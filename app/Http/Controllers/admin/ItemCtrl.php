<?php

namespace App\Http\Controllers\admin;

use App\Item;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    function index($id, $info = array(), $edit = false)
    {
        if($id>0)
        {
            $data = Item::where('project_id',$id);
        }else{
            $data = Item::select('*');
        }


        $data = $data->orderBy('name','asc')
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
            'name' => $req->name,
            'amount' => $req->amount,
            'qty' => $req->qty
        ]);
        return redirect()->back()->with('status','save');
    }

    function update(Request $req, $id)
    {
        Item::where('id',$id)
            ->update([
                'project_id' => $req->project_id,
                'name' => $req->project_name,
                'amount' => $req->amount,
                'qty' => $req->qty
            ]);
        return redirect()->back()->with('status','update');
    }

    function delete($id)
    {
        $item = Item::find($id);
        $project_id = $item->project_id;
        $item->delete();
        return redirect('/admin/items/list/'.$project_id)->with('status','delete');
    }
}
