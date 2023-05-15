<?php

namespace Modules\Discount\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Query\JoinClause;
use Modules\Discount\Models\Card;
use Modules\Discount\Models\DiscountCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index(Request $request)
    {
        $cards = Card::query()
            ->distinct()
            ->select('cards.*')
            ->when($request->get('q'), function (Builder $query) {
                $word = request()->get('q');
                $query->join('cards_translation', function (JoinClause $join) {
                    $join->on('cards_translation.category_id', '=', 'cards.id');
                });

                return $query->whereRaw("(cards_translation.name like '%{$word}%') or cards.id = '%{$word}%'");
            })
            ->orderBy(request()->get('sort', 'cards.created_at'), request()->get('direction', 'DESC'))
            ->orderBy('cards.id', request()->get('direction', 'DESC'))
            ->paginate(10);

        return response()->json($cards);
    }
}
