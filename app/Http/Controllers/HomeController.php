<?php

namespace App\Http\Controllers;

use DB;
use Cookie;
use Session;
use App\Models\User;
use App\Models\Admin;
use App\Models\Agent;
use App\Models\Branch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Log in user wallet
        $users = User::where('id',Auth::id())->first();

        $wallet = $users -> wallet;
        $wallet -> balance;

        //Log in user history
        $walletHistory = DB::table('wallets')
        ->leftjoin('transactions','wallets.id','=','transactions.wallet_id')
        ->where('wallets.holder_id',Auth::user()->id)
        ->get();

        // $walletHistory = DB::table('wallets')
        // ->leftjoin('transactions','wallets.id','=','transactions.wallet_id')
        // ->leftjoin('transfers', 'wallet.id','=','transfers.from_id')
        // ->where(function($query){
        //      ->select('transfers.*','transfers.status as typeTransfer')
        //})
        // ->where('wallets.holder_id',Auth::user()->id)
        // ->get();

        //All users wallet
        $users = DB::table('users')->leftjoin('wallets','users.id','=','wallets.holder_id')->select('users.*','wallets.balance as wBalance')->get();

        return view('home', compact('wallet','walletHistory','users'));
    }

    public function transferForm($id){
        
        $users = User::where('account_id','=',$id)->first();
        return view('pages/transfer',compact('users'));
    }


    public function transferr(){
        //Except Auth request all user
        //$iii = DB::table('users')->where('id','!=', Auth::user()->id)->get();
 //return view('pages.transferr', compact('iii'));
         //Print All(Included self)
        $users = DB::table('users')->get();
        return view('pages.transferr')->with('users',$users);;
     }

     public function transfer(Request $request){
        
        $first = User::where('id',Auth::id())->first();
        $last = User::where('account_id', $request -> userID)->first();
        $first->getKey() !== $last->getKey();

        if($first-> hasWallet('default')){
            $walletFirst = $first->wallet;
        }
        elseif($first-> hasWallet('my-wallet')){
            $walletFirst = $first->getWallet('my-wallet');
        }
        else{
            Session::flash('msg','You dint have any wallet please create one');
            return redirect('/home');
        }

        if($last-> hasWallet('default')){
            $walletLast = $last->wallet;
        }
        elseif($last-> hasWallet('my-wallet')){
            $walletLast = $last->getWallet('my-wallet');
        }
        else{
            Session::flash('msg','You dint have any wallet please create one');
            return redirect('/home');
        }

        if(\Hash::check($request->password, $first->password)){
            $walletFirst -> transferFloat($walletLast, $request -> amount);
            Session::flash('msg','Transfered successfully!');
            return redirect('home');
        }
        else{
            $us = DB::table('users')->get();
            Session::flash('error','Transfered failed due to invalid password!');
            return view('pages.transferr')->with('users',$us);
        }
    }

     public function TransferMoney(){
        //Log in user wallet
        $users = User::where('id',Auth::id())->first();
 
        if($users-> hasWallet('default')){
            $wallet = $users->wallet;
        }
        elseif($users-> hasWallet('my-wallet')){
            $wallet = $users->getWallet('my-wallet');
        }
 
        //Log in user history
        $walletHistory = DB::table('wallets')
        ->leftjoin('transactions','wallets.id','=','transactions.wallet_id')
        ->where('wallets.holder_id',Auth::user()->id)
        ->get();
 
        // $walletHistory = DB::table('wallets')
        // ->leftjoin('transactions','wallets.id','=','transactions.wallet_id')
        // ->leftjoin('transfers', 'wallet.id','=','transfers.from_id')
        // ->where(function($query){
        //      ->select('transfers.*','transfers.status as typeTransfer')
        //})
        // ->where('wallets.holder_id',Auth::user()->id)
        // ->get();
 
        //All users wallet
        $users = DB::table('users')->leftjoin('wallets','users.id','=','wallets.holder_id')->select('users.*','wallets.balance as wBalance')->get();
 
        return view('pages.TransferMoney', compact('wallet','walletHistory','users'));
     }
 //EnterPassword
    public function enterPassword(){
         //Log in user wallet
         $users = User::where('id',Auth::id())->first();

         if($users-> hasWallet('default')){
             $wallet = $users->wallet;
         }
         elseif($users-> hasWallet('my-wallet')){
             $wallet = $users->getWallet('my-wallet');
         }

 
         //Log in user history
         $walletHistory = DB::table('wallets')
         ->leftjoin('transactions','wallets.id','=','transactions.wallet_id')
         ->where('wallets.holder_id',Auth::user()->id)
         ->get();
 
         // $walletHistory = DB::table('wallets')
         // ->leftjoin('transactions','wallets.id','=','transactions.wallet_id')
         // ->leftjoin('transfers', 'wallet.id','=','transfers.from_id')
         // ->where(function($query){
         //      ->select('transfers.*','transfers.status as typeTransfer')
         //})
         // ->where('wallets.holder_id',Auth::user()->id)
         // ->get();
 
         //All users wallet
         $users = DB::table('users')->leftjoin('wallets','users.id','=','wallets.holder_id')->select('users.*','wallets.balance as wBalance')->get();
 
         return view('pages.enterPassword', compact('wallet','walletHistory','users'));
        }

        public function searchUser(){
            $r=request();
            $keyword=$r->keyword;
            $uaa=DB::table('users')
            ->where('users.name','like','%'.$keyword.'%')
            ->get();
            return view('pages.transferr')->with('users',$uaa);
        }

    //Transfer
    public function transactionHistory(){
        //Log in user wallet
        $users = User::where('id',Auth::id())->first();

        if($users-> hasWallet('default')){
            $wallet = $users->wallet;
        }
        elseif($users-> hasWallet('my-wallet')){
            $wallet = $users->getWallet('my-wallet');

        }

        //Log in user history
        $walletHistory = DB::table('wallets')
        ->leftjoin('transactions','wallets.id','=','transactions.wallet_id')
        ->where('wallets.holder_id',Auth::user()->id)
        ->get();

        // $walletHistory = DB::table('wallets')
        // ->leftjoin('transactions','wallets.id','=','transactions.wallet_id')
        // ->leftjoin('transfers', 'wallet.id','=','transfers.from_id')
        // ->where(function($query){
        //      ->select('transfers.*','transfers.status as typeTransfer')
        //})
        // ->where('wallets.holder_id',Auth::user()->id)
        // ->get();

        //All users wallet
        $users = DB::table('users')->leftjoin('wallets','users.id','=','wallets.holder_id')->select('users.*','wallets.balance as wBalance')->get();

        return view('pages.transactionHistory', compact('wallet','walletHistory','users'));
    }

    //Scan
    public function scan(){
        //Log in user wallet
        $users = User::where('id',Auth::id())->first();
 
        if($users-> hasWallet('default')){
            $wallet = $users->wallet;
        }
        elseif($users-> hasWallet('my-wallet')){
            $wallet = $users->getWallet('my-wallet');
        
        }
 
        //Log in user history
        $walletHistory = DB::table('wallets')
        ->leftjoin('transactions','wallets.id','=','transactions.wallet_id')
        ->where('wallets.holder_id',Auth::user()->id)
        ->get();
 
      
        $users = DB::table('users')->leftjoin('wallets','users.id','=','wallets.holder_id')->select('users.*','wallets.balance as wBalance')->get();
 
        return view('pages.scan', compact('wallet','walletHistory','users'));
     }
     public function test(){
        //Log in user wallet
        $users = User::where('id',Auth::id())->first();
        $wallet = $users -> wallet;
        $wallet -> balance;
 
        //Log in user history
        $walletHistory = DB::table('wallets')
        ->leftjoin('transactions','wallets.id','=','transactions.wallet_id')
        ->where('wallets.holder_id',Auth::user()->id)
        ->get();
 
        // $walletHistory = DB::table('wallets')
        // ->leftjoin('transactions','wallets.id','=','transactions.wallet_id')
        // ->leftjoin('transfers', 'wallet.id','=','transfers.from_id')
        // ->where(function($query){
        //      ->select('transfers.*','transfers.status as typeTransfer')
        //})
        // ->where('wallets.holder_id',Auth::user()->id)
        // ->get();
 
        //All users wallet
        $users = DB::table('users')->leftjoin('wallets','users.id','=','wallets.holder_id')->select('users.*','wallets.balance as wBalance')->get();
 
        return view('pages.test', compact('wallet','walletHistory','users'));
     }
     public function depositForm(){
        //Log in user wallet
        $users = User::where('id',Auth::id())->first();
        $wallet = $users -> wallet;
        $wallet -> balance;
        //Log in user history
        $walletHistory = DB::table('wallets')
        ->leftjoin('transactions','wallets.id','=','transactions.wallet_id')
        ->where('wallets.holder_id',Auth::user()->id)
        ->get();

        //All users wallet
        $users = DB::table('users')->leftjoin('wallets','users.id','=','wallets.holder_id')->select('users.*','wallets.balance as wBalance')->get();

        return view('deposit', compact('wallet','walletHistory','users'));
    }

    public function withdrawForm(){
        //Log in user wallet
        $user = User::where('id',Auth::id())->first();

        $wallet = $user->wallet;
        $wallet->balance;

        //Log in user history
        $walletHistory = DB::table('wallets')
        ->leftjoin('transactions','wallets.id','=','transactions.wallet_id')
        ->where('wallets.holder_id',Auth::user()->id)
        ->get();

        //All users wallet
        $users = DB::table('users')->leftjoin('wallets','users.id','=','wallets.holder_id')->select('users.*','wallets.balance as wBalance')->get();

        return view('withdraw',compact('wallet','walletHistory','user'));
    }



   //Deposit
   public function deposit(Request $request){

    $user = User::where('id',Auth::id())->first();
    if($wallet = $user->wallet){
        $wallet = $user->wallet;
        $wallet->balance;
    }
    elseif($user-> hasWallet('my-wallet')){
        $wallet = $user->getWallet('my-wallet');
    }
    else{
        return redirect('home');
    }

    if($request -> amount + ($wallet -> balance/100) > $user -> credit_limit){
        $remaining = $user -> credit_limit - ($wallet -> balance/100);
        return redirect('home');
    }
    else{
        $wallet -> depositFloat($request -> amount);
        return redirect('home');
    }
    
}
    
   //Withdraw
   public function withdraw(Request $request){
    $user = User::where('id',Auth::id())->first();
    $walletBalance = DB::table('wallets')->where('holder_id',Auth::id())->first();
    $wallet = $user -> wallet;
    $wallet -> balance;

    $wallet -> withdrawFloat($request -> amount);
    return redirect('/home');
}
//QrCode
    public function QrCode(){
        $user = User::where('id',Auth::id())->first();
        return view('pages.QrCode',compact('user'));
    }
   
    //Check password (qrcode)
    public function checkPassword(Request $request){
        $check = User::where('password',$request -> password)->where('account_id',Auth::user()->account_id)->first();

        if($check){
            Session::flash('success',"Transfered successfully!");
            return view('pages.pay');
        }
        else{
            Session::flash('error',"Invalid Password!");
            return view('pages.scan');
        }
    }
}