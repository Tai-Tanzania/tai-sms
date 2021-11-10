<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\Beneficiary;

class AuthController extends Controller
{
    public function index(){
        $messages = Message::get();
        $users = Beneficiary::get();

        return view('welcome', compact('messages','users'));
    }

    public function login(){
        return view('login');
    }

    public function getAllBeneficiaries(){
        $users = Beneficiary::get();
        return \response()->json($users, 200);
    }

    public function autheticate(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            return redirect('/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
