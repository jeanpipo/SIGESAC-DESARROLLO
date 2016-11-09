<?php
/**
 * @copyright 2014 - Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio
 * @license GPLv3
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 *
 * Sesion.php - Componente de MVCRIVERO.
 *
 * Esta clase permite encapsular y simplificar el manejo de los datos de
 * las sesiones en PHP. En el sistema se manejan cuatro datos básicos por 
 * la sesión que son:  nombre, apellido, tipo y  código del usuario. La 
 * clase permite manejar estos datos como si se tratara de un objeto, y 
 * además encapsula las instrucciones para iniciar y cerrar sesión. Los 
 * atributos de esta clase son posiciones en el arreglo $_SESSIO
 * 
 *  
 * @author GERALDINE CASTILLO	(geralcs94@gmail.com)
 * @author JHONNY VIELMA 		(jhonnyvq1@gmail.com)
 * @author Johan Alamo (lider de proyecto) <johan.alamo@gmail.com>
 * 
 * @package Componentes
 */


class Sesion{
	/**
		 * Funcion estatica que permite iniciar la sesion .
		 *
		 * Permite iniciar la sesion con el login y los permisos para que se puedan utilizar 
		 * posteriormente y obtenerlo.
		 *
		 * @param object   $login				Objetro login para guardar en la variable de sesion.
		 * @param object   $permisos			Objetro Permisos para guardar en la variable de sesion.
		 * 
		 * @throws Exception 					Exception cuando el parametro no es login.
		 */
	public static function iniciar($usuario){
		try{	
			if ((is_object($usuario)) && (get_class($usuario)=='Usuario')){
				Sesion::asignarLogin($usuario);
			}else
				throw new exception("El primer parametro de la funcion debe ser un objeto tipo Usuario");
		}catch (Exception $e){
			throw $e;
		}	
		
	}
	/**
		 * Funcion estatica que permite iniciar sesion .
		 *
		 * Permite iniciar la variable $_SESION de php.
		 * 
		 * @throws Exception 					Exception cuando el parametro no es login.
		 */
	
	public static function iniciarSesion(){
		session_start();
	}
	
	/**
		 * Funcion estatica que permite cerrar la sesion .
		 *
		 * Permite cerrar la sesion cuando ya esta activada, destruyendo $_SESION de php.
		 * 
		 */
	 
	public static function cerrarSesion(){
		unset($_SESSION);
		session_destroy();
			
	}
	
		/**
		 * Funcion estatica que permite saber si hay usuario logueado .
		 *
		 * Permite saber si hay un usuario logueado en el sistema.
		 * 
		 * @return boolean		True en caso de haber usuario logueado y false en caso de no estar loguado.
		 * 
		 */
	 
	public static function hayUsuarioLogueado(){
		return isset ($_SESSION['login']);
	}
	 

	private static function asignarLogin($usuario){
		if ((is_object($usuario)) && (get_class($usuario)=='Usuario'))
			$_SESSION['login']=$usuario;
		else
			throw new Exception ("Parametro no válido, debe ser un objeto Usuario ");
	}
	

	public static function obtenerLogin(){
		if (Sesion::hayUsuarioLogueado()){
			return $_SESSION['login'];
		}
		else 
			return Sesion::hayUsuarioLogueado();
	}

	public static function asignarDatosUsuario($arr){
		$_SESSION['datos'] = $arr;
	}
	
	public static function obtenerDatosUsuario(){
		if(isset($_SESSION['datos']))
			return $_SESSION['datos'];
		return null;
	}

}

?>
	
