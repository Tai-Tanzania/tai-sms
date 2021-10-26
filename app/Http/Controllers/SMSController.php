<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SMSController extends Controller
{
    public function callback(Request $request){
        if(!isset($_POST) )
        {
            return response()->json(['message' => 'Nothing'], 400);
        }else{
            $from = $request->SOURCEADDR;        
            $message = $request->MESSAGE;
            $vp = $request->VP;
            $destaddr = $request->DESTADDR;
            $sourceaddnpi = $request->SOURCEADDRNPI;
            $sourceaddrton =  $request->SOURCEADDRTON;
            
            //ADD YOUR CODE HERE

            return response()->json('Success', 200);
        }
    }
}
