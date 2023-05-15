<?php

namespace Modules\Offer\Controllers\Web;
use App\Http\Controllers\Controller;
use Session;

class tamara extends Controller
{
  
    /**
     * call tamara api.
     * 
     * @param int $reference
     * @param float $amount
     * @param string $Productname
     * @param string $UserName
     * @param int $UserPhone
     * @param string $UserEmail
     * @param string $Branche
     * @param string $redirectUrl
     * @param string $FailedUrl
     * @param string $Branchename
     *
     * @return Json
     */

    public function callTamara($reference,$amount,$Productname,$UserName,$UserPhone,$UserEmail,$Branche,$redirectUrl,$FailedUrl,$Branchename)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.tamara.co/checkout',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
        "order_reference_id": '.$reference.',
        "order_number": "A'.$reference.'",
        "total_amount": {
            "amount": '.$amount.',
            "currency": "SAR"
        },
        "description": "'.$Productname.'",
        "country_code": "SA",
        "payment_type": "PAY_BY_INSTALMENTS",
        "instalments": null,
        "locale": "'.Session::get('locale').'",
        "items": [
            {
            "reference_id": '.$reference.',
            "type": "Digital",
            "name": "'.$Productname.'",
            "sku": "SA-'.$reference.'",
            "image_url": "https://www.example.com/product.jpg",
            "quantity": 1,
            "unit_price": {
                "amount": '.$amount.',
                "currency": "SAR"
            },
            "discount_amount": {
                "amount": "00.00",
                "currency": "SAR"
            },
            "tax_amount": {
                "amount": "00.00",
                "currency": "SAR"
            },
            "total_amount": {
                "amount": '.$amount.',
                "currency": "SAR"
            }
            }
        ],
        "consumer": {
            "first_name": "'.$UserName.'",
            "last_name": "'.$UserName.'",
            "phone_number": "'.$UserPhone.'",
            "email": "'.$UserEmail.'"
        },
        "billing_address": {
            "first_name": "'.$UserName.'",
            "last_name": "'.$UserName.'",
            "line1": "'.$Branche.'",
            "line2": "N/A",
            "region": "N/A",
            "postal_code": "N/A",
            "city": "'.$Branchename.'",
            "country_code": "SA",
            "phone_number":  "'.$UserPhone.'"
        },
        "shipping_address": {
            "first_name": "'.$UserName.'",
            "last_name": "'.$UserName.'",
            "line1": "'.$Branche.'",
            "line2": "N/A",
            "region": "N/A",
            "postal_code": "N/A",
            "city": "'.$Branchename.'",
            "country_code": "SA",
            "phone_number":  "'.$UserPhone.'"
        },
        "discount": {
            "name": "Christmas 2020",
            "amount": {
            "amount": "00.00",
            "currency": "SAR"
            }
        },
        "tax_amount": {
            "amount": "00.00",
            "currency": "SAR"
        },
        "shipping_amount": {
            "amount": "00.00",
            "currency": "SAR"
        },
        "merchant_url": {
            "success": "'.$redirectUrl.'",
            "failure": "'.$FailedUrl.'",
            "cancel": "'.$FailedUrl.'",
            "notification": "'.$redirectUrl.'"
        },
        "platform": "Magento",
        "is_mobile": false,
        "risk_assessment": {
            "customer_age": 22,
            "customer_dob": "31-01-2000",
            "customer_gender": "Male",
            "customer_nationality": "SA",
            "is_premium_customer": true,
            "is_existing_customer": true,
            "is_guest_user": true,
            "account_creation_date": "31-01-2019",
            "platform_account_creation_date": "string",
            "date_of_first_transaction": "31-01-2019",
            "is_card_on_file": true,
            "is_COD_customer": true,
            "has_delivered_order": true,
            "is_phone_verified": true,
            "is_fraudulent_customer": true,
            "total_ltv": 501.5,
            "total_order_count": 12,
            "order_amount_last3months": 301.5,
            "order_count_last3months": 2,
            "last_order_date": "31-01-2021",
            "last_order_amount": 301.5,
            "reward_program_enrolled": true,
            "reward_program_points": 300
        },
        "expires_in_minutes": 0,
        "additional_data": {
            "delivery_method": "home delivery",
            "pickup_store": "Store A"
        }
        }',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhY2NvdW50SWQiOiIxMzkyMGJhMS0xMGVkLTQzOTctOGM1MC0xYTU4YjJhNzMyNGYiLCJ0eXBlIjoibWVyY2hhbnQiLCJzYWx0IjoiYmQ3MmE2YTlhZWI1N2M4M2I2MWE2ODliNzU4ZjAxMWQiLCJpYXQiOjE2NDYxNDIxODIsImlzcyI6IlRhbWFyYSJ9.vrs4PBsT_ktYkcznkqv_6Q5SyigKjOTgZRGsjS6O1t-D9F5F4NCVy4QBZVj5R1o8EZyfMbYqN6XJtKJvcQt9kcGRQRB0zpT3QhnvWnQKOO76JXpRSVGsldXfpCVwGdJB29E3zOw6QVT4XZGfwgGXxYfSLYdRNI5P6ROpj-3NhlGLOC4SLLioMEpbxPqhBxwnA0c7VlYyW1vvXJwwcfeNALYGTovUWJQIm9GVI7gUka5qzQB8r9M2wmzZnlfJVuMQ61tCqfia9YDHZ4g3BN9fL1ieMmbFAViotosxms2dRScn50nxT4qAtJmkpvnP2-5B8dP0QUXoHQYjUZn2XghLTg',
            'Content-Type: application/json'
        ),
        ));
       
        $response = curl_exec($curl);
        
        $response = json_decode($response,true);
        
        curl_close($curl);

        return $response ;
    }

    /**
     * call change statusOrderTamara api.
     * 
     * @param string $orderId
     *
     * @return Json
     */

    public function statusOrderTamara($orderId)
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.tamara.co/orders/'.$orderId.'/authorise',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhY2NvdW50SWQiOiIxMzkyMGJhMS0xMGVkLTQzOTctOGM1MC0xYTU4YjJhNzMyNGYiLCJ0eXBlIjoibWVyY2hhbnQiLCJzYWx0IjoiYmQ3MmE2YTlhZWI1N2M4M2I2MWE2ODliNzU4ZjAxMWQiLCJpYXQiOjE2NDYxNDIxODIsImlzcyI6IlRhbWFyYSJ9.vrs4PBsT_ktYkcznkqv_6Q5SyigKjOTgZRGsjS6O1t-D9F5F4NCVy4QBZVj5R1o8EZyfMbYqN6XJtKJvcQt9kcGRQRB0zpT3QhnvWnQKOO76JXpRSVGsldXfpCVwGdJB29E3zOw6QVT4XZGfwgGXxYfSLYdRNI5P6ROpj-3NhlGLOC4SLLioMEpbxPqhBxwnA0c7VlYyW1vvXJwwcfeNALYGTovUWJQIm9GVI7gUka5qzQB8r9M2wmzZnlfJVuMQ61tCqfia9YDHZ4g3BN9fL1ieMmbFAViotosxms2dRScn50nxT4qAtJmkpvnP2-5B8dP0QUXoHQYjUZn2XghLTg',
        ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response,true);
        curl_close($curl);

    }
}
