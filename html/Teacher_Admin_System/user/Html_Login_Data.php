<!-- 页面内容开始 -->
  <div class="admin-content">
    <div class="admin-content-body">
      <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">账户管理</strong>/<small>登录日志</samll></div>
      </div>
      
     <div class="am-g">
      	 <div class="am-u-sm-9  am-u-end">
          <div class="am-panel am-panel-default">
             <div class="am-panel-hd am-panel-secondary">
               <h3 class="am-panel-title">登录日志</h3>
             </div>
             <div class="am-panel-bd">
              <p> 此日志记录用户账户的登录操作，可显示登录时间、地点、错误登录的密码<br/></p>
               <table class="am-table am-table-striped am-table-hover table-main">
              <thead>
              <tr>
               <th class="table-id">ID</th><th class="table-title">IP</th><th class="table-type">登录地</th><th class="table-author am-hide-sm-only">时间</th><th class="table-date am-hide-sm-only">状态</th><th class="table-set">错误密码</th>
              </tr>
              </thead>
              <tbody>
            <?php
            $sql="select * from login_teacher where username ='".$_SESSION['username']."' order by id desc";
            $data_get=new Mysql_get($sql);
			$row_num=$data_get->GetRowNum();
			$Page_Show_Num=15;     //设置每页显示 15 条记录
			$Page_Num=ceil($row_num/$Page_Show_Num);
			if(isset($_GET['page']))$page=$_GET['page'];
            else $page=1;
			$row_start=($page-1)*$Page_Show_Num;
			$sql=sprintf("select * from login_teacher where username ='%s' order by id desc limit %s,%s",$_SESSION['username'],$row_start,$Page_Show_Num);
            $data_get=new Mysql_get($sql);
            $row=$data_get->GetResult(); 
            $row_show=$data_get->GetRowNum();
			for($i=1;$i<=$row_show;$i++)
			{
				echo '<tr><td class="am-hide-sm-only">'.$i.'</td><td>'.$row[$i]['ip'].'</td>'; //编号、IP地址
				echo '<td class="am-hide-sm-only">'.Get_Ip_Loc($row[$i]['ip']).'</td>';        //IP定位
				
				echo '<td class="am-hide-sm-only">'.$row[$i]['logintime'].'</td>'; 
				if($row[$i]['pass_state']=='Success')
				echo '<td class="am-hide-sm-only" ><font color="green">成功</font></td>'; 
        else
				echo '<td class="am-hide-sm-only" ><font color="red">失败</font></td>'; 
				echo '<td class="am-hide-sm-only">'.$row[$i]['pass_wrong'].'</td></tr>'; //促偶的密码
				
			}
            ?>  	
             </tbody>
            </table>
            <div class="am-cf">
                         共 <?php echo $row_num;?>条记录
               <div class="am-fr">
                <ul class="am-pagination">
                 <?php if($page==1) echo '<li class="am-disabled">';?><a href="Index_Run.php?Run=Login_Data&page=<?php echo $page-1 ?>">上一页</a></li>
                 <?php 
                 for($i=1;$i<=$Page_Num;$i++)
				             { 	  if($i==$page) echo '<li class="am-active">';
							          	 else echo '<li>';
									     echo '<a href="Index_Run.php?Run=Login_Data&page='.$i.'">'.$i.'</a></li>';
							     } 
							   ?>
							  <?php if($page==$Page_Num) echo '<li class="am-disabled">';?><a href="Index_Run.php?Run=Login_Data&page=<?php echo $page+1 ?>">下一页</a></li>
                </ul>
              </div>
                             
            </div>
            
            
            <hr />
            <p>注：如发现异常登录或多次连续错误登录请及时修改密码并于运维人员联系Ban&nbsp;IP地址</p>        
              </p>                      
             </div>
        </div>
        </div>
    
    
    </div>
    <!-- 页面内容结束 -->
    


