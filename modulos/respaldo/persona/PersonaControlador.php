<?php
//	require_once("base/clases/utilitarias/UtilBdd.clase.php");
	require_once("modulos/persona/modelo/PersonaServicio.php");
	require_once("modulos/estudiante/modelo/EstudianteServicio.php");
	require_once("modulos/empleado/modelo/EmpleadoServicio.php");
	require_once("modulos/pensum/modelo/PensumServicio.php");
	require_once("modulos/instituto/modelo/InstitutoServicio.php");
	require_once("modulos/foto/FotoControlador.php");
	require_once("modulos/foto/modelo/FotografiaServicio.php");
/**
 * @copyright 2015 - Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio
 * @license GPLv3
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 *
 * PersonaControlador.php - Controlador del módulo Persona.
 *
 * Este es el controlador del módulo Persona, permite manejar las 
 * operaciones relacionadas con los errores del sistema (agregar, modificar,
 * eliminar, consultar y buscar) 
 * 
 * Es el intermediario entre la base de datos y la vista.
 *  
 * @author Jean Pierre Sosa Gómez (jean_pipo_10@hotmail.com)  
 * 
 * @package Controladores
 */

	class PersonaControlador
	{

		/**
		 * Función pública y estática que permite manejar el requerimiento
		 * (o acción) indicado por el usuario.
		 * 
		 * Todas las acciones de este módulo trabajan en conjunto con la clase Vista para 
	     * mostrar el resultado de la petición del usuario y dicha interacción con la base de datos.
	     * Para más información de esta clase, visite:
		 *
		 * @link /base/clases/vista/Vista.php 	Clase Vista.	
	     *
		 * @var string $accion 					Acción requerida por el usuario.
		 *
		 * @throws Exception 					Si la acción no coincide con las predefinidas del módulo.
		 *
		 */
		public static function manejarRequerimiento()
		{
			$accion= PostGet::obtenerPostGet("m_accion");
			if(!$accion)
				$accion="listar";

			if($accion == 'listar')
				self::listar();
			elseif($accion == 'modificar')
				self::modificar();
			elseif($accion == 'agregar')
				self::agregar();
			elseif($accion=='eliminar')
				self::eliminar();
			else if($accion == 'listarSelects')
				self::listarSelects();
			else
				throw new Exception ("'PersonaControlador' La accion $accion no es valida");
		}

		/**
		 * Función pública y estática que permite listar a las personas que estan registradas en la DB.
		 * 
		 *
		 * Se obtienen todas las personas, y se lista dependiendo del tipo de persona que se este 
		 * pidiendo, ya sea empleado, estudiante, o simplemente las personas que estan registradas.  
		 * 		
		 *
		 * @throws Exception 		Si es capturada alguna excepción en el servicio.
		 */
		public static function listar()
		{
			try
			{	
				
				$pnf=PostGet::obtenerPostGet("pnf");
				$estado=PostGet::obtenerPostGet("estado");
				$instituto=PostGet::obtenerPostGet("instituto");
				$tipo_persona=PostGet::obtenerPostGet("tipo_persona");
				$campo=PostGet::obtenerPostGet("campo");

				$campo=strtoupper($campo);
				/*Vista::asignarDato('institutos',$instituto);
				Vista::asignarDato('pnfs',$pnf);
				Vista::asignarDato('estados',$estado);*/
				
				$ruta=null;
				if($pnf=="seleccionar" || $pnf== 'undefined')
					$pnf=null;
				
				if($estado=="seleccionar" || $estado== 'undefined')
					$estado=null;
								
				if($instituto=="seleccionar" || $instituto == 'undefined')
					$instituto=null;

				if(!$campo)
					$campo=null;

				if(!$tipo_persona)
					$tipo_persona=null;	

					$personas=null;			

				
				if(!$tipo_persona || $tipo_persona=="ambos")			
					$personas=PersonaServicio::listar($pnf,$estado,$instituto,$campo);
								
			/*	elseif($tipo_persona=="estudiante"){
					$personas=EstudianteServicio::listarPersonaEstudiante($pnf,$estado,$instituto,null,null,null,null,null);
				}
			
				elseif($tipo_persona=="empleado")
					$personas=EmpleadoServicio::listarPersonaEmpleado($pnf,$estado,$instituto);
				*/

			
				if(!$instituto)
					$instituto=null;

				

				$pnf=PensumServicio::ObtenerPensumInsituto($instituto);
				$instituto=InstitutoServicio::listarInstitutos();	
				
				$estado=PersonaServicio::listarEstado();
				Vista::asignarDato('instituto',$instituto);
				Vista::asignarDato('pnf',$pnf);
				Vista::asignarDato('estado',$estado);
				Vista::asignarDato('persona',$personas);
				Vista::asignarDato('tipo_persona',$tipo_persona);
				Vista::asignarDato('codi',PostGet::obtenerPostGet("codi"));

				if(!$personas){					
					Vista::asignarDato('persona',null);
				}


				Vista::asignarDato('estatus',1);
					
				
				if(!$personas)
				{
					Vista::asignarDato('mensaje','No hay personas para mostrar');
				}
				Vista::Mostrar();
			}
			catch(Exception $e)
			{
				throw $e;
			}
		}
		
		public static function listarSelects(){
			try{
				
				$pnf=PostGet::obtenerPostGet("pnf");
				$estado=PostGet::obtenerPostGet("estado");
				$instituto=PostGet::obtenerPostGet("instituto");


				
				if($pnf=="seleccionar" || $pnf== 'undefined')
					$pnf=null;
				
				if($estado=="seleccionar" || $estado== 'undefined')
					$estado=null;


				if($instituto=="seleccionar" || !$instituto || $instituto == 'undefined')
					$instituto=null;
				
				$pnf=PensumServicio::ObtenerPensumInsituto($instituto);
				$instituto=InstitutoServicio::listarInstitutos();
				$estado=PersonaServicio::listarEstado(PostGet::obtenerPostGet("tipo_persona"));
				Vista::asignarDato('instituto',$instituto);
				Vista::asignarDato('pnf',$pnf);
				Vista::asignarDato('estado',$estado);
				Vista::asignarDato('empleado2',PostGet::obtenerPostGet("empleado2"));
				Vista::Mostrar();

			}
			catch(Exception $e){
				throw $e;
			}
			
	}

		/**
		 * Función pública y estática que permite modificar la informaacion de una persona
		 * que estan registradas en la DB. 
		 *
		 * Se envia el codigo de la persona a la cual se desea modificar a informacion,
		 * se lista toda la informacion de la persona.
		 *
		 * @throws Exception 		Si es capturada alguna excepción en el servicio.
		 */
		public static function modificar()
		{
			try
			{		
				$codigo=PostGet::obtenerPostGet("codPersona");
				
				$persona=PersonaServicio::listar(null,null,null,null,$codigo);	
				$estudiante=EstudianteServicio::listar(null,null,null,null,$codigo);
				$empleado=EmpleadoServicio::listar(null,null,null,null,$codigo);
				$foto=FotografiaServicio::existe($codigo);
				//var_dump($persona);

				if($foto){		

					$ruta=$_SERVER['DOCUMENT_ROOT']."/sisconot/temp/".$codigo.".".$foto[0]["tipo"];
					//echo $ruta;
				//	FotografiaServicio::extraerEn($codigo,$ruta);
				}

				if($persona)
				{	
					Vista::asignarDato('persona',$persona);
					Vista::asignarDato('estudiante',$estudiante);
					Vista::asignarDato('empleado',$empleado);
		/*			if($foto)
						$ruta="temp/".$codigo.".".$foto[0]["tipo"];
						Vista::asignarDato('foto',$ruta);
					//var_dump($foto[0]["archivo"]);
*/
					Vista::asignarDato('estatus',1);
				}
				else
				{
					Vista::asignarDato('mensaje','No se puede modificar a la persona');
					Vista::asignarDato('estatus',-1);
				}
				
				Vista::Mostrar();
		

			}
			catch(Exception $e){
				throw $e;
			}
		}

		/**
		 * Función pública y estática que permite almacenar la informacion de una persona en la DB
		 *  
		 * se determina si el estado de la operacion si es N se va agregar una persona a 
		 * la base de datos, si es M se va a modificar dicha informacion. Luego de determianar
		 * el estado se llamara al servicio correspondiente.
		 *
		 * @throws Exception 		Si es capturada alguna excepción en el servicio.
		 */
		public static function agregar ()
		{
			try
			{					
				
				$codigo=PostGet::obtenerPostGet("codigo");	
				$cedula=PostGet::obtenerPostGet("cedPersona");	
				$rif=PostGet::obtenerPostGet("rifPersona");		
				$nombre1=PostGet::obtenerPostGet("nombre1");
				$nombre2=PostGet::obtenerPostGet("nombre2");
				$apellido1=PostGet::obtenerPostGet("apellido1");
				$apellido2=PostGet::obtenerPostGet("apellido2");
				$telefono1=PostGet::obtenerPostGet("telefono1");
				$telefono2=PostGet::obtenerPostGet("telefono2");
				$corPersonal=PostGet::obtenerPostGet("corPersonal");
				$corInstitucional=PostGet::obtenerPostGet("corInstitucional");				
				$direccion=PostGet::obtenerPostGet("direccion");
				$discapacidad=PostGet::obtenerPostGet("discapacidad");
				$observaciones=PostGet::obtenerPostGet("obsPersona");
				$sexo=PostGet::obtenerPostGet("sexo");
				$tipSangre=PostGet::obtenerPostGet("tipSangre");
				$estCivil=PostGet::obtenerPostGet("estCivil");
				$hijos=PostGet::obtenerPostGet("hijo");
				$nacionalidad=PostGet::obtenerPostGet("nacionalidad");
				$fecNacimiento=PostGet::obtenerPostGet("fecNacimiento");
				$archivo=PostGet::obtenerFiles("archivo","name");


				if(!$rif)
					$rif=null;
				if(!$corPersonal)
					$corPersonal=null;
				if(!$corInstitucional)
					$corInstitucional=null;
				if(!$codigo)
					$codigo=null;
				if(!$archivo)
					$archivo=null;
				if(!$fecNacimiento)
					$fecNacimiento=null;

				
				$response=null;
				$response2=null;

				if(!$codigo){
					$response=PersonaServicio::agregar($cedula,			$rif,				$nombre1,		
													 $nombre2,			$apellido1,			$apellido2,		
													 $sexo,				$fecNacimiento,	    $tipSangre,	
													 $telefono1,		$telefono2,			$corPersonal,	
													 $corInstitucional, $direccion,			$discapacidad,	
													 $nacionalidad,		$hijos,				$estCivil,		
													 $observaciones
												);

				}
				else
					$response2=PersonaServicio::modificar($codigo,			$cedula,			$rif,
														   $nombre1,		$nombre2,			$apellido1,
														   $apellido2,		$sexo,				$fecNacimiento,
														   $tipSangre,		$telefono1,			$telefono2,
														   $corPersonal,	$corInstitucional,	$direccion,
														   $discapacidad,	$nacionalidad,		$hijos,
														   $estCivil,		$observaciones
														);
				if($response){
					if($response>0)
						Vista::asignarDato('mensaje','Se ha agregado la Persona '.$nombre1.' '.$apellido1.'.');
					else
						Vista::asignarDato('mensaje','No se pudo agregar a la Persona '.$nombre1.' '.$apellido1.'.');
					
					Vista::asignarDato('estatus',$response);
				}

				elseif($response2){
					if($response2>0)
						Vista::asignarDato('mensaje','Se han modificado los datos de la Persona '.$nombre1.' '.$apellido1.'.');
					else
						Vista::asignarDato('mensaje','los datos de la persona'.$nombre1.' '.$apellido1.' No pudieron ser modificados.');
						
					Vista::asignarDato('estatus',$response2);
				}
				
				if($response2>0 || $response>0){
					$persona="";					
					$persona=PersonaServicio::listar(null,null,null,null,null,$cedula);
					Vista::asignarDato('codPersona',$persona[0]['cod_persona']);
					Vista::asignarDato('respuesta',$persona);
					Vista::asignarDato('tipo_persona','estudiante');
				}

				$foto="";
				if($archivo && !$codigo){
					$codigo=$persona[0]["cod_persona"];
					$tipo="";
					$tipo=explode(".",$archivo["name"]);
					$arch=pg_escape_string($archivo["tmp_name"]);	
					if($tipo){
						$ruta=$_SERVER['DOCUMENT_ROOT']."/github/sisconot/temp/".$codigo.".".$tipo[1];
					//	if(file_exists($ruta))
					//		unlink($ruta);
					//	copy($arch,$ruta);
						//$ruta="/temp/".$codigo.".".$tipo[1];
						
				//		Vista::asignarDato("ruta",$ruta);
			//			$foto=FotoControlador::Iniciar();

					}					
					
				}
				elseif($archivo && $codigo){
					$tipo="";
					$tipo=explode(".",$archivo["name"]);	
					$arch=pg_escape_string($archivo["tmp_name"]);
					//PersonaServicio::modificarFoto($codigo,$arch,$a[1],$archivo["name"]);
					if($tipo){			

						$ruta=$_SERVER['DOCUMENT_ROOT']."/github/sisconot/temp/".$codigo.".".$tipo[1];
					//	if(file_exists($ruta))
					//		unlink($ruta);
					//	copy($arch,$ruta);
						//var_dump($ruta);
						//$ruta="/temp/".$codigo.".".$tipo[1];
				//		Vista::asignarDato("ruta",$ruta);
						//$foto=FotoControlador::Iniciar();
						//FotografiaServicio::extraerEn($persona[0]["cod_persona"],"/var/www/proyecto/GitHub/sisconot/".$persona[0]["cod_persona"].".".$a[1]);

					}
					
					//$response=PersonaServicio::listarFoto($codigo);
					/*if($response)
						PersonaServicio::modificarFoto($persona[0]["cod_persona"],$foto,$a[1]);
					else
						PersonaServicio::agregarFoto($persona[0]["cod_persona"],$foto,$a[1]);
					*/				
				}
			//	if($foto===true && ($response>0 || $response2>0)){
			//		FotografiaServicio::guardar($codigo,$tipo[count($tipo)-1],$ruta);
					
		//		}
			//	if(isset($ruta)){
			//		if(file_exists($ruta))
			//			unlink($ruta);
			//	}
				

			/*	if($foto!='2' && $foto==true){
					Vista::asignarDato("foto",$ruta);
				}
				else if($foto==='2'){
					Vista::asignarDato("mensajeFoto","la imagen NO posee el tamaño minimo para almacernarse");
				}*/
				
					

				Vista::mostrar();
			}
			catch(Exception $e){
				throw $e;
			}
		}

		/**
		 * Función pública y estática que permite eliminar a una persona de la base de datos
		 * de manera permanente. 
		 *
		 * Se envia el codigo de la persona al servicio, a la cual se desea eliminar..
		 *
		 * @throws Exception 		Si es capturada alguna excepción en el servicio.
		 */
		public static function eliminar ()
		{
			try
			{
				$codigo=PostGet::obtenerPostGet("cod_persona");
				if(!$codigo)
					$codigo=null;

				$response=PersonaServicio::eliminar($codigo);
				if($response>0){
					Vista::asignarDato('mensaje', 'La persona se ha eliminado correctamente');
					Vista::asignarDato('estatus',1);
					//$response=FotografiaServicio::existe($codigo);
					//if($response>0)
					//	FotografiaServicio::eliminar($codigo);
				}
				else{
					Vista::asignarDato('mensaje', 'No se pudo eliminar a la persona."');
					Vista::asignarDato('estatus',0);
				}

				Vista::mostrar();

			}
			catch (Exception $e){
				throw $e;
			}
		}


	}
?>
