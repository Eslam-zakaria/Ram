<?php

namespace Modules\Doctor\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorTranslation extends Model
{
    protected $fillable = ['name', 'description', 'bio','meta_title', 'meta_description', 'meta_keywords', 'canonical_url','alt_image','slug'];
}
