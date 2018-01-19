<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\AdminMessage;

class adminMessageController extends ApiController
{


   public function __construct()
   {
      $this->model = new AdminMessage;
   }


   public function sendMessage()
   {
      if(!$message = request('content'))
         return err('not message');


      if(! $messageId = $this->saveText())
         return err('error');

      $r = $this->model->create(['message_id'=>$messageId]);
      return $this->resultReturn($r->id);
   }

   public function userGetMessage($count = null)
   {
      if(!session('user'))
         return err('not user log');

      $id = session('user')->id;

      if($count){
         $r = $this->joinMessageTable($id)->where('status',null)->count();
      }else{
         $r =  $this->joinMessageTable($id)->get();
      }


      return $this->resultReturn($r);
   }


   public function getUnreadCount()
   {
      return $this->userGetMessage(true);
   }

   public function joinMessageTable($id)
   {
      return  $this->model
            ->select('admin_messages.*','messageText.content','admin_message_statuses.status')
            ->leftJoin('messageText','admin_messages.message_id','=','messageText.id')
            ->leftJoin('admin_message_statuses',function($join)use($id){
               $join->on('admin_messages.id','=','admin_message_statuses.admin_message_id')
                     ->where('admin_message_statuses.user_id','=',$id)
                     ->where('admin_message_statuses.status','<>','delete');
            });
   }

}
