<?php
//配置主文件
//本项目在github中是实时更新的，因此github中的代码里包含了作者的所有配置信息
//虽然这些密码授权的只是一个公众号、一个数据库...但是其蕴涵的价值是无价的。
//希望大家能够尊重作者，能够正确理解开源开发的精神，自觉不利用这些密钥去做一些
//可耻的事。





//-----------数据库信息配置-----------------------

define(MYSQL_SERVER,"localhost");            //定义数据服务器的地址 //define(MYSQL_SERVER,"172.16.0.80");            //定义数据服务器的地址 
define(MYSQL_USERNAME,"wechat_szhcloud");    //定义数据库的用户名//define(MYSQL_USERNAME,"root"); 
define(MYSQL_PASSWORD,"DbPRaP3Zxz");         //定义数据库的密码//define(MYSQL_PASSWORD,"980609"); 
define(MYSQL_DATAUSE,"wechat_szhcloud");     //定义数据库的数据库名
//-----------*********---------------------------

//-----------微信授权配置-----------------------

define(WECHAT_TOKEN,"hellowechat");                          //定义微信的token字串
define(WECHAT_APPID,"wx575e17e5f5a47565");                   //定义微信的appid
define(WECHAT_APPSECRET,"546cc87edcba87c4e36bc1f813b18af9"); //定义微信的appsecret
//define(WECHAT_SERVERREADY,"false");                          //定义微信服务器是否已经初始化（如果已经初始化，请注释掉本行）
define(WECHAT_SERVERREADY,"true");                           //定义微信服务器是否已经初始化（如果没有初始化，请注释掉本行）
//-----------*********---------------------------

//-----------图灵机器人授权配置------------------


define(TULIN_APIURL,"http://www.tuling123.com/openapi/api");            //定义图灵机器人post的地址（WEB API）
define(TULIN_APIKEY,"f8b5fe97efd246f28484f49359f9cd15");                //定义数据库的用户名

//-----------*********---------------------------

//-----------腾讯COS存储系统配置-----------------------
define(COS_SERVER,'COS');                                             //定义系统中使用的URL的地址是为直接访问COS（运行模式）【请注释下一行】
//define(COS_SERVER,'SERVER');                                        //定义系统中使用的URL的地址是为直接访问服务器模式（测试模式）【请注释上一行】
define(COS_URL,"http://oss.tencent.szhcloud.cn/WebSource/");          //定义COS服务器地址 (web资源)
define(COS_YURL,"http://oss.tencent.szhcloud.cn/");                    //定义COS服务器的域名地址define(SERVER_URL,"http://".$_SERVER["SERVER_NAME"]."/src/");        //定义服务器模式时的地址
define(COS_REGION,"ap-shanghai");                                    //定义COS资源桶的区域
define(COS_NAME,"szhcloud");                                         //定义COS服务器的资源名
define(COS_APPID,"1252411219");                                      //定义腾讯APPID
define(COS_SECRETID,"AKIDzoQp0yhHcjcIl0qrTr1yiEXgcLq7M1e4");         //定义腾讯SECRETID
define(COS_SECRETKEY,"JPIyRgiWAaqtjLkvtdATZSK0XrysZ3KN");            //定义腾讯SECRETKEY
define(COS_CONFIDENCE,"75");                                      //设定人脸识别的截断精度（范围0-100），低于这个值将会判定识别失败。
//-----------*********---------------------------

//-----------高德云IP地址定位-----------//此功能暂时废弃
define(GAODE_URL,"http://iploc.market.alicloudapi.com/v3/ip");             //定义定位接口地址
//define(GAODE_APPKEY,"24751225");                                           //定义AppKey
//define(GAODE_APPSERCERT,"a11b64146b0f446c0d80cb348c36ac72");               //定义AppSercertdefine(GAODE_APPCODE,"39ff81027d7d403aa38bdf892e536940");                  //定义AppCode
//----------------------------------

?>