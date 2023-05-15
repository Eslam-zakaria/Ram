<?php

namespace Modules\Casing\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Query\JoinClause;
use Modules\Casing\Models\CasingCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = CasingCategory::query()
            ->distinct()
            ->select('casing_categories.*')
            ->when($request->get('q'), function (Builder $query) {
                $word = request()->get('q');
                $query->join('casing_categories_translation', function (JoinClause $join) {
                    $join->on('casing_categories_translation.category_id', '=', 'casing_categories.id');
                });

                return $query->whereRaw("(casing_categories_translation.name like '%{$word}%') or casing_categories.id = '%{$word}%'");
            })
            ->orderBy(request()->get('sort', 'casing_categories.created_at'), request()->get('direction', 'DESC'))
            ->orderBy('casing_categories.id', request()->get('direction', 'DESC'))
            ->paginate(10);

        return response()->json($categories);
    }
}