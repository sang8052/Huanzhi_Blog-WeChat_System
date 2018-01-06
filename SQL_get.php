<?php

require_once("SQL_do.php");
$sql="select * from sysinfo where keyword='Wechat_Server'";
$system_information=new Mysql_get($sql);
$row=$system_information->Get_Result();

define(VERSION_SYSTEML,$row['version']);
$sql="select * from sysinfo where keyword='Control_Server'";
$row['version']=$system_information->Get_Result();
define(VERSION_CONTROL,$row['version']);
$sql="select * from sysinfo where keyword='Database_Server'";
$row['version']=$system_information->Get_Result();
define(VERSION_DATA,$row['version']);
$sql="select * from sysinfo where keyword='FaceCheck_Server'";
$row['version']=$system_information->Get_Result();
define(VERSION_FACECHECK,$row['version']);
Class Mysql_get

{

	private $result=null;

	function __construct($sql) 

   {

	$Mysql_RES=new Mysql_do();

    $this->result=$Mysql_RES->SetSQL($sql);

   }

   function GetRowNum()

   {

   	 $num=mysql_num_rows($this->result);

   	 return $num;

   }

   

   function GetResult()

   {

   	$i=1;

   	while($row[$i] = mysql_fetch_array($this->result))

     {

     	$i++;

    }
    $row[0]=$i-1;
    return $row;

   }

   function Get_Result()

   {

   	

   	$row = mysql_fetch_array($this->result);

       return $row;

   }

}





?>