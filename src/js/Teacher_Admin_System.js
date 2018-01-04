window.onload = function() {

            if (window.applicationCache) //检查浏览器是否支持HTML5技术
            {
                try{
                        if (/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent)) //检查是否使用了安卓、IOS、等设备
                        {window.location.href="../../Echo_Error.php?error=1003"; }
                       
                    }
                catch(e){}
               
            } 
            else
            {
             window.location.href="../../Echo_Error.php?error=1003"; 
            }

        }

function New_File_Bag()
 {
 	var reg=new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\s]*$" );
 	var bag= prompt("请输入文件夹名称，只能使用英文字母、数字、下划线和中文,且文件夹名称不能为Home");
 	if (reg.test(bag))
 	{
 		if(bag=="Home")
 		{
 			alert ("文件夹名称不能为Home");
 		}
 		else {window.location.href="Index_Run.php?Run=Cloud_File&Action=New&Bag_Name="+bag;}
 	}
 	else
 	{
 		alert ("文件夹名称只能使用英文字母、数字、下划线和中文!");
 	}
 	
 	return true;
 }

 function Pass_Relcheck() {
                var reg=new RegExp('(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[^a-zA-Z0-9]).{8,16}'); 
                var New_Pass=document.getElementById("New_Pass").value; 
                var New_Pass_check=document.getElementById("New_Pass_check").value;
                if(!reg.test(New_Pass)){
                	alert("新密码中必须包含字母、数字、特称字符，长度在8-16位之间!"); 
                    return false; }
                if (New_Pass_check != New_Pass||New_Pass_check==0) 
                { 
              alert("两次密码输入不一致"); return false; 
                 } 
              return true; 
               } 
 

window.onload = function() {

            if (window.applicationCache) //检查浏览器是否支持HTML5技术
            {
                try{
                        if (/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent)) //检查是否使用了安卓、IOS、等设备
                        {window.location.href="../../Echo_Error.php?error=1003"; }
                       
                    }
                catch(e){}
               
            } 
            else
            {
             window.location.href="../../Echo_Error.php?error=1003"; 
            }

        }
                 
function URL_SHOW(url)
{
	alert("下载地址:"+url);
}

function Mail_Write_Reset()
{
	alert("重置成功！");
	window.location.href="Index_Run.php?Run=Mail_Write";
}

function Mail_check()
{
	
	 var get_username=document.getElementById("get_username").value;
	 var title=document.getElementById("title").value;
	 
	 get_username=get_username.replace(/(^\s*)|(\s*$)/g, '');//去除空格;
	 title=title.replace(/(^\s*)|(\s*$)/g, '');//去除空格;
	
	 if ( get_username== '' ||  get_username == undefined ||  get_username== null) 
	 {alert("请输入消息收件人！"); return false;}
	 else 
	 { if(title== '' ||  title == undefined ||  title== null)
	   {alert("请输入消息主题！"); return false;}
	   else return true;
	  }
	
	
}
