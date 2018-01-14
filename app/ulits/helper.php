<?php 

function suc($data=null){
	return response()->json(['success'=>true,'data'=>$data],200);
};
function err($msg=null,$status=403){
	return response()->json(['success'=>false,'msg'=>$msg],$status);
}
	
 ?>
