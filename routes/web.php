<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AdminController;
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

//Admin Login & Logout
Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'check_login']);
Route::get('admin/logout', [AdminController::class, 'logout']);

//Route for authenticating users' login and registration
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register');


//Route for editing and updating users' information
Route::get('profile',[AuthController::class, 'profile'])->name('profile');
Route::get('transactionHistory',[AuthController::class, 'transactionHistory'])->name('view.transactionHistory');
Route::get('Transfer',[AuthController::class, 'transfer'])->name('transfer');
Route::get('QrScan',[AuthController::class, 'QrScan'])->name('QrScan');
Route::get('MemberRegistration',[AuthController::class, 'MemberRegistration'])->name('member.register');
Route::get('BranchRegistration',[AuthController::class, 'BranchRegistration'])->name('branch.register');
Route::get('AgentsRegistration',[AuthController::class, 'AgentsRegistration'])->name('agent.register');
Route::get('viewMembers',[AuthController::class, 'viewMember'])->name('view.member');
Route::get('viewBranch',[AuthController::class, 'viewBranch'])->name('view.branch');
Route::get('viewAgents',[AuthController::class, 'viewAgents'])->name('view.agents');



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

Route::get('/home', [AuthController::class, 'home'])->name('home');