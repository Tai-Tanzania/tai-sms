<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Twillio\WhatsappController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('sms-callback', [SMSController::class,'callback']);
Route::post('whatsapp-callback', [WhatsappController::class, 'listenToReplies']);
Route::post('send-sms',[SMSController::class,'testerSMS']);
Route::get('messages',[SMSController::class,'getAllSMS']);
Route::get('getAllBeneficiaries',[AuthController::class,'getAllBeneficiaries']);