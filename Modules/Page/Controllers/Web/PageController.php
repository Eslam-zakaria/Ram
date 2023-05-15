<?php

namespace Modules\Page\Controllers\Web;

use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Service\Models\Service;
use Modules\Branche\Models\Branche;
use Modules\Doctor\Models\Doctor;
use Modules\Page\Models\Page;
use Modules\Ticket\Models\Ticket;
use Modules\Ticket\Constants\TicketPurpose;
use Modules\Country\Models\Country;
use Session;
use Validator;
class PageController extends Controller
{
    private $viewsPath = 'Page.Resources.views.';

    public function thanks(Request $request)
    {
        $services = Service::query()->where('status', Statuses::ACTIVE)->get();
        $branches = Branche::query()->where('status', Statuses::ACTIVE)->get();

        return view($this->viewsPath.'.ram.thanks', compact('services', 'branches'));
    }

    public function bhThanks(Request $request)
    {
        $services = Service::query()->where('status', Statuses::ACTIVE)->get();
        $branches = Branche::query()->where('status', Statuses::ACTIVE)->get();

        return view($this->viewsPath.'.bh.thanks', compact('services', 'branches'));
    }

    public function about()
    {
        $doctors = Doctor::query()->with('translations', 'service.translations', 'country')
        ->where('status', Statuses::ACTIVE)
        ->inRandomOrder()
        ->limit(30)
        ->get();

        return view($this->viewsPath.'.about', compact('doctors'));
    }

    public function contact()
    {
        $services = Service::query()->with('translations')->where('status', Statuses::ACTIVE)->whereIn('type_of_place',[1,3])->get();

        $countries = Country::has('branche')->with('branche.translations')->get();

        return view($this->viewsPath.'.contact', compact('services', 'countries'));
    }

    public function store(Request $request)
    {
        $criteria = [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'content' => 'required'
        ];

        $request->validate($criteria);

        $lead = new Ticket();
        $lead->purpose = TicketPurpose::CONTACTUS;
        $lead->topic = "CONTACTUS";
        $lead->fill($request->request->all());
        $lead->save();

        return redirect('contact-us' . ( app()->getLocale() != 'ar' ? ( '/?lang=' . app()->getLocale() ) : ''))->with(['success' => 'Updated Successfully']);
    }

    public function jcia(Request $request)
    {
        return view($this->viewsPath.'.jcia');
    }
}
