<?php

	//这个一个工具类,作用是完成对数据库的操作
	class SqlHelper {

		public $conn;
		public $db_name="empmanage";
		public $username="root";
		public $password="root";
		public $host="localhost";

		public function __construct(){


            $this->conn=new mysqli($this->host,$this->username,$this->password);

//			$this->conn=mysql_connect($this->host,$this->username,$this->password);
//			if(!$this->conn){
//				die("连接失败".mysql_error());
//			}
//			mysql_select_db($this->dbname,$this->conn);

            if(mysqli_connect_errno())
            {
                echo mysqli_connect_error();
            }
            $this->conn-> select_db($this->db_name);
		}


		//执行dql语句
		public function execute_dql($sql){
            mysqli_query($this->conn,"set names utf8");
			//$res=mysql_query($sql,$this->conn) or die(mysql_error());
            $res = mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn)) ;
			return $res;

		}

        //添加操作
        public function addemp(emp $emp){
            $this->conn-->query("set names gbk");

            $sql = "insert into user1(name,psw,email,age) values(?,?,?,?)";

            $mysqli_stmt = $this->conn->prepare($sql);
            $mysqli_stmt->bind_param("sisi",$emp->getName(),$emp->getGrade(),$emp->getEmail(),$emp->getSalary());

            $b = $mysqli_stmt->execute();

            return $b;

        }

		//执行dql语句，但是返回的是一个数组
		public function execute_dql2($sql){

			$arr=array();
			$res=mysqli_query($this->conn,$sql) or die(mysqli_error());

			//把$res=>$arr 把结果集内容转移到一个数组中.
			while($row=mysqli_fetch_assoc($res)){
				$arr[]=$row;
			}
			//这里就可以马上把$res关闭.
			mysqli_free_result($res);
			return $arr;

		}

		//考虑分页情况的查询,这是一个比较通用的并体现oop编程思想的代码
		//$sql1="select * from where 表名 limit 0,6";
		//$sql2="select count(id) from 表名"
		public function exectue_dql_fenye($sql1,$sql2,$fenyePage){

			//这里我们查询了要分页显示的数据
			$res=$this->conn->query($sql1) or die(mysqli_error());
			//$res=>array()
			$arr=array();
			//把$res转移到$arr
			while($row=mysqli_fetch_assoc($res)){
				$arr[]=$row;
			}

			mysqli_free_result($res);

			$res2=mysqli_query($this->conn,$sql2) or die(mysqli_error());

			if($row=mysqli_fetch_row($res2)){
				$fenyePage->pageCount=ceil($row[0]/$fenyePage->pageSize);
				$fenyePage->rowCount=$row[0];
			}

			mysqli_free_result($res2);

			//把导航信息也封装到fenyePage对象中
			$navigate="";
            if ($fenyePage->pageNow>20){
                $prePage=$fenyePage->pageNow-20;
                $navigate= "<a href='../view/empList.php?pageNow=$prePage'><<<</a>&nbsp;";
            }
			if ($fenyePage->pageNow>1){
				$prePage=$fenyePage->pageNow-1;
				$navigate.= "<a href='../view/empList.php?pageNow=$prePage'>上一页</a>&nbsp;";
			}
            for($start=$fenyePage->pageNow-5;$start<$fenyePage->pageNow+5;$start++){
                if($start>0&&$start<=$fenyePage->rowCount) {
                    $navigate.="<a href='empList.php?pageNow=$start'>[$start]</a>";
                }
            }
			if($fenyePage->pageNow<$fenyePage->pageCount){
				$nextPage=$fenyePage->pageNow+1;
				$navigate.= "<a href='../view/empList.php?pageNow=$nextPage'>下一页</a>&nbsp;";
			}
            if($fenyePage->pageNow<$fenyePage->pageCount-20){
                $nextPage=$fenyePage->pageNow+20;
                $navigate.= "<a href='../view/empList.php?pageNow=$nextPage'>>>></a>&nbsp;";
            }
			//把$arr赋给$fenyePage
			$fenyePage->res_array=$arr;
			$fenyePage->navigate=$navigate;





		}

		//执行dml语句
		public  function execute_dml($sql){

			$b=mysqli_query($this->conn,$sql);
			if(!$b){
				return 0;
			}else{
				if(mysqli_affected_rows($this->conn)>0){
					return 1;//表示执行ok
				}else{
					return 2;//表示没有行受到影响
				}
			}

		}

		//关闭连接的方法
		public function close_connect(){

			if(!empty($this->conn)){
				mysqli_close($this->conn);
			}
		}
	}
?>