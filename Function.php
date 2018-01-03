<?php 
function Get_Client_Ip($type = 0, $strict = false)   //获得当前客户端的ip地址

    {

    $ip = null;

    // 0 返回字段型地址(127.0.0.1)

    // 1 返回长整形地址(2130706433)

    $type = $type ? 1 : 0;

    if ($strict) {

        /* 防止IP地址伪装的严格模式 */

        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {

            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

            $pos = array_search('unknown', $arr);

            if (false !== $pos) {

                unset($arr[$pos]);

            }

            $ip = trim(current($arr));

        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {

            $ip = $_SERVER['HTTP_CLIENT_IP'];

        } elseif (isset($_SERVER['REMOTE_ADDR'])) {

            $ip = $_SERVER['REMOTE_ADDR'];

        }

    } else if (isset($_SERVER['REMOTE_ADDR'])) {

        $ip = $_SERVER['REMOTE_ADDR'];

    }
	/* IP地址合法性验证 */

    $long = sprintf("%u", ip2long($ip));

    $ip = $long ? [$ip, $long] : ['0.0.0.0', 0];

    return $ip[$type];

     }
	
	function Get_Del_ListBag($row)
	{
		$bag[1]=$row['filename'];$j=2;
		$sql=sprintf("select uplocal from file_share where username='%s'  group by uplocal",$_SESSION['username']);
        $data_get=new Mysql_get($sql);
        $row=$data_get->GetResult();
		
	$row_num=$data_get->GetRowNum();
		
		for($i=1;$i<=$row_num;$i++)
		{
			if($row[$i]['uplocal']!='Home')
			{
				$filename=$row[$i]['uplocal'];
			
			while($data[uplocal]!='Home')
			{
				
				 $sql=sprintf("select * from file_share where username='%s'  and filename='%s' and  type='bag'",$_SESSION['username'],$filename);
                $data_get=new Mysql_get($sql);
				$data=$data_get->Get_Result();
				if($data['uplocal']==$bag[1])
				{
					$bag[$j]=$row[$i]['uplocal'];
					$j++;
				}
				 $filename=$data['uplocal'];
			}
			unset($data);
			}
			
		}
		$bag[0]=$j-1;
		return $bag;
		
	}
	
	
	
	function Get_Time()
	{
		date_default_timezone_set("Asia/Shanghai");
		$time=date("Y-m-d H:i:s");
		return $time;
	}
	
	function Get_Ip_Loc($ip)

    {

    	$host = GAODE_URL;
  
    $method = "GET";
    $appcode = GAODE_APPCODE;
    $headers = array();
    array_push($headers, "Authorization:APPCODE " . $appcode);
    $querys = "ip=".$ip;
    $url = $host."?".$querys;
 
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    //curl_setopt($curl, CURLOPT_FAILONERROR, false);
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  //  curl_setopt($curl, CURLOPT_HEADER, true);
    if (1 == strpos("$".$host, "https://"))
    {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    }
	
	$response = curl_exec($curl);
// if ($response === false) echo curl_error($ch);
   curl_close($curl);
   $response = json_decode($response, true);//将json转为数组格式数据
   
    if($response['province']=='局域网')$response['province']='内部测试';
      {
        if($response['city']!='Array')
        return   $response['province'].$response['city'];
        else  return $response['province'];
      }
  
    	

    }
	
	function JSON_get_post($url, $params, $method)

    {

    /* 创建cURL句柄 */

    $ch = curl_init();



    /* 设置URL连接参数 */

    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);// 设置尝试连接等待时间

    curl_setopt($ch, CURLOPT_TIMEOUT, 60);// 设置cURL函数执行的最长时间

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);// 将执行结果以字符串返回

    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);// 根据响应头信息进行重定向



    /* POST与GET请求 */

    $params = http_build_query($params);// 将请求参数转换为字符串形式

    if ($method=='post') 

    {

    	  //curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

    } 

    if($method=='get')

    {

        $url = $url . ($params ? '?' : '') . $params;

    }

    curl_setopt($ch, CURLOPT_URL, $url);



    /* 抓取URL并关闭资源 */

    $response = curl_exec($ch);

    // if ($response === false) echo curl_error($ch);

    curl_close($ch);

    $response = json_decode($response, true);//将json转为数组格式数据

    return $response;

    }

    
?>