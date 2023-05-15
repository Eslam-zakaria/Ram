<?php

namespace Modules\Offer\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Query\JoinClause;
use Modules\Offer\Models\OfferBranche;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BrancheController extends Controller
{
    public function index(Request $request)
    {
        $branches = OfferBranche::query()
            ->distinct()
            ->select('offer_branches.*')
            ->when($request->get('q'), function (Builder $query) {
                $word = request()->get('q');
                $query->join('offer_branche_translations', function (JoinClause $join) {
                    $join->on('offer_branche_translations.offer_branche_id', '=', 'offer_branches.id');
                });

                return $query->whereRaw("(offer_branche_translations.name like '%{$word}%') or offer_branches.id = '%{$word}%'");
            })
            ->orderBy(request()->get('sort', 'offer_branches.created_at'), request()->get('direction', 'DESC'))
            ->orderBy('offer_branches.id', request()->get('direction', 'DESC'))
            ->paginate(10);

        return response()->json($branches);
    }
}
