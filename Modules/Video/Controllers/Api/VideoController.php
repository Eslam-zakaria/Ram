<?php

namespace Modules\Video\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Video\Models\Video;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(Request $request)
    {
            $users = Video::query()
                ->select('videos.*')
                ->when($request->get('q'), function (Builder $query) {
                    $word = request()->get('q');

                    return $query->whereRaw("(videos.name like '%{$word}%')");
                })
                ->orderBy(request()->get('sort', 'videos.created_at'), request()->get('direction', 'DESC'))
                ->orderBy('videos.id', request()->get('direction', 'DESC'))
                ->paginate(10);

        return response()->json($users);
    }
}
