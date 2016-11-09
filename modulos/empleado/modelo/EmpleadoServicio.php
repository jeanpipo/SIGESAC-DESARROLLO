<?php

/**
 * @copyright 2015 - Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio
 * @license GPLv3
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 *
 * EmpleadoServicio.php - Servicio del módulo Empleado.
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
 *
 * @package Servicios
 */
class EmpleadoServicio
{

	/**
	 * Función pública y estática que permite agregar un empleado a la base de datos.
	 *
	 * Esta funcion es la encargada de agregar un nuevo empleado a la base de datos,
	 * donde recibe cierta cantidad parametros para ser almacenados en la tabla sis.t_empleado.
	 *
	 *
	 * @param int $cod_persona 					Codigo de la persona este es el codigo que relaciona la tabla persona con la tabla empleado.
	 * @param int $cod_instituto				Codigo de la institucion donde labora el empleado.
	 * @param int $cod_pensum 					Codigo de pensum.
	 * @param chart $cod_estado 				Codigo de estado que posee el empleado.
	 * @param String $fec_inicio				Fecha en la que empezo a trabajar el empleado.
	 * @param String $fec_fin					Fecha en la que termino a trabajar el empleado.
	 * @param bool $es_jef_pensum				Indica si el empleado es jefe de pensum
	 * @param bool $es_jef_con_estudio			Indica si el empleado es jefe de control de estudio
	 * @param bool $es_ministerio				Indica si el empleado trabaja en el ministerio
	 * @param bool $es_docente					Indica si el empleado es un docente
	 * @param String $es_observaciones			Observaciones que se tengan respecto all empleado
	 *
	 * @return int 								Retorna el codigo que posee el empleado en la base de datos.
	 * @throws Exception 					Con el mensaje "No se pudo agregar al empleado."
	 * si no se pudo llevar a cabo la operación.
	 */
	public static function agregar(	$cod_persona=null,		$cod_instituto=null,		$cod_pensum=null,
									$cod_estado=null,   	$fec_inicio=null,			$fec_fin=null,
									$es_jef_pensum=null,	$es_jef_con_estudio=null,   $es_ministerio=null,
									$es_docente=null,		$observaciones=null
								)
	{
		try
		{

			$conexion = Conexion::conectar();
			$consulta = " select sis.f_empleado_ins(
													:cod_persona,		:cod_instituto,		:cod_pensum,
													:cod_estado,		:fec_inicio,		:fec_fin,
													:es_jef_pensum,		:es_jef_con_estudio,:es_ministerio,
													:es_docente,		:observaciones
												);";
			$ejecutar = $conexion->prepare($consulta);

			$ejecutar->bindParam(':cod_persona',$cod_persona, PDO::PARAM_STR);
			$ejecutar->bindParam(':cod_instituto',$cod_instituto, PDO::PARAM_STR);
			$ejecutar->bindParam(':cod_pensum',$cod_pensum, PDO::PARAM_STR);
			$ejecutar->bindParam(':cod_estado',$cod_estado, PDO::PARAM_STR);
			$ejecutar->bindParam(':fec_inicio',$fec_inicio, PDO::PARAM_STR);
			$ejecutar->bindParam(':fec_fin',$fec_fin, PDO::PARAM_STR);
			$ejecutar->bindParam(':es_jef_pensum',$es_jef_pensum, PDO::PARAM_STR);
			$ejecutar->bindParam(':es_jef_con_estudio',$es_jef_con_estudio, PDO::PARAM_STR);
			$ejecutar->bindParam(':es_ministerio',$es_ministerio, PDO::PARAM_STR);
			$ejecutar->bindParam(':es_docente',$es_docente, PDO::PARAM_STR);
			$ejecutar->bindParam(':observaciones',$observaciones, PDO::PARAM_STR);
			
			$login=Vista::obtenerDato('login');
			if($login->obtenerPermiso('EmpleadoAgregar')){
				$ejecutar->setFetchMode(PDO::FETCH_ASSOC);

				$ejecutar->execute();

				$codigo=$ejecutar->fetchColumn(0);
				return $codigo;
			}
			else
				throw new Exception("NO tienes Permiso para agregar a un empleado");
				
		}
		catch(Exception $e){
			throw $e;
		}
	}

	/**
	 * Función pública y estática que permite modificar a un empleado.
	 *
	 * Esta funcion es la encargada de modificar un a un empleado, se pasan cierta cantidad de parámetros
	 * para ser modificados en la base de datos.
	 *
	 *
	 * @param int $codigo 						Codigo del empleado este es el codigo que posee el empleado.
	 * @param int $cod_persona 					Codigo de la persona este es el codigo que relaciona la tabla persona con la tabla empleado.
	 * @param int $cod_instituto				Codigo de la institucion donde labora el empleado.
	 * @param int $cod_pensum 					Codigo de pensum.
	 * @param chart $cod_estado 				Codigo de estado que posee el empleado.
	 * @param String $fec_inicio				Fecha en la que empezo a trabajar el empleado.
	 * @param String $fec_fin					Fecha en la que termino a trabajar el empleado.
	 * @param bool $es_jef_pensum				Indica si el empleado es jefe de pensum
	 * @param bool $es_jef_con_estudio			Indica si el empleado es jefe de control de estudio
	 * @param bool $es_ministerio				Indica si el empleado trabaja en el ministerio
	 * @param bool $es_docente					Indica si el empleado es un docente
	 * @param String $observaciones			Observaciones que se tengan respecto all empleado
	 *
	 * @return int 								si se realizo la modificacion con exito devolvera 1 de lo contrario devolvera 0.
	 * @throws Exception 							Con el mensaje "No se logro modificar la informacion del empleado." cuando
	 * no se puede llevar a cabo la operación.
	 */

	public static function modificar(	$codigo=null,		$cod_persona=null,		$cod_instituto=null,
										$cod_pensum=null,	$cod_estado=null,  		$fec_inicio=null,
										$fec_fin=null,		$es_jef_pensum=null,	$es_jef_con_estudio=null,
										$es_ministerio=null,$es_docente=null,		$observaciones=null
									)
	{
		try
		{
			$conexion = Conexion::conectar();
			$consulta = " select sis.f_empleado_act(:codigo,		:cod_persona,		:cod_instituto,
													:cod_pensum,	:cod_estado,		:fec_inicio,
													:fec_fin,		:es_jef_pensum,		:es_jef_con_estudio,
													:es_ministerio,	:es_docente,		:observaciones
												)";
			$ejecutar = $conexion->prepare($consulta);

			$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_STR);
			$ejecutar->bindParam(':cod_persona',$cod_persona, PDO::PARAM_STR);
			$ejecutar->bindParam(':cod_instituto',$cod_instituto, PDO::PARAM_STR);
			$ejecutar->bindParam(':cod_pensum',$cod_pensum, PDO::PARAM_STR);
			$ejecutar->bindParam(':cod_estado',$cod_estado, PDO::PARAM_STR);
			$ejecutar->bindParam(':fec_inicio',$fec_inicio, PDO::PARAM_STR);
			$ejecutar->bindParam(':fec_fin',$fec_fin, PDO::PARAM_STR);
			$ejecutar->bindParam(':es_jef_pensum',$es_jef_pensum, PDO::PARAM_STR);
			$ejecutar->bindParam(':es_jef_con_estudio',$es_jef_con_estudio, PDO::PARAM_STR);
			$ejecutar->bindParam(':es_ministerio',$es_ministerio, PDO::PARAM_STR);
			$ejecutar->bindParam(':es_docente',$es_docente, PDO::PARAM_STR);
			$ejecutar->bindParam(':observaciones',$observaciones, PDO::PARAM_STR);

			$login=Vista::obtenerDato('login');
			if($login->obtenerPermiso('EmpleadoModificar')){
				$ejecutar->setFetchMode(PDO::FETCH_ASSOC);

				$ejecutar->execute();

				$row = $ejecutar->fetchColumn(0);

				return $row;
			}
			else
				throw new Exception("NO tienes permiso para modificar a un empleado");
				
		}
		catch(Exception $e){
			throw $e;
		}
	}

	/**
	 * Función que permite listar todos los empleados almacenados en la base de datos.
	 *
	 * Puede recibir ciertas cantidades de parametro y dependiendo de los parametros ingresados se va a proceder a listar
	 * ciertos empleados, un solo empleado o todos los empleados registrados,
	 * luego va realizar la consulta a la base de datos y retorna un arreglo asociativo con los empleados obtenidos o
	 * null si no se encontró coincidencia.
	 *
	 * @param int $codigo 						Codigo del empleado este es el codigo que posee el empleado.
	 * @param int $cod_persona 					Codigo de la persona este es el codigo que relaciona la tabla persona con la tabla empleado.
	 * @param int $cod_instituto				Codigo de la institucion donde labora el empleado.
	 * @param int $cod_pensum 					Codigo de pensum.
	 * @param chart $cod_estado 				Codigo de estado que posee el empleado.
	 * @param String $fec_inicio				Fecha en la que empezo a trabajar el empleado.
	 * @param String $fec_fin					Fecha en la que termino a trabajar el empleado.
	 * @param bool $es_jef_pensum				Indica si el empleado es jefe de pensum
	 * @param bool $es_jef_con_estudio			Indica si el empleado es jefe de control de estudio
	 * @param bool $es_ministerio				Indica si el empleado trabaja en el ministerio
	 * @param bool $es_docente					Indica si el empleado es un docente
	 *
	 * @return array|null						Retorna un arreglo de arreglos asociativos o null de no encontrarse coincidencias.
	 *
	 * @throws Exception 					Si se producen errores en operaciones con la base de datos.
	 */

	public static function listar (	$pnf=null, 					$estado=null,		$instituto=null,
									$codigo=null,				$cod_persona=null,	$es_jef_pensum=null,
								   	$es_jef_con_estudio=null,	$es_ministerio=null,$es_docente=null,
								   	$fec_inicio=null,			$fec_fin=null
								)
	{
		try
		{


			$conexion = Conexion::conectar();
			/*$consulta="select em.*, p.nom_corto as nom_pensum, i.nom_corto as nom_instituto, e.nombre,
							p.nombre as nom_pen_largo, i.nombre as nom_ins_largo,
							(select to_char(em.fec_inicio,'DD/MM/YYYY')) as fec_inicios,
							(select to_char(em.fec_fin,'DD/MM/YYYY')) as fec_final
						from sis.t_empleado em, sis.t_instituto i,
							sis.t_est_empleado e, sis.t_pensum p where true ";
*/
			$consulta="select em.*, p.nom_corto as nom_pensum, i.nom_corto as nom_instituto, e.nombre,
						p.nombre as nom_pen_largo, i.nombre as nom_ins_largo,
						(select to_char(em.fec_inicio,'DD/MM/YYYY')) as fec_inicios,
						(select to_char(em.fec_fin,'DD/MM/YYYY')) as fec_final
						FROM sis.t_empleado em LEFT JOIN sis.t_instituto i ON(i.codigo=em.cod_instituto) LEFT JOIN 
						sis.t_est_empleado e ON (e.codigo=em.cod_estado) LEFT JOIN 
						sis.t_pensum p ON (p.codigo=em.cod_pensum) where true";
			if($codigo)
				$consulta.= " and em.codigo = $codigo ";

			if($pnf)
				$consulta.= " and em.cod_pensum = $pnf ";

			if($instituto)
				$consulta.= " and em.cod_instituto = $instituto ";

			if($estado)
				$consulta.= " and em.cod_estado ='$estado' ";

			if($cod_persona)
				$consulta.= " and em.cod_persona = $cod_persona ";

			if($es_jef_pensum)
				$consulta.= " and em.es_jef_pensum = $es_jef_pensum ";

			if($es_jef_con_estudio)
				$consulta.= " and em.es_jef_con_estudio = $es_jef_con_estudio ";

			if($es_ministerio)
				$consulta.= " and em.es_ministerio = $es_ministerio ";

			if($es_docente)
				$consulta.= " and em.es_docente = $es_docente ";

			if($fec_inicio)
				$consulta.= " and em.fec_inicio = '$fec_inicio' ";

			if($fec_fin)
				$consulta.= " and em.fec_fin = '$fec_fin' ";

			$consulta.=" /*and i.codigo=em.cod_instituto and e.codigo=em.cod_estado
				and p.codigo=em.cod_pensum*/ order by em.fec_inicio desc";

			$login=Vista::obtenerDato('login');
			if($login->obtenerPermiso('EmpleadoListar')){
				$ejecutar=$conexion->prepare($consulta);
				//var_dump($consulta);
				$ejecutar-> execute(array());

				if($ejecutar->rowCount() != 0)
					return $ejecutar->fetchAll();
				else
					return null;
			}
			else
				throw new Exception("NO tienes permiso para listar empleados");
				

		}
		catch(Exception $e){
			throw $e;
		}
	}

	/**
	 * Función que permite listar todos los empleados almacenados con informacion de la tabla sis.t_persona
	 * en la base de datos.
	 *
	 * Puede recibir ciertas cantidades de parametro y dependiendo de los parametros ingresados se va a proceder a listar
	 * ciertos empleados, un solo empleado o todos los empleados registrados,
	 * luego va realizar la consulta a la base de datos y retorna un arreglo asociativo con los empleados obtenidos o
	 * null si no se encontró coincidencia.
	 *
	 * @param int $codigo 						Codigo del empleado este es el codigo que posee el empleado.
	 * @param int $cedula						Es el numero de cedula del empleado.
	 * @param String $correo 					Es el correo electronico del empleado.
	 * @param String $nombre1 					Es el primer nombre del empleado.
	 * @param String $nombre2					Es el segundo nombre del empleado.
	 * @param String $apellido1					Es el primer apellido del empleado.
	 * @param String $apellido2					Es el segundo apellido del empleado.
	 * @param chart $sexo						Indica el sexo del empleado.
	 * @param int $cod_instituto				Indica el instituto donde el empleado esta trabajando.
	 * @param int $cod_pensum 					Codigo de pensum.
	 * @param chart $cod_estado 				Codigo de estado que posee el empleado.
	 * @return array|null						Retorna un arreglo de arreglos asociativos o null de no encontrarse coincidencias.
	 *
	 * @throws Exception 					Si se producen errores en operaciones con la base de datos.
	 */
//si da algun error revisar los parametros
	public static function listarPersonaEmpleado (	$cod_pensum=null,	$cod_estado=null,	$cod_instituto=null,
													$codigo=null,		$campo=null,		$cedula=null,
													$correo=null,	  	$nombre1=null,		$nombre2=null,	
													$apellido1=null,  	$apellido2=null,	$sexo=null
												)
	{
		try
		{
			$conexion = Conexion::conectar();
			$consulta="select p.*, p.codigo as cod_persona/*, em.*, em.codigo as cod_empelado*/
								from sis.t_persona p, sis.t_empleado em
							where true and p.codigo=em.cod_persona ";

			if($codigo)
				$consulta.= " and p.codigo like '%$codigo%'";

			if($cedula)
				$consulta.= " and p.cedula like '%$cedula%'";

			if($correo)
				$consulta.= " and p.cor_personal like '%$correo%'";

			if($nombre1)
				$consulta.= " and p.nombre1 like '%$nombre1%'";

			if($nombre2)
				$consulta.= " and p.nombre2 like '%$nombre2%'";

			if($apellido1)
				$consulta.= " and p.apellido1 like '%$apellido1%'";

			if($apellido2)
				$consulta.= " and p.apellido2 like '%$apellido2%'";

			if($sexo)
				$consulta.= " and p.sexo like '%$sexo%'";

			if($cod_instituto)
				$consulta.= " and em.cod_instituto=$cod_instituto";

			if($cod_pensum)
				$consulta.= " and em.cod_pensum=$cod_pensum";

			if($campo){
				$campo=strtoupper($campo);
				$consulta.=" and (CONCAT(cast(p.cedula as varchar),nombre1 || ' ' ||nombre2 || ' ' ||apellido1 || ' '||apellido2)  
								ilike '%$campo%' 
								OR
								CONCAT(cast(p.cedula as varchar),nombre1 || ' ' ||apellido1)  
								ilike '%$campo%' 
								OR
								CONCAT(cast(p.cedula as varchar),nombre1  || ' ' || nombre2 ||' ' ||apellido1)  
								ilike '%$campo%' 
								OR
								CONCAT(cast(p.cedula as varchar),nombre1  || ' ' || apellido1 ||' ' ||apellido2)  
								ilike '%$campo%') ";
			}
							
			if($cod_estado)
				$consulta.= " and em.cod_estado = '$cod_estado'";

			$consulta.=" group by p.codigo order by p.codigo ";


			$ejecutar=$conexion->prepare($consulta);
		//	echo $consulta;
			$ejecutar-> execute(array());

			if($ejecutar->rowCount() != 0)
				return $ejecutar->fetchAll();
			else
				return null;


		}
		catch(Exception $e){
			throw $e;
		}
	}

	public static function listarTodo ()
	{
		try
		{
			$conexion = Conexion::conectar();
			$consulta= "select sis.f_empleado_sel(:cursor)";

			$ejecutar= $conexion->prepare($consulta);
			$cursor='fcursorinst';
			$ejecutar->bindParam(':cursor',$cursor, PDO::PARAM_INT);
			// inicia transaccion
			$conexion->beginTransaction();
			$ejecutar->execute();
			$cursors = $ejecutar->fetchAll();
			// cierra cursor
			$ejecutar->closeCursor();
			// array para almacenar resultado del cursor
			$results = array();
			// sirver para leer multiples cursores si es necesario
			foreach($cursors as $k=>$v){
				// ejecutar otro query para leer el cursor
				$ejecutar = $conexion->query('FETCH ALL IN "'. $v[0] .'";');
				$results[$k] = $ejecutar->fetchAll();
				$ejecutar->closeCursor();
				// cierra cursor
			}
			$conexion->commit();
			if(count($results) > 0)
				return $results;
			else
				return null;

		}
		catch(Exception $e){
			throw $e;
		}
	}

	/**
	 * Función pública y estática que permite eliminar a un empleado.
	 *
	 * Recibe como parámetro el código del empleado que se va a eliminar, de encontrarse a ese empleado
	 * en la base de datos se va a eliminar.
	 *
	 * @param int $codigo 				Código del empleado que va a ser eliminado de la base de datos.
	 *
	 * @return int 						Si la eliminacion fue exitoza la funcion devolvera 1 de lo contrario devolvera 0.
	 * @throws Exception 				Con el mensaje "No se pudo eliminar el empleado."
	 * si no se puede llevar a cabo la eliminación.
	 */
	public static function eliminar($codigo=null){
		try{
			$conexion=Conexion::conectar();
			$consulta="select sis.f_empleado_eli(:codigo)";
			$ejecutar=$conexion->prepare($consulta);
			// indica
			// como se indica en parametro y el tipo de parametro que se envia
			$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);
			$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
			//ejecuta
			$login=Vista::obtenerDato('login');
			if($login->obtenerPermiso('EmpleadoEliminar')){
				$ejecutar->execute();
				//primera columana codigo
				$row = $ejecutar->fetchColumn(0);

				return $row;
			}
			else
				throw new Exception("NO tienes permiso para eliminar un empleado");
				
		}
		catch(Exception $e){
			throw new Exception ("El empleado NO pudo ser eliminado, es posible que tenga registro en otro lugar");

			
		}
	}

	public static function buscarDocentes($patron,$pensum,$instituto){
		try{
			$conexion=Conexion::conectar();
			$consulta = "select per.codigo cod_persona,
								emp.codigo,
								per.nombre1,
								per.apellido1,
								per.nombre2,
								per.apellido2,
								per.cedula
								from sis.t_empleado emp
								inner join sis.t_persona per
									on per.codigo = emp.cod_persona
								where es_docente = true
								and emp.cod_pensum = :pensum
								and emp.cod_instituto = :instituto
								and emp.cod_estado = 'A'
								and CONCAT (cast(per.cedula as varchar),
										upper(per.nombre1),
										upper(per.nombre2),
										upper(per.apellido1),
										upper(per.apellido2))
								like upper('%$patron%')
								order by apellido1;";

			$ejecutar=$conexion->prepare($consulta);

			$ejecutar->bindParam(':pensum',$pensum, PDO::PARAM_INT);
			$ejecutar->bindParam(':instituto',$instituto, PDO::PARAM_INT);

			$ejecutar->execute();


			if($ejecutar->rowCount() != 0){
				return $ejecutar->fetchAll();
			}
			else
				return null;
		}
		catch(Exception $e){
			throw $e;
		}
	}

	public static function listarEstado()
	{
		try
		{
			$conexion = Conexion::conectar();

			$ejecutar = $conexion->prepare("SELECT * FROM sis.t_est_empleado;");
			$ejecutar->execute(array());
			
			if($ejecutar->rowCount()!= 0)
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
