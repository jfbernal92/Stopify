<?php

class Cancion implements JsonSerializable  {
    private const INSERT_SONG = "INSERT IGNORE INTO cancion (idSpotify, titulo, autor,anio, duracion, popularity,preview_url, image_url)".
                    "VALUES(?,?,?,?,?,?,?,?)";

    private $idSpotify, $titulo, $autor,$anio, $duracion, $popularity,$preview_url, $image_url; 

   
    public function __construct(){
    }

    public function __sleep(){
        return array( 
            "idSpotify",
            "titulo", 
            "autor",
            "anio",
            "duracion", 
            "popularity",
            "preview_url",
            "image_url");
    }
    public function __wakeup(){
        return new Cancion(
            $this->idSpotify,
            $this->titulo ,
            $this->autor ,
            $this->anio,
            $this->duracion ,
            $this->popularity,
            $this->preview_url,
            $this->image_url);
    }
    
    public function __set($prop, $val){
        $this->$prop=$val;
    }

    public function __get($prop){
        return $this->$prop;
    }
    
    //Obtiene la clase apropiada para el estilo de css en función de la popularidad de la canción.
    public function getProgressBar(){
        $p = $this->popularity;
        if($p<40){
            return "warning";
        }else if($p<70){
            return "info";
        }
        return "success";  
    }

    //Implementación de la interface JsonSerializable para enviar el objeto a través de api.php correctamente.
    public function jsonSerialize(){
        return[
        "idSpotify" => $this->idSpotify,
        "titulo" => $this->titulo,
        "autor"=> $this->autor,
        "anio" => $this->anio,
        "duracion" => $this->duracion,
        "popularity" => $this->popularity,
        "preview_url"=> $this->preview_url,
        "image_url"=> $this->image_url
    ];
    }

    //Guarda esta canción en la BBDD
    public function save(){
       
        $con = Conexion::getInstancia() ;
        $prep = $con::$db->prepare(self::INSERT_SONG);
        
        return $con->query($prep,[
                                $this->idSpotify,
                                $this->titulo,
                                $this->autor,
                                $this->anio,
                                $this->duracion,
                                $this->popularity,
                                $this->preview_url,
                                $this->image_url
                            ]);
    }
}