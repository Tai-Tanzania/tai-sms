<?php

namespace App\Http\Controllers\Twillio;

use Illuminate\Http\Request;
use App\Http\Controllers\Twillio\WhatsappController;
use App\Models\Beneficiary;

class HIVController extends Controller
{
    public function index($phone){
        $waController = new WhatsappController();
        $user = Beneficiary::where('phone', $phone)->first();

        if($user->language_id == 1){
            return $waController->sendWhatsAppMessage("+".$phone, "HIV is a parasite that causes AIDS by attacking the body\'s immune system. When a person's immune system is weakened it causes the body to fail to fight HIV and thus allow opportunistic infections to penetrate more easily. Choose what you want to know more about: 
            \n 14 -  Myth and misconceptions about HIV
            \n 15 - How HIV is transmitted
            \n 16 - Effects of HIV/AIDS
            \n 17 - Risk behaviours that may lead to HIV infection
            \n 18 - Signs and Symptoms of HIV
            \n 19 - HIV/AIDS testing 
            \n 20 - Preventive measures of HIV/AIDS");
        }

        return $waController->sendWhatsAppMessage("+".$phone, "VVU ni vimelea vinavyosababisha hali ya UKIMWI kwa kushambulia mfumo wa kinga ya mwili. Kinga ya mwili wa mtu inaposhuka husababisha mwili kushindwa kupambana na VVU na hivyo kuruhusu magonjwa nyemelezi kupenya kirahisi. Chagua nini unatataka kujua zaidi kuhusu VVU: 
         \n 14 - Imani potofu kuhusu VVU
         \n 15 - Mtu anambukizwajie VVU?
         \n 16 - Madhara ya Ukimwi
         \n 17 - Tabia hatarishi zinazopelekea maambukizi ya VVU
         \n 18 - Ishara na dalili za VVU/UKIMWI
         \n 19 - Upimaji wa VVU/UKIMWI
         \n 20 - Jinsi ya kuzuia maambukizi ya virusi vya UKIMWI");  
    }

    public function hivA($phone){
        $waController = new WhatsappController();
        $user = Beneficiary::where('phone', $phone)->first();

        if($user->language_id == 1){
            return $waController->sendWhatsAppMessage("+".$phone,
            "Myth and misconceptions about HIV are:
            \n - Having multiple sexual partners is a sign of manhood or girls\’ beauty.
            \n - HIV is for older people and not adolescents.
            \n - Not having multiple partners during my adolescence will enhance my sexual desire in my adulthood
            \n - Having multiple sexual partners is fashion (everyone is doing it)
            \n - Using protection (condom) during sexual intercourse is like eating a banana with its peel
            ");
        }

        return $waController->sendWhatsAppMessage("+".$phone,
            " Imani potofu kuhusu VVU ni kama:
            \n - Kuwa na wapenzi wengi ndio uanamume au uzuri wa msichana.
            \n - VVU huwapata watu wazima na sio vijana wa rika barehe.
            \n - Kutokuwa na wapenzi wengi nikiwa mdogo itaniongezea hamu ya mapenzi nikiwa mtu mzima.
            \n - Kuwa na wapenzi wengi ni kwenda na wakati (kila mtu anafanya hivyo).
            \n - Kutumia kondom wakati wa kujamiiana ni sawa na kula ndizi na ganda lake.");
    }

    public function hivB($phone){
        $waController = new WhatsappController();
        $user = Beneficiary::where('phone', $phone)->first();

        if($user->language_id == 1){
            return $waController->sendWhatsAppMessage("+".$phone,
            "HIV is transmitted through:
            \n - Unprotected sexual intercourse with an infected partner,
            \n - Exposure to infected blood and blood products like sharing of contaminated needles, razor blades, and other injecting equipment,
            \n - Infection from an HIV-positive mother to a baby born during pregnancy, childbirth or breastfeeding.
            \n - Certain body fluids like semen, and vaginal fluids from an infected person. ");
        }

        return $waController->sendWhatsAppMessage("+".$phone,
            "Mtu anambukizwa VVU kupitia:
            \n - VVU inawezwa kuambukizwa kwa kufanya ngono zembe na mtu anayeishi na VVU
            \n - Kwa njia ya damu yenye maambukizi ya VVU au vifaa vyenye damu ya maambukizi ya VVU kama kushirikiana vifaa vyenye ncha kali kama sindano, nyembe au vinginevyo.
            \n - Maambukizi kutoka kwa mama mwenye VVU kwenda kwa mtoto ambae ajazaliwa wakati wa ujauzito, kujifungua au kunyonyesha.
            \n - Majimaji fulani ya mwili kama shahawa, na maji maji ya ukeni kutoka kwa mtu aliyeambukizwa.
            ");
    }

    public function hivC($phone){
        $waController = new WhatsappController();
        $user = Beneficiary::where('phone', $phone)->first();

        if($user->language_id == 1){
            return $waController->sendWhatsAppMessage("+".$phone,
            "Effects of HIV/AIDS are:
            \n - A person living with HIV/AIDS may have to regularly miss school to attend clinic appointments. This can affect their educational achievement and sense of fitting in with peers.
            \n - A person living with HIV/AIDS may experience cognitive challenges such as learning difficulties and memory problems. 
            \n - A person with HIV/AIDS often stigmatized and discriminated
            \n - A person living with HIV/AIDS experiences emotional challenges such as anger, depression etc.           
            \n - Regular illness may prevent teenagers living with HIV/AIDS from going to school regularly, making friends, learning sports and hobbies.");
        }

        return $waController->sendWhatsAppMessage("+".$phone,
            "Madhara ya Ukimwi ni kama:
            \n - Mtu anayeishi VVU/UKIMWI anaweza kukosa masomo mara kwa mara kutokana na kulazimika kuhudhuria kliniki au kuwa na miadi na daktari.
            \n - Mtu anayeishi na VVU/UKIMWI anaweza kupata changamoto za kiakili kama vile matatizo ya kujifunza na matatizo ya kumbukumbu.
            \n - Mtu aliye na VVU/UKIMWI mara nyingi hunyanyapaliwa na kubaguliwa.
            \n - Mtu anayeishi na VVU/UKIMWI hupata changamoto za kihisia kama vile hasira, mfadhaiko, n.k.
            \n - Magonjwa ya mara kwa mara yanaweza kuwazuia vijana wanaoishi na VVU/UKIMWI kwenda shule mara kwa mara, kupata marafiki, kujifunza michezo na mambo wanayoyapenda.");
    }

    public function hivD($phone){
        $waController = new WhatsappController();
        $user = Beneficiary::where('phone', $phone)->first();

        if($user->language_id == 1){
            return $waController->sendWhatsAppMessage("+".$phone,
            "Risk behaviours that may lead to HIV infection are such as:
            \n - Having unprotected sex,
            \n - Having multiple partners,
            \n - Uses of drugs and alcohol,
            \n - Incorrect and inconsistence use of condom,
            \n - Sharing sharp tools eg needles, razor blades etc.");
        }

        return $waController->sendWhatsAppMessage("+".$phone,
            "Tabia hatarishi zinazopelekea maambukizi ya VVU ni kama
            \n - Kufanya ngono bila kinga.
            \n - Kuwa na mwenza zaidi ya mmoja.
            \n - Matumizi ya madawa ya kulevya na pombe.
            \n - Matumizi yasiyo sahihi ya kondomu.
            \n - Kuchangia vitu vyenye ncha kali. Mfano; sindano, wembe n.k.");
    }

    public function hivE($phone){
        $waController = new WhatsappController();
        $user = Beneficiary::where('phone', $phone)->first();

        if($user->language_id == 1){
            return $waController->sendWhatsAppMessage("+".$phone,
            "Signs and Symptoms of HIV are:
           \n - Intermittent fever and chills.
           \n - Rashes,
           \n - Night sweats,
           \n - Intermittent muscle aches and fatigue
           \n - Sore throat");
        }

         return $waController->sendWhatsAppMessage("+".$phone,
             "Ishara na dalili za VVU/UKIMWI ni kama:
             \n - Homa na baridi ya mara kwa mara,
             \n - Vipele mwilini
             \n - Kutokwa na jasho usiku
             \n - Maumivu ya misuli ya hapa na pale na uchovu
             \n - Kuuma koo.");
    }

    public function hivF($phone){
        $waController = new WhatsappController();
        $user = Beneficiary::where('phone', $phone)->first();

        if ($user->language_id ==1){
            return $waController->sendWhatsAppMessage("+".$phone,
            " About HIV/AIDS testing:
            \n - HIV testing services (HTS) are the gateway to access HIV care, treatment, prevention, and support services.
                 These services are free and voluntary and can be accessed in health care centers.");
        }

        return $waController->sendWhatsAppMessage("+".$phone,
        "Kuhusu Upimaji wa VVU/UKIMWI:
        \n - Huduma za kupima VVU ni lango la kupata huduma za matunzo, matibabu, kinga na usaidizi wa VVU. 
             Huduma hizi ni za bure na za hiari na zinaweza kupatikana katika vituo vya huduma za afya.");

    }

    public function hivG($phone){
        $waController = new WhatsappController();
        $user = Beneficiary::where('phone', $phone)->first();

        if ($user->language_id ==1){
            return $waController->sendWhatsAppMessage("+".$phone,
            "Preventive measures of HIV/AIDS:
           \n - Abstain from sex at a young age,
           \n - Use condoms correctly and consistently
           \n - Avoid being influenced by peer pressure on sexual practices, alcohol, and drug use.
           \n - Open up and seek advice from trusted persons such as parents, teachers, health workers, religious leaders, etc.
           \n - Avoid watching sexually arousing content.
           \n - Avoid sharing sharp objects such as razor blades, needles, etc.
           \n - Use of antiretroviral drugs (ARVs) for prevention
           \n - Elimination of mother-to-child transmission of HIV.");
        }

        return $waController->sendWhatsAppMessage("+".$phone,
        "Jinsi ya kuzuia maambukizi ya virusi vya UKIMWI:
       \n - Epuka ngono katika uri mdogo
       \n - Tumia kondomu kwa usahihi na kwa uthabiti
       \n - Epuka kuathiriwa na shinikizo rika juu ya vitendo vya ngono zembe, pombe, na matumizi ya madawa ya kulevya.
       \n - Funguka na tafuta ushauri kutoka kwa watu unaowaamini kama vile wazazi/walezi, waalimu, wahudumu wa afya n.k.
       \n - Epuka kutazama maudhui yanayoamsha hisia za kufanya ngono.
       \n - Epuka kuchangia vitu vyenye ncha kali kama vile wembe, sindano, n.k.
       \n - Matumizi ya dawa ya kuimalisha seli za damu na kurefusha maisha (ARV).
       \n - Kutokomeza maambukizi ya VVU kutoka kwa mama mwenye VVU kwenda kwa mtoto.");
    }

}
