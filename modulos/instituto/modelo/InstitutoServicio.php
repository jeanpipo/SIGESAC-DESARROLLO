	<?php

/**
 * @copyright 2014 - Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio
 * @license GPLv3
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 *
 * InstitutoServicio.php - Servicio del módulo Instituto.
 *
 * Esta clase ofrece el servicio de conexión a la base de datos, recibe 
 * los parámetros, construye las consultas SQL, hace las peticiones a 
 * la base de datos y retorna los objetos o datos correspondientes a la
 * acción. en este archivo se contiene todo lo relacionado a instituto
 * es el archivo que permite la interacion la lo relacionado a instituto
 * en la base de datos.Todas las funciones de esta clase relanzan las excepciones si son capturadas.
 * Esto con el fin de que la clase manejadora de errores las capture y procese.
 *
 * @author Rafael Garcia (rafaelantoniorf@gmail.com)
 * @author Johan Alamo (lider de proyecto) <johan.alamo@gmail.com>
 *  clase InsitutoServicio 
 */

class InstitutoServicio {
	/**
		 * Función que permite listar todos los institutos.
		 * 
		 * Realiza la consulta a la base de datos llamando a store procedure (funcion en postgresSQL) sis.f_instituto_seleccionar() 
		 * utilizando tranasaccion la luego leer el cursor
		 * 		 * 
		 * @return array|null					Retorna un arreglo de arreglos asociativos o null de no encontrarse coincidencias.								
		 *
		 * @throws Exception 					Si se producen errores en operaciones con la base de datos.
		 */
		public static function listarInstitutos(){
		try{

			$conexion=Conexion::conectar();
			$consulta= "select sis.f_instituto_seleccionar('pcursor')";							
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
		 * Función que permite agregar un instituto.
		 * 
		 * Permite agrega un instituto a la base de datos.
		 * 
		 * @param objet $instituto 			  	Objeto instituto a agregar.
		 *
		 * @throws Exception 					Si no se puede agregar el instituto.
		 */
		public static function agregar($instituto){
		try{				
				$conexion=Conexion::conectar();
				$consulta="select sis.f_instituto_insertar(:nombreCorto, :nombre, :direccion)";								
				$ejecutar=$conexion->prepare($consulta);
				// indica
				// como se indica en parametro y el tipo de parametro que se envia
				$ejecutar->bindParam(':nombreCorto',$instituto->obtenerNombreCorto(), PDO::PARAM_STR);
				$ejecutar->bindParam(':nombre',$instituto->obtenerNombre(), PDO::PARAM_STR);
				$ejecutar->bindParam(':direccion',$instituto->obtenerDireccion(), PDO::PARAM_STR);
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
		 * Función que permite agregar un instituto.
		 * 
		 * Permite agrega un instituto a la base de datos.
		 * 
		 * @param nombre $nombre 			  	variable instituto a agregar.
		 * @param nomCorto $nomCorto 			  	Objeto instituto a agregar.
		 * @param direccion $direccion 			  	Objeto instituto a agregar.
		 *
		 * @throws Exception 					Si no se puede agregar el instituto.
		*/
		public static function agregarInstituto($nombre,$nomCorto,$direccion){
		try{
				$conexion=Conexion::conectar();
				$consulta="select sis.f_instituto_insertar(:nombreCorto, :nombre, :direccion)";								
				$ejecutar=$conexion->prepare($consulta);
				// indica
				// como se indica en parametro y el tipo de parametro que se envia
				$ejecutar->bindParam(':nombreCorto',$nomCorto, PDO::PARAM_STR);
				$ejecutar->bindParam(':nombre',$nombre, PDO::PARAM_STR);
				$ejecutar->bindParam(':direccion',$direccion, PDO::PARAM_STR);
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
		 * Función que permite modificar un instituto.
		 * 
		 * Permite modificar un instituto a la base de datos.
		 * 
		 * @param objet $instituto 			  	Objeto instituto a modificar.
		 *
		 * @throws Exception 					Si no se puede modificar el instituto.
		 */
		public static function modificar($instituto){
		try{

		//		echo " modificar .....";
				$conexion=Conexion::conectar();
				$consulta="select sis.f_instituto_actualizar(:codigo,:nombreCorto, :nombre, :direccion)";								
				$ejecutar=$conexion->prepare($consulta);
				// indica
		//		echo "<br> codigo :"+$instituto->obtenerCodigo();
		//		echo " codigo :"+$instituto->obtenerNombreCorto();
		//		echo " codigo :"+$instituto->obtenerNombre();
		//		echo " codigo :"+$instituto->obtenerDireccion();
				// como se indica en parametro y el tipo de parametro que se envia
				$ejecutar->bindParam(':codigo',$instituto->obtenerCodigo(), PDO::PARAM_STR);
				$ejecutar->bindParam(':nombreCorto',$instituto->obtenerNombreCorto(), PDO::PARAM_STR);
				$ejecutar->bindParam(':nombre',$instituto->obtenerNombre(), PDO::PARAM_STR);
				$ejecutar->bindParam(':direccion',$instituto->obtenerDireccion(), PDO::PARAM_STR);
				$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
				//ejecuta				
				$ejecutar->execute();
				//primera columana codigo
				$row = $ejecutar->fetchColumn(0);			

		//		var_dump(" prueba :::: "+$row)		;
		//		echo ".:::::ASdasdasassad";
				// recomendad null a este objeto						
				unset($ejecutar);
				// PDO cierrar auntomaticamenta la seccion de db cuando el objeto es null
				unset($conexion);
				if ($row == 0)
					throw new Exception("No se puede modificar el instituto");	
			}catch(Exception $e){
				throw $e;
			}	 
		}
		
		/**
		 * Función que permite modificar un instituto.
		 * 
		 * Permite modificar un instituto a la base de datos.
		 * 
		 * @param objet $codigo 			  	Objeto instituto a modificar.
		 * @param objet $nombreCorto 			Objeto instituto a modificar.
		 * @param objet $nombre 			  	Objeto instituto a modificar.
		 * @param objet $direccion 			  	Objeto instituto a modificar.
		 *
		 * @throws Exception 					Si no se puede modificar el instituto.
		 */
		public static function modificarInstituto($codigo, $nombreCorto, $nombre, $direccion){
		try{
				$conexion=Conexion::conectar();
				$consulta="select sis.f_instituto_actualizar(:codigo, :nombreCorto, :nombre, :direccion)";								
				$ejecutar=$conexion->prepare($consulta);
				// indica
				// como se indica en parametro y el tipo de parametro que se envia
				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);
				$ejecutar->bindParam(':nombreCorto',$nombreCorto, PDO::PARAM_STR);
				$ejecutar->bindParam(':nombre',$nombre, PDO::PARAM_STR);
				$ejecutar->bindParam(':direccion',$direccion, PDO::PARAM_STR);
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
					throw new Exception("No se puede modificar el instituto");	
			}catch(Exception $e){
				throw $e;
			} 
		}

		/**
		 * Función que permite eliminar un instituto.
		 * 
		 * Permite eliminar un instituto a la base de datos.
		 * 
		 * @param int $codigo 			  		Codigo instituto a eliminar.
		 *
		 * @throws Exception 					Si no se puede eliminar el instituto.
		 */
		public static function eliminar($codigo){
		try{
				$conexion=Conexion::conectar();
				$consulta="select sis.f_instituto_eliminar(:codigo)";								
				$ejecutar=$conexion->prepare($consulta);
				// indica
				// como se indica en parametro y el tipo de parametro que se envia
				$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_INT);				
				$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
				//ejecuta				
				$ejecutar->execute();
				//primera columana codigo
				$row = $ejecutar->fetchColumn(0);					
				//var_dump($row);
				// recomendad null a este objeto	
				unset($ejecutar);
				// PDO cierrar auntomaticamenta la seccion de db cuando el objeto es null
				unset($conexion);
				if ($row == 0)
					throw new Exception("No se puede eliminar el instituto");	
			}catch(Exception $e){
				throw $e;
			}
		}
		
	
		/**
		 * Función que permite obtener un instituto.
		 * 
		 * Permite obtener eun instituto de la base de datos.
		 * 
		 * @return objet				Objeto istituto obtenido en la base de datos.
		 * 
		 * @throws Exception 			si no existe el instituto.
		 * 
		 */
		public static function obtener($codigo){
			try{
				$conexion=Conexion::conectar();				
				$consulta= "select sis.f_instituto_seleccionar_por_codigo('pcursor',:codigo)";
							
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

