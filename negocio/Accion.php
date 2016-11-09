<?php
/**
 * Accion.php - Componente de MVCRIVERO.
 * 
 * Clase permite encapsular y simplificar el manejo de los datos de
 * lo que son las acciones para el manejo de la permisologia del MVC.
 *
 * @copyright 2016 - Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio
 * @license GPLv3
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @author Johan Alamo (lider de proyecto) <johan.alamo@gmail.com>
 * @author GERALDINE CASTILLO (geralcs94@gmail.com)
 * @author JHONNY VIELMA 	  (jhonnyvq1@gmail.com)
 * 
 * @package MVC
 */



class Accion{
	 /** @var Integer|null Código de la acción */
	public $codigo;
	 /** @var String|null Nombre de la acción */
	public $nombre;
	 /** @var String|null Descripción de la acción */
	public $descripcion;
	 /** @var Integer|null Código del módulo */
	public $codModulo;

	/**
	 * Método que permite iniciar todos los valores del objeto Accion.
	 *
	 * 	Esta función asigna los valores si el usuario los manda por parámetro 
	 *  y de no hacerlo le asigna valores predeterminados.
	 *
	 * @param String  $codigo 		        Código que posee la acción almacenada en el objeto.
	 * @param String  $nombre				Nombre de la acción almacenada en el objeto.
	 * @param String  $descripcion		    Descripción de la acción almacenada en el objeto.
	 * @param Integer $codModulo		    Código del módulo al cual pertenece la acción.	 
	 * 
	 * @return this                         Instancia del objeto. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	function __construct ($codigo=null,$nombre=null,$descripcion=null,$codModulo=null){
			$this->asignarCodigo($codigo);
			$this->asignarNombre($nombre);
			$this->asignarDescripcion($descripcion);
			$this->asignarCodModulo($codModulo);
			return $this;
	}

	/**
	 * 	Método público asigna el código pasado por parámetro al objeto Accion.
	 *
	 * @param Integer $codigo 		        Código a insertar en el objeto Accion.
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
	 * Método público con el que se obtiene el código almacenado en el objeto Accion. 
	 * 
	 * @return Integer || null              Codigo del objeto Acción. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public function obtenerCodigo(){
		return $this->codigo;
	}
	/**
	 * 	Método público el cual asigna el nombre pasado por parámetro al objeto Accion.
	 *
	 * @param string $nombre 		        Nombre a insertar en el objeto Accion.
	 * 
	 * @return this                         Instancia del objeto. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public function asignarNombre($nombre){
		$this->nombre = $nombre;
		return $this;
	}
	 /**
	 * Método público con el que se obtiene el nombre almacenado en el objeto Accion. 
	 * 
	 * @return String || null               Nombre del objeto Accion. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public function obtenerNombre(){
		return $this->nombre;
	}
	/**
	 * 	Método público el cual asigna la descripción pasado por parámetro al objeto Accion.
	 *
	 * @param String $descripcion 	        Descripción a insertar en el objeto Accion.
	 * 
	 * @return this                         Instancia del objeto. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public function asignarDescripcion($descripcion){
		$this->descripcion = $descripcion;
		return $this;
	}
	/**
	 * Método público con el que se obtiene la descripción almacenado en el objeto Accion. 
	 * 
	 * @return String || null               Descripción del objeto Accion. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public function obtenerDescripcion(){
		return $this->descripcion;
	}
	/**
	 * 	Método público el cual asigna el código del módulo pasado por parámetro al objeto Accion.
	 *
	 * @param String $codModulo 	        Codigo del modulo a insertar en el objeto Acción.
	 * 
	 * @return this                         Instancia del objeto. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public function asignarCodModulo($codModulo){
		$this->codModulo = $codModulo;
		return $this;
	}
	/**
	 * 	Método público el cual obtiene el código del módulo al cual pertenece el objeto Accion.
	 * 
	 * @return Integer || null              Código del módulo. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public function obtenerCodModulo(){
		return $this->codModulo;
	}
}
?>
