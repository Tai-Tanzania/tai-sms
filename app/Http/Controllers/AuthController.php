<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        return view('dashboard.index');
    }

    public function logout(){
        return \redirect('/');
    }
}
