<?php
namespace Home\Controller;
use Think\Controller;
class MainController extends Controller {
    Public function _initialize(){
    	$UserModel = M('user');
    	$token = $_COOKIE['market_usertoken'];
    	$result = $UserModel->where(array('token'=>$token))->find();
    	if(empty($result)){
    		$this->success('认证失效，请重新登录！',U('Index/login'),2);
    		die;
    	}
    }

    Public function goodsdetail(){
    	$gid = I('get.gid'); 
    	$this->assign('gid',$gid);
    	$this->display();
    }
    Public function buygoods(){
        $gid = I('get.gid'); 
        $this->assign('gid',$gid);
        $this->display();
    }
    Public function discussion(){
        $gid = I('get.gid'); 
        $this->assign('gid',$gid);
        $this->display();
    }

    Public function storedetail(){
        $uid = I('get.uid');
        $this->assign('uid',$uid);
        $this->display();
    }
    Public function successbuy(){
        $ooid = I('get.ooid');
        $this->assign('ooid',$ooid);
        $this->display();
    }
    Public function orderdetail(){
        $ooid = I('get.ooid');
        $this->assign('ooid',$ooid);
        $this->display();
    }
    Public function show_qr(){
        $qrid = I('get.qrid');
        $this->assign('qrid',$qrid);
        $this->display();
    }
}