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
         'send_id'=>session('user')->id,
         'user_id'=>request('recipient'),
         'content'=>request('content'),
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

      if(!session('user'))
         return err('not user log');

      $id = session('user')->id;

      $r = $this->model
            ->select('envelopes.*','messageText.content','users.username')
            ->join('messageText','envelopes.message_id','=','messageText.id')
            ->join('users','envelopes.send_id','=','users.id')
            ->where('status','<>','delete')
            ->where('user_id',$id)
            ->get();

      return $this->resultReturn($r);
   }

   public function getUnreadCount()
   {
      if(!session('user'))
         return err('not user log');

      $id = session('user')->id;

      $r = $this->model
            ->select('envelopes.*','messageText.content')
            ->join('messageText','envelopes.message_id','=','messageText.id')
            ->where('status','unread')
            ->where('user_id',$id)
            ->count();

      return $this->resultReturn($r);
   }


   public function envelopeRead($to = 'read')
   {

      if(!$data = $this->changeStatusValidator())
         return $this->getError();

      $r = $this->changeColumn($data['id'],'status',$to);

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
