<?php

namespace Modules\Branche\Models;


use App\Constants\Statuses;
use Eloquent;
use Modules\Country\Models\Country;
use Modules\Specificity\Models\Specificity;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Modules\Service\Models\Service;
use Modules\Offer\Models\Offer;

class Branche extends Eloquent  implements TranslatableContract
{
    use Translatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'country_id', 'reference_id','phone' ,'location' ,'image'
    ];

    protected $appends =[
        'statusLabel'
    ];

    public $translatedAttributes = ['name', 'description'];

    public function getStatusLabelAttribute()
    {
        return Statuses::getLabel($this->status);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function specificities()
    {
        return $this->belongsToMany(Specificity::class, 'branche_specificities', 'branche_id', 'specificity_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'branche_services', 'branche_id', 'service_id');
    }

    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'offer_list_branches', 'branche_id', 'offer_id');
    }
}
