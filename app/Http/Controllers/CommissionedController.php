<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Commissioned;

class CommissionedController extends ApiController
{

   public $createRule =
   [
      'community'=>'required',
      'unit_number'=>'required',
      'building_number'=>'required',
      'house_number'=>'required',
      'constant'=>'required',
      'tel'=>'required',
      'user_id'=>'required|exists:users,id',
      'expect_price'=>'required',
   ];


   public function __construct()
   {
      $this->model = new Commissioned;
   }

   public function createCommissioned()
   {
      if(!$data =$this->createValidator())
         return $this->getError();

      $r =  $this->model->create($data);
      return $this->resultReturn($r->id);
   }

   private function createValidator()
   {
      $data = requset()->toArray();
      $data['user_id'] = session('user')->id;

      return $this->validator($this->createRule,$data)
   }
}
