

<?php

/**
 * @copyright 2014 - Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio
 * @license GPLv3
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 *
 * TrayectoServicio.php - Servicio del módulo UnidadCurricular.
 *
 * Esta clase ofrece el servicio de conexión a la base de datos, recibe 
 * los parámetros, construye las consultas SQL, hace las peticiones a 
 * la base de datos y retorna los objetos o datos correspondientes a la
 * acción. en este archivo se contiene todo lo relacionado a UnidadCurricular
 * es el archivo que permite la interacion la lo relacionado a UnidadCurricular
 * en la base de datos.Todas las funciones de esta clase relanzan las excepciones si son capturadas.
 * Esto con el fin de que la clase manejadora de errores las capture y procese.
 *
 * @author Rafael Garcia (rafaelantoniorf@gmail.com)
 * @author Johan Alamo (lider de proyecto) <johan.alamo@gmail.com>
 *  clase TrayectoServicio 
 */

/*
require_once "negocio/Pensum.php";
require_once "negocio/Trayecto.php";
require_once "negocio/UniCurricular.php";

*/
class UnidadServicio
{

	/**
		 * Función que permite listar todos los UnidadCurricular.
		 * 
		 * Realiza la consulta a la base de datos llamando a store procedure (funcion en postgresSQL) 
		 * utilizando tranasaccion la luego leer el cursor
		 * 		 * 
		 * @return array|null					Retorna un arreglo de arreglos asociativos o null de no encontrarse coincidencias.								
		 *
		 * @throws Exception 					Si se producen errores en operaciones con la base de datos.
		 */

	public static function listarUniCurricular(){
		try{

			$conexion=Conexion::conectar();
			$consulta= "select sis.f_unicurricular_seleccionar('pcursor')";							
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
		 * Función que permite agregar un UnidadCurricular.
		 * 
		 * Permite agrega un UnidadCurricular a la base de datos.
		 * 
		 * @param objet $UnidadCurricular 			  	Objeto UnidadCurricular a agregar.
		 *
		 * @throws Exception 					Si no se puede agregar el UnidadCurricular.
		 */	


	public static function agregarUniCurricularObjetc($UnidadCurricular){
		try{
			$conexion=Conexion::conectar();
			$consulta="select sis.f_unicurricular_insertar(:v_cod_uni_ministerio, :v_nombre, :v_hta, :v_hti, :v_uni_credito, :v_dur_semanas, :v_not_min_aprobatoria, :v_not_maxima, :v_descripcion, :v_observacion, :v_contenido)";
			$ejecutar=$conexion->prepare($consulta);
			// indica
			// como se indica en parametro y el tipo de parametro que se envia 			
			$ejecutar->bindParam(':v_cod_uni_ministerio',$UnidadCurricular->obtenerCodUniMinisterio(), PDO::PARAM_STR);
			$ejecutar->bindParam(':v_nombre',$UnidadCurricular->obtenerNombre(), PDO::PARAM_STR);
			$ejecutar->bindParam(':v_hta',$UnidadCurricular->obtenerHta(), PDO::PARAM_INT);
			$ejecutar->bindParam(':v_hti',$UnidadCurricular->obtenerHti(), PDO::PARAM_INT);
			$ejecutar->bindParam(':v_uni_credito',$UnidadCurricular->obtenerUniCredito(), PDO::PARAM_INT);
			$ejecutar->bindParam(':v_dur_semanas',$UnidadCurricular->obtenerDurSemana(), PDO::PARAM_INT);
			$ejecutar->bindParam(':v_not_min_aprobatoria',$UnidadCurricular->obtenerNotMinAprobatoria(), PDO::PARAM_INT);
			$ejecutar->bindParam(':v_not_maxima',$UnidadCurricular->obtenerNotMaxima(), PDO::PARAM_INT);
			$ejecutar->bindParam(':v_descripcion',$UnidadCurricular->obtenerDescripcion(), PDO::PARAM_STR);
			$ejecutar->bindParam(':v_observacion',$UnidadCurricular->obtenerObservacion(), PDO::PARAM_STR);
			$ejecutar->bindParam(':v_contenido',$UnidadCurricular->obtenerContenido(), PDO::PARAM_STR);
		
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
		 * Función que permite modificar un UnidadCurricular.
		 * 
		 * Permite modificar un UnidadCurricular a la base de datos.
		 * 
		 * @param objet $UnidadCurricular 			  	Objeto UnidadCurricular a modificar.
		 *
		 * @throws Exception 					Si no se puede modificar el UnidadCurricular.
		 */
	public static function modificarUniCurricularObject($UnidadCurricular){
		try{
			$conexion=Conexion::conectar();
			$consulta="select sis.f_unicurricular_actualizar(:codigo, :v_cod_uni_ministerio, :v_nombre, :v_hta, :v_hti, :v_uni_credito, :v_dur_semanas, :v_not_min_aprobatoria, :v_not_maxima, :v_descripcion, :v_observacion, :v_contenido)";
			$ejecutar=$conexion->prepare($consulta);
			// indica
			// como se indica en parametro y el tipo de parametro que se envia
			$ejecutar->bindParam(':codigo',$UnidadCurricular->obtenerCodigo(), PDO::PARAM_INT);
			$ejecutar->bindParam(':v_cod_uni_ministerio',$UnidadCurricular->obtenerCodUniMinisterio(), PDO::PARAM_STR);
			$ejecutar->bindParam(':v_nombre',$UnidadCurricular->obtenerNombre(), PDO::PARAM_STR);
			$ejecutar->bindParam(':v_hta',$UnidadCurricular->obtenerHta(), PDO::PARAM_INT);
			$ejecutar->bindParam(':v_hti',$UnidadCurricular->obtenerHti(), PDO::PARAM_INT);
			$ejecutar->bindParam(':v_uni_credito',$UnidadCurricular->obtenerUniCredito(), PDO::PARAM_INT);
			$ejecutar->bindParam(':v_dur_semanas',$UnidadCurricular->obtenerDurSemana(), PDO::PARAM_INT);
			$ejecutar->bindParam(':v_not_min_aprobatoria',$UnidadCurricular->obtenerNotMinAprobatoria(), PDO::PARAM_INT);
			$ejecutar->bindParam(':v_not_maxima',$UnidadCurricular->obtenerNotMaxima(), PDO::PARAM_INT);
			$ejecutar->bindParam(':v_descripcion',$UnidadCurricular->obtenerDescripcion(), PDO::PARAM_STR);
			$ejecutar->bindParam(':v_observacion',$UnidadCurricular->obtenerObservacion(), PDO::PARAM_STR);
			$ejecutar->bindParam(':v_contenido',$UnidadCurricular->obtenerContenido(), PDO::PARAM_STR);
		
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
				throw new Exception("No se puede modificar el UnidadCurricular");	
		}catch(Exception $e){
			throw $e;
		}	 
	}


	/**
		 * Función que permite eliminar un UnidadCurricular.
		 * 
		 * Permite eliminar un UnidadCurricular a la base de datos.
		 * 
		 * @param int $codigo 			  		Codigo UnidadCurricular a eliminar.
		 *
		 * @throws Exception 					Si no se puede eliminar el UnidadCurricular.
		 */
		public static function eliminar($codigo){
		try{
				$conexion=Conexion::conectar();
				$consulta="select sis.f_unicurricular_eliminar(:codigo)";								
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
					throw new Exception("No se puede eliminar el UnidadCurricular");	
			}catch(Exception $e){
				throw $e;
			}
		}
		


/**
		 * Función que permite obtener un UnidadCurricular.
		 * 
		 * Permite obtener eun UnidadCurricular de la base de datos.
		 * 
		 * @return objet				Objeto istituto obtenido en la base de datos.
		 * 
		 * @throws Exception 			si no existe el UnidadCurricular.
		 * 
		 */
		public static function obtener($codigo){
			try{
				$conexion=Conexion::conectar();				
				$consulta= "select sis.f_unicurricular_por_codigo_seleccionar('pcursor',:codigo)";
							
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
		 * Función que permite obtener un UnidadCurricular.
		 * 
		 * Permite obtener eun UnidadCurricular de la base de datos.
		 * 
		 * @return objet				Objeto istituto obtenido en la base de datos.
		 * 
		 * @throws Exception 			si no existe el UnidadCurricular.
		 * 
		 */
		public static function obtenerPensumUsado($codigo){
			try{
				$conexion=Conexion::conectar();				
				$consulta= "select sis.f_unicurricular_por_pen_usado('pcursor',:codigo)";
							
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
		 * Función que permite obtener un UnidadCurricular.
		 * 
		 * Permite obtener eun UnidadCurricular de la base de datos.
		 * 
		 * @return objet				Objeto istituto obtenido en la base de datos.
		 * 
		 * @throws Exception 			si no existe el UnidadCurricular.
		 * 
		 */
		public static function obtenerPorCoincidencia($patron,$accion){
			try{
				$conexion=Conexion::conectar();				
				$consulta= "select sis.f_unicurricular_por_patron_seleccionar('pcursor',:patron, :accion)";
							
				$ejecutar= $conexion->prepare($consulta);
				$ejecutar->bindParam(':patron',$patron, PDO::PARAM_STR);
				$ejecutar->bindParam(':accion',$accion, PDO::PARAM_STR);		
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
		 * Función que permite obtener un pensum por unidad curriculuar que pase.
		 * 
		 * Permite obtener eun pensum de la base de datos.
		 * 
		 * @return objet				Objeto unidad obtenido en la base de datos.
		 * 
		 * @throws Exception 			si no existe el pensum.
		 * 
		 */
		public static function ObtenerUnidadesPorPensum($codigo){
			try{
				$conexion=Conexion::conectar();				
				$consulta= "select sis.f_unicurricular_por_pensum_seleccionar('pcursor',:codigo)";
							
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
		 * Función que permite obtener un pensum por unidad curriculuar que pase.
		 * 
		 * Permite obtener eun pensum de la base de datos.
		 * 
		 * @return objet				Objeto unidad obtenido en la base de datos.
		 * 
		 * @throws Exception 			si no existe el pensum.
		 * 
		 */
		public static function ObtenerUnidadesPorPenYTra($codigoTra,$codigoPen){
			try{
				$conexion=Conexion::conectar();				
				$consulta= "select sis.f_unicurricular_por_pen_y_tray_seleccionar('pcursor',:codigoPen, :codigoTra)";
							
				$ejecutar= $conexion->prepare($consulta);
				$ejecutar->bindParam(':codigoTra',$codigoTra, PDO::PARAM_INT);
				$ejecutar->bindParam(':codigoPen',$codigoPen, PDO::PARAM_INT);	
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

		public static function ObtenerUnidadesPorPenTraPatron($codigoTra,$codigoPen,$patron,$tipo){
			try{

				$conexion = Conexion::conectar();
				$patron=strtoupper($patron);
				$cad="";
			
				$cad=" and t.codigo=$codigoTra and t.cod_pensum=p.codigo and utp.cod_trayecto=t.codigo";
				$cad.=" and p.codigo=$codigoPen and utp.cod_pensum=p.codigo ";

			
			
				$consulta="select u.* from sis.t_uni_curricular u, sis.t_trayecto t, 
								sis.t_pensum p, sis.t_uni_tra_pensum utp
							where true $cad and utp.cod_tipo='$tipo'
								and utp.cod_uni_curricular=u.codigo and u.nombre like '%$patron%' 
								group by u.codigo order by codigo;";

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

		public static function uniCurPensum ($pensum=null,$patron=null,$tipo=null){
			try{

				$conexion = Conexion::conectar();

				$consulta="select uc.* from sis.t_uni_tra_pensum utp, sis.t_uni_curricular uc
							where utp.cod_pensum=$pensum and utp.cod_uni_curricular=uc.codigo
							and uc.nombre like upper('%$patron%') and utp.cod_tipo='$tipo'";
				
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


}
?>
