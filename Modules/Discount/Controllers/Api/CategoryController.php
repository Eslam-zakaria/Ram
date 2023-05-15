<?php

namespace Modules\Discount\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Query\JoinClause;
use Modules\Discount\Models\DiscountCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = DiscountCategory::query()
            ->distinct()
            ->select('discount_categories.*')
            ->when($request->get('q'), function (Builder $query) {
                $word = request()->get('q');
                $query->join('discount_categories_translation', function (JoinClause $join) {
                    $join->on('discount_categories_translation.category_id', '=', 'discount_categories.id');
                });

                return $query->whereRaw("(discount_categories_translation.name like '%{$word}%') or discount_categories.id = '%{$word}%'");
            })
            ->orderBy(request()->get('sort', 'discount_categories.created_at'), request()->get('direction', 'DESC'))
            ->orderBy('discount_categories.id', request()->get('direction', 'DESC'))
            ->paginate(10);

        return response()->json($categories);
    }
}
