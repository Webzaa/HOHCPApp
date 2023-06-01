<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ApiController;

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



Route::post('login', [App\Http\Controllers\Api\ApiController::class,'login'])->name('login');

Route::post('loginCheck', [App\Http\Controllers\Api\ApiController::class,'loginCheck'])->name('loginCheck');

Route::post('Verify-OTP', [App\Http\Controllers\Api\ApiController::class,'VerifyOTP'])->name('VerifyOTP');

Route::post('Register', [App\Http\Controllers\Api\ApiController::class,'Register'])->name('Register');

Route::get('GetProjects', [App\Http\Controllers\Api\ApiController::class,'GetProjects'])->name('GetProjects');

Route::post('GetDashboardDetails', [App\Http\Controllers\Api\ApiController::class,'GetDashboardDetails'])->name('GetDashboardDetails');

Route::get('GetLeads', [App\Http\Controllers\Api\ApiController::class,'GetLeads'])->name('GetLeads');

Route::post('GetUserDetails', [App\Http\Controllers\Api\ApiController::class,'GetUserDetails'])->name('GetUserDetails');

Route::post('UpdateUserDetails', [App\Http\Controllers\Api\ApiController::class,'UpdateUserDetails'])->name('UpdateUserDetails');

Route::post('AddLead', [App\Http\Controllers\Api\ApiController::class,'AddLead'])->name('AddLead');

Route::get('GetProjectDetails', [App\Http\Controllers\Api\ApiController::class,'GetProjectDetails'])->name('GetProjectDetails');

Route::post('forgot-password', [App\Http\Controllers\Api\ApiController::class,'ForgotPassword'])->name('forgot-password');

Route::post('SendEmailer', [App\Http\Controllers\Api\ApiController::class,'SendEmailer'])->name('SendEmailer');

Route::post('GetBookings', [App\Http\Controllers\Api\ApiController::class,'GetBookings'])->name('GetBookings');

Route::post('ResendOTP', [App\Http\Controllers\Api\ApiController::class,'ResendOTP'])->name('ResendOTP');

Route::post('AddCDCProfile', [App\Http\Controllers\Api\ApiController::class,'AddCDCProfile'])->name('AddCDCProfile');

Route::get('GetCDCProfile', [App\Http\Controllers\Api\ApiController::class,'GetCDCProfile'])->name('GetCDCProfile');

Route::post('AddCPToApp', [App\Http\Controllers\Api\ApiController::class,'AddCPToApp'])->name('AddCPToApp');

Route::post('UpdateDeviceID', [App\Http\Controllers\Api\ApiController::class,'UpdateDeviceID'])->name('UpdateDeviceID');

Route::post('GetUserLoginHistory', [App\Http\Controllers\Api\ApiController::class,'GetUserLoginHistory'])->name('GetUserLoginHistory');

Route::post('SendBrochureEmailer', [App\Http\Controllers\Api\ApiController::class,'SendBrochureEmailer'])->name('SendBrochureEmailer');

Route::post('VerifyOTPLogin', [App\Http\Controllers\Api\ApiController::class,'VerifyOTPLogin'])->name('VerifyOTPLogin');

Route::post('AddDataToAudit', [App\Http\Controllers\Api\ApiController::class,'AddDataToAudit'])->name('AddDataToAudit');