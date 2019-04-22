<?php

namespace Modules\Ivehicles\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Core\Traits\NamespacedEntity;
use Modules\Ivehicles\Presenters\FeaturePresenter;
use Illuminate\Database\Eloquent\Builder;

class Feature extends Model
{
    use Translatable,PresentableTrait, NamespacedEntity;


    protected $table = 'ivehicles__features';
    public $translatedAttributes = ['name'];
    protected $fillable = ['name','type'];
    protected $presenter = FeaturePresenter::class;
    protected $cast = [
        'type' => 'int'
    ];


    public function vehicles(){
        return $this->belongsToMany(Vehicle::class,'ivehicles__vehicle_feature');
    }

    /**
     * Check if the post is in draft
     * @param Builder $query
     * @return Builder
     */
    public function scopeInside(Builder $query)
    {
        return $query->where('type',TypeFeature::INSIDE);
    }

    /**
     * Check if the post is in draft
     * @param Builder $query
     * @return Builder
     */
    public function scopeEquipment(Builder $query)
    {
        return $query->where('type',TypeFeature::EQUIPMENT);
    }

    /**
     * Check if the post is in draft
     * @param Builder $query
     * @return Builder
     */
    public function scopeOutside(Builder $query)
    {
        return $query->where('type',TypeFeature::OUTSIDE);
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
        $config = implode('.', ['asgard.ivehicle.config.relations.features', $method]);

        #i: Relation method resolver
        if (config()->has($config)) {
            $function = config()->get($config);

            return $function($this);
        }

        #i: No relation found, return the call to parent (Eloquent) to handle it.
        return parent::__call($method, $parameters);
    }
}
