<?php
require_once "Cancion.php";
require_once "Lista.php";
class Usuario {

    private $idUser;
    private $idSpotify;
    private $usuario;
    private $email;

    private $spotifyUser = false;

    //Array de objetos Lista
    private $listas = array();
    
    //Array de objetos Cancion
    private $cancionesFavoritas = array();

    //Queries para obtener datos relevante del usuario.
    private const UPDATE_USERNAME = "UPDATE usuario SET usuario=? WHERE idUser=?";
    
    private const SELECT_LISTA_CANCION = "SELECT c.idSpotify, c.titulo, c.autor, c.anio, c.duracion, c.popularity, c.preview_url, c.image_url FROM  lista l JOIN lista_cancion lc ON l.idLista=lc.idLista LEFT JOIN cancion c on lc.idSpotify=c.idSpotify WHERE l.idUsuario=? AND l.idLista=?";
    private const SELECT_LISTAS = "SELECT l.idLista, l.nombre, l.fechaCreacion FROM usuario u RIGHT JOIN lista l ON u.idUser=l.idUsuario WHERE u.idUser=?";
    private const DELETE_SONG_FROM_LIST ="DELETE FROM lista_cancion WHERE idSpotify=? AND idLista=?";
    private const DELETE_LISTA="DELETE FROM lista WHERE idLista=?";
    private const CREATE_LISTA="INSERT IGNORE INTO lista(nombre, fechaCreacion, idUsuario) VALUES(?,now(),?)";
    private const INSERT_SONG_INTO_LIST="INSERT IGNORE INTO lista_cancion (idSpotify, idLista) VALUES (?,?)";

    private const SELECT_FAVORITE_SONG = "SELECT c.idSpotify, c.titulo, c.autor,c.anio, c.duracion, c.popularity,c.preview_url, c.image_url FROM cancion_favorita cf RIGHT JOIN cancion c ON cf.idSpotify=c.idSpotify WHERE cf.idUsuario=?";
    private const INSERT_FAVORITE_SONG ="INSERT IGNORE INTO cancion_favorita (idSpotify, idUsuario) VALUES (?,?)";
    private const DELETE_FAVORITE_SONG ="DELETE FROM cancion_favorita WHERE idUsuario=? AND idSpotify=?";
    
    private static $con;


    public function __construct(){
        self::$con = Conexion::getInstancia() ;
        $this->getCancionesFromBBDD();
        $this->getListasFromBBDD();  
    }

    public function __get($prop) {
        return $this->$prop;
    }

    public function __set($prop,$val){
        if(property_exists($this, $prop)){
            $this->$prop = $val; 
        }     
    }
        
    public function __sleep(){
        return array("idUser", 
            "idSpotify",
            "usuario",  
            "email",
            "spotifyUser",
            "listas",
            "cancionesFavoritas");
    }

    public function __wakeup(){
        return new Usuario($this->idUser,
            $this->idSpotify,
            $this->usuario ,
            $this->email,
            $this->spotifyUser,
            $this->listas,
            $this->cancionesFavoritas);
    }
        
    public function __toString(){
        return "<pre>Usuario: [ID] => " . $this->idUser .
        " [USUARIO] => ". $this->usuario .
        " [EMAIL] => ". $this->email .
        " \n[CANCIONES] => ". print_r($this->cancionesFavoritas,true) .
        " \n[LISTAS] => ". print_r($this->listas,true)."</pre>";
    }

    /*
    * Método para cambiar el nombre del usuario en la aplicación.
    */
    public function updateUserName($name){
        $prep = self::$con::$db->prepare(self::UPDATE_USERNAME);
        $lastnick = $this->usuario;
        if(self::$con->query($prep,[$name,$this->idUser])){
            $this->usuario = $name;
        }
        return $lastnick == $this->usuario;
    }

    /*
    * Obtiene las canciones favoritas de este usuario guardadas en la BBDD.
    */
    private function getCancionesFromBBDD(){
        $prep = self::$con::$db->prepare(self::SELECT_FAVORITE_SONG);
        if(self::$con->query($prep,[$this->idUser])){
            foreach(self::$con->getEntities("Cancion") as $cancion){
                $this->cancionesFavoritas[$cancion->idSpotify]= $cancion;
            }
        }   
    }

    /*
    * Obtiene las listas guardadas por este usuario en la BBDD.
    */
    private function getListasFromBBDD(){
        $prep = self::$con::$db->prepare(self::SELECT_LISTAS);
        if(self::$con->query($prep,[$this->idUser])){
            //Asigna la id al array asociativo
            foreach(self::$con->getEntities("Lista") as $lista){
                $this->listas[$lista->idLista] = $lista;
            
                //Asignamos cada cancion a su lista
                $prep = self::$con::$db->prepare(self::SELECT_LISTA_CANCION);
                if(self::$con->query($prep,[$this->idUser, $lista->idLista])){
                   $this->listas[$lista->idLista]->canciones=self::$con->getEntities("Cancion");	
                }
            }
        }
    }

    /*
    * Guarda una canción como favorita y actualiza el array.
    */
    public function saveFavoriteSong($idSpotify){
        $prep = self::$con::$db->prepare(self::INSERT_FAVORITE_SONG);
        $count = sizeof($this->cancionesFavoritas);
        if(self::$con->query($prep,[$idSpotify,$this->idUser])){
            $this->cancionesFavoritas=array();
            $this->getCancionesFromBBDD();
        }
        return $count >= sizeof($this->cancionesFavoritas);
    }

    /*
    * Elmina una canción favorita y actualiza el array.
    */
    public function deleteFavoriteSong($idSpotify){
        $prep = self::$con::$db->prepare(self::DELETE_FAVORITE_SONG);
        $count = sizeof($this->cancionesFavoritas);   
        if(self::$con->query($prep,[$this->idUser,$idSpotify])){
            $this->cancionesFavoritas=array();
            $this->getCancionesFromBBDD();
        }
        return $count <= sizeof($this->cancionesFavoritas);
    }

    /*
    * Guarda una canción en una o más listas.
    */
    public function insertSongIntoList($idSpotify, $arrayLista){
        foreach($arrayLista as $key=>$value){
            $prep = self::$con::$db->prepare(self::INSERT_SONG_INTO_LIST);
            self::$con->query($prep,[$idSpotify,$value]);
        }
        $this->listas=array();
        $this->getListasFromBBDD();
    }

    /*
    * Elmina una canción de una lista.
    */
    public function deleteSongFromLista($idSpotify, $idLista){
        $prep = self::$con::$db->prepare(self::DELETE_SONG_FROM_LIST);
        $count = sizeof($this->listas[$idLista]->canciones);
        if(self::$con->query($prep,[$idSpotify,$idLista])){
            $this->listas=array();
            $this->getListasFromBBDD();
        }
        return $count <=  sizeof($this->listas[$idLista]->canciones);
    }

    /*
    * Elmina una lista.
    */
    public function deleteList($idLista){
        $prep = self::$con::$db->prepare(self::DELETE_LISTA);
        $count = sizeof($this->listas);
        if(self::$con->query($prep,[$idLista])){
            $this->listas=array();
            $this->getListasFromBBDD();
        }
        return $count <=  sizeof($this->listas);
    }

    /*
    * Crea una lista.
    */
    public function createList($name){
        $prep = self::$con::$db->prepare(self::CREATE_LISTA);
        $count = sizeof($this->listas);
        if(self::$con->query($prep,[$name,$this->idUser])){
            $this->listas=array();
            $this->getListasFromBBDD();
        }
        return $count >=  sizeof($this->listas);
    }

}
