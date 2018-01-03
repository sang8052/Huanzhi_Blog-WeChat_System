 function Pass_Relcheck() {
                var reg=new RegExp('(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[^a-zA-Z0-9]).{8,16}'); 
                var New_Pass=document.getElementById("New_Pass").value; 
                var New_Pass_check=document.getElementById("New_Pass_check").value;
                if(!reg.test(New_Pass)){
                	alert("新密码中必须包含字母、数字、特称字符，长度在8-16位之间!"); 
                    return false; }
                if (New_Pass_check != New_Pass||New_Pass_check==0) 
                { 
              alert("两次密码输入不一致"); return false; 
                 } 
              return true; 
               } 