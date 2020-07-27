<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use App\Project;
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

    public function projects($id)
    {
        $cat = Category::find($id);
        $projects = Project::where('cat_id',$id)->orderBy('name','asc')->get();
        return view('home.project',[
            'menu' => 'manage',
            'cat_name' => $cat->name,
            'projects' => $projects
        ]);
    }

    static function countItems($project_id)
    {
        $count =  Item::where('project_id',$project_id)->count();
        return $count;
    }
}
