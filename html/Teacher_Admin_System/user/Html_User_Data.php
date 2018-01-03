<!-- 页面内容开始 -->
  <div class="admin-content">
    <div class="admin-content-body">
      <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">个人信息</strong></div>
      </div>
      
      <div class="am-g">
      	 <div class="am-u-lg-3  am-u-end">
          <div class="am-panel am-panel-default">
             <div class="am-panel-hd am-panel-secondary">
               <h3 class="am-panel-title">密码重置</h3>
             </div>
             <div class="am-panel-bd">
              <p><form action="Index_Run.php?Run=User_Data&post=pass" method="post" onsubmit="return Pass_Relcheck()">
              	<table border="0" align="center" width="300">
              		<tr><td align="center" colspan="2">修改登录密码</td></tr>
              		<tr><td align="left" width="80">原密码:</td><td><input name="Old_Pass" type="password"  width="20"></td></tr>
              		<tr><td align="left" width="80">新密码:</td><td><input name="New_Pass" id="New_Pass" type="password" width="20"></td></tr>
              		<tr><td align="left" width="80">重复密码:</td><td><input name="New_Pass_check" id="New_Pass_check"  type="password" width="20"></td></tr>
              		<tr><td colspan="2" align="center"><input type="submit" value="修改密码" onclick="return Pass_Relcheck()">&nbsp;&nbsp;<input type="reset" value="全部清除"></td></tr>
              		</table>
              </form>
             <script src="<?php echo $FIEL_URL?>js/Pass_check.js"></script>
              </p>
              <hr/><p><font color="red">注:密码中必须包含字母、数字、特称字符，长度在8-16位之间</font></p>    
             </div>
        </div>
        </div>
        <div class="am-u-lg-6  am-u-end">
          <div class="am-panel am-panel-default">
             <div class="am-panel-hd am-panel-secondary">
               <h3 class="am-panel-title">用户信息</h3>
             </div>
             <div class="am-panel-bd">
              <p>
              	<?php 
              		$sql="select * from user_teacher where username ='".$_SESSION['username']."'";
                    $data_get=new Mysql_get($sql);
                    $row=$data_get->Get_Result();
              		?><form action="?Run=User_Data&post=data" method="post">
              <table border="1" align="center">
              	<caption>用户&nbsp;<?php echo $_SESSION['username']?>&nbsp;的个人信息</caption>
              	<tr><td>姓名:</td><td><?php echo $row['name'] ?></td><td rowspan="3" align="middle">照片</td><td rowspan="3" align="middle" width="150" height="210"><img  src="<?php if($row['photo']=='') echo $FIEL_URL.'img/people_demo.png'; else echo $row['photo'] ;?>"></td></tr>
              		<tr><td>性别：</td><td><?php echo $row['sex'];?></td></tr>
              		<tr><td>教授课程：</td><td align="center" width="350"><input  name="lesson" type="text" value="<?php echo $row['lesson'];?>" style="width:335px;"></td></tr>
              		<tr><td>个性签名：</td><td colspan="3" align="center"><textarea name="signs" cols="70" rows="5"><?php echo $row['signs']; ?></textarea></td></tr>
              		<tr><td align="center" colspan="4">	<input type="submit" value="修改信息" > </td></tr>
              		</table>
              		</from>
              </p>                      
             </div>
           

        </div>
        </div>
      </div>