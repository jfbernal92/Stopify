<?php
require_once "lib/Clases/Sesion.php";

$ses = Sesion::iniciarSesion();

if($ses->checkActiveSesion()){   
	if(!isset($_SESSION["admin"])){ // En caso de que se intente acceder a esta página sin tener permiso, redirije a una página de error.
        $ses->redirect("403.php");
        exit();
    }
    $ses->getAdminData(); // Obtiene los datos estadísticos.
}else{
    $ses->redirect();
    exit();
}

?>
    
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/logo.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Admin Spotify</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/demo/demo.css" rel="stylesheet" />
    <style>

        .dropdown-menu-logout{
            right: 1rem;
            left: auto;
            top: 3rem;
        }
        i{
            cursor:pointer;
        }
        i:hover{
            color: red;
        }
    </style>
</head>

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="azure" data-background-color="white" data-image="assets/img/sidebar-1.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="logo">
                <a href="#" class="simple-text logo-normal">Admin Panel</a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="nav-item active  ">
                        <a class="nav-link" href="#">
                            <i class="material-icons">dashboard</i>
                            <p>Resumen</p>
                        </a>
                    </li>                 
                   
                    <li class="nav-item ">
                        <a class="nav-link" href="logout.php">
                            <i class="material-icons">exit_to_app</i>
                            <p>Log out</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
                <div class="container-fluid">
                   
                    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                    </button>
                    
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content mt-4">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card card-stats">
                                <div class="card-header card-header-success card-header-icon">
                                    <div class="card-icon">
                                        <i class="material-icons">person_add</i>
                                    </div>
                                    <p class="card-category">Usuarios</p>
                                    
                                    <h3 class="card-title">+<?=end($_SESSION["usersCount"])->count;?></h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">date_range</i> Últimas 24 Horas
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card card-stats">
                                <div class="card-header card-header-warning card-header-icon">
                                    <div class="card-icon">
                                        <i class="material-icons">playlist_add</i>
                                    </div>
                                    <p class="card-category">Listas</p>
                                    <h3 class="card-title">+<?=end($_SESSION["listas"])->count;?></h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">playlist_add</i> Últimas 24 Horas
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card card-stats">
                                <div class="card-header card-header-info card-header-icon">
                                    <div class="card-icon">
                                        <i class="material-icons">queue_music</i>
                                    </div>
                                    <p class="card-category">Canciones</p>
                                    <h3 class="card-title">+<?=+end($_SESSION["canciones"])->count;?></h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">update</i> Últimas 24 Horas
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card card-chart">
                                <div class="card-header card-header-success">
                                    <div class="ct-chart" id="userChart"></div>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">Registros Diarios 
                                    
                                    <?php 
                                    // Usuarios registrados en 24h
                                    $ayer=0;
                                    $hoy = 0;
                                    $total = 0;
                                    foreach($_SESSION["usersCount"] as $c):
                                        $total+=$c->count;
                                        if($c->day == date('d', strtotime("-1 days"))){
                                            $ayer = $c->count;
                                        }else if($c->day == date('d')){
                                            $hoy = $c->count;
                                        }
                                    endforeach;
                                            
                                         
                                        
                                    ?>
                                    <span class="text<?php echo ($hoy>=$ayer)?'-success':'-danger'?> float-right">
                                    <i class="fa fa-long-arrow-<?php echo ($hoy>=$ayer)?'up':'down'?>"></i><?php echo round($hoy*100/$total,2)?>% 
                                    
                                    <?php 
                                    ?></span></h4>
                                    
                                    
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-chart">
                                <div class="card-header card-header-warning">
                                    <div class="ct-chart" id="listChart"></div>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">Listas Diarias
                                    
                                    <?php 
                                        // Listas registrados en 24h
                                        $ayer=0;
                                        $hoy = 0;
                                        $total = 0;
                                        foreach($_SESSION["listas"] as $c):
                                            $total+=$c->count;
                                            if($c->day == date('d', strtotime("-1 days"))){
                                                $ayer = $c->count;
                                            }else if($c->day == date('d')){
                                                $hoy = $c->count;
                                            }
                                        endforeach;
                                                
                                             
                                            
                                        ?>
                                        <span class="text<?php echo ($hoy>=$ayer)?'-success':'-danger'?> float-right">
                                        <i class="fa fa-long-arrow-<?php echo ($hoy>=$ayer)?'up':'down'?>"></i> <?php echo round($hoy*100/$total,2)?>% 
                                        
                                        <?php 
                                        ?></span></h4>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-chart">
                                <div class="card-header card-header-info">
                                    <div class="ct-chart" id="songChart"></div>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">Canciones diarias <?php 
                                        // Canciones registrados en 24h
                                        $ayer=0;
                                        $hoy = 0;
                                        $total = 0;
                                        foreach($_SESSION["canciones"] as $c):
                                            $total+=$c->count;
                                            if($c->day == date('d', strtotime("-1 days"))){
                                                $ayer = $c->count;
                                            }else if($c->day == date('d')){
                                                $hoy = $c->count;
                                            }
                                        endforeach;
                                                
                                             
                                            
                                        ?>
                                        <span class="text<?php echo ($hoy>=$ayer)?'-success':'-danger'?> float-right">
                                        <i class="fa fa-long-arrow-<?php echo ($hoy>=$ayer)?'up':'down'?>"></i> <?php echo round($hoy*100/$total,2)?>% 
                                        
                                        <?php 
                                        ?></span></h4>
                                </div>
                                <!-- <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">access_time</i> campaign sent 2 days ago
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header card-header-rose p-4">
                                    <h4 class="card-title">Últimos Usuarios Registrados</h4>
                                    <p class="card-category"></p>
                                </div>
                                <div class="card-body table-responsive">
                                    <table class="table table-hover">
                                        <thead class="text-rose">
                                            <th>ID</th>
                                            <th>Usuario</th>
                                            <th>Fecha de Registro</th>
                                            <th>Email</th>
                                            <th>Spotify User</th>
                                            <th>Gestionar</th>
                                        </thead>
                                        <tbody><!-- Lista de Usuarios -->
                                           <?php foreach($_SESSION["users"] as $user):?> 
                                            <tr id="u<?=$user->idUser ?>">
                                                <td><?=$user->idUser ?></td>
                                                <td><?=$user->usuario ?></td>
                                                <td><?=$user->fechaRegistro ?></td>
                                                <td><?=$user->email ?></td>
                                                <td><?php echo (isset($user->idSpotify)) ? "Sí" : "No";?></td>
                                                <td>
                                                    <?php if (!isset($user->idSpotify)): ?>
                                                        <i class="material-icons delete-icon" onclick="sendRequest({'cod':'deleteUser','method':'POST','idUser':'<?=$user->idUser?>'})">delete_forever</i>
                                                    <?php endif;?>
                                                </td>
                                            </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
    <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!-- Chartist JS -->
    <script src="assets/js/plugins/chartist.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="assets/js/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>
    <script src="js/api.js" type="text/javascript"></script>


    
    <script>

        // Ordena los días de la semana en el gráfico.
        function getLabels(){
            var d = new Date();
            var n = d.getDay()
            var days = ["L", "M", "X", "J", "V", "S","D"];
            for(i=0; i< n; i++){
                var temp = days.shift();
                days.push( temp )
            }
            return days;
        }

        $(document).ready(function() {

            var labels = getLabels();
            var datauserChart = {
                labels: labels,
                series: [
                    [<?php  // Usuarios registrados por día en los últimos 7 días.
                        for($i=6; $i>=0; $i--){
                            $val = 0;
                            foreach($_SESSION["usersCount"] as $c):
                                if($c->day == date('d', strtotime("-$i days"))){
                                    $val = $c->count;
                                }
                            endforeach;
                            echo "{meta: '$val', value: $val },";
                        }   
                        ?>]
                ]};

            var optionsuserChart = {
                lineSmooth: Chartist.Interpolation.cardinal({
                    tension: 0
                }),
                low: 0,
                high: Math.round(<?php // Máximo número para calcular el punto más alto de la gráfica.
                        $max = 0 ;
                        foreach($_SESSION["usersCount"] as $c):
                            if($c->count > $max) $max=$c->count;
                        endforeach;
                        echo $max;
                        ?>*1.5),
                        
                chartPadding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                }
            };
            new Chartist.Line('#userChart',datauserChart,optionsuserChart );


            var datalistChart = {
                labels: labels ,
                series: [
                    [<?php  // Listas registrados por día en los últimos 7 días.
                        for($i=6; $i>=0; $i--){
                            $val = 0;
                            foreach($_SESSION["listas"] as $c):
                                if($c->day == date('d', strtotime("-$i days"))){
                                    $val = $c->count;
                                }
                            endforeach;
                            echo $val .",";
                        }   
                        ?>]
                ]};

            var optionslistChart = {
                lineSmooth: Chartist.Interpolation.cardinal({
                    tension: 0
                }),
                low: 0,
                high: Math.round(<?php 
                        $max = 0 ;
                        foreach($_SESSION["listas"] as $c):
                            if($c->count > $max) $max=$c->count;
                        endforeach;
                        echo $max;
                        ?>*1.5),
                
                chartPadding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                }
            };
            new Chartist.Line('#listChart', datalistChart,optionslistChart);


            var datalsongChart = {
                labels: labels,
                series: [
                    [<?php  // Canciones registrados por día en los últimos 7 días.
                        for($i=6; $i>=0; $i--){
                            $val = 0;
                            foreach($_SESSION["canciones"] as $c):
                                if($c->day == date('d', strtotime("-$i days"))){
                                    $val = $c->count;
                                }
                            endforeach;
                            echo $val .",";
                        }   
                        ?>]
                ]};

            var optionssongChart = {
                lineSmooth: Chartist.Interpolation.cardinal({
                    tension: 0
                }),
                low: 0,
                high: Math.round(<?php 
                        $max = 0 ;
                        foreach($_SESSION["canciones"] as $c):
                            if($c->count > $max) $max=$c->count;
                        endforeach;
                        echo $max;
                        ?>*1.5),
                chartPadding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                }
            };
             new Chartist.Line('#songChart', datalsongChart,optionssongChart);

        });

    </script>
</body>
</html>
