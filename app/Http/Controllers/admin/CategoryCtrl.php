<?php

namespace App\Http\Controllers\admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CategoryCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('login');
    }

    public function index($edit = false, $info = array()){
        $data = Category::select('*');

        $data = $data->orderBy('name','asc')
                    ->paginate(30);

        return view('admin.category',[
            'menu' => 'category',
            'data' => $data,
            'edit' => $edit,
            'info' => $info
        ]);
    }

    public function edit($id)
    {
        $info = Category::find($id);
        return self::index(true, $info);
    }

    public function save(Request $req){
        $check = self::checkName($req->categoryName);
        if($check)
            return redirect()->back()->with('status','duplicate');
        Category::create([
            'name' => ucwords($req->categoryName)
        ]);
        self::saveLogs(" <add>created</add> category <b>$req->categoryName</b>");
        return redirect()->back()->with('status','save');
    }

    function checkName($name)
    {
        $check = Category::where('name',$name)->first();
        if($check)
            return true;
        return false;
    }

    function update(Request $req, $id)
    {
        Category::find($id)
            ->update([
                'name' => ucwords($req->categoryName)
            ]);
        self::saveLogs(" <upd>updated</upd> category <b>$req->categoryName</b>");
        return redirect()->back()->with('status','update');
    }

    function delete($id)
    {
        $cat = Category::find($id);
        self::saveLogs(" <rm>deleted</rm> category <b>$cat->name</b>");
        $cat->delete();
        return redirect('/admin/category')->with('status','update');
    }

    function saveLogs($activity)
    {
        $user = Session::get('user');
        LogCtrl::saveLogs("<b>$user->fname $user->lname</b> $activity.");
    }
}
