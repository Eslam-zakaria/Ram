<?php

namespace Modules\Specificity\Models;


use App\Constants\Statuses;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Eloquent;
use Modules\Doctor\Models\Doctor;
use Modules\Service\Models\Service;
class Specificity extends Eloquent  implements TranslatableContract
{

    use Translatable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
     'service_id', 'icon','image'
    ];

    public $translatedAttributes = ['name', 'description', 'slug','meta_title', 'canonical_url', 'meta_description', 'meta_keywords','alt_image','alt_brief_image','brief'];

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
        return $this->belongsTo(Service::class);
    }

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_specificities', 'specificity_id', 'doctor_id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function enabledcategories()
    {
        return $this->hasMany(Category::class)->where('status',Statuses::ACTIVE);
    }
}
