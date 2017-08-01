<?php
namespace Server\Controller;

use Think\Controller\HproseController;
class AdminController extends HproseController
{
	public function GetGoods($page){
		$page1 = $page[0] * $page[1];
		$page2 = $page[1];
		$sql = "select * from goods where goods.state=0 and del=0 limit ".$page1.','.$page2;
		$result = M()->query($sql);
		for($i=0;$i<count($result);$i++){
			$result[$i]['uname'] = M('user')->where(array('uid'=>$result[$i]['uid']))->getfield('uname');
			$attachs = explode(',', $result[$i]['attach']);
			for($j=0;$j<count($attachs);$j++){
				$result[$i]['attachs'][$j] = M('attach')->where(array('aid'=>$attachs[$j]))->getfield('url');
			}
		}
		return $result;
	}

	public function GetAllGoods($page){
		$page1 = $page[0] * $page[1];
		$page2 = $page[1];
		$sql = "select * from goods limit ".$page1.','.$page2;
		$result = M()->query($sql);
		for($i=0;$i<count($result);$i++){
			$result[$i]['del_r'] = $result[$i]['del'];
			switch ($result[$i]['del_r']) {
				case 0:
					$result[$i]['del'] = '正常';
					break;
			}
			switch ($result[$i]['state']) {
				case 0:
					$result[$i]['del'] = '待审核';
					break;
			}
			switch ($result[$i]['del_r']) {
				case 1:
					$result[$i]['del'] = '下架';
					break;
			}
			$result[$i]['uname'] = M('user')->where(array('uid'=>$result[$i]['uid']))->getfield('uname');
			$attachs = explode(',', $result[$i]['attach']);
			for($j=0;$j<count($attachs);$j++){
				$result[$i]['attachs'][$j] = M('attach')->where(array('aid'=>$attachs[$j]))->getfield('url');
			}
		}
		return $result;
	}
	public function CheckGoods($gid){
		$save['state'] = 2;
		return M('goods')->where(array('gid'=>$gid))->save($save);
	}
	public function UnCheckGoods($gid){
		$save['del'] = 1;
		return M('goods')->where(array('gid'=>$gid))->save($save);
	}
	public function gt_pie(){
		$sql = "select count(*) as count from goods where goods.state<>0 and del=0";
		$sql0 = "select count(*) as count from goods where goods.state<>0 and del=0 and type=0";
		$sql1 = "select count(*) as count from goods where goods.state<>0 and del=0 and type=1";
		$sql2 = "select count(*) as count from goods where goods.state<>0 and del=0 and type=2";
		$sql3 = "select count(*) as count from goods where goods.state<>0 and del=0 and type=3";
		$sql4 = "select count(*) as count from goods where goods.state<>0 and del=0 and type=4";
		$count = M()->query($sql);
		$count0 = M()->query($sql0);
		$count1 = M()->query($sql1);
		$count2 = M()->query($sql2);
		$count3 = M()->query($sql3);
		$count4 = M()->query($sql4);
		$count = $count[0][count];
		$count0 = $count0[0][count];
		$count1 = $count1[0][count];
		$count2 = $count2[0][count];
		$count3 = $count3[0][count];
		$count4 = $count4[0][count];
		$count = array('count0' => $count0/$count*100 ,
		'count1' => $count1/$count*100,
		'count2' => $count2/$count*100,
		'count3' => $count3/$count*100,
		'count4' => $count4/$count*100);
		return $count;
	}
	public function gtime_sale(){
		$sql = "select DATE_FORMAT(finishtime,'%Y-%m-%d 08:00:00') days,count(*) count from morder where finishtime is not null group by days";
		$res = M()->query($sql);
		$result = array();
		for($i=0;$i<count($res);$i++){
			$result[$i]['0'] = strtotime($res[$i]['days'])."000";
			$result[$i]['0'] = (double)$result[$i]['0'];
			$result[$i]['1'] = (int)$res[$i]['count'];
		}
		return $result;
	}
	public function show_gs_sale(){
		$sql = "select storename,count(ooid) count from user,goods,morder where user.uid=goods.uid and morder.gid=goods.gid and morder.state=2 group by storename";
		$res = M()->query($sql);
		$result['stroesale'] = $res;
		// $sql = "select "
		for($i=0; $i<count($result['stroesale']);$i++){
			$result['drilldown'][$i]['name'] = $result['stroesale'][$i]['storename'];
			$result['drilldown'][$i]['id'] = $result['stroesale'][$i]['storename'];
			$sql = "select goods.type type,count(ooid) count from user,goods,morder where user.uid=goods.uid and morder.gid=goods.gid and morder.state=2 and user.storename='".$result['stroesale'][$i]['storename']."' group by type";
			$data = array('0'=>0,
				'1'=>0,
				'2'=>0,
				'3'=>0,
				'4'=>0);
			$result['drilldown'][$i]['data'] = M()->query($sql);
			for($j=0; $j<count($result['drilldown'][$i]['data']);$j++){
				$data[$result['drilldown'][$i]['data'][$j]['type']] = (int)$result['drilldown'][$i]['data'][$j]['count'];
			}
			$result['drilldown'][$i]['data'] = $data;
		}

		
		return $result;
	}
	public function gts_sale($year){
		$type = [0,1,2,3,4];
		for($i=0;$i<count($type);$i++){
			$month_sale = [0,0,0,0,0,0,0,0,0,0,0,0];
			$sql = "select DATE_FORMAT(finishtime,'%Y-%m-00 08:00:00') months,goods.type,count(*) count from morder,goods where morder.gid=goods.gid and goods.type=$type[$i] and finishtime like '$year%' group by months";
			$result[$i] = M()->query($sql);
			for($j=0;$j<count($result[$i]);$j++){
				$date = (int)substr($result[$i][$j]['months'], 5,2);
				$month_sale[$date] = (int)$result[$i][$j]['count'];
			}
			$result[$i] = $month_sale;
		}
		
		return $result;
	}
	public function GetUsers($page){
		$page1 = $page[0] * $page[1];
		$page2 = $page[1];
		$sql = "select uid,uphone,uname,openid,email,storename,storedescribe,realname,provname,cityname,user.del,url from user,attach,dict_city,dict_province where user.aid=attach.aid and dict_city.cityid=user.cityid and dict_province.provid=user.provid limit ".$page1.','.$page2;
		$result = M()->query($sql);
		for($i=0;$i<count($result);$i++){
			switch ($result[$i]['del']) {
				case 0:
					$result[$i]['del'] = "正常";
					break;
				case 1:
					$result[$i]['del'] = "未激活";
					break;
			}
			switch ($result[$i]['openid']) {
				case NULL:
					$result[$i]['weixin'] = "未绑定微信";
					break;
				default:
					$result[$i]['weixin'] = "已绑定微信";
					break;
			}
			$result[$i]['address'] = $result[$i]['provname']." ".$result[$i]['cityname'];

		}
		return $result;
	}
	public function UpdatePages($pagesize){
		$sql = "select count(*) usercount from user";
		$res = M()->query($sql);
		$result['user'] = $res[0]['usercount'];
		if($result['user']!=0) $result['user']--;
		$result['user'] = (int)($result['user']/$pagesize);
		$sql = "select count(*) allgoodscount from goods";
		$res = M()->query($sql);
		$result['allgoods'] = $res[0]['allgoodscount'];
		if($result['allgoods']!=0) $result['allgoods']--;
		$result['allgoods'] = (int)($result['allgoods']/$pagesize);
		$sql = "select count(*) allgoodscount from goods where goods.state=0 and del=0";
		$res = M()->query($sql);
		$result['goods'] = $res[0]['allgoodscount'];
		if($result['goods']!=0) $result['goods']--;
		$result['goods'] = (int)($result['goods']/$pagesize);
		return $result;
	}
	public function login(){
		$token = date("Y-m-d_H:i",time());
		$sql = "select value from admin_list where del=0";
		$adminlist = M()->query($sql);
		for($i=0;$i<count($adminlist);$i++){
			$openid = $adminlist[$i]['value'];
			$map = 	md5("$openid$token");
			if(M('admin')->where(array('value'=>$map))->find()){
				return $map;
			}
		}	
		return 0;
	}
	public function test(){
		$sql = "select gid from goods where goods.state<>0 and goods.state<>3 and goods.del=0";
		$goodslist = M()->query($sql);
		$sql = "select uid from user where user.token='$token'";
		$user = M()->query($sql);
		$userid = $user[0]['uid'];
		$sql = "select uid from user where user.del=0";
		$userlist = M()->query($sql);
		$vlist = array();
		for($i=0;$i<count($userlist);$i++){
			for($j=0;$j<count($goodslist);$j++){
				$vlist[$userlist[$i]['uid']][$goodslist[$j]['gid']] = 0;
			}
		}
		//求userid与其他人的Cos值
		$sql = "select uid,gid,score from user_visit";
		$user_visit = M()->query($sql);
		for($i=0;$i<count($user_visit);$i++){
			$vlist[$user_visit[$i]['uid']][$user_visit[$i]['gid']] += $user_visit[$i]['score'];
		}

		for($i=0;$i<count($vlist);$i++){
			$visit[$i]['uid'] = $userlist[$i]['uid'];
			for($j=0;$j<count($goodslist);$j++){
				$visit[$i]['goods'][$j] = $vlist[$userlist[$i]['uid']][$goodslist[$j]['gid']];
			}
		}
		$result['goods'] = $goodslist;
		$result['vlist'] = $vlist;
		$result['visit'] = $visit;

		$result['user'] = $userlist;
		return $result;
	}
}