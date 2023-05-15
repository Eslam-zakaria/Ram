<?php

namespace Modules\Setting\Models;


use App\Constants\SettingTypes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Eloquent;

class Setting extends Eloquent  implements TranslatableContract
{
    use Translatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'key',  'template', 'image' , 'type'
    ];

    protected $appends =[
        'typeLabel'
    ];

    public function getTypeLabelAttribute()
    {
        return SettingTypes::getLabel($this->type);
    }

    public $translatedAttributes = ['name', 'value'];

}
