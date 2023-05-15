<?php

namespace Modules\Page\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Query\JoinClause;
use Modules\Page\Models\Page;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $pages = Page::query()
            ->when($request->get('q'), function (Builder $query) {
                $word = request()->get('q');
                $query->join('page_translations', function (JoinClause $join) {
                    $join->on('page_translations.page_id', '=', 'pages.id');
                });

                return $query->whereRaw("(page_translations.name like '%{$word}%') or pages.id = '%{$word}%'");
            })
            ->orderBy(request()->get('sort', 'pages.created_at'), request()->get('direction', 'DESC'))
            ->orderBy('pages.id', request()->get('direction', 'DESC'))
            ->paginate(10);

        return response()->json($pages);
    }
}
