<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SMSController;
use App\Models\Beneficiary;

class MarriageController extends Controller
{
    public function index($phone){
        $smsController = new SMSController();
        $user = Beneficiary::where('phone', $phone)->first();   

        if($user->language_id == 1){
            return $smsController->sendSMS($phone, "Child marriage refers to any formal 
            marriage or informal union between a child under the age of 18 and an adult 
            or another child. Choose what you want to know more about: 
            \n\n CM A. What are the consequences for child marriage?
            \n\n CM B. Call for action for child marriage/ What can I do to prevent child marriage?");
        }

        return $smsController->sendSMS($phone, "Ndoa za utotoni ni muungano wa jadi, 
        dini au isiyo rasmi ambapo ama bibi au bwana harusi ni chini ya umri wa miaka 
        18. Chagua nini unatataka kujua zaidi kuhusu Ndoa za utotoni: 
         \n\n CM A. Kuna madhara gani kuolewa katika umri mdogo?
         \n\n CM B. Nifanye nini kuepuka ndoa za utotoni?");  
    }

    public function cmA($phone){
        $smsController = new SMSController();
        $user = Beneficiary::where('phone', $phone)->first();   

        if($user->language_id == 1){
            return $smsController->sendSMS($phone,
             "- Exposure to domestic and sexual violence from a husband.
            \n - Teenage/early pregnancy that might increase the chance for negative health impacts such as maternal and infant death.
            \n - School dropout which will result to lack of education
            \n - Economic dependent,
            \n - Loss of freedom and autonomous decision for the future.");
        }

        return $smsController->sendSMS($phone, 
        "- Ukatili wa kijinsia na kingono kutoka kwa mume au mke,
        \n - Mimba za utotoni zinazoweza kusababisha kifo,
        \n - Kukatisha masomo,
        \n - Kuwa tegemezi kiuchumi, na
        \n - Kukosa uhuru na kukosa fursa ya kufanya maamuzi.");  
    }

    public function cmB($phone){
        $smsController = new SMSController();
        $user = Beneficiary::where('phone', $phone)->first();   

        if($user->language_id == 1){
            return $smsController->sendSMS($phone,
             "- Focus should be on education and your wellbeing and not marriage.
             \n - As soon as you encounter or see any adolescent girl being forced to marriage report to relevant authorities such as gender desk, social welfare officer and others.
             \n - Speak out against child marriage to your family and the community.");
        }

        return $smsController->sendSMS($phone, 
        "- Zingatia zaidi elimu (masomo) na afya yako.
        \n - Toa taaria kwenye dawati la insia kwenye kituo chochoe cha polisi, afisa ustawi wa jamii, mwalimu au mtu unaemuamini endapo utalazimishwa kuolewa.
        \n - Paza sauti kwa familia yako na jamii kukataa ndoa za utotoni");  
    }
}
