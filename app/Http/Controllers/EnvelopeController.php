<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Envelope;

class envelopeController extends ApiController
{


   protected $rules =
   [
      'user_id'=>'required|exists:users,id',
      'send_id'=>'required|exists:users,id',
      'content'=>'required',
   ];

   protected $changeStatusRule =
   [
      'id'=>'required|exists:envelopes',
   ];


   public function __construct(){
      $this->model = new Envelope;
   }

   public function sendMessage()
   {


      if(! $data = $this->sendMessageVildator())
         return $this->getError();


      if(!($messageId = $this->saveText()))
         return err('content error');

      $r = $this->send($messageId,$data);
      return $r === false ? suc($r) : err('error');

   }

   private function sendMessageVildator()
   {
      $data =
      [
         'send_id'=>sessiony('user')->id,
         'user_id'=>request('recipient'),
         'content'=>request('msg'),
      ];


      return $this->validator($this->rules,$data);
   }


   private function send($messageId,$data)
   {

      $data =
      [
         'message_id'=>$messageId,
         'user_id'=>$data['user_id'],
         'send_id'=>$data['send_id']
      ];


      $r = $this->model->create($data);
      dd($r);
      return $r ? $r->id : false;

   }



   public function getUserMessage()
   {

      if(!$id =userIsLogin())
         return err('not user log');


      $r = $this->model
            ->with('sendUser')
            ->with('message')
            // ->select('envelopes.*','messageText.content','users.username')
            // ->join('messageText','envelopes.message_id','=','messageText.id')
            // ->join('users','envelopes.send_id','=','users.id')
            ->where('status','<>','delete')
            ->where('user_id',$id)
            ->orderBy('id','desc')
            ->paginate(10);

      return $this->resultReturn($r);
   }

   public function getUnreadCount()
   {

      if(!$id =userIsLogin())
         return err('not user log');

      $r = $this->model
            ->select('envelopes.*','messageText.content')
            ->join('messageText','envelopes.message_id','=','messageText.id')
            ->where('status','unread')
            ->where('user_id',$id)
            ->count();

      return $this->resultReturn($r);
   }


   /**
    * The Method Is User Read Envelope change Status Api;
    * @Yuan1998
    * @DateTime 2018-02-03T12:45:14+0800
    * @param    string                   $to [description]
    * @return   [type]                       [description]
    */
   public function envelopeRead($to = 'read')
   {

      if(!$id =userIsLogin())
         return err('not user');

      $eid = request('id');

      $data = $this->model->find($eid);

      if($data->user_id != $id)
         return err('not you envelope');

      $data->status= $to;

      $r = $data->save();

      return $this->resultReturn($r);

   }

   public function envelopeDelete()
   {

      return $this->envelopeRead('delete');

   }

   protected function changeStatusValidator()
   {
      $data = ['id'=>request('id')];

      return $this->validator($this->changeStatusRule,$data);

   }



}
