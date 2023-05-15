<?php

namespace Modules\Discount\Models;


use App\Constants\BookingStatuses;
use Eloquent;
use Mail;
use Modules\Discount\Models\Discount;
use Modules\Branche\Models\Branche;
use Modules\Doctor\Models\Doctor;
class DiscountBooking extends Eloquent
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'discount_id','branche_id','doctor_id', 'attendance_date','source','notes','status'
    ];


    /**
     * Get the post that owns the comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function discount()
    {
        return $this->belongsTo(Discount::class);
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

    /**
     * Get the post that owns the comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branche()
    {
        return $this->belongsTo(Branche::class);
    }


    protected $appends = [
        'statusLabel'
    ];

    public function getStatusLabelAttribute()
    {
        return BookingStatuses::getLabel($this->status);
    }
}
