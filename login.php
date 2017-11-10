<?php
//登录流程
$name = $_GET["name"];
$pwd = $_GET["pwd"];
//2验证数据
if($name ==""||$pwd ==""){
    $msg = array("status"=>0,"msg"=>"用户名或密码不能为空");
    echo json_encode($msg); //将数组转换json对象
    exit();
}

$con = mysqli_connect("localhost", "root", "111444le", "huaban");
if(!$con){
    $msg = array("status"=>0,"msg"=>"系统错误，请重试！");
    echo json_encode($msg);
    exit();
}
mysqli_set_charset($con, "utf8");
$pwd = md5($pwd);
$sql = "select * from user where username='{$name}' and pwd='{$pwd}'";
$result = mysqli_query($con,$sql);
if(!$result){
     $msg = array("status"=>0,"msg"=>"系统错误，请重试。");
     echo json_encode($msg);
     exit();
}
$row = mysqli_fetch_assoc($result);
if($row!=null){
//      $id = mysqli_insert_id($con);//获取插入的id号
     setcookie("user_id",$row["id"],time()+3600*24);
     setcookie("user_name",$row["username"],time()+3600*24);
     $msg = array("status"=>1,"msg"=>"登陆成功！！");
     echo json_encode($msg);
     exit();
}
else{
     $msg = array("status"=>0,"msg"=>"账号或密码错误！");
     echo json_encode($msg);
     exit();
}