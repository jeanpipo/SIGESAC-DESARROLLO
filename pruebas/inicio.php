<?
require('fpdf.php');

class PDF extends FPDF
{

//Pie de página
	function Header()
	{

	$this->SetY(10);

	$this->SetFont('Arial','I',8);

	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	   }
}

//Creación del objeto de la clase heredada
	$pdf = new PDF('l','mm','letter');

	$pdf->AliasNbPages();
	
	$pdf->AddPage();
	$pdf->Ln();
	$pdf->SetFont('Arial','B',11);
	$pdf->SetTextColor(0);
	$pdf->SetFillColor(255,255,255);
	$pdf->SetLeftMargin(15);
	$pdf->SetTopMargin(22);
	
	$pdf->SetFont('Arial','B',14);

//Aquí escribimos lo que deseamos mostrar
	$pdf->SetFont('Arial','B',14);

for ($i = 1; $i < 50; $i++){
	$pdf->Cell(0,5,"LISTADO DE ASISTENCIA / "	 ,0,0,'',true);
	$pdf->Ln();
}



$pdf->Output("archivo.pdf",'I');
?> 
