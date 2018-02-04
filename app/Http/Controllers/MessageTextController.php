<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\MessageText;

class MessageTextController extends Controller
{

   public function __construct(){
      $this->model = new MessageText;
   }

   public static function saveMessageContent($msg)
   {

      $r = MessageText::create(['content'=>$msg]);
      return $r? $r->id : false;

   }
}
