<?php
$con = mysqli_connect("localhost", "root", "111444le", "huaban");
if(!$con){
    echo "连接失败！！";die();
}
mysqli_set_charset($con, "utf8");
/* -----------------获取分类--------------*/
$sql  = "select * from classify";
$result = mysqli_query($con, $sql);
$classList = array();
if($result){
    while($row = mysqli_fetch_array($result)){
        $classList[]=$row;
    }
}
//为您推荐
$sql = "select * from image order by `like` desc limit 0,3";
$result = mysqli_query($con, $sql);
$recommendList = array();
if($result){
    while ($row = mysqli_fetch_assoc($result)){
        $recommendList[]=$row;
    }
}
//原创插画
$sql = "select * from image order by look desc limit 0,4";
$result  = mysqli_query($con, $sql);
$recommendLook = array();
if($result){
    while ($row = mysqli_fetch_assoc($result)){
        $recommendLook[]= $row;
    }
}

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


?>



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
        <div id="page" class="page-min-width" style="display: block">
            <!--头部-->
            <div class="head-box">
            	<!--背景-->
            	<div class="banner-background" id="bannertop" style="background-image: url(images/images/banner1.jpg); opacity: 1; background-position: center 0px;"></div>
            	<div class="mask"></div>
            	<div class="new-banner">
            		<div class="title"></div>
            		<div class="search-box">
            			<form method="get" action="" class="new-searching-unit" data-regestered="regestered">
                                    <input id="querytop" type="text" size="27" name="search" autocomplete="off" placeholder="搜索你喜欢的" value=""> 
                                    <a href="javascript:;" class="go" id="goto"  title="点击搜索"></a>
            			</form>
            			<div class="search-hint" id="input1"></div>
            		    <div class="hot-words">
            		    	<span>热门搜索:</span>
            		    	<a href="javascript:;">排版</a>
            		    	<span>,</span>
            		    	<a href="javascript:;">海报设计</a>
            		    	<span>,</span>
            		    	<a href="javascript:;">花瓣LIVE</a>
            		    	<span>,</span>
            		    	<a href="javascript:;">配色</a>
            		    	<span>,</span>
            		    	<a href="javascript:;">壁纸那些事</a>
            		    	
            		    </div>
            		</div>
            		<div class="author">
            			<div class="wrapper wrapper-996">
            				<span>图片：</span>
            				<a href="JavaScript:;" rel="nofollow">乐乐</a>
            			</div>
            		</div>
            	</div>
                <!--条-->
                <div id="top_promotion" style="display: block;">
                	<a href="javascript:;" rel="nofollow" class="inner">
                		<img src="images/top_two.jpg" id="top_two"/>
                	</a>
                </div>
                <!--导航-->
                <!--1-->
                <div id="header" class="hts nologin-index" style="left: 0px;">
                	<div class="wrapper wrapper-996">
                		<div class="menu-bar">
                			<div class="left-part">
                				<a id="huaban" href="index.php"></a>
                                                <a href="index.php" data-title="home" class="header-item active" id="top">首页</a>
                				<a href="javascript:;" class="header-item" id="top">发现</a>
                				<a href="javascript:;"class="header-item" id="top">最新</a>
                				<a href="javascript:;" class="header-item" rel="nofollow" id="top">活动</a>
                				<a class="header-item cut-off" id="top"></a>
                				<a href="javascript:;" target="_blank" class="header-item meisi" >美思</a>
                				<a href="javascript:;" target="_blank" class="header-item meisu">
                					美素
                					<i class="entrance"></i>
                				</a>
                                                
                				<a href="javascript:;" target="_blank" class="header-item live">花瓣LIve</a>
                				<div class="menu-nav">
                				
                				</div>
                			</div>
                                    
                			<div class="right-part">
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
                				<input id="query" size="27" name="search" placeholder="搜索你喜欢的" />
                                                <a href="search.php" class="go" title="点击搜索"></a>
                			</form>
                			<div class="search-hint"></div>
                		</div>
                	</div>
                </div>
                
               
                <!--2-->
                <div class="header" id="header2" style="display: none;">
					<div class="nav_two clearbox">
						<div class="header_nav_left header_nav_lefttwo">
							<a id="huaban" href="index.php"></a>
		                	<a href="javascript:;" data-title="home" class="header-item active" id="top">首页</a>
		                	<a href="javascript:;" class="header-item" id="top">发现</a>
		                	<a href="javascript:;"class="header-item" id="top">最新</a>
		                	<a href="javascript:;" target="_blank" class="header-item meisi" >美思 
		                		<span class="entrancetwo">
		                		</span>
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
                                                    <a href="index.php" class="body_logo" id="header_nav_right_logo">
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
                                                                        <a href="liebiao.php">我的收藏</a>
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
		                		<input id="query" size="27" name="search" placeholder="搜索你喜欢的" />
                                                <a href="javascript:;" class="go" id="gototwo" title="点击搜索"></a>
		                	</form>
					</div>
				</div>
                
            </div>
           
            
            
           
           
        
           
           
           <!--身子-->
	        <div class="wrapper-996 wrapper">
	        	<!--增加-->
	           <div class="info">
	           	<div class="content">
	           		<ul class="clearbox">
                                    <?php foreach($classList as $ck=>$cv){ ?>
	           			<li >
                                            <a href="liebiao.php?id=<?php echo $cv["id"];?>&search=<?php echo $cv["name"];?>"><?php echo $cv["name"];?></a>
                                                <img src="<?php echo $cv["image"];?>" />
	           			</li>
                                    
                                    <?php } ?>
	           		</ul>
	           	</div>
	           </div>
	        <!--条-->
	        	<div class="recommend-line ">
	        		<div class="content_left"></div>
	        		<a>大家正在关注</a>
	        		<div class="content_right"></div>
	        	</div>        
	        <!--中部-->
		       <div class="category-image-box explore-category-image-box">
		        	<a href="javascript:;" target="_target" class="categroy-image explore-promotion">
		        		<img src="images/body1.jpg"  title=""/>
		        	</a>
		        	<a href="javascript:;" target="_target" class="categroy-image explore-promotion">
		        		<img src="images/body2.jpg"  title=""/>
		        	</a>
		        	<a href="javascript:;" target="_target" class="categroy-image explore-promotion">
		        		<img src="images/body3.jpg"  title=""/>
		        	</a>
		        	<a href="javascript:;" target="_target" class="categroy-image explore-promotion">
		        		<img src="images/body4.jpg"  title=""/>
		        	</a>
		        	<a href="javascript:;" target="_target" class="categroy-image explore-promotion">
		        		<img src="images/body5.jpg"  title=""/>
		        	</a>
		        </div>
	        <!--条-->
	            <div class="recommend-line">
	            	<div class="content_left"></div>
	        		<a>为您推荐</a>
	        		<div class="content_right"></div>
	        	</div>
	        <!--内容-->   
	            <div id="recommend_container" class="recommend-container">
	            	<div class="recommend-container-row clearfix">
	            		<div class="recommend-imgbox recommend-box">
                                    <a href="xiangqing.php">
<!--	            				<img src="images/body11.jpg" />-->
                                            <img src="<?php echo $recommendList[0]["url"];?>" />
	            			</a>
	            		</div>
	            		
	            		<div class="recommend-box">
	            			<div class="recommend-infobox board small">
	            				<div class="recommend-data board"></div>
	            				<h2>
	            					<a href="javascript:;"><?php echo $recommendList[0]["name"];?></a>
	            				</h2>
	            				<p>
	            					<span><?php echo $recommendList[0]["look"];?>采集</span>
	            					<span><?php echo $recommendList[0]["like"];?>粉丝</span>
	            					
	            				</p>
	            				<span>
	            					来自
	            					<a href="javascript:;"rel="nofollow"><?php echo $recommendList[0]["name"];?></a>
	            				</span>
	            				
	            			</div>
	            			<div class="info-tra-left"></div>
	            			<div class="recommend-infobox user samll pl-right">
	            				<div class="recommend-data user"></div>
	            				<h2 class="user">
	            					<a href="javascript:;"><?php echo $recommendList[1]["name"];?></a>
	            				</h2>
	            				<p>
	            					<span><?php echo $recommendList[1]["look"];?>采集</span>
	            					<span><?php echo $recommendList[1]["like"];?>粉丝</span>
	            					
	            				</p>
	            			</div>
	            			<div class="info-tra-right"></div>
	            		</div>
	            		
	            		<div class="recommend-userbox recommend-box">
	            			<a href="xiangqing.php" class="avt">
<!--	            				<img src="images/body13.jpg" />-->
                                             <img src="<?php echo $recommendList[1]["url"];?>" />
	            			</a>
	            			<a style="background: url(images/backgroundone.jpg)no-repeat;" class="avt-bg"></a>
	            		</div>
	            		<div class="recommend-hidebox pl-right">
	            			<div class="recommend-imgbox recommend-box">
	            				<a href="xiangqing.php">
<!--	            					<img src="images/body14.jpg" />-->
                                                    <img src="<?php echo $recommendList[2]["url"];?>" />
	            				</a>
	            			</div>
	            			<div class="recommend-infobox board recommend-box big">
	            				<div class="recommend-data board"></div>
	            				<h2>
	            					<a href="javascript:;"><?php echo $recommendList[2]["name"] ?></a>
	            				</h2>
	            				<p>
	            					<span><?php echo $recommendList[2]["look"];?>采集</span>
	            					<span><?php echo $recommendList[2]["like"];?>粉丝</span>
	            					
	            				</p>
	            				<span>
	            					来自
	            					<a href="javascript:;" rel="nofollow" >蝴蝶fdfe</a>
	            				</span>
	            				<div class="info-tra-left big"></div>
	            			</div>
	            		</div>
	            	</div>
	            </div>
	            <hr />
                    
                    
                    
                    <!--条-->
	            <div class="recommend-line">
	            	<div class="content_left"></div>
	        		<a>原创插画</a>
	        		<div class="content_right"></div>
	        	</div>
	        <!--内容-->   
	            <div id="recommend_container" class="recommend-container">
	            	<div class="recommend-container-row clearfix">
	            		
	            		
	            		        <div class="recommend-box">
	            			<div class="recommend-infobox board small">
	            				
	            				<h2>
	            					<a href="xiangqing.php"><?php echo $recommendLook[0]["name"];?></a>
	            				</h2>
	            				<p>
	            					<span><?php echo $recommendLook[0]["look"];?>观看</span>
	
	            				</p>
	            				
	            				
	            			</div>
	            			<div class="info-tra-left"></div>
	            			<div class="recommend-infobox user samll pl-right">
	            				
	            				<h2 class="user">
	            					<a href="javascript:;"><?php echo $recommendLook[1]["name"];?></a>
	            				</h2>
	            				<p>
	            					<span><?php echo $recommendLook[1]["look"];?>观看</span>	
	            				</p>
	            			</div>
	            			<div class="info-tra-right"></div>
	            		</div>
	            		
	            		<div class="recommend-imgbox recommend-box">
	            			<a href="xiangqing.php">
<!--	            				<img src="images/body11.jpg" />    -->
                                            <img src="<?php echo $recommendLook[0]["url"]?>" /> 
                                            
	            			</a>
	            		</div>
                                
                                <div class="recommend-hidebox pl-right">
	            			<div class="recommend-imgbox recommend-box">
	            				<a href="xiangqing.php">
<!--	            					<img src="images/body14.jpg" />-->
                                                    <img src="<?php echo $recommendLook[3]["url"];?>" />
	            				</a>
	            			</div>
	            			<div class="recommend-infobox board recommend-box big">
<!--	            				<div class="recommend-data board"></div>-->
	            				<h2>
	            					<a href="javascript:;"><?php echo $recommendLook[2]["name"] ?></a>
	            				</h2>
	            				<p>

	            					<span><?php echo $recommendLook[2]["look"] ?>观看</span>
	            				</p>
	            				<span>
<!--	            					来自
	            					<a href="javascript:;" rel="nofollow" ><?php echo $recommendLook[2]["name"] ?></a>-->
	            				</span>
	            				<div class="info-tra-left big"></div>
	            			</div>
	            		</div>
                            
                            
                            
                                <div class="recommend-userbox recommend-box">
                                    <a href="xiangqing.php" class="avt">
<!--	            				<img src="images/body13.jpg" />-->
                                             <img src="<?php echo $recommendLook[2]["url"];?>" />
	            			</a>
	            			<a style="background: url(images/backgroundone.jpg)no-repeat;" class="avt-bg"></a>
	            		</div>
	            		
	            	</div>
	            </div>
	            <hr /> 
                    
                    
                    
                    
                    
                    
	        <!--更多-->
	            <div class="get-more">
	            	<div class="content_left"></div>
	            	<a>加载更多</a>
	            	<div class="content_right"></div>
	            </div>
	        <!--分类-->
	            <div class="new-index-category">
	            	<div class="new-index-category-head clearfix">
	            		<div class="title">
	            			<span>以分类浏览</span>
	            		</div>
	            		<div class="all-pins">
	            			<a href="JavaScript:;">所有采集>></a>
	            		</div>
	            	</div>
	            	<div class="new-index-category-body">
	            		<ul class="new-index-category-group">
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">UI/UX</a>
	            			</li>
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">平面</a>	
	            			</li>
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">插画/漫画</a>
	            			</li>
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">家具/家装</a>
	            			</li>
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">女装/搭配</a>
	            			</li>
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">男士/风尚</a>
	            			</li>
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">婚礼</a>
	            			</li>
	            		</ul>
	            		<ul class="new-index-category-group">
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">工业设计</a>
	            			</li>
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">摄影</a>	
	            			</li>
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">造型/美女</a>
	            			</li>
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">美食</a>
	            			</li>
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">旅行</a>
	            			</li>
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">手工/布艺</a>
	            			</li>
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">健身/舞蹈</a>
	            			</li>
	            		</ul>
	            		<ul class="new-index-category-group">
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">儿童</a>
	            			</li>
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">宠物</a>	
	            			</li>
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">美图</a>
	            			</li>
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">明星</a>
	            			</li>
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">美女</a>
	            			</li>
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">礼物</a>
	            			</li>
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">极客</a>
	            			</li>
	            		</ul>
	            		<ul class="new-index-category-group">
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">动漫</a>
	            			</li>
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">建筑设计</a>	
	            			</li>
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">人文艺术</a>
	            			</li>
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">数据图</a>
	            			</li>
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">游戏</a>
	            			</li>
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">汽车/摩托</a>
	            			</li>
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">电影/图书</a>
	            			</li>
	            		</ul>
                           
                            
	            		<ul class="new-index-category-group">
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">生活百科</a>
	            			</li>
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">教育</a>	
	            			</li>
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">运动</a>
	            			</li>
	            			<li class="new-index-category-item">
	            				<a href="javascript:;">搞笑</a>
	            			</li>
	            			
	            		</ul>
	            	</div>
	            </div>
	        
	        </div>
	    
	    	
	    <!--底部--> 
	        <div id="index_footer">
	        	<div class="wrapper wrapper-996">
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
	        			<a href="javascript:;">联系客服：
	        				<span class="qiyu chat">在线客服</span>
	        			</a>
	        			<a href="javascript:;" class="weixin">官方微信:
	        			<img src="images/erweima.png" />
	        			<img src="images/erweimatwo.png"  class="code" id="code"/>
	        			</a>
	        			<a href="javascript:;">
	        				<img src="images/sm_124x47.png" />
	        			</a>
	        		</div>
	        	</div>
	            <div class="wrapper wrapper-996 bottom">
	            	© Huaban 河北软件职业技术学院
	            	<span>|</span>
	            	<a href="javascript:;">冀公安网备2343242342343号</a>
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
	           	  		<!--<form action="" method="post">-->
                                        <div id="formone">
	           	  			<input type="text" placeholder="输入花瓣网账号" name="name" class="zhanghao"/>
	           	  			<br>
                                                <input type="password" placeholder="输入密码" placeholder="输入密码" name="pwd" class="mima"/>
	           	  			<br>
	           	  			<input type="submit" value="登录" name="denglu" class="denglu2" id="login_login"/>
	           	  			<br />
	           	  		<!--</form>-->
                                        </div>
           	  		<div id="bottom">
           	  			<a href="javascript:;">忘记密码>></a>
                                        <span >还没有账号？<a href="javascript:;" id="login_tiao"  onclick="f5()">点击注册>></a></span>
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
           
        </div>
    </body>
</html>
<script>
    document.getElementById("src").onclick = function(){
        document.getElementById("src").setAttribute("src","php/yzm.php?"+Math.random());
    }
</script>