<!-- 侧边栏 开始 -->
<?php 
if(!is_file("../../Safe_Check.php"))
{
	$echo='<script language="javascript">{ window.location.href="../../Echo_Error.php?error=1007";} </script>';echo $echo;
}
	?>
  <div class="admin-sidebar am-offcanvas" id="admin-offcanvas">
    <div class="am-offcanvas-bar admin-offcanvas-bar">
      <ul class="am-list admin-sidebar-list">
        <li><a href="Index_Run.php"><span class="am-icon-home"></span> 首页</a></li>
        <li class="admin-parent">
          <a class="am-cf" data-am-collapse="{target: '#collapse-user'}"><span class="am-icon-user"></span> 账户管理 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
          <ul class="am-list am-collapse admin-sidebar-sub " id="collapse-user">
            <li><a href="Index_Run.php?Run=Login_Data" class="am-cf"><span class="am-icon-calendar"></span> 登录日志</a></li>
             <li><a href="Index_Run.php?Run=User_Data" class="am-cf"><span class="am-icon-database"></span>个人信息</a></li>
          </ul>
        </li>
        
        <li class="admin-parent">
        <a class="am-cf" data-am-collapse="{target: '#collapse-student'}"><span class="am-icon-users"></span> 学生管理 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
         
         
         </li>
         
         <li class="admin-parent">
        <a class="am-cf" data-am-collapse="{target: '#collapse-cloud'}" href="Index_Run.php?Run=Cloud_File&Action=Show"><span class="am-icon-cloud"></span> 资源共享 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
           
         
         </li>
         
         <li class="admin-parent">
        <a class="am-cf" data-am-collapse="{target: '#collapse-class'}"><span class="am-icon-pencil"></span> 随堂练习 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
         
         
         </li>
         
         <li class="admin-parent">
        <a class="am-cf" data-am-collapse="{target: '#collapse-blog'}"><span class="am-icon-book"></span> 网页博文 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
         
         
         </li>
         
         <li class="admin-parent">
        <a class="am-cf" data-am-collapse="{target: '#collapse-mail'}"><span class="am-icon-envelope"></span> 站内消息 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
         <ul class="am-list am-collapse admin-sidebar-sub " id="collapse-mail">
         	   <li><a href="Index_Run.php?Run=Mail_Write" class="am-cf"><span class="am-icon-pencil-square-o"></span>写消息</a></li>
             <li><a href="Index_Run.php?Run=Mail_New" class="am-cf"><span class="am-icon-envelope-o"></span>未读消息</a></li>
             <li><a href="Index_Run.php?Run=Mail_Get" class="am-cf"><span class="am-icon-folder"></span>收件夹</a></li>
             <li><a href="Index_Run.php?Run=Mail_Send" class="am-cf"><span class="am-icon-folder-o"></span>发件夹</a></li>
             
          </ul>
         
         </li>
        <li><a href="Index_Run.php?Run=Login_Out"><span class="am-icon-sign-out"></span> 注销</a></li>
      </ul>

      

      <div class="am-panel am-panel-default admin-sidebar-panel">
        <div class="am-panel-bd">
          <p><span class="am-icon-tag"></span>Teams Invite(维护团队)</p>
          <p>Mail:sang8052@qq.com<br/>
          	Github:  <a href="https://github.com/sang8052/Huanzhi_Blog-WeChat_System" target="_blank">sang8052</a><br/>
          	QQ：925040692 
          </p>
        </div>
      </div>
    </div>
  </div>
  <!-- 侧边栏 结束-->