<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});


// Route::any('/yo',function(){
//    $a = request('a');
//    $r = sessiony('user');
//    // dd(sessiony('user')->toArray());
//    // sessiony()->forget('a');
//    return $r->toArray();
//    return '1';
// });

Route::any('/{m}/{a}',function($m,$a){
   $ns = "App\Http\Controllers\\${m}Controller";

   return (new $ns($m))->$a();
});
