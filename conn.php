<?php
	/*
	项目名称:PHP实现登录与注册功能-初级
	最后更新时间：2020/02/21
	作者：west liu(http://www.westcore.top)
	*/
	$conn = @mysqli_connect("localhost","root","test112") or die("数据库连接出错！");//输入相应的数据库地址、用户名和密码
	$selected = mysqli_select_db($conn, "test");//打开一个数据表，请打开readme.txt在这个表中创建字段
?>