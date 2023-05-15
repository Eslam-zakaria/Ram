<?php

namespace App\Services;

use App\Http\Services\UploaderService;
use Illuminate\Support\Facades\Schema;
use Modules\Setting\Models\Setting;

class SettingsServices
{
    protected $setting;
    protected $uploaderService;


    public function __construct(Setting $setting, UploaderService $uploaderService)
    {
        $this->setting = $setting;
        $this->uploaderService = $uploaderService;
    }

    public function list(array $data = [])
    {
        $settings = $this->setting->with('translations')->get();

        foreach ($settings as $setting){
            $data[$setting->key]['ar'] = $setting->translate('ar')->value;
            $data[$setting->key]['en'] = $setting->translate('en')->value;
        }

        return $data;
    }

    public function update(array $payload)
    {

        if(isset($payload['images'])){
            foreach ($payload['images'] as $key => $image){

                $oldSetting = $this->setting->where('key', $key)->first();

                if( !$oldSetting ){

                    $image_path = $this->uploaderService->upload($image, "settings");
                    $setting = $this->setting->fill(['key' => $key, 'other_value' => $image_path]);
                    $setting->save();

                }else{

                    $image_path = $this->uploaderService->upload($image, "settings");
                    $oldSetting->other_value = $image_path;
                    $oldSetting->update();

                }

            }
        }else{
            foreach ($payload as $key => $data){
                if( $data != null ){

                    $oldSetting = $this->setting->where('key', $key)->first();

                    if( !$oldSetting ){
                        $setting = $this->setting->fill(!is_array($data) ? ['key' => $key, 'other_value' => $data] : array_merge($data, ['key' => $key, 'translatable' => 2]));
                        $setting->save();
                    }else{
                        $oldSetting->fill(!is_array($data) ? ['key' => $key, 'other_value' => $data] : array_merge($data, ['key' => $key, 'translatable' => 2]));
                        $oldSetting->update();
                    }

                }

            }
        }

        /*if ($request->hasFile('image')) {
            $setting->image = $this->uploaderService->upload($request->file("image"), "settings");
            $setting->translateOrNew('en')->value = $setting->image;
            $setting->translateOrNew('ar')->value = $setting->image;
        }
        $setting->save();*/
    }
}
