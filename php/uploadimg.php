<?php
if($_FILES["file"]["name"] != '')
{
require("connection.php");
session_start();
 $test = explode('.', $_FILES["file"]["name"]);
 $ext = end($test);
 $name = rand(100, 999) . '.' . $ext;
 $location = '../uploads/' . $name;
 move_uploaded_file($_FILES["file"]["tmp_name"], $location);
 $location2='uploads/'.$name;
 $sql="update riad set Logo_src ='".$location2."' where Num_Riad=".$_SESSION["riad"][0]."";
 $_SESSION['riad'][2]=$location2;
 $req=mysqli_query($con,$sql);
}

?>
