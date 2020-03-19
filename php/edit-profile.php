<?php
session_start();
require("connection.php");
require("PHPMailerAutoload.php");
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
$a=$_SESSION['riad'][0];
  if($op==1){
     $ver=mysqli_query($con,"select * From  riad where Login='".$user."' and Motdepasse='".$pw."'")  or die ("!!!!!!!!!!!!!!!!!!!!!!!!!!!");
     if (mysqli_num_rows($ver)!=0){
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
     $mail->addAddress('');
     $mail->addReplyTo('');
     $mail->isHTML(true);
     $mail->Subject='Nouvelle Demande ! ';
     $mail->Body="Envoyer la demande de ".$_SESSION['riad'][1]." dans une heure '".$timestamp."' pour changer le mot de passe <a href='http://localhost:8080/ScreenDayPro2/pages/edit-motdepasse-riad.html'>Cliquez Ici pour changer le mot de passe  </a> ";
     if(!$mail->send())
     echo 1;
     else 
     echo 0;

}
else
   echo 1;
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
     

  if($op==3){
     $ver=mysqli_query($con,"select * From  riad where Login='".$user."' and Motdepasse='".$pw."'")  or die ("!!!!!!!!!!!!!!!!!!!!!!!!!!!");
     if (mysqli_num_rows($ver)!=0){        
mysqli_query($con,"UPDATE riad SET Motdepasse ='".$pwafter."'WHERE Num_Riad= ".$_SESSION['riad'][0]."") or die("requite!!!!!!!!");
echo 1;
     }
      }


     
  mysqli_close($con);
?>