<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Food;
use Session;
use Cookie;
use DB;

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
//Transfer Money
public function transferMoney(){
    return view('pages.TransferMoney');
   }

   //Profile
   public function profile(){
    return view('pages.profile');
}
//Transaction History
public function transactionHistory(){
    return view('pages.transactionHistory');
}
//Home
public function home(){
    return view('home');
}

//ViewMember
public function viewMember(){
    return view('pages.viewMembers');
}
//ViewBranch 
public function viewBranch(){
    return view('pages.viewBranch');
}
//ViewAgents 
public function viewAgents(){
    return view('pages.viewAgents');
}

  //postRegisterBranches
public function postRegisterBranches(Request $r)
{
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
    // generate account id automatically
    $r['account_id'] = $this->generateAccID(12);

    $data = $r->all();
    $check = $this->createBranches($data);

    return redirect()->route('view.branch')->withSuccess('You have successfully created a new branch!');

}
public function createBranches(array $data)
{
    return Branch::create([
        'name' => $data['name'],
        'username' => $data['username'],
        'password' => \Hash::make($data['password']),
        'account_level' => $data['account_level'],
        'account_name' => $data['account_name'],
        'account_id' => $data['account_id'],
        'email' => $data['email'],
        'join_date' => $data['join_date'],
        'base_currency' => $data['base_currency'],
        'handphone_number' => $data['handphone_number'],
        'credit_limit' => $data['credit_limit'],
        'credit_available' => $data['credit_available'],
        'ic' => $data['ic'],
        'created_by' => $data['created_by'],
    ]);
}
public function generateAccID($limit)
{
    $accID = '';
    for($i = 0; $i < $limit; $i++){ $accID .= mt_rand(0, 9); }
    return $accID;
}

}