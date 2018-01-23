<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionY extends Model
{

    protected $guarded = ['id'];

    protected $fillable = ['token','user_id','data','expired_time','logs'];

    public $casts=[
      'data'=>'json',
      'logs'=>'json',
    ];

    protected $table = 'session_y';
    public $cache;


    public function hasUsers(){
      return $this->hasOne('\App\User','id','user_id');
    }

    public function createSession()
    {
      $this->token = $this->generateToken();

      $this->cache = $this->create(['expired_time'=>$this->expired_time(),'token'=>$this->token,'data'=>[]]);

      return $this->cache->token;
    }

    public function findSession()
    {
      $cache = $this->cache;

      if(!$cache)
         return false;

      if( $id = $cache->user_id)
         $this->findUser($id);

      return $this;

    }

    public function saveUserId($id)
    {

      $this->cache->user_id = $id;
      $this->cache->save();
      $this->findUser($id);

      $this->mergeData();
      $this->mergeLogs();
      dd($this->user);

      return $this;
    }

    /**
     * on Logout remove session user_id
     *
     * @Yuan1998
     * @DateTime 2018-01-23T14:22:28+0800
     * @return   [type]                   [description]
     */
    public function removeUserId_logout()
    {
      $this->cache->user_id = null;
      unset($this->user);
      $this->cache->save();
    }

    /**
     * save user data or save temporate data
     * @Yuan1998
     * @DateTime 2018-01-23T14:23:26+0800
     * @param    {data}                   $data ['a'=>'b']
     * @return   null
     */
    public function saveData($data=null)
    {

      if($data){
         $this->cache->data = $data;
      }
      $this->cache->save();

    }



    /**
     * On login. merge temporate data to user data.
     * @Yuan1998
     * @DateTime 2018-01-23T14:24:46+0800
     * @return   [type]                   [description]
     */
    public function mergeData()
    {

      if( $sData = $this->cache->data){

      $uData = $this->user->data ?:[];

      $this->user->data = array_merge($sData,$uData);

      $this->user->save();

      }
    }


    /**
     * On login merge temporate logs to user logs
     *
     * @Yuan1998
     * @DateTime 2018-01-23T14:25:28+0800
     * @return   null
     */
    public function mergeLogs()
    {

      if($slogs =$this->cache->logs){

         $ulogs = $this->user->logs ?:[];

         $this->user->logs = array_merge($slogs,$ulogs);
         $this->user->save();
      }
    }


    /**
     * On session user_id exists , find user.
     *
     * @Yuan1998
     * @DateTime 2018-01-23T14:26:00+0800
     * @param    [id]                   $id [user_id]
     * @return   [type]                       [description]
     */
    public function findUser($id)
    {

      $this->user = (new \App\User)->where('id',$id)->first();

    }



    /**
     * [generateToken description]
     * @Yuan1998
     * @DateTime 2018-01-23T14:28:02+0800
     * @return   [type]                   [description]
     */
    private function generateToken()
    {

      do{
         $token = uniqid().md5(time().'yuanyi');
      }while ($this->findToken($token));

      return $token;
    }

    public function findToken($token)
    {
      return ($this->cache = $this->where('token',$token)->first());
    }

    public function get_data($key)
    {

      $A = (new \CustomHelp\HelpArray($this->cache->data));

      return $key ? $A->_get($key) : $A;

    }

    public function set_data($key,$value)
    {

      $data = $this->cache->data;

      $this->cache->data = array_set($data,$key,$value);

      $this->cache->save();
    }


    public function addLog()
    {

      if($this->cache->user_id){
         $this->user->addLog();
      }else{
         $logs = $this->cache->logs;
         $logs[] = generateLog();
         $this->cache->logs = $logs;
         $this->cache->save();
      }
    }

    public function dropExpired()
    {
      $this->where('expired_time','<',_getDate())->delete();
    }

    public function expired_time($remenber = false)
    {
      $day = $remenber ? 30 : 3;
      return _getDate($day);
    }


}
