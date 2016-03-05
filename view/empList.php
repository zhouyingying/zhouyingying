<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<title>雇员信息列表</title>
</head>
<?php

	require_once '../class/EmpService.class.php';
	require_once '../bean/FenyePage.class.php';


	//创建一个FenyePage对象实例
	$fenyePage=new FenyePage();
	
	//给fenyePage指定必须的数据
	$fenyePage->pageNow=1;
	$fenyePage->pageSize=6;
	
	
	//这里我们需要根据用户的点击来修改$pageNow这个值
	//这里我们需要判断 是否有这个pageNow发送，有就使用，
	//如果没有，则默认显示第一页
	if(!empty($_GET['pageNow'])){
		$fenyePage->pageNow=$_GET['pageNow'];

	}
	//创建了EmpService对象实例
	$empService=new EmpService();
	//调用getEmpListByPage方法,该方法可以把fenyePage完成
	$empService->getFenyePage($fenyePage);
	
	echo "<table border='1px' bordercolor='green'  cellspacing='0px'  width='700px'>";
	echo "<tr><th>id</th><th>name</th><th>grade</th><th>email</th><th>salary</th><th>删除用户</th><th>修改用户</th></tr>"; 
	
	for($i=0;$i<count($fenyePage->res_array);$i++){
		$row=$fenyePage->res_array[$i];
			echo "<tr><td>{$row['id']}</td>".
                    "<td>{$row['name']}</td>".
                "<td>{$row['grade']}</td>".
                "<td>{$row['email']}</td>".
                "<td>{$row['salary']}</td>".
		        "<td><a href='#'>删除用户3</a></td>".
                "<td><a href='#'>修改用户</a></td></tr>";
	}
	echo "<h1>雇员信息列表 </h1>";
	echo "</table>";
	
	
	//显示上一页和下一页
	
	echo $fenyePage->navigate;

	//可以使用for打印超链接


/*	$page_whole=10;
	$start=floor(($pageNow-1)/$page_whole)*$page_whole+1;
	$index=$start;
	//整体每10页向前翻
	//如果当前pageNow在1-10页数，就没有向前翻动的超连接
	if($pageNow>$page_whole){
		echo "&nbsp;&nbsp;<a href='empList.php?pageNow=".($start-1)."'>&nbsp;&nbsp;<<&nbsp;&nbsp;</a>";
	}
	//定$start 1---》10  floor((pageNow-1)/10)=0*10+1   11->20   floor((pageNow-1)/10)=1*10+1 21-30 floor((pageNow-1)/10)=2*10+1
	for(;$start<$index+$page_whole;$start++){
		echo "<a href='empList.php?pageNow=$start'>[$start]</a>";
	}
	
	//整体每10页翻动
	echo "&nbsp;&nbsp;<a href='empList.php?pageNow=$start'>&nbsp;&nbsp;>>&nbsp;&nbsp;</a>";
	//显示当前页和共有多少页
	echo " 当前页{$pageNow}/共{$pageCount}页";
	
	//指定跳转到某页
	echo "<br/><br/>";*/
	?>

	<form action="empList.php">
	跳转到:<input type="text" name="pageNow" />
	<input type="submit" value="GO">
	</form>
	
</html>