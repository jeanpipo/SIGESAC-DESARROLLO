<?php


/**
 * @copyright 2014 - Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio
 * @license GPLv3
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 *
 * PrelacionServicio.php - Servicio del módulo prelacion.
 *
 * Esta clase ofrece el servicio de conexión a la base de datos, recibe 
 * los parámetros, construye las consultas SQL, hace las peticiones a 
 * la base de datos y retorna los objetos o datos correspondientes a la
 * acción. en este archivo se contiene todo lo relacionado a prelacion
 * es el archivo que permite la interacion la lo relacionado a prelacion
 * en la base de datos.Todas las funciones de esta clase relanzan las excepciones si son capturadas.
 * Esto con el fin de que la clase manejadora de errores las capture y procese.
 *
 * @author Rafael Garcia (rafaelantoniorf@gmail.com)
 * @author Johan Alamo (lider de proyecto) <johan.alamo@gmail.com>
 *  
 */


class PrelacionServicio
{

	

	/**
		 * Función que permite agregar un prelacion.
		 * 
		 * Permite agrega un prelacion a la base de datos.
		 * 
		 * @param objet $prelacion 			  	Objeto prelacion a agregar.
		 *
		 * @throws Exception 					Si no se puede agregar el prelacion.
		 */	
		public static function agregarPrelacionObjetc($prelacion){
		try{
			$conexion=Conexion::conectar();
			$consulta="select sis.f_prelacion_insertar(:cod_pensum, :cod_instituto, :cod_uni_curricular, :cod_uni_cur_prelada)";								
			$ejecutar=$conexion->prepare($consulta);
			// indica
			// como se indica en parametro y el tipo de parametro que se envia 			
			$ejecutar->bindParam(':cod_pensum',$prelacion->obtenerCodigoPesum(), PDO::PARAM_INT);
			$ejecutar->bindParam(':cod_instituto',$prelacion->obtenerCodigoInstituto(), PDO::PARAM_INT);
			$ejecutar->bindParam(':cod_uni_curricular',$prelacion->obtenerCodigoUniCurricular(), PDO::PARAM_INT);
			$ejecutar->bindParam(':cod_uni_cur_prelada',$prelacion->obtenerCodigoUniCurPrelada(), PDO::PARAM_INT);
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
		 * Función que permite agregar un prelacion.
		 * 
		 * Permite agrega un prelacion a la base de datos.
		 * 
		 * @param nombre $codPensum 			  	variable prelacion a agregar.
		 * @param nomCorto $codInstituto 			  	variable prelacion a agregar.
		 * @param direccion $codUniCurricular 			  	variable prelacion a agregar.
		 * @param min_can_elect $codUniCurPrelada 			  	variable prelacion a agregar.	
		 *
		 * @throws Exception 					Si no se puede agregar el prelacion.
		*/
	public static function agregarPrelacionParametro($codPensum, $codInstituto, $codUniCurricular, $codUniCurPrelada){
		try{
			$conexion=Conexion::conectar();
			$consulta="select sis.f_instituto_insertar(:cod_pensum, :cod_instituto, :cod_uni_curricular, :cod_uni_cur_prelada)";
			$ejecutar=$conexion->prepare($consulta);
			// indica
			// como se indica en parametro y el tipo de parametro que se envia
			$ejecutar->bindParam(':cod_pensum',$codPensum, PDO::PARAM_INT);
			$ejecutar->bindParam(':cod_instituto',$codInstituto, PDO::PARAM_INT);
			$ejecutar->bindParam(':cod_uni_curricular',$codUniCurricular, PDO::PARAM_INT);
			$ejecutar->bindParam(':cod_uni_cur_prelada',$codUniCurPrelada, PDO::PARAM_INT);
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
		 * Función que permite modificar un prelacion.
		 * 
		 * Permite modificar un prelacion a la base de datos.
		 * 
		 * @param objet $prelacion 			  	Objeto prelacion a modificar.
		 *
		 * @throws Exception 					Si no se puede modificar el prelacion.
		 */
	public static function modificarPrelacionObject($prelacion){
		try{
			$conexion=Conexion::conectar();
			$consulta="select sis.f_prelacion_actualizar(:codigo, :cod_pensum, :cod_instituto, :cod_uni_curricular, :cod_uni_cur_prelada)";
			$ejecutar=$conexion->prepare($consulta);
			// indica
			// como se indica en parametro y el tipo de parametro que se envia
			$ejecutar->bindParam(':codigo',$prelacion->obtenerCodigo(), PDO::PARAM_INT);
			$ejecutar->bindParam(':cod_pensum',$codPensum, PDO::PARAM_INT);
			$ejecutar->bindParam(':cod_instituto',$codInstituto, PDO::PARAM_INT);
			$ejecutar->bindParam(':cod_uni_curricular',$codUniCurricular, PDO::PARAM_INT);
			$ejecutar->bindParam(':cod_uni_cur_prelada',$codUniCurPrelada, PDO::PARAM_INT);
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
				throw new Exception("No se puede modificar la prelacion");	
		}catch(Exception $e){
			throw $e;
		}	 
	}

	/**
		 * Función que permite modificar un prelacion.
		 * 
		 * Permite modificar un prelacion a la base de datos.
		 * 
		 * @param codigo $codigo 			  	variable prelacion a modificar.
		 * @param nombre $codPensum 			  	variable prelacion a agregar.
		 * @param nomCorto $codInstituto 			  	variable prelacion a agregar.
		 * @param direccion $codUniCurricular 			  	variable prelacion a agregar.
		 * @param min_can_elect $codUniCurPrelada 			  	variable prelacion a agregar.	
		 *
		 * @throws Exception 					Si no se puede modificar el prelacion.
		*/
		public static function modificarPrelacionParametro($codigo, $codPensum, $codInstituto, $codUniCurricular, $codUniCurPrelada){
			try{
				$conexion=Conexion::conectar();
				$consulta="select sis.f_prelacion_actualizar(:codigo, :cod_pensum, :cod_instituto, :cod_uni_curricular, :cod_uni_cur_prelada)";
			    $ejecutar=$conexion->prepare($consulta);
				// indica
				// como se indica en parametro y el tipo de parametro que se envia
				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);
		    	$ejecutar->bindParam(':cod_pensum',$codPensum, PDO::PARAM_INT);
				$ejecutar->bindParam(':cod_instituto',$codInstituto, PDO::PARAM_INT);
				$ejecutar->bindParam(':cod_uni_curricular',$codUniCurricular, PDO::PARAM_INT);
				$ejecutar->bindParam(':cod_uni_cur_prelada',$codUniCurPrelada, PDO::PARAM_INT);
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
					throw new Exception("No se puede modificar el prelacion");	

			}catch(Exception $e){
				throw $e;
			}	 
		}	

		/**
		 * Función que permite eliminar un prelacion.
		 * 
		 * Permite eliminar un prelacion a la base de datos.
		 * 
		 * @param int $codigo 			  		Codigo prelacion a eliminar.
		 *
		 * @throws Exception 					Si no se puede eliminar el prelacion.
		 */
		public static function eliminar($codigo){
		try{
				$conexion=Conexion::conectar();
				$consulta="select sis.f_prelacion_eliminar(:codigo)";								
				$ejecutar=$conexion->prepare($consulta);
				// indica
				// como se indica en parametro y el tipo de parametro que se envia
				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);				
				$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
				//ejecuta				
				$ejecutar->execute();
				//primera columana codigo
				$row = $ejecutar->fetchColumn(0);					
				var_dump($row);
				// recomendad null a este objeto	
				unset($ejecutar);
				// PDO cierrar auntomaticamenta la seccion de db cuando el objeto es null
				unset($conexion);
				if ($row == 0)
					throw new Exception("No se puede eliminar la prelacion");	
			}catch(Exception $e){
				throw $e;
			}
		}
		

		/**
		 * Función que permite obtener un prelacion.
		 * 
		 * Permite obtener eun prelacion de la base de datos.
		 * 
		 * @return objet				Objeto istituto obtenido en la base de datos.
		 * 
		 * @throws Exception 			si no existe el prelacion.
		 * 
		 */
		public static function obtener($codigo){
			try{
				$conexion=Conexion::conectar();				
				$consulta= "select sis.f_prelacion_por_codigo_seleccionar('pcursor',:codigo)";
							
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
		 * Función que permite obtener un prelacion.
		 * 
		 * Permite obtener eun prelacion de la base de datos.
		 * 
		 * @return objet				Objeto istituto obtenido en la base de datos.
		 * 
		 * @throws Exception 			si no existe el prelacion.
		 * 
		 */
		public static function obtenerPorRequerido($codigoPensum,$codigo){
			try{
				$conexion=Conexion::conectar();				
				$consulta= "select sis.f_prelacion_por_requeridas('pcursor',:codigoPensum, :codigo)";
							
				$ejecutar= $conexion->prepare($consulta);
				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);	
				$ejecutar->bindParam(':codigoPensum',$codigoPensum, PDO::PARAM_INT);
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
		 * Función que permite obtener un prelacion.
		 * 
		 * Permite obtener eun prelacion de la base de datos.
		 * 
		 * @return objet				Objeto istituto obtenido en la base de datos.
		 * 
		 * @throws Exception 			si no existe el prelacion.
		 * 
		 */
		public static function obtenerPorRequisito($codigoPensum,$codigo){
			try{
				$conexion=Conexion::conectar();				
				$consulta= "select sis.f_prelacion_por_requisito('pcursor',:codigoPensum, :codigo)";
							
				$ejecutar= $conexion->prepare($consulta);
				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);	
				$ejecutar->bindParam(':codigoPensum',$codigoPensum, PDO::PARAM_INT);
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

}
?>
