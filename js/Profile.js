var tab=[];
$("#demandes").removeClass("active open");
$("#dashboard").removeClass("active open");
$("#messagerie").removeClass("active open");
$("#profil").addClass("active open");
function getNotification(){
   $.get("../php/riad.php",{op:8},function(data){ 
       let tab=JSON.parse(data);
       console.log(tab);
       let s="";
       for(let i=0;i<tab.length;i++){
          if(i==0){
           s+=`<li>
           <a href="http://localhost:8080/ScreenDayPro2/pages/demande.php">
               <div class="icon-circle bg-blue"><i class="zmdi zmdi-account"></i></div>
               <div class="menu-info">
                   <h4>${parseInt(tab[i].nbr)>1 ? `${tab[i].nbr} Nouvelles demande` :`${tab[i].nbr} Nouvelle demandes`}</h4>
                   <p>${tab[i].nom}</p>
               </div>
           </a>
       </li>`;
       }
      else if(i==1){
         s+=`<li>
         <a href="http://localhost:8080/ScreenDayPro2/pages/demande.php">
             <div class="icon-circle bg-blue"><i class="zmdi zmdi-email"></i></div>
             <div class="menu-info">
                 <h4>${parseInt(tab[i].nbr)>1 ? `${tab[i].nbr} Nouvelles message` :`${tab[i].nbr} Nouvelle messages`}</h4>
                 <p>${tab[i].nom}</p>
             </div>
         </a>
     </li>`;
       }
      }
       
       $("#noti").html(s);
   })
}
getNotification();
if(window.location.pathname=="/ScreenDayPro2/pages/profile.php"){
  var xhr=new XMLHttpRequest();
   xhr.onreadystatechange=function(){
       if(this.status==200 && this.readyState==4){
        tab=JSON.parse(this.response);
        console.log(tab);
     for(i=0;i<tab.length;i++)
      {
     document.getElementById("aniimated-thumbnials").innerHTML+="<div class='col-xl-4 col-lg-6 col-md-6 col-sm-12 m-b-30'> <a href='"+tab[i].src+"'> <img class='img-fluid img-thumbnail' src='"+tab[i].src+"' alt=''> </a> </div>";
   
                            
      }


   }

   }
   
xhr.open("GET","../php/images.php",true)
xhr.send();


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
     url:"../php/upload.php",
     method:"POST",
     data: form_data,
     contentType: false,
     cache: false,
     processData: false,
    
    });
   //  location.reload();
   window.location.reload();
   }
  });
}