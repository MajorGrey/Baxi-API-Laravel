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
        return view('status', ['data' => $response]);
        // return $response;

    }

    public function ekedc(){
        return view('ekedc.form');
    }

    public function ekedc_id($id, $number){

        $url='services/electricity/verify';
        $data = [
            'account_number' => $number,
            'service_type' => $id,

        ];
        $response = $this->api($url, $data);
        return $response;
    }

    public function ekedc_pay(Request $req){
        $url='services/electricity/request';
        $data = [
            'phone' => $req->phone,
            'amount' => $req->amount,
            'account_number' => $req->account_number,
            'service_type' => $req->service_type,
            'agentReference' => 'baxi-api-'.rand(0,time()).rand(0,1000),
            'agentId' => env('BAXI_ID'),
        ];
        $response = $this->api($url, $data);
        return view('status', ['data' => $response]);
        // return $response;
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
        }else if($url == 'services/multichoice/request'){
            $headers = [
                'Accept: application/json',
                'Content-Type: application/json',
                'Baxi-date: '.strtotime("now"),
                'x-api-key: '.$api_key,

            ];

        }else if($url == 'services/electricity/request'){
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
