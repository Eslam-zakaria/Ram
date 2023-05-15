<?php

namespace Modules\Service\Controllers\Admin;

use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use App\Http\Services\UploaderService;
use Illuminate\Database\Query\JoinClause;
use Modules\Page\Models\Page;
use Modules\Service\Models\Service;
use Modules\Branche\Models\Branche;
use Illuminate\Http\Request;
use PhpParser\Comment\Doc;
use Modules\Service\Http\Requests\ServiceStoreRequest;
use Modules\Service\Http\Requests\ServiceUpdateRequest;

class ServiceController extends Controller
{
    /**
     * @var UploaderService
     */
    private $uploaderService;

    public function __construct(UploaderService $uploaderService)
    {
        $this->uploaderService = $uploaderService;
    }

    private $viewsPath = 'Service.Resources.views.';

    public function index()
    {

        return view($this->viewsPath.'index');
    }


    public function create()
    {
        $branches = Branche::listsTranslations('name')->get();

        return view($this->viewsPath.'create', ['branches'  => $branches]);
    }

    public function store(ServiceStoreRequest $request) {

        $service = new Service();
        $service->fill($request->request->all());

        if ($request->hasFile('image') ) {
            $service->image = $this->uploaderService->upload($request->file("image"), "services");
        }

        $service->save();

        if ($branches = $request->get('branche')) {
            $service->branches()->attach($branches);
        }

        return redirect()->route('admin.services.index')->with(['success' => 'Updated Successfully']);
    }


    public function edit(Service $service)
    {
        $serviceBranchesIds = [];
        if (count($service->branches) > 0 ) {
            foreach($service->branches as $branch) {
                $serviceBranchesIds[] = $branch->id;
            }
        }

        $branches = Branche::join('branche_translations', function (JoinClause $join) {
            $join->on('branche_translations.branche_id', '=', 'branches.id');
        })->where('branche_translations.locale', 'ar')->pluck('branche_translations.name', 'branches.id');

        return view($this->viewsPath.'edit',['form' => $service ,'serviceBranchesIds' => $serviceBranchesIds,'branches' => $branches]);
    }


    public function update(Service $service, ServiceUpdateRequest $request) {

        $service->fill($request->request->all());

        if ($request->hasFile('image') ) {
            $service->image = $this->uploaderService->upload($request->file("image"), "services");
        }

        if ($branches = $request->get('branche')) {
            $service->branches()->sync($branches);
        }
        $service->save();

        return redirect()->route('admin.services.index')->with(['success' => 'Updated Successfully']);
    }

    public function enable(Service $service, Request $request) {
        $service->status = Statuses::ACTIVE;
        $service->save();

        return redirect()->route('admin.services.index')->with(['success' => 'Updated Successfully']);
    }

    public function disable(Service $service, Request $request) {
        $service->status = Statuses::DISABLED;
        $service->save();

        return redirect()->route('admin.services.index')->with(['success' => 'Updated Successfully']);
    }

    public function deleted(Service $service, Request $request) {

        if(file_exists(public_path().'/'.$service->image)){
            $image_path = public_path().'/'.$service->image;
                  unlink($image_path);    
        }

        $service->delete();

        return redirect()->route('admin.services.index')->with(['success' => 'Deleted Successfully']);
    }
}

