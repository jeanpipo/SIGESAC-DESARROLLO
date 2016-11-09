<?php 
/**
 *
 * TablaAccion.php - Componente de MVCRIVERO.
 * 
 * Clase permite encapsular y simplificar el manejo de los datos de
 * lo que son los permisos que tiene una accion en una tabla ya sea
 * para insertar(I), modificar(U), eliminar(D) o select (s)para el 
 * manejo de la permisologia del MVC.
 *
 * @copyright 2016 - Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio
 * @license   GPLv3
 * @license   http://www.gnu.org/licenses/gpl-3.0.html
 * 
 * @author GERALDINE CASTILLO (geralcs94@gmail.com)
 * @author JHONNY VIELMA 	  (jhonnyvq1@gmail.com)
 * @author Johan Alamo (lider de proyecto) <johan.alamo@gmail.com>
 * @package MVC
 */
class TablaAccion {
		 /** @var Integer|null Código de la acción */
		public $codAccion;
		 /** @var Integer|null Código de la tabla */
		public $codTabla;
		 /** @var String|null Permisos que tiene la ación sobre la tabla*/
		public $permisos;
		 /** @var String|null Nombre de la tabla*/
		public $nombre;

	/**
	 *  Función que permite asignar los valores si el usuario los manda por parámetro 
	 *  y de no hacerlo le asigna valores predeterminados, todos en null.
	 *
	 * @param Integer $codAccion		    Código de la acción que se almacenara en el objeto.
	 * @param Integer $codTabla				Código de la tabla que se almacenara en el objeto.
	 * @param String  $permisos		        Permisos que posee la acción en la tabla que se almacenará en el objeto.
	 * @param String  $nombre		        Nombre de la tabla que se guardará en el objeto la cual es la dueña del codTabla.	 
	 * 
	 * @return this                         Instancia del objeto. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
		function __construct ($codAccion=null,$codTabla=null,$permisos=null,$nombre=null){

			$this->asignarCodAccion($codAccion);
			$this->asignarCodTabla($codTabla);
			$this->asignarPermisos($permisos);
			$this->asignarNombre($nombre);
			return $this;
		}
		
	/**
	 * 	Método público que asigna el código de la acción pasado por parámetro al objeto TablaAcción.
	 *
	 * @param Integer $codAccion 	        Código de acción a guardar en el objeto TablAcción.
	 * 
	 * @return this                         Instancia del objeto. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
		public function asignarCodAccion($codAccion){	
			$this->codAccion = $codAccion;
			return $this;
		}
	/**
	 * 	Método público que obtiene el código de la del objeto TablaAcción
	 * 
	 * @return Integer || null              Código de la acción. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
		public function obtenerCodAccion(){
			return $this->codAccion;
		}
	/**
	 * 	Método público que asigna el código de la tabla pasado por parámetro al objeto TablaAcción.
	 *
	 * @param Integer $codTabla	            Código de la tabla a guardar en el objeto TablaAcción.
	 * 
	 * @return this                         Instancia del objeto. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
		public function asignarcodTabla($codTabla){
			$this->codTabla= $codTabla;
			return $this;
		}
	/**
	 * 	Método público que obtiene el código de la tabla del objeto TablaAcción.
	 *
	 * 
	 * @return Integer || null              Código de la tabla. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
		public function obtenercodTabla(){
			return $this->codTabla;
		}
	/**
	 * 	Método público que asigna los permisos pasado por parámetro al objeto TablaAcción,
	 *  estos permisos son los que posee la acción en la tabla, los permisos se pasan por 
	 *  parámetro con la inicial del permiso es decir U o I o D o S y si son varios los permisos
	 *  estos van corridos por ejemplo US si se tiene permiso de update y select.
	 *
	 * @param String $permisos	            Permisos a guardar en el objeto.
	 * @return this                         Instancia del objeto. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
		public function asignarPermisos($permiso){
			$this->permisos = $permiso;
			return $this;
		}
	/**
	 * 	Método público que obtiene los permisos del objeto TablaAcción.
	 *
	 * 
	 * @return String || null               Permisos. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
		public function obtenerPermisos(){
			return $this->permisos;
		}
	/**
	 * 	Método público que asigna el nombre de la tabla al objeto TablaAccion,
	 *  este nombre de la tabla pertenece al código de tabla almacenado en el 
	 *	objeto.
	 *
	 * @param String $nombre            Nombre de la tabla a guardar en el objeto.
	 *
	 * @return this                     Instancia del objeto. 
	 *
	 * @throws Exception 			    No lanza exceptiones.
	 */
		public function asignarNombre($nombre){
			$this->nombre = $nombre;
			return $this;
		}
	/**
	 * 	Método puúblico que obtiene el nombre de la tabla del objeto TablaAcción,
	 * 	este nombre de la tabla pertenece al código de tabla almacenado en el 
	 *	objeto.
	 * 
	 * @return String || null               Nombre de la tabla. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
		public function obtenerNombre(){
			return $this->nombre;
		}
	}
?>
