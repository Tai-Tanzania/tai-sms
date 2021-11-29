<?php

namespace App\Http\Controllers\Twillio;

use Illuminate\Http\Request;
use App\Http\Controllers\Twillio\WhatsappController;
use App\Models\Beneficiary;

class PregnancyController extends Controller
{
    public function index($phone){
        $waController = new WhatsappController();
        $user = Beneficiary::where('phone', $phone)->first();   

        if($user->language_id == 1){
            return $waController->sendWhatsAppMessage("+".$phone, "Teenage pregnancy  occurs to adolescent girl under 20 years of age. 
             Statistics shows that, one in every four adolescent girls under 18 years is pregnant or has given birth.    
             Choose what you want to know more about: 
            \n 23 - Drivers to teenage pregnancy.
            \n 24 - Signs of pregnancy/ How will I know if I\’m pregnant?
            \n 25 - Effects of teenage pregnancies.
            \n 26 - Preventive Measures of teenage pregnancies/ How can I prevent myself rom getting pregnant?");
        }

        return $waController->sendWhatsAppMessage("+".$phone, "Mimba za utotoni kutokea pale msichana wenye umri chini ya miaka 18.
         Takwimu zinaonesha katika wasichana wanne wenye umri chini ya miaka 18 mmoja huwa ni mjamzito au tayari ameshazaa.         
         Chagua nini unataka kujua zaidi: 
        \n 23 - Vitu gani vinaweza kupelekea kupata mimba za utotoni?
        \n 24 - Dalili za ujauzito/ Nitajujae kama nina ujauzito?
        \n 25 - Madhara ya mimba za utotoni
        \n 26 - Jinsi ya kuzuia mimba za utotoni/ Ninawezaje kuepuka mimba za utotoni?"); 
    }


    public function pcA($phone){
         $waController = new WhatsappController();
        $user = Beneficiary::where('phone', $phone)->first();   

        if($user->language_id == 1){
            return $waController->sendWhatsAppMessage("+".$phone,
             "Drivers to teenage pregnancy:
             \n - Lack of information about sexual and reproductive health
             \n - Family and community pressure that lead to early marriage,
             \n - School dropout,
             \n - Sexual violence or child rape,
             \n - Poverty,
             \n - Unprotected sex
             \n - Exposure to risk environment,
             \n - Peer pressure, and
             \n - Poor traditions and taboos for example; Not discussing about sexual reproductive health with a parent");
        }

        return $waController->sendWhatsAppMessage("+".$phone, 
        "Vitu vinavyopelekea kupata mimba za utotoni:
        \n - Kukosa elimu ya afya ya uzazi
        \n - Shinikizo la familia na jamii kuolewa katika umri mdogo,
        \n - Kukatisha masomo,
        \n - Ukatili wa kingono au kubakwa,
        \n - Umasikini, 
        \n - Ngono zembe katika umri mdogo,
        \n - Mazingira hatarishi
        \n - Shinikizo rika na
        \n - Mila na desturi potofu mfano kutokuongelea masuala ya afya ya uzazi na mzazi.");  
    }


    public function pcB($phone){
         $waController = new WhatsappController();
        $user = Beneficiary::where('phone', $phone)->first();   

        if($user->language_id == 1){
            return $waController->sendWhatsAppMessage("+".$phone,
             "Signs of pregnancy are:
             \n - Missed or very light menstrual period,
             \n - Breast tenderness,
             \n - Nausea or vomiting, often in the morning,
             \n - Feeling dizzy and fainting,
             \n - Weight gain,
             \n - Feeling tired, and
             \n - Swollen abdomen/belly");
        }

        return $waController->sendWhatsAppMessage("+".$phone, 
        "Dalili za utoto ni: \n
         - Kutoona siku zako za hedhi au kupata hedhi yam matone matone,
       \n - Matiti kuongezeka ukubwa na wakati mwingine yanauma,
       \n - Kichefuchefu au kutapika na mara nyingi asubuhi,
       \n - Kuhisi kizunguzungu na/au kuzimia,
       \n - Mwili kuongezeka uzito, 
       \n - Kuhisi uchovu, na
       \n - Tumbo kuongezeka na kuwa kubwa.");  
    }


    public function pcC($phone){
         $waController = new WhatsappController();
        $user = Beneficiary::where('phone', $phone)->first();   

        if($user->language_id == 1){
            return $waController->sendWhatsAppMessage("+".$phone,
             " Effects of teenage pregnancies are:
             \n - High risk of Infant and maternal mortality
             \n - High chances of premature infants
             \n - High chances of getting eclampsia which might lead to death.
             \n - High chances of getting fistula.
             \n - Heavy bleeding and severe rupture during childbirth. 
             \n - Severe chronic pain or infertility due to immature reproductive organs.
             \n - School dropout.");
        }

        return $waController->sendWhatsAppMessage("+".$phone, 
        "Madhara ya mimba za utotoni ni:
         \n - Unahatarisha uhai wako pamoja na wa mtoto,
         \n - Kuna uwezekano mkubwa wa mtoto kuzaliwa njiti,
         \n - Kupata kifafa cha mimba ambacho huweza kusababisha kifo cha mama na/au mtoto,
         \n - Uwezekano mkubwa wa kupata tatizo la fistula,
         \n - Kutokwa damu nyingi na kuchanika sana wakati wa kujifungua,
         \n - Kupata uchungu wa muda mrefu au kushindwa kujifungua kutokana na viungo vya uzazi/ nyonga kutokukomaa,
         \n - Uwezekano mkubwa wa kukatiza masomo.");  
    }


    public function pcD($phone){
         $waController = new WhatsappController();
        $user = Beneficiary::where('phone', $phone)->first();   

        if($user->language_id == 1){
            return $waController->sendWhatsAppMessage("+".$phone,
             "Preventive Measures of teenage pregnancies:
             \n - Seek right information on sexual reproductive health in health centers. 
             \n - Open up to a trusted person such as parent, health care provider etc. 
             \n - Avoid being tempted with luxurious goods such as money, transport lifts, mobile phones etc.
             \n - Avoid the use of alcohol and illicit drugs which may lead to unsafe sex. 
             \n - Keep good company and avoid peer pressure. 
             \n - Seek help when being raped or forced to get married at young age. 
             \n - Avoid unprotected sex. 
             ");
        }

        return $waController->sendWhatsAppMessage("+".$phone, 
        "Jinsi ya kuzuia mimba za utotoni:
        \n - Tafuta taarifa sahihi kuhusu afya ya uzazi kutoka kwenye kituo cha afya,
        \n - Kuwa huru kuongea na mtu unaemuamini mfano mzazi au mtaalamu wa afya,
        \n - Epuka tamaa ya vitu mfano pesa, lifti n.k,
        \n - Epuka matumizi ya vilevi yanayochochea kufanya ngono zembe,
        \n - Kuwa na marafiki wazuri,
        \n - Toa taarifa kwenye dawati la jinsia au kituo cha polisi  endapo utapata tishio la kubakwa, utabakwa au kulazimishwa kuolewa, na
        \n - Epuka ngono zembe.");  
    }


}
