<?php

namespace Modules\Page\Models;


use App\Constants\Genders;
use App\Constants\Statuses;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Eloquent;
use Modules\Branche\Models\Branche;
use Modules\Offer\Models\Offer;
use Modules\Service\Models\Service;

class Page extends Eloquent  implements TranslatableContract
{

    use Translatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'gender', 'image', 'template', 'footer_image', 'discount_text', 'discount_url', 'discount_percent'
    ];

    protected $appends =[
        'statusLabel', 'genderLabel'
    ];

    public $translatedAttributes = ['name', 'description'];


    public function getStatusLabelAttribute()
    {
        return Statuses::getLabel($this->status);
    }

    public function getGenderLabelAttribute()
    {
        return Genders::getLabel($this->gender);
    }
}
