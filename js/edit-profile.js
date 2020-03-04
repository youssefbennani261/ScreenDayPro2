function changerPassword(){
  var xhr=new XMLHttpRequest();
  xhr.onreadystatechange=function(){
   if(this.status==200 && this.readyState==4){
 var cas =this.responseText;
   if(cas==1){
   document.getElementById("user").style.borderBottom=' 1px red solid';
   document.getElementById("pw").style.borderBottom=' 1px red solid';}
    else if(cas==0){
      $.notify({ 
        message: " Demande Envoyer avec Succes  ",
      },
      {
            type: 'success'
        });
     location.reload();
    }

   }
  }
  var op=1;
  var user=document.getElementById("user").value;
  var pw=document.getElementById("pw").value;
  xhr.open("POST","../php/edit-profile.php",true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
   var data="op="+op+"&user="+user+"&pw="+pw;
   xhr.send(data);
    }


    function changerinfo(){

      var xhr=new XMLHttpRequest();
      xhr.onreadystatechange=function(){
       if(this.status==200 && this.readyState==4){
     var cas =this.responseText;
  
       if(cas==-1){
     
      $.notify({ 
        message: " il ñ'y a pas modification ",
      },
      {
            type: 'warning'
        });
       }
      if(cas==1){
        
           $.notify({ 
            message: "Modification avec Succes",
          },
          {
                type: 'success'
            });
         location.reload();
        }
        
       }
      }
      var op=2;
      var nom=document.getElementById("nomriad").value;
      var directeur=document.getElementById("Directeur").value;
      var email=document.getElementById("email").value;
      var Detail=document.getElementById("Detail").value;
      var adresse=document.getElementById("adresse").value;
      xhr.open("POST","../php/edit-profile.php",true);
      xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
       var data="op="+op+"&nomriad="+nom+"&Directeur="+directeur+"&email="+email+"&adresse="+adresse+"&Detail="+Detail;
       xhr.send(data);
        }

    function editpasse(){
      var user =document.getElementById("user").value;
      var pw =document.getElementById("pw").value;
      var pwafter =document.getElementById("pwafter").value;
      var xhr=new XMLHttpRequest();
      xhr.onreadystatechange=function(){
             if(this.status==200 && this.readyState==4)
             {
                var cas=this.responseText;
                if(cas==1){
                 $.notify({ 
                     message: " Mot de passe Modifier Avec Succes ",
                   },
                   {
                         type: 'success'
                     });
                     window.location.href="index.php";
                     
                }else
               {
                 $.notify({ 
                     message: " Login ou le mot de passe incorrect ",
                   },
                   {
                         type: 'danger'
                     });
               }
     
             }
             }
             if(user!="" && pw!=""&& pwafter!=""){
                 
                 xhr.open("POST","../php/edit-profile.php",true);
                 xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");  
                 xhr.send("op=3&user="+user+"&pw="+pw+"&pwafter="+pwafter);
                 }
                 if(user=="" ) 
                 document.getElementById("user").style.border=' solid 1px red';
                else
                  document.getElementById("user").style.border="#CCD4DA solid 1px";
                if(pw=="" ) 
                 document.getElementById("pw").style.border=' solid 1px red';
                 else
                 document.getElementById("pw").style.border="#CCD4DA solid 1px";  
                 if(pwafter=="" ) 
                 document.getElementById("pwafter").style.border=' solid 1px red';
                 else
                 document.getElementById("pwafter").style.border="#CCD4DA solid 1px";  
     


    }


