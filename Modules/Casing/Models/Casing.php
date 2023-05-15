<?php

namespace Modules\Casing\Models;

use App\Constants\Statuses;
use Eloquent;
use Modules\Casing\Models\CasingCategory;
use Modules\Doctor\Models\Doctor;

class Casing extends Eloquent
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image_before', 'image_after', 'status', 'doctor_id', 'category_id'
    ];


    protected $appends =[
        'statusLabel'
    ];

    public function getStatusLabelAttribute()
    {
        return Statuses::getLabel($this->status);
    }

    public function category()
    {
        return $this->belongsTo(CasingCategory::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}