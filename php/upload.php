<?php
  require('connection.php');
  session_start(); 
  if(isset($_POST['submit'])){

    function saveimage($name,$image,$con,$id){
        $req=mysqli_query($con,"insert into imagepro values(NULL,'".$name."','".$image."',".$id.")") or die  ("!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!");
         $req1=mysqli_query($con,"select image from imagepro where id_riad=".$id."") or die("!!!!!!!!!!!!!!!!!!");
         while($row=mysqli_fetch_array($req1)){
          $_SESSION['imgprofile']=$row[0];
         }
        //    

    }
  
  if(getimagesize($_FILES['file']['tmp_name'])==false)
  {
      echo 'please select un images';
  }
 else
   {
       $image=addslashes($_FILES['file']['tmp_name']);
       $name=addslashes($_FILES['file']['name']);
        $image=file_get_contents($image);
        $image=base64_encode($image);
        saveimage($name,$image,$con,$_SESSION["riad"][0]);
        
        

   }


  }
?>