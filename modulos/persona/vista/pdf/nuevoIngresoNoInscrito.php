<?php
	$pdf = new FPDF('p','mm','A4');

		$persona=Vista::obtenerDato("personasYaRegistradas");
		//var_dump($persona);
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',11);
		$pdf->SetTextColor(0);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetLeftMargin(15);
		$pdf->SetTopMargin(20);

		$pdf->SetFont('Arial','B',14);
		$pdf->Cell(0,10,"LISTA DE ESTUDIANTES QUE YA ENCUENTRAN REGISTRADAS ",0,1,'C',true);
		$pdf->Cell(0,10,"POR LO QUE DEBEN SER REGISTRADAS MANUALMENTE",0,1,'C',true);
		$pdf->Cell(0,10,"EN EL MODULO DE ESTUDIANTES",0,1,'C',true);
		$pdf->Ln();

		$pdf->SetFont('Arial','B',11);
		$pdf->Cell(20,7,"Cedula",1,0,'C',true);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0);
		$pdf->SetFont('Arial','B',11);
		$pdf->Cell(50,7,"Apellidos",1,0,'C',true);
		$pdf->SetFont('Arial','B',11);
		$pdf->Cell(50,7,"Nombre",1,0,'C',true);
		$pdf->SetFont('Arial','B',11);
		$pdf->Cell(70,7,"e-mail",1,0,'C',true);

		$pdf->Ln();
			
		$datosSplit="";
		for($x=1; $x<count($persona); $x++){
			$datosSplit=explode(";",$persona[$x]);
			$pdf->SetFont('Arial','B',11);
			$pdf->Cell(20,7,$datosSplit[2],1,0,'C',true);
			$pdf->SetFillColor(255,255,255);
			$pdf->SetTextColor(0);
			$pdf->SetFont('Arial','B',11);
			$pdf->Cell(50,7,$datosSplit[1],1,0,'C',true);
			$pdf->SetFont('Arial','B',11);
			$pdf->Cell(50,7,$datosSplit[0],1,0,'C',true);
			$pdf->SetFont('Arial','B',11);
			$pdf->Cell(70,7,$datosSplit[3],1,0,'C',true);
			$pdf->Ln();
		}

		$pdf->Output("ListadoDePersonas.pdf", 'I');
?>