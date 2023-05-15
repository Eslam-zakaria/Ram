<?php

namespace Modules\Discount\Models;


use App\Constants\Statuses;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Eloquent;
use Modules\Discount\Models\DiscountCategory;

class Discount extends Eloquent  implements TranslatableContract
{

    use Translatable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image', 'status', 'price', 'card_id', 'category_id'
    ];

    public $translatedAttributes = ['name', 'description'];


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


    public function category()
    {
        return $this->belongsTo(DiscountCategory::class);
    }

    public function card()
    {
        return $this->belongsTo(Card::class);
    }
}
