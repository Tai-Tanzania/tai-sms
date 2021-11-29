<?php

namespace App\Http\Controllers\Twillio;

use Illuminate\Http\Request;
use App\Http\Controllers\Twillio\WhatsappController;
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
        $waController = new WhatsappController();

        $user = Beneficiary::where('phone', $phone)->first();

        if($user->language_id == 1){
            return $waController->sendWhatsAppMessage("+".$phone, "GBV/VAC is any harmful act committed against a woman, man or child intended to harm body or psychology or dignity based on gender. Choose what you want to know more about: 
            \n 9 - Myth about GBV
            \n 10 - Misconceptions on GBV
            \n 11 - Effects of GBV & VAC?
            \n 12 - GBV indicators /What are indicators of violence against children?
            \n 13 - What to do to end gender based violence (GBV)?");
        }

        return $waController->sendWhatsAppMessage("+".$phone, "Ukatili wa kijinsia (UWAKI) ni kitendo chochote 
        cha kikatili anachofanyiwa mwanamke, mwanaume au mtoto chenye lengo la kudhuru mwili,
         saikolojia au utu wake kutokana na jinsia yake. Chagua nini unatataka kujua zaidi kuhusu UWAKI: 
         \n 9 - Dhana kuhusu UWAKI
         \n 10 - Dhana potofu kuhusu UWAKI
         \n 11 - Athari za ukatili wa kijinsia na watoto(UWAKI)
         \n 12 - Viashiria vya unyanyasai kwa watoto/Nitajuaje kama nafanyiwa UWAKI?
         \n 13 - Nianye nini kuepuka ukatili wa kijinsia na watoto (UWAKI)?");   
    }
    
    /**
     * Gender based violence option A
     *
     * @param string $phone
     * @return void
     */
    public function gbvA($phone){
        $waController = new WhatsappController();

        $user = Beneficiary::where('phone', $phone)->first();

        if($user->language_id == 1){
            return $waController->sendWhatsAppMessage("+".$phone,
            "Myth about GBV are:
            \n - Men have the right to control women behavior and discipline them,
            \n - Violence is normal and acceptable in a relationship,
            \n - Victims of violence allow to happen to them,
            \n - Only small percentage of adolescents are affected by violence,
            \n - Violence affects adolescents from poor families more than rich families,
            \n - Violence is inherently attached and therefore it is normal to few tribes, and
            \n - Adolescent girls who have been victims of violence have poor upbringing");
        }

        return $waController->sendWhatsAppMessage("+".$phone,
        "Dhana kuhusu UWAKI ni:
        \n - Mwanaume ana haki ya kudhibiti tabia za mwanamke na kumshikisha adabu
        \n - Ukatili ni jambo la kawaida na unakubalika kwenye mahusiano.
        \n - Wahanga wa UWAKI wanajitakia
        \n - Ni asilimia chache ya vijana wanaoathirika na ukatili
        \n - Ukatili huwaathiri vijana wanaotoka kwenye familia duni zaidi kuliko familia tajiri
        \n - Ukatili hurithiwa, hivyo ni kawaida kwenye makabila machache, na
        \n - Wasichana ambao wamekua wahanga wa ukatili, walikosa malezi bora.");   
    }
    
    /**
     * Gender based violence option B
     *
     * @param string $phone
     * @return void
     */
    public function gbvB($phone){
        $waController = new WhatsappController();
        $user = Beneficiary::where('phone', $phone)->first();

        if($user->language_id == 1){
            return $waController->sendWhatsAppMessage("+".$phone,
            "Misconceptions on GBV are:
            \n - If I tell someone that I\’m being abused I might be beaten or blamed,
            \n - If I tell someone that I\’m being abused they will not believe me,
            \n - If I tell someone that I\’m being abused the culprit might harm me,
            \n - If I open-up that I\’m being abused I might be disowned by my family, and
            \n - If I report to the police that I’m being abused I might end up in jail");
        }

        return $waController->sendWhatsAppMessage("+".$phone,
        "Dhana potofu kuhusu UWAKI ni:
        \n - Endapo nitamwambia mtu kwamba ninanyanyaswa nitapigwa au kulaumiwa,
        \n - Endapo nitamwambia mtu kwamba ninanyanyaswa, hakuna atakayeniamini,
        \n - Endapo nitambwambia mtu kwamba ninanyanyaswa, mkosaji anaweza kunidhuru,
        \n - Endapo nitasema kwamba ninanyanyaswa, ninaweza kutengwa na familia yangu, na
        \n - Endapo nitaripoti polisi kwamba nafanyiwa ukatili naweza kufungwa jela.");   
    }
    
    /**
     * Gender based violence option C
     *
     * @param  string $phone
     * @return void
     */
    public function gbvC($phone){
        $waController = new WhatsappController();
        $user = Beneficiary::where('phone', $phone)->first();

        if($user->language_id == 1){
            return $waController->sendWhatsAppMessage("+".$phone,
            "Effects of GBV & VAC are:
            \n - Permanent disability,
            \n - Mental health problems such as depression, anxiety,
            \n - Chronic health problems such as STDs, spread of HIV/AIDS, 
            \n - Adapting bad behaviors as a way of escaping violence such as use of alcohol,
            \n - Psychological trauma, and
            \n - Discrimination and self-isolation.");
        }

        return $waController->sendWhatsAppMessage("+".$phone,
        "Athari za ukatili wa kijinsia na watoto(UWAKI) ni:
        \n - Ulemavu wa kudumu,
        \n - Matatizo ya afya ya akili mano, hofu na msongo wa mawazo,
        \n - Matatizo sugu ya kiafya mfano, magonjwa ya zinaa, kuenea kwa UKIMWI,
        \n - Kuiga tabia hatarishi ili kukwepa changamoto za ukatili mfano matumizi ya vilevi,
        \n - Maumivu ya kisaikolojia, na
        \n - Ubaguzi na kujitenga.");   
    }
    
    /**
     * Gender based violence option D
     *
     * @param  mixed $phone
     * @return void
     */
    public function gbvD($phone){
        $waController = new WhatsappController();
        $user = Beneficiary::where('phone', $phone)->first();

        if($user->language_id == 1){
            return$waController->sendWhatsAppMessage("+".$phone,
                "GBV and violence against children indicators are:
                \n - Physical violence such as beaten, threaten with weapons etc.
                \n - Emotional violence such as being called bad names, insulted, abandoned.
                \n - Sexual violence such being raped, being touched without your consent.");
        }

        return $waController->sendWhatsAppMessage("+".$phone, 
            "Viashiria vya unyanyasai kwa watoto na UWAKI ni:
            \n- Unyanyasai wa kimwili kama kupigwa, kutishiwa vitu, n.k,
            \n - Unyanyasaji wa kihisia mano kuitwa majina, kutukanwa, kutelekezwa n.k, na
            \n - Unyanyasai wa kingono kama vile kubakwa, kushikwa bila ruhusa yako n.k.");
    }
    
    /**
     * Gender based violence option E
     *
     * @param  mixed $phone
     * @return void
     */
    public function gbvE($phone){
        $waController = new WhatsappController();
        $user = Beneficiary::where('phone', $phone)->first();

        if($user->language_id == 1){
            return $waController->sendWhatsAppMessage("+".$phone, 
                " What you can do to end gender based violence (GBV):
                \n - Tell a trusted adult (teacher, parent, religious leader) or report to the gender and children desk at the nearest police station,	
                \n - Avoid risk environment.
                \n - Avoid accepting gifts or money from people you don\’t know, as it results to abuse.
                \n - Scream to get help if someone tries to touch inappropriately or beating you.
                \n - Don’t keep any kind of Gender Based Violence a secret, you should talk to trusted adult who will take you seriously and help you, and
                \n - Keep telling trusted adults about an act of abuse until someone believes you");
        }

        return $waController->sendWhatsAppMessage("+".$phone, 
            "Nini kufanya kuepuka ukatili wa kijinsia na watoto (UWAKI):
            \n - Toa taarifa kwa mtu unayemuamini (mzazi, mwalimu, kiongozi wa dini) au dawati la jinsia kwenye kituo cha polisi kilichopo karibu,
            \n - Epuka mazingira hatarishi,
            \n - Epuka kupokea zawadi au fedha kutoka kwa mtu usiyemahamu, hii inaweza kukupelekea ukatili,
            \n - Piga kelele kuomba msaada endapo mtu atakushika isivyofaa au kukupiga,
            \n - Usifiche aina yoyote ya ukatili, zungumza na mtu unaemuamini na atakae chukua hatua, na
            \n - Endelea kuwaambia watu wazima unaowaamini kuhusu unyanyasaji hadi mtu akuamini.
            ");
    }

}
