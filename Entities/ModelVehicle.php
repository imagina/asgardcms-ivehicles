<?php

namespace Modules\Ivehicles\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\NamespacedEntity;

class ModelVehicle extends Model
{
    use Translatable, NamespacedEntity;

    protected $table = 'ivehicles__models';
    public $translatedAttributes = ['name'];
    protected $fillable = ['name','brand_id'];
    public $translationForeignKey ="model_id";

    protected $cast = [
    ];


    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function vehicles(){
        return $this->hasMany(Vehicle::class);
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
        $config = implode('.', ['asgard.ivehicle.config.relations.models', $method]);

        #i: Relation method resolver
        if (config()->has($config)) {
            $function = config()->get($config);

            return $function($this);
        }

        #i: No relation found, return the call to parent (Eloquent) to handle it.
        return parent::__call($method, $parameters);
    }
}
