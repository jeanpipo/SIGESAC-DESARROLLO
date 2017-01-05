<?php


/**
 * @copyright 2014 - Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio
 * @license GPLv3
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 *
 * TrayectoServicio.php - Servicio del módulo Trayecto.
 *
 * Esta clase ofrece el servicio de conexión a la base de datos, recibe
 * los parámetros, construye las consultas SQL, hace las peticiones a
 * la base de datos y retorna los objetos o datos correspondientes a la
 * acción. en este archivo se contiene todo lo relacionado a Trayecto
 * es el archivo que permite la interacion la lo relacionado a Trayecto
 * en la base de datos.Todas las funciones de esta clase relanzan las excepciones si son capturadas.
 * Esto con el fin de que la clase manejadora de errores las capture y procese.
 *
 * @author Rafael Garcia (rafaelantoniorf@gmail.com)
 * @author Johan Alamo (lider de proyecto) <johan.alamo@gmail.com>
 *  clase TrayectoServicio
 */

//require_once "negocio/Pensum.php";
//require_once "negocio/Trayecto.php";

class TrayectoServicio
{


/**
		 * Función que permite listar todos los Trayecto.
		 *
		 * Realiza la consulta a la base de datos llamando a store procedure (funcion en postgresSQL) sis.f_Trayecto_seleccionar()
		 * utilizando tranasaccion la luego leer el cursor
		 * 		 *
		 * @return array|null					Retorna un arreglo de arreglos asociativos o null de no encontrarse coincidencias.
		 *
		 * @throws Exception 					Si se producen errores en operaciones con la base de datos.
		 */
	public static function listarTrayectos(){
		try{

			$conexion=Conexion::conectar();
			$consulta= "select sis.f_trayecto_seleccionar('pcursor')";
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
		 * Función que permite agregar un trayecto.
		 *
		 * Permite agrega un trayecto a la base de datos.
		 *
		 * @param objet $trayecto 			  	Objeto trayecto a agregar.
		 *
		 * @throws Exception 					Si no se puede agregar el trayecto.
		 */
	public static function agregarTrayectoObjetc($trayecto){
		try{
			$conexion=Conexion::conectar();
			$consulta="select sis.f_trayecto_insertar(:cod_pensum, :num_trayecto, :certificado, :min_cre_obligatoria, :min_cre_electiva, :min_cre_acreditable, :min_can_electiva)";
			$ejecutar=$conexion->prepare($consulta);
			// indica
			// como se indica en parametro y el tipo de parametro que se envia
			$ejecutar->bindParam(':cod_pensum',$trayecto->obtenerCodPensum(), PDO::PARAM_INT);
			$ejecutar->bindParam(':num_trayecto',$trayecto->obtenerNumero(), PDO::PARAM_INT);
			$ejecutar->bindParam(':certificado',$trayecto->obtenerCertificado(), PDO::PARAM_STR);
			$ejecutar->bindParam(':min_cre_obligatoria',$trayecto->obtnerMinCreObligatorio(), PDO::PARAM_INT);
			$ejecutar->bindParam(':min_cre_electiva',$trayecto->obtenerMinCreElectiva(), PDO::PARAM_INT);
			$ejecutar->bindParam(':min_cre_acreditable',$trayecto->obtenerminCreAcreditable(), PDO::PARAM_INT);
			$ejecutar->bindParam(':min_can_electiva',$trayecto->obtenerMinCanElectiva(), PDO::PARAM_INT);
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
		 * Función que permite agregar un trayecto.
		 *
		 * Permite agrega un trayecto a la base de datos.
		 *
		 * @param cod_pensum $cod_pensum 			  	variable trayecto a agregar.
		 * @param num_trayecto $num_trayecto 			  	variable trayecto a agregar.
		 * @param certificado $certificado 			  	variable trayecto a agregar.
		 * @param min_cre_obligatoria $min_cre_obligatoria 			  	variable trayecto a agregar.
		 * @param min_cre_electiva $min_cre_electiva 			  	variable trayecto a agregar.
		 * @param min_cre_acreditable $min_cre_acreditable 			  	variable trayecto a agregar.
		 * @param min_can_electiva $min_can_electiva 			  	variable trayecto a agregar.
		 *
		 * @throws Exception 					Si no se puede agregar el trayecto.
		*/
		public static function agregarTrayectoParametro($cod_pensum, $num_trayecto, $certificado, $min_cre_obligatoria, $min_cre_electiva, $min_cre_acreditable, $min_can_electiva){
		try{
			$conexion=Conexion::conectar();
			$consulta="select sis.f_trayecto_insertar(:cod_pensum, :num_trayecto, :certificado, :min_cre_obligatoria, :min_cre_electiva, :min_cre_acreditable, :min_can_electiva)";
			$ejecutar=$conexion->prepare($consulta);
			// indica
			// como se indica en parametro y el tipo de parametro que se envia
			$ejecutar->bindParam(':cod_pensum',$cod_pensum, PDO::PARAM_INT);
			$ejecutar->bindParam(':num_trayecto',$num_trayecto, PDO::PARAM_INT);
			$ejecutar->bindParam(':certificado',$certificado, PDO::PARAM_STR);
			$ejecutar->bindParam(':min_cre_obligatoria',$min_cre_obligatoria, PDO::PARAM_INT);
			$ejecutar->bindParam(':min_cre_electiva',$min_cre_electiva, PDO::PARAM_INT);
			$ejecutar->bindParam(':min_cre_acreditable',$min_cre_acreditable, PDO::PARAM_INT);
			$ejecutar->bindParam(':min_can_electiva',$min_can_electiva, PDO::PARAM_INT);
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
		 * Función que permite modificar un trayecto.
		 *
		 * Permite modificar un trayecto a la base de datos.
		 *
		 * @param objet $trayecto 			  	Objeto trayecto a modificar.
		 *
		 * @throws Exception 					Si no se puede modificar el trayecto.
		 */
		public static function modificarTrayectoObject($trayecto){
			try{

				$conexion=Conexion::conectar();
				$consulta="select sis.f_trayecto_actualizar(:codigo, :cod_pensum, :num_trayecto, :certificado, :min_cre_obligatoria, :min_cre_electiva, :min_cre_acreditable, :min_can_electiva)";
				$ejecutar=$conexion->prepare($consulta);
				// indica
				// como se indica en parametro y el tipo de parametro que se envia
				$ejecutar->bindParam(':codigo',$trayecto->obtenerCodigo(), PDO::PARAM_INT);
				$ejecutar->bindParam(':cod_pensum',$trayecto->obtenerCodPensum(), PDO::PARAM_INT);
				$ejecutar->bindParam(':num_trayecto',$trayecto->obtenerNumero(), PDO::PARAM_INT);
				$ejecutar->bindParam(':certificado',$trayecto->obtenerCertificado(), PDO::PARAM_STR);
				$ejecutar->bindParam(':min_cre_obligatoria',$trayecto->obtnerMinCreObligatorio(), PDO::PARAM_INT);
				$ejecutar->bindParam(':min_cre_electiva',$trayecto->obtenerMinCreElectiva(), PDO::PARAM_INT);
				$ejecutar->bindParam(':min_cre_acreditable',$trayecto->obtenerminCreAcreditable(), PDO::PARAM_INT);
				$ejecutar->bindParam(':min_can_electiva',$trayecto->obtenerMinCanElectiva(), PDO::PARAM_INT);
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
					throw new Exception("No se puede modificar el trayecto");
			}catch(Exception $e){
				throw $e;
			}
		}


		/**
		 * Función que permite eliminar un trayecto.
		 *
		 * Permite eliminar un trayecto a la base de datos.
		 *
		 * @param int $codigo 			  		Codigo trayecto a eliminar.
		 *
		 * @throws Exception 					Si no se puede eliminar el trayecto.
		 */
		public static function eliminar($codigo){
		try{
				$conexion=Conexion::conectar();
				$consulta="select sis.f_trayecto_eliminar(:codigo)";
				$ejecutar=$conexion->prepare($consulta);
				// indica
				// como se indica en parametro y el tipo de parametro que se envia
				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);
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
					throw new Exception("No se puede eliminar el trayecto");
			}catch(Exception $e){
				throw $e;
			}
		}

    	/**
		 * Función que permite obtener un trayecto.
		 *
		 * Permite obtener eun trayecto de la base de datos.
		 *
		 * @param int $codigo				Objeto trayecto obtenido en la base de datos.
		 *
		 * @throws Exception 			si no existe el trayecto.
		 *
		 */
		public static function obtener($codigo){
			try{
				$conexion=Conexion::conectar();
				$consulta= "select sis.f_trayecto_por_codigo_seleccionar('pcursor',:codigo)";

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
		 * Función que permite obtener un trayecto por patron.
		 *
		 * Permite obtener eun trayecto de la base de datos.
		 *
		 * @param int $codigo				Objeto trayecto obtenido en la base de datos.
		 *
		 * @throws Exception 			si no existe el trayecto.
		 *
		 */
		public static function obtenerPorPatron($codigo,$patron){
			try{
				$conexion=Conexion::conectar();
				$consulta= "select sis.f_trayecto_por_patron_seleccionar('pcursor', :codigo, :patron)";

				$ejecutar= $conexion->prepare($consulta);
				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);
				$ejecutar->bindParam(':patron',$patron, PDO::PARAM_STR);
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

		public static function obtenerTrayectoPensum($codigo=null){
			try{

				$conexion = Conexion::conectar();
				$consulta = "select * from sis.t_trayecto where cod_pensum=?";
				$ejecutar=$conexion->prepare($consulta);

				$ejecutar-> execute(array($codigo));

				if($ejecutar->rowCount() != 0){
					$ejecutar = $ejecutar->fetchAll();
					$tra['codigo'] = '';
					$tra['num_trayecto'] = "Generales del Pensum";
					$ejecutar[count($ejecutar)] = $tra;
					return $ejecutar;
				}
				else
					return null;
			}
			catch(Exception $e){
				throw $e;
			}
		}


}
?>
