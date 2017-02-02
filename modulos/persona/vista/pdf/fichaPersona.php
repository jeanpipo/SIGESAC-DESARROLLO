<?php
	
	$persona=Vista::obtenerDato("persona");
	$estudiante=Vista::obtenerDato("estudiante");
	$empleado=Vista::obtenerDato("empleado");
//var_dump($estudiante);
	$pdf = new FPDF('p','mm','A4');

	$pdf->AddPage();	
	$pdf->SetTextColor(0);
	$pdf->SetFillColor(255,255,255);
	$pdf->SetLeftMargin(15);
	$pdf->SetTopMargin(20);

	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(0,10,"FICHA PERSONAL",0,0,'C',true);
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Cell(0,10,"INFORMACIÓN PERSONAL",0,0,'C',true);
	$pdf->SetFont('Arial','B',11);
	$pdf->Ln();
	$pdf->Cell(0,7,"Codigo: ".$persona[0]["codigo"],0,0,'C',false);
	$pdf->Ln();
	$pdf->Cell(0,7,"Nombres: ".$persona[0]["nombre1"]." ".$persona[0]["nombre2"],0,0,'C',false);
	$pdf->Ln();
	$pdf->Cell(0,7,"Apellidos: ".$persona[0]["apellido1"]." ".$persona[0]["apellido2"],0,0,'C',false);
	$pdf->Ln();
	$pdf->Cell(0,7,"C.I.: ".$persona[0]["cedula"],0,0,'C',false);
	$pdf->Ln();
	$pdf->Cell(0,7,"RIF: ".$persona[0]["rif"],0,0,'C',false);
	$pdf->Ln();
	$pdf->Cell(0,7,"Sexo: ".$persona[0]["Sexo"],0,0,'C',false);
	$pdf->Ln();
	$pdf->Cell(0,7,"Fecha de nacimiento: ".$persona[0]["fec_nacimientos"],0,0,'C',false);
	$pdf->Ln();
	$pdf->Cell(0,7,"Tipo de Sangre: ".$persona[0]["tip_sangre"],0,0,'C',false);
	$pdf->Ln();
	$pdf->Cell(0,7,"telefono1: ".$persona[0]["telefono1"],0,0,'C',false);
	$pdf->Ln();
	$pdf->Cell(0,7,"telefono2: ".$persona[0]["telefono2"],0,0,'C',false);
	$pdf->Ln();
	$pdf->Cell(0,7,"E-mail: ".$persona[0]["cor_personal"],0,0,'C',false);
	$pdf->Ln();
	$pdf->Cell(0,7,"E-mail Institucional: ".$persona[0]["cor_institucional"],0,0,'C',false);
	$pdf->Ln();
	$pdf->Cell(0,7,"Dirección: ".$persona[0]["direccion"],0,0,'C',false);
	$pdf->Ln();
	$pdf->Cell(0,7,"Discapacidad: ".$persona[0]["discapacidad"],0,0,'C',false);
	$pdf->Ln();
	$pdf->Cell(0,7,"Nacionalidad ".$persona[0]["nacionalidad"],0,0,'C',false);
	$pdf->Ln();
	$pdf->Cell(0,7,"Numero de Hijos: ".$persona[0]["hijos"],0,0,'C',false);
	$pdf->Ln();
	$pdf->Cell(0,7,"Estado Civil: ".$persona[0]["est_civil"],0,0,'C',false);
	$pdf->Ln();
	$pdf->Cell(0,7,"Observaciones: ".$persona[0]["observaciones"],0,0,'C',false);



	

	if($estudiante){
		$pdf->AddPage();	
		$pdf->SetTextColor(0);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetLeftMargin(15);
		$pdf->SetTopMargin(20);

		$pdf->SetFont('Arial','B',14);
		$pdf->Cell(0,10,"INFORMACIÓN ACADEMICA",0,0,'C',true);
		$pdf->SetFont('Arial','B',11);
		$pdf->Ln();

		$pdf->Cell(0,7,"Pensum: ".$estudiante[0]["nom_pen_largo"],0,0,'C',false);
		$pdf->Ln();
		$pdf->Cell(0,7,"Instituto: ".$estudiante[0]["nom_ins_largo"],0,0,'C',false);
		$pdf->Ln();
		$pdf->Cell(0,7,"Codigo del estudiante: ".$estudiante[0]["codigo"],0,0,'C',false);
		$pdf->Ln();
		$pdf->Cell(0,7,"Número de Carnet: ".$estudiante[0]["num_carnet"],0,0,'C',false);
		$pdf->Ln();
		$pdf->Cell(0,7,"Número de Expediente: ".$estudiante[0]["num_expediente"],0,0,'C',false);
		$pdf->Ln();
		$pdf->Cell(0,7,"Codigo Rusnies: ".$estudiante[0]["cod_rusnies"],0,0,'C',false);
		$pdf->Ln();
		$pdf->Cell(0,7,"Estado: ".$estudiante[0]["nombre"],0,0,'C',false);
		$pdf->Ln();
		$pdf->Cell(0,7,"Fecha de Inicio: ".$estudiante[0]["fec_inicios"],0,0,'C',false);
		$pdf->Ln();
		$pdf->Cell(0,7,"fecha Fin: ".$estudiante[0]["fec_final"],0,0,'C',false);
		$pdf->Ln();
		$pdf->Cell(0,7,"Condición: ".$estudiante[0]["condicion"],0,0,'C',false);	
	}


	if($empleado){
		$pdf->AddPage();	
		$pdf->SetTextColor(0);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetLeftMargin(15);
		$pdf->SetTopMargin(20);
		
		$pdf->SetFont('Arial','B',14);
		$pdf->Cell(0,10,"INFORMACIÓN LABORAL",0,0,'C',true);
		$pdf->SetFont('Arial','B',11);
		$pdf->Ln();
		$pdf->Cell(0,7,"Pensum: ".$empleado[0]["nom_pen_largo"],0,0,'C',false);
		$pdf->Ln();
		$pdf->Cell(0,7,"Instituto: ".$empleado[0]["nom_ins_largo"],0,0,'C',false);
		$pdf->Ln();
		$pdf->Cell(0,7,"Codigo del Empleado: ".$empleado[0]["codigo"],0,0,'C',false);
		$pdf->Ln();
		$pdf->Cell(0,7,"Fecha de Inicio: ".$empleado[0]["fec_inicios"],0,0,'C',false);
		$pdf->Ln();
		$pdf->Cell(0,7,"Fecha Fin: ".$empleado[0]["fec_final"],0,0,'C',false);
		$pdf->Ln();
		$pdf->Cell(0,7,"Estado: ".$empleado[0]["nombre"],0,0,'C',false);
		$pdf->Ln();
		if($empleado[0]["es_jef_pensum"])
			$empleado[0]["es_jef_pensum"]="si";
		else
			$empleado[0]["es_jef_pensum"]="no";

		$pdf->Cell(0,7,"Jefe de Pensum: ".$empleado[0]["es_jef_pensum"],0,0,'C',false);
		$pdf->Ln();

		if($empleado[0]["es_jef_con_estudio"])
			$empleado[0]["es_jef_con_estudio"]="si";
		else
			$empleado[0]["es_jef_con_estudio"]="no";

		$pdf->Cell(0,7,"Jefe de Control de Estudio: ".$empleado[0]["es_jef_con_estudio"],0,0,'C',false);
		$pdf->Ln();

		if($empleado[0]["es_ministerio"])
			$empleado[0]["es_ministerio"]="si";
		else
			$empleado[0]["es_ministerio"]="no";
		$pdf->Cell(0,7,"Personal del Ministerio: ".$empleado[0]["es_ministerio"],0,0,'C',false);
		$pdf->Ln();

		if($empleado[0]["es_docente"])
			$empleado[0]["es_docente"]="si";
		else
			$empleado[0]["es_docente"]="no";
		$pdf->Cell(0,7,"Docente: ".$empleado[0]["es_docente"],0,0,'C',false);
		$pdf->Ln();
		$pdf->Cell(0,7,"Observaciones:".$empleado[0]["observaciones"],0,0,'C',false);

	}

	
	$pdf->Output("ListadoDePersonas.pdf", 'I');
?>
