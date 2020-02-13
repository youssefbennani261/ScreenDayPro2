<?php
require("connection.php");
session_start();
$op=isset($_GET["op"])?$_GET["op"]:0;
if($op==1){
    $req=mysqli_query($con,"select COUNT(Id_reservation)
    FROM reservation r 
    join prix_chambre pr on pr.id_Prix=r.id_Prix
    join chambre c on c.num_chambre=pr.num_chambre
    join riad rd on rd.Num_Riad=c.Num_Riad
    WHERE MONTH(Date_reservation) = MONTH(CURRENT_DATE()) 
    and YEAR(Date_reservation) = YEAR(CURDATE()) and rd.Num_Riad='{$_SESSION["riad"][0]}'
    ");
    $req2=mysqli_query($con,"select SUM(pr.Prix)
    from reservation r
    join prix_chambre pr on pr.id_Prix=r.id_Prix
    join chambre c on c.num_chambre=pr.num_chambre
    join riad rd on rd.Num_Riad=c.Num_Riad
    WHERE MONTH(Date_reservation) = MONTH(CURRENT_DATE())
    and YEAR(Date_reservation) = YEAR(CURDATE()) and rd.Num_Riad='{$_SESSION["riad"][0]}'
    ");
    $req3=mysqli_query($con,"
	select COUNT(Id_reservation)
    FROM reservation r 
    join prix_chambre pr on pr.id_Prix=r.id_Prix
    join chambre c on c.num_chambre=pr.num_chambre
    join riad rd on rd.Num_Riad=c.Num_Riad
    WHERE MONTH(Date_reservation) = MONTH(CURRENT_DATE())-1
    and YEAR(Date_reservation) = YEAR(CURDATE()) and rd.Num_Riad='{$_SESSION["riad"][0]}'");
    $req4=mysqli_query($con,"
	select SUM(pr.Prix)
    from reservation r
    join prix_chambre pr on pr.id_Prix=r.id_Prix
    join chambre c on c.num_chambre=pr.num_chambre
    join riad rd on rd.Num_Riad=c.Num_Riad
    WHERE MONTH(Date_reservation) = MONTH(CURRENT_DATE())-1
    and YEAR(Date_reservation) = YEAR(CURDATE()) and rd.Num_Riad='{$_SESSION["riad"][0]}'");
    $req5=mysqli_query($con,"select COUNT(num_chambre)
    from chambre
    where Cas_reservation=1 
    and Num_Riad='{$_SESSION["riad"][0]}'");
    $req6=mysqli_query($con,"select COUNT(num_chambre)
    from chambre
    where Cas_reservation=0 and Num_Riad='{$_SESSION["riad"][0]}'");
    $req7=mysqli_query($con,"select COUNT(num_chambre)
    from chambre where Num_Riad='{$_SESSION["riad"][0]}'");

    $tab=array($req->fetch_assoc(),$req2->fetch_assoc(),$req3->fetch_assoc(),$req4->fetch_assoc(),$req5->fetch_assoc(),$req6->fetch_assoc(),$req7->fetch_assoc());
    echo json_encode($tab);
}

?>