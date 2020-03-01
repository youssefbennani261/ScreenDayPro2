if(window.location.pathname=="/ScreenDayPro2/pages/demandes_agence.php"){
    let demandes;
    $.get("../php/agence_agence.php",{op:3},(data)=>{
        demandes=JSON.parse(data);
        let s;
        for(let i=0;i<demandes.length;i++){
            
            s+=`<tr><td>${demandes[i].Responsable}</td><td>${demandes[i].Date_Debut}</td><td>${demandes[i].Date_Fin}</td><td>${demandes[i].Personnes}</td><td>${demandes[i].date_demande}</td><td>${demandes[i].vérifié=="0"?`<span class="badge badge-warning">En Attente</span>`:demandes[i].vérifié=="1"?`<span class="badge badge-success">approuvée</span>`:`<span class="badge badge-danger">Refusé</span>`}</td></tr>`;
        }
        $("#tabledem").html(s);
            
        })
        
    }
if(window.location.pathname=="/ScreenDayPro2/pages/email_agence.php"){
    let clone;
    let emails;
    let agences;
    let sentmails;
    $.get("../php/email.php",{op:1},(data)=>{
        emails=JSON.parse(data);
        getemail();
    })
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
         $.post("../php/email.php",{op:2,sujet:$(".sujet").val(),content:$('.summernote').summernote('code')},(data)=>{
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
            riads=JSON.parse(data);
            let s = `<div class="inbox right">
            <div class="card">
                <div class="body mb-2">
                    <div class="form-group">
                        <select class="form-control" id=riads></select>
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
          for(let i=0;i<riads.length;i++){
            $("#riads").append(new Option(riads[i].Nom,riads[i].Num_riad));
        }
        $("#sendmsg").click(()=>{
            $.post("../php/email.php",{op:3,sujet:$(".sujet").val(),content:$('.summernote').summernote('code')},(data)=>{
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
                <td class="u_image"><img src="${sentmails[i].logo_src}" alt="user" class="rounded" width="30"></td>
                <td class="u_name"><h5 class="font-15 mt-0 mb-0">${sentmails[i].Nom_agg}</h6></td>
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
