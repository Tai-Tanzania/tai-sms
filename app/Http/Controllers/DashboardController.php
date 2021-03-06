<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Beneficiary;
use App\Exports\BeneficiariesExport;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function index(){
        $messages = Message::all();
        $users = Beneficiary::all();

        $englishSpeakers = Beneficiary::where('language_id', 1)->get();
        $swahiliSpeakers = Beneficiary::where('language_id', 2)->get();

        return view('dashboard.index', \compact('users','messages','englishSpeakers', 'swahiliSpeakers'));
    }

    public function beneficiaries(){
        $users = Beneficiary::with('lang')->get();
        return view('dashboard.beneficiaries', ['beneficiaries'=>$users]);
    }

    public function export(){
        return Excel::download(new BeneficiariesExport, 'beneficiaries.xlsx');
    }

    public function messages(){
        $messages = Message::with('beneficiary')->get(); 
        return view('dashboard.messages', \compact('messages'));
    }
}
