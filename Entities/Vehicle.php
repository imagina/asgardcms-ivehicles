<?php

namespace Modules\Ivehicles\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Core\Traits\NamespacedEntity;
use Modules\Ivehicles\Presenters\VehiclePresenter;


class Vehicle extends Model
{
    use Translatable,PresentableTrait, NamespacedEntity;

    protected $table = 'ivehicles__vehicles';
    public $translatedAttributes = ['name','description','slug','metatitle','metadescription','metakeywords'];
    protected $fillable = ['name','description','slug','metatitle','metadescription','metakeywords','mileage','engine','price', 'address','model_id','brand_id','fuel','transmission','owner_id','options','status','year','featured'];
    protected $presenter = VehiclePresenter::class;
    protected $casts = [
        'options' => 'array'
    ];

    public function modelVehicle()
    {
        return $this->belongsTo(ModelVehicle::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'ivehicles__vehicle_feature');
    }

    public function owner()
    {
        $driver = config('asgard.user.config.driver');

        return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User",'owner_id');
    }


    public function getMainimageAttribute(){

        $image=$this->options->mainimage ?? 'modules/ivehicles/img/default.jpg';
        $v=strftime('%u%w%g%k%M%S', strtotime($this->updated_at));
        // dd($v) ;
        return url($image.'?v='.$v);
    }
    public function getMediumimageAttribute(){

        return url(str_replace('.jpg','_mediumThumb.jpg',$this->options->mainimage ?? 'modules/ivehicles/img/default.jpg'));
    }
    public function getThumbailsAttribute(){

        return url(str_replace('.jpg','_smallThumb.jpg',$this->options->mainimage?? 'modules/ivehicles/img/default.jpg'));
    }


    public function getUrlAttribute(){

        return  \URL::route('ivehicles.vehicles.show', [$this->brand->slug,$this->slug]);
    }
    public function getOptionsAttribute($value)
    {
        return json_decode($value);

    }
    public function getVideosAttribute(){

        if (isset($this->options->videos)&&!empty($this->options->videos)){

            $videos = explode(',',$this->options->videos);

            return $videos;
        }
        return null;
    }

    /**
     * get Gallery
     * @return string
     */
    public function getGalleryAttribute()
    {

        $images = \Storage::disk('publicmedia')->files('assets/ivehicles/vehicles/gallery/' . $this->id);
        if (count($images)) {
            return $images;
        }
        return null;
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
        return $query->whereStatus(Status::INACTVE);

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
        $config = implode('.', ['asgard.ivehicles.config.relations.vehicles', $method]);

        #i: Relation method resolver
        if (config()->has($config)) {
            $function = config()->get($config);

            return $function($this);
        }

        #i: No relation found, return the call to parent (Eloquent) to handle it.
        return parent::__call($method, $parameters);
    }
}
