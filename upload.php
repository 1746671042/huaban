
<!DOCTYPE html>
<html>
    <head>
        <title>花瓣网_陪你做生活的设计师(发现、采集你喜欢的灵感、家具、穿搭、婚礼、美食、旅行、美图、商品等)</title>
        <meta charset="UTF-8">
	<link rel="shortcut icon" type="image/x-icon" sizes="any" href="images/images/favicon.ico">
        <link type="text/css" rel="stylesheet" href="css/index.css" />
        <link type="text/css" rel="stylesheet" href="css/common.css"/>
        <script type="text/javascript" src="js/jquery-1.12.3.min.js"></script>
        <link type="text/css" rel="stylesheet" href="css/sweet-alert.css"/>
        <script type="text/javascript" src="js/sweet-alert.min.js"></script>
        <!--<script type="text/javascript" src="js/common.js"></script>-->
        <script type="text/javascript" src="js/index.js"></script>
        
    </head>
    <body>

<?php
header('content-type:text/html;charset:utf-8');
/*-------------头像上传-------------*/
$file = $_FILES["image"];
if($file["error"]!=0){
//echo "<script>console.log('上传失败');history.go(-1);</script>";
swal("上传失败！","","error");
exit();
    
}
//var_dump($file);
/*重命名
 * 获取后缀
 */
$num = strrpos($file["name"], ".");
$type = substr($file["name"], $num);
$newname = date("YmdHis").rand(100, 999).$type;

//确定上传路径
$upload ="./uploads/";
$filePath =$upload.$newname;

//移动文件
if(move_uploaded_file($file["tmp_name"],$filePath)){
            //修改入库
        $con = mysqli_connect("localhost", "root", "111444le", "huaban");
        if(!$con){
//             echo "<script>console.log('上传失败');history.go(-1);</script>";
             swal("上传失败！","","error");
            exit();
        }
        mysqli_set_charset($con, "utf8");
        /*------密码加密------*/
        $sql = "update user set H_portrait='{$filePath}' where id=".$_COOKIE["user_id"];
        if(mysqli_query($con, $sql)){
            echo "<script>self.location=document.referrer;</script>";
        }
        else{
//            echo "<script>console.log('上传失败');history.go(-1);</script>";
            swal("上传失败！","","error");
        }
}
else{
//        echo "<script>console.log('上传失败');history.go(-1);</script>";
        swal("上传失败！","","error");
        exit();
}
?>
</body>
</html>
