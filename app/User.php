<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded = ['id'];

    public $table = 'users';

    public $userPermission = [
        '1'=>'user',
    ];

    public $casts=[
      'data'=>'json',
      'logs'=>'json',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function set_data()
    {
        $data = $this->data;

        array_set($data,$key,$value);

        $this->data = $data;

        $this->save();

    }


    public function get_data($key)
    {

        if(!$key){
            $data = $this->data;
        }elseif($key === 'user'){
            $data = $this;
            unset($data['data'],$data['logs']);
        }

      $A = (new \CustomHelp\HelpArray($data));

      return (($key !== 'user')&& ($key)) ? $A->_get($key) : $A;
    }




    public function addLog()
    {

        $logs = $this->logs ?: [];

        $logs[] = generateLog();

        $this->logs = $logs;

        $this->save();
    }

}
