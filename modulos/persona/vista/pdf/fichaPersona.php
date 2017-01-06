<?php
	
	$persona=Vista::obtenerDato("persona");
	$estudiante=Vista::obtenerDato("estudiante");
	$empleado=Vista::obtenerDato("empleado");

	$pdf = new FPDF('p','mm','A4');

	$pdf->AddPage();
	$pdf->SetFont('Arial','B',11);
	$pdf->SetTextColor(0);
	$pdf->SetFillColor(255,255,255);
	$pdf->SetLeftMargin(15);
	$pdf->SetTopMargin(20);

	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(0,10,"FICHA PERSONAL",0,0,'C',true);
	$pdf->Ln();
	
	$pdf->Output("ListadoDePersonas.pdf", 'I');
?>
