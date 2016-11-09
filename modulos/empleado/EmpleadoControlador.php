<?php
//require_once("base/clases/utilitarias/UtilBdd.clase.php");
require_once("modulos/empleado/modelo/EmpleadoServicio.php");
//require_once("negocio/Estudiante.clase.php");
require_once("modulos/pensum/modelo/PensumServicio.php");
require_once("modulos/persona/modelo/PersonaServicio.php");
require_once("modulos/instituto/modelo/InstitutoServicio.php");
class EmpleadoControlador
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

		$accion = PostGet::obtenerPostGet('m_accion');

		//si $accion viene null se tomara por defecto la accion de listar
		if(!$accion)
			$accion = 'listar';
		if($accion == 'listar')
			self::listar();
		else if($accion == 'agregar')
			self::agregar();
		else if($accion == 'modificar')
			self::modificar();
		else if($accion == 'eliminar')
			self::eliminar();
		else if($accion == 'auto')
			self::buscarEmpleado();	
		else if ($accion == 'listarEstado') 
			self::listarEstado();	
		else
			throw new Exception ("'EmpleadoControlador' La accion $accion no es valida");
	}


	/**
	 * Función pública y estática que permite listar a un empleado que esta registrado en la DB.
	 *
	 *
	 * se obtiene el estudiante, y se lista la informacion obtenida
	 *
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
			$codPersona=PostGet::obtenerPostGet("codPersona");
			$codigo=PostGet::obtenerPostGet("codEmpleado");


			if($pnf=="seleccionar" || $pnf== 'undefined')
				$pnf=null;
				
			if($estado=="seleccionar" || $estado== 'undefined')
				$estado=null;
							
			if($instituto=="seleccionar" || $instituto == 'undefined')
				$instituto=null;

			if(!$campo)
				$campo=null;

			if(!$codPersona)
				$codPersona=null;

			if(!$codigo)
				$codigo=null;

			$personas=EmpleadoServicio::listarPersonaEmpleado($pnf,$estado,$instituto,null,$campo);
			$empleado=EmpleadoServicio::listar(null,null,null,$codigo,$codPersona);
			
			vista::asignarDato('persona',$personas);

			if(!$personas)
				Vista::asignarDato('persona',null);

			if(!$codPersona)
				Vista::asignarDato('empleado',null);
				
			
			$pnf=PensumServicio::ObtenerPensumInsituto($instituto);
			$instituto=InstitutoServicio::listarInstitutos();
			$estado=EmpleadoServicio::listarEstado();
			Vista::asignarDato('instituto',$instituto);
			Vista::asignarDato('pnf',$pnf);
			Vista::asignarDato('estado',$estado);
			Vista::asignarDato('tipo_persona',$tipo_persona);
			Vista::asignarDato('empleado',$empleado);
			Vista::asignarDato('codPersona',$codPersona);
			//Vista::asignarDato('empleado2',PostGet::obtenerPostGet("empleado2"));
			Vista::asignarDato('codi',PostGet::obtenerPostGet("codi"));

			if(!$personas)
				Vista::asignarDato('mensaje','No hay personas para mostrar');
			
			Vista::Mostrar();


		}
		catch(Exception $e){
			throw $e;
		}
	}
	
	public static function listarEstado(){
		try{

			Vista::asignarDato('estado',EmpleadoServicio::listarEstado());
			Vista::asignarDato('estatus',1);
			Vista::Mostrar();
		}
		catch(Exception $e){
			throw $e;
		}
	}

	/**
	 * Función pública y estática que permite almacenar la informacion de un empleado en la DB
	 *
	 * se determina si el estado de la operacion, si es N se va agregar un nuevo  empleado a
	 * la base de datos, si es M se va a modificar dicha informacion. Luego de determianar
	 * el estado se llamara al servicio correspondiente.
	 *
	 * @throws Exception 		Si es capturada alguna excepción en el servicio.
	 */
	public static function agregar()
	{
		try
		{
			$codPersona=PostGet::obtenerPostGet("codPersona");
			$codigo=PostGet::obtenerPostGet("codEmpleado");
			$codInstituto =PostGet::obtenerPostGet("codInstituto");
			$codPensum = PostGet::obtenerPostGet("codPensum");
			$codEstado= PostGet::obtenerPostGet("codEstado");
			$fecInicio= PostGet::obtenerPostGet("fecInicio");
			$fecFin= PostGet::obtenerPostGet("fecFin");
			$observaciones= PostGet::obtenerPostGet("observaciones");
			$es_jef_con_estudio=PostGet::obtenerPostGet("es_jef_con_estudio");
			$es_ministerio=PostGet::obtenerPostGet("es_ministerio");
			$es_jef_pensum=PostGet::obtenerPostGet("es_jef_pensum");
			$Docente=PostGet::obtenerPostGet("Docente");

			$response=null;
			$response2=null;

			if(!$codigo)
				$codigo=null;
			if(!$fecFin)
				$fecFin=null;

			$es_jef_con_estudio=trim($es_jef_con_estudio);
			$es_ministerio=trim($es_ministerio);
			$es_jef_pensum=trim($es_jef_pensum);
			$Docente=trim($Docente);


			if($es_jef_con_estudio=="")
				$es_jef_con_estudio='false';

			if($es_ministerio=="")
				$es_ministerio='false';

			if($es_jef_pensum=="")
				$es_jef_pensum='false';

			if($Docente=="")
				$Docente='false';

			if(!$codigo)
				$response = EmpleadoServicio::agregar($codPersona, 	$codInstituto, 			$codPensum,
											$codEstado,		$fecInicio, 		$fecFin,
											$es_jef_pensum, $es_jef_con_estudio,$es_ministerio,
											$Docente,		$observaciones
										);
			else{

				if(EmpleadoServicio::listar(null,null,null,$codigo))
					$response2= EmpleadoServicio::modificar($codigo,		$codPersona, 	$codInstituto, 			$codPensum,
											$codEstado,		$fecInicio, 		$fecFin,
											$es_jef_pensum, $es_jef_con_estudio,$es_ministerio,
											$Docente,		$observaciones
										);
				else
					$response = EmpleadoServicio::agregar($codPersona, 	$codInstituto, 			$codPensum,
											$codEstado,		$fecInicio, 		$fecFin,
											$es_jef_pensum, $es_jef_con_estudio,$es_ministerio,
											$Docente,		$observaciones
										);

			}

			if($response!=null){
				$empleado=EmpleadoServicio::listar($codPensum, 			 $codEstado,	 $codInstituto,
													null,				 $codPersona,	 $es_jef_pensum,
											   		$es_jef_con_estudio, $es_ministerio, $Docente,
											   		$fecInicio	);
				Vista::asignarDato("codEmpleado",$empleado[0]['codigo']);
				Vista::asignarDato('estatus', $response);
				if($response>0)
					Vista::asignarDato('mensaje',"La informacion del empleado fue almacenada con exito.");
				else
					Vista::asignarDato('mensaje',"No se pudo agregar al empleado.");
			}

			elseif($response2!=null){

				Vista::asignarDato('estatus', $response2);
				if($response2>0)
					Vista::asignarDato('mensaje',"La informacion del empleado ha sido modificada con exito.");
				else
					Vista::asignarDato('mensaje',"No se pudo modificar al empleado.");
			}

			Vista::mostrar();

		}
		catch(Exception $e){
			throw $e;
		}
	}


	/**
	 * Función pública y estática que permite eliminar a un empleado de la base de datos
	 * de manera permanente.
	 *
	 * Se envia el codigo del empleado al servicio, a la cual se desea eliminar..
	 *
	 * @throws Exception 		Si es capturada alguna excepción en el servicio.
	 */
	public static function eliminar ()
	{
		try
		{
			$codigo=PostGet::obtenerPostGet("codEmpleado");
			if(!$codigo)
				$codigo=null;

			$response=EmpleadoServicio::eliminar($codigo);
			Vista::asignarDato('estatus', 1);
			if($response>0)
				Vista::asignarDato('mensaje',"El empleado fue eliminado de manera Exitosa");
			else
				Vista::asignarDato('mensaje',"No se pudo eliminar el empleado.");

			Vista::mostrar();

		}
		catch (Exception $e){
			throw $e;
		}
	}

	public static function buscarEmpleado(){
		try{
			$patron = PostGet::obtenerPostGet("patron");
			$pensum = PostGet::obtenerPostGet("pensum");
			$instituto = PostGet::obtenerPostGet("instituto");
			$completo= PostGet::obtenerPostGet("completo");

			$r = EmpleadoServicio::buscarDocentes($patron,$pensum,$instituto);
			
			$cad = "[";
			if ($r != null){
				$c = 0;
				foreach ($r as $docente) {
					if ($c > 0)
						$cad .= ",";
					$cad .= "{";
					
					if(!$completo)
						$cad .= '"label": "' . $docente['nombre1']. ' '. $docente['nombre2'].' '. $docente['apellido1'].' '. $docente['apellido2'] .' ('.$docente['cedula'].')", ';
					else
						$cad .= '"label": "' . $docente['nombre1']. ' ' . $docente['nombre2']. ' ' . $docente['apellido1']. ' ' . $docente['apellido2'] . '", ';

					if(!$completo)
						$cad .= '"value": '.$docente['cod_persona'];
					else
						$cad .= '"value":'.$docente['codigo'];
					
					$cad .= "}";
					$c++;
				}
			}
			else{
				$cad .= "{";
				$cad .= '"label":"No hay coincidencias", ';
				$cad .= '"value": "null"';
				$cad .= "}";
			}
			$cad .= "]";

			Vista::asignarDato("auto",$cad);

			Vista::mostrar();
		}
		catch(Exception $e){
			throw $e;
		}
	}
}
?>
