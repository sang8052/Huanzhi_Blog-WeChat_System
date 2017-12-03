<?php 
require_once("System_RunStateCheck.php");               //系统运行状态检测
require_once ("../../sdk/image-php/index.php");         //加载腾讯图片识别SDK
require_once('../../sdk/cos-php/cos-autoloader.php');   //加载腾讯COS系统SDK
use QcloudImage\CIClient;
if(COS_SERVER=="COS")
$FIEL_URL=COS_URL;
if(COS_SERVER=="SERVER")
$FIEL_URL=SERVER_URL;

if(!isset($_GET['userid'])||$_GET['userid']==''||$_GET['userid']==NULL)
{
	$echo='<script language="javascript">{ window.location.href="../../Echo_Error.php?error=1001";} </script>';
	echo $echo;

}

?>
<!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>寰智人脸识别系统_识别人脸</title>

  <!-- Set render engine for 360 browser -->
  <meta name="renderer" content="webkit">

  <!-- No Baidu Siteapp-->
  <meta http-equiv="Cache-Control" content="no-siteapp"/>

  <link rel="icon" type="image/png" href="<?php echo $FIEL_URL?>img/logo_72X72.png">

  <!-- Add to homescreen for Chrome on Android -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="icon" sizes="192x192" href="<?php echo $FIEL_URL?>img/logo_72X72.png">

  <!-- Add to homescreen for Safari on iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
  <link rel="apple-touch-icon-precomposed" href="<?php echo $FIEL_URL?>img/logo_72X72.png">

  <!-- Tile icon for Win8 (144x144 + tile color) -->
  <meta name="msapplication-TileImage" content="<?php echo $FIEL_URL?>img/logo_72X72.png">
  <meta name="msapplication-TileColor" content="#0e90d2">

  <link rel="stylesheet" href="<?php echo $FIEL_URL?>assets/css/amazeui.min.css">
  <link rel="stylesheet" href="<?php echo $FIEL_URL?>assets/css/app.css">
  <style type="text/css">
  *#web_content{color: #F5F5F5; font-size:medium;}
  </style>
     <script src="<?php echo $FIEL_URL?>js/exif_min.js"></script>
</head>
<body>
   
	<div id="web_bg" style="position:absolute; width:100%; height:100%; z-index:-1"> 
    <img style="position:fixed;" src="<?php echo $FIEL_URL?>img/backgroud_01.jpg" height="100%" width="100%" /> 
    </div>
    <div id="web_content" >
    	<table align="center"  width="90%" height="90%" border="0">
    		 <caption align="top"> <p style="color:red; font-size: larger; text-align: center;">人脸识别</p></caption> 
     <tr><td>
	<form name="PeopleInformation" action="Run_Check_PeopleInformation.php"  method="post" enctype="multipart/form-data">
    <table align="center" border="0" width="300">
	<tr><td align="left">
		 <div class="am-input-group"><span class="am-input-group-label"><i class="am-icon-file am-icon-fw"></i></span><input name="pic" form="noupdata" id="picupload" type="file"  class="am-form-field  am-round "size="10" /></div>
		</td></tr>
    <tr><td align="center"><img src="" id="picview"></td></tr>
	<tr><td >告知：受光照，算法精度等诸多条件影响，人脸识别得出的数据不能保证绝对精准。</td></tr>
	<tr><td align="center" ><input name="confirm"  type="checkbox" onclick="agree();" id="radio_confirm"/>我已阅读以上告示，同意收集信息并保证相关信息准确。</td</tr>
	<tr><td align="center" > <button type="submit"  name="submit" class="am-btn am-btn-success am-round am-btn-sm"  disabled="disabled" id="button_submit"  />提交</button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="reset"  name="reset" class="am-btn am-btn-warning am-round am-btn-sm"  id="button_reset"  />重置</buttonn></td</tr>
  <input name="userid" type="hidden" value="<?php echo $_GET['userid']?>" />
    <input name="picdata" type="hidden" id="picdata" value="" />
    <input name="picname" type="hidden" id="picname" value="" />
  </table></form>
        </td></tr></table>
   </div>


<!--在这里编写你的代码-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="<?php echo $FIEL_URL?>js/ImageUpload.js"></script>
<script src="<?php echo $FIEL_URL?>js/select_check.js"></script>
<script src="<?php echo $FIEL_URL?>assets/js/jquery-3.2.1.min.js"></script>
<!--<![endif]-->
<!--[if lte IE 8 ]>
<script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->
<script src="<?php echo $FIEL_URL?>assets/js/amazeui.min.js"></script>
</body>
</html>