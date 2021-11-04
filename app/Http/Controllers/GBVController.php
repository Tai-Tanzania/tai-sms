<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SMSController;
use App\Models\Beneficiary;

class GBVController extends Controller
{
    public function index(Request $request = null, $phone){
        $smsController = new SMSController();

        $user = Beneficiary::where('phone', $phone)->first();

        if($user->language_id == 1){
            return $smsController->sendSMS($phone, "GBV/VAC is any harmful act committed against a woman, man or child intended to harm body or psychology or dignity based on gender. Choose what you want to know more about: 
            \n\n I. Myth about GBV
            \n\n J. Misconceptions on GBV
            \n\n K. Effects of GBV and VAC/What are the effect of VAC?
            \n\n L. GBV/VAC indicators /What are indicators of violence against children?
            \n\n M. What to do/Call for Action What will I do I encounter violence?");
        }

        return $smsController->sendSMS($phone, "Ukatili wa kijinsia (UWAKI) ni kitendo chochote 
        cha kikatili anachofanyiwa mwanamke, mwanaume au mtoto chenye lengo la kudhuru mwili,
         saikolojia au utu wake kutokana na jinsia yake. Chagua nini unatataka kujua zaidi kuhusu UWAKI: 
         \n\n I. Imani potofu kuhusu UWAKI
         \n\n J. Dhana potofu kuhusu UWAKI
         \n\n K. Athari za UWAKI/ Kuna athari gani za UWAKI?
         \n\n L. Viashiria vya unyanyasai kwa Watoto/Nitajuaje kama nafanyiwa UWAKI?
         \n\n M. Nianye nini kuepuka UWAKI?");   
    }
}
