<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SMSController;
use App\Models\Beneficiary;

class GBVController extends Controller
{    
    /**
     * index
     *
     * @param  string $phone
     * @return void
     */
    public function index($phone){
        $smsController = new SMSController();

        $user = Beneficiary::where('phone', $phone)->first();

        if($user->language_id == 1){
            return $smsController->sendSMS($phone, "GBV/VAC is any harmful act committed against a woman, man or child intended to harm body or psychology or dignity based on gender. Choose what you want to know more about: 
            \n GBV A - Myth about GBV
            \n GBV B - Misconceptions on GBV
            \n GBV C - Effects of GBV and VAC/What are the effect of VAC?
            \n GBV D - GBV/VAC indicators /What are indicators of violence against children?
            \n GBV E - What to do/Call for Action What will I do I encounter violence?");
        }

        return $smsController->sendSMS($phone, "Ukatili wa kijinsia (UWAKI) ni kitendo chochote 
        cha kikatili anachofanyiwa mwanamke, mwanaume au mtoto chenye lengo la kudhuru mwili,
         saikolojia au utu wake kutokana na jinsia yake. Chagua nini unatataka kujua zaidi kuhusu UWAKI: 
         \n GBV A - Imani potofu kuhusu UWAKI
         \n GBV B - Dhana potofu kuhusu UWAKI
         \n GBV C - Athari za UWAKI/ Kuna athari gani za UWAKI?
         \n GBV D - Viashiria vya unyanyasai kwa Watoto/Nitajuaje kama nafanyiwa UWAKI?
         \n GBV E - Nianye nini kuepuka UWAKI?");   
    }
    
    /**
     * Gender based violence option A
     *
     * @param string $phone
     * @return void
     */
    public function gbvA($phone){
        $smsController = new SMSController();

        $user = Beneficiary::where('phone', $phone)->first();

        if($user->language_id == 1){
            return $smsController->sendSMS($phone, 
            "- Men have the right to control women behavior and discipline them,
            \n - Violence is normal and acceptable in a relationship,
            \n - Victims of violence allow to happen to them,
            \n - Only small percentage of adolescents are affected by violence,
            \n - Violence affects adolescents from poor families more than rich families,
            \n - Violence is inherently attached and therefore it is normal to specific tribes, and
            \n - Adolescent girls who have been victims of violence have poor upbringing");
        }

        return $smsController->sendSMS($phone, 
        "- Mwanaume ana haki ya kudhibiti tabia za mwanamke na kumshikisha adabu
        \n - Mwanamke kupigwa na mpenzi wake ni jambo la kawaida kwenye mahusiano
        \n - Wahanga wa UWAKI wanajitakia
        \n - Ni asilimia chache ya wavulana na wasichana wanaoathirika na UWAKI
        \n - UWAKI huwaathiri wasichana na wavulana wanaotoka kwenye familia masikini zaidi kuliko familia tajiri");   
    }
    
    /**
     * Gender based violence option B
     *
     * @param string $phone
     * @return void
     */
    public function gbvB($phone){
        $smsController = new SMSController();
        $user = Beneficiary::where('phone', $phone)->first();

        if($user->language_id == 1){
            return $smsController->sendSMS($phone, 
            "- If I tell someone that I’m being abused I might be beaten or blamed,
            \n - If I tell someone that I’m being abused they will not believe me,
            \n - If I tell someone that I’m being abused the culprit might harm me,
            \n - If I open-up that I’m being abused I might be disowned by my family, and
            \n - If I open-up to the police that I’m being abused I might end up in jail");
        }

        return $smsController->sendSMS($phone, 
        " - Endapo nitamwambia mtu kwamba nimebakwa, kupigwa au kunyanyaswa nitachekwa, kulaumiwa au kupigwa.
        \n - Endapo nitamueleza mtu kwamba nimenyanyaswa, kubakwa au kudhulumiwa hakuna atakayeniamini.
        \n - Endapo nitamwambia mtu kwamba ninanyanyaswa, kufanyishwa kazi, kutengwa, kutopewa mahitaji muhimu nitafukuzwa nyumbani
        \n - Endapo nitaripoti polisi kwamba nafanyiwa UWAKI naweza kufungwa jela.");   
    }
    
    /**
     * Gender based violence option C
     *
     * @param  string $phone
     * @return void
     */
    public function gbvC($phone){
        $smsController = new SMSController();
        $user = Beneficiary::where('phone', $phone)->first();

        if($user->language_id == 1){
            return $smsController->sendSMS($phone, 
            "- Permanent disability,
            \n - Mental health problems such as depression, anxiety,
            \n - Chronic health problems such as STDs, spread of HIV/AIDS, 
            \n - Adapting bad behaviors as a way of escaping GBV/VAC such as use of alcohol,
            \n - Psychological trauma, and
            \n - Discrimination and self-isolation.");
        }

        return $smsController->sendSMS($phone, 
        "-	Ulemavu wa kudumu,
        \n - Matatizo ya afya ya akili mano, hofu na msongo wa mawazo,
        \n - Matatizo sugu ya kiafya mfano, magonwa ya zinaa ana UKIMWI,
        \n - Kuiga tabia hatarishi ili kuendana na changamoto za UWAKI mfano matumizi ya vilevi,
        \n - Kumbukumbu mbaya, na
        \n - Kutengwa na kujitenga.");   
    }
    
    /**
     * Gender based violence option D
     *
     * @param  mixed $phone
     * @return void
     */
    public function gbvD($phone){
        $smsController = new SMSController();
        $user = Beneficiary::where('phone', $phone)->first();

        if($user->language_id == 1){
            return $smsController->sendSMS($phone, 
                "- Physical violence such as beaten, kicked, threaten with weapons etc.
                \n - Emotional violence such as being called bad names, insulted, abandoned.
                \n - Sexual violence such being raped, being touched without your consent.");
        }

        return $smsController->sendSMS($phone, 
            "- Unyanyasai wa kimwili kama kupigwa, kutishiwa vitu, kunyimwa chakula n.k,
            \n - Unyanyasaji wa kihisia mano kuitwa majina, kutukanwa, kutelekezwa n.k, na
            \n - Unyanyasai wa kingono mano, kubakwa, kushikwa bila ruhusa yako n.k.");
    }
    
    /**
     * Gender based violence option E
     *
     * @param  mixed $phone
     * @return void
     */
    public function gbvE($phone){
        $smsController = new SMSController();
        $user = Beneficiary::where('phone', $phone)->first();

        if($user->language_id == 1){
            return $smsController->sendSMS($phone, 
                "- Tell a trusted adult (teacher, health worker, social worker, counsellor, religious leader) report to the gender and children desk at the nearest police station	
                \n - Avoid risk environment.
                \n - Avoid accepting gifts or money from people you don’t know, as it results to abuse.
                \n - You can scream and shout to get help if someone tries to touch inappropriately or beating you.
                \n - Don’t keep any kind of Gender Based Violence a secret, you should talk to trusted adult who will take you seriously and help you.
                \n - Keep telling trusted adults about an act of abuse until someone believes you");
        }

        return $smsController->sendSMS($phone, 
            "- Toa taarifa kwa mzazi, mwalimu, kiongozi, dawati la insia au kwa afisa ustawi wa jamii,
            \n - Epuka mazingira hatarishi,
            \n - Epuka kupokea zawadi au fedha kutoka kwa mtu usiyemahamu,
            \n - Piga kelele kuomba msaada endapo mtu atakushika isivyofaa mfaano, matiti au sehemu za siri, na
            \n - Usifiche aina yoyote ya ukatili, zungumza na mtu unaemuamini na atakae chukua hatua.
            ");
    }

}
