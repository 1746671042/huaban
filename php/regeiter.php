<?php
session_start();
header("content-type:text/html;charset=utf8");


if (isset($_POST["zhuce"])) {
    $name = isset($_POST["name"]) ? $_POST["name"] : "";
    $pwd = isset($_POST["pwd"]) ? $_POST["pwd"] : "";
    $name_len = strlen($name);
    $pwd_len = strlen($pwd);
    $yanzheng = isset($_POST["yanzheng"]) ? $_POST["yanzheng"] : "";
    if ($name == "" || $pwd == "") {
        echo "<script>alert('请填写用户名或密码');history.go(-1);</script>";
        exit();
    }
    if ($name_len < 6 || $name_len > 11 || $pwd_len < 6 || $pwd_len > 11) {
        echo "<script>alert('未按照长度输入！');history.go(-1);</script>";
    } else {
        if ($yanzheng !== strtolower($_SESSION["yzm"])) {
            echo "<script>alert('验证码不正确！');history.go(-1);</script>";
        } else {
            //1. 连接数据库
            $con = mysqli_connect("localhost", "root", "111444le", "huaban");
            if (mysqli_connect_errno() != 0) {//输出错误码，正确是0
                echo "<script>alert('系统错误');history.go(-1);</script>";
                //    echo mysqli_connect_error();//输出错误原因
                die(); //组织程序运行
            }
            //2.校验编码
            mysqli_set_charset($con, "utf8");
            //3.执行sql语句
            $sql = "select * from zhuce where name ='{$name}'";
            $result = mysqli_query($con, $sql);
            //删除\增加\修改语句的返回结果成功为true，失败为false
            if (!$result) {
                echo "<script>alert('系统错误');history.go(-1);</script>";
                die();
            } else {
                //查询记录的条数
                $count = mysqli_num_rows($result);
                if ($count > 0) {
                    echo "<script>alert('用户名已存在！！');history.go(-1);</script>";
                    exit();
                }
            }
            //$pwd = md5($pwd);
            $sql = "insert into zhuce(name,pwd) values('{$name}','{$pwd}')";
            $insertResult = mysqli_query($con, $sql);
            if ($insertResult) {
                echo "<script>alert('注册成功！！');window.location.href = '';history.go(-1);</script>";
            } else {
                echo "<script>alert('注册失败！！');history.go(-1);</script>";
            }
        }
    }
} else {
    echo "<script>alert('系统错误');window.location.href= '';</script>";
}
mysqli_close($con);
