<?php

namespace Modules\Service\Controllers\Web;

use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\JoinClause;
use Modules\Blog\Models\Blog;
use Modules\Service\Models\Service;
use Modules\Service\Models\ServiceTranslation;
use Modules\Specificity\Models\Specificity;
use Modules\Doctor\Models\Doctor;

class ServiceController extends Controller
{
    private $viewsPath = 'Service.Resources.views.';

    public function index()
    {
        $services = Service::with('translations')
            ->where('status', Statuses::ACTIVE)
            ->whereIn('type_of_place',[1,3])
            ->get();

        $doctors = Doctor::with('translations', 'service.translations', 'branches.translations')
            ->where('status', Statuses::ACTIVE)
            ->inRandomOrder()
            ->limit(30)
            ->get();

        $articles = Blog::with('translations', 'category')
            ->where('status', Statuses::ACTIVE)
            ->limit(6)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view($this->viewsPath . 'web.index', compact('services','doctors', 'articles'));
    }

    public function details($slug)
    {
        $service = Service::join('service_translations', function (JoinClause $join) {
            $join->on('service_translations.service_id', '=', 'services.id');
        })->where('service_translations.locale', app()->getLocale())
            ->where('service_translations.slug', $slug)
            ->where('status', Statuses::ACTIVE)
            ->with('specialities.translations')
            ->first();

        if (!$service)

        return redirect(app()->getLocale() != 'ar' ? 'services?lang=en' : 'services', 301);

        $service =  Service::with('specialities.translations')->find($service->service_id);

        $servicedoctors = Doctor::with('translations', 'service.translations', 'branches.translations')
            ->where('specialty_id', $service->id)
            ->where('status', Statuses::ACTIVE)
            ->inRandomOrder()->limit(30)
            ->get();

        $serviceSlug = ServiceTranslation::select('slug')
            ->where('locale', '!=', app()->getLocale())
            ->where('service_id', $service->id)
            ->first();

        $articles = Blog::with('translations', 'category')
            ->where('status', Statuses::ACTIVE)
            ->limit(6)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view($this->viewsPath.'web.details', compact('service','serviceSlug','servicedoctors', 'articles'));
    }

    public function subServicesdetails($slug)
    {

        $sub_service = Specificity::join('specificity_translations', function (JoinClause $join) {
                $join->on('specificity_translations.specificity_id', '=', 'specificities.id');
                })->where('specificity_translations.locale', app()->getLocale())
                ->where('specificity_translations.slug', $slug)
                ->where('status', Statuses::ACTIVE)
                ->first();

        if (!$sub_service)

        return redirect(app()->getLocale() != 'ar' ? 'services?lang=en' : 'services', 301);

        $sub_service =  Specificity::find($sub_service->specificity_id);

        $servicedoctors = Doctor::with('translations', 'service.translations', 'branches.translations')
            ->where('specialty_id', $sub_service->service->id)
            ->where('status', Statuses::ACTIVE)
            ->inRandomOrder()->limit(30)
            ->get();

        $relatedSubservices = Specificity::with('translations')
            ->where('service_id', $sub_service->service->id)
            ->where('id','!=',$sub_service->id)
            ->where('status', Statuses::ACTIVE)
            ->inRandomOrder()->limit(30)
            ->get();

        $articles = Blog::with('translations', 'category')
            ->where('status', Statuses::ACTIVE)
            ->limit(6)
            ->orderBy('created_at', 'DESC')
            ->get();

        //Doctors Form
        $DoctorsID  = $sub_service->doctors->pluck('id');
        $doctors = Doctor::with('translations')->where('status', Statuses::ACTIVE)->whereIn('id',$DoctorsID)->get();

        return view($this->viewsPath.'web.subdetails', compact('sub_service','servicedoctors', 'articles','relatedSubservices','doctors'));
    }

}
