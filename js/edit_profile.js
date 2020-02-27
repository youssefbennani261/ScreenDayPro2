$(document).on('click', '#sendfile', function(){
  
   var name = document.getElementById("fileup").files[0].name;
   var form_data = new FormData();
   var ext = name.split('.').pop().toLowerCase();
   if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
   {
    alert("Format d'image Invalide");
   }
   var oFReader = new FileReader();
   oFReader.readAsDataURL(document.getElementById("fileup").files[0]);
   var f = document.getElementById("fileup").files[0];
   var fsize = f.size||f.fileSize;
   if(fsize > 2000000)
   {
    alert("La taille d'image est grande");
   }
   else
   {
    form_data.append("file", document.getElementById('fileup').files[0]);
    $.ajax({
     url:"../php/uploadimg.php",
     method:"POST",
     data: form_data,
     contentType: false,
     cache: false,
     processData: false,
    
    });
    window.location.reload();
   }
  });
