var tab=[];
if(window.location.pathname=="/ScreenDayPro2/profile.php"){
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
xhr.open("GET","php/images.php",true)
xhr.send();
   
}