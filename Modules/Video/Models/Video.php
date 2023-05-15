<?php

namespace Modules\Video\Models;


use App\Constants\Statuses;
use Eloquent;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Modules\Page\Models\Page;
use Modules\Specificity\Models\Specificity;
use Modules\Doctor\Models\Doctor;

class Video extends Eloquent  implements TranslatableContract
{
    use Translatable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'image','video','doctor_id'
    ];

    public $translatedAttributes = ['name'];
    

    protected $appends =[
        'statusLabel'
    ];

    public function getStatusLabelAttribute()
    {
        return Statuses::getLabel($this->status);
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
}
