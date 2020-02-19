<?php
require("connection.php");
session_start();
         $id=$_SESSION['riad'][0];
      $req=mysqli_query($con,"select a.Num_agence, a.Nom,a.Directeur,a.Adresse,a.Telephone from agence a join demande d on a.Num_agence=d.Num_agence join reservation r on r.Num_Demande =d.Num_Demande  and d.Num_Riad=".$id." group by a.Num_agence ") or die ("!!!!!!!!!!!!!!!!!!");
 while($row=mysqli_fetch_array($req))
     $tab[]=array("num"=>$row[0],"nom"=>$row[1],"directeur"=>$row[2],"adresse"=>$row[3],"tel"=>$row[4]);
 
     echo json_encode($tab);
?>