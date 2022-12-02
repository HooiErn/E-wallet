<?php

namespace App\Http\Controllers;

use DB;
use Cookie;
use Session;
use App\Models\Food;
use App\Models\Admin;
use App\Models\Agent;
use App\Models\Branch;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

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
    $users = DB::table('users')->where('users.id',Auth::id())
    ->leftjoin('wallets','users.id','=','wallets.holder_id')
    ->select('users.*','wallets.balance as balance')
    ->get();
    return view('home',compact('users'));
}

//ViewMember
public function viewMember(){
    $users = DB::table('users')->select('users.*')->where('account_level','4')
    ->leftjoin('wallets','users.id','=','wallets.holder_id')
    ->select('users.*','wallets.balance as balance')
    ->get();
    return view('admin.users.viewMembers')->with(["users" => $users]);
}
//ViewBranch 
public function viewBranch(){
    $users = DB::table('users')->select('users.*')->where('account_level','2')
    ->leftjoin('wallets','users.id','=','wallets.holder_id')
    ->select('users.*','wallets.balance as balance')
    ->get();
    return view('admin.users.viewBranch')->with(["users" => $users]);;
}
//ViewAgents 
public function viewAgents(){
    $users = DB::table('users')->select('users.*')->where('account_level','3')
    ->leftjoin('wallets','users.id','=','wallets.holder_id')
    ->select('users.*','wallets.balance as balance')
    ->get();
    return view('admin.users.viewAgents')->with(["users" => $users]);;
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
            'ic' => 'nullable',
            'created_by' => 'required',
            'deleted_by' => 'nullable',
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
        $users->save();

        Session::flash('success',"User was updated successfully!");
        if($users->account_level == 4){
            return redirect()->route('view.member');
        }
        else if($users->account_level == 3){
            return redirect()->route('view.agent');
        }else if($users->account_level == 2){
            return redirect()->route('view.branch');
        }
        
    }

    public function postRegistration(Request $request){
        
        $request->validate([
            'name' => 'required',
            'account_name' => 'required',
            'account_id' => 'required',
            'account_level' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'join_date' => 'required',
            'base_currency' => 'nullable',
            'credit_limit' => 'required',
            'created_by' => 'required',
        ]);
        // generate account id automatically
        $request['account_id'] = $this->generateAccID(12);
$data = $request->only('name','account_name','account_id','account_level','username','password','email','join_date','base_currency'
        ,'credit_limit','created_by');
        $check = $this->create($data);

        //check if user is created
        if($check)
        {
            // assign user to get its id
            $user = DB::table('users')->select('users.id')->where('users.account_id',$request->account_id)->first()->id;

            // check for each permission is checked on checkbox
            if($request->can_deposit)
            {
                $data = array('user_id' => $user,'permission_id' => 1);
                DB::table('user_permissions')->insert($data);
            }
            if($request->can_withdraw)
            {
                $data = array('user_id' => $user,'permission_id' => 2);
                DB::table('user_permissions')->insert($data);
            }
            if($request->can_transfer)
            {
                $data = array('user_id' => $user,'permission_id' => 3);
                DB::table('user_permissions')->insert($data);
            }
        }

        // insert create wallet code or method here

        if($request->account_level == 1)
        {
            return redirect()->route('view.admin')->withSuccess('You have successfully created a sub-admin!');
        }
        else if($request->account_level == 2)
        {
            return redirect()->route('view.branch')->withSuccess('You have successfully created a new branch!');
        }
        else if($request->account_level == 3)
        {
            return redirect()->route('view.agents')->withSuccess('You have successfully created a new agent!');
        }
        else if($request->account_level == 4)
        {
            return redirect()->route('view.member')->withSuccess('You have successfully created a new member!');
        }
        else
        {
            return back()->withError('Incorrect input. Please try again.');
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
//         'ic' => $data['ic'],
//         'created_by' => $data['created_by'],
//     ]);
// }

}