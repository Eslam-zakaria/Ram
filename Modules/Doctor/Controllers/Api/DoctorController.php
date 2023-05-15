<?php

namespace Modules\Doctor\Controllers\Api;

use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
use Modules\Doctor\Models\Doctor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
            $doctors = Doctor::query()
            ->select('doctors.*')
            ->join('services', 'services.id', '=', 'doctors.specialty_id')
                ->when($request->get('q'), function (Builder $query) {
                    $word = request()->get('q');

                    $query->join('doctor_translations', function (JoinClause $join) {
                        $join->on('doctor_translations.doctor_id', '=', 'doctors.id');
                    });

                    return $query->whereRaw("(doctor_translations.name like '%{$word}%') or doctors.id = '%{$word}%'");

                })
                ->orderBy(request()->get('sort', 'doctors.created_at'), request()->get('direction', 'DESC'))
                ->orderBy('doctors.id', request()->get('direction', 'DESC'))
                ->with('service')
                ->paginate(10);

        return response()->json($doctors);
    }

    public function findDoctorAvailableTimes($doctor)
    {
        $doctor = Doctor::find($doctor);

        $workingMinutes = (strtotime($doctor->end_time) - strtotime($doctor->start_time)) / 60;

        $availableAppointmentsCount = $workingMinutes/30; // appointments every 30 minute
        $availableAppointments = [date( "g:i A",strtotime($doctor->start_time))];

        for ($i = 1 ; $i<= $availableAppointmentsCount; $i++) {
            $nextAppointment= 30 * $i * 60;
            array_push($availableAppointments, date( "g:i A",strtotime($doctor->start_time)+$nextAppointment));
        }

        return response()->json($availableAppointments);
    }

    /**
     * List doctors.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {
        $doctors = DB::table('doctors')
            ->join('doctor_translations', 'doctors.id', '=', 'doctor_translations.doctor_id')
            ->where('doctor_translations.locale', $request->get('lang') ?? 'ar')
            ->where('doctor_translations.name', 'LIKE', '%' . $request->get('keyword') . '%')
            ->orderBy('doctors.created_at', 'DESC')
            ->where('status', Statuses::ACTIVE)
            ->paginate(12);

        return response()->json($doctors);
    }
}
