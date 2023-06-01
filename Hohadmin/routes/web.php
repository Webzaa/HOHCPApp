<?php

use Illuminate\Support\Facades\Route;  
use App\Http\Controllers\CityController;
use App\Http\Controllers\AmenitiesController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ChannelPartnerController;
use App\Http\Controllers\SalesManagerController;
use App\Http\Controllers\ProjectCollateralController;
use App\Http\Controllers\MapCollateralImageController;
use App\Http\Controllers\RolesPermissionController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\NotificationController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();
Route::get('/register',[RegisterController::class, 'index'])->name('register');
Route::get('/reset-password',[App\Http\Controllers\UserController::class, 'ResetPasswordLoad']);
Route::post('/reset-password',[App\Http\Controllers\UserController::class, 'ResetPassword']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('get-permissions/{id}', [App\Http\Controllers\RolesPermissionController::class, 'GetPermissions']);
Route::post('store-role-permissions', [App\Http\Controllers\RolesPermissionController::class, 'StoreRolePermission'])->name('StoreRolePermission.post');
Route::resource('Dashboard', DashBoardController::class);
Route::resource('city', CityController::class);
Route::resource('User', UserController::class);
Route::resource('RolesPermission', RolesPermissionController::class);
Route::resource('Amenities', AmenitiesController::class);
Route::resource('Master', MasterController::class);
Route::resource('project', ProjectController::class);
Route::resource('ChannelPartner', ChannelPartnerController::class);
Route::resource('SalesManager', SalesManagerController::class);
Route::resource('lead', LeadController::class);
Route::resource('Notification', NotificationController::class);
Route::resource('ProjectCollateral', ProjectCollateralController::class);
Route::delete('ProjectCollateraldDelete/{id}', [App\Http\Controllers\ProjectCollateralController::class,'destroy']);
Route::delete('CollateralImage/{id}', [App\Http\Controllers\MapCollateralImageController::class,'destroy']);
Route::get('download/{id}', [App\Http\Controllers\ProjectController::class,'ZipFile']);
Route::get('project-active/{id}', [App\Http\Controllers\ProjectController::class,'StatusUpdate']);
Route::get('cp-active/{id}', [App\Http\Controllers\ChannelPartnerController::class,'StatusUpdate']);
Route::get('UpdateCPProject/{id}', [App\Http\Controllers\ChannelPartnerController::class,'UpdateCPProjectDetails']);
Route::get('lead-status-approved/{id}', [App\Http\Controllers\LeadController::class,'StatusUpdateApproved']);
Route::get('lead-status-rejected/{id}', [App\Http\Controllers\LeadController::class,'StatusUpdateRejected']);
Route::get('sm-active/{id}', [App\Http\Controllers\SalesManagerController::class,'StatusUpdate']);
