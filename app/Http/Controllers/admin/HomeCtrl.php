<?php

namespace App\Http\Controllers\admin;

use App\Bid;
use App\BidItem;
use App\Logs;
use App\Project;
use App\SystemInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('login');
    }

    public function index(){
        $last_log = Logs::orderBy('created_at','desc')->first();
        return view('admin.index',[
            'menu' => 'home',
            'log' => $last_log
        ]);
    }

    public function chart()
    {
        $data = array();
        $today = Carbon::today()->addDay(-6);
        for($i=0; $i<7; $i++)
        {
            $data['day'][] = $today->format('M/d');
            $start = Carbon::parse($today)->startOfDay();
            $end = Carbon::parse($today)->endOfDay();
            $count = Bid::whereBetween('created_at',[$start,$end])->count();
            $data['count'][] = $count;
            $today->addDay(1);
        }
        return $data;
    }

    static function countOpenBid()
    {
        $projects = Project::where('date_open', '<=', Carbon::now())
            ->where('status','open')
            ->count();
        return $projects;
    }

    static function countSubmittedBid()
    {
        $start = Carbon::now()->startOfDay();
        $end = Carbon::now()->endOfDay();
        $bid = Bid::whereBetween('created_at',[$start,$end])->count();
        return $bid;
    }

    static function getBulletin()
    {
        $r = SystemInfo::where('section','bulletin')->first()->value;
        return $r;
    }

    public function updateBulletin(Request $req)
    {
        $bulletin = SystemInfo::where('section','bulletin')->first();
        $bulletin->update([
            'value' => $req->bulletin
        ]);
        return redirect()->back()->with('success','Bulletin successfully updated');
    }
}
