<?php
//收藏操作  判断是否登录
if(!isset($_COOKIE["user_id"]) ||$_COOKIE["user_id"]<=0){
    $arr =array("status"=>1,"msg"=>"请登录");
    echo json_encode($arr);
    exit();
}
$uid = isset($_POST["uid"])?$_POST["uid"]:0;
$iid = isset($_POST["iid"])?$_POST["iid"]:0;
if($uid <=0 || $iid <=0){
    $arr =array("status"=>2,"msg"=>"参数错误");
    echo json_encode($arr);
    exit();
}


//入库
header('Content-type:text/html; charset=utf-8');
$con = mysqli_connect("localhost", "root", "111444le", "huaban");
if(!$con){
    $arr =array("status"=>2,"msg"=>"系统错误");
    echo json_encode($arr);
    exit();
}
mysqli_set_charset($con, "utf8");
$sql = "insert into collection(uid,iid) values({$uid},{$iid})";
$result = mysqli_query($con, $sql);
if($result){
    $arr =array("status"=>0,"msg"=>"收藏成功");
    echo json_encode($arr);
    exit();
}else{
    $arr =array("status"=>2,"msg"=>"收藏失败");
    echo json_encode($arr);
    exit();
}