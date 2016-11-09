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

Nombre: PeriodoServicio.php
Diseñador: Juan De Sousa (juanmdsousa@gmail.com)
Programador: Juan De Sousa
Lider de proyecto: Johan Alamo (johan.alamo@gmail.com)
Fecha: Diciembre de 2015
Descripción:
	Este es el servicio del módulo Periodo. Encargado de todas las operaciones que involucren la base de datos.

 * * * * * * * * Cambios/Mejoras/Correcciones/Revisiones * * * * * * * *
---                         ----      ---------

 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
*/


	class PeriodoServicio{

		/*
		 * Método obtenerPeriodos de la case PeriodoServicio.
		 *
		 * Obtiene una lista de periodos en el sistema.
		 *
		 * Valores de retorno:
		 *	 Retorna un arreglo con los periodos en el sistema.
		 *
		 */

		public static function obtenerPeriodos(){
			try{
				$conexion = Conexion::conectar();
				$consulta = "select sis.f_periodo_sel('periodos')";
				$ejecutar = $conexion->prepare($consulta);
				$conexion->beginTransaction();
				$ejecutar->execute();

				$cursors = $ejecutar->fetchAll();
				$ejecutar->closeCursor();

				$results = array();
				$ejecutar = $conexion->query('FETCH ALL IN periodos;');
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
		 * Método obtenerPeriodoPorCódigo
		 *
		 * Recibe un código de periodo como parámetro y retorna la información
		 * de ese periodo si existe en la base de datos. De no ser así,
		 * retorna null.
		 *
		 * Valores de entrada:
		 * 		$codigo 			Código del periodo a consultar
		 *
		 * Valores de retorno:
		 * 		Arreglo con información de Periodo
		 * 		Null
		 *
		 */

		public static function obtenerPeriodoPorCodigo($codigo){
			try{
				$conexion = Conexion::conectar();
				$consulta = "select sis.f_periodo_sel('periodos',:codigo)";
				$ejecutar = $conexion->prepare($consulta);

				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);
				$conexion->beginTransaction();
				$ejecutar->execute();
				$cursors = $ejecutar->fetchAll();
				$ejecutar->closeCursor();

				$results = array();
				$ejecutar = $conexion->query('FETCH ALL IN periodos;');
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
		 * Método insertarPeriodo de PeriodoServicio.
		 *
		 * Agrega un periodo a la base de datos. Si se realizó la inserción,
		 * devuelve el código del periodo. De no ser así, devuelve cero
		 * (y lanza excepción en base de datos)
		 *
		 * Valores de entrada:
		 * 		$nombre						Nombre del periodo a ser agregado.
		 * 		$codIns						Código del instituto del periodo.
		 * 		$codPen						Código del pensum asociado al periodo.
		 * 		$fecIni						Fecha de inicio del periodo.
		 * 		$fecFin						Fecha de fin del periodo.
		 * 		$observaciones				Observaciones del periodo.
		 * 		$codEst						Código de estado del periodo.
		 *
		 * Valores de retorno:
		 * 		Código del periodo
		 */

		public static function insertarPeriodo($nombre, $codIns, $codPen, $fecIni, $fecFin, $observaciones, $codEst){
			try{
				$conexion=Conexion::conectar();
				$consulta="select sis.f_periodo_ins(:p_nombre, :p_cod_instituto, :p_cod_pensum, :p_fec_inicio, :p_fec_final, :p_observaciones, :p_cod_estado)";
				$ejecutar=$conexion->prepare($consulta);

				$ejecutar->bindParam(':p_nombre',$nombre, PDO::PARAM_STR);
				$ejecutar->bindParam(':p_cod_instituto',$codIns, PDO::PARAM_INT);
				$ejecutar->bindParam(':p_cod_pensum',$codPen, PDO::PARAM_INT);
				$ejecutar->bindParam(':p_fec_inicio',$fecIni, PDO::PARAM_STR);
				$ejecutar->bindParam(':p_fec_final',$fecFin, PDO::PARAM_STR);
				$ejecutar->bindParam(':p_observaciones',$observaciones, PDO::PARAM_STR);
				$ejecutar->bindParam(':p_cod_estado',$codEst, PDO::PARAM_STR);
				$ejecutar->setFetchMode(PDO::FETCH_ASSOC);

				$ejecutar->execute();

				$codigo = $ejecutar->fetchColumn(0);
				return $codigo;
			}
			catch(Exception $e){
				throw $e;
			}
		}

		/*
		 * Método eliminarPeriodo de PeriodoServicio.
		 *
		 * Recibe un código de periodo y lo elimina de la base de datos.
		 * De no poder realizar la eliminación, lanza una excepción.
		 *
		 * Valores de entrada:
		 * 		$codigo					Código del periodo a eliminar.
		 *
		 */

		public static function eliminarPeriodo($codigo){
			try{
				$conexion=Conexion::conectar();
				$consulta="select sis.f_periodo_del(:codigo)";
				$ejecutar=$conexion->prepare($consulta);

				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);
				$ejecutar->setFetchMode(PDO::FETCH_ASSOC);

				$ejecutar->execute();

				$row = $ejecutar->fetchColumn(0);

				if ($row == 0)
					throw new Exception("No se pudo eliminar el Periodo.");
			}
			catch(Exception $e){
				throw $e;
			}
		}

		/*
		 * Método modificarPeriodo de PeriodoServicio.
		 *
		 * Modifica un periodo de la base de datos. De no ser así, arroja una excepción.
		 *
		 * Valores de entrada:
		 * 		$codigo						Código del perido a modificar.
		 * 		$nombre						Nombre del periodo a ser modificado.
		 * 		$codIns						Código del instituto del periodo.
		 * 		$codPen						Código del pensum asociado al periodo.
		 * 		$fecIni						Fecha de inicio del periodo.
		 * 		$fecFin						Fecha de fin del periodo.
		 * 		$observaciones				Observaciones del periodo.
		 * 		$codEst						Código de estado del periodo.
		 *
		 */

		public static function modificarPeriodo($codigo, $nombre, $codIns, $codPen, $fecIni, $fecFin, $observaciones, $codEst){
			try{
				$conexion=Conexion::conectar();
				$consulta="select sis.f_periodo_mod(:codigo, :p_nombre, :p_cod_instituto, :p_cod_pensum, :p_fec_inicio, :p_fec_final, :p_observaciones, :p_cod_estado)";
				$ejecutar=$conexion->prepare($consulta);

				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);
				$ejecutar->bindParam(':p_nombre',$nombre, PDO::PARAM_STR);
				$ejecutar->bindParam(':p_cod_instituto',$codIns, PDO::PARAM_INT);
				$ejecutar->bindParam(':p_cod_pensum',$codPen, PDO::PARAM_INT);
				$ejecutar->bindParam(':p_fec_inicio',$fecIni, PDO::PARAM_STR);
				$ejecutar->bindParam(':p_fec_final',$fecFin, PDO::PARAM_STR);
				$ejecutar->bindParam(':p_observaciones',$observaciones, PDO::PARAM_STR);
				$ejecutar->bindParam(':p_cod_estado',$codEst, PDO::PARAM_STR);

				$ejecutar->execute();

				$row = $ejecutar->rowCount();

				if ($row == 0)
					throw new Exception("No se puede modificar el periodo.");

				return $row;
			}
			catch(Exception $e){
				throw $e;
			}
		}

		public static function obtenerPeriodoPorPensum($codigo){
			try{
				$conexion = Conexion::conectar();
				$consulta = "select sis.f_periodo_pensum_sel('periodos',:codigo)";
				$ejecutar = $conexion->prepare($consulta);

				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);
				$conexion->beginTransaction();
				$ejecutar->execute();
				$cursors = $ejecutar->fetchAll();
				$ejecutar->closeCursor();

				$results = array();
				$ejecutar = $conexion->query('FETCH ALL IN periodos;');
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

		public static function listar($patron = null){
			try{
				$conexion = Conexion::conectar();

				$consulta = "select per.codigo,
									ins.nom_corto nomi,
									pen.nom_corto nomp,
									per.nombre,
									per.fec_inicio,
									per.fec_final,
									est.nombre nome,
									per.cod_estado
									from sis.t_periodo per
									inner join sis.t_instituto ins
										on ins.codigo = per.cod_instituto
									inner join sis.t_pensum pen
										on pen.codigo = per.cod_pensum
									inner join sis.t_est_periodo est
										on est.codigo = per.cod_estado
									where upper(ins.nom_corto) like upper('%$patron%')
									or upper(pen.nom_corto) like upper('%$patron%')
									or upper(per.nombre) like upper('%$patron%')
									or upper(est.nombre) like upper('%$patron%')
									order by 	per.cod_estado,
												ins.nom_corto;";

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

		public static function obtenerDatosPeriodo($codigo){
			try{
				$conexion = Conexion::conectar();

				$consulta = "select 	per.codigo,
										per.cod_instituto,
										per.cod_pensum,
										per.cod_estado,
										per.nombre,
										ins.nombre nom_instituto,
										pen.nombre nom_pensum,
										per.fec_inicio,
										per.fec_final,
										per.observaciones,
										per.cod_estado
										from sis.t_periodo per
										inner join sis.t_pensum pen
											on pen.codigo = per.cod_pensum
										inner join sis.t_instituto ins
											on ins.codigo = per.cod_instituto
										where per.codigo = :codigo;";

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

		public static function obtenerEstadosPeriodo(){
			try{
				$conexion = Conexion::conectar();

				$consulta = "select 	est.codigo,
										est.nombre
										from sis.t_est_periodo est;";

				$ejecutar = $conexion->prepare($consulta);

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

		public static function periodoInsPenEstado($instituto=null,$pensum=null,$estado=null){
			try{

				$conexion = Conexion::conectar();

				$consulta="select * from sis.t_periodo where cod_instituto=$instituto and 
							cod_pensum=$pensum and cod_estado = '$estado';";
			
				$ejecutar = $conexion->prepare($consulta);
				$ejecutar->execute(array());

				$results = $ejecutar->fetchAll();

				if(count($results)>0)
					return $results;
				else
					return null;

			}
			catch(Exception $e){
				throw $e;
			}
		}
	}
?>
