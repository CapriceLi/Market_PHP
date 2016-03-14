<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<head>
	<link href="/market/Public/css/common.css" rel="stylesheet">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link type="text/css" media="screen" rel="stylesheet" href="/market/Public/css/weixin_index.css" /> 
	<script type="text/javascript" src="/market/Public/js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="/market/Public/js/jquery.cookie.js"></script> 
	<script type="text/javascript" src="/market/Public/js/hprose/hprose.js" flashpath="/market/Public/js/hprose/"></script>
	<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="viewport" content="width=320,maximum-scale=1.3,user-scalable=no" />
</head>


<div class="login_main">
	<h1 id='test'></h1>
</div>
<script type="text/javascript">
	$("#test").html($.cookie('usertoken'))
</script>

</html>