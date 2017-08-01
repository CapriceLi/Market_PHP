<?php
$test = '搜索今天要交易的订单';
$reg = '/^.*搜索.*今天.*交易.*/';
if(preg_match_all($reg,$test) == 1){
	$date = date("Y-m-d",time());
}
?>