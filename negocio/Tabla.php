<?php
/**
 * @copyright 2016 - Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio
 * @license GPLv3
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 *
 * Tabla.php - Componente de MVCRIVERO.
 * 
 * Clase permite encapsular y simplificar el manejo de los datos de
 * lo que son las tablas para el manejo de la permisologia del MVC.
 *
 * 
 * @author GERALDINE CASTILLO (geralcs94@gmail.com)
 * @author JHONNY VIELMA 	  (jhonnyvq1@gmail.com)
 * @author Johan Alamo (lider de proyecto) <johan.alamo@gmail.com>
 * 
 * @package MVC
 */

	class Tabla {
		public $codigo;
		public $nombre;
		public $estatus;
		
		
		/**
		 * Metodo que permite iniciar todos los valores del objeto Tabla.
		 *
		 * 	Esta funcion asigna los valores si el usuario los manda por parametro 
		 *  y de no hacerlo le asigna valores predeterminados.
		 *
		 * @param String $codigo 		        Codigo que posee la tabla almacenada en el objeto.
		 * @param String  $Nombre				Nombre de la tabla almacenada en el objeto.
		 * @param Char  $estatus= S || N 		Estatus de la tabla almacenada en el objeto.
		 * 
		 * @return this                         Instancia del objeto. 
		 *
		 * @throws Exception 					No lanza exceptiones.
		 */
		function __construct ($codigo=null,$nombre=null,$estatus="S"){
			$this->asignarCodigo($codigo);
			$this->asignarNombre($nombre);
			$this->asignarEstatus($estatus);
			return $this;
		}
		
		/**
		 * Metodo que permite asignar el codigo al objeto.
		 *
		 * 	Metodo publico asigna el codigo pasado por parametro al objeto Tabla. 
		 *  .
		 *
		 * @param Integer $codigo 		        Codigo a insertar en el objeto Tabla.
		 * 
		 * @return this                         Instancia del objeto. 
		 *
		 * @throws Exception 					No lanza exceptiones.
		 */
		
		public function asignarCodigo($codigo){
			$this->codigo = $codigo;
			return $this;
		}
		/**
		 * Metodo que permite obtener el codigo.
		 *
		 * Metodo publico con el que se obtiene el codigo almacenado en el objeto Tabla. 
		 * 
		 * @return Integer || null              Codigo del objeto Tabla. 
		 *
		 * @throws Exception 					No lanza exceptiones.
		 */
		public function obtenerCodigo(){
			return $this->codigo;

		}
		/**
		 * Metodo publico que permite asignar el nombre al objeto.
		 *
		 * 	Metodo publico el cual asigna el nombre pasado por parametro al objeto Tabla.
		 *
		 * @param string $nombre 		        Nombre a insertar en el objeto Tabla.
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
		 * Metodo que permite obtener el nombre.
		 *
		 * Metodo publico con el que se obtiene el nombre almacenado en el objeto Tabla. 
		 * 
		 * @return String || null               Nombre del objeto Tabla. 
		 *
		 * @throws Exception 					No lanza exceptiones.
		 */
		public function obtenerNombre(){
			return $this->nombre;
		}
		/**
		 * Metodo publico que permite asignar el estatus al objeto.
		 *
		 * 	Metodo publico el cual asigna el estatus pasado por parametro al objeto Tabla
		 * 	este estatus puede ser S que significa que la tabla existe en la base de datos,
		 * 	N de no existir.
		 *
		 * @param Char $estatus 		        Estatus a insertar en el objeto Tabla.
		 * 
		 * @return this                         Instancia del objeto. 
		 *
		 * @throws Exception 					No lanza exceptiones.
		 */
		public function asignarEstatus($estatus){
			$this->estatus = $estatus;
			return $this;
		}
		/**
		 * Metodo que permite obtener el estatus.
		 *
		 * Metodo publico con el que se obtiene el estatus almacenado en el objeto Tabla. 
		 * 
		 * @return Char                         Estatus del objeto Tabla. 
		 *
		 * @throws Exception 					No lanza exceptiones.
		 */
		public function obtenerEstatus(){
			return $this->nombreCorto;
		}	
	}
?>
