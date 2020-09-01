<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('login');
    }

    public function index(){
        return view('admin.index',[
            'menu' => 'home'
        ]);
    }


}
