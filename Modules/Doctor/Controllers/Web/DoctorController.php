<?php

namespace Modules\Doctor\Controllers\Web;

use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Modules\Branche\Models\Branche;
use Modules\Doctor\Models\Doctor;
use Modules\Doctor\Models\DoctorTranslation;
use Modules\Specificity\Models\Specificity;
use Modules\Country\Models\Country;
use Modules\Service\Models\Service;
use Modules\Video\Models\Video;
use Modules\Casing\Models\Casing;

class DoctorController extends Controller
{
    private $viewsPath = 'Doctor.Resources.views.';

    public function index(Request $request)
    {
        $doctors = Doctor::query()->select('doctors.*')->where('status', Statuses::ACTIVE)
            ->when(request(), function (Builder $query) {
                $word = request()->get('q');
                $lang = request()->get('lang') ? request()->get('lang') : 'ar';
                $query->join('doctor_translations', function (JoinClause $join) {
                    $join->on('doctor_translations.doctor_id', '=', 'doctors.id');
                })->where('doctor_translations.locale', $lang);
                if($word){
                    return $query->whereRaw("(doctor_translations.name like '%{$word}%')");
                }

            })
            ->when($request->get('services'), function (Builder $query) {
                return $query->where('doctors.specialty_id','=', request()->get('services'));
            })
            ->when($request->get('branche'), function (Builder $query) {
                $query->join('doctor_branches', 'doctor_branches.doctor_id', '=', 'doctors.id');
                return $query->where('doctor_branches.branche_id','=', request()->get('branche'));
            })
            ->when($request->get('specialty'), function (Builder $query) {
                $query->join('doctor_specificities', 'doctor_specificities.doctor_id', '=', 'doctors.id');
                return $query->where('doctor_specificities.specificity_id','=', request()->get('specialty'));
            })
            ->orderBy(request()->get('sort', 'doctors.created_at'), request()->get('direction', 'DESC'))
            ->orderBy('doctors.id', request()->get('direction', 'DESC'))
            ->with('branches.translations', 'service.translations', 'translations')
        ->paginate(15);

        $specialities = Specificity::where('status', Statuses::ACTIVE)->get();

        $branches = Branche::where('status', Statuses::ACTIVE)->with('translations')->get();

        $countries = Country::has('branche')->with('translations', 'branche.translations')->get();

        $services = Service::has('specialities')->with('translations', 'specialities.translations')->where('status', Statuses::ACTIVE)->get();

        $servicesbar = Service::where('status', Statuses::ACTIVE)->with('translations')->whereIn('type_of_place',[1,3])->get();

        return view($this->viewsPath . 'web.index', compact('specialities', 'doctors', 'branches','countries','services','servicesbar','request'));
    }

    public function details(Request $request,$slug)
    {
        $lang = $request->lang? $request->lang: 'ar';
        $doctor = Doctor::join('doctor_translations', function (JoinClause $join) {
            $join->on('doctor_translations.doctor_id', '=', 'doctors.id');
        })->where('doctor_translations.locale', $lang)->where('status', Statuses::ACTIVE)
            ->where('doctor_translations.slug', $slug)->first();

        if (!$doctor)
        return redirect()->route('web.doctors.index', app()->getLocale() == 'en' ? ['lang' => 'en'] : '' ,301);

        $doctor =  Doctor::find($doctor->doctor_id);
        $videos = Video::has('doctor')->where('doctor_id', $doctor->id)->where('status', Statuses::ACTIVE)->paginate(6);
        $casing = Casing::where('doctor_id', $doctor->id)->where('status', Statuses::ACTIVE)->paginate(8);

        $servicedoctors = Doctor::with('translations')->where('specialty_id', $doctor->specialty_id)->where('status', Statuses::ACTIVE)->inRandomOrder()->limit(30)->get();
        //get Auther Slug
        $doctorSlug = DoctorTranslation::select('slug')->where('locale','!=',$lang)->where('doctor_id',$doctor->id)->first();
        return view($this->viewsPath.'web.details', compact('doctor','videos','servicedoctors','doctorSlug','casing','request'));
    }
}
