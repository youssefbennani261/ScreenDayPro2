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
if($op==2){
    $req1=mysqli_query($con,"select Nom_responsable,date(date_debut),date(date_fin) from reservation r join demande d on r.Num_Demande=d.Num_Demande where Num_Riad=1 and MONTH(Date_reservation) = MONTH(CURRENT_DATE()) and YEAR(Date_reservation) = YEAR(CURDATE())");
    while($row=$req1->fetch_array())
    $tab[]=array("title"=>$row[0],"start"=>$row[1],"end"=>$row[2]);
    echo json_encode($tab);
}
if($op==3){
    $req=mysqli_query($con,"select Num_Demande,nom,Nom_responsable,Date_debut,Date_fin,Detail from demande d
    join agence a on d.Num_agence=a.Num_agence
    where Num_riad='{$_SESSION["riad"][0]}'");
    while($row=$req->fetch_array())
    $tab[]=array("numdemande"=>$row[0],"nomagg"=>$row[1],"respo"=>$row[2],"datedeb"=>$row[3],"datefin"=>$row[4],"detail"=>(substr_count( $row[5], "\n" ))==0?1:substr_count( $row[5], "\n" ));
    echo json_encode($tab);
}
if($op==4){
    $req=mysqli_query($con,"select num_chambre,Nbr_Adulte+nbr_enfent from chambre where Cas_reservation=0 and Num_riad='{$_SESSION["riad"][0]}'");
    while($row=$req->fetch_array())
    $tab[]=array("num_chambre"=>$row[0],"nbrpers"=>$row[1]);
    echo json_encode($tab);
}

?>