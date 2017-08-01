<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    Public function _initialize(){
    	$UserModel = M('user');
    	$token = $_COOKIE['market_usertoken'];
    	$result = $UserModel->where(array('token'=>$token))->find();
    	if(empty($result)){
    		$this->success('认证失效，请重新登录！'.$token,U('Index/login'),2);
    		die;
    	}
    }
    Public function ugoodsdetail(){
    	$gid = I('get.gid'); 
    	$this->assign('gid',$gid);
    	$this->display();
    }
    Public function userorderdetail(){
        $ooid = I('get.ooid');
        $this->assign('ooid',$ooid);
        $this->display();
    }    
    Public function discussion_g(){
        $gid = I('get.gid'); 
        $this->assign('gid',$gid);
        $this->display();
    }
    Public function discussion_u(){
        $gid = I('get.gid'); 
        $this->assign('gid',$gid);
        $this->display();
    }
}