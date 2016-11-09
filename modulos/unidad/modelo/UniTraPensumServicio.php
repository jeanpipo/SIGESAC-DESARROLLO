<?php

/**
 * @copyright 2014 - Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio
 * @license GPLv3
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 *
 * UniTraPensumServicio.php - Servicio del módulo UniTraPensum.
 *
 * Esta clase ofrece el servicio de conexión a la base de datos, recibe 
 * los parámetros, construye las consultas SQL, hace las peticiones a 
 * la base de datos y retorna los objetos o datos correspondientes a la
 * acción. en este archivo se contiene todo lo relacionado a UniTraPensum
 * es el archivo que permite la interacion la lo relacionado a UniTraPensum
 * en la base de datos.Todas las funciones de esta clase relanzan las excepciones si son capturadas.
 * Esto con el fin de que la clase manejadora de errores las capture y procese.
 *
 * @author Rafael Garcia (rafaelantoniorf@gmail.com)
 * @author Johan Alamo (lider de proyecto) <johan.alamo@gmail.com>
 *  clase TrayectoServicio 
 */




class UniTraPensumServicio
{


	/**
	 * Función que permite agregar un UniTraPen.
	 * 
	 * Permite agrega un UniTraPen a la base de datos.
	 * 
	 * @param objet $UniTraPen 			  	Objeto UniTraPen a agregar.
	 *
	 * @throws Exception 					Si no se puede agregar el UniTraPen.
	 */	
	public static function agregarUniTraPenObjetc($codigoPen,$trayecto,$unidad,$tipo){
			//var_dump($trayecto);
			//var_dump($tipo);
		try{
			$conexion=Conexion::conectar();
			$consulta="select sis.f_uni_tra_pensu_insertar(:cod_pensum, :cod_trayecto, :cod_uni_curricular, :tipo)";								
			$ejecutar=$conexion->prepare($consulta);
			// indica
			// como se indica en parametro y el tipo de parametro que se envia 			
			$ejecutar->bindParam(':cod_pensum',$codigoPen, PDO::PARAM_INT);
			$ejecutar->bindParam(':cod_trayecto',$trayecto, PDO::PARAM_INT);
			$ejecutar->bindParam(':cod_uni_curricular',$unidad, PDO::PARAM_INT);
			$ejecutar->bindParam(':tipo', $tipo , PDO::PARAM_STR);
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
		 * Función que permite modificar un UniTraPen.
		 * 
		 * Permite modificar un UniTraPen a la base de datos.
		 * 
		 * @param codigo $codigo 			  	variable UniTraPen a modificar.
		 * @param nombre $nombre 			  	variable UniTraPen a modificar.
		 * @param nomCorto $nomCorto 			  	variable UniTraPen a modificar.
		 * @param direccion $direccion 			  	variable UniTraPen a modificar.
		 * @param min_can_elect $min_can_elect 			  	variable UniTraPen a modificar.
		 * @param min_cre_elect $min_cre_elect 			  	variable UniTraPen a modificar.
		 * @param min_cre_obligat $min_cre_obligat 			  	variable UniTraPen a modificar.
		 * @param fec_creac $fec_creac 			  	variable UniTraPen a modificar.
		 *
		 * @throws Exception 					Si no se puede modificar el UniTraPen.
		*/
		public static function modificarPrelacionParametro($codigo, $codPensum, $codInstituto, $codUniCurricular, $codUniCurPrelada){
			try{
				$conexion=Conexion::conectar();
				$consulta="select sis.f_uni_tra_pensu_actualizar(:codigo, :cod_pensum, :cod_instituto, :cod_uni_curricular, :cod_uni_cur_prelada)";
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
				$consulta="select sis.f_uni_tra_pensu_eliminar(:codigo)";								
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
				$consulta= "select sis.f_uni_tra_pensu_por_codigo_seleccionar('pcursor',:codigo)";
							
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




}
?>
