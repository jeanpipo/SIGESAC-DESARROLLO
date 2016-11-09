<?php


/**
 * @copyright 2015 - Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio
 * @license GPLv3
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 *
 * EstudianteServicio.php - Servicio del módulo Estudiante.
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
 * @package Servicios
 */
class EstudianteServicio
{

	/**
	 * Función pública y estática que permite agregar a un estudiante a la base de datos.
	 *
	 * Esta funcion es la encargada de agregar un nuevo estudiante a la base de datos,
	 * donde recibe cierta cantidad parametros para ser almacenados en la tabla sis.t_estudiante.
	 *
	 *
	 * @param int $cod_persona 					Codigo de la persona este es el codigo que relaciona la tabla persona con la tabla estudiante.
	 * @param int $cod_instituto				Codigo de la institucion donde estudia el estudiante.
	 * @param int $cod_pensum 					Codigo de pensum en donde esta inscrito el estudiante.
	 * @param String $num_carnet				Indica el numero de carnet que posee el estudiante.
	 * @param String $num_expediiente			Indica el numero de expediente que posee el estudiante.
	 * @param String $cod_rusnies 				Indica el numero rusnies que tiene el estudiante.
	 * @param chart $cod_estado 				Codigo de estado que posee el estudiante.
	 * @param String $fec_inicio				Fecha en la que empezo a estudiar el estudiante.
	 * @param String $fec_fin					Fecha en la que termino a estudiar el estudiante.
	 * @param String $condicion					Indica la condicion que tiene el estudiante.
	 * @param String $observaciones			Observaciones que se tengan respecto al estudiante
	 *
	 * @return int 								Retorna el codigo que posee el estudiante en la base de datos.
	 * @throws Exception 					Con el mensaje "No se pudo inscribir al estudiante."
	 * si no se pudo llevar a cabo la operación.
	 */
	public static function agregar(	$cod_persona=null, 	$cod_instituto=null, 	$cod_pensum=null,
									$num_carnet=null, 	$num_expediente=null,	$cod_rusnies=null,
									$cod_estado=null,	$fec_inicio=null, 		$fec_fin=null,
									$condicion=null, 	$observaciones=null
								)
	{
		try
		{
			$conexion = Conexion::conectar();

			$consulta="select sis.f_estudiante_ins(	:cod_persona, 	:cod_instituto, 	:cod_pensum,
												   	:num_carnet,	:num_expediente, 	:cod_rusnies,
												   	:cod_estado, 	:fec_inicio,		:fec_fin,
												   	:condicion, 	:observaciones
												)";

			$ejecutar=$conexion->prepare($consulta);
			$ejecutar->bindParam(':cod_persona',$cod_persona, PDO::PARAM_STR);
			$ejecutar->bindParam(':cod_instituto',$cod_instituto, PDO::PARAM_STR);
			$ejecutar->bindParam(':cod_pensum',$cod_pensum, PDO::PARAM_STR);
			$ejecutar->bindParam(':num_carnet',$num_carnet, PDO::PARAM_STR);
			$ejecutar->bindParam(':num_expediente',$num_expediente, PDO::PARAM_STR);
			$ejecutar->bindParam(':cod_rusnies',$cod_rusnies, PDO::PARAM_STR);
			$ejecutar->bindParam(':cod_estado',$cod_estado, PDO::PARAM_STR);
			$ejecutar->bindParam(':fec_inicio',$fec_inicio, PDO::PARAM_STR);
			$ejecutar->bindParam(':fec_fin',$fec_fin, PDO::PARAM_STR);
			$ejecutar->bindParam(':condicion',$condicion, PDO::PARAM_STR);
			$ejecutar->bindParam(':observaciones',$observaciones, PDO::PARAM_STR);
			$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
			$login=Vista::obtenerDato('login');
			if($login->obtenerPermiso('EstudianteAgregar')){
				$ejecutar->execute();
				
				$codigo = $ejecutar->fetchColumn(0);


				if($ejecutar->rowCount() == 0)
					throw new Exception("No se pudo inscribir al estudiante.");

				return $codigo;
			}
			else
				throw new Exception("NO tienes permiso para agregar a un estudiant");
				
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

			$ejecutar = $conexion->prepare("SELECT * FROM sis.t_est_estudiante;");
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
	 * @param String $num_carnet				Indica el numero de carnet que posee el estudiante.
	 * @param String $num_expediente			Indica el numero de expediente que posee el estudiante.
	 * @param String $cod_rusnies 				Indica el numero rusnies que tiene el estudiante.
	 * @param chart $cod_estado 				Codigo de estado que posee el estudiante.
	 * @param String $fec_inicio				Fecha en la que empezo a estudiar el estudiante.
	 * @param String $fec_fin					Fecha en la que termino a estudiar el estudiante.
	 *
	 * @return array|null						Retorna un arreglo de arreglos asociativos o null de no encontrarse coincidencias.
	 *
	 * @throws Exception 					Si se producen errores en operaciones con la base de datos.
	 */
	public static function listar (	$pnf=null, 			$estado=null,		$instituto=null,
									$codigo=null, 		$cod_persona=null, 	$num_carnet=null,
									$num_expediente=null,$cod_rusnies=null,	$fec_inicio=null,
									$fec_fin=null
									)
	{

		try
		{
			$conexion = Conexion::conectar();

			/* listar a todos los estudiante en general*/
			$consulta= "select es.*, p.nom_corto as nom_pensum, i.nom_corto as nom_instituto, e.nombre,
							p.nombre as nom_pen_largo, i.nombre as nom_ins_largo,
							(select to_char(es.fec_inicio,'DD/MM/YYYY')) as fec_inicios,
							(select to_char(es.fec_fin,'DD/MM/YYYY')) as fec_final,
							count(*) as total_filas
						from sis.t_estudiante es,  sis.t_instituto i,
							sis.t_est_estudiante e, sis.t_pensum p where true ";

			if($codigo)
				$consulta.= "and es.codigo =$codigo";

			if($cod_persona)
				$consulta.= " and es.cod_persona =$cod_persona ";

			if($instituto)
				$consulta.= " and es.cod_instituto =$instituto ";

			if($pnf)
				$consulta.= " and es.cod_pensum = $pnf ";

			if($num_carnet)
				$consulta.= " and es.num_carnet ='$num_carnet' ";

			if($num_expediente)
				$consulta.= " and es.num_expediente ='$num_expediente' ";

			if($cod_rusnies)
				$consulta.= " and es.cod_rusnies ='$cod_rusnies' ";

			if($estado)
				$consulta.= " and es.cod_estado = '$estado' ";

			if($fec_inicio)
				$consulta.= " and es.fec_inicio='$fec_inicio' ";

			if($fec_fin)
				$consulta.= " and es.fec_fin='$fec_fin' ";

			$consulta.=" and i.codigo=es.cod_instituto and e.codigo=es.cod_estado
						 and p.codigo=es.cod_pensum 
						 group by es.codigo, p.codigo, i.codigo,e.codigo";


			$login=Vista::obtenerDato('login');
			if($login->obtenerPermiso('EstudianteListar')){
				$ejecutar= $conexion->prepare($consulta);

				$ejecutar-> execute(array());

				if($ejecutar->rowCount() != 0)
					return $ejecutar->fetchAll();
				else
					return null;
			}
			else
				throw new Exception("NO tienes permiso para listar estudiantes");
				


		}
		catch(Exception $e){
			throw $e;
		}
	}

	/**
	 * Función que permite listar todos los estudiantes almacenados con informacion de la tabla sis.t_persona
	 * en la base de datos.
	 *
	 * Puede recibir ciertas cantidades de parametro y dependiendo de los parametros ingresados se va a proceder a listar
	 * ciertos estudiantes, un solo estudiante o todos los estudiantes registrados,
	 * luego va realizar la consulta a la base de datos y retorna un arreglo asociativo con los estudiantes obtenidos o
	 * null si no se encontró coincidencia.
	 *
	 * @param int $codigo 						Codigo del empleado este es el codigo que posee el estudiante.
	 * @param int $cedula						Es el numero de cedula del estudiante.
	 * @param String $correo 					Es el correo electronico del estudiante.
	 * @param String $nombre1 					Es el primer nombre del estudiante.
	 * @param String $nombre2					Es el segundo nombre del estudiante.
	 * @param String $apellido1					Es el primer apellido del estudiante.
	 * @param String $apellido2					Es el segundo apellido del estudiante.
	 * @param chart $sexo						Indica el sexo del estudiante.
	 * @param int $cod_instituto				Indica el instituto donde el estudiante esta estudiando.
	 * @param int $cod_pensum 					Codigo de pensum donde el estudiante esta inscrito.
	 * @param chart $cod_estado 				Codigo de estado que posee el estudiante.
	 * @return array|null						Retorna un arreglo de arreglos asociativos o null de no encontrarse coincidencias.
	 *
	 * @throws Exception 					Si se producen errores en operaciones con la base de datos.
	 */
	 
	 
	public static function listarPersonaEstudiante(	$cod_pensum=null,			$cod_estado=null,	$cod_instituto=null,
													$campo=null,				$codigo=null,		$cod_esudiante=null,													$cod_curso=null,			$cedula=null,
													$correo=null,				$nombre1=null,		$nombre2=null,
													$apellido1=null,			$apellido2=null,	$sexo=null

												  )
	{
		try
		{

			$conexion = Conexion::conectar();
			if($cod_curso)
				$consulta = "select p.*,  p.codigo as cod_persona , c.codigo as cod_curso ,
							ce.codigo as cod_cur_estudiate, ce.cod_estado as cur_est_codigo , es.*,
							es.codigo as cod_estudiante, (select to_char(es.fec_inicio,'DD/MM/YYYY')) as fec_inicios,
							(select to_char(es.fec_fin,'DD/MM/YYYY')) as fec_final
							from sis.t_persona p, sis.t_estudiante es , sis.t_cur_estudiante ce,
								sis.t_curso c
						 	where true and p.codigo=es.cod_persona ";

			if(!$cod_curso)
				$consulta = "select p.*,  p.codigo as cod_persona 
							from sis.t_persona p, sis.t_estudiante es
						 	where true and p.codigo=es.cod_persona ";

			if($codigo)
				$consulta.= " and p.codigo =$codigo ";

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

			if($cedula)
				$consulta.= " and p.cedula = $cedula ";

			if($correo)
				$consulta.= " and p.cor_personal like '%$correo%' ";

			if($nombre1)
				$consulta.= " and p.nombre1 like '%$nombre1%' ";

			if($nombre2)
				$consulta.= " and p.nombre2 like '%$nombre2%' ";

			if($apellido1)
				$consulta.= " and p.apellido1 like '%$apellido1%' ";

			if($apellido2)
				$consulta.= " and p.apellido2 like '%$apellido2%' ";

			if($sexo)
				$consulta.= " and p.sexo like '%$sexo%' ";

			if($cod_instituto)
				$consulta.= " and es.cod_instituto=$cod_instituto ";

			if($cod_pensum)
				$consulta.= " and es.cod_pensum=$cod_pensum ";

			if($cod_estado)
				$consulta.= " and es.cod_estado ='$cod_estado' ";

			if($cod_curso){

				if($cod_curso && $cod_estudiante )
					$consulta.=" and ce.cod_estudiante=es.codigo and c.codigo=$cod_curso and es.codigo=$cod_estudiante and ce.cod_curso=c.codigo  ";

				elseif($cod_curso)
					$consulta.=" and ce.cod_estudiante=es.codigo and c.codigo=$cod_curso  and ce.cod_curso=c.codigo ";
			}

			if(!$cod_curso)
				$consulta.=" group by p.codigo order by p.codigo ";



			$ejecutar=$conexion->prepare($consulta);

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

	public static function listarEstudiantePeriodo($cod_instituto=null,$cod_pensum=null,$cod_periodo=null,
													$cod_estado=null)
	{

		try{
			$conexion = Conexion::conectar();

			$consulta="select 	per.codigo,
								per.cedula ,
								coalesce(per.apellido1,'') || ' ' || coalesce(per.apellido2,'') || ', ' || coalesce(per.nombre1,'') || ' ' || coalesce(per.nombre2,'') as nombrecompleto,
								per.nacionalidad
								from sis.t_estudiante as est
								inner join sis.t_persona as per
									on per.codigo = est.cod_persona
								inner join sis.t_periodo as pdo
									on pdo.cod_pensum = est.cod_pensum
								where est.cod_instituto = $cod_instituto
								and est.cod_pensum = $cod_pensum
								and pdo.codigo = $cod_periodo
								and est.cod_estado = '$cod_estado'
								order by
									per.apellido1,
									per.nombre1;";

			$ejecutar=$conexion->prepare($consulta);

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


	/**
	 * Función pública y estática que permite modificar a un empleado.
	 *
	 * Esta funcion es la encargada de modificar un a un empleado, se pasan cierta cantidad de parámetros
	 * para ser modificados en la base de datos.
	 *
	 *
	 * @param int $codigo 						Codigo del estudiate este es el codigo que posee el estudiante en la base de datos.
	 * @param int $cod_persona 					Codigo de la persona este es el codigo que relaciona la tabla persona con la tabla estudiante.
	 * @param int $cod_instituto				Codigo de la institucion donde estudia el estudiante.
	 * @param int $cod_pensum 					Codigo de pensum en donde esta inscrito el estudiante.
	 * @param String $num_carnet				Indica el numero de carnet que posee el estudiante.
	 * @param String $num_expediiente			Indica el numero de expediente que posee el estudiante.
	 * @param String $cod_rusnies 				Indica el numero rusnies que tiene el estudiante.
	 * @param chart $cod_estado 				Codigo de estado que posee el estudiante.
	 * @param String $fec_inicio				Fecha en la que empezo a estudiar el estudiante.
	 * @param String $fec_fin					Fecha en la que termino a estudiar el estudiante.
	 * @param String $condicion					Indica la condicion que tiene el estudiante.
	 * @param String $observaciones				Observaciones que se tengan respecto al estudiante
	 *
	 * @return int 								si se realizo la modificacion con exito devolvera 1 de lo contrario devolvera 0.
	 * @throws Exception 							Con el mensaje "No se logro modificar la informacion del estudiante." cuando
	 * no se puede llevar a cabo la operación.
	 */
	public static function modificar (	$codigo,		$cod_persona, 	$cod_instituto,
										$cod_pensum,	$num_carnet, 	$num_expediente,
										$cod_rusnies, 	$cod_estado,    $fec_inicio,
										$fec_fin, 		$condicion,		$observaciones
									)
	{
		try
		{
			$conexion = Conexion::conectar();
			$ejecutar = $conexion->prepare("
						select sis.f_estudiante_act(
													:codigo,		:cod_persona, 	:cod_instituto,
													:cod_pensum,	:num_carnet, 	:num_expediente,
													:cod_rusnies, 	:cod_estado,	:fec_inicio,
													:fec_fin, 		:condicion, 	:observaciones
												);"
										  );
			$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_STR);
			$ejecutar->bindParam(':cod_persona',$cod_persona, PDO::PARAM_STR);
			$ejecutar->bindParam(':cod_instituto',$cod_instituto, PDO::PARAM_STR);
			$ejecutar->bindParam(':cod_pensum',$cod_pensum, PDO::PARAM_STR);
			$ejecutar->bindParam(':num_carnet',$num_carnet, PDO::PARAM_STR);
			$ejecutar->bindParam(':num_expediente',$num_expediente, PDO::PARAM_STR);
			$ejecutar->bindParam(':cod_rusnies',$cod_rusnies, PDO::PARAM_STR);
			$ejecutar->bindParam(':cod_estado',$cod_estado, PDO::PARAM_STR);
			$ejecutar->bindParam(':fec_inicio',$fec_inicio, PDO::PARAM_STR);
			$ejecutar->bindParam(':fec_fin',$fec_fin, PDO::PARAM_STR);
			$ejecutar->bindParam(':condicion',$condicion, PDO::PARAM_STR);
			$ejecutar->bindParam(':observaciones',$observaciones, PDO::PARAM_STR);

			$login=Vista::obtenerDato('login');
			if($login->obtenerPermiso('EstudianteModificar')){
				$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
				//ejecuta
				$ejecutar->execute();
				//primera columana codigo
				$row = $ejecutar->fetchColumn(0);

				return $row;
			}
			else
				throw new Exception("NO tienes permiso para modificar a un estudiante");
				
		}
		catch(Exception $e){
			throw $e;
		}
	}

	/**
	 * Función pública y estática que permite eliminar a un estudiante.
	 *
	 * Recibe como parámetro el código del estudiante que se va a eliminar, de encontrarse a ese estudiante
	 * en la base de datos se va a eliminar.
	 *
	 * @param int $codigo 				Código del estudiante que va a ser eliminado de la base de datos.
	 *
	 * @return int 						Si la eliminacion fue exitoza la funcion devolvera 1 de lo contrario devolvera 0.
	 * @throws Exception 				Con el mensaje "No se pudo eliminar el empleado."
	 * si no se puede llevar a cabo la eliminación.
	 */
	public static function eliminar($codigo=null){
		try{
			$conexion=Conexion::conectar();
			$consulta="select sis.f_estudiante_eli(:codigo)";
			$ejecutar=$conexion->prepare($consulta);
			// indica
			// como se indica en parametro y el tipo de parametro que se envia
			$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);
			$login=Vista::obtenerDato('login');
			if($login->obtenerPermiso('EstudianteEliminar')){
				$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
				//ejecuta
				$ejecutar->execute();
				//primera columana codigo
				$row = $ejecutar->fetchColumn(0);

				return $row;
			}
			else
				throw new Exception ("NO tienes permiso para eliminar a un estudiante");
		}
		catch(Exception $e){
			throw new Exception ("El estudiante NO pudo ser eliminado, es posible que ya este registrado en un curso");
		}
	}

	/** Función que obtiene la lista de estudiantes de un curso específico,
	 * Parámetros de entrada:
	 *   $codigo: código del curso a consultar
	 *   $estados: cadena que contiene los estudiantes a consultar, es decir,
	 *			la consulta traerá aquellos estudiantes que cuyo código de estado
	 * 			esté contenido dentro de la cadena. El valor por defecto de 
	 * 			este parámetro es 'XARIC' para que los obtenga a todos
	 * Valor de retorno
	 *  la lista de estudiantes ordenada por apellido, coloca de último los
	 * 	retirados
	 * Ejemplo:
	 * 
	 * EstudianteServicio::listarEstudiantesDeCurso(207): trae todos los estudiantes
	 * 			
	 * EstudianteServicio::listarEstudiantesDeCurso(207,'ARIC'): trae todos los
	 * 			estudiantes menos los retirados.
	 */

	public static function listarEstudiantesDeCurso($codigo, $est_estudiante='XARIC'){
		try{
			$conexion = Conexion::conectar();

			$consulta = "select 	ce.codigo cod_curest,
									ce.cod_curso,
									per.codigo,
									per.cedula,
									per.apellido1,
									per.nombre1,
									per.cor_personal,
									ce.por_asistencia,
									ce.nota,
									ce.cod_estado,
									ece.nombre,
									per.nacionalidad
						from sis.t_cur_estudiante ce
							left join sis.t_persona per
									on per.codigo = ce.cod_estudiante
							inner join sis.t_est_cur_estudiante ece
									on ce.cod_estado = ece.codigo
						where ce.cod_curso = :codigo
							and position(ce.cod_estado in '$est_estudiante') > 0 -- para obtener los que tienen el estado indicado dentro de la cadena est_estudiante					
						order by
									case when ce.cod_estado = 'X' then 'Z' --para colocar los retirados de ultimo
											else 'A' end,                  -- y los demás de primero
									per.apellido1
									;";

			$ejecutar=$conexion->prepare($consulta);
			$ejecutar->bindParam(":codigo", $codigo, PDO::PARAM_INT);
			$ejecutar->execute();

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
