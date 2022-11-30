<?php

namespace App\Http\Controllers\Auth;

use DB;
use Cookie;
use Session;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// here is the code for settling login,register,logout function
class AuthController extends Controller
{
    public function index(){

        return view('auth.login');

    }
//Login
    public function postLogin(Request $request){

        $request->validate([
            'password' => 'required',
            'username' => 'required',
        ]);

        if($request->has('rememberme')){
            Cookie::queue('username',$request->username,1440); //1440 means it stays for 24 hours
            Cookie::queue('password',$request->password,1440);
        }

        $credentials = $request->only('password', 'username');

        if(Auth::attempt($credentials))
        {
            if(Auth::user()->isAdmin()){
                return redirect()->route('admin.dashboard');
            }
            else if(Auth::user()->isBranch()){
                return redirect()->route('branch.dashboard');
            }
            else if(Auth::user()->isAgent()){
                return redirect()->route('agent.dashboard');
            }
            else{
                return redirect()->route('home');
            }
        }

        return redirect('admin/dashboard');
        //return redirect('login')->with('error', 'Username or password is incorrect. Please try again.');

    }

//Register
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
            'handphone_number' => 'nullable',
            'credit_limit' => 'required',
            'ic' => 'nullable',
            'created_by' => 'required',
        ]);
        // generate account id automatically
        $request['account_id'] = $this->generateAccID(12);

        $data = $request->all();
        $check = $this->create($data);

        if($request->account_level == 2)
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

    public function generateAccID($limit)
    {
        $accID = '';
        for($i = 0; $i < $limit; $i++){ $accID .= mt_rand(0, 9); }
        return $accID;
    }


//Dashboard
    public function dashboard(){

        if(Auth::check()){
            return view('dashboard');
        }

        return redirect('login')->withSuccess('You do not have access to this page!');
    }

    public function branchDashboard()
    {
        return view('branch.dashboard');
    }

    public function agentDashboard()
    {
        return view('agent.dashboard');
    }
    
    public function create(array $data){
        
        return User::create([
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
            'ic' => $data['ic'],
            'created_by' => $data['created_by'],
        ]);
    }
    
  //Profile
   public function profile(){
    $users = User::all()->where('id',Auth::id());
    return view('pages.profile')->with(["users" => $users]);
}
//Update
    // public function update(Request $r)
    // {
    //     $users = User::find($r->id);
    //     $r->validate([
    //         'name' => 'required',
    //         'username' => 'required',
    //         'password' => 'required',
    //         'email' => 'required',
    //         'handphone_number' => 'nullable',
    //         'gender' => 'nullable',
    //         'ic' => 'nullable',
    //         'bank_account_number1' => 'nullable',
    //         'bank_account_number2' => 'nullable',
    //         'bank_account_number3' => 'nullable',
    //         'permission' => 'required',
    //     ]);

    
    //     $users->name = $r->name;
    //     $users->username = $r->username;
    //     $users->password = Hash::make($r->password);
    //     $users->email = $r->email;
    //     $users->handphone_number = $r->handphone_number;
    //     $users->gender = $r->gender;
    //     $users->ic = $r->ic;
    //     $users->bank_account_number1 = $r->bank_account_number1;
    //     $users->bank_account_number2 = $r->bank_account_number2;
    //     $users->bank_account_number3 = $r->bank_account_number3;
    //     $users->permission = $r->permission;
    //     $users->save();

    //     Session::flash('success',"User was updated successfully!");
    //     if($users->type == 2){
    //         return redirect()->route('agent.show');
    //     }
    //     else if($users->type == 1){
    //         return redirect()->route('member.show');
    //     }
        
    // }
 
    //Edit Password
     public function editPassword()
    {
        $users = User::all()->where('id',Auth::id());

        return view('pages.editPassword')->with(["users" => $users]);
    } 

//Update Password
    public function updatePassword(Request $r)
    {

        $r->validate([
            'password' => 'required',
            'confirmPassword'=> 'required',
        ]);

        if($r -> confirmPassword !== $r ->password){
            Session::flash('error',"Your confirm password is not same as the new password.");
            return redirect()->route('password.change');
        }
        elseif($r -> confirmPassword == $r ->password){
            User::where('id',$r->userID)->update([
            'password' => \Hash::make($r->password)
        ]);

        Session::flash('success',"Password was changed successfully!");
        return redirect()->route('profile');
        }
        
    }

  
      public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }
}