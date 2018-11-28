<?php

require_once "lib/Clases/Sesion.php";



$msg = null;

$ses = Sesion::iniciarSesion();
if($ses->checkActiveSesion()){   
	if(isset($_SESSION["admin"])){
    	$ses->redirect("dashboard.php");
	}else{
		$ses->redirect("403.php");
	}
	exit();
	
}

if(!empty($_POST)){
	$usr = $_POST["admin"]??"";
	$pwd = md5($_POST["pass"]??"");
	if($ses->loginAdmin($usr, $pwd)){
		$ses->redirect("dashboard.php");
	}else{
		$msg ="Datos de administrador incorrectos.";
	}
}
//echo "<pre>".print_r($_SESSION, true)."</pre>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Stopify Admin</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="assets/img/logo.png">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->

<style>
 .wrap-login100{
	 padding: 100px;
 }
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
</style>
</head>
<body>
	

	<!-- ALERT CON MSJ -->
<?php if(isset($msg)): ?>
    <div class="alert alert-danger animated-alert">
        <div class="container-fluid">
            <div class="alert-icon">
                
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="material-icons">X</i></span>
            </button>
            <b><?php echo $msg ?></b>
        </div>
    </div>

<?php endif;?>


	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="POST">
					<span class="login100-form-title">
						Admin Login
					</span>

					<div class="wrap-input100 ">
						<input class="input100" type="text" name="admin" placeholder="Usuario">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Se necesita una contraseña">
						<input class="input100" type="password" name="pass" placeholder="Contraseña">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>