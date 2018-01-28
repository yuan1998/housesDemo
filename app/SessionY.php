<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\SessionUser as UserModel;

class SessionY extends Model
{



   /**
    * Table Guarded.
    * @var array
    */
    protected $guarded = ['id'];



    /**
     * table Fillable.
     * @var Array
     */
    protected $fillable = ['token','user_id','data','expired_time','logs'];



    /**
     * table column type.
     * @var Array
     */
    public $casts=[
      'data'=>'json',
      'logs'=>'json',
    ];



    /**
     * Model table name.
     * @var string
     */
    protected $table = 'session_y';


    /**
     * session cache.
     * @var Object
     */
    public $cache;



    /**
     * has database users.
     * @Yuan1998
     * @DateTime 2018-01-23T14:48:35+0800
     * @return   Object
     */
    public function hasUsers(){
      return $this->hasOne('\App\SessionUser','id','user_id');
    }



    /**
     * create session.
     *
     * @Yuan1998
     * @DateTime 2018-01-23T14:47:56+0800
     * @return   String                   create session token.
     */
    public function createSession()
    {
      $this->token = $this->generateToken();

      $this->cache = $this->create(['expired_time'=>$this->expired_time(true),'token'=>$this->token,'data'=>[]]);

      return $this->cache->token;
    }


    /**
     * find session.
     *
     * @Yuan1998
     * @DateTime 2018-01-23T14:47:19+0800
     * @return   Object                   $this|Model
     */
    public function findSession()
    {
      $cache = $this->cache;

      if(!$cache)
         return false;

      if( $id = $cache->user_id)
         $this->user = UserModel::findUser($id);

      return $this;

    }


    /**
     * On login save current user.
     *
     * @Yuan1998
     * @DateTime 2018-01-23T14:45:16+0800
     * @param    String                   $id  user id
     * @return   Object                   $this|Model
     */

    public function saveUserId($id)
    {

      $this->setUserId($id);

      $this->user = UserModel::findUser($id);

      $this->LoginMerge();

    }


    /**
     * merge Data & Logs.
     * @Yuan1998
     * @DateTime 2018-01-24T14:41:28+0800
     */
    public function LoginMerge()
    {

      $this->mergeData();
      $this->mergeLogs();

      return $this;
    }


    /**
     * on Logout remove session user_id
     *
     * @Yuan1998
     * @DateTime 2018-01-23T14:22:28+0800
     * @return   [type]                   [description]
     */
    public function removeUserId()
    {

      $this->setUserId();
      unset($this->user);
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
     * generate token.
     *
     * @Yuan1998
     * @DateTime 2018-01-23T14:28:02+0800
     * @return   [string]                   token
     */
    private function generateToken()
    {

      do{
         $token = uniqid().md5(time().'yuanyi');
      }while ($this->findToken($token));

      return $token;
    }



    /**
     * find token.
     *
     * @Yuan1998
     * @DateTime 2018-01-23T14:37:23+0800
     * @param    [string]                   $token [s_token]
     * @return   [Object]                          $this->cache|Model
     */
    public function findToken($token)
    {
      return ($this->cache = $this->where('token',$token)->first());
    }


    /**
     * get session temporate data.
     *
     * @Yuan1998
     * @DateTime 2018-01-23T14:39:23+0800
     * @param    [string]                   $key [find data keyword]
     * @return   [array]                        [find result.]
     */
    public function get_data($key=false)
    {
      if($key === 'user')
         return false;

      $A = (new \CustomHelp\HelpArray($this->cache->data));

      return $key ? $A->_get($key) : $A;

    }


    /**
     * set temporate data
     *
     * @Yuan1998
     * @DateTime 2018-01-23T14:40:50+0800
     * @param    [String]                   $key   [save key name]
     * @param    [String|Array]                   $value [save value]
     */
    public function set_data($key,$value)
    {

      $data = $this->cache->data;

      $this->cache->data = array_set($data,$key,$value);

      $this->cache->save();
    }


    /**
     * add log.
     *
     * @Yuan1998
     * @DateTime 2018-01-23T14:42:15+0800
     */
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


    /**
     * remove expired session.
     * @Yuan1998
     * @DateTime 2018-01-23T14:42:35+0800
     * @return   [null]
     */
    public function dropExpired()
    {
      $this->where('expired_time','<',_getDate())->delete();
    }


    /**
     * generate expired time.
     * @Yuan1998
     * @DateTime 2018-01-23T14:43:12+0800
     * @param    boolean                  $remenber [if remenber.save 30days. else save 3days]
     * @return   DateTime                             generate result.
     */
    public function expired_time($remenber = false)
    {
      $day = $remenber ? 30 : 3;
      return _getDate($day);
    }



    /**
     * set Session User_id
     * @Yuan1998
     * @DateTime 2018-01-24T16:05:26+0800
     * @param    String                   $id  default is null.
     */
    public function setUserId($id=null)
    {
        $this->cache->user_id = $id;
        $this->cache->expired_time = $this->expired_time(request('remenber'));
        $this->cache->save();
    }

}
