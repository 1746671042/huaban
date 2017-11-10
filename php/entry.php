<?php

header("content-type:text/html;charset=utf8");
if (isset($_POST["denglu"])) {
    $name = isset($_POST["name"]) ? $_POST["name"] : "";
    $pwd = isset($_POST["pwd"]) ? $_POST["pwd"] : "";
    $name_len = strlen($name);
    $pwd_len = strlen($pwd);
//    var_dump($name_len,$pwd_len);
//    exit();
    if ($name == "" || $pwd == "") {
        echo "<script>alert('请填写用户名或密码');history.go(-1);</script>";
        exit();
    } else {
        if ($name_len < 6 || $name_len > 11 || $pwd_len < 6 || $pwd_len > 11) {
            echo "<script>alert('未按照长度输入！');history.go(-1);</script>";
        } else {
            //1连接数据库
            $con = mysqli_connect("localhost", "root", "111444le", "huaban");
            if (mysqli_connect_errno() != 0) {
                echo "<script>alert('系统错误');history.go(-1);</script>";
                die();
            }
            mysqli_set_charset($con, "utf8");
            $sql = "select name,pwd  from zhuce where name='{$name}' and pwd = '{$pwd}'";
            $result = mysqli_query($con, $sql);
            if (!$result) {
                echo "<script>alert('系统错误');history.go(-1);</script>";
                exit();
            } else {
                $row = mysqli_fetch_assoc($result);
                setcookie("user_id", $row["name"], time() + 60);
                setcookie("user_name", $row["pwd"], time() + 60);
                echo "<script>window.location.href= 'http://localhost/php/zuoye/huaban/personal.html';</script>";
            }
        }
    }
} else {
    echo "<script>alert('系统错误');window.location.href='';</script>";
}
mysqli_close($con);