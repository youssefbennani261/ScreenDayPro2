$("#singin").click(function(){

    $.post("php/login.php",{login:$("#email").val(),pwd:$("#pwd").val()},function(data){
        if(data=="1"){
            window.location.href="index.php";
            
        }

        else
        alert("0");
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