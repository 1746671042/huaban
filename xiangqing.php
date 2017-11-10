<?php

$con = mysqli_connect("localhost", "root", "111444le", "huaban");
if(!$con){
    echo "连接失败！！";die();
}
mysqli_set_charset($con, "utf8");
/*------------------判断是否登陆-------------------*/
//判断是否登陆
$userinfo =array();
if(isset($_COOKIE["user_id"]) && $_COOKIE["user_id"] >0){
    //用户登录状态
    //获取用户信息
    $sql ="select * from user where id=".$_COOKIE["user_id"];
    $result = mysqli_query($con, $sql);
    if($result){
        $userinfo = mysqli_fetch_assoc($result);
    }
}
//是否收藏
$isLike = false;
$user =array();
if(isset($_COOKIE["user_id"]) && $_COOKIE["user_id"] >0){ 
    //用户登录状态
    //获取用户信息
    $sql ="select * from user where id=".$_COOKIE["user_id"];
    $result = mysqli_query($con, $sql);
    if($result){
        $user = mysqli_fetch_assoc($result);
        //--------判断是否收藏---------------*/
        $sql = "select * from collection where uid={$user["id"]} and iid={$id}";
        $result = mysqli_query($con, $sql);
            if($result)
            {
                $num = mysqli_num_rows($result);
                if($num>0){
                     $isLike =true;
                }
            }
         //--------判断收藏---------------*/
    }
}

/*----------------查询图片的详情-------------*/
$id = isset($_GET["id"])?$_GET["id"]:1;
$sql ="select * from image where id={$id}";
$result = mysqli_query($con, $sql);
$imageInfo = array();
if($result){
    $imageInfo = mysqli_fetch_assoc($result);
}


/*---------------图片对应的用户信息---------------*/
$sql = "select * from user where id={$imageInfo["uid"]}";
$result = mysqli_query($con, $sql);
$usertwoinfo =array();
if($result){
    $usertwoinfo = mysqli_fetch_assoc($result);
}


/*----------------获取评论内容---------------------*/
$sql = "select * from comment where iid={$id} order by date desc limit 0,2";
$result = mysqli_query($con, $sql);
$commentList =array();
if($result){
    while ($row = mysqli_fetch_assoc($result)){
        $commentList[]=$row;
    }
}




/*-------------------------------------------------查询------------------------------------------------------*/
$search = isset($_GET["search"])?$_GET["search"]:"";

//分页
$page =isset($_GET["page"])?$_GET["page"]:1;  ///当前页数

$num =5;   //每页显示的条数

$start =($page-1) * $num;   //0
/*-------------------------------------------总页数 ----------------------*/
$sql1 = "select count(conent) as c from comment where iid={$id} order by date desc limit 0,2";
$result = mysqli_query($con, $sql1);
$count=0;
if($result){
    $row = mysqli_fetch_assoc($result);
    $count=$row["c"];
}
$countpage= ceil($count/$num);
/*-------------------------------------------总页数 ----------------------*/

/*-------------------------------------------每页数据 ----------------------*/
//echo $start;
$sql ="select * from comment limit {$start},{$num} ";

$result = mysqli_query($con, $sql);
$list =array();
if($result!=false){
    while ($row = mysqli_fetch_assoc($result)){
        $list[]=$row;
    }
}

/*-------------------------------------------每页数据 ----------------------*/



/*-----------------textarea---------------*/
$text = isset($_GET['text'])?$_GET['text']:"";
echo $text;
?>


<!DOCTYPE html>
<html>
    <head>
        <title>详情页面</title>
        <meta charset="UTF-8">
	<link rel="shortcut icon" type="image/x-icon" sizes="any" href="images/images/favicon.ico">
        <link type="text/css" rel="stylesheet" href="css/xiangqing.css" />
        <link type="text/css" rel="stylesheet" href="css/common.css" />
        <script type="text/javascript" src="js/jquery-1.12.3.min.js"></script>
        <link type="text/css" rel="stylesheet" href="css/sweet-alert.css"/>
        <script type="text/javascript" src="js/sweet-alert.min.js"></script>
        <script type="text/javascript" src="js/common.js"></script>
        <script type="text/javascript" src="js/xiangqing.js"></script>
    </head>
    <body>
        <div class="header">
			<div class="nav_two clearbox">
			<div class="header_nav_left">
                        <a id="huaban" href="index.php"></a>
                	<a href="index.php" data-title="home" class="header-item active" id="top">首页</a>
                	<a href="javascript:;" class="header-item" id="top">发现</a>
                	<a href="javascript:;"class="header-item" id="top">最新</a>
                	<a href="javascript:;" target="_blank" class="header-item meisi" >美思 
                		<span class="entrance">new</span>
                	</a>
                	
                	<a href="" target="_blank" class="header-item meisu">
                		活动
                	</a>
                	<a href="javascript:;" target="_blank" class="header-item live">教育</a>
                	<a class="menu-nav"></a>
                </div>
                	
                <div class="header_nav_right">
                                     <?php if($userinfo ==null){?>
		                		<div class="login-nav">
		                			<a href="javascript:;" class="register btn rbtn" id="register" onclick="f3()">
		                				<span class="text">注册</span>
		                			</a>
		                			<a href="javascript:;" class="login btn wbtn" id="entry" onclick="f1()">
		                				<span class="text">登录</span>
		                			</a>
		                		</div>
                                     <?php } else {?>
                                        <div class="login-navtwo">
                                                    <a href="javascript:;" class="body_logo" id="header_nav_right_logo">
<!--                                                            <img src="images/images/kojng.png" />-->
                                                        <?php if($userinfo["H_portrait"]!="") {?>
                                                        <img src="<?php echo $userinfo["H_portrait"]; ?>"/>
                                                        
                                                        <?php }else {?>
                                                        <img src="images/images/kong.png" />
                                                        <?php }?>
                                                    </a>
                                                        <div class="header_nav_xiala" id="xiala">
                                                                <p>
                                                                        <img src="images/images/persion-icon.png" height="15"/>
                                                                        <a href="personal.php">个人中心</a>
                                                                </p>
                                                                <p>
                                                                        <img src="images/images/like-icon.png" height="15"/>
                                                                        <a href="personaltwo.php">我的收藏</a>
                                                                </p>
                                                                <p>
                                                                        <img src="images/images/quit-icon.png" height="15"/>
                                                                        <a href="exit.php">退出登录</a>
                                                                </p>
                                                        </div>
					            </div>
                                            <?php }?>
		                </div>
                	<form id="search-form" method="get" action="" class="searching-unit">
                		<input id="query" size="27" name="q" placeholder="搜索你喜欢de" />
                		<a href="javascript:;" class="go" id="gototwo" ></a>
                	</form>
			</div>
		</div>
           
           <!--中部-->
           <div class="wrapper wrapper-998">
           	   <!--左侧-->
           	   <div class="wrapper_left clearbox">
	           	   	<div class="top">
                                    <!--判断是否收藏-->
                                    <?php if($isLike == true) {?>
                                    <span class="shoucang"  style="background:rgba(0,0,0,.3)">收&nbsp;藏</span>
                                    <?php } else { ?>
                                    <span class="shoucang" id="like" >收&nbsp;藏</span>
                                    <?php }?>
                                    <span class="back" onclick="self.location=document.referrer;">返&nbsp;回</span>
	           	   	</div>
	           	   	<div class="img_two">
                                    <img src="<?php echo $imageInfo["url"]?>" width="700"/>
	           	   	</div>
           	   </div>
           	   <!--右侧-->
           	   <div class="wrapper_right clearbox">
           	   	    <div class="right_top">
                                <?php if(!isset($userinfo["H_portrait"])) {?>
                                <img src="images/images/kong.png" height="70"/>
                                <?php }else {?>
                                <img src="<?php echo $userinfo["H_portrait"];?>" height="70"/>
                                <?php }?>
                                
                                
                                 <?php if(!isset($userinfo["username"])) {?>
                                <p class="name_liu"><?php echo "无名氏！"?></p>
                                <?php }else {?>
                                <p class="name_liu"><?php echo $userinfo["username"];?></p>
                                <?php }?>
                                
                                
           	   	    	
                                <!--//H_portrait   是头像-->
           	   	    	<p class="name_liu"><?php // echo $userinfo["username"];?></p>
           	   	    	<br />
           	   	    	<p class="date_liu">发布于<?php echo date("Y.m.d",$imageInfo["date"])?></p>
           	   	    </div>
           	   	    <div class="right_body">
                                <?php foreach ($commentList as $ck=>$cv) {?>
                               
           	   	    	<div class="pinglun pl_lun">
                                        <?php 
                                        $sql = "select * from user where id={$cv["uid"]}";
                                        $result = mysqli_query($con, $sql);
                                        $info =array();
                                        if($result){
                                            $info = mysqli_fetch_assoc($result);
                                        }
                                        ?>
                                        <img src="<?php  if($info["H_portrait"]==""){echo "images/images/kong.png";}else echo $info["H_portrait"];?>" style="height:50px"/>
           	   	    		<span class="liuyan_one"><?php echo $info["username"];?></span>
           	   	    		<span class="liuyan_date"><?php echo date("Y年m月d日",$cv["date"]);?></span>
           	   	    		<p class="huifu"><?php echo $cv["conent"];?></p>
           	   	    	</div>
                                <?php }?>
<!--           	   	    	<div class="pinglun_two pl_lun">
           	   	    		<img src="images/images/list_icon1.jpg" />
           	   	    		<span class="liuyan_two">djkfjdsaf</span>
           	   	    		<span class="liuyan_datetwo">09月26日</span>
           	   	    		<p class="huifu">回复:fafads</p>
           	   	    	</div>-->
           	   	    
           	   	    </div>
<!--           	   	    分页
           	   	    <div class="fix">
           	   	    	<a><</a>
           	   	    	<a class="page">1</a>
           	   	    	<a>></a>
           	   	    </div>-->
                             <!--分页-->
	    <div class="page">
	    	<div id="page_nav">
                    <?php if($countpage >1) {?>
                        
	    		<ul>  
                            <?php 
                                $startpage =$page-2;
                                $endpage =$page+2;
                              
                                if($countpage>=4){
                                    if($startpage<=0){
                                        $startpage = 1;
                                        $endpage = 4;
                                    }
                                    if($endpage>$countpage){
                                        $endpage=$countpage;
                                        $startpage=$endpage-1;
                                    }
                                }
                                else{
                                    $startpage=1;
                                    $endpage=$countpage;
                                }
                            ?>
                            
                            
                            <?php if($page>1) { ?>
	    			<li>
                                    <a href="xiangqing.php?page=<?php echo $page-1;?>"><</a>
                                </li>
                            <?php }?>
                                
                                
                            <?php for($i =$startpage;$i<=$endpage;$i++) { ?>
                                 <?php if($i==$page) { ?>
                                <li><a href="xiangqing.php?page=<?php echo $i;?>" class="pageone"><?php echo $i;?></a></li>
                                 <?php } else { ?>
                                <li><a href="xiangqing.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
                                 <?php } ?>
                            <?php }?>
<!--	    			<li class="pageone">1</li>	-->
<!--	    			<li>2</li>	
	    			<li>3</li>-->
                            <?php if($page <$countpage) { ?>
	    			<li>
                                    <a href="xiangqing.php?page=<?php echo $page+1;?>&search=<?php echo $search;?>">></a>
                                </li>
                            <?php }?>
	    		</ul>
                    <?php }?>
	    	</div>
	    </div>

                             
                             
                             
                             
                             
           	   	    <div class="right_bottom">
           	   	    	<form class="form">
                                    <textarea class="textarea"  name="text" id="textarea" onmousedown="s(event,this)"><?php if($text!=null){ echo "{$text}";} else{ echo "";};?>
           	   	    		</textarea>
           	   	    		<br />
                                        <input type="button" value="评论" name="pinglun" class="tijiao" id="comment"/>
           	   	    	</form>
           	   	    </div>
           	   </div>
           </div>
           
          
           <!--底部--> 
	        <div id="index_footer">
	        	<div class="wrapper wrapper-996 clearbox">
	        		<div class="column">
	        			<a href="javascript:;" class="title">花瓣首页</a>
	        			<a href="javascript:;">花瓣采集工具</a>
	        			<a href="javascript:;">花瓣官方博客</a>
	        		</div>
	        		<div class="column">
	        			<a href="javascript:;" class="title">练习与合作</a>
	        			<a href="javascript:;">联系我们</a>
	        			<a href="javascript:;">用户反馈</a>
	        			<a href="javascript:;">花瓣LOGO标准文档</a>
	        		</div>
	        		<div class="column">
	        			<a href="javascript:;" class="title">移动客户端</a>
	        			<a href="javascript:;">花瓣iPhone版</a>
	        			<a href="javascript:;">花瓣Android</a>
	        			<a href="javascript:;">花瓣HD</a>
	        		</div>
	        		<div class="column follow-us">
	        			<a href="javascript:;">关注我们</a>
	        			<a href="javascript:;">新浪微博：@花瓣网</a>
	        			<a href="javascript:;">官方QQ:
	        				<span class="qiyu chat">2552698596</span>
	        			</a>
	        			<a href="javascript:;" class="weixin">官方微信:
	        			</a>
	        			<img src="images/erweimatwo.png"  class="code" id="code"/>
	        		</div>
	        	</div> 
	        </div>
        
        
	 <!--登陆-->
           <div class="denglu" id="entry2">
           	  <div class="contenttwo">
           	  	<img src="images/logo_2x.png" class="logo" width="106" height="36"/>
           	  	<!--中部内容-->
           	  	<div class="nav">
           	  		<div id="text">第三方登陆</div>
           	  		<div id="imgs">
           	  			<img src="images/images/ananan.png"  class="imgs"/>
           	  		</div>
           	  		<div id="mima">使用账号密码登录</div>
                                        <div id="formone">
	           	  			<input type="text" placeholder="输入花瓣网账号" name="name" class="zhanghao"/>
	           	  			<br>
                                                <input type="password" placeholder="输入密码" placeholder="输入密码" name="pwd" class="mima"/>
	           	  			<br>
	           	  			<input type="submit" value="登录" name="denglu" class="denglu2" id="login_login"/>
	           	  			<br />
                                        </div>
           	  		<div id="bottom">
           	  			<a href="javascript:;">忘记密码>></a>
                                        <span>还没有账号？<a href="javascript:;" onclick="f5()">点击注册>></a></span>
           	  		</div>
           	  		<div id="close" onclick="f2()">
           	  			<i>X</i>
           	  		</div>
           	  	</div>
           	  </div>
           </div>
           
         <!--注册-->
           <div class="zhuce" id="entry3">
           	  <div class="contentthree">
           	  	<img src="images/logo_2x.png" class="logo" width="106" height="36"/>
           	  	<!--中部内容-->
           	  	<div class="nav">
           	  		<div id="mima">使用用户名注册</div>
                                <!--<form action="" method="post" id="zhucece">-->
                                <div  id="form">
	           	  			<input type="text" placeholder="字母开头字母数字结合6-11位" name="name" class="zhanghao"/>
	           	  			<br>
                                                <input type="password" placeholder="字母数字下划线组合8-15位" class="pwd" name="pwd"/>
	           	  			<br>
                                                <input type="text" placeholder="请输入验证码" class="yanzheng" name="yanzheng"/>
                                                <img src="php/yzm.php" id="src"/>
                                                <!--<a href="javascript:;" id="click">换一张</a>-->
	           	  			<br />
	           	  			<input type="submit" value="注册" name="zhuce" class="denglu2" id="regesiter"/>
	           	  			<br />
	           	  		<!--</form>-->
                                        </div>
           	  		<div id="closetwo" onclick="f4()">
           	  			<i>X</i>
           	  		</div>
           	  	</div>
           	  </div>
           </div>
        
        
	
	</body>
</html>
<script type="text/javascript">
    
//    /*验证码
 document.getElementById("src").onclick = function(){
        document.getElementById("src").setAttribute("src","php/yzm.php?"+Math.random());
    }
//    判断是否可以收藏
<?php if($user ==null) {?>
$("#like").click(function(){
   swal({ 
        title: "请先登录！！", 
        text: "", 
        allowOutsideClick:true,
      });
      setTimeout(function(){
          $("body").click();
          $("#entry2").css("display","block");
      },2000);
});
//评论
$("#comment").click(function(){
    swal({ 
        title: "请先登录！！", 
        text: "", 
        allowOutsideClick:true,
      });
      setTimeout(function(){
          $("body").click();
          $("#entry2").css("display","block");
      },2000);
    
});
<?php }else {?>
  //判断是否已经收藏（不可从夫收藏）
    var isLike =true;
//    执行收藏
     $("#like").click(function(){
    var uid = <?php echo $_COOKIE["user_id"];?>;
    var iid = <?php echo $id;?>;
//    开始收藏
    
            if(isLike){
            $.ajax({
                type:"post",
                url:"like.php",
                data:{uid:uid,iid:iid},
                    success:function(data){
        //                data = $.parseJSON(data);
                        if(data.status ==1){
                            $("#entry2").css("display","block");
                        }
                        else if(data.status ==2){
                            swal(data.msg,"","error");
                        }
                        else{
                            swal("收藏成功","","success")
                            $("#like").css("background","rgba(0,0,0,.3");
                            isLike =false;
                        }
                    }      
                })
            }
        })  
    
    
    
    //发表判断
        $("#comment").click(function(){
        var uid = <?php echo $_COOKIE["user_id"];?>;
        var iid = <?php echo $id;?>;
        var textarea = $("#textarea").val();
        if(textarea =="")
        {
            swal("请输入评论内容！","","error");
        }
        else{
               $.ajax({
               type:"post",
               url:"comment.php",
               data:{uid:uid,iid:iid,textarea:textarea},
                   success:function(data){
       //                data = $.parseJSON(data);
                       if(data.status ==1){
                           $("#entry2").css("display","block");
                       }
                       else if(data.status ==2){
                           swal(data.msg,"","error");
                       }
                       else{
                           history.go(0);
                       }
                   }      
               })
        }    
});
<?php }?>
    
    
</script>