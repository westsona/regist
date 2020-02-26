<?php
	/*
	项目名称:PHP实现登录与注册功能-初级
	最后更新时间：2020/02/21
	作者：west liu(http://www.westcore.top)
	*/
  session_start();
    if(empty($_SESSION['userinfo']['uid'])&&empty($_SESSION['userinfo']['email'])){
      echo '未登录';
    }else{
      echo '已登录';
    }
?>
<html lang="en">
<meta charset="UTF-8">
<meta name="Author" content="West Liu">
<meta name="Keywords" content="php 源码,PHP注册,PHP登录,PHP学习">
<meta name="Description" content="一个简单的PHP注册登录程序，欢迎学习交流。">
<head>
<title>PHP首页</title>
</head>
<body>
      <tr>
      <td><a href = "login.php">登录</a></td>
				<td><a href = "signUp.php">注册</a></td>
			</tr>
</body>
</html>
