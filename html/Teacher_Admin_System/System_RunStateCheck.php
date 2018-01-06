<?php

require_once("../../conf.php");

require_once("../../SQL_get.php");

require_once("../../Function.php");

require_once('../../sdk/cos-php/cos-autoloader.php');   //加载腾讯COS系统SDK


//此文件用来检验系统状态判断系统是否能够继续执行

$sql="select * from sysinfo where keyword ='Teacher_Admin_Server'";

$data_get=new Mysql_get($sql);

$row=$data_get->Get_Result();

if($row['bool']=='false')

{

	$echo='<script language="javascript">{ window.location.href="../../Echo_Error.php?error=4001&TextReturn='.$row['content'].'";} </script>';

	echo $echo;

}
else 
{
$SYSTEM['VERSION']=$row['version'];		
$SYSTEM['BUILD']=$row['build'];		
}



?>