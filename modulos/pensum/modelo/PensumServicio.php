<?php


/**
 * @copyright 2014 - Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio
 * @license GPLv3
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 *
 * pensumServicio.php - Servicio del módulo Pensum.
 *
 * Esta clase ofrece el servicio de conexión a la base de datos, recibe
 * los parámetros, construye las consultas SQL, hace las peticiones a
 * la base de datos y retorna los objetos o datos correspondientes a la
 * acción. en este archivo se contiene todo lo relacionado a pensum
 * es el archivo que permite la interacion la lo relacionado a pensum
 * en la base de datos.Todas las funciones de esta clase relanzan las excepciones si son capturadas.
 * Esto con el fin de que la clase manejadora de errores las capture y procese.
 *
 * @author Rafael Garcia (rafaelantoniorf@gmail.com)
 *  clase
 */

// require_once "negocio/Pensum.php";



class PensumServicio
{

	/**
	 * Función que permite listar todos los pensum.
	 *
	 * Realiza la consulta a la base de datos llamando a store procedure (funcion en postgresSQL) sis.f_pensum_seleccionar()
	 * utilizando tranasaccion la luego leer el cursor
	 * 		 *
	 * @return array|null					Retorna un arreglo de arreglos asociativos o null de no encontrarse coincidencias.
	 *
	 * @throws Exception 					Si se producen errores en operaciones con la base de datos.
	 */

	public static function listarPensum(){
		try{
			$conexion=Conexion::conectar();
			$consulta= "select sis.f_pensum_seleccionar('pcursor')";
			$ejecutar= $conexion->prepare($consulta);
			// inicia transaccion
			$conexion->beginTransaction();
			$ejecutar->execute();
			$cursors = $ejecutar->fetchAll();
			// cierra cursor
			$ejecutar->closeCursor();
			// array para almacenar resultado del cursor
			$results = array();
				// ejecutar otro query para leer el cursor
				$ejecutar = $conexion->query('FETCH ALL IN pcursor;');
				$results = $ejecutar->fetchAll();
				$ejecutar->closeCursor();
				// cierra cursor
			$conexion->commit();
			// recomendad null a este objeto
			unset($ejecutar);
			// PDO cierrar auntomaticamenta la seccion de db cuando el objeto es null
			unset($conexion);
			if(count($results) > 0)
				return $results;
			else
				return null;
		}catch (Exception $e ){
				throw $e;
		}
	}

	/**
		 * Función que permite agregar un pensum.
		 *
		 * Permite agrega un pensum a la base de datos.
		 *
		 * @param objet $pensum 			  	Objeto pensum a agregar.
		 *
		 * @throws Exception 					Si no se puede agregar el pensum.
		 */
	public static function agregar()
	{
		try{
				$nArg=func_num_args();
				if ($nArg==1){
				$p=func_get_arg(0);
				if ((is_object($p)) && (get_class($p)=='Pensum'))
				self::agregarO($p);
				}else{
				if ($nArg!=2)
					throw new Exception ('Cantidad de parámetros incorrecta');
				else
					self::agregarD(func_get_arg(0),func_get_arg(1),func_get_arg(2));
				}
			}catch (Exception $e){
			throw $e;
			}
	}

	/**
		 * Función que permite agregar un pensum.
		 *
		 * Permite agrega un pensum a la base de datos.
		 *
		 * @param objet $pensum 			  	Objeto pensum a agregar.
		 *
		 * @throws Exception 					Si no se puede agregar el pensum.
		 */
	public static function agregarPensumObjetc($pensum){
		try{

			//var_dump($pensum);
			$conexion=Conexion::conectar();
			$consulta="select sis.f_pensum_insertar(:nombre, :nombreCorto, :observaciones, :min_can_elect, :min_cre_elect, :min_cre_obligat, :fec_creac)";
			$ejecutar=$conexion->prepare($consulta);
			// indica
			// como se indica en parametro y el tipo de parametro que se envia
			$ejecutar->bindParam(':nombre',$pensum->obtenerNombre(), PDO::PARAM_STR);
			$ejecutar->bindParam(':nombreCorto',$pensum->obtenerNombreCorto(), PDO::PARAM_STR);
			$ejecutar->bindParam(':observaciones',$pensum->obtenerObservaciones(), PDO::PARAM_STR);
			$ejecutar->bindParam(':min_can_elect',$pensum->obtenerMinCanElectiva(), PDO::PARAM_INT);
			$ejecutar->bindParam(':min_cre_elect',$pensum->obtenerMinCreElectiva(), PDO::PARAM_INT);
			$ejecutar->bindParam(':min_cre_obligat',$pensum->obtenerMinCreObligatorio(), PDO::PARAM_INT);
			$ejecutar->bindParam(':fec_creac', $pensum->obtenerFechaCreacion() , PDO::PARAM_STR);
			//$ejecutar->bindParam(':fec_creac', date ("d-m-Y", strtotime(str_replace('-', '/', $pensum->obtenerFechaCreacion()))), PDO::PARAM_STR);

			$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
			//ejecuta
			$ejecutar->execute();
			//primera columana codigo
			$codigo = $ejecutar->fetchColumn(0);
			unset($ejecutar);
			unset($conexion);
			return $codigo;
		}catch(Exception $e){
			throw $e;

		}
	}

	/**
		 * Función que permite agregar un pensum.
		 *
		 * Permite agrega un pensum a la base de datos.
		 *
		 * @param nombre $nombre 			  	variable pensum a agregar.
		 * @param nomCorto $nomCorto 			  	variable pensum a agregar.
		 * @param direccion $direccion 			  	variable pensum a agregar.
		 * @param min_can_elect $min_can_elect 			  	variable pensum a agregar.
		 * @param min_cre_elect $min_cre_elect 			  	variable pensum a agregar.
		 * @param min_cre_obligat $min_cre_obligat 			  	variable pensum a agregar.
		 * @param fec_creac $fec_creac 			  	variable pensum a agregar.
		 *
		 * @throws Exception 					Si no se puede agregar el pensum.
		*/
	public static function agregarPensumParametro($nombre, $nombreCorto, $observaciones, $min_can_elect, $min_cre_elect, $min_cre_obligat, $fec_creac){
		try{
			$conexion=Conexion::conectar();
			$consulta="select sis.f_instituto_insertar(:nombre, :nombreCorto, :observaciones, :min_can_elect, :min_cre_elect, :min_cre_obligat, :fec_creac)";
			$ejecutar=$conexion->prepare($consulta);
			// indica
			// como se indica en parametro y el tipo de parametro que se envia
			$ejecutar->bindParam(':nombre',$nombre, PDO::PARAM_STR);

			$ejecutar->bindParam(':nombreCorto',$nombreCorto, PDO::PARAM_STR);

			$ejecutar->bindParam(':observaciones',$observaciones, PDO::PARAM_STR);

			$ejecutar->bindParam(':min_can_elect',$min_can_elect, PDO::PARAM_INT);

			$ejecutar->bindParam(':min_cre_elect',$min_cre_elect, PDO::PARAM_INT);

			$ejecutar->bindParam(':min_cre_obligat',$min_cre_obligat, PDO::PARAM_INT);

			$ejecutar->bindParam(':fec_creac', $pensum->obtenerFechaCreacion() , PDO::PARAM_STR);

			$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
			//ejecuta
			$ejecutar->execute();
			//primera columana codigo
			$codigo = $ejecutar->fetchColumn(0);
			unset($ejecutar);
			unset($conexion);
			return $codigo;

		}catch(Exception $e){
			throw $e;
		}
	}

	/**
		 * Función que permite modificar un pensum.
		 *
		 * Permite modificar un pensum a la base de datos.
		 *
		 * @param objet $pensum 			  	Objeto pensum a modificar.
		 *
		 * @throws Exception 					Si no se puede modificar el pensum.
		 */
	public static function modificarPensumObject($pensum){
		try{
			$conexion=Conexion::conectar();
			$consulta="select sis.f_pensum_actualizar(:codigo, :nombre, :nombreCorto, :observaciones, :min_can_elect, :min_cre_elect, :min_cre_obligat, :fec_creac)";
			$ejecutar=$conexion->prepare($consulta);
			// indica
			// como se indica en parametro y el tipo de parametro que se envia
			$ejecutar->bindParam(':codigo',$pensum->obtenerCodigo(), PDO::PARAM_INT);
			$ejecutar->bindParam(':nombre',$pensum->obtenerNombre(), PDO::PARAM_STR);
			$ejecutar->bindParam(':nombreCorto',$pensum->obtenerNombreCorto(), PDO::PARAM_STR);
			$ejecutar->bindParam(':observaciones',$pensum->obtenerObservaciones(), PDO::PARAM_STR);
			$ejecutar->bindParam(':min_can_elect',$pensum->obtenerMinCanElectiva(), PDO::PARAM_INT);
			$ejecutar->bindParam(':min_cre_elect',$pensum->obtenerMinCreElectiva(), PDO::PARAM_INT);
			$ejecutar->bindParam(':min_cre_obligat',$pensum->obtenerMinCreObligatorio(), PDO::PARAM_INT);
			var_dump($pensum->obtenerFechaCreacion());
			$ejecutar->bindParam(':fec_creac', $pensum->obtenerFechaCreacion() , PDO::PARAM_STR);

			$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
			//ejecuta
			$ejecutar->execute();
			//primera columana codigo
			$row = $ejecutar->fetchColumn(0);
			// recomendad null a este objeto
			unset($ejecutar);
			// PDO cierrar auntomaticamenta la seccion de db cuando el objeto es null
			unset($conexion);
			if ($row == 0)
				throw new Exception("No se puede modificar el pensum");
		}catch(Exception $e){
			throw $e;
		}
	}

	/**
		 * Función que permite modificar un pensum.
		 *
		 * Permite modificar un pensum a la base de datos.
		 *
		 * @param codigo $codigo 			  	variable pensum a modificar.
		 * @param nombre $nombre 			  	variable pensum a modificar.
		 * @param nomCorto $nomCorto 			  	variable pensum a modificar.
		 * @param direccion $direccion 			  	variable pensum a modificar.
		 * @param min_can_elect $min_can_elect 			  	variable pensum a modificar.
		 * @param min_cre_elect $min_cre_elect 			  	variable pensum a modificar.
		 * @param min_cre_obligat $min_cre_obligat 			  	variable pensum a modificar.
		 * @param fec_creac $fec_creac 			  	variable pensum a modificar.
		 *
		 * @throws Exception 					Si no se puede modificar el pensum.
		*/
		public static function modificarPensumParametro($codigo, $nombre, $nombreCorto, $observaciones, $min_can_elect, $min_cre_elect, $min_cre_obligat, $fec_creac){
			try{
				$conexion=Conexion::conectar();
				$consulta="select sis.f_pensum_actualizar(:codigo, :nombre, :nombreCorto, :observaciones, :min_can_elect, :min_cre_elect, :min_cre_obligat, :fec_creac)";
			    $ejecutar=$conexion->prepare($consulta);
				// indica
				// como se indica en parametro y el tipo de parametro que se envia
				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);
				$ejecutar->bindParam(':nombre',$nombre, PDO::PARAM_STR);
				$ejecutar->bindParam(':nombreCorto',$nombreCorto, PDO::PARAM_STR);
				$ejecutar->bindParam(':observaciones',$observaciones, PDO::PARAM_STR);
				$ejecutar->bindParam(':min_can_elect',$min_can_elect, PDO::PARAM_INT);
				$ejecutar->bindParam(':min_cre_elect',$min_cre_elect, PDO::PARAM_INT);
				$ejecutar->bindParam(':min_cre_obligat',$min_cre_obligat, PDO::PARAM_INT);
				$ejecutar->bindParam(':fec_creac', strtotime(date ("d-m-Y", $fec_creac)), PDO::PARAM_STR);
				$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
				//ejecuta
				$ejecutar->execute();
				//primera columana codigo
				$row = $ejecutar->fetchColumn(0);
				// recomendad null a este objeto
				unset($ejecutar);
				// PDO cierrar auntomaticamenta la seccion de db cuando el objeto es null
				unset($conexion);
				if ($row == 0)
					throw new Exception("No se puede modificar el pensum");

			}catch(Exception $e){
				throw $e;
			}
		}

		/**
		 * Función que permite eliminar un pensum.
		 *
		 * Permite eliminar un pensum a la base de datos.
		 *
		 * @param int $codigo 			  		Codigo pensum a eliminar.
		 *
		 * @throws Exception 					Si no se puede eliminar el pensum.
		 */
		public static function eliminar($codigo){
		try{
				$conexion=Conexion::conectar();
				$consulta="select sis.f_pensum_eliminar(:codigo)";
				$ejecutar=$conexion->prepare($consulta);
				// indica
				// como se indica en parametro y el tipo de parametro que se envia
				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);
				$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
				//ejecuta
				$ejecutar->execute();
				//primera columana codigo
				$row = $ejecutar->fetchColumn(0);
			//	var_dump($row);
				// recomendad null a este objeto
				unset($ejecutar);
				// PDO cierrar auntomaticamenta la seccion de db cuando el objeto es null
				unset($conexion);
				if ($row == 0)
					throw new Exception("No se puede eliminar el pensum");
			}catch(Exception $e){
				throw $e;
			}
		}


		/**
		 * Función que permite obtener un pensum.
		 *
		 * Permite obtener eun pensum de la base de datos.
		 *
		 * @return objet				Objeto pensum obtenido en la base de datos.
		 *
		 * @throws Exception 			si no existe el pensum.
		 *
		 */
		public static function obtener($codigo){
			try{
				$conexion=Conexion::conectar();
				$consulta= "select sis.f_pensum_por_codigo_seleccionar('pcursor',:codigo)";

				$ejecutar= $conexion->prepare($consulta);
				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);
				// inicia transaccion
				$conexion->beginTransaction();
				$ejecutar->execute();
				$cursors = $ejecutar->fetchAll();
				// cierra cursor
				$ejecutar->closeCursor();
				// array para almacenar resultado del cursor
				$results = array();
				// ejecutar otro query para leer el cursor
				$ejecutar = $conexion->query('FETCH ALL IN pcursor;');
				$results = $ejecutar->fetchAll();
				$ejecutar->closeCursor();
				// cierra cursor
				$conexion->commit();
				// recomendad null a este objeto
				unset($ejecutar);
				// PDO cierrar auntomaticamenta la seccion de db cuando el objeto es null
				unset($conexion);

				if(count($results) > 0)
					return $results;
				else
					return null;

			}catch (Exception $e ){
				throw $e;
			}
		}

		/**
		 * Función que permite obtener un pensum por filtro que pase.
		 *
		 * Permite obtener eun pensum de la base de datos.
		 *
		 * @return objet				Objeto pensum obtenido en la base de datos.
		 *
		 * @throws Exception 			si no existe el pensum.
		 *
		 */
		public static function ObtenerPensumInsituto($codigo){
			try{
				$conexion=Conexion::conectar();
				$consulta= "select sis.f_pensum_por_instituto_seleccionar('pcursor',:codigo)";

				$ejecutar= $conexion->prepare($consulta);
				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);
				// inicia transaccion
				$conexion->beginTransaction();
				$ejecutar->execute();
				$cursors = $ejecutar->fetchAll();
				// cierra cursor
				$ejecutar->closeCursor();
				// array para almacenar resultado del cursor
				$results = array();
				// ejecutar otro query para leer el cursor
				$ejecutar = $conexion->query('FETCH ALL IN pcursor;');
				$results = $ejecutar->fetchAll();
				$ejecutar->closeCursor();
				// cierra cursor
				$conexion->commit();
				// recomendad null a este objeto
				unset($ejecutar);
				// PDO cierrar auntomaticamenta la seccion de db cuando el objeto es null
				unset($conexion);

				if(count($results) > 0)
					return $results;
				else
					return null;

			}catch (Exception $e ){
				throw $e;
			}
		}

		/**
		 * Función que permite obtener un pensum por filtro que pase.
		 *
		 * Permite obtener eun pensum de la base de datos.
		 *
		 * @return objet				Objeto pensum obtenido en la base de datos.
		 *
		 * @throws Exception 			si no existe el pensum.
		 *
		 */
		public static function ObtenerPensumTrayecto($codigo){
			try{
				$conexion=Conexion::conectar();
				$consulta= "select sis.f_pensum_por_trayecto_seleccionar('pcursor',:codigo)";

				$ejecutar= $conexion->prepare($consulta);
				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);
				// inicia transaccion
				$conexion->beginTransaction();
				$ejecutar->execute();
				$cursors = $ejecutar->fetchAll();
				// cierra cursor
				$ejecutar->closeCursor();
				// array para almacenar resultado del cursor
				$results = array();
				// ejecutar otro query para leer el cursor
				$ejecutar = $conexion->query('FETCH ALL IN pcursor;');
				$results = $ejecutar->fetchAll();
				$ejecutar->closeCursor();
				// cierra cursor
				$conexion->commit();
				// recomendad null a este objeto
				unset($ejecutar);
				// PDO cierrar auntomaticamenta la seccion de db cuando el objeto es null
				unset($conexion);

				if(count($results) > 0){
					$tra['codigo'] = null;
					$tra['num_trayecto'] = "Generales del Pensum";

					$results[count($results)] = $tra;
					return $results;
				}
				else
					return null;

			}catch (Exception $e ){
				throw $e;
			}
		}

		public static function pensumConEstActivo ($codigo=null){
			try{

				$conexion = Conexion::conectar();
				$consulta = "select e.*, p.*, p.codigo as pensum_codigo
							 from sis.t_pensum p, sis.t_estudiante e
							 where e.cod_estado='A' and e.cod_pensum=p.codigo
								and e.cod_persona=?";


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

}
?>
