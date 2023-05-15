<?php

namespace Modules\Specificity\Models;

use App\Constants\Statuses;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Modules\Specificity\Models\Specificity;
use Eloquent;

class Category extends Eloquent  implements TranslatableContract
{
    use Translatable;
    protected $fillable = ['specificity_id'];

    public $translatedAttributes = ['name'];


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
    public function specificity()
    {
        return $this->belongsTo(Specificity::class);
    }

    public function enabledSpecialities() {
        return $this->specialities()->where('status','=', Statuses::ACTIVE);
    }


}
