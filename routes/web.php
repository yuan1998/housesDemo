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

Route::any('/api/{m}/{a}',function($m,$a){
	$ns = "App\Http\Controllers\\${m}Controller";
	// dd($ns);
	return (new $ns($m))->$a();
});

Route::get('admin/{a}', function ($page) {
    return view("admin.$page");
});
Route::get('user/{a}', function ($page) {
    return view("user.$page");
});
Route::get('/', function () {
    return view("public.home");
});

