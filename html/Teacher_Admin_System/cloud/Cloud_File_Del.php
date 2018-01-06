<?php
if(!is_file("../../Safe_Check.php"))
{
	$echo='<script language="javascript">{ window.location.href="../../Echo_Error.php?error=1007";} </script>';echo $echo;
}
?>
<?php
if(isset($_GET['id']))
{
   $sql=sprintf("select * from file_share where id='%s'",$_GET['id']);
   $data_get=new Mysql_get($sql);
   $row=$data_get->Get_Result(); 
   if($_SESSION['username']!=$row['username'])
   {
   	$echo='<script language="javascript">{ window.location.href="../../Echo_Error.php?error=3002";} </script>';echo $echo;
   }
   else
   	{
   		$del[0]=1;
		$del[1]=$row;
   		if($row['type']=='bag')
		{
			
			 $bag=Get_Del_ListBag($row);
		  
			for($q=1;$q<=$bag[0];$q++)
			{
			 
			  $sql=sprintf("select * from file_share where username='%s' and uplocal='%s'",$_SESSION['username'],$bag[$q]);
              $data_get=new Mysql_get($sql);
              $row=$data_get->GetResult(); 
			  
			  $j=$del[0];$del[0]=$del[0]+$row[0];
			  for($i=1;$i<=$row[0];$i++)
		    	{
				$k=$j+$i;
				$del[$k]=$row[$i];
			    }
			}
		}
		for($i=0;$i<=$del[0];$i++)
		{
		  if($del[$i]['type']=='file')
		   {
		   	$cos_filename="File_Share/".$del[$i]['id']."-".$del[$i]['filename'];
		    $cosClient = new Qcloud\Cos\Client(array('region' =>COS_REGION,
            'credentials'=> array(
            'appId' => COS_APPID,
            'secretId'    => COS_SECRETID,
            'secretKey' => COS_SECRETKEY))); 
		   try {
            $result = $cosClient->deleteObject(array(
            'Bucket' => COS_NAME,
            'Key' => $cos_filename));
			
             //print_r($result);
            } catch (\Exception $e) {
            echo "$e\n";
            }
            
		   }
		       $sql=sprintf("delete from file_share where id='%s'",$del[$i]['id']);
              $data_get=new Mysql_get($sql);   
		
		}
		   $echo='<script language="javascript">{  alert("文件删除成功！");  window.location.href="Index_Run.php?Run=Cloud_File&Action=Show";} </script>';echo $echo;
		  
		
		
			
		
	}
}
?>