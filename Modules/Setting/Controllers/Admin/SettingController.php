<?php

namespace Modules\Setting\Controllers\Admin;

use App\Constants\SettingTypes;
use App\Http\Controllers\Controller;
use App\Http\Services\UploaderService;
use Modules\Setting\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private $viewsPath = 'Setting.Resources.views.';

    /**
     * @var UploaderService
     */
    private $uploaderService;

    public function __construct(UploaderService $uploaderService)
    {
        $this->uploaderService = $uploaderService;
    }

    public function index()
    {
        return view($this->viewsPath.'index');
    }

    public function edit(Setting $setting)
    {
        return view($this->viewsPath.'.edit',['form' => $setting]);
    }

    public function update(Setting $setting, Request $request) {
        $criteria = [
            'name' => '',
            'value' => '',
        ];

        $request->validate($criteria);

        $setting->fill($request->all());

        if ($request->hasFile('image')) {
            $setting->image = $this->uploaderService->upload($request->file("image"), "settings");
            $setting->translateOrNew('en')->value = $setting->image;
            $setting->translateOrNew('ar')->value = $setting->image;
        }

        $setting->save();

        return redirect()->route('admin.settings.index')->with(['success' => 'Updated Successfully']);
    }
}

