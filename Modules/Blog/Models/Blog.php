<?php

namespace Modules\Blog\Models;

use App\Constants\Statuses;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Eloquent;
use Illuminate\Support\Str;
use Modules\Blog\Models\BlogCategory;

class Blog extends Eloquent  implements TranslatableContract
{
    use Translatable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'image'
    ];

    public $translatedAttributes = [
        'name',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'alt_image',
        'slug'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    protected $appends = ['statusLabel', 'blogDetailsLink'];

    public function getStatusLabelAttribute()
    {
        return Statuses::getLabel($this->status);
    }

    /**
     * Get blog url.
     *
     * @return string
     */
    public function getBlogDetailsLinkAttribute(): string
    {
        return url($this->translate(app()->getLocale())->new_slug ?? $this->translate(app()->getLocale())->slug ?? '') . ( app()->getLocale() != 'ar' ? '?lang=en' : '' );
    }
}
