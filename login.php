<?php
	/*
	项目名称:PHP实现登录与注册功能-初级
	最后更新时间：2020/02/21
	作者：west liu(http://www.westcore.top)
	*/
	// error_reporting(0);
	session_start();
	include("conn.php");
	$postEmail = isset($_POST['email']) ? $_POST['email'] : '';//取得用户输入的email
	$postPassword = isset($_POST['password']) ? $_POST['password'] : '';//取得用户输入的密码
	$sql = "SELECT email,password,uid FROM user WHERE email = '$postEmail'";//SQL查询
	$query = mysqli_query($conn,$sql);//执行SQL语句
	$row=mysqli_fetch_array($query,MYSQLI_ASSOC);
	$email = $row[email];//将查询的结果赋值
	$password = $row[password];//将查询的结果赋值uid
	$uid = $row[uid];//将查询的结果赋值
	if(isset($_POST['login']))//当用户点击登录按钮时
	{
		if($email == $postEmail && $password == $postPassword)//验证用户名和密码是否一致
		{
			$_SESSION['userinfo']=[
				'uid'=>$uid,
				'email'=>$email
			];
			header("location:index.php");
		}
		else
		{
			echo "<script>alert('帐户名或密码错误！');history.go(-1)</script>";//用户名和密码不一致，跳转到当前页面重新输入
		}
	}

	
?>

<html lang="en">
<meta charset="UTF-8">
<meta name="Author" content="">
<meta name="Keywords" content="php 源码,PHP注册,PHP登录,PHP学习">
<meta name="Description" content="一个简单的PHP注册登录程序，欢迎学习交流。">
<script language = "javascript"><!--使用js验证-->
	function Checked()
	{
		if(myform.email.value == "")//如果Email为空
		{
			alert("您还没有填写登录邮箱！");
			myform.email.focus();
			return false;
		}
		if(myform.password.value == "")//如果密码为空
		{
			alert("您忘记填写密码了！");
			myform.password.focus();
			return false;
		}
	}
</script>
<style type = "text/css">
	body
	{
		width:400px;
		height:280px;
		margin-left:auto;
		margin-right:auto;
		border:1px red solid;
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
<head>
<title>PHP登录</title>
</head>
<body>
	<center>
	<!--登录表单-->
	<form action = "" method = "post" name = "myform" onsubmit = "return Checked();">
		<table>
			<tr>
				<td>Email:</td>
				<td><input type = "email" name = "email" /></td>
			</tr>
			<tr>
				<td>密码:</td>
				<td><input type = "password" name = "password" /></td>
			</tr>
			<tr>
				<td><input type = "submit" name = "login" value = "登录" /></td>
				<td><a href = "signUp.php">注册</a></td>
			</tr>
		</table>
	</form>
	<!--登录表单结束-->
	</center>
</body>
</html>
