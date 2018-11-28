<?php

require_once "vendor/autoload.php";
require_once "lib/Clases/Sesion.php";
require_once "lib/Clases/Stopify.php";

// Fichero para procesar la petición de loggin a spotify y abrir la sesión con su token.

const CLIENT_KEY = "772c11e4edb149afaf9ac73f9359576b";
const CLIENT_SECRET ="8e6ed35d90a748cab3233f60b4323e28";

$session = new SpotifyWebAPI\Session(
    CLIENT_KEY,
    CLIENT_SECRET,
    "http://localhost/dwes/Stopify/callback.php"
);

$ses = Sesion::iniciarSesion();
if(!$ses->checkActiveSesion() ){
    if(isset($_GET["code"])){
        // Si spotify responde con el codigo para obtener el accessToken, realizamos la petición.
        $session->requestAccessToken($_GET["code"]);
    }
}else if(isset($_SESSION["refreshToken"])){ //Si no hay sesion activa y hay un token para refresco, lo actualizamos.
    $session->refreshAccessToken($_SESSION["refreshToken"]);
}else{
    die("**Error al conectar con la API  de spotify");
}

// Equivalente a $_SESSION["key"] = "value"
$ses->setParameter("accessToken", $session->getAccessToken());
$ses->setParameter("refreshToken", $session->getRefreshToken());
$ses->setParameter("spotyExpireTime", $session->getTokenExpiration());
$ses->setParameter("time", time());

// Recopilamos los datos del usuario y nos redireccionara a la pagina del perfil.
$stopy = Stopify::getInstancia();
$stopy->registerOrLogin();
exit();