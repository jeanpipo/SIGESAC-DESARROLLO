<?php


//Clase que permite la comunicación con la base de datos
require_once  "modelo/UsuarioServicio.php";


class UsuarioControlador {
	
	
	public static function manejarRequerimiento(){
		try {
			//permite obtener la acción a realizar en este módulo
			$accion = PostGet::obtenerPostGet('m_accion');
			
			//Acciones de curso
			if (!$accion) 
				$accion = 'listar';
			
			if ($accion == 'listar') 					self::listar();
			else if ($accion == 'crear')				self::crear();				
			else if ($accion == 'otorgarPermisos')		self::otorgarPermisos();				
			else
				throw new Exception ("acción inválida en el controlador del Usuario: ".$accion);
		}catch (Exception $e){
				throw $e;
		}
	}
	
	

	static function listar() {
		try{
			echo "MODULO NO REALIZADO.... USUARIO ---> LISTAR";
		}catch(Exception $e){
			throw $e;
		}
	
	}


	public static function crear(){
		try{
			
			$login = PostGet::obtenerPostGet('login');
			$cedula = PostGet::obtenerPostGet('cedula');
			$clave = PostGet::obtenerPostGet('clave');			
			$res = UsuarioServicio::crear($cedula, $clave, $login);
			
		}catch (Exception $e){
			throw $e;
		}
	}

		
	public static function otorgarPermisos(){
		try{
			
			$login = PostGet::obtenerPostGet('login');
			$res = UsuarioServicio::otorgarPermisos($login);
			
		}catch (Exception $e){
			throw $e;
		}
	}

		


}
