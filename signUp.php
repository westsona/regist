<?php
	/*
	项目名称:PHP实现登录与注册功能-初级
	最后更新时间：2020/02/21
	作者：west liu(http://www.westcore.top)
	*/
	session_start();
	include("conn.php");//连接数据库
	$account = isset($_POST['account']) ? $_POST['account'] : '';//取得用户昵称
	$email = isset($_POST['email']) ? $_POST['email'] : '';//取得用户邮箱
	$password2 = isset($_POST['password2']) ? $_POST['password2'] : '';//取得用户密码
	$image = isset($_POST['image']) ? strtoupper($_POST['image']) : '';//取得用户输入的图片验证码并转换为大写
	$image2 = $_SESSION['pic'];//取得图片验证码中的四个随机数
	$uid=uuid();

	if(isset($_POST['submit']))//当用户点击提交时
	{
		if($image == $image2)//判断验证码是否输入正确
		{
			$sql = "INSERT INTO user(account,email,password,uid) VALUES('$account','$email','$password2','$uid')";//SQL语句
			mysqli_query($conn,$sql);//执行SQL语句，写入用户数据
			echo "<script>alert('注册成功');window.location= 'signUp.php';</script>";
		}
		else
		{
			echo "<script>alert('验证码错误！');</script>";
		}
	}

	function uuid($prefix = '')
	{
		$chars = md5(uniqid(mt_rand(), true));
		$uuid  = substr($chars,0,8) . '-';
		$uuid .= substr($chars,8,4) . '-';
		$uuid .= substr($chars,12,4) . '-';
		$uuid .= substr($chars,16,4) . '-';
		$uuid .= substr($chars,20,12);
		return $prefix . $uuid;
	}
?>

<html lang="en">
<meta charset="UTF-8">
<meta account="Author" content="">
<meta account="Keywords" content="php 源码,PHP注册,PHP登录,PHP学习">
<meta account="Description" content="一个简单的PHP注册登录程序，欢迎学习交流。">
<head>
<title>PHP注册</title>
<style type = "text/css">
	body
	{
		width:600px;
		height:360px;
		margin-left:auto;
		margin-right:auto;
		border:1px red solid;
	}
	form
	{
		width:500px;
		height:200px;
		margin-left:auto;
		margin-right:auto;
		margin-top:30px;
		<!--border:1px red solid;-->
	}
	#image
	{
		width:200px;
		height:80px;
		margin-top:30px;
		margin-left:auto;
		margin-right:auto;
		<!--border:1px red solid;-->
	}
</style>

</head>
<body>

<script language = "javascript">
	function checkform()//使用JS来验证用户输入是否符合规范
	{
		if(myform.account.value == "")//昵称不能为空
		{
			alert("昵称不能为空！");
			myform.account.focus();
			return false;
		}
		if(!myform.account.value.replace(/[^\a-\z\A-\Z]/g,''))//使用正则表达式来判断昵称
		{
			alert("昵称不符合规范！");
			myform.account.focus();
			return false;
		}
		if(myform.account.value.length < 4 || myform.account.value.length > 8)//当用户输入的昵称小于4或者大于8时
		{
			alert("昵称不符合规范！");
			myform.account.focus();
			return false;
		}
		if(myform.email.value == "")//邮箱不能为空
		{
			alert("邮箱必须填写！");
			myform.email.focus();
			return false;
		}
		if(myform.email.value.length < 12)//邮箱不能少于12个字符，否则不符合规范
		{
			alert("邮箱不符合规范！");
			myform.email.focus();
			return false;
		}
		if(myform.password1.value == "")//密码不能为空
		{
			alert("密码不能为空！");
			myform.password1.focus();
			return false;
		}
		if(myform.password2.value == "")//密码不能为空
		{
			alert("密码不能为空！");
			myform.password2.focus();
			return false;
		}
		if(!myform.password1.value.replace(/[^\a-\z\A-\Z]/g,''))//使用正则表达式来判断密码
		{
			alert("密码不符合规范！");
			myform.password1.focus();
			return false;
		}
		if(myform.password1.value.length < 6)//如果密码小于6位
		{
			alert("密码不能少于6位！");
			myform.password1.focus();
			return false;
		}
		if(myform.password1.value != myform.password2.value)//判断两次输入的密码是否一致
		{
			alert("两次输入的密码不一致！");
			myform.password1.focus();
			return false;
		}
	}
</script>
	<form action = "" method = "post" name = "myform" onsubmit = "return checkform();"><!--注册表单-->
	<center>
		<table height = 60;>
		<tr>
			<td>昵称:</td>
			<td><input type = "text" name = "account"  /><dfn>(只能由4-8位字母或数字组成)</dfn></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input type = "email" name = "email"  /></td>
		</tr>
		<tr>
			<td>密码:</td>
			<td><input type = "password" name = "password1"  /><dfn>(必须由大于6位的字母或数字组成)</dfn></td>
		</tr>
		<tr>
			<td>确认密码:</td>
			<td><input type = "password" name = "password2"  /></td>
		</tr>
		<tr>
			<td>验证码:</td>
			<td><input type = "text" name = "image" /><img src = 'PIN_easy.php' /></td>
		</tr>
		<tr>
			<td><input type = "submit" name = "submit" value = "注册" /></td>
			<td><a href = "login.php">登录</a></td>
		</tr>
		</table>
	</center>
	</form>
</body>
</html>