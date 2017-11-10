
var denglu = document.getElementById("entry");
function f1(){
        document.getElementById("entry2").style.display = "block";
}
var close = document.getElementById("close");
function f2(){
        
        document.getElementById("entry2").style.display = "none";
}
//注册
var zhuce= document.getElementById("register");
function f3(){
    document.getElementById("entry3").style.display = "block";
        
}
var close = document.getElementById("closetwo");
function f4(){
        document.getElementById("entry3").style.display = "none";
}
 var close = document.getElementById("login_tiao");
function  f5(){
    document.getElementById("entry2").style.display = "none";
    document.getElementById("entry3").style.display = "block";
}
                        
                        
//                        $("#src").click(function(){
//                            $("#src").attr("src","php/yzm.php?".(math.random()));
//                        })

////搜索框跳转
//var go = document.getElementById("goto");
//function f6(){
//    var text = $("#query").val();
//    if(text ==""){
//    swal("请输入搜索内容！","","error");
//    }else{
//    window.location.href="search.php?search="+text;
//    }
//}     



 
 
//}
//刷新验证码
// document.getElementById("src").onclick = function(){
//        document.getElementById("src").setAttribute("src","php/yzm.php?"+Math.random());
//    }


////下拉后搜索框跳转
//var gotwo = document.getElementById("gototwo");
//function f7(){
//    var text = $("#query").val();
//    var texttop = $("#query").val();
//    if(text ==""){
//    swal("请输入搜索内容！","","error");
//    }else{
//    window.location.href="search.php?search="+text;
//    }
//}
 

window.onload=function(){
   //注册添加事件
                  $("#regesiter").click(function(){
                      //2获取数据
                      var name = $("#form>input[name=name]").val();
                      var pwd = $("#form>input[name=pwd]").val();
                      var yzm= $("#form>input[name=yanzheng]").val();
                      if(name==""|| pwd==""||yzm==""){
                          swal("信息填写不完整","","error");
                          return;
                      }
                      else{
                          //提交后台
                          $.ajax({
                              type:"get",
                              url:"http://localhost/php/zuoye/huaban/regesiter.php",
                              data:{name:name,pwd:pwd,yzm:yzm},  //提交参数；json数据串
                              success:function(data){
                               data = $.parseJSON(data);
                                  if(data.status == 0){
          //                            alert(data.msg);
                                       swal(data.msg,"","error");
                                  }
                                  else{
                                      swal({
                                            title:"注册成功!",
                                            text:"恭喜",
                                            imageUrl:"images/thumbs-up.jpg"
                                        });
                                      history.go(0);//刷新当前页面
                                  }
                              }    
                          })
                      }
          }) 


                     //登录添加事件
                  $("#login_login").click(function(){
                      //2获取数据
                      var name = $("#formone>input[name=name]").val();
                      var pwd = $("#formone>input[name=pwd]").val();
                      if(name==""|| pwd==""){
                        swal("用户名或密码不能为空","","error");
                          return;
                      }
                      else{
                          //提交后台
                          $.ajax({
                              type:"get",
                              url:"http://localhost/php/zuoye/huaban/login.php",
                              data:{name:name,pwd:pwd},  //提交参数；json数据串
                              success:function(data){
                               data = $.parseJSON(data);
                                  if(data.status == 1){
          //                            alert(data.msg);
                                        swal({
                                            title:"登陆成功!",
                                            text:"恭喜",
                                            imageUrl:"images/thumbs-up.jpg"
                                        });
                                        history.go(0);//刷新当前页面 
                                        
                                  }
                                  else{
                                      swal(data.msg,"","error");
                                  }
                              }    
                          })
                      }
          }       
          )
  
  
  
  
  
  var f8 = function(){
    var texttop = $("#query").val();
        if(texttop ==""){
        swal("请输入搜索内容！","","error");
        }else{
       
        window.location.href="search.php?search="+texttop;
        
        }
    }; 
  $(".go").click(function(){
            f8();
        })
        
  }