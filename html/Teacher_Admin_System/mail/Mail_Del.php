 <?php
             if(isset($_GET['id']))
			 {
			 	 $sql=sprintf("select * from mail where id = '%s '",$_GET['id']);
                 $data_get=new Mysql_get($sql);
                 $row_check=$data_get->Get_Result(); 
				
				 if($row_check['get_username']==$_SESSION['username']) 
				 {
				 	
					$sql=sprintf("update mail set get_show='0' where id = '%s '",$_GET['id']);
                    $data_get=new Mysql_get($sql);
					$echo='<script language="javascript">{alert("删除成功！"); window.location.href=document.referrer; } </script>';echo $echo;
				 }
				 else if($row_check['send_username']==$_SESSION['username']) 
				 {
				 	$sql=sprintf("update mail set send_show='0' where id = '%s '",$_GET['id']);
                    $data_get=new Mysql_get($sql);
					$echo='<script language="javascript">{alert("删除成功！"); window.location.href=document.referrer; } </script>';echo $echo;
				 }
                 else  {$echo='<script language="javascript">{ window.location.href="../../Echo_Error.php?error=1006";} </script>';echo $echo;}
				
			}
			 else
			 	{
			 		{$echo='<script language="javascript">{ window.location.href="../../Echo_Error.php?error=1005";} </script>';echo $echo;}
			 	}
?>