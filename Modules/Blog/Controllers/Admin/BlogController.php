<?php

namespace Modules\Blog\Controllers\Admin;

use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use App\Http\Services\UploaderService;
use Illuminate\Database\Query\JoinClause;
use Modules\Blog\Models\BlogCategory;
use Modules\Blog\Models\Blog;
use Illuminate\Http\Request;
use Modules\Blog\Http\Requests\BlogUpdateRequest;
use Modules\Blog\Http\Requests\BlogStoreRequest;

class BlogController extends Controller
{
    private $viewsPath = 'Blog.Resources.views.';

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
        $currentLocale = config('app.locale');
        $categories = BlogCategory::listsTranslations('name')->with('translations')->get();

        return view($this->viewsPath.'create', compact('categories'));
    }

    public function store(BlogStoreRequest $request) {

        $blog = new Blog();
        $blog->fill($request->request->all());

        if ($request->hasFile('image')) {
            $blog->image = $this->uploaderService->upload($request->file("image"), "blogs");
        }

        $blog->save();

        return redirect()->route('admin.blogs.index')->with(['success' => 'Updated Successfully']);
    }

    public function edit(Blog $Blog)
    {
        $Blog->load('translations');

        $currentLocale = config('app.locale');

        $categories = BlogCategory::listsTranslations('name')->with('translations')->get();

        return view($this->viewsPath . 'edit', ['form' => $Blog, 'categories' => $categories]);
    }

    public function update(Blog $blog, BlogUpdateRequest $request) {

        $blog->fill($request->all());

        if ($request->hasFile('image')) {
            $blog->image = $this->uploaderService->upload($request->file("image"), "blogs");
        }

        $blog->save();

        return redirect()->route('admin.blogs.index')->with(['success' => 'Updated Successfully']);
    }


    public function enable(Blog $Blog, Request $request)
    {
        $Blog->status = Statuses::ACTIVE;
        $Blog->save();

        return redirect()->route('admin.blogs.index')->with(['success' => 'Updated Successfully']);
    }

    public function disable(Blog $Blog, Request $request)
    {
        $Blog->status = Statuses::DISABLED;
        $Blog->save();

        return redirect()->route('admin.blogs.index')->with(['success' => 'Updated Successfully']);
    }
}

