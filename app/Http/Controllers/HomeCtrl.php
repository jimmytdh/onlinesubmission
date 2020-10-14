<?php

namespace App\Http\Controllers;

use App\Bid;
use App\BidItem;
use App\Category;
use App\Http\Controllers\admin\LogCtrl;
use App\Item;
use App\Project;
use App\SystemInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class HomeCtrl extends Controller
{
    public function index()
    {
        return view('home.index', [
            'menu' => 'home'
        ]);
    }

    public function projects($id)
    {
        $cat = Category::find($id);
        if (!$cat)
            return redirect('/');
        $projects = Project::where('cat_id', $id)
            ->where('date_open', '<=', Carbon::now())
            ->where('status','open')
            ->orderBy('name', 'asc')->get();

        return view('home.project', [
            'menu' => 'manage',
            'cat_name' => $cat->name,
            'projects' => $projects
        ]);
    }

    function dropzone()
    {
        return view('home.upload',[
            'menu' => 'manage'
        ]);
    }

    public function items($id)
    {
        $items = Item::where('project_id', $id)
            ->orderBy('item_no', 'asc')
            ->get();
        return view('load.items', [
            'items' => $items
        ]);
    }

    public function submit($id)
    {
        $items = Item::where('project_id', $id)
            ->orderBy('item_no', 'asc')
            ->get();
        return view('load.submit', [
            'items' => $items
        ]);
    }

    public function submitBid(Request $request, $id)
    {
        $acronym = self::acronym($request->company);
        $ref_no = $acronym . date('Ymd') . $id;
        $this->validate($request, [
            'items' => 'required',
            'financial_file' => 'max:25000',
            'technical_file' => 'max:25000',
        ]);

        if($request->hasFile('financial_file'))
        {
            $ext = $request->file('financial_file')->getClientOriginalExtension();
            // filename to store
            $financial_file_name = $ref_no."_".time().'.'.$ext;
            //upload file
            $path = $request->file('financial_file')->storeAs('public/upload',$financial_file_name);
        }

        if($request->hasFile('technical_file'))
        {
            //get extension
            $ext = $request->file('technical_file')->getClientOriginalExtension();
            // filename to store
            $technical_file_name = $ref_no."_".time().'.'.$ext;
            //upload file
            $path = $request->file('technical_file')->storeAs('public/upload',$technical_file_name);
        }

        $bid = Bid::create([
            'project_id' => $id,
            'ref_no' => $ref_no,
            'company' => $request->company,
            'bidder' => $request->bidder,
            'contact' => $request->contact,
            'financial_file' => $financial_file_name,
            'technical_file' => $technical_file_name,
            'status' => 'original',
            'final_status' => 'pending',
            'remarks' => '',
        ]);

        foreach ($request->items as $i) {
            BidItem::create([
                'bid_id' => $bid->id,
                'item_id' => $i
            ]);
        }
        $bac_no = Project::find($id)->bac_no;
        LogCtrl::saveLogs("<b>$request->bidder</b> of <add>$request->company</add> submitted a bid for BAC No. <b>$bac_no</b> with <b>Ref. No. $ref_no</b>.");
        return redirect('/track/' . $ref_no);

    }
    public function submitBid2(Request $req, $id)
    {
        $acronym = self::acronym($req->company);
        $ref_no = $acronym . date('Ymd') . $id;

        //handle file upload
        $financial_file = $req->file('financial_file');
        $extension = $financial_file->getClientOriginalExtension();
        $financial_file_name = $ref_no . "_financial." . $extension;
        Storage::disk('upload')->put($financial_file_name, File::get($financial_file));

        $technical_file = $req->file('technical_file');
        $extension = $technical_file->getClientOriginalExtension();
        $technical_file_name = $ref_no . "_technical." . $extension;
        Storage::disk('upload')->put($technical_file_name, File::get($technical_file));

        $bid = Bid::create([
            'project_id' => $id,
            'ref_no' => $ref_no,
            'company' => $req->company,
            'bidder' => $req->bidder,
            'contact' => $req->contact,
            'financial_file' => $financial_file_name,
            'technical_file' => $technical_file_name,
            'status' => 'original',
            'final_status' => 'pending',
            'remarks' => '',
        ]);

        foreach ($req->items as $i) {
            BidItem::create([
                'bid_id' => $bid->id,
                'item_id' => $i
            ]);
        }
        $bac_no = Project::find($id)->bac_no;
        LogCtrl::saveLogs("<b>$req->bidder</b> of <add>$req->company</add> submitted a bid for BAC No. <b>$bac_no</b> with <b>Ref. No. $ref_no</b>.");
        return redirect('/track/' . $ref_no);
    }

    function modify(Request $req)
    {
        $bid = Bid::find($req->bid_id);
        $dt = date('mdHis');

        if($req->hasFile('financial_file'))
        {
            $ext = $req->file('financial_file')->getClientOriginalExtension();
            // filename to store
            $financial_file_name = $bid->ref_no . "_financial_modified$dt." . $ext;
            //upload file
            $path = $req->file('financial_file')->storeAs('public/upload',$financial_file_name);
        }

        if($req->hasFile('technical_file'))
        {
            //get extension
            $ext = $req->file('technical_file')->getClientOriginalExtension();
            // filename to store
            $technical_file_name = $bid->ref_no . "_technical_modified$dt." . $ext;
            //upload file
            $path = $req->file('technical_file')->storeAs('public/upload',$technical_file_name);
        }

        $bid = Bid::create([
            'project_id' => $bid->project_id,
            'ref_no' => $bid->ref_no,
            'company' => $bid->company,
            'bidder' => $bid->bidder,
            'contact' => $bid->contact,
            'financial_file' => $financial_file_name,
            'technical_file' => $technical_file_name,
            'status' => 'modified',
            'final_status' => 'pending',
            'remarks' => '',
        ]);
        $bac_no = Project::find($bid->project_id)->bac_no;
        LogCtrl::saveLogs("<b>$bid->bidder</b> of <add>$bid->company</add> submitted a <upd>modified documents</upd> of <b>Ref. No. $bid->ref_no</b>.");
        return redirect('/track/' . $bid->ref_no);
    }

    public function submitTrack(Request $req)
    {
        return redirect('/track/'.$req->ref_no);
    }

    public function track($ref_no)
    {
        $info = Bid::where('ref_no',$ref_no)
                ->orderBy('created_at','asc')
                ->first();
        if(!$info)
            return redirect('/error')->with('msg','Reference No. '.$ref_no);

        $project = Project::find($info->project_id);
        return view('home.track',[
            'info' => $info,
            'menu' => 'track',
            'ref_no' => $ref_no,
            'project' => $project
        ]);
    }

    static function countItems($project_id)
    {
        $count =  Item::where('project_id',$project_id)->count();
        return $count;
    }

    static function acronym($string){
        $words = preg_split("/[\s,_-]+/", $string);
        $acronym = "";
        foreach ($words as $w) {
            $acronym .= $w[0];
        }
        return strtoupper($acronym);
    }

    static function submission($ref_no)
    {
        $data = Bid::where('ref_no',$ref_no)
                ->orderBy('created_at','asc')
                ->get();
        return $data;
    }

    function upcoming()
    {
        return view('home.upcoming',[
            'menu' => 'upcoming'
        ]);
    }

    static function getBulletin()
    {
        $r = SystemInfo::where('section','bulletin')->first()->value;
        return $r;
    }
}
