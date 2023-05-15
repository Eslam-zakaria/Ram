<?php

namespace Modules\Specificity\Controllers\Admin;

use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\JoinClause;
use Modules\Specificity\Models\Category;
use Illuminate\Http\Request;
use Modules\Specificity\Models\Specificity;
use Modules\Specificity\Http\Requests\CategoryStoreRequest;
use Modules\Specificity\Http\Requests\CategoryUpdateRequest;

class CategoryController extends Controller
{
    private $viewsPath = 'Specificity.Resources.views.Category.';

    public function index()
    {
        return view($this->viewsPath.'index');
    }

    public function create()
    {
        $currentLocale = config('app.locale');
        $specificities = Specificity::join('specificity_translations', function (JoinClause $join) {
            $join->on('specificity_translations.specificity_id', '=', 'specificities.id');
        })->where('specificity_translations.locale', 'ar')->get();

        return view($this->viewsPath.'create', compact('specificities'));
    }

    public function store(CategoryStoreRequest $request) {

        $category = new Category();
        $category->fill($request->request->all());

        $category->save();
        return redirect()->route('admin.categories.index')->with(['success' => 'Updated Successfully']);
    }

    public function edit(Category $category)
    {
        $currentLocale = config('app.locale');

        $specificities = Specificity::join('specificity_translations', function (JoinClause $join) {
            $join->on('specificity_translations.specificity_id', '=', 'specificities.id');
        })->where('specificity_translations.locale', 'ar')->get();
        return view($this->viewsPath.'edit',['form' => $category,'specificities' => $specificities]);
    }

    public function update(Category $category, CategoryUpdateRequest $request) {

        $category->fill($request->all());
        $category->save();

        return redirect()->route('admin.categories.index')->with(['success' => 'Updated Successfully']);
    }


    public function enable(Category $category, Request $request)
    {
        $category->status = Statuses::ACTIVE;
        $category->save();

        return redirect()->route('admin.categories.index')->with(['success' => 'Updated Successfully']);
    }

    public function disable(Category $category, Request $request)
    {
        $category->status = Statuses::DISABLED;
        $category->save();

        return redirect()->route('admin.categories.index')->with(['success' => 'Updated Successfully']);
    }

    public function delete(Category $category, Request $request)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with(['success' => 'Deleted Successfully']);
    }
}

