  <meta charset="utf-8">
<?php
if(isset($_GET['error']))
{
	if($_GET['error']=='1001')
	echo "错误：获取用户id信息失败，请返回微信公众号寰智博客，输入\"添加人脸信息 \"后点击返回的连接重新进入系统。";
	if($_GET['error']=='1002')
	echo "错误：用户id信息授权出错，请不要复制微信浏览器中的网址并用其它浏览器打开！";
	if($_GET['error']=='2001')
	echo "错误：您的微信账号已经绑定了用户信息，且该用户姓名与您尝试录入的人脸信息的姓名不相同！";
	if($_GET['error']=='2002')
	echo "错误：该姓名已经绑定了微信账号！！";
	if($_GET['error']=='2003')
	echo "错误：该姓名下面的人脸信息已经达到最大值（20个）！";
	if($_GET['error']=='3001')
	echo "识别失败，请先添加人脸信息。如果您已经添加人脸信息，请尝试拍摄更加清晰的照片，或者重新添加人脸信息。";
    if($_GET['error']=='4001')
	{echo $_GET['TextReturn'];}
}

?>