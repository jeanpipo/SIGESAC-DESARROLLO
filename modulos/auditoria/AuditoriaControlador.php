<?php

	require_once("modulos/auditoria/modelo/AuditoriaServicio.php");
/**
 * @copyright 2015 - Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio
 * @license GPLv3
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 *
 * AuditoriaControlador.php - Controlador del módulo Persona.
 *
 * Este es el controlador del módulo Persona, permite manejar las 
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

	class AuditoriaControlador
	{

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
		public static function manejarRequerimiento()
		{
			$accion= PostGet::obtenerPostGet("m_accion");
			if(!$accion)
				$accion="listar";

			if($accion == 'listar')
				self::listar();			
			else
				throw new Exception ("'AuditoriaControlador' La accion $accion no es valida");
		}

		/**
		 * Función pública y estática que permite listar la auditoria que estan registradas en la DB.
		 * 
		 *
		 * Se obtienen todos los datos agregados, eliminados y modificados y se lista dependiendo del tipo de filtro
		 * que estes usando  
		 * 		
		 *
		 * @throws Exception 		Si es capturada alguna excepción en el servicio.
		 */
		public static function listar()
		{	
			try
			{	
				$tabla=PostGet::obtenerPostGet('tabla');
				$usuario=PostGet::obtenerPostGet('usuario');
				$tipo=PostGet::obtenerPostGet('accion');
			
				if(!$tipo)
					$tipo=null;
				if(!$usuario)
					$usuario=null;
				if(!$tabla)
					$tabla=null;

				$auditoria=AuditoriaServicio::listar($tabla,$usuario,$tipo);

				Vista::asignarDato('auditoria',$auditoria);

				Vista::asignarDato('estatus',1);					
				
				if(!$auditoria)
					Vista::asignarDato('mensaje','No hay datos auditados para mostrar');
				
				Vista::Mostrar();
			}
			catch(Exception $e)
			{
				throw $e;
			}
		}

		
	}
?>
