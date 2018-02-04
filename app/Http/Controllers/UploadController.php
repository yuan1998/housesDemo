<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends ApiController
{
    public function image()
    {

      if(!$imgstr = request('file'))
         return err();

      $r = $this->parseBase64($imgstr);

      return $this->resultReturn($r);
    }


    public function deleteFile()
    {
      $fileName = request('file');
      $path = base_path()."/public/storage/img/";
      unlink($path.$fileName);
    }
}
