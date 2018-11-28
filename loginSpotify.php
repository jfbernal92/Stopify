<?php


require_once "vendor/autoload.php";
require_once "lib/Clases/Sesion.php";

const CLIENT_KEY = "772c11e4edb149afaf9ac73f9359576b";
const CLIENT_SECRET ="8e6ed35d90a748cab3233f60b4323e28";

// Primer paso para logearse con Spotify.
$session = new SpotifyWebAPI\Session(
    CLIENT_KEY,
    CLIENT_SECRET,
    "http://localhost/dwes/Stopify/callback.php"
);

// Permisos para obtener información del Usuario.
$options = [
    "scope" => [
        "playlist-read-private",
        "playlist-modify-public",
        "playlist-modify-private",
        "user-read-private",
        "user-read-email",
    ],
];

//Redirije a la uri de spotify que solicita permisos y vuelve a callback con el parametro "code" en la URL
header("Location: ". $session->getAuthorizeUrl($options));    
die();