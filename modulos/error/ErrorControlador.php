<?php

	require_once("modulos/error/modelo/ErrorServicio.php");
/**
 * @copyright 2015 - Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio
 * @license GPLv3
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 *
 * ErrorControlador.php - Controlador del módulo Curso.
 *
 * Este es el controlador del módulo Error, permite manejar las 
 * operaciones relacionadas con los errores del sistema (agregar, modificar,
 * eliminar, consultar y buscar) 
 * 
 * Es el intermediario entre la base de datos y la vista.
 *  
 * @author Jean Pierre Sosa Gómez (jean_pipo_10@hotmail.com)  
 * @author Johan Alamo (lider de proyecto) <johan.alamo@gmail.com>
 * 
 * @package Controladores
 */

	class ErrorControlador{

		/**
		 * Función pública y estática que permite manejar el requerimiento
		 * (o acción) indicado por el usuario.
		 * 
		 * Todas las acciones de este módulo trabajan en conjunto con la clase Vista para 
	     * mostrar el resultado de la petición del usuario y dicha interacción con la base de datos.
	     * Para más información de esta clase, visite:
		 *
		 * @link /base/clases/vista/Vista.php 	Clase Vista.	
	     *
		 * @var string $accion 					Acción requerida por el usuario.
		 *
		 * @throws Exception 					Si la acción no coincide con las predefinidas del módulo.
		 *
		 */
		
		public static function manejarRequerimiento(){
			$accion = PostGet::obtenerPostGet('m_accion');		

			//si $accion viene null se tomara por defecto la accion de listar
			if(!$accion)
				$accion = 'listar';

			//si $accion trae algun valor va a seleccionar alguna de estas acciones
			if($accion == 'listar')
				self::listar();
			else if($accion == 'agregarError')
				self::agregarError();
			else if($accion == 'buscarError')
				self::buscarError();
			else if($accion == 'modificacionError')
				self::modificacionError();
			else if($accion == 'eliminarError')
				self::eliminarError();
			else if ($accion == 'depurar')
				self::depurar();

			// si $accion no coincide con ninguna de las acciones anteriores va a arrojar la exepcion 
			else
				throw new Exception("(ErrorControlador) La acción $accion no es válida.");
		}


		/**
		 * Función pública y estática que permite listar los errores que se han reportado.
		 * 
		 *
		 * Se obtienen todos los errores, a la vez se obtienen todos los tipos de estado y tipos de estados especificos.  
		 * en la funcion listarEstado(PostGet::obtenerPostGet('codigo_estado') se pasa por parametro los tipos de estado 
		 * de error para despues listarlos.
		 * La funcion listarEstado() obtiene todos los tipos de estados ejemplo:"revidado","corregido","en proceso",etc.
		 * 		
		 *
		 * @throws Exception 		Si es capturada alguna excepción en el servicio.
		 */	

		public static function listar(){
			try{
				
				if($r= ErrorServicio::listar()){

					Vista::asignarDato('errores',$r);
					Vista::asignarDato('estatus',1);	

					
					// se pasa por parametro los tipos de estados de error para luego ser listado
								
					if($r=ErrorServicio::listarEstado(PostGet::obtenerPostGet('codigo_estado')))  	
						Vista::asignarDato('estado',$r);				
					else					
						Vista::asignarDato('estado','Sin Estado');

					/*
					* lista todos los tipos de estados de error para que el usuario seleccione el estado 
					* y asi mostrar todos los errores que concuerden con ese estado de error					
					*/
					if($r=ErrorServicio::listarEstado())  		
						Vista::asignarDato('estado_completo',$r);				
					else					
						Vista::asignarDato('estado_completo','Sin Estado');
				}
				else{
					Vista::asignarDato('mensaje', "No hay errores disponibles.");
				}
				Vista::mostrar();
			}
			catch(Exception $e){
				throw $e;
			}
		}

		/**
		 * Función pública y estática que permite agregar un nuevo error.
		 *
		 * La funcion buscarErrorArchivo($codError) permite revisar el archivo numeroErrores.txt ubicado en 
		 * la raiz del sistema y verifica si el error existe y como parametro se pasa el 
		 * el codigo de error. Si el error existe va a llamar a la funcion obtenerError($codError) la cual
		 * va a obtener la informacion del error buscandolo en el archivo de texto llamado errores.txt
		 * y ubicado en la raiz del sistema de lo contrario se asiganara por defecto el codigo de error "0"
		 * para luego almacenar el error en la base de datos.
		 * 
		 *
		 * @var int $codError			Codigo del error que el usuario ingresa.
		 * @var String $descError		la descriopcion del error que el usuario ingresa
		 *
		 * @throws Exception 			Si es capturada alguna excepcion en el servicio.
		 *
		 */

		public static function agregarError(){
			try{
				$codError = PostGet::obtenerPostGet('codError');
				$descError = PostGet::obtenerPostGet('descError');
				$cadenaError="";
				if(manejoErrores::buscarErrorArchivo($codError) && $codError!="")
					$cadenaError=manejoErrores::obtenerError($codError);
				else
					$codError = 0;
				
				ErrorServicio::agregarError($codError,Sesion::obtenerCodigo(),'E',date("d/m/Y"),'01/01/2000',$descError,'',$cadenaError);

				Vista::asignarDato('mensaje','Se reportó el error exitosamente.');

				Vista::mostrar();
			}catch(Exception $e){
				throw $e;
			}
		}

		/**
		 * Función pública y estática que permite buscar un error en la base de datos.
		 *
		 * la funcion buscarError() lo primero que hace esta funcion es buscar el error y ver si existe
		 * usando la funcion "listar()" y se le pasa por parametro el codigo de error que se desea buscar
		 * luego llama a la funcion "listarEstado()" para que traiga todos los estados de error. 
		 *	 
		 *
		 * @throws Exception 			Si es capturada alguna excepcion en el servicio.
		 *
		 */

		public static function buscarError()
		{
			try
			{				
				if($r=ErrorServicio::listar(PostGet::obtenerPostGet('codigo_error')))
				{
					Vista::asignarDato('errores',$r);
					Vista::asignarDato('estatus',1);					

					if($r=ErrorServicio::listarEstado()) 
						Vista::asignarDato('estado',$r);				
					else					
						Vista::asignarDato('estado','Sin Estado');	
										
				}
				else
					Vista::asignarDato('mensaje','No se encontro el Error.');

				Vista::mostrar();
			}

			
			catch(Exception $e)		{throw $e;}
		}

		
		/**
		 * Función pública y estática que permite modifica un error en la base de datos.
		 *
		 * la funcion modificacionError() llama a la funcion "modificarError()" en el servicio y se le pasa 
		 * por parametro el estado del error, la respuesta dada por la persona que esta corrigiendo	 
		 * el error y el id del error para poder ser modificado en la base de datos.
		 *
		 * @throws Exception 			Si es capturada alguna excepcion en el servicio.
		 *
		 */

		public static function modificacionError()
		{
			try
			{

				ErrorServicio::modificarError(
												PostGet::obtenerPostGet('estado_error'),
												PostGet::obtenerPostGet('respuesta'),
												PostGet::obtenerPostGet('id_error'),
												date("d/m/Y")
											);
				Vista::asignarDato('estatus',1);
				Vista::asignarDato('mensaje','El error se ha modificado correctamente.');
				Vista::mostrar();

			}
			catch(Exception $e)		{throw $e;}
		}


		/**
		 * Función pública y estática que permite elimina un error en la base de datos.
		 *
		 * la funcion eliminarError() llama a la funcion "eliminarError()" en el servicio y se le pasa por parametro
		 * el id del error para poder ser eliminado de la base de datos.
		 *
		 * @throws Exception 			Si es capturada alguna excepcion en el servicio.
		 *
		 */

		public static function eliminarError()
		{
			try
			{
				ErrorServicio::eliminarError(PostGet::obtenerPostGet('id_error'));
				Vista::asignarDato("estatus",1);
				vista::asignarDato("mensaje","El reporte fue borrado con exito.");
				Vista::mostrar();
			}
			catch(Exception $e)		{throw $e;}
		}

		public static function depurar(){		//poner esta funcion en otra clase 
			echo "<pre>";
			var_dump($_SESSION);
			echo "</pre>";			
		}

	}
	
?>
