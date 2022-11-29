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
// Route::post('post-register-branches',[AdminController::class, 'postRegisterBranches'])->name('register.branch.post');
// Route::post('post-register-agents',[AdminController::class, 'postRegisterAgents'])->name('register.agent.post');


//Route for editing and updating users' information
Route::get('profile',[AdminController::class, 'profile'])->name('profile');
Route::get('transactionHistory',[HomeController::class, 'transactionHistory'])->name('view.transactionHistory');

Route::get('QrScan',[AdminController::class, 'QrScan'])->name('QrScan');
Route::get('MemberRegistration',[AdminController::class, 'MemberRegistration'])->name('member.register');
Route::get('BranchRegistration',[AdminController::class, 'BranchRegistration'])->name('branch.register');
Route::get('AgentsRegistration',[AdminController::class, 'AgentsRegistration'])->name('agent.register');
Route::get('AdminsRegistration',[AdminController::class, 'AdminRegistration'])->name('admin.register');
Route::post('update' ,[AdminController::class,'update'])->name('user.update');
Route::get('viewMembers',[AdminController::class, 'viewMember'])->name('view.member');
Route::get('viewBranch',[AdminController::class, 'viewBranch'])->name('view.branch');
Route::get('viewAgents',[AdminController::class, 'viewAgents'])->name('view.agents');

//Transfer
Route::get('transferr',[HomeController::class, 'transferr'])->name('view.transfeR');
Route::get('/transfer/{id}', [HomeController::class, 'transferForm']);
Route::post('check-out/transfer', [HomeController::class, 'transfer']);
Route::get('transactionHistory',[HomeController::class, 'transactionHistory'])->name('view.transactionHistory');
Route::post('/transferr',[HomeController::class, 'searchUser'] ) ->name('search.user');


//Scan to pay
Route::get('pay',[HomeController::class, 'pay'])->name('view.pay');

//Testing
Route::get('test',[HomeController::class, 'test'])->name('view.test');

// -----Manager-----
//Deposit
Route::get('deposit', [HomeController::class, 'depositForm']);
Route::post('check-out/deposit', [HomeController::class, 'deposit']);

//Withdraw
Route::get('withdraw', [HomeController::class, 'withdrawForm']);
Route::post('check-out/withdraw', [HomeController::class, 'withdraw']);
// -----Member-----
//Transfer
Route::get('/transfer/{id}', [HomeController::class, 'transferForm']);
Route::post('check-out/transfer', [HomeController::class, 'transfer']);
Route::get('transactionHistory',[HomeController::class, 'transactionHistory'])->name('view.transactionHistory');
Route::get('test',[HomeController::class, 'test'])->name('view.test');

//Scan to pay
Route::get('scan',[HomeController::class, 'scan'])->name('view.scan');


//Change Password
Route::get('change-password', [AuthController::class, 'editPassword'])->name('password.change');
Route::post('update-password',[AuthController::class, 'updatePassword'])->name('password.update');

Route::get('profile', [AuthController::class, 'profile'])->name('profile');  
Route::get('admin/dashboard',[AdminController::class, 'adminDashboard'])->name('admin.dashboard');
Route::get('branch/dashboard',[AuthController::class, 'branchDashboard'])->name('branch.dashboard');
Route::get('agent/dashboard',[AuthController::class, 'agentDashboard'])->name('agent.dashboard');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');


//Table
Route::get('admin/table', function(){return view('admin/table');});
//Transaction History
Route::get('admin/transactionHistory', [AdminController::class, 'showHistory']);


//Route for providing support if user forget password
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'sendForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'sendResetPasswordForm'])->name('reset.password.post');

Route::get('home', [AdminController::class, 'home'])->name('home');