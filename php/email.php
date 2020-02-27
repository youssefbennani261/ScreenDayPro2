<?php
  require("connection.php");
  session_start();
  $op=isset($_GET['op'])?$_GET['op']:0;
  $op2=isset($_POST['op'])?$_POST['op']:0;
  $agg=isset($_POST['agence'])?$_POST['agence']:0;
  $sujet=isset($_POST['sujet'])?$_POST['sujet']:"";
  $content=isset($_POST['content'])?$_POST['content']:"";
  $emails=isset($_POST['emails'])?$_POST['emails']:"";
  if($op==1){
      if(isset($_SESSION["riad"])){
          $req=mysqli_query($con,"select logo_src,Nom,sujet,content,e.num_agence,id_email,date_envoi from emails e join agence a on a.Num_agence=e.Num_agence where e.Num_Riad='{$_SESSION["riad"][0]}' and sender='agence'");
          while($row=$req->fetch_array()){
              $tab[]=array("logo_src"=>$row[0],"Nom"=>$row[1],"sujet"=>$row[2],"content"=>$row[3],"numag"=>$row[4],"id_email"=>$row[5],"date_envoi"=>$row[6]);
          }
          echo json_encode($tab);
  
      }

    //   if(isset($_SESSION["agence"])){

    //   }

  }
  if($op2==2){
      $sql="insert into emails values (0,'".$agg."','{$_SESSION["riad"][0]}','riad','".$sujet."','".$content."')";
      $req=mysqli_query($con,$sql);
  }
  if($op==2){
    $req=mysqli_query($con,"select Num_agence,Nom from agence where Num_Riad='{$_SESSION["riad"][0]}'");
    while($row=$req->fetch_array()){
      $tab[]=array("Num_agence"=>$row[0],"Nom"=>$row[1]);
    }
    echo json_encode($tab);
  }
  if($op2==3){
    $sql="insert into emails values (0,'".$agg."','{$_SESSION["riad"][0]}','riad','".$sujet."','".$content."',CURRENT_TIME)";
    $req=mysqli_query($con,$sql);
  }
  if($op==3){
    $req=mysqli_query($con,"select Nom_Riad,sujet,content,r.logo_src,Nom,date_envoi from emails e join riad r on e.Num_Riad=r.Num_Riad join agence a on e.Num_agence=a.Num_agence where e.Num_riad='{$_SESSION["riad"][0]}' and sender='riad'");
    while($row=$req->fetch_array()){
      $tab[]=array("Nom_Riad"=>$row[0],"sujet"=>$row[1],"content"=>$row[2],"logo_src"=>$row[3],"nom_ag"=>$row[4],"date_envoi"=>$row[5]);
    }
    echo json_encode($tab);
 
  }
  if($op2==4){
    $tab=json_decode($emails, true);
    foreach ($tab as $item){
      $req=mysqli_query($con,"delete from emails where id_email='".$item."'");
    }
  }



?>