 var ipt = document.getElementById('picupload'),
     img = document.getElementById('picview'),
     picdata=document.getElementById('picdata'),
     picname=document.getElementById('picname'),
     Orientation = null;
     ipt.onchange = function () 
     {
                var file = ipt.files[0],
                    reader = new FileReader(),
                    image = new Image();
                    
        if(file)
        {
                	    EXIF.getData(file, function(){Orientation = EXIF.getTag(this, 'Orientation');});
                        reader.onload = function (ev) {
                    	image.src = ev.target.result; 
                    	image.onload = function () {
                        var imgWidth = this.width,
                        imgHeight = this.height;
                        imgWidth = 290;
                        imgHeight = Math.ceil(290 * this.height / this.width);
                             
                            
                            
                            var canvas = document.createElement("canvas"),
                            ctx = canvas.getContext('2d');
                            canvas.width = imgWidth;
                            canvas.height = imgHeight;
                            if(Orientation && Orientation != 1){
                                switch(Orientation){
                                    case 6:
                                        canvas.width = imgHeight;    
                                        canvas.height = imgWidth;    
                                        ctx.rotate(Math.PI / 2);    
                                        ctx.drawImage(this, 0, -imgHeight, imgWidth, imgHeight);
                                        break;
                                    case 3:
                                        ctx.rotate(Math.PI);    
                                        ctx.drawImage(this, -imgWidth, -imgHeight, imgWidth, imgHeight);
                                        break;
                                    case 8:
                                        canvas.width = imgHeight;    
                                        canvas.height = imgWidth;    
                                        ctx.rotate(3 * Math.PI / 2);    
                                        ctx.drawImage(this, -imgWidth, 0, imgWidth, imgHeight);
                                        break;
                                }
                             }
                            else{
                                ctx.drawImage(this, 0, 0, imgWidth, imgHeight);
                                }
                            img.src = canvas.toDataURL("image/jpeg", 1);
                            picdata.value=img.src;
                            picname.value=file.name;
                            
                            
  
function getFileName(o){
    var pos=o.lastIndexOf("\\");
    return o.substring(pos+1);  
}
                          }
                        };
                    reader.readAsDataURL(file);
            }
      }