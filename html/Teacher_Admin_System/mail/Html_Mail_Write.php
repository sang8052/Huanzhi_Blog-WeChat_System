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
               <h3 class="am-panel-title">新建消息</h3>
             </div>
             <div class="am-panel-bd">
             	<form action="Index_Run.php?Run=Mail_Write_Fun" method="post" onsubmit="return Mail_check()">
             	<table border="0" class="am-table am-table-striped am-table-hover table-main">
             		<tr><td width="150" align="center">收件人</td><td width="800"><input name="get_username" type="text"  id="get_username" style="width: 250px;"></td></tr>
             	    <tr><td width="150" align="center">标题</td><td width="800"><input name="title" type="text" id="title" style="width: 500px;"></td></tr>
             	    <tr><td width="150" align="center">内容</td><td width="800">
             	    	<textarea name="content" id="content" ></textarea>
             	    	<script type="text/javascript"src="<?php echo $FIEL_URL?>ueditor/ueditor.config.js"></script>  
                        <script type="text/javascript"src="<?php echo $FIEL_URL?>ueditor/ueditor.all.js"></script> 
             	    	<script type="text/javascript">  
                     
                       var ue=UE.getEditor('content');  
                        </script> 

             	    	
             	    </td></tr>
             	    <tr><td colspan="2" align="center"><table border="0"><tr><td><button  type="submit" class="am-btn am-btn-default am-btn-xs am-text-primary am-hide-sm-only" ><span class="am-icon-send" ></span>发送消息</button></td><td><button  type="button" onclick="Mail_Write_Reset()" class="am-btn am-btn-default am-btn-xs am-text-warning am-hide-sm-only"><span class="am-icon-refresh"></span>全部重置</button></td></tr></table></td></tr>
             	</table></form><hr/>
              <p>注：因手机页面和电脑页面存在大小差异，故站内消息在学生端可能会有略微格式差异。</p>                      
             </div>
        </div>
        </div>
    
    
    </div>
   