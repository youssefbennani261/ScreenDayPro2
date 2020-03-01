if(window.location.pathname=="/ScreenDayPro2/pages/edit_profile-agence.php"){
 function saveinfo(){
    var chain= new RegExp("^[a-z]+[ \-']?[[a-z]+[ \-']?]*[a-z]+$");
    var tel= new RegExp("[0-9]{10,15}");
    var Email1 = new RegExp("[^@ \t\r\n]+@[^@ \t\r\n]+\.[^@ \t\r\n]+");
       var bdinfo=document.querySelectorAll(".info");
        var cas =0;
        var data="op=1";
       for(i=0;i<bdinfo.length;i++){
         if(bdinfo[i].id=="email"){
               if(Email1.test(bdinfo[i].value) && bdinfo[i].value!=""){
                     cas++;
                     data+="&email="+bdinfo[i].value;
                     bdinfo[i].style.border="#CCD4DA solid 1px";
         }else
          bdinfo[i].style.border="red solid 1px";
         }else if(bdinfo[i].id=="telephone"){
                  if(tel.test(bdinfo[i].value)){
                        cas++;
                        data+="&tel="+bdinfo[i].value;
                        bdinfo[i].style.border="#CCD4DA solid 1px";
         }else
            bdinfo[i].style.border="red solid 1px";
         }
          else if(bdinfo[i].id=="adresse"){
                    if( bdinfo[i].value!=""){
                     cas++;
                     data+="&"+bdinfo[i].id+"="+bdinfo[i].value;
                     bdinfo[i].style.border="#CCD4DA solid 1px";
                     }else
                     bdinfo[i].style.border="red solid 1px";
         } else{
    
            if(chain.test(bdinfo[i].value)){
                     cas++;
                     data+="&"+bdinfo[i].id+"="+bdinfo[i].value;
                     bdinfo[i].style.border="#CCD4DA solid 1px";
                     }else
                     bdinfo[i].style.border="red solid 1px";
                     }
          }
        if(cas==5){
                    saveinfoserveur(data);    
    }    

 }

      function saveinfoserveur(data){

         var xhr= new  XMLHttpRequest();
         xhr.onreadystatechange=function(){
         if(this.status==200 && this.readyState==4){
               var tab = this.response; 
            if(tab==1){
            $.notify({
      message:"modification avec succes ",
            },
            {
               type:'success'
            });




            }
         
         }
      }
         xhr.open("POST","../php/edit_agence.php",true);
         xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");  
         xhr.send(data);
      }


      function chengerpassword(){
         var xhr =new XMLHttpRequest();
       var pw= document.getElementById("pw").value;
        var pwafter=document.getElementById("pwafter").value;
        var login=document.getElementById("user").value;
         xhr.onreadystatechange=function(){
               if(this.status==200 && this.readyState==4){
                  var rep= this.responseText;
                  if(rep==1)
                  alert(" mot de passe charger avec succes");
                   else
                    alert("!!!!!!!!!!!");
               }
         }
         if(pw!="" && pwafter!=""&& user!=""){
             xhr.open("POST","../php/edit_agence.php",true);
         xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");  
         xhr.send("op=2$user=")+user+"&pw="+pw+"$pwafter="+pwafter;
         }
        
      }


      $(document).on('click', '#sendfile', function(){
         var name = document.getElementById("fileup").files[0].name;
         var form_data = new FormData();
         var ext = name.split('.').pop().toLowerCase();
         if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
         {
          alert("Format d'image Invalide");
         }
         var oFReader = new FileReader();
         oFReader.readAsDataURL(document.getElementById("fileup").files[0]);
         var f = document.getElementById("fileup").files[0];
         var fsize = f.size||f.fileSize;
         if(fsize > 2000000)
         {
          alert("La taille d'image est grande");
         }
         else
         {
          form_data.append("file", document.getElementById('fileup').files[0]);
          $.ajax({
           url:"../php/edit_agence.php",
           method:"POST",
           data: form_data,
           contentType: false,
           cache: false,
           processData: false,
          
          });
          window.location.reload();
         }
        });
      
  }


     

