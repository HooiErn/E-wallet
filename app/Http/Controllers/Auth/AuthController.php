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
        

        if(Auth::attempt($credentials)){
            // set remember me token when user check the box
            //$remember = Input::get('remember');
            /*if(!empty($remember)){
                Auth::login(Auth::user()->id, true);
            }*/
            if(Auth::user()->isAdmin()){
                return redirect()->route('agent.register')->withSuccess('You have successfully logged in!');
            }
            else if(Auth::user()->isAgent() && Auth::user()->permission == 1){
                return redirect()->route('user.register')->withSuccess('You have successfully logged in!');
            }
            else if(Auth::user()->isAgent() && Auth::user()->permission == 2){
                return redirect()->route('member.show')->withSuccess('You have successfully logged in!');
            }
            else if(Auth::user()->isMember()){
                return redirect()->route('blacklist.view')->withSuccess('You have successfully logged in!');
            }

        }

        return redirect('login')->with('error', 'Username or password is incorrect. Please try again.');;

    }

//Register
    public function postRegistration(Request $request){
        
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'type' => 'required',
            'handphone_number' => 'nullable',
            'gender' => 'nullable',
            'permission' => 'required',
            'created_by' => 'required',
        ]);
    
        $data = $request->all();
        $check = $this->create($data);

        if($request->type == 1){
            return redirect()->route('member.show')->withSuccess('You have successfully created a new member!');
        }
        elseif($request->type == 2){
            return redirect()->route('agent.show')->withSuccess('You have successfully created a new agent!');
        }
        else{
            return redirect()->route('member.show')->withSuccess('You have successfully created a new member!');
        } 
    }
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


//Dashboard
    public function dashboard(){

        if(Auth::check()){
            return view('dashboard');
        }

        return redirect('login')->withSuccess('You do not have access to this page!');
    }
    
    public function create(array $data){
        
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'email' => $data['email'],
            'handphone_number' => $data['handphone_number'],
            'gender' => $data['gender'],
            'type' => $data['type'],
            'permission' => $data['permission'],
            'created_by' => $data['created_by'],
        ]);
    }
    

//Update
    public function update(Request $r)
    {
        $users = User::find($r->id);
        $r->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'handphone_number' => 'nullable',
            'gender' => 'nullable',
            'ic' => 'nullable',
            'bank_account_number1' => 'nullable',
            'bank_account_number2' => 'nullable',
            'bank_account_number3' => 'nullable',
            'permission' => 'required',
        ]);

    
        $users->name = $r->name;
        $users->username = $r->username;
        $users->password = Hash::make($r->password);
        $users->email = $r->email;
        $users->handphone_number = $r->handphone_number;
        $users->gender = $r->gender;
        $users->ic = $r->ic;
        $users->bank_account_number1 = $r->bank_account_number1;
        $users->bank_account_number2 = $r->bank_account_number2;
        $users->bank_account_number3 = $r->bank_account_number3;
        $users->permission = $r->permission;
        $users->save();

        Session::flash('success',"User was updated successfully!");
        if($users->type == 2){
            return redirect()->route('agent.show');
        }
        else if($users->type == 1){
            return redirect()->route('member.show');
        }
        
    }
 
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
        return redirect()->route('profile.view');
        }
        
    }

  //Profile
    public function profile(){
        return view('pages.profile');
    }
    //Transaction History
    public function transactionHistory(){
        return view('pages.transactionHistory');
    }

    

      public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }
}