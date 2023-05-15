<?php

namespace Modules\Specificity\Models;

use Illuminate\Database\Eloquent\Model;

class SpecificityTranslation extends Model
{
    protected $fillable = ['name', 'description', 'slug','meta_title', 'canonical_url', 'meta_description', 'meta_keywords','alt_image','alt_brief_image','brief'];
}
