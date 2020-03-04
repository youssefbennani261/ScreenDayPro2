<?php 
session_start();
if(!isset($_SESSION["agence"])){header("Location: http://localhost:8080/ScreenDayPro2/sign-in.html");} ?> 
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
<link rel="stylesheet" href="../assets/plugins/dropify/css/dropify.min.css">

<!-- Light Gallery Plugin Css -->
<link rel="stylesheet" href="../assets/plugins/light-gallery/css/lightgallery.css">
<link rel="stylesheet" href="../assets/plugins/fullcalendar/fullcalendar.min.css">
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

<!-- Left Sidebar -->

<?php $path=$_SERVER["DOCUMENT_ROOT"]."/ScreenDayPro2/pages/"; include($path."menugauche_agence.html");?>
<?php $path=$_SERVER["DOCUMENT_ROOT"]."/ScreenDayPro2/pages/"; include($path."menudroit_agence.html");?>


<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Profile</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index_agence.php"><i class="zmdi zmdi-home"></i> Agence </a></li>
                        <li class="breadcrumb-item">Pages</li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    <a href="edit_profile-agence.php" class="btn btn-info btn-icon float-right"><i class="zmdi zmdi-edit"></i></a>
                </div>
            </div>
        </div> 
        <div class="container-fluid">
            <div class="row ">
                <div class="col-lg-4 col-md-12  mx-auto">
                    <div class="card mcard_3 ">
                        <div class="body ">
                            <a href="profile_agence.php"><img src=<?php echo $_SESSION['agence'][5]?> class="rounded-circle shadow " alt="profile-image"></a>
                            <h4 class="m-t-10"><?php echo $_SESSION['agence'][1]?></h4>                            
                            <div class="row ">
                                <div class="col-12 ">
                                    <!-- <ul class="social-links list-unstyled">
                                        <li><a title="facebook" href="javascript:void(0);"><i class="zmdi zmdi-facebook"></i></a></li>
                                        <li><a title="twitter" href="javascript:void(0);"><i class="zmdi zmdi-twitter"></i></a></li>
                                        <li><a title="instagram" href="javascript:void(0);"><i class="zmdi zmdi-instagram"></i></a></li>
                                    </ul> -->
                                    <p class="text-muted"><?php echo $_SESSION['agence'][3]?></p>
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
                    <div class="card  ">
                        <div class="body ">
                            <small class="text-muted">Email address: </small>
                            <p><?php echo $_SESSION['agence'][6]?></p>
                            <hr>
                            <small class="text-muted">Phone: </small>
                            <p><?php echo $_SESSION['agence'][4]?></p>
                            <hr>
                            <ul class="list-unstyled">
                                <li>
                                    <div>Qualité Service</div>
                                    <div class="progress m-b-20">
                                        <div class="progress-bar l-blue " role="progressbar" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100" style="width: 89%"> <span class="sr-only">62% Complete</span> </div>
                                    </div>
                                </li>
                                <!-- <li>
                                    <div>Wordpress</div>
                                    <div class="progress m-b-20">
                                        <div class="progress-bar l-green " role="progressbar" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100" style="width: 56%"> <span class="sr-only">87% Complete</span> </div>
                                    </div>
                                </li>
                                <li>
                                    <div>HTML 5</div>
                                    <div class="progress m-b-20">
                                        <div class="progress-bar l-amber" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 78%"> <span class="sr-only">32% Complete</span> </div>
                                    </div>
                                </li>
                                <li>
                                    <div>Angular</div>
                                    <div class="progress m-b-20">
                                        <div class="progress-bar l-blush" role="progressbar" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100" style="width: 43%"> <span class="sr-only">56% Complete</span> </div>
                                    </div>
                                </li> -->
                            </ul>
                          
                        </div>
                    </div>                    
                </div>
                
            </div>
        </div>
    </div>
</section>
<!-- Jquery Core Js --> 
<script src="../js/jquery.min.js"></script>
<script src="../js/profile.js"></script>
<script src="../assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="../assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="../assets/plugins/light-gallery/js/lightgallery-all.min.js"></script> <!-- Light Gallery Plugin Js --> 
<script src="../assets/bundles/fullcalendarscripts.bundle.js"></script><!--/ calender javascripts --> 

<script src="../assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
<script src="../assets/js/pages/medias/image-gallery.js"></script>
<script src="../assets/js/pages/calendar/calendar.js"></script>
<script src="../assets/plugins/dropify/js/dropify.min.js"></script>
<script src="../assets/js/pages/forms/dropify.js"></script>

</body>
</html>