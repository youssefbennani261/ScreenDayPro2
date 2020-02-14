function verification(){
  var xhr=new XMLHttpRequest();
  xhr.onreadystatechange=function(){
   if(this.status==200 && this.readyState==4){
 var cas =this.response;
   if(cas==0)
    alert("Username or Password Incorrect");
    else
     alert("Password Modifier avec Succes");
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