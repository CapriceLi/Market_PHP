<?php

function clean($str){
	/*	
		$str=trim($str);
		$str=strip_tags($str);
		$str=stripslashes($str);
		$str=addslashes($str);
		$str=rawurldecode($str);
		$str=quotemeta($str);
		$str=htmlspecialchars($str);
		//$str=preg_replace("//+|/*|/`|//|/-|/$|/#|/^|/!|/@|/%|/&|/~|/^|/[|/]|/'|/"/", "", $str);//去除特殊符号+*`/-$#^~!@#$%&[]'"
		//$str=preg_replace("//s/", "", $str);//去除空格、换行符、制表符
	*/
		return $str;
	}

/**
 * 字符串转换为数组，主要用于把分隔符调整到第二个参数
 * @param  string $str  要分割的字符串
 * @param  string $glue 分割符
 * @return array
 */
function str2arr($str, $glue = ','){
	return explode($glue, $str);
}

/**
 * 数组转换为字符串，主要用于把分隔符调整到第二个参数
 * @param  array  $arr  要连接的数组
 * @param  string $glue 分割符
 * @return string
 */
function arr2str($arr, $glue = ','){
	return implode($glue, $arr);
}

/**
 * 对象转数组
 * @param  objectstdClass $obj   json对象
 * @return array					数组
 */
function object_to_array($obj)
{
	$_arr= is_object($obj) ? get_object_vars($obj) : $obj;
	foreach($_arr as $key=> $val)
	{
		$val= (is_array($val) || is_object($val)) ?       object_to_array($val) : $val;
		$arr[$key] = $val;
	}
	return $arr;
}

/**
 * 生成本服务器唯一标识字符串32位长度
 * @return string
 */
function getToken(){
	$tokenstr = md5(time() . mt_rand(1,1000000));
	$res = M('user')->where(array('token'=>$tokenstr))->find();
	//保证生成不重复的Token
	if($res){
		getToken();
	}else{
		return $tokenstr;
	}
}


/**
 * 根据token值返回用户id
 * @param  string $token  用户token值
 * @return User			 如果获取失败返回 false，如果取到还返回user数组（包括id,name,phone,email,credit,type,state）
 */
function getUserFromToken($token){
	//根据token从数据库获取uid值
	$user = M('user')->where(array('token'=>$token))->field('uid,uphone,uname,sex,openid,email,attach')->find();
	if($user){
		//
	}else{
		return 0;
	}
	return $user;
}

/**
 * 根据attachid返回附件id 和路径
 * @param  string 	$attachid  附件id值
 * @return 			$result  如果失败返回false ，如果成功返回数组{title,url,size}
 */
function getAttach($attachid){
	//根据attachid值从数据库获取附件信息
	$attach = M('attach')->where(array('id'=>$attachid,'del'=>0))->field('id,title,url,size,suffix,createtime')->find();
	if($attach){
		return $attach;
	}else{
		//获取失败
		return false;
	}
}



/**
 * 将json转换成逗号分割字符串返回
 * @param  string 	$json  json字符串
 * @return 			$result  如果失败返回false ，如果成功返回数组{title,url,size}
 */
function json2comma($json){
	$array = json_decode($json);
	$comma='';
	for($i=0; $i<count($array); $i++){
		if($i==0 && $array[$i]!=''){
			$comma=$array[$i];
		}
		else if($i!=0 && $array[$i]!=''){
			$comma.=','.$array[$i];
		}
	}
	return $comma;
}


/**
 * 接口标准返回操作失败
 * @param  string 	$errorcode 错误编码
 * @return 			$result  如果失败返回false ，如果成功返回数组{title,url,size}
 */
function returnFailure($errorcode){
	switch($errorcode){
		case -1:
		$info='参数错误';
		break;
		case 100:
		$info='密码缺失';
		break;
		case 101:
		$info='用户名缺失';
		break;
		case 102:
		$info='当前用户名不存在';
		break;
		case 103:
		$info='用户密码错误';
		break;
		case 104:
		$info='用户ID缺失';
		break;
		case 105:
		$info='手机号码错误';
		break;
		case 106:
		$info='非法用户';
		break;
		case 200:
		$info='文件存储失败';
		break;
		case 201:
		$info='短消息发送失败错误';
		break;
		case 300:
		$info='数据存储失败';
		break;
		case 301:
		$info='数据修改失败';
		break;
		case 302:
		$info='附件存储失败';
		break;
		case 303:
		$info='数据读取失败';
		break;
		case 304:
		$info='数据不存在';
		break;
		case 305:
		$info='数据操作失败';
		break;
		default:
		$info='系统错误';
	}


	//返回错误代码和错误信息
	$arr  =  array('success' =>0,'errocode'=>$errorcode,'info'=>$info);
	$str = json_encode($arr, JSON_UNESCAPED_UNICODE);
	return $str;
}

/**
 * 接口标准返回操作成功(仅当返回一个标志Success时条用，1表示成功）
 * @param  string 	$errorcode 错误编码
 * @return 			$result  如果失败返回false ，如果成功返回数组{title,url,size}
 */
function returnSuccess(){
	$arr  =  array('success' =>1);
	$str = json_encode($arr, JSON_UNESCAPED_UNICODE);
	return $str;
}

function connectsql()
{
	$dbhost = "localhost";
	$username = "root";
	$userpass = "admin";
	$dbdatabase = "market";
	$db_connect = mysql_connect($dbhost, $username, $userpass) or die("Unable to connect to the MySQL!");
	mysql_select_db($dbdatabase, $db_connect);
	return $db_connect;
}

function get_access_token2()
{
	$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx951ac1092ad9a5bf&secret=4918f8fab950eddfba7e985f76a97b46';
	$access_token_tmp = file_get_contents($url);
	$result = json_decode($access_token_tmp, true);
	$access_token = $result['access_token'];
	return $access_token;
}
function getAccessToken(){
	$result = M('msystem')->where(array('type'=>0))->find();
	if(empty($result)){
		$access_token = get_access_token2();
		$add['type'] = 0;
		$add['value'] = $access_token;
		$add['createtime'] = date("Y-m-d H:i:s",time());
		$add['updatetime'] = date("Y-m-d H:i:s",time());
		M('msystem').add($add);
	}else{
		$lasttime = strtotime($result['updatetime']);
		if($lasttime+7000 <= time()){
			$access_token = get_access_token2();
			$add['type'] = 0;
			$add['value'] = $access_token;
			$add['createtime'] = date("Y-m-d H:i:s",time());
			$add['updatetime'] = date("Y-m-d H:i:s",time());
			M('msystem')->where(array('type'=>0))->save($add);
		}else{
			$access_token = $result['value'];
		}
	}
	return $access_token;
}
// function getAccessToken3() {
// 	$db_connect=connectsql();
// 	$result=mysql_query("SELECT * FROM msystem WHERE type = 0");
// 	$row=mysql_fetch_row($result);
// 	$createtime = date("Y-m-d H:i:s",time());
// 	if($row == ""){
// 		$access_token = get_access_token2();
// 		mysql_query("INSERT INTO msystem (type,value,createtime,updatetime) VALUES (0, '$access_token', '$createtime', '$createtime')");
// 	}else{
// 		$lasttime = strtotime($row[4]);
// 		if($lasttime+7000 <= time()){
// 			$access_token = get_access_token2();
// 			$result = mysql_query("UPDATE msystem SET updatetime='".date("Y-m-d H:i:s",time())."', value='". $access_token."' WHERE type=0");
// 		}else {
// 			$access_token = $row[2];
// 		}
// 	}
// 	mysql_close($db_connect);
// 	return $access_token;
// }

function downloadWeixinFile($url){
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_NOBODY, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$package = curl_exec($ch);
	$httpinfo = curl_getinfo($ch);
	curl_close($ch);
	$imageAll = array_merge(array('header' => $httpinfo), array('body' => $package));
	return $imageAll;
}

function saveWeixinFile($filename,$filecontent)
{
	$local_file = fopen($filename, 'w');
	if(false !== $local_file){
		if (false !== fwrite($local_file, $filecontent)){
			fclose($local_file);
		}
	}
}
function https_post($url,$data=null){
	$curl = curl_init();
	curl_setopt($curl,CURLOPT_URL,$url);
	curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);
	curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,FALSE);
	if(!empty($data)){
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	}
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($curl);
	curl_close($curl);
	return $output;
}

function sendTemplatePost($jsonstr,$type){
	switch ($type) {
		case 0:
		$sql = "select uname,uphone from user where uid=" . $jsonstr['uid'];
		$user = M()->query($sql);
		$user = $user[0];
		$sql = "select goods.name,user.openid from goods,user where goods.uid=user.uid and goods.gid=".$jsonstr['gid'];
		$goods = M()->query($sql);
		$goods = $goods[0];
		$template_id = "Gt6PRhemAdXqho_SAh-tC5lE4hwmKu6iNGDfr6BZKzA";
		$first = "用户购买了您的商品";
		$keyword1 = $goods['name'];
		$keyword2 = $user['uname'];
		$keyword3 = $user['uphone'];
		$keyword4 = $jsonstr['ooid'];
		$url = "http://open.weixin.qq.com/connect/oauth2/authorize?appid=wx951ac1092ad9a5bf&redirect_uri=http://www.jasper-website.site/market/oauth2.php/orderdetail_g/".$jsonstr['ooid']."&response_type=code&scope=snsapi_base&state=STATE";
		$data = array(
			'first' => array('value' => urlencode("$first"), 'color' => "#743A3A",),
			'keyword1' => array('value' => urlencode("$keyword1"), 'color' => '#000000',),
			'keyword2' => array('value' => urlencode("$keyword2"), 'color' => '#000000',),
			'keyword3' => array('value' => urlencode("$keyword3"), 'color' => '#000000',),
			'keyword4' => array('value' => urlencode("$keyword4"), 'color' => '#000000',),
			);
		$template = array('touser' => $goods['openid'],
			'template_id' => $template_id,
			'url' => $url,
			'topcolor' => "#7B68EE",
			'data' => $data
			);
		break;
		case 1:
		switch ($jsonstr['state']) {
			case 3:
			$template_id = "pyzVupighET20hdugHPmyRGSNiBHEiXOL3KxJ2feK3o";
			$first = "您的订单已经被取消";
			$sql = "select goods.name,user.openid from goods,morder,user where morder.gid=goods.gid and user.uid=morder.uid and morder.ooid='".$jsonstr['ooid']."'";
			$value = M()->query($sql);
			$value = $value[0];
			$keyword1 = $value['name'];
			$keyword2 = $jsonstr['ooid'];
			$url = "http://open.weixin.qq.com/connect/oauth2/authorize?appid=wx951ac1092ad9a5bf&redirect_uri=http://www.jasper-website.site/market/oauth2.php/orderdetail_u/".$jsonstr['ooid']."&response_type=code&scope=snsapi_base&state=STATE"; 
			$data = array(
				'first' => array('value' => urlencode("$first"), 'color' => "#743A3A",),
				'keyword1' => array('value' => urlencode("$keyword1"), 'color' => '#000000',),
				'keyword2' => array('value' => urlencode("$keyword2"), 'color' => '#000000',),
				);
			$template = array('touser' => $value['openid'],
				'template_id' => $template_id,
				'url' => $url,
				'topcolor' => "#7B68EE",
				'data' => $data
				);
			break;
			case 1:
			$template_id = "pyzVupighET20hdugHPmyRGSNiBHEiXOL3KxJ2feK3o";
			$first = "您的订单已经确认";
			$sql = "select goods.name,user.openid from goods,morder,user where morder.gid=goods.gid and user.uid=morder.uid and morder.ooid='".$jsonstr['ooid']."'";
			$value = M()->query($sql);
			$value = $value[0];
			$keyword1 = $value['name'];
			$keyword2 = $jsonstr['ooid'];
			$url = "http://open.weixin.qq.com/connect/oauth2/authorize?appid=wx951ac1092ad9a5bf&redirect_uri=http://www.jasper-website.site/market/oauth2.php/orderdetail_u/".$jsonstr['ooid']."&response_type=code&scope=snsapi_base&state=STATE"; 
			$data = array(
				'first' => array('value' => urlencode("$first"), 'color' => "#743A3A",),
				'keyword1' => array('value' => urlencode("$keyword1"), 'color' => '#000000',),
				'keyword2' => array('value' => urlencode("$keyword2"), 'color' => '#000000',),
				);
			$template = array('touser' => $value['openid'],
				'template_id' => $template_id,
				'url' => $url,
				'topcolor' => "#7B68EE",
				'data' => $data
				);
			break;
			case 2:
			$template_id = "pyzVupighET20hdugHPmyRGSNiBHEiXOL3KxJ2feK3o";
			$first = "您的订单交易完成";
			$sql = "select goods.name,user.openid from goods,morder,user where morder.gid=goods.gid and user.uid=goods.uid and morder.ooid='".$jsonstr['ooid']."'";
			$value = M()->query($sql);
			$value = $value[0];
			$keyword1 = $value['name'];
			$keyword2 = $jsonstr['ooid'];
			$url = "http://open.weixin.qq.com/connect/oauth2/authorize?appid=wx951ac1092ad9a5bf&redirect_uri=http://www.jasper-website.site/market/oauth2.php/orderdetail_g/".$jsonstr['ooid']."&response_type=code&scope=snsapi_base&state=STATE"; 
			$data = array(
				'first' => array('value' => urlencode("$first"), 'color' => "#743A3A",),
				'keyword1' => array('value' => urlencode("$keyword1"), 'color' => '#000000',),
				'keyword2' => array('value' => urlencode("$keyword2"), 'color' => '#000000',),
				);
			$template = array('touser' => $value['openid'],
				'template_id' => $template_id,
				'url' => $url,
				'topcolor' => "#7B68EE",
				'data' => $data
				);
			break;
		}
		break;
		case 2:
		$template_id = "Pz8QXJILmkLGlXxzzykqq1PhKuHLUshvwAs5xP5_NFQ";
		$first = "对方给你发送了位置信息";
		$keyword1 = $jsonstr['name'];
		$keyword2 = $jsonstr['realname'];
		$keyword3 = $jsonstr['uphone'];
		$keyword4 = $jsonstr['ooid'];
		$keyword5 = $jsonstr['location'];
		$url = "http://open.weixin.qq.com/connect/oauth2/authorize?appid=wx951ac1092ad9a5bf&redirect_uri=http://www.jasper-website.site/market/oauth2.php/map/".$jsonstr['latitude']."/".$jsonstr['longitude']."/".$jsonstr['uphone']."&response_type=code&scope=snsapi_base&state=STATE"; 
		$data = array(
				'first' => array('value' => urlencode("$first"), 'color' => "#743A3A",),
				'keyword1' => array('value' => urlencode("$keyword1"), 'color' => '#000000',),
				'keyword2' => array('value' => urlencode("$keyword2"), 'color' => '#000000',),
				'keyword3' => array('value' => urlencode("$keyword3"), 'color' => '#000000',),
				'keyword4' => array('value' => urlencode("$keyword4"), 'color' => '#000000',),
				'keyword5' => array('value' => urlencode("$keyword5"), 'color' => '#000000',),
				);
			$template = array('touser' => $jsonstr['openid'],
				'template_id' => $template_id,
				'url' => $url,
				'topcolor' => "#7B68EE",
				'data' => $data
				);
		break;
	}
	$url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . getAccessToken();
	$res = https_post($url, urldecode(json_encode($template)));
	return $res;
}


function visited_log($token,$gid,$score){
	$para_arr = json_decode($jsonstr, true);
	$add['uid'] = M('user')->where(array('token'=>$token))->getfield('uid');
	$add['gid'] = $gid;
	$add['score'] = $score;
	// M('user_visit')->add($add);
	return 0;
}

function get_recommend($token){
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
