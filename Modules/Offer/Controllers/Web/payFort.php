<?php

namespace Modules\Offer\Controllers\Web;
use App\Http\Controllers\Controller;
use Session;

class payFort extends Controller
{

    /**
     * request Paramters to payFort.
     * 
     * @param array from data $booking
     * @param float $price
     * @param string $OfferName
     * @param string $returnUrl
     *
     * @return Array
     */

    public function paymentrequestParams($booking,$price,$OfferName,$returnUrl)
    {

        $requestParams = array(
            'command' => 'PURCHASE',
            'access_code' => env('PAYFORT_ACCESS_CODE'),
            'merchant_identifier' => env('PAYFORT_MERCHANT_IDENTIFIER'),
            'merchant_reference' => $booking->order_reference,
            'amount' => $price * 100,
            'currency' => env('PAYFORT_CURRENCY'),
            'language' => Session::get('locale'),
            'customer_email' => $booking->email,
            'signature' => $this->generatesignatureCode($booking->order_reference,$price * 100,$booking->email,$OfferName),
            'order_description' => $OfferName,
            'return_url' => $returnUrl,
            );


        return $requestParams ;   
    }
     /**
     * generate signatureCode to payFort.
     * 
     * @param int $reference
     * @param float $price
     * @param string $email
     * @param string $name
     *
     * @return signature
     */

    public function generatesignatureCode($reference,$price,$email,$name)
    {
        if(Session::get('locale') == 'en'){
            $returnUrl = url('/').'/page/offer-thanks'.'/'.'?lang='.Session::get('locale').'';
        } else {
            $returnUrl = url('/').'/page/offer-thanks';
        }

        $shaString  = '';
        // array request
        $arrData    = array(
        'command'             => 'PURCHASE',
        'access_code'         => env('PAYFORT_ACCESS_CODE'),
        'merchant_identifier' => env('PAYFORT_MERCHANT_IDENTIFIER'),
        'merchant_reference'  => $reference,
        'amount'              => $price,
        'currency'            => env('PAYFORT_CURRENCY'),
        'language'            => Session::get('locale'),
        'customer_email'      => $email,
        'order_description'   => $name,
        'return_url'          => $returnUrl,
        );
        // sort an array by key
        ksort($arrData);
        foreach ($arrData as $key => $value) {
            $shaString .= "$key=$value";
        }

        // make sure to fill your sha request pass phrase
        $shaString = env('PAYFORT_SHA_REQUEST_PHRASE') . $shaString . env('PAYFORT_SHA_REQUEST_PHRASE');
        $signature = hash('SHA256', $shaString);

        return $signature;


    }

}
