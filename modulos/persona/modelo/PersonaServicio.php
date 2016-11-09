<?php

/**
 * @copyright 2015 - Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio
 * @license GPLv3
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 *
 * PersonaServicio.php - Servicio del módulo Persona.
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
class PersonaServicio
{

	/**
	 * Función pública y estática que permite agregar a una persona a la base de datos.
	 *
	 * Esta funcion es la encargada de agregar una nueva persona a la base de datos, 
	 * donde recibe cierta cantidad parametros para ser almacenados en la tabla sis.t_persona.
	 * 
	 *
	 * @param int $cedula 						Indica la cedula de identidad de la persona
	 * @param String $rif						indica el el registro de informacion fiscal de la persona
	 * @param String $nombre1 					Indica el primer nombre de la persona.
	 * @param String $nombre2 					Indica el segundo nombre de la persona.
	 * @param String $apellido1					Indica el primer apellido de la persona.
	 * @param String $apellido2					Indica el segundo apellido de la persona.
	 * @param String $fec_nacimiento			Fecha en la que nacio la persona.
	 * @param String $tip_sangre				el tipo de sangre que posee la persona.
	 * @param chart  $sexo						Indica el sexo del persona.
	 * @param String $telefono1					Indica el telefono principal de la persona.
	 * @param String $telefono2					Indica el telefono secundario de la persona.
	 * @param String $cor_institucional			Indica si el correo institucional de la persona.
	 * @param String $cor_personal				Indica si el correo personal de la persona.
	 * @param String $direccion					Indica la direccion de habitacion de la persona.
	 * @param String $discapacidad				Indica si la persona posee alguna discapacidad.
	 * @param chart $nacionalidad				Indica la nacionalidad que posee la persona.
	 * @param int $hijos						Indica la cantidad de hijos que posee la persona.
	 * @param chart $est_civil					Indica el estado civil que tiene la persona.
	 * @param String $observaciones				Observaciones que se tengan respecto a la persona.
	 *
	 * @return int 								Retorna el codigo que posee la persona en la base de datos.
	 * @throws Exception 						de vuelve una excepcion 
	 * si no se pudo llevar a cabo la operación.
	 */
	public static function agregar ($cedula,			$rif,				$nombre1,		
									$nombre2,			$apellido1,			$apellido2,		
									$sexo,				$fec_nacimiento,	$tip_sangre,	
									$telefono1,			$telefono2,			$cor_personal,	
									$cor_institucional, $direccion,			$discapacidad,	
									$nacionalidad,		$hijos,				$est_civil,		
									$observaciones
								)


	{
		try
		{

			$conexion = Conexion::conectar();

			
			
			$consulta="select sis.f_persona_ins(
												:cedula,		:rif,			:nombre1, 
												:nombre2,		:apellido1,		:apellido2,:sexo,
												:fec_nacimiento,:tip_sangre,	:telefono1,
												:telefono2,		:cor_personal,	:cor_institucional,
												:direccion,		:discapacidad,	:nacionalidad,
												:hijos,			:est_civil,		:observaciones
											)";

			$ejecutar=$conexion->prepare($consulta);

			$ejecutar->bindParam(':cedula',$cedula, PDO::PARAM_STR);
			$ejecutar->bindParam(':rif',$rif, PDO::PARAM_STR);			
			$ejecutar->bindParam(':nombre1',$nombre1, PDO::PARAM_STR);
			$ejecutar->bindParam(':nombre2',$nombre2, PDO::PARAM_STR);
			$ejecutar->bindParam(':apellido1',$apellido1, PDO::PARAM_STR);
			$ejecutar->bindParam(':apellido2',$apellido2, PDO::PARAM_STR);
			$ejecutar->bindParam(':sexo',$sexo, PDO::PARAM_STR);
			$ejecutar->bindParam(':fec_nacimiento',$fec_nacimiento, PDO::PARAM_STR);
			$ejecutar->bindParam(':tip_sangre',$tip_sangre, PDO::PARAM_STR);
			$ejecutar->bindParam(':telefono1',$telefono1, PDO::PARAM_STR);
			$ejecutar->bindParam(':telefono2',$telefono2, PDO::PARAM_STR);
			$ejecutar->bindParam(':cor_personal',$cor_personal, PDO::PARAM_STR);
			$ejecutar->bindParam(':cor_institucional',$cor_institucional, PDO::PARAM_STR);
			$ejecutar->bindParam(':direccion',$direccion, PDO::PARAM_STR);
			$ejecutar->bindParam(':discapacidad',$discapacidad, PDO::PARAM_STR);
			$ejecutar->bindParam(':nacionalidad',$nacionalidad, PDO::PARAM_STR);
			$ejecutar->bindParam(':hijos',$hijos, PDO::PARAM_STR);
			$ejecutar->bindParam(':est_civil',$est_civil, PDO::PARAM_STR);
			$ejecutar->bindParam(':observaciones',$observaciones, PDO::PARAM_STR);
			$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
			
			$login=Vista::obtenerDato('login');
			if($login->obtenerPermiso('PersonaAgregar')){
				$ejecutar->execute();
				$codigo = $ejecutar->fetchColumn(0);					
					return $codigo;	
			}	
			else
				throw new Exception ("No tienes permiso para Agregar a una persona");
		}
		catch(Exception $e){
			throw $e;
		}
	}

	/**
	 * Función que permite listar todas las personas almacenadas en la tabla sis.t_persona
	 * de la base de datos.
	 *
	 * Puede recibir ciertas cantidades de parametro y dependiendo de los parametros ingresados se va a proceder a listar
	 * ciertas personas, una sola persona o a todas las personas registrados,
	 * luego va realizar la consulta a la base de datos y retorna un arreglo asociativo con las personas obtenidas o
	 * null si no se encontró coincidencia.
	 *
	 * @param int $codigo 						Codigo del persona este es el codigo que posee la persona.
	 * @param int $cedula						Es el numero de cedula de la persona.
	 * @param String $correo 					Es el correo electronico del persona.
	 * @param String $nombre1 					Es el primer nombre de la persona.
	 * @param String $nombre2					Es el segundo nombre de la persona.
	 * @param String $apellido1					Es el primer apellido de la persona.
	 * @param String $apellido2					Es el segundo apellido de la persona.
	 * @param chart $sexo						Indica el sexo del persona.
	 * @param int $cod_instituto				Indica el instituto donde el persona esta trabajando y/o estudiando.
	 * @param int $cod_pensum 					Codigo de pensum donde la persona esta trabajando y/o estudiando.
	 * @param chart $cod_estado 				Codigo de estado que posee el empleado y/o estudiante.
	 * @return array|null						Retorna un arreglo de arreglos asociativos o null de no encontrarse coincidencias.								
	 *
	 * @throws Exception 					Si se producen errores en operaciones con la base de datos.
	 */

	public static function listar(	$pnf=null, 			$estado=null,	$instituto=null,
									$campo=null, 		$codigo=null,	$cedula=null,	
									$correo=null,		$nombre1=null,	$nombre2=null,	
									$apellido1=null,	$apellido2=null,$sexo=null,		
									$cod_instituto=null,$cod_pensum=null,$cod_estado=null
											
								)
	{
		try
		{	
			$conexion = Conexion::conectar();

			$bool=false;
			$con_empleado="";
			$con_estudiante="";
			$consulta="	where true ";
			
			if($pnf){
				$consulta.= "and (em.cod_pensum = $pnf or es.cod_pensum = $pnf) ";
				$con_estudiante.=" and es.cod_pensum = $pnf";
				$con_empleado.=" and em.cod_pensum = $pnf ";
			}

			if($estado){
				$consulta.= "and (em.cod_estado = '$estado' or es.cod_estado = '$estado') ";
				$con_empleado.=" and em.cod_estado = '$estado' ";
				$con_estudiante.=" and es.cod_estado = '$estado' ";
			}

			if($instituto){
				$consulta.= "and (em.cod_instituto = $instituto or es.cod_instituto = $instituto) ";
				$con_empleado.=" and em.cod_instituto = $instituto ";
				$con_estudiante.=" and es.cod_instituto = $instituto ";
			}

			if($campo){
				$bool=true;
				$consulta.=" and (CONCAT(cast(p.cedula as varchar),nombre1 || ' ' ||nombre2 || ' ' ||apellido1 || ' '||apellido2)  
								ilike '%$campo%' 
								OR
								CONCAT(cast(p.cedula as varchar),nombre1 || ' ' ||apellido1)  
								ilike '%$campo%' 
								OR
								CONCAT(cast(p.cedula as varchar),nombre1  || ' ' || nombre2 ||' ' ||apellido1)  
								ilike '%$campo%' 
								OR
								CONCAT(cast(p.cedula as varchar),nombre1  || ' ' || apellido1 ||' ' ||apellido2)  
								ilike '%$campo%') ";
			}
			if($codigo){
				$consulta.= " and p.codigo = $codigo ";
				
			}

			if($cedula){
				$consulta.= "and p.cedula = $cedula ";
			}

			if($correo){
				$consulta.= "and p.cor_personal like '%$correo%' ";
			}

			if($nombre1){
				$consulta.= "and p.nombre1 like '%$nombre1%' ";
			}

			if($nombre2){
				$consulta.= "and p.nombre2 like '%$nombre2%' ";
			}

			if($apellido1){
				$consulta.= "and p.apellido1 like '%$apellido1%' ";
			}

			if($apellido2){
				$consulta.= "and p.apellido2 like '%$apellido2%' ";
			}

			if($sexo){
				$consulta.= "and p.sexo like '%$sexo%' ";
			}

			if(!$pnf && !$estado && !$instituto){
				$consulta2="select p.*,p.codigo as cod_persona, (select to_char(fec_nacimiento,'DD/MM/YYYY')) as fec_nacimientos
							 from sis.t_persona p ";
			}
			else{
				$consulta2=" select p.*, p.codigo as cod_persona,(select to_char(fec_nacimiento,'DD/MM/YYYY')) as fec_nacimientos
							from  sis.t_persona p left join sis.t_estudiante es 
							on true and p.codigo=es.cod_persona  $con_estudiante
							left join sis.t_empleado em 
							on true and em.cod_persona=p.codigo  $con_empleado ";
				if(!$bool)
					$consulta.=" and p.codigo=es.cod_persona or p.codigo=em.cod_persona ";
			}

			$consulta.=" group by p.codigo  order by p.codigo ";
			$consulta = $consulta2.$consulta;

 

			$login=Vista::obtenerDato('login');
			if($login->obtenerPermiso('PersonaListar')){
				$ejecutar=$conexion->prepare($consulta);			
				$ejecutar-> execute(array());
				if($ejecutar->rowCount() != 0)
					return $ejecutar->fetchAll();
				else
					return null; 			
			}
			else
				throw new Exception ("NO tienes permiso para listar a una persona");				
 		
			
			
		}
		catch(Exception $e){
			throw $e;
		}
	}

	public static function listarTodo($codigo=null)
	{
		try
		{
			$conexion = Conexion::conectar();
			$consulta="select sis.f_persona_sel(:cursor)";

			$ejecutar=$conexion->prepare($consulta);
			$cursor='fcursorinst';
			$ejecutar->bindParam(':cursor',$cursor, PDO::PARAM_STR);
			
			$conexion->beginTransaction();
				$ejecutar->execute();			
			$cursors = $ejecutar->fetchAll();
			// cierra cursor
			$ejecutar->closeCursor();
			// array para almacenar resultado del cursor
			$results = array();
			// sirver para leer multiples cursores si es necesario
			foreach($cursors as $k=>$v){
				// ejecutar otro query para leer el cursor
				$ejecutar = $conexion->query('FETCH ALL IN "'. $v[0] .'";');
				$results[$k] = $ejecutar->fetchAll();
				$ejecutar->closeCursor();
				// cierra cursor
			}
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

	public static function listarEstado()
	{
		try
		{
			$conexion = Conexion::conectar();

			$ejecutar = $conexion->prepare("select * from sis.t_est_empleado union select * from sis.t_est_estudiante order by nombre;");	
			$ejecutar->execute(array());			
			
			if($ejecutar->rowCount()!= 0)
				return $ejecutar->fetchAll();
			else
				return null;
		}
		catch(Exception $e){
			throw $e;
		}
	}


	/**
	 * Función pública y estática que permite modificar a una persona.
	 *
	 * Esta funcion es la encargada de modificar a una persona, se pasan cierta cantidad de parámetros
	 * para ser modificados en la base de datos.
	 * 
	 *
	 * @param int $codigo 						Codigo del persona este es el codigo que posee la persona.
	 * @param int $cedula 						Indica la cedula de identidad de la persona
	 * @param String $rif						indica el el registro de informacion fiscal de la persona
	 * @param String $nombre1 					Indica el primer nombre de la persona.
	 * @param String $nombre2 					Indica el segundo nombre de la persona.
	 * @param String $apellido1					Indica el primer apellido de la persona.
	 * @param String $apellido2					Indica el segundo apellido de la persona.
	 * @param String $fec_nacimiento			Fecha en la que nacio la persona.
	 * @param String $tip_sangre				el tipo de sangre que posee la persona.
	 * @param chart  $sexo						Indica el sexo del persona.
	 * @param String $telefono1					Indica el telefono principal de la persona.
	 * @param String $telefono2					Indica el telefono secundario de la persona.
	 * @param String $cor_institucional			Indica si el correo institucional de la persona.
	 * @param String $cor_personal				Indica si el correo personal de la persona.
	 * @param String $direccion					Indica la direccion de habitacion de la persona.
	 * @param String $discapacidad				Indica si la persona posee alguna discapacidad.
	 * @param chart $nacionalidad				Indica la nacionalidad que posee la persona.
	 * @param int $hijos						Indica la cantidad de hijos que posee la persona.
	 * @param chart $est_civil					Indica el estado civil que tiene la persona.
	 * @param String $observaciones				Observaciones que se tengan respecto a la persona.
	 *
	 * @return int 								si se realizo la modificacion con exito devolvera 1 de lo contrario devolvera 0.
	 * @throws Exception 							Con el mensaje "No se puedo modificar la informacion de la persona." cuando
	 * no se puede llevar a cabo la operación.
	 */

	public static function modificar($codigo,		$cedula,			$rif,
									 $nombre1,		$nombre2,			$apellido1,
									 $apellido2,	$sexo,				$fec_nacimiento,
									 $tip_sangre,	$telefono1,			$telefono2,
									 $cor_personal,	$cor_institucional,	$direccion,
									 $discapacidad,	$nacionalidad,		$hijos,
									 $est_civil,	$observaciones
								)
	{
		try
		{
			$conexion = Conexion::conectar();

			$consulta="select sis.f_persona_act(:codigo,		:cedula,			:rif,
												:nombre1, 	    :nombre2,			:apellido1,
												:apellido2,		:sexo, 		  	    :fec_nacimiento,
												:tip_sangre,	:telefono1,	    	:telefono2,
												:cor_personal,	:cor_institucional, :direccion,
												:discapacidad,	:nacionalidad,	    :hijos,
												:est_civil,		:observaciones
											)";								
				$ejecutar=$conexion->prepare($consulta);

			$ejecutar->bindParam(':cedula',$cedula, PDO::PARAM_STR);
			$ejecutar->bindParam(':rif',$rif, PDO::PARAM_STR);
			$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_STR);			
			$ejecutar->bindParam(':nombre1',$nombre1, PDO::PARAM_STR);
			$ejecutar->bindParam(':nombre2',$nombre2, PDO::PARAM_STR);
			$ejecutar->bindParam(':apellido1',$apellido1, PDO::PARAM_STR);
			$ejecutar->bindParam(':apellido2',$apellido2, PDO::PARAM_STR);
			$ejecutar->bindParam(':sexo',$sexo, PDO::PARAM_STR);
			$ejecutar->bindParam(':fec_nacimiento',$fec_nacimiento, PDO::PARAM_STR);
			$ejecutar->bindParam(':tip_sangre',$tip_sangre, PDO::PARAM_STR);
			$ejecutar->bindParam(':telefono1',$telefono1, PDO::PARAM_STR);
			$ejecutar->bindParam(':telefono2',$telefono2, PDO::PARAM_STR);
			$ejecutar->bindParam(':cor_personal',$cor_personal, PDO::PARAM_STR);
			$ejecutar->bindParam(':cor_institucional',$cor_institucional, PDO::PARAM_STR);
			$ejecutar->bindParam(':direccion',$direccion, PDO::PARAM_STR);
			$ejecutar->bindParam(':discapacidad',$discapacidad, PDO::PARAM_STR);
			$ejecutar->bindParam(':nacionalidad',$nacionalidad, PDO::PARAM_STR);
			$ejecutar->bindParam(':hijos',$hijos, PDO::PARAM_STR);
			$ejecutar->bindParam(':est_civil',$est_civil, PDO::PARAM_STR);
			$ejecutar->bindParam(':observaciones',$observaciones, PDO::PARAM_STR);

			$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
			$login=Vista::obtenerDato('login');

			$row=-2;
			if($login->obtenerPermiso('PersonaModificar')){
				$ejecutar->execute();
				$row = $ejecutar->fetchColumn(0);				
			}							
				

			if ($row == 0)
					throw new Exception("No se puedo modificar la informacion de la persona.");	
			
			if ($row == -2)
				throw new Exception("No tienes permiso para modificar la informacion de persona.");	

			return $row;
		}
		catch(Exception $e){
			throw $e;
		}
	}



	/**
	 * Función pública y estática que permite eliminar a una persona.
	 *
	 * Recibe como parámetro el código de la persona que se va a eliminar, de encontrarse la persona
	 * en la base de datos se va a eliminar.
	 *
	 * @param int $codigo 				Código de la persona que va a ser eliminado de la base de datos.
	 * 
	 * @return int 						Si la eliminacion fue exitoza la funcion devolvera 1 de lo contrario devolvera 0.
	 * @throws Exception 				Con el mensaje "No se pudo eliminar a la persona." 
	 * si no se puede llevar a cabo la eliminación.
	 */
	public static function eliminar($codigo=null)
	{
		try
		{
			$conexion = Conexion::conectar();
			$consulta="select sis.f_persona_eli(:codigo)";

			$ejecutar=$conexion->prepare($consulta);
			$ejecutar->bindParam(':codigo',$codigo, PDO::PARAM_STR);						
			
			$login=Vista::obtenerDato('login');
			if($login->obtenerPermiso('PersonaEliminar')){
				$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
				//ejecuta				
				$ejecutar->execute();
				//primera columana codigo
				$row = $ejecutar->fetchColumn(0);					

				return $row;	
			}
			else
				throw new Exception ("NO tienes permiso para eliminar a una persona");
		}
		catch(Exception $e){
			throw new Exception("No se pudo eliminar es posible que ya este registrada como un estudiante o empleado");
		}
	}

	public static function AgregarFoto ($codigo,$codFoto){
		try{
			$conexion = Conexion::conectar();
			$ejecutar = $conexion->prepare("update sis.t_persona set cod_foto=?  where codigo=?;");	
			$login=Vista::obtenerDato('login');
			if($login->obtenerPermiso('GestionarArchivo')){
				$ejecutar->execute(array($codFoto,$codigo));			
			
				if($ejecutar->rowCount()!= 0)
					return $ejecutar->fetchAll();
				else
					return null;
			}
			else
				throw new Exception("NO tienes permiso para Agregar una foto");
				
		}
		catch(Exception $e){
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
	public static function creUsuario($usuario,$clave,$tipo="u"){
		try{

			$conexion=Conexion::conectar();
			$consulta="select per.f_usuario_crear(?,?,?)";
			$ejecutar=$conexion->prepare($consulta);
			$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
			$ejecutar->execute(array($usuario, $clave, $tipo)); 
			return true;

		}catch(Exception $e){
		
				throw $e;
		}
	}

	/**
	 * Método que permite agregar un usuario a la tabla t_usuario cuando son de base de datos 
	 *
	 * @param Usuario $usuario	    		Objeto que contiene la información del usuario.
	 *
	 * @return Integer || null              Código del usuario agregado. 
	 * @throws Exception 					En caso de haber un error al agregar el usuario.
	 */

	public static function agregarUsuBsaDatos($usuario,$codPersona){
		try{
			$conexion=Conexion::conectar();
			$consulta="select per.f_ins_usuario(?,?,?,?,?)";
			$ejecutar=$conexion->prepare($consulta);
			$ejecutar->setFetchMode(PDO::FETCH_ASSOC);
			$ejecutar->execute(array($usuario,
									 "U",
									 $codPersona,
									 "",
									 ""
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

	public static function existeUsuario($codigo,$usuario){
		try{

			$conexion=Conexion::conectar();
			$consulta="select * from per.t_usuario where campo1=? or usuario=?;";
			$ejecutar=$conexion->prepare($consulta);

			$ejecutar->execute(array($codigo,$usuario));			
			
			if($ejecutar->rowCount()!= 0)
				return $ejecutar->fetchAll();
			else
				return null;

		}
		catch(Exception $e){
			throw $e;
		}
	}

	public static function obtenerPermisos($rol){
		try{

			$conexion=Conexion::conectar();
			$consulta="select * from per.t_acc_usuario where cod_usuario=?;";
			$ejecutar=$conexion->prepare($consulta);

			$ejecutar->execute(array($rol));			
			
			if($ejecutar->rowCount()!= 0)
				return $ejecutar->fetchAll();
			else
				return null;
		}
		catch(Exception $e){
			throw $e;
		}
	}

	public static function darPermisos($codigo,$permiso){
		try{
			$conexion=Conexion::conectar();
			for($x=0;$x<count($permiso);$x++){
				
				$consulta="select per.f_usuario_usu_acc_insertar(?,?);";
				$ejecutar=$conexion->prepare($consulta);

				$ejecutar->execute(array($codigo,$permiso[$x]['cod_accion']));	
			}		
			
			if($ejecutar->rowCount()!= 0)
				return $ejecutar->fetchAll();
			else
				return null;
		}
		catch(Exception $e){
			throw $e;
		}
	}

	public static function listarRoles(){
		try{
			$conexion=Conexion::conectar();			
				
			$consulta="select * from per.t_usuario where tipo ='R';";
			$ejecutar=$conexion->prepare($consulta);
			
			$ejecutar->execute(array());				
			
			if($ejecutar->rowCount()!= 0)
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
