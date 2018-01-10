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

Route::any('api/{m}/{a}',function($m,$a){
	$ns = "App\Http\Controllers\\${m}Controller";
	return (new $ns)->$a();
})

Route::get('/', function () {
    return view('welcome');
});
