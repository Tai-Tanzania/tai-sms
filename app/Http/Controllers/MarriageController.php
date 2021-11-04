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
}
