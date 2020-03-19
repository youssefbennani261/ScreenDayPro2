<?php
require("connection.php");
require("PHPMailerAutoload.php");

session_start();
$op=isset($_GET["op"])?$_GET["op"]:0;
$op2=isset($_POST["op"])?$_POST["op"]:0;

if($op==1){
   $req=mysqli_query($con,"select CONCAT(' chambre ',pr.num_chambre),date(date_debut),date(date_fin),Detail from reservation r join demande d on r.Num_Demande=d.Num_Demande join agence a on a.Num_agence=d.Num_agence JOIN prix_chambre pr on pr.id_Prix=r.id_Prix where d.Num_Riad='{$_SESSION["agence"][10]}'  group by Nom_responsable ");
   while($row=$req->fetch_array()){
       $tab[]=array("title"=>$row[0],"start"=>$row[1],"end"=>$row[2]);
   }
   echo json_encode($tab);
}
if($op2==2){
    $respo=mysqli_escape_string($con,$_POST['respo']);
    $date_deb=mysqli_escape_string($con,$_POST['date_deb']);
    $date_fin=mysqli_escape_string($con,$_POST['date_fin']);
    $nbper=mysqli_escape_string($con,$_POST['nbper']);
    $detail=mysqli_escape_string($con,$_POST['detail']);
    $timestamp = date("Y-m-d H:i:s");
    $req=mysqli_query($con,"insert into demande values (0,'".$respo."','".$date_deb."','".$date_fin."','".$nbper."','".$detail."','".$timestamp."','{$_SESSION["agence"][0]}','{$_SESSION["agence"][10]}',0)");
    $req2=mysqli_query($con,"select r.email from riad r join agence a on a.Num_Riad=r.Num_Riad where a.Num_agence='{$_SESSION["agence"][0]}'");
    $rslt=$req2->fetch_assoc();
    $mail=new PHPMailer();
    $mail->isSMTP();
    $mail->Host='smtp.gmail.com';
    $mail->Port=587;
    $mail->SMTPAuth=true;
    $mail->SMTPSecure='tls';
    $mail->Username='';
    $mail->Password='';
    $mail->setFrom('agence_amal@gmail.com','amal' );
    $mail->addAddress($rslt["email"]);
    $mail->addReplyTo('');
    $mail->isHTML(true);
    $mail->Subject='Nouvelle Demande ! ';
    $mail->Body="Une demande a ete creer par '{$_SESSION["agence"][1]}' le '".$timestamp."'";
    if(!$mail->send())
    echo "walo";
    else 
    echo "kayn";
}
if($op==3){
    $req=mysqli_query($con,"select nom_responsable,DATE(Date_debut),DATE(Date_fin),Nbr_personne,DATE(Date_demande),vérifié from demande where num_agence='{$_SESSION["agence"][0]}'");
    while($row=$req->fetch_array()){
        $tab[]=array("Responsable"=>$row[0],"Date_Debut"=>$row[1],"Date_Fin"=>$row[2],"Personnes"=>$row[3],"date_demande"=>$row[4],"vérifié"=>$row[5]);
    }
    echo json_encode($tab);
}



?>