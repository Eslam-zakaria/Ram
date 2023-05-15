<?php

namespace Modules\Casing\Controllers\Admin;

use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use App\Http\Services\UploaderService;
use Illuminate\Database\Query\JoinClause;
use Modules\Casing\Models\CasingCategory;
use Modules\Casing\Models\Casing;
use Illuminate\Http\Request;
use Modules\Doctor\Models\Doctor;
use Modules\Casing\Http\Requests\CasingStoreRequest;
use Modules\Casing\Http\Requests\CasingUpdateRequest;

class CasingController extends Controller
{
    private $viewsPath = 'Casing.Resources.views.';

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

    public function create()
    {
        $doctors = Doctor::where('status', Statuses::ACTIVE)->listsTranslations('name')->get();
        $categories = CasingCategory::listsTranslations('name')->get();

        return view($this->viewsPath.'create', compact('doctors', 'categories'));
    }

    public function store(CasingStoreRequest $request) {

        $Casing = new Casing();
        $Casing->fill($request->request->all());

        if ($request->hasFile('image_before')) {
            $Casing->image_before = $this->uploaderService->upload($request->file("image_before"), "Casings");
        }

        if ($request->hasFile('image_after')) {
            $Casing->image_after = $this->uploaderService->upload($request->file("image_after"), "Casings");
        }

        $Casing->save();
        return redirect()->route('admin.Casings.index')->with(['success' => 'Updated Successfully']);
    }

    public function edit(Casing $Casing)
    {
        $doctors = Doctor::where('status', Statuses::ACTIVE)->listsTranslations('name')->get();
        $categories = CasingCategory::listsTranslations('name')->get();

        return view($this->viewsPath.'edit',['form' => $Casing,
            'categories' => $categories,
            'doctors' => $doctors
            ]);
    }

    public function update(Casing $Casing, CasingUpdateRequest $request) {

        $Casing->fill($request->all());

        if ($request->hasFile('image_before')) {
            $Casing->image_before = $this->uploaderService->upload($request->file("image_before"), "Casings");
        }

        if ($request->hasFile('image_after')) {
            $Casing->image_after = $this->uploaderService->upload($request->file("image_after"), "Casings");
        }

        $Casing->save();

        return redirect()->route('admin.Casings.index')->with(['success' => 'Updated Successfully']);
    }


    public function enable(Casing $Casing, Request $request)
    {
        $Casing->status = Statuses::ACTIVE;
        $Casing->save();

        return redirect()->route('admin.Casings.index')->with(['success' => 'Updated Successfully']);
    }

    public function disable(Casing $Casing, Request $request)
    {
        $Casing->status = Statuses::DISABLED;
        $Casing->save();

        return redirect()->route('admin.Casings.index')->with(['success' => 'Updated Successfully']);
    }
}