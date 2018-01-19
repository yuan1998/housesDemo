<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\MessageText;

class MessageTextController extends Controller
{

   public function __construct(){
      $this->model = new MessageText;
   }

   public function saveMessageContent()
   {
      if(!($content = request('content')))
         return false;

      $r = MessageText::create(['content'=>$content]);
      return $r? $r->id : false;
   }
}
