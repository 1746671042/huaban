<?php
session_start();
//header("content-type:image/jpeg");
$img = imagecreate(120, 40);
imagecolorallocate($img, rand(0, 255),rand(0, 255) ,rand(0, 255));
$arr = array_merge(range(0, 9), range("A", "Z"), range("a", "z"));
$sum = "";
for($i=0;$i<5;$i++){
    $num = rand(0, 61);
    $str = $arr[$num];
    $color = imagecolorallocate($img, rand(0,255), rand(0,255),rand(0,255));
    $size = rand(15, 20);
    $anger = rand(0, 50);
    $y = rand(25,40);
    $x = rand(20*$i+10, 20*($i+1)+10);
    imagettftext($img, $size, $anger, $x, $y, $color,"msyh.ttc", $str);
    $sum =$sum.$str;
    
}
$_SESSION["yzm"] = $sum;
//var_dump($_SESSION["yzm"]);
imagejpeg($img);
?>
