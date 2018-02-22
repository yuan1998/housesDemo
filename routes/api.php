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

   Route::any('changeAvatar','UserController@changeUserAvatar')->middleware('Api:user');

   Route::any('getAllUser','UserController@getAllUser')->middleware('Api:admin');

   Route::any('isAdmin','UserController@isAdmin')->middleware('Api:admin');

   Route::any('getUserCount','UserController@getUserCount')->middleware('Api:admin');
   Route::any('getUserInfo','UserController@getUserInfo')->middleware('Api:admin');
   Route::any('changeUserData','UserController@changeUserData')->middleware('Api:admin');
   Route::any('createUser','UserController@createUser')->middleware('Api:admin');

   Route::any('change','UserController@change')->middleware('Api:user');

});


Route::group(['prefix'=>'house'],function(){

   Route::any('status','HouseController@getStatusList');

   Route::any('read','HouseController@read');


   Route::any('searchTitle','HouseController@searchTitle');

   Route::any('file','HouseController@sendFile');

   Route::any('addData','HouseController@add')->middleware('Api:user');

   Route::any('getUserHouse','HouseController@getUserHouse')->middleware('Api:user');

   Route::any('houseAuditPass','HouseController@houseAuditPass');

   Route::any('addDataValidator','HouseController@isUserHouse')->middleware('Api:user');

   Route::any('additional','HouseController@addData')->middleware('Api:user');

   Route::any('getHotHouse','HouseController@getHotHouse');

   Route::any('sellingHouseInfo','HouseController@sellingHouseInfo');

   Route::any('getAuditCount','HouseController@getAuditCount')->middleware('Api:admin');

   Route::any('getSellingCount','HouseController@getSellingCount')->middleware('Api:admin');

   Route::any('sellHouse','HouseController@getSellHouse')->middleware('Api:user');

   Route::any('allHouse','HouseController@getAllHouse')->middleware('Api:admin');

   Route::any('auditHouse','HouseController@getAuditHouse')->middleware('Api:admin');

   Route::any('getHouseInfo','HouseController@getHouseInfo')->middleware('Api:admin');

   Route::any('houseEdit','HouseController@houseEdit')->middleware('Api:admin');

   Route::any('closeHouse','HouseController@closeHouse')->middleware('Api:admin');

   Route::any('addHouse','HouseController@addHouse')->middleware('Api:admin');

   Route::any('getLngLat','HouseController@getLngLat');

   Route::any('clone','HouseController@copyHouse');

});


Route::group(['prefix'=>'commissioned'],function(){

   Route::any('create','CommissionedController@createCommissioned')->middleware('Api:user');

   Route::any('userRead','CommissionedController@getUserCommissioneds')->middleware('Api:user');

   Route::any('readId','CommissionedController@getIdCommissioned')->middleware('Api:user');

   Route::any('statusList','CommissionedController@getStatusList');

   Route::any('getCount','CommissionedController@getPageCount')->middleware('Api:user');

   Route::any('getPage','CommissionedController@getCurrentPage')->middleware('Api:user');

   Route::any('getAll','CommissionedController@getAll')->middleware('Api:admin');


});

Route::group(['prefix'=>'envelope'],function(){

   Route::any('getMessage','EnvelopeController@getUserMessage')->middleware('Api:user');

   Route::any('readStatus','EnvelopeController@envelopeRead')->middleware('Api:user');

   Route::any('getUnreadCount','EnvelopeController@getUnreadCount')->middleware('Api:user');

   Route::any('send','EnvelopeController@sendMessage')->middleware('Api:user');

});

Route::group(['prefix'=>'adminMessage'],function(){

   Route::any('userGetMessage','AdminMessageController@userGetMessage')->middleware('Api:user');

   Route::any('getUnreadCount','AdminMessageController@getUnreadCount')->middleware('Api:user');

   Route::any('send','AdminMessageController@send')->middleware('Api:admin');

   Route::any('unreadTitle','AdminMessageController@getUnreadMessageTitle')->middleware('Api:user');


});

Route::group(['prefix'=>'adminMessageStatus'],function(){

   Route::any('readStatus','AdminMessageStatusController@userRead')->middleware('Api:user');

});

Route::group(['prefix'=>'upload'],function(){
   Route::post('image','UploadController@image');
});

Route::group(['prefix'=>'img'], function(){
   Route::get('/','ImageController@imageFile');

   Route::any('save','ImageController@saveFile');

   Route::any('remove','ImageController@removeImage');
});

Route::group(['prefix'=>'reservation'], function(){

   Route::any('create','ReservationController@newReservation')->middleware('Api:user');
   Route::any('check','ReservationController@checkIsReservation')->middleware('Api:user');

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





