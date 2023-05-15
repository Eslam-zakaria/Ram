<?php

namespace Modules\Booking\Controllers\Web;

use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Database\Eloquent\Builder;
use Modules\Booking\Models\Booking;
use Modules\Branche\Models\Branche;
use Modules\Doctor\Models\Doctor;
use Modules\Specificity\Models\Specificity;
use Modules\Service\Models\Service;
use Modules\Country\Models\Country;
use Illuminate\Support\Facades\Redirect;
use Session;
use Validator;
class BookingController extends Controller
{
    private $viewsPath = 'Booking.Resources.views.';

    public function index()
    {
        $request = request();

        $doctors = Doctor::with('translations')->where('status', Statuses::ACTIVE)->get();
        $specialities = Specificity::with('translations')->where('status', Statuses::ACTIVE)->get();
        $branches = Branche::with('translations')->where('status', Statuses::ACTIVE)->get();
        $services = Service::with('translations')->where('status', Statuses::ACTIVE)->whereIn('type_of_place',[1,3])->get();
        $countries = Country::has('branche')->with('translations')->get();

        $serviceId = request()->get('service') ? request()->get('service') : 1 ;

        // dd(request()->speciality);

        if ($serviceId) {
            $servicesFirst = Service::find($serviceId);
            $branche = request()->get('branche') ? request()->get('branche') :'';
            if($branche){
                request()->request->set('branche', request()->get('branche'));
            }
            $branches = Branche::with('translations')->where('status', Statuses::ACTIVE)
            ->when($serviceId, function (Builder $query, $serviceId) {
                $query->join('branche_services', 'branche_services.branche_id', '=', 'branches.id');
                return $query->where('branche_services.service_id','=', $serviceId);
            })
            ->get();

            $specialities = Specificity::with('translations')->where('status', Statuses::ACTIVE)->where('service_id',$serviceId)->get();
            // dd($specialities);

            $doctorId = request()->get('doctor') ? request()->get('doctor') :'';
            $specificity = request()->get('speciality') ? request()->get('speciality') :'';

            if($specificity){
                $GetspecificityId = Specificity::find($specificity);
                //Doctors
                $DoctorsID  = $GetspecificityId->doctors->pluck('id');
                $doctors = Doctor::with('translations')->where('status', Statuses::ACTIVE)->whereIn('id',$DoctorsID)->get();
            }

            $GetdoctorId = '';
            if($doctorId) {
                $GetdoctorId = Doctor::find($doctorId);
                //Branches
                $branchesID = $GetdoctorId->branches->pluck('id');
                if ($GetdoctorId->branches->first()){
                    request()->request->set('branche', $GetdoctorId->branches->first()->id);
                }
                $branches = Branche::with('translations')->where('status', Statuses::ACTIVE)->whereIn('id',$branchesID)->get();
                //Specialities
                if($specificity){
                    $specialitID  = $GetdoctorId->specificities->pluck('id');
                    $specialities = Specificity::with('translations')->where('status', Statuses::ACTIVE)->whereIn('id',$specialitID)->get();
                    request()->request->set('speciality', request()->get('speciality'));
                }else{
                    $specialitID  = $GetdoctorId->specificities->pluck('id');
                    $specialities = Specificity::with('translations')->where('status', Statuses::ACTIVE)->whereIn('id',$specialitID)->get();
                }
            }
        }
        return view($this->viewsPath . 'web.index', compact('services','serviceId','servicesFirst','countries','specialities', 'doctors','GetdoctorId', 'branches','request'));
    }

    public function store(Request $request)
    {
        $criteria = [
            'name' => 'required',
            'phone' => 'required|numeric|min:10',
            'email' => 'required|email',
            'attendance_date' => 'required',
            'available_time' => 'required',
            'branche_id' => 'required|numeric|min:1',
            'doctor_id' => 'required|numeric|min:1',
            'speciality' => 'required|numeric|min:1',
        ];

        $Validator = Validator::make($request->all(),$criteria);
        if ($Validator->fails()) {
            Session::flash('error',__('messages.All required data must be entered'));
            return Redirect::back()->withInput($request->all());
        } else {

            try{

                // $availability =  $this->validateAvailableBooking($request);

                // if (!$availability) {

                //     return Redirect::to('book-an-appointment'. '/?availability='. 1 . ( app()->getLocale() != 'ar' ? ( '&lang=' . app()->getLocale()) : ''))->withInput($request->all());;
                // }

                $booking = new Booking();
                $booking->fill($request->request->all());
                $booking->speciality_id = $request->request->get('speciality');
                 //comment this and add new column => available_time
                    // $availableTime = $request->request->get('available_time');
                    // $availableTime = str_replace("-",':',$availableTime);
                    // $attendance_date = $request->request->get('attendance_date') .' '. \Carbon\Carbon::parse($availableTime)->format('H:i');
                    // $booking->attendance_date = $attendance_date;
                $booking->attendance_date = $request->request->get('attendance_date');
                $booking->available_time = $request->request->get('available_time');
                $booking->save();

                Session::flash('success',__('messages.Your booking has been sent successfully'));
                if(Session::get('locale') == 'en'){
                   return redirect()->route('web.bookings.confirm', ['id' => $booking->id ,'lang' => Session::get('locale')]);
                } else {
                    return redirect()->route('web.bookings.confirm', ['id' => $booking->id]);
                }
            }catch (\Exception $ex) {
                Session::flash('error',__('messages.There is an error please make sure to fill in all the required data'));
               return Redirect::back()->withInput($request->all());
            }
        }
    }

    public function confirm($id)
    {
        $booking = Booking::find($id);

        $servicesId   = $booking->speciality->service_id;
        $categorylist = $servicesId == 1 ? '651' : ($servicesId == 2 ? '652' : ($servicesId == 3 ? '653' : '668')); // dental or derma or medical

        $Countbooking = Booking::where('name',$booking->name)
                                ->where('phone',$booking->phone)
                                ->where('email',$booking->email)
                                ->where('speciality_id',$booking->speciality_id)
                                ->where('doctor_id',$booking->doctor_id)
                                ->where('attendance_date',$booking->attendance_date)
                                ->where('available_time',$booking->available_time)
                                ->count();

        if($Countbooking <= 1) {

            $curl = curl_init();

            $service=[ '0' =>
            [

                "submissionid"=> $booking->available_time,
                "offer_id"=> \Carbon\Carbon::parse($booking->attendance_date)->format('Y-m-d'),
                "nationalid"=> $booking->name . " && ". $booking->phone,
                "payed"=> "No value",
                "offer_description"=> $booking->speciality->name,
                "amount"=> "No value",
                "trans_id"=> "No value",
                "branchtext"=> $booking->source_ads ?? 'No value',
                "department"=> $booking->doctor->name,
                "source"=> 'Booking Page',
                "promotiontext"=> 'websitebookingram',
                "branchlist" => $booking->branche->reference_id ? $booking->branche->reference_id  : '559' ,
                "servicelist" => "654" ,
                "directionlist" => "658",
                "sourcelist" => "666",
                "urlsourcelist" => "667",
                "categorylist" => $categorylist,
            ]
            ];


            $data = [
                "auth" => settings()->get('leads.integration.token'),
                "name"=> $booking->name,
                "email"=> $booking->email,
                "mobile"=> $booking->phone,
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
        }

        return view($this->viewsPath . 'web.confirm', ['booking' => $booking]);
    }

    public function validateAvailableBooking(Request $request)
    {
        $availableTime = $request->request->get('available_time');

        $availableTime = str_replace("-",':',$availableTime);

        $attendance_date = $request->request->get('attendance_date') .' '. \Carbon\Carbon::parse($availableTime)->format('H:i');

        $existBooking = Booking::selectRaw('bookings.*')
            ->where('branche_id' , '=', $request->request->get('branche_id'))
            ->where('doctor_id' , '=', $request->request->get('doctor_id'))
            ->where('attendance_date' , '=' , $attendance_date)
            ->first();

        return $availability = $existBooking ? 0 : 1 ;
    }
    public function validateKsaPhone(Request $request)
    {
        $phone = $request->request->get('phone');

        return preg_match('/^(009665|9665|\+9665|05|5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/', $phone); // return true

    }
}
