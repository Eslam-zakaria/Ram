<?php

namespace Modules\Offer\Models;

use Illuminate\Database\Eloquent\Model;

class OfferBrancheTranslation extends Model
{
    protected $fillable = ['name','slug','desc_offer','currency','meta_title','alt_image','canonical_url','meta_description','meta_keywords'];
}