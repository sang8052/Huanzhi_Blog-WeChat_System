# Host: 172.16.0.80  (Version 5.5.54-log)
# Date: 2018-01-04 21:52:54
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "chats"
#

DROP TABLE IF EXISTS `chats`;
CREATE TABLE `chats` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `asks` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(255) DEFAULT NULL,
  `content` text,
  `mediaid` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `musicurl` varchar(255) DEFAULT NULL,
  `hqmusicurl` varchar(255) DEFAULT NULL,
  `articlecount` int(1) DEFAULT '1',
  `picurl` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `userid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='自定义回复表';

#
# Data for table "chats"
#

/*!40000 ALTER TABLE `chats` DISABLE KEYS */;
INSERT INTO `chats` VALUES (1,'人脸识别系统','news',NULL,NULL,'人脸识别系统正在开发中..','我可不是脸盲哦，你是谁，我只要瞅一眼就知道，不信，就来试试！',NULL,NULL,1,'http://oss.tencent.szhcloud.cn/img/tulin_url.jpg','http://wechat.szhcloud.top/html/Human_Check_System/System_Index.php','true'),(2,'添加人脸信息','news',NULL,NULL,'寰智人脸识别系统-添加人脸信息','请上传五官清晰的照片哦。',NULL,NULL,1,'http://oss.tencent.szhcloud.cn/img/tulin_url.jpg','http://wechat.szhcloud.top/html/Human_Check_System/Form_Get_PeopleInformation.php','true'),(3,'识别人脸信息','news',NULL,NULL,'寰智人脸识别系统-识别人脸信息','寰智人脸识别系统-添加人脸信息',NULL,NULL,1,'http://oss.tencent.szhcloud.cn/img/tulin_url.jpg','http://wechat.szhcloud.top/html/Human_Check_System/Form_Check_PeopleInformation.php','true');
/*!40000 ALTER TABLE `chats` ENABLE KEYS */;

#
# Structure for table "file_share"
#

DROP TABLE IF EXISTS `file_share`;
CREATE TABLE `file_share` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `uplocal` varchar(255) DEFAULT NULL,
  `ossurl` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

#
# Data for table "file_share"
#

/*!40000 ALTER TABLE `file_share` DISABLE KEYS */;
INSERT INTO `file_share` VALUES (29,'admin','2017_11_30 上午4_41 Office Lens (1).jpg','Home','http://oss.tencent.szhcloud.cnFile_Share/29-2017_11_30 上午4_41 Office Lens (1).jpg','file','2018-01-03 10:38:04','142.6298828125KB');
/*!40000 ALTER TABLE `file_share` ENABLE KEYS */;

#
# Structure for table "login_teacher"
#

DROP TABLE IF EXISTS `login_teacher`;
CREATE TABLE `login_teacher` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `logintime` varchar(255) DEFAULT NULL,
  `pass_state` varchar(255) DEFAULT NULL,
  `pass_wrong` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

#
# Data for table "login_teacher"
#

/*!40000 ALTER TABLE `login_teacher` DISABLE KEYS */;
INSERT INTO `login_teacher` VALUES (1,'admin','172.16.0.54','2017-12-30 13:06:21','Success',NULL),(2,'admin','172.16.0.54','2017-12-30 13:06:36','Success',NULL),(3,'admin','172.16.0.56','2017-12-30 16:27:35','Success',NULL),(4,'admin','172.16.0.80','2017-12-30 16:31:20','Success',NULL),(5,'admin','172.16.0.56','2017-12-30 22:23:17','Fail','1322'),(6,'admin','172.16.0.54','2017-12-31 19:52:34','Success',NULL),(7,'admin','172.16.0.54','2017-12-31 21:26:38','Success',NULL),(8,'admin','172.16.0.54','2017-12-31 23:01:10','Success',NULL),(9,'admin','172.16.0.54','2018-01-01 00:29:07','Success',NULL),(10,'admin','172.16.0.54','2018-01-01 19:09:41','Success',NULL),(11,'admin','172.16.0.54','2018-01-01 20:49:10','Success',NULL),(12,'admin','172.16.0.54','2018-01-01 22:21:08','Success',NULL),(13,'admin','172.16.0.54','2018-01-01 23:52:02','Fail','admin'),(14,'admin','172.16.0.54','2018-01-01 23:52:11','Success',NULL),(15,'admin','172.16.0.54','2018-01-01 23:59:40','Fail','admin'),(16,'admin','172.16.0.54','2018-01-01 23:59:50','Success',NULL),(17,'admin','172.16.0.80','2018-01-02 00:39:47','Fail','admin'),(18,'admin','172.16.0.80','2018-01-02 00:39:54','Success',NULL),(19,'admin','172.16.0.80','2018-01-02 01:10:08','Success',NULL),(20,'admin','172.16.0.54','2018-01-02 10:28:08','Fail','admin'),(21,'admin','172.16.0.54','2018-01-02 10:28:54','Success',NULL),(22,'admin','172.16.0.54','2018-01-02 14:29:50','Success',NULL),(23,'admin','172.16.0.54','2018-01-02 17:00:55','Success',NULL),(24,'admin','172.16.0.54','2018-01-02 19:45:37','Success',NULL),(25,'admin','172.16.0.54','2018-01-02 19:55:25','Success',NULL),(26,'admin','172.16.0.54','2018-01-02 20:16:14','Success',NULL),(27,'admin','172.16.0.54','2018-01-02 21:46:54','Success',NULL),(28,'admin','172.16.0.80','2018-01-02 22:26:07','Success',NULL),(29,'admin','172.16.0.54','2018-01-03 10:37:37','Success',NULL),(30,'admin','172.16.0.54','2018-01-03 12:11:46','Success',NULL),(31,'admin','172.16.0.54','2018-01-03 15:01:30','Success',NULL),(32,'admin','172.16.0.54','2018-01-03 16:31:55','Success',NULL),(36,'admin','172.16.0.54','2018-01-03 20:04:20','Success',NULL),(37,'admin','172.16.0.54','2018-01-04 08:42:13','Success',NULL),(38,'admin','172.16.0.54','2018-01-04 15:36:30','Success',NULL),(39,'admin','172.16.0.54','2018-01-04 20:41:37','Success',NULL);
/*!40000 ALTER TABLE `login_teacher` ENABLE KEYS */;

#
# Structure for table "mail"
#

DROP TABLE IF EXISTS `mail`;
CREATE TABLE `mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `send_username` varchar(255) DEFAULT NULL,
  `get_username` varchar(255) DEFAULT NULL,
  `get_read` tinyint(1) DEFAULT NULL,
  `get_show` tinyint(1) DEFAULT NULL,
  `send_show` tinyint(1) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

#
# Data for table "mail"
#

/*!40000 ALTER TABLE `mail` DISABLE KEYS */;
INSERT INTO `mail` VALUES (1,'admin','测试消息接收人',0,1,0,'测试消息','2018-01-04 21:22:04','<p>这是我发给你的测试消息</p><table><tbody><tr class=\"firstRow\"><td width=\"172\" valign=\"top\" style=\"word-break: break-all;\">姓名</td><td width=\"172\" valign=\"top\" style=\"word-break: break-all;\">学号</td><td width=\"172\" valign=\"top\" style=\"word-break: break-all;\">班级</td><td width=\"172\" valign=\"top\" style=\"word-break: break-all;\">性别</td></tr><tr><td width=\"172\" valign=\"top\" style=\"word-break: break-all;\">344</td><td width=\"172\" valign=\"top\" style=\"word-break: break-all;\">3434342</td><td width=\"172\" valign=\"top\" style=\"word-break: break-all;\">4343434</td><td width=\"172\" valign=\"top\" style=\"word-break: break-all;\">22222</td></tr><tr><td width=\"172\" valign=\"top\" style=\"word-break: break-all;\">234243</td><td width=\"172\" valign=\"top\" style=\"word-break: break-all;\">234234</td><td width=\"172\" valign=\"top\" style=\"word-break: break-all;\">2234324</td><td width=\"172\" valign=\"top\" style=\"word-break: break-all;\">3333</td></tr></tbody></table><p><br/></p>'),(2,'运维团队','admin',1,0,1,'系统退信','2018-01-04 21:22:04','尊敬的&nbsp;测试教师&nbsp;先生,您好，您于&nbsp;2018-01-04 21:22:04&nbsp;发送给&nbsp;测试消息接收人&nbsp;，主题为&nbsp;测试消息&nbsp;的邮件因为无法找到对应的收信人，因此已经被退回。该邮件的内容如下:<br/><p>这是我发给你的测试消息</p><table><tbody><tr class=\"firstRow\"><td width=\"172\" valign=\"top\" style=\"word-break: break-all;\">姓名</td><td width=\"172\" valign=\"top\" style=\"word-break: break-all;\">学号</td><td width=\"172\" valign=\"top\" style=\"word-break: break-all;\">班级</td><td width=\"172\" valign=\"top\" style=\"word-break: break-all;\">性别</td></tr><tr><td width=\"172\" valign=\"top\" style=\"word-break: break-all;\">344</td><td width=\"172\" valign=\"top\" style=\"word-break: break-all;\">3434342</td><td width=\"172\" valign=\"top\" style=\"word-break: break-all;\">4343434</td><td width=\"172\" valign=\"top\" style=\"word-break: break-all;\">22222</td></tr><tr><td width=\"172\" valign=\"top\" style=\"word-break: break-all;\">234243</td><td width=\"172\" valign=\"top\" style=\"word-break: break-all;\">234234</td><td width=\"172\" valign=\"top\" style=\"word-break: break-all;\">2234324</td><td width=\"172\" valign=\"top\" style=\"word-break: break-all;\">3333</td></tr></tbody></table><p><br/></p>');
/*!40000 ALTER TABLE `mail` ENABLE KEYS */;

#
# Structure for table "sysinfo"
#

DROP TABLE IF EXISTS `sysinfo`;
CREATE TABLE `sysinfo` (
  `Id` int(5) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(255) DEFAULT NULL,
  `version` varchar(255) DEFAULT NULL,
  `bool` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `infor` varchar(255) DEFAULT NULL,
  `build` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

#
# Data for table "sysinfo"
#

/*!40000 ALTER TABLE `sysinfo` DISABLE KEYS */;
INSERT INTO `sysinfo` VALUES (1,'Wechat_Server','1.0.0.4','true',NULL,'微信消息接收回复系统',NULL),(3,'FaceCheck_Server','1.0.0.2','false','人脸识别系统正在二次开发，暂时关闭使用。','人脸识别系统',NULL),(4,'Control_Server','1.0.0.2','false','控制端正在建设中...暂时无法使用。敬请期待。','微信控制后端系统',NULL),(5,'Database_Server','1.0.0.3','true',NULL,'数据库系统',NULL),(6,'Teacher_Admin_Server','1.0.0.1','true','建设中，暂停使用！','教师管理后台','2017-12-31 V3');
/*!40000 ALTER TABLE `sysinfo` ENABLE KEYS */;

#
# Structure for table "sysnotice"
#

DROP TABLE IF EXISTS `sysnotice`;
CREATE TABLE `sysnotice` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(255) DEFAULT NULL,
  `content` text,
  `time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "sysnotice"
#

/*!40000 ALTER TABLE `sysnotice` DISABLE KEYS */;
INSERT INTO `sysnotice` VALUES (1,'Teacher_Admin_Server','账户管理、资源共享模块已经建设完成，其他功能正在建设中。<br/>\n模块建设顺序规划：站内消息->网页博文->学生管理->随堂练习','2017-01-03 15:06:46');
/*!40000 ALTER TABLE `sysnotice` ENABLE KEYS */;

#
# Structure for table "user_teacher"
#

DROP TABLE IF EXISTS `user_teacher`;
CREATE TABLE `user_teacher` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `lesson` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `signs` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "user_teacher"
#

/*!40000 ALTER TABLE `user_teacher` DISABLE KEYS */;
INSERT INTO `user_teacher` VALUES (1,'admin','39f3646e5a34782b3b306d284b26869a','测试教师','C++,PHP,JAVA','男','做最好的老师',NULL);
/*!40000 ALTER TABLE `user_teacher` ENABLE KEYS */;

#
# Structure for table "userdata"
#

DROP TABLE IF EXISTS `userdata`;
CREATE TABLE `userdata` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) DEFAULT NULL,
  `wechatid` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `piccount` int(11) DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

#
# Data for table "userdata"
#

/*!40000 ALTER TABLE `userdata` DISABLE KEYS */;
INSERT INTO `userdata` VALUES (1,'5252a4b010c6789720709aa56390ea66','oGVKLxBFmOfmPrOOan_0b6XVpdsI','桑泽寰','男',1),(2,'2039c802777c4e1244e84243b1c45e74','oGVKLxLFKFjmgdFYU8EQgHxcejAw','朱海铭','男',2),(3,'df999c6c9c432745c6835a9d5e872388','oGVKLxCOYzQut6A-c0B01UolMpkM','','',0),(4,'9673c4a57e12e0d3d758ab6586e99f0f','oGVKLxPNpwLLGNXdmh-zsjV_yX7Q','','',0),(5,'473d68b05a34a3191f964e6c6f94aba5','oGVKLxIuFgCDOAz9anTb5Vny4t3o',NULL,NULL,0);
/*!40000 ALTER TABLE `userdata` ENABLE KEYS */;

#
# Structure for table "userpic"
#

DROP TABLE IF EXISTS `userpic`;
CREATE TABLE `userpic` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) DEFAULT NULL,
  `picurl` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

#
# Data for table "userpic"
#

/*!40000 ALTER TABLE `userpic` DISABLE KEYS */;
INSERT INTO `userpic` VALUES (15,'5252a4b010c6789720709aa56390ea66','http://oss.tencent.szhcloud.cn/PeopleInformation/Pic_Upload/ed9f3563e8939cad18a39c93ec5c9f9b.jpg?imageMogr2/auto-orient'),(16,'2039c802777c4e1244e84243b1c45e74','http://oss.tencent.szhcloud.cn/PeopleInformation/Pic_Upload/893f66bedebb425a65ef67698da6167d.jpg?imageMogr2/auto-orient'),(17,'2039c802777c4e1244e84243b1c45e74','http://oss.tencent.szhcloud.cn/PeopleInformation/Pic_Upload/7821856a53fb3be374c96ddce2bcbbf9.jpg?imageMogr2/auto-orient');
/*!40000 ALTER TABLE `userpic` ENABLE KEYS */;
