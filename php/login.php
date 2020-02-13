<?php
require("connection.php");
$login=isset($_POST["login"])?$_POST["login"]:"";
$pwd=isset($_POST["pwd"])?$_POST["pwd"]:"";
$req=mysqli_query($con,"select * from riad where Login='".$login."'  and Password='".$pwd."'");
$req2=mysqli_query($con,"select * from riad where Email='".$login."'  and Password='".$pwd."'");
if($req->num_rows>0 or $req2->num_rows>0){
session_start();
$_SESSION["riad"]=$req->num_rows?$req->fetch_array():$req2->fetch_array();
echo "1";
}
else if ($req->num_rows==0 or $req2->num_rows==0){
$req=mysqli_query($con,"select * from agence where Login='".$login."'  and Password='".$pwd."'");
$req2=mysqli_query($con,"select * from agence where Email='".$login."'  and Password='".$pwd."'");
if($req->num_rows>0 or $req2->num_rows>0){
    session_start();
    $_SESSION["agence"]=$req->num_rows?$req->fetch_array():$req2->fetch_array();
    echo "1";
    }
}
else
echo "0";
?>