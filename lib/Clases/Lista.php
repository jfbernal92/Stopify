<?php

class Lista {
    private $idLista, $nombre, $fechaCreacion, $canciones = array();

    public function __construct(){
    }

    public function __sleep(){
        return array("idLista","nombre","fechaCreacion","canciones");
    }

    public function __wakeup(){
        return new Lista($this->idLista, $this->nombre, $this->fechaCreacion, $this->canciones);
    }

    public function __get($prop){
        return $this->$prop;
    }

    public function __set($prop,$val){
        if(property_exists($this,$prop)){
            $this->$prop = $val;
        }   
    } 

    /*
    * Añade una cancion, si no existe, al atributo $canciones.
    */
    public function addCancion($cancion){
        if(!in_array($cancion, $this->canciones)){
            $this->canciones[$cancion->idSpotify]= $cancion;            
        }
    }
}