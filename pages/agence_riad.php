<?php 
session_start();
if(!isset($_SESSION["riad"])){header("Location: http://localhost:8080/ScreenDayPro2/sign-in.html");} ?> 
<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>Profile</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- Favicon-->
<link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
<!-- Light Gallery Plugin Css -->
<link rel="stylesheet" href="../assets/plugins/light-gallery/css/lightgallery.css">
<link rel="stylesheet" href="../assets/plugins/fullcalendar/fullcalendar.min.css">
<!-- Custom Css -->
<link rel="stylesheet" href="../assets/css/style.min.css">
</head>

<body class="theme-blush"  onload="load1()" >
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

<!-- Left Sidebar -->

<?php $path=$_SERVER["DOCUMENT_ROOT"]."/ScreenDayPro2/pages/"; include($path."menugauche.html");?>
<?php $path=$_SERVER["DOCUMENT_ROOT"]."/ScreenDayPro2/pages/"; include($path."menudroit.html");?>

    <!-- Right Sidebar -->


<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Profile Agence</h2>
                   
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    <a href="profile-edit.php" class="btn btn-info btn-icon float-right"><i class="zmdi zmdi-edit"></i></a>
                </div>
            </div>
        </div> 
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card mcard_3">
                        <div class="body">
                            <a href="#" id="imgp"> </a>
                            <h4 class="m-t-10" id="no"></h4> 
                            <h5 class="m-t-10" id="te"></h5>                            
                            <div class="row">
                                <div class="col-12">
                                    <!-- <ul class="social-links list-unstyled">
                                        <li><a title="facebook" href="javascript:void(0);"><i class="zmdi zmdi-facebook"></i></a></li>
                                        <li><a title="twitter" href="javascript:void(0);"><i class="zmdi zmdi-twitter"></i></a></li>
                                        <li><a title="instagram" href="javascript:void(0);"><i class="zmdi zmdi-instagram"></i></a></li>
                                    </ul> -->
                                    <p class="text-muted" id="ad"></p>
                                   
                                </div>
                                <!-- <div class="col-4">                                    
                                    <small>Following</small>
                                    <h5>852</h5>
                                </div>
                                <div class="col-4">                                    
                                    <small>Followers</small>
                                    <h5>13k</h5>
                                </div>
                                <div class="col-4">                                    
                                    <small>Post</small>
                                    <h5>234</h5>
                                </div>                             -->
                            </div>
                        </div>
                    </div>
                  
                </div>
              
            </div>
            <div class="col-lg-12 col-md-12">                
                    <div class="card">
                        <div class="header">
                            <h2><strong> List </strong> Reservation D'agence</h2>
                        </div>
                        <div class="body ">
                        <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <input type="date"  oninput="cherche()" style="background-color:beige" class="form-control" id="date" >
                                    </div>
                                </div>
                            <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                            <table class="table table-hover c_table">
                    <thead>
                        <tr style="background-color:beige">
                            <th>Nom Agence</th>
                            <th>Date Debut </th>
                            <th>Date Fin</th>
                            <th>Prix</th>
                            <th>Nom responsable</th>    
                            <th>Nombre Personnes</th>
                            
                            
                        
                            
                        </tr>
                    </thead>
                    <tbody id="tab_demande">
                    
                    </tbody>
                </table>   
                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control ml-3" style="background-color:beige" id="total" placeholder="TOTAL : 00 DH">
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
<script src="../js/agence.js"></script>
<script src="../assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="../assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="../assets/plugins/light-gallery/js/lightgallery-all.min.js"></script> <!-- Light Gallery Plugin Js --> 
<script src="../assets/bundles/fullcalendarscripts.bundle.js"></script><!--/ calender javascripts --> 

<script src="../assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
<script src="../assets/js/pages/medias/image-gallery.js"></script>
<script src="../assets/js/pages/calendar/calendar.js"></script>
</body>
</html>