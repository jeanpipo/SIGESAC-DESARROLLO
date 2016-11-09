<?php
	header("Content-type: application/vnd.oasis.opendocument.spreadsheet");
	header("Content-Disposition: attachment; filename=reporte.ods");
	//require_once "../../../../base/clases/vista/Vista.php";
	require_once("../../modelo/PersonaServicio.php");
	require_once("../../../estudiante/modelo/EstudianteServicio.php");
	require_once("../../../empleado/modelo/EmpleadoServicio.php");
	

	$pnf=PostGet::obtenerPostGet("pnf");
	$estado=PostGet::obtenerPostGet("estado");
	$instituto=PostGet::obtenerPostGet("instituto");
	$tipo_persona=PostGet::obtenerPostGet("tipo_persona");
	$campo=PostGet::obtenerPostGet("campo");


	if($pnf=="seleccionar")
		$pnf=null;

	if($estado=="seleccionar")
		$estado=null;
					
	if($instituto=="seleccionar")
		$instituto=null;




	if(!$campo)
		$campo=null;

	if(!$tipo_persona)
		$tipo_persona=null;				


	if($tipo_persona=="ambos")			
		$persona=PersonaServicio::listar($pnf,$estado,$instituto,$campo);
					
	elseif($tipo_persona=="estudiante"){
		$persona=EstudianteServicio::listarPersonaEstudiante($pnf,$estado,$instituto,null,null,null,null,null);
	}

	elseif($tipo_persona=="empleado")
		$persona=EmpleadoServicio::listarPersonaEmpleado($pnf,$estado,$instituto);
	}
	var_dump($persona);

?>

<html >

<body>
	<table>

		<tr>
			<th>
				cedula
			</th>

			<th>
				apellidos
			</th>

			<th>
				nombres
			</th>

			<th>
				E-mail
			</th>

		</tr>
		<?php
			for($x=0;$x<count($persona);$x++){
		?>
		<tr>
			<th><?php echo $persona[$x]["cedula"];?></th>
			<th><?php echo $persona[$x]["apellido1"]." ".$persona[$x]["apellido2"];?></th>
			<th><?php echo $persona[$x]["nombre1"]." ".$persona[$x]["nombre1"];?></th>
			<th><?php echo $persona[$x]["cor_personal"];?></th>
		</tr>
		<?php
			}
			Vista::mostrar();
		?>
	</table>
</body>
</html>
