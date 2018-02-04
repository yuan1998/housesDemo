<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Response;
use Storage;


class ImageController extends Controller
{

    public function imageFile()
    {
      $filename = request('file');

      $file = Storage::disk('public')->get($filename);

      $type =Storage::disk('public')->mimeType($filename);

      $response = Response::make($file, 200);

      $response->header("Content-Type", $type);

      return $response;
    }

    public function saveFile()
    {


      $imgstr = request('file');

      $new_data=explode(";",$imgstr);

      $type= explode("/",$new_data[0])[1];

      $img= explode(",",$new_data[1])[1];

      $name = self::createFileName($type);

      $data = base64_decode($img);

       $r =Storage::disk('public')->put($name,$data);
       return [$r];
    }

    public static function createFileName($ext)
    {
      return date('Y-m-d-H-i-s') .'-'. rand(1010,2020). uniqid() .'.'. $ext;
    }




}
