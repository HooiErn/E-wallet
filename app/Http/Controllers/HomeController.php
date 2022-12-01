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

        if($users-> hasWallet('default')){
            $wallet = $users->wallet;
        }
        elseif($users-> hasWallet('my-wallet')){
            $wallet = $users->getWallet('my-wallet');
        }
        else{
            $wallet = $users->createWallet([
                'name' => 'New Wallet',
                'slug' => 'my-wallet',
            ]);
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

        return view('home', compact('wallet','walletHistory','users'));
    }

    public function transferForm(Request $request, $id){
        
        $users = DB::table('users')->where('users.id',$id)->get();
        return view('pages.Transfer', compact('users'));
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
        $last = User::where('id', $request -> userID)->first();
        $first->getKey() !== $last->getKey();

        if($first-> hasWallet('default')){
            $walletFirst = $first->wallet;
        }
        elseif($first-> hasWallet('my-wallet')){
            $walletFirst = $first->getWallet('my-wallet');
        }
        else{
            Session::flash('msg','You dint have any wallet please create one');
            return redirect('/');
        }

        if($last-> hasWallet('default')){
            $walletLast = $last->wallet;
        }
        elseif($last-> hasWallet('my-wallet')){
            $walletLast = $last->getWallet('my-wallet');
        }
        else{
            Session::flash('msg','You dint have any wallet please create one');
            return redirect('/');
        }

        if(\Hash::check($request->password, $first->password)){
            $walletFirst -> transfer($walletLast, $request->amount);
            Session::flash('msg','Transfered successfully!');
            return redirect('home');
        }
        else{
            Session::flash('msg','Transfered failed due to invalid password!');
            return redirect('transferr');
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
        else{
            $wallet = $users->createWallet([
                'name' => 'New Wallet',
                'slug' => 'my-wallet',
            ]);
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
         else{
             $wallet = $users->createWallet([
                 'name' => 'New Wallet',
                 'slug' => 'my-wallet',
             ]);
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
        else{
            $wallet = $users->createWallet([
                'name' => 'New Wallet',
                'slug' => 'my-wallet',
            ]);
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
        else{
            $wallet = $users->createWallet([
                'name' => 'New Wallet',
                'slug' => 'my-wallet',
            ]);
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
 
        return view('pages.scan', compact('wallet','walletHistory','users'));
     }
     public function test(){
        //Log in user wallet
        $users = User::where('id',Auth::id())->first();
 
        if($users-> hasWallet('default')){
            $wallet = $users->wallet;
        }
        elseif($users-> hasWallet('my-wallet')){
            $wallet = $users->getWallet('my-wallet');
        }
        else{
            $wallet = $users->createWallet([
                'name' => 'New Wallet',
                'slug' => 'my-wallet',
            ]);
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
 
        return view('pages.test', compact('wallet','walletHistory','users'));
     }
     public function depositForm(){
        //Log in user wallet
        $user = User::where('id',Auth::id())->first();

        if($user-> hasWallet('default')){
            $wallet = $user->wallet;
        }
        elseif($user-> hasWallet('my-wallet')){
            $wallet = $user->getWallet('my-wallet');
        }
        else{
            $wallet = $user->createWallet([
                'name' => 'New Wallet',
                'slug' => 'my-wallet',
            ]);
        }

        //Log in user history
        $walletHistory = DB::table('wallets')
        ->leftjoin('transactions','wallets.id','=','transactions.wallet_id')
        ->where('wallets.holder_id',Auth::user()->id)
        ->get();

        //All users wallet
        $users = DB::table('users')->leftjoin('wallets','users.id','=','wallets.holder_id')->select('users.*','wallets.balance as wBalance')->get();

        return view('deposit', compact('wallet','walletHistory','user'));
    }

    public function withdrawForm(){
        //Log in user wallet
        $user = User::where('id',Auth::id())->first();

        if($user-> hasWallet('default')){
            $wallet = $user->wallet;
        }
        elseif($user-> hasWallet('my-wallet')){
            $wallet = $user->getWallet('my-wallet');
        }
        else{
            $wallet = $user->createWallet([
                'name' => 'New Wallet',
                'slug' => 'my-wallet',
            ]);
        }

        //Log in user history
        $walletHistory = DB::table('wallets')
        ->leftjoin('transactions','wallets.id','=','transactions.wallet_id')
        ->where('wallets.holder_id',Auth::user()->id)
        ->get();

        //All users wallet
        $users = DB::table('users')->leftjoin('wallets','users.id','=','wallets.holder_id')->select('users.*','wallets.balance as wBalance')->get();

        return view('withdraw',compact('wallet','walletHistory','user'));
    }



    public function deposit(Request $request){
        $user = User::where('id',Auth::id())->first();
        if($user-> hasWallet('default')){
            $wallet = $user->wallet;
        }
        elseif($user-> hasWallet('my-wallet')){
            $wallet = $user->getWallet('my-wallet');
        }
        else{
            Session::flash('msg','You dint have any wallet please create one');
            return redirect('/');
        }
        $wallet -> deposit($request -> amount);

        return redirect('/');
    }
    
    
    public function withdraw(Request $request){
        $user = User::where('id',Auth::id())->first();
        if($user-> hasWallet('default')){
            $wallet = $user->wallet;
        }
        elseif($user-> hasWallet('my-wallet')){
            $wallet = $user->getWallet('my-wallet');
        }
        else{
            Session::flash('msg','You dint have any wallet please create one');
            return redirect('/');
        }
        $wallet -> withdraw($request -> amount);

        return redirect('/');
    }
//QrCode
    public function QrCode(){
        $user = User::where('id',Auth::id())->first();
        return view('pages.QrCode',compact('user'));
    }
    //Pay
    public function pay($id){
      
        //Log in user wallet
       $user = User::where('id',Auth::id())->first();

       if($user-> hasWallet('default')){
           $wallet = $user->wallet;
       }
       elseif($user-> hasWallet('my-wallet')){
           $wallet = $user->getWallet('my-wallet');
       }
       else{
           $wallet = $user->createWallet([
               'name' => 'New Wallet',
               'slug' => 'my-wallet',
           ]);
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

       return view('pages.pay', compact('wallet','walletHistory','user'));
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