<?php

namespace Modules\Ivehicles\Entities;

use Illuminate\Database\Eloquent\Model;

class BrandTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name','slug','description'];
    protected $table = 'ivehicles__brand_translations';
}
