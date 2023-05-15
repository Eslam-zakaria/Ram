<?php

namespace Modules\Discount\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Discount\Models\DiscountBooking;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
            $bookings = DiscountBooking::query()
                ->select('discount_bookings.*')
                ->with('discount')
                ->when($request->get('q'), function (Builder $query) {
                    $word = request()->get('q');

                    return $query->whereRaw("(discount_bookings.name like '%{$word}%' OR discount_bookings.phone like '%{$word}%' )");
                })
                ->orderBy(request()->get('sort', 'discount_bookings.created_at'), request()->get('direction', 'DESC'))
                ->orderBy('discount_bookings.id', request()->get('direction', 'DESC'))
                ->paginate(10);

        return response()->json($bookings);
    }
}