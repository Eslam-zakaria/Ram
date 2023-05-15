<?php

namespace Modules\Specificity\Controllers\Admin;

use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\JoinClause;
use Modules\Specificity\Models\Category;
use Modules\Specificity\Models\Specificity;
use App\Http\Services\UploaderService;
use Modules\Service\Models\Service;
use Illuminate\Http\Request;
use Modules\Specificity\Http\Requests\SpecificityUpdateRequest;
use Modules\Specificity\Http\Requests\SpecificityStoreRequest;

class SpecificityController extends Controller
{
    /**
     * @var UploaderService
     */
    private $uploaderService;

    public function __construct(UploaderService $uploaderService)
    {
        $this->uploaderService = $uploaderService;
    }

    private $viewsPath = 'Specificity.Resources.views.';

    public function index()
    {

        return view($this->viewsPath.'index');
    }

    public function create()
    {
        $currentLocale = config('app.locale');
        $categories = Category::join('category_translations', function (JoinClause $join) {
            $join->on('category_translations.category_id', '=', 'categories.id');
        })->where('category_translations.locale', 'ar')->get();

        $services = Service::where('status', Statuses::ACTIVE)->listsTranslations('name')->get();

        return view($this->viewsPath.'create', compact('categories','services'));
    }

    public function store(SpecificityStoreRequest $request) {

        $specificity = new Specificity();
        $specificity->fill($request->request->all());

        if ($request->hasFile('image') ) {
            $specificity->image = $this->uploaderService->upload($request->file("image"), "specificity");
        }

        if ($request->hasFile('icon') ) {
            $specificity->icon = $this->uploaderService->upload($request->file("icon"), "specificity");
        }

        $specificity->save();
        return redirect()->route('admin.specificities.index')->with(['success' => 'Updated Successfully']);
    }

    public function edit(Specificity $Specificity)
    {
        $currentLocale = config('app.locale');
        $categories = Category::join('category_translations', function (JoinClause $join) {
            $join->on('category_translations.category_id', '=', 'categories.id');
        })->where('category_translations.locale', 'ar')->get();

        $services = Service::where('status', Statuses::ACTIVE)->listsTranslations('name')->get();

        return view($this->viewsPath.'edit',['form' => $Specificity,
            'categories' => $categories,'services' => $services
            ]);
    }

    public function update(Specificity $specificity, SpecificityUpdateRequest $request) {

        $specificity->fill($request->request->all());

        if ($request->hasFile('image') ) {
            $specificity->image = $this->uploaderService->upload($request->file("image"), "specificity");
        }

        if ($request->hasFile('icon') ) {
            $specificity->icon = $this->uploaderService->upload($request->file("icon"), "specificity");
        }
        
        $specificity->save();

        return redirect()->route('admin.specificities.index')->with(['success' => 'Updated Successfully']);
    }

    public function enable(Specificity $specificity, Request $request)
    {
        $specificity->status = Statuses::ACTIVE;
        $specificity->save();

        return redirect()->route('admin.specificities.index')->with(['success' => 'Updated Successfully']);
    }

    public function disable(Specificity $specificity, Request $request)
    {
        $specificity->status = Statuses::DISABLED;
        $specificity->save();

        return redirect()->route('admin.specificities.index')->with(['success' => 'Updated Successfully']);
    }

    public function delete(Specificity $specificity, Request $request)
    {
        $specificity->delete();

        return redirect()->route('admin.specificities.index')->with(['success' => 'Deleted Successfully']);
    }
}

