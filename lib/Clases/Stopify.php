<?php

require_once "Usuario.php";
require_once "Sesion.php";
require_once "Conexion.php" ;
require_once "vendor/autoload.php";

const MAX_REG = 12;

class Stopify{

    //Queries para log in y registros
    private const SELECT_USER_BY_ID = "SELECT * FROM usuario WHERE idSpotify=?";
    private const INSERT_SPOTIFY_USER ="INSERT INTO usuario (usuario, email, idSpotify, fechaRegistro) VALUES(?,?,?,now())";

    //Queries para busquedas y datalist
    private const FIND_TRACK_NAME = "SELECT DISTINCT titulo FROM cancion WHERE titulo LIKE CONCAT('%', ?, '%') LIMIT 9";


    private static $instancia = null;
    private static $api;
    private static $con;

    private function __construc(){}

    private function __clone(){}
    
    /*
    * Usamos patrón sigleton
    */
    public static function getInstancia(){
        if (is_null(self::$instancia)){
            self::$api = new SpotifyWebAPI\SpotifyWebAPI();
            self::$instancia = new Stopify();
            self::$con = Conexion::getInstancia();
        }
        return self::$instancia ;
    }

    public function __set($prop, $value){
        if(property_exists($prop)){
            $this->$prop = $value;
        }
    }

    /*
    * Si la sesión no está activa, obtendrá el access token necesario y los datos necesarios
    * para formar el objeto Usuario.
    */
    private static function logWithSpotify($usuario){
        $ses = Sesion::iniciarSesion();
        $usuario->spotifyUser = true;
        // Comprueba si la sesion de spotify esta iniciada.
        if(!$ses->checkActiveSesion()){
            $ses->redirect();
            exit();  
        }else if(isset($_SESSION["accessToken"])){
            self::$api->setAccessToken($_SESSION["accessToken"]);
        }else{
            die("**Error con el token");
        }

        //Listas para el usuario
        $playlists =  self::$api->getUserPlaylists($usuario->idSpotify);
        $listas = array();
        foreach ($playlists->items as $playlist) {

            $lista = new Lista();
            $lista->idSpotify = $playlist->id;
            $lista->nombre = $playlist->name;
            $lista->fechaCreacion = "Lista de Spotify";

            $playlistTracks =  self::$api->getPlaylistTracks($playlist->id);
            //Canciones por lista
            foreach ($playlistTracks->items as $track) {                   
                $lista->addCancion(self::getCancionObject($track->track));       
            }
            $listas[$playlist->id] = $lista;  
        }
        $usuario->listas = $listas;
        $ses->setParameter("user", $usuario);
        $ses->redirect();
        
    }

    /*
    * Comprueba si el usuario logeado con Spotify existe en la BBDD. Si no lo está, lo registra
    * y llama el método logWithSpotify para obtener los datos de Usuario necesarios.
    */
    public function registerOrLogin(){
        self::$api->setAccessToken($_SESSION["accessToken"]);
        $prep = self::$con::$db->prepare(self::SELECT_USER_BY_ID);
        if (!self::$con->query($prep,[ self::$api->me()->id])){
            $prep = self::$con::$db->prepare(self::INSERT_SPOTIFY_USER);
            if (!self::$con->query($prep,[ self::$api->me()->display_name, self::$api->me()->email,  self::$api->me()->id])){
                die("**Error registrando usuario de spotify en la aplicacion");
            }
        }
        self::logWithSpotify(self::$con->getEntity("Usuario"));
    }

    /*
    * Genera un objeto Canción a partir de los datos obtenidos a través de la API de spotify.
    */
    private function getCancionObject($track){
        $cancion = new Cancion();
        $cancion->idSpotify = $track->id;
        $cancion->titulo = $track->name;
        $cancion->autor = $track->artists[0]->name;
        $cancion->anio = $track->album->release_date;
        $cancion->duracion = date("i:s",$track->duration_ms/1000);
        $cancion->popularity = $track->popularity;
        $cancion->preview_url = $track->preview_url;
        $cancion->image_url = $track->album->images[1]->url;
        return $cancion;
    }

    /*
    * Devuelve el nombre de las canciones que coincidan con el parámetro $name.
    * Se usará para mostrarlos en un datalist al buscar una canción.
    */
    public function searchInBBDD($name){
        $prep = self::$con::$db->prepare(self::FIND_TRACK_NAME);
        if (self::$con->query($prep,[$name])){
            return self::$con->getEntities();
        }
        return [];
    }

    /*
    * Genera una búsqueda en la api de Spotify y devuelve un array con objetos de tipo Canción.
    */
    public function searchInSpotify($q, $type, $offset=0,$accessToken){
        self::$api->setAccessToken($accessToken);
        $query = self::$api->search($q, $type,[
            "limit"=>MAX_REG,
            "offset"=>MAX_REG*$offset
        ]);

        $canciones =  array();
        foreach($query->tracks->items as $track){
            array_push($canciones, $this->getCancionObject($track));
        }
        return  $canciones;
    }

    /*
    * Busca una canción por su identificador en la api de Spotify.
    */
    public function searchSongBySpotifyID($id, $accessToken){
        self::$api->setAccessToken($accessToken);
        $query = self::$api->getTrack($id);
        return $this->getCancionObject($query);

    }

    // /*
    // * Elimina una cancion de spotify
    // */
    // public function deleteSongFromList($playlistID, $songID, $accessToken){
    //     $tracks = [
    //         'tracks' => [
    //             ['id' => $songID],  
    //         ],
    //     ];
    //     $api->deletePlaylistTracks($playlistID, $tracks, 'SNAPSHOT_ID');
    // }

}