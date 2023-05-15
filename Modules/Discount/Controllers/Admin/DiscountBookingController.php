<?php

namespace Modules\Discount\Controllers\Admin;

use App\Constants\BookingStatuses;
use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use App\Http\Services\UploaderService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Modules\Discount\Models\DiscountBooking;
use Modules\Branche\Models\Branche;
use Modules\Doctor\Models\Doctor;
use Illuminate\Http\Request;

class DiscountBookingController extends Controller
{
    /**
     * @var UploaderService
     */
    private $uploaderService;

    public function __construct(UploaderService $uploaderService)
    {
        $this->uploaderService = $uploaderService;
    }

    private $viewsPath = 'Discount.Resources.views.Booking.';

    public function index()
    {

        return view($this->viewsPath . 'index');
    }

    public function edit(DiscountBooking $discounts_booking)
    {
        // dd($discounts_booking->discount->name);

        $currentLocale = config('app.locale');

        $branches = Branche::join('branche_translations', function (JoinClause $join) {
            $join->on('branche_translations.branche_id', '=', 'branches.id');
        })->where('branches.status', Statuses::ACTIVE)->where('branche_translations.locale', 'ar')->pluck('branche_translations.name', 'branches.id');

        $doctors = Doctor::join('doctor_translations', function (JoinClause $join) {
            $join->on('doctor_translations.doctor_id', '=', 'doctors.id');
        })->where('doctors.status', Statuses::ACTIVE)->where('doctor_translations.locale', 'ar')->pluck('doctor_translations.name', 'doctors.id');

        return view($this->viewsPath . 'edit', ['form' => $discounts_booking ,'doctors' => $doctors,
        'branches' => $branches]);
    }

    public function update(DiscountBooking $discounts_booking, Request $request)
    {

        $discounts_booking->fill($request->request->all());

        $discounts_booking->save();

        return redirect()->route('admin.discounts-bookings.index')->with(['success' => 'Updated Successfully']);
    }

    public function exportCsv(Request $request)
    {
        // dd($request->all());
        $fileName = 'discount_bookings.csv';
        $bookings = DiscountBooking::query()
            ->select('discount_bookings.*')
            ->with('discount','branche','doctor')
            ->when($request, function (Builder $query){
                $word = request()->get('q');
                $datefrom = request()->get('date_from');
                $dateto = request()->get('date_to');
                $status = (int)(request()->get('status_filter'));

                if(!empty($word)){
                    $query->orwhere('discount_bookings.name', 'like', '%' . $word . '%')->orWhere('discount_bookings.phone',  'like', '%' . $word . '%');
                }
                if(!empty($datefrom)){
                    $query->orwhereBetween('discount_bookings.created_at', [$datefrom, $dateto]);
                }
                if($status >= 0){
                    $query->orwhere('discount_bookings.status' , $status);
                }

            })
            ->orderBy(request()->get('sort', 'discount_bookings.created_at'), request()->get('direction', 'DESC'))
            ->orderBy('discount_bookings.id', request()->get('direction', 'DESC'))
            ->get();

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('name', 'email', 'phone', 'status', 'notes', 'discount' ,'branch' ,'doctor' ,'attendance_date');

        $callback = function () use ($bookings, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($bookings as $booking) {
                $row['name'] = $booking->name;
                $row['email'] = $booking->email;
                $row['phone'] = $booking->phone;
                if($booking->sent >= 0) {
                $row['status'] = BookingStatuses::getLabel($booking->status);
                } else {
                $row['status'] = 'N/A' ;
                }
                $row['notes'] =  $booking->notes ? $booking->notes : 'N/A';
                $row['discount'] = $booking->discount->name;
                $row['branch'] = $booking->branche->name;
                $row['doctor'] = $booking->doctor->name;
                $row['attendance_date'] = $booking->attendance_date;

                fputcsv($file, array($row['name'], $row['email'], $row['phone'], $row['status'] ,$row['notes'], $row['discount'],  $row['branch'], $row['doctor'],$row['attendance_date']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

}

