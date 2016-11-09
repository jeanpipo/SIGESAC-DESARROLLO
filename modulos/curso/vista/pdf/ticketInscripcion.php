<?php
    $info = Vista::obtenerDato("ticket");
    if($info){
        $pdf = new FPDF('p','mm',array(130,200));

        $pdf->AddPage();
        $pdf->SetFont('Arial','B',10);
        $pdf->SetTextColor(0);
        $pdf->SetFillColor(255,255,255);

        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0,5,"TICKET DE INSCRIPCIÓN",0,0,'C',true);
        $pdf->Ln();

        $pdf->SetFont('Arial','',10);
        $pdf->Cell(0,5,$info[0]['nombreinst'],0,0,'C',true);
        $pdf->Ln();

        $pdf->SetFont('Arial','',10);
        $pdf->Cell(0,5,$info[0]['nombrepensum'],0,0,'C',true);
        $pdf->Ln();

        $pdf->SetFont('Arial','',10);
        $pdf->Cell(0,5,$info[0]['nombreper'],0,0,'C',true);
        $pdf->Ln();

        $pdf->SetFont('Arial','',10);
        $pdf->Cell(0,5,$info[0]['nombreest']." ".$info[0]['nacionalidad']."-".$info[0]['cedula'],0,0,'C',true);
        $pdf->Ln();
        $pdf->Ln();

        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(25,5,'Unidad Curricular',1,0,'C',true);
        $pdf->Cell(20,5,'Docente',1,0,'C',true);
        $pdf->Cell(15,5,'Cod Curso',1,0,'C',true);
        $pdf->Cell(15,5,'Sección',1,0,'C',true);
        $pdf->Cell(30,5,'Orden/Capacidad',1,0,'C',true);
        $pdf->Ln();

        $pdf->SetFont('Arial','',7);
        for($i = 0; $i < count($info); $i++){
            if(strlen($info[$i]['nombreuni']) > 18)
                $pdf->Cell(25,5,substr($info[$i]['nombreuni'],0,15)."...",1,0,'C',true);
            else
                $pdf->Cell(25,5,$info[$i]['nombreuni'],1,0,'C',true);
            $pdf->Cell(20,5,$info[$i]['nombredoc'],1,0,'C',true);
            $pdf->Cell(15,5,$info[$i]['codcurso'],1,0,'C',true);
            $pdf->Cell(15,5,$info[$i]['seccion'],1,0,'C',true);
            $pdf->Cell(30,5,$info[$i]['orden']."/".$info[$i]['capacidad'],1,0,'C',true);
            $pdf->Ln();
        }

        $pdf->Ln();
        $pdf->Cell(0,5,'    _____________________________                                  _____________________________',0,0,'C',true);
        $pdf->Ln();
        $pdf->Cell(0,5,'  Firma de Estudiante                                                                 Firma de personal de inscripción',0,0,'C',true);
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Cell(0,5,"Sello del Departamento",0,0,'C',true);
        $pdf->Ln();
        $a = getdate();
        $hora = "am";
        if($a['hours'] > 12){
            $a['hours'] -= 12;
            $hora = "pm";
        }
        else if($a['hours'] == 12){
            $hora = "pm";
        }
        $pdf->Cell(0,5,"Este ticket fue generado por el Sistema de Gestión Académica (SISGESAC) el ".$a['mday']."/".$a['mon']."/".$a['year']." a las ".$a['hours'].":".$a['minutes'].$hora,0,0,'C',true);
        $pdf->Output($info[0]['nombreper']."-".$info[0]['nombreest']."TICKET_INSCRIPCION".".pdf", 'D');
    }
    else{
        throw new Exception("No se puede generar el PDF.");
    }
?>
