<?php

namespace Modules\Ivehicles\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Core\Traits\NamespacedEntity;
use Modules\Ivehicles\Presenters\BrandPresenter;

class Brand extends Model
{
    use Translatable,PresentableTrait, NamespacedEntity;


    protected $table = 'ivehicles__brands';
    public $translatedAttributes = ['name','slug','description'];
    protected $fillable = ['name','slug','description','options', 'status'];
    protected $cast = [
        'status' => 'int',
        'options'=>'array'
    ];

   protected $presenter =BrandPresenter::class;


    /**
     * Relation by Models Vehicles
     * @return mixed
     */
    public function models()
    {
        return $this->hasMany(ModelVehicle::class);
    }

    /**
     * Relation with Vehicles
     * @return mixed
     */
    public function vehicles(){
        return $this->hasMany(Vehicle::class);
    }

    /**
     * Check if the post is in draft
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive($query)
    {
        return $query->whereStatus(Status::ACTIVE);
    }

    /**
     * Check if the post is in draft
     * @param Builder $query
     * @return Builder
     */
    public function scopeInactive($query)
    {
        return $query->whereStatus(Status::INACTIVE);
    }

    /**
     * Magic Method modification to allow dynamic relations to other entities.
     * @var $method
     * @var $destination_path
     * @return string
     */
    public function __call($method, $parameters)
    {
        #i: Convert array to dot notation
        $config = implode('.', ['asgard.ivehicle.config.relations.brands', $method]);

        #i: Relation method resolver
        if (config()->has($config)) {
            $function = config()->get($config);

            return $function($this);
        }

        #i: No relation found, return the call to parent (Eloquent) to handle it.
        return parent::__call($method, $parameters);
    }

}
