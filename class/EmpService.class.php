<?php

	require_once '../SQL/SqlHelper.class.php';

	class EmpService{
		//一个函数可以获取共有多少页
		function getPageCount($pageSize){

			//需要查询$rowCount
			$sql="select count(id) from emp";
			$sqlHelper=new SqlHelper();
			$res=$sqlHelper->execute_dql($sql);

			//这样就可以计算$pageCount
			if($row=mysqli_fetch_row($res)){
				$pageCount=ceil($row[0]/$pageSize);
			}
			//释放资源关闭连接
			mysqli_free_result($res);
			//关闭连接
			$sqlHelper->close_connect();
			return $pageCount;
		}

		//一个函数可以获取应当显示的雇员信息
		function getEmpListByPage($pageNow,$pageSize){

			$sql="select * from emp limit ".($pageNow-1)*$pageSize.",$pageSize";

			$sqlHelper=new SqlHelper();
			//这里的$res就是一个二维数组
			$res=$sqlHelper->execute_dql2($sql);

			//释放资源和关闭连接
			//关闭连接
			$sqlHelper->close_connect();

			return $res;

		}

		//第二种使用封装的方式完成的分页(业务逻辑到这里)
		function getFenyePage($fenyePage){

			$sql1="select * from emp  limit "
			.($fenyePage->pageNow-1)*$fenyePage->pageSize.",".$fenyePage->pageSize;

			$sql2="select count(id) from emp";

			//创建一个SqlHelper对象实例
			$sqlHelper=new SqlHelper();
			$sqlHelper->exectue_dql_fenye($sql1,$sql2,$fenyePage);

			$sqlHelper->close_connect();
		}
	}
?>