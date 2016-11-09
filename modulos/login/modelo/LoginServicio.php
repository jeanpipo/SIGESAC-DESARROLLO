<?php
/**
 * @copyright 2014 - Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio
 * @license GPLv3
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 *
 * LoginServicio.php - Servicios de MVCRIVERO.
 *
 * Esta clase ofrece el servicio de conexión a la base de datos, recibe los
 * parámetros, construye las consultas SQL, hace las peticiones a la base de
 * datos y retorna los objetos o datos correspondientes a la acción.
 * 
 *  
 * @author JHONNY VIELMA 		(jhonnyvq1@gmail.com)
 * @author GERALDINE CASTILLO 	(geralcs@gmail.com)
 * @author Johan Alamo (lider de proyecto) <johan.alamo@gmail.com>
 * 
 * @link /base/clases/conexion/Conexion.php 	Clase Conexion
 * 
 * @link /negocio/login.php 					Clase Login
 * 
 * @package Servicios
 */
 

class LoginServicio{
	
	
	
	 /**
		 * Funcion estatica que permite obtener el login a la base de datos.
		 *
		 * Permite cosultar a la base de datos si el usuario pertenece al sistema
		 * y cosultar si su tipo de usuario corresponde a su usuario, se valida 
		 * todo los datos de logueo mediante una consulta.
		 *
		 * @param string  $usuario 				Usuario.
		 * @param string  $tipoU 				Tipo de usuario. 
		 * @param string  $codDepartamento		Codigo del departamento al que pertenece el usuario.
		 * @param string  $codInstituto			Codigo del instituto al que pertenece.
		 * 
		 * @return object|null 	                Objeto login de corresponder todos los datos o null de no corresponder.
		 * 
		 * @throws Exception 					Exceptiones capturas.
		 * 
		 */
	public static function obtenerLogin($usuario,$contraseña,$tipo=true){
			try{
				
				$conexion=Conexion::conectar();
				if ($tipo){
					$consulta= "select * from per.t_usuario where usuario=?";
					$parametros=array($usuario);
				}else{
					$consulta= "select * from per.t_usuario where usuario=? and pass=?";
					$parametros=array($usuario,md5($contraseña));
				}
				
				$ejecutar= $conexion->prepare($consulta);
				$ejecutar->execute($parametros);
				$a=$ejecutar->fetchAll();
				if ($a){
					$usu= new Usuario();
					$usu->asignarCodigo($a[0]["codigo"]);
					$usu->asignarUsuario($a[0]["usuario"]);
					$usu->asignarTipo($a[0]["tipo"]);
					$usu->asignarCampo1($a[0]["campo1"]);
					$usu->asignarCampo2($a[0]["campo2"]);
					$usu->asignarCampo3($a[0]["campo3"]);
					$usu->asignarClave($contraseña);
					return $usu;
				}else
					throw new Exception("Datos de autentificación incorrectos");
			}catch (Exception $e ){
				throw $e;
			}	
		}
		
	public static function obtenerDatosPersona($codigo){
		try{
			$conexion = Conexion::conectar();
			
			$consulta = "select 	per.nombre1 || ' ' || per.apellido1 as nombre,
									per.codigo,
									per.cod_foto,
									arc.tipo,
									emp.es_jef_pensum,
									emp.es_jef_con_estudio,
									emp.es_ministerio,
									emp.es_docente,
									emp.cod_instituto emp_inst,
									emp.cod_pensum emp_pensum,
									emp.cod_estado emp_estado,
									est.cod_instituto est_inst,
									est.cod_pensum est_pensum,
									est.cod_estado est_estado
									from sis.t_persona per
									left join sis.t_empleado as emp
										on emp.cod_persona = per.codigo
									left join sis.t_estudiante as est
										on est.cod_persona = per.codigo
									left join sis.t_archivo arc
										on arc.codigo = per.cod_foto
									where per.codigo = $codigo";
									
			$ejecutar = $conexion->prepare($consulta);
			$ejecutar->execute(Array());
			$r = $ejecutar->fetchAll();
			
			if($r)
				return $r;
			return null;
		}
		catch(Exception $e){
			throw $e;
		}
	}

}

?>
