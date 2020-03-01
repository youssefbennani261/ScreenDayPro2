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
    <title> Home</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
    <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="../assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css" />
    <link rel="stylesheet" href="../assets/plugins/charts-c3/plugin.css" />
    <link rel="stylesheet" href="../assets/plugins/bootstrap-select/css/bootstrap-select.css" />

    <link rel="stylesheet" href="../assets/plugins/morrisjs/morris.min.css" />
    <link rel="stylesheet" href="../assets/plugins/summernote/dist/summernote.css"/>

    <!-- Custom Css -->
    <link rel="stylesheet" href="../assets/css/style.min.css">
</head>

<body class="theme-blush" >
    <!-- <?php session_start(); ?> -->
    <?php $path=$_SERVER["DOCUMENT_ROOT"]."/ScreenDayPro2/pages/"; include($path."menugauche_agence.html");?>
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><img class="zmdi-hc-spin" src="../assets/images/loader.svg" width="48" height="48"
                    alt="Aero"></div>
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


    
    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Mes Messages</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="zmdi zmdi-home"></i> Home</a></li>
                        <li class="breadcrumb-item active">Messagerie</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                            class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                            class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
    <div class="body_scroll">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="d-flex">
                        <div class="mobile-left">
                            <a class="btn btn-info btn-icon toggle-email-nav collapsed" data-toggle="collapse" href="#email-nav" role="button" aria-expanded="false" aria-controls="email-nav">
                                <span class="btn-label"><i class="zmdi zmdi-more"></i></span>
                            </a>
                        </div>
                        <div class="inbox left" id="email-nav">
                            
                            <div class="mail-compose mb-4">
                                <a href="javascript:composemsg()" class="btn btn-danger btn-block">Compose</a>
                            </div>
                            <div class="mail-side">
                                <ul class="nav">
                                    <li id="inbox"><a href="javascript:getemail();"><i class="zmdi zmdi-inbox"></i>Inbox<span class="badge badge-primary" id="nbrmsg"></span></a></li>
                                    <li id="send"><a href="javascript:getsentmsg();"><i class="zmdi zmdi-mail-send"></i>Sent</a></li>
                                </ul>
                               
                            </div>
                        </div>
                        <div class="inbox right">
                            

                            <div class="table-responsive">
                                <table class="table c_table inbox_table" id="emails">
                                    <!-- <tr>
                                        <td class="chb">
                                            <div class="checkbox simple">
                                                <input id="mc1" type="checkbox">
                                                <label for="mc1"></label>
                                            </div>
                                        </td>
                                        <td class="starred "><a href="javascript:void(0);"><i class="zmdi zmdi-star"></i></a></td>
                                        <td class="u_image"><img src="../assets/images/xs/avatar1.jpg" alt="user" class="rounded" width="30"></td>
                                        <td class="u_name"><h5 class="font-15 mt-0 mb-0">Maryam Amiri</h6></td>
                                        <td class="max_ellipsis">
                                            <a class="link" href="mail-single.html">
                                                <span class="badge badge-primary mr-2">Work</span>
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            </a>
                                        </td>
                                        <td class="time">9:30 AM</td>
                                    </tr> -->
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    </section>
    
    <!-- default modal -->

   
    <!-- Jquery Core Js -->
    <script src="../js/jquery.min.js"></script>
    <script src="../assets/bundles/libscripts.bundle.js"></script>
    <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) -->
    <script src="../assets/bundles/vendorscripts.bundle.js"></script> <!-- slimscroll, waves Scripts Plugin Js -->

    <script src="../assets/bundles/c3.bundle.js"></script>
    <script src="../assets/bundles/mainscripts.bundle.js"></script>


    <script src="../assets/js/pages/index.js"></script>
    <script src="../assets/plugins/summernote/dist/summernote.js"></script>
    <script src="../assets/plugins/momentjs/moment.js"></script>
    <script src="../js/main_agence.js"></script>
    <script src="../assets/plugins/bootstrap-notify/bootstrap-notify.js"></script> <!-- Bootstrap Notify Plugin Js -->
    <script src="../assets/js/pages/ui/notifications.js"></script> <!-- Custom Js -->

    <script src="../assets/bundles/fullcalendarscripts.bundle.js"></script>
</body>

</html>