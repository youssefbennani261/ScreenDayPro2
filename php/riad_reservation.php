<?php
require("connection.php");
session_start();
$op=0;
$op=isset($_POST['op'])?$_POST['op']:0;
$id=isset($_POST['id'])?$_POST['id']:0;
$date=isset($_POST['date'])?$_POST['date']:"";

if($op==1){
$req=mysqli_query($con,"select a.Nom,d.Date_debut,d.Date_fin,d.Nom_responsable,d.Nbr_personne,p.Prix as somme from agence a join demande d on a.Num_agence=d.Num_agence join reservation r ON d.Num_Demande=r.Num_Demande join prix_chambre p on r.id_Prix=p.id_Prix WHERE a.Num_Riad=".$_SESSION['riad'][0]." and a.Num_agence=".$id." ORDER BY d.Date_demande ASC") or die("!!!!!!!!!!!!!!!");

while($row=mysqli_fetch_array($req)){
$tab[]=array("nom"=>$row[0],"dd"=>$row[1],"df"=>$row[2],"prix"=>$row[3],"nrespo"=>$row[4],"nbr"=>$row[5]);
}
echo json_encode($tab);
}
if($op==2){
    $req1=mysqli_query($con,"select Nom,Directeur,Adresse,Telephone,Logo_src,Email from agence where Num_agence=".$id."");
    while($row=mysqli_fetch_array($req1)){
        $tab2[]=array("Nom"=>$row[0],"Directeur"=>$row[1],"Adresse"=>$row[2],"Telephone"=>$row[3],"Logo"=>$row[4],"email"=>$row[5]);
        }
   echo json_encode($tab2);

}
if($op==3){
    $req2=mysqli_query($con,"select a.Nom,d.Date_debut,d.Date_fin,p.Prix,d.Nom_responsable,d.Nbr_personne  from agence a join demande d on a.Num_agence=d.Num_agence join reservation r ON d.Num_Demande=r.Num_Demande join prix_chambre p on r.id_Prix=p.id_Prix WHERE a.Num_Riad=1 and a.Num_agence=1  and d.Date_debut>='".$date."' ORDER BY d.Date_demande ASC ") or die("!!!!!!!!!!!!!!!");
if(mysqli_num_rows($req2)){
     while($row=mysqli_fetch_array($req2)){
    $tab[]=array("nom"=>$row[0],"dd"=>$row[1],"df"=>$row[2],"prix"=>$row[3],"nrespo"=>$row[4],"nbr"=>$row[5]);
    }
    echo json_encode($tab);   
}
    
}
?>