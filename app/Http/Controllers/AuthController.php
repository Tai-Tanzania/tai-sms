<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\Beneficiary;

class AuthController extends Controller
{
    public function index(){
        $messages = Message::all();
        $users = Beneficiary::all();

        return view('welcome', compact('messages','users'));
    }

    public function login(){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(){
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');

    }
}
