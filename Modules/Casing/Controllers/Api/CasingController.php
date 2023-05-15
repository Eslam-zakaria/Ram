<?php

namespace Modules\Casing\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Query\JoinClause;
use Modules\Casing\Models\Casing;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CasingController extends Controller
{
    public function index(Request $request)
    {
        $users = Casing::query()
            ->select('casings.*')
            ->orderBy('casings.'.request()->get('sort', 'created_at'), request()->get('direction', 'DESC'))
            ->orderBy('casings.id', request()->get('direction', 'DESC'))
            ->paginate(10);

        return response()->json($users);
    }
}