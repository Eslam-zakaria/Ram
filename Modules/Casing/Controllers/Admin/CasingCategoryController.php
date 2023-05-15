<?php

namespace Modules\Casing\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Branche\Models\Branche;
use Modules\Casing\Models\Casing;
use Modules\Casing\Models\CasingCategory;
use Illuminate\Http\Request;
use Modules\Doctor\Models\Doctor;
use Modules\Casing\Http\Requests\CasingCategoryStoreRequest;
use Modules\Casing\Http\Requests\CasingCategoryUpdateRequest;
class CasingCategoryController extends Controller
{
    private $viewsPath = 'Casing.Resources.views.Category.';

    public function index()
    {
        return view($this->viewsPath.'index');
    }

    public function create()
    {
        return view($this->viewsPath.'create');
    }

    public function store(CasingCategoryStoreRequest $request) {

        $category = new CasingCategory();
        $category->fill($request->request->all());

        $category->save();

        return redirect()->route('admin.Casing-categories.index')->with(['success' => 'Updated Successfully']);
    }

    public function edit(CasingCategory $Casing_category)
    {
        return view($this->viewsPath.'edit',['form' => $Casing_category]);
    }

    public function update(CasingCategory $Casing_category, CasingCategoryUpdateRequest $request) {

        $Casing_category->fill($request->all());
        $Casing_category->save();


        return redirect()->route('admin.Casing-categories.index')->with(['success' => 'Updated Successfully']);
    }

    public function deleted(CasingCategory $CasingCategory, Request $request) {

        $CasingCategory->delete();

        return redirect()->route('admin.Casing-categories.index')->with(['success' => 'Deleted Successfully']);
    }
}