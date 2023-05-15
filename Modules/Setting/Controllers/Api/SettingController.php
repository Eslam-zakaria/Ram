<?php

namespace Modules\Setting\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Setting\Models\Setting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $users = Setting::query()
            ->when($request->get('q'), function (Builder $query) {
                $word = request()->get('q');

                return $query->whereRaw("(settings.name like '%{$word}%' OR settings.key like '%{$word}%')");
            })
            ->orderBy(request()->get('sort', 'settings.created_at'), request()->get('direction', 'DESC'))
            ->orderBy('settings.id', request()->get('direction', 'DESC'))
            ->paginate(10);

        return response()->json($users);
    }
}
