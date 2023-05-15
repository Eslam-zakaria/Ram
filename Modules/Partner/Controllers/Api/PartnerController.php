<?php

namespace Modules\Partner\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Partner\Models\Partner;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
            $partners = Partner::query()
                ->select('partners.*')
                ->orderBy(request()->get('sort', 'partners.created_at'), request()->get('direction', 'DESC'))
                ->orderBy('partners.id', request()->get('direction', 'DESC'))
                ->paginate(10);

        return response()->json($partners);
    }
}
