<?php
	
	require_once '../class/AdminService.class.php';
	//接收用户的数据
	//1.id
	$id=$_POST['id'];
	//2.密码
	$password=$_POST['password'];
    session_start();
	
	//实例化一个AdminServive方法
	$adminService=new AdminService();
	$name=$adminService->chekcAdimn($id,$password);
	if($name!=""){

        $_SESSION['user']=$name;
	   //setcookie("user1",$name,time()+1200);
		//合法
		header("Location: "."../view/empManage.php");
		exit();
	}else{
		//非法
		header("Location: "."../view/login.php?errno=1");
		exit();
	}
	
	
?>