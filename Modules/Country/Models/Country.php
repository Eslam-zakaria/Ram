<?php

namespace Modules\Country\Models;

use Astrotomic\Translatable\Translatable;
use Eloquent;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Modules\Branche\Models\Branche;
use App\Constants\Statuses;
class Country extends Eloquent implements TranslatableContract
{
    use Translatable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key',
    ];

    public $translatedAttributes = ['name'];

    public function branche()
    {
        return $this->hasMany(Branche::class)->where('status', Statuses::ACTIVE);
    }
}
