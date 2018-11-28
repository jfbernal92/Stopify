<?php

require_once "lib/Clases/Conexion.php";
require_once "lib/Clases/Usuario.php";
require_once "lib/Clases/Sesion.php";
$msg = null;

$ses = Sesion::iniciarSesion();
if($ses->checkActiveSesion()){   
    $_SESSION["time"] = time() ;
    $ses->redirect();
}

if(!empty($_POST)){
    switch($_POST["a"]){
        case "log": // Si quiere logearse y es correcto, redirecciona.
            if($ses->login($_POST["user"], md5($_POST["pass"]))){
                $ses->redirect();
                exit();
            }
            //echo $_SESSION; 
            $msg ="Usuario o Contraseña incorrectos";
            break;
        case "reg":
            $validacion = $ses->validateRegisterForm(); // Valida el formulario
            $msg = $validacion[1];  
            if($validacion[0]){ // Si es válido intentará registrarlo
                if($ses->register($_POST["user"], md5($_POST["pass"]),$_POST["email"], false)){
                    $ses->redirect();
                    exit();
                }else{
                    $msg = "Este usuario o email ya existe.";
                }
            }  
            break;
            default: // Peticiones malintencionadas.
                $ses->redirect("403.php");
                
    }  
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/png" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Stopify
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="assets/css/material-kit.css?v=2.0.4" rel="stylesheet" />

    <link href="assets/css/mdb.css" rel="stylesheet" />


    <style>
        
        @keyframes alert{
            from{top: -150px;opacity: 0};
            to{top: 90px;opacity: 1};
        }
        .animated-alert {
            max-width: 30%;
            position: absolute;
            top: 90px;
            left: 10px;
            animation: alert 2s ease;
            z-index: 1;
        }
        ::-webkit-scrollbar { 
            display: none; 
        }
        html, body {
            max-width: 100%;
            overflow-x: hidden !important;
        }
        .view {
            position: fixed;
            width: 100%;
            cursor: default;
            height: 100%;
        }
  </style>
    <script>
    // Script para ocultar o mostrar los formularios de Log in y Registro.
        function hideLoginShowReg(){
            
            $('#loginCard').removeClass().addClass('container animated fadeOutLeft ');
            setTimeout(function(){
              $('#loginCard').hide();
                $('#registroCard').removeClass().addClass('container animated fadeInRight ').show();
            }, 500);
            
    }
        function hideRegShowLogin(){
            if(!$('#loginCard').is(':visible')){
                $('#registroCard').removeClass().addClass('container animated fadeOutRight ');
                setTimeout(function(){
                  $('#registroCard').hide();
                    $('#loginCard').removeClass().addClass('container animated fadeInLeft ').show();
                }, 500);
            }
    }
    // Valida el formulario en navegador.
    function check(input) {
        if (input.value != document.getElementById('pass').value) {
            input.setCustomValidity('Las contraseñas no coinciden.');
        } else {
            input.setCustomValidity('');
        }
    }
     function info(input) {
        if (input.value.length < 6) {
            input.setCustomValidity('La longitud mínima son 6 caracteres.');
        } else {
            input.setCustomValidity('');
        }
    }
    // Actualiza la barra en función de campos válidos.
    function validate(){
      var inputs=$('#paso1 > span > div > input');
      var i=0;
      inputs.each(function(){
      
        if(this.checkValidity()){
          i++;
        }
        
      });
       $('#progressReg').css('width',i*100/4+'%');
      return (i==4)?true:false;
      
    }
    
    </script>
</head>

<body onload="validate();">
    <div class="view">
        <img style="height: 100%; width: 100%;" src="assets/img/fondo.png" class="img-fluid" alt="">
        <div class="mask flex-center rgba-black-strong">
        </div>
    </div>


    <nav class="navbar navbar-expand-lg bg-primary mb-0" style="padding: 5px 30px;border-radius: 0;background-color: rgba(156, 39, 176, 0.25) !important;box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14);">

        <div class="navbar-translate">
            <img src="assets/img/logo.png" class="navbar-brand" width="45px" style="height: auto">
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item" onclick="hideRegShowLogin()">
                    <a href="#" class="nav-link">
                        <i class="material-icons">account_circle</i> Login
                    </a>
                </li>
                <li class="nav-item" onclick="hideLoginShowReg()">
                    <a href="#" class="nav-link">
                        <i class="material-icons">settings</i> Registrarse
                    </a>
                </li>
            </ul>
        </div>

    </nav>

   <!-- ALERT -->
<?php if(isset($msg)): ?>
    <div class="alert alert-warning animated-alert">
        <div class="container-fluid">
            <div class="alert-icon">
                <i class="material-icons">info_outline</i>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="material-icons">clear</i></span>
            </button>
            <b><?php echo $msg ?></b>
        </div>
    </div>

<?php endif;?>




    <h1 class="title text-white text-center animated slower slideInRight ">Stopify</h1>
    <hr style="width: 75%" class="animated slower slideInLeft bg-white">
    <!-- REGISTRO -->
    <form class="form" method="post" onsubmit="return validate()" style="margin-top: 2.5rem !important;">
       <input type="hidden" name="a" value="reg">
        <div class="container" id="registroCard" style="display: none">
            <div class="row">
                <div class="col-lg-5 col-md-6 ml-auto mr-auto">
                    <div class="card card-login">
                        <div class="card-header card-header-primary text-center" style="background: linear-gradient(63deg, #AB476C, #7B1FCA);">
                            <h4 class="card-title">Registrarse</h4>
                            <div class="progress mb-0 mx-4">
                                <div class="progress-bar bg-success" id="progressReg" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="card-body mb-4">
                            <!-- PASO 1 REGISTRO -->
                            <div id="paso1">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">face</i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Usuario" name="user" minlength=6 value="<?= $_POST["user"]??"" ; ?>" required pattern="[A-Za-z0-9]{5,}" oninput="validate();">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">mail</i>
                                        </span>
                                    </div>
                                    <input type="email" class="form-control" placeholder="Email" name="email" value="<?= $_POST["email"]??"" ; ?>" required oninput="validate();">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">lock_outline</i>
                                        </span>
                                    </div>
                                    <input type="password" class="form-control" placeholder="Contraseña" name="pass" id="pass" value="<?= $_POST["pass"]??"" ; ?>"required pattern="[A-Za-z0-9ñÑ]{6,}" oninput="info(this);validate();">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">lock_outline</i>
                                        </span>
                                    </div>
                                    <input type="password" class="form-control" placeholder="Repite contraseña" name="pass2" value="<?= $_POST["pass"]??"" ; ?>"required oninput="check(this);validate();">
                                </div>
                            </div>

                        </div>


                        <div class="footer text-center">
                            <button type="submit" class="mb-4 btn btn-primary btn-link btn-wd btn-lg">Registro</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- LOGGIN -->
    <div class="container animated fadeIn slower delay-2s " id="loginCard" style="margin-top: 4.5rem !important;">
        <div class="row">
            <div class="col-lg-5 col-md-6 ml-auto mr-auto">
                <div class="card card-login">
                    <form class="form" method="post" style="min-height: 280px;">
                       <input type="hidden" name="a" value="log">
                        <div class="card-header card-header-primary text-center" style="background: linear-gradient(63deg, #AB476C, #7B1FCA);">
                            <h4 class="card-title">Log in with</h4>
                            <div class="social-line">
                                <a href="loginSpotify.php" class="btn btn-just-icon btn-link">
                                <i class="fab fa-spotify"></i></a>
                                <!-- <div class="ripple-container"></div></a>
                                <a href="#" class="btn btn-just-icon btn-link">
                                    <i class="fa fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-just-icon btn-link">
                                    <i class="fa fa-google-plus"></i>
                                </a> -->
                            </div>
                                
                        </div>
                        <div class="card-body">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">face</i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" placeholder="Usuario o Email" name="user" required>
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">lock_outline</i>
                                    </span>
                                </div>
                                <input type="password" class="form-control" placeholder="Contraseña" name="pass" required>
                            </div>
                        </div>
                        <div class="footer text-center">
                            <button type="submit" class="btn btn-primary btn-link btn-wd btn-lg">Iniciar Sesión</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


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
    <script src="assets/js/core/bootstrap-material-design.min.js"></script>
</body>

</html>
