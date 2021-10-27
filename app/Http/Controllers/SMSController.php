<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class SMSController extends Controller
{
    public function sendSMS(){

        $api_key='24c3943f93fb04b2';
        $secret_key = 'NzRiYWRiZWM4NGE3ZTY4MjMxZDZkZjA2ZjRiY2JmNWE2NzE0ZmUzYTM5MmFmZDFkZGEyNzE4N2YyODJlMjM0ZQ==';

        $postData = array(
            'source_addr' => '15320',
            'encoding'=>0,
            'schedule_time' => '',
            'message' => 'Hello Man',
            'recipients' => [array('recipient_id' => '1','dest_addr'=>'255782835136')]
        );

        $Url ='https://apisms.beem.africa/v1/send';

        $ch = curl_init($Url);
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Authorization:Basic ' . base64_encode("$api_key:$secret_key"),
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode($postData)
        ));

        $response = curl_exec($ch);

        if($response === FALSE){
                echo $response;

            die(curl_error($ch));
        }
        var_dump($response);

    }



    public function callback(Request $request){
        $validator = Validator::make($request->all(), [
           'MESSAGE' => 'required',
           'SOURCEADDR' => 'required',
           'VP' => 'required',
           'SOURCEADDRNPI' => 'required',
           'SOURCEADDRTON' => 'required'

        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Nothing'], 400);
        }

        $from = $request->SOURCEADDR;        
        $message = $request->MESSAGE;
        $vp = $request->VP;
        $destaddr = $request->DESTADDR;
        $sourceaddnpi = $request->SOURCEADDRNPI;
        $sourceaddrton =  $request->SOURCEADDRTON;

        return response()->json('Success', 200);
    }
}
