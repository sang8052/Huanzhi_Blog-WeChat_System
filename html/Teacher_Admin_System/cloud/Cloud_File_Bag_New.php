<?php
if(!is_file("../Safe_Check.php"))
{
	$echo='<script language="javascript">{ window.location.href="../../Echo_Error.php?error=1007";} </script>';echo $echo;
}
?>
<?php
$i=$_SESSION['File_Bag'][0];
$File_Bag=$_SESSION['File_Bag'][$i];
if(isset($_GET['Bag_Name']))
{
	
	   $sql=sprintf("select * from file_share where username='%s' and uplocal ='%s' and type='bag' and filename='%s'",$_SESSION['username'],$File_Bag,$_GET['Bag_Name']);
       $data_get=new Mysql_get($sql);
       $row=$data_get->Get_Result(); 
       $row_num=$data_get->GetRowNum();
	   if($row_num==1)
	   {
	   	{$echo='<script language="javascript">{  alert("错误！已经存在同名文件夹！");  window.location.href="Index_Run.php?Run=Cloud_File&Action=Show&File_Bag='.$File_Bag.'";} </script>';echo $echo;}
	   }
	   else
	   	{
	   		$time=Get_Time();
	   		$sql=sprintf("insert into file_share (username,filename,uplocal,type,time) values('%s','%s','%s','bag','%s')",$_SESSION['username'],$_GET['Bag_Name'],$File_Bag,$time);
    
		   $data_get=new Mysql_get($sql);
		   {$echo='<script language="javascript">{  alert("新建文件夹成功！");  window.location.href="Index_Run.php?Run=Cloud_File&Action=Show&File_Bag='.$File_Bag.'";} </script>';echo $echo;}
	   	}
}

?>