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


    /**
     * The Methods is User read Message Create Log;
     * @Yuan1998
     * @DateTime 2018-02-03T12:38:55+0800
     * @return   [type]                   [description]
     */
    public function userRead()
    {

      if(!$id = userIsLogin())
        return err();

      $aid = request('id');

      $c = $this->model->where('admin_message_id',$aid)->where('user_id',$id)->exists();

      if($c)
        return err('readed');

      $r = $this->model->create(['admin_message_id'=>$aid,'user_id'=>$id]);

      return $this->resultReturn($r->id);

    }
}
