<?php
	
	/**
	 * @copyright 2015 - Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio
	 * @license GPLv3
	 * @license http://www.gnu.org/licenses/gpl-3.0.html
	 *
	 * InstitutoServicio.php - Servicio del módulo Instituto.
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
	 * 
	 * @package Servicios
	 */
	class ErrorServicio{


		/**
		 * Función que permite listar($codigo=null) todos los errores almacenados en la base de datos.
		 *
		 * Puede recibir por parametro el codigo del error o null y dependiendo del valor va a listar todos los errores o solo uno,
		 * luego va realizar la consulta a la base de datos y retorna un arreglo asociativo con los errores obtenidos o
		 * null si no se encontró coincidencia.
		 *
		 * @param int $codigo 					Código del error con el que se listarán el error.
		 * @return array|null					Retorna un arreglo de arreglos asociativos o null de no encontrarse coincidencias.								
		 *
		 * @throws Exception 					Si se producen errores en operaciones con la base de datos.
		 */

		public static function listar($codigo=null){
			try{
				$conexion = Conexion::conectar();

				$consulta = "select 	error.*,
										est.nombre,
										per.apellido1|| ', ' || per.nombre1 as nombrecompleto
										from err.t_error as error
										inner join err.t_est_error as est
											on error.cod_estatus = est.codigo
										left join sis.t_persona as per
											on error.cod_usuario = per.codigo";									
				if($codigo!=null)
					$consulta.=" where error.codigo = ?";
				$consulta.=" order by error.cod_estatus, error.fec_reporte";
			

				$ejecutar = $conexion->prepare($consulta);
				
				if($codigo!=null)
					$ejecutar->execute(array(($codigo))); 		//ME ENREDE PARA HACER EL OTRO IF
					// ($codigo==null)?$ejecutar->execute(array()):$ejecutar->execute(array(($codigo))); 
				else
					$ejecutar->execute(array());

				if($ejecutar->rowCount())
					return $ejecutar->fetchAll();
				else
					return null;
			}
			catch(Exception $e){
				throw $e;
			}
		}

		
		/**
		 * Función que permite listarEstado($codigo = null) todos los estados de error almacenados en la base de datos.
		 *
		 * Puede recibir por parametro el codigo del estado del error o null y dependiendo del valor va a listar todos los
		 * estados de  error o solo los seleccionados, luego va realizar la consulta a la base de datos
		 * y retorna un arreglo asociativo con los estados de error obtenidos o
		 * null si no se encontró coincidencia.
		 *
		 * PD:un ejemplo de estado de error son "en proceso","corregido","revisado", entre otros.
		 *
		 * @param int $codigo 					Código del estado de error con el que se listarán los estados.
		 * @return array|null					Retorna un arreglo de arreglos asociativos o null de no encontrarse coincidencias.								
		 *
		 * @throws Exception 					Si se producen errores en operaciones con la base de datos.
		 *
		 */	

		public static function listarEstado($codigo = null)
		{
			try
			{
				$conexion = Conexion::conectar();
				/*
				 * Si $codigo es igual a null entonces va a listar todos los estados
				 * de lo contrario va a listasr todos los estado de error que se haya pasado por parametro				  
				 */
				if($codigo==null)
				{
					$ejecutar = $conexion->prepare("select * from err.t_est_error");
					$ejecutar->execute(array());
				}				
				else 
				{
					$consulta = "select * from err.t_est_error where ";

					for($i = 0; $i < count($codigo); $i++)
						($i==0)?$consulta .= " codigo = ?":$consulta.=" or codigo = ?";

					$ejecutar = $conexion->prepare($consulta);
					$ejecutar->execute($codigo);
				}
				

				if($ejecutar->rowCount())
					return $ejecutar->fetchAll();
				else
					return null;	
			}
			catch(Exception $e)		{throw $e;}
		}


		/**
		 * Función pública y estática que permite obtener el máximo código de la tabla t_error.
		 *
		 * Retorna un entero con el máximo código.
		 * 
		 *
		 * @return int 							El máximo código de los cursos consultados.
		 *
		 * @throws Exception 					Si se producen errores en operaciones con la base de datos.
		 */
		
		public static function obtenerMaxCodigo(){
			try{
				$conexion = Conexion::conectar();
				
				//$consulta = Util::max("codigo","err.t_error");
				
				$ejecutar = $conexion->prepare("select max(codigo) from err.t_error");
				
				$ejecutar->execute(array());
				
				$r = $ejecutar->fetchAll();
				
				return $r[0][0];
			}
			catch(Exception $e){
				throw $e;
			}
		}


		/**
		 * Función pública y estática que permite agregar un error a la base de datos.
		 *
		 * Esta funcion es la encargada de agregar un nuevo error a la base de datos, donde recibe cierta cantidad parametros
		 * para ser almacenados en la tabla t_error.
		 * 
		 *
		 * @param int $codigoError 					Codigo del error este es el idenficiador del reporte.
		 * @param int $codUsuario 					Codigo del usuario es el codigo del usuario que esta reportando el error.
		 * @param chart $codEstatus 				Es el estados que va a poseer el reporte.
		 * @param String $fecReporte 				Es la fecha de cuando se hizo el reporte.
		 * @param String $fecRespuesta				Contiene null.
		 * @param String $descripcion				Contiene la descripcion del error.
		 * @param String $respuesta					contiene null.
		 * @param String $cadenaError				.
		 *
		 * @throws Exception 					Con el mensaje "No se pudo reportar el error."
		 * si no se pudo llevar a cabo la operación.
		 */

		public static function agregarError 	($codigoError, 
											$codUsuario, 
											$codEstatus, 
											$fecReporte, 
											$fecRespuesta, 
											$descripcion, 
											$respuesta,
											$cadenaError){
												
			try{							
				$conexion = Conexion::conectar();
				//consulta=Util::insert("err.t_error",9)
				$ejecutar = $conexion->prepare("insert into err.t_error values(?,?,?,?,?,?,?,?,?)");
				
				$ejecutar->execute(array(
									self::obtenerMaxCodigo() + 1,
									$codigoError,
									$codUsuario,
									$codEstatus,
									$fecReporte,
									$fecRespuesta,
									$descripcion,
									$respuesta,
									$cadenaError
									)
									);
				
				if($ejecutar->rowCount() == 0)
					throw new Exception("No se pudo reportar el error.");
			}
			catch(Exception $e){
				throw $e;
			}
		}


		/**
		 * Función pública y estática que permite modiciar un reporte de error.
		 *
		 * Esta funcion es la encargada de modificar un reporte de error, se pasan cierta cantidad de parámetros
		 * para ser modificados en la base de datos.
		 * 
		 *
		 * @param chart $estado  						Es el codigo del estado que posee el reporte.
		 * @param String $respuesta  					Es la respuesta dada por la persona que esta corrigiendo el error.
		 * @param int $id 				  				Es el codigo de identificacion que posee el reporte en la base de datos.
		 *
		 * @throws Exception 							Con el mensaje "No se logro modificar el Error." cuando
		 * no se puede llevar a cabo la operación.
		 */

		public static function modificarError($estado=null,$respuesta=null,$id=null,$fecha=null)	//acomodado
		{
			try
			{
				$conectar=Conexion::conectar();
				//$consulta=Util::update("err.t_error","cod_estatus,respuesta","codigo=?");
				$ejecutar=$conectar->prepare("UPDATE err.t_error SET cod_estatus=? , respuesta=? , fec_respuesta=? WHERE codigo=?;");
				$ejecutar->execute(array($estado,$respuesta,$fecha,$id));  //acomodado

				if($ejecutar->rowCount()==0)
					throw new Exception("No se logro modificar el Error.");
			}
			catch(Exception $e)		{throw $e;}			
				
		}
		
		/**
		 * Función pública y estática que permite eliminar un reporte.
		 *
		 * Recibe como parámetro el código del reporte que se va a eliminar, de estar este error reportado
		 * en la base de datos se va a eliminar.
		 *
		 * @param int $codigo 				Código del reporte a ser eliminado de la base de datos.
		 * 
		 * @throws Exception 				Con el mensaje "No se logro borrar reporte." 
		 * si no se puede llevar a cabo la eliminación.
 		 */		
 		 

		public static function eliminarError($codigo)
		{
			try
			{
				$conectar=Conexion::conectar();
				//$consulta=Util::delete("err.t_error","codigo=?");
				$ejecutar=$conectar->prepare("delete from err.t_error where codigo=?");				
				$ejecutar->execute(array($codigo));

				if($ejecutar->rowCount()==0)
					throw new Exception("No se logro borrar reporte.");
					
			}
			catch(Exception $e)		{throw $e;}
		}
	}

?>
