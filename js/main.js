$("#singin").click(function(){

    $.post("php/login.php",{login:$("#email").val(),pwd:$("#pwd").val()},function(data){
        if(data=="1"){
            window.location.href="index.php";
            
        }

        else
        alert("Mot de passe Incorrect");
        })
})
if(window.location.pathname=="/ScreenDayPro2/index.php"){
    $.get("php/riad.php",{op:1},function(data){
        var tab=JSON.parse(data);
        $("#nbrres").html(tab[0]["COUNT(Id_reservation)"]+" <small class='info'>ce mois </small>");
        $("#ca").html(eval(tab[1]["SUM(pr.Prix)"])+" Dh"+" <small class='info'>ce mois</small>");
        var res=increasedecrease(tab[0]["COUNT(Id_reservation)"],tab[2]["COUNT(Id_reservation)"]);
        var res2=increasedecrease(tab[1]["SUM(pr.Prix)"],tab[3]["SUM(pr.Prix)"]);
        $("#resstat").html(res);
        $("#castat").html(res2)
        var numb =res.match(/\d+/)[0];
        $("#progress_res").attr("aria-valuenow",numb)
        $("#progress_res").css({"width":parseInt(numb)+"%"});
        var numb2 =res2.match(/\d+/)[0];
        $("#progress_ca").attr("aria-valuenow",numb2)
        $("#progress_ca").css({"width":parseInt(numb2)+"%"});
        ////////////////////////////////////////////////////////////////////////

        $("#nbr0").html(tab[4]["COUNT(num_chambre)"]+'<small class="info"> of '+ tab[6]["COUNT(num_chambre)"]+' </small>');
        $("#nbr01").html('<div class="progress-bar l-blue" role="progressbar" aria-valuenow="'+tab[4]["COUNT(num_chambre)"]+'" aria-valuemin="0" aria-valuemax="'+tab[6]["COUNT(num_chambre)"]+'" style="width:'+tab[4]["COUNT(num_chambre)"]*100/tab[6]["COUNT(num_chambre)"]+'%;"></div>');
        $("#nbr1").html(tab[5]["COUNT(num_chambre)"]+'<small class="info"> of '+tab[6]["COUNT(num_chambre)"]+' </small>');
        $("#nbr11").html('<div class="progress-bar l-green" role="progressbar" aria-valuenow="'+tab[5]["COUNT(num_chambre)"]+'" aria-valuemin="0" aria-valuemax="'+tab[6]["COUNT(num_chambre)"]+'" style="width: '+tab[5]["COUNT(num_chambre)"]*100/tab[6]["COUNT(num_chambre)"]+'%;"></div>');

    })
}
// pour calculer pourcetage de difference entre ce mois et le dernier mois
function increasedecrease(thismonth,lastmonth){
    var output="";
if(thismonth>lastmonth){
    var inc=thismonth-lastmonth;
    output=Math.floor(inc/lastmonth*100)+" % higher than last month ";
}
if(thismonth<lastmonth){
    var dec=lastmonth-thismonth;
    output=Math.floor(dec/lastmonth*100)+" % lower than last month ";
}
return output;
}

if(window.location.pathname=="/ScreenDayPro2/demande.php"){

    var demandes;
    
    $.get("php/riad.php",{op:3},function(data){
        demandes=JSON.parse(data);
        for(let i=0;i<demandes.length;i++){
            $("#tab_demandes").append("<tr><td style='display: table-cell'>"+demandes[i].nomagg+"</td><td style='display: table-cell'>"+demandes[i].respo+"</td><td style='display: table-cell'>"+demandes[i].datedeb+"</td><td style='display: table-cell'>"+demandes[i].datefin+"</td><td style='display: table-cell'>"+JSON.parse(demandes[i].detail).length+"</td><td><button class='btn btn-success accepte' data-toggle='modal' data-target='#defaultModal' id='"+i+"'>Accepter</button></td><td><button class='btn btn-danger refuse' id=d"+demandes[i].numdemande+" >Refuser</button></td></tr>");

        }
    })
    
    $("#tab_demandes").on('click','.accepte',function(){
        var reservation=[];
        var chambres;
        $.get("php/riad.php",{op:4},(data)=>{
             chambres=JSON.parse(data);
             let ind =$(this).attr('id');
             let pers=JSON.parse(demandes[ind].detail);
             $(".modal-body").empty();
             for(let i=0;i<pers.length;i++){
                 if(i==0)
                 $(".modal-body").append("<input type='hidden' id='iddem' value='"+demandes[ind].numdemande+"'></input>"+"<input type='hidden' id='numag' value='"+demandes[ind].Num_agence+"'></input>"+" veuillez choisir les Chambres pour <br> "+pers[i].client+"("+pers[i].type+")"+"<i class='zmdi zmdi-account-circle zmdi-hc-lg'></i>"+" <select class='chambres form-control'></select><a class='float-right setchambre'></a><br>Prix"+"   <i class='zmdi zmdi-money-box zmdi-hc-lg'></i>"+"<br><input type='text' class='form-control setprix' placeholder='Tappez le prix de cette chambre'><br>");
                 else
                 $(".modal-body").append(pers[i].client+"("+pers[i].type+")"+"<i class='zmdi zmdi-account-circle zmdi-hc-lg'></i>"+" <select class='chambres form-control'></select><br>Prix"+"   <i class='zmdi zmdi-money-box zmdi-hc-lg'></i>"+"<br><input type='text' class='form-control setprix' placeholder='Tappez le prix de cette chambre'><br>");
             }
             for(let i=0;i<chambres.length;i++){
             $(".chambres").append(new Option("chambre "+chambres[i].num_chambre+" ("+chambres[i].nbradulte+" Adulte "+chambres[i].nbr_enfent+" bebe "+" )",chambres[i].num_chambre));
             }
        })
        $(".modal-body").on('change','.chambres',(event)=>{
            $('.setchambre').html("Affecter chambre "+chambres[event.originalEvent.target.selectedIndex].num_chambre+" pour tous");
        })
        $(".modal-body").on('click','.setchambre',()=>{
            $(".chambres").prop('selectedIndex',$(".chambres").prop('selectedIndex'));
        })
    });
        $("#save").click(function(){
            var prix=JSON.stringify(getrepeated());
            var iddemande=parseInt($("#iddem").val());
            var num_age=parseInt($("#numag").val());
            $.get("php/riad.php",{op:5,prix:prix,demade:iddemande,num_agence:num_age},(data)=>{
                console.log(data);
            })
            $('#defaultModal').modal('toggle');
        });
        $("#tab_demandes").on('click','.refuse',function(e){
            console.log(e);
            // swal("Avertissement", "Voulez vous supprimer cette demande ?","warning");
            swal("Avertissement", "Voulez vous supprimer cette demande ?","warning",{
                buttons: {
                    confirm: true,
                  cancel: true,
                  
                },
              }).then(function(isConfirm) {
                if (isConfirm) {
                  swal({
                    title: 'supprimé',
                    text: 'La demande est supp  rimé!',
                    icon: 'success'
                  }).then(function() {
                    $.get("php/riad.php",{op:6,demade:parseInt(e.currentTarget.id.substr(1,1))},()=>{
                        
                    })
                  });
                } 
        })})

    }
function getrepeated(){
    var data=[];
    var occurs=[];
    for(let i=0;i<$(".setprix").length;i++){
           data.push({"id_chambre":parseInt($(".chambres")[i].value),"prix":parseInt($(".setprix")[i].value)});
        //    "id_demande":parseInt($("#iddem").val()),
    }
    // $.each(data, function(i, el){
    //     if($.inArray(el.prix, occurs) === -1) occurs.push(parseInt(el));
    // });
    return data;
}

