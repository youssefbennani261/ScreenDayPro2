var reservation;
function verificationdemande(){
        let state;
     let tab=[];
    // tab=tab.concat(document.querySelectorAll(".nom"),document.querySelectorAll(".type"),document.querySelectorAll(".cin"));
    for(let i=0;i<parseInt($("#nbrper").val());i++){
        if($(".nom")[i].value==""){
        tab.push($(".nom")[i]);
        $(".nom")[i].classList.add("border-danger");
        }
        if($(".type")[i].value==""){
        tab.push($(".type")[i]);
        $(".type")[i].classList.add("border-danger");
        }
        if($(".cin")[i].value==""){
        tab.push($(".cin")[i]);
        $(".cin")[i].classList.add("border-danger");
        }
    }

    if(tab.length==0)state=false 
    else{
    state=true;
    }
    return state;
}
$.get("../php/agence_agence.php",{op:1},function(data){
    reservation=JSON.parse(data);
    console.log(reservation);
    $.each(reservation, function(index, event){
        $('#calendar').fullCalendar('renderEvent', event);
    });

})
$(function() {

    enableDrag();

    function enableDrag(){

        $('#external-events .fc-event').each(function() {

            $(this).data('event', {

                title: $.trim($(this).text()), // use the element's text as the event title

                stick: true // maintain when user navigates (see docs on the renderEvent method)

            });



            // make the event draggable using jQuery UI

            $(this).draggable({

                zIndex: 999,

                revert: true,      // will cause the event to go back to its

                revertDuration: 0  //  original position after the drag

            });

        });

    }

    var today = new Date();

    var dd = today.getDate();

    var mm = today.getMonth()+1; //January is 0!

    var yyyy = today.getFullYear();



    if(dd<10) { dd = '0'+dd }

    if(mm<10) { mm = '0'+mm } 


    var current = yyyy + '-' + mm + '-'+dd;

    var calendar = $('#calendar');

    // initialize the calendar
    let state=false;
    calendar.fullCalendar({
        
        editable: true,
        droppable: true,
        eventStartEditable:false,
        eventLimit: true, // allow "more" link when too many events

        // events:reservation,
        selectable: true,
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        // dayClick: function(date) {
        //     alert('clicked ' + date.format());
            
        //   },
          select: function(startDate, endDate,e) {
            if(e.target.colSpan==1){
                if(startDate.format()<current ){
                    $.notify({
                        message: "Date Invalid ",
                      },
                      {
                            type: 'danger'
                        });
                    }
                else{
                let demande=[];
                // alert('selected ' + startDate.format());
                $("#addDirectEvent").modal('toggle');
                let s=`
                    <div class="form-group">
                        <label>Le</label>
                        <input disabled class="form-control" id="date" name="event-name" type="text" value=${startDate.format()} /><br>
                        <label>Nom responsable</label>
                        <input  class="form-control" name="event-name" type="text" id="respo" /><br>
                        <label>Nombre de Personne</label>
                        <input class="form-control" id="nbrper" type="number"/><br>
                    </div>
                    <div class="form-group pers"></div>
           `;
            $(".modal-body").html(s);
            $("#nbrper").on('input', function() {
                $(".pers").empty();
                for(let i=0;i<parseInt($("#nbrper").val());i++){
                    $(".pers").append(`<fieldset class="border p-3"> <legend class="w-25">Client ${i+1}</legend>
                    <label>Nom Client</label>
                    <input  class="form-control nom"  type="text"  /><br>
                    <label>Type</label>
                    <select class="form-control type"><option value="bebe">bebe</option><option value="adulte">adulte</option></select><br>
                    <label>CIN</label>
                    <input  class="form-control cin"  type="text"  /><br>
                    </fieldset><br>`);
                }
            })

            $("#send").click(()=>{
                if(verificationdemande()==true || $("#respo").val()=="")
                {
                    $.notify({
                        message: "Remplir tous les champs svp",
                      },
                      {
                            type: 'danger'
                        });
                    }
                else{
                for(let i=0;i<parseInt($("#nbrper").val());i++){
                    demande.push({client:$(".nom")[i].value,type:$(".type")[i].value,passport:$(".cin")[i].value})
                }
                $.post("../php/agence_agence.php",{op:2,detail:JSON.stringify(demande),date_deb:$("#date").val(),date_fin:$("#date").val(),nbper:parseInt($("#nbrper").val()),respo:$("#respo").val()},()=>{
                    $("#addDirectEvent").modal('toggle');
                    $.notify({
                        message: "demande envoyé , en attente d'approbation"                        ,
                      },
                      {
                            type: 'success'
                        });
                })
            }
            })
        }
            }
            else{
                if(startDate.format()<current||endDate.format()<current){
                    $.notify({
                        message: "Date Invalid "                        ,
                      },
                      {
                            type: 'danger'
                        });
                    }
                else{
                // alert('selected ' + startDate.format() + ' to ' + endDate.format());
                let demande=[];
                $("#addDirectEvent").modal('toggle');
                function formatDate(date) {
                    var d = new Date(date),
                        month = '' + (d.getMonth() + 1),
                        day = '' + d.getDate(),
                        year = d.getFullYear();
                
                    if (month.length < 2) 
                        month = '0' + month;
                    if (day.length < 2) 
                        day = '0' + day;
                
                    return [year, month, day].join('-');
                }
                let newDate = new Date(endDate.year(), endDate.month(), endDate.date()-1);
               let myenddate=formatDate(newDate);
 

                let s=`
                    <div class="form-group">
                        <label>A partir</label>
                        <input disabled class="form-control" id="datede" name="event-name" type="text" value=${startDate.format()} /><br>
                        <label>Jusqu'a</label>
                        <input disabled class="form-control" id="datefin" name="event-name" type="text" value=${myenddate} /><br>
                        <label>Nom responsable</label>
                        <input  class="form-control" name="event-name" type="text" id="respo" /><br>
                        <label>Nombre de Personne</label>
                        <input class="form-control" id="nbrper" type="number"/><br>
                    </div>
                    <div class="form-group pers"></div>
           `;
            $(".modal-body").html(s);
            $("#nbrper").on('input', function() {
                $(".pers").empty();
                for(let i=0;i<parseInt($("#nbrper").val());i++){
                    $(".pers").append(`<fieldset class="border p-3"> <legend class="w-25">Client ${i+1}</legend>
                    <label>Nom Client</label>
                    <input  class="form-control nom"  type="text"  /><br>
                    <label>Type</label>
                    <select class="form-control type"><option value="bebe">bebe</option><option value="adulte">adulte</option></select><br>
                    <label>CIN</label>
                    <input  class="form-control cin"  type="text"  /><br>
                    </fieldset><br>`);
                }
            })
            $("#send").click(()=>{
                if(verificationdemande()==true || $("#respo").val()==""){
                    alert("2");
                $.notify({
                    message: "Remplir tous les champs svp",
                  },
                  {
                        type: 'danger'
                    });
                }
                else{
                for(let i=0;i<parseInt($("#nbrper").val());i++){
                    demande.push({client:$(".nom")[i].value,type:$(".type")[i].value,passport:$(".cin")[i].value})
                }
                $.post("../php/agence_agence.php",{op:2,detail:JSON.stringify(demande),date_deb:$("#datede").val(),date_fin:$("#datefin").val(),nbper:parseInt($("#nbrper").val()),respo:$("#respo").val()},()=>{
                    $("#addDirectEvent").modal('toggle');
                    $.notify({
                        message: "demande envoyé , en attente d'approbation"                        ,
                      },
                      {
                            type: 'success'
                        });
                })
            }

            })
        }
            }

        },
        viewRender: function (view, element) {
            $.each(reservation, function(index, event){
   $('#calendar').fullCalendar('renderEvent', event);
});
}
        
        
    });

});