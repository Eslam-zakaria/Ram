<?php

namespace Modules\Offer\Controllers\Web;
use App\Http\Controllers\Controller;
use Modules\Offer\Models\OfferBooking;

class rightNow extends Controller
{

     /**
     * call RightNow Api.
     * 
     * @param array from data $booking
     *
     * @return Array
     */

    public function callRightNowOnlinePay($booking)
    {

        //Check Status
        $statusBooking = $booking->status == 0 ? 'Pending' : ($booking->status == 1 ? 'Confirmed' : 'Not Confirmed');
  
        $Countbooking = OfferBooking::where('name',$booking->name)
                                     ->where('phone',$booking->phone)
                                     ->where('email',$booking->email)
                                     ->where('offer_id',$booking->offer_id)
                                     ->where('type_pay',$booking->type_pay)
                                     ->where('attendance_date',$booking->attendance_date)
                                     ->where('order_reference',$booking->order_reference)
                                     ->count();

        if($Countbooking <= 1) { 
            // Pay online with payfort 
            $curl = curl_init();

            $service=[ '0' =>
            [
                "submissionid"=> date('Y-m-d H:i', strtotime($booking->created_at)),
                "offer_id"=> $booking->attendance_date . " && ". $booking->available_time,
                "nationalid"=> $booking->name . " && ". $booking->phone,
                "payed"=> 'online payment',
                "offer_description"=> $booking->offer->name,
                "amount"=> $booking->offer->price,
                "trans_id"=> $booking->order_reference,
                "branchtext"=> $booking->source_ads ?? 'No value',
                "department"=> $statusBooking,
                "source"=> 'onlinepay',//waiting sherif
                "promotiontext"=> $booking->type_pay,
                "branchlist" => $booking->branche->reference_id ? $booking->branche->reference_id  : '559' ,
                "servicelist" => "654" ,
                "directionlist" => "659",
                "sourcelist" => $booking->sourcelist ? $booking->sourcelist : '666',
                "urlsourcelist" => $booking->urlsourcelist ? $booking->urlsourcelist : '667',
                "categorylist" => "668",
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

            $response     = curl_exec($curl);
            $responseData = json_decode($response,true);
            $err          = curl_error($curl);
        }

    }

    /**
     * call RightNow Api.
     * 
     * @param array from data $dataOffer
     * @param string $InstallmentType
     *
     * @return Array
     */

    public function callRightNowInstallmentPay($dataOffer,$InstallmentType)
    {

        $curl = curl_init();

            $service=[ '0' =>
            [
                "submissionid"=> date('Y-m-d H:i', strtotime($dataOffer->created_at)),
                "offer_id"=> $dataOffer->attendance_date . " && ". $dataOffer->available_time,
                "nationalid"=> $dataOffer->name . " && ". $dataOffer->phone,
                "payed"=> $InstallmentType,
                "offer_description"=> $dataOffer->offer->name,
                "amount"=> $dataOffer->offer->price,
                "trans_id"=> $dataOffer->order_reference,
                "branchtext"=> $dataOffer->source_ads ?? 'No value',
                "department"=> $dataOffer->statusLabel,
                "source"=> 'onlinepay',
                "promotiontext"=> $dataOffer->type_pay,
                "branchlist" => $dataOffer->branche->reference_id ? $dataOffer->branche->reference_id  : '559' ,
                "servicelist" => "654" ,
                "directionlist" => "659",
                "sourcelist" => $dataOffer->sourcelist ? $dataOffer->sourcelist : '666',
                "urlsourcelist" => $dataOffer->urlsourcelist ? $dataOffer->urlsourcelist : '667',
                "categorylist" => "668",
            ]
            ];


            $data = [
                "auth" => settings()->get('leads.integration.token'),
                "name"=> $dataOffer->name,
                "email"=> $dataOffer->email,
                "mobile"=> $dataOffer->phone,
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
            $response = json_decode($response,true);
            $err      = curl_error($curl);
    }

     /**
     * call RightNow Api.
     * 
     * @param array from data $LeadBooking
     *
     * @return Array
     */

    public function callRightNowPayInBranch($LeadBooking)
    {
        $Countbooking = OfferBooking::where('name',$LeadBooking->name)
                        ->where('phone',$LeadBooking->phone)
                        ->where('email',$LeadBooking->email)
                        ->where('offer_id',$LeadBooking->offer_id)
                        ->where('type_pay',$LeadBooking->type_pay)
                        ->where('attendance_date',$LeadBooking->attendance_date)
                        ->count();

        if($Countbooking <= 1) {   

            $curl = curl_init();

            $service=[ '0' =>
            [
            "submissionid"=> date('Y-m-d H:i', strtotime($LeadBooking->created_at)),
            "offer_id"=> $LeadBooking->attendance_date . " && ". $LeadBooking->available_time,
            "nationalid"=> $LeadBooking->name . " && ". $LeadBooking->phone,
            "payed"=> 'Payment in branch',
            "offer_description"=> $LeadBooking->offer->name,
            "amount"=> $LeadBooking->offer->price,
            "trans_id"=> "No value",
            "branchtext"=> $LeadBooking->source_ads ?? 'No value',
            "department"=> 'Pending',//waiting sherif
            "source"=> 'onlinepay',//waiting sherif
            "promotiontext"=> $LeadBooking->type_pay,
            "branchlist" => $LeadBooking->branche->reference_id ? $LeadBooking->branche->reference_id  : '559' ,
            "servicelist" => "654" ,
            "directionlist" => "659",
            "sourcelist" => $LeadBooking->sourcelist ? $LeadBooking->sourcelist : '666',
            "urlsourcelist" => $LeadBooking->urlsourcelist ? $LeadBooking->urlsourcelist : '667',
            "categorylist" => "668",
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
            $response = json_decode($response,true);
            $err      = curl_error($curl);

        }

    }
}
