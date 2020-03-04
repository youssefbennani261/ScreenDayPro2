<?php
session_start();
 require("connection.php");
 require("PHPMailerAutoload.php");
 $user=isset($_POST['user'])?$_POST['user']:'';
 $pw=md5(isset($_POST['pw'])?$_POST['pw']:'');
 $pwafter=md5(isset($_POST['pwafter'])?$_POST['pwafter']:'');
 $op=isset($_POST['op'])?$_POST['op']:0;
 $nom=isset($_POST['nomagence'])?$_POST['nomagence']:"";
 $directeur=isset($_POST['Directeur'])?$_POST['Directeur']:"";
 $email=isset($_POST['email'])?$_POST['email']:"";
 $adresse=isset($_POST['adresse'])?$_POST['adresse']:"";
 $telephone=isset($_POST['tel'])?$_POST['tel']:"";
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
        $mail->addAddress('TannoucheBennaniYoussef@gmail.com');
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