<?php
require("connection.php");
$op=isset($_POST['op'])?$_POST['op']:0;
$user=isset($_POST['user'])?$_POST['user']:'';
$pw= md5(isset($_POST['pw'])?$_POST['pw']:'');
$pwafter= md5( isset($_POST['pwafter'])?$_POST['pwafter']:'');
  if($op==1){
$ver=mysqli_query($con,"select * From  riad where Login='".$user."' and Motdepasse='".$pw."'")  or die ("!!!!!!!!!!!!!!!!!!!!!!!!!!!");
if (mysqli_num_rows($ver)!=0){
    $ecra=mysqli_query($con,"update riad set Motdepasse ='".$pwafter."' where login='".$user."'}") or die("requite!!!!!!!!");
echo 1;
}
else
   echo 0;
  }

  mysqli_close($con);
?>