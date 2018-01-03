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