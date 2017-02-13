<?php

/*
 * * * * * * * * * * LICENCIA * * * * * * * * * * * * * * * * * * * * *

Copyright(C) 2012
Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio

Este programa es Software Libre y usted puede redistribuirlo y/o modificarlo
bajo los términos de la versión 3.0 de la Licencia Pública General (GPLv3)
publicada por la Free Software Foundation (FSF), es distribuido sin ninguna
garantía. Usted debe haber recibido una copia de la GPLv3 junto con este
programa, sino, puede encontrarlo en la página web de la FSF, 
específicamente en la dirección http://www.gnu.org/licenses/gpl-3.0.html

 * * * * * * * * * * ARCHIVO * * * * * * * * * * * * * * * * * * * * *

Nombre: FotografiaServicio.clase.php
Diseñador: Geraldine Castillo (geritha_19@hotmmail.com)
Programador: Geraldine Castillo
Lider de proyecto: Johan Alamo (johan.alamo@gmail.com)
Fecha: Diciembre de 2013
Descripción: 

	Esta clase sólo contiene métodos estáticos y no posee atributos. Permite agilizar el manejo de todos los datos y acciones de una fotografía en la base de datos. 

 * * * * * * * * Cambios/Mejoras/Correcciones/Revisiones * * * * * * * *
               /      / .
---                         ----      ---------

 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
*/?>
<?php

class FotografiaServicio {
	/* método público que permite verificar si existe una fotografía mediante un código  único por persona  . Retornará true en 		caso de existir y false en caso de error.
	Parámetros de entrada:
	$codigo_persona: tipo: cadena.
	Código de la persona por el cual se verificará si existe .
	Valor de retorno:
	En  caso exitoso true  , false en caso de error.
	Excepciones que lanza: 
	Exception: si ocurre un error en la conexión a la base de datos..	
	*/
	
	static public function existe($codigo=NULL) {
		try{
			//var_dump($codigo);
			if(!$codigo)
				$codigo=NULL;
			$conexion = Conexion::conectar();
			$consulta = "SELECT * FROM sis.t_archivo WHERE 
					codigo= ?";
			
			$ejecutar=$conexion->prepare($consulta);		
			$ejecutar-> execute(array($codigo));			
 			//var_dump($ejecutar->fetchAll());
			if($ejecutar->rowCount() != 0)
				return $ejecutar->fetchAll();
			else
				return null;
		}
		catch(Exception $e){
			throw $e;
		}
			
	}
	
	
	/*método público que permite eliminar una fotografía de la base de datos.
	Parámetros de entrada: 
	$codigo: tipo: cadena.
	Código de la fotografía a eliminar.
	Valor de retorno: true: en caso de éxito, false: en caso de error. 
	Excepciones que lanza: 
	Exception: si ocurre un error en la conexión a la base de datos.	
	*/	
	static public function eliminar($codigo){
		try{

			$conexion = Conexion::conectar();
			$consulta = "delete from sis.t_archivo 
		         where codigo=?";
		    $login=Vista::obtenerDato('login');
			if($login->obtenerPermiso('GestionarArchivo')){
				$ejecutar=$conexion->prepare($consulta);		
				$ejecutar-> execute(array($codigo));			
	 			//var_dump($ejecutar->fetchAll());
				if($ejecutar->rowCount() != 0)
					return $ejecutar->fetchAll();
				else
					return null;
			}
			else
				throw new Exception("NO tienes permiso para Eliminar un archivo");
				
		}
		catch(Exception $e){
			throw $e;
		}		
	}

	/* método público que permite guardar  todos los datos referentes a una fotografía en la base de datos. 
	Parámetros de entrada: 
	$cod_persona: tipo: cadena.
	Código de la persona en la cual se guardará la fotografía.
	$ruta: tipo: cadena.
	Indica la ruta en donde se encuentra la imagen a incluir en la base de datos. Por ejemplo: “/tmp/foto.jpg”.
	$tipo: tipo: cadena.
	Tipo de archivo que se esta guarando. Por ejemplo: jpg, docx, rar  entre otros .
	Valor de retorno: true: en caso de éxito, false: en caso de error .
	Excepciones que lanza: 
	Exception: si ocurre un error en la conexión a la base de datos.
	Exception:si los campos están vacios.	
	*/
	static public function guardar($codigo,$tipo,$ruta){
		try{

			$conexion = Conexion::conectar();
			if(FotografiaServicio::existe($codigo)== false ){
				$consulta = "select sis.f_archivo_ins (?,?);";
				$login=Vista::obtenerDato('login');
				if($login->obtenerPermiso('GestionarArchivo')){
					$ejecutar=$conexion->prepare($consulta);
							
					$ejecutar-> execute(array($tipo,$ruta));

					if($ejecutar->rowCount() != 0)
						return $ejecutar->fetchAll();
					else
						return null;
				}
				else
					throw new Exception("NO tienes permiso paraguardar un archivo");
					
			}
			else{

				$consulta="select sis.f_archivo_mod (?,?,?)";
				$ejecutar=$conexion->prepare($consulta);
				$ejecutar-> execute(array($codigo,$tipo,$ruta));
				if($ejecutar->rowCount() != 0){
					if($ejecutar->fetchAll()>0)
						return true;
				}
				else
					return null;
			}

						
 		
			
						

		}
		catch(Exception $e){
			throw $e;
		}
		
	}
	/* método público que permite extraer una fotografía de la base de datos en la dirección deseada.
	Parámetros de entrada: 
	$cod_persona: tipo: cadena.
	Código de la persona de la cual se extraerá la fotografía.
 	$ruta: tipo: cadena.
	Indica el lugar donde se guardará la fotografía. Por ejemplo: “/tmp/foto.jpg”.
	Valor de retorno: true: en caso de éxito, false: en caso de error. 
	Excepciones que lanza: 
	Exception: si ocurre un error en la conexión a la base de datos.	

	*/
	
	static public function extraerEn($codigo,$ruta){
		
			 $conexion = Conexion::conectar();
			
			$consulta = "SELECT lo_export(sis.t_archivo.archivo,?) FROM sis.t_archivo WHERE 
				codigo= ?";
			$login=Vista::obtenerDato('login');
			if($login->obtenerPermiso('GestionarArchivo')){
				$ejecutar=$conexion->prepare($consulta);
				//	var_dump($consulta);		
				$ejecutar-> execute(array($ruta,$codigo));			
	 		
				if($ejecutar->rowCount() != 0)
					return $ejecutar->fetchAll();
				else
					return null;
			}
			else
				throw new Exception ("NO tienes permiso para consultar un archivo.");
		//lanza una exception si falla la conexion	
		
	}
	
	public static function extraer($ruta, $nombre, $tipo){
		try{
			if(!$ruta){
				$a=explode("/", (__DIR__));
				$path="";
				$x=0;
				$contador=count($a);
				unset($a[$contador-1]);
				unset($a[$contador-2]);	
				unset($a[$contador-3]);	
				$path=implode("/",$a)."/temp/".$nombre.".".$tipo;				
				$ruta=$path;
			}
			else
				return $ruta."/".$nombre.".".$tipo;
			
			if($nombre && $tipo)
				return $ruta;
			return null;	
		}
		catch(Exception $e){
			throw $e;
		}
	}
}

?>
