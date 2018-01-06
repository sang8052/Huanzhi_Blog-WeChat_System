<!-- 顶部功能栏 开始-->

<?php
if(!is_file("../../Safe_Check.php"))
{
	$echo='<script language="javascript">{ window.location.href="../../Echo_Error.php?error=1007";} </script>';echo $echo;
}
	$sql=sprintf("select * from mail where get_username='%s' and get_read='0' and get_show='1'",$_SESSION['username']);
   $data_get=new Mysql_get($sql);
   $row=$data_get->Get_Result(); 
   $row_num=$data_get->GetRowNum();
   $mail_num=$row_num;
	
	?>
<header class="am-topbar am-topbar-inverse admin-header">
  <div class="am-topbar-brand">
    <strong>寰智博客</strong> <small>教师管理后台</small>
  </div>

  <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

  <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

    <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
      <li><a href="Index_Run.php?Run=Mail_New"><span class="am-icon-envelope-o"></span> 未读消息 <span class="am-badge am-badge-warning"><?php echo $mail_num ?></span></a></li>
      <li class="am-dropdown" data-am-dropdown>
        <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
          <span class="am-icon-users"></span> <?php echo $_SESSION['name']; ?> <span class="am-icon-caret-down"></span>
        </a>
        <ul class="am-dropdown-content">
          <li><a href="Index_Run.php?Run=Login_Data"><span class="am-icon-user"></span>登录日志</a></li>
          <li><a href="Index_Run.php?Run=User_Data"><span class="am-icon-cog"></span>个人设置</a></li>
          <li><a href="Index_Run.php?Run=Login_Out"><span class="am-icon-power-off"></span> 退出</a></li>
        </ul>
      </li>
      <li class="am-hide-sm-only"><a href="javascript:;" id="admin-fullscreen"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>
    </ul>
  </div>
</header>

<!-- 顶部功能栏 结束-->