<?php

namespace Modules\Lead\Controllers\Web;

use App\Constants\Statuses;
use Modules\Lead\Constants\InstallmentCompany;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Lead\Models\Lead;
use Modules\Branche\Models\Branche;
use Modules\Doctor\Models\Doctor;
use Modules\Specificity\Models\Specificity;
use Modules\Service\Models\Service;
use Modules\Country\Models\Country;
use Illuminate\Support\Facades\Redirect;
use Modules\Lead\Constants\LeadStatus;
use Carbon\Carbon;
use Session;
use Validator;
class LeadController extends Controller
{
    private $viewsPath = 'Lead.Resources.views.';

    public function index(Request $request)
    {
        $doctors = Doctor::where('status', Statuses::ACTIVE)->get();
        $specialities = Specificity::where('status', Statuses::ACTIVE)->get();
        $branches = Branche::where('status', Statuses::ACTIVE)->get();
        $services = Service::where('status', Statuses::ACTIVE)->whereIn('type_of_place',[1,3])->get();
        $countries = Country::has('branche')->get();

        if(app()->getLocale() == 'ar'){
            $company = InstallmentCompany::getListAr();
        }else{
            $company = InstallmentCompany::getList();
        }

        return view($this->viewsPath . 'web.index', compact('company','services','countries','specialities', 'doctors', 'branches','request'));
    }

    public function store(Request $request)
    {
        $criteria = [
            'name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'branche_id' => 'required|numeric|min:1',
            'doctor_id' => 'required|numeric|min:1',
            'speciality_id' => 'required|numeric|min:1',
            'company' => 'required|numeric|min:0',
        ];

        $Validator = Validator::make($request->all(),$criteria);
        if ($Validator->fails()) {
            Session::flash('error',__('messages.All required data must be entered'));
            return Redirect::back()->withInput($request->all());
        } else {

            $lead = new Lead();
            $lead->fill($request->request->all());
            $lead->save();

            Session::flash('success',__('messages.Your booking has been sent successfully'));
            return $this->sendLeads($lead);
            return redirect()->route('web.leads.thanks', app()->getLocale() == 'en' ? ['lang' => Session::get('locale')] : '');

        }
    }

    public function confirm()
    {

        return view($this->viewsPath . 'web.thanks');
    }

    public function freeservices(Request $request)
    {
        return redirect(app()->getLocale() != 'ar' ? '/?lang=en' : '/', 301);

        $doctors      = Doctor::where('status', Statuses::ACTIVE)->get();
        $specialities = Specificity::where('status', Statuses::ACTIVE)->get();
        $branches     = Branche::where('status', Statuses::ACTIVE)->get();
        $services     = Service::where('status', Statuses::ACTIVE)->whereIn('type_of_place',[1,3])->get();
        $countries    = Country::has('branche')->get();
        $YearNow      = Carbon::now()->year;
        $submonth     = Carbon::now()->subMonth();
        $monthName    = $submonth->translatedFormat('F');
        $winnerleads  = Lead::has('speciality')->where('sent', LeadStatus::Winner)->whereMonth('created_at',$submonth->month)->get();

        return view($this->viewsPath . 'web.freeservices', compact('services','countries','specialities', 'doctors', 'branches','request','YearNow','monthName','winnerleads'));
    }

    public function storefreeservices(Request $request)
    {
        $criteria = [
            'name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'branche_id' => 'required|numeric|min:1',
            'doctor_id' => 'required|numeric|min:1',
            'speciality_id' => 'required|numeric|min:1',
        ];

        $Validator = Validator::make($request->all(),$criteria);
        if ($Validator->fails()) {
            Session::flash('error',__('messages.All required data must be entered'));
            return Redirect::back()->withInput($request->all());
        } else {

            $lead = new Lead();
            $lead->fill($request->request->all());
            $lead->save();

            Session::flash('success',__('messages.Your booking has been sent successfully'));
            return $this->sendLeads($lead);
            return redirect()->route('web.leads.freethanks', app()->getLocale() == 'en' ? ['lang' => Session::get('locale')] : '');

        }
    }

    public function thanksfreeservices()
    {

        return view($this->viewsPath . 'web.freethanks');
    }

    public function rate(Request $request)
    {
        $doctors = Doctor::where('status', Statuses::ACTIVE)->get();
        $specialities = Specificity::where('status', Statuses::ACTIVE)->get();
        $branches = Branche::where('status', Statuses::ACTIVE)->get();
        $services = Service::where('status', Statuses::ACTIVE)->whereIn('type_of_place',[1,3])->get();
        $countries = Country::has('branche')->get();

        return view($this->viewsPath . 'web.rate', compact('services','countries','specialities', 'doctors', 'branches','request'));
    }

    public function storerate(Request $request)
    {
        $criteria = [
            'name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'branche_id' => 'required|numeric|min:1',
            'doctor_id' => 'required|numeric|min:1',
            'speciality_id' => 'required|numeric|min:1',
            'rate1' => 'required',
            'rate2' => 'required',
            'rate3' => 'required',
            'rate4' => 'required',
            'rate5' => 'required',
            'rate6' => 'required',
            'rate7' => 'required',
            'rate8' => 'required',
        ];

        $Validator = Validator::make($request->all(),$criteria);
        if ($Validator->fails()) {
            Session::flash('error',__('messages.All required data must be entered'));
            return Redirect::back()->withInput($request->all());
        } else {
            $rates = [
                'rate1' => $request->get('name_rate1') . "\r\n" . $request->get('rate1'),
                'rate2' => $request->get('name_rate2') . "\r\n" . $request->get('rate2'),
                'rate3' => $request->get('name_rate3') . "\r\n" . $request->get('rate3'),
                'rate4' => $request->get('name_rate4') . "\r\n" . $request->get('rate4'),
                'rate5' => $request->get('name_rate5') . "\r\n" . $request->get('rate5'),
                'rate6' => $request->get('name_rate6') . "\r\n" . $request->get('rate6'),
                'rate7' => $request->get('name_rate7') . "\r\n" . $request->get('rate7'),
                'rate8' => $request->get('name_rate8') . "\r\n" . $request->get('rate8'),
            ];


                $lead = new Lead();
                $lead->fill(array_merge(
                    ['rates' => serialize($rates)],
                    $request->request->all())
                );
                $lead->save();

                Session::flash('success',__('messages.Your review has been submitted successfully thank you'));
                return redirect()->route('web.leads.ratethanks', app()->getLocale() == 'en' ? ['lang' => Session::get('locale')] : '');

        }
    }

    public function thanksrate()
    {
        return view($this->viewsPath . 'web.ratethanks');
    }

    //==============Leads Integration================//
    public function sendLeads($LeadBooking) //Payment in branch
    {

            if($LeadBooking->speciality->service_id == 1){ // dental
                $categorylist = "651" ;
            } elseif ($LeadBooking->speciality->service_id == 2) { // derma
                $categorylist = "652" ;
            } elseif ($LeadBooking->speciality->service_id == 3) { // medical
                $categorylist = "653" ; 
            } else {
                $categorylist = "668" ; 
            }

            $sourcePage = '';
            if($LeadBooking->source == "installment"){
                $sourcePage = 'Installment Page';
            } elseif($LeadBooking->source == "free-services"){
                $sourcePage = 'Free services Page';
            }

            $curl = curl_init();

            $service=[ '0' =>
            [
                "submissionid"=> date('Y-m-d', strtotime($LeadBooking->created_at)),
                "offer_id"=> date('H:i', strtotime($LeadBooking->created_at)),
                "nationalid"=> $LeadBooking->name . " && ". $LeadBooking->phone,
                "payed"=> "No value",
                "offer_description"=> $LeadBooking->speciality->name,
                "amount"=> "No value", //waiting sherif
                "trans_id"=> "No value", //waiting sherif
                "branchtext"=> $LeadBooking->branche->name,
                "department"=> $LeadBooking->doctor->name,
                "source"=> $sourcePage,
                "promotiontext"=> 'websitebookingram',
                "branchlist" => $LeadBooking->branche->reference_id ? $LeadBooking->branche->reference_id  : '559' ,
                "servicelist" => "654" ,
                "directionlist" => "658",
                "sourcelist" => "666",
                "urlsourcelist" => "667",
                "categorylist" => $categorylist,
            ]
            ];


            $data = [
                "auth" => settings()->get('leads.integration.token'),
                "name"=> $LeadBooking->name,
                "email"=> $LeadBooking->email,
                "mobile"=> $LeadBooking->phone,
                "Service"=> json_encode($service)
            ];

            curl_setopt_array($curl, array(
                CURLOPT_URL => settings()->get('leads.integration.url'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 300,
                CURLOPT_SSL_VERIFYPEER =>0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $data,

            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            if($LeadBooking->source == "installment"){
            return redirect()->route('web.leads.thanks', app()->getLocale() == 'en' ? ['lang' => Session::get('locale')] : '');
            } elseif($LeadBooking->source == "free-services"){
            return redirect()->route('web.leads.freethanks', app()->getLocale() == 'en' ? ['lang' => Session::get('locale')] : '');
            }
    }
}
