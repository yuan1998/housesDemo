<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \App\User;

class UserController extends ApiController
{
	// signup rules
	private $signupRules = [
		'username'=>'required|between:6,32|unique:users',
		'password'=>'required|min:6',
		'email'=>'required|email|unique:users',
		'tel'=>'required|unique:users',
	];

	protected $fillable = ['username','password','email','tel'];



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

		sessiony()->saveUserId($user->id);
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

		$user=$this->model->where('username',$username)->first();


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

		sessiony()->forget('user');

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

		if(sessiony('user')){

			$want = request('want');

			return $want ? suc(session('user')->_all($want)) : suc();
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



}
