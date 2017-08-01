<?php
namespace Home\Controller;
use Think\Controller;
use Com\Wechat;
use Com\WechatAuth;
class AdminController extends Controller {
	public function index(){
		$this->display();
	}

	public function main(){
		$admintoken = $_COOKIE['market_admintoken'];
		if(!M('admin')->where(array('value'=>$admintoken))->find()){
			$this->success('认证失效，请扫码登陆！',U('Admin/index'),2);
		}else{
		$this->display();
		}
	}


	public function auth(){
		$openid = I('get.openid');
		$flag = 0;
		// $adminlist = M('admin_list')->where(array('del'=>0))->getfield('value');
		$sql = "select alid,value from admin_list where del=0";
		$adminlist = M()->query($sql);
		// $this->assign('info',$adminlist[0]['value']);
		for($i=0;$i<count($adminlist);$i++){
			if($openid == $adminlist[$i]['value']){
				$token = date("Y-m-d_H:i",time());
				$value['value'] = md5("$openid$token");
				M('admin')->where(array('alid'=>$adminlist[$i]['alid']))->save($value);
				$this->assign('info',0);
				$flag = 1;
			}
		}
		$_SESSION['openid']='';
		if($flag == 0) $this->assign('info',1);
		$this->display();
	}
}