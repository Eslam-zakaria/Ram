<?php

namespace Modules\Discount\Controllers\Web;

use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Modules\Discount\Models\Card;
use Modules\Discount\Models\Discount;
use Modules\Discount\Models\DiscountCategory;
use Modules\Discount\Models\DiscountBooking;
use Modules\Branche\Models\Branche;
use Modules\Doctor\Models\Doctor;
use Modules\Comment\Constants\CommentStatus;
use Modules\Comment\Models\Comment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Redirect;
use Session;
use Validator;

class DiscountController extends Controller
{
    private $viewsPath = 'Discount.Resources.views.';

    public function index(Request $request)
    {
        $cards = Card::where('status', Statuses::ACTIVE);

        if ($request->has('q')) {

            $cards = Card::query()->has('discount')
                ->distinct()
                ->select('cards.*')
                ->when($request->get('q'), function (Builder $query) {
                    $word = request()->get('q');
                    $query->join('card_translations', function (JoinClause $join) {
                        $join->on('card_translations.card_id', '=', 'cards.id');
                    });

                    return $query->whereRaw("(card_translations.name like '%{$word}%') or cards.id = '%{$word}%'");
                })->where('status', Statuses::ACTIVE);
        }

        if ($request->has('category')) {

            $categoryId = DiscountCategory::where('id',request()->get('category'))->pluck('id');

            $cards = Card::query()->select('cards.*')->where('cards.status', Statuses::ACTIVE)
            ->join('discounts', function (JoinClause $join) {
                $join->on('discounts.card_id', '=', 'cards.id');
            })->where('discounts.category_id', $categoryId);

        }
        // dd($cards);

        $cards = $cards->has('discount')->paginate(6);
        $categories = DiscountCategory::get();


        return view($this->viewsPath.'web.index', compact('cards', 'categories','request'));
    }

    public function details($id)
    {
        $card = Card::where('status', Statuses::ACTIVE)->find($id);

        if (!$card)
        return redirect()->route('web.discounts.index', app()->getLocale() == 'en' ? ['lang' => 'en'] : '' ,301);

        $categories = DiscountCategory::has('discounts')->get();
        // dd($categories);

        return view($this->viewsPath.'web.details', compact('card',
        'categories'));
    }

    public function bookdiscount($id ,Request $request)
    {

        $discount      = Discount::where('status', Statuses::ACTIVE)->find($id);

        if (!$discount)
        return redirect()->route('web.discounts.index', app()->getLocale() == 'en' ? ['lang' => 'en'] : '' ,301);

        $discountcat   = DiscountCategory::where('id',$discount->category_id)->first();

        $BranchId      = $discountcat->branches->pluck('id');
        $branches      = Branche::where('status', Statuses::ACTIVE)->whereIn('id',$BranchId)->get();
        $doctors       = Doctor::where('status', Statuses::ACTIVE)->where('specialty_id',$discountcat->id)->get();

        return view($this->viewsPath.'web.book', compact('discount','discountcat','branches','doctors','request'));
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
            'discount_id' => 'required|numeric|min:1',
        ];

        $Validator = Validator::make($request->all(),$criteria);
        if ($Validator->fails()) {
            Session::flash('error',__('messages.All required data must be entered'));
            return Redirect::back()->withInput($request->all());
        } else {

            try{

                $availability =  $this->validateAvailableBooking($request);

                if (!$availability) {
                    return redirect()->route('web.discounts.book', ['locale' => Session::get('locale'),'id' => $request->discount_id ,'availability' => 1])->withInput($request->all());
                }

                $booking = new DiscountBooking();
                $booking->fill($request->request->all());
                $availableTime = $request->request->get('available_time');
                $availableTime = str_replace("-",':',$availableTime);
                $attendance_date = $request->request->get('attendance_date') .' '. \Carbon\Carbon::parse($availableTime)->format('H:i');
                $booking->attendance_date = $attendance_date;
                $booking->save();

                Session::flash('success',__('messages.Your booking has been sent successfully'));
                if(Session::get('locale') == 'en'){
                    return redirect()->route('web.discount-booking.confirm', ['lang' => Session::get('locale'), 'id' => $booking->id]);
                } else {
                    return redirect()->route('web.discount-booking.confirm', ['id' => $booking->id]);
                }
            }catch (\Exception $ex) {
                Session::flash('error',__('messages.There is an error please make sure to fill in all the required data'));
               return Redirect::back()->withInput($request->all());
            }
        }
    }

    public function validateAvailableBooking(Request $request)
    {
        $availableTime = $request->request->get('available_time');

        $availableTime = str_replace("-",':',$availableTime);

        $attendance_date = date( 'Y-m-d h:i:s',strtotime($request->request->get('attendance_date').' '.$availableTime));

        $existBooking = DiscountBooking::selectRaw('discount_bookings.*')
            ->where('branche_id' , '=', $request->request->get('branche_id'))
            ->where('doctor_id' , '=', $request->request->get('doctor_id'))
            ->where('attendance_date' , '=' , $attendance_date)
            ->first();

        return $availability = $existBooking ? 0 : 1 ;
    }

    public function confirm($id)
    {
        $LeadBooking = DiscountBooking::find($id);
        
        if($LeadBooking->discount->category->id == 1){ // dental
            $categorylist = "651" ;
        } elseif ($LeadBooking->discount->category->id == 2) { // derma
            $categorylist = "652" ;
        } elseif ($LeadBooking->discount->category->id == 3) { // medical
            $categorylist = "653" ; 
        } else {
            $categorylist = "668" ; 
        }

        $curl = curl_init();

        $service=[ '0' =>
        [
            "submissionid"=> date('Y-m-d', strtotime($LeadBooking->created_at)),
            "offer_id"=> date('H:i', strtotime($LeadBooking->created_at)),
            "nationalid"=> $LeadBooking->name . " && ". $LeadBooking->phone,
            "payed"=> "No value",
            "offer_description"=> $LeadBooking->discount->name,
            "amount"=> "No value", //waiting sherif
            "trans_id"=> "No value", //waiting sherif
            "branchtext"=> $LeadBooking->branche->name,
            "department"=> $LeadBooking->doctor->name,
            "source"=> 'Discount Page',
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


        return view($this->viewsPath . 'web.confirm', app()->getLocale() == 'en' ? ['lang' => Session::get('locale'),'booking' => $LeadBooking] : ['booking' => $LeadBooking]);
    }
}
