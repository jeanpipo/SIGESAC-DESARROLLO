<?php
/**
 * UsuarioServicio.php - Servicio del módulo usuario.
 * 
 * Esta clase ofrece el servicio de conexión a la base de datos, recibe 
 * los parámetros, construye las consultas SQL, hace las peticiones a 
 * la base de datos y retorna los objetos o datos correspondientes a la
 * acción. Todas las funciones de esta clase relanzan las excepciones si son capturadas,
 * esto con el fin de que la clase manejadora de errores las capture y procese.
 *
 * @copyright 2016 - Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio
 * @license GPLv3
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 * 
 * @author GERALDINE CASTILLO (geralcs94@gmail.com)
 * @author JHONNY VIELMA 	  (jhonnyvq1@gmail.com)
 * @author Johan Alamo (lider de proyecto) <johan.alamo@gmail.com>
 * 
 * @package MVC
 */

class UsuarioServicio{
	/**
	 * Método que permite retornar un arreglo de objetos Usuario si $tipObjeto es true y sino retorna la matriz
	 *de la información extraída de base de datos.
	 *
	 * @param Boolean $tipObjeto 		    Si se quiere la respuesta un arreglo objetos Usuario.
	 * @param matriz $matriz				Matriz que contiene la información extraída de base de datos.
	 * @return  Ninguno. 
	 * @throws Exception 					No lanza exceptiones.
	 */
	private static function retornar($tipObjeto,$tipo,$matriz){
			
			if ($tipObjeto){
				for($i = 0; $i < count($matriz); $i++){
					$usuario=new Usuario();
					$usuario->asignarCodigo($matriz[$i][0]);
					$usuario->asignarUsuario($matriz[$i][1]);
					if ($tipo=='true'){
						$usuario->asignarTipo($matriz[$i][2]);
						$usuario->asignarCampo1($matriz[$i][3]);
						$usuario->asignarCampo2($matriz[$i][4]);
						$usuario->asignarCampo3($matriz[$i][5]);
							

					}else{
						$usuario->asignarClave($matriz[$i][2]);
						$usuario->asignarTipo($matriz[$i][3]);
						$usuario->asignarCampo1($matriz[$i][4]);
						$usuario->asignarCampo2($matriz[$i][5]);
						$usuario->asignarCampo3($matriz[$i][6]);
						
					}
					$usuarios[]=$usuario;
				}
				return $usuarios;
			}
			else
				return $modMatriz;
	}
	/**
	 * Método que permite agregar un usuario a la tabla t_usuario cuando son de base de datos 
	 *
	 * @param Usuario $usuario	    		Objeto que contiene la información del usuario.
	 *
	 * @return Integer || null              Código del usuario agregado. 
	 * @throws Exception 					En caso de haber un error al agregar el usuario.
	 */

	public static function agregarUsuBsaDatos($usuario){
		try{
			$conexion=Conexion::conectar();
			$consulta="select per.f_ins_usuario(?,?,?,?,?)";
			$ejecutar=$conexion->prepare($consulta);
			$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
			$ejecutar->execute(array($usuario->obtenerUsuario(),
									 $usuario->obtenertipo(),
									 $usuario->obtenerCampo1(),
									 $usuario->obtenerCampo2(),
									 $usuario->obtenerCampo3()
									)); 
			
			//primera columana código
			$codigo = $ejecutar->fetchColumn(0);
			if ($codigo)
				return $codigo;
			else 
				throw new Exception("Error al agregar el usuario");

		}catch(Exception $e){
			throw $e;
		}
	}
	/**
	 * Método que permite agregar un usuario a la tabla t_usuario cuando no son de base de datos. 
	 * @param Usuario $usuario	    		Objeto que contiene la información del usuario.
	 *
	 * @return Integer || null              Código del usuario agregado. 
	 * @throws Exception 					En caso de haber un error al agregar el usuario.
	 */
	public static function agregarNoUsuBsaDatos($usuario){
		try{
			$conexion=Conexion::conectar();
			$consulta="select per.f_ins_usu_no_bd(?,?,?,?,?,?)";
			$ejecutar=$conexion->prepare($consulta);
			$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
			$ejecutar->execute(array($usuario->obtenerUsuario(),
									md5( $usuario->obtenerClave()),
									 $usuario->obtenertipo(),
									 $usuario->obtenerCampo1(),
									 $usuario->obtenerCampo2(),
									 $usuario->obtenerCampo3()
									)); 
			
			//primera columana código
			$codigo = $ejecutar->fetchColumn(0);
			if ($codigo)
				return $codigo;
			else 
				throw new Exception("Error al agregar el usuario");

		}catch(Exception $e){
			throw $e;
		}
	}
		/**
	 * Método que permite crear un usuario de base de datos. 
	 * @param Usuario $usuario	    		Objeto que contiene la información del usuario.
	 * @param Char    $tipo	    		    Caracter que representa el tipo de usuario a crear u= usuario normal y
	 *										u= superusuario.
	 *
	 * @return True 		  				True si lo crea.      
	 * @throws Ninguna.     
	 */
	public static function creUsuario($usuario,$tipo="u"){
		try{

			$conexion=Conexion::conectar();
			$consulta="select per.f_usuario_crear(?,?,?)";
			$ejecutar=$conexion->prepare($consulta);
			$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
			$ejecutar->execute(array($usuario->obtenerUsuario(),
									 $usuario->obtenerClave(),
									 $tipo
									)); 
			return true;

		}catch(Exception $e){
		
				throw $e;
		}
	}
	/**
	 * Método que permite obtener los usuarios por un patrón que se desee . 
	 * @param String $patron	    		Patrón de búsqueda.
	 * @param String $tipo	    			cdena que representa el tipo de usuarios, si de base de datos o no.
	 * @param String $order	    			cdena que representa por cual campo se quiere ordenar.
	 * @return Arreglo Usuario	            Arreglo de objetos Usuarios si hay coincidencias
	 * @throws Exception 					En caso de error.
	 */
	public static function filtrar($patron='',$tipo,$order="usuario"){
		try{

			$conexion=Conexion::conectar();
			$consulta="select per.f_usuario_filtar('cursor','".$patron."','".$order."')";
			$ejecutar= $conexion->prepare($consulta);
			// inicia transaccion
			$conexion->beginTransaction();
			$ejecutar->execute();
			$cursors = $ejecutar->fetchAll();
			// cierra cursor
			$ejecutar->closeCursor();
			// array para almacenar resultado del cursor
			// sirver para leer multiples cursores si es necesario
			// ejecutar otro query para leer el cursor
			$ejecutar = $conexion->query('FETCH ALL IN cursor;');
			$results = $ejecutar->fetchAll();
			$ejecutar->closeCursor();
			$conexion->commit();
			if(count($results) > 0)
				return self::retornar(true,$tipo,$results);
			else	
				return null;
		}catch(Exception $e){
			throw $e;
			
			
		}
	}
	/**
	 * Método que permite obtener un usuaro según su código . 
	 * @param Integer $codigo	    		código del usuario a a buscar.
	 * @param String $tipo	    			cdena que representa el tipo de usuarios, si de base de datos o no.
	 * @return Arreglo de objeto Usuario	Arreglo de objeto Usuario si hay coincidencias
	 * @throws Exception 					En caso de error.
	 */
	public static function obtener($codigo,$tipo){
		try{

			$conexion=Conexion::conectar();
			$consulta="select per.f_usuario_obtener(?,?)";
			$ejecutar= $conexion->prepare($consulta);
	
			$conexion->beginTransaction();
			$ejecutar->execute(array($codigo,'cursor'));
			$cursors = $ejecutar->fetchAll();
		
			$ejecutar->closeCursor();
		
			$ejecutar = $conexion->query('FETCH ALL IN cursor;');
			$results = $ejecutar->fetchAll();
			$ejecutar->closeCursor();
			$conexion->commit();
			if(count($results) > 0)
				return self::retornar(true,$tipo,$results);
			else	
				throw new Exception("Error al mostrar el usuario");
		}catch(Exception $e){
			throw $e;
			
			
		}
	}
	/**
	 * Método que permite modificar un usuario de la tabla t_usuario cuando no son de base de datos. 
	 * @param Usuario $usuario	    		Objeto que contiene la información del usuario.
	 *
	 * @return Integer || null              Código del usuario agregado. 
	 * @throws Exception 					En caso de haber un error al agregar el usuario.
	 */
	public static function modificarNoUsuBsaDatos($usuario){
		try{
			$conexion=Conexion::conectar();
			$consulta="select per.f_usuario_mod_no_bd(?,?,?,?,?,?)";
			$ejecutar=$conexion->prepare($consulta);
			$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
			if ($usuario->obtenerClave()==null)
				$clave=null;
			else 
				$clave=md5($usuario->obtenerClave());
			$ejecutar->execute(array($usuario->obtenercodigo(),
									
									 $usuario->obtenertipo(),
									 $usuario->obtenerCampo1(),
									 $usuario->obtenerCampo2(),
									 $usuario->obtenerCampo3(),

									 $clave
									)); 
			
			//primera columana código
			$resultado = $ejecutar->fetchColumn(0);
			if ($resultado==1)
				return true;

			else 
				throw new Exception("Error al modificar el usuario");

		}catch(Exception $e){
			throw $e;
		}
	}
	/**
	 * Método que permite modificar un usuario de la tabla t_usuario cuando son de base de datos. 
	 * @param Usuario $usuario	    		Objeto que contiene la información del usuario.
	 *
	 * @return Integer || null              Código del usuario agregado. 
	 * @throws Exception 					En caso de haber un error al agregar el usuario.
	 */
	public static function modificarUsuBsaDatos($usuario){
		try{
			$conexion=Conexion::conectar();
			$consulta="select per.f_usuario_modificar(?,?,?,?,?)";
			$ejecutar=$conexion->prepare($consulta);
			$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
			$ejecutar->execute(array($usuario->obtenercodigo(),
									
									 $usuario->obtenertipo(),
									 $usuario->obtenerCampo1(),
									 $usuario->obtenerCampo2(),
									 $usuario->obtenerCampo3()
									)); 
			
			//primera columana código
			$resultado = $ejecutar->fetchColumn(0);
			if ($resultado==1)
				return true;

			else 
				throw new Exception("Error al  modificar el usuario");

		}catch(Exception $e){
			throw $e;
		}
	}
		/**
	 * Método que permite cambiar la contraseña de un usuario si es de base de datos. 
	 * @param String $usuario	    		cadena que representa el usuario a cambiar la contraseña.
	 *
	 * @return True   						True si cambia la contraseña    
	 * @throws Ninguna.     
	 */
	public static function camClaveUsuBD($usuario,$clave){
		try{

			$conexion=Conexion::conectar();
			$consulta="select per.f_usuario_cam_clave(?,?)";
			$ejecutar=$conexion->prepare($consulta);
			$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
			$ejecutar->execute(array($usuario,
									 $clave
									
									)); 
			return true;

		}catch(Exception $e){
		
				throw $e;
		}
	}
			/**
	 * Método que permite cambiar la contraseña de un usuario si no es de base de datos. 
	 * @param Integer $codigo	    		Entero que representa el código del usuario
	 * @param String $clave	    			Cadena que representa la clave del usuario
	 * @return True   						True si cambia la contraseña    
	 * @throws Ninguna.     
	 */
	public static function camClaveNoUsuBD($codigo,$clave){
		try{

			$conexion=Conexion::conectar();
			$consulta="select per.f_usuario_cam_clave_no_usbd(?,?)";
			$ejecutar=$conexion->prepare($consulta);
			$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
			$ejecutar->execute(array($codigo,
									 $clave
									
									)); 
			return true;

		}catch(Exception $e){
		
				throw $e;
		}
	}
				/**
	 * Método que permite eliminar un usuario cuando son de base de datos. 
	 * @param String $usuario	    		cadena que representa el usuario.
	 * @return Ninguno. 
	 * @throws Ninguna.     
	 */
	public static function eliUsuBasDatos($usuario){
		try{

			$conexion=Conexion::conectar();
			$consulta="select per.f_usuario_eli_bas_datos(?)";
			$ejecutar=$conexion->prepare($consulta);
			$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
			$ejecutar->execute(array($usuario
									
									)); 
			return true;

		}catch(Exception $e){
		
				throw $e;
		}
	}
	/**
	 * Método que permite eliminar un usuario de la tabla t_usuario. 
	 * @param Integer $codigo	    	Entero que representa el código del usuario.
	 * @return Ninguno. 
	 * @throws Ninguna.     
	 */
	public static function eliminar($codigo){
		try{

			$conexion=Conexion::conectar();
			$consulta="select per.f_usuario_eliminar(?)";
			$ejecutar=$conexion->prepare($consulta);
			$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
			$ejecutar->execute(array($codigo)); 
			

		}catch(Exception $e){
		
				throw $e;
		}
	}
	/**
	 * Método que permite obtener todas la acciones que se encuentran guardadas en la base de datos,
	 * tanto las que pose un usuario como las que no posee. Esta funcion se puede utilizar sin utilizar
	 * tanto como cuando se quiera obtener la acciones de un usuario como cuando solo se quieren obtener
	 * las acciones de la base de datos dejando el parametro de usuario vacio, aparte se puede filtrar entre
	 * las acciones. 
	 * @param String $usuario	    		Nombre del usuario que se quiere obtener sus acciones o '' de querer las acciones sin usuarios.
	 * @param String $patron	    		Patron por el cual se desea filtrar en la lista.
	 * @param Bool	 $tipoReturn   	 	    True como predeterminado para que la funcion retorne un objeto permiso y false para que retorne un arreglo.
	 * 
	 * @return Object Permiso || array	    Objeto permiso o arreglo si el parametro tipoReturn fue pasado como false.
	 * @throws Exception 					En caso de error.
	 */
	public static function obtenerAccionesUsuarios($usuario='',$patron='',$tipoReturn=true){
		try{
			$conexion=Conexion::conectar();
			$consulta="select per.f_usuario_obt_usu_acciones('cursor','".$usuario."','".$patron."')";
			$ejecutar= $conexion->prepare($consulta);
			// inicia transaccion
			$conexion->beginTransaction();
			$ejecutar->execute();
			$cursors = $ejecutar->fetchAll();
			// cierra cursor
			$ejecutar->closeCursor();
			// array para almacenar resultado del cursor
			// sirver para leer multiples cursores si es necesario
			// ejecutar otro query para leer el cursor
			$ejecutar = $conexion->query('FETCH ALL IN cursor;');
			$results = $ejecutar->fetchAll();
			$ejecutar->closeCursor();
			$conexion->commit();
			if(count($results) > 0)
				return self::retornarPermisos($results,$tipoReturn);
			else	
				throw new Exception("No se obtuvo resultado de acciones");
		}catch(Exception $e){
			throw $e;
		}
	}
	/**
	 * Método que permite retornar un  objeto Permiso si $tipoReturn  es true y sino retorna la matriz
	 * de la información extraída de base de datos.
	 *
	 * @param Boolean $tipReturn 		    True si quiere que retorne un objeto permiso o false una matriz.
	 * @param matriz $matriz				Matriz que contiene la información extraída de base de datos de las acciones.
	 * @return  Ninguno. 
	 * @throws Exception 					No lanza exceptiones.
	 */
	private static function retornarPermisos($matriz,$tipoReturn){
			
			if ($tipoReturn){
				$permisos=new Permisos();
				$permisos->iniciar();
				for($i = 0; $i < count($matriz); $i++){
					if ($matriz[$i][0]!=null)
						$posee=true;
					else 
						$posee=false;
					$permisos->agregarAccion($matriz[$i][3],$posee);
				}
				return $permisos;
			}
			else
				return $matriz;
	}
	/**
	 * Método que permite agregarle o asignarle una accion a u usuario
	 *
	 * @param Integer $codUsuario	    	Integer que representa el codigo del usuario que se le asignara la acción.
	 * @param Integer $codAccion	    	Integer que representa el codigo de la acción que se le asignara al usuario.
	 * 
	 * @return Integer || null              Código del usuario agregado. 
	 * @throws Exception 					En caso de haber un error al asignar la acción al usuario.
	 */

	public static function agregarAccionUsuario($codUsuario,$codAccion){
		try{
			$conexion=Conexion::conectar();
			$consulta="select per.f_usuario_usu_acc_insertar(?,?)";
			$ejecutar=$conexion->prepare($consulta);
			$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
			$ejecutar->execute(array($codUsuario,
									 $codAccion
									)); 
			

			$codigo = $ejecutar->fetchColumn(0);
			if ($codigo)
				return $codigo;
			else 
				throw new Exception("Error al asignar la acción al usuario");

		}catch(Exception $e){
			throw $e;
		}
	}
	/**
	 * Método que permite  eliminar o arevocar una accion a un usuario
	 *
	 * @param Integer $codUsuario	    	Integer que representa el codigo del usuario que se le revocara la acción.
	 * @param Integer $codAccion	    	Integer que representa el codigo de la acción que se le revocara al usuario.
	 *
	 * @return Integer                      1 de ser exitoso 
	 * @throws Exception 					En caso de haber un error al agregar el usuario.
	 */

	public static function eliminarAccionUsuario($codUsuario,$codAccion){
		try{
			$conexion=Conexion::conectar();
			$consulta="select per.f_usuario_acc_usu_eliminar(?,?)";
			$ejecutar=$conexion->prepare($consulta);
			$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
			$ejecutar->execute(array($codUsuario,
									 $codAccion
									)); 
			

			$codigo = $ejecutar->fetchColumn(0);
			if ($codigo>0)
				return $codigo;
			else 
				throw new Exception("Error al revocar la accion del usuario");

		}catch(Exception $e){
			throw $e;
		}
	}
	
	public static function restablecerPermisosBD($usuario){
		try{
			$conexion=Conexion::conectar();
			$consulta="select per.f_usuario_rev_per_usuarios(array['".$usuario."'])";
			$ejecutar=$conexion->prepare($consulta);
			$ejecutar->execute();

			$consulta="select per.f_usuario_asi_per_tablas_usuario(?)";
			$ejecutar=$conexion->prepare($consulta);

			$ejecutar->execute(array($usuario)); 
			

		}catch(Exception $e){
			throw $e;
		}

	}

	public static function modificarTipoUsuario($usuario,$tipo){
		try{
			$conexion=Conexion::conectar();
			$consulta="select per.f_usuario_mod_tip_usuario(?,?)";
			$ejecutar=$conexion->prepare($consulta);
			$ejecutar->execute(array($usuario,$tipo));

		}catch(Exception $e){
			throw $e;
		}

	}





}


?>
