<?php 
require_once("System_RunStateCheck.php");         //系统运行状态检测
if(COS_SERVER=="COS")
$FIEL_URL=COS_URL;
if(COS_SERVER=="SERVER")
$FIEL_URL=SERVER_URL;
?>
<!DOCTYPE html>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>教师管理后台 &lsaquo; 登录</title>
<link rel='dns-prefetch' href='//s.w.org' />
<link rel='stylesheet' href='https://www.szhcloud.cn/newblog/wp-admin/load-styles.php?c=0&amp;dir=ltr&amp;load%5B%5D=dashicons,buttons,forms,l10n,login&amp;ver=4.8.4' type='text/css' media='all' />
<link rel="stylesheet" type="text/css" href="https://www.szhcloud.cn/newblog/wp-content/themes/presence-master/css/login.css" />
<!-- Set render engine for 360 browser -->
<meta name="renderer" content="webkit">
<!-- No Baidu Siteapp-->
<meta http-equiv="Cache-Control" content="no-siteapp"/>
<link rel="icon" type="image/png" href="<?php echo $FIEL_URL?>img/logo_72X72.png">

<link rel="stylesheet" href="<?php echo $FIEL_URL?>assets/css/amazeui.min.css">
<link rel="stylesheet" href="<?php echo $FIEL_URL?>assets/css/app.css">
<script type="text/javascript" src="https://www.szhcloud.cn/newblog/wp-content/themes/presence-master/js/jquery.min.js"></script>
<meta name='robots' content='noindex,follow' />
<meta name="viewport" content="width=device-width" />
</head>
	<body class="login login-action-login wp-core-ui  locale-zh-cn">
		<div id="login">
		<h1>教师管理后台</h1>
	
<form name="loginform" id="loginform" action="Run_Login.php" method="post">
	<p>
		<label for="user_login">用户名<br />
		<input type="text" name="log" id="user_login" class="input" value="" size="20" /></label>
	</p>
	<p>
		<label for="user_pass">密码<br />
		<input type="password" name="pwd" id="user_pass" class="input" value="" size="20" /></label>
	</p>
		<p class="forgetmenot"><label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever"  /> 记住我的登录信息</label></p>
	<p class="submit">
		<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="登录" />
		<input type="hidden" name="redirect_to" value="https://www.szhcloud.cn/newblog/wp-admin/" />
		<input type="hidden" name="testcookie" value="1" />
	</p>
</form>

<p id="nav">
	<a href="#">忘记密码？</a>
</p>

<script type="text/javascript">
function wp_attempt_focus(){
setTimeout( function(){ try{
d = document.getElementById('user_login');
d.focus();
d.select();
} catch(e){}
}, 200);
}

/**
 * Filters whether to print the call to `wp_attempt_focus()` on the login screen.
 *
 * @since 4.8.0
 *
 * @param bool $print Whether to print the function call. Default true.
 */
wp_attempt_focus();
if(typeof wpOnload=='function')wpOnload();
</script>

	<p id="backtoblog"><a href="https://cn.wordpress.org/">&larr; 登陆界面 &nbsp; Power By WordPress</a></p>
	
	</div>

	
	<div class="footer">
   <p class="am-padding-left">Copyright &copy; 2017 szhcloud.cn <a href="https://www.szhcloud.cn/newblog/" target="_blank">寰智博客 </a>All Rights | Author by <a href="https://github.com/sang8052/Huanzhi_Blog-WeChat_System" target="_blank">sang8052</a></p>
     </div>
<script type="text/javascript" src="https://www.szhcloud.cn/newblog/wp-content/themes/presence-master/js/resizeBg.js"></script>
<script type="text/javascript">
jQuery("body").prepend("<div class=\"loading\"><img src=\"https://www.szhcloud.cn/newblog/wp-content/themes/presence-master/images/login_loading.gif\" width=\"58\" height=\"10\"></div><div id=\"bg\"><img /></div>");
jQuery('#bg').children('img').attr('src', '<?php echo $FIEL_URL?>img/login_bg_01.JPG').load(function(){
	resizeImage('bg');
	jQuery(window).bind("resize", function() { resizeImage('bg'); });
	jQuery('.loading').fadeOut();
});</script>
	<div class="clear"></div>
<!--[if (gte IE 9)|!(IE)]><!-->
<script src="<?php echo $FIEL_URL?>js/Teacher_Admin_System.js"></script>
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


