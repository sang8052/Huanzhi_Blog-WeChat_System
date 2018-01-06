<?php

if(!is_file("../Safe_Check.php"))
{
	$echo='<script language="javascript">{ window.location.href="../../Echo_Error.php?error=1007";} </script>';echo $echo;
}

if(isset($_POST['lesson'])&&isset($_POST['signs']))
{
	$sql=sprintf("update user_teacher set lesson='%s', signs ='%s' where username ='%s'",$_POST['lesson'],$_POST['signs'],$_SESSION['username']);
$data_get=new Mysql_get($sql);
$echo='<script language="javascript">{ alert("修改个人资料成功！"); window.location.href="Index_Run.php?Run=User_Data";} </script>';echo $echo;
}
?>