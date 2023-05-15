<?php

namespace Modules\Service\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceTranslation extends Model
{
    protected $fillable = ['name', 'description', 'meta_title', 'meta_description', 'meta_keywords', 'canonical_url','alt_image','slug'];
}
