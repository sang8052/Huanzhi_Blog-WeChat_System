<?php 
require_once("Login_Check.php"); 

?>
<!-- 网页头部 开始-->
<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>教师管理后台</title>
  <meta name="description" content="教师管理后台">
  <meta name="keywords" content="index">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="icon" type="image/png" href="<?php echo $FIEL_URL?>img/logo_72X72.png">
  <link rel="stylesheet" href="<?php echo $FIEL_URL?>assets/css/amazeui.min.css"/>
  <link rel="stylesheet" href="<?php echo $FIEL_URL?>assets/css/admin.css">
  </head>
  <body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，本站使用的Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->
<!-- 网页头部 结束-->
<?php 
    require_once("html/Html_Header.php"); //加载顶部功能栏
	echo '<div class="am-cf admin-main">';
	require_once("html/Html_SideBar.php");//加载侧边栏
    if(!isset($_GET['Run']))  require_once("html/Html_Index.php"); //加载主页面（默认主页）
    
    
    else if ($_GET['Run']=='Login')   //执行登录操作
	{
		require_once("user/Run_Login.php");
	} 
	
    else if ($_GET['Run']=='Login_Data')   //显示登录日志
	{
		require_once("user/Html_Login_Data.php");
	} 
	
	else if ($_GET['Run']=='User_Data')   //显示个人信息
	{
		if(isset($_GET['post']))
		{
			if($_GET['post']=='pass')
			require_once("user/Pass_Reset.php");
			if($_GET['post']=='data')
			require_once("user/Data_Reset.php");
		}
		else
		require_once("user/Html_User_Data.php");
	} 
	
	else if($_GET['Run']=='Cloud_File')  //显示资源共享界面
	{
		if(isset($_GET['Action'])&&($_GET['Action']=='Show'||$_GET['Action']=='Show-'||$_GET['Action']=='New'||$_GET['Action']=='Search'))
		{
			if($_GET['Action']!='New')
			{
			 require_once("cloud/Cloud_File_Table_Show.php");
			}
           else 
		   	{
		   		
		   		require_once("cloud/Cloud_File_Bag_New.php");
		   	}
			
		}
		else
		require_once("html/Html_404.php");
		
	}
   
    else if($_GET['Run']=='Cloud_File_Upload')
    {
    	require_once("cloud/Cloud_File_Upload.php");
    }
    
	else if($_GET['Run']=='Cloud_File_Del')
    {
    	require_once("cloud/Cloud_File_Del.php");
    }
    
    else if($_GET['Run']=='Mail_Write')
    {
    	require_once("mail/Html_Mail_Write.php");
    }
    
    else if($_GET['Run']=='Mail_Write_Fun')
    {
    	require_once("mail/Mail_Write.php");
    }
    
    else if($_GET['Run']=='Mail_Send'||$_GET['Run']=='Mail_Get'||$_GET['Run']=='Mail_New')
    {
    	require_once("mail/Mail_List.php");
    }
    
  
    
    else if($_GET['Run']=='Mail_Show')
    {
    	   	require_once("mail/Mail_Show.php");
    }
	
	else if($_GET['Run']=='Mail_Del_Sen89'||$_GET['Run']=='Mail_Del_Get')
    {
    	   	require_once("mail/Mail_Del.php");
    }
	
	else if ($_GET['Run']=='Login_Out')   //退出登录
	{
		session_destroy();
		$echo='<script language="javascript">{ alert("您已经成功注销登陆！"); window.location.href="Form_Login.php";} </script>';echo $echo;
	} 
	
	else 
		{
			require_once("html/Html_404.php");
		}
	
	
	
	
	
	
	
	
	require_once("html/Html_CopyRight.php"); //加载版权页脚
    echo '</div><!-- 页面内容结束 --></div>';
    require_once("html/Html_End.php"); //加载网页尾部


?>
