<?php
session_start();
//正常的注册流程
$name = $_GET["name"];
$pwd = $_GET["pwd"];
$yzm = $_GET["yzm"];
//2验证数据
if($name ==""||$pwd ==""||$yzm==""){
    $msg = array("status"=>0,"msg"=>"请将数据填写完整");
    echo json_encode($msg); //将数组转换json对象
    exit();
}



//用户名格式判断
if(preg_match("/^[a-zA-Z][a-zA-Z0-9]{5,10}$/", $name)==false){
    $msg = array("status"=>0,"msg"=>"用户名格式不正确");
    echo json_encode($msg);
    exit();
}

//密码格式是否正确
if(preg_match("/^[a-zA-Z0-9_]{8,15}$/", $pwd) ==false){
   $msg = array("status"=>0,"msg"=>"密码格式不正确");
    echo json_encode($msg);
    exit();
}
//验证码格式是否正确
if($yzm !=strtolower($_SESSION["yzm"])){
   $msg = array("status"=>0,"msg"=>"验证码不正确");
    echo json_encode($msg);
    exit();
}

$con = mysqli_connect("localhost", "root", "111444le", "huaban");
if(!$con){
    $msg = array("status"=>0,"msg"=>"系统错误，请重试！");
    echo json_encode($msg);
    exit();
}
mysqli_set_charset($con, "utf8");
$sql ="select * from user where username ='{$name}'";
$result = mysqli_query($con, $sql);
if(!$result){
     $msg = array("status"=>0,"msg"=>"系统错误，请重试！");
    echo json_encode($msg);
    exit();
}
$num =mysqli_num_rows($result);
if($num>0){
    $msg = array("status"=>0,"msg"=>"用户名已存在");
    echo json_encode($msg);
    exit();
}
$pwd = md5($pwd);
$sql = "insert into user(username,pwd) values('{$name}','{$pwd}')";
$result = mysqli_query($con,$sql);
if($result){
     $id = mysqli_insert_id($con);//获取插入的id号
     setcookie("user_id",$id,time()+3600*24);
     setcookie("user_name",$name,time()+3600*24);
     $msg = array("status"=>1,"msg"=>"注册成功");
     echo json_encode($msg);
}
else{
    $msg = array("status"=>0,"msg"=>"注册失败,请重试。");
//    $msg = array("status"=>0,"msg"=> mysqli_error($con));
    echo json_encode($msg);
}




//else{
//   $msg = array("status"=>1,"msg"=>"请求成功");
//   echo json_encode($msg);
//}