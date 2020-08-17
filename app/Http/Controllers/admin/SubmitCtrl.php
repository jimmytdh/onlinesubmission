<?php

namespace App\Http\Controllers\admin;

use App\Bid;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SubmitCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('login');
    }

    function index()
    {
        $bac_no = Session::get('bac_no');
        $proj = Project::where('bac_no',$bac_no)->first();
        $notfound = false;
        $info = null;
        if(!$proj){
            $notfound = true;
        }else{
            $info = Bid::where('project_id',$proj->id)
                ->orderBy('ref_no','asc')
                ->orderBy('created_at','asc')
                ->get();
        }

        return view('admin.submission',[
            'menu' => 'report',
            'sub' => 'submit',
            'bac_no' => $bac_no,
            'info' => $info,
            'notfound' => $notfound
        ]);
    }

    function search(Request $req)
    {
        Session::put('bac_no',$req->bac_no);
        return redirect('/admin/report/submission');
    }

    function download($file,$id)
    {
        $bid = Bid::find($id);
        if($file=='financial'){
            $download = $bid->financial_file;
        }else{
            $download = $bid->technical_file;
        }
        ob_end_clean();
        return Storage::disk('upload')->download($download);
    }

    function updateRemarks(Request $req)
    {
        Bid::find($req->bid_id)
            ->update([
                'remarks' => $req->remarks,
                'final_status' => $req->status
            ]);

        return redirect('/admin/report/submission')->with('status','updated');
    }
}
