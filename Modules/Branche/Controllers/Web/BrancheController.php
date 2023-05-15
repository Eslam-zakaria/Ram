<?php

namespace Modules\Branche\Controllers\Web;

use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Modules\Branche\Models\Branche;
use Modules\Doctor\Models\Doctor;
use Modules\Specificity\Models\Specificity;
use Modules\Country\Models\Country;
use Modules\Service\Models\Service;
use Modules\Video\Models\Video;

class BrancheController extends Controller
{
    private $viewsPath = 'Branche.Resources.views.';

    public function index(Request $request)
    {
        $branches = Branche::query()->select('branches.*')->where('status', Statuses::ACTIVE)
                    ->when(request(), function (Builder $query) {
                        $word = request()->get('q');
                        $lang = request()->get('lang') ? request()->get('lang') : 'ar';
                        $query->join('branche_translations', function (JoinClause $join) {
                            $join->on('branche_translations.branche_id', '=', 'branches.id');
                        })->where('branche_translations.locale', $lang);
                        if($word){
                            return $query->whereRaw("(branche_translations.name like '%{$word}%')");
                        }

            })
            ->when($request->get('services'), function (Builder $query) {
                $query->join('branche_services', 'branche_services.branche_id', '=', 'branches.id');
                return $query->where('branche_services.service_id','=', request()->get('services'));
            })
            ->when($request->get('branche'), function (Builder $query) {
                return $query->where('branches.id','=', request()->get('branche'));
            })
            ->orderBy(request()->get('sort', 'branches.created_at'), request()->get('direction', 'DESC'))
            ->orderBy('branches.id', request()->get('direction', 'DESC'))
            ->with('translations', 'country')
            ->paginate(15);

        $specialities = Specificity::where('status', Statuses::ACTIVE)->with('translations')->get();

        $brancheslist = Branche::where('status', Statuses::ACTIVE)->get();

        $countries = Country::has('branche')->with('translations', 'branche.translations')->get();

        $services = Service::has('specialities')->where('status', Statuses::ACTIVE)->with('branches', 'specialities.translations')->get();

        $servicesbar = Service::where('status', Statuses::ACTIVE)->whereIn('type_of_place',[1,3])->with('translations')->get();

        return view($this->viewsPath . 'web.index', compact('specialities', 'branches', 'brancheslist','countries','services','servicesbar','request'));
    }

}
