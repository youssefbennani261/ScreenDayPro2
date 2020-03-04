<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>Modification Profile </title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/plugins/dropify/css/dropify.min.css">
<!-- Favicon-->
<?php
session_start();
if(!isset($_SESSION["agence"])){header("Location: http://localhost:8080/ScreenDayPro2/sign-in.html");} ?>
<link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
<!-- Custom Css -->
<link rel="stylesheet" href="../assets/css/style.min.css">
</head>

<body class="theme-blush">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img class="zmdi-hc-spin" src="../assets/images/loader.svg" width="48" height="48" alt="Aero"></div>
        <p>Please wait...</p>
    </div>
</div>

<!-- Overlay For Sidebars -->
<div class="overlay"></div>

<!-- Main Search -->
<div id="search">
    <button id="close" type="button" class="close btn btn-primary btn-icon btn-icon-mini btn-round">x</button>
    <form>
        <input type="search" value="" placeholder="Search..." />
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>

<!-- Right Icon menu Sidebar -->
<?php $path=$_SERVER["DOCUMENT_ROOT"]."/ScreenDayPro2/pages/"; include($path."menudroit_agence.html");?>


<!-- Left Sidebar -->
<?php $path=$_SERVER["DOCUMENT_ROOT"]."/ScreenDayPro2/pages/"; include($path."menugauche_agence.html");?>
<!-- <aside id="leftsidebar" class="sidebar">
 
</aside> -->

<!-- Right Sidebar -->


<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Profile Edit</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="zmdi zmdi-home"></i> Agence</a></li>
                        <li class="breadcrumb-item">Pages</li>
                        <li class="breadcrumb-item">Profile</li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    <a href="profile.php" class="btn btn-info btn-icon float-right"><i class="zmdi zmdi-check"></i></a>
                </div>
            </div>
        </div> 
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                <div class="card">
                        <div class="header">
                            <h2><strong>Picture</strong> Settings</h2>
                        </div>
                        <div class="body clearfix">
                            <div class="row">
                                               
                                <img id="imgprofile" src=<?php echo $_SESSION['agence'][5] ?>   class="rounded-circle shadow " alt="profile-image">                               <div class="col-12">
                                                                      
                                </div>
                                  
                                                           
                            </div>    
                        <input type='file' class='dropify' id='fileup'/><br><br>
                        <button type="button" class='btn btn-primary float-right' id='sendfile'>Upload</button>
          
                        </div>
                    </div>
                    <div class="card">
                        <div class="header">
                            <h2><strong>Account</strong> Settings</h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control info"  id="nomagence" placeholder="Nom agence">
                                    </div>
                                </div>                                    
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control info" id="Directeur" placeholder="Directeur">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control info" id="email" placeholder="E-mail">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control  info" id="adresse" placeholder="Adresse">
                                    </div>
                                </div>
                              
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control  info" id="telephone" placeholder="Telephone">
                                    </div>
                                </div>
                               
                                <div class="col-md-12">
                                    <button class="btn btn-primary" onclick="saveinfo()">Save Changes</button>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header">
                            <h2><strong>Security</strong> Settings</h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <input type="text" id="user" class="form-control" placeholder="Username">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <input type="password" id="pw" class="form-control" placeholder="Current Password">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-info" onclick="chengerpassword()">Envoyer demande changer </button>
                                </div>                                
                            </div>                              
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Jquery Core Js --> 

<script src="../js/jquery.min.js"></script>
<script src="../assets/js/pages/ui/notifications.js"></script> <!-- Custom Js -->
<script src="../js/main_agence.js"></script>
<script src="../assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="../assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
 <script src="../js/edit-profile.js"></script> <!-- modification profile -->
<script src="../assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
<script src="../assets/plugins/dropify/js/dropify.min.js"></script>
<script src="../assets/js/pages/forms/dropify.js"></script>  
<script src="../assets/js/pages/ui/notifications.js"></script> <!-- Custom Js -->

</body>
</html>