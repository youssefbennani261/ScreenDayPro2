$("#singin").click(function(){

    $.post("php/login.php",{login:$("#email").val(),pwd:$("#pwd").val()},function(data){
        if(data=="1"){
            window.location.href="pages/index.php";
            
        }
        else if(data=="2"){
            window.location.href="pages/index_agence.php";
        }

        else
        alert("Mot de passe Incorrect");
        })
})
if(window.location.pathname=="/ScreenDayPro2/pages/index.php"){
    $.get("../php/riad.php",{op:1},function(data){
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
function getdemandes(){
    $("#tab_demandes").empty();
    $.get("../php/riad.php",{op:3},function(data){
        demandes=JSON.parse(data);
        for(let i=0;i<demandes.length;i++){
            $("#tab_demandes").append("<tr><td style='display: table-cell'>"+demandes[i].nomagg+"</td><td style='display: table-cell'>"+demandes[i].respo+"</td><td style='display: table-cell'>"+demandes[i].datedeb+"</td><td style='display: table-cell'>"+demandes[i].datefin+"</td><td style='display: table-cell'>"+JSON.parse(demandes[i].detail).length+"</td><td><button class='btn btn-success accepte' data-toggle='modal' data-target='#defaultModal' id='"+i+"'>Accepter</button></td><td><button class='btn btn-danger refuse' id=d"+demandes[i].numdemande+" >Refuser</button></td></tr>");
        }
    })
}

if(window.location.pathname=="/ScreenDayPro2/pages/demande.php"){
    let count=0;
    var demandes;
    var chambres;

    getdemandes();
    $("#tab_demandes").on('click','.accepte',function(e){
        var reservation=[];
        
        let numaggence=demandes[e.target.id].Num_agence;
        $.get("../php/riad.php",{op:4,num_agence:numaggence},(data)=>{
             chambres=JSON.parse(data);
             console.log(chambres);
             let ind =$(this).attr('id');
             let pers=JSON.parse(demandes[ind].detail);
             $(".modal-body").empty();
             $("#resalert").addClass("d-none");
             for(let i=0;i<pers.length;i++){
                 count=0
                 if(pers[i].type=="bebe")
                 count++;
                 else 
                 count+=2;
                 if(i==0)
                 $(".modal-body").append("<input type='hidden' id='iddem' value='"+demandes[ind].numdemande+"'></input>"+"<input type='hidden' id='numag' value='"+demandes[ind].Num_agence+"'></input>"+" veuillez choisir les Chambres pour <br> "+pers[i].client+"("+pers[i].type+")"+"<i class='zmdi zmdi-account-circle zmdi-hc-lg'></i>"+" <select class='chambres form-control'></select><a class='float-right setchambre'></a><br>");
                 else
                 $(".modal-body").append(pers[i].client+"("+pers[i].type+")"+"<i class='zmdi zmdi-account-circle zmdi-hc-lg'></i>"+" <select class='chambres form-control'></select><br><br>");
                 
             }
             for(let i=0;i<chambres["chambres"].length;i++){
             $(".chambres").append(new Option("chambre "+chambres["chambres"][i].num_chambre+" ("+chambres["chambres"][i].nbradulte+" Adulte "+chambres["chambres"][i].nbr_enfent+" bebe "+" )",chambres["chambres"][i].num_chambre));
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
            if(validationres()<count)
            $("#resalert").removeClass("d-none");         
            else if(validationres()==count ||validationres()>count){
            $("#resalert").addClass("d-none");
            var prix=JSON.stringify(getchambre_idprix());
            var iddemande=parseInt($("#iddem").val());
            var num_age=parseInt($("#numag").val());
            $.get("../php/riad.php",{op:5,prix:prix,demade:iddemande,num_agence:num_age},(data)=>{
                getdemandes();
            })
            $('#defaultModal').modal('toggle');
            
        }


        });
        $("#tab_demandes").on('click','.refuse',function(e){
            
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
                    text: 'La demande est supprimé!',
                    icon: 'success'
                  }).then(function() {
                    $.get("../php/riad.php",{op:6,demade:parseInt(e.currentTarget.id.match(/\d+/)[0])},()=>{
                        getdemandes();
                    })
                  });
                } 
        })})

    }
function getchambre_idprix(){
    var data=[];
    let ch;
    for(let i=0;i<$(".chambres").length;i++){
         ch=chambres["prix"].find(el=>el.num_chambre==chambres["chambres"][$(".chambres")[0].selectedIndex].num_chambre)
         data.push({num_chambre:ch.num_chambre,id_Prix:ch.id_Prix});
    }

    return data;
}
function validationres(){
    let ind=[];
    let filtred=[];
    let data=0;
    let selects=$(".chambres");
    for(let i=0;i<selects.length;i++){
        ind.push(selects[i].selectedIndex);
    }
    $.each(ind, function(i, el){
        if($.inArray(el, filtred) === -1) filtred.push(el);
    });
    for(let i=0;i<filtred.length;i++)
    data+=parseInt(chambres["chambres"][i].nbradulte)*2+parseInt(chambres["chambres"][i].nbr_enfent);

    return data;
}

//verification de la validation des inputs 

function validationinput(selector){
    var state=true;
    let inputs=document.querySelectorAll(selector);
    var exp = new RegExp("^[0-9]*$");
    for(let i=0;i<inputs.length;i++){
        
        if(inputs[i].value=="" || exp.test(inputs[i].value)==false){
        inputs[i].classList.add("is-invalid");
        state=false;
        }
    }
    return state;
}
if(window.location.pathname=="/ScreenDayPro2/pages/email.php"){
    let clone;
    let emails;
    let agences;
    let sentmails;
    $.get("../php/email.php",{op:1},(data)=>{
        emails=JSON.parse(data);
        getemail();
    })

    // function returntomails(){
    //     if(clone)
    //     $(".right").replaceWith(clone);
        
    // }
    function getemail(){
        $("#nbrmsg").html(emails.length);
        let s=`<div class="i_action d-flex justify-content-between align-items-center">
                                
        <div class="">
            <div class="btn-group">
                <a href="javascript:void(0);" class="btn btn-outline-secondary btn-sm delete"><i class="zmdi zmdi-delete"></i></a>
            </div>
        </div>
    </div>
<div class="table-responsive"><table class="table c_table inbox_table" id="emails">`;
        for(let i=0;i<emails.length;i++){
            s+=`<tr>
            <td class="chb">
                <div class="checkbox simple">
                    <input id="mc${i}" class="cbo" value=${emails[i].id_email} type="checkbox">
                    <label for="mc${i}"></label>
                </div>
            </td>
            <td class="starred "><a><i class="zmdi zmdi-star"></i></a></td>
            <td class="u_image"><img src=${emails[i].logo_src} alt="user" class="rounded" width="30"></td>
            <td class="u_name"><h5 class="font-15 mt-0 mb-0">${emails[i].Nom}</h6></td>
            <td class="max_ellipsis">
                <a class="link" a href="javascript:showsingleemail(${i});">
                    <span class="badge badge-primary mr-2">${emails[i].sujet}</span>
                    ${emails[i].content}
                </a>
            </td>
            <td class="time">${emails[i].date_envoi}</td>
        </tr>`;
        }
        s+=`</table></div>`;
        $(".right").html(s);
        $(".delete").click(()=>{
            var emailstoremove = $(".cbo:checked").map(function(){
                return $(this).val();
              }).get();
              $.post("../php/email.php",{op:4,emails:JSON.stringify(emailstoremove)},(data)=>{
                 window.location.reload();
              })
        })

    }
    function showsingleemail(i){
        clone=$(".right").clone();
        let s =`<div class="inbox right">
        <div class="card">
            <div class="body mb-2">
                <div class="d-flex justify-content-between flex-wrap-reverse">
                    <h5 class="mt-0 mb-0 font-17">${emails[i].sujet}</h5>
                </div>
            </div>
            <div class="body mb-2">
                <ul class="list-unstyled d-flex justify-content-md-start mb-0">
                    <li><img class="rounded w40" src=${emails[i].logo_src} alt=""></li>
                    <li class="ml-3">
                        <p class="mb-0"><span class="text-muted">From:</span> ${emails[i].Nom}</p>
                        <p class="mb-0"><span class="text-muted">To:</span> Moi</p>
                    </li>
                </ul>
            </div>
            <div class="body mb-2">
            <p>${emails[i].content}</p>

            </div>
            <div class="body">
                <a  href="javascript:sendmessage(${i});" class="p-2"><i class="zmdi zmdi-mail-reply"></i> Reply</a>
            </div>
        </div>
    </div>`;
    $(".right").html(s);

    }
    function sendmessage(i){
        let s = `<div class="inbox right">
        <div class="card">
            <div class="body mb-2">
                <div class="form-group">
                    <input type="text" class="form-control to" value="${emails[i].Nom}" id="${emails[i].numag}" />
                </div>
                <div class="form-group mb-0">
                    <input type="text" class="form-control sujet" placeholder="Subject" />
                </div>
            </div>
            <div class="body">
                <div class="summernote">

                </div>
                <button type="button" class="btn btn-info waves-effect m-t-20" id=sendmsg>SEND</button>
            </div>
        </div>
    </div>`;
    $(".right").html(s);
    $('.summernote').summernote({
        lang: 'fr-FR'
      });

    
      $("#sendmsg").click(()=>{
         $.post("../php/email.php",{op:2,agence:parseInt($(".to").attr("id")),sujet:$(".sujet").val(),content:$('.summernote').summernote('code')},(data)=>{
            $.notify({
                message: "Email a été envoyé avec succes",
              },
              {
                    type: 'success'
                });
                getemail();
         })
      })

    }
    function composemsg(){
        $.get("../php/email.php",{op:2},(data)=>{
            agences=JSON.parse(data);
            let s = `<div class="inbox right">
            <div class="card">
                <div class="body mb-2">
                    <div class="form-group">
                        <select class="form-control" id=agences></select>
                    </div>
                    <div class="form-group mb-0">
                        <input type="text" class="form-control sujet" placeholder="Subject" />
                    </div>
                </div>
                <div class="body">
                    <div class="summernote">
    
                    </div>
                    <button type="button" class="btn btn-info waves-effect m-t-20" id=sendmsg>SEND</button>
                </div>
            </div>
        </div>`;
    
        $(".right").html(s);
            
        $('.summernote').summernote({
            lang: 'fr-FR'
          });
          for(let i=0;i<agences.length;i++){
            $("#agences").append(new Option(agences[i].Nom,agences[i].Num_agence));
        }
        $("#sendmsg").click(()=>{
            $.post("../php/email.php",{op:3,agence:$("#agences").val(),sujet:$(".sujet").val(),content:$('.summernote').summernote('code')},(data)=>{
                $.notify({
                    message: "Email a été envoyé avec succes",
                  },
                  {
                        type: 'success'
                    });
            })
            getemail();

        })
        })
  
    }
    function getsentmsg(){
        $("#sent").addClass("active"); 
        $("#inbox").removeClass("active");       
        $.get("../php/email.php",{op:3},(data)=>{
            sentmails=JSON.parse(data);
            let s=`<div class="table-responsive"><table class="table c_table inbox_table" id="emails">`;
            for(let i=0;i<sentmails.length;i++){
                s+=`<tr>
                <td class="chb">
                    <div class="checkbox simple">
                        <input id="mc1" type="checkbox">
                        <label for="mc1"></label>
                    </div>
                </td>
                <td class="starred "><a><i class="zmdi zmdi-star"></i></a></td>
                <td class="u_image"><img src="./${sentmails[i].logo_src}" alt="user" class="rounded" width="30"></td>
                <td class="u_name"><h5 class="font-15 mt-0 mb-0">${sentmails[i].Nom_Riad}</h6></td>
                <td class="max_ellipsis">
                    <a class="link" a href="javascript:view_sentmsg(${i});">
                        <span class="badge badge-primary mr-2">${sentmails[i].sujet}</span>
                        ${sentmails[i].content}
                    </a>
                </td>
                <td class="time"> ${sentmails[i].date_envoi}</td>
            </tr>`;
            }
            s+=`</table></div>`;
            $(".right").html(s);
        })
    }
    function view_sentmsg(i){
        clone=$(".right").clone();
        let s =`<div class="inbox right">
        <div class="card">
            <div class="body mb-2">
                <div class="d-flex justify-content-between flex-wrap-reverse">
                    <h5 class="mt-0 mb-0 font-17">${sentmails[i].sujet}</h5>
                </div>
            </div>
            <div class="body mb-2">
                <ul class="list-unstyled d-flex justify-content-md-start mb-0">
                    <li><img class="rounded w40" src=${sentmails[i].logo_src} alt=""></li>
                    <li class="ml-3">
                        <p class="mb-0"><span class="text-muted">From:</span> me</p>
                        <p class="mb-0"><span class="text-muted">To:</span>${sentmails[i].nom_ag} </p>
                    </li>
                </ul>
            </div>
            <div class="body mb-2">
            <p>${sentmails[i].content}</p>

            </div>

        </div>
    </div>`;
    $(".right").html(s);
    }

    
}