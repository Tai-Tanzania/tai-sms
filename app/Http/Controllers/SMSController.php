<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class SMSController extends Controller
{
    public function sendSMS(){
        
        $response = Http::withHeaders([
            'Authorization:Basic' =>  base64_encode("24c3943f93fb04b2:NzRiYWRiZWM4NGE3ZTY4MjMxZDZkZjA2ZjRiY2JmNWE2NzE0ZmUzYTM5MmFmZDFkZGEyNzE4N2YyODJlMjM0ZQ=="),
            'Content-Type' => 'application/json'
        ])->post('https://apisms.beem.africa/v1/send', [
            'source_addr' => '15320',
            'encoding'=>0,
            'schedule_time' => '',
            'message' => 'Hello World',
            'recipients' => [
                array('recipient_id' => '1','dest_addr'=>'255782835136')
            ]
        ]);

        if($response->successful()){
            return response()->json('Success', 200);
        }

        return \response()->json('Failed', 400);
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
