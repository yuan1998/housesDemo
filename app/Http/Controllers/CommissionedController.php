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
      'contact'=>'required',
      'tel'=>'required',
      'user_id'=>'required|exists:users,id',
      'expect_price'=>'required',
      'city'=>'required',
   ];


   public $statusList=['audit'=>'审核中','pass'=>'审核通过,请补全资料','sell'=>'在售','pay'=>'交易中','complete'=>'交易完成','close'=>'委托已关闭'];

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
      $data = request()->toArray();
      $data['user_id'] = sessiony('user')->id;

      return $this->validator($this->createRule,$data);
   }

   public function getUserCommissioneds()
   {

      if(! $id = userIsLogin())
         return err('not user log');

      $r = $this->model->where('user_id',$id)->get();

      return $this->resultReturn($r);

   }

   public function getStatusList()
   {
      return suc($this->statusList);
   }


}
