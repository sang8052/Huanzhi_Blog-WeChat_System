  <meta charset="utf-8">
<?php
require_once("System_RunStateCheck.php");         //系统运行状态检测
require_once ("../../sdk/image-php/index.php");         //加载腾讯图片识别SDK
require_once('../../sdk/cos-php/cos-autoloader.php');   //加载腾讯COS系统SDK
use QcloudImage\CIClient;

//脚本开始



if(Post_Data_Check())  
{

  $User_Id=$_POST['userid'];
  $User_Name=$_POST['name'];
  $User_Sex=$_POST['sex'];
  $Pic_Url=UploadPic();
  $Check_Return=Check_PeopleInformation($User_Id,$Pic_Url);
 // print_r($Check_Return);
  if($Check_Return['code']=='0'&&$Check_Return['data']['candidates'][0]['confidence']>=COS_CONFIDENCE)   //检查识别是否成功，是否满足识别精度限定。
  {
     echo '识别成功!<br/>';
     $userid=$Check_Return['data']['candidates'][0]['person_id'];   //输出的是返回的数据中精度最高的一组数据。
     $sql="select * from userdata where userid='".$userid."'"; 
     $data_mysql=new Mysql_get($sql);
     $row=$data_mysql->Get_Result();
	 echo "姓名：".$row['username']."<br/>";
	 echo "性别：".$row['sex']."<br/>";
     echo '识别精度:'.$Check_Return['data']['candidates'][0]['confidence']."%";
  }
 else
  {
 	$echo='<script language="javascript">{ window.location.href="../../Echo_Error.php?error=3001";} </script>';
//	echo $echo;
  }
}



//脚本结束


//脚本函数定义

function Check_PeopleInformation($userid,$picurl) //调用腾讯人脸识别JDK
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




?>
