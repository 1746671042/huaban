<?php
//收藏操作  判断是否登录
if(!isset($_COOKIE["user_id"]) ||$_COOKIE["user_id"]<=0){
    $arr =array("status"=>1,"msg"=>"请登录");
    echo json_encode($arr);
    exit();
}
$name = isset($_GET["name"])?$_GET["name"]:"";
$val = isset($_GET["val"])?$_GET["val"]:"";

if($name =="" ||$val ==""){
    $arr =array("status"=>2,"msg"=>"信息填写不完整！");
    echo json_encode($arr);
    exit();
    
}
//修改入库
$con = mysqli_connect("localhost", "root", "111444le", "huaban");
if(!$con){
    echo "连接失败！！";die();
}
mysqli_set_charset($con, "utf8");
/*------密码加密------*/
if($name == "pwd"){
    $val = md5($val);
}
$sql = "update user set {$name}='{$val}' where id=".$_COOKIE["user_id"];
if(mysqli_query($con, $sql)){
    $arr =array("status"=>0,"msg"=>"修改成功！");
    echo json_encode($arr);
    exit();
}
else{
    $arr =array("status"=>2,"msg"=>"修改失败！");
    echo json_encode($arr);
    exit();
}