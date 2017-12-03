
<?php
	require_once("conf.php");
class  Mysql_do
{
private $mysql_server_name=MYSQL_SERVER; //改成自己的mysql数据库服务器
private $mysql_username=MYSQL_USERNAME; //改成自己的mysql数据库用户名
private $mysql_password=MYSQL_PASSWORD; //改成自己的mysql数据库密码 
private $mysql_database=MYSQL_DATAUSE; //改成自己的mysql数据库名
private $conn=null;


function __construct() 
{
  $this->conn=mysql_connect($this->mysql_server_name,$this->mysql_username,$this->mysql_password) or die("数据库连接出错，具体信息:".mysql_error()) ; //连接数据库
  
  
  
}

function SetSQL($sql)
{
 

	if($sql=='')
	echo "SQL命令不能为空！";
	else
	{
    mysql_query("set names 'utf8'"); //数据库输出编码 应该与你的数据库编码保持一致.
    mysql_select_db($this->mysql_database,$this->conn)or die("数据库选择出错，具体信息:".mysql_error()) ; ; //打开数据库
	$return=mysql_query($sql,$this->conn);
    if(!$return) 
    echo "SQL语句执行出错！<br/> SQL语句:".$sql."<br/>具体信息".mysql_error();
    return $return;
    }
    
}

}
?>