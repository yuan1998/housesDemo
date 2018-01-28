<?php

use Illuminate\Http\Request;
use \App\Http\Controllers\HouseController as HouseC;
use \App\Http\Controllers\UserController as UserC;
use \App\Http\Controllers\EnvelopeController as EnvelopeC;


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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//   return $request->user();
// });

Route::group(['prefix'=>'user'],function(){

   Route::any('usernameExists','UserController@usernameExists');

   Route::any('emailExists','UserController@emailExists');

   Route::any('telExists','UserController@telExists');

   Route::any('login','UserController@login');

   Route::any('signup','UserController@signup');

   Route::any('is_login','UserController@is_login');

   Route::any('logout','UserController@logout')->middleware('Api:user');

   Route::any('getUserData','UserController@getUserData')->middleware('Api:user');

   Route::any('getUserList','UserController@getUserList')->middleware('Api:admin');

});


Route::group(['prefix'=>'house'],function(){

   Route::any('getStatusList','HouseController@getStatusList');

   Route::any('read','HouseController@read');

   Route::any('getSellingHouses','HouseController@getSellingHouses');

   Route::any('searchTitle','HouseController@searchTitle');

});


Route::group(['prefix'=>'commissioned'],function(){

   Route::any('create','CommissionedController@createCommissioned')->middleware('Api:user');

   Route::any('read','CommissionedController@getUserCommissioneds')->middleware('Api:user');

   Route::any('readId','CommissionedController@getIdCommissioned')->middleware('Api:user');

   Route::any('statusList','CommissionedController@getStatusList');

});

Route::group(['prefix'=>'envelope'],function(){

   Route::any('getUserMessage','EnvelopeController@getUserMessage')->middleware('Api:user');

   Route::any('read','EnvelopeController@envelopeRead')->middleware('Api:user');

   Route::any('getUnreadCount','EnvelopeController@getUnreadCount')->middleware('Api:user');

});

Route::group(['prefix'=>'adminMessage'],function(){

   Route::any('userGetMessage','adminMessageController@userGetMessage')->middleware('Api:user');

   Route::any('getUnreadCount','adminMessageController@getUnreadCount')->middleware('Api:user');


});

Route::group(['prefix'=>'adminMessageStatus'],function(){
   Route::any('userRead','adminMessageStatusController@userRead')->middleware('Api:user');
});


/**
 *  The Route if All Api Entrance.
 *
 * @param ModelName $m
 * @param ActionName $a
 *
 */
// Route::any('/{m}/{a}',function($m,$a){
//    // $ns = "App\Http\Controllers\\${m}Controller";

//    return (new $ns($m))->$a();
// });





