<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SMSController;
use App\Models\Beneficiary;

class PregnancyController extends Controller
{
    public function index($phone){
        $smsController = new SMSController();
        $user = Beneficiary::where('phone', $phone)->first();   

        if($user->language_id == 1){
            return $smsController->sendSMS($phone, "Adolescent pregnancy is a pregnancy that occurs to a adolescent girl under 20 years of age. Adolescent girls are impregnated after engaging in unprotected sexual intercourse, and, lack of relevant knowledge on reproductive health. 
            One in every four adolescent girls under 18 years is pregnant or has given birth.  
             Choose what you want to know more about: 
            \n\n TP A. Drivers to teenage pregnancy/What are the causes?
            \n\n TP B. Signs of pregnancy/ How will I know if I’m pregnant?
            \n\n TP C. Effects of teenage pregnancies/What are effect o teenage pregnancy?
            \n\n TP D. Preventive Measure of teenage pregnancies/ How can I prevent myself rom getting pregnant?");
        }

        return $smsController->sendSMS($phone, "Mimba za utotoni ni ujauzito anaoupata msichana mwenye umri chini ya miaka 20. Wasichana hupata mimba kutokana na kufanya mapenzi bila kutumia kinga na kukosa elimu sahihi ya afya uzazi.
        Msichana mmoja kati ya wanne walio chini ya miaka 18 amepata mimba au amejifungua mtoto.         
         Chagua nini unataka kujua zaidi: 
        \n\n TP A. Dalili za ujauzito/ Nitajujae kama nina ujauzito?
        \n\n TP B. Vitu gani vinaweza kupelekea kupata mimba za utotoni?
        \n\n TP C. Nitajuaje kama nina ujauzito?
        \n\n TP D. Madhara ya mimba za utototni/Mimba za utotoni zina madhara gani?"); 
    }
}
