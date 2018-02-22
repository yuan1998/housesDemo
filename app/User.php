<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;



    /**
     * The Attribute is Protection Column.
     * @var array
     */
    protected $guarded = ['id'];


    /**
     * The Attribute is set Table Name.
     * @var string
     */
    public $table = 'users';


    /**
     * The Attribute is Users Permissions Leave.
     * @var Array
     */
    public $userPermissionList = [
        '1'=>'user',
    ];



    /**
     * The Attribute is set Column Type.
     * @var Array
     */
    public $casts=[
      'data'=>'json',
      'logs'=>'json',
      'avatar_url'=>'json'
    ];

        /**
     * Model Fillable.
     * @var Array
     */
    protected $fillable = ['username','password','email','tel','permission','nick_name'];




    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



}
