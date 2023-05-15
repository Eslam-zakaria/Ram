<?php

namespace Modules\Offer\Models;


use App\Constants\Statuses;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Eloquent;
use Modules\Service\Models\Service;
use Modules\Branche\Models\Branche;
use Modules\Offer\Models\OfferBranche;

class Offer extends Eloquent  implements TranslatableContract
{

    use Translatable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'price','discount','price_after_discount','image' ,'service_id','branche_id','slider_image','status_payment','status_installment'
    ];
 
    public $translatedAttributes = [
        'name','meta_title','alt_image','canonical_url','meta_description','meta_keywords'
    ];

    /**
     * Get the post that owns the comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get the post that owns the comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branche()
    {
        return $this->belongsTo(OfferBranche::class);
    }

    public function branches()
    {
        return $this->belongsToMany(Branche::class, 'offer_list_branches', 'offer_id', 'branche_id');
    }

    protected $appends =[
        'statusLabel'
    ];

    public function getStatusLabelAttribute()
    {
        return Statuses::getLabel($this->status);
    }
}
