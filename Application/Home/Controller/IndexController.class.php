<?php
namespace Home\Controller;
use Think\Controller;
use Com\Wechat;
use Com\WechatAuth;
class IndexController extends Controller {
	public function index(){
		$this->display();
	}
	Public function baidu_map(){
        $latitude = I('get.latitude'); 
        $longitude = I('get.longitude');
        $uphone = I('get.uphone');
        $this->assign('latitude',$latitude);
        $this->assign('longitude',$longitude);
        $this->assign('uphone',$uphone);
        $this->display();
    }
}
