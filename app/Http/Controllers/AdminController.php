<?php

namespace App\Http\Controllers;

use DB;
use Cookie;
use Session;
use App\Models\Food;
use App\Models\Admin;
use App\Models\Agent;
use App\Models\Branch;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    //Login
    public function login(){
        return view('admin/login');
    }

    //Check Login
    public function check_login(Request $request){

        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where(['name' => $request->name, 'password' => sha1($request->password)])->count();

        if($request->has('rememberme')){
            Cookie::queue('name',$request->name,1440); //1440 means it stays for 24 hours
            Cookie::queue('password',$request->password,1440);
        }

        if($admin > 0){
            $adminData = Admin::where(['name' => $request->name, 'password' => sha1($request->password)])->get();
            session(['adminData' => $adminData]);
            return redirect('admin/dashboard');
        }
        else{
            return redirect('admin/login')->with('msg', 'Invalid name/password!!');
        }
    }

    

    //Logout
    public function logout(){
        session()->forget(['adminData']);
        return redirect('admin/login');
    }

    public function adminDashboard()
    {
        return view('admin.dashboard');
    }


//Function
//Transfer(Phone search)
public function transfer(){
    return view('pages.Transfer');
}
//QRScan
public function QrScan(){
    return view('pages.QrScan');
}
//Create Members
public function MemberRegistration(){

    return view('admin.users.CreateMembers');

}
//Create Branch
public function BranchRegistration(){

return view('admin.users.CreateBranch');

}
//Create Agents/Manager
public function AgentsRegistration(){

return view('admin.users.CreateAgents');

}
//Create Admin
public function AdminRegistration(){

    return view('admin.users.CreateAdmins');
    
    }
//Transfer Money
public function transferMoney(){
    return view('pages.TransferMoney');
   }

   //Profile
   public function profile(){
    return view('pages.profile');
}
   //Show History
   public function showHistory(){
    $users = DB::table('transactions')
    ->leftjoin('users','transactions.payable_id','=','users.id')
    ->select('transactions.*','users.loginID as holderName')
    ->get();


    return view('pages.transactionHistory', compact('users'));
}
//Home
public function home(){
    return view('home');
}

//ViewMember
public function viewMember(){
    $users = DB::table('users')->select('users.*')->where('account_level','4')->get();
    return view('admin.users.viewMembers')->with(["users" => $users]);
}
//ViewBranch 
public function viewBranch(){
    return view('admin.users.viewBranch');
}
//ViewAgents 
public function viewAgents(){
    return view('admin.users.viewAgents');
}

//EnterPassword
public function enterPassword(){
    return view('pages.enterPassword');
    }
    
      //Show Wallet
      public function showWallet(){
        $users = User::all();
        foreach($users as $user){
            if($user -> hasWallet('my-wallet')){
                $wallet = $user -> getWallet('my-wallet');
            }
            else{
                $wallet = $user->createWallet([
                    'name' => 'New Wallet',
                    'slug' => 'my-wallet',
                ]);
            } 
        }

        $wallets = DB::table('wallets')
        ->leftjoin('users','wallets.holder_id','=','users.id')
        ->select('wallets.*','users.loginID as uName')
        ->get();
        return view('admin/wallet', compact('users','wallets'));
    }

    //Update
    public function update(Request $r)
    {
        $users = User::find($r->id);
        $r->validate([
            'name' => 'required',
            'account_name' => 'required',
            'account_id' => 'required',
            'account_level' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'join_date' => 'required',
            'base_currency' => 'nullable',
            'handphone_number' => 'nullable',
            'credit_limit' => 'required',
            'credit_available' => 'required',
            'ic' => 'nullable',
            'created_by' => 'required',
        ]);
        $users->name = $r->name;
        $users->account_id = $r->account_id;
        $users->account_name = $r->account_name;
        $users->account_level = $r->account_level;
        $users->username = $r->username;
        $users->password = Hash::make($r->password);
        $users->email = $r->email;
        $users->handphone_number = $r->handphone_number;  
        $users->ic = $r->ic;
        $users->join_date = $r->join_date;
        $users->base_currency = $r->base_currency;
        $users->credit_limit = $r->credit_limit;
        $users->credit_available = $r->credit_available;
        $users->save();

        Session::flash('success',"User was updated successfully!");
        if($users->type == 4){
            return redirect()->route('view.member');
        }
        else if($users->type == 3){
            return redirect()->route('view.agent');
        }else if($users->type == 2){
            return redirect()->route('view.branch');
        }
        
    }

//postRegisterBranches
// public function postRegisterBranches(Request $r)
// {
//     $r->validate([
//         'name' => 'required',
//         'account_name' => 'required',
//         'account_id' => 'required',
//         'account_level' => 'required',
//         'username' => 'required',
//         'password' => 'required',
//         'email' => 'required',
//         'join_date' => 'required',
//         'base_currency' => 'nullable',
//         'handphone_number' => 'nullable',
//         'credit_limit' => 'required',
//         'credit_available' => 'required',
//         'ic' => 'nullable',
//         'created_by' => 'required',
//     ]);
//     // generate account id automatically
//     $r['account_id'] = $this->generateAccID(12);

//     $data = $r->all();
//     $check = $this->createBranches($data);

//     return redirect()->route('view.branch')->withSuccess('You have successfully created a new branch!');

// }

// //postRegisterAgents
// public function postRegisterAgents(Request $r)
// {
//     $r->validate([
//         'name' => 'required',
//         'account_name' => 'required',
//         'account_id' => 'required',
//         'account_level' => 'required',
//         'username' => 'required',
//         'password' => 'required',
//         'email' => 'required',
//         'join_date' => 'required',
//         'base_currency' => 'nullable',
//         'handphone_number' => 'nullable',
//         'credit_limit' => 'required',
//         'credit_available' => 'required',
//         'ic' => 'nullable',
//         'created_by' => 'required',
//     ]);
//     // generate account id automatically
//     $r['account_id'] = $this->generateAccID(12);

//     $data = $r->all();
//     $check = $this->createAgents($data);

//     return redirect()->route('view.agents')->withSuccess('You have successfully created a new agent!');

// }

// public function generateAccID($limit)
// {
//     $accID = '';
//     for($i = 0; $i < $limit; $i++){ $accID .= mt_rand(0, 9); }
//     return $accID;
// }

// public function createBranches(array $data)
// {
//     return Branch::create([
//         'name' => $data['name'],
//         'username' => $data['username'],
//         'password' => \Hash::make($data['password']),
//         'account_level' => $data['account_level'],
//         'account_name' => $data['account_name'],
//         'account_id' => $data['account_id'],
//         'email' => $data['email'],
//         'join_date' => $data['join_date'],
//         'base_currency' => $data['base_currency'],
//         'handphone_number' => $data['handphone_number'],
//         'credit_limit' => $data['credit_limit'],
//         'credit_available' => $data['credit_available'],
//         'ic' => $data['ic'],
//         'created_by' => $data['created_by'],
//     ]);
// }

// public function createAgents(array $data)
// {
//     return Agent::create([
//         'name' => $data['name'],
//         'username' => $data['username'],
//         'password' => \Hash::make($data['password']),
//         'account_level' => $data['account_level'],
//         'account_name' => $data['account_name'],
//         'account_id' => $data['account_id'],
//         'email' => $data['email'],
//         'join_date' => $data['join_date'],
//         'base_currency' => $data['base_currency'],
//         'handphone_number' => $data['handphone_number'],
//         'credit_limit' => $data['credit_limit'],
//         'credit_available' => $data['credit_available'],
//         'ic' => $data['ic'],
//         'created_by' => $data['created_by'],
//     ]);
// }

}