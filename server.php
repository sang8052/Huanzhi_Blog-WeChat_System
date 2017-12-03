
<?php
//服务端程序：V1.0.0.5
//DEBUG版本：21
//更新日志：
//1.优化人脸识别速度，对图片进行压缩之后再进行传输，提高反应速度和时间
//2.优化图片上传，图片上传后自动在前端压缩，旋转，节约服务器资源。//3.数据库更新，可通过数据库控制各模块工作，并由数据库获得最新版本信息。//4.文件路径整理


	require_once("conf.php");
	require_once("SQL_get.php");
	$WeChatClass = new WechatAPI();
    if(WECHAT_SERVERREADY=="false"){$WeChatClass->valid(); } //用于初始化配置微信服务器,
    else
    {$WeChatClass->ResponseMsg();}
 
 
  class WechatAPI 
  {
 
    private $token = WECHAT_TOKEN;
    private $appId = WECHAT_APPID;
    private $appSecret = WECHAT_APPSECRET;
    
   
    
    
    private function CheckSignature() //检查消息是否来自微信服务器
    {
      $signature = $_GET["signature"];
      $timestamp = $_GET["timestamp"];
      $nonce = $_GET["nonce"];  
      $tmpArr = array($this->token, $timestamp, $nonce);
      sort($tmpArr);
      $tmpStr = implode($tmpArr);
      $tmpStr = sha1($tmpStr);
      if($tmpStr == $signature) 
      {
        return true;
      } 
      else 
      {
        return false;
      }
    }
 
     private function valid()   //用于初始化配置微信服务器
    {
    	$echoStr = $_GET["echostr"];
       //valid signature, option
      if($this->CheckSignature()){
      	ob_clean();
        echo $echoStr;
        exit;
      }
    }
    
     public function ResponseMsg()
    {
       $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr))
        {
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $res=new Response();
            //echo "实例化回复消息对象成功！";
            $res->ResponseData['FromUserName'] = $postObj->FromUserName;
            $res->Check_Userid($res->ResponseData['FromUserName']);
            $res->ResponseData['ToUserName']= $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $res->ResponseData['CreateTime']= time();
             if(!empty($keyword))
            {
            	//echo "接收到post数据包";
            	$res->ResponseData=$res->Echo_Server($keyword,$res->ResponseData);//检查关键字是否为 版本信息||系统版本，如果是则输出相应信息
            
            	$res->ResponseData=$res->Echo_MysqlData($keyword,$res->ResponseData); //自定义回复数据库检索，如果有则输出数据库中定义的内容
            
            	$res->ResponseData=$res->Echo_TULIN($keyword,$res->ResponseData);//调用图灵api
            	
            	print_r($res->ResponseData);
            	if($res->ResponseData['type']=='text')
            	$res->Response_text($res->ResponseData);
            	if($res->ResponseData['type']=='image')
            	$res->Response_image();
            	if($res->ResponseData['type']=='voice')
            	$res->Response_voice();
            	if($res->ResponseData['type']=='vedio')
            	$res->Response_vedio();
            	if($res->ResponseData['type']=='music')
            	$res->Response_music();
            	if($res->ResponseData['type']=='news')
            	$res->Response_news($res->ResponseData);
            }
          else echo 'xml数据包中文本内容为空！';
   
          }
      else {echo '获取post的数据为空！';exit;}
    }
    
   }
   
   class Response
   {
   	
   	public $ResponseData=null;
   	 //数组$ResponseData的成员名和用途
     //bool：true，false                            标识数组是否为空
     //type：text，image，voice，vedio，music，news  标识返回的消息类型
     //ToUserName：                                                                  接收方帐号（收到的OpenID）
     //FromUserName：                                                              开发者微信号
     //CreateTime：	                                                                消息创建时间 （整型）
     //content：                                                                        文本消息的内容
     //MediaId	                                                                       通过微信素材管理中的接口上传多媒体文件，得到的id。
     //title：vedio，music，news                    消息的标题
     //Description：vedio，music，news              消息的描述
     //-----Music消息专用------
     //MusicURL		        音乐链接
     //HQMusicUrl		高质量音乐链接，WIFI环境优先使用该链接播放音乐
     //ThumbMediaId		缩略图的媒体id，通过素材管理中的接口上传多媒体文件，得到的id
     //-----news消息专用------
     //ArticleCount		图文消息个数，限制为8条以内
     //Articles		多条图文消息信息，默认第一个item为大图,注意，如果图文数超过8，则将会无响应
     //PicUrl		图片链接，支持JPG、PNG格式，较好的效果为大图360*200，小图200*200
     //Url		点击图文消息跳转链接
     
     // 返回函数赋值代码，数组中没有的项请为空
     /*
        请复制以下代码--->          
                 ---> 
                  
                $ResponseData['bool']=true;
                $ResponseData['type']='';
                $ResponseData['Content']="";
                $ResponseData['MediaId']='';
                $ResponseData['title']='';
                $ResponseData['Description']='';
                $ResponseData['MusicURL']='';
                $ResponseData['HQMusicUrl']='';
                $ResponseData['ArticleCount']='';
                $ResponseData['PicUrl']='';
                $ResponseData['Url']='';
     */
    
   
    
    private function Check_Chats($keyword)//匹配数据库，寻找回答
    {
       $sql="select * from chats where asks='".$keyword."'";
       $data_mysql=new Mysql_get($sql);
       $ans_num=$num=$data_mysql->GetRowNum();
       $row=$data_mysql->GetResult();
       if($ans_num!=0)
    	return    $row[$num];
    	else return null;
    }
    
    public function Check_Userid($wechatid)//检查数据库中是否有微信用户id
    {
    	 $sql="select * from userdata where wechatid='".$wechatid."'";
    	 $data_mysql=new Mysql_get($sql);
    	 $ans_num=$num=$data_mysql->GetRowNum();
    	 if($ans_num==0)
    	 {
    	 $userid=md5($wechatid);
    	 $sql="insert into userdata set wechatid='".$wechatid."' , userid='".$userid."'";
    	 $sql_mysql=new Mysql_do();
    	 $sql_mysql->SetSQL($sql);
    	 }
    }
    
    
    public function Echo_Server($keyword,$ResponseData)//输出版本信息
     {
       
     	if( $ResponseData['bool']!='true')
     	{
     	
     		if($keyword=="版本信息"||$keyword=="系统版本")
             {
             	$Version['SERVER']=VERSION_SERVER;
             	$Version['DATA']=VERSION_DATA;
             	$Version['CONTROL']=VERSION_CONTROL;
             	$ResponseData['bool']='true';
                $ResponseData['type']='text';
                $ResponseData['Content']="服务端版本:".$Version['SERVER']."\n数据库版本:".$Version['DATA']."\n控制台版本:".$Version['CONTROL'];
                $ResponseData['MediaId']='';
                $ResponseData['title']='';
                $ResponseData['Description']='';
                $ResponseData['MusicURL']='';
                $ResponseData['HQMusicUrl']='';
                $ResponseData['ArticleCount']='';
                $ResponseData['PicUrl']='';
                $ResponseData['Url']='';
             }
			 if($keyword=="我的信息"||$keyword=="我是谁"||$keyword=="查询个人信息")
             {
             	$sql="select * from userdata where wechatid='".$ResponseData['FromUserName']."'"; 
                $data_mysql=new Mysql_get($sql);
	            $row=$data_mysql->Get_Result();
				
             	$ResponseData['bool']='true';
                $ResponseData['type']='text';
				if($row['username']!=''||$row['username']!=NULL)
                $ResponseData['Content']="用户唯一ID:".$row['userid']."\n姓名:".$row['username']."\n性别:".$row['sex'];
				else
				$ResponseData['Content']="您还没有绑定信息，请回复 '添加人脸信息',按照提示输入信息，即可绑定。";
                $ResponseData['MediaId']='';
                $ResponseData['title']='';
                $ResponseData['Description']='';
                $ResponseData['MusicURL']='';
                $ResponseData['HQMusicUrl']='';
                $ResponseData['ArticleCount']='';
                $ResponseData['PicUrl']='';
                $ResponseData['Url']='';
             }
			 
           
     	}
     	return $ResponseData;    
             
     }
     
     public function Echo_MysqlData($keyword,$ResponseData)//输出mysql数据库里自定义的回复内容
     {
     		
     	if(  $ResponseData['bool']!='true')
          {
             $data_get=$this->Check_Chats($keyword);  //匹配数据库，寻找回答
             
             if($data_get['type']!=null||$data_get['type']!='')
             {
             	if($data_get['type']=='news')
             	{
               $ResponseData['bool']='true';
             	$ResponseData['type']='news';
             	$ResponseData['ArticleCount']=1;
             	$ResponseData['title'][0]=$data_get['title'];
             	$ResponseData['Description'][0]=$data_get['description'];
             	if(COS_SERVER=="COS")
             	$ResponseData['PicUrl'][0]=COS_URL."img/tulin_url.jpg";
             	if(COS_SERVER=="SERVER")
             	$ResponseData['PicUrl'][0]=SERVER_URL."img/tulin_url.jpg";
             	if($data_get['userid']=="true")
             	{
             		$userid=self::Get_Userid($ResponseData['FromUserName']);
                    $ResponseData['Url'][0]=$data_get['url']."?userid=".$userid;
             	}
             	else
                $ResponseData['Url'][0]=$data_get['url'];
             	}
             	else
             	{
             $ResponseData['bool']='true';
             $ResponseData['type']=$data_get['type'];
             $ResponseData['Content']=$data_get['content'];
             $ResponseData['MediaId']=$data_get['mediaid'];
             $ResponseData['title']=$data_get['title'];
             $ResponseData['Description']=$data_get['description'];
             $ResponseData['MusicURL']=$data_get['musicurl'];
             $ResponseData['HQMusicUrl']=$data_get['hqmusicurl'];
             $ResponseData['ArticleCount']=$data_get['articlecount'];
             $ResponseData['PicUrl']=$data_get['picurl'];
             $ResponseData['Url']=$data_get['url'];
             	}
            
            }
           
          } 
           return $ResponseData;
     }
     
    
     public function Echo_TULIN($keyword,$ResponseData)
     {
     		
     	if( $ResponseData['bool']!='true')
     	{    
     		
             $ip=self::Get_Client_Ip();
             $loc=self::Get_Ip_Loc($ip);
             $userid=self::Get_Userid($ResponseData['FromUserName']);
             $data_tulin_url=TULIN_APIURL;
             $data_tulin['key']=TULIN_APIKEY;
             $data_tulin['info']=$keyword;
             $data_tulin['loc']=$loc;
             $data_tulin['userid']=$userid;
             $method="post";
             $data_tulin_get=self::JSON_get_post( $data_tulin_url, $data_tulin, $method);
             //print_r($data_tulin_get);
             if( $data_tulin_get['code']=='100000')
             {
             	//echo "tulin回复文本消息"; 
             	$ResponseData['bool']='true';
             $ResponseData['type']='text';
             $ResponseData['Content']=$data_tulin_get['text'];
             }
            else if( $data_tulin_get['code']=='200000')
             {
             	 $ResponseData['bool']='true';
             	$ResponseData['type']='news';
             	$ResponseData['ArticleCount']=1;
             	$ResponseData['title'][0]=$data_tulin_get['text'];
             	$ResponseData['Description'][0]="图灵机器人智能回复";
             	if(COS_SERVER=="COS")
             	$ResponseData['PicUrl'][0]=COS_URL."img/tulin_url.jpg";
             	if(COS_SERVER=="SERVER")
             	$ResponseData['PicUrl'][0]=SERVER_URL."img/tulin_url.jpg";
                $ResponseData['Url'][0]=$data_tulin_get['url'];
             }
           else if( $data_tulin_get['code']=='302000')
             {
             	 $ResponseData['bool']='true';
             	$ResponseData['type']='news';
             	
             	for($i=0;$data_tulin_get['list'][$i]!=null;$i++)
             	$ResponseData['ArticleCount']=$i++;
             	if($ResponseData['ArticleCount']>=8)$ResponseData['ArticleCount']=8;
             	$j=$ResponseData['ArticleCount']-1;
             	for($i=0;$i<=$j;$i++)
             	{	
             	$ResponseData['title'][$i]=$data_tulin_get['list'][$i]['article'];
             	$ResponseData['Description'][$i]=$data_tulin_get['list'][$i]['source'];
             	$ResponseData['PicUrl'][$i]=$data_tulin_get['list'][$i]['icon'];;
                $ResponseData['Url'][$i]=$data_tulin_get['list'][$i]['detailurl'];
               }
             }
             else if( $data_tulin_get['code']=='308000')
              {
              	 $ResponseData['bool']='true';
             	$ResponseData['type']='news';
             	for($i=0;$data_tulin_get['list']["$i"]!=null;$i++)
             	$ResponseData['ArticleCount']=$i++;
             	if($ResponseData['ArticleCount']>=8)$ResponseData['ArticleCount']=8;
             	$j=$ResponseData['ArticleCount']-1;
             	for($i=0;$i<=$j;$i++)
             		{
             			$ResponseData['title'][$i]=$data_tulin_get['list'][$i]['name'];
             	        $ResponseData['Description'][$i]=$data_tulin_get['list'][$i]['info'];
             	        $ResponseData['PicUrl'][$i]=$data_tulin_get['list'][$i]['icon'];
             	        $ResponseData['Url'][$i]=$data_tulin_get['list'][$i]['detailurl'];
             		}
             	
             }
             else
             {
             	echo $data_tulin_get['code'];
             }
           
     }
     return $ResponseData;
    }
    
  
     
    public  function Get_Client_Ip($type = 0, $strict = false)   //获得当前客户端的ip地址
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
     
       public function Get_Ip_Loc($ip)
    {
    	$data_baidu_url=BAIDU_URL;
    	$data_baidu['ip']=$ip;
    	$data_baidu['ak']=BAIDU_AK;
    	$data_baidu['coor']=BAIDU_COOR;
    	$method='get';
    	$loc=self::JSON_get_post($data_baidu_url,$data_baidu, $method);
    	return $loc['content']['address'];
    	
    }
    
     private function Get_Userid($wechatid)
    {
    	 $sql="select * from userdata where wechatid='".$wechatid."'";
    	 $data_mysql=new Mysql_get($sql);
    	  $ans_num=$num=$data_mysql->GetRowNum();
       $row=$data_mysql->GetResult();
       if($ans_num!=0)
    	return    $row[$num]['userid'];
    	else return null;
    }
    
    public function JSON_get_post($url, $params, $method)
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
    
    
    
    
    
    public function Response_text($ResponseData)
    {    //echo "回复文本消息"; 
       
    	 $textTpl = "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[%s]]></MsgType>
                <Content><![CDATA[%s]]></Content>
                <FuncFlag>0<FuncFlag>
                </xml>";
         $resultStr = sprintf($textTpl, $ResponseData['FromUserName'], $ResponseData['ToUserName'], $ResponseData['CreateTime'], $ResponseData['type'], $ResponseData['Content']);
         echo $resultStr;
         
    }
    
    private function Response_image()
    {
    	
    }
    
    private function Response_voice()
    {
    	
    }
    
    private function Response_vedio()
    {
    	
    }
    
    private function Response_music()
    {
    	
    }
    
    public function Response_news($ResponseData)
    {
    	 $textTpl_a = "<xml>
				<ToUserName><![CDATA[%s]]></ToUserName>
				<FromUserName><![CDATA[%s]]></FromUserName>
				<CreateTime>%s</CreateTime>
				<MsgType><![CDATA[%s]]></MsgType>
				<ArticleCount>%s</ArticleCount>
				<Articles>";
		$resultStr_a = sprintf($textTpl_a, $ResponseData['FromUserName'], $ResponseData['ToUserName'], $ResponseData['CreateTime'], $ResponseData['type'], $ResponseData['ArticleCount']);
		$j=$ResponseData['ArticleCount']-1;
		for($i=0;$i<=$j;$i++)
			{
		$textTpl_b[$i] = "<item>
				<Title><![CDATA[%s]]></Title> 
				<Description><![CDATA[%s]]></Description>
				<PicUrl><![CDATA[%s]]></PicUrl>
				<Url><![CDATA[%s]]></Url>
			    </item>";
				$resultStr_b[$i] = sprintf($textTpl_b[$i], $ResponseData['title'][$i], $ResponseData['Description'][$i], $ResponseData['PicUrl'][$i], $ResponseData['Url'][$i]);
			}
			for($i=0;$i<=$j;$i++)
				{
					$resultStr_b_all=$resultStr_b_all.$resultStr_b[$i];
				}
		           $resultStr_c=$textTpl_c="</Articles>
		                                    </xml>";
				
                
                $resultStr=$resultStr_a.$resultStr_b_all.$resultStr_c;
                echo $resultStr;
             
    }
    
   }
  
?>