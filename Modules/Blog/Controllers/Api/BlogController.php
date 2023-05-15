<?php

namespace Modules\Blog\Controllers\Api;

use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
use Modules\Blog\Models\Blog;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request, $perPage = 10)
    {
        $users = Blog::query()
            ->select('blogs.*')
            ->when($request->get('q'), function (Builder $query) {
                $word = request()->get('q');
                $query->join('blog_translations', function (JoinClause $join) {
                    $join->on('blog_translations.blog_id', '=', 'blogs.id');
                })->where('blog_translations.locale', 'ar');

                return $query->whereRaw("(blog_translations.name like '%{$word}%') or blogs.id = '%{$word}%'");
            })
            ->orderBy('blogs.'.request()->get('sort', 'created_at'), request()->get('direction', 'DESC'))
            ->orderBy('blogs.id', request()->get('direction', 'DESC'))
            ->with('category')
            ->groupBy('blogs.id')
            ->paginate($perPage);

        return response()->json($users);
    }

    /**
     * List blogs.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {
        $articles = DB::table('blogs')
            ->join('blog_translations', 'blogs.id', '=', 'blog_translations.blog_id')
            ->where('blog_translations.locale', $request->get('lang') ?? 'ar')
            ->where('blog_translations.name', 'LIKE', '%' . $request->get('keyword') . '%')
            ->orderBy('blogs.created_at', 'DESC')
            ->where('status', Statuses::ACTIVE)
            ->paginate(12);

        return response()->json($articles);
    }
}
