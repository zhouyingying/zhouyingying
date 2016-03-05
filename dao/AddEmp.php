<?php
/**
 * User: zhou
 * Date: 2016/3/1
 * Time: 18:09
 * Function:
 */
require_once '../class/AddEmp.class.php';
require_once  '../bean/emp.class.php';

$name=$_POST['name'];
$grade=$_POST['grade'];
$email=$_POST['email'];
$salary=$_POST['salary'];

$emp=new emp($name,$grade,$email,$salary);

$addemp=new AddEmp();
try {
    $res = $addemp->InsertEmp($emp);
}catch(Exception $e){
    echo "false";
}
if($res){
    echo "true";
}else{
    echo "false";
}





?>