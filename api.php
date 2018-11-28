<?php
header("Content-type: application/json; charset=utf-8") ;


require_once "lib/Clases/Stopify.php";
require_once "lib/Clases/Cancion.php";
require_once "lib/Clases/Usuario.php";

//Constantes para el obtener el accesToken de Spotify
const URL = "https://accounts.spotify.com/api/token";
const CLIENT_KEY = "772c11e4edb149afaf9ac73f9359576b";
const CLIENT_SECRET ="8e6ed35d90a748cab3233f60b4323e28";


// Define estructura estandar de una respuesta para formatearla en JSON
$response = array();
$response["error"] =  true;
$response["data"] = array();
$response["cod"] = (isset($_GET["cod"])) ?$_GET["cod"] :$_POST["cod"] ;

// Si no hubiera una sesión activa no se podría usar la aplicación como API REST.
$ses = Sesion::iniciarSesion();
if(!$ses->checkActiveSesion()){
    $ses->redirect();
   exit();
}
$stopy = Stopify::getInstancia();

// Necesitaremos un token para buscar en la api de spotify. En caso de que no sea un usuario logeado con
// spotify, tendremos que generar nosotros mismo uno.
if(isset($_SESSION["user"]) && !$_SESSION["user"]->spotifyUser && !isset($_SESSION["accessToken"])){
    getAccessTokenForNoSpotifyUser();  
}

// Servicio REST de búsqueda de canciones.
//
// Parámetros necesarios:
//
//  cod = "get" (obligatorio)
//  q   = Nombre de canción para buscar.
//  p   = Número de página para el resultado. Por defecto muestra 12 resultados.
if(!empty($_GET)){
    switch($_GET["cod"]){
        case "get":
        $q = $_GET["q"]??"";
        $p = $_GET["p"]??0;
            $canciones = $stopy->searchInSpotify($q, "track", $p, $_SESSION["accessToken"]);
            foreach($canciones as $cancion){
                if(!isset($_SESSION["user"]->cancionesFavoritas[$cancion->idSpotify])){
                    array_push($response["data"], $cancion);
                }
            }
            $response["error"] = false;
            $response["p"] = $p+1;
        break;  
    }
}

// Gestión de datos de Usuario
if(!empty($_POST)){
    switch($_POST["cod"]){  
        case "changeNick": // Cambia el nick del usuario.
            if(strlen($_POST["nick"])>=6){ // Comprueba que la longitud sea de al menos 6 caracteres.
                $response["error"] = $_SESSION["user"]->updateUserName($_POST["nick"]);
                $response["data"] = $_POST["nick"];
            }
        break;
        case "saveSong": // Guarda una canción como favorita
            $stopy->searchSongBySpotifyID($_POST["idSpotify"],$_SESSION["accessToken"])->save();
            $response["error"] = $_SESSION["user"]->saveFavoriteSong($_POST["idSpotify"]);
            $response["data"]=$_POST["idSpotify"];
        break;
        case "search": // Muestra nombres de canciones sugeridas en un datalist.
            $response["data"] =$stopy->searchInBBDD($_POST["txt"]);
            $response["error"] = false;
        break;
        case "deleteFromList": // Elimina una canción de una lista.
            if(!$_SESSION["user"]->spotifyUser){
                $response["error"] = $_SESSION["user"]->deleteSongFromLista($_POST["songID"],$_POST["playlistID"]);
                $response["data"] = "l".$_POST["playlistID"].$_POST["songID"];
            }
        break;
        case "delete": // Elimina una canción favorita.
            $response["error"] = $_SESSION["user"]->deleteFavoriteSong($_POST["idSpotify"]);
            $response["data"] = $_POST["idSpotify"];
        break;
        case "deleteLista": // Elimina una lista.
            $response["error"] = $_SESSION["user"]->deleteList($_POST["idLista"]);
            $response["data"] = "lista".$_POST["idLista"];
        break;
        case "createLista": // Crea una lista.
            $response["error"] = $_SESSION["user"]->createList($_POST["listaName"]);
        break;
        case "insertIntoLista": // Inserta una canción en una o más listas.
            $_SESSION["user"]->insertSongIntoList($_POST["idSpotify"],$_POST["idLista"]);
            header("Location: profile-page.php");
            exit();
        break;
        case "deleteUser": // Elimina un usuario. Sólo podrá hacerlo el usuario administrador.
            if(isset($_SESSION["admin"])){
                $response["error"]= $ses->deleteUser($_POST["idUser"]);
                $response["data"] = "u".$_POST["idUser"];
            }            
        break;
    }
    
}

// Generaremos una petición con curl para obtener el accessToken.
function getAccessTokenForNoSpotifyUser(){
    $data = array('grant_type' => 'client_credentials'); // Parámetro necesario para la API de spotify.
    $options = array(
        'http' => array(
            'header'  => "Content-type:application/x-www-form-urlencoded\r\n".
                         "Authorization: Basic ".base64_encode(CLIENT_KEY . ":".CLIENT_SECRET),
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options); // Obtiene la respuesta de curl
    $result = json_decode(file_get_contents(URL, false, $context)); // Parsea el resultado en formato json.s
    if ($result === FALSE) { 
        die("**Error obteniendo un token"); 
    }
    $_SESSION["accessToken"]=$result->access_token;
    $_SESSION["spotyExpireTime"]=$result->expires_in + time();
}

// Imprime la respuesta
echo json_encode($response,JSON_UNESCAPED_SLASHES);