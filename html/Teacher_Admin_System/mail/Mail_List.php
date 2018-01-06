<!-- 页面内容开始 -->
<?php
if(!is_file("../../Safe_Check.php"))
{
	$echo='<script language="javascript">{ window.location.href="../../Echo_Error.php?error=1007";} </script>';echo $echo;
}
?>
<?php 
    if($_GET['Run']=="Mail_New") 
    {
    	$Mail_Type="未读消息";
		$sql_where=sprintf("get_username='%s' and get_read='0' and get_show='1'",$_SESSION['username']);
    }
    if($_GET['Run']=='Mail_Send')
    {
    	$Mail_Type='发件箱';
		$sql_where=sprintf("send_username='%s' and send_show='1'",$_SESSION['username']);
    } 
	if($_GET['Run']=='Mail_Get')
	 {
	 	$Mail_Type='收件箱';
		$sql_where=sprintf("get_username='%s' and  get_show='1'",$_SESSION['username']);
	 }
?>
  <div class="admin-content">
    <div class="admin-content-body">
      <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">站内消息</strong>/<small><?php echo $Mail_Type ?></small></div>
      </div>
      <hr/>
 
      
      <div class="am-g">
      	 <div class="am-u-sm-9  am-u-end">
          <div class="am-panel am-panel-default">
             <div class="am-panel-hd am-panel-secondary">
               <h3 class="am-panel-title"><?php echo $Mail_Type ?></h3>
             </div>
             <div class="am-panel-bd">
             	
             	<table border="0" class="am-table am-table-striped am-table-hover table-main">
              <thead><tr><th class="table-id">ID</th><th class="table-title"><?php if($Mail_Type=='发件箱') echo '收件人'; else echo '发件人'; ?></th><th class="table-type">主题</th><th class="table-author am-hide-sm-only">发送时间</th><th class="table-date am-hide-sm-only">状态</th><th class="table-set">操作</th></tr></thead>
             	  <tbody>
            <?php
            
            $sql="select * from mail where ".$sql_where." order by id desc";
            $data_get=new Mysql_get($sql);
			$row_num=$data_get->GetRowNum();
			$Page_Show_Num=15;     //设置每页显示 15 条记录
			$Page_Num=ceil($row_num/$Page_Show_Num);
			if(isset($_GET['page']))$page=$_GET['page'];
            else $page=1;
			$row_start=($page-1)*$Page_Show_Num;
			$sql=sprintf("select * from mail where %s order by id desc limit %s,%s",$sql_where,$row_start,$Page_Show_Num);
            $data_get=new Mysql_get($sql);
            $row=$data_get->GetResult(); 
            $row_show=$data_get->GetRowNum();
			for($i=1;$i<=$row_show;$i++)
			{
				echo '<tr><td class="am-hide-sm-only">'.$i.'</td><td>';           //编号
				
				if($Mail_Type=='发件箱') echo $row[$i]['get_username'].'</td>';   //收件人/发件人
				else echo $row[$i]['send_username'].'</td>'; 
				
				echo '<td class="am-hide-sm-only"><a href="Index_Run.php?Run=Mail_Show&id='.$row[$i]['id'].'">'.$row[$i]['title'].'</td>';        //主题
				
				echo '<td class="am-hide-sm-only">'.$row[$i]['time'].'</td>'; 
				if($Mail_Type=='发件箱') 
				 { if($row[$i]['get_read']==1)
				 	echo '<td class="am-hide-sm-only" ><font color="green">对方已读消息</font></td>'; 
				   else
				   	echo '<td class="am-hide-sm-only" ><font color="red">对方尚未阅读</font></td>'; 
				 }
				else
				{
					if($row[$i]['get_read']==1)
				 	echo '<td class="am-hide-sm-only" ><font color="green">已读消息</font></td>'; 
				   else
				   	echo '<td class="am-hide-sm-only" ><font color="red">未读消息</font></td>'; 
				}
				
				echo '<td class="am-hide-sm-only"><a href="Index_Run.php?Run=';
				if($Mail_Type=='发件箱')  echo 'Mail_Del_Send';
				else echo 'Mail_Del_Get';
				echo '&id='.$row[$i]['id'].'"><button type="button" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</button></a></td></tr>';  //删除邮件
				
			}
            ?>  	
             </tbody>
             	</table><hr/>
                        <div class="am-cf">
                         共 <?php echo $row_num;?>条记录
               <div class="am-fr">
                <ul class="am-pagination">
                 <?php if($Page_Num==0)$Page_Num=1;if($page==1) echo '<li class="am-disabled">';?><a href="Index_Run.php?Run=&page=<?php echo $page-1 ?>">上一页</a></li>
                 <?php 
                 for($i=1;$i<=$Page_Num;$i++)
				             { 	  if($i==$page) echo '<li class="am-active">';
							          	 else echo '<li>';
									     echo '<a href="Index_Run.php?Run='.$_GET['Run'].'&page='.$i.'">'.$i.'</a></li>';
							     } 
							   ?>
							  <?php if($page==$Page_Num) echo '<li class="am-disabled">';?><a href="Index_Run.php?Run=<?php echo $_GET['Run'] ?>&page=<?php echo $page+1 ?>">下一页</a></li>
                </ul>
              </div>         
             </div>
        </div>
        </div>
    </div>
    
    </div>