<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php 

require_once("System_RunStateCheck.php");         //系统运行状态检测
if(COS_SERVER=="COS")
$FIEL_URL=COS_URL;
if(COS_SERVER=="SERVER")
$FIEL_URL=SERVER_URL;
if(!is_file("../Safe_Check.php"))
{
	$echo='<script language="javascript">{ window.location.href="../../Echo_Error.php?error=1007";} </script>';echo $echo;
}

if($_POST['log']=='')
{$echo='<script language="javascript">{ window.location.href="../../Echo_Error.php?error=1004";} </script>';echo $echo;}
if ($_POST['pwd']=='')
{$echo='<script language="javascript">{ window.location.href="../../Echo_Error.php?error=1004";} </script>';echo $echo;}

$username=htmlspecialchars($_POST['log']);
$password=htmlspecialchars($_POST['pwd']);

$sql="select * from user_teacher where username ='".$username."'";
$data_get=new Mysql_get($sql);
$row=$data_get->Get_Result();

if(md5($password)==$row['password'])
{
	session_start();
	$_SESSION['username']=$username;
	$_SESSION['name']=$row['name'];
	$_SESSION['sex']=$row['sex'];
	$_SESSION['ip']=Get_Client_Ip();
	$_SESSION['time']=Get_Time();
	$_SESSION['timeactive']=$_SESSION['time'];
	$sql=sprintf("insert into login_teacher (username,ip,logintime,pass_state) values('%s','%s','%s','Success')",$username,Get_Client_Ip(),Get_Time());
    $data_get=new Mysql_get($sql);
	$echo='<script language="javascript">{ window.location.href="Index_Run.php";} </script>';echo $echo;
}
else
{
	$sql=sprintf("insert into login_teacher (username,ip,logintime,pass_state,pass_wrong) values('%s','%s','%s','Fail','%s')",$username,Get_Client_Ip(),Get_Time(),$password);
    $data_get=new Mysql_get($sql);
	$echo='<script language="javascript">{ window.location.href="../../Echo_Error.php?error=2004";} </script>';echo $echo;
   
}
	


?>