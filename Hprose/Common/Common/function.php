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
	//根据token值从数据库获取uid值
	$user = M('User')->where(array('token'=>$token))->field('id,name,phone,email,type,state,credit')->find();
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
	


		
