<?php

namespace Modules\Doctor\Models;


use App\Constants\Statuses;
use Eloquent;
use Modules\Branche\Models\Branche;
use Modules\Specificity\Models\Specificity;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Modules\Country\Models\Country;
use Modules\Service\Models\Service;

class Doctor extends Eloquent implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = [
        'name',
        'description',
        'bio',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'alt_image',
        'slug'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image',
        'start_time',
        'end_time' ,
        'years_of_experience',
        'country_id',
        'specialty_id'
    ];

    protected $casts = [
        'available_days' => 'array'
    ];

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
    public function service()
    {
        return $this->belongsTo(Service::class,'specialty_id','id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function specificity()
    {
        return $this->belongsTo(Specificity::class);
    }

    public function branches()
    {
        return $this->belongsToMany(Branche::class, 'doctor_branches', 'doctor_id', 'branche_id');
    }

    public function specificities()
    {
        return $this->belongsToMany(Specificity::class, 'doctor_specificities', 'doctor_id', 'specificity_id');
    }

    public function videos()
    {
        return $this->belongsToMany(Video::class,'id','doctor_id');
    }
}
