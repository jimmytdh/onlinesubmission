<?php

namespace App\Http\Controllers;

use App\Http\Controllers\admin\LogCtrl;
use App\User;
use App\UserPriv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginCtrl extends Controller
{
    public function __construct()
    {
        //$this->middleware('isLogin');
    }

    public function index()
    {
        return view('login');
    }

    public function validateLogin(Request $req)
    {
        $user = User::where('username',$req->username)->first();
        if($user)
        {
            if(!Hash::check($req->password,$user->password))
            {
                return redirect('/login')->with('status','error');
            }
            $user_priv = UserPriv::where('user_id',$user->id)
                    ->where('syscode','bidding')
                    ->first();
            if(!$user_priv)
                return redirect('/login')->with('status','denied');

            Session::put('user',$user);
            Session::put('level',$user_priv->level);
            Session::put('isLogin',true);

            LogCtrl::saveLogs("<add>$user->fname $user->lname</add> <b>logged in.</b>");
            return redirect('/admin');

        }else{
            return redirect('/login')->with('status','error');
        }
    }

    public function logoutUser()
    {
        Session::flush();
        return redirect('/');
    }
}
