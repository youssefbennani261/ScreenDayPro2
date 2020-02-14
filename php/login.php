<?php
#ini_set("display_errors",1);
require("connection.php");
$login=isset($_POST["login"])?$_POST["login"]:"";
$pwd=isset($_POST["pwd"])?$_POST["pwd"]:"";
$pwd1=md5($pwd);
$req=mysqli_query($con,"select * from riad where (Email='".$login."' or Login='".$login."' )  and Password='".$pwd1."'");
if($req->num_rows>0){
session_start();
$_SESSION["riad"]=$req->fetch_array();
echo "1";
}
else if ($req->num_rows==0){
$req=mysqli_query($con,"select * from agence where (Login='".$login."' or Email='".$login."') and Password='".$pwd1."'");
if($req->num_rows>0 ){
    session_start();
    $_SESSION["agence"]=$req->num_rows?$req->fetch_array():$req2->fetch_array();
    echo "1";
    }
}
else
echo "0";
?>