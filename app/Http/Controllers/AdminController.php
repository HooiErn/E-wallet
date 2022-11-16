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

  //Dashboard
  public function index(){
    $categories = DB::table('categories')->select('categories.*')->get();
    $foods = DB::table('food')->leftjoin('categories','categories.id','=','food.categoryID')->select('food.*','categories.name as categoryName')->get();
    return view('admin/dashboard')->with(["categories" => $categories])->with(["foods" => $foods]);
}
    
   //Menu
   public function menu(){
    // $foods= Food::all();
    $foods = DB::table('food')->leftjoin('categories','food.categoryID','=','categories.id')->select('food.*','categories.name as cName')->get();
    return view('pages.menu')->with('foods',$foods);
}
  

}