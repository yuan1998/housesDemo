<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\AdminMessage;

class adminMessageController extends ApiController
{



   /**
    * new Model
    *
    * @Yuan1998
    * @DateTime 2018-01-24T15:10:49+0800
    */
   public function __construct()
   {
      $this->model = new AdminMessage;
   }



   /**
    * send Message Api
    *
    * @Yuan1998
    * @DateTime 2018-01-24T15:11:00+0800
    * @return   [Array]                   Result success: true|false
    */
   public function sendMessage()
   {
      if(!$message = request('content'))
         return err('not message');


      if(! $messageId = $this->saveText())
         return err('error');

      $r = $this->model->create(['message_id'=>$messageId]);
      return $this->resultReturn($r->id);
   }





   /**
    * get user All Messages
    *
    * @Yuan1998
    * @DateTime 2018-01-24T15:11:45+0800
    * @param    boolean                   $count [On $count is true,return user Unread Messages.]
    * @return   Array                          Result Success: true|false & Data : data|errorMsg
    */
   public function userGetMessage($count = false)
   {
      if(! $id = userIsLogin())
         return err('not user log');


      if($count){
         $r = $this->joinMessageTable($id)->where('status',null)->count();
      }else{
         $r =  $this->joinMessageTable($id)->get();
      }


      return $this->resultReturn($r);

   }



   /**
    * Get User Unread Messages Count.
    *
    * @Yuan1998
    * @DateTime 2018-01-24T15:15:32+0800
    * @return   [type]                   [description]
    */
   public function getUnreadCount()
   {
      return $this->userGetMessage(true);
   }



   /**
    * Join MessageText Get Message Content.
    * Join AdminMessageStatuses Get Message Status.
    *
    * @Yuan1998
    * @DateTime 2018-01-24T15:16:02+0800
    * @param    String                   $id User Id .
    * @return   Object                       Model $this.
    */
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
