 var t="";
function load()
{
  $("#demandes").removeClass("active open");
  $("#dashboard").removeClass("active open");
  $("#messagerie").removeClass("active open");
  $("#profil").removeClass("active open");
  $("#agences").addClass("active open");
var xhr=new XMLHttpRequest();
xhr.onreadystatechange=function(){
if(this.status==200 && this.readyState==4){
        var tab=JSON.parse(this.response);
    var j=document.getElementById("tab_agences");
        tab.forEach(unit);
     
            function unit (item,index) {
              j.innerHTML+="<tr><td style='display: table-cell'>"+ item['nom']+" </td><td style='display: table-cell'>"+ item['directeur']+"</td><td style='display: table-cell'>"+item['adresse']+"</td><td style='display: table-cell'>"+item['tel']+"</td><td style='display: table-cell'><a class='btn btn-success' href='agence_riad.php' onclick='unit1("+item['num']+")'>afficher</a></td></tr>";
              
             }
        
}
}
    xhr.open("GET","../php/listagence.php",true);
    xhr.send();

}

    function unit1(id){     
     localStorage['id']=id; 
        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.status==200 && this.readyState==4){
                 var data=JSON.parse(this.response);
               data.forEach(bo)
               function bo(item,index){
              
                 t+="<tr><td style='display: table-cell'>"+ item['nom']+" </td><td style='display: table-cell'>"+ item['dd']+"</td><td style='display: table-cell'>"+item['df']+"</td><td style='display: table-cell'>"+item['prix']+"</td><td style='display: table-cell'>"+item['nrespo']+"</td><td style='display: table-cell'>"+item['nbr']+"</td></tr>";
                
                 
                }
               
sessionStorage['list']=t;

            }
        }
        var data="op="+1+"&id="+id;
        xhr.open("POST","../php/riad_reservation.php",true);
        xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    
        xhr.send(data);

      }

      function load1(){
         document.getElementById("tab_demande").innerHTML=sessionStorage['list'];
         load2();
        }


      function load2(){

        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.status==200 && this.readyState==4){
                 var data=JSON.parse( this.response);
               data.forEach(bo)
               function bo(item,index){
              
              document.getElementById("imgp").innerHTML='<img class="media-object " src="'+item['Logo']+'" alt=""></img>';
              document.getElementById("no").innerText=item['Nom'];
              document.getElementById("ad").innerText=item['Adresse'];
              document.getElementById("te").innerText=item['Telephone'];
            }
            }
        }
        var data="op="+2+"&id="+localStorage['id'];
        xhr.open("POST","../php/riad_reservation.php",true);
        xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    
        xhr.send(data);
     


      }


   function cherche(){
    
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.status==200 && this.readyState==4){
         t="";
          if(this.response!=""){
             var data=JSON.parse(this.response);
             var sum=0;
            
                 data.forEach(bo)
           function bo(item,index){
          
             t+="<tr><td style='display: table-cell'>"+ item['nom']+" </td><td style='display: table-cell'>"+ item['dd']+"</td><td style='display: table-cell'>"+item['df']+"</td><td style='display: table-cell'>"+item['prix']+"</td><td style='display: table-cell'>"+item['nrespo']+"</td><td style='display: table-cell'>"+item['nbr']+"</td></tr>";
            sum+=parseInt(item['prix']);
             
            }
            document.getElementById('tab_demande').innerHTML=t;
 document.getElementById("total").innerText="TOTAL : "+sum+" DH";
             }else{
              document.getElementById('tab_demande').innerHTML=t;
             }
         

        }
    }
    var data="op="+3+"&id="+localStorage['id']+"&date="+document.getElementById("date").value;
    xhr.open("POST","../php/riad_reservation.php",true);
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  
    xhr.send(data);


  }





