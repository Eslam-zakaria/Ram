<?php

namespace Modules\Offer\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Offer\Models\OfferBooking;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
            $bookings = OfferBooking::query()
                ->select('offer_bookings.*')
                ->with('offer','branche')
                ->when($request->get('q'), function (Builder $query) {
                    $word = request()->get('q');

                    return $query->whereRaw("(offer_bookings.name like '%{$word}%' OR offer_bookings.phone like '%{$word}%' OR offer_bookings.order_reference like '%{$word}%' )");
                })
                ->orderBy(request()->get('sort', 'offer_bookings.created_at'), request()->get('direction', 'DESC'))
                ->orderBy('offer_bookings.id', request()->get('direction', 'DESC'))
                ->paginate(10);

        return response()->json($bookings);
    }
}