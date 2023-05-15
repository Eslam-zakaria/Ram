<?php

namespace Modules\Branche\Controllers\Admin;

use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use App\Http\Services\UploaderService;
use Illuminate\Database\Query\JoinClause;
use Modules\Branche\Models\Branche;
use Illuminate\Http\Request;
use Modules\Country\Models\Country;
use Modules\Specificity\Models\Specificity;
use Modules\Service\Models\Service;
use PhpParser\Comment\Doc;
use Modules\Branche\Http\Requests\BrancheStoreRequest;
use Modules\Branche\Http\Requests\BrancheUpdateRequest;
use Validator;
class BrancheController extends Controller
{
    /**
     * @var UploaderService
     */
    private $uploaderService;

    public function __construct(UploaderService $uploaderService)
    {
        $this->uploaderService = $uploaderService;
    }

    private $viewsPath = 'Branche.Resources.views.';

    public function index()
    {

        return view($this->viewsPath.'index');
    }


    public function create()
    {
        $countries = Country::listsTranslations('name')->get();
        $services = Service::where('status', Statuses::ACTIVE)->listsTranslations('name')->get();
        return view($this->viewsPath.'create', compact('countries','services'));
    }

    public function store(BrancheStoreRequest $request) {

        $branche = new Branche();
        $branche->fill($request->request->all());

        if ($request->hasFile('image')) {
            $branche->image = $this->uploaderService->upload($request->file("image"), "branches");
        }

        $branche->save();

        if ($services = $request->get('service')) {
            $branche->services()->attach($services);
        }

        return redirect()->route('admin.branches.index')->with(['success' => 'Updated Successfully']);
    
    }


    public function edit(Branche $branche)
    {
        $BranchesservicesIds = [];
        if (count($branche->services) > 0 ) {
            foreach($branche->services as $service) {
                $BranchesservicesIds[] = $service->id;
            }
        }

        $countries = Country::listsTranslations('name')->get();
        
        $currentLocale = config('app.locale');
        $services = Service::where('status', Statuses::ACTIVE)->join('service_translations', function (JoinClause $join) {
            $join->on('service_translations.service_id', '=', 'services.id');
        })->where('service_translations.locale', 'ar')->pluck('service_translations.name', 'services.id');

        return view($this->viewsPath.'edit',['form' => $branche, 'countries' => $countries , 'services' => $services ,'BranchesservicesIds' => $BranchesservicesIds]);
    }


    public function update(Branche $branche, BrancheUpdateRequest $request) {
        

        $branche->fill($request->request->all());

        if ($request->hasFile('image') ) {
            $branche->image = $this->uploaderService->upload($request->file("image"), "branches");
        }

        if ($services = $request->get('service')) {
            $branche->services()->sync($services);
            }

        $branche->save();

        return redirect()->route('admin.branches.index')->with(['success' => 'Updated Successfully']);

    }

    public function enable(Branche $branche, Request $request) {
        $branche->status = Statuses::ACTIVE;
        $branche->save();

        return redirect()->route('admin.branches.index')->with(['success' => 'Updated Successfully']);
    }

    public function disable(Branche $branche, Request $request) {
        $branche->status = Statuses::DISABLED;
        $branche->save();

        return redirect()->route('admin.branches.index')->with(['success' => 'Updated Successfully']);
    }

    public function delete(Branche $branche, Request $request) {

        $branche->delete();

        return redirect()->route('admin.branches.index')->with(['success' => 'Deleted Successfully']);
    }
}

