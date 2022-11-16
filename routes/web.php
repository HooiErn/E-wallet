<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Pages\BlacklistController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index']);

//Route for authenticating users' login and registration
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');


//Route for editing and updating users' information
Route::get('profile',[AdminController::class, 'profile'])->name('profile');
Route::get('transactionHistory',[AdminController::class, 'transactionHistory'])->name('view.transactionHistory');
Route::get('Transfer',[AdminController::class, 'transfer'])->name('transfer');
Route::get('QrScan',[AdminController::class, 'QrScan'])->name('QrScan');
Route::get('MemberRegistration',[AdminController::class, 'MemberRegistration'])->name('member.register');
Route::get('BranchRegistration',[AdminController::class, 'BranchRegistration'])->name('branch.register');
Route::get('AgentsRegistration',[AdminController::class, 'AgentsRegistration'])->name('agent.register');

//Change Password
Route::get('change-password', [AuthController::class, 'editPassword'])->name('password.change');
Route::post('update-password',[AuthController::class, 'updatePassword'])->name('password.update');

Route::get('profile', [AuthController::class, 'profile'])->name('profile');  
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');

//Route for providing support if user forget password
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'sendForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'sendResetPasswordForm'])->name('reset.password.post');
