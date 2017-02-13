<?php
require_once("modulos/foto/modelo/FotografiaServicio.php");
class FotoControlador{

	//private $ruta;		// Se establece la ruta en de la ubicacion de la imagen.	
	private static $ancho_limite=300;		//Se establece el limite de pixeles de ancho que va a obtener la imagen despues de ser modificada.
	private static $altura_limite=300;		//Se establece el limite de pixeles de alto que va a obtener la imagen despues de ser modificada.

	public static function manejarRequerimiento(){
		$accion = PostGet::obtenerPostGet("m_accion");
		if(!$accion)
			$accion="";

		if($accion=="borrar")
			self::borrar();
		else if($accion == "buscarFoto")
			self::buscarFoto(); //
		else if($accion == "guardarFoto")
			self::guardarFoto();
		else if($accion == "eliminarFoto")
			self::eliminarFoto();
		else if($accion == "extraerFoto")
			self::extraerFoto();
		else if($accion == "Existencia")
			self::Existencia();
		else
			throw new Exception ("'FotoControlador' La accion $accion no es valida");
	}
		

	public static function iniciar(){
		$codigo=Vista::obtenerDato("codPersona");
		$ruta=Vista::obtenerDato("ruta");

		$dimensionesMinimas=self::validar_dimensiones_minimas ($ruta);
		if(!self::validar_dimensiones ($ruta)){
			$dimensiones=self::get_dimensiones ($ruta);
			self::guardar (self::redimensionar ($dimensiones,$ruta),$ruta);
			$tipo=explode(".",$ruta);
			//$destino="modulos/persona/vista/html5/imagen/PersonasImg/".$a[1];
			//copy($ruta,$destino);
			//unlink($ruta);
					
			return true;

		}
		elseif(!$dimensionesMinimas){
			unlink($ruta);
			return '2';
		}
		else
		{		
			return true;
		}


	}

	/*la funcion abrir imagen abre la imagen de la planilla para poder ser trabajada*/
	public static function obtener_foto($ruta)
	{	
		if(!strpos(strtoupper($ruta), ".JPG")===false || !strpos(strtoupper($ruta), ".JPEG")===false){
			return imagecreatefromjpeg($ruta);	//Se abre la imagen donde esta la planilla.
		}
		elseif(!strpos(strtoupper($ruta), ".PNG")===false)
			return imagecreatefrompng($ruta);  //Se guardan los cambios realizados.	
		elseif(!strpos(strtoupper($ruta), ".GIF")===false)
			return imagecreatefromgif($ruta);//Se guardan los cambios realizados.	
			
	}

	/*La funcion get_dimensiones obtiene la cantidad de pixeles de la imagen
	tanto de largo como se ancho*/
	public static function get_dimensiones ($ruta)
	{
		
		list($ancho_original, $altura_original) = getimagesize($ruta);	// devuelve el ancho y la altura de la imagen en pixeles
		return $ancho_original."|".$altura_original;
	}

	/* Esta funcion se encargar de verificar si las dimensiones de la imagen son lo sufisientemente 
	grande para ser trabajada */
	public static function validar_dimensiones ($ruta)
	{
		$a=explode("|",self::get_dimensiones($ruta));	
		if($a[0]<=350 and $a[1]<=350)	{return true;}
		else 							{return false;}
	}

	public static function validar_dimensiones_minimas ($ruta)
	{	

		$a=explode("|",self::get_dimensiones($ruta));
		
		if($a[0]<=250 or $a[1]<=250)	{return false;}
		else 							{return true;}
	}

	public static function guardar ($cambio,$ruta)	//pendiente con las extenciones hay que determinar eso.
	{
		
		if($cambio!=null)
		{
			if(!strpos(strtoupper($ruta) ,".JPG")===false || !strpos(strtoupper($ruta) ,".JPEG")===false)
				imagejpeg($cambio,$ruta);  //Se guardan los cambios realizados.	
			elseif(!strpos(strtoupper($ruta), ".PNG")===false)
				imagepng($cambio,$ruta);  //Se guardan los cambios realizados.	
			elseif(!strpos(strtoupper($ruta), ".GIF")===false)
				imagegif($cambio,$ruta);  //Se guardan los cambios realizados.
		}
		
	}

	/*La funcion redimencionar redimensiona la imagen a un nuevo tamaño */
	public static function redimensionar ($dimensiones,$ruta)
	{
		$a=explode("|",$dimensiones);	// se obtiene las dimensiones originales de la imagen tanto de ancho como de alto
		$imagen_redimensionada=self::imagen_vacia(self::$ancho_limite."|".self::$altura_limite);	//se obtiene una imagen en blanco
		//se redimensiona la imagen la valiable $a en la posicion cero contiene el ancho original y la variable $a en la posicion 1 contiene la altura original
		imagecopyresized($imagen_redimensionada,self::obtener_foto($ruta), 0, 0, 0, 0, self::$ancho_limite,self::$altura_limite, $a[0] , $a[1]); 
						        	
		return  $imagen_redimensionada;    //se guardan los cambios
	}

	/*La funcion imagen_vacia crea una imagen en blanco para poder albergar 
	los cambios que sufre una imagen*/
	public static function imagen_vacia($dimensiones)
	{
		$a=explode("|", $dimensiones);	//obtiene las dimensiones de la imagen 
		return imagecreatetruecolor($a[0],$a[1]); //se crea una imagen en blanco para guardar los cambios q se efectue
	}

	public static function borrar(){
		try{
			$ruta = PostGet::obtenerPostGet("ruta");
			$nombre = PostGet::obtenerPostGet("nombre");
			//echo $ruta;
			if(isset($ruta)){
				if(file_exists($ruta))
					unlink($ruta);
			}
			elseif($nombre){
				$a=explode("/", (__DIR__));
				$path="";
				$x=0;
				$contador=count($a);
				unset($a[$contador-1]);
				unset($a[$contador-2]);	
				$path=implode("/",$a)."/temp/".$nombre;
				if(file_exists($path))
					unlink($path);
				Vista::asignarDato("ruta",$path);
			}

			Vista::Mostrar();
		}
		catch(Exception $e){
			throw $e;
		}
	}

	public static function buscarFoto(){
		try{
			$a=explode("/", (__DIR__));
			$path="";
			$x=0;
			$contador=count($a);
			unset($a[$contador-1]);
			unset($a[$contador-2]);
			
			$path=implode("/",$a);
			$codigo=PostGet::obtenerPostGet("codigo");
			$codPersona=PostGet::obtenerPostGet("codPersona");
			$foto=FotografiaServicio::existe($codigo);

			$ruta=$path."/temp/".$codPersona.".".$foto[0]["tipo"];
			$ruta2="temp/".$codPersona.".".$foto[0]["tipo"];

			if($foto)
				$foto=FotografiaServicio::extraerEn($codigo,$ruta);

			if($foto)
				Vista::asignarDato("foto",$ruta2);
			else
				Vista::asignarDato("foto",null);

			Vista::Mostrar();
		}
		catch(Exception $e){
			throw $e;
		}
	}


	public static function guardarFoto($codigo,$tipo,$ruta){
		try{
			
			$r=FotografiaServicio::guardar($codigo,$tipo,$ruta);
			if($r){
				Vista::asignarDato("codFoto",$r);
				Vista::asignarDato("mensaje","La foto ha sido guardada");
				Vista::asignarDato("estatus",1);
			}
			else{
				Vista::asignarDato("mensaje","La foto NO se guardo");
				Vista::asignarDato("estatus",-1);
			}


			Vista::Mostrar();
			
		}
		catch(Exception $e){
			throw $e;
		}
	}

	public static function eliminarFoto($codigo){
		try{
			$r=FotografiaServicio::eliminar($codigo);

			if($r){
				Vista::asignarDato("mensaje","La foto ha sido borrada");
				Vista::asignarDato("estatus",1);
			}
			else{
				Vista::asignarDato("mensaje","La foto NO se pudo borrar");
				Vista::asignarDato("estatus",-1);
			}


			Vista::Mostrar();

		}
		catch(Exception $e){
			throw $e;
		}
	}


	public static function extraerFoto(/*$codigo,$ruta*/){
		try{
			
			
			$codigo=PostGet::obtenerPostGet("codigo");
			$ruta=PostGet::obtenerPostGet("ruta");
			$codPersona=PostGet::obtenerPostGet("codPersona");
			$tipo=PostGet::obtenerPostGet("tipo");
			
			if(!$ruta){
				FotografiaServicio::extraer($ruta, $codPersona, $tipo);
			}			
			$r=FotografiaServicio::extraerEn($codigo,$ruta);

			return ($r);

		}
		catch(Exception $e){
			throw $e;
		}
	}

	public static function Existencia($codigo){
		try{

			$r=FotografiaServicio::existe($codigo);		

			Vista::asignarDato("existe",$r);
			Vista::asignarDato("mensaje","La foto si existe");

			Vista::Mostrar();
		}
		catch(Exception $e){
			throw $e;
		}
	}

}
?>
