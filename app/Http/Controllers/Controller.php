<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function hash_digest()
    {
        $request_type = "GET";
        $endpoint = "/api/baxipay/superagent/account/balance";
        $request_date = "Thu, 19 Dec 2019 17:40:26 GMT";
        $user_secret = "YOUR_USER_SECRET";
        $json_payload = '{ "name":"tayo" }';
        $encoded_payload_hash = "";

        // 1. CONVERT DATE TO UNIX TIMESTAMP
        $timestamp = strtotime($request_date);

        if (!empty($json_payload)) {
            // 2. DO A SHA256 OF YOUR JSON PAYLOAD (IF AVAILABLE)
            $payload_hash = hash('sha256', $json_payload, $raw_output = TRUE);

            // 3. ENCODE THE PAYLOAD HASH WITH BASE-64
            $encoded_payload_hash = base64_encode($payload_hash);
        } else {
            $encoded_payload_hash = ""; // NO PAYLOAD
        }

        // 4. CREATE A SECURITY STRING FOR THIS REQUEST
        $signed_string = $request_type . $endpoint . $timestamp . $encoded_payload_hash;

        // 5. DO A UTF-8 ENCODE OF THE SECURITY STRING
        $encoded_signed_string = utf8_encode($signed_string);

        // 6. SIGN USING HMAC-SHA1: Key = USER_SECRET, Message = ENCODED SIGNED STRING
        $hash_signature = hash_hmac("sha1", $encoded_signed_string, $user_secret, $raw_output = TRUE);

        // 7. CONVERT HASH SIGNATURE TO BASE 64
        $final_signature = base64_encode($hash_signature);

        return $final_signature;
    }

    public function index()
    {
        return view('index');
    }

    public function dstv(){
        $url='services/multichoice/list';
        $type='dstv';
        $data = array("service_type" => $type);
        $response = $this->api($url, $data);

        if($response['code'] == 200){
            return view('dstv.index', ['datas' => $response]);
            // return $response;
        }else{
            abort(503);
        }
    }

    public function dstv_id($id){
        if($id > 9){
            abort(404);
        }
        $url='services/multichoice/list';
        $type='dstv';
        $data = array("service_type" => $type);
        $response = $this->api($url, $data);

        if($response['code'] == 200){
            return view('dstv.form', ['datas' => $response, 'id' => $id]);
            // return $response;
        }else{
            abort(503);
        }
    }

    public function dstv_pay(Request $req){
        $url='services/multichoice/request';
        $data = [
            'total_amount' => $req->total_amount,
            'product_monthsPaidFor' => $req->product_monthsPaidFor,
            'product_code' => $req->product_code,
            'smartcard_number' => $req->smartcard_number,
            'service_type' => 'dstv',
            'agentReference' => 'baxi-api-'.rand(0,time()).rand(0,1000),
            'agentId' => env('BAXI_ID'),
        ];
        $response = $this->api($url, $data);
        return view('dstv.status', ['data' => $response]);
        // return $response;

    }

    public function ekedc(){
        return view('ekedc.form');
    }

    public function ekedc_id($id){
        return view('ekedc.form', ['id' => $id]);

    }

    public function api($url, $data){

        $base_url = env('BAXI_URL');

        $api_key = env('BAXI_API_KEY');

        $handle = curl_init();
        // Set the url
        curl_setopt($handle, CURLOPT_URL, $base_url.$url);
        // Set the result output to be a string.
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

        //set the service type

        $data_string = json_encode($data);

        curl_setopt($handle, CURLOPT_POSTFIELDS, $data_string );
        //set headers_list
        if($url == 'services/multichoice/request'){
            $headers = [
                'Accept: application/json',
                'Content-Type: application/json',
                'Baxi-date: '.strtotime("now"),
                'x-api-key: '.$api_key,

            ];
        }else{
            $headers = [
                'Accept: application/json',
                'Content-Type: application/json',
                'x-api-key: '.$api_key,

            ];
        }

        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);

        $output = curl_exec($handle);

        curl_close($handle);

       return json_decode($output, true);

    }
}
