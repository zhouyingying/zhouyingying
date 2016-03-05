<?php

	require_once dirname(dirname(__FILE__)) . '/SQL/SqlHelper.class.php';
	//该类是一个业务逻辑处理类,主要完成对admin表操作
	class AdminService{
		
		//提供一个验证用户是否合法 的方法
		public function  chekcAdimn($id,$password){
			
			$sql="select name,password from admin where   Id=$id";
			//创建一个SqlHelper对象
			$sqlHelper=new SqlHelper();
			$res=$sqlHelper->execute_dql($sql);
			if($row=mysqli_fetch_assoc($res)){
				//比对密码
				if($password==$row['password']){
					//setcookie("name",$row['name']);
                    return $row['name'];
				}
			}
			//资源
			mysqli_free_result($res);
			//关闭连接 
			$sqlHelper->close_connect();
			return false;
		}
        
		
	}
?>