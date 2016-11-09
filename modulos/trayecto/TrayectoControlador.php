<?php

	
/**
 * @copyright 2014 - Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio
 * @license GPLv3
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 *
 * TrayectoControlador.php - Controlador del módulo trayecto.
 *
 * Esta clase ofrece el servicio de conexión a la base de datos, recibe 
 * los parámetros, construye las consultas SQL, hace las peticiones a 
 * la base de datos y retorna los objetos o datos correspondientes a la
 * acción. en este archivo se contiene todo lo relacionado a trayecto
 * es el archivo que permite la interacion la lo relacionado a trayecto
 * en la base de datos.Todas las funciones de esta clase relanzan las excepciones si son capturadas.
 * Esto con el fin de que la clase manejadora de errores las capture y procese.
 *
 * @author Rafael Garcia (rafaelantoniorf@gmail.com)s
 * @author Johan Alamo (lider de proyecto) <johan.alamo@gmail.com>
 *
 *  clase TrayectoServicio 
 * @link modulos/trayecto/modelo/TrayectoServicio.php 			 Clase PensumServicio
 * @link egocio/Trayecto.php		                         Clase Pensum
 * 
 * @package Controladores
 */
	require_once("modulos/trayecto/modelo/TrayectoServicio.php");
	require_once("negocio/Trayecto.php");



	class  TrayectoControlador{


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
				$accion = PostGet::obtenerPostGet('m_accion');	

				if ($accion == null) 					
					$accion = 'listar';		

				else if ($accion == 'listar') 	
					self::listar();
				else if ($accion == 'preAgreModif') 	
					self::preAgreModif();
				else if ($accion =='agregarTrayecto')
					self::agregar();
				else if ($accion == 'verTrayecto')
					self::obtener();
				elseif ($accion == 'obtenerPorPatron')
					self::obtenerPorPatron();
				else if ($accion == 'modificarTrayecto')
					self::modificar();				
				else if ($accion == 'eliminarTrayecto')
					self::eliminar();
				else if($accion == 'listarTrayectoPensum')
					self::listarTrayectoPensum();
				else
				throw new Exception ("(TrayectoControlador) Accion $accion no es valida");			
		}
		

		/**
		*
		* Función Permite Agregar trayecto.
		* 
		* Permite manejar  el agregar un trayecto, recibe los parámetros desde 
		* la vista (arreglo PostGet) y llama a trayecto servicio que permite
		* comunicarse con la base de datos,y este último retorna el resultado
	    * ya sea éxito o fracaso,
		* @param codigo $codigo                         variable codigo a agregar.
		* @param cod_pensum $cod_pensum 			  	variable trayecto a agregar.
		* @param num_trayecto $num_trayecto 			  	variable trayecto a agregar.
		* @param certificado $certificado 			  	variable trayecto a agregar.
		* @param min_cre_obligatoria $min_cre_obligatoria 			  	variable trayecto a agregar.
		* @param min_cre_electiva $min_cre_electiva 			  	variable trayecto a agregar.
		* @param min_cre_acreditable $min_cre_acreditable 			  	variable trayecto a agregar.
		* @param min_can_electiva $min_can_electiva 			  	variable trayecto a agregar.
		*
		* @throws Exception 					Si no se puede hacer la acion.
		*/

		public	static function preAgreModif(){
			try{					
				$trayecto = new Trayecto ();				
				if (PostGet::obtenerPostGet('codigo') == '') {					
					$trayecto->asignarCodPensum(PostGet::obtenerPostGet('cod_pensum'));
					$trayecto->asignarNumero(PostGet::obtenerPostGet('num_trayecto'));
					$trayecto->asignarCertificado(PostGet::obtenerPostGet('certificado'));
					$trayecto->asignarMinCreObligatorio(PostGet::obtenerPostGet('min_cre_obligatoria'));	
					$trayecto->asignarMinCreElectiva(PostGet::obtenerPostGet('min_cre_electiva'));	
					$trayecto->asignarMinCreAcreditable(PostGet::obtenerPostGet('min_cre_acreditable'));	
					$trayecto->asignarMinCanElectiva(PostGet::obtenerPostGet('min_can_electiva'));	
					self::agregar($trayecto);
				}else{								
					$trayecto->asignarCodigo(PostGet::obtenerPostGet('codigo'));
					$trayecto->asignarCodPensum(PostGet::obtenerPostGet('cod_pensum'));
					$trayecto->asignarNumero(PostGet::obtenerPostGet('num_trayecto'));
					$trayecto->asignarCertificado(PostGet::obtenerPostGet('certificado'));
					$trayecto->asignarMinCreObligatorio(PostGet::obtenerPostGet('min_cre_obligatoria'));	
					$trayecto->asignarMinCreElectiva(PostGet::obtenerPostGet('min_cre_electiva'));	
					$trayecto->asignarMinCreAcreditable(PostGet::obtenerPostGet('min_cre_acreditable'));	
					$trayecto->asignarMinCanElectiva(PostGet::obtenerPostGet('min_can_electiva'));
					self::modificar($trayecto);
				}		
			/*	$mensaje="trayecto Pensum";
				Vista::asignarDato('unidad',$unidades);
				Vista::asignarDato('mensaje',$mensaje);
				Vista::asignarDato('estatus',1);
				Vista::mostrar(); */
			}catch(Exception $e){
				throw $e;
			}
		}

		/**
		 * Función Permite Agregar trayecto.
		 * 
		 * Permite manejar  el agregar un trayecto, recibe los parámetros desde 
		 * la vista (arreglo PostGet) y llama a trayecto servicio que permite
		 * comunicarse con la base de datos,y este último retorna el resultado
	     * ya sea éxito o fracaso,
		 * 
		 * @param cod_pensum $cod_pensum 			  	variable trayecto a agregar.
		 * @param num_trayecto $num_trayecto 			  	variable trayecto a agregar.
		 * @param certificado $certificado 			  	variable trayecto a agregar.
		 * @param min_cre_obligatoria $min_cre_obligatoria 			  	variable trayecto a agregar.
		 * @param min_cre_electiva $min_cre_electiva 			  	variable trayecto a agregar.
		 * @param min_cre_acreditable $min_cre_acreditable 			  	variable trayecto a agregar.
		 * @param min_can_electiva $min_can_electiva 			  	variable trayecto a agregar.
		  *
		 * @throws Exception 					Si no se puede hacer la acion.
		 */	
	
		public static function agregar($trayecto)
		{
			try
			{
				$r=TrayectoServicio::agregarTrayectoObjetc($trayecto);
				$mensaje="Trayecto Agregado";
				Vista::asignarDato('trayecto',$r);
				Vista::asignarDato('estatus',1);
				Vista::asignarDato('mensaje',$mensaje);
				Vista::mostrar();
				 
			}catch (Exception $e) {throw $e;}
		} 

		

	/**
	 * Función que permite eliminar un trayecto.
	 *
	 *Permite eliminar un trayecto, recibe los parámetros desde 
	 * la vista (arreglo PostGet) y llama a trayecto servicio que permite
	 * comunicarse con la base de datos,y este último retorna el resultado
     * ya sea éxito o fracaso.
	 * 
	 * @param string $codigo 			  		codigo codigo trayecto.
	 *
	 * @throws Exception 					Si no se puede hacer la acion.
	 */		

		public static function eliminar()
		{
			try
			{
				TrayectoServicio::eliminar(PostGet::obtenerPostGet('codigo'));
				$mensaje = "Exito Trayecto Eliminado";
				Vista::asignarDato('mensaje',$mensaje);		
				Vista::asignarDato('estatus',1);
				Vista::mostrar();
			}
			catch (Exception $e){throw $e;}
		}

			
	/**
	 * Función que permite obtener un trayecto.
	 *
	 *Permite obtener un trayecto, recibe los parámetros desde 
	 * la vista (arreglo PostGet) y llama a trayecto servicio que permite
	 * comunicarse con la base de datos,y este último retorna el resultado
     * ya sea éxito o fracaso.
	 * 
	 * @param string $codigo 			  		codigo codigo trayecto.
	 *
	 * @throws Exception 					Si no se puede hacer la acion.
	 */
		public static function obtener()
		{
			try{				
				$r=TrayectoServicio::obtener(PostGet::obtenerPostGet('codigo'));
				$mensaje="Trayecto";
				Vista::asignarDato('trayecto',$r);
				Vista::asignarDato('estatus',1);
				Vista::asignarDato('mensaje',$mensaje);
				Vista::mostrar();
			}catch (Exception $e) {throw $e;}
		}


		/**
	 * Función que permite obtener un trayecto.
	 *
	 *Permite obtener un trayecto, recibe los parámetros desde 
	 * la vista (arreglo PostGet) y llama a trayecto servicio que permite
	 * comunicarse con la base de datos,y este último retorna el resultado
     * ya sea éxito o fracaso.
	 * 
	 * @param string $codigo 			  		codigo codigo trayecto.
	 *
	 * @throws Exception 					Si no se puede hacer la acion.
	 */
		public static function obtenerPorPatron()
		{
			try{				
				$r=TrayectoServicio::obtenerPorPatron(PostGet::obtenerPostGet('codigo'),PostGet::obtenerPostGet('patron'));
				$mensaje="Trayecto";
				Vista::asignarDato('pensum',$r);
				Vista::asignarDato('estatus',1);
				Vista::asignarDato('mensaje',$mensaje);
				Vista::mostrar();
			}catch (Exception $e) {throw $e;}
		}


	/**
	 * Función que permite modificar un trayecto.
	 *
	 * Permite modificar un trayecto, recibe los parámetros desde 
	 * la vista (arreglo PostGet) y llama a trayecto servicio que permite
	 * comunicarse con la base de datos,y este último retorna el resultado
     * ya sea éxito o fracaso.
	 * 
 	 * @param codigo $codigo 			  	variable trayecto a modificar.
	 * @param cod_pensum $cod_pensum 			  	variable trayecto a modificar.
	 * @param num_trayecto $num_trayecto 			  	variable trayecto a modificar.
	 * @param certificado $certificado 			  	variable trayecto a modificar.
	 * @param min_cre_obligatoria $min_cre_obligatoria 			  	variable trayecto a modificar.
	 * @param min_cre_electiva $min_cre_electiva 			  	variable trayecto a modificar.
	 * @param min_cre_acreditable $min_cre_acreditable 			  	variable trayecto a modificar.
	 * @param min_can_electiva $min_can_electiva 			  	variable trayecto a modificar.
	 *
	 * @throws Exception 					Si no se puede hacer la acion.
	 */	
		public static function modificar($trayecto)
		{
			try{
				$r=TrayectoServicio::modificarTrayectoObject($trayecto);
				$mensaje="Trayecto modificado";
				Vista::asignarDato('trayecto',$r);
				Vista::asignarDato('estatus',1);
				Vista::asignarDato('mensaje',$mensaje);
				Vista::mostrar();		
			}catch (Exception $e) {throw $e;}
		}

		/**
		 * Función del controlaodr que Permite listar .
		 * 
		 * permite listar todos los trayecto.		 		 
		 *
		 * @throws Exception 					Si no se puede hacer la acion y ocurre una error en el servicio.
		 */		
		private static function listar(){
			try{
				$trayecto=TrayectoServicio::listarTrayectos();
					
					if ($trayecto){
						Vista::asignarDato('trayectos',$trayecto);
						Vista::asignarDato('estatus',1);
					}
					else {
						$mensaje="no hay trayecto";
						Vista::asignarDato('mensaje',$mensaje);
					}
					Vista::mostrar();
				}catch(Exception $e){
					throw $e;
				}
		}

		public static function listarTrayectoPensum(){
			try{
				
				$r=TrayectoServicio::obtenerTrayectoPensum(PostGet::obtenerPostGet('codigo'));
				Vista::asignarDato("trayecto",$r);
				Vista::mostrar();
			}
			catch(Exception $e){
				throw $e;
			}
		}

	}
?>
