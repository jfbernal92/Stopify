<?php


require_once "vendor/autoload.php";
require_once "lib/Clases/Sesion.php";

const CLIENT_KEY = "THE API CLIENT KEY";
const CLIENT_SECRET ="THE API CLIENT SECRET KEY";

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
