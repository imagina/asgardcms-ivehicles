<?php

namespace Modules\Ivehicles\Entities;

use Illuminate\Database\Eloquent\Model;

class ModelVehicleTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
    protected $table = 'ivehicles__model_translations';
}
