var comp;

var reservation;
let demandes2;
$.get("../php/riad.php",{op:2},function(data){
    reservation=JSON.parse(data);
})
$.get("../php/riad.php",{op:7},function(data){
    demandes2=JSON.parse(data);
 comp=reservation.concat(demandes2);
     console.log(comp);
     $.each(comp, function(index, event){
        $('#calendar').fullCalendar('renderEvent', event);
    });
})
$(function() {


    var calendar = $('#calendar');

    // initialize the calendar
    
    calendar.fullCalendar({
        header: {

            left: 'title',

            center: '',

            right: 'prev, next',


        },
        events: comp,
        displayEventTime: false,

        eventClick: function(e) { 
            if(e.className[0]=="bg-success"){
            let detail=JSON.parse(e.detail);
            $("#defaultModal").modal('toggle');
            $("#tableres").DataTable( {
                data:detail,
                columns: [
                    { data: 'client' },
                    { data: 'type' },
                    { data: 'passport' }
                ],
                paging: false,
                searching: false,
                destroy: true
            })

        }
        if(e.className[0]=="bg-danger")
        window.location.href="demande.php";
    }
    ,
        viewRender: function (view, element) {
                     $.each(comp, function(index, event){
            $('#calendar').fullCalendar('renderEvent', event);
        });
        }
        
    });
    
});