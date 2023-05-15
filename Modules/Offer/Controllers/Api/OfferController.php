<?php

namespace Modules\Offer\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Offer\Models\Offer;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index(Request $request)
    {
            $users = Offer::query()
                ->select('offers.*')
                ->when($request->get('q'), function (Builder $query) {
                    $word = request()->get('q');
                    $query->join('offer_translations', function (JoinClause $join) {
                        $join->on('offer_translations.offer_id', '=', 'offers.id');
                    })->where('offer_translations.locale', 'ar');
    
                    return $query->whereRaw("(offer_translations.name like '%{$word}%') or offers.id = '%{$word}%'");
                })
                ->orderBy('offers.'.request()->get('sort', 'created_at'), request()->get('direction', 'DESC'))
                ->orderBy('offers.id', request()->get('direction', 'DESC'))
                ->with('service','branche')
                ->groupBy('offers.id')
                ->paginate(10);

        return response()->json($users);
    }
}
