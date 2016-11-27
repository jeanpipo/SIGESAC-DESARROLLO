<?php
/**
 * * * * * * * * * * LICENCIA * * * * * * * * * * * * * * * * * * * * *

Copyright(C) 2015
Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio

Este programa es Software Libre y usted puede redistribuirlo y/o modificarlo
bajo los términos de la versión 3.0 de la Licencia Pública General (GPLv3)
publicada por la Free Software Foundation (FSF), es distribuido sin ninguna
garantía. Usted debe haber recibido una copia de la GPLv3 junto con este
programa, sino, puede encontrarlo en la página web de la FSF,
específicamente en la dirección http://www.gnu.org/licenses/gpl-3.0.html

 * * * * * * * * * * ARCHIVO * * * * * * * * * * * * * * * * * * * * *

Nombre: CursoServicio.php
Diseñador: Juan De Sousa (juanmdsousa@gmail.com)
Programador: Juan De Sousa
Lider de proyecto: Johan Alamo (johan.alamo@gmail.com)
Fecha: Diciembre de 2015
Descripción:
	Este es el servicio del módulo Curso. Encargado de todas las operaciones que involucren la base de datos.

 * * * * * * * * Cambios/Mejoras/Correcciones/Revisiones * * * * * * * *
---                         ----      ---------

 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
*/

	class CursoServicio{

		/*
		 * Método obtenerCursos de CursoServicio.
		 *
		 * Devuelve una lista con todos los cursos de la base de datos.
		 * Si no hay cursos en la base de datos, retorna null.
		 *
		 * Valores de retorno:
		 * 		Arreglo con información de cursos.
		 * 		Null
		 */

		public static function obtenerCursos(){
			try{
				$conexion = Conexion::conectar();
				$consulta = "select sis.f_curso_sel('cursos')";
				$ejecutar = $conexion->prepare($consulta);
				$conexion->beginTransaction();
				$ejecutar->execute();

				$cursors = $ejecutar->fetchAll();
				$ejecutar->closeCursor();

				$results = array();
				$ejecutar = $conexion->query('FETCH ALL IN cursos;');
				$results = $ejecutar->fetchAll();
				$ejecutar->closeCursor();
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

		/*
		 * Método obtenerCursoPorCodigo de CursoServicio.
		 *
		 * Recibe un código de curso y retorna la información del mismo.
		 * Si no encuentra información, retorna null.
		 *
		 * Valores de entrada:
		 * 		$codigo					Código de curso a consultar.
		 *
		 * Valores de retorno:
		 * 		Arreglo con información de curso.
		 * 		Null
		 *
		 */

		public static function obtenerCursoPorCodigo($codigo){
			try{
				$conexion = Conexion::conectar();
				$consulta = "select sis.f_curso_sel('cursos',:codigo)";
				$ejecutar = $conexion->prepare($consulta);

				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);
				$conexion->beginTransaction();
				$ejecutar->execute();
				$cursors = $ejecutar->fetchAll();
				$ejecutar->closeCursor();

				$results = array();
				$ejecutar = $conexion->query('FETCH ALL IN cursos;');
				$results = $ejecutar->fetchAll();
				$ejecutar->closeCursor();
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

		/*
		 * Método insertarCurso de CursoServicio
		 *
		 * Recibe la información de un curso a ser insertado.
		 * Si se realiza la inserción, devuelve el código del curso que generó.
		 * De no ser así, devuelve cero (y lanza una excepción en la base de datos)
		 *
		 * Valores de entrada:
		 * 		$codPeriodo					Código del periodo del curso a ser agregado.
		 * 		$codUniCurricular			Código de unidad curricular del curso a ser agregado.
		 * 		$codDocente					Código del docente que dictará el curso.
		 * 		$seccion					Sección a la que pertenece el curso.
		 * 		$fecInicio					Fecha de inicio del curso.
		 * 		$fecFinal					Fecha del final del curso.
		 * 		$capacidad					Capacidad del curso.
		 * 		$observaciones				Observaciones del curso.
		 *
		 * Valores de retorno
		 * 		Código que se generó para el curso.
		 */

		public static function insertarCurso($codPeriodo, $codUniCurricular, $codDocente, $seccion, $fecInicio, $fecFinal, $capacidad=NULL, $observaciones){
			try{
				$conexion=Conexion::conectar();
				$consulta="select sis.f_curso_ins(:p_cod_periodo, :p_cod_uni_curricular, :p_cod_docente, upper(:p_seccion), :p_fec_inicio, :p_fec_final, :p_capacidad, :p_observaciones)";
				$ejecutar=$conexion->prepare($consulta);

				$ejecutar->bindParam(':p_cod_periodo',$codPeriodo, PDO::PARAM_INT);
				$ejecutar->bindParam(':p_cod_uni_curricular',$codUniCurricular, PDO::PARAM_INT);
				$ejecutar->bindParam(':p_cod_docente',$codDocente, PDO::PARAM_INT);
				$ejecutar->bindParam(':p_seccion',$seccion, PDO::PARAM_STR);
				$ejecutar->bindParam(':p_fec_inicio',$fecInicio, PDO::PARAM_STR);
				$ejecutar->bindParam(':p_fec_final',$fecFinal, PDO::PARAM_STR);
				$ejecutar->bindParam(':p_capacidad',$capacidad, PDO::PARAM_INT);
				$ejecutar->bindParam(':p_observaciones',$observaciones, PDO::PARAM_STR);

				$login=Vista::obtenerDato('login');
				if($login->obtenerPermiso('CursoAgregar'))
					$ejecutar->execute();
				else
					throw new Exception("No posees permisos para agregar un curso");


				$row = $ejecutar->fetchColumn(0);

				return $row;
			}
			catch(Exception $e){
				throw $e;
			}
		}

		/*
		 * Método modificarCurso de CursoServicio
		 *
		 * Recibe la información de un curso a ser modificado.
		 * Si no se pudo modificar, arroja una excepción.
		 *
		 * Valores de entrada:
		 * 		$codigo						Código del curso a ser modificado.
		 * 		$codPeriodo					Código del periodo del curso a ser modificado.
		 * 		$codUniCurricular			Código de unidad curricular del curso a ser modificado.
		 * 		$codDocente					Código del docente que dictará el curso.
		 * 		$seccion					Sección a la que pertenece el curso.
		 * 		$fecInicio					Fecha de inicio del curso.
		 * 		$fecFinal					Fecha del final del curso.
		 * 		$capacidad					Capacidad del curso.
		 * 		$observaciones				Observaciones del curso.
		 *
		 */


		public static function modificarCurso($codigo, $codPeriodo, $codUniCurricular, $codDocente, $seccion, $fecInicio, $fecFinal, $capacidad, $observaciones){
			try{
				$conexion=Conexion::conectar();
				$consulta="select sis.f_curso_mod(:codigo, :p_cod_periodo, :p_cod_uni_curricular, :p_cod_docente, upper(:p_seccion), :p_fec_inicio, :p_fec_final, :p_capacidad, :p_observaciones)";
				$ejecutar=$conexion->prepare($consulta);

				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);
				$ejecutar->bindParam(':p_cod_periodo',$codPeriodo, PDO::PARAM_INT);
				$ejecutar->bindParam(':p_cod_uni_curricular',$codUniCurricular, PDO::PARAM_INT);
				$ejecutar->bindParam(':p_cod_docente',$codDocente, PDO::PARAM_INT);
				$ejecutar->bindParam(':p_seccion',$seccion, PDO::PARAM_STR);
				$ejecutar->bindParam(':p_fec_inicio',$fecInicio, PDO::PARAM_STR);
				$ejecutar->bindParam(':p_fec_final',$fecFinal, PDO::PARAM_STR);
				$ejecutar->bindParam(':p_capacidad',$capacidad, PDO::PARAM_INT);
				$ejecutar->bindParam(':p_observaciones',$observaciones, PDO::PARAM_STR);

				$login=Vista::obtenerDato('login');
				if($login->obtenerPermiso('CursoModificar'))
					$ejecutar->execute();
				else
					throw new Exception("No tienes permiso para modificar un curso");



				$row = $ejecutar->fetchColumn(0);


				return $row;

			}
			catch(Exception $e){
				throw $e;
			}
		}

		/*
		 * Método eliminarCurso de CursoServicio.
		 *
		 * Recibe un código de curso y lo elimina de la base de datos.
		 * Si no se puede eliminar, lanza una excepción.
		 *
		 * Valores de entrada:
		 * 		$codigo					Código del curso a ser eliminado.
		 */

		public static function eliminarCurso($codigo){
			try{
				$conexion=Conexion::conectar();
				$consulta="select sis.f_curso_del(:codigo)";
				$ejecutar=$conexion->prepare($consulta);

				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);
				$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
				$login=Vista::obtenerDato('login');
				if($login->obtenerPermiso('CursoEliminar'))
					$ejecutar->execute();
				else
					throw new Exception("No tiene permiso para eliminar un curso");


				$row = $ejecutar->fetchColumn(0);

				if ($row == 0)
					throw new Exception("No se pudo eliminar el curso.");

				return $row;
			}
			catch(Exception $e){
				throw $e;
			}
		}

		/*
		 *  CURSO_ESTUDIANTE
		 */

		 /*
		 * Método obtenerCurEst de CursoServicio.
		 *
		 * Devuelve una lista con todos los registros
		 * de cur-estudiante de la base de datos.
		 * Si no hay, retorna null.
		 *
		 * Valores de retorno:
		 * 		Arreglo con información de curEstudiantes.
		 * 		Null
		 */
		 public static function obtenerCurEst(){
			 try{
				$conexion = Conexion::conectar();
				$consulta = "select sis.f_cur_estudiante_sel('curest')";
				$ejecutar = $conexion->prepare($consulta);
				$conexion->beginTransaction();
				$ejecutar->execute();

				$cursors = $ejecutar->fetchAll();
				$ejecutar->closeCursor();

				$results = array();
				$ejecutar = $conexion->query('FETCH ALL IN curest;');
				$results = $ejecutar->fetchAll();
				$ejecutar->closeCursor();
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

		 /*
		 * Método obtenerCursoPorCodigo de CursoServicio.
		 *
		 * Recibe un código de curso y retorna la información del mismo.
		 * Si no encuentra información, retorna null.
		 *
		 * Valores de entrada:
		 * 		$codigo					Código de curso a consultar.
		 *
		 * Valores de retorno:
		 * 		Arreglo con información de curso.
		 * 		Null
		 *
		 */

		 public static function obtenerCurEstPorCodigo(){
			 try{
				$conexion = Conexion::conectar();
				$consulta = "select sis.f_cur_estudiante_sel_por_codigo('curest',:codigo)";
				$ejecutar = $conexion->prepare($consulta);

				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);
				$conexion->beginTransaction();
				$ejecutar->execute();
				$cursors = $ejecutar->fetchAll();
				$ejecutar->closeCursor();

				$results = array();
				$ejecutar = $conexion->query('FETCH ALL IN curest;');
				$results = $ejecutar->fetchAll();
				$ejecutar->closeCursor();
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

		 /*
		 * Método insertarCurEst de CursoServicio
		 *
		 * Recibe la información de un cur-estudiante a ser insertado.
		 * Si se realiza la inserción, devuelve el código del cur-estudiante que generó.
		 * De no ser así, devuelve cero (y lanza una excepción en la base de datos)
		 *
		 * Valores de entrada:
		 * 		$codEstudiante				Código del estudiante dentro del curso.
		 * 		$codCurso					Código del curso al que pertenece el estudiante.
		 * 		$porAsistencia				Porcentaje de asistencia del estudiante en el curso.
		 * 		$nota						Nota del estudiante en el curso.
		 * 		$codEstado					Código del estado del estudiante dentro del curso.
		 * 		$observaciones				Observaciones del estudiante dentro del curso.
		 *
		 * Valores de retorno
		 * 		Código que se generó para el curEstudiante.
		 */

		 public static function insertarCurEst($codEstudiante, $codCurso, $porAsistencia, $nota, $codEstado, $observaciones){
			 try{
				$conexion=Conexion::conectar();

				if(!self::verificarEst($codEstudiante,$codCurso)){
					$consulta="select sis.f_cur_estudiante_ins(:p_cod_estudiante,:p_cod_curso,:p_por_asistencia,:p_nota,:p_cod_estado,:p_observaciones)";

					$ejecutar=$conexion->prepare($consulta);

					$ejecutar->bindParam(':p_cod_estudiante',$codEstudiante, PDO::PARAM_INT);
					$ejecutar->bindParam(':p_cod_curso',$codCurso, PDO::PARAM_INT);
					$ejecutar->bindParam(':p_por_asistencia',$porAsistencia, PDO::PARAM_INT);
					$ejecutar->bindParam(':p_nota',$nota, PDO::PARAM_STR);
					$ejecutar->bindParam(':p_cod_estado',$codEstado, PDO::PARAM_STR);
					$ejecutar->bindParam(':p_observaciones',$observaciones, PDO::PARAM_STR);
					$ejecutar->setFetchMode(PDO::FETCH_ASSOC);

					$ejecutar->execute();

					$codigo = $ejecutar->fetchColumn(0);
					return $codigo;
				}
				else{
					self::cambiarEstado($codEstudiante,$codCurso,'C');

					return 0;
				}
			}
			catch(Exception $e){
				throw $e;
			}
		 }

		 /*
		 * Método modificarCurEst de CursoServicio
		 *
		 * Recibe la información de un cur-estudiante a ser modificado.
		 * Si no se realiza la modificación, lanza una excepción.
		 *
		 * Valores de entrada:
		 * 		$codigo						Código del curEstudiante a modificarse.
		 * 		$codEstudiante				Código del estudiante dentro del curso.
		 * 		$codCurso					Código del curso al que pertenece el estudiante.
		 * 		$porAsistencia				Porcentaje de asistencia del estudiante en el curso.
		 * 		$nota						Nota del estudiante en el curso.
		 * 		$codEstado					Código del estado del estudiante dentro del curso.
		 * 		$observaciones				Observaciones del estudiante dentro del curso.
		 *
		 */

		 public static function modificarCurEst($codigo, $codEstudiante, $codCurso, $porAsistencia, $nota, $codEstado, $observaciones){
			 try{
				$conexion=Conexion::conectar();
				$consulta="select sis.f_cur_estudiante_mod(:codigo, :p_cod_estudiante,:p_cod_curso,:p_por_asistencia,:p_nota,:p_cod_estado,:p_observaciones)";
				$ejecutar=$conexion->prepare($consulta);

				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);
				$ejecutar->bindParam(':p_cod_estudiante',$codEstudiante, PDO::PARAM_INT);
				$ejecutar->bindParam(':p_cod_curso',$codCurso, PDO::PARAM_INT);
				$ejecutar->bindParam(':p_por_asistencia',$porAsistencia, PDO::PARAM_INT);
				$ejecutar->bindParam(':p_nota',$nota, PDO::PARAM_INT);
				$ejecutar->bindParam(':p_cod_estado',$codEstado, PDO::PARAM_STR);
				$ejecutar->bindParam(':p_observaciones',$observaciones, PDO::PARAM_STR);
				$ejecutar->setFetchMode(PDO::FETCH_ASSOC);

				$ejecutar->execute();

				$row = $ejecutar->fetchColumn(0);

				if ($row == 0)
					throw new Exception("No se puede modificar el estudiante en este curso.");
			}
			catch(Exception $e){
				throw $e;
			}
		 }

		 /*
		  * Método eliminarCurEst de CursoServicio
		  *
		  * Elimina la información de un curEstudiante
		  * dentro de la base de datos. Recibe como parámetro el código
		  * del curEstudiante a eliminar.
		  * Si no se pudo eliminar, lanzar una excepción.
		  *
		  * Valor de entrada:
		  * 		$codigo					Código del curestudiante a ser eliminado.
		  */

		 public static function eliminarCurEst($codigo){
			 try{
				$conexion=Conexion::conectar();
				$consulta="select sis.f_cur_estudiante_del(:codigo)";
				$ejecutar=$conexion->prepare($consulta);

				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);
				$ejecutar->setFetchMode(PDO::FETCH_ASSOC);

				$ejecutar->execute();

				$row = $ejecutar->fetchColumn(0);

				if ($row == 0)
					throw new Exception("No se pudo eliminar el estudiante en este curso.");
			}
			catch(Exception $e){
				throw $e;
			}
		 }

		public static function listarSeccionPorTrayecto($codigo,$periodo){
		 	try{
				$conexion=Conexion::conectar();



				$consulta="select 	distinct(cur.seccion)
									from sis.t_uni_tra_pensum as utp
									inner join sis.t_curso as cur
									on utp.cod_uni_curricular = cur.cod_uni_curricular
									where utp.cod_trayecto = :codigo
									and cur.cod_periodo = :periodo
									order by cur.seccion;";

				$ejecutar=$conexion->prepare($consulta);
				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);
				$ejecutar->bindParam(':periodo',$periodo, PDO::PARAM_INT);
				$conexion->beginTransaction();
				$ejecutar->execute();

				$results = $ejecutar->fetchAll();
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

		public static function listarUniCurricular($seccion, $pensum, $trayecto, $periodo){
		 	try{
				$conexion=Conexion::conectar();

				$consulta=" select 	cur.codigo, uni.nombre
									from sis.t_curso cur
									inner join sis.t_uni_tra_pensum utp
										on cur.cod_uni_curricular = utp.cod_uni_curricular
									inner join sis.t_uni_curricular uni
										on cur.cod_uni_curricular = uni.codigo
									inner join sis.t_periodo per
										on utp.cod_pensum = per.cod_pensum
									where cur.seccion = :seccion and utp.cod_pensum = :pensum
									and utp.cod_trayecto = :trayecto and per.codigo = :periodo
							 			order by uni.nombre;";

				$ejecutar=$conexion->prepare($consulta);

				$ejecutar->bindParam(':seccion',$seccion, PDO::PARAM_STR);
				$ejecutar->bindParam(':pensum',$pensum, PDO::PARAM_INT);
				$ejecutar->bindParam(':trayecto',$trayecto, PDO::PARAM_INT);
				$ejecutar->bindParam(':periodo',$periodo, PDO::PARAM_INT);

				$conexion->beginTransaction();
				$ejecutar->execute();

				$results = $ejecutar->fetchAll();
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

		public static function listarCursos($codIns,$codPen,$codPer,$patron){
			try{
				$conexion=Conexion::conectar();

				$consulta=" select 	cur.codigo,
									tra.num_trayecto,
									cur.seccion,
									uni.nombre,
									pers.nombre1 || ' ' || pers.apellido1 as nombredocente,
									t1.t c,
									cur.capacidad,
									cur.fec_inicio,
									cur.fec_final,
									uni.cod_uni_ministerio
									from sis.t_uni_tra_pensum utp
									inner join sis.t_curso cur
										on cur.cod_uni_curricular = utp.cod_uni_curricular
									inner join sis.t_periodo per
										on per.codigo = cur.cod_periodo
									left join sis.t_trayecto tra
										on tra.codigo = utp.cod_trayecto
									inner join sis.t_uni_curricular as uni
										on uni.codigo = utp.cod_uni_curricular
									left join sis.t_persona pers
										on pers.codigo = cur.cod_docente
									left join (SELECT ce.cod_curso, COUNT(*) t FROM sis.t_cur_estudiante ce where ce.cod_estado <> 'X' group by ce.cod_curso) t1
										on t1.cod_curso = cur.codigo
									where (per.cod_instituto = ?)
									and (per.cod_pensum = ?)
									and (per.codigo = ?)
									and (sis.utf(uni.nombre) ilike sis.utf(?)
									or sis.utf(pers.nombre1) ilike sis.utf(?)
									or sis.utf(pers.nombre2) ilike sis.utf(?)
									or sis.utf(pers.apellido1) ilike sis.utf(?)
									or sis.utf(pers.apellido2) ilike sis.utf(?))
									group by
										t1.t,
										cur.codigo,
										tra.num_trayecto,
										cur.seccion,
										uni.nombre,
										pers.nombre1 || ' ' || pers.apellido1,
										cur.capacidad,
										cur.fec_inicio,
										cur.fec_final,
										uni.cod_uni_ministerio
									order by
										tra.num_trayecto,
										cur.seccion,
										uni.nombre;
									";


				$ejecutar=$conexion->prepare($consulta);
				$conexion->beginTransaction();
				$patron = "%".$patron."%";

				$r = Array($codIns,$codPen,$codPer,$patron,$patron,$patron,$patron,$patron);
				$login=Vista::obtenerDato('login');
				if($login->obtenerPermiso('CursoListar')){
					$ejecutar->execute($r);
					$results = $ejecutar->fetchAll();
					$conexion->commit();

					if(count($results) > 0)
						return $results;
					else
						return null;
				}
				else
					throw new Exception("No tienes permiso para listar cursos");

			}
			catch(Exception $e){
				throw $e;
			}
		}


		public static function obtenerDatosDeCurso($codigo){
			try{
				$conexion=Conexion::conectar();

				$consulta="select 	per.cod_instituto,
									per.cod_pensum,
									per.codigo,
									utp.cod_trayecto,
									cur.seccion,
									cur.codigo as codigocurso,
									cur.cod_uni_curricular,
									cur.cod_docente,
									ins.nombre nombreins,
									ins.nom_corto nom_cor_instituto,
									pen.nombre nombrepen,
									pen.nom_corto nom_cor_pensum,
									tra.num_trayecto numtrayecto,
									uni.nombre nombreuni,
									per.nombre nombreperiodo,
									pers.nombre1 || ' ' || pers.apellido1 as nombredocente
									from sis.t_curso cur
									inner join sis.t_periodo per
										on per.codigo = cur.cod_periodo
									inner join sis.t_uni_tra_pensum utp
										on utp.cod_pensum = per.cod_pensum
									       and utp.cod_uni_curricular = cur.cod_uni_curricular
									inner join sis.t_instituto ins
										on ins.codigo = per.cod_instituto
									inner join sis.t_pensum pen
										on pen.codigo = per.cod_pensum
									inner join sis.t_trayecto tra
										on tra.codigo = utp.cod_trayecto
									inner join sis.t_uni_curricular uni
										on uni.codigo = cur.cod_uni_curricular
									left join sis.t_persona pers
										on pers.codigo = cur.cod_docente
									where cur.codigo = :codigo;";

				$ejecutar=$conexion->prepare($consulta);
				$conexion->beginTransaction();
				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);
				$ejecutar->execute();
				$results = $ejecutar->fetchAll();
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

		public static function obtenerCursosPensum($seccion, $trayecto, $periodo){
			try{
				$conexion=Conexion::conectar();

				$consulta="select 	cur.codigo codCurso,
									uni.nombre,
									cur.capacidad,
									uni.codigo coduni,
									pers.codigo,
									pers.nombre1 || ' ' || pers.apellido1 nombredocente,
									cur.fec_inicio,
									cur.fec_final,
									cur.cod_docente codDocente,
									cur.observaciones
									from sis.t_periodo per
									inner join sis.t_uni_tra_pensum utp
										on utp.cod_pensum = per.cod_pensum
									left join (select 	cu.*
												from sis.t_curso as cu
												where cu.seccion= :seccion
												and cu.cod_periodo= :periodo) as cur
										on utp.cod_uni_curricular = cur.cod_uni_curricular
									left join sis.t_persona as pers
										on pers.codigo = cur.cod_docente
									inner join sis.t_uni_curricular as uni
										on uni.codigo = utp.cod_uni_curricular
									where (utp.cod_trayecto = :trayecto and per.codigo = :periodo2)
									order by
										cur.codigo";

				$ejecutar=$conexion->prepare($consulta);
				$conexion->beginTransaction();
				$ejecutar->bindParam(':seccion',$seccion, PDO::PARAM_STR);
				$ejecutar->bindParam(':trayecto',$trayecto, PDO::PARAM_INT);
				$ejecutar->bindParam(':periodo',$periodo, PDO::PARAM_INT);
				$ejecutar->bindParam(':periodo2',$periodo, PDO::PARAM_INT);
				$ejecutar->execute();
				$results = $ejecutar->fetchAll();
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

		public static function obtenerEstusEstudiante(){
			try{
				$conexion = Conexion::conectar();

				$consulta = "select 	codigo,
										nombre
										from sis.t_est_cur_estudiante
										where nombre <> 'Retirado'
										order by nombre;";

				$ejecutar=$conexion->prepare($consulta);

				$conexion->beginTransaction();
				$ejecutar->execute();
				$results = $ejecutar->fetchAll();
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

		public static function retirarEstudiante($est, $curso){
			try{
				$conexion = Conexion::conectar();

				$consulta = "update sis.t_cur_estudiante set cod_estado = 'X' where cod_estudiante = :est and cod_curso = :curso;";

				$ejecutar=$conexion->prepare($consulta);
				$conexion->beginTransaction();
				$ejecutar->bindParam(':est',$est, PDO::PARAM_INT);
				$ejecutar->bindParam(':curso',$curso, PDO::PARAM_INT);
				$ejecutar->execute();
				$conexion->commit();
			}
			catch(Exception $e){
				throw $e;
			}
		}

		public static function obtenerCursosPorEstudiante($codigo){
			try{
				$conexion = Conexion::conectar();

				$consulta = "select 	curest.codigo cod_ce,
										cur.codigo cod_cur,
										uni.nombre,
										per.apellido1 || ' ' || per.nombre1 as nombredoc,
										cur.seccion,
										edo.nombre edonom,
										tra.num_trayecto,
										uni.cod_uni_ministerio
										from sis.t_cur_estudiante as curest
										inner join sis.t_curso as cur
											on cur.codigo = curest.cod_curso
										inner join sis.t_uni_curricular as uni
											on uni.codigo = cur.cod_uni_curricular
										left join sis.t_persona as per
											on per.codigo = cur.cod_docente
										inner join sis.t_est_cur_estudiante as edo
											on edo.codigo = curest.cod_estado
										inner join sis.t_uni_tra_pensum as utp
											on utp.cod_uni_curricular = cur.cod_uni_curricular
										left join sis.t_trayecto as tra
											on utp.cod_trayecto = tra.codigo
										where curest.cod_estudiante = :codigo and curest.cod_estado = 'C'
										order by
											tra.num_trayecto,
											cur.seccion;";

				$ejecutar=$conexion->prepare($consulta);

				$conexion->beginTransaction();
				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);
				$ejecutar->execute();
				$results = $ejecutar->fetchAll();
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

		public static function eliminarEstudiante($est, $curso){
			try{
				$conexion = Conexion::conectar();

				$consulta = "delete from sis.t_cur_estudiante where cod_estudiante = :est and cod_curso = :curso;";

				$ejecutar=$conexion->prepare($consulta);
				$conexion->beginTransaction();
				$ejecutar->bindParam(':est',$est, PDO::PARAM_STR);
				$ejecutar->bindParam(':curso',$curso, PDO::PARAM_INT);
				$ejecutar->execute();
				$conexion->commit();
			}
			catch(Exception $e){
				throw $e;
			}
		}

		public static function retirarCurEstudiante($codigo){
			try{
				$conexion = Conexion::conectar();

				$consulta = "update sis.t_cur_estudiante set cod_estado = 'X' where codigo = :codigo;";

				$ejecutar=$conexion->prepare($consulta);
				$conexion->beginTransaction();
				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);
				$ejecutar->execute();
				$conexion->commit();

				$row = $ejecutar->rowCount();

				if ($row == 0)
					throw new Exception("No se pudo eliminar el estudiante en este curso.");

				return $row;
			}
			catch(Exception $e){
				throw $e;
			}
		}

		/* SECUENCIA DE INSCRIPCION */

		public static function obtenerUnidadesCurricularesDelPensumPorEstudiante($codigo){
			try{

				$conexion = Conexion::conectar();

				$consulta = "select 	utp.cod_uni_curricular
										from sis.t_persona per
										inner join sis.t_estudiante est
											on per.codigo = est.cod_persona
										inner join sis.t_uni_tra_pensum utp
											on utp.cod_pensum = est.cod_pensum
										inner join sis.t_uni_curricular uni
											on uni.codigo = utp.cod_uni_curricular
										left join sis.t_curso as cur
											on cur.cod_uni_curricular = utp.cod_uni_curricular
										where per.codigo = :codigo
										group by utp.cod_uni_curricular;";

				$ejecutar=$conexion->prepare($consulta);
				$conexion->beginTransaction();
				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);
				$ejecutar->execute();
				$results = $ejecutar->fetchAll(PDO::FETCH_COLUMN, 0);
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

		public static function obtenerUnidadesCurricularesConvalidadasPorEstudiante($codigo,$pensum){
			try{

				$conexion = Conexion::conectar();

				$consulta = "select 	con.cod_uni_curricular
										from sis.t_convalidacion con
										where cod_estudiante = :codigo
										and cod_pensum = :pensum";

				$ejecutar=$conexion->prepare($consulta);
				$conexion->beginTransaction();
				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);
				$ejecutar->bindParam(':pensum',$pensum, PDO::PARAM_INT);
				$ejecutar->execute();
				$results = $ejecutar->fetchAll(PDO::FETCH_COLUMN, 0);
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

		public static function obtenerUnidadesCurricularesAprobadasPorEstudiante($codigo,$pensum){
			try{

				$conexion = Conexion::conectar();

				$consulta = "select	cur.cod_uni_curricular
									from sis.t_cur_estudiante ce
									inner join sis.t_curso cur
										on cur.codigo = ce.cod_curso
									inner join sis.t_estudiante est
										on est.cod_persona = ce.cod_estudiante
									where ce.cod_estudiante = :codigo
									and ce.cod_estado = 'A'
									and est.cod_pensum = :pensum;";

				$ejecutar=$conexion->prepare($consulta);
				$conexion->beginTransaction();

				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);
				$ejecutar->bindParam(':pensum',$pensum, PDO::PARAM_INT);
				$ejecutar->execute();
				$results = $ejecutar->fetchAll(PDO::FETCH_COLUMN, 0);
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

		public static function obtenerUnidadesCurricularesPreladasPorListaDeUnidadesCurriculares($lista,$pensum,$instituto){
			try{

				$conexion = Conexion::conectar();

				$consulta = "select 	pre.cod_uni_cur_prelada
										from sis.t_prelacion pre
										where true
										";
				if($lista != NULL){
					$lista = implode(",",$lista);
					$lista = "(".$lista.")";

					$consulta .=" and pre.cod_uni_curricular IN $lista";
				}


				$consulta .= "
										and cod_pensum = :pensum
										and cod_instituto = :instituto";

				$ejecutar=$conexion->prepare($consulta);
				$conexion->beginTransaction();

				$ejecutar->bindParam(':pensum',$pensum);
				$ejecutar->bindParam(':instituto',$instituto);

				$ejecutar->execute();
				$results = $ejecutar->fetchAll(PDO::FETCH_COLUMN, 0);
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

		public static function obtenerCursosDisponiblesParaInscripcionPorEstudiante($estudiante, $aprobadas, $convalidadas, $prelacion, $cursando, $periodo){
			try{
				$conexion = Conexion::conectar();

				//incluye el periodo

				$consulta = "select
										utp.cod_uni_curricular,
										cur.codigo,
										tra.num_trayecto,
										uni.nombre,
										uni.uni_credito,
										cur.seccion,
										coalesce(cantc.t,0) cantidad,
										cur.capacidad,
										uni.cod_uni_ministerio
								from sis.t_persona per
										inner join sis.t_estudiante est
											on est.cod_persona = per.codigo
										inner join sis.t_uni_tra_pensum utp
											on utp.cod_pensum = est.cod_pensum
										inner join sis.t_uni_curricular uni
											on uni.codigo = utp.cod_uni_curricular
										inner join sis.t_curso as cur
											on cur.cod_uni_curricular = utp.cod_uni_curricular
										inner join sis.t_periodo pdo
											on pdo.codigo = cur.cod_periodo
										left join sis.t_trayecto as tra
											on tra.codigo = utp.cod_trayecto
										left join (SELECT ce.cod_curso codigo,
												coalesce(count(*),0) t
												FROM sis.t_cur_estudiante ce
												where ce.cod_estado <> 'X'
												group by ce.cod_curso) cantc

										    on cantc.codigo = cur.codigo
								where per.codigo = :estudiante
										and coalesce(cantc.t,0) < cur.capacidad
										and pdo.cod_estado = 'A'
										";

										if($aprobadas != NULL){
											$aprobadas = implode(",",$aprobadas);
											$aprobadas = "(".$aprobadas.")";
											$consulta .= " and utp.cod_uni_curricular not in $aprobadas ";
										}
										if($convalidadas != NULL){
											$convalidadas = implode(",",$convalidadas);
											$convalidadas = "(".$convalidadas.")";
											$consulta .= " and utp.cod_uni_curricular not in $convalidadas ";
										}

										if($cursando != NULL){
											$cursando = implode(",",$cursando);
											$cursando = "(".$cursando.")";
											$consulta .= " and utp.cod_uni_curricular not in $cursando ";
										}
										if($prelacion != NULL){
											$prelacion = implode(",",$prelacion);
											$prelacion = "(".$prelacion.")";
											$consulta .= " and utp.cod_uni_curricular not in $prelacion ";
										}
										$consulta .="
										and cur.cod_periodo = $periodo
										group by
											utp.cod_uni_curricular,
											utp.cod_trayecto,
											cur.codigo,
											tra.num_trayecto,
											uni.nombre,
											uni.uni_credito,
											cur.seccion,
											cantc.t,
											cur.capacidad,
											uni.cod_uni_ministerio
										order by
											utp.cod_trayecto,
											utp.cod_uni_curricular,
											cur.seccion";

				$ejecutar=$conexion->prepare($consulta);
				$conexion->beginTransaction();

				$ejecutar->bindParam(':estudiante', $estudiante);

				$ejecutar->execute();
				$results = $ejecutar->fetchAll();
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

		public static function obtenerCursosCursando($estudiante,$pensum){
			try{
				$conexion = Conexion::conectar();

				$consulta = "select 	cur.cod_uni_curricular
										from sis.t_cur_estudiante ce
										inner join sis.t_curso cur
											on cur.codigo = ce.cod_curso
										inner join sis.t_uni_tra_pensum utp
											on utp.cod_uni_curricular = cur.cod_uni_curricular
										where ce.cod_estudiante = :estudiante
										and ce.cod_estado = 'C'
										and utp.cod_pensum = :pensum
										group by
											cur.cod_uni_curricular;";

				$ejecutar=$conexion->prepare($consulta);
				$conexion->beginTransaction();
				$ejecutar->bindParam(':estudiante', $estudiante, PDO::PARAM_INT);
				$ejecutar->bindParam(':pensum', $pensum, PDO::PARAM_INT);
				$ejecutar->execute();
				$results = $ejecutar->fetchAll(PDO::FETCH_COLUMN, 0);
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


		public static function cambiarEstado($codEstudiante,$codCurso,$estado){
			try{
				$conexion = Conexion::conectar();

				$consulta = "update 	sis.t_cur_estudiante
										set cod_estado = :estado
										where cod_estudiante = :codEstudiante
										and cod_curso = :codCurso";

				$ejecutar=$conexion->prepare($consulta);
				$conexion->beginTransaction();
				$ejecutar->bindParam(':codEstudiante', $codEstudiante, PDO::PARAM_INT);
				$ejecutar->bindParam(':codCurso', $codCurso, PDO::PARAM_INT);
				$ejecutar->bindParam(':estado', $estado, PDO::PARAM_INT);
				$ejecutar->execute();

				$conexion->commit();

			}
			catch(Exception $e){
				throw $e;
			}
		}

		public static function obtenerLeyendaEstatusCurso(){
			try{
				$conexion = Conexion::conectar();

				$consulta = "select * from sis.t_est_cur_estudiante order by codigo";

				$ejecutar = $conexion->prepare($consulta);

				$ejecutar->execute(array());

				if($ejecutar->rowCount() != 0)
					return $ejecutar->fetchAll();
				else
					return null;
			}
			catch(Exception $e){
				throw $e;
			}
		}


		public static function verificarEst($codEstudiante,$codCurso){
			try{
				$conexion = Conexion::conectar();

				$consulta = "select		codigo
										from sis.t_cur_estudiante
										where cod_estudiante = :codEstudiante
										and cod_curso = :codCurso";

				$ejecutar=$conexion->prepare($consulta);
				$conexion->beginTransaction();
				$ejecutar->bindParam(':codEstudiante', $codEstudiante, PDO::PARAM_INT);
				$ejecutar->bindParam(':codCurso', $codCurso, PDO::PARAM_INT);

				$ejecutar->execute();

				return ($ejecutar->rowCount() > 0);
			}
			catch(Exception $e){
				throw $e;
			}
		}

		public static function obtenerTicketInscripcion($codEstudiante, $codPensum, $codPeriodo){
			try{
				$conexion = Conexion::conectar();

				$consulta = "select	ins.nombre as nombreinst,
									pen.nombre as nombrepensum,
									pdo.nombre as nombreper,
									per.nacionalidad,
									per.cedula,
									per.nombre1 || ' ' || per.apellido1 as nombreest,
									uni.nombre as nombreuni,
									coalesce(per2.nombre1 || ' ' || per2.apellido1,'No asignado') as nombredoc,
									cur.codigo codcurso,
									cur.seccion,
									cur.capacidad,
									(select  	count(codigo)
											from sis.t_cur_estudiante
											where  cod_estado = 'C'
											and cod_curso = cur.codigo
											and codigo < (select codigo
											from sis.t_cur_estudiante
											where cod_estudiante = per.codigo
											and cod_estado = 'C'
											and cod_curso = cur.codigo) + 1)
									as orden
									from sis.t_estudiante est
									inner join sis.t_persona per
										on per.codigo = est.cod_persona
									inner join sis.t_cur_estudiante curest
										on curest.cod_estudiante = per.codigo
									inner join sis.t_curso cur
										on cur.codigo = curest.cod_curso
									inner join sis.t_periodo pdo
										on pdo.codigo = cur.cod_periodo
									inner join sis.t_pensum pen
										on pen.codigo = est.cod_pensum
									inner join sis.t_uni_curricular uni
										on uni.codigo = cur.cod_uni_curricular
									inner join sis.t_instituto ins
										on ins.codigo = pdo.cod_instituto
									left join sis.t_persona per2
										on per2.codigo = cur.cod_docente
									where per.codigo = :estudiante
									and pdo.codigo = :periodo
									and pen.codigo = :pensum
									and curest.cod_estado = 'C';";

					$ejecutar=$conexion->prepare($consulta);
					$conexion->beginTransaction();
					$ejecutar->bindParam(':estudiante', $codEstudiante, PDO::PARAM_INT);
					$ejecutar->bindParam(':pensum', $codPensum, PDO::PARAM_INT);
					$ejecutar->bindParam(':periodo', $codPeriodo, PDO::PARAM_INT);
					$ejecutar->execute();
					$results = $ejecutar->fetchAll();
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

		public static function verificarEstudiantesCurso($codigo){
			try{
				$conexion = Conexion::conectar();

				$consulta = "select count(codigo)
											from sis.t_cur_estudiante
											where cod_curso = $codigo";

				$ejecutar = $conexion->prepare($consulta);

				$ejecutar->execute();

				$result = $ejecutar->fetchAll();

				return $result[0][0];
			}
			catch(Exception $e){
				throw $e;
			}
		}

		public static function listarTipoUnicurricuar(){
			try{

				$conexion = Conexion::conectar();
				$consulta = "select * from sis.t_tip_uni_curricular;";

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

		public static function agregarConvalidacion($cod_persona, 	   $con_nota,  $nota,
												   $fecha,  			   $cod_tip_uni_curricular,
												   $cod_pensum, 		   $cod_trayecto, 		   $cod_uni_curricular,
												   $descripcion )
		{
			try{

				$conexion = Conexion::conectar();

				$consulta = "select sis.f_convalidar_ins(
														:cod_persona, 	   :con_nota,  :nota,
												   		:fecha,  			   :cod_tip_uni_curricular,
												   		:cod_pensum, 		   :cod_trayecto, 		   :cod_uni_curricular,
												   		:descripcion
													);";
				$ejecutar = $conexion->prepare($consulta);

				$ejecutar->bindParam(':cod_persona',$cod_persona, PDO::PARAM_STR);
				$ejecutar->bindParam(':con_nota',$con_nota, PDO::PARAM_STR);
				$ejecutar->bindParam(':nota',$nota, PDO::PARAM_STR);
				$ejecutar->bindParam(':fecha',$fecha, PDO::PARAM_STR);
				$ejecutar->bindParam(':cod_tip_uni_curricular',$cod_tip_uni_curricular, PDO::PARAM_STR);
				$ejecutar->bindParam(':cod_pensum',$cod_pensum, PDO::PARAM_STR);
				$ejecutar->bindParam(':cod_trayecto',$cod_trayecto, PDO::PARAM_STR);
				$ejecutar->bindParam(':cod_uni_curricular',$cod_uni_curricular, PDO::PARAM_STR);
				$ejecutar->bindParam(':descripcion',$descripcion , PDO::PARAM_STR);

				$login=Vista::obtenerDato('login');
				if($login->obtenerPermiso('convalidar')){
					$ejecutar->setFetchMode(PDO::FETCH_ASSOC);

					$ejecutar->execute();
					$codigo=$ejecutar->fetchColumn(0);
					return $codigo;
				}
				else
					throw new Exception("No tienes permiso para agregar una convalidacion");

			}
			catch(Exception $e){
				throw $e;
			}
		}

		public static function buscarConvalidacionEstudiante ($codigo=null){
			try{
				$conexion = Conexion::conectar();
				$consulta = "select c.codigo,c.cod_estudiante,c.con_nota, c.nota, p.nom_corto,
								c.fecha,c.descripcion, tuc.nombre as tipo, t.num_trayecto, uc.nombre
							from sis.t_tip_uni_curricular tuc, sis.t_convalidacion c, sis.t_trayecto t,
								sis.t_pensum p, sis.t_uni_curricular uc, sis.t_estudiante est
							where c.cod_estudiante=est.codigo and c.cod_trayecto=t.codigo
								and p.codigo=c.cod_pensum and tuc.codigo=c.cod_tip_uni_curricular
								and uc.codigo=c.cod_uni_curricular and est.cod_persona=?
							order by c.fecha desc,c.codigo";

				$ejecutar=$conexion->prepare($consulta);

				$ejecutar-> execute(array($codigo));

				if($ejecutar->rowCount() != 0)
					return $ejecutar->fetchAll();
				else
					return null;
			}
			catch(Exception $e){
				throw $e;
			}
		}

		public static function BuscarConvalidacionPorCodigo ($codigo=null){
			try{

				$conexion = Conexion::conectar();

				$consulta = "select c.*, uc.nombre,
								p.nombre1 || ' ' || p.nombre2 || ' ' || p.apellido1 || ' ' ||
								p.apellido2 as nomPersona, p.cedula,
								(select to_char(c.fecha,'DD/MM/YYYY')) as fechas
							from sis.t_convalidacion c, sis.t_uni_curricular uc,
								sis.t_persona p, sis.t_estudiante e
							where c.codigo=? and c.cod_uni_curricular=uc.codigo
								and p.codigo = e.cod_persona and e.codigo=c.cod_estudiante;";

				$ejecutar=$conexion->prepare($consulta);

				$ejecutar-> execute(array($codigo));

				if($ejecutar->rowCount() != 0)
					return $ejecutar->fetchAll();
				else
					return null;
			}
			catch(Exception $e){
				throw $e;
			}
		}

		public static function modificarConvalidacion($codigo,$descripcion){
			try{
				$conexion = Conexion::conectar();

				$consulta="select sis.f_convalidar_mod(:codigo,:descripcion)";

				$ejecutar=$conexion->prepare($consulta);

				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_STR);
				$ejecutar->bindParam(':descripcion',$descripcion, PDO::PARAM_STR);

				$login=Vista::obtenerDato('login');
				if($login->obtenerPermiso('convalidar')){
					$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
						//ejecuta
					$ejecutar->execute();
						//primera columana codigo
					$row = $ejecutar->fetchColumn(0);

					return $row;
				}
				else
					throw new Exception("NO tienes permiso para modificar una convalidacion");

			}
			catch(Exception $e){
				throw $e;
			}
		}

		public static function borrarConvalidacion($codigo=null){
			try{

				$conexion = Conexion::conectar();
				$consulta="select sis.f_convalidacion_eli(:codigo)";
				$ejecutar=$conexion->prepare($consulta);

				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_STR);
				$login=Vista::obtenerDato('login');
				if($login->obtenerPermiso('convalidar')){
					$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
					//ejecuta

					$ejecutar->execute();
					//primera columana codigo
					$row = $ejecutar->fetchColumn(0);
					//var_dump($row);

					return $row;
				}
				else
					throw new Exception("NO tienes permiso para eliminar una convalidacon");

			}
			catch(Exception $e){
				throw $e;
			}
		}

		public static function agregarElectiva($periodo,	$unidadCurricular,
											   $docente,	$seccion,
											   $fecInicio,	$fecFin,
											   $capacidad,  $observaciones){
			try{

				$conexion = Conexion::conectar();

				$consulta="insert into sis.t_curso (cod_periodo, cod_uni_curricular,cod_docente,
													seccion,	 fec_inicio,		fec_final,
													capacidad,	 observaciones,		cod_estado)
							values(?,?,?,?,?,?,?,?,?);";

				$ejecutar=$conexion->prepare($consulta);

				$ejecutar-> execute(array($periodo,	$unidadCurricular,	$docente,
											 $seccion,	$fecInicio,			$fecFin,
											 $capacidad,$observaciones,		'A'));

				if($ejecutar->rowCount() != 0)
					return $ejecutar->fetchAll();
				else
					return null;
			}
			catch(Exception $e){
				throw $e;
			}
		}


		public static function modificarElectiva($periodo,	$unidadCurricular,
											     $docente,	$seccion,
											     $fecInicio,$fecFin,
											     $capacidad,$observaciones,
											     $codigo){
			try{

				$conexion = Conexion::conectar();

				$consulta="update sis.t_curso set cod_periodo=?, cod_uni_curricular=?, cod_docente=?,
													seccion=?,	 fec_inicio=?,		   fec_final=?,
													capacidad=?, observaciones=?,	   cod_estado=?
							where codigo=?";

				$ejecutar=$conexion->prepare($consulta);

				$ejecutar-> execute(array($periodo,	$unidadCurricular,	$docente,
											 $seccion,	$fecInicio,			$fecFin,
											 $capacidad,$observaciones,		'A',
											 $codigo));

				if($ejecutar->rowCount() != 0)
					return $ejecutar->fetchAll();
				else
					return null;
			}
			catch(Exception $e){
				throw $e;
			}
		}

		public static function listarCurElectivas ($pensum,$periodo){
			try{

				$conexion = Conexion::conectar();

				$consulta="select 	p.nombre1 || ' ' ||p.apellido1 as nom_persona,
									 uc.nombre, c.*, (select to_char(c.fec_final,'DD/MM/YYYY')) as fec_fin,
									 (select to_char(c.fec_inicio,'DD/MM/YYYY')) as fec_inicios
							from sis.t_persona p, sis.t_uni_curricular uc,
								sis.t_curso c, sis.t_uni_tra_pensum utp,
								sis.t_periodo per,sis.t_empleado e

							where utp.cod_pensum=? and utp.cod_tipo='E'
								and utp.cod_uni_curricular=uc.codigo
							and c.cod_uni_curricular=uc.codigo
							and p.codigo=e.cod_persona and e.cod_persona=c.cod_docente
							and per.codigo=? ";


				$ejecutar=$conexion->prepare($consulta);

				$ejecutar-> execute(array($pensum,$periodo));

				if($ejecutar->rowCount() != 0)
					return $ejecutar->fetchAll();
				else
					return null;
			}
			catch(Exception $e){
				throw $e;
			}
		}

		public static function buscarCurElectiva ($codigo){
			try{

				$conexion = Conexion::conectar();

				$consulta="select 	p.nombre1 || ' ' ||p.apellido1 as nom_persona,
								uc.nombre, c.*, utp.cod_pensum, (select to_char(c.fec_final,'DD/MM/YYYY')) as fec_fin,
									 (select to_char(c.fec_inicio,'DD/MM/YYYY')) as fec_inicios
							from sis.t_persona p, sis.t_uni_curricular uc,
								sis.t_curso c,  sis.t_empleado e,
								sis.t_uni_tra_pensum utp
							where c.codigo=? and c.cod_uni_curricular=uc.codigo
								and p.codigo=e.cod_persona
								and uc.codigo=utp.cod_uni_curricular";


				$ejecutar=$conexion->prepare($consulta);

				$ejecutar-> execute(array($codigo));

				if($ejecutar->rowCount() != 0)
					return $ejecutar->fetchAll();
				else
					return null;
			}
			catch(Exception $e){
				throw $e;
			}
		}

		public static function buscarAcreditadas($codEstudiante){
			try{
				$conexion = Conexion::conectar();
				$consulta = "select a.codigo as codigo,p.nom_corto as pensum, t.num_trayecto as trayecto,
									a.fecha as fecha, a.descripcion as descripcion, a.uni_credito as uni_credito
								from sis.t_acreditable as a, sis.t_pensum as p, sis.t_trayecto as t
								where a.cod_estudiante=? and p.codigo=a.cod_pensum and t.codigo=a.cod_trayecto";
				$ejecutar=$conexion->prepare($consulta);

				$ejecutar-> execute(array($codEstudiante));

				if($ejecutar->rowCount() != 0)
					return $ejecutar->fetchAll();
				else
					return null;
			}
			catch(Exception $e){
				throw $e;
			}

		}

		public static function obtenerUltCodAcreditable(){
			try{
				$conexion = Conexion::conectar();
				$consulta = "select coalesce(max(codigo),0) from sis.t_acreditable;";
				$ejecutar=$conexion->prepare($consulta);
				$ejecutar-> execute(array());
				if($ejecutar->rowCount() != 0){
					$a=$ejecutar->fetchAll();
					return $a[0]["coalesce"];
				}
				else
					return null;
			}
			catch(Exception $e){
				throw $e;
			}
		}

		public static function agregarAcreditada($codigo,		$cod_estudiante,$cod_pensum,
												$cod_trayecto,	$uni_credito,	$fecha,
												$descripcion){
			try{
				$conexion = Conexion::conectar();
				$consulta = "insert into sis.t_acreditable (codigo,cod_estudiante,cod_pensum,cod_trayecto,
															uni_credito,fecha,descripcion)
									values (?,?,?,?,?,?,?);";
				$ejecutar=$conexion->prepare($consulta);

				$ejecutar-> execute(array($codigo,$cod_estudiante,$cod_pensum,
											$cod_trayecto,$uni_credito,$fecha,$descripcion));
				if($ejecutar->rowCount() != 0){
					$ejecutar->fetchAll();
					return $codigo;
				}else
					return null;
			}
			catch(Exception $e){
				throw $e;
			}
		}

		public static function modificarAcreditada($codigo,		$cod_estudiante,$cod_pensum,
												$cod_trayecto,	$uni_credito,	$fecha,
												$descripcion){
			try{
				$conexion = Conexion::conectar();
				$consulta = "update sis.t_acreditable set cod_pensum=?,cod_trayecto=?,
															uni_credito=?,fecha=?,descripcion=?

									where codigo=?;";
				$ejecutar=$conexion->prepare($consulta);

				$ejecutar-> execute(array($cod_pensum,$cod_trayecto,$uni_credito,$fecha,$descripcion,$codigo));
				if($ejecutar->rowCount() != 0){
					$ejecutar->fetchAll();
					return $codigo;
				}else
					return null;
			}
			catch(Exception $e){
				throw $e;
			}
		}

		public static function buscarUnaAcreditable($codigo){
			try{
				$conexion = Conexion::conectar();
				$consulta = "select codigo, cod_estudiante, cod_pensum, cod_trayecto, uni_credito, fecha, descripcion
								from sis.t_acreditable
								where codigo=?";
				$ejecutar=$conexion->prepare($consulta);

				$ejecutar-> execute(array($codigo));

				if($ejecutar->rowCount() != 0)
					return $ejecutar->fetchAll();
				else
					return null;
			}
			catch(Exception $e){
				throw $e;
			}
		}

		public static function borrarAcreditable($codigo){
			try{
				$conexion = Conexion::conectar();
				$consulta = "delete from sis.t_acreditable where codigo=?";
				$ejecutar=$conexion->prepare($consulta);

				$ejecutar-> execute(array($codigo));

				if($ejecutar->rowCount() != 0)
					return $ejecutar->fetchAll();
				else
					return null;
			}
			catch(Exception $e){
				throw $e;
			}
		}

		public static function obtenerEstConPensum($codigo){
			try{
				$conexion = Conexion::conectar();

				$consulta = "select 	uni.nombre as nombreuni,
										uni.not_min_aprobatoria,
										uni.not_maxima,
										uni.uni_credito,
										cur.seccion,
										docente.apellido1 || ', ' || docente.nombre1 as nombredocente,
										docente.cedula ceduladoc,
										pen.nombre nombrepensum,
										per.nombre as periodo,
										ins.nombre insti,
										curest.nota,
										curest.por_asistencia,
										estudiante.apellido1 || ', ' || estudiante.nombre1 as nombreestudiante,
										estudiante.cedula,
										estado.codigo as codestado,
										estado.nombre as nombreestado,
										tra.num_trayecto
										from sis.t_curso cur
										inner join sis.t_uni_curricular uni
											on cur.cod_uni_curricular = uni.codigo
										inner join sis.t_periodo per
											on per.codigo = cur.cod_periodo
										inner join sis.t_persona docente
											on docente.codigo = cur.cod_docente
										inner join sis.t_pensum pen
											on pen.codigo = per.cod_pensum
										inner join sis.t_instituto ins
											on ins.codigo = per.cod_instituto
										inner join sis.t_cur_estudiante curest
											on curest.cod_curso = cur.codigo
										inner join sis.t_persona estudiante
											on estudiante.codigo = curest.cod_estudiante
										inner join sis.t_est_cur_estudiante estado
											on estado.codigo = curest.cod_estado
										inner join sis.t_uni_tra_pensum utp
											on (utp.cod_uni_curricular = uni.codigo and utp.cod_pensum = pen.codigo)
										left join sis.t_trayecto tra
											on utp.cod_trayecto = tra.codigo
										where cur.codigo = ?
										order by nombreestudiante asc;";

				$ejecutar = $conexion->prepare($consulta);

				$ejecutar->execute(array($codigo));

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
