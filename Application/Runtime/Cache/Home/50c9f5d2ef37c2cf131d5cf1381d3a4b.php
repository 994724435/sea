<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>登录</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="stylesheet" href="/Public/Home/css/aui.min.css">
		<link rel="stylesheet" href="/Public/Home/css/common.css" />
		<style>
			.mui-input-row label{width: 15%;}
			.mui-input-group{background: #efeff4;}
			.mui-input-row{background: #fff;}
			.logo{display: block;width: 100%;}
			.mui-input-row label .mui-icon{position: relative;top: -2px;color:#1b7ac0 ;}
			.mui-input-row label~input{width: 85%;font-size: 14px;text-indent: 8px;font-family: "微软雅黑";}
			.mui-btn-block{padding: 8px 0;width: 90%;margin: 30px auto;font-size: 15px;}
			.mui-btn-primary{background: #1b7ac0;border-color:#1b7ac0;}
			/* .logo{display: block;width:200px;margin: 40px auto 10px;} */
			.logotext{text-align: center;margin: 0;color: #000;font-family: "微软雅黑";}
			.mui-input-group{margin-top: 10px;}
			.code{width: 80px;color: #fff;background: #1b7ac0;position: absolute;right: 0;top: 0;height: 40px;line-height: 40px;text-align: center;}
		</style>
	</head>

	<body>
		<!--<header class="mui-bar mui-bar-nav">
		  <h1 class="mui-title">登录</h1>
		</header>-->
		<div class="mui-content">
			 <img src="/Public/Home/img/p_39.png" class="logo"/>
			<form class="mui-input-group" action="" method="post" enctype="multipart/form-data">
			<div class="mui-input-row">
				<label><span class="mui-icon mui-icon-person"></span></label>
				<input type="text" name="name" class="mui-input-clear" placeholder="请输入手机号"  id="user">
			</div>
			<div class="mui-input-row">
				<label><span class="mui-icon mui-icon-locked"></span></label>
				<input type="password" name="pwd" class="mui-input-clear" placeholder="请输入密码" id="pwd">
			</div>
			<div class="mui-input-row">
				<label><span class="mui-icon mui-icon-locked"></span></label>
				<input type="number" name="numbers"  placeholder="请输入验证码"><span class="code"><?php echo ($numbers); ?></span>
			</div>
				<input type="hidden" name="number" value="<?php echo ($numbers); ?>">
			<button class="mui-btn mui-btn-primary mui-btn-block" id="login" type="submit">立即登录</button>

			</form>
		</div>
       
		
		<script src="/Public/Home/js/jquery-3.1.1.min.js"></script>
		<script type="text/javascript">
			
			
		</script>
	</body>

</html>