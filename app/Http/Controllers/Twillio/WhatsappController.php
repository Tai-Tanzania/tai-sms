<?php

namespace App\Http\Controllers\Twillio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Twillio\GBVController;
use App\Http\Controllers\Twillio\HIVController;
use App\Http\Controllers\Twillio\MarriageController;
use App\Http\Controllers\Twillio\PregnancyController;

class WhatsappController extends Controller
{
    public function sendWhatsAppMessage(string $recipient, string $message)
    {
        $twilio_whatsapp_number = env('TWILIO_WHATSAPP_NUMBER');
        $account_sid = env("TWILIO_SID");
        $auth_token = env("TWILIO_AUTH_TOKEN");

        $client = new Client($account_sid, $auth_token);
        return $client->messages->create($recipient, array('from' => "whatsapp:$twilio_whatsapp_number", 'body' => $message));
    }
    
    public function listenToReplies(Request $request)
    {
        $phone = ltrim($request->input('From'),'+');
        $message = $request->input('Body');

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
                'transaction_id' => \time(),
                'beneficiary_id' => $b->id
            ]);

            if($checkIfGreetingEnglish){
                $b->update(['language_id' => 1]);
                return $this->sendWhatsAppMessage("+".$phone, "Greetings! Welcome to Tai SMS portal. Type 1 to communicate in English or 2 to communicate in Swahili.");
            }

            if($checkIfGreetingSwahili){
                $b->update(['language_id' => 2]);
                return $this->sendWhatsAppMessage("+".$phone, "Karibu kwenye mfumo wa SMS wa Tai Tanzania. Jibu 1 kupata majibu kwa Kiingereza au 2 kupata majibu kwa Kiswahili.");
            }

            //send greeting SMS
            return $this->sendWhatsAppMessage("+".$phone, "Karibu kwenye mfumo wa SMS wa Tai Tanzania. Jibu 1 kupata majibu kwa Kiingereza au 2 kupata majibu kwa Kiswahili.");
        }


        //language check
        $checkIfEnglishIsSelected = preg_match("~\b1\b~",$message);
        $checkIfSwahiliIsSelected = preg_match("~\b2\b~",$message);

        $checkENG = Str::startsWith($message, ['ENG']);
        $checkSW = Str::startsWith($message, ['SW']);

        if($checkENG){
            Beneficiary::where('phone', $phone)->update(['language_id' => 1]);
            return $this->sendWhatsAppMessage("+".$phone, "You have selected English as your langague. Choose which ones below would you like to know more about: 
            \n Choose 5 to know more about Gender based violence
            \n Choose 6 to know more about Child Marriage
            \n Choose 7 to know more about Human Immunodefiency Virus
            \n Choose 8 to know more about Teenage Pregnancy
            \n\n To Change Language, text ENG for English language or SW for Swahili language.");
        }

        if($checkSW){
            Beneficiary::where('phone', $phone)->update(['language_id' => 2]);
            return $this->sendWhatsAppMessage("+".$phone, "Umechagua Kiswahili kama lugha yako.  Chagua kati ya mada zipi unataka kujua zaidi:
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
            return $this->sendWhatsAppMessage("+".$phone, "You have chosen English as your language of choice. What is your name? Please type like the following \"Name Jacob Abdallah\"");
        }

        if($checkIfSwahiliIsSelected){
            Beneficiary::where('phone', $phone)->update(['language_id' => 2]);
            return $this->sendWhatsAppMessage("+".$phone, "Umechagua Swahili kama lugha yako. Je, kwa jina unaitwa nani? Anza kuandika jina lako kama kwa mfano \"Jina Jacob Abdallah\"");
        }

        if($checkIfGreetingEnglish){
            Beneficiary::where('phone', $phone)->update(['language_id' => 1]);
            return $this->sendWhatsAppMessage("+".$phone, "Greetings! Welcome back to Tai SMS portal. Choose which ones below would you like to know more about: 
            \n Choose 5 to know more about Gender based violence
            \n Choose 6 to know more about Child Marriage
            \n Choose 7 to know more about Human Immunodefiency Virus
            \n Choose 8 to know more about Teenage Pregnancy
            \n\n To Change Language, text ENG for English language or SW for Swahili language.
            ");
        }

        if($checkIfGreetingSwahili){
            Beneficiary::where('phone', $phone)->update(['language_id' => 2]);
            return $this->sendWhatsAppMessage("+".$phone, "Karibu tena kwenye mfumo wa SMS wa Tai Tanzania. Chagua kati ya mada zipi unataka kujua zaidi:
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
                return $this->sendWhatsAppMessage("+".$phone, "Karibu tena kwenye mfumo wa SMS wa Tai Tanzania. Chagua kati ya mada zipi unataka kujua zaidi:
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
        return $this->sendWhatsAppMessage("+".$phone, "Una umri wa miaka mingapi? Jibu kama ifwatavyo \"Umri 20\"");
    }

    public function saveNameInEnglish($phone, $message){
        Beneficiary::where('phone', $phone)->update(['name' => Str::after($message, 'Name')]);
        return $this->sendWhatsAppMessage("+".$phone, "How old are you? Your answer should be like \"Age 20\".");
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
        return $this->sendWhatsAppMessage("+".$phone, "Je, wewe ni jinsia gani? Jibu 3 kama ni ya kiume; 4 kama ya kike.");
    }

    public function saveAgeInEnglish($phone, $message){
        Beneficiary::where('phone', $phone)->update(['age' => Str::after($message,'Age')]);
        return $this->sendWhatsAppMessage("+".$phone, "What is your gender? Answer 3 if male; 4 if female.");
    }

    public function saveGender($phone,$message){
        preg_match("~\b3\b~",$message) ?  
        Beneficiary::where('phone', $phone)->update(['gender' => 'male']) :
        Beneficiary::where('phone', $phone)->update(['gender' => 'female']);

        if(Beneficiary::where('phone', $phone)->pluck('language_id')->first() == 1){
            return $this->sendWhatsAppMessage("+".$phone, "What is the name of the region you reside in? Answer like \"Region Kigoma\".");
        } 
        return $this->sendWhatsAppMessage("+".$phone, "Unaishi mkoa gani? Jiba kama ifwatavyo: \"Mkoa Kigoma\".");   
    }

    public function saveRegionInSwahili($phone,$message){
        Beneficiary::where('phone', $phone)->update(['location' => Str::after($message, 'Mkoa')]);
        return $this->sendWhatsAppMessage("+".$phone, "Asante kwa kujibu maswali yetu. 
        Chagua Zipi kati ya vifwatavyo ungependa kujua zaidi:
            \n Chagua 5 kujua zaidi kuhusu Ukatili wa kijinsia (UWAKI)
            \n Chagua 6 kujua zaidi kuhusu Ndoa za utotoni
            \n Chagua 7 kujua zaidi kuhusu Virusi vya Ukimwi
            \n Chagua 8 kujua zaidi kuhusu Mimba za utotoni"); 
    }

    public function saveRegionInEng($phone,$message){
        Beneficiary::where('phone', $phone)->update(['location' => Str::after($message, 'Region')]);
        return $this->sendWhatsAppMessage("+".$phone, "Thanks for answering our questions. Choose which ones below would you like to know more about: 
            \n Choose 5 to know more about Gender based violence
            \n Choose 6 to know more about Child Marriage
            \n Choose 7 to know more about Human Immunodefiency Virus
            \n Choose 8 to know more about Teenage Pregnancy"); 
    }

    
}
