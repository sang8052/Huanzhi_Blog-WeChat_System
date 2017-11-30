<?php 
require("../../conf.php");
if(COS_SERVER=="COS")
$FIEL_URL=COS_URL;
if(COS_SERVER=="SERVER")
$FIEL_URL=SERVER_URL;
?>
<!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>寰智博客--人脸识别系统</title>

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
</head>
<body>
    <audio src="<?php echo $FIEL_URL?>music/Akie-sentinel_class.mp3" autoplay="autoplay" loop="-1">WARNING:声音播放出错！</audio>
	<div id="web_bg" style="position:absolute; width:100%; height:100%; z-index:-1"> 
    <img style="position:fixed;" src="<?php echo $FIEL_URL?>img/backgroud_01.jpg" height="100%" width="100%" /> 
    </div>
    <div id="web_content" >
    	<table align="center"  width="90%" height="90%" border="0">
        <caption align="top"> <p style="color:red; font-size: larger; text-align: center;">系统简介</p></caption> 
        <tr align="top"><td>
        <p style="color: #F5F5F5; font-size: small;"> 寰智人脸识别系统是基于腾讯的人脸识别（Facial Recognition）系统，结合寰智微信的实际情况，
                所编译的一套图形识别系统。利用本系统，可以实现在一定条件下的身份效验功能。</p>
        <p style="color: #F5F5F5; font-size: small;"> 目前，此系统还在开发实践阶段，您可以访问<a href="https://cloud.tencent.com/act/event/ci_demo.html">腾讯云（qcloud）关于智能AI部分的技术文档及页面</a>，来
               了解更多本系统所可能采用的技术指标。</p>
        <p style="color: #F5F5F5; font-size: small;">更多功能敬请期待...</p>
        <p style="color: #F5F5F5; font-size: small;" align="right">2017.12.1</p>
        <p style="color: #F5F5F5; font-size: small;" align="right">MR_SZH</p>
        </td></tr></table>
   </div>


<!--在这里编写你的代码-->

<!--[if (gte IE 9)|!(IE)]><!-->
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