<?php

namespace Modules\Lead\Models;


use Eloquent;
use Mail;
use Modules\Branche\Models\Branche;
use Modules\Offer\Models\Offer;
use Modules\Doctor\Models\Doctor;
use Modules\Specificity\Models\Specificity;
use Modules\Lead\Constants\LeadStatus;
class Lead extends Eloquent
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'branche_id', 'offer_id','speciality_id','doctor_id','source', 'sourceid', 'urlsourceid','company', 'rates'
    ];
    /**
     * The attributes that are appended.
     *
     * @var array
     */
    protected $appends = [
        'sentLabel'
    ];


    /**
     * Get the post that owns the comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    /**
     * Get the post that owns the comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branche()
    {
        return $this->belongsTo(Branche::class);
    }

    /**
     * Get the post that owns the comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function speciality()
    {
        return $this->belongsTo(Specificity::class);
    }

    /**
     * Get the post that owns the comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function getSentLabelAttribute()
    {
        return LeadStatus::getLabel($this->sent);
    }



}
