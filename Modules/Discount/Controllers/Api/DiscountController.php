<?php

namespace Modules\Discount\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Query\JoinClause;
use Modules\Discount\Models\Discount;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index(Request $request)
    {
        $users = Discount::query()
            ->select('discounts.*')
            ->when($request->get('q'), function (Builder $query) {
                $word = request()->get('q');
                $query->join('discount_translations', function (JoinClause $join) {
                    $join->on('discount_translations.discount_id', '=', 'discounts.id');
                });

                return $query->whereRaw("(discount_translations.name like '%{$word}%') or discounts.id = '%{$word}%'");
            })
            ->orderBy('discounts.'.request()->get('sort', 'created_at'), request()->get('direction', 'DESC'))
            ->orderBy('discounts.id', request()->get('direction', 'DESC'))
            ->paginate(10);

        return response()->json($users);
    }
}
