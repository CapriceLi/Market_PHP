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


<center>
	<div class="sign_main">
		<div class="sign_title">注册</div>
		<div class="sign_phone">
			<span>手机:</span>
			<input type="text"/>
		</div>
		<div class="sign_username">
			<span>用户名:</span>
			<input type="text"/>
		</div>
		<div class="sign_password">
			<span>密码:</span>
			<input type="password"/>
		</div>
		<div class="sign_repassword">
			<span>再次输入密码:</span>
			<input type="password"/>
			<span id="error_repassword" style="color: red;display: none">*两次输入密码必须一致</span>
		</div>
		<div class="sign_sex">
			<span>性别:</span>
			<select>
				<option value ="0">男</option>
				<option value ="1">女</option>
			</select>
		</div>
		<div class="sign_email">
			<span>email:</span>
			<input type="text"/>
		</div>
		<div class="submit" style="cursor:pointer">
			<a>提交</a>
		</div>
	</div>
</center>
<script type="text/javascript">
	$(".sign_repassword>input,.sign_password>input").keypress(function(){
		$("#error_repassword").hide();
	})
	$(".submit").click(function(){
		var uname = $(".sign_username>input").val().trim();
		var upwd =	$(".sign_password>input").val().trim();
		var rupwd = $(".sign_repassword>input").val().trim();
		var sex = $(".sign_sex>select").val().trim();
		var uphone = $(".sign_phone>input").val().trim();
		var email = $(".sign_email>input").val().trim();
		if (upwd == rupwd) {
			var jsonstr = {"uname":uname,"upwd":upwd,"sex":sex,"uphone":uphone,"email":email};
			var client = new HproseHttpClient('http://120.27.34.165/market/hprose.php/User', ['sign']);
			client.sign(JSON.stringify(jsonstr),function (result) {
				var jsonobj = JSON.parse(result);
				console.log(jsonobj);
				if(jsonobj.errorcode=="002"){
					alert("有重复的手机");
				}if(jsonobj.errorcode=="003"){
					alert("有重复的用户名");
				}
				else{
					var strurl = "<?php echo U('Home/Main/main');?>";
					$.cookie('usertoken',null); 
					$.cookie('usertoken', jsonobj.utoken,{ expires: 7 }); 
					document.location=strurl;
				}
			}, function (name, err) {
				console.log(err);
				return;
			})

			return
		}
		$(".sign_repassword>input").focus();
		$("#error_repassword").show();
	})
</script>
</html>