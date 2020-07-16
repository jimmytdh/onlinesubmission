<?php

namespace App\Http\Controllers\admin;

use App\Project;
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
}
