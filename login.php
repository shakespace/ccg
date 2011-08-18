<?php

	$userName = $_POST("UserName");
	$password = $_POST("Password");
	
	
	
	if($userName=="zhangsan" && $password=="123456")
	{
		echo 'login succeed';
	}
	else
	{
		echo 'login failed';
	}
	
?>