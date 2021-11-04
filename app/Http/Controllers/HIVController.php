<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SMSController;
use App\Models\Beneficiary;

class HIVController extends Controller
{
    public function index($phone){
        $smsController = new SMSController();
        $user = Beneficiary::where('phone', $phone)->first();

        if($user->language_id == 1){
            return $smsController->sendSMS($phone, "Human Immunodefiency Virus (HIV) is a retrovirus which causes AIDS. HIV targets the immune system and weakens people’s defense against many infections. Choose what you want to know more about: 
            \n HIV A. Myth about HIV
            \n HIV B. How HIV is transmitted
            \n HIV C. Effects of HIV/AIDS
            \n HIV D. Risk behaviours that may lead to HIV infection
            \n HIV E. Signs and Symptoms of HIV
            \n HIV F. HIV testing 
            \n HIV G. Preventive measures of HIV/AIDS");
        }

        return $smsController->sendSMS($phone, "Virus Vya Ukimwi (VVU) ni vimelea vinavyosababisha
         hali ya UKIMWI kwa kushambulia mfumo wa kinga ya mwili. Kinga ya mwili wa mtu inaposhuka
          husababisha mwili kushindwa kupambana na VVU na hivyo kuruhusu magonjwa nyemelezi
           kupenya kirahisi. . Chagua nini unatataka kujua zaidi kuhusu VVU: 
         \n HIV A. Imani potofu kuhusu VVU
         \n HIV B. Mtu anambukizwajie VVU?
         \n HIV C. Madhara ya HIV
         \n HIV D. Tabia hatarishi zinazopelekea maambukizi ya VVU
         \n HIV E. Upimaji virusi vya UKIMWI
         \n HIV F. Ushauri nasaha
         \n HIV G. Jinsi ya kuzuia maambukizi ya virusi vya UKIMWI");  
    }

    public function hivA($phone){
        $smsController = new SMSController();
        $user = Beneficiary::where('phone', $phone)->first();

        if($user->language_id == 1){
            return $smsController->sendSMS($phone,
            "•	Having multiple sexual partners is a sign of manhood or girls’ beauty.
            \n • HIV is for older people and not adolescents.
            \n • Not having multiple partners during my adolescence will enhance my sexual desire in my adulthood
            \n • Having multiple sexual partners is fashion (everyone is doing it)
            \n • Using protection (condom) during sexual intercourse is like eating a banana with its peel
            ");
        }

        return $smsController->sendSMS($phone,
            "•	Kuwa na wapenzi wengi ndio uanamume.
            \n • Kuwa na wapenzi wengi ni ishara ya uzuri.
            \n • VVU huwapata watu wazima na sio vijana wadogo.
            \n • Kutokuwa na wapenzi wengi nikiwa mdogo itaniongezea hamu ya mapenzi nikiwa mtu mzima.
            \n • Kuwa na wapenzi wengi ni kwenda na wakati
            \n • Kutumia kondom wakati wa kujamiiana kunapunguza raha, ni sawa na kula ndizi na ganda lake.");
    }

    public function hivB($phone){
        $smsController = new SMSController();
        $user = Beneficiary::where('phone', $phone)->first();

        if($user->language_id == 1){
            return $smsController->sendSMS($phone,
            "• Unprotected sexual intercourse with an infected partner,
            \n • Exposure to infected blood and blood products like sharing of contaminated needles, razor blades, and other injecting equipment,
            \n • Infected mother to unborn child, during child delivery, or breast feeding, and
            \n • certain body fluids like semen, and vaginal fluids from a infected person. ");
        }

        return $smsController->sendSMS($phone,
            "• VVU inawezwa kuambukizwa kwa kufanya ngono zembe na mtu anayeishi na VVU
            \n • Kwa njia ya damu yenye maambukizi au vifaa vyenye damu kama kushirikiana vifaa vyenye ncha kali kama sindano, nyembe au vinginevyo.
            \n • Maabukizi kutoka kwa mama mwenye VVU kwenda kwa mtoto ambae ajazaliwa wakati wa ujauzito, kujifungia au kunyonyesha.
            \n • Pia, baadhi ya maji maji kama vile shahawa au maji maji ya uke kutoka kwa mtu anayeishi na VVU.
            ");
    }

    public function hivC($phone){
        $smsController = new SMSController();
        $user = Beneficiary::where('phone', $phone)->first();

        if($user->language_id == 1){
            return $smsController->sendSMS($phone,
            "• A person living with HIV/AIDS may have to regularly miss school to attend clinic appointments. This can affect their educational achievement and sense of fitting in with peers
            \n • A person living with HIV/AIDS may experience cognitive challenges such as learning difficulties and memory problems. 
            \n • A person with HIV/AIDS often stigma and discrimination
            \n • A person living with HIV/AIDS experiences emotional challenges such as anger, depression etc.           
            \n • Regular illness may prevent teenagers living with HIV/AIDS from going to school regularly, making friends, learning sports and hobbies.");
        }

        return $smsController->sendSMS($phone,
            "• Utakuwa na uwezekano wa kukosa masomo kutokana na kulazimika kuhudhuria kliniki au kuwa na miadi na daktari.
            \n • Unaweza kupata changamoto kwenye masomo yako hasa katika masuala kumbukumbu ya masomo kwa kuwa VVU/UKIMWI vinaweza kuleta changamoto katika ukuaji wa ubongo
            \n • Unaweza kupata Unyanyapaa kutoka kwa jamii inayokuzunguka
            \n • Unaweza kupata changamoto mbalimbali za kihisia
            \n • UKIMWI kama magonjwa mengine unaweza kukufanya ushindwe kwenda shule kila wakati pia kupunguza kazi na shughuli ulizozoea kuzifanya mara kwa mara.");
    }

    public function hivD($phone){
        $smsController = new SMSController();
        $user = Beneficiary::where('phone', $phone)->first();

        if($user->language_id == 1){
            return $smsController->sendSMS($phone,
            "• Having unprotected sex,
            \n • Having multiple partners,
            \n • Uses of drugs and alcohol,
            \n • Incorrect and inconsistence use of protection,
            \n • Sharing sharp tools eg needles, razor blades etc.");
        }

        return $smsController->sendSMS($phone,
            "• Kushiriki ngono isiyo salama.
            \n • Kuwa na mwenza zaid ya mmoja.
            \n • Matumizi ya vilevi.
            \n • Matumizi yasiyo sahihi ya kondom.
            \n • Kuchangia vitu vyenye ncha kali. Mfano; sindano");
    }

    public function hivE($phone){
        $smsController = new SMSController();
        $user = Beneficiary::where('phone', $phone)->first();

        if($user->language_id == 1){
            return $smsController->sendSMS($phone,
            "• Swollen lymph nodes.
            \n • Intermittent fever and chills,
           \n • Rash,
           \n • Night sweats,
           \n • Intermittent muscle aches and fatigue
           \n • Sore throat");
        }

        // return $smsController->sendSMS($phone,
        //     "• Kushiriki ngono isiyo salama.
        //     \n • Kuwa na mwenza zaid ya mmoja.
        //     \n • Matumizi ya vilevi.
        //     \n • Matumizi yasiyo sahihi ya kondom.
        //     \n • Kuchangia vitu vyenye ncha kali. Mfano; sindano");
    }

}
