<?php
  require("connection.php");
  session_start();
  $cas=1;
  $tab=[];
  if($cas==1){
      $reponce=mysqli_query($con,"select src from Mesimages where num_riad='{$_SESSION["riad"][0]}'");
     while($row=mysqli_fetch_array($reponce)){
         $tab[]=array("src"=>$row[0]);
     }
      $data=json_encode($tab);
      echo $data;
  }
?>