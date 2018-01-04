<!-- 页面内容开始 -->
  <div class="admin-content">
    <div class="admin-content-body">
      <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">站内消息</strong>/<small>写消息</small></div>
      </div>
      <hr/>
 
      
      <div class="am-g">
      	 <div class="am-u-sm-9  am-u-end">
          <div class="am-panel am-panel-default">
             <div class="am-panel-hd am-panel-secondary">
               <h3 class="am-panel-title">阅读消息</h3>
             </div>
             <div class="am-panel-bd">
             
             <?php 
             if(isset($_GET['id']))
			 {
			 	 $sql=sprintf("select * from mail where id = '%s '",$_GET['id']);
                 $data_get=new Mysql_get($sql);
                 $row_check=$data_get->Get_Result(); 
				
				 if($row_check['get_username']==$_SESSION['username']) 
				 {
				 	$Mail_Type='get'; $row=$row_check;
					$sql=sprintf("update mail set get_read='1' where id = '%s '",$_GET['id']);
                    $data_get=new Mysql_get($sql);
				 }
				 else if($row_check['send_username']==$_SESSION['username']) {$Mail_Type='send';$row=$row_check;}
                 else  {$echo='<script language="javascript">{ window.location.href="../../Echo_Error.php?error=1006";} </script>';echo $echo;}
				
			}
			 else
			 	{
			 		{$echo='<script language="javascript">{ window.location.href="../../Echo_Error.php?error=1005";} </script>';echo $echo;}
			 	}
			
             ?>
             	<table border="1" class="am-table am-table-striped am-table-hover table-main">
             		<tr><td width="150" align="center"><?php if($Mail_Type=='send') echo '收件人'; else echo '发件人' ; ?></td><td width="800"><input name="get_username" type="text"  id="get_username" style="width: 250px;" value="<?php if($Mail_Type=='send') echo $row['get_username']; else echo $row['send_username'] ; ?>" disabled="disabled"></td></tr>
             	    <tr><td width="150" align="center">标题</td><td width="800"><input name="title" type="text" id="title" style="width: 500px;" value="<?php echo $row['title']; ?>" disabled="disabled"></td></tr>
             	    <tr><td width="150" align="center">发送时间</td><td width="800"><input name="get_username" type="text"  id="get_username" style="width: 250px;" value="<?php echo $row['time'];  ?>" disabled="disabled"></td></tr>
             	    <tr><td width="150" align="center">内容</td><td width="800">
             	    	
<?php echo $row['content']; ?>
             	    	
             	    </td></tr>
             	  
             	</table><hr/>
              <p>注：因手机页面和电脑页面存在大小差异，故站内消息在学生端可能会有略微格式差异。</p>                      
             </div>
        </div>
        </div>
    
    
    </div>
   