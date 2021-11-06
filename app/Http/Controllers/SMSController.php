<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Models\Message;
use App\Models\Beneficiary;
use Illuminate\Support\Str;
use App\Http\Controllers\GBVController;
use App\Http\Controllers\HIVController;
use App\Http\Controllers\MarriageController;
use App\Http\Controllers\PregnancyController;
use RealRashid\SweetAlert\Facades\Alert;


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
        return response()->json('who are you?', 200);
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

    public function formMsg(Request $request){

        $newPhone = ltrim($request->phone, '0');
        $phone = "255".$newPhone;

        $check = Beneficiary::where('phone', $phone)->exists();

        if(!$check){

            //create new user
            $b = Beneficiary::create([
                'phone' => $phone
            ]);

            //send greeting SMS
            $this->sendSMS($phone, "Greetings! Welcome to Tai SMS portal. Type A to communicate in English or B to communicate in Swahili.");
            return redirect()->back();
        }

        $this->sendSMS($phone, "Greetings! Welcome back to Tai SMS portal. Type A to communicate in English or B to communicate in Swahili.");
        return redirect()->back();
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

        if($phone == "255744306422" || "255783858149"){
            $b = Beneficiary::firstOrCreate([
                'phone' => $phone
            ]);
    
            Message::create([
                'from' => $phone,
                'sms' => $message,
                'transaction_id' => $request->input('transaction_id'),
                'beneficiary_id' => $b->id
            ]);

            return response()->json('stopping spammer', 200);
        }

        $b = Beneficiary::firstOrCreate([
            'phone' => $phone
        ]);

        Message::create([
            'from' => $phone,
            'sms' => $message,
            'transaction_id' => $request->input('transaction_id'),
            'beneficiary_id' => $b->id
        ]);

        return response()->json('who are you?', 200);
        

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
            $this->sendSMS($phone, "Greetings! Welcome to Tai SMS portal. Type A to communicate in English or B to communicate in Swahili.");
            return response()->json('Registration confirmed', 200);
        }

        //greeting check
        $checkIfGreeting = Str::startsWith($message , ['Hello', 'Habari']);

        //language check
        $checkIfEnglishIsSelected = Str::startsWith($message, 'A');
        $checkIfSwahiliIsSelected = Str::startsWith($message, 'B');

        //age check
        $checkAgeInSwahili = Str::containsAll($message, ['Nina','umri','wa','miaka' ]);
        $checkAgeInEnglish = Str::containsAll($message, ['I', 'am', 'years', 'old' ]);

        //language check
        $checkIfGreetingInswahili = Str::containsAll($message, ['Jina','langu', 'ni']);
        $checkIfGreetingInEnglish = Str::containsAll($message, ['My', 'name', 'is']);

        //gender check
        $checkIfMale = Str::endsWith($message, 'C');
        $checkIfFemale = Str::endsWith($message, 'D');

        //region check
        $checkRegionInSwahili = Str::startsWith($message, 'Naishi');
        $checkRegionInEnglish = Str::endsWith($message, 'region');

        if($checkIfGreetingInswahili){
           return $this->saveNameInSwahili($phone, $message);
        }

        if($checkIfGreetingInEnglish){
            return $this->saveNameInEnglish($phone, $message);
        }

        if($checkRegionInSwahili){
            return $this->saveRegionInSwahili($phone,$message);
        }

        if($checkRegionInEnglish){
            return $this->saveRegionInEng($phone,$message);
        }

        if($checkAgeInSwahili){
            return  $this->saveAgeInSwahili($phone, $message);
        }

        if($checkAgeInEnglish){
            return $this->saveAgeInEnglish($phone, $message);
        }

        if($checkIfMale || $checkIfFemale){
            return $this->saveGender($phone, $message);
        }

        if($checkIfEnglishIsSelected){
            Beneficiary::where('phone', $phone)->update(['language_id' => 1]);
            return $this->sendSMS($phone, "You have chosen English as your language of choice. What is your name? Please type in starting with \"My name is ...\"");
        }

        if($checkIfSwahiliIsSelected){
            Beneficiary::where('phone', $phone)->update(['language_id' => 2]);
            return $this->sendSMS($phone, "Umechagua Swahili kama lugha yako. Je, kwa jina unaitwa nani? Anza kuandika jina lako kwa kuandika \"Jina langu ni ...\"");
        }


        switch ($message) {
            case Str::endsWith($message, 'GBV'):
                $gbvController = new GBVController();
                $gbvController->index($phone);
                break;
            case Str::containsAll($message, ['GBV', 'A']):
                $gbvController = new GBVController();
                $gbvController->gbvA($phone);
                break;
            case Str::containsAll($message, ['GBV','B']):
                $gbvController = new GBVController();
                $gbvController->gbvB($phone);
                break;
            case Str::containsAll($message, ['GBV','C']):
                $gbvController = new GBVController();
                $gbvController->gbvC($phone);
                break;
            case Str::containsAll($message, ['GBV','D']):
                $gbvController = new GBVController();
                $gbvController->gbvD($phone);
                break;
            case Str::containsAll($message, ['GBV', 'E']):
                $gbvController = new GBVController();
                $gbvController->gbvE($phone);
                break;
            case Str::endsWith($message, 'HIV'):
                $hivController = new HIVController();
                $hivController->index($phone);
                break;
            case Str::containsAll($message, ['HIV', 'A']):
                $hivController = new HIVController();
                $hivController->hivA($phone);
                break;
            case Str::containsAll($message, ['HIV', 'B']):
                $hivController = new HIVController();
                $hivController->hivB($phone);
                break;
            case Str::containsAll($message, ['HIV', 'C']):
                $hivController = new HIVController();
                $hivController->hivC($phone);
                break;
            case Str::containsAll($message, ['HIV','D']):
                $hivController = new HIVController();
                $hivController->hivD($phone);
                break;
            case Str::containsAll($message, ['HIV','E']):
                $hivController = new HIVController();
                $hivController->hivE($phone);
                break;
            case Str::containsAll($message, ['HIV', 'F']):
                $hivController = new HIVController();
                $hivController->hivF($phone);
                break;
            case Str::containsAll($message, ['HIV','G']):
                $hivController = new HIVController();
                $hivController->hivG($phone);
                break;
            case Str::endsWith($message, 'CM'):
                $cmController = new MarriageController();
                $cmController->index($phone);
                break;
            case Str::containsAll($message, ['CM','A']):
                $cmController = new MarriageController();
                $cmController->cmA($phone);
                break;
            case Str::containsAll($message, ['CM','B']):
                $cmController = new MarriageController();
                $cmController->cmB($phone);
                break;
            case Str::endsWith($message, 'TP'):
                $pcController = new PregnancyController();
                $pcController->index($phone);
                break;
            case Str::containsAll($message, ['TP','A']):
                $pcController = new PregnancyController();
                $pcController->pcA($phone);
                break;
            case Str::containsAll($message, ['TP','B']):
                $pcController = new PregnancyController();
                $pcController->pcB($phone);
                break;
            case Str::containsAll($message, ['TP','C']):
                $pcController = new PregnancyController();
                $pcController->pcC($phone);
                break;
            case Str::containsAll($message, ['TP','D']):
                $pcController = new PregnancyController();
                $pcController->pcD($phone);
                break;
            default:
                return $this->sendSMS($request->input('from'), "Greetings! Welcome back to Tai SMS portal. Type A to communicate in English or B to communicate in Swahili.");
                break;
        }

        if($checkIfGreeting){

            $b = Beneficiary::where('phone', $phone)->first();

            // Message::create([
            //     'from' => $request->input('from'),
            //     'sms' => $request->input('message.text'),
            //     'to' =>  $request->input('to'),
            //     'transaction_id' => $request->input('transaction_id'),
            //     'beneficiary_id' => $b->id
            // ]);

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
        Beneficiary::where('phone', $phone)->update(['name' => Str::after($message, 'Jina langu ni')]);
        return $this->sendSMS($phone, "Una umri wa miaka mingapi? Jibu kuanzia \"Nina umri wa miaka 20\" ukimalizia na idadi ya miaka yako.");
    }

    public function saveNameInEnglish($phone, $message){
        Beneficiary::where('phone', $phone)->update(['name' => Str::after($message, 'My name is')]);
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
        Beneficiary::where('phone', $phone)->update(['location' => Str::after($message, 'Naishi mkoa wa')]);
        return $this->sendSMS($phone, "Asante kwa kujibu maswali yetu. 
        Chagua Zipi kati ya vifwatavyo ungependa kujua zaidi:
        \n GBV . Ukatili wa kijinsia na watoto 
        \n CM . Ndoa za utotoni 
        \n HIV . Virus Vya Ukimwi 
        \n TP . Mimba za utotoni"); 
    }

    public function saveRegionInEng($phone,$message){
        Beneficiary::where('phone', $phone)->update(['location' => Str::beforeLast($message, 'region')]);
        return $this->sendSMS($phone, "Thanks for answering our questions. Choose which ones below would you like to know more about: 
            \n GBV . Gender based violence
            \n CM . Child Marriage
            \n HIV . Human Immunodefiency Virus
            \n TP . Teenage Pregnancy"); 
    }

}
