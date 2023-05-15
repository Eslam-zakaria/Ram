<?php

namespace Modules\Offer\Controllers\Web;
use App\Http\Controllers\Controller;
use Session;

class tabby extends Controller
{
    /**
     * call tabby api.
     * 
     * @param int $reference
     * @param float $amount
     * @param string $Productname
     * @param string $UserName
     * @param int $UserPhone
     * @param string $UserEmail
     * @param string $Branche
     * @param string $SubBranche
     * @param string $returnUrl
     * @param string $FailedUrl
     *
     * @return Json
     */

    public function callTabby($reference,$amount,$Productname,$UserName,$UserPhone,$UserEmail,$Branche,$SubBranche,$returnUrl,$FailedUrl){
       
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.tabby.ai/api/v2/checkout',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
        "payment": {
            "amount": '.$amount.',
            "currency": "SAR",
            "description": "'.$Productname.'",
            "buyer": {
            "phone": "'.$UserPhone.'",
            "email": "'.$UserEmail.'",
            "name": "'.$UserName.'",
            "dob": "2019-08-24"
            },
            "buyer_history": {
            "registered_since": "2019-08-24T14:15:22Z",
            "loyalty_level": 0,
            "wishlist_count": 0,
            "is_social_networks_connected": true,
            "is_phone_number_verified": true,
            "is_email_verified": true
            },
            "order": {
            "tax_amount": "0.00",
            "shipping_amount": "0.00",
            "discount_amount": "0.00",
            "updated_at": "2019-08-24T14:15:22Z",
            "reference_id": "'.$reference.'",
            "items": [
                {
                "title": "'.$Productname.'",
                "description": "'.$Productname.'",
                "quantity": 1,
                "unit_price": "0.00",
                "discount_amount": "0.00",
                "reference_id": "'.$reference.'",
                "image_url": "http://example.com",
                "product_url": "http://example.com",
                "gender": "Male",
                "category": "Ram",
                "color": "Ram",
                "product_material": "Ram",
                "size_type": "Ram",
                "size": "Ram",
                "brand": "Ram"
                }
            ]
            },
            "order_history": [
            {
                "purchased_at": "2019-08-24T14:15:22Z",
                "amount": "0.00",
                "payment_method": "card",
                "status": "new",
                "buyer": {
                "phone": "'.$UserPhone.'",
                "email": "'.$UserEmail.'",
                "name": "'.$UserName.'",
                "dob": "2019-08-24"
                },
                "shipping_address": {
                "city": "'.$Branche.'",
                "address": "'.$SubBranche.'",
                "zip": "'.$SubBranche.'"
                },
                "items": [
                {
                    "title": "'.$Productname.'",
                    "description": "'.$Productname.'",
                    "quantity": 1,
                    "unit_price": "0.00",
                    "discount_amount": "0.00",
                    "reference_id": "'.$reference.'",
                    "image_url": "http://example.com",
                    "product_url": "http://example.com",
                    "ordered": 0,
                    "captured": 0,
                    "shipped": 0,
                    "refunded": 0,
                    "gender": "Male",
                    "category": "Ram",
                    "color": "Ram",
                    "product_material": "Ram",
                    "size_type": "Ram",
                    "size": "Ram",
                    "brand": "Ram"
                }
                ]
            }
            ],
            "shipping_address": {
            "city": "'.$Branche.'",
            "address": "'.$SubBranche.'",
            "zip": "'.$SubBranche.'"
            },
            "meta": {
            "order_id": "#'.$reference.'",
            "customer": "'.$reference.'"
            },
            "attachment": {
            "body": "{\\"flight_reservation_details\\": {\\"pnr\\": \\"TR9088999\\",\\"itinerary\\": [...],\\"insurance\\": [...],\\"passengers\\": [...],\\"affiliate_name\\": \\"some affiliate\\"}}",
            "content_type": "application/vnd.tabby.v1+json"
            }
        },
        "lang": "'.Session::get('locale').'",
        "merchant_code": "'.$reference.'",
        "merchant_urls": {
            "success": "'.$returnUrl.'",
            "cancel": "'.$FailedUrl.'",
            "failure": "'.$FailedUrl.'"
        }
        }',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer pk_cc15e787-5b8b-4a76-a4e6-8f2f280a8a08',
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response,true);

        curl_close($curl);

        return $response;
    }

    /**
     * call tabby Retrieve api.
     * 
     * @param string $PaymentID
     *
     * @return Json
     */

    public function callRetrieveTabby($PaymentID){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.tabby.ai/api/v1/payments/'.$PaymentID.'',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
              'Authorization: Bearer sk_70992bd6-66fd-48fd-a88c-5d4c8f7fd3ab'
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response,true);
        $Amount   = $response['amount'];

        curl_close($curl);

        return $Amount;
        
    }

    /**
     * call tabby Capture api.
     * 
     * @param string $PaymentID
     * @param string $Amount
     *
     * @return Json
     */

    public function callCaptureTabby($PaymentID,$Amount){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.tabby.ai/api/v1/payments/'.$PaymentID.'/captures',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
              "amount": "'.$Amount.'"
          }',
            CURLOPT_HTTPHEADER => array(
              'Content-Type: application/json',
              'Authorization: Bearer sk_70992bd6-66fd-48fd-a88c-5d4c8f7fd3ab'
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response,true);

        curl_close($curl);

        return $response;
        
    }
}
