<meta charset="utf-8">
<?php
require_once("SQL_get.php");
require_once("SQL_do.php");
date_default_timezone_set('PRC'); //设置时区为中国
$SAVE=Get_Save_token();
if($SAVE!=null)
{
	$SAVE_TOKEN['access_token']=$SAVE['value'];
    $SAVE_TOKEN['timenum']=$SAVE['value2'];
	 $timenum=date('Y-m-d H:i:s', time()); 
	 $timenum=strtotime($timenum);

	 if($timenum<$SAVE_TOKEN['timenum'])
	 {
	 	$access_token=$SAVE_TOKEN['access_token'];
	 }
	 else
	 {
	 	TOKEN_Reflash();
	 }
}
else
{
	TOKEN_Reflash();
}

function TOKEN_Reflash()
{
	
	
	$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx575e17e5f5a47565&secret=546cc87edcba87c4e36bc1f813b18af9";
	$res=curl_http_request($url);
	$access_token=$res['access_token'];
	$datastr=date('Y-m-d H:i:s',strtotime('+2 hour'));
	$settimenum=strtotime($datastr);
	$sql="update SysInfo set value='".$res['access_token']."' , value2='".$settimenum."' where keyword='access_token'";
	$data_mysql=new Mysql_do();
	$data_mysql->SetSQL($sql);
	
}

function curl_http_request($url,$data = null)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FASLE);
    //如果$data不为空,则为POST请求
    if (!empty($data)){ 
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);
    if ($error){
        throw new Exception('请求发生错误：' . $error);
    }
    $resultArr = json_decode($output, true);//将json转为数组格式数据
    return $resultArr;
}

function Get_Save_token()
{
	 $sql="select * from SysInfo where keyword='access_token'";
       $data_mysql=new Mysql_get($sql);
       $ans_num=$num=$data_mysql->GetRowNum();
       if($ans_num=0) return null;
       else
       {
       	$row=$data_mysql->GetResult();
       	return $row[1];
       }
}

?>