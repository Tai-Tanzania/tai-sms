<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Beneficiary;

class DashboardController extends Controller
{
    public function index(){
        $messages = Message::all();
        $users = Beneficiary::all();

        return view('dashboard.index', \compact('users','messages'));
    }
}
