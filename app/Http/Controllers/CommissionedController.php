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


   public $statusList=
   [
      'audit'=>'审核中',
      'pass'=>'审核通过,请补全资料',
      'unpass'=>'审核失败',
      'valuation'=>'估价中',
      'sell'=>'在售',
      'pay'=>'交易中',
      'complete'=>'交易完成',
      'close'=>'委托已关闭'
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
      $data = request()->toArray();
      $data['user_id'] = sessiony('user')->id;

      return $this->validator($this->createRule,$data);
   }

   public function getUserCommissioneds()
   {

      if(! $id = userIsLogin())
         return err('not user log');

      $r = $this->model->where('user_id',$id)->orderBy('id', 'desc')->get();

      return suc($r);

   }

   public function getIdCommissioned()
   {

      $r = $this->model->where('id',request('id'))->where('user_id',sessiony('user')->id)->first();
      return $this->resultReturn($r);
   }

   public function getStatusList()
   {
      return suc($this->statusList);
   }

   public function getCurrentPage()
   {
      $r = $this->model->orderBy('id','desc')->where('status','<>','off')->paginate(5);
      return $this->resultReturn($r);
   }

   public function getPageCount()
   {
      $r = $this->model->where('status','<>','off')->count();
      if(!$r)
         return err();

      return $this->resultReturn(ceil($r/5));
   }


}
