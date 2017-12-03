
  function agree(){
       if(document.getElementById('radio_confirm').checked)
              document.getElementById('button_submit').disabled=false;
    else
        document.getElementById('button_submit').disabled='disabled';  
  }   

