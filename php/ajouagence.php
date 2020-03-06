<?php
require("connection.php");
require("PHPMailerAutoload.php");
$op=isset($_POST['op'])?$_POST['op']:0;
$user=isset($_POST['user'])?$_POST['user']:'';
$pw= md5(isset($_POST['pw'])?$_POST['pw']:'');
$nomagence=isset($_POST['nomagence'])?$_POST['nomagence']:'';
$directeur=isset($_POST['directeuragence'])?$_POST['directeuragence']:'';
$adresse=isset($_POST['adresse'])?$_POST['adresse']:'';
$telephone=isset($_POST['telephone'])?$_POST['telephone']:'';
$email=isset($_POST['email'])?$_POST['email']:'';
$dateinscription=isset($_POST['dateinscription'])?$_POST['dateinscription']:'';

$tabe=isset($_POST['tab'])?$_POST['tab']:'';
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
   $mail->addAddress("'".$email."'");
   $mail->addReplyTo('');
   $mail->isHTML(true);
   $mail->Subject='Nouvelle Demande ! ';
   $mail->Body="Envoyer la demande de ".$_SESSION['riad'][1]." dans une heure '".$timestamp."' pour Confirmation Creation votre site Web <a href='http://localhost:8080/ScreenDayPro2/pages/createLogin.html?id=3'>Cliquez Ici pour changer le mot de passe  </a> ";
   
 echo 1;
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