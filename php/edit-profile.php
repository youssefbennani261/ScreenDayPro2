<?php
require("connection.php");
$op=isset($_POST['op'])?$_POST['op']:0;
$user=isset($_POST['user'])?$_POST['user']:'';
$pw= md5(isset($_POST['pw'])?$_POST['pw']:'');
$pwafter= md5( isset($_POST['pwafter'])?$_POST['pwafter']:'');
  if($op==1){
$ver=mysqli_query($con,"select * From  riad where Login='".$user."' and Password='".$pw."'")  or die ("!!!!!!!!!!!!!!!!!!!!!!!!!!!");
if (($ver->num_rows)==0)
    echo 0;
else
  $ecra=mysqli_query($con,"update riad set Password ='".$pwaftercripte."'") or die("requite!!!!!!!!1");
  echo $pwaftercripte;
  }
  


?>