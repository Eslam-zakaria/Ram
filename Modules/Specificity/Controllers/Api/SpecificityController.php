<?php

namespace Modules\Specificity\Controllers\Api;

use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
use Modules\Doctor\Models\Doctor;
use Modules\Specificity\Models\Specificity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use PhpParser\Comment\Doc;

class SpecificityController extends Controller
{
    public function index(Request $request)
    {
        $users = Specificity::query()
            ->select('specificities.*')
            ->join('services', 'services.id', '=', 'specificities.service_id')
            ->when($request->get('q'), function (Builder $query) {
                $word = request()->get('q');
                $query->join('specificity_translations', function (JoinClause $join) {
                    $join->on('specificity_translations.specificity_id', '=', 'specificities.id');
                });

                return $query->whereRaw("(specificity_translations.name like '%{$word}%') or specificities.id = '%{$word}%'");
            })
            ->orderBy('specificities.'.request()->get('sort', 'created_at'), request()->get('direction', 'DESC'))
            ->orderBy('specificities.id', request()->get('direction', 'DESC'))
            ->with('service')
            ->paginate(10);

        return response()->json($users);
    }

    public function show($lang, $specificity, Request $request)
    {
        $specificity = Specificity::find($specificity);

        return response()->json($specificity);
    }

    public function listDoctorsBySpecialty($lang, $service,$branche,$specificity, Request $request)
    {
        $doctors = Doctor::where('status', Statuses::ACTIVE)->where('specialty_id',$service)
            ->when($branche, function (Builder $query, $branche) {
                $query->join('doctor_branches', 'doctor_branches.doctor_id', '=', 'doctors.id');
                return $query->where('doctor_branches.branche_id', '=', $branche);
            })
            ->when($specificity, function (Builder $query, $specificity) {
                $query->join('doctor_specificities', 'doctor_specificities.doctor_id', '=', 'doctors.id');
                return $query->where('doctor_specificities.specificity_id','=', $specificity);
            })
            ->get();

        return response()->json(['doctors' => $doctors]);
    }

    /**
     * List specificities.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {
        $specificities = DB::table('specificities')
            ->join('specificity_translations', 'specificities.id', '=', 'specificity_translations.specificity_id')
            ->where('specificity_translations.locale', $request->get('lang') ?? 'ar')
            ->where('specificity_translations.name', 'LIKE', '%' . $request->get('keyword') . '%')
            ->orderBy('specificities.created_at', 'DESC')
            ->where('status', Statuses::ACTIVE)
            ->paginate(12);

        return response()->json($specificities);
    }
}
