<?php
require("connection.php");
require("PHPMailerAutoload.php");
$op=mysqli_real_escape_string($con,$_POST["op"])?mysqli_real_escape_string($con,$_POST["op"]):0;
$user=mysqli_real_escape_string($con,$_POST["user"])?mysqli_real_escape_string($con,$_POST["user"]):'';
$pw= md5( mysqli_real_escape_string($con,$_POST["pw"])?mysqli_real_escape_string($con,$_POST["pw"]):'');
$nomagence=mysqli_real_escape_string($con,$_POST["nomagence"])?mysqli_real_escape_string($con,$_POST["nomagence"]):'';
$directeur=mysqli_real_escape_string($con,$_POST["directeuragence"])?mysqli_real_escape_string($con,$_POST["directeuragence"]):'';
$adresse=mysqli_real_escape_string($con,$_POST["adresse"])?mysqli_real_escape_string($con,$_POST["adresse"]):'';
$telephone=mysqli_real_escape_string($con,$_POST["telephone"])?mysqli_real_escape_string($con,$_POST["telephone"]):'';
$email=mysqli_real_escape_string($con,$_POST["email"])?mysqli_real_escape_string($con,$_POST["email"]):'';
$dateinscription=mysqli_real_escape_string($con,$_POST["dateinscription"])?mysqli_real_escape_string($con,$_POST["dateinscription"]):'';
$tabe=mysqli_real_escape_string($con,$_POST["tab"])?mysqli_real_escape_string($con,$_POST["tab"]):'';

$a=[];
session_start();
if($op==1){
 $req=mysqli_query($con,"insert into agence values(null,'".$nomagence."','".$directeur."','".$adresse."','".$telephone."','','".$email."','','','".$dateinscription."',".$_SESSION['riad'][0].")") or die ("!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!");
 $_COOKIE['id']=mysqli_insert_id($con);
 $ta=json_decode($tabe,true);
 $w=mysqli_insert_id($con);
   foreach($ta as $item){
  $req2=mysqli_query($con," insert into prix_chambre values(null,".$item["prix"].",".$item["idch"].",".$w.")");
   }
   $timestamp = date("Y-m-d H:i:s");
   $mail=new PHPMailer();
   $mail->isSMTP();
   $mail->Host='smtp.gmail.com';
   $mail->Port=587;
   $mail->SMTPAuth=true;
   $mail->SMTPSecure='tls';
   $mail->Username='';
   $mail->Password='';
   $mail->setFrom($_SESSION['riad'][5],$_SESSION['riad'][1]);
   $mail->addAddress($email);
   $mail->addReplyTo('Demande');
   $mail->isHTML(true);
   $mail->Subject='Nouvelle Demande ! ';
   $mail->Body="Envoyer la demande de ".$_SESSION['riad'][1]." dans une heure '".$timestamp."' pour Confirmation Creation votre site Web <a href='http://localhost:8080/ScreenDayPro2/pages/createLogin.html'>Cliquez Ici pour changer le mot de passe  </a> ";
   if($mail->send()){
      echo 1;
   }
   else 
   echo 0;


 
}
if($op==2){
     $req=mysqli_query($con,"select num_chambre,Designation,Nbr_Adulte,nbr_enfent from chambre where Num_Riad=".$_SESSION['riad'][0]."") or die ("!!!!!!!!!!!!!!!!!!");
  while($row=mysqli_fetch_array($req)){
     $tab[]=array("num_chambre"=>$row[0],"designation"=>$row[1],"nbr_adulte"=>$row[2],"nbr_enfent"=>$row[3]);
  }
   echo json_encode($tab);

}

if($op==4){
  
 $req=mysqli_query($con,"update agence set Login='".$user."' ,motdepasse='".$pw."' WHERE Num_agence=".$_COOKIE['id']."");
 echo 1;


}