<?php
if(isset($_POST['New_Pass'])&&isset($_POST['Old_Pass']))
{
	$sql="select * from user_teacher where username ='".$_SESSION['username']."'";
    $data_get=new Mysql_get($sql);
    $row=$data_get->Get_Result();

    if(md5($_POST['Old_Pass'])==$row['password'])
  {
	$sql=sprintf("update user_teacher set password='%s' where username ='%s'",md5($_POST['New_Pass']),$_SESSION['username']);
    $data_get=new Mysql_get($sql);
	session_destroy();
    $echo='<script language="javascript">{ alert("修改密码成功！请重新登录！"); window.location.href="From_Login.php";} </script>';echo $echo;
  }
	else
	{
		
		$echo='<script language="javascript">{ alert("原密码不正确！"); window.location.href="Index_Run.php?Run=User_Data";} </script>';echo $echo;
	}
}
?>
