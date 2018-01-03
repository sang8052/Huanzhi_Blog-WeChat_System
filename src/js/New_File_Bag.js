 function New_File_Bag()
 {
 	var reg=new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\s]*$" );
 	var bag= prompt("请输入文件夹名称，只能使用英文字母、数字、下划线和中文,且文件夹名称不能为Home");
 	if (reg.test(bag))
 	{
 		if(bag=="Home")
 		{
 			alert ("文件夹名称不能为Home");
 		}
 		else {window.location.href="Index_Run.php?Run=Cloud_File&Action=New&Bag_Name="+bag;}
 	}
 	else
 	{
 		alert ("文件夹名称只能使用英文字母、数字、下划线和中文!");
 	}
 	
 	return true;
 }
