<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends ApiController
{
	// signup rules 
	private $signupRules = [
		'username'=>'required|between:6,32|unique:users',
		'password'=>'required|min:6',
		'email'=>'required|email|unique:users',
		'tel'=>'required|unique:users',
	];

	private $signupColumns = ['username','password','email','tel'];

	// login 
	public function login()
	{	
		/*
			if is login.
			return error msg.
		 */
		if($this->is_login()->getData()->success)
			return err('请先登出');

		/*
			login validator .
			if pass , data save to session.
			else return false.
		 */
		if(!($user = $this->loginValidate()))
			return err('用户名或密码有误');

		session(['user'=>$user]);
		return suc();
	}	

	// login validate
	private function loginValidate()
	{
		/*
			get username & password.
			then judgment value is not it null.
		 */
		if(!($username = request('username'))||!($password=request('password')))
			return false;

		/*
			by username find user data.
		 */
		$user=$this->model->where('username',$username)->first();

		/*
			find result if null return false.
		 */
		if(!$user)
			return false;

		/*
			contrast password is consistent.
			if unconsistent return false.
		 */
		if(!Hash::check($password,$user['password']))
			return false;
		return $user;
	}

	//sigin 	
	public function signup()
	{

		// get form data and validate

		if( !$data = $this->signupValidate())
			return $this->getError();

		// dd($data);

		$r = $this->model->create($data);

		return $r ? suc($r->id) : err('error');
	}

	// signup validate 
	private function signupValidate()
	{
		// get need data
		$data =request()->only($this->signupColumns);

		// data in validate
		$data = $this->validator($this->signupRules,$data);

		/*
			judgment validate result.
			if fail return false
		 */ 
		if(!$data)
			return false;

		/*
			judgment data length and must data length is it equal
			if not retrun false
		 */
		if(count($data) != count($this->signupColumns)){
			$this->error = 'params error';
			return false;
		}

		/*
			all validated pass.
			hash password. 
			return data.
		 */
		$data['password'] = Hash::make($data['password']);

		return $data;
	}



	// logout
	public function logout()
	{
		// session in remove user
		
		session()->forget('user');

		return suc();
	}

	// is_login 
	public function is_login()
	{
		// judgment session user exists;
		if(session()->has('user')){
			/*
				session user exists;
				judgment request(want) 
				if exists return want to data
				else return true
			 */
			$want = request('want');
			return $want ? suc(session('user')->all($want)) : suc();
		}
		// unlogin return false
		return err();
	}

}
