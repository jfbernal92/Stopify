<?php
require_once "Conexion.php" ;
require_once "Usuario.php" ;

class Sesion {

	private $expire_time = 3600 ;

	//Queries para Admin
	private const SELECT_ADMIN ="SELECT * FROM admin WHERE usuario=? AND password=? ";
	private const SELECT_LAST_USERS ="SELECT idUser, idSpotify, usuario, email, fechaRegistro  FROM usuario LIMIT 20";
	private const SELECT_LAST_USERS_COUNT ="SELECT COUNT(*) as 'count',YEAR(fechaRegistro) as 'year', MONTH(fechaRegistro) as 'month',DAY(fechaRegistro) as 'day' FROM usuario WHERE fechaRegistro >= NOW() + INTERVAL -7 DAY GROUP BY  YEAR(fechaRegistro), MONTH(fechaRegistro),DAY(fechaRegistro) LIMIT 7";
	private const SELECT_LAST_CANCIONES = "SELECT COUNT(*) as 'count',YEAR(fechaCreacion) as 'year', MONTH(fechaCreacion) as 'month',DAY(fechaCreacion) as 'day' FROM cancion_favorita WHERE fechaCreacion >= NOW() + INTERVAL -7 DAY GROUP BY  YEAR(fechaCreacion), MONTH(fechaCreacion),DAY(fechaCreacion) LIMIT 7";
	private const SELECT_LAST_LISTAS ="SELECT COUNT(*) as 'count',YEAR(fechaCreacion) as 'year', MONTH(fechaCreacion) as 'month',DAY(fechaCreacion) as 'day' FROM lista WHERE fechaCreacion >= NOW() + INTERVAL -7 DAY GROUP BY  YEAR(fechaCreacion), MONTH(fechaCreacion),DAY(fechaCreacion) LIMIT 7";
	private const DELETE_USER ="DELETE FROM usuario WHERE idUser=?";

	//Queries para loggin
	private const SELECT_USER = "SELECT * FROM usuario WHERE (usuario=? OR email=?) AND password=?";

	//Query para registro de usuarios
	private const INSERT_USER ="INSERT INTO usuario (usuario, password, email, fechaRegistro) VALUES(?,?,?,now())";
	
	private static $instancia = null;

	private function __construc(){}

	private function __clone(){}

	public function __destroy(){
		$_SESSION[] = array() ;
		session_destroy() ;
	}

	public static function iniciarSesion(){
		if(session_status()!=PHP_SESSION_ACTIVE){
			session_start() ;
		}
		
		if (is_null(self::$instancia)){
			self::$instancia = new Sesion() ;	
		}
		return self::$instancia ;
	}

	private function isExpired(){
		$tme_log = $_SESSION["time"] ;
		$tme_act = time() ;
		//Comprobamos también que el token para la gestion de cuentas de spotify no haya expirado.
		if(isset($_SESSION["spotyExpireTime"])){ 
			$this->expire_time =  $_SESSION["spotyExpireTime"]- time();
		}
		return (($tme_act - $tme_log) > $this->expire_time) ;
	}

	private function isLogged(){
		return !empty($_SESSION) ;
	}

	public function checkActiveSesion() {
		if ($this->isLogged()){
			if ($this->isExpired()){
				$this->__destroy() ;
				return false; // Estaba loggeado pero la sesión ha expirado.
			}else{
				$_SESSION["time"] = time() + 3600;
				return true;	// Hay una sesión, por lo que actualizamos el tiempo de expiración.
			}
		}
		return false; // No existe una sesión iniciada.

	}

	/*
	* Si hay una sesión activa al llamar a este método, por defecto redijirá a la página de perfil de usuario.
	* Si no hubiera una sesión iniciada, volvería al index.php.
	* En el caso de que no hubiera una sesión activa, pero el usuario se hubiera loggeado con spotify, redirije
	* a loginSpotify.php para reobtener los parámetros necesarios para iniciar sesión automáticamente.
	*/
	public function redirect($url="profile-page.php"){
		if ($this->checkActiveSesion()){
			header("Location: $url");
			exit();
		}else if(isset($_SESSION["user"]) && $_SESSION["user"]->spotifyUser){
			heaer("Location: loginSpotify.php");
			exit();
		}
		header("Location: index.php");
		exit();	
	}

	public function close(){
		if ($this->checkActiveSesion())	$this->__destroy() ;
	}

	/*
	* Método para mostrar la sesión de forma rápida.
	*/
	public function __toString(){
		return "<pre>".print_r($_SESSION,true)."</pre>" ;
	}

	/*
	* Equivalente a  $_SESSION["key"] = "value";
	*/
	public function setParameter($key, $value){
		$_SESSION[$key] = $value;
	}

	/*
	* Lee los datos del formulario de registro para validarlos y evitar peticiones POST maliciosas.
	* Devuelve:
	* [boolean, string]
	* boolean =  true o false en función de si el formulario se ha validad correctamente.
	* string = mensaje para mostrar al usuario en caso de error.
	*/
	public function validateRegisterForm(){
			//Buscamos campos vacios o con longitud menor a 6 y que el email sea valido
			foreach ($_POST as $key => $value){
			if($key!="a" && strlen(trim($value))<6){
				return [false, "El campo $key no es válido."];
			}
			if ($key == "email" && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
				return [false,"$value no es un email válido."];
			}
		}
		if($_POST["pass"]!=$_POST["pass2"]){
			return [false,"Las contraseñas no coinciden."];
		}
		return [true, "Formulario correcto."];
	}

	/*
	* Comprueba si ya estaba loggeado, y si no está, obtiene los datos del usuario y genera una sesión válida.
	* Devuelve:
	* true = Se ha loggeado correctamente.
	* false = Los datos de usuario o contraseña no coinciden con ningún registro en la BBDD.
	*/
	public function login($usr, $pwd){
		if ($this->isLogged()){
			return true;
		}else{
			$con = Conexion::getInstancia() ;
			$prep = $con::$db->prepare(self::SELECT_USER);
			if ($con->query($prep,[$usr, $usr, $pwd])){
				$usuario = $con->getEntity("Usuario") ;
				$_SESSION["time"] = time() ;
				$_SESSION["user"] = $usuario;
				return true;
			}					
		} 
		return false;
	}

	/*
	* Registra al usuario si no existe y llama al método login para abrir una sesión con los datos del usuario.
	*/
	public function register($usr, $pwd, $email){
		$con = Conexion::getInstancia() ;
		$prep = $con::$db->prepare(self::INSERT_USER);
		if ($con->query($prep,[$usr, $pwd, $email])){		
			return $this->login($usr, $pwd);
		}
		return false;
	}

	/*
	* Método para el log del Administrador en el panel de administración.
	*/
	public function loginAdmin($usr, $pwd){
		$con = Conexion::getInstancia() ;
		$prep = $con::$db->prepare(self::SELECT_ADMIN);
		if($con->query($prep,[$usr, $pwd])){
			$_SESSION["admin"] = true;
			$_SESSION["time"] = time();
			return true;
		}
		return false;
	}

	/*
	* Método para eliminar un usuario de la BBDD 
	*/
	public function deleteUser($idUser){
		$con = Conexion::getInstancia() ;
		$prep = $con::$db->prepare(self::DELETE_USER);
		if($con->query($prep,[$idUser])){
			foreach($_SESSION["users"] as $key=>$u){
				if($u->idUser == $idUser){
					unset($_SESSION[$key]);
					return false;
				}
			}
		}
		return true;
	}


	/*
	* Obtiene los datos relevantes para la administración de usuarios y visionado de estadísticas.
	*/
	public function getAdminData(){
		$con = Conexion::getInstancia() ;
		
		$prep = $con::$db->prepare(self::SELECT_LAST_USERS);
		$con->query($prep,[]);
		$_SESSION["users"] =$con->getEntities();
		
		$prep = $con::$db->prepare(self::SELECT_LAST_USERS_COUNT);
		$con->query($prep,[]);
		$_SESSION["usersCount"] =$con->getEntities();

		$prep = $con::$db->prepare(self::SELECT_LAST_CANCIONES);
		$con->query($prep,[]);
		$_SESSION["canciones"] =$con->getEntities();

		$prep = $con::$db->prepare(self::SELECT_LAST_LISTAS);
		$con->query($prep,[]);
		$_SESSION["listas"] =$con->getEntities();
	}
}