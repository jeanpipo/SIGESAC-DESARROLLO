<?php
	
/**
 * @copyright 2014 - Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio
 * @license GPLv3
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 *
 * PensumControlador.php - Controlador del módulo pensum.
 *
 * Esta clase ofrece el servicio de conexión a la base de datos, recibe 
 * los parámetros, construye las consultas SQL, hace las peticiones a 
 * la base de datos y retorna los objetos o datos correspondientes a la
 * acción. en este archivo se contiene todo lo relacionado a pensum
 * es el archivo que permite la interacion la lo relacionado a pensum
 * en la base de datos.Todas las funciones de esta clase relanzan las excepciones si son capturadas.
 * Esto con el fin de que la clase manejadora de errores las capture y procese.
 *
 * @author Rafael Garcia (rafaelantoniorf@gmail.com)s
 * @author Johan Alamo (lider de proyecto) <johan.alamo@gmail.com>
 *
 *  clase PensumServicio 
 * @link modulos/pensum/modelo/PensumServicio.php 			 Clase PensumServicio
 * @link negocio/Pensum.php			                         Clase Pensum
 * 
 * @package Controladores
 */
	require_once("modulos/pensum/modelo/PensumServicio.php");
	require_once("negocio/Pensum.php");	


	class  PensumControlador
	{
		
		/**
		 * Función Permite manejar la accion en el controlador.
		 * 
		 * Permite manejar la accion en el controlador.
		 * 
		 * @param string $m_accion 			  		obtenerPostGet accion a hacer.
		 *
		 * @throws Exception 					Si no se puede hacer la acion.
		 */
		public static function manejarRequerimiento(){		
		
				//permite obtener la acción a realizar en este módulo
				$accion = PostGet::obtenerPostGet('m_accion');
	
				//Acciones de curso
				if ($accion == null) 					
					$accion = 'listar';			
				else if ($accion == 'listar') 	
					self::listar();
				else if ($accion == 'preModif')					
					self::preModif();
				else if ($accion == 'preModifAgre')					
					self::preModifAgre();
				else if ($accion == 'agregar')					
					self::agregar();					
				else if ($accion == 'buscarPensum')
					self::buscarPensum();
				else if ($accion == 'buscarPorInstituto')
					self::buscarPorInstituto();
				else if ($accion == 'buscarPorTrayecto')
					self::buscarPorTrayecto();
				else if ($accion =='modificar')				
					self::modificar();					
				else if ($accion == 'eliminar')
					self::eliminar();
				else if ($accion == 'mostrar')
					self::mostrar();
				else if($accion == 'pensumEstActivo')
					self::pensumEstActivo();
				else
				throw new Exception ("(PensumControlador) Accion $accion no es valida");
			
		}

		/**
		 * Función del controlaodr que Permite listar .
		 * 
		 * permite listar todos los pensum.		 		 
		 *
		 * @throws Exception 					Si no se puede hacer la acion y ocurre una error en el servicio.
		 */
		public static function listar(){
			try{				
				$r = PensumServicio::listarPensum();
				Vista::asignarDato('pensum',$r);
				Vista::asignarDato('estatus',1);
				Vista::mostrar();
			}catch(Exception $e){
				throw $e;
			}
		}


/**
		 * Función Permite Agregar/modifiar pensum.
		 * 
		 * @param int codigo                     variable codigo de pesum
		 * @param string nombre 			  	variable pensum a agregar.
		 * @param string nomCorto 			  	variable pensum a agregar.
		 * @param string direccion 			  	variable pensum a agregar.
		 * @param int min_can_elect 			  	variable pensum a agregar.
		 * @param int min_cre_elect 			  	variable pensum a agregar.
		 * @param int min_cre_obligat 			  	variable pensum a agregar.
		 * @param string fec_creac 			  	variable pensum a agregar.
		 *
		 * @throws Exception 					Si no se puede hacer la acion.
		 */	

		public static function preModifAgre()
		{
			try
			{
				$pensum = new Pensum ();
				if (!PostGet::obtenerPostGet('codigo')){	
				$pensum->asignarNombre(PostGet::obtenerPostGet('nombre'));			
				$pensum->asignarNombreCorto(PostGet::obtenerPostGet('nom_corto'));			
				$pensum->asignarObservaciones(PostGet::obtenerPostGet('observaciones'));
				$pensum->asignarMinCanElectiva(PostGet::obtenerPostGet('minCanElectiva'));
				$pensum->asignarMinCreElectiva(PostGet::obtenerPostGet('minCreElectiva'));
				$pensum->asignarMinCreObligatorio(PostGet::obtenerPostGet('minCreObli'));
				$pensum->asignarFechaCreacion(PostGet::obtenerPostGet('fecha'));
				if (PostGet::obtenerPostGet('observaciones')==='')
					$pensum->asignarObservaciones(null);				
				 	self::agregar($pensum);
				}else{
				$pensum->asignarCodigo(PostGet::obtenerPostGet('codigo'));
				$pensum->asignarNombre(PostGet::obtenerPostGet('nombre'));			
				$pensum->asignarNombreCorto(PostGet::obtenerPostGet('nom_corto'));			
				$pensum->asignarObservaciones(PostGet::obtenerPostGet('observaciones'));
				$pensum->asignarMinCanElectiva(PostGet::obtenerPostGet('minCanElectiva'));
				$pensum->asignarMinCreElectiva(PostGet::obtenerPostGet('minCreElectiva'));
				$pensum->asignarMinCreObligatorio(PostGet::obtenerPostGet('minCreObli'));
				$pensum->asignarFechaCreacion(PostGet::obtenerPostGet('fecha'));
				if (PostGet::obtenerPostGet('observaciones')==='')
					$pensum->asignarObservaciones(null);
					self::modificar($pensum);
				}			
			

			}catch (Exception $e){
				throw $e;
				//var_dump($e);
			}
		}



/**
		 * Función Permite Agregar pensum.
		 * 
		 * Permite manejar  el agregar un pensum, recibe los parámetros desde 
		 * la vista (arreglo PostGet) y llama a pensum servicio que permite
		 * comunicarse con la base de datos,y este último retorna el resultado
	     * ya sea éxito o fracaso,
		 * 
		 * @param string nombre 			  	variable pensum a agregar.
		 * @param string nomCorto 			  	variable pensum a agregar.
		 * @param string direccion 			  	variable pensum a agregar.
		 * @param int min_can_elect 			  	variable pensum a agregar.
		 * @param int min_cre_elect 			  	variable pensum a agregar.
		 * @param int min_cre_obligat 			  	variable pensum a agregar.
		 * @param string fec_creac 			  	variable pensum a agregar.
		 *
		 * @throws Exception 					Si no se puede hacer la acion.
		 */	

		public static function agregar($pensum)
		{
			try
			{					
				$r=PensumServicio::agregarPensumObjetc($pensum);			
				$mensaje= "Pensum Agregado";
				Vista::asignarDato('pensum', $r);
				Vista::asignarDato('estatus', 1);
				Vista::asignarDato('mensaje', $mensaje);
				Vista::mostrar();

			}catch (Exception $e){
				throw $e;
				//var_dump($e);
			}
		}
		
	/**
	 * Función que permite eliminar un pensum.
	 *
	 *Permite eliminar un pensum, recibe los parámetros desde 
	 * la vista (arreglo PostGet) y llama a pensum servicio que permite
	 * comunicarse con la base de datos,y este último retorna el resultado
     * ya sea éxito o fracaso.
	 * 
	 * @param string $codigo 			  		codigo codigo pensum.
	 *
	 * @throws Exception 					Si no se puede hacer la acion.
	 */	
		public static function eliminar()
		{
			try
			{
				$r=PensumServicio::eliminar(PostGet::obtenerPostGet('codigo'));
				$mensaje="Pensum Eliminado";
				Vista::asignarDato('pensum',$r);
				Vista::asignarDato('estatus',1);
				Vista::asignarDato('mensaje',$mensaje);
				Vista::mostrar();
			}
			catch (Exception $e){
				throw $e;
			}
		}

	/**
	 * Función que permite obtener un pensum.
	 *
	 *Permite obtener un pensum, recibe los parámetros desde 
	 * la vista (arreglo PostGet) y llama a pensum servicio que permite
	 * comunicarse con la base de datos,y este último retorna el resultado
     * ya sea éxito o fracaso.
	 * 
	 * @param string $codigo 			  		codigo codigo pensum.
	 *
	 * @throws Exception 					Si no se puede hacer la acion.
	 */		
		public static function buscarPensum()
		{
			try
			{
				$r=PensumServicio::obtener(PostGet::obtenerPostGet('codigo'));
			//	var_dump($r);
				$mensaje="Pensum";
				Vista::asignarDato('pensum',$r);
				Vista::asignarDato('estatus',1);
				Vista::asignarDato('mensaje',$mensaje);
				Vista::mostrar();
			}
			catch (Exception $e){
				throw $e;
			}
		}

		/**
	 * Función que permite obtener un pensum.
	 *
	 *Permite obtener un pensum, recibe los parámetros desde 
	 * la vista (arreglo PostGet) y llama a pensum servicio que permite
	 * comunicarse con la base de datos,y este último retorna el resultado
     * ya sea éxito o fracaso.
	 * 
	 * @param string $codigo 			  		codigo codigo pensum.
	 *
	 * @throws Exception 					Si no se puede hacer la acion.
	 */		
		public static function buscarPorInstituto()
		{
			try
			{
				$r=PensumServicio::ObtenerPensumInsituto(PostGet::obtenerPostGet('codigo'));
				$mensaje="Pensum";
				Vista::asignarDato('pensum',$r);
				Vista::asignarDato('estatus',1);
				Vista::asignarDato('mensaje',$mensaje);
				Vista::mostrar();
			}
			catch (Exception $e){
				throw $e;
			}
		}

	/**
	 * Función que permite obtener un pensum.
	 *
	 *Permite obtener un pensum, recibe los parámetros desde 
	 * la vista (arreglo PostGet) y llama a pensum servicio que permite
	 * comunicarse con la base de datos,y este último retorna el resultado
     * ya sea éxito o fracaso.
	 * 
	 * @param string $codigo 			  		codigo codigo pensum.
	 *
	 * @throws Exception 					Si no se puede hacer la acion.
	 */		
		public static function buscarPorTrayecto()
		{
			try
			{
				$r=PensumServicio::ObtenerPensumTrayecto(PostGet::obtenerPostGet('codigo'));
			//	var_dump($r);
				$mensaje="Pensum";
				Vista::asignarDato('pensum',$r);
				Vista::asignarDato('estatus',1);
				Vista::asignarDato('mensaje',$mensaje);
				Vista::mostrar();
			}
			catch (Exception $e){
				throw $e;
			}
		}


	/**
	 * Función que permite modificar un pensum.
	 *
	 * Permite modificar un pensum, recibe los parámetros desde 
	 * la vista (arreglo PostGet) y llama a pensum servicio que permite
	 * comunicarse con la base de datos,y este último retorna el resultado
     * ya sea éxito o fracaso.
	 * 
 	 * @param string nombre 			  	variable pensum a modificar.
	 * @param string nomCorto 			  	variable pensum a modificar.
	 * @param string direccion 			  	variable pensum a modificar.
	 * @param int min_can_elect 			  	variable pensum a modificar.
	 * @param int min_cre_elect 			  	variable pensum a modificar.
	 * @param int min_cre_obligat 			  	variable pensum a modificar.
	 * @param string fec_creac 			  	variable pensum a modificar.
	 * @throws Exception 					Si no se puede hacer la acion.
	 */	
		public static function modificar ($pensum)
		{
			try
			{
    		
				$r = PensumServicio::modificarPensumObject($pensum);
				$mensaje= "Pensum Modificado";
				Vista::asignarDato('pensum',$r);
				Vista::asignarDato('estatus',1);
				Vista::asignarDato('mensaje',$mensaje);;
				Vista::mostrar();		
			}catch (Exception $e) {
				throw $e;
			}
		}

		/**
		 * Función del controlaodr que Permite mostrar vista .
		 * 
		 * permite mostrar vista pensum.		 		 
		 *
		 * @throws Exception 					Si no se puede hacer la acion y ocurre una error en el servicio.
		 */
		public static function mostrar(){
			try{				
				Vista::mostrar();
			}catch(Exception $e){
				throw $e;
			}
		}

		/**
		* Funcion del carga vista de modificar
		*
		*
		*/
		public static function preModif(){
			try
			{
				$r=PensumServicio::obtener(PostGet::obtenerPostGet('codigoPensum'));
			//	var_dump($r);
				$mensaje="Pensum";
				Vista::asignarDato('pensum',$r);
			//	var_dump($r);
				Vista::asignarDato('estatus',1);
				Vista::asignarDato('mensaje',$mensaje);
				Vista::mostrar();
			}
			catch (Exception $e){
				throw $e;
			}
		}

		public static function pensumEstActivo(){

			try{				
				$r=PensumServicio::pensumConEstActivo(PostGet::obtenerPostGet('codigo'));
					
				Vista::asignarDato('pensum',$r);
				//var_dump($r);
				
				self::mostrar();

			}
			catch(Exception $e){
				throw $e;
			}
		}	
	
	}
?>
