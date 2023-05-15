<?php

namespace Modules\Offer\Controllers\Admin;

use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use App\Http\Services\UploaderService;
use Modules\Offer\Models\OfferBranche;
use Illuminate\Http\Request;
use PhpParser\Comment\Doc;
use Modules\Offer\Http\Requests\OfferBrancheStoreRequest;
use Modules\Offer\Http\Requests\OfferBrancheUpdateRequest;
class OfferBrancheController extends Controller
{
    /**
     * @var UploaderService
     */
    private $uploaderService;

    public function __construct(UploaderService $uploaderService)
    {
        $this->uploaderService = $uploaderService;
    }

    private $viewsPath = 'Offer.Resources.views.Branche.';

    public function index()
    {

        return view($this->viewsPath.'index');
    }


    public function create()
    {

        return view($this->viewsPath.'create');
    }

    public function store(OfferBrancheStoreRequest $request) {

        $offerBranche = new OfferBranche();
        $offerBranche->fill($request->request->all());

        if ($request->hasFile('image') ) {
            $offerBranche->image = $this->uploaderService->upload($request->file("image"), "offers");
        }

        if ($request->hasFile('cover_image') ) {
            $offerBranche->cover_image = $this->uploaderService->upload($request->file("cover_image"), "offers");
        }

        $offerBranche->save();

        return redirect()->route('admin.offer-branches.index')->with(['success' => 'Updated Successfully']);
    }


    public function edit(OfferBranche $offer_branch)
    {
        return view($this->viewsPath.'edit', ['form' => $offer_branch]);
    }


    public function update(OfferBranche $offer_branch, OfferBrancheUpdateRequest $request) {


        $offer_branch->fill($request->request->all());

        if ($request->hasFile('image') ) {
            $offer_branch->image = $this->uploaderService->upload($request->file("image"), "offers");
        }

        if ($request->hasFile('cover_image') ) {
            $offer_branch->cover_image = $this->uploaderService->upload($request->file("cover_image"), "offers");
        }

        $offer_branch->save();

        return redirect()->route('admin.offer-branches.index')->with(['success' => 'Updated Successfully']);
    }

    public function enable(OfferBranche $offerBranche, Request $request) {
        $offerBranche->status = Statuses::ACTIVE;
        $offerBranche->save();

        return redirect()->route('admin.offer-branches.index')->with(['success' => 'Updated Successfully']);
    }

    public function disable(OfferBranche $offerBranche, Request $request) {
        $offerBranche->status = Statuses::DISABLED;
        $offerBranche->save();

        return redirect()->route('admin.offer-branches.index')->with(['success' => 'Updated Successfully']);
    }
}

