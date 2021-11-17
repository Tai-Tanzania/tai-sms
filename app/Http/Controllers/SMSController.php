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

       return $response = curl_exec($ch);

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
     * formMsg
     *
     * @param  mixed $request
     * @return void
     */
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
            Alert::success('Welcome to Tai SMS portal! We will contact you.');
            return redirect()->back();
        }

        $this->sendSMS($phone, "Greetings! Welcome back to Tai SMS portal. Type A to communicate in English or B to communicate in Swahili.");
        Alert::info('Welcome back! We will contact you.');
        return redirect()->back();
    }

    public function sendTxt(Request $request){
        $this->sendSMS($request->phone, $request->message);
        session()->flash('success', 'Message sent successfully');
        return \redirect()->back();
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

        if($phone == "255783858149"){
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

        if($phone == "255744306422"){
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
        
        //checking if user is in the database
        $checkIfUserExistsInDB = Beneficiary::where('phone', $phone)->exists();

        //greeting check
        $checkIfGreetingEnglish = Str::startsWith($message , ['Hello', 'hello', 'Hi', 'hi']);
        $checkIfGreetingSwahili = Str::startsWith($message , ['Habari', 'habari', 'Mambo', 'mambo']);

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

            if($checkIfGreetingEnglish){
                $b->update(['language_id' => 1]);
                return $this->sendSMS($phone, "Greetings! Welcome to Tai SMS portal. Type 1 to communicate in English or 2 to communicate in Swahili.");
            }

            if($checkIfGreetingSwahili){
                $b->update(['language_id' => 2]);
                return $this->sendSMS($phone, "Karibu kwenye mfumo wa SMS wa Tai Tanzania. Jibu 1 kupata majibu kwa Kiingereza au 2 kupata majibu kwa Kiswahili.");
            }

            //send greeting SMS
            return $this->sendSMS($phone, "Karibu kwenye mfumo wa SMS wa Tai Tanzania. Jibu 1 kupata majibu kwa Kiingereza au 2 kupata majibu kwa Kiswahili.");
        }

        //language check
        $checkIfEnglishIsSelected = preg_match("~\b1\b~",$message);
        $checkIfSwahiliIsSelected = preg_match("~\b2\b~",$message);

        $checkENG = Str::startsWith($message, ['ENG']);
        $checkSW = Str::startsWith($message, ['SW']);

        if($checkENG){
            Beneficiary::where('phone', $phone)->update(['language_id' => 1]);
            return $this->sendSMS($phone, "You have selected English as your langague. Choose which ones below would you like to know more about: 
            \n Choose 5 to know more about Gender based violence
            \n Choose 6 to know more about Child Marriage
            \n Choose 7 to know more about Human Immunodefiency Virus
            \n Choose 8 to know more about Teenage Pregnancy
            \n\n To Change Language, text ENG for English language or SW for Swahili language.");
        }

        if($checkSW){
            Beneficiary::where('phone', $phone)->update(['language_id' => 2]);
            return $this->sendSMS($phone, "Umechagua Kiswahili kama lugha yako.  Chagua kati ya mada zipi unataka kujua zaidi:
            \n Chagua 5 kujua zaidi kuhusu Ukatili wa kijinsia (UWAKI)
            \n Chagua 6 kujua zaidi kuhusu Ndoa za utotoni
            \n Chagua 7 kujua zaidi kuhusu Virusi vya Ukimwi
            \n Chagua 8 kujua zaidi kuhusu Mimba za utotoni
            \n\n Kubadilisha lugha, chagua ENG kupata Kiingereza, au SW kupata Kiswahili.");
        }

        //age check
        $checkAgeInSwahili = Str::containsAll($message, ['Nina','umri','wa','miaka' ]);
        $checkAgeInEnglish = Str::containsAll($message, ['I', 'am', 'years', 'old' ]); //

        //language check
        $checkIfLanguageInswahili = Str::containsAll($message, ['Jina']);
        $checkIfLanguageInEnglish = Str::containsAll($message, ['Name']);

        //gender check
        $checkIfMale = preg_match("~\b3\b~",$message);
        $checkIfFemale = preg_match("~\b4\b~",$message);

        //region check
        $checkRegionInSwahili = Str::startsWith($message, 'Mkoa');
        $checkRegionInEnglish = Str::startsWith($message, 'Region');

        if($checkIfLanguageInswahili){
           return $this->saveNameInSwahili($phone, $message);
        }

        if($checkIfLanguageInEnglish){
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
            return $this->sendSMS($phone, "You have chosen English as your language of choice. What is your name? Please type like the following \"Name Jacob Abdallah\"");
        }

        if($checkIfSwahiliIsSelected){
            Beneficiary::where('phone', $phone)->update(['language_id' => 2]);
            return $this->sendSMS($phone, "Umechagua Swahili kama lugha yako. Je, kwa jina unaitwa nani? Anza kuandika jina lako kama kwa mfano \"Jina Jacob Abdallah\"");
        }

        if($checkIfGreetingEnglish){
            Beneficiary::where('phone', $phone)->update(['language_id' => 1]);
            return $this->sendSMS($request->input('from'), "Greetings! Welcome back to Tai SMS portal. Choose which ones below would you like to know more about: 
            \n Choose 5 to know more about Gender based violence
            \n Choose 6 to know more about Child Marriage
            \n Choose 7 to know more about Human Immunodefiency Virus
            \n Choose 8 to know more about Teenage Pregnancy
            \n\n To Change Language, text ENG for English language or SW for Swahili language.
            ");
        }

        if($checkIfGreetingSwahili){
            Beneficiary::where('phone', $phone)->update(['language_id' => 2]);
            return $this->sendSMS($request->input('from'), "Karibu tena kwenye mfumo wa SMS wa Tai Tanzania. Chagua kati ya mada zipi unataka kujua zaidi:
            \n Chagua 5 kujua zaidi kuhusu Ukatili wa kijinsia (UWAKI)
            \n Chagua 6 kujua zaidi kuhusu Ndoa za utotoni
            \n Chagua 7 kujua zaidi kuhusu Virusi vya Ukimwi
            \n Chagua 8 kujua zaidi kuhusu Mimba za utotoni
            \n\n Kubadilisha lugha, chagua ENG kupata Kiingereza, au SW kupata Kiswahili
            ");
        }

        switch ($message) {
            case Str::startsWith($message, '5'):
                $gbvController = new GBVController();
                $gbvController->index($phone);
                break;
            case Str::startsWith($message, '9'):
                $gbvController = new GBVController();
                $gbvController->gbvA($phone);
                break;
            case Str::startsWith($message,'10'):
                $gbvController = new GBVController();
                $gbvController->gbvB($phone);
                break;
            case Str::startsWith($message,'11'):
                $gbvController = new GBVController();
                $gbvController->gbvC($phone);
                break;
            case Str::startsWith($message,'12'):
                $gbvController = new GBVController();
                $gbvController->gbvD($phone);
                break;
            case Str::startsWith($message, '13'):
                $gbvController = new GBVController();
                $gbvController->gbvE($phone);
                break;
            case Str::startsWith($message, '7'):
                $hivController = new HIVController();
                $hivController->index($phone);
                break;
            case Str::startsWith($message, '14'):
                $hivController = new HIVController();
                $hivController->hivA($phone);
                break;
            case Str::startsWith($message,'15'):
                $hivController = new HIVController();
                $hivController->hivB($phone);
                break;
            case Str::startsWith($message,'16'):
                $hivController = new HIVController();
                $hivController->hivC($phone);
                break;
            case Str::startsWith($message,'17'):
                $hivController = new HIVController();
                $hivController->hivD($phone);
                break;
            case Str::startsWith($message,'18'):
                $hivController = new HIVController();
                $hivController->hivE($phone);
                break;
            case Str::startsWith($message,'19'):
                $hivController = new HIVController();
                $hivController->hivF($phone);
                break;
            case Str::startsWith($message,'20'):
                $hivController = new HIVController();
                $hivController->hivG($phone);
                break;
            case Str::startsWith($message, '6'):
                $cmController = new MarriageController();
                $cmController->index($phone);
                break;
            case Str::startsWith($message, '21'):
                $cmController = new MarriageController();
                $cmController->cmA($phone);
                break;
            case Str::startsWith($message, '22'):
                $cmController = new MarriageController();
                $cmController->cmB($phone);
                break;
            case Str::startsWith($message, '8'):
                $pcController = new PregnancyController();
                $pcController->index($phone);
                break;
            case Str::startsWith($message, '23'):
                $pcController = new PregnancyController();
                $pcController->pcA($phone);
                break;
            case Str::startsWith($message, '24'):
                $pcController = new PregnancyController();
                $pcController->pcB($phone);
                break;
            case Str::startsWith($message, '25'):
                $pcController = new PregnancyController();
                $pcController->pcC($phone);
                break;
            case Str::startsWith($message, '26'):
                $pcController = new PregnancyController();
                $pcController->pcD($phone);
                break;
            default:
                return $this->sendSMS($request->input('from'), "Karibu tena kwenye mfumo wa SMS wa Tai Tanzania. Chagua kati ya mada zipi unataka kujua zaidi:
                \n Chagua 5 kujua zaidi kuhusu Ukatili wa kijinsia (UWAKI)
                \n Chagua 6 kujua zaidi kuhusu Ndoa za utotoni
                \n Chagua 7 kujua zaidi kuhusu Virusi vya Ukimwi
                \n Chagua 8 kujua zaidi kuhusu Mimba za utotoni
                \n\n Kubadilisha lugha, chagua ENG kupata Kiingereza, au SW kupata Kiswahili
                ");
                break;
        }

    }
    
    /**
     * saveNameInSwahili
     *
     * @param  mixed $phone
     * @param  mixed $message
     * @return void
     */
    public function saveNameInSwahili($phone, $message){
        Beneficiary::where('phone', $phone)->update(['name' => Str::after($message, 'Jina')]);
        return $this->sendSMS($phone, "Una umri wa miaka mingapi? Jibu kama ifwatavyo \"Umri 20\"");
    }

    public function saveNameInEnglish($phone, $message){
        Beneficiary::where('phone', $phone)->update(['name' => Str::after($message, 'Name')]);
        return $this->sendSMS($phone, "How old are you? Your answer should be like \"Age 20\".");
    }
    
    /**
     * saveAgeInSwahili
     *
     * @param  mixed $phone
     * @param  mixed $message
     * @return void
     */
    public function saveAgeInSwahili($phone, $message){
        Beneficiary::where('phone', $phone)->update(['age' => Str::after($message, 'Umri')]);
        return $this->sendSMS($phone, "Je, wewe ni jinsia gani? Jibu 3 kama ni ya kiume; 4 kama ya kike.");
    }

    public function saveAgeInEnglish($phone, $message){
        Beneficiary::where('phone', $phone)->update(['age' => Str::after($message,'Age')]);
        return $this->sendSMS($phone, "What is your gender? Answer 3 if male; 4 if female.");
    }

    public function saveGender($phone,$message){
        preg_match("~\b3\b~",$message) ?  
        Beneficiary::where('phone', $phone)->update(['gender' => 'male']) :
        Beneficiary::where('phone', $phone)->update(['gender' => 'female']);

        if(Beneficiary::where('phone', $phone)->pluck('language_id')->first() == 1){
            return $this->sendSMS($phone, "What is the name of the region you reside in? Answer like \"Region Kigoma\".");
        } 
        return $this->sendSMS($phone, "Unaishi mkoa gani? Jiba kama ifwatavyo: \"Mkoa Kigoma\".");   
    }

    public function saveRegionInSwahili($phone,$message){
        Beneficiary::where('phone', $phone)->update(['location' => Str::after($message, 'Mkoa')]);
        return $this->sendSMS($phone, "Asante kwa kujibu maswali yetu. 
        Chagua Zipi kati ya vifwatavyo ungependa kujua zaidi:
            \n Chagua 5 kujua zaidi kuhusu Ukatili wa kijinsia (UWAKI)
            \n Chagua 6 kujua zaidi kuhusu Ndoa za utotoni
            \n Chagua 7 kujua zaidi kuhusu Virusi vya Ukimwi
            \n Chagua 8 kujua zaidi kuhusu Mimba za utotoni"); 
    }

    public function saveRegionInEng($phone,$message){
        Beneficiary::where('phone', $phone)->update(['location' => Str::after($message, 'Region')]);
        return $this->sendSMS($phone, "Thanks for answering our questions. Choose which ones below would you like to know more about: 
            \n Choose 5 to know more about Gender based violence
            \n Choose 6 to know more about Child Marriage
            \n Choose 7 to know more about Human Immunodefiency Virus
            \n Choose 8 to know more about Teenage Pregnancy"); 
    }

}
