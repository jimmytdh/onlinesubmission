<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','HomeCtrl@index');
Route::get('/category/show/{id}','HomeCtrl@projects');
Route::get('/project/items/{id}','HomeCtrl@items');
Route::get('/submit/{id}','HomeCtrl@submit');
Route::post('/submit/{id}','HomeCtrl@submitBid');
Route::post('/modify','HomeCtrl@modify');
Route::post('/track','HomeCtrl@submitTrack');
Route::get('/track/{ref_no}','HomeCtrl@track');
Route::get('/upcoming','HomeCtrl@upcoming');

Route::get('/dropzone','HomeCtrl@dropzone');
Route::post('/dropzone/upload','UploadCtrl@post_upload');

Route::get('/logout','LoginCtrl@logoutUser');
Route::get('/login','LoginCtrl@index')->middleware('isLogin');
Route::post('/login/validate','LoginCtrl@validateLogin');

Route::get('/admin','admin\HomeCtrl@index');
Route::get('/admin/chart','admin\HomeCtrl@chart');
Route::post('/admin/bulletin','admin\HomeCtrl@updateBulletin');


//Submission Process
Route::get('/admin/report/submission','admin\SubmitCtrl@index');
Route::post('/admin/report/submission','admin\SubmitCtrl@search');
Route::post('/admin/report/submission/remarks','admin\SubmitCtrl@updateRemarks');
Route::get('/admin/report/submission/download/{file}/{id}','admin\SubmitCtrl@download');

Route::get('/admin/report/logs','admin\LogCtrl@index');
//end submission


//Manage Categories
Route::get('/admin/category','admin\CategoryCtrl@index');
Route::post('/admin/category/save','admin\CategoryCtrl@save');
Route::get('/admin/category/edit/{id}','admin\CategoryCtrl@edit');
Route::post('/admin/category/update/{id}','admin\CategoryCtrl@update');
Route::get('/admin/category/delete/{id}','admin\CategoryCtrl@delete');
//End Categories

//Mange Projects
Route::get('/admin/projects/list/{id}','admin\ProjectCtrl@index');
Route::post('/admin/projects/list/{id}','admin\ProjectCtrl@save');
Route::get('/admin/projects/edit/{id}','admin\ProjectCtrl@edit');
Route::post('/admin/projects/update/{id}','admin\ProjectCtrl@update');
Route::get('/admin/projects/delete/{id}','admin\ProjectCtrl@delete');
//End Projects

//Mange Items
Route::get('/admin/items/list/{id}','admin\ItemCtrl@index');
Route::post('/admin/items/list/{id}','admin\ItemCtrl@save');
Route::get('/admin/items/edit/{id}','admin\ItemCtrl@edit');
Route::post('/admin/items/update/{id}','admin\ItemCtrl@update');
Route::get('/admin/items/delete/{id}','admin\ItemCtrl@delete');
//End Projects


Route::get('/loading',function(){
    return view('load.loading');
});

Route::get('/error',function(){
    return view('error',['menu'=>'']);
});
