function ajouteragence(){
    var cas =0;
    var data = "op="+1;
    var dbprix=[];
    ////////////////////////////////////////////////////
    var email;
    var pw;
    var chain= new RegExp("^[a-zA-Z]*$");
    var tel= new RegExp("[0-9]{10,15}");
    var Email1 = new RegExp("[^@ \t\r\n]+@[^@ \t\r\n]+\.[^@ \t\r\n]+");
    var bdinfo =document.querySelectorAll(".info");
    var bdsuc=document.querySelectorAll(".info-suc");
    var bdch=document.querySelectorAll(".prix");
    var dbid=document.querySelectorAll(".prix-ch");
    
      for(i=0;i<bdinfo.length;i++){
         if(bdinfo[i].id=="email"){
          if( Email1.test(bdinfo[i].value))
             {
                 ++cas;
                  data+="&email="+bdinfo[i].value;
                  bdinfo[i].style.border="#CCD4DA solid 1px";
                  email=bdinfo[i].value;
             } else
             {
                bdinfo[i].style.border=" 2px solid red";
             } 
        
         }else if(bdinfo[i].id=="telephone"){
              if( tel.test( bdinfo[i].value))
                {
                ++cas;
                data+="&telephone="+bdinfo[i].value;
                bdinfo[i].style.border="#CCD4DA solid 1px";
                }else{
                    bdinfo[i].style.border=" 2px solid red";
                }
         }else if(bdinfo[i].id=="dateinscription"){
              if( bdinfo[i].value!="")
                {
                ++cas;
                data+="&dateinscription="+bdinfo[i].value;
                bdinfo[i].style.border="#CCD4DA solid 1px";
                }else{
                    bdinfo[i].style.border=" 2px solid red";
                }
         }else {
        if(chain.test(bdinfo[i].test) && bdinfo[i].value!="")
        {
                ++cas;
                 data+="&"+bdinfo[i].id+"="+bdinfo[i].value;
                 bdinfo[i].style.border="#CCD4DA solid 1px";
        }else
                  bdinfo[i].style.border=" 2px solid red";
          
         }
          
      }
    for(i=0;i<bdsuc.length;i++)
    {
        if(bdsuc[i].id=="pw" ){
            if(bdsuc[i].value!=""){
                ++cas;
                bdsuc[i].style.border="#CCD4DA solid 1px";
            }else{
                bdsuc[i].style.border=" 2px solid red";
            }
        } else if(bdsuc[i].id=="pwconferm" && bdsuc[i].value!="" ){
            if(bdsuc[i].value==bdsuc[i-1].value){
                ++cas;
                pw=bdsuc[i].value;
                data+="&motdepasse="+bdsuc[i].value;
                bdsuc[i].style.border="#CCD4DA solid 1px";
            }else{
                bdsuc[i].style.border=" 2px solid red";
            }
        }else
        {
            if(bdsuc[i].value!=""){
                cas++;
                data+="&login="+bdsuc[i].value;
                bdsuc[i].style.border="#CCD4DA solid 1px";
            }else
            bdsuc[i].style.border=" 2px solid red";
    
        }
    
    
    }
    
    for(i=0;i<bdch.length;i++){
       if(bdch[i].value!=0){
          dbprix.push({idch:parseInt(dbid[i].id),prix:parseInt(bdch[i].value)});
       }
       
    }
   
    if(cas==9){
        dbprix=JSON.stringify(dbprix);
     data+="&tab="+dbprix;
     ajouter(data,email,pw);
    }
    }
    
    
     function ajouter(data,email,pw){
        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
              if(this.readyState==4 && this.status==200)
              {
                  var cas=this.response;
                  if(cas==1)
                   alert("Email : "+email+" et  Mot de passe :"+pw);
              }
              }
              xhr.open("POST","php/ajouagence.php",true);
              xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
              xhr.send(data);
     }
    
    
    
    function unit(){
        var xhr=new XMLHttpRequest();
      xhr.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200)
            {
                var con=document.getElementById("contentch");
               var  ch="";
                var tab=JSON.parse(this.response);
              tab.forEach(load)           
               function load(item,index){
    
             ch+= "<div class='col-lg-8 col-md-12'><div class='form-group prix-ch'id='"+item['num_chambre']+"'><label class='form-control'>"+item['designation']+" ( "+item['nbr_adulte']+" Adule "+item['nbr_enfent']+" enfent )</label></div></div><div class='col-lg-4 col-md-12'><div class='form-group'> <input type='number' min='0'  class='form-control prix ' placeholder='Prix Chambre'> </div></div>";
    
               }
    con.innerHTML=ch;
            }
            }
            xhr.open("POST","php/ajouagence.php",true);
            xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            var data="op="+2;
            xhr.send(data);
    }
    
    