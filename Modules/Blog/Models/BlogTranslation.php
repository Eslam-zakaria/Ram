<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class BlogTranslation extends Model
{
    protected $fillable = [
        'name',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'alt_image',
        'slug',
        'new_slug'
    ];
}
