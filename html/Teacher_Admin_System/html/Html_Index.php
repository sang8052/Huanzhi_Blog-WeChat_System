<!-- 页面内容开始 -->
  <div class="admin-content">
    <div class="admin-content-body">
      <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">首页</strong></div>
      </div>
      
      <div class="am-g">
      	 <div class="am-u-lg-3  am-u-end">
          <div class="am-panel am-panel-default">
             <div class="am-panel-hd am-panel-secondary">
               <h3 class="am-panel-title">系统信息</h3>
             </div>
             <div class="am-panel-bd">
              <p>系统版本：<?php echo $SYSTEM["VERSION"]; ?> <br/>
              Build Date:<?php echo $SYSTEM["BUILD"]; ?><br/>
                           客户端IP地址:<?php echo $_SESSION['ip']?><br/>
                           登录时间：<?php echo $_SESSION['time']?><br/>
                                                      登录有效时间：<? echo date('Y-m-d H:i:s',strtotime($_SESSION['time'])+5400)?><br/>
                                                      服务器域名：<?php echo "http://".$_SERVER['SERVER_NAME']?><br/> 
              </p>                      
             </div>
        </div>
        </div>
        <div class="am-u-lg-6  am-u-end">
          <div class="am-panel am-panel-default">
             <div class="am-panel-hd am-panel-secondary">
               <h3 class="am-panel-title">系统公告</h3>
             </div>
             <div class="am-panel-bd">
              <p>
              	<?php 
              	$sql="select * from sysnotice where keyword ='Teacher_Admin_Server'";
                $data_get=new Mysql_get($sql);
                $row=$data_get->Get_Result();
				        echo $row['content'];
              		?>
              </p>                      
             </div>
              <div class="am-panel-footer" align="right">时间：<?php echo $row['time'] ?></div>

        </div>
        </div>
      </div>
      
      <div class="am-g">
      	 <div class="am-u-sm-9  am-u-end">
          <div class="am-panel am-panel-default">
             <div class="am-panel-hd am-panel-secondary">
               <h3 class="am-panel-title">使用说明</h3>
             </div>
             <div class="am-panel-bd">
              <p>
                           此系统为寰智博客-微信课堂系统的教师管理后台。系统主要拥有如下功能：<br/>
                           <ul>
                           	<li>1.学生管理----管理学生数据，用于课堂进行人脸识别签到等</li>
                           	<li>2.资源共享----用于课堂进行课件、资料等资源的共享</li>
                            <li>3.随堂练习----可在课堂上发起练习，并可实时查看答题情况</li>
                            <li>4.网页博文----可以编写自己的文章，并向学生分享</li>
                           	<li>5.站内消息----可以向系统内的其它教师发送消息</li>	
                           </ul>
                        
              </p>                      
             </div>
        </div>
        </div>
    
    
    </div>
    <!-- 页面内容结束 -->

