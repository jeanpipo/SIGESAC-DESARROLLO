<?php

/**
 * @copyright 2014 - Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio
 * @license GPLv3
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 *
 * InstitutoControlador.php  Controladores de MVCRIVERO.
 *
 *	Este es el controlador del módulo Instituto, permite manejar las 
 *	operaciones relacionadas con los institutos (agregar, modificar,
 *	eliminar, consultar, buscar), es el intermediario entre la base de
 *	datos y la vista. La función manejarRequerimiento se maneja la accion a emprender, 
 *  obteniéndola del arreglo Post/Get en la posición 'accion'
 * 
 *  
 * @author RAFAEL GARCIA 		(rafaelantoniorf@gmail.com)
 * @author JHONNY VIELMA 		(jhonnyvq1@gmail.com)
 * @author Johan Alamo (lider de proyecto) <johan.alamo@gmail.com>
 * @link /modulos/instituto/modelo/InstitutoServicio.php 			 Clase InstitutoServicio
 * @link /negocio/Instituto.php 			                         Clase Instituto
 * 
 * @package Controladores
 */

//Objeto Instituto
require_once "negocio/Instituto.php";
require_once "modulos/instituto/modelo/InstitutoServicio.php";


class InstitutoControlador {
	
	

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

		//permite colocar una acción predefinida en caso de no colocarla
		if ( ! $accion)
			$accion = 'listar';
			

		if ($accion == 'listar')
			self::listarInstitutos();
		elseif ($accion == 'agregar') 
			self::agregarInstituto();
		elseif ($accion == 'modificar') 
			self::modificarInstituto();
		elseif ($accion == 'eliminar') 
			self::eliminar();
		elseif ($accion == 'obtener') 
			self::obtener();
		else
			die("Acci&oacute;n inv&aacute;lida en el m&oacute;dulo Instituto: $accion");
	}

	
	/**
		 * Función Permite Agregar Instituto.
		 * 
		 * Permite manejar  el agregar un instituto, recibe los parámetros desde 
		 * la vista (arreglo PostGet) y llama a instituto servicio que permite
		 * comunicarse con la base de datos,y este último retorna el resultado
	     * ya sea éxito o fracaso,
		 * 
		 * @param string $nombre 			  		nombre nombre instituto.
		 * @param string $nombreC 			  		nombreC nombre corto instituto
		 * @param string $direccion 			  	direccion accion a hacer.
		 *
		 * @throws Exception 					Si no se puede hacer la acion.
		 */	
	
	private static function agregarInstituto() {
		$instituto = new Instituto();
		$instituto->asignarNombre(PostGet::obtenerPostGet('nombre'));
		$instituto->asignarNombreCorto(PostGet::obtenerPostGet('nombreC'));
		$instituto->asignarDireccion(PostGet::obtenerPostGet('direccion'));
		InstitutoServicio::agregar($instituto);
		Vista::asignarDato('mensaje','Se ha agregado el instituto');
		Vista::asignarDato('estatus',1);
		Vista::mostrar();
	}
	

/**
	 * Función que permite modificar un instituto.
	 *
	 * Permite modificar un instituto, recibe los parámetros desde 
	 * la vista (arreglo PostGet) y llama a instituto servicio que permite
	 * comunicarse con la base de datos,y este último retorna el resultado
     * ya sea éxito o fracaso.
	 * 
	 * @param string $nombre 			  		nombre nombre instituto.
	 * @param string $nombreC 			  		nombreC nombre corto instituto
	 * @param string $direccion 			  	direccion accion a hacer.
	 *
	 * @throws Exception 					Si no se puede hacer la acion.
	 */	
	private static function modificarInstituto() {
		
		$instituto = new Instituto();
		$instituto->asignarNombre(PostGet::obtenerPostGet('nombre'));
		$instituto->asignarCodigo(PostGet::obtenerPostGet('codigo'));
		$instituto->asignarNombreCorto(PostGet::obtenerPostGet('nombreC'));
		$instituto->asignarDireccion(PostGet::obtenerPostGet('direccion'));
	//	var_dump($instituto);
		InstitutoServicio::modificar($instituto);
		Vista::asignarDato('estatus',1);
		Vista::asignarDato('mensaje','Se ha modificado el instituto');
		Vista::mostrar();
	}


	/**
	 * Función que permite obtener un instituto.
	 *
	 *Permite obtener un instituto, recibe los parámetros desde 
	 * la vista (arreglo PostGet) y llama a instituto servicio que permite
	 * comunicarse con la base de datos,y este último retorna el resultado
     * ya sea éxito o fracaso.
	 * 
	 * @param string $codigo 			  		codigo codigo instituto.
	 *
	 * @throws Exception 					Si no se puede hacer la acion.
	 */		
	private static function obtener() {
		

		$ins=InstitutoServicio::obtener(PostGet::obtenerPostGet('codigo'));
		Vista::asignarDato('instituto',$ins);
		Vista::asignarDato('estatus',1);
		Vista::mostrar();
	}

	/**
	 * Función que permite eliminar un instituto.
	 *
	 *Permite eliminar un instituto, recibe los parámetros desde 
	 * la vista (arreglo PostGet) y llama a instituto servicio que permite
	 * comunicarse con la base de datos,y este último retorna el resultado
     * ya sea éxito o fracaso.
	 * 
	 * @param string $codigo 			  		codigo codigo instituto.
	 *
	 * @throws Exception 					Si no se puede hacer la acion.
	 */		
	private static function eliminar() {
		

		$ins=InstitutoServicio::eliminar(PostGet::obtenerPostGet('codigo'));
		Vista::asignarDato('mensaje',"instituto eliminado");
		Vista::asignarDato('estatus',1);
		Vista::mostrar();
	}
	
	/**
	 * Función del controlaodr que Permite listar .
	 * 
	 * permite listar todos los pensum.		 		 
	 *
	 * @throws Exception 					Si no se puede hacer la acion y ocurre una error en el servicio.
	 */		
	private static function listarInstitutos(){
		try{
			$institutos=InstitutoServicio::listarInstitutos();
				
				if ($institutos){
					Vista::asignarDato('institutos',$institutos);
					Vista::asignarDato('estatus',1);
				}
				else {
					$mensaje="no hay institutos";
					Vista::asignarDato('mensaje',$mensaje);
				}
				Vista::mostrar();
			}catch(Exception $e){
				throw $e;
			}
	}
		
}
