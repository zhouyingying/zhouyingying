<?php
/**
 * User: zhou
 * Date: 2016/3/1
 * Time: 20:18
 * Function:封装的emp数据类
 */
class emp
{
    private $id;
    private $name;
    private $grade;
    private $email;
    private $salary;

    public function getEmail()
    {
        return $this->email;
    }

    public function getGrade()
    {
        return $this->grade;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSalary()
    {
        return $this->salary;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setGrade($grade)
    {
        $this->grade = $grade;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setSalary($salary)
    {
        $this->salary = $salary;
    }
    public function __construct($name,$grade,$email,$salary)
    {
        $this->name=$name;
        $this->email=$email;
        $this->grade=$grade;
        $this->salary=$salary;
    }
}
?>