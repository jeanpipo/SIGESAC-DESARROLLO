<?php
//require_once("base/clases/utilitarias/UtilBdd.clase.php");
require_once("modulos/estudiante/modelo/EstudianteServicio.php");
require_once("modulos/pensum/modelo/PensumServicio.php");
require_once("modulos/persona/modelo/PersonaServicio.php");
require_once("modulos/instituto/modelo/InstitutoServicio.php");
require_once("modulos/curso/modelo/CursoServicio.php");

class EstudianteControlador
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
		elseif($accion == 'agregar')
			self::agregar();
		elseif($accion == 'eliminar')
			self::eliminar();
		else if($accion == 'listarEstudiantesPorCurso')
			self::listarEstudiantesPorCurso();
		else if($accion == 'listarEstudiantePeriodo')
			self::listarEstudiantePeriodo();
		else if($accion == 'buscarEstudiante')
			self::buscarEstudiante();
		else if($accion == 'listarEstado')
			self::listarEstado();
		else if($accion == 'autocompletarEstudiante')
			self::autocompletarEstudiante();
		else
			throw new Exception ("'EstudianteControlador' La accion $accion no es valida");
	}


	/**
	 * Función pública y estática que permite listar a un estudiante que esta registrado en la DB.
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
			$codigo=PostGet::obtenerPostGet("codEstudiante");


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

			$estudiante=EstudianteServicio::listar(null,null,null,$codigo,$codPersona);

			$personas=EstudianteServicio::listarPersonaEstudiante($pnf,$estado,$instituto,$campo);
			
			vista::asignarDato('persona',$personas);

			if(!$personas)
				Vista::asignarDato('persona',null);
			
			$pnf=PensumServicio::ObtenerPensumInsituto($instituto);
			$instituto=InstitutoServicio::listarInstitutos();
			$estado=PersonaServicio::listarEstado("estudiante");
			Vista::asignarDato('instituto',$instituto);
			Vista::asignarDato('pnf',$pnf);
			Vista::asignarDato('estado',$estado);
			Vista::asignarDato('tipo_persona',$tipo_persona);
			Vista::asignarDato('estudiante',$estudiante);
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

			Vista::asignarDato('estado',EstudianteServicio::listarEstado());
			Vista::asignarDato('estatus',1);
			Vista::Mostrar();
		}
		catch(Exception $e){
			throw $e;
		}
	}

	/**
	 * Función pública y estática que permite almacenar la informacion de un estudiante en la DB
	 *
	 * se determina si el estado de la operacion, si es N se va agregar un nuevo  estudiante a
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
			$codigo=PostGet::obtenerPostGet("codEstudiante");
			$codInstituto = PostGet::obtenerPostGet("codInstituto");
			$codPensum = PostGet::obtenerPostGet("codPensum");
			$numCarnet = PostGet::obtenerPostGet("numCarnet");
			$numExpediente= PostGet::obtenerPostGet("numExpediente");
			$codRusnies= PostGet::obtenerPostGet("codRusnies");
			$codEstado= PostGet::obtenerPostGet("codEstado");
			$fecInicio= PostGet::obtenerPostGet("fecInicio");
			$fecFin= PostGet::obtenerPostGet("fecFin");
			$condicion= PostGet::obtenerPostGet("condicion");
			$observaciones= PostGet::obtenerPostGet("obsEstudiante");

			if($codEstado=="seleccionar")
				$codEstado=null;
			if(!$condicion)
				$condicion=null;
			if(!$numCarnet)
				$numCarnet=null;
			if(!$numExpediente)
				$numExpediente=null;
			if(!$codRusnies)
				$codRusnies=null;

			if(!$codigo)
				$codigo=null;

			if(!$fecFin)
				$fecFin=null;

			if(!$fecInicio)
				$fecInicio=null;

			$response=null;
			$response2=null;
			$existe=null;

			if($codEstado=='A')
				$existe=EstudianteServicio::listar($codPensum,'A',null,null,$codPersona);

			
			if(!$codigo && !$existe)
				$response=EstudianteServicio::agregar($codPersona, 	$codInstituto, 	$codPensum,
														$numCarnet, 	$numExpediente,	$codRusnies,
														$codEstado,		$fecInicio, 	$fecFin,
														$condicion, 	$observaciones
													);


			else if(!$existe[0]['total_filas'] 
					||($existe[0]['total_filas'] 
					&& $existe[0]['codigo']==$codigo) )
				$response2=EstudianteServicio::modificar($codigo,		$codPersona, 	$codInstituto, 	$codPensum,
														$numCarnet, 	$numExpediente,	$codRusnies,
														$codEstado,		$fecInicio, 	$fecFin,
														$condicion, 	$observaciones
													);

			if($response){
				if($response>0){
					$estudiante=EstudianteServicio::listar( $codPensum, 		$codEstado,		$codInstituto,
															null, 				$codPersona, 	null,
															$numExpediente,     $codRusnies,	$fecInicio
															);
					Vista::asignarDato("codEstudiante",$estudiante[0]['codigo']);
					Vista::asignarDato('mensaje','El estudiante fue agregado exitosamente');
				}
				else
					Vista::asignarDato('mensaje','El empleado no pudo ser Agregado');
				Vista::asignarDato('estatus',$response);
			}
		
			elseif($response2){
				if($response2>0)
					Vista::asignarDato('mensaje','El la informacion del estudiante fue modificada con exito');
				else
					Vista::asignarDato('mensaje','La informacion del estudiante no pudo ser modificada');
				Vista::asignarDato('estatus',$response2);
			}
			
			else if((!$response && !$response2 )){
				Vista::asignarDato('mensaje','El estudiante ya se encuentra activo en este pensum');
				Vista::asignarDato('estatus',$response2);
			}

			//Vista::asignarDato('mensaje','No se pudo agregar a la Persona '.$nombre1.' '.$apellido1.'.');
			
			Vista::mostrar();

		}
		catch(Exception $e){
			throw $e;
		}
	}

	/**
	 * Función pública y estática que permite modificar la informacion de un estudiante
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

				$estudiante=EstudianteServicio::listar(null,null,null,null,null,null,null,$codigo);
				self::listar();
				if($estudiante)
				{
					Vista::asignarDato('estudiante',$estudiante);
					Vista::asignarDato('estatus',1);
				}
				else
				{
					Vista::asignarDatos('mensaje','No se puede modificar la informacion del estudiante');
					Vista::asignarDato('estatus',-1);
				}

			}
			catch(Exception $e){
				throw $e;
			}
		}

	/**
	 * Función pública y estática que permite eliminar a un estudiante de la base de datos
	 * de manera permanente.
	 *
	 * Se envia el codigo del estudiante al servicio, a la cual se desea eliminar..
	 *
	 * @throws Exception 		Si es capturada alguna excepción en el servicio.
	 */
	public static function eliminar ()
	{
		try
		{
			$codigo=PostGet::obtenerPostGet("cod_estudiante");
			if(!$codigo)
				$codigo=null;

			$response=EstudianteServicio::eliminar($codigo);
			if($response>0)
				Vista::asignarDato('mensaje', 'La persona se ha eliminado correctamente.');
			else
				Vista::asignarDato('mensaje','No se pudo eliminar al estudiante.');
			Vista::asignarDato('estatus',$response);
			Vista::mostrar();

		}
		catch (Exception $e){
			throw $e;
		}
	}

	public static function listarEstudiantesPorCurso(){
		try{
			$codigo = PostGet::obtenerPostGet("codigo");
			
			//estado de los estudiantes a consultar (en formato cadena)
			$est_estudiante = PostGet::obtenerPostGet("est_estudiante");
			if($codigo){
				if (is_null($est_estudiante))
					Vista::asignarDato("estudiante",EstudianteServicio::listarEstudiantesDeCurso($codigo));
				else
					Vista::asignarDato("estudiante",EstudianteServicio::listarEstudiantesDeCurso($codigo,$est_estudiante));
				Vista::asignarDato("datocurso",CursoServicio::obtenerDatosDeCurso($codigo));
			}
			
			$r = CursoServicio::obtenerEstusEstudiante();

			Vista::asignarDato("estados",$r);

			Vista::mostrar();
		}
		catch(Exception $e){
			throw $e;
		}
	}

	public static function listarEstudiantePeriodo(){
		try{
			$instituto = PostGet::obtenerPostGet("instituto");
			$pensum = PostGet::obtenerPostGet("pensum");
			$periodo = PostGet::obtenerPostGet("periodo");

			Vista::asignarDato("estudiantes",EstudianteServicio::listarEstudiantePeriodo($instituto,$pensum,$periodo,'A'));

			Vista::mostrar();
		}
		catch(Exception $e){
			throw $e;
		}
	}

	public static function buscarEstudiante(){
		try{

			$patron = PostGet::obtenerPostGet("patron");
			$pensum = PostGet::obtenerPostGet("pensum");
			$instituto = PostGet::obtenerPostGet("instituto");
			$estado = PostGet::obtenerPostGet("estado");
			$mostrarCedula = PostGet::obtenerPostGet("mostrarCedula");
			$patron=strtoupper($patron);

			if($pnf=="seleccionar" || $pnf== 'undefined')
				$pnf=null;
				
			if($estado=="seleccionar" || $estado== 'undefined')
				$estado=null;
							
			if($instituto=="seleccionar" || $instituto == 'undefined')
				$instituto=null;
			if($mostrarCedula== 'undefined' || !$mostrarCedula)
				$mostrarCedula=false;

			$r = EstudianteServicio::listarPersonaEstudiante($pnf,$estado,$instituto,$patron);


			$cad = "[";
			if ($r != null){
				$c = 0;
				foreach ($r as $estudiante) {
					if ($c > 0)
						$cad .= ",";
					$cad .= "{";
					if($mostrarCedula)
						$cad .= '"label": "' . $estudiante['nombre1']. ' ' . $estudiante['nombre2']. ' ' . $estudiante['apellido1']. ' ' . $estudiante['apellido2']. ' ('.$estudiante['cedula'].')", ';
					else
						$cad .= '"label": "' . $estudiante['nombre1']. ' ' . $estudiante['nombre2']. ' ' . $estudiante['apellido1']. ' ' . $estudiante['apellido2']. '", ';

					$cad .= '"value": '.$estudiante['cod_persona'].",";
					$cad .= '"cedula": '.$estudiante['cedula'].",";
					$cad .= '"nombre": "' . $estudiante['nombre1']. ' '. $estudiante['nombre2']. ' ' . 
								$estudiante['apellido1']. ' ' . $estudiante['apellido2'] . '" ';
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
