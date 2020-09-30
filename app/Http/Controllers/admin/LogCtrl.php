<?php

namespace App\Http\Controllers\admin;

use App\Logs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('login');
    }

    public function index()
    {
        $logs = Logs::orderBy('created_at','desc')->paginate(100);
        return view('admin.log',[
            'menu' => 'report',
            'sub' => 'logs',
            'logs' => $logs
        ]);
    }

    static function saveLogs($activity)
    {
        Logs::create([
            'activity' => $activity
        ]);
    }
}
