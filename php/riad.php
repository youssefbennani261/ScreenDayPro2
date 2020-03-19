<?php
require("connection.php");
session_start();
$op=isset($_GET["op"])?$_GET["op"]:0;
$prix=isset($_GET["prix"])?$_GET["prix"]:0;
$demade=isset($_GET["demade"])?$_GET["demade"]:0;
$num_agence=isset($_GET["num_agence"])?$_GET["num_agence"]:0;
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
    $req1=mysqli_query($con,"select CONCAT(a.Nom,' ( chambre ',pr.num_chambre,' )'),date_debut,DATE_ADD(DATE(date_fin), INTERVAL 1 DAY),Detail from reservation r join demande d on r.Num_Demande=d.Num_Demande join agence a on a.Num_agence=d.Num_agence JOIN prix_chambre pr on pr.id_Prix=r.id_Prix where d.Num_Riad='{$_SESSION["riad"][0]}' group by Nom_responsable");
    while($row=$req1->fetch_array())
    $tab[]=array("title"=>$row[0],"start"=>$row[1],"end"=>$row[2],"detail"=>$row[3],"className"=>"bg-success");
    echo json_encode($tab);
}
if($op==3){
    $req=mysqli_query($con,"select Num_Demande,nom,Nom_responsable,Date_debut,Date_fin,Detail,a.Num_agence from demande d
    join agence a on d.Num_agence=a.Num_agence
    where d.Num_riad='{$_SESSION["riad"][0]}' and vérifié=0 ");
    while($row=$req->fetch_array())
    $tab[]=array("numdemande"=>$row[0],"nomagg"=>$row[1],"respo"=>$row[2],"datedeb"=>$row[3],"datefin"=>$row[4],"detail"=>$row[5],"Num_agence"=>$row[6]);
    echo json_encode($tab);
}
if($op==4){
    $req=mysqli_query($con,"select num_chambre,Nbr_Adulte,nbr_enfent from chambre where Cas_reservation=0 and Num_riad='{$_SESSION["riad"][0]}'");
    $req2=mysqli_query($con,"select * from prix_chambre where Num_agence='".$num_agence."'");
    while($row=$req->fetch_array())
    $tab[]=array("num_chambre"=>$row[0],"nbradulte"=>$row[1],"nbr_enfent"=>$row[2]);
    while($row=$req2->fetch_array())
    $tab2[]=array("id_Prix"=>$row[0],"Prix"=>$row[1],"num_chambre"=>$row[2]);
    echo json_encode(array("chambres"=>$tab,"prix"=>$tab2));
}

if($op==5){
    $timestamp = date("Y-m-d H:i:s");
    $tab=json_decode($prix, true);
    foreach ($tab as $item) {
        $prix1=$item["id_Prix"];
        $idchambre=$item["num_chambre"];
        $sql2="insert into reservation values (0,'".$timestamp."','".$prix1."','".$num_agence."','".$demade."')";
        $req2=mysqli_query($con,$sql2);
        $sql3="update chambre set Cas_reservation=1 where num_chambre='".$idchambre."'";
        $req3=mysqli_query($con,$sql3);
        $sql4="update demande set vérifié=1 where Num_Demande='".$demade."'";
        $req4=mysqli_query($con,$sql4);
       }
       echo "1";
}
if($op==6){
    $req=mysqli_query($con,"update demande set vérifié=2 where Num_Demande ='".$demade."'");
}
if($op==7){
    $req=mysqli_query($con,"select Nom,DATE(date_debut),DATE_ADD(DATE(date_fin), INTERVAL 1 DAY),detail from demande d join agence a on a.Num_agence=d.Num_agence where d.num_riad='{$_SESSION["riad"][0]}' and vérifié=0");
    if($req->num_rows === 0){
        echo "not found";
    }
    else{
        while($row=$req->fetch_array()){
            $tab[]=array("title"=>$row[0],"start"=>$row[1],"end"=>$row[2],"className"=>"bg-danger");
        }
        echo json_encode($tab);
    }

}
if($op==8){
    $req=mysqli_query($con,"select count(Num_demande),Nom from demande d JOIN agence a on a.Num_agence=d.Num_agence where vérifié=0 and d.num_riad='{$_SESSION["riad"][0]}'");
    while($row=$req->fetch_array()){
        $tab[]=array("nbr"=>$row[0],"nom"=>$row[1]);
    }
    $req2=mysqli_query($con,"select  count(id_email),Nom FROM emails e  JOIN agence a on a.Num_agence=e.Num_agence WHERE e.Num_Riad='{$_SESSION["riad"][0]}' and sender='agence' and deleted=0");
    while($row=$req2->fetch_array()){
        $tab2[]= array("nbr"=>$row[0],"nom"=>$row[1]);
    }
    $tab=array_merge($tab,$tab2);
   echo json_encode($tab);
}
mysqli_close($con);

?>