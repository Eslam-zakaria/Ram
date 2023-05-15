<?php

namespace Modules\Blog\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Eloquent;

class BlogCategory extends Eloquent  implements TranslatableContract
{
    use Translatable;

    protected $fillable = ['name'];

    public $translatedAttributes = [
        'name',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'slug',
        'new_slug'
    ];
}
