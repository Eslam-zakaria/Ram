<?php

namespace Modules\Discount\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Eloquent;
use Modules\Branche\Models\Branche;
use App\Constants\Statuses;
class DiscountCategory extends Eloquent  implements TranslatableContract
{
    use Translatable;
    protected $fillable = ['name', 'slug'];

    public $translatedAttributes = ['name'];

    public function branches()
    {
        return $this->belongsToMany(Branche::class);
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class,'category_id','id')->where('status',Statuses::ACTIVE);
    }
}
