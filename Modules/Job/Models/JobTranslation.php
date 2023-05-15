<?php

namespace Modules\Job\Models;

use Illuminate\Database\Eloquent\Model;

class JobTranslation extends Model
{
    protected $fillable = ['name', 'content', 'description', 'requirements'];
}
