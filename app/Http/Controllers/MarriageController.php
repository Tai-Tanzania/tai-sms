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
            return $smsController->sendSMS($phone, "Child marriage refers to any formal marriage or informal union between a child under the age of 18 and an adult or another child. Choose what you want to know more about: 
            \n 21 - What are the consequences for child marriage?
            \n 22 - Call for action for child marriage/ What can I do to prevent child marriage?");
        }

        return $smsController->sendSMS($phone, "Ndoa za utotoni inarejelea ndoa yoyote rasmi au muungano usio rasmi kati ya mtoto aliye chini ya umri wa miaka 18 na mtu mzima au mtoto mwingine. Chagua nini unatataka kujua zaidi kuhusu Ndoa za utotoni: 
         \n 21 - Yapi ni madhara ya ndoa za utotoni?
         \n 22 - Nifanye nini kuzuia ndoa za utotoni?");  
    }

    public function cmA($phone){
        $smsController = new SMSController();
        $user = Beneficiary::where('phone', $phone)->first();   

        if($user->language_id == 1){
            return $smsController->sendSMS($phone,
             "consequences for child marriage are such as:
            \n - Exposure to domestic and sexual violence from a husband.
            \n - Teenage pregnancy that might increase the chance for negative health impacts such as maternal and infant death.
            \n - Lack of education due to school dropout
            \n - Economic dependent, and
            \n - Loss of freedom and autonomous decision.");
        }

        return $smsController->sendSMS($phone, 
        "madhara ya ndoa za utotoni ni kama:
        \n - Unyanyasaji wa majumbani na kingono kutoka kwa mume.
        \n - Mimba za utotoni zinazoweza kuongeza athari mbaya kiafya kama vile kifo cha mama na mtoto,
        \n - Ukosefu wa elimu kwa sababu ya kuacha shule
        \n - Kuwa tegemezi kiuchumi, na
        \n - Kukosa uhuru na uamuzi binafsi.");  
    }

    public function cmB($phone){
        $smsController = new SMSController();
        $user = Beneficiary::where('phone', $phone)->first();   

        if($user->language_id == 1){
            return $smsController->sendSMS($phone,
             "What i can  do to prevent child marriage:
             \n - Focus should be on education and your wellbeing and not marriage.
             \n - As soon as you encounter or see any adolescent girl being forced to marriage report to relevant authorities such as gender desk, social welfare officer and others.
             \n - Speak out against child marriage to your family and the community.");
        }

        return $smsController->sendSMS($phone, 
        "Nini nifanye kuzuia ndoa za utotoni:
        \n - Zingatia elimu na ustawi wako na sio ndoa.
        \n - Toa taaria kwenye dawati la jinsia kwenye kituo chochote cha polisi, afisa ustawi wa jamii, endapo utalazimishwa kuolewa au kuona binti analazimishwa kuolewa.
        \n - Paza sauti kwa familia yako na jamii kukataa ndoa za utotoni");  
    }
}
