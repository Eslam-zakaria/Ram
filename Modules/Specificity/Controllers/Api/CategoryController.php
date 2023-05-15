<?php

namespace Modules\Specificity\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Query\JoinClause;
use Modules\Specificity\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::query()
            ->distinct()
            ->select('categories.*')
            ->join('specificities', 'specificities.id', '=', 'categories.specificity_id')
            ->when($request->get('q'), function (Builder $query) {
                $word = request()->get('q');
                $query->join('category_translations', function (JoinClause $join) {
                    $join->on('category_translations.category_id', '=', 'categories.id');
                });

                return $query->whereRaw("(category_translations.name like '%{$word}%') or categories.id = '%{$word}%'");
            })
            ->orderBy(request()->get('sort', 'categories.created_at'), request()->get('direction', 'DESC'))
            ->orderBy('categories.id', request()->get('direction', 'DESC'))
            ->with('specificity')
            ->paginate(10);

        return response()->json($categories);
    }
}
