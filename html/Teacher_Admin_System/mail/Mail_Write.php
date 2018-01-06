<?php

if(!is_file("../../Safe_Check.php"))
{
	$echo='<script language="javascript">{ window.location.href="../../Echo_Error.php?error=1007";} </script>';echo $echo;
}

    $send_username=$_SESSION['username'];
	$get_username=$_POST['get_username'];
	if($get_username==$send_username)
   {$echo='<script language="javascript">{ window.location.href="../../Echo_Error.php?error=3005";} </script>';echo $echo;}
	else
	{
	$title=$_POST['title'];
	$content=$_POST['content'];
	$time=Get_Time();
	$sql=sprintf("insert into mail (send_username,get_username,get_read,get_show,send_show,title,time,content) values('%s','%s','0','1','1','%s','%s','%s')",$send_username,$get_username,$title,$time,$content);
    $data_get=new Mysql_get($sql);
	
	
	/* 检索是否存在指定的接收消息的用户 */
	$sql=sprintf("select * from  user_teacher where username='%s'",$get_username);
	$data_get=new Mysql_get($sql);
	$row=$data_get->GetResult();
	$row_num=$row[0];
	if($row_num==0) $System_Mail='False';
	/* 如果不存在指定的接收消息的用户，返回False，如果存在，返回True*/
	
	if($System_Mail=='False')
	{   
	    if($_SESSION['sex']=='男')$sex='先生';else $sex='女士';
	    $content_r=sprintf("尊敬的&nbsp;%s&nbsp;%s,您好，您于&nbsp;%s&nbsp;发送给&nbsp;%s&nbsp;，主题为&nbsp;%s&nbsp;的邮件因为无法找到对应的收信人，因此已经被退回。该邮件的内容如下:<br/>%s",$_SESSION['name'],$sex,$time,$get_username,$title,$content);
		$title='系统退信';
		$sql=sprintf("insert into mail (send_username,get_username,get_read,get_show,send_show,title,time,content) values('运维团队','%s','0','1','1','%s','%s','%s')",$send_username,$title,$time,$content_r);
        $data_get=new Mysql_get($sql);
	}
	
	$echo='<script language="javascript">{ alert("消息发送成功！");window.location.href="Index_Run.php?Run=Mail_Send";} </script>';echo $echo;
    
	}
	
   

	
?>