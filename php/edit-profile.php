<?php
require("connection.php");
session_start();
$op=isset($_POST['op'])?$_POST['op']:0;
$user=isset($_POST['user'])?$_POST['user']:'';
$pw= md5(isset($_POST['pw'])?$_POST['pw']:'');
$pwafter= md5( isset($_POST['pwafter'])?$_POST['pwafter']:'');
$nom=isset($_POST['nomriad'])?$_POST['nomriad']:'';
$directeur=isset($_POST['Directeur'])?$_POST['Directeur']:'';
$email=isset($_POST['email'])?$_POST['email']:'';
$detail=isset($_POST['Detail'])?$_POST['Detail']:'';
$adresse=isset($_POST['adresse'])?$_POST['adresse']:'';
$cas=-1;
$a=$_SESSION["riad"][0];
  if($op==1){
$ver=mysqli_query($con,"select * From  riad where Login='".$user."' and Motdepasse='".$pw."'")  or die ("!!!!!!!!!!!!!!!!!!!!!!!!!!!");
if (mysqli_num_rows($ver)!=0){
  $a=$_SESSION["riad"][0];
    $ecra=mysqli_query($con,"update riad set Motdepasse ='".$pwafter."' where Num_Riad=".$a."") or die("requite!!!!!!!!");
echo 1;
}
else
   echo 0;
  }
  if($op==2){
 if($nom!=""){
       $req=mysqli_query($con,"update riad set Nom_Riad ='".$nom."' where Num_Riad=".$a."") or die  (" !!!!!!!!!!!!!!!!!!!!");$cas=1;}
if($directeur!=""){
       $req=mysqli_query($con,"update riad set Directeur ='".$directeur."' where Num_Riad=".$a."") or die  (" !!!!!!!!!!!!!!!!!!!!");$cas=1;}
  if($email!=""){
       $req=mysqli_query($con,"update riad set Email ='".$email."' where Num_Riad=".$a."") or die  (" !!!!!!!!!!!!!!!!!!!!");$cas=1;}
  if($detail!=""){
       $req=mysqli_query($con,"update riad set Detail_Riad ='".$detail."' where Num_Riad=".$a."") or die  (" !!!!!!!!!!!!!!!!!!!!");$cas=1;}
  if($adresse!=""){
       $req=mysqli_query($con,"update riad set Adresse ='".$adresse."' where Num_Riad=".$a."") or die  (" !!!!!!!!!!!!!!!!!!!!");$cas=1;}
  echo $cas;
      }

  mysqli_close($con);
?>