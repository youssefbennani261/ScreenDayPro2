<?php
require("connection.php");
session_start();
$op=isset($_GET['op'])?$_GET['op']:0;
$op2=isset($_POST['op'])?$_POST['op']:0;
$respo=isset($_POST['respo'])?$_POST['respo']:"";
$date_deb=isset($_POST['date_deb'])?$_POST['date_deb']:"";
$date_fin=isset($_POST['date_fin'])?$_POST['date_fin']:"";
$nbper=isset($_POST['nbper'])?$_POST['nbper']:0;
$detail=isset($_POST['detail'])?$_POST['detail']:"";
if($op==1){
   $req=mysqli_query($con,"select CONCAT(a.Nom,' ( chambre ',pr.num_chambre,' )'),date(date_debut),date(date_fin),Detail from reservation r join demande d on r.Num_Demande=d.Num_Demande join agence a on a.Num_agence=d.Num_agence JOIN prix_chambre pr on pr.id_Prix=r.id_Prix where d.Num_Riad='{$_SESSION["agence"][10]}' and MONTH(Date_reservation) = MONTH(CURRENT_DATE()) and YEAR(Date_reservation) = YEAR(CURDATE()) group by Nom_responsable ");
   while($row=$req->fetch_array()){
       $tab[]=array("title"=>$row[0],"start"=>$row[1],"end"=>$row[2]);
   }
   echo json_encode($tab);
}
if($op2==2){
    $timestamp = date("Y-m-d H:i:s");
    $req=mysqli_query($con,"insert into demande values (0,'".$respo."','".$date_deb."','".$date_fin."','".$nbper."','".$detail."','".$timestamp."','{$_SESSION["agence"][0]}','{$_SESSION["agence"][10]}',0)");
}







?>