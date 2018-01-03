<?php
if($_GET['Action']!='Search')
{
   if($_GET['Action']=='Show')
     {
	if(!isset($_GET['File_Bag']))
    {
   	 $File_Bag="Home";
   	 unset($_SESSION['File_Bag']);
	 $_SESSION['File_Bag'][0]=1;
	 $_SESSION['File_Bag'][1]=$File_Bag;
	}
   else
   	{
   		echo "ok";
   	 $i=$_SESSION['File_Bag'][0];
   	 $File_Bag=$_GET['File_Bag'];
	 if($File_Bag!=$_SESSION['File_Bag'][$i])
   	 $_SESSION['File_Bag'][0]++;$j=$_SESSION['File_Bag'][0];
	 $_SESSION['File_Bag'][$j]=$File_Bag;
   	}
   }

   if($_GET['Action']=='Show-')
  {
	$i=$_SESSION['File_Bag'][0];$j=$i-1;
	$File_Bag=$_SESSION['File_Bag'][$j];
	$_SESSION['File_Bag'][0]--;
	unset($_SESSION['File_Bag'][$i]);
   }
   $sql=sprintf("select * from file_share where username='%s' and uplocal ='%s' and type='bag' order by id  ",$_SESSION['username'],$File_Bag);
   $data_get=new Mysql_get($sql);
   $row=$data_get->GetResult(); 
  
   $row_show=$data_get->GetRowNum();
   $sql=sprintf("select * from file_share where username='%s' and uplocal ='%s' and type='file' order by id  ",$_SESSION['username'],$File_Bag);
   $data_get=new Mysql_get($sql);
   $row_file=$data_get->GetResult(); 
   
   $row_file_show=$data_get->GetRowNum();
   
}
else
{
$sql="select * from file_share where username='".$_SESSION['username']."' and filename like '%".$_POST['File_Name']."%' order by id desc ";
            echo $sql;
            $data_get=new Mysql_get($sql);
            $row=$data_get->GetResult(); 
            $row_show=$data_get->GetRowNum();
}

?>
<div class="admin-content">
    <div class="admin-content-body">
      <div class="am-cf am-padding am-padding-bottom-0">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">资源共享</strong> / <small>网络硬盘</small></div>
      </div>

      <hr>

     
      
      
  <div class="am-g">
      	 <div class="am-u-sm-12  am-u-end">
          <div class="am-panel am-panel-default">
             <div class="am-panel-hd am-panel-secondary">
               <h3 class="am-panel-title">
               	<?php 
               	if($_GET['Action']=="Search")
               	{
               		echo "文件--".$_POST['File_Name']."--搜索结果：";
               	}
               else
               {echo "当前目录：";
               	$j=$_SESSION['File_Bag'][0];
				for($i=1;$i<=$j;$i++)
				{
					echo  $_SESSION['File_Bag'][$i].'/';
				}
               	}?>
               	</h3>
             </div>
             <div class="am-panel-bd">
        
          <div class="am-u-sm-12 am-u-md-4 am-u-end">
          <div class="am-btn-toolbar">
            <div class="am-btn-group am-btn-group-xs">
              <button type="button" onclick="location.href='Index_Run.php?Run=Cloud_File&Action=Show'" class="am-btn am-btn-default"><span class="am-icon-home"></span>返回根目录 </button>
              <button type="button" onclick="location.href='Index_Run.php?Run=Cloud_File&Action=Show-'" class="am-btn am-btn-default"><span class="am-icon-mail-reply"></span> 返回上一层</button>
              <button type="button" class="am-btn am-btn-default" onclick="New_File_Bag()"><span class="am-icon-plus"></span> 新建文件夹</button>
               
            </div>
          </div>
        </div>
        
        <div class="am-u-sm-12 am-u-md-5 am-u-end">
          <div class="am-input-group am-input-group-sm">
          	<form name="uploadfile" action="Index_Run.php?Run=Cloud_File_Upload" method="post" enctype="multipart/form-data">
          		<table border="0"><tr><td> <input type="file" class="am-form-field" name="File_Upload" id="File_Upload"></td><td> <button class="am-btn am-btn-default" type="submit">上传文件到该目录下</button></td></tr></table>
           </form>
          </div>
        </div>
      
      
        
        <div class="am-u-sm-12 am-u-md-3 am-u-end">
          <div class="am-input-group am-input-group-sm">
          	<form name="Serach_file" action="Index_Run.php?Run=Cloud_File&Action=Search" method="post">
            <table border="0"><tr><td><input type="text" class="am-form-field" name="File_Name"></td><td><button class="am-btn am-btn-default" type="submit">搜索</button></td></tr></table>
       </form>
          </div>
        </div>
            
               <table class="am-table am-table-striped am-table-hover table-main">
              <thead>
              <tr>
               <th class="table-id">ID</th><th class="table-title">文件名</th><th class="table-title">类型</th><th class="table-type">大小</th><th class="table-author am-hide-sm-only">上传时间</th><th class="table-date am-hide-sm-only">操作</th>
              </tr>
              </thead>
              <tbody>
                <?php
                     
                  for($i=1;$i<=$row_show;$i++)
			{
				if($row[$i]['size']>=1024){$b=sprintf('%.2f MB',$row[$i]['size']/1024);}
				else $b=sprintf('%.2f KB',$row[$i]['size']);
				$row[$i]['size']=$b;
				echo '<tr><td class="am-hide-sm-only">'.$i.'</td>'; //编号
				echo '<td class="am-hide-sm-only"><a href="Index_Run.php?Run=Cloud_File&Action=Show&File_Bag='.$row[$i]['filename'].'">'.$row[$i]['filename'].'</a></td>';  //文件名（下载地址）
			    echo '<td class="am-hide-sm-only">文件夹</td>'; //类型
			    echo '<td class="am-hide-sm-only"></td>'; //大小
				echo '<td class="am-hide-sm-only">'.$row[$i]['time'].'</td>'; //时间
			    echo '<td class="am-hide-sm-only">';
			    echo '<a href="Index_Run.php?Run=Cloud_File_Del&id='.$row[$i]['id'].'"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</button></a></td></tr>'; //删除
				
                			
			}                
			  for($i=1;$i<=$row_file_show;$i++)
			{
				echo '<tr><td class="am-hide-sm-only">'.($row_show+$i).'</td>'; //编号
				if($row_file[$i]['size']>=1024){$b=sprintf('%.2f MB',$row_file[$i]['size']/1024);}
				else $b=sprintf('%.2f KB',$row_file[$i]['size']);
				$row_file[$i]['size']=$b;
				
					 echo '<td class="am-hide-sm-only"><a href="'.$row_file[$i]['ossurl'].'">'.$row_file[$i]['filename'].'</a></td>';  //文件名（下载地址）
					 echo '<td class="am-hide-sm-only">文件</td>'; //类型
			         echo '<td class="am-hide-sm-only">'.$row_file[$i]['size'].'</td>'; //大小
				     echo '<td class="am-hide-sm-only">'.$row_file[$i]['time'].'</td>'; //时间
					 echo '<td class="am-hide-sm-only"><table border="0"><tr><td><button class="am-btn am-btn-default am-btn-xs am-text-primary am-hide-sm-only  " onclick="URL_SHOW(\''.$row_file[$i]['ossurl'].'\')"><span class="am-icon-cloud-download"></span> 下载地址</button></td><td>';
					 echo '<a href="Index_Run.php?Run=Cloud_File_Del&id='.$row_file[$i]['id'].'"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</button></a></td></tr></table></td></tr>'; //删除
				    
                			
			}                
                ?>
             </tbody>
            </table>
             <div class="am-cf">
             <p>共<?php echo $row_show+$row_file_show; ?> 条数据</p>          
            </div>
                             
            </div>
           </div>
           </div>
           </div>
      
	
