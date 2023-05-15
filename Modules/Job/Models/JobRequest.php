<?php

namespace Modules\Job\Models;


use Eloquent;
use Mail;
use Modules\Branche\Models\Branche;
use Modules\Job\Models\Job;
use Modules\Offer\Models\Offer;

class JobRequest extends Eloquent
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'job_id', 'resume' , 'notes', 'nationality', 'birthdate'
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
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function getSentLabelAttribute()
    {
        return $this->sent ? 'Sent' : 'Pending';
    }
}
