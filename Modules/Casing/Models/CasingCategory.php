<?php

namespace Modules\Casing\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Eloquent;
use Modules\Branche\Models\Branche;

class CasingCategory extends Eloquent  implements TranslatableContract
{
    use Translatable;
    protected $fillable = ['name'];

    public $translatedAttributes = ['name'];

    public function Casings()
    {
        return $this->belongsToMany(Discount::class);
    }

    public function branches()
    {
        return $this->belongsToMany(Branche::class);
    }
}