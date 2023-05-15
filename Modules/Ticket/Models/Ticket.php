<?php

namespace Modules\Ticket\Models;


use Eloquent;
use Mail;
use Modules\Branche\Models\Branche;
use Modules\Doctor\Models\Doctor;
use Modules\Offer\Models\Offer;
use Modules\Ticket\Constants\TicketPurpose;

class Ticket extends Eloquent
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'topic' , 'content', 'purpose'
    ];

    /**
     * The attributes that are appended.
     *
     * @var array
     */
    protected $appends = [
        'purposeLabel'
    ];

    public function getPurposeLabelAttribute()
    {
       return TicketPurpose::getLabel($this->purpose);
    }
}
