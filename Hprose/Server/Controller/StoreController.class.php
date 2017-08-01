<?php
namespace Server\Controller;

use Think\Controller\HproseController;
class StoreController extends HproseController
{
	//创建商品
	public function CreateGoods($jsonstr){
		$GoodsModel = M('goods');
		$UserModel = M('user');
		$para_arr = json_decode($jsonstr, true);
		// return $para_arr;
		$goods = $para_arr;
		$goods['createtime'] = date("Y-m-d H:i:s",time());
		$goods['endtime'] = date("Y-m-d H:i:s",time());
		$goods['state'] = "0";
		$goods['attach'] = "";
		for($i=0;$i<3;$i++){
			if($goods['images'][$i] != ""){
				$aid=$this->uploadGoodsImg($goods['images'][$i]);
				$goods['attach'] .= "$aid,";
			}
		}
		$goods['attach'] = substr($goods['attach'],0,-1);
		if($goods['attach'] == false)
		{
			$goods['attach'] = 1;
		}
		
		if($goods['uid'] = $UserModel->where(array("token"=> $goods['token']))->field('uid')->find()['uid']){
			if($result = $GoodsModel->add($goods)){
				return $result;
			}
		}
	}
	//修改商品
	public function EditGoods($jsonstr){
		$GoodsModel = M('goods');
		$UserModel = M('user');
		$para_arr = json_decode($jsonstr, true);
		$goods = $para_arr;
		$attach = explode(',',$goods['attach']);

		// $goods['state'] = "0";
		$goods['attach'] = "";
		// return $goods['images'][0];
		for($i=0;$i<3;$i++){
			if($goods['images'][$i] == "-1"){
				if($attach[$i]){
					$goods['attach'] .= "$attach[$i],";
				}
			}
			if($goods['images'][$i] != "" && $goods['images'][$i] != "-1"){
				$aid=$this->uploadGoodsImg($goods['images'][$i]);
				$goods['attach'] .= "$aid,";
			}
		}
		$goods['attach'] = substr($goods['attach'],0,-1);
		if($goods['attach'] == false)
		{
			$goods['attach'] = "";
		}
		return $GoodsModel->save($goods);
	}
	// 获取商品列表（main）
	public function GetGoodsList($jsonstr){
		$para_arr = json_decode($jsonstr, true);
		$search = "\"%".$para_arr['search']."%\"";
		$para_arr['page'] = $para_arr['page'] * $para_arr['pagesize'];
		$type = " ";
		if($para_arr['type'] != -1){
			$type = " and type =".$para_arr['type'];
		}
		$sql = "select goods.*,user.storename from goods,user where goods.uid=user.uid and name like ".$search.$type." and user.provid=".$para_arr['provid']." and goods.del=0 and user.del=0 and state<>0 and user.token<>'".$para_arr['token']."' order by goods.createtime desc limit ".$para_arr['page'].",".$para_arr['pagesize'];
		$result = M()->query($sql);
		for($i=0;$i<count($result);$i++){
			$aid = explode(',',$result[$i]['attach']);
			$result[$i]['url'] = M('attach')->where(array("aid"=>$aid[0]))->getfield('url');
		}
		$str = json_encode($result,JSON_UNESCAPED_UNICODE);
		return $str;
	}
	// 获取关注的商品列表
	public function GetFocusGoodsList($jsonstr){
		$UserModel = M('user');
		$para_arr = json_decode($jsonstr, true);
		$para_arr['page'] = $para_arr['page'] * $para_arr['pagesize'];
		$uid = $UserModel->where(array("token"=> $para_arr['token']))->field('uid')->find()['uid'];
		$sql = "select goods.*,user.storename from goods,user where goods.uid=user.uid and goods.gid in (select toid from focus where fromid=".$uid." and type=0 and state=1) and state<>0 limit ".$para_arr['page'].",".$para_arr['pagesize'];
		$result = M()->query($sql);
		for($i=0;$i<count($result);$i++){
			$aid = explode(',',$result[$i]['attach']);
			$result[$i]['url'] = M('attach')->where(array("aid"=>$aid[0]))->getfield('url');
		}
		$str = json_encode($result,JSON_UNESCAPED_UNICODE);
		return $str;
	}
	// 获取订单列表
	public function GetOrderList($jsonstr){
		$UserModel = M('user');
		$para_arr = json_decode($jsonstr, true);
		$para_arr['page'] = $para_arr['page'] * $para_arr['pagesize'];
		$uid = $UserModel->where(array("token"=> $para_arr['token']))->field('uid')->find()['uid'];
		$sql = "select user.uid as uid2, user.storename,morder.*,goods.name,goods.attach from morder,goods,user where morder.gid=goods.gid and user.uid=goods.uid and morder.uid = ". $uid . " order by morder.state,morder.tradetime DESC,morder.createtime DESC limit ".$para_arr['page'].",".$para_arr['pagesize'];
		// return json_encode($sql,JSON_UNESCAPED_UNICODE);
		$result = M()->query($sql);
		for($i=0;$i<count($result);$i++){
			$aid = explode(',',$result[$i]['attach']);
			$result[$i]['url'] = M('attach')->where(array("aid"=>$aid[0]))->getfield('url');
		}
		$str = json_encode($result,JSON_UNESCAPED_UNICODE);
		return $str;
	}
	// 获取关注的店铺列表
	public function GetFocusStoreList($jsonstr){
		$UserModel = M('user');
		$para_arr = json_decode($jsonstr, true);
		$para_arr['page'] = $para_arr['page'] * $para_arr['pagesize'];
		$uid = $UserModel->where(array("token"=> $para_arr['token']))->field('uid')->find()['uid'];
		$sql = "select uname,storename,uid,aid from user where uid in (select toid from focus where fromid=".$uid." and type=1 and state = 1) limit ".$para_arr['page'].",".$para_arr['pagesize'];
		// return json_encode($sql,JSON_UNESCAPED_UNICODE);
		$result = M()->query($sql);
		for($i=0;$i<count($result);$i++){
			$aid = explode(',',$result[$i]['aid']);
			$result[$i]['url'] = M('attach')->where(array("aid"=>$aid[0]))->getfield('url');
		}
		$str = json_encode($result,JSON_UNESCAPED_UNICODE);
		return $str;
	}
	// 获取商品详情
	public function GetGoodsDetail($jsonstr){
		$para_arr = json_decode($jsonstr, true);
		// return $para_arr['gid'];
		$para_arr['uid'] = M('user')->where(array('token'=>$para_arr['token']))->getfield('uid');
		$sql = "select goods.*,ifnull(s1.state,0) as focus from goods left join (select focus.fromid,focus.toid,focus.state from focus where focus.fromid=".$para_arr['uid']." and focus.type=0) as s1 on goods.gid = s1.toid where goods.gid = ".$para_arr['gid'];
		// return json_encode($sql,JSON_UNESCAPED_UNICODE);
		$result = M()->query($sql);
		$result = $result[0];
		// return json_encode($result,JSON_UNESCAPED_UNICODE);
		$aid_tmp = explode(',',$result['attach']);
		$aid = "(-1";
		for($i=0;$i<count($aid_tmp);$i++){
			$aid .= ",$aid_tmp[$i]";
		}
		$aid .=")";
		$sql = "select url from attach where aid in ".$aid." and del = 0";
		$result['urls'] = M()->query($sql);
		$sql = "select uphone,provname,cityname,storename from user,dict_city,dict_province where user.provid=dict_province.provid and user.cityid=dict_city.cityid and user.token ='".$para_arr['token']."'";
		$result['user'] = M()->query($sql);
		$result['phone'] = $result['user'][0]['uphone'];
		$result['provname'] = $result['user'][0]['provname'];
		$result['cityname'] = $result['user'][0]['cityname'];
		$result['storename'] = $result['user'][0]['storename'];
		return json_encode($result,JSON_UNESCAPED_UNICODE);
	}
	// 关注商品/取消关注商品
	public function FocusGoods($jsonstr){
		// return $jsonstr;
		$para_arr = json_decode($jsonstr, true);
		$add['toid'] = $para_arr['gid'];
		$add['type'] = 0;
		$add['fromid'] = M('user')->where(array('token'=>$para_arr['token']))->getfield('uid');
		$add['fid'] = M('focus')->where($add)->getfield('fid');
		if(!empty($add['fid'])){
			if($para_arr['focus'] == false){
				$add['state'] = 1;
				visited_log($para_arr['token'],$para_arr['gid'],5);
			}else{
				$add['state'] = 0;
				visited_log($para_arr['token'],$para_arr['gid'],-5);
			}
			return M('focus')->save($add);
		}else{
			visited_log($para_arr['token'],$para_arr['gid'],5);
			return M('focus')->add($add);
		}	
	}
	// 获取本商铺的商品列表
	public function GetGoodsListByUid($jsonstr){
		$para_arr = json_decode($jsonstr, true);
		$search = "\"%".$para_arr['search']."%\"";
		$para_arr['page'] = $para_arr['page'] * $para_arr['pagesize'];
		$type = " ";
		if($para_arr['type'] != -1){
			$type = " and type =".$para_arr['type'];
		}
		$sql = "select goods.*,user.storename from goods,user where goods.uid=user.uid and name like ".$search.$type." and goods.del=0 and user.del=0 and goods.uid = ".$para_arr['uid']." and state<>0 order by goods.createtime desc limit ".$para_arr['page'].",".$para_arr['pagesize'];
		$result = M()->query($sql);
		for($i=0;$i<count($result);$i++){
			$aid = explode(',',$result[$i]['attach']);
			$result[$i]['url'] = M('attach')->where(array("aid"=>$aid[0]))->getfield('url');
		}
		$str = json_encode($result,JSON_UNESCAPED_UNICODE);
		return $str;
	}
	// 获取商铺详情
	public function GetStoreFromuname($uid,$token){
		$sql = "select storename,url,storedescribe,ifnull(state,0) state from (select uid,storename,url,storedescribe from user,attach where uid=$uid and attach.aid=user.aid) s1 left join (select toid,fromid,state from focus,user where focus.fromid=user.uid and user.token='$token' and toid=$uid and type=1) s2 on s1.uid = s2.toid";
		$result = M()->query($sql);
		$result = $result[0];
		return $result;
	}
	// 通过token获取商品列表
	public function GetGoodsListByToken($jsonstr){
		$para_arr = json_decode($jsonstr, true);
		$search = "\"%".$para_arr['search']."%\"";
		$para_arr['page'] = $para_arr['page'] * $para_arr['pagesize'];
		$type = " ";
		if($para_arr['type'] != -1){
			$type = " and type =".$para_arr['type'];
		}
		$sql = "select goods.*,user.storename from goods,user where goods.uid=user.uid and name like ".$search.$type." and goods.del=0 and user.del=0 and user.token = '".$para_arr['token']."' order by goods.createtime desc  limit ".$para_arr['page'].",".$para_arr['pagesize'];
		$result = M()->query($sql);
		for($i=0;$i<count($result);$i++){
			$aid = explode(',',$result[$i]['attach']);
			$result[$i]['url'] = M('attach')->where(array("aid"=>$aid[0]))->getfield('url');
		}
		$str = json_encode($result,JSON_UNESCAPED_UNICODE);
		return $str;
	}
	// 上传商品图片
	public function uploadGoodsImg($serverid){
		$access_token = getAccessToken();
		$url = "https://api.weixin.qq.com/cgi-bin/media/get?access_token=$access_token&media_id=$serverid";
		$fileInfo = downloadWeixinFile($url);
		$filepath = '/Public/resorce/goods_img/'.$serverid.date("Y-m-d_H_i_s",time()).'.jpg';
		$filename = '/var/www/market'.$filepath;
		saveWeixinFile($filename, $fileInfo["body"]);
		$add['title'] = $serverid.date("Y-m-d_H_i_s",time()).'.jpg';
		$add['suffix'] = ".jpg";
		$add['url'] = $filepath;
		$add['createtime'] = date("Y-m-d H:i:s",time());
		$aid = M('attach')->add($add);
		return $aid;	
	}
	// 下架
	public function OffSale($gid){
		$save['del'] = 1;
		M('goods')->where(array('gid'=>$gid))->save($save);
	}
	// 关注店铺/取消关注店铺
	public function FocusStore($uid,$token,$state){
		$save['toid'] = $uid;
		$save['type'] = 1;
		$save['fromid'] = M('user')->where(array("token"=>$token))->getfield("uid");
		$find = M('focus')->where($save)->find();
		if($find){
			$save['state'] = $state;
			if(M('focus')->where($find)->save($save))return 1;
		}else{
			$save['state'] = $state;
			if(M('focus')->add($save)) return 1;
		}
		return 0;
	}
	// 获取城市列表
	public function GetProvince(){
		$result = M('dict_province')->where(1)->field("provid,provname")->select();
		for($i=0;$i<count($result);$i++){
			$result[$i]['provid'] = (int)$result[$i]['provid'];
		}
		return $result;
	}
	// 获取区列表
	public function GetCitys($provid){
		$result = M('dict_city')->where(array("provid"=>$provid))->field("cityid,cityname")->select();
		for($i=0;$i<count($result);$i++){
			$result[$i]['cityid'] = (int)$result[$i]['cityid'];
		}
		return $result;
	}
	// 获取所有区
	public function GetCitysAll(){
		$result = M('dict_city')->where(1)->field("cityid,cityname,provid")->select();
		for($i=0;$i<count($result);$i++){
			$result[$i]['cityid'] = (int)$result[$i]['cityid'];
		}
		return $result;
	}
	// 购买商品
	public function BuyGoods($jsonstr){
		$para_arr = json_decode($jsonstr, true);
		$para_arr['uid'] = M('user')->where(array('token'=>$para_arr['token']))->getfield('uid');
		// return json_encode(M()->getLastsql(),JSON_UNESCAPED_UNICODE);
		while(1){
			$para_arr['ooid'] = 'S' . mt_rand(1000000,9999999);
			if(!M('morder')->where(array('ooid'=>$para_arr['ooid']))->find()) break;
		}
		$para_arr['createtime'] = date("Y-m-d H:i:s");
		$para_arr['tradetime'] = date('Y-m-d H:i:s',strtotime($para_arr['tradetime']));
		$para_arr['templatetype'] = 0;
		if(M('morder')->add($para_arr)){
			sendTemplatePost($para_arr,0);
			visited_log($para_arr['token'],$para_arr['gid'],10);
			$arr = array('info' => 'success','ooid' => $para_arr['ooid'],'errorcode' => -1);
		}else{
			$arr = array('info' => 'false','errorcode' => '004');
		}

		$str = json_encode($arr,JSON_UNESCAPED_UNICODE);
		return $str;
	}
	// 获取订单详情
	public function GerOderDetail($ooid){
		// return $ooid;
		$sql = "select user.realname,user.uphone,goods.name,goods.price as o_price,morder.*,user2.uid as uid2,user2.realname as realname2,user2.uphone as uphone2,user2.email as email2,user2.storename,city.cityname,province.provname from morder,user,goods,dict_city as city,dict_province as province,user as user2 where morder.gid = goods.gid and goods.uid = user2.uid and morder.provid = province.provid and morder.cityid = city.cityid and morder.uid=user.uid and morder.ooid = '$ooid' and morder.del = 0";
		$result = M()->query($sql);
		$result = $result[0];
		$str = json_encode($result,JSON_UNESCAPED_UNICODE);
		return $str;
	}
	// 获取聊天详情
	public function Getdiscussion($jsonstr){
		$para_arr = json_decode($jsonstr, true);
		$sql = "select discussion.*,uname,attach.url from discussion,user,attach where user.aid=attach.aid and user.uid = discussion.uid and user.token='".$para_arr['token']."' and discussion.gid=" .$para_arr['gid'];
		$result = M()->query($sql);
		$result = $result[0];
		$result['bbs'] = json_decode($result['bbs'],JSON_UNESCAPED_UNICODE);
		for($i=0;$i<count($result['bbs']);$i++){
			if($result['bbs'][$i]['type'] == 2 || $result['bbs'][$i]['type'] == 4){
				$result['bbs'][$i]['content'] = M('attach')->where(array('aid'=>$result['bbs'][$i]['content']))->getfield('url');
			}
		}
		$sql = "select url,uname from attach,goods,user where user.aid=attach.aid and goods.uid=user.uid and goods.gid=".$para_arr['gid'];
		$result['url2'] = M()->query($sql);
		$result['uname2'] = $result['url2'][0]['uname'];
		$result['url2'] = $result['url2'][0]['url'];
		$state['ustate'] = 0;
		M('discussion')->where(array('did'=>$result['did']))->save($state);
		$str = json_encode($result,JSON_UNESCAPED_UNICODE);
		return $str;
	}
	// 获取聊天详情(_g)
	public function Getdiscussion_g($jsonstr){
		$para_arr = json_decode($jsonstr, true);
		$sql = "select discussion.*,uname,attach.url from discussion,goods,user,attach where user.aid=attach.aid and discussion.gid=goods.gid and user.uid=goods.uid and user.token='".$para_arr['token']."' and discussion.gid=" .$para_arr['gid'];
		// return json_encode($sql,JSON_UNESCAPED_UNICODE);
		$result = M()->query($sql);
		$result = $result[0];
		$result['bbs'] = json_decode($result['bbs'],JSON_UNESCAPED_UNICODE);
		for($i=0;$i<count($result['bbs']);$i++){
			if($result['bbs'][$i]['type'] == 2 || $result['bbs'][$i]['type'] == 4){
				$result['bbs'][$i]['content'] = M('attach')->where(array('aid'=>$result['bbs'][$i]['content']))->getfield('url');
			}
		}
		$sql = "select url,uname,user.uid from attach,user,discussion where user.aid=attach.aid and discussion.uid=user.uid and discussion.gid=".$para_arr['gid'];
		$result['url2'] = M()->query($sql);
		$result['uname2'] = $result['url2'][0]['uname'];
		$result['uid2'] = $result['url2'][0]['uid'];
		$result['url2'] = $result['url2'][0]['url'];
		$state['gstate'] = 0;
		M('discussion')->where(array('did'=>$result['did']))->save($state);
		$str = json_encode($result,JSON_UNESCAPED_UNICODE);
		return $str;
	}
	// 发送消息
	public function SendMessage($jsonstr){
		$para_arr = json_decode($jsonstr, true);
		$para_arr['time'] = date("Y-m-d H:i:s", time());
		if($para_arr['type'] == 1){
			$map['uid'] = $para_arr['uid'] = M('user')->where(array('token'=>$para_arr['token']))->getfield('uid');
			$map['gid'] = $para_arr['gid'];
			$para_arr['gstate'] = 1;
		}else if($para_arr['type'] == 3){
			$map['uid'] = $para_arr['uid_u'];
			$map['gid'] = $para_arr['gid'];
			$para_arr['ustate'] = 1;
		}else if($para_arr['type'] == 2){
			$map['uid'] = $para_arr['uid'] = M('user')->where(array('token'=>$para_arr['token']))->getfield('uid');
			$map['gid'] = $para_arr['gid'];
			$para_arr['gstate'] = 1;
			$para_arr['content'] = $this->downloadVoice($para_arr['serverid']);
		}else if($para_arr['type'] == 4){
			$map['uid'] = $para_arr['uid_u'];
			$map['gid'] = $para_arr['gid'];
			$para_arr['ustate'] = 1;
			$para_arr['content'] = $this->downloadVoice($para_arr['serverid']);
		}
		// return json_encode($map,JSON_UNESCAPED_UNICODE);
		$bbs_n  = array(
			'type' => $para_arr['type'],
			'content' => $para_arr['content'],
			'time' => $para_arr['time']
			);
		$bbs = M('discussion')->where($map)->getfield('bbs');
		$para_arr['updatetime'] = date("Y-m-d H:i:s", time());
		if($bbs){
			$bbs = json_decode($bbs,JSON_UNESCAPED_UNICODE);
			array_push($bbs, $bbs_n);
			$para_arr['bbs'] = json_encode($bbs,JSON_UNESCAPED_UNICODE);
			M('discussion')->where($map)->save($para_arr);
		}else{
			$bbs = array();
			array_push($bbs, $bbs_n);
			$para_arr['bbs'] = json_encode($bbs,JSON_UNESCAPED_UNICODE);
			M('discussion')->add($para_arr);
		}
		$str = json_encode($para_arr,JSON_UNESCAPED_UNICODE);
		return $str;

	}
	// 获取我的订单列表
	public function GetMyOrderList($jsonstr){
		$para_arr = json_decode($jsonstr, true);
		$para_arr['page'] = $para_arr['page'] * $para_arr['pagesize'];
		$sql = "select morder.*,goods.name,goods.attach from morder,goods,user where morder.gid=goods.gid and goods.uid = user.uid and (morder.state <> 3 and morder.state <> 2 ) and user.token='".$para_arr['token']."' order by morder.state,morder.tradetime DESC,morder.createtime DESC limit ".$para_arr['page'].",".$para_arr['pagesize'];
		// return json_encode($sql,JSON_UNESCAPED_UNICODE);
		$result = M()->query($sql);
		for($i=0;$i<count($result);$i++){
			$aid = explode(',',$result[$i]['attach']);
			$result[$i]['url'] = M('attach')->where(array("aid"=>$aid[0]))->getfield('url');
		}
		$str = json_encode($result,JSON_UNESCAPED_UNICODE);
		return $str;
	}
	// 更改订单状态
	public function ChangeOrderState($jsonstr){
		$para_arr = json_decode($jsonstr, true);
		if($para_arr['state'] == 1){
			$para_arr['confirmtime'] = date("Y-m-d H:i:s", time());
			// $n_num = M('goods')->where(array(''))
		}
		if($para_arr['state'] == 2)
			$para_arr['finishtime'] = date("Y-m-d H:i:s", time());
		if(M('morder')->where(array('ooid'=>$para_arr['ooid']))->save($para_arr)){
			$arr = array('info' => 'success','errorcode' => -1);
			$result = sendTemplatePost($para_arr,1);
		}else{
			$arr = array('info' => 'flase','errorcode' => '000');
		}
		$str = json_encode($arr,JSON_UNESCAPED_UNICODE);
		return $str;
	}
	// 获取未处理的订单数
	public function GetUnconfirmCount($token){
		$sql = "select count(*) as num from morder,goods,user where user.uid=goods.uid and goods.gid=morder.gid and user.token='$token' and (morder.state<>2 and morder.state<>3)";
		$result = M()->query($sql);
		$result = $result[0];
		return $result;
	}
	// 获取聊天状态
	public function GetDicussionState($token){
		$sql = "select max(ustate) as ustate from discussion,user where user.uid=discussion.uid and user.token='$token'";
		$result = M()->query($sql);
		$result_u = $result[0];
		$sql = "select max(gstate) as gstate from discussion,user,goods where goods.gid=discussion.gid and user.uid=goods.uid and user.token='$token'";
		$result = M()->query($sql);
		$result_g = $result[0];
		if($result_u['ustate']==1 | $result_g['gstate']==1)
			$result = 1;
		else $result = 0;
		return $result;
	}
	// 获取聊天列表
	public function GetDiscussionlist($jsonstr){
		$para_arr = json_decode($jsonstr, true);
		$pagesize = $para_arr['pagesize'];
		$token = $para_arr['token'];
		$page = $para_arr['page'] * $para_arr['pagesize'];
		//作为user
		$sql = "(select attach.url as url2,discussion.*,user2.uname as uname,1 as role from attach,discussion,user,goods,user as user2 where user.uid=discussion.uid and user2.aid=attach.aid and user.token='$token' and user2.uid=goods.uid and goods.gid=discussion.gid)";
		$sql .=" union ";
		//作为goods
		$sql .= "(select attach.url as url2,discussion.*,user2.uname as uname,0 as role from attach,discussion,user,goods,user as user2 where goods.gid=discussion.gid and attach.aid=user2.aid and user.uid=goods.uid and user.token='$token' and user2.uid=discussion.uid)";
		$sql .=" order by updatetime DESC limit $page,$pagesize";
		// return json_encode($sql,JSON_UNESCAPED_UNICODE);
		$result = M()->query($sql);
		for($i=0;$i<count($result);$i++){
			$result[$i]['bbs'] = json_decode($result[$i]['bbs'],JSON_UNESCAPED_UNICODE);
			$result[$i]['bbs'] = $result[$i]['bbs'][count($result[$i]['bbs'])-1];
		}
		$str = json_encode($result,JSON_UNESCAPED_UNICODE);
		return $str;
	}
	// public function sendVoice($jsonstr){
	// 	$para_arr = json_decode($jsonstr, true);
	// 	$serverid = $para_arr['serverid'];
	// 	$aid = 
	// }
	// 下载音频
	public function downloadVoice($serverid){
		$access_token = getAccessToken();
		$url = "https://api.weixin.qq.com/cgi-bin/media/get?access_token=$access_token&media_id=$serverid";
		$fileInfo = downloadWeixinFile($url);
		$filepathamr = '/Public/resorce/audio/'.$serverid.date("Y-m-d_H_i_s",time()).'.amr';
		$filepath = '/Public/resorce/audio/'.$serverid.date("Y-m-d_H_i_s",time()).'.mp3';
		$filenameamr = '/var/www/market'.$filepathamr;
		$filename = '/var/www/market'.$filepath;
		saveWeixinFile($filenameamr, $fileInfo["body"]);
		system("ffmpeg -i $filenameamr $filename");
		system("rm -rf $filenameamr");
		$add['title'] = $serverid.date("Y-m-d_H_i_s",time()).'.mp3';
		$add['suffix'] = ".mp3";
		$add['url'] = $filepath;
		$add['createtime'] = date("Y-m-d H:i:s",time());
		$aid = M('attach')->add($add);
		return $aid;
	}
	// 获取二维码
	public function GetQR($gid){
		$qrid = M('qrcode')->where(array('id'=>$gid,'type'=>0,'del'=>0))->getfield('qrid');
		if(empty($qrid)){
			return $this->CreatQR($gid);
		}
		return $qrid;
	}
	// 生成二维码
	public function CreatQR($gid){
		$access_token = getAccessToken();
		$qrcode = '{"action_name": "QR_LIMIT_SCENE","action_info": {"scene": {"scene_id": '.$gid.'}}}';
		$url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=$access_token";
		$result = https_post($url,$qrcode);
		$jsoninfo=json_decode($result,true);
		$filepath = '/Public/resorce/QR/'.$gid.date("Y-m-d_H:i:s",time()).'.png';
		$filename = '/var/www/market'.$filepath;
		$url = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".$jsoninfo['ticket'];
		$fileInfo = downloadWeixinFile($url);
		saveWeixinFile($filename, $fileInfo["body"]);
		$add['id'] = $gid;
		$add['url'] = $filepath;
		$qrid = M('qrcode')->add($add);
		return $qrid;
	}
	// 通过qrid获取二维码
	public function GetQRByqrid($qrid){
		return M('qrcode')->where(array('qrid'=>$qrid,'type'=>0,'del'=>0))->getfield('url');
	}


}