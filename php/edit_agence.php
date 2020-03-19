<?php
session_start();
 require("connection.php");
 require("PHPMailerAutoload.php");
$user=mysqli_real_escape_string($con,$_POST["user"])?mysqli_real_escape_string($con,$_POST["user"]):'';
$pw= md5(mysqli_real_escape_string($con,$_POST["pw"])?mysqli_real_escape_string($con,$_POST["pw"]):'');
$pwafter=md5(mysqli_real_escape_string($con,$_POST["pwafter"])?mysqli_real_escape_string($con,$_POST["pwafter"]):'');
$op=mysqli_real_escape_string($con,$_POST["op"])?mysqli_real_escape_string($con,$_POST["op"]):'';
$nom=mysqli_real_escape_string($con,$_POST["nomagence"])?mysqli_real_escape_string($con,$_POST["nomagence"]):'';
$directeur=mysqli_real_escape_string($con,$_POST["Directeur"])?mysqli_real_escape_string($con,$_POST["Directeur"]):'';
$email=mysqli_real_escape_string($con,$_POST["email"])?mysqli_real_escape_string($con,$_POST["email"]):'';
$adresse=mysqli_real_escape_string($con,$_POST["adresse"])?mysqli_real_escape_string($con,$_POST["adresse"]):'';
$telephone=mysqli_real_escape_string($con,$_POST["tel"])?mysqli_real_escape_string($con,$_POST["tel"]):'';

 $cas=0;
 

    if($op==1)
    {
            if($nom!="")
            {
              $req=mysqli_query($con," update agence set Nom='".$nom."' where Num_agence=".$_SESSION['agence'][0]."") or die ("!!!!!!!!!!!!!!!!!!!!!!!!!!") ;$cas=1;
            }  
            if($directeur!="")
            {
                $req=mysqli_query($con," update agence set Directeur='".$directeur."' where Num_agence=".$_SESSION['agence'][0]."") or die ("!!!!!!!!!!!!!!!!!!!!!!!!!!") ;$cas=1;
            } if($email!="")
            {
                $req=mysqli_query($con," update agence set email='".$email."' where Num_agence=".$_SESSION['agence'][0]."") or die ("!!!!!!!!!!!!!!!!!!!!!!!!!!") ;$cas=1;
            } if($adresse!="")
            {
                $req=mysqli_query($con," update agence set adresse='".$adresse."' where Num_agence=".$_SESSION['agence'][0]."") or die ("!!!!!!!!!!!!!!!!!!!!!!!!!!") ;$cas=1;
            } if($telephone!="")
            {
                $req=mysqli_query($con," update agence set telephone='".$telephone."' where Num_agence=".$_SESSION['agence'][0]."") or die ("!!!!!!!!!!!!!!!!!!!!!!!!!!") ;$cas=1;

            }
    echo $cas;


    }
    if($op==2){

     $resu=mysqli_query($con,"select 1 from agence WHERE Login='".$user."' && motdepasse='".$pw."'");
     if(mysqli_num_rows($resu)){
        $timestamp = date("Y-m-d H:i:s");
        $mail=new PHPMailer();
        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->Port=587;
        $mail->SMTPAuth=true;
        $mail->SMTPSecure='tls';
        $mail->Username='';
        $mail->Password='';
        $mail->setFrom($_SESSION['agence'][6],$_SESSION['agence'][1]);
        $mail->addAddress('@gmail.com');
        $mail->addReplyTo('');
        $mail->isHTML(true);
        $mail->Subject='Nouvelle Demande ! ';
        $mail->Body="Envoyer la demande de ".$_SESSION['agence'][1]." dans une heure '".$timestamp."' pour changer le mot de passe <a href='http://localhost:8080/ScreenDayPro2/pages/edit-motdepasse-agence.html'>Cliquez Ici pour changer le mot de passe  </a> ";
        if(!$mail->send())
        echo 1;
        else 
        echo 0;
     }
    else 
       echo 1;

    }
if($op==4){
    
    $resu=mysqli_query($con,"select 1 from agence WHERE Login='".$user."' and motdepasse='".$pw."'");
    if(mysqli_num_rows($resu)){
     $resu1=mysqli_query($con,"update agence SET motdepasse='".$pwafter."' where num_agence =".$_SESSION['agence'][0].""); 
    echo $cas=1;
   }else
    echo $cas=0;
} 
if($op==5){

  $req1=mysqli_query($con,"select Email from riad WHERE Email='".$email."'");
    if(mysqli_num_rows($req1)==0){
      $req2=mysqli_query($con,"select Email from agence WHERE Email='".$email."'");
        if(mysqli_num_rows($req2)){
            $timestamp = date("Y-m-d H:i:s");
            $mail=new PHPMailer();
            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->Port=587;
            $mail->SMTPAuth=true;
            $mail->SMTPSecure='tls';
            $mail->Username='';
            $mail->Password='';
            $mail->setFrom('security','Recuperatoin le Mot de passe');
            $mail->addAddress($email);
            $mail->addReplyTo('Demande');
            $mail->isHTML(true);
            $mail->Subject='Nouvelle Demande ! ';
            $mail->Body="Envoyer la demande De Recuperation Mot de passe dans une heure '".$timestamp."' pour Recuperation le mot de passe <a href='http://localhost:8080/ScreenDayPro2/pages/recuperation.html'>Cliquez Ici pour changer le mot de passe  </a> ";
            if(!$mail->send())
            echo 0;
            else 
            echo 1;

        }
        else
        echo 0;


    }
    else{

        $timestamp = date("Y-m-d H:i:s");
        $mail=new PHPMailer();
        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->Port=587;
        $mail->SMTPAuth=true;
        $mail->SMTPSecure='tls';
        $mail->Username='';
        $mail->Password='';
        $mail->setFrom('security','Recuperatoin le Mot de passe');
        $mail->addAddress($email);
        $mail->addReplyTo('Demande');
        $mail->isHTML(true);
        $mail->Subject='Nouvelle Demande ! ';
        $mail->Body="Envoyer la demande De Recuperation Mot de passe dans une heure '".$timestamp."' pour Recuperation le mot de passe <a href='http://localhost:8080/ScreenDayPro2/pages/recuperation.html'>Cliquez Ici pour changer le mot de passe  </a> ";
        if(!$mail->send())
        echo 0;
        else 
        echo 1;
    }
}

if($op==6){

    $req1=mysqli_query($con,"select Email from riad WHERE Email='".$email."'");
    if(mysqli_num_rows($req1)==0){
      $req2=mysqli_query($con,"select Email from agence WHERE Email='".$email."'");
        if(mysqli_num_rows($req2)){ 
            $r=mysqli_query($con,"update agence set Motdepasse='".$pw."' where Email='".$email."'");
            echo 1;
        }
        else
        echo 0;


    }
    else{
      $r=mysqli_query($con,"update riad set Motdepasse='".$pw."' where Email='".$email."'");
        echo 1;

    }
}


if($_FILES["file"]["name"] != '')
{
require("connection.php");
session_start();
 $test = explode('.', $_FILES["file"]["name"]);
 $ext = end($test);
 $name = rand(100, 999) . '.' . $ext;
 $location = '../uploads/' . $name;
 move_uploaded_file($_FILES["file"]["tmp_name"], $location);
 $location2='../uploads/'.$name;
 $sql="update agence set Logo_src ='".$location2."' where Num_agence=".$_SESSION["agence"][0]."";
 $_SESSION['agence'][5]=$location2;
 $req=mysqli_query($con,$sql);
}
    

?>