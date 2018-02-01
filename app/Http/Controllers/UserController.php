<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \App\User;

class UserController extends ApiController
{


   /**
    * Signup Rules
    *
    * @var Array
    */
   private $signupRules = [
      'username'=>'required|between:6,32|unique:users',
      'password'=>'required|min:6',
      'email'=>'required|email|unique:users',
      'tel'=>'required|unique:users',
   ];





   /**
    * [__construct description]
    * @Yuan1998
    * @DateTime 2018-01-23T15:16:51+0800
    */
   public function __construct(){
      // $model = "\App\user";

      // $this->model = new $model;
      $this->model = new User;
   }


   /**
    * Login Api
    * @Yuan1998
    * @DateTime 2018-01-23T15:03:59+0800
    * @return   Array                   ['success'=>true|false,'data|msg'=>Array]
    */
   public function login()
   {

      if(sessiony('user'))
         return err('请先登出');

      if(!($user = $this->loginValidate()))
         return err('用户名或密码有误');


      newSession()->saveUserId($user->id);
      return suc();
   }



   /**
    * Login Validator.
    * @Yuan1998
    * @DateTime 2018-01-23T15:05:14+0800
    * @return   Array|false                   Validate pass,return data,else return false.
    */
   private function loginValidate()
   {

      if(!($username = request('username'))||!($password=request('password')))
         return false;

      $user=$this->model->where('username',$username)->orWhere('tel',$username)->orWhere('email',$username)->first();


      if(!$user)
         return false;


      if(!Hash::check($password,$user['password']))
         return false;
      return $user;
   }



   /**
    * Signup Api
    * @Yuan1998
    * @DateTime 2018-01-23T15:06:25+0800
    * @return   Array                   signup success return true&lastId,else return false.
    */
   public function signup()
   {

      // get form data and validate

      if( !$data = $this->signupValidate())
         return $this->getError();



      $r = $this->model->create($data);

      return $r ? suc($r->id) : err('error');

   }




   /**
    * Signup validator.
    * @Yuan1998
    * @DateTime 2018-01-23T15:07:49+0800
    * @return   Array|false                   On success return validate data. else return false.
    */
   private function signupValidate()
   {
      // get need data
      $data =request()->toArray();


      $data = $this->validator($this->signupRules,$data);


      if(!$data)
         return false;

      $data['password'] = Hash::make($data['password']);

      return $data;
   }



   /**
    * Login out Api
    * @Yuan1998
    * @DateTime 2018-01-23T15:08:53+0800
    * @return   Array                   ['success'=>true]
    */
   public function logout()
   {
      // session in remove user

      newSession()->removeUserId();

      return suc();
   }



   /**
    * judge is login.
    *
    * @Yuan1998
    * @DateTime 2018-01-23T15:09:35+0800
    * @return   boolean                  [description]
    */
   public function is_login()
   {

      if($a = sessiony('user')){

         $want = request('want');

         return $want ? suc($a->_all($want)) : suc();
      }

      return err(null,200);
   }


   /**
    * get User Data.
    * @Yuan1998
    * @DateTime 2018-01-23T15:10:33+0800
    * @return   Array                   On success return true&&user data. fail return false&&errorMsg.
    */
   public function getUserData(){
      $user =sessiony('user');

      if(!$user )

         return err('not user');

      return suc($user->toArray());

   }

   /**
    * find username exists
    * @Yuan1998
    * @DateTime 2018-01-27T15:17:21+0800
    * @return   array                   data = true|false
    */
   public function usernameExists()
   {
      $key = 'username';
      return $this->find_key_exists($key);
   }


   /**
    * find email exists
    * @Yuan1998
    * @DateTime 2018-01-27T15:18:10+0800
    * @return   array                    data = true|false
    */
   public function emailExists()
   {
       $key = 'email';
       return $this->find_key_exists($key);
   }


   /**
    * find tel exists
    * @Yuan1998
    * @DateTime 2018-01-27T15:18:38+0800
    * @return   Array
    */
   public function telExists()
   {
       $key = 'tel';
       return $this->find_key_exists($key);
   }


   /**
    * the function is find xxxExists core;
    * @Yuan1998
    * @DateTime 2018-01-27T15:19:03+0800
    * @param    String                   $key key get value in the request.
    * @return   boolean                        find result
    */
   private function find_key_exists($key)
   {
      $value = request($key);
      $r = $this->model->where($key,$value)->exists();
      return suc($r);
   }

   /**
    * The method is change User Avatar
    * @Yuan1998
    * @DateTime 2018-01-31T16:58:15+0800
    * @return   [type]                   [description]
    */
   public function changeUserAvatar()
   {


      if(!$user = nowUser())
        return err('Not User');

      if(!$file = request('file'))
        return err('not File');

      $newFile = $this->parseBase64($file);

      if(!$newFile)
        return err('upload Err');

      $name = @sessiony('user')->avatar_url['name'];

      if($name)
        $this->removeFile($name);

      $user->avatar_url = $newFile;
      $r = $user->save();


      return $this->resultReturn($r);
   }

}
