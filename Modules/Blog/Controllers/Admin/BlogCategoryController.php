<?php

namespace Modules\Blog\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Blog\Models\BlogCategory;
use Illuminate\Http\Request;
use Modules\Blog\Http\Requests\CategoryStoreRequest;
use Modules\Blog\Http\Requests\CategoryUpdateRequest;

class BlogCategoryController extends Controller
{
    private $viewsPath = 'Blog.Resources.views.Category.';

    public function index()
    {
        return view($this->viewsPath.'index');
    }

    public function create()
    {
        return view($this->viewsPath.'create');
    }

    public function store(CategoryStoreRequest $request) {

        $category = new BlogCategory();
        $category->fill($request->request->all());

        $category->save();
        return redirect()->route('admin.blog-categories.index')->with(['success' => 'Updated Successfully']);
    }

    public function edit(BlogCategory $blogCategory)
    {
        return view($this->viewsPath.'edit',['form' => $blogCategory]);
    }

    public function update(BlogCategory $blogCategory, CategoryUpdateRequest $request) {

        $blogCategory->fill($request->all());
        $blogCategory->save();

        return redirect()->route('admin.blog-categories.index')->with(['success' => 'Updated Successfully']);
    }
}

