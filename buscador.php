<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />

    <link rel="icon" type="image/png" href="assets/img/logo.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Stopify
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="assets/css/material-kit.css?v=2.0.4" rel="stylesheet" />
    <style>
        .fa-heart:hover{
            transition: all 0.3s linear;
            color: red;
            text-shadow: 1px 0px 10px red;
        }
        .fa-heart{
            transition: all 0.3s linear;
            color: inherit;
            text-shadow: none;
        }
        .play-icon{
            transition: all 0.3s linear;
            color: inherit;
            text-shadow: none;
        }
        .play-icon:hover{
            transition: all 0.1s linear;
            color: green;
            text-shadow: 1px 0px 2px green;
        }
        input::-webkit-calendar-picker-indicator {
            display: none;
        }
        .form-control, .is-focused .form-control {
            background-image: -webkit-linear-gradient(bottom, #FFFFFF 1px, rgba(156, 39, 176, 0) 2px), -webkit-linear-gradient(bottom, #d2d2d2 1px, rgba(210, 210, 210, 0) 1px);
            background-image: -o-linear-gradient(bottom, #FFFFFF 1px, rgba(156, 39, 176, 0) 2px), -o-linear-gradient(bottom, #d2d2d2 1px, rgba(210, 210, 210, 0) 1px);
            background-image: linear-gradient(to top, #FFFFFF 1px, rgba(156, 39, 176, 0) 2px), linear-gradient(to top, #d2d2d2 1px, rgba(210, 210, 210, 0) 1px);
            color: white;
        }

        .navbar.navbar-transparent {
            color: #fff;
            background: linear-gradient(63deg, #AB476C, #7B1FCA);
            background-position: 0 -100px;
            background-size: 100% 100%;
            background-repeat: no-repeat;
            transition-property: box-shadow, background, padding-top;
            transition-delay: 0s, 0s, 0s;
            transition-duration:0s, 0.5s, 1s;
        }
        .navbar.fixed-top {border-radius: 0;}
        .navbar {
            color: #fff;
            background: linear-gradient(63deg, #AB476C, #7B1FCA);
            background-position: 0 0px;
            background-size: 100% 100%;
            background-repeat: no-repeat;
        
            background-color: transparent !important;
            transition-property: box-shadow, background, padding-top;
            transition-delay: 0.5s, 0s, 0s;
            transition-duration:0.5s, 0.5s, 1s;
        }

        @media (max-width: 991px){
            #q {
                color: darkgray;
            }
        }
        .navbar .navbar-toggler .navbar-toggler-icon {background-color: white;}
        
        .card-song{
            height: 536.33px;
        }
        .caratula-container{
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        .caratula{
            max-width: 200px;
            align-self: center;
            padding: 30px 0px 15px 0;
        }
        .playButton i {
            cursor: pointer;
            font-size:30px;
        }

        @media (min-width: 1200px){
            .container {
                max-width: 1280px;
            }
        }
    
        .profile-content{
            padding: 50px 40px;
            min-height: 200px;
            display: flex;
            justify-content: center;
        }
        
    </style>
    
</head>

<body class="profile-page sidebar-collapse">
    <nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
        <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand" href="#">
                    Stopify </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="dropdown nav-item">
                        <a href="profile-page.php" class=" nav-link">
                            <i class="material-icons">account_circle</i> Mi Perfil
                        </a>
                    </li>
                    <li class="dropdown nav-item" >
                        <div class="form-inline ml-3">
                            <div class="form-group no-border pt-0">
                                <input type="text" autocomplete=off class="form-control"list="data-list" id="q" name="q" placeholder="Buscar canción" value="<?php if(!empty($_POST)) echo($_POST["q"]);?>">
                                <span id="search"  class="btn btn-white btn-just-icon btn-round">
                                        <i class="material-icons">search</i>
                                </span>
                                <datalist id="data-list">
                                  
                                </datalist>
                            </div>
                            
                        </form>
                        
                    </li>
                    <li class="ml-4 nav-item ">
                        <a class=" nav-link" href="logout.php">
                            <i class="material-icons">exit_to_app</i>
                            Log out
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- HEADER -->
    <div class="page-header header-filter justify-content-center row" data-parallax="true" style="background-image: url('assets/img/header.jpg');">
    </div>
    <!-- HEADER -->
    
    <!-- MAIN -->
    <div class="main main-raised">
        <div class="profile-content  ">
            <div class="row p-4 text-center " id="content" data-pagina=0 style="width:100%;justify-content: center;">
               <h3 id="contentHeader">Tus resultados aparecerán aquí...</h3>
            </div>
        </div>
    </div>
    <!-- MAIN -->

    <footer class="footer footer-default">
        <div class="container">
            <div class="copyright text-center">
                &copy; Juan Francisco Bernal Rodríguez<br>DWES
            </div>
        </div>
    </footer>

 <!--   Core JS Files   -->
 <script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
 <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
 <script src="assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
 <script src="assets/js/plugins/moment.min.js"></script>
 <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
 <script src="assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
 <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
 <script src="assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
 <!--	Plugin for Sharrre btn -->
 <script src="assets/js/plugins/jquery.sharrre.js" type="text/javascript"></script>
 <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
 <script src="assets/js/material-kit.js?v=2.0.4" type="text/javascript"></script>

 <script src="js/api.js"></script>
 <script>
     $( document ).ready(function(){
        $("#search").click();
     });
 </script>
</body>

</html>
