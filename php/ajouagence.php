<?php
require("connection.php");
$op=isset($_POST['op'])?$_POST['op']:0;
$nomagence=isset($_POST['nomagence'])?$_POST['nomagence']:'';
$directeur=isset($_POST['directeuragence'])?$_POST['directeuragence']:'';
$adresse=isset($_POST['adresse'])?$_POST['adresse']:'';
$telephone=isset($_POST['telephone'])?$_POST['telephone']:'';
$email=isset($_POST['email'])?$_POST['email']:'';
$dateinscription=isset($_POST['dateinscription'])?$_POST['dateinscription']:'';
$login=isset($_POST['login'])?$_POST['login']:'';
$motdepasse=isset($_POST['motdepasse'])?$_POST['motdepasse']:'';
$tabe=isset($_POST['tab'])?$_POST['tab']:'';
$a=[];
session_start();
if($op==1){
 $req=mysqli_query($con,"insert into agence values(null,'".$nomagence."','".$directeur."','".$adresse."','".$telephone."','','".$email."','".$login."','".md5($motdepasse)."','".$dateinscription."',".$_SESSION['riad'][0].")") or die ("!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!");
 $ta=json_decode($tabe,true);
 $w=mysqli_insert_id($con);
   foreach($ta as $item){
  $req2=mysqli_query($con," insert into prix_chambre values(null,".$item["prix"].",".$item["idch"].",".$w.")");

   }

 echo 1;
}
if($op==2){
     $req=mysqli_query($con,"select num_chambre,Designation,Nbr_Adulte,nbr_enfent from chambre where Num_Riad=".$_SESSION['riad'][0]."") or die ("!!!!!!!!!!!!!!!!!!");
  while($row=mysqli_fetch_array($req)){
     $tab[]=array("num_chambre"=>$row[0],"designation"=>$row[1],"nbr_adulte"=>$row[2],"nbr_enfent"=>$row[3]);
  }
   echo json_encode($tab);

}
