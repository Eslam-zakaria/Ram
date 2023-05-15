<?php

namespace Modules\Blog\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Query\JoinClause;
use Modules\Blog\Models\BlogCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = BlogCategory::query()
            ->distinct()
            ->select('blog_categories.*')
            ->when($request->get('q'), function (Builder $query) {
                $word = request()->get('q');
                $query->join('blog_categories_translation', function (JoinClause $join) {
                    $join->on('blog_categories_translation.category_id', '=', 'blog_categories.id');
                });

                return $query->whereRaw("(blog_categories_translation.name like '%{$word}%') or blog_categories.id = '%{$word}%'");
            })
            ->orderBy(request()->get('sort', 'blog_categories.created_at'), request()->get('direction', 'DESC'))
            ->orderBy('blog_categories.id', request()->get('direction', 'DESC'))
            ->paginate(10);

        return response()->json($categories);
    }
}
