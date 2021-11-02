<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Models\Message;
use App\Models\Beneficiary;

class SMSController extends Controller
{
    public function sendSMS(Request $request){

        $api_key= env('BEEM_API_KEY');
        $secret_key = env('BEEM_SECRET_KEY');

        $postData = array(
            'source_addr' => env('BEEM_SOURCE_ADDRESS'),
            'encoding'=>0,
            'schedule_time' => '',
            'message' => $request->message,
            'recipients' => [array('recipient_id' => '1','dest_addr'=> $request->phone)]
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

    public function getAllSMS(){
        $messages = Message::all();
        return \response()->json($messages, 200);
    }

    public function callback(Request $request){

        $checkIfUserExistsInDB = Beneficiary::where('phone', $request->input('from'))->exists();

        if(!$checkIfUserExistsInDB){
            Beneficiary::create([
                'phone' => $request->input('from')
            ]);

            Message::create([
                'from' => $request->input('from'),
                'sms' => $request->input('message.text'),
                'to' =>  $request->input('to'),
                'transaction_id' => $request->input('transaction_id'),
            ]);
        }

        Message::create([
            'from' => $request->input('from'),
            'sms' => $request->input('message.text'),
            'to' =>  $request->input('to'),
            'transaction_id' => $request->input('transaction_id'),
        ]);

            return \response()->json('success', 200);

    }
}
