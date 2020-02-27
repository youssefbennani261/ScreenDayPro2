function changerPassword(){
  var xhr=new XMLHttpRequest();
  xhr.onreadystatechange=function(){
   if(this.status==200 && this.readyState==4){
 var cas =this.responseText;
   if(cas==0){
   document.getElementById("user").style.borderBottom=' 1px red solid';
   document.getElementById("pw").style.borderBottom=' 1px red solid';}
    else if(cas==1){
       alert("Password Modifier avec Succes");
     location.reload();
    }
    
   }
  }
  var op=1;
  var user=document.getElementById("user").value;
  var pw=document.getElementById("pw").value;
  var pwafter=document.getElementById("pwafter").value;
  xhr.open("POST","../php/edit-profile.php",true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
   var data="op="+op+"&user="+user+"&pw="+pw+"&pwafter="+pwafter;
   xhr.send(data);
    }


    function changerinfo(){
      var xhr=new XMLHttpRequest();
      xhr.onreadystatechange=function(){
       if(this.status==200 && this.readyState==4){
     var cas =this.responseText;
  
       if(cas==-1){
      alert("il ñ'y a pas modification ");
       }
        if(cas==1){
           alert("Modification avec Succes ");
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

