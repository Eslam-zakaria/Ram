<?php

namespace Modules\Service\Models;


use App\Constants\Statuses;
use Eloquent;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Modules\Page\Models\Page;
use Modules\Specificity\Models\Specificity;
use Modules\Branche\Models\Branche;
use Modules\Service\Http\Requests\ServiceStoreRequest;
use Modules\Service\Http\Requests\ServiceUpdateRequest;

class Service extends Eloquent  implements TranslatableContract
{
    use Translatable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'image','icon','type_of_place'
    ];

    public $translatedAttributes = [
        'name',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'alt_image',
        'slug'
    ];


    protected $appends =[
        'statusLabel'
    ];

    public function getStatusLabelAttribute()
    {
        return Statuses::getLabel($this->status);
    }

    public function specialities()
    {
        return $this->hasMany(Specificity::class);
    }

    public function branches()
    {
        return $this->belongsToMany(Branche::class, 'services_branches', 'service_id', 'branche_id');
    }
}
