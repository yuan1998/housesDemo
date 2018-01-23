<?php

function suc($data=null)
{
	return response()->json(['success'=>true,'data'=>$data],200);
}


function err($msg=null,$status=403)
{
	return response()->json(['success'=>false,'msg'=>$msg],$status);
}

function newSession()
{
   if(!array_get($GLOBALS,'SessionClass'))
      array_set($GLOBALS,'SessionClass',(new \App\SessionY));
   return array_get($GLOBALS,'SessionClass');
}


function sessiony()
{
   $SY = newSession();
   $arg = func_get_args();

   $SY = $SY->user ?: $SY;


   if(!$arg){
      return $SY->get_data();
   }elseif(count($arg)===1 && is_string($arg[0])){
       return $SY->get_data($arg[0]);
   }elseif(count($arg) ===1 && is_array($arg[0])){
      foreach($arg[0] as $key=>$value){
         $SY->set_data($key,$value);
      }
   }

}

function _getDate($day = null)
{

   $dayTime = $day ? day($day) : 0;
   return date('Y-m-d H:i:s',time() + $dayTime);
}

/**
 * generate x day to second
 *
 * @Yuan1998
 * @DateTime 2018-01-23T15:20:15+0800
 * @param    integer                  $day [description]
 * @return   [type]                        [description]
 */
function day($day= 1)
{
   return $day * 24 * 60 *60;
}

function generateLog()
{
   // dd(get_class_methods(request()));
   $ip = getIp();
   return ['log_time'=>date('Y-m-d H:i:s',time()),'ip'=>$ip];

}

function getIp()
{
   return request()->ip();
}

 ?>
