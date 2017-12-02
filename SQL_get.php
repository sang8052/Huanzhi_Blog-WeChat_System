<?php
require_once("SQL_do.php");
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
    return $row;
   }
   function Get_Result()
   {
   	
   	$row = mysql_fetch_array($this->result);
     
     
    
    return $row;
   }
}


?>