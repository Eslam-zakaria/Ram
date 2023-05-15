<?php

namespace Modules\Booking\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Booking\Models\Booking;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
            $bookings = Booking::query()
                ->select('bookings.*')
                ->with('branche', 'doctor','speciality')
                ->when($request->get('q'), function (Builder $query) {
                    $word = request()->get('q');

                    return $query->whereRaw("(bookings.name like '%{$word}%' OR bookings.phone like '%{$word}%' )");
                })
                ->orderBy(request()->get('sort', 'bookings.created_at'), request()->get('direction', 'DESC'))
                ->orderBy('bookings.id', request()->get('direction', 'DESC'))
                ->paginate(10);

        return response()->json($bookings);
    }

    public function store(Request $request)
    {
        $criteria = [
            'name' => 'required',
            'phone' => 'required',
            'branche_id' => 'required',
            'offer_id' => 'required',
            'source' => ''
        ];

        $request->validate($criteria);

        $booking = new Booking();
        $booking->fill($request->request->all());
        $booking->save();

        return response()->json($booking);
    }
}
