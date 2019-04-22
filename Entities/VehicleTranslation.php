<?php

namespace Modules\Ivehicles\Entities;

use Illuminate\Database\Eloquent\Model;

class VehicleTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name','description','slug','metatitle','metadescription','metakeywords'];
    protected $table = 'ivehicles__vehicle_translations';


    public function getMetatitleAttribute(){


        return $this->metatitle ?? $this->title;

    }
    public function getMetadescriptionAttribute(){

        return $this->metadescription ?? substr(strip_tags($this->description),0,150);
    }
}
