<?php
//	require_once("base/clases/utilitarias/UtilBdd.clase.php");
	require_once("modulos/persona/modelo/PersonaServicio.php");
	require_once("modulos/estudiante/modelo/EstudianteServicio.php");
	require_once("modulos/empleado/modelo/EmpleadoServicio.php");
	require_once("modulos/pensum/modelo/PensumServicio.php");
	require_once("modulos/instituto/modelo/InstitutoServicio.php");
	require_once("modulos/foto/modelo/FotografiaServicio.php");
	require_once("modulos/foto/FotoControlador.php");
	require_once('recursos/spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
	require_once('recursos/spreadsheet-reader-master/SpreadsheetReader.php');

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
 * @author Johan Alamo (lider de proyecto) <johan.alamo@gmail.com>
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
			else if($accion == 'listarEstadoEstudianteEmpleado')
				self::listarEstadoEstudianteEmpleado();
			else if($accion == "agregarUsuario")
				self::agregarUsuario();
			else if($accion == "obtenerRol")
				self::obtenerRol();
			else if($accion == "cargaArchivoNuevoIngreso")
				self::cargaArchivoNuevoIngreso();
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
			
				Vista::asignarDato('persona',$personas);
				Vista::asignarDato('tipo_persona',$tipo_persona);
				Vista::asignarDato('codi',PostGet::obtenerPostGet("codi"));
				
				if(!$personas)			
					Vista::asignarDato('persona',null);

				Vista::asignarDato('estatus',1);					
				
				if(!$personas)
					Vista::asignarDato('mensaje','No hay personas para mostrar');
				
				Vista::Mostrar();
			}
			catch(Exception $e)
			{
				throw $e;
			}
		}

		public static function listarEstadoEstudianteEmpleado(){
			try{
			
				Vista::asignarDato('estado',PersonaServicio::listarEstado());
				Vista::asignarDato('estatus',1);
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
				$a=explode("/", (__DIR__));
				$path="";
				$x=0;
				$contador=count($a);
				unset($a[$contador-1]);
				unset($a[$contador-2]);
				
				$path=implode("/",$a);
				
				//$ruta=$path."/temp/".$codigo.".".$foto[0]["tipo"]; 
				$estudiante=null;
				$empleado=null;
				$persona=null;
				$codigo=PostGet::obtenerPostGet("codPersona");	
				$login=Vista::obtenerDato('login');
				if($login->obtenerPermiso('PersonaListar'))		
					$persona=PersonaServicio::listar(null,null,null,null,$codigo);	

				$login=Vista::obtenerDato('login');
				if($login->obtenerPermiso('EstudianteListar'))
					$estudiante=EstudianteServicio::listar(null,null,null,null,$codigo);

				$login=Vista::obtenerDato('login');
				if($login->obtenerPermiso('EmpleadoListar'))
					$empleado=EmpleadoServicio::listar(null,null,null,null,$codigo);

				$foto=FotografiaServicio::existe($persona[0]['cod_foto']);

				if($foto){		
			
					$ruta=$path."/temp/".$codigo.".".$foto[0]["tipo"];
					
					FotografiaServicio::extraerEn($persona[0]['cod_foto'],$ruta);
					
				}

				if($persona)
				{	

					Vista::asignarDato('persona',$persona);
					Vista::asignarDato('estudiante',$estudiante);
					Vista::asignarDato('empleado',$empleado);
					if($foto){
						$ruta="temp/".$codigo.".".$foto[0]["tipo"];
						Vista::asignarDato('foto',$ruta);
					}
					//var_dump($foto[0]["archivo"]);

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

				$a=explode("/", (__DIR__));
				$path="";
				$x=0;
				$contador=count($a);
				unset($a[$contador-1]);
				unset($a[$contador-2]);
				
				$path=implode("/",$a);

				
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
				if($archivo){
					if(!$codigo)
						$codigo=$persona[0]["cod_persona"];
				
					$tipo="";
					$tipo=explode(".",$archivo["name"]);
					$arch=pg_escape_string($archivo["tmp_name"]);	
					if($tipo){
						$ruta=$path."/temp/".$codigo.".".$tipo[1];
												
						copy($arch,$ruta);
						$ruta="temp/".$codigo.".".$tipo[1];
						
						Vista::asignarDato("ruta",$ruta);

						$foto=FotoControlador::Iniciar();
					}	
				}
				
				
				if($foto===true && ($response>0 || $response2>0)){
					$tipo=$tipo[count($tipo)-1];
					$codigo=FotografiaServicio::guardar($persona[0]["cod_foto"],$tipo,$path."/temp/".$codigo.".".$tipo);
				

					if($codigo[0][0]==true){									
						PersonaServicio::AgregarFoto(Vista::obtenerDato("codPersona"),$codigo[0][0]);
					}
				}
				

				if($foto!=='2' && $foto===true){
					Vista::asignarDato("foto",$ruta);
				}
				else if($foto==='2'){
					Vista::asignarDato("mensajeFoto","la imagen NO posee el tamaño minimo para almacernarse");
				}
				
					

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
					Vista::asignarDato('estatus',0);
				}

				Vista::mostrar();
			}
			catch (Exception $e){
				throw $e;
			}
		}

		private static function agregarUsuario() {
		try{

			$usuario=PostGet::obtenerPostGet('usuSistema');
			$clave=PostGet::obtenerPostGet('clave');
			$rol=PostGet::obtenerPostGet('rol');
			$codPersona=PostGet::obtenerPostGet('codPersona');
			
			if (!PersonaServicio::existeUsuario($codPersona,$usuario) 
				&& $clave && $usuario && $codPersona){

				if (PersonaServicio::creUsuario($usuario,$clave)){
					$codigo=PersonaServicio::agregarUsuBsaDatos($usuario,$codPersona);	
					$permiso=PersonaServicio::obtenerPermisos($rol);
					if($permiso){
						PersonaServicio::darPermisos($codigo,$permiso);	

					}
					
				}		

			}
			else
				throw new Exception("Este usuario ya existe");
				
			
			Vista::asignarDato('mensaje','Se ha agregado el usuario'.$usuario.".");
			Vista::asignarDato('estatus',1);
			Vista::mostrar();
			}
			catch(Exception $e){
				throw $e;	
			}
		}

		public static function obtenerRol(){
			try{

				$r=PersonaServicio::listarRoles();
			
				Vista::asignarDato("rol",$r);
				Vista::asignarDato('estatus',1);
				Vista::mostrar();
				

			}
			catch(Exception $e){
				throw $e;
			}
		}

		public static function cargaArchivoNuevoIngreso ()
		{
			try
			{
				
				$instituto=PostGet::obtenerPostGet('instituto');
				$pnf=PostGet::obtenerPostGet('pnf');
				$validar=PostGet::obtenerPostGet('validar');
				$fechaInicio=date('d')."/".date('m')."/".date('Y');
				$formato = PostGet::obtenerPostGet('formato');
				
				$ruta=PostGet::obtenerPostGet('ruta');
				if($ruta  && $formato=="html5"){
					$tipo=explode(".",$ruta);
				}
				$contExite=1;
					$conNoExiste=1;
				if(!$ruta){		
					$personasCargadasExito[0]="nombre;apellido;cedula;correo";
					$personasCargadasFallo[0]="nombre;apellido;cedula;correo";			
					$archivo=PostGet::obtenerFiles("archivo","name");
					$a=explode("/", (__DIR__));
					$path="";
					$x=0;
					$contador=count($a);
					unset($a[$contador-1]);
					unset($a[$contador-2]);				
					$path=implode("/",$a);
					$tipo=explode(".",$archivo["name"]);
					$arch=pg_escape_string($archivo["tmp_name"]);
					$ruta=$path."/temp/".$tipo[0].date('d')."-".date('m')."-".date('Y')."-".date('G').":".date('i').":".date('s').".".$tipo[count($tipo)-1];
					copy($arch,$ruta);
				}
				elseif($formato!="html5"){
					$personasCargadasExito[0]="nombre;apellido;cedula;correo";
					$personasCargadasFallo[0]="nombre;apellido;cedula;correo";	
				}
				else{
					$personasCargadasExito="codigo;nombre;apellido;cedula;correo\n";
					$personasCargadasFallo="nombre;apellido;cedula;correo\n";
				}

				
			
				if($tipo[count($tipo)-1]=='txt' or $tipo[count($tipo)-1]=='odt' or $tipo[count($tipo)-1]=='doc' or $tipo[count($tipo)-1]=='docx'){
					$arch=fopen($ruta,'a+');
					while (!feof($arch)){

						$Row=explode(";", fgets($arch));

						if(PostGet::obtenerPostGet('ruta') && $formato=="html5"){

							if($Row[0]=="")
									break;

							$nombre="";
							$nombre=explode(" ", $Row[2]);
							$nombre2="";
								
							if(count($nombre)>2){
								for($x=1;$x<count($nombre);$x++){
									$nombre2.=$nombre[$x]." ";
								}
							}	
							elseif(count($nombre)==2)
								$nombre2=$nombre[1];

							$apellido="";
							$apellidoAux=explode(" ", $Row[1]);
							$apellido2="";

							if(count($apellidoAux)>2){
								$apellido=$apellidoAux[0]." ".$apellidoAux[1];
								for($x=1;$x<count($apellidoAux);$x++){
									$apellido2.=$apellidoAux[$x]." ";
								}
							}	
							elseif(count($apellidoAux)==2){
								$apellido2=$apellidoAux[1];	
								$apellido=$apellidoAux[0];
							}
							
							

							$r=PersonaServicio::agregar (str_replace(",","",str_replace(".","",$Row[0])),null,				$nombre[0],		
																$nombre2,			$apellido,			$apellido2,		
																$Row[3],			null,				null,	
																$Row[5],				null,				$Row[4],null,null,null,null,null,null,null														
															);
								if($r>0){
									$personasCargadasExito.=$r.";".$Row[1].";".$Row[2].";".$Row[0].";".$Row[4]."\n";
									EstudianteServicio::agregar($r, 			$instituto, 	$pnf,
																null, 			null,			null,
																'A',			$fechaInicio, null,null,null 	
															);
								}
								else
									$personasCargadasFallo.=$Row[1].";".$Row[2].";".$Row[0].";".$Row[4]."\n";	
						}
						else if($Row[0]){
							$r=PersonaServicio::listar(	null, 				null,			null,
																null, 				null,			str_replace(",","",str_replace(".","",$Row[0]))															
											
															);
									if($r){
										$personasCargadasFallo[$contExite]=$Row[1].";".$Row[2].";".$Row[0].";".$Row[4];
										$contExite++;
										
									}
									else{
										$personasCargadasExito[$conNoExiste]=$Row[1].";".$Row[2].";".$Row[0].";".$Row[4];
										$conNoExiste++;

									}
					
						}
					}
				}
				else{

					

					$Spreadsheet = new SpreadsheetReader($ruta);
					$BaseMem = memory_get_usage();
					$Sheets = $Spreadsheet -> Sheets();	
					

					foreach ($Sheets as $Index => $Name)
					{
						$Spreadsheet -> ChangeSheet($Index);

						foreach ($Spreadsheet as $Key => $Row)
						{
							//for($x=0; $x<count($Row);$x++){
								if($Row[0]=="")
									break;
								$nombre="";
								$nombre=explode(" ", $Row[2]);
								$nombre2="";
									
								if(count($nombre)>2){
									for($x=1;$x<count($nombre);$x++){
										$nombre2.=$nombre[$x]." ";
									}
								}	
								elseif(count($nombre)==2)
									$nombre2=$nombre[1];

								$apellido="";
								$apellidoAux=explode(" ", $Row[1]);
								$apellido2="";

								if(count($apellidoAux)>2){
									$apellido=$apellidoAux[0]." ".$apellidoAux[1];
									for($x=1;$x<count($apellidoAux);$x++){
										$apellido2.=$apellidoAux[$x]." ";
									}
								}	
								elseif(count($apellidoAux)==2){
									$apellido2=$apellidoAux[1];	
									$apellido=$apellidoAux[0];
								}

								

								if(PostGet::obtenerPostGet('ruta') && $formato=="html5"){
									$r=PersonaServicio::agregar (str_replace(",","",str_replace(".","",$Row[0])),null,				$nombre[0],		
																$nombre2,			$apellido,			$apellido2,		
																$Row[3],			null,				null,	
																$Row[5],				null,				$Row[4]															
															);
									if($r>0){
										$personasCargadasExito.=$r.";".$Row[1].";".$Row[2].";".$Row[0].";".$Row[4]."\n";
										EstudianteServicio::agregar($r, 			$instituto, 	$pnf,
																	null, 			null,			null,
																	'A',			$fechaInicio 	
																);
										$conNoExiste++;

									}
									else{
										$personasCargadasFallo.=$Row[1].";".$Row[2].";".$Row[0].";".$Row[4]."\n";	
										$contExite++;
									}
								}
								else{

									$r=PersonaServicio::listar(	null, 				null,			null,
																null, 				null,			str_replace(",","",str_replace(".","",$Row[0]))															
											
															);
									if($r){
										$personasCargadasFallo[$contExite]=$Row[1].";".$Row[2].";".$Row[0].";".$Row[4];
										$contExite++;
										
									}
									else{
										$personasCargadasExito[$conNoExiste]=$Row[1].";".$Row[2].";".$Row[0].";".$Row[4];
										$conNoExiste++;
									}

								}							

							//}		
								
						
						}
					}
					
				}
				//Vista::asignarDato("papa",PostGet::obtenerPostGet('ruta')." ---- ".$formato);
				if(PostGet::obtenerPostGet('ruta') && $formato=="html5"){
					unlink($ruta);
					if($conNoExiste>1){
						Vista::asignarDato("estatus","1");
						Vista::asignarDato("mensaje","Fueron inscritas ".($conNoExiste-1)." personas Con Exito y ".($contExite-1)." personas ya estaban registradas");
					}
					else{
						Vista::asignarDato("estatus","-1");
						Vista::asignarDato("mensaje","No se registro ninguna persona");
					}
				}
						
				
				Vista::asignarDato('personasAgregadas',$personasCargadasExito);
				Vista::asignarDato('personasYaRegistradas',$personasCargadasFallo);
				Vista::asignarDato('contadorNoExite',$conNoExiste);
				Vista::asignarDato('contadorExiste',$contExite);
				Vista::asignarDato('ruta',$ruta);
					
				Vista::mostrar();
			}
			catch (Exception $e){
				throw $e;
			}
		}
	}
?>
