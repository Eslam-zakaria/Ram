<?php

namespace Modules\Comment\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Modules\Comment\Models\Comment;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $users = Comment::query()
            ->select('comments.*')
            ->with('blog')
            ->when($request->get('q'), function (Builder $query) {
                $word = request()->get('q');

                return $query->whereRaw("(comments.body like '%{$word}%') or comments.id = '%{$word}%'");
            })
            ->orderBy('comments.'.request()->get('sort', 'created_at'), request()->get('direction', 'DESC'))
            ->orderBy('comments.id', request()->get('direction', 'DESC'))
            ->paginate(10);

        return response()->json($users);
    }
}
