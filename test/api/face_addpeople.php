<!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>寰智博客--人脸识别系统--新增个人信息</title>

  <!-- Set render engine for 360 browser -->
  <meta name="renderer" content="webkit">

  <!-- No Baidu Siteapp-->
  <meta http-equiv="Cache-Control" content="no-siteapp"/>

  <link rel="icon" type="image/png" href="assets/i/logo_72X72.png">

  <!-- Add to homescreen for Chrome on Android -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="icon" sizes="192x192" href="assets/i/logo_72X72.png">

  <!-- Add to homescreen for Safari on iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
  <link rel="apple-touch-icon-precomposed" href="assets/i/logo_72X72.png">

  <!-- Tile icon for Win8 (144x144 + tile color) -->
  <meta name="msapplication-TileImage" content="assets/i/logo_72X72.png">
  <meta name="msapplication-TileColor" content="#0e90d2">

  <link rel="stylesheet" href="assets/css/amazeui.min.css">
  <link rel="stylesheet" href="assets/css/app.css">
  	<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
    <?php
require_once "jssdk.php";
$jssdk = new JSSDK("wx575e17e5f5a47565", "546cc87edcba87c4e36bc1f813b18af9");
$signPackage = $jssdk->GetSignPackage();
?>
   	
  	<script>
  /*
   * 注意：
   * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
   * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
   * 3. 常见问题及完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
   *
   * 开发中遇到问题详见文档“附录5-常见错误及解决办法”解决，如仍未能解决可通过以下渠道反馈：
   * 邮箱地址：weixin-open@qq.com
   * 邮件主题：【微信JS-SDK反馈】具体问题
   * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
   */
  
      wx.config({
    
	debug: false,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList : [ 'checkJsApi', 'chooseImage' ]  
      // 所有要调用的 API 都要加到这个列表中
    
  });
  
  wx.ready(function ()
   {
   wx.checkJsApi({  
            jsApiList : ['scanQRCode'],  
            success : function(res) {  }  
  });
  
  wx.chooseImage({

    count: 1, // 默认9

    sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有

    sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有

    success: function (res) {

        var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片

    }

});
        
        
		
	 });
</script>
</head>
<body >
	<div id="web_bg" style="position:absolute; width:100%; height:100%; z-index:-1"> 
    <img style="position:fixed;" src="http://oss.tencent.szhcloud.cn/src/backgroud_01.jpg" height="100%" width="100%" /> 
    </div>
   
<div id="web_content" align="center">
	<p>寰智博客--人脸识别系统</p>
	<form name="PeopleInformation" action="PostRun.php"  method="post">
    <table align="center" border="1" width="300">
	<tr><td align="right">姓名</td><td align="left"><input name="name"  type="text" size="20" /> </td></tr>
	<tr><td align="right">性别</td><td align="left"><input name="sex"  type="radio"  id="radio_sex" value="男"/> 男&nbsp;&nbsp;&nbsp;&nbsp;<input name="sex" type="radio"  id="radio_sex" value="女"/>女</td></tr>
	<tr><td align="right">年龄</td><td align="left"><input name="old"  type="text" size="20" /> </td></tr>
	<tr><td align="right">照片</td><td align="left"><input name="pic"  type="file" size="20" /></td></tr>
	<tr><td colspan="2">告知：本系统所收集的数据仅供后台工程师优化算法采用，后期可能会对接入课堂点名功能中，我们承诺对于所收集的个人信息将严格保密，为了保证算法的合理性和准确性，请务必准确填写个人信息。【相关信息一经录入，均不可更改】<br/>受光照，算法精度等诸多条件影响，人脸识别得出的数据不能保证绝对精准。</td></tr>
	<tr><td align="center" colspan="2"><input name="confirm"  type="checkbox" onclick="agree();" id="radio_confirm"/>我已阅读以上告示，同意收集信息并保证相关信息准确。</td</tr>
	<tr><td align="center" colspan="2">  <input type="submit"  name="submit" value="提交" disabled="disabled" id="button_submit" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset"  name="reset"  value="重置" /></td</tr>
  </table></form>
</div>
  
   <?php
  	require_once __DIR__ . '/Tencent_pic/index.php';
    use QcloudImage\CIClient; 
  	?>

<!--在这里编写你的代码-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="assets/js/select_check.js"></script>
<script src="assets/js/jquery-3.2.1.min.js"></script>

<!--<![endif]-->
<!--[if lte IE 8 ]>
<script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->
<script src="assets/js/amazeui.min.js"></script>
</body>
</html>
