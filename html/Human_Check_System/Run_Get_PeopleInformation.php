  <meta charset="utf-8">
<?php
require_once("System_RunStateCheck.php");         //系统运行状态检测
require_once ("../../sdk/image-php/index.php");         //加载腾讯图片识别SDK
require_once('../../sdk/cos-php/cos-autoloader.php');   //加载腾讯COS系统SDK
use QcloudImage\CIClient;


if(Post_Data_Check())
{

  $User_Id=$_POST['userid'];
  $User_Name=$_POST['name'];
  $User_Sex=$_POST['sex'];
 
  $Pic_Url=UploadPic();
  $Pic_Count=CheckPeopleInformation($User_Id,$User_Name);

  if($Pic_Count==0){UserData_SetPeopleInformation($User_Id,$User_Name,$User_Sex,$Pic_Url);}
  else{UserData_AddPeopleInformation($User_Id,$Pic_Url, $Pic_Count);}
  $echo='<script language="javascript">{ alert("新增人脸信息成功！");window.location.href="System_introduction.php?userid='.$User_Id.'";} </script>';
   echo $echo;
  
}

function CheckPeopleInformation($userid,$username)
{
	     $sql="select * from userdata where username='".$username."'";
         $data_mysql=new Mysql_get($sql);
		 $ans_num=$num=$data_mysql->GetRowNum();
         if($ans_num!=0)
		 {
		 	 $row=$data_mysql->Get_Result();
		    if($userid!=$row['userid'])
		    {
		    $echo='<script language="javascript">{ window.location.href="../../Echo_Error.php?error=2002";} </script>';
	        echo $echo;
			exit;
		    }
		 }
	     $sql="select * from userdata where userid='".$userid."'"; 
    	 $data_mysql=new Mysql_get($sql);
		 $row=$data_mysql->Get_Result();
         if($row['username']!=''&&$row['username']!=$username)
		{
			$echo='<script language="javascript">{ window.location.href="../../Echo_Error.php?error=2001";} </script>';
	        echo $echo;
			exit;
		}
		if($row['piccount']==20)
		{
			$echo='<script language="javascript">{ window.location.href="../../Echo_Error.php?error=2003";} </script>';
	        echo $echo;
			exit;
		}
        return $row['piccount'];	
}


function Post_Data_Check()
{
    if(!isset($_POST['name']))
    {
	echo "操作出错！数据流1异常！";
	return FALSE;
    }
	else if(!isset($_POST['sex']))
    {
	echo "操作出错！数据流2异常！";
	return FALSE;
    }
	else if(!isset($_POST['userid']))
	{
	echo "操作出错！数据流3异常！";
	return FALSE;
	}
	else if(!isset($_POST['picdata']))
	{
	echo "操作出错！数据流4异常！";
	return FALSE;
	}
	else if(!isset($_POST['picname']))
	{
	echo "操作出错！数据流5异常！";
	return FALSE;
	}
	else
		return TRUE;
		
}

function UploadPic()
{
	$cosClient = new Qcloud\Cos\Client(array('region' =>COS_REGION,
    'credentials'=> array(
        'appId' => COS_APPID,
        'secretId'    => COS_SECRETID,
        'secretKey' => COS_SECRETKEY))); 
	$pic['data']=$_POST['picdata'];	
preg_match('/^(data:\s*image\/(\w+);base64,)/', $pic['data'], $pic['file']);
$pic['type'] = $pic['file'][2];    //获取图片的类型jpg png等
$pic['name'] = $_POST['picname'];//图片重命名
$savepath = "/www/wwwroot/tempfile/".$pic['name'];   //图片保存目录
$TempFile=$savepath; 
file_put_contents($savepath, base64_decode(str_replace( $pic['file'], '', $pic['data'])));   //对图片进行解析并保存
  
   $Now_Time=date('Y-m-d H:i:s');
   $Cos_Filename="/PeopleInformation/Pic_Upload/".md5($pic['name'].$Now_Time).".".$pic['type'] ;
   try {
    $result = $cosClient->upload(
                 $bucket=COS_NAME,
                 $key = $Cos_Filename,
        $body=fopen($TempFile,'r+'));
       // print_r($result);
    } 
    catch (\Exception $e) {echo "$e\n"; return FALSE;}
	$result = @unlink ($TempFile); 
     $Cos_FileUrl=$Cos_Filename;
	 return $Cos_FileUrl;
}


function UserData_SetPeopleInformation($userid,$username,$usersex,$picurl)
{
	     $sql="update userdata set username='".$username."' , sex='".$usersex."', piccount='1' where userid='".$userid."'";
    	 $sql_mysql=new Mysql_do();
    	 $sql_mysql->SetSQL($sql);
		 $sql="insert userpic (userid,picurl) value('".$userid."','".COS_YURL.$picurl."')";
    	 $sql_mysql=new Mysql_do();
    	 $sql_mysql->SetSQL($sql);
		 $client = new CIClient(COS_APPID,COS_SECRETID,COS_SECRETKEY, COS_NAME);
         $client->setTimeout(30);
		 $res=$client->faceNewPerson($userid, array('default_group',), array('url'=>COS_YURL.$picurl),$username);
		 //var_dump ($res);
}

function UserData_AddPeopleInformation($userid,$picurl,$piccount)
{
	    $piccount++;
	    $sql="update userdata set  piccount='".$piccount."' where userid='".$userid."'";
    	 $sql_mysql=new Mysql_do();
    	 $sql_mysql->SetSQL($sql);
		 $sql="insert userpic (userid,picurl) value('".$userid."','".COS_YURL.$picurl."')";
    	 $sql_mysql=new Mysql_do();
    	 $sql_mysql->SetSQL($sql);
		 $client = new CIClient(COS_APPID,COS_SECRETID,COS_SECRETKEY, COS_NAME);
         $client->setTimeout(30);
		 $client->faceAddFace($userid, array('urls'=>array(COS_YURL.$picurl)));
		 //var_dump ($res);
    	 
}


?>
