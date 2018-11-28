<?php
// Cierra una sesión activa.
require_once "lib/Clases/Sesion.php";
$ses = Sesion::iniciarSesion();
if($ses->checkActiveSesion()){
    $ses->close();
}
header("Location: index.php");
