<?php

namespace Modules\Booking\Controllers\Admin;

use App\Constants\BookingStatuses;
use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use App\Http\Services\UploaderService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Modules\Booking\Models\Booking;
use Illuminate\Http\Request;
use Modules\Branche\Models\Branche;
use Modules\Doctor\Models\Doctor;
use Modules\Specificity\Models\Specificity;
class BookingController extends Controller
{
    /**
     * @var UploaderService
     */
    private $uploaderService;

    public function __construct(UploaderService $uploaderService)
    {
        $this->uploaderService = $uploaderService;
    }

    private $viewsPath = 'Booking.Resources.views.';

    public function index()
    {

        return view($this->viewsPath . 'index');
    }

    public function edit(Booking $booking)
    {
        $currentLocale = config('app.locale');

        $branches = Branche::join('branche_translations', function (JoinClause $join) {
            $join->on('branche_translations.branche_id', '=', 'branches.id');
        })->where('branches.status', Statuses::ACTIVE)->where('branche_translations.locale', $currentLocale)->pluck('branche_translations.name', 'branches.id');

        $doctors = Doctor::join('doctor_translations', function (JoinClause $join) {
            $join->on('doctor_translations.doctor_id', '=', 'doctors.id');
        })->where('doctors.status', Statuses::ACTIVE)->where('doctor_translations.locale', $currentLocale)->pluck('doctor_translations.name', 'doctors.id');

        $speciality = Specificity::where('id',$booking->speciality)->first();

        return view($this->viewsPath . 'edit', [
            'form' => $booking,
            'doctors' => $doctors,
            'branches' => $branches,
            'speciality' =>$speciality
        ]);
    }

    public function update(Booking $booking, Request $request)
    {
        $criteria = [
            'name' => 'required',
            'branche_id' => 'required',
            'doctor_id' => 'required',
            'phone' => 'required',
        ];

        $request->validate($criteria);

        $booking->fill($request->request->all());

        $booking->save();

        return redirect()->route('admin.bookings.index')->with(['success' => 'Updated Successfully']);
    }

    public function exportCsv(Request $request)
    {
        // dd($request->all());
        $fileName = 'bookings.csv';
        $bookings = Booking::query()
            ->select('bookings.*')
            ->with('branche', 'doctor')
            ->where(function ($query) use ($request) {
                $word = request()->get('q');
                $datefrom = request()->get('date_from');
                $dateto = request()->get('date_to');
                $status = (request()->get('status_filter'));

                if(!empty($word)){
                   $query->where('bookings.name', 'like', '%' . $word . '%')->orWhere('bookings.phone',  'like', '%' . $word . '%');
                }
                if(!empty($datefrom)){

                   $query->whereDate('bookings.created_at','>=', $datefrom)->whereDate('bookings.created_at', '<=', $dateto);
                }
                if($status >= '0'){
                   $query->where('bookings.sent' , $status);
                }

            })
            ->orderBy(request()->get('sort', 'bookings.created_at'), request()->get('direction', 'DESC'))
            ->orderBy('bookings.id', request()->get('direction', 'DESC'))
            ->get();

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('name', 'email', 'phone', 'status', 'notes', 'branch', 'doctor', 'attendance_date' ,'created_at');

        $callback = function () use ($bookings, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($bookings as $booking) {
                $row['name'] = $booking->name;
                $row['email'] = $booking->email;
                $row['phone'] = $booking->phone;
                if($booking->sent >= 0) {
                $row['status'] = BookingStatuses::getLabel($booking->sent);
                } else {
                $row['status'] = 'N/A' ;
                }
                $row['notes'] =  $booking->notes ? $booking->notes : 'N/A';
                $row['branch'] = $booking->branche->name;
                $row['doctor'] = $booking->doctor->name;
                $row['attendance_date'] = date('Y-m-d H:i A', strtotime($booking->attendance_date));
                $row['created_at'] = date('Y-m-d H:i A', strtotime($booking->created_at));

                fputcsv($file, array($row['name'], $row['email'], $row['phone'], $row['status'] ,$row['notes'], $row['branch'], $row['doctor'], $row['attendance_date'] , $row['created_at']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

}

