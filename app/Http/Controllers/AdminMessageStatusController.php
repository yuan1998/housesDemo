<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\AdminMessageStatus;

class AdminMessageStatusController extends ApiController
{

    public function __construct()
    {
      $this->model = new AdminMessageStatus;
    }

    public function userRead()
    {

      if(!$data = $this->userReadValidator())
         return $this->getError();

      // dd($data);

      $r = $this->model->create($data);

      return $this->resultReturn($r->id);

    }

    private function userReadValidator()
    {
      $rules =
      [
         'admin_message_id'=>'required|exists:admin_messages,id',
         'user_id'=>'required|exists:users,id'
      ];

      $data =
      [
         'admin_message_id'=>request('id'),
         'user_id'=>session('user')->id,
      ];

      return $this->validator($rules,$data);
    }
}
