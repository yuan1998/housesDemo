<?php


/**
 * 返回成功数据模板
 * @Yuan1998
 * @DateTime 2018-01-24T20:17:56+0800
 * @param    All                   $data 可以为任何类型的数据，携带回到发送端.
 * @return   Array                         生成的返回结果.
 */
function suc($data=null)
{
	return response()->json(['success'=>true,'data'=>$data],200);
}


/**
 * 返回错误结果模板
 *
 * @Yuan1998
 * @DateTime 2018-01-24T20:15:54+0800
 * @param    String|Array                   $msg    错误信息，可以为任何类型
 * @param    integer                  $status 错误码
 * @return   Array                           生成的错误结果。
 */
function err($msg=null,$status=403)
{
	return response()->json(['success'=>false,'msg'=>$msg],$status);
}


/**
 * 实例Session
 *
 * @Yuan1998
 * @DateTime 2018-01-24T20:15:13+0800
 * @return   Model                   Session Model
 */
function newSession()
{
   if(!array_get($GLOBALS,'SessionClass'))
      array_set($GLOBALS,'SessionClass',(new \App\SessionY));

   return array_get($GLOBALS,'SessionClass');
}


/**
 * 现在登录的用户
 *
 * @Yuan1998
 * @DateTime 2018-01-24T20:14:34+0800
 * @return   Model                   user Model
 */
function nowUser()
{
   $s =newSession();
   return $s->user ?: null;
}




/**
 * 该func读取Session中储存的Data，如果用户已登录，则返回用户数据，如果不是登录用户，返回Session临时Data
 *
 * @Yuan1998
 * @DateTime 2018-01-24T20:19:48+0800
 * @param     Array|String|empty             Array，如果传参为数字则为储存.String，返回字符串所对应并存在的于Data的数据.
 * @return   [type]                   [description]
 */
function sessiony($cond = false)
{
   $SY = newSession();

   $SY = $SY->user ?: $SY;

   if(!$cond){
      return $SY->get_data();
   }elseif(is_string($cond)){
       return $SY->get_data($cond);
   }elseif(is_array($cond)){
      foreach($cond as $key=>$value){
         $SY->set_data($key,$value);
      }
   }

}



/**
 * 获取 Y-m-d H:i:s 格式的时间,根据传参的天数来添加减少时间.
 * @Yuan1998
 * @DateTime 2018-01-24T20:27:45+0800
 * @param    Integer                   $day Day,需要添加或减少天数。
 * @return   DateTime                        生成的时间.
 */
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


/**
 * 生成一跳登录记录.
 *
 * @Yuan1998
 * @DateTime 2018-01-24T20:30:20+0800
 * @return   Array                   ['log_time'=>当前时间,'ip'=>客户端Ip];
 */
function generateLog()
{
   // dd(get_class_methods(request()));
   $ip = getIp();
   return ['log_time'=>date('Y-m-d H:i:s',time()),'ip'=>$ip,'url'=>url()->current()];

}


/**
 * 获取当前客户端的IP地址。
 * @Yuan1998
 * @DateTime 2018-01-24T20:31:41+0800
 * @return   String                   Ip地址.
 */
function getIp()
{
   return request()->ip();
}

function userIsLogin()
{
   $user = sessiony('user');

   return $user->id ?: null;

}

 ?>
