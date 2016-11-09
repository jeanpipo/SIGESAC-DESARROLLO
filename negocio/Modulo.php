<?php
/**
 * Modulo.php - Componente de MVCRIVERO.
 * 
 * Clase permite encapsular y simplificar el manejo de los datos de
 * lo que son los modulos para el manejo de la permisologia del MVC
 * ya que las acciones se pueden agregar o englobar a modulos y asi
 * estas acciones pertenecer a un modulo en comun.
 *
 * @copyright 2016 - Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio
 * @license GPLv3
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 *
 *
 * @author Johan Alamo (lider de proyecto) <johan.alamo@gmail.com>
 * @author GERALDINE CASTILLO (geralcs94@gmail.com)
 * @author JHONNY VIELMA 	  (jhonnyvq1@gmail.com)
 * 
 * @package MVC
 */


class Modulo{
	 /** @var Integer|null Código del modulo */
	public $codigo;
	/** @var String|null  Nombre del modulo */
	public $nombre;
	/** @var String|null  Descripción del modulo */
	public $descripcion;
	
	/**
	 * Metodo que permite iniciar todos los valores del objeto Modulo.
	 *
	 * 	Esta funcion asigna los valores si el usuario los manda por parametro 
	 *  y de no hacerlo le asigna valores predeterminados.
	 *
	 * @param String $codigo 		        Codigo que posee el modulo almacenada en el objeto.
	 * @param String $nombre				Nombre del modulo almacenada en el objeto.
	 * @param String $descripcion		    Descripcion del modulo almacenada en el objeto.
	 * 
	 * @return $this                         Instancia del objeto. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	function __construct ($codigo=null,$nombre=null,$descripcion=null){
			$this->asignarCodigo($codigo);
			$this->asignarNombre($nombre);
			$this->asignarDescripcion($descripcion);
			return $this;
	}
	/**
	 * Metodo que permite asignar el codigo al objeto.
	 *
	 * 	Metodo publico asigna el codigo pasado por parametro al objeto Modulo.
	 *
	 * @param Integer $codigo 		        Codigo a insertar en el objeto Modulo.
	 * @source  1 2 klfjelkfjlejflke
	 * 
	 * @return $this                         Instancia del objeto. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public function asignarCodigo($codigo){
		$this->codigo=$codigo;
		return $this;
	}
	/**
	 * Metodo que permite obtener el codigo.
	 *
	 * Metodo publico con el que se obtiene el codigo almacenado en el objeto Modulo. 
	 * 
	 * @return Integer || null              Codigo del objeto Modulo. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public function obtenerCodigo(){
		return $this->codigo;

	}
	/**
	 * Metodo publico que permite asignar el nombre al objeto.
	 *
	 * 	Metodo publico el cual asigna el nombre pasado por parametro al objeto Modulo.
	 *
	 * @param string $nombre 		        Nombre a insertar en el objeto Modulo.
	 * 
	 * @return $this                         Instancia del objeto. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public function asignarNombre($nombre){
		$this->nombre = $nombre;
		return $this;
	}
	 /**
	 * Metodo que permite obtener el nombre.
	 *
	 * Metodo publico con el que se obtiene el nombre almacenado en el objeto Modulo. 
	 * 
	 * @return String || null               Nombre del objeto Modulo. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public function obtenerNombre(){
		return $this->nombre;
	}
	/**
	 * Metodo publico que permite asignar la descripcion al objeto.
	 *
	 * 	Metodo publico el cual asigna la descripcion pasado por parametro al objeto Modulo
	 *
	 * @param String $descripcion 	        Descripción a insertar en el objeto Modulo.
	 * 
	 * @return $this                         Instancia del objeto. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public function asignarDescripcion($descripcion){
		$this->descripcion = $descripcion;
		return $this;
	}
	/**
	 * Metodo que permite obtener la descripción.
	 *
	 * Metodo publico con el que se obtiene la descripción almacenado en el objeto Modulo. 
	 * 
	 * @return String || null               Descripcion del objeto Modulo. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public function obtenerDescripcion(){
		return $this->descripcion;

	}

}
?>
