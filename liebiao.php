<?php
$con = mysqli_connect("localhost", "root", "111444le", "huaban");
if(!$con){
    echo "连接失败！！";die();
}
mysqli_set_charset($con, "utf8");
/*--------------------判断是否登陆-------------------*/
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

/* -----------------获取分类--------------*/
$sql  = "select * from classify limit 0,6";
$result = mysqli_query($con, $sql);
$classList = array();
if($result){
    while($row = mysqli_fetch_array($result)){
        $classList[]=$row;
    }
}


/*----------------获取首页分类的id-----------------*/
$id =isset($_GET["id"])?$_GET["id"]:1;
$sql = "select * from classify where id={$id}";
$result = mysqli_query($con, $sql);
$classInfo = array();
if($result){
    $classInfo = mysqli_fetch_assoc($result);
}

/*-------------------分类内容-------------------------*/
$sql = "select * from image where cid={$classInfo["id"]}";
$result = mysqli_query($con, $sql);
$imageList = array();
if($result){
    while ($row = mysqli_fetch_assoc($result)){
       $imageList[] = $row;   
    }
}








/*-------------------------------------------------查询------------------------------------------------------*/
$search = isset($_GET["search"])?$_GET["search"]:"";
//分页
$page =isset($_GET["page"])?$_GET["page"]:1;  ///当前页数

$num =6;   //每页显示的条数

$start =($page-1) * $num;   //0




/*-------------------------------------------总页数 ----------------------*/
$sql1 = "select count(*) as c from image where name like '%{$search}%'";
$result = mysqli_query($con, $sql1);
$count=0;
if($result){
    $row = mysqli_fetch_assoc($result);
    $count=$row["c"];
}
$countpage= ceil($count/$num);
/*-------------------------------------------总页数 ----------------------*/

/*-------------------------------------------每页数据 ----------------------*/
//$sql ="select * from image where name like '%{$search}%' limit {$start},{$num} ";
//$result = mysqli_query($con, $sql);
//$list =array();
//if($result!=false){
//    while ($row = mysqli_fetch_assoc($result)){
//        $list[]=$row;
//    }
//}
/*-------------------------------------------每页数据 ----------------------*/
$num =6;   //每页显示的条数
$start =($page-1) * $num;   //0
$sql ="select * from image where cid={$id} limit {$start},{$num} ";
$result = mysqli_query($con, $sql);
$listtwo =array();
if($result!=false){
    while ($row = mysqli_fetch_assoc($result)){
        $list[]=$row;
    }
}




?>



<!DOCTYPE html>
<html>
    <head>
        <title>list花瓣网_陪你做生活的设计师(发现、采集你喜欢的灵感、家具、穿搭、婚礼、美食、旅行、美图、商品等)</title>
        <meta charset="UTF-8">
	    <link rel="shortcut icon" type="image/x-icon" sizes="any" href="images/images/favicon.ico">
        <link type="text/css" rel="stylesheet" href="css/liebiao.css" />
        <link type="text/css" rel="stylesheet" href="css/common.css" />
       <script type="text/javascript" src="js/jquery-1.12.3.min.js"></script>
        <link type="text/css" rel="stylesheet" href="css/sweet-alert.css"/>
        <script type="text/javascript" src="js/sweet-alert.min.js"></script>
        <script type="text/javascript" src="js/common.js"></script>
        
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
		                	
		                	<a href="javascript:;" target="_blank" class="header-item meisu">
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
                                                        <?php if($userinfo["H_portrait"] == "") {?>
                                                        <img src="images/images/kong.png" />
                                                        <?php }else {?>
                                                        <img src="<?php echo $userinfo["H_portrait"]; ?>"/>
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
		                		<input id="query" size="27" name="search" placeholder="搜索你喜欢de" />
		                		<a href="javascript:;" class="go" id="gototwo" onclick="f7()"></a>
		                	</form>
					</div>
				</div>
					<div class="lie_imgs">
						<div class="lie_text_nav">
							<div class="text_nav_two clearbox">
                                                        <?php if($classInfo !=null) {?>
                                                            <p class="lie_imgs_top">
                                                                <?php echo $classInfo["name"];?>
                                                            </p>
                                                            <br />
                                                            <p class="lie_imgs_body">
                                                                <?php echo $classInfo["brief"];?>
                                                            </p>
                                                            <br />
                                                        <?php }?>
							<div class="lie_imgs_div">
							<p class="lie_imgs_bottom">Ta们已关注</p>
							</div>
							<br />
                                                        <?php 
                                                        $sql = "select * from image where id={$classInfo["id"]} order by id desc limit 0,4";
                                                        $result = mysqli_query($con, $sql);
                                                        $user =array();
                                                        if($result){
                                                            $user = mysqli_fetch_assoc($result);
                                                        }
                                                        ?>
                                                        
							<div class="lie_imgs_img clearbox">
                                                        <?php foreach ($list as $k=>$v) {?>
                                                        <p><img src="<?php echo $v["url"];?>"/></p>  
                                                        <?php }?>
<!--							<p><img src="images/body19.jpg"/></p>
							<p><img src="images/body19.jpg"/></p>
							<p><img src="images/body19.jpg"/></p>
							<p><img src="images/body19.jpg"/></p>
							<p><img src="images/body19.jpg"/></p>-->
							</div>
                                                        
							</div>
						</div>
					</div>
				</div>
                                
                                
                                
                                
         <div class="wrapper-996 wrapper">
	        	<!--增加-->
	           <div class="info">
	           	<div class="content">
	           		<ul class="clearbox">
                                    <?php foreach($classList as $ck=>$cv){ ?>
	           			<li >
                                            <a href="liebiao.php?id=<?php echo $cv["id"];?>&search=<?php echo $cv["name"]; ?>"><?php echo $cv["name"];?></a>
                                                <img src="<?php echo $cv["image"];?>" />
	           			</li>
                                    
                                    <?php } ?>
	           		</ul>
	           	</div>
	           </div>

<!--         身体 
   
		        <!--中心-->
                    
		        <div class="net clearbox">
                            
                            <?php foreach($list as $k=>$v) { ?>
                            <a href="xiangqing.php?id=<?php echo $v["id"];?>"/>
		        	<div class="one">
		        		<img src="<?php echo $v["url"]; ?>"/>
		        		<div class="mingcheng"><?php echo $v["name"];?></div>
                                         <?php 
                                            $sql = "select * from user where id={$v["uid"]}";
                                            $result = mysqli_query($con, $sql);
                                            $user =array();
                                            if($result){
                                                $user = mysqli_fetch_assoc($result);
                                            }
                                         ?>
		        		<div class="navtwo">
		        			<img src="<?php echo $user["H_portrait"];?>" />
		        			<span class="fff">来自</span>
                                                <span class="zuozhe">
		        				<?php echo $user["username"];?>
                                                </span>
		        			<span class="fff">收藏</span>
		        			<br />
		        			<p class="date"><?php echo date("Y-m-d",$v["date"]);?></p>
		        		</div>
		        	</div>
                            </a>
                            <?php } ?>
                            
		        </div>  
                 
         </div>
         
<!--         分页
         <div class="page">
         	<div class="page_nav clearbox">
         		<ul>
         			<li><</li>
         			<li class="a">1</li>
         			<li>2</li>
         			<li>3</li>
         			<li>></li>
         		</ul>
         	</div>
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
                                    <a href="liebiao.php?page=<?php echo $page-1;?>&id=<?php echo $id;?>"><</a>
                                </li>
                            <?php }?>
                                
                                
                            <?php for($i =$startpage;$i<=$endpage;$i++) { ?>
                                 <?php if($i==$page) { ?>
                                <li><a href="liebiao.php?page=<?php echo $i;?>&id=<?php echo $id;?>" class="pageone"><?php echo $i;?></a></li>
                                 <?php } else { ?>
                                <li><a href="liebiao.php?page=<?php echo $i;?>&id=<?php echo $id;?>"><?php echo $i;?></a></li>
                                 <?php } ?>
                            <?php }?>
<!--	    			<li class="pageone">1</li>	-->
<!--	    			<li>2</li>	
	    			<li>3</li>-->
                            <?php if($page <$countpage) { ?>
	    			<li>
                                    <a href="liebiao.php?page=<?php echo $page+1;?>&id=<?php echo $id;?>">></a>
                                </li>
                            <?php }?>
	    		</ul>
                    <?php }?>
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
<script>
 document.getElementById("src").onclick = function(){
        document.getElementById("src").setAttribute("src","php/yzm.php?"+Math.random());
    }
</script>