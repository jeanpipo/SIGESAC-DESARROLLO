<?php

require_once "modulos/usuario/modelo/UsuarioServicio.php";
require_once "modulos/instalacion/modelo/InstalacionServicio.php";
require_once "negocio/Usuario.php";
require_once "negocio/Instalacion.php";
require_once "negocio/Permisos.php";

/**
* UsuarioControlador.php - Controlador del módulo usuario.
*
* Este es el controlador del módulo usuario, permite manejar las 
* operaciones relacionadas con los usuarios (agregar, modificar,
* eliminar, consultar y buscar), es el intermediario entre la base de datos y la vista. 
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
class UsuarioControlador{



	/**
	 * Método que permite manejar las acciones relacionadas a este módulo obteniendolas por POST o GET.
	 * @param 	Ninguno.
	 * @return  Ninguno. 
	 *
	 * @throws Exception 					En caso de acción no reconocida por el módulo.
	 */
	public static function manejarRequerimiento(){

			//permite obtener la acción a realizar en este módulo
			$accion = PostGet::obtenerPostGet('m_accion');

			//permite colocar una acción predefinida en caso de no colocarla
			if ( ! $accion)
				$accion = 'filtrar';
				
			if ($accion=='filtrar') self::filtrar();
			else if ($accion == 'agregar')
				self::agregar();
			else if ($accion == 'obtener')
				self::obtener();
			else if ($accion == 'modificar')
				self::modificar();
			else if ($accion == 'eliminar')
				self::eliminar();
			else if ($accion=='administrarPermisos')
				self::administrarPermisos();
			else if ($accion=='obtenerPermisos')
				self::obtenerPermisos();
			else if ($accion=='autocompletarUsuario')
				self::autocompletar();
			else if ($accion=='asignarAccion')
				self::asignarAccionUsuario();
			else if ($accion=='eliminarAccion')
				self::eliminarAccionUsuario();
			else if ($accion=='restablecerPermisosBD')
				self::restablecerPermisosBD();
			else
				throw new exception ("Acci&oacute;n inv&aacute;lida: $accion en el m&oacute;dulo usuario ");
	} 

	/**
	 * Método que permite agregar un usuario a través de los parámtros obtenidos por POST o GET 
	 * por medio del servicio de usuario ya sean usuario de base de datos o no.
	 * @param 	Ninguno.
	 * @return  Ninguno. 
	 * @throws  No lanza excepción.
	 */
	private static function agregar() {
		try{

			$usuario= new Usuario();
			$usuario->asignarUsuario(PostGet::obtenerPostGet('usuSistema'));
			$usuario->asignarClave(PostGet::obtenerPostGet('clave'));
			$usuario->asignarTipo(PostGet::obtenerPostGet('tipo'));
			$usuario->asignarCampo1(PostGet::obtenerPostGet('campo1'));
			$usuario->asignarCampo2(PostGet::obtenerPostGet('campo2'));
			$usuario->asignarCampo3(PostGet::obtenerPostGet('campo3'));


			global $instalacion;
			$tipo=$instalacion->obtenerUsuBD();

			$clave=$usuario->obtenerClave();
			if ($clave==null)
				$usuario->asignarClave("");
			if ($tipo=='true'){

				if ($usuario->obtenerTipo()=='R')
					$codigo=UsuarioServicio::agregarUsuBsaDatos($usuario);
				else
					if (UsuarioServicio::creUsuario($usuario)){

						$codigo=UsuarioServicio::agregarUsuBsaDatos($usuario);
						
					}

			}else 
				$codigo=UsuarioServicio::agregarNoUsuBsaDatos($usuario);
			
			Vista::asignarDato('mensaje','Se ha agregado el usuario'.$usuario->obtenerUsuario()." con éxito");
			Vista::asignarDato('estatus',1);
			Vista::asignarDato('codUsuario',$codigo);
			Vista::asignarDato('tipo',$tipo);
			Vista::mostrar();
		}catch(Exception $e){
			throw $e;	
		}
	}
	/**
	 * Método que permite obtener los usuarios de la tabla t_usuario a través de un patrón enviado por POSt o GET. 
	 *
	 * @param 	Ninguno.
	 * @return  Ninguno. 
	 * @throws  No lanza excepción.
	 */
	private static function filtrar() {
		try{
			global $instalacion;
			$tipo=$instalacion->obtenerUsuBD();
			$patron=PostGet::obtenerPostGet('patUsuario');
			if (PostGet::obtenerPostGet('order')!=null)
				$order=PostGet::obtenerPostGet('order');
			else
				$order='usuario';
			$usuarios=UsuarioServicio::filtrar($patron,$tipo,$order);
			if ($usuarios==null)
				Vista::asignarDato('mensaje','No se encontraron usuarios');
			 
				Vista::asignarDato('usuarios',$usuarios);
			
			Vista::asignarDato('estatus',1);
			Vista::mostrar();
		}catch(Exception $e){
			throw $e;	
		}
	}
	
	/**
	 * Método que permite eliminar un usuario de la tabla t_usuario. 
	 *
	 * @param 	Ninguno.
	 * @return  Ninguno. 
	 * @throws  No lanza excepción.
	 */
	private static function eliminar() {
		try{
			global $instalacion;
			$tipo=$instalacion->obtenerUsuBD();

			$codigo=PostGet::obtenerPostGet('codigo');
			$tipUsuario=PostGet::obtenerPostGet('tipo');
			$usuario=PostGet::obtenerPostGet('usuario');


			if ($tipo=="true"){
				if ($tipUsuario=="U")
					UsuarioServicio::eliUsuBasDatos($usuario);
				UsuarioServicio::eliminar($codigo);

			}
			else 
				UsuarioServicio::eliminar($codigo);

			Vista::asignarDato('estatus',1);
			Vista::asignarDato('mensaje','Usuario '.$usuario. ' eliminado con éxito');

			Vista::mostrar();
		}catch(Exception $e){
			throw $e;	
		}
	}
	/**
	 * Método que permite obtener la lista de usuarios y la permisologia de un usuario si
	 * se pasa el nombre del usuario por POST o GET. 
	 *
	 * @param 	Ninguno.
	 * @return  Ninguno. 
	 * @throws  No lanza excepción.
	 */
	public static function administrarPermisos(){
			global $instalacion;
		$tipo=$instalacion->obtenerUsuBD();
		if (PostGet::obtenerPostGet('usuario')!=null){
			$usu=PostGet::obtenerPostGet('usuario');
			$usuario=UsuarioServicio::filtrar($usu,$tipo);
			$permisos = usuarioServicio::obtenerAccionesUsuarios($usu,"",true);

			Vista::asignarDato('usuario',$usuario);
			Vista::asignarDato('permisos',$permisos);
		}else{
			Vista::asignarDato('usuario',null);
		}
			
		
		$usuarios=UsuarioServicio::filtrar('',$tipo);
		Vista::asignarDato('usuarios',$usuarios);
		Vista::mostrar();
	}
	/**
	 * Método que permite obtener la lista de usuarios y roles en formato de autocompletar
	 *
	 * Metodo statico que permite obtener los usuarios y los roles y enviarlos a la vista 
	 * en el formato para el autocompletar, recive el patron por el cual se quiere filtrar
	 * en la lista por post o por get con el nombre de 'patron'.
	 *
	 * @param 	Ninguno.
	 * @return  Ninguno. 
	 * @throws  Al no existir concidencias.
	 */
	private static function autocompletar() {
		try{
			global $instalacion;
			$tipo=$instalacion->obtenerUsuBD();
			$patron=PostGet::obtenerPostGet('patron');
			$usuarios=UsuarioServicio::filtrar($patron,$tipo,'tipo');
			
			$cad = "[";
			if ($usuarios!=null){
				$c = 0;
				foreach ($usuarios as $u) { 
					if ($u->obtenerTipo()=='U') $usu='Usuario';
					else $usu="Rol";

					if ($c > 0) 
						$cad .= ",";
					$cad .= "{";
					$cad .= '"label": " #'.$u->obtenerCodigo().' '. $u->obtenerUsuario(). ' (' . $usu. ')", ';
					$cad .= '"value": "'.$u->obtenerUsuario().'"';
					$cad .= "}";
					$c++;
				}
			}else{
				$cad .= "{";
				$cad .= '"label": " No hay coincidencias ", ';
				$cad .= '"value": null';
				$cad .= "}";
			}
			$cad .= "]";
			Vista::asignarDato('auto',$cad);
			Vista::mostrar();
		}catch(Exception $e){
			$cad = "[";
			$cad .= "{";
			$cad .= '"label": " No hay coincidencias ", ';
			$cad .= '"value": null';
			$cad .= "}";
			$cad .= "]";
			Vista::asignarDato('auto',$cad);
			Vista::mostrar();
		}
	}

/**
	 * Método que permite agregar o asignarla una accion a un usuario.
	 *
	 * Metodo statico que permite asignarle una acción a un usuario, esta funcion
	 * recibe por pos o get el codigo de usuario y el codigo de la acción.
	 *
	 * @param 	Ninguno.
	 * @return  Ninguno. 
	 * @throws  Al no existir concidencias.
	 */
	private static function asignarAccionUsuario() {
		try{
			$codUsuario=PostGet::obtenerPostGet('codUsuario');
			$codAccion= PostGet::obtenerPostGet('codAccion');
			$codUsuarioAccion=UsuarioServicio::agregarAccionUsuario($codUsuario,$codAccion);
			$usuario= PostGet::obtenerPostGet('usuario');



			if ($codAccion==18)
				usuarioServicio::modificarTipoUsuario($usuario,"SUPERUSER");
			if ($codAccion==15 ||$codAccion==16||$codAccion==17 ){
				usuarioServicio::modificarTipoUsuario($usuario,"  CREATEROLE ");
				$permisos=usuarioServicio::obtenerAccionesUsuarios($usuario,"AdministrarPrivilegios",true);
				if ($permisos->obtenerPermiso("AdministrarPrivilegios")!=true)
					usuarioServicio::modificarTipoUsuario($usuario,"NOSUPERUSER");
			}

			Vista::asignarDato("estatus",1);
			Vista::asignarDato("codAccion",$codAccion);
			Vista::asignarDato("codAccionUsuario",$codUsuarioAccion);
			Vista::mostrar();
			//usuarioServicio::restablecerPermisosBD($usuario);
		}catch(Exception $e){
			throw $e;
		}
	}

/**
	 * Método que permite eliminar o revocarle una accion a un usuario.
	 *
	 * Metodo statico que permite revocar una acción a un usuario, esta funcion
	 * recibe por pos o get el codigo de usuario y el codigo de la acción a revocar.
	 *
	 * @param 	Ninguno.
	 * @return  Ninguno. 
	 * @throws  Al no existir concidencias.
	 */
	private static function eliminarAccionUsuario() {
		try{
			$codUsuario=PostGet::obtenerPostGet('codUsuario');
			$codAccion= PostGet::obtenerPostGet('codAccion');
			$codUsuarioAccion=UsuarioServicio::eliminarAccionUsuario($codUsuario,$codAccion);
			//$usuario=UsuarioServicio::filtrar($codUsuario,true);
			$usuario= PostGet::obtenerPostGet('usuario');
			if ($codAccion==18)
				usuarioServicio::modificarTipoUsuario($usuario,"NOSUPERUSER");
			if ($codAccion==15 ||$codAccion==16||$codAccion==17 ){
				$permisos=usuarioServicio::obtenerAccionesUsuarios($usuario,"usuario",true);
				if (($permisos->obtenerPermiso("UsuarioAgregar")!=true)&&($permisos->obtenerPermiso("UsuarioModificar")!=true)&&($permisos->obtenerPermiso("UsuarioEliminar")!=true)){
					usuarioServicio::modificarTipoUsuario($usuario,"NOCREATEROLE");

				}
			}
			
			Vista::asignarDato("estatus",1);
			Vista::asignarDato("codAccion",$codAccion);
			Vista::mostrar();
			//usuarioServicio::restablecerPermisosBD($usuario);
		}catch(Exception $e){
			throw $e;
		}
	}

	public static function restablecerPermisosBD(){
		$usu=PostGet::obtenerPostGet('usuario');
		usuarioServicio::restablecerPermisosBD($usu);
		Vista::asignarDato("estatus",1);
		Vista::asignarDato("mensaje","Permisos establecidos perfectamente");
		Vista::mostrar();
	}


	/**
	 * Método que permite obtener los permisos de un usuario
	 * 
	 * Metodo estatico que permite obtener la lista de permisos de un usuario
	 * y asignarla en la vista para su uso al igual que ejecutar la vista que se desee
	 * con la informacion guardada en ella, recibe el usuario por post o get al igual que
	 * el patron que se desea para filtrar la lista. 
	 *
	 * @param 	Ninguno.
	 * @return  Ninguno. 
	 * @throws  No lanza excepción.
	 */
	public static function obtenerPermisos(){
		$usu=PostGet::obtenerPostGet('usuario');
		$patron="";
		if (PostGet::obtenerPostGet('patAcciones')!=null){
			$patron=PostGet::obtenerPostGet('patAcciones');
		}
		$permisos = usuarioServicio::obtenerAccionesUsuarios($usu,$patron,false);
		Vista::asignarDato("permisos",$permisos);
		Vista::mostrar();
	}
	/**
	 * Método que permite obtener los usuarios de la tabla t_usuario a través de su código obtenido por POST o GET. 
	 *
	 * @param 	Ninguno.
	 * @return  Ninguno. 
	 * @throws  No lanza excepción.
	 */
	private static function obtener() {
		try{
			global $instalacion;
			$tipo=$instalacion->obtenerUsuBD();
	
			$codigo=PostGet::obtenerPostGet('codigo');
			$nomUsuario=PostGet::obtenerPostGet('usuario');
			$tipUsuario=PostGet::obtenerPostGet('tipo');


			$usuario=UsuarioServicio::obtener($codigo,$tipo);

			$nomUsuAdministrador=$instalacion->obtenerUsuarioAdmin();

			if ($nomUsuario==$nomUsuAdministrador)
				Vista::asignarDato('tipo',false);
			else 
				Vista::asignarDato('tipo',true);

				
			Vista::asignarDato('estatus',1);
			Vista::asignarDato('usuario',$usuario);
			
			Vista::mostrar();
		}catch(Exception $e){
			throw $e;	
		}
	}

	/**
	 * Método que permite modificar un usuario a través de su código obtenido por el POST o GET. 
	 *
	 * @param 	Ninguno.
	 * @return  Ninguno. 
	 * @throws  No lanza excepción.
	 */
	private static function modificar() {
		try{
			global $instalacion;
			$tipo=$instalacion->obtenerUsuBD();
	
			$usuario= new Usuario();
			$usuario->asignarCodigo(PostGet::obtenerPostGet('codigo'));
			$usuario->asignarUsuario(PostGet::obtenerPostGet('usuario'));
			$usuario->asignarClave(PostGet::obtenerPostGet('clave'));
			$usuario->asignarTipo(PostGet::obtenerPostGet('tipo'));
			$usuario->asignarCampo1(PostGet::obtenerPostGet('campo1'));
			$usuario->asignarCampo2(PostGet::obtenerPostGet('campo2'));
			$usuario->asignarCampo3(PostGet::obtenerPostGet('campo3'));

			//claave anterior
			$claAnterior=PostGet::obtenerPostGet('claAnterior');
			//tipo de suario anterior.
			$tipAnterior=PostGet::obtenerPostGet('tipAnterior');

			$login=Sesion::obtenerLogin();
			$clave=$login->obtenerClave();

			//Cuando son usuarios de base de datos.
			if ($tipo=="true"){

				if ( $tipAnterior=="U" && $usuario->obtenerTipo()=="U"){
					if ($usuario->obtenerClave()==true){
						
						if (strcmp ($clave,$claAnterior)==0  ){

							UsuarioServicio::camClaveUsuBD($usuario->obtenerUsuario(),$usuario->obtenerClave());	

					
							
							if ($usuario->obtenerUsuario()==$login->obtenerUsuario()){

								$login->asignarClave($usuario->obtenerClave());
								$login->asignarTipo($usuario->obtenerTipo());
								Sesion::iniciar($login);
								Conexion::iniciar($instalacion->obtenerServidor(),$instalacion->obtenerNombreBD(),
								$instalacion->obtenerPuerto(),$usuario->obtenerUsuario(),$usuario->obtenerClave());
							}

						
						}
						else 
							throw new Exception("La contraseña no coincide con la actual",-3);
							

					}
				}

				UsuarioServicio::modificarUsuBsaDatos($usuario);
				//crear el usuario cuando cambia de rol a usuario
				if ($tipAnterior=="R" && $usuario->obtenerTipo()=="U")
					UsuarioServicio::creUsuario($usuario);
				if ($tipAnterior=="U" && $usuario->obtenerTipo()=="R")
					UsuarioServicio::eliUsuBasDatos($usuario->obtenerUsuario());

		
			}

			else{
				//cuando no son usuarios de base de datos


				if ($tipAnterior=="U" && $usuario->obtenerTipo()=="R")
			
					$usuario->asignarClave(null);
					
		
				if ($usuario->obtenerClave()==true && $usuario->obtenerTipo()=="U"){
					
					
					if (strcmp ($clave,$claAnterior)==0  || ($tipAnterior=="R" && $usuario->obtenerTipo()=="U")){
							UsuarioServicio::camClaveNoUsuBD($usuario->obtenerCodigo(),$usuario->obtenerClave());
						

							if ($usuario->obtenerUsuario()==$login->obtenerUsuario()){
								$login->asignarClave($usuario->obtenerClave());
								$login->asignarTipo($usuario->obtenerTipo());
								Sesion::iniciar($login);
							}
					
						if ($instalacion->obtenerUsuarioAdmin()==$usuario->obtenerUsuario()){
							UsuarioServicio::camClaveUsuBD($usuario->obtenerUsuario(),$usuario->obtenerClave());
						
							Conexion::iniciar($instalacion->obtenerServidor(),$instalacion->obtenerNombreBD(),
							$instalacion->obtenerPuerto(),$usuario->obtenerUsuario(),$usuario->obtenerClave());
						
							$instalacion->obtenerInstalacionIni();
							$instalacion->asignarPassAdmin($usuario->obtenerClave());
							$instalacion->crearArchivo();
							$instalacion->guardarDatosAplicacion();

						}
					}
					else 
						throw new Exception("La contraseña no coincide con la actual",-3);
				}

					UsuarioServicio::modificarNoUsuBsaDatos($usuario);
			}
				
				


			
			Vista::asignarDato('codigo',$usuario->obtenerCodigo());	
			Vista::asignarDato('estatus',1);
			Vista::asignarDato('mensaje','Se ha modificado el usuario '. $usuario->obtenerUsuario() .' con éxito');
			Vista::mostrar();
		}catch(Exception $e){
		
			throw $e;	

		}
	}

}
