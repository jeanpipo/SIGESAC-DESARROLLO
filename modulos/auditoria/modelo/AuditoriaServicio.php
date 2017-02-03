<?php

/**
 * @copyright 2015 - Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio
 * @license GPLv3
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 *
 * PersonaServicio.php - Servicio del módulo Persona.
 *
 * Esta clase ofrece el servicio de conexión a la base de datos, recibe 
 * los parámetros, construye las consultas SQL, hace las peticiones a 
 * la base de datos y retorna los objetos o datos correspondientes a la
 * acción. Todas las funciones de esta clase relanzan las excepciones si son capturadas.
 * Esto con el fin de que la clase manejadora de errores las capture y procese.
 * Esta clase trabaja en conjunto con la clase Conexion.
 * 
 *
 * @link /base/clases/conexion/Conexion.php 	Clase Conexion
 * 
 * Esta clase trabaja en conjunto con la clase errores.
 * 
 * @link /base/clases/Errores.php 		Clase manejadora de errores.
 *  
 * @author JEAN PIERRE SOSA GOMEZ (jean_pipo_10@hotmail.com)
 * @author Johan Alamo (lider de proyecto) <johan.alamo@gmail.com>
 * 
 * @package Servicios
 */
class AuditoriaServicio
{

	/**
	 * Función que permite listar todas las tabalas auditadas almacenadas en la tabla sis.t_auditoria
	 * de la base de datos.
	 *
	 * Puede recibir ciertas cantidades de parametro y dependiendo de los parametros ingresados se va a proceder a listar
	 * ciertas tablas, una sola tabla o a todas las tablas auditadas
	 * luego va realizar la consulta a la base de datos y retorna un arreglo asociativo con los datos auditados obtenidas o
	 * null si no se encontró coincidencia.
	 *
	 * @param int $codigo 						Codigo del persona este es el codigo que posee la persona.
	 * @param int $cedula						Es el numero de cedula de la persona.
	 * @param String $correo 					Es el correo electronico del persona.
	 * @param String $nombre1 					Es el primer nombre de la persona.
	 * @param String $nombre2					Es el segundo nombre de la persona.
	 * @param String $apellido1					Es el primer apellido de la persona.
	 * @param String $apellido2					Es el segundo apellido de la persona.
	 * @param chart $sexo						Indica el sexo del persona.
	 * @param int $cod_instituto				Indica el instituto donde el persona esta trabajando y/o estudiando.
	 * @param int $cod_pensum 					Codigo de pensum donde la persona esta trabajando y/o estudiando.
	 * @param chart $cod_estado 				Codigo de estado que posee el empleado y/o estudiante.
	 * @return array|null						Retorna un arreglo de arreglos asociativos o null de no encontrarse coincidencias.								
	 *
	 * @throws Exception 					Si se producen errores en operaciones con la base de datos.
	 */

	public static function listar($tabla,$usuario,$tipo)
	{
		try
		{	
			$conexion = Conexion::conectar();
			
			$consulta = "select * from aud.f_auditoria_sel(string_to_array(?,','),
															string_to_array(?,','),
															string_to_array(upper(?),',')
														);";

			$ejecutar=$conexion->prepare($consulta);			
			$ejecutar-> execute(array($tabla,$usuario,$tipo));
			if($ejecutar->rowCount() != 0)
				return $ejecutar->fetchAll();
			else
				return null;  		
			
			
		}
		catch(Exception $e){
			throw $e;
		}
	}
}
?>

