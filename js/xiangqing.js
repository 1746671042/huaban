function s(e,a)
{ 
    var text = $("#textarea").val();          
	 if ( e && e.preventDefault )
         { e.preventDefault();
             text="请输入评论内容！";
       }
	else
	window.event.returnValue=false;
    {
		a.focus();
         text=" ";
     } 
	
    
}

window.location.href='xiangqing.php?text=' + text;
