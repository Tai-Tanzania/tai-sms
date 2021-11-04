<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Models\Message;
use App\Models\Beneficiary;
use Illuminate\Support\Str;
use App\Http\Controllers\GBVController;

class SMSController extends Controller
{    
    /**
     * testerSMS
     *
     * @param  mixed $request
     * @return void
     */
    public function testerSMS(Request $request){

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

    
    /**
     * sendSMS
     *
     * @param  mixed $phone
     * @param  mixed $message
     * @return void
     */
    public function sendSMS($phone, $message){
        $api_key= env('BEEM_API_KEY');
        $secret_key = env('BEEM_SECRET_KEY');

        $postData = array(
            'source_addr' => env('BEEM_SOURCE_ADDRESS'),
            'encoding'=>0,
            'schedule_time' => '',
            'message' => $message,
            'recipients' => [array('recipient_id' => '1','dest_addr'=> $phone)]
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
    
    /**
     * getAllSMS
     *
     * @return void
     */
    public function getAllSMS(){
        $messages = Message::all();
        return \response()->json($messages, 200);
    }
    
    /**
     * callback
     *
     * @param  mixed $request
     * @return void
     */
    public function callback(Request $request){

        $phone = $request->input('from');
        $message = $request->input('message.text');

        //checking if user is in the database
        $checkIfUserExistsInDB = Beneficiary::where('phone', $phone)->exists();

        if(!$checkIfUserExistsInDB){

            //create new user
            $b = Beneficiary::create([
                'phone' => $phone
            ]);

            //store message
            Message::create([
                'from' => $phone,
                'sms' => $message,
                'transaction_id' => $request->input('transaction_id'),
                'beneficiary_id' => $b->id
            ]);

            //send greeting SMS
            return $this->sendSMS($phone, "Greetings! Welcome to Tai SMS portal. Type A to communicate in English or B to communicate in Swahili.");
        }

        $checkIfGreeting = Str::startsWith($message , ['Hello', 'Hi', 'Niaje', 'Mambo']);
        $checkIfEnglishIsSelected = Str::endsWith($message, 'A');
        $checkIfSwahiliIsSelected = Str::endsWith($message, 'B');
        $checkAgeInSwahili = Str::containsAll($message, ['Nina','umri','wa','miaka' ]);
        $checkAgeInEnglish = Str::containsAll($message, ['I', 'am', 'years', 'old' ]);
        $checkIfGreetingInswahili = Str::containsAll($message, ['Jina','langu', 'ni']);
        $checkIfMale = Str::endsWith($message, 'C');
        $checkIfFemale = Str::endsWith($message, 'D');
        $checkRegionInSwahili = Str::startsWith($message, 'Naishi');
        $checkRegionInEnglish = Str::endsWith($message, 'region');


        switch ($message) {
            case Str::endsWith($message, 'E'):
                $gbvController = new GBVController();
                $gbvController->index(null, $phone);
                break;
            
            default:
                # code...
                break;
        }

        if($checkIfGreetingInswahili){
            $this->saveNameInSwahili($phone, $message);
        }

        if($checkRegionInSwahili){
            $this->saveRegionInSwahili($phone,$message);
        }

        if($checkRegionInEnglish){
            $this->saveRegionInEng($phone,$message);
        }

        if($checkAgeInSwahili){
            $this->saveAgeInSwahili($phone, $message);
        }

        if($checkAgeInEnglish){
            $this->saveAgeInEnglish($phone, $message);
        }

        if($checkIfMale || $checkIfFemale){
            $this->saveGender($phone, $message);
        }

        if($checkIfEnglishIsSelected){
            Beneficiary::where('phone', $phone)->update(['language' => 1]);
            return $this->sendSMS($phone, "You have chosen English as your language of choice. What is your name? Please type in starting with \"My name is ...\"");
        }

        if($checkIfSwahiliIsSelected){
            Beneficiary::where('phone', $phone)->update(['language' => 2]);
            return $this->sendSMS($phone, "Umechagua Swahili kama lugha yako. Je, kwa jina unaitwa nani? Anza kuandika jina lako kwa kuandika \"Jina langu ni ...\"");
        }

        if($checkIfGreeting){
            Message::create([
                'from' => $request->input('from'),
                'sms' => $request->input('message.text'),
                'to' =>  $request->input('to'),
                'transaction_id' => $request->input('transaction_id'),
            ]);

            //send greeting sms
            return $this->sendSMS($request->input('from'), "Greetings! Welcome back to Tai SMS portal.");
        }

            // return \response()->json('success', 200);

    }
    
    /**
     * saveNameInSwahili
     *
     * @param  mixed $phone
     * @param  mixed $message
     * @return void
     */
    public function saveNameInSwahili($phone, $message){
        Beneficiary::where('phone', $phone)->update(['name' => Str::after($message, 'Jina langu ni ')]);
        return $this->sendSMS($phone, "Una umri wa miaka mingapi? Jibu kuanzia \"Nina umri wa miaka ...\" ukimalizia na idadi ya miaka yako.");
    }

    public function saveNameInEnglish($phone, $message){
        Beneficiary::where('phone', $phone)->update(['name' => Str::after($message, 'My name is ')]);
        return $this->sendSMS($phone, "How old are you? Your answer should be like \"I am 20 years old\".");
    }
    
    /**
     * saveAgeInSwahili
     *
     * @param  mixed $phone
     * @param  mixed $message
     * @return void
     */
    public function saveAgeInSwahili($phone, $message){
        Beneficiary::where('phone', $phone)->update(['age' => Str::after($message, 'Nina umri wa miaka ')]);
        return $this->sendSMS($phone, "Je, wewe ni jinsia gani? Jibu C kama ni ya kiume; D kama ya kike.");
    }

    public function saveAgeInEnglish($phone, $message){
        Beneficiary::where('phone', $phone)->update(['age' => Str::between($message, 'am', 'years')]);
        return $this->sendSMS($phone, "What is your gender? Answer C if male; D if female.");
    }

    public function saveGender($phone,$message){
        Str::endsWith($message, 'C') ?  
        Beneficiary::where('phone', $phone)->update(['gender' => 'male']) :
        Beneficiary::where('phone', $phone)->update(['gender' => 'female']);

        if(Beneficiary::where('phone', $phone)->pluck('language_id')->first() == 1){
            return $this->sendSMS($phone, "What is the name of the region you reside in? Answer like \"Kigoma region\".");
        } 
        return $this->sendSMS($phone, "Unaishi mkoa gani? Jiba kama ifwatavyo: \"Naishi mkoa wa Kigoma\".");   
    }

    public function saveRegionInSwahili($phone,$message){
        Beneficiary::where('phone', $phone)->update(['region' => Str::after($message, 'Naishi mkoa wa')]);
        return $this->sendSMS($phone, "Asante kwa kujibu maswali yetu. 
        Chagua Zipi kati ya vifwatavyo ungependa kujua zaidi:
        \n\n E. Ukatili wa kijinsia na watoto 
        \n\n F. Ndoa za utotoni 
        \n\n G. Virus Vya Ukimwi 
        \n\n H. Mimba za utotoni"); 
    }

    public function saveRegionInEng($phone,$message){
        Beneficiary::where('phone', $phone)->update(['region' => Str::beforeLast($message, 'region')]);
        return $this->sendSMS($phone, "Thanks for answering our questions. Choose which ones below would you like to know more about: 
            \n\n E. Gender based violence
            \n\n F. Child Marriage
            \n\n G. Human Immunodefiency Virus
            \n\n H. Teenage Pregnancy"); 
    }

}
