<?php


	class UsuarioServicio{
		public static function otorgarPermisos($login){
			try{
				$conexion=Conexion::conectar();
								

				$ejecutar = $conexion->prepare("grant all privileges on schema sis,per,err to $login");
				$ejecutar->execute(array());

				$ejecutar = $conexion->prepare(
					"grant all privileges on table 
						sis.t_persona,
						sis.t_pensum,
						sis.t_est_estudiante,
						sis.v_estudiante,
						sis.t_est_docente,
						sis.v_docente,
						sis.t_instituto,
						sis.t_trayecto,
						sis.t_uni_curricular,
						sis.t_tip_uni_curricular,
						sis.t_curso,
						sis.t_cur_estudiante,
						sis.t_est_cur_estudiante,
						sis.t_periodo,sis.t_est_periodo,
						sis.t_docente,
						per.t_menu,
						per.t_mod_usuario,
						per.t_modulo,
						per.t_tabla,
						per.t_usuario,
						err.t_error,
						err.t_est_error
					to $login;"
				);
				$ejecutar->execute(array());

				return;		
			}catch (Exception $e ){
				throw $e;
			}				
		}
		public static function crear($cedula, $clave, $login){
			try{
				$conexion=Conexion::conectar();
								
				$ejecutar = $conexion->prepare("create user $login password '$clave';");				
				$r = $ejecutar->execute(array());

				$ejecutar = $conexion->prepare("insert into per.t_usuario (nombre,codigo,tipo) 
												values('$login',
												(select codigo from sis.t_persona where cedula = $cedula),
												'R');"
												);
				$ejecutar->execute(array());


				return;		
			}catch (Exception $e ){
				throw $e;
			}	
		}

}
	
?>
