<?php

namespace App\Http\Controllers;

use App\Consultation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeCtrl extends Controller
{
    public function index()
    {
        return view('home.index',[
            'menu' => 'home'
        ]);
    }
}
