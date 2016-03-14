<?php
namespace Server\Controller;

use Think\Controller\HproseController;
class UserController extends HproseController
{
	public function login($jsonstr)
	{
		$para_arr = json_decode($jsonstr, true); 
		$userphone = $para_arr['userphone'];
		$password = $para_arr['password'];
		$Model=M('user');
		$map['uphone'] = $userphone;
		$map['upwd'] = md5($password);
		$result=$Model->where($map)->find();
		if(!empty($result)){
			$token = getToken();
			$save['token'] = $token;
			$Model->where(array('uphone' => $userphone))->save($save);
			$arr = array('info' => 'success','utoken' => $token,'errorcode' => -1);
		}else{
			$arr = array('info' => 'false','errorcode' => '001');
		}
		$str = json_encode($arr,JSON_UNESCAPED_UNICODE);
		return $str;
	}

	public function sign($jsonstr)
	{
		$para_arr = json_decode($jsonstr,true);
		$para_arr['upwd'] = md5($para_arr['upwd']);
		$UserModel = M('user');
		$chack_uphone = $UserModel->where(array('uphone' => uphone))->find();
		$chack_uname = $UserModel->where(array('uname' => uname))->find();
		if(!empty($chack_uphone)){
			$arr = array('info' => 'false','errorcode' => '002');
		}
		if(!empty($chack_uname)){
			$arr = array('info' => 'false','errorcode' => '003');
		}
		if(empty($chack_uphone)&&empty($chack_uname)){
			$token = getToken();
			$para_arr['token'] = $token;
			$UserModel->add($para_arr);
			$arr = array('info' => 'success','utoken' => $token,'errorcode' => -1);
		}
		$str = json_encode($arr,JSON_UNESCAPED_UNICODE);
		return $str;
	}

}
?>
