<?php

namespace Modules\Page\Controllers\Admin;

use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use App\Http\Services\UploaderService;
use Modules\Page\Models\Page;
use Illuminate\Http\Request;
use PhpParser\Comment\Doc;

class PageController extends Controller
{
    /**
     * @var UploaderService
     */
    private $uploaderService;

    public function __construct(UploaderService $uploaderService)
    {
        $this->uploaderService = $uploaderService;
    }

    private $viewsPath = 'Page.Resources.views.';

    public function index()
    {

        return view($this->viewsPath.'index');
    }


    public function create()
    {
        return view($this->viewsPath.'create');
    }

    public function store(Request $request) {
        $criteria = [
            'name' => '',
            'description' => '',
        ];

        $request->validate($criteria);
        $page = new Page();
        $page->fill($request->request->all());

        if ($request->hasFile('image') ) {
            $page->image = $this->uploaderService->upload($request->file("image"), "pages");
        }

        $page->save();

        return redirect()->route('admin.pages.index')->with(['success' => 'Updated Successfully']);
    }


    public function edit(Page $page)
    {
        return view($this->viewsPath.'edit',['form' => $page]);
    }


    public function update(Page $page, Request $request) {
        $criteria = [
            'name' => '',
            'description' => '',
        ];

        $request->validate($criteria);

        $page->fill($request->request->all());

        if ($request->hasFile('image') ) {
            $page->image = $this->uploaderService->upload($request->file("image"), "pages");
        }

        $page->save();

        return redirect()->route('admin.pages.index')->with(['success' => 'Updated Successfully']);
    }

    public function enable(Page $page, Request $request) {
        $page->status = Statuses::ACTIVE;
        $page->save();

        return redirect()->route('admin.pages.index')->with(['success' => 'Updated Successfully']);
    }

    public function disable(Page $page, Request $request) {
        $page->status = Statuses::DISABLED;
        $page->save();

        return redirect()->route('admin.pages.index')->with(['success' => 'Updated Successfully']);
    }
}

