<?php

namespace Modules\Setting\Models;

use Illuminate\Database\Eloquent\Model;

class SettingTranslation extends Model
{
    protected $fillable = ['name', 'value'];
}
