<?php

namespace Modules\Offer\Models;

use Illuminate\Database\Eloquent\Model;

class OfferTranslation extends Model
{
    protected $fillable = ['name', 'description','meta_title','alt_image','canonical_url','meta_description','meta_keywords'];
}