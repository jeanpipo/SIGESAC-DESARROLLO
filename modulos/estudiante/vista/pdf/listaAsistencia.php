<?php
//*********************************** inicializaciones ************************************

	global $curso;
	global $estudiantes;
	global $alto;
	global $ancho;
	global $nombreArchivoDestino;


	$estudiantes = Vista::obtenerDato('estudiante');
	$curso = Vista::obtenerDato("datocurso");
	$alto = 5;
	$ancho = 19;
	$nombreArchivoDestino = "curso_" . $curso[0]["codigocurso"] . "_asistencia.pdf";

//******************** Creación de clase para agregar el header ********************************
	class PDF extends FPDF
	{

	//Encabezado de página
		function Header()
		{
			global $curso;
			global $estudiantes;
			$this->SetFont('Arial','B',11);
			$this->SetTextColor(0);
			$this->SetFillColor(255,255,255);
			$this->SetLeftMargin(15);
			$this->SetTopMargin(60);


			$this->SetY(10);
			$this->SetFont('Arial','B',14);
			$this->Cell(0,5,"LISTADO DE ASISTENCIA / "
							. "CÓDIGO DEL CURSO: " . $curso[0]["codigocurso"] . " / "
							. "DOCENTE: " . $curso[0]['nombredocente']
			 ,0,0,'L',true);
			$this->Ln();
			$this->SetFont('Arial','',11);

			$this->Cell(0,5,
							$curso[0]['nom_cor_instituto'] . " / "
							. $curso[0]['nom_cor_pensum'] . " / "
							. $curso[0]['nombreperiodo'] . " / "
							. "TRAYECTO ".$curso[0]['numtrayecto'] . " / "
							. $curso[0]['nombreuni'] . " / "
							. "SECCIÓN " .  $curso[0]['seccion']
			,0,0,'',true);
			$this->Ln();

			$this->Cell(0,5,
							"CANTIDAD DE ESTUDIANTES: " . count($estudiantes)
							. " / PÁGINA " . $this->PageNo().' DE {nb}'
			,0,0,'',true);
			$this->Ln();
			$this->Ln();



		   }
	}


//*********************** Código para mostrar la información ************************************


	$pdf = new PDF('l','mm','letter');

	$pdf->AliasNbPages(); //para colocarle alias al número total de páginas

	$pdf->AddPage();
	$pdf->SetFont('Arial','B',11);
	$pdf->SetTextColor(0);
	$pdf->SetFillColor(255,255,255);
	$pdf->SetLeftMargin(15);
	$pdf->SetTopMargin(60);

	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(10,$alto,"#",1,0,'C',true);
	$pdf->Cell(19,$alto,"Cédula",1,0,'C',true);
	$pdf->Cell(40,$alto,"Apellido y Nombre",1,0,'C',true);
	for($i = 0; $i < 10; $i++)
		$pdf->Cell($ancho,$alto,"",1,0,'C',true);
	$pdf->Ln();

	$pdf->SetFont('Arial','',9);
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0);

	for($i=0;$i<count($estudiantes);$i++){
		$pdf->Cell(10,$alto,$i+1,1,0,'C',true);
		$pdf->Cell(19,$alto,$estudiantes[$i]['cedula'],1,0,'C',true);
		$pdf->Cell(40,$alto,$estudiantes[$i]['apellido1'].", ".$estudiantes[$i]['nombre1'],1,0,'',true);

		for($j = 0; $j < 10; $j++)
			$pdf->Cell($ancho,$alto,"",1,0,'C',true);
		$pdf->Ln();
	}

	$pdf->SetFont('Arial','BU',12);
	$pdf->Cell(0,10,"OBSERVACIONES: ",0,0,'',true);

//	$pdf->Output("LISTA DE ASISTENCIA_".$curso[0]['nombreuni']." Seccion ".$curso[0]['seccion'].".pdf", 'D');
	$pdf->Output($nombreArchivoDestino , 'I');

?>
