<?php
if(!is_file("../Safe_Check.php"))
{
	$echo='<script language="javascript">{ window.location.href="../../Echo_Error.php?error=1007";} </script>';echo $echo;
}
?>
<?php
$i=$_SESSION['File_Bag'][0];
$File_Bag=$_SESSION['File_Bag'][$i];
if ($_FILES["File_Upload"]["error"] > 0)
{
   $echo='<script language="javascript">{ window.location.href="../../Echo_Error.php?error=3004";} </script>';echo $echo;
}
else
	{
		  $Filename=$_FILES['File_Upload']['name'];
  $Filesize=($_FILES['File_Upload']['size']/1024)."KB";
  $TempFile=$_FILES['File_Upload']['tmp_name'];
  print_r($$_FILES);
  $time=Get_Time();
  
  $sql=sprintf("select *from file_share where username='%s' and filename='%s' and uplocal='%s'",$_SESSION['username'],$Filename,$File_Bag);
   $data_get=new Mysql_get($sql);
   $row=$data_get->Get_Result(); 
   $row_num=$data_get->GetRowNum();
   if($row_num!=0){	$echo='<script language="javascript">{ window.location.href="../../Echo_Error.php?error=3003";} </script>';echo $echo;}
   else{
   $sql=sprintf("insert into file_share (username,filename,uplocal,ossurl,type,time,size) values('%s','%s','%s','%s','file','%s','%s')",$_SESSION['username'],$Filename,$File_Bag, $Cos_FileUrl,$time,$Filesize);
   $data_get=new Mysql_get($sql);
   $sql=sprintf("select *from file_share where username='%s' and filename='%s' and uplocal='%s'",$_SESSION['username'],$Filename,$File_Bag);
   $data_get=new Mysql_get($sql);
   $row=$data_get->Get_Result(); 
   $id=$row['id'];
   
   $Cos_Filename="File_Share/".$id."-".$Filename ;
   
   
   $cosClient = new Qcloud\Cos\Client(array('region' =>COS_REGION,
    'credentials'=> array(
        'appId' => COS_APPID,
        'secretId'    => COS_SECRETID,
        'secretKey' => COS_SECRETKEY))); 
   try {
    $result = $cosClient->upload(
                 $bucket=COS_NAME,
                 $key = $Cos_Filename,
        $body=fopen($TempFile,'r+'));
       // print_r($result);
    } 
    catch (\Exception $e) {echo "$e\n"; return FALSE;}
	$result = @unlink ($TempFile); 
     $Cos_FileUrl=COS_YURL.$Cos_Filename;
	 $sql=sprintf("update file_share set ossurl='%s' where id='%s'",$Cos_FileUrl,$id);
   $data_get=new Mysql_get($sql);
	    
		   {$echo='<script language="javascript">{  alert("文件上传成功！");  window.location.href="Index_Run.php?Run=Cloud_File&Action=Show&File_Bag='.$File_Bag.'";} </script>';echo $echo;}
	
   }
	}

 

?>