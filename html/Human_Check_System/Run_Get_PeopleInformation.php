  <meta charset="utf-8">
<?php
require('../../sdk/cos-php/cos-autoloader.php');
require("../../conf.php");
require_once("../../SQL_get.php");
require_once ("../../sdk/image-php/index.php");
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
	$TempFile="/www/wwwroot/tempfile/".$_FILES['pic']['name'];
    $POST['pic']=$_FILES['pic']['tmp_name'];
	copy($POST['pic'], $TempFile);
	$exif = exif_read_data($TempFile);
	if($exif['Orientation']==8)
	$degrees=90;
	if($exif['Orientation']==3)
	$degrees=180;
	if($exif['Orientation']==6)
	$degrees=270;
    //创建图像资源，以jpeg格式为例
    $source = imagecreatefromjpeg($TempFile);
    //使用imagerotate()函数按指定的角度旋转
    $rotate = imagerotate($source, $degrees, 0);
    //旋转后的图片保存
    imagejpeg($rotate,$TempFile);
   $File_Type=substr(strrchr($_FILES['pic']['name'], '.'), 1);
   $Now_Time=date('Y-m-d H:i:s');
   $Cos_Filename="/PeopleInformation/Pic_Upload/".md5($_FILES['pic']['name'].$Now_Time).".".$File_Type;
   try {
    $result = $cosClient->upload(
                 $bucket=COS_NAME,
                 $key = $Cos_Filename,
        $body=fopen($TempFile,'r+'));
       // print_r($result);
    } 
    catch (\Exception $e) {echo "$e\n"; return FALSE;}
	$result = @unlink ($TempFile); 
     $Cos_FileUrl=$Cos_Filename."?imageMogr2/auto-orient";
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
