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

// Route::any('/api/{m}/{a}',function($m,$a){
//    $ns = "App\Http\Controllers\\${m}Controller";
//    // dd($ns);
//    return (new $ns($m))->$a();
// });

// Route::get('/', function () {
//   return view("public.home");
// });
// Route::any('/img', function(){
//    $filename = request('file');
//     $path = base_path(). "/public/storage/img/" . $filename;

//     if(!File::exists($path)) {
//         return response()->json(['message' => 'Image not found.'], 404);
//     }

//     $file = File::get($path);
//     $type = File::mimeType($path);

//     $response = Response::make($file, 200);
//     $response->header("Content-Type", $type);

//     return $response;
// });
