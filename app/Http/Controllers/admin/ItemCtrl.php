<?php

namespace App\Http\Controllers\admin;

use App\BidItem;
use App\Item;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ItemCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('login');
    }

    static function countItems($project_id)
    {
        $count =  Item::where('project_id',$project_id)->count();
        return $count;
    }

    static function getItemsByProjectID($project_id)
    {
        $items = Item::where('project_id',$project_id)->orderBy('item_no','asc')->get();
        return $items;
    }

    function index($id, $info = array(), $edit = false)
    {
        if($id>0)
        {
            $data = Item::where('project_id',$id);
        }else{
            $data = Item::select('*');
        }


        $data = $data->orderBy('item_no','asc')
            ->paginate(30);
        $proj = Project::find($id);

        $projects = Project::orderBy('bac_no','desc')->get();

        return view('admin.item',[
            'menu' => 'category',
            'data' => $data,
            'edit' => $edit,
            'info' => $info,
            'id' => $id,
            'projects' => $projects,
            'proj' => $proj
        ]);
    }

    function edit($id)
    {
        $info = Item::find($id);
        return self::index($info->project_id, $info, true);
    }

    function save(Request $req)
    {
        Item::create([
            'project_id' => $req->project_id,
            'item_no' => $req->item_no,
            'name' => $req->name,
            'unit' => $req->unit,
            'amount' => $req->amount,
            'qty' => $req->qty
        ]);
        self::saveLogs("<add>added</add> item <b>$req->item_no. $req->name, qty $req->qty, amount $req->amount</b>");
        return redirect()->back()->with('status','save');
    }

    function update(Request $req, $id)
    {
        Item::where('id',$id)
            ->update([
                'project_id' => $req->project_id,
                'item_no' => $req->item_no,
                'name' => $req->name,
                'unit' => $req->unit,
                'amount' => $req->amount,
                'qty' => $req->qty
            ]);
        self::saveLogs("<upd>updated</upd> item <b>$req->item_no. $req->name, qty $req->qty, amount $req->amount</b>");
        return redirect()->back()->with('status','update');
    }

    function delete($id)
    {
        $item = Item::find($id);
        self::saveLogs("<rm>deleted</rm> item <b>$item->item_no. $item->name</b>");
        $project_id = $item->project_id;
        $item->delete();
        return redirect('/admin/items/list/'.$project_id)->with('status','delete');
    }

    static function getItemByBid($bid_id)
    {
        $items = BidItem::select('items.*')
                    ->leftJoin('items','items.id','=','bid_items.item_id')
                    ->where('bid_items.bid_id',$bid_id)
                    ->get();
        return $items;
    }

    function saveLogs($activity)
    {
        $user = Session::get('user');
        LogCtrl::saveLogs("<b>$user->fname $user->lname</b> $activity.");
    }
}
