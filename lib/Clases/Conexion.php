<?php
require_once "Usuario.php";
require_once "Cancion.php";
require_once "Lista.php";

class Conexion {

	private static $dbHost = "localhost" ;
	private static $dbUser = "root" ;
	private static $dbPass = "" ;
	private static $dbName = "stopify" ;
	private static $dbCharset ="utf8";

	//Objeto PDO donde guardar los prepared statement
	private static $prep;

	private static $instancia = null;
	
	public static $db;			


	private function __construct() {
		$this->conectar() ;
	}
	
	public function __destruct(){	
		Conexion::$db = null ;
	}

	private function __clone(){}


	public function __wakeup(){
		$this->conectar() ;
	}

	//Devuelve la instancia de este objeto si no está creada previamente.
	public static function getInstancia() {
		if (is_null(self::$instancia)):
			self::$instancia = new Conexion() ;
		endif ;
		
		return self::$instancia ;
	}

	/*
	 * Abre la conexión con la base de datos.
	 * Añadimos el parámetro MYSQL_ATTR_FOUND_ROWS para que también devuelva filas afectadas en inserts.
	 */
	private function conectar(){
		try{
			self::$db =new PDO("mysql:host=".self::$dbHost.";dbname=".self::$dbName.";charset=".self::$dbCharset, self::$dbUser, self::$dbPass, array(PDO::MYSQL_ATTR_FOUND_ROWS => true));
		}catch(PDOException $err){
			die("**Error: " . $err->getMessage());
		}
	}

	
	/*
	* Ejecutará la sentencia prepared que le llegue por parametro. Además
	* bindea los valores dentro de la sentencia (estos tienen que ser enviados en el orden correcto).
	*
	* Devuelve:
	* true = consulta con al menos 1 fila afectada.
	* false = sin filas afectadas.
	*/
	public function query($prepared_query, $params){
		for($i=0;$i<count($params);$i++){
			$prepared_query->bindParam($i+1,$params[$i],PDO::PARAM_STR,100);
		}
		self::$prep = $prepared_query;
		self::$prep->execute();
		if(is_object(self::$prep)){
			return (self::$prep->rowCount()>0);
		}
		return (self::$prep->rowCount()>0);
	}
	
	/*
	* Devuelve un objeto de la clase que se le pase como parámetro. Si no hay parámetro, generará un objeto
	* de clase stdClasss.
	*/
	public function getEntity($class="stdClass"){
		return self::$prep->fetchObject($class); ;
	}
	
	/*
	* Devuelve un array de objetos de la clase que se le pase como parámetro. Si no hay parámetro, los objetos serán
	* de clase stdClass.
	*/
	public function getEntities($class="stdClass"){		
		return self::$prep->fetchAll(PDO::FETCH_CLASS, $class);
	}

}