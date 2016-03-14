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
	<div class="login_title">二手交易市场</div>
	<div class="login_input">
		<div><input id="userphone"/></div>
		<div><input type="password" id="password"/></div>
		<center><div class="submit"  id="submit_button" style="cursor:pointer"><a>登录</a></div></center>
		<center><div class="submit"  id="sign_button" style="cursor:pointer"><a>注册</a></div></center>
	</div>
</div>
<script type="text/javascript">
	$("#sign_button").click(function(){
		var strurl = "<?php echo U('Home/Main/sign');?>";
		document.location=strurl;
	})
	$("#submit_button").click(function(){
		var userphone = $.trim($("#userphone").val());
		var password = $.trim($("#password").val());

		var jsonstr = {"userphone": userphone, "password": password};
		var strurl = "<?php echo U('Home/Main/main');?>";

		console.log(jsonstr);
		var client = new HproseHttpClient('http://120.27.34.165/market/hprose.php/User', ['login']);
		client.login(JSON.stringify(jsonstr),function (result) {
			var jsonobj = JSON.parse(result);
			console.log(jsonobj);
			if(jsonobj.errorcode=="001"){
				console.log(jsonobj)
			}else{
				$.cookie('usertoken',null); 
				$.cookie('usertoken', jsonobj.utoken,{ expires: 7 }); 
				document.location=strurl;
			}
		}, function (name, err) {
			console.log(err);
			return;
		})
	})
</script>

</html>