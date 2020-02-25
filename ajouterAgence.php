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
    <title> Ajouter Agence</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css" />
    <link rel="stylesheet" href="assets/plugins/charts-c3/plugin.css" />
    <link rel="stylesheet" href="assets/plugins/bootstrap-select/css/bootstrap-select.css" />

    <link rel="stylesheet" href="assets/plugins/morrisjs/morris.min.css" />

    <!-- Custom Css -->
    <link rel="stylesheet" href="assets/css/style.min.css">
</head>

<body class="theme-blush" onload="unit()" >
    <!-- <?php session_start(); ?> -->
    <?php $path=$_SERVER["DOCUMENT_ROOT"]."/ScreenDayPro2/pages/"; include($path."menugauche.html");?>
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><img class="zmdi-hc-spin" src="assets/images/loader.svg" width="48" height="48"
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
    <?php $path=$_SERVER["DOCUMENT_ROOT"]."/ScreenDayPro2/pages/"; include($path."menudroit.html");?>
    <!-- Left Sidebar -->
   

    <!-- Right Sidebar -->
    
    <!-- Main Content -->

    
    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Ajouter Agence</h2>
                   
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                            class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                            class="zmdi zmdi-arrow-right"></i></button>
                   
                </div>
            </div>
        </div>
        <div class="container-fluid">
           
        <div class="row clearfix">
                <div class="col-md-12">
              
                    <div class="card">
                        <div class="header">
                            <h2><strong>Information</strong> Agence</h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control info"  id="nomagence" placeholder="Nom Agence">
                                    </div>
                                </div>                                    
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control info" id="directeuragence" placeholder="Directeur">
                                    </div>
                                </div>
                               
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control info" id="adresse" placeholder="Adresse">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control info" id="telephone" placeholder="Telephone">
                                    </div>
                                </div>
                                 <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control info" id="email" placeholder="E-mail">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                          <label class="form-control">Date Inscription :</label> 
                                        
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                         
                                        <input type="date" class="form-control info" id="dateinscription" >
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header">
                            <h2><strong>Login</strong>  El Mot de passe</h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <input type="text"id="user" class="form-control info-suc" placeholder="Login">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <input type="password" id="pw" class="form-control info-suc" placeholder="Mot de passe">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <input type="password"  id="pwconferm" class="form-control info-suc" placeholder="Confirmation Mot de passe">
                                    </div>
                                </div>
                                                         
                            </div>                              
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="header">
                            <h2><strong>Chambres</strong> Et Prix</h2>
                        </div>
                        <div class="body">
                            <div class="row" id="contentch">
                                <div class="col-lg-8 col-md-12">
                                    <div class="form-group">
                                        <label class="form-control"> Chambre Numero 230</label>
                                     </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <input type="number" min="0"  class="form-control" placeholder="Prix Chambre">
                                    </div>
                                </div>
                                
                                                         
                            </div>     
                                                   
                        </div>
                        <button class="btn btn-primary  mt-5" onclick="ajouteragence()" >Ajouter L'agence </button>  
                    </div>
                </div>
            </div>

            </div>

        </div>
    </section>
    <!-- default modal -->
    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">Reservation</h4>
                </div>
                
                <div class="modal-body">
                veuillez choisir les Chambres pour
                    <select id="chambres" class="form-control">

                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-round waves-effect">SAVE CHANGES</button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
   
    <!-- Jquery Core Js -->
    <script src="js/jquery.min.js"></script>
    <script src="js/ajou_agence.js"></script>
    <script src="assets/bundles/libscripts.bundle.js"></script>
    <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) -->
    <script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- slimscroll, waves Scripts Plugin Js -->

    <script src="assets/bundles/jvectormap.bundle.js"></script> <!-- JVectorMap Plugin Js -->
    <script src="assets/bundles/sparkline.bundle.js"></script> <!-- Sparkline Plugin Js -->
    <script src="assets/bundles/c3.bundle.js"></script>
    <script src="assets/bundles/mainscripts.bundle.js"></script>

    <script src="assets/js/pages/index.js"></script>
    <script src="assets/js/pages/calendar/calendar.js"></script>
    <script src="assets/bundles/fullcalendarscripts.bundle.js"></script>
</body>

</html>