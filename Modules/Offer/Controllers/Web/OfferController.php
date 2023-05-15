<?php

namespace Modules\Offer\Controllers\Web;

use App\Constants\Statuses;
use App\Constants\BookingStatuses;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Modules\Branche\Models\Branche;
use Modules\Offer\Models\Offer;
use Modules\Offer\Models\OfferBranche;
use Modules\Offer\Models\OfferBooking;
use Modules\Offer\Models\OfferBrancheTranslation;
use Modules\Service\Models\Service;
use Modules\Offer\Controllers\Web\payFort;
use Modules\Offer\Controllers\Web\rightNow;
use Modules\Offer\Controllers\Web\tamara;
use Modules\Offer\Controllers\Web\tabby;
use Illuminate\Support\Facades\Redirect;
use Session;
use Validator;
class OfferController extends Controller
{
    private $viewsPath = 'Offer.Resources.views.';

    public function index(Request $request)
    {

        $offerbranches = OfferBranche::where('status', Statuses::ACTIVE)->get();

        return view($this->viewsPath . 'web.index', compact('offerbranches'));
    }

    public function lists($slug ,Request $request)
    {
        $lang = $request->lang? $request->lang: 'ar';
        $offers = OfferBranche::join('offer_branche_translations', function (JoinClause $join) {
            $join->on('offer_branche_translations.offer_branche_id', '=', 'offer_branches.id');
        })->where('offer_branche_translations.locale', $lang)->where('status', Statuses::ACTIVE)
            ->where('offer_branche_translations.slug', $slug)->first();

        if (!$offers)
            // abort(404, 'Not Found');
            return redirect()->route('web.offers.index', app()->getLocale() == 'en' ? ['lang' => 'en'] : '' ,301);

        $offers =  OfferBranche::find($offers->offer_branche_id);


        $servicesbar = Service::where('status', Statuses::ACTIVE)->whereIn('type_of_place',[2,3])->get();

        //get Auther Slug
        $offerSlug = OfferBrancheTranslation::select('slug')->where('locale','!=',$lang)->where('offer_branche_id',$offers->id)->first();

        //Get Offers

        $Alloffers = Offer::query()->select('offers.*')->where('status', Statuses::ACTIVE)
            ->where('branche_id', $offers->id)
            ->when($request->get('services'), function (Builder $query) {
                return $query->where('offers.service_id','=', request()->get('services'));
            })
            ->orderBy(request()->get('sort', 'offers.created_at'), request()->get('direction', 'DESC'))
            ->orderBy('offers.id', request()->get('direction', 'DESC'))
            ->get();

        return view($this->viewsPath.'web.lists', compact('offers','offerSlug','request','servicesbar','Alloffers'));
    }

    public function bookoffer($id ,Request $request)
    {
        $offer       = Offer::where('status', Statuses::ACTIVE)->find($id);
        if(!$offer){

            return redirect()->back()->with(['error' => __('messages.This offer is not available')], 301);
        }
        $allOffer    = Offer::where('status', Statuses::ACTIVE)->get();
        $allBranches = OfferBranche::where('status', Statuses::ACTIVE)->get();
        $branches    = Branche::where('status', Statuses::ACTIVE)->whereIn('id',$offer->service->branches->pluck('id'))->get();
        $ApiKey      = 'pk_cc15e787-5b8b-4a76-a4e6-8f2f280a8a08';

        return view($this->viewsPath.'web.book', compact('offer','allOffer','allBranches','branches','ApiKey'));
    }

    public function store(Request $request)
    {
        $criteria = [
            'name' => 'required',
            'phone' => 'required|numeric|min:10',
            'email' => 'required|email',
            'attendance_date' => 'required',
            'available_time' => 'required',
            'offer_id' => 'required|numeric|min:1',
            'branche_id' => 'required|numeric|min:1',
            'sub_branche_id' => 'required|numeric|min:1',
            'type_pay' => 'required',
            'check_terms' => 'required',
        ];

        $Validator = Validator::make($request->all(),$criteria);
        if ($Validator->fails()) {
            Session::flash('error',__('messages.All required data must be entered'));
            return Redirect::back()->withInput($request->all());
        } else {

            try{

                $offerBooking = new OfferBooking();
                $offerBooking->fill($request->request->all());
                $attendance_date = date('Y-m-d',strtotime($request->request->get('attendance_date')));
                $offerBooking->attendance_date = $attendance_date;
                $offerBooking->order_reference = $this->generateUniqueCode();
                $offerBooking->type_pay = $request->request->get('type_pay');
                $offerBooking->type_installment = $request->request->get('installment_pay') ? $request->request->get('installment_pay') : $request->request->get('type_pay');
                $offerBooking->save();


                if($offerBooking->type_pay == "Pay online"){

                   return redirect()->route('web.bookings.payment', app()->getLocale() == 'en' ? ['referal_code' => $offerBooking->order_reference,'lang' => Session::get('locale') ] : ['referal_code' => $offerBooking->order_reference]);

                } elseif($offerBooking->type_pay == "Pay with installment") {

                    if($offerBooking->type_installment == "Tamara"){

                        if(Session::get('locale') == 'en'){
                            $FailedUrl = url('/').'/page/offer-installment'.'/'.'?lang='.Session::get('locale').'';
                            $returnUrl = url('/').'/page/offer/installment-thanks'.'/'.'?lang='.Session::get('locale').'';
                        } else {
                            $FailedUrl = url('/').'/page/offer-installment';
                            $returnUrl = url('/').'/page/offer/installment-thanks';
                        }
                        $reference     = $offerBooking->order_reference;
                        $amount        = (float)$offerBooking->offer->price;
                        $Productname   = $offerBooking->offer->name;
                        $Branchename   = $offerBooking->branche->name;
                        $UserName      = $offerBooking->name;
                        $UserPhone     = $offerBooking->phone;
                        $UserEmail     = $offerBooking->email;
                        $Branche       = $offerBooking->offer->branche->name;
                        return $this->CheckOutTamara($reference,$amount,$Productname,$UserName,$UserPhone,$UserEmail,$Branche,$returnUrl,$FailedUrl,$Branchename);

                    } else {

                        if(Session::get('locale') == 'en'){
                            $FailedUrl = url('/').'/page/offer-installment'.'/'.'?lang='.Session::get('locale').'';
                            $returnUrl = url('/').'/page/offer/installment-thanks'.'/'.'?lang='.Session::get('locale').'';
                        } else {
                            $FailedUrl = url('/').'/page/offer-installment';
                            $returnUrl = url('/').'/page/offer/installment-thanks';
                        }
                        $reference     = $offerBooking->order_reference;
                        $amount        = (float)$offerBooking->offer->price;
                        $Productname   = $offerBooking->offer->name;
                        $UserName      = $offerBooking->name;
                        $UserPhone     = $offerBooking->phone;
                        $UserEmail     = $offerBooking->email;
                        $Branche       = $offerBooking->offer->branche->name;
                        $SubBranche    = $offerBooking->branche->name;
                        return $this->CheckOutTabby($reference,$amount,$Productname,$UserName,$UserPhone,$UserEmail,$Branche,$SubBranche,$returnUrl,$FailedUrl);

                    }

                } else {
                    Session::flash('success',__('messages.Your booking has been sent successfully'));
                    return $this->sendLeads($offerBooking);
                    return redirect()->route('web.offers.thanks', app()->getLocale() == 'en' ? ['lang' => Session::get('locale')] : '');
                }
            }catch (\Exception $ex) {
                Session::flash('error',__('messages.There is an error please make sure to fill in all the required data'));
               return Redirect::back()->withInput($request->all());
            }
        }

    }

    /**

     * Write referal_code on Method

     *

     * @return response()

     */

    public function generateUniqueCode()

    {
        do {

            $referal_code = random_int(100000, 999999);

        } while (OfferBooking::where("order_reference", "=", $referal_code)->first());

        return $referal_code;

    }


    public function payment($referal_code)
    {
        // get book details
        $booking = OfferBooking::where('order_reference', "=", $referal_code)->first();

        // check locale lang EN or AR
        if(Session::get('locale') == 'en'){
            $returnUrl = url('/').'/page/offer-thanks'.'/'.'?lang='.Session::get('locale').'';
        } else {
            $returnUrl = url('/').'/page/offer-thanks';
        }

        // check found discount on offer
        if($booking->offer->discount > 0){

           $price =  $booking->offer->price_after_discount;
        } else {
           $price =  $booking->offer->price;
        }

        // remove any space in offer name
        $replace = ['(' , ')' ,'+'];
        $OfferName = str_replace($replace, ' ', $booking->offer->name);

        // call payment class
        $payment          = new payFort();
        $requestParams    = $payment->paymentrequestParams($booking,$price,$OfferName,$returnUrl);

        // redirect payfort url
        $redirectUrl      = 'https://checkout.payfort.com/FortAPI/paymentPage';

        return view('web.home.payment', ['redirectUrl' => $redirectUrl ,'requestParams' => $requestParams]);
    }



    public function thanks(Request $request)
    {
        if($request->merchant_reference) {

              $booking = OfferBooking::where('order_reference', "=", $request->merchant_reference)->first();

            if($request->response_message == "Success" || $request->response_message == "عملية ناجحة" || $request->status == "14"){

                $booking->status = BookingStatuses::CONFIRMED;
                $booking->notes  = $request->response_message ? $request->response_message : 'عملية ناجحة';
                $booking->save();

            } else {

                $booking->status = BookingStatuses::NOT_CONFIRMED;
                $booking->notes  = $request->response_message ? $request->response_message : 'عملية فاشلة';
                $booking->save();
            }

            // call rightNow Api class
            $rightNow       = new rightNow();
            $sendLeads      = $rightNow->callRightNowOnlinePay($booking);

        }

        return view($this->viewsPath . 'web.thanks');
    }

    //==============Installment Tamara================//

    public function CheckOutTamara($reference,$amount,$Productname,$UserName,$UserPhone,$UserEmail,$Branche,$redirectUrl,$FailedUrl,$Branchename)
    {

        // call tamara class
        $callTamara       = new tamara();
        $datacheckOut     = $callTamara->callTamara($reference,$amount,$Productname,$UserName,$UserPhone,$UserEmail,$Branche,$redirectUrl,$FailedUrl,$Branchename);
        $urlcheckOut      = $datacheckOut['checkout_url'];

        // update order_reference in Table offer_booking
        $OrderUpdated     = OfferBooking::where('order_reference', "=", $reference)->first();

        if($OrderUpdated){

            $OrderUpdated->order_reference = $datacheckOut['order_id'];
            $OrderUpdated->save();
        }

        return Redirect::to($urlcheckOut);

    }

    //==============Installment Tabby================//

    public function CheckOutTabby($reference,$amount,$Productname,$UserName,$UserPhone,$UserEmail,$Branche,$SubBranche,$returnUrl,$FailedUrl){

        // call tabby class
        $callTabby        = new tabby();
        $datacheckOut     = $callTabby->callTabby($reference,$amount,$Productname,$UserName,$UserPhone,$UserEmail,$Branche,$SubBranche,$returnUrl,$FailedUrl);
        $OrderId          = $datacheckOut['payment']['id'];

        if($datacheckOut['status'] == 'created'){

               $OrderUpdated = OfferBooking::where('order_reference', "=", $reference)->first();
            if($OrderUpdated){

                $OrderUpdated->order_reference = $OrderId;
                $OrderUpdated->save();
            }

            $urlcheckOut = $datacheckOut['configuration']['available_products']['installments'][0]['web_url'];

            return Redirect::to($urlcheckOut);

        } else {

               $OrderUpdated = OfferBooking::where('order_reference', "=", $reference)->first();
            if($OrderUpdated){

                $OrderUpdated->order_reference = $OrderId;
                $OrderUpdated->save();
            }

            $dataOffer = OfferBooking::orderBy('id','desc')->where('order_reference', "=", $OrderId)->first();
            $dataOffer->status = BookingStatuses::NOT_CONFIRMED;
            $dataOffer->notes  = ' فشل فى عملية التقسيط ';
            $dataOffer->save();

            return redirect()->route('web.offers.installment', ['payment_id' => $OrderId]);
        }

    }

    //============CallRetrievePaymentTabby============
    public function CallRetrievePaymentTabby($PaymentID)
    {
        // call tabby class
        $callTabby   = new tabby();
        $Amount      = $callTabby->callRetrieveTabby($PaymentID);

        return $this->CallCapturePaymentTabby($PaymentID,$Amount);

    }
    //============CallCapturePaymentTabby============
    public function CallCapturePaymentTabby($PaymentID,$Amount)
    {
        // call tabby class
        $callTabby     = new tabby();
        $responseData  = $callTabby->callCaptureTabby($PaymentID,$Amount);

        return view($this->viewsPath . 'web.thanksinstallment');

    }
    //=============ReturnInstallment==============//
    public function offerInstallment(Request $request)
    {
        if($request->orderId){ //Tamara

            $dataOffer = OfferBooking::orderBy('id','desc')->where('order_reference', "=", $request->orderId)->first();
            $dataOffer->status = BookingStatuses::NOT_CONFIRMED;
            $dataOffer->notes = ' فشل فى عملية التقسيط '.'-'.$request->paymentStatus;
            $dataOffer->save();

            $InstallmentType = 'Tamara';
        } else { //Tabby

            $dataOffer = OfferBooking::orderBy('id','desc')->where('order_reference', "=", $request->payment_id)->first();
            $dataOffer->status = BookingStatuses::NOT_CONFIRMED;
            $dataOffer->notes = ' فشل فى عملية التقسيط ';
            $dataOffer->save();

            $InstallmentType = 'Tabby';
        }

        // call rightNow Api class
        $rightNow       = new rightNow();
        $sendLeads      = $rightNow->callRightNowInstallmentPay($dataOffer,$InstallmentType);

        return view($this->viewsPath . 'web.installment');
    }

    public function thanksInstallment(Request $request)
    {

        if($request->payment_id){ //Tabby

            $dataOffer = OfferBooking::where('order_reference',$request->payment_id)->first();

            $dataOffer->status = BookingStatuses::CONFIRMED;
            $dataOffer->notes  = 'عملية ناجحة';
            $dataOffer->save();

            $InstallmentType = 'Tabby';

            // call rightNow Api class
            $rightNow       = new rightNow();
            $sendLeads      = $rightNow->callRightNowInstallmentPay($dataOffer,$InstallmentType);

            return $this->CallRetrievePaymentTabby($request->payment_id);
        } else { //Tamara

            $dataOffer = OfferBooking::where('order_reference',$request->orderId)->first();

            $dataOffer->status = BookingStatuses::CONFIRMED;
            $dataOffer->notes  = 'عملية ناجحة';
            $dataOffer->save();

            $InstallmentType = 'Tamara';

            // call rightNow Api class
            $rightNow       = new rightNow();
            $sendLeads      = $rightNow->callRightNowInstallmentPay($dataOffer,$InstallmentType);

            return $this->ChangeStatusOrderTamara($request->orderId);
        }
    }

    //============ChangeStatusOrderTamara============
    public function ChangeStatusOrderTamara($orderId){

        // call tamara class & call function statusOrderTamara
        $callTamara       = new tamara();
        $changeStatus     = $callTamara->statusOrderTamara($orderId);

        return view($this->viewsPath . 'web.thanksinstallment');
    }

    //==============Leads Integration================//
    public function sendLeads($LeadBooking) //Payment in branch
    {
        // call rightNow Api class
        $rightNow       = new rightNow();
        $sendLeads      = $rightNow->callRightNowPayInBranch($LeadBooking);

        return redirect()->route('web.offers.thanks', app()->getLocale() == 'en' ? ['lang' => Session::get('locale')] : '');
    }

    //===================TermsAndCondition==================

    public function terms()
    {
        return view($this->viewsPath.'web.terms');
    }

}
