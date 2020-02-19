<?php
require("connection.php");
session_start();
$op=isset($_POST['op'])?$_POST['op']:0;
$id=isset($_POST['id'])?$_POST['id']:0;
if($op==1){
$req=mysqli_query($con,"select a.Nom,d.Date_debut,d.Date_fin,p.Prix,d.Nom_responsable,d.Nbr_personne from agence a JOIN demande d on a.Num_agence=d.Num_agence JOIN reservation r on d.Num_Demande=r.Num_Demande join riad rd on rd.Num_Riad =d.Num_Riad join prix_chambre p on p.id_Prix=r.id_Prix WHERE a.Num_agence=".$id." GROUP BY r.Id_reservation ORDER BY d.Date_demande ASC") or die("!!!!!!!!!!!!!!!");
while($row=mysqli_fetch_array($req)){
$tab[]=array("nom"->$row[0],"dd"->$row[1],"df"->$row[2],"prix"->$row[3],"nrespo"->$row[4],"nbr"->$row[5]);
}
echo json_encode($tab);

}






















?>