<?php
		
		$persona=Vista::obtenerDato("persona");


		$pdf = new FPDF('p','mm','A4');

		$pdf->AddPage();
		$pdf->SetFont('Arial','B',11);
		$pdf->SetTextColor(0);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetLeftMargin(15);
		$pdf->SetTopMargin(20);

		$pdf->SetFont('Arial','B',14);
		$pdf->Cell(0,10,"LISTA DE PERSONAS",0,0,'C',true);
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
		$pdf->Cell(70,7,"E-mail",1,0,'C',true);
		
		$pdf->Ln();


		for($x=0; $x<count($persona); $x++){
			$pdf->SetFont('Arial','B',11);
			$pdf->Cell(20,7,$persona[$x]["cedula"],1,0,'C',true);
			$pdf->SetFillColor(255,255,255);
			$pdf->SetTextColor(0);
			$pdf->SetFont('Arial','B',11);
			$pdf->Cell(50,7,$persona[$x]['apellido1']." ".$persona[$x]["apellido2"],1,0,'C',true);
			$pdf->SetFont('Arial','B',11);
			$pdf->Cell(50,7,$persona[$x]["nombre1"]." ".$persona[$x]["nombre2"],1,0,'C',true);
			$pdf->SetFont('Arial','B',11);
			$pdf->Cell(70,7,$persona[$x]["cor_personal"],1,0,'C',true);
			$pdf->Ln();
		}
	
		$pdf->Output("ListadoDePersonas.pdf", 'D');
?>