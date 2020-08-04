<?php

namespace App\Http\Controllers;

use App\Bid;
use App\BidItem;
use App\Category;
use App\Item;
use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class HomeCtrl extends Controller
{
    public function index()
    {
        return view('home.index',[
            'menu' => 'home'
        ]);
    }

    public function projects($id)
    {
        $cat = Category::find($id);
        if(!$cat)
            return redirect('/');
        $projects = Project::where('cat_id',$id)
                ->where('date_open','>=',Carbon::now())
                ->orderBy('name','asc')->get();

        return view('home.project',[
            'menu' => 'manage',
            'cat_name' => $cat->name,
            'projects' => $projects
        ]);
    }

    public function items($id)
    {
        $items = Item::where('project_id',$id)
                ->orderBy('name','asc')
                ->get();
        return view('load.items',[
            'items' => $items
        ]);
    }

    public function submit($id)
    {
        $items = Item::where('project_id',$id)
            ->orderBy('name','asc')
            ->get();
        return view('load.submit',[
            'items' => $items
        ]);
    }

    public function submitBid(Request $req, $id)
    {
        $acronym = self::acronym($req->company);
        $ref_no = $acronym.date('Ymd').$id;

        $financial_file = $req->file('financial_file');
        $extension = $financial_file->getClientOriginalExtension();
        $financial_file_name = $ref_no."_financial.".$extension;
        Storage::disk('upload')->put($financial_file_name, File::get($financial_file));

        $technical_file = $req->file('technical_file');
        $extension = $technical_file->getClientOriginalExtension();
        $technical_file_name = $ref_no."_technical.".$extension;
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

        foreach($req->items as $i){
            BidItem::create([
                'bid_id' => $bid->id,
                'item_id' => $i
            ]);
        }

        return redirect('/track/'.$ref_no);
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
}
