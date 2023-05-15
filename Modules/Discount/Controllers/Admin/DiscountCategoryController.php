<?php

namespace Modules\Discount\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Branche\Models\Branche;
use Modules\Discount\Models\DiscountCategory;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Modules\Discount\Http\Requests\DiscountCategoryStoreRequest;
use Modules\Discount\Http\Requests\DiscountCategoryUpdateRequest;

class DiscountCategoryController extends Controller
{
    private $viewsPath = 'Discount.Resources.views.Category.';

    public function index()
    {
        return view($this->viewsPath.'index');
    }

    public function create()
    {

        $branches = Branche::listsTranslations('name')->get();

        return view($this->viewsPath.'create', compact('branches'));
    }

    public function store(DiscountCategoryStoreRequest $request) {

        // dd($request->all());

        $category = new DiscountCategory();
        $category->fill($request->request->all());

        $category->save();

        if ($branches = $request->get('branche_id')) {
            $category->branches()->attach($branches);
        }

        // $category->branches()->attach($request->request->get('branche_id'));

        return redirect()->route('admin.discount-categories.index')->with(['success' => 'Updated Successfully']);
    }

    public function edit(DiscountCategory $discountCategory)
    {
        $discountBranchesIds = [];
        if (count($discountCategory->branches) > 0 ) {
            foreach($discountCategory->branches as $branch) {
                $discountBranchesIds[] = $branch->id;
            }
        }

        $currentLocale = config('app.locale');

        $branches = Branche::join('branche_translations', function (JoinClause $join) {
            $join->on('branche_translations.branche_id', '=', 'branches.id');
        })->where('branche_translations.locale', 'ar')->pluck('branche_translations.name', 'branches.id');

        // $branches = Branche::listsTranslations('name')->pluck('name', 'id');

        return view($this->viewsPath.'edit',['form' => $discountCategory, 'branches' => $branches , 'discountBranchesIds' => $discountBranchesIds]);
    }

    public function update(DiscountCategory $discountCategory, DiscountCategoryUpdateRequest $request) {
    
        $discountCategory->fill($request->all());
        $discountCategory->save();

        if ($branches = $request->get('branche_id')) {
            $discountCategory->branches()->sync($branches);
        }
        // $discountCategory->branches()->attach($request->request->get('branche_id'));

        return redirect()->route('admin.discount-categories.index')->with(['success' => 'Updated Successfully']);
    }
}

