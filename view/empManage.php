


<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<title>管理界面</title>
</head>

<?php
    session_start();
	echo "欢迎 ". $_SESSION['user']." 登录成功!";
    //echo  "欢迎 ". $_COOKIE['user']." 登录成功!";
?>
<br/><a href='login.php'>返回重新登录</a>
<h1>主界面</h1>
<a href='empList.php'>管理用户</a><br/>
<a href='#' onclick="anchu()">添加用户</a><br/>
<a href='#'>查询用户</a><br/>
<a href='login.php'>退出系统</a><br/>

<div style="width: 250px;height: 200px;border:solid 1px #666;position:absolute;top:80px;left:200px;display:none; top:200px;left:550px;background-color: white;box-shadow:12px 12px 10px #909090;" id="AddAdmin">
    <form method="post" action="AddAdmin.php" >
        <div style="width: 250px;height:40px;line-height:40px;text-align: center;font-size:16px;font-weight:bold;background-color: #000000;color:#FFFFFF;">请输入雇员信息</div>
        <table style=" margin-top:10px">
            <tr style="height: 30px">
                <td width="50">姓名</td>
                <td><input type="text" id="name"></td>
            </tr>
            <tr>
                <td width="50">级别</td>
                <td><input type="text" id="grade"></td>
            </tr>
            <tr>
                <td width="50">email</td>
                <td><input type="text" id="email"></td>
            </tr>
            <tr>
                <td width="50">工资</td>
                <td><input type="text" id="salary"></td>
            </tr>

        </table>
        &nbsp;&nbsp;<input type="button" value="提交" style="margin-top:15px" onclick="Submit_post()"/>
        &nbsp;&nbsp;<input type="reset"  value="重置"/>
        &nbsp;&nbsp;<input type="button" onclick="clear()" value="取消"/>
    </form>
    </div>

<script type="text/javascript">
    function clear() {
        alert("12");
        document.getElementById("AddAdmin").style.display="none";
    }
    
    function anchu() {
        var dic= document.getElementById("AddAdmin");

        
        dic.style.display="";
    }

    function createXMLHTTPRequest(){
        var xmlHttpRequest;
        if (window.XMLHttpRequest) {
            //针对FireFox，Mozillar，Opera，Safari，IE7，IE8
            xmlHttpRequest = new XMLHttpRequest();
            //针对某些特定版本的mozillar浏览器的BUG进行修正
            if (xmlHttpRequest.overrideMimeType) {
                xmlHttpRequest.overrideMimeType("text/xml");
            }
        } else if (window.ActiveXObject) {
            //针对IE6，IE5.5，IE5
            //两个可以用于创建XMLHTTPRequest对象的控件名称，保存在一个js的数组中
            //排在前面的版本较新
            var activexName = [ "MSXML2.XMLHTTP", "Microsoft.XMLHTTP" ];
            for ( var i = 0; i < activexName.length; i++) {
                try {
                    //取出一个控件名进行创建，如果创建成功就终止循环
                    //如果创建失败，回抛出异常，然后可以继续循环，继续尝试创建
                    xmlHttpRequest = new ActiveXObject(activexName[i]);
                    if(xmlHttpRequest){
                        break;
                    }
                } catch (e) {
                }
            }
        }
        return xmlHttpRequest;
    }

    function Submit_post(){
        var name=document.getElementById("name").value;
        var grade=document.getElementById("grade").value;
        var email=document.getElementById("email").value;
        var salary=document.getElementById("salary").value;

        var req = createXMLHTTPRequest();
        if(req){
            req.open("POST", "../dao/AddEmp.php", true);
            req.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=utf-8;");
            req.send("name="+name+"&grade="+grade+"&email="+email+"&salary="+salary);
            //var form = new FormData();
          // form.append("name", name);
           // form.append("password",pass);
           // req.send(form);
            req.onreadystatechange = function(){
                if(req.readyState == 4){
                    if(req.status == 200){
                        var text= req.responseText;
                        //alert(text);
                        if(text=="true"){
                        //document.getElementById("AddAdmin").style.display="none";
                        clear();
                        alert("添加成功");
                       
                        }
                        else{
                            alert("添加失败");
                        }
                    }else{
                        alert("添加失败");
                    }
                }
            }
        }
    }


</script>

</html>