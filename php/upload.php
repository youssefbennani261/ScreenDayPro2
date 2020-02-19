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
 $sql="insert into mesimages values(0,'".$location2."','".$_SESSION["riad"][0]."')";
$req=mysqli_query($con,$sql);
}

?>