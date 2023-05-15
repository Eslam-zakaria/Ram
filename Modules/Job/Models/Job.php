<?php

namespace Modules\Job\Models;


use App\Constants\Statuses;
use Eloquent;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Modules\Branche\Models\Branche;
use Modules\Department\Models\Department;

class Job extends Eloquent  implements TranslatableContract
{
    use Translatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'image', 'branche_id', 'department_id', 'status'
    ];

    protected $appends =[
        'statusLabel'
    ];

    public $translatedAttributes = ['name', 'content', 'description', 'requirements'];

    public function getStatusLabelAttribute()
    {
        return Statuses::getLabel($this->status);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branche()
    {
        return $this->belongsTo(Branche::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
