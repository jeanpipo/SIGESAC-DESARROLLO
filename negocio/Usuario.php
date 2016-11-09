<?php
/**
 * Usuario.php - Componente de MVCRIVERO.
 * 
 * Clase permite encapsular y simplificar el manejo de los datos del
 * usuario para el manejo de la permisoloía del MVC.
 * Esta clase posee un atributo Permiso que contiene la permisología del usuario. 
 * @copyright 2016 - Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio
 * @license GPLv3
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 * 
 * @author GERALDINE CASTILLO (geralcs94@gmail.com)
 * @author JHONNY VIELMA 	  (jhonnyvq1@gmail.com)
 * @author Johan Alamo (lider de proyecto) <johan.alamo@gmail.com>
 * @package MVC
 */
require_once'negocio/Permisos.php';

class Usuario{
	 /** @var Integer|null entero que representa el código del usuario*/
	public $codigo; 
	 /** @var Integer|null contraseña del usuario */
	public $clave;
	 /** @var String|null cadena que representa el nombre del usuario */
	public $usuario;  
	 /** @var Char|null cadena que representa el tipo de usuario U(usuario) R(rol) */
	public $tipo; 
	 /** @var String|null cadena donde se puede guardar cualquier información adicional del usuario. */
	public $campo1; 
	 /** @var String|null cadena donde se puede guardar cualquier información adicional del usuario. */
	public $campo2;
	 /** @var String|null cadena donde se puede guardar cualquier información adicional del usuario. */
	public $campo3;	
	 /** @var Permiso|null objeto que representa los permisos del usuario. */
	public $permisos; 
	
	/**
	 * Método público que permite asignar el código al objeto Usuario.
	 * @param Integer $codigo 		        Código del usuario.
	 * 
	 * @return this                         Instancia del objeto. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public function asignarCodigo($codigo){
		$this->codigo=$codigo;
		return $this;
	}
	/**
	 * Método público que permite obtener el código del objeto Usuario. 
	 * 
	 * @return Integer || null              Código del usuario. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public function obtenerCodigo(){
		return $this->codigo;

	}
	/**
	 * Método público que permite asignar el usuario al objeto Usuario.
	 *
	 * @param string $usuario 		        Nombre del usurio.
	 * 
	 * @return this                         Instancia del objeto. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public function asignarUsuario($usuario){
		$this->usuario = $usuario;
		return $this;
	}
	 /**
	 * Método público que permite obtener el usuario del objeto Usuario.
	 *
	 * @return String || null               Nombre del usuario. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public function obtenerUsuario(){
		return $this->usuario;
	}
	/**
	 * Método público que permite asignar el tipo al objeto Usuario.
	 *
	 * @param String $tipo	        		Tipo de ususario U(usuario) o R(rol).
	 * 
	 * @return this                         Instancia del objeto. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public function asignarTipo($tipo){
		$this->tipo = $tipo;
		return $this;
	}
	/**
	 * Método público que permite obtener el tipo del objeto Usuario.
	 * 
	 * @return String || null               Tipo del usuario. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public function obtenerTipo(){
		return $this->tipo;

	}
	/**
	 * Método público que permite asignar el campo1 al objeto Usuario.
	 *
	 * @param String $campo1	        	Donde se puede guardar cualquier información adicional del usuario.
	 * 
	 * @return this                         Instancia del objeto. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public function asignarCampo1($campo1){
		$this->campo1 = $campo1;
		return $this;
	}
	/**
	 * Método público que permite obtener el campo1 del objeto Usuario.
	 * 
	 * @return String || null               campo1. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public function obtenerCampo1(){
		return $this->campo1;

	}
	/**
	 * Método público que permite asignar el campo2 al objeto Usuario.
	 *
	 * @param String $campo2	        	Donde se puede guardar cualquier información adicional del usuario.
	 * 
	 * @return this                         Instancia del objeto. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public function asignarCampo2($campo2){
		$this->campo2 = $campo2;
		return $this;
	}
	/**
	 * Método público que permite obtener el campo2 del objeto Usuario.
	 * 
	 * @return String || null               campo2. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public function obtenerCampo2(){
		return $this->campo2;

	}
		/**
	 * Método público que permite asignar el campo3 al objeto Usuario.
	 *
	 * @param String $campo3	        	Donde se puede guardar cualquier información adicional del usuario.
	 * 
	 * @return this                         Instancia del objeto. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public function asignarCampo3($campo3){
		$this->campo3 = $campo3;
		return $this;
	}
	/**
	 * Método público que permite obtener el campo3 del objeto Usuario.
	 * 
	 * @return String || null               campo3. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public function obtenerCampo3(){
		return $this->campo3;

	}
		/**
	 * Método público que permite asignar la clave al objeto Usuario.
	 *
	 * @param String $clave	        		clave del usuario.
	 * 
	 * @return this                         Instancia del objeto. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public function asignarClave($clave){
		$this->clave = $clave;
		return $this;
	}
	/**
	 * Método público que permite obtener la clave del objeto Usuario.
	 * 
	 * @return String || null               clave. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public function obtenerClave(){
		return $this->clave;

	}

	public function asignarPermisos($permisos){
		$this->permisos=$permisos;
	}

	public function obtenerPermiso($accion){
		return $this->permisos->obtenerPermiso($accion);

	}
	public function obtenerPermisosJavascript($nombreVar){
		return $this->permisos->obtenerJavascript($nombreVar);

	}

	public function obtenerPermisos(){
		return $this->permisos;

	}
}
?>
