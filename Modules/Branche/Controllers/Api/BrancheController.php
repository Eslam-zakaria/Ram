<?php

namespace Modules\Branche\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Query\JoinClause;
use Modules\Branche\Models\Branche;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Modules\Specificity\Models\Specificity;
use Modules\Country\Models\Country;
use Modules\Doctor\Models\Doctor;
use App\Constants\Statuses;
class BrancheController extends Controller
{
    public function index(Request $request)
    {
        $branches = Branche::query()
            ->distinct()
            ->select('branches.*')
            ->join('countries', 'countries.id', '=', 'branches.country_id')
            ->when($request->get('q'), function (Builder $query) {
                $word = request()->get('q');
                $query->join('branche_translations', function (JoinClause $join) {
                    $join->on('branche_translations.branche_id', '=', 'branches.id');
                });

                return $query->whereRaw("(branche_translations.name like '%{$word}%') or branches.id = '%{$word}%'");
            })
            ->orderBy(request()->get('sort', 'branches.created_at'), request()->get('direction', 'DESC'))
            ->orderBy('branches.id', request()->get('direction', 'DESC'))
            ->with('country', 'translations')
            ->paginate(10);

        return response()->json($branches);
    }


    public function listSpecialtiesbyBrnache($lang, $branche)
    {
        $branche = Branche::find($branche);
        return response()->json($branche->specificities);
    }

    public function listBrnacheByServices($lang, $service)
    {
        $countries = Country::has('branche')->get();
        $branches = Branche::where('status', Statuses::ACTIVE)
                        ->whereHas('services', function($branches) use ($service){

                            $branches->where('service_id',$service);

                        })
            ->with('translations')
            ->get();

        return response()->json(['branches' => $branches , 'countries' => $countries]);
    }

    public function listDoctorsByBranche($lang, $service,$branche, Request $request)
    {
        $doctors = Doctor::where('status', Statuses::ACTIVE)->where('specialty_id',$service)
                        ->whereHas('branches', function($doctors) use ($branche){

                            $doctors->where('branche_id',$branche);

                        })->get();

        return response()->json(['doctors' => $doctors]);
    }

}
