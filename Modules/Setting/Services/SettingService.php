<?php

namespace Modules\Setting\Services;


use Illuminate\Http\UploadedFile;
use Modules\Setting\Models\Setting;

class SettingService
{
    public function get($key)
    {
        $setting = Setting::query()->where('key', $key)->first();
        return  $setting ? $setting->value : '';
    }

    public function has($key)
    {
        return $this->get($key) ? true : false;
    }
}
