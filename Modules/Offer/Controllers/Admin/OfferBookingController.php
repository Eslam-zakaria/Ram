<?php

namespace Modules\Offer\Controllers\Admin;

use App\Constants\BookingStatuses;
use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use App\Http\Services\UploaderService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Modules\Offer\Models\OfferBooking;
use Illuminate\Http\Request;

class OfferBookingController extends Controller
{
    /**
     * @var UploaderService
     */
    private $uploaderService;

    public function __construct(UploaderService $uploaderService)
    {
        $this->uploaderService = $uploaderService;
    }

    private $viewsPath = 'Offer.Resources.views.Booking.';

    public function index()
    {

        return view($this->viewsPath . 'index');
    }

    public function edit(OfferBooking $offer_booking)
    {

        return view($this->viewsPath . 'edit', ['form' => $offer_booking]);
    }

    public function update(OfferBooking $offer_booking, Request $request)
    {

        $offer_booking->fill($request->request->all());

        $offer_booking->save();

        return redirect()->route('admin.offer-bookings.index')->with(['success' => 'Updated Successfully']);
    }

    public function exportCsv(Request $request)
    {
        // dd($request->all());
        $fileName = 'offer_bookings.csv';
        $bookings = OfferBooking::query()
            ->select('offer_bookings.*')
            ->with('offer','branche')
            ->where(function ($query) use ($request) {
                $word = request()->get('q');
                $datefrom = request()->get('date_from');
                $dateto = request()->get('date_to');
                $status = (request()->get('status_filter'));
                
                if(!empty($word)){
                     $query->where('offer_bookings.name', 'like', '%' . $word . '%')->orWhere('offer_bookings.phone',  'like', '%' . $word . '%')->orWhere('offer_bookings.order_reference',  'like', '%' . $word . '%');
                }
                if(!empty($datefrom)){
                     $query->whereDate('offer_bookings.created_at','>=', $datefrom)->whereDate('offer_bookings.created_at', '<=', $dateto);
                }
                if($status >= '0'){

                     $query->where('offer_bookings.status' , $status);
                }

            })
            ->orderBy(request()->get('sort', 'offer_bookings.created_at'), request()->get('direction', 'DESC'))
            ->orderBy('offer_bookings.id', request()->get('direction', 'DESC'))
            ->get();
      
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('merchant', 'name', 'email', 'phone', 'status', 'notes', 'type_pay' ,'offer' ,'time','attendance_date','created_at');

        $callback = function () use ($bookings, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($bookings as $booking) {
                $row['merchant'] = $booking->order_reference;
                $row['name'] = $booking->name;
                $row['email'] = $booking->email;
                $row['phone'] = $booking->phone;
                if($booking->sent >= 0) {
                $row['status'] = BookingStatuses::getLabel($booking->status);
                } else {
                $row['status'] = 'N/A' ;
                }
                $row['notes'] =  $booking->notes ? $booking->notes : 'N/A';
                $row['type_pay'] = $booking->type_pay;
                $row['offer'] = $booking->offer->name;
                $row['branche'] = $booking->sub_branche_id ? $booking->branche->name : 'N/A';
                $row['time'] = $booking->available_time;
                $row['attendance_date'] = date('Y-m-d H:i A', strtotime($booking->attendance_date));
                $row['created_at'] = date('Y-m-d H:i A', strtotime($booking->created_at));

                fputcsv($file, array($row['merchant'], $row['name'], $row['email'], $row['phone'], $row['status'] ,$row['notes'], $row['type_pay'], $row['offer'], $row['time'], $row['attendance_date'], $row['created_at']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

}

