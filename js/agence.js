function load()
{
var xhr=new XMLHttpRequest();
xhr.onreadystatechange=function(){
if(this.status==200 && this.readyState==4){
        var tab=JSON.parse(this.response);
    var j=document.getElementById("tab_agences");
        tab.forEach(unit);
     
            function unit (item,index) {
              j.innerHTML+="<tr><td style='display: table-cell'>"+ item['nom']+" </td><td style='display: table-cell'>"+ item['directeur']+"</td><td style='display: table-cell'>"+item['adresse']+"</td><td style='display: table-cell'>"+item['tel']+"</td><td style='display: table-cell'><a class='btn btn-success' href='agence_riad' onclick='unit1("+item['num']+")'>afficher</a></td></tr>";
              
             }
        
}
}
    xhr.open("GET","php/listagence.php",true);
    xhr.send();

}

    function unit1(id){
       
        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.status==200 && this.readyState==4){
              
                 var data=JSON.parse( this.response);
               data.forEach(bo)
               function bo(item,index){
                 t+="<tr><td style='display: table-cell'>"+ item['nom']+" </td><td style='display: table-cell'>"+ item['dd']+"</td><td style='display: table-cell'>"+item['df']+"</td><td style='display: table-cell'>"+item['prix']+"</td><td style='display: table-cell'>"+item['nrespo']+"</td><td style='display: table-cell'>"+item['nbr']+"</td></tr>";
     
                      }
localStorage['listdomande']=t;
            }
        }
        var data="op="+1+"&id="+id;
        xhr.open("POST","php/riad_reservation.php",true);
        xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        xhr.send(data);
      
      }
      function load1(){
        document.getElementById("tab_demande").innerHTML=localStorage['listdomande'];
      }