<?php

namespace Modules\Ivehicles\Entities;

use Illuminate\Database\Eloquent\Model;

class FeatureTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
    protected $table = 'ivehicles__feature_translations';
}
