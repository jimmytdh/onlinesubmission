<?php

namespace App\Http\Controllers\admin;

use App\Bid;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SubmitCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('login');
    }

    function index($bac_no = null, $info = null)
    {
        return view('admin.submission',[
            'menu' => 'report',
            'sub' => 'submit',
            'bac_no' => $bac_no,
            'info' => $info
        ]);
    }

    function search(Request $req)
    {
        $proj = Project::where('bac_no',$req->bac_no)->first();
        if(!$proj)
            return redirect('/admin/report/submission')->with('status','notfound');

        $info = Bid::where('project_id',$proj->id)->get();

        return self::index($req->bac_no, $info);
    }

    function download($file,$id)
    {
        $bid = Bid::find($id);
        if($file=='financial'){
            $download = $bid->financial_file;
        }else{
            $download = $bid->technical_file;
        }
        echo $download;

        return Storage::disk('upload')->download($download);
    }
}
