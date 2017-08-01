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
		$result=$Model->where($map)->field('uid')->find();
		if(!empty($result)){
			$token = getToken();
			$save['token'] = $token;
			$save['openid'] = $_COOKIE['market_openid'];
			setcookie('market_openid','',-1);
			$Model->where(array('uphone' => $userphone,'del' => 0))->save($save);
			$arr = array('info' => 'success','utoken' => $token,'uid' => $result['uid'],'errorcode' => -1);
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
		$chack_uphone = $UserModel->where(array('uphone' => $para_arr['uphone']))->find();
		$chack_uname = $UserModel->where(array('uname' => $para_arr['uname']))->find();
		if(!empty($chack_uphone)){
			$arr = array('info' => 'false','errorcode' => '002');
		}
		if(!empty($chack_uname)){
			$arr = array('info' => 'false','errorcode' => '003');
		}
		if(empty($chack_uphone)&&empty($chack_uname)){
			$token = getToken();
			$para_arr['token'] = $token;
			$para_arr['createtime'] = date("Y-m-d H:i:s");
			$uid = $UserModel->add($para_arr);
			$arr = array('info' => 'success','utoken' => $token,'uid'=>$uid,'errorcode' => -1);
		}
		$str = json_encode($arr,JSON_UNESCAPED_UNICODE);
		return $str;
	}

	public function GetUser($token){
		$sql = "select uid,uphone,uname,sex,role,email,storename,url,provid,cityid,storedescribe,realname from user,attach where user.aid=attach.aid and token='".$token."' and attach.del<>1";
		// return json_encode($sql,JSON_UNESCAPED_UNICODE);
		$result = M('')->query($sql);
		$str = json_encode($result,JSON_UNESCAPED_UNICODE);
		return $str;
	}

	public function uploadUserImg($jsonstr){
		$para_arr = json_decode($jsonstr,true);
		$picid = $para_arr['serverid'][0];
		$access_token = getAccessToken();
		$url = "https://api.weixin.qq.com/cgi-bin/media/get?access_token=$access_token&media_id=$picid";
		$fileInfo = downloadWeixinFile($url);
		$user = M('user')->where(array('token' => $para_arr['token']))->getfield('uid');
		$filepath = '/Public/resorce/avatar/'.$user.'_'.date("Y-m-d_H:i:s",time()).'.jpg';
		$filename = '/var/www/market'.$filepath;
		saveWeixinFile($filename, $fileInfo["body"]);
		$add['title'] = $user.'_'.date("Y-m-d_H:i:s",time()).'.jpg';
		$add['suffix'] = ".jpg";
		$add['url'] = $filepath;
		$add['createtime'] = date("Y-m-d H:i:s",time());
		$aid = M('attach')->add($add);
		$save['aid'] = $aid;
		if(M('user')->where(array('uid'=>$user))->save($save)){
			return 1;
		}else{
			return 0;
		}

	}
	public function ManageUser($jsonstr){
		$para_arr = json_decode($jsonstr,true);
		return M('user')->save($para_arr);
	}
	public function UserSafety($jsonstr){
		$para_arr = json_decode($jsonstr,true);
		if($para_arr['upwd_2'] && $para_arr['upwd_1'] && $para_arr['o_pwd']){
			$para_arr['upwd'] = md5($para_arr['upwd_2']);
			$para_arr['o_pwd'] = md5($para_arr['o_pwd']);
			if(!M('user')->where(array('uphone'=>$para_arr['uphone_o'],'upwd'=>$para_arr['o_pwd']))->find()){
				$arr = array('info' => 'false','errorcode' => '005');
				$str = json_encode($arr,JSON_UNESCAPED_UNICODE);
				return $str;
			}
		}
		if(M('user')->where(array('uid'=>$para_arr['uid']))->save($para_arr))
			$arr = array('info' => 'success','errorcode' => -1);
		else
			$arr = array('info' => 'false','errorcode' => '000');
		$str = json_encode($arr,JSON_UNESCAPED_UNICODE);
		return $str;
	}
	public function UnBind($token){
		$save['openid'] = NULL;
		return M('user')->where(array('token' => $token))->save($save);
	}
	public function GetLocation($jsonstr){
		// return 1;
		$para_arr = json_decode($jsonstr,true);
		$url="http://api.map.baidu.com/geocoder?location=".$para_arr['latitude'].",".$para_arr['longitude']."&output=json&key=At7arP68oRCImzqeg6zisuLubPognc7e";
		// return $url;
		$str=file_get_contents($url);
		$res=json_decode($str,true);

		$province = $res['result']['addressComponent']['province'];
   		// $province = substr($province,0,-1);
		$sql = "select provid,provname from dict_province where baidu_name like '$province%'";
   		// return $sql;
		$provid = M()->query($sql);
		return $provid[0];
	}
	public function GetLocationDetail($jsonstr){
		// return 1;
		$para_arr = json_decode($jsonstr,true);
		$url="http://api.map.baidu.com/geocoder?location=".$para_arr['latitude'].",".$para_arr['longitude']."&output=json&key=At7arP68oRCImzqeg6zisuLubPognc7e";
		// return $url;
		$str=file_get_contents($url);
		$res=json_decode($str,true);
		$res = $res['result'];
		$provname = $res['addressComponent']['province'];
		$type = M('dict_province')->where(array('baidu_name'=>$provname))->getfield('type');
		if($type == 1){
			$cityname = $res['addressComponent']['district'];
		}else{
			$cityname = $res['addressComponent']['city'];
		}

		$sql = "select dict_city.cityid,dict_province.provid from dict_province,dict_city where cityname like'$cityname%' and provname like '$provname%'";
   		// return $sql;
		$res['addressid'] = M()->query($sql);
		$res['addressid'] = $res['addressid'][0];
		return $res;
	}
	public function SendLocationTemplate($jsonstr){
		$para_arr = json_decode($jsonstr,true);
		if($para_arr['type']==1){
			$sql = "select goods.name,user.openid,user2.realname,user2.uphone from user,user as user2,goods,morder where user2.uid=morder.uid and morder.gid=goods.gid and goods.uid=user.uid and morder.ooid='".$para_arr['ooid']."'";
			$touser = M()->query($sql);
			$touser = $touser[0];
		}elseif($para_arr['type']==2){
			$sql = "select user.openid,user2.realname,user2.uphone,goods.name from user,user as user2,goods,morder where morder.uid=user.uid and morder.gid=goods.gid and goods.uid=user2.uid and morder.ooid='".$para_arr['ooid']."'";
			// return $sql;
			$touser = M()->query($sql);
			$touser = $touser[0];
		}
		$touser['latitude'] = $para_arr['latitude'];
		$touser['longitude'] = $para_arr['longitude'];
		$url="http://api.map.baidu.com/geocoder?location=".$para_arr['latitude'].",".$para_arr['longitude']."&output=json&key=At7arP68oRCImzqeg6zisuLubPognc7e";
		$str=file_get_contents($url);
		$res=json_decode($str,true);
		$touser['location'] = $res['result']['formatted_address'];
		$touser['ooid'] = $para_arr[ooid];
		return sendTemplatePost($touser,2);
	}

	public function get_recommend_g($token){
		$goods = get_recommend($token);
		for($i=0;$i<count($goods);$i++){
			$sql = "select goods.*,user.storename from goods,user where goods.uid=user.uid and goods.del=0 and user.del=0 and state<>0 and goods.gid=".$goods[$i];
				$result = M()->query($sql);
				$aid = explode(',',$result[0]['attach']);
				$result[0]['url'] = M('attach')->where(array("aid"=>$aid[0]))->getfield('url');
				$goods_list[] = $result[0];
		}
		return $goods_list;
	}



	public function test($token){
		$sql = "select gid from goods,user where user.token<>'$token' and goods.uid=user.uid and goods.state<>0 and goods.state<>3 and goods.del=0";
		$goodslist = M()->query($sql);
		$sql = "select uid from user where user.token='$token'";
		$user = M()->query($sql);
		$userid = $user[0]['uid'];
		$sql = "select uid from user where user.del=0";
		$userlist = M()->query($sql);
		$vlist = array();
		for($i=0;$i<count($userlist);$i++){
			for($j=0;$j<count($goodslist);$j++){
				$vlist[$userlist[$i]['uid']][$goodslist[$j]['gid']] = NULL;
			}
		}
		//求userid与其他人的Cos值
		$sql = "select uid,gid,score from user_visit";
		$user_visit = M()->query($sql);
		for($i=0;$i<count($user_visit);$i++){
			$vlist[$user_visit[$i]['uid']][$user_visit[$i]['gid']] += $user_visit[$i]['score'];
		}
		for($i=0;$i<count($goodslist);$i++){
			$gid = $goodslist[$i]['gid'];
			if($vlist[$userid][$gid] != NULL){
				$fm1 += $vlist[$userid][$gid] * $vlist[$userid][$gid];
			}else{
				$expect[] = array('gid'=>$gid,'score'=>0);
			}
		}
		$fm1 = sqrt($fm1);
		// return $userlist;
		for($i=0;$i<count($userlist);$i++){  
			$fz = 0;  
			$fm2 = 0;

			for($j=0;$j<count($goodslist);$j++){
				$uid = $userlist[$i]['uid'];
				$gid = $goodslist[$j]['gid'];
        		//计算分子  
				if($vlist[$userid][$gid] != null && $vlist[$uid][$gid] != null){  
					$fz += $vlist[$userid][$gid] * $vlist[$uid][$gid];  
				}  
        		//计算分母
				if($vlist[$uid][$gid] != null){  
					$fm2 += $vlist[$uid][$gid] * $vlist[$uid][$gid];  
				}             
			}
			$fm2 = sqrt($fm2);  
			// if($uid == '29'){return $fz/$fm1/$fm2;}
			$cos[$i] = $fz/$fm1/$fm2;
			if($cos[$i] == false) $cos[$i] = 0;
			$result[$i]['cos'] = $cos[$i];
			$result[$i]['uid'] = $uid;
		}  
		rsort($cos);
		//$neighbour_set 存储最近邻的人和cos值  
		$neighbour_set = array();
		for($i=0;$i<3;$i++){  //前三名
			for($j=0;$j<count($result);$j++){  
				// $uid = $userlist[$j]['uid'];
				if($cos[$i] == $result[$j]['cos']){
					$uid = $result[$j]['uid'];
					$neighbour_set[$i]['uid'] = $uid;  
					$neighbour_set[$i]['cos'] = $result[$j]['cos'];
					for($k=0;$k<count($goodslist);$k++){
						$gid = $goodslist[$k]['gid'];
						if($vlist[$userid][$gid] == null){
							$neighbour_set[$i][$gid] = $vlist[$uid][$gid];
						}
					}
        		}  
    		}  
		}
		//进行预测，计算Predict
		$p_arr = array();  
		for($i=0;$i<count($expect);$i++){
			$gid = $expect[$i]['gid'];
			$pfz_f = 0;  
			$pfm_f = 0; 
			for($j=0;$j<count($neighbour_set);$j++){  
    			$pfz_f += $neighbour_set[$j]['cos'] * $neighbour_set[$j][$gid];  
    			$pfm_f += $neighbour_set[$j]['cos'];

			}

			$p_arr[$i][0] = $gid;
			$p_arr[$i][1] = $pfz_f/sqrt($pfm_f);  
			$score[] = $pfz_f/sqrt($pfm_f);  
		}
		rsort($score);
		$max = array();
		for($n=0;$n<4;$n++){
			for($i=0;$i<count($p_arr);$i++){
				if($p_arr[$i][1] == $score[$n] && $score[$n]!=0) {
					$flag = 0;
					for($k=0;$k<count($max);$k++){
						if($max[$k]==$p_arr[$i][0]) $flag=1;
					}
					if($flag == 0) $max[]=$p_arr[$i][0]; 
				}
			}
		}
		// return $p_arr;
		return $max;
		}
	}
?>
