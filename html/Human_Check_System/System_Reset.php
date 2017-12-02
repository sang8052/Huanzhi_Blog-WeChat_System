  <meta charset="utf-8">
<?php

//系统重置脚本：警告，访问此脚本将清空人脸识别系统的所有数据，请谨慎使用
//系统重置保护手动开关
define(SYSTEM_RESET,'FALSE');
//define(SYSTEM_RESET,'TRUE');
require('../../sdk/cos-php/cos-autoloader.php');
require("../../conf.php");
require_once("../../SQL_get.php");
require_once ("../../sdk/image-php/index.php");
use QcloudImage\CIClient;

if(SYSTEM_RESET=='FALSE')
{
	echo "Warning：系统重置保护启用中！请使用FTP访问网站目录下的 /html/Human_Check_System/System_Reset.php 文件。<br/>";
	echo "将第6行代码 \"//define(SYSTEM_RESET,'FALSE');\" 最前面的\"//\"删除。<br/> ";
	echo "在第6行代码 \"define(SYSTEM_RESET,'TRUE');\" 最前面的添加\"//\"<br/> ";
}

else
{
	$sql="select * from userdata "; 
    $data_mysql=new Mysql_get($sql);
	$num=$data_mysql->GetRowNum();
	$num--;
    $row=$data_mysql->GetResult();
	$client = new CIClient(COS_APPID,COS_SECRETID,COS_SECRETKEY, COS_NAME);
    $client->setTimeout(30);
	for($i=0;$i<=$num;$i++)
	{
		if($row[$i]['username']!=''||$row[$i]['username']!=NULL)
		{
			$client->faceDelPerson($row[$i]['userid']);
		}
	}
	echo "人脸识别终端初始化成功！<br/>";
	$sql="update userdata set username='', sex='' ,piccount=''";
	$sql_mysql=new Mysql_do();
    $sql_mysql->SetSQL($sql);
	echo "用户信息数据库初始化成功！<br/>";
	$sql="delete from userpic";
	$sql_mysql=new Mysql_do();
    $sql_mysql->SetSQL($sql);
	echo "图片数据库初始化成功！<br/>";
	
}
?>