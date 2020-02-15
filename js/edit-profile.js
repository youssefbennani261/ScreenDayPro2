function verification(){
  var xhr=new XMLHttpRequest();
  xhr.onreadystatechange=function(){
   if(this.status==200 && this.readyState==4){
 var cas =this.responseText;
   if(cas==0){
   document.getElementById("user").style.borderBottom=' 1px red solid';
   document.getElementById("pw").style.borderBottom=' 1px red solid';}
    else if(cas==1)
     alert("Password Modifier avec Succes");
     location.reload();
   }
  }
  var op=1;
  var user=document.getElementById("user").value;
  var pw=document.getElementById("pw").value;
  var pwafter=document.getElementById("pwafter").value;
  xhr.open("POST","php/edit-profile.php",true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
   var data="op="+op+"&user="+user+"&pw="+pw+"&pwafter="+pwafter;
   xhr.send(data);
    }