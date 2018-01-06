<?php
require_once("System_RunStateCheck.php");         //系统运行状态检测
if(COS_SERVER=="COS")
$FIEL_URL=COS_URL;
if(COS_SERVER=="SERVER")
$FIEL_URL=SERVER_URL;
session_start();
if(isset($_GET['Run'])&&$_GET['Run']!='Login')
{
	if(!isset($_SESSION['username']))
{
	{$echo='<script language="javascript">{  alert("请先登录！");  window.location.href="Index.php";} </script>';echo $echo;}
}
else{
	$timenow=strtotime(Get_Time());
    $time_session= strtotime(date('Y-m-d H:i:s',strtotime($_SESSION['timeactive'])+5400)) ;
    if($timenow>=$time_session)
	{$echo='<script language="javascript">{  alert("登录过期！请重新登录！");  window.location.href="Index.php";} </script>';echo $echo;}
	else
	{
		$_SESSION['timeactive']=Get_Time();
	}
}

}

?>