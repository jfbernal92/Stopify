<?php
    require_once "lib/Clases/Sesion.php";
    require_once "lib/Clases/Usuario.php";
    $ses = Sesion::iniciarSesion();
    if(!$ses->checkActiveSesion()){
        $ses->redirect();
    }
    $user = $_SESSION["user"];
    //echo $_SESSION;

?>

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
        @keyframes alert{
           from{left: -400px;};
            
        }
        @keyframes alert-dismiss{
            from{left: -10px;};
          
        }
   
   
        i{
            cursor:pointer;
        }
        .animated-alert {
            
            position: fixed;
            left:10px;
            bottom:10px;
            animation: alert 1s ;
            z-index: 5000;
            
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

     
        .listaProgress{
             min-width:50px;
        }
        
        @media (max-width: 991px){
            #q {
                color: darkgray;
            }
        }
        .navbar .navbar-toggler .navbar-toggler-icon {background-color: white;}
        
 
        .card-song-profile{
            height:400px
        }
        .caratula-container{
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        .caratula-profile{
            max-width: 100px;
            align-self: center;
            padding: 30px 0px 15px 0;
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
        .delete-icon{
            transition: all 0.3s linear;
            color: inherit;
            text-shadow: none;
        }
        .delete-icon:hover{
            transition: all 0.1s linear;
            color: red;
            text-shadow: 1px 0px 2px red;
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
        #nickNameTitle{
            cursor:pointer;
        }
        input::-webkit-calendar-picker-indicator {
            display: none;
        }
        
    </style>
    
</head>

<body class="profile-page sidebar-collapse">
    <nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
        <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand" href="#">Stopify</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="dropdown nav-item" >
                        <form class="form-inline ml-3" method="POST" action="buscador.php">
                            <div class="form-group no-border">
                                <input type="text" class="form-control" autocomplete=off list="data-list" id="q" name="q" placeholder="Buscar canción">
                                <button type="submit" id="busca" class="btn btn-white btn-just-icon btn-round">
                                        <i class="material-icons">search</i>
                                </button>
                                <input type="hidden" name="cod" value="get">
                                <input type="hidden" name="p" value="0">
                            </div>
                            <datalist id="data-list">
                                  
                                  </datalist>
                        </form>
                    </li>
                    <li class="ml-4 nav-item " style="border:0;">
                        <a class=" nav-link" href="logout.php">
                            <i class="material-icons">exit_to_app</i>
                            Log out
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="page-header header-filter" data-parallax="true" style="background-image: url('assets/img/header.jpg');"></div>
    <div class="main main-raised">
        <div class="profile-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 ml-auto mr-auto">
                        <div class="profile">
                            <div class="avatar">
                                <img src="assets/img/noprofile.png" alt="Circle Image" class="img-raised rounded-circle img-fluid">
                            </div>
                            <div class="name">
                                <h3 class="title" id="nickNameTitle" data-toggle="modal" data-target="#modalNick">
                                    <?=$user->usuario ?>
                                </h3>
                                <h6>
                                    <?= $user->email?>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 ml-auto mr-auto">
                        <div class="profile-tabs">
                            <ul class="nav nav-pills nav-pills-icons justify-content-center" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#canciones" role="tab" data-toggle="tab">
                                        <i class="material-icons">library_music</i> Mis Canciones
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#listas" role="tab" data-toggle="tab">
                                        <i class="material-icons">playlist_play</i> Mis Listas
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="tab-content tab-space">
                    <!-- CANCIONES -->
                    <div class="pb-0 tab-pane active text-center gallery" id="canciones">
                        <div class="row px-4">
                            <!-- Card Cancion -->

                            <?php  foreach($user->cancionesFavoritas as $cancion):  ?>
                            <div class="col-lg-4 col-md-6 col-12 " id="<?=$cancion->idSpotify?>"> 
                                <div class=" card card-song-profile">
                                    <div class="caratula-container">
                                        <img class="card-img-top mb-0 caratula-profile" src="<?=$cancion->image_url?>" alt="Card image cap">
                                        <span class="playButton">
                                            <i class="material-icons play-icon" data-song="<?=$cancion->preview_url?>" onclick="play('<?=$cancion->preview_url?>')">play_circle_outline</i>
                                            <i class="material-icons delete-icon" data-id="<?=$cancion->idSpotify?>" onclick="sendRequest({'cod':'delete','method':'POST','idSpotify':'<?=$cancion->idSpotify?>'})">delete_forever</i>
                                            <?php if(!$user->spotifyUser):?><i class="material-icons" onclick="addSongToList('<?=$cancion->idSpotify?>');" data-toggle="modal" data-target="#modalInsertLista">playlist_add</i><?php endif;?>
                                        </span>
                                    </div>
                                    <div class="card-body pt-0">
                                        <hr>
                                        <h4 class="title mb-0"><?=substr($cancion->titulo,0,64)?></h4>
                                        <p class="card-text">Cantante:<?=$cancion->autor?></p>
                                        <p class="card-text">Año:<?=$cancion->anio?></p>
                                        <p class="card-text">Duracion:<?=$cancion->duracion?></p>
                                        <div>
                                            <p class="card-text mr-2" style="display: inline-block">Puntuación: </p>
                                            <span class="progress" style="width: 20%;height: 16px !important;display: inline-flex" data-toggle="tooltip" data-placement="bottom" title="<?=$cancion->popularity?>/ 100">
                                                <span class="progress-bar bg-<?=$cancion->getProgressBar()?>" role="progressbar" style="width:<?=$cancion->popularity?>%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php endforeach; ?>

                        </div>
                        <!-- PAGINACION NO IMPLEMENTADA
                        <div class="row mt-3  justify-content-center mb-1">
                            <ul class="pagination">
                                <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                </li>
                                <li class="page-item active">
                                    <span class="page-link">1</span>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </div> 
                    -->
                    </div>
                    <!-- CANCIONES -->

                    <!-- LISTAS -->
                    <div class="pb-3 tab-pane text-center gallery" id="listas">
                       
                        <?php if(!$user->spotifyUser): ?>
                        <button class="btn btn-primary"data-toggle="modal" data-target="#modalLista">Crear una lista</button>
                        <?php endif; ?>
                        <div class="row">
                            <?php foreach($user->listas as $key=> $lista): ?>
                            <div class="col-12" id="lista<?php echo $key?>">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <!-- CABECERA LISTA -->
                                        <div class="panel-group"  role="tablist" aria-multiselectable="true">
                                            <div class="panel panel-default">
                                                <div class="panel-heading" role="tab" id="headingOne">
                                                    <a role="button" data-toggle="collapse" data-parent="#l<?php echo$lista->idLista .$key?>" href="#lc<?php echo$lista->idLista  .$key;?>" aria-expanded="true" aria-controls="collapseOne">
                                                        <h4 class="panel-title text-muted row">
                                                            <div class="col-5">
                                                                <?php echo $lista->nombre; if(!$user->spotifyUser):?> <i class="material-icons" onclick="sendRequest({'cod':'deleteLista','method':'POST','idLista':'<?=$key?>'})">delete_forever</i><?php endif;?>
                                                            </div>
                                                            <div class="col-2"> <i class="material-icons">keyboard_arrow_down</i></div>
                                                            <div class="col-5"> (<?=$lista->fechaCreacion?>) </div>
                                                        </h4>
                                                    </a>
                                                </div>
                                                <!-- PANEL COLAPSABLE PARA CANCIONES -->
                                                <div id="lc<?php echo $lista->idLista .$key ;?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                    <div class="row">
                                                        <table class="table table-hover">
                                                            <tbody>
                                                                <?php foreach($lista->canciones as $cancion):?>
                                                                <tr id="l<?=$key . $cancion->idSpotify?>">
                                                                    <td>
                                                                        <?=$cancion->titulo?>
                                                                    </td>
                                                                    <td>
                                                                        <?=$cancion->autor?>
                                                                    </td>
                                                                    <td>
                                                                        <?=$cancion->anio?>
                                                                    </td>
                                                                    <td class="listaProgress">
                                                                        <span class="progress" style="width: 100%;height: 16px !important;display: inline-flex" data-toggle="tooltip" data-placement="bottom" title="<?=$cancion->popularity?>/ 100">
                                                                            <span class="progress-bar bg-<?=$cancion->getProgressBar()?>" role="progressbar" style="width:<?=$cancion->popularity?>%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></span>
                                                                        </span>
                                                                    </td>
                                                                    <td>
                                                                        <?=$cancion->duracion?>
                                                                    </td>
                                                                    <td>
                                                                        <i class="material-icons play-icon" onclick="play('<?=$cancion->preview_url?>')">play_circle_filled</i>
                                                                        <?php if (!$user->spotifyUser): ?>
                                                                            <i class="material-icons delete-icon" data-id="<?=$cancion->idSpotify?>" onclick="sendRequest({'cod':'deleteFromList','method':'POST','songID':'<?=$cancion->idSpotify?>','playlistID':'<?=$key?>'})">delete_forever</i>
                                                                        <?php endif;?>
                                                                    </td>
                                                                </tr>
                                                                <?php endforeach?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- PANEL COLAPPSABLE -->
                                            </div>
                                        </div>
                                        <!-- CABECERA LISTA -->
                                    </div>
                                </div>
                            </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                    <!-- LISTAS -->
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Nick -->
    <div class="modal fade" id="modalNick" tabindex="-1" role="dialog" aria-labelledby="modalNick" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalNick">¿Quieres cambiar tu nombre de Usuario?</h5>
                    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">  
            
                    <div class="form-group">
                        <label for="nickInput" class="bmd-label-floating">Nuevo nombre de Usuario</label>
                        <input type="text" class="form-control" id="nickInput" style="color: grey;">
                        <span class="bmd-help mt-2">Nota: Si te has logeado con Spotify, los cambios sólo se verán afectado dentro de esta aplicación.</span>
                    </div>   
                
                </div>
                <div class="modal-footer">
                    <button type="button" id="changeNick" class="btn btn-primary" disabled>Aplicar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Nick -->
     <!-- Modal Lista -->
     <div class="modal fade" id="modalLista" tabindex="-1" role="dialog" aria-labelledby="modalLista" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLista">Crea una nueva lista</h5>
                    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">  
            
                    <div class="form-group">
                        <label for="listaInput" class="bmd-label-floating">Nombre de lista</label>
                        <input type="text" class="form-control" id="listaInput" style="color: grey;">
                        <span class="bmd-help mt-2">Nota: La lista creada se guardará de forma local. Próximamente se integrará con Spotify.</span>
                    </div>   
                
                </div>
                <div class="modal-footer">
                    <button type="button" id="createLista" class="btn btn-primary" disabled>Aplicar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Lista -->
    <!-- Modal Insert in Lista -->
    <div class="modal fade" id="modalInsertLista" tabindex="-1" role="dialog" aria-labelledby="modalInsertLista" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalInsertLista">Añade esta cancion a una lista:</h5>
                   
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
               </div>
               <div class="modal-body">  
                    <form action="api.php" method="post" id="formInsertLista">
                        <div class="form-group">
                            <input type="hidden" name="cod" value="insertIntoLista">
                            <?php foreach ($user->listas as $key=>$value):?>
                            <div class="form-check">
                                <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="idLista[]" value="<?=$key?>">
                               <?=$value->nombre?>
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                                </label>
                            </div>
                            <?php endforeach;?>

                        </div>
                        <input type="submit" value="Guardar" class="btn btn-primary">
                    </form>   
                
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div> -->
            </div>
        </div>
    </div>
    <!-- Modal Insert in Lista -->
    <footer class="footer footer-default">
        <div class="container">
            <div class="copyright text-center">
                &copy; Juan Francisco Bernal Rodríguez<br>
                DWES
            </div>
        </div>
    </footer>
    
    <!--   Core JS Files   -->
    <script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="js/api.js"></script>
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

    
</body>

</html>
