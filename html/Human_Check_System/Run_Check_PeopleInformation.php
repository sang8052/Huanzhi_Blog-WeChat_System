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
  $Check_Return=Check_PeopleInformation($User_Id,$Pic_Url);
 // print_r($Check_Return);
  if($Check_Return['code']=='0')
  {
  echo '识别成功!<br/>';
  $userid=$Check_Return['data']['candidates'][0]['person_id'];
   $sql="select * from userdata where userid='".$userid."'"; 
   $data_mysql=new Mysql_get($sql);
	 $row=$data_mysql->Get_Result();
	echo "姓名：".$row['username']."<br/>";
	echo "性别：".$row['sex']."<br/>";
  echo '识别精度:'.$Check_Return['data']['candidates'][0]['confidence']."%";
  }
 else
 {
 	echo "识别失败，请先添加人脸信息。如果您已经添加人脸信息，请尝试拍摄更加清晰的照片，或者重新添加人脸信息。";
 }
}

function Check_PeopleInformation($userid,$picurl)
{
	    
		 $client = new CIClient(COS_APPID,COS_SECRETID,COS_SECRETKEY, COS_NAME);
         $client->setTimeout(30);

		 $res=$client->faceIdentify('default_group', array('url'=>COS_YURL.$picurl));
		// var_dump ($res);
		  $res = json_decode($res, true);//将json转为数组格式数据
	
  return $res;
}


function Post_Data_Check()
{
    
if(!isset($_POST['userid']))
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
		$degrees=270;
		$TempFile="/www/wwwroot/tempfile/".$_FILES['pic']['name'];
        //创建图像资源，以jpeg格式为例
        $source = imagecreatefromjpeg($_FILES['pic']['tmp_name']);
        //使用imagerotate()函数按指定的角度旋转
        $rotate = imagerotate($source, $degrees, 0);
        //旋转后的图片保存
        imagejpeg($rotate,$TempFile);
   $File_Type=substr(strrchr($_FILES['pic']['name'], '.'), 1);
   $Now_Time=date('Y-m-d H:i:s');
   $Cos_Filename="/PeopleCheck/Pic_Upload/".md5($_FILES['pic']['name'].$Now_Time).".".$File_Type;
   try {
    $result = $cosClient->upload(
                 $bucket=COS_NAME,
                 $key = $Cos_Filename,
        $body=fopen($TempFile,'r+'));
       // print_r($result);
    } 
    catch (\Exception $e) {echo "$e\n"; return FALSE;}
	$result = @unlink ($TempFile); 
    
	 return $Cos_Filename;
}





?>
