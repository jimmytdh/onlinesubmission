<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('login');
    }

    static function countProjects($cat_id)
    {
        $count =  Project::where('cat_id',$cat_id)->count();
        return $count;
    }

    function index($id, $info = array(), $edit = false)
    {
        if($id>0)
        {
            $data = Project::where('cat_id',$id);
        }else{
            $data = Project::select('*');
        }


        $data = $data->orderBy('name','asc')
            ->paginate(30);
        $cat_name = Category::find($id)->name;

        $categories = Category::orderBy('name','asc')->get();

        return view('admin.project',[
            'menu' => 'category',
            'data' => $data,
            'edit' => $edit,
            'info' => $info,
            'id' => $id,
            'categories' => $categories,
            'cat_name' => $cat_name
        ]);
    }

    function edit($id)
    {
        $info = Project::find($id);
        return self::index($info->cat_id, $info, true);
    }

    function save(Request $req)
    {

        $check = Project::where('bac_no',$req->bac_no)->first();
        if($check)
            return redirect()->back()->with('status','duplicate');

        $status = 'close';
        if($req->date_open >= Carbon::now())
        {
            $status = 'open';
        }
        $date = "$req->date_open $req->time_open";
        $date = Carbon::parse($date)->format('Y-m-d H:i:s');

        Project::create([
                'cat_id' => $req->cat_id,
                'name' => $req->project_name,
                'bac_no' => $req->bac_no,
                'ABC' => $req->ABC,
                'date_open' => $date,
                'status' => $status
            ]);
        return redirect()->back()->with('status','save');
    }

    function update(Request $req, $id)
    {
        $check = Project::where('bac_no',$req->bac_no)->where('id','!=',$id)->first();
        if($check)
            return redirect()->back()->with('status','duplicate');

        $date = "$req->date_open $req->time_open";
        $date = Carbon::parse($date)->format('Y-m-d H:i:s');


        Project::where('id',$id)
            ->update([
                'cat_id' => $req->cat_id,
                'name' => $req->project_name,
                'bac_no' => $req->bac_no,
                'ABC' => $req->ABC,
                'date_open' => $date,
                'status' => $req->status
            ]);
        return redirect()->back()->with('status','update');
    }

    function delete($id)
    {
        $proj = Project::find($id);
        $cat_id = $proj->cat_id;
        $proj->delete();
        return redirect('/admin/projects/list/'.$cat_id)->with('status','delete');
    }
}
