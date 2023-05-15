<?php

namespace Modules\Testimonial\Models;


use App\Constants\Statuses;
use Eloquent;
use Modules\Specificity\Models\Specificity;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Testimonial extends Eloquent  implements TranslatableContract
{
    use Translatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'image'
    ];

    protected $appends =[
        'statusLabel'
    ];

    public $translatedAttributes = ['name', 'description'];

    public function getStatusLabelAttribute()
    {
        return Statuses::getLabel($this->status);
    }

    public function specificities()
    {
        return $this->belongsToMany(Specificity::class, 'testimonial_specificities', 'testimonial_id', 'specificity_id');
    }
}
