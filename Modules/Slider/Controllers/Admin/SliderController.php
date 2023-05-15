<?php

namespace Modules\Slider\Controllers\Admin;

use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use App\Http\Services\UploaderService;
use Modules\Page\Models\Page;
use Modules\Slider\Models\Slider;
use Illuminate\Http\Request;
use PhpParser\Comment\Doc;
use Modules\Slider\Http\Requests\SliderStoreRequest;
use Modules\Slider\Http\Requests\SliderUpdateRequest;

class SliderController extends Controller
{
    /**
     * @var UploaderService
     */
    private $uploaderService;

    public function __construct(UploaderService $uploaderService)
    {
        $this->uploaderService = $uploaderService;
    }

    private $viewsPath = 'Slider.Resources.views.';

    public function index()
    {

        return view($this->viewsPath.'index');
    }


    public function create()
    {
        return view($this->viewsPath.'create');
    }

    public function store(SliderStoreRequest $request) {
        $slider = new Slider();
        $slider->fill($request->request->all());

        if ($request->hasFile('image') ) {
            $slider->image = $this->uploaderService->upload($request->file("image"), "sliders");
        }

        $slider->save();

        return redirect()->route('admin.sliders.index')->with(['success' => 'Updated Successfully']);
    }


    public function edit(Slider $slider)
    {
        return view($this->viewsPath.'edit',['form' => $slider]);
    }


    public function update(Slider $slider, SliderUpdateRequest $request) {

        $slider->fill($request->request->all());

        if ($request->hasFile('image') ) {
            $slider->image = $this->uploaderService->upload($request->file("image"), "sliders");
        }

        $slider->save();

        return redirect()->route('admin.sliders.index')->with(['success' => 'Updated Successfully']);
    }

    public function enable(Slider $slider, Request $request) {
        $slider->status = Statuses::ACTIVE;
        $slider->save();

        return redirect()->route('admin.sliders.index')->with(['success' => 'Updated Successfully']);
    }

    public function disable(Slider $slider, Request $request) {
        $slider->status = Statuses::DISABLED;
        $slider->save();

        return redirect()->route('admin.sliders.index')->with(['success' => 'Updated Successfully']);
    }
}

