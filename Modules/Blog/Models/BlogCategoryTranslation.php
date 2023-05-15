<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategoryTranslation extends Model
{
    protected $fillable = ['name', 'meta_title', 'meta_description', 'meta_keywords', 'canonical_url','slug'];
}
