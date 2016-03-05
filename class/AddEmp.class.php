<?php

require_once '../SQL/SqlHelper.class.php';
require_once '../bean/emp.class.php';
//该类是一个业务逻辑处理类,主要完成对emp表操作
class AddEmp{

    //提供一个插入数据的方法
    public function  InsertEmp(emp $emp){
        $name=$emp->getName();
        $grade=$emp->getGrade();
        $email=$emp->getEmail();
        $salary=$emp->getSalary();

        //$sql="INSERT INTO emp (name, grade,email,salary) VALUE (?,?,?,?)";
        $sql="INSERT INTO emp (name, grade,email,salary) VALUE ('"."$name"."',$grade".",$email".",$salary)";
        //创建一个SqlHelper对象

        $sqlHelper=new SqlHelper();
        $res=$sqlHelper->execute_dql($sql);

       // $res2=$res;
       // mysqli_free_result($res);
        //关闭连接
        $sqlHelper->close_connect();
        if(!$res){
            return false;
        }else{
            return true;
        }
        //资源
    }
}
?>