<?php

namespace Modules\Partner\Controllers\Admin;

use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use App\Http\Services\UploaderService;
use Modules\Page\Models\Page;
use Modules\Partner\Models\Partner;
use Illuminate\Http\Request;
use PhpParser\Comment\Doc;
use Modules\Partner\Http\Requests\PartnerStoreRequest;
use Modules\Partner\Http\Requests\PartnerUpdateRequest;

class PartnerController extends Controller
{
    /**
     * @var UploaderService
     */
    private $uploaderService;

    public function __construct(UploaderService $uploaderService)
    {
        $this->uploaderService = $uploaderService;
    }

    private $viewsPath = 'Partner.Resources.views.';

    public function index()
    {

        return view($this->viewsPath.'index');
    }


    public function create()
    {
        return view($this->viewsPath.'create');
    }

    public function store(PartnerStoreRequest $request) {
        $partner = new Partner();
        $partner->fill($request->request->all());

        if ($request->hasFile('image') ) {
            $partner->image = $this->uploaderService->upload($request->file("image"), "partners");
        }

        $partner->save();

        return redirect()->route('admin.partners.index')->with(['success' => 'Updated Successfully']);
    }


    public function edit(Partner $partner)
    {
        return view($this->viewsPath.'edit',['form' => $partner]);
    }


    public function update(Partner $partner, PartnerUpdateRequest $request) {

        $partner->fill($request->request->all());

        if ($request->hasFile('image') ) {
            $partner->image = $this->uploaderService->upload($request->file("image"), "partners");
        }

        $partner->save();

        return redirect()->route('admin.partners.index')->with(['success' => 'Updated Successfully']);
    }

    public function enable(Partner $partner, Request $request) {
        $partner->status = Statuses::ACTIVE;
        $partner->save();

        return redirect()->route('admin.partners.index')->with(['success' => 'Updated Successfully']);
    }

    public function disable(Partner $partner, Request $request) {
        $partner->status = Statuses::DISABLED;
        $partner->save();

        return redirect()->route('admin.partners.index')->with(['success' => 'Updated Successfully']);
    }
}

