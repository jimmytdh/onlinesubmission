<?php

namespace App\Http\Controllers\admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('login');
    }

    public function index(){
        $data = Category::select('*');

        $data = $data->orderBy('name','asc')
                    ->paginate(30);

        return view('admin.category',[
            'menu' => 'category',
            'data' => $data
        ]);
    }

    public function save(Request $req){
        $check = self::checkName($req->categoryName);
        if($check)
            return redirect()->back()->with('status','duplicate');
        Category::create([
            'name' => ucwords($req->categoryName)
        ]);
        return redirect()->back()->with('status','save');
    }

    function checkName($name)
    {
        $check = Category::where('name',$name)->first();
        if($check)
            return true;
        return false;
    }
}
