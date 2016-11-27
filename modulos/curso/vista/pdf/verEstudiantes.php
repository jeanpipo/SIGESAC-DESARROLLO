<?php

	$estudiantes = Vista::obtenerDatos();
	$leyenda = Vista::obtenerDato("leyenda");
	$curso = Vista::obtenerDato("datocurso");

	$nombreArchivoDestino = "curso_" . $curso[0]["codigo"] . "_acta_notas.pdf";
	$estados = array();
	/*arma el arreglo estados con la siguiente estructura
	   pos / columna         nombre        cantidad
	   *    "R"             Reprobado          0
	   *    "A"             Aprobado           0
	   *    ....
	   *
	   * ej:   $estados["R"]["nombre"] == "Reprobado"
	   */
	for($j = 0; $j < count($leyenda); $j++){
		$estados[$leyenda[$j]['codigo']]['nombre'] = $leyenda[$j]['nombre'];
		$estados[$leyenda[$j]['codigo']]['cantidad'] = 0;
	}

/*
	$estados["A"] = 0; //aprobado
	$estados["C"] = 0; //Cursando
	$estados["E"] = 0; //Retirado
	$estados["I"] = 0; //Inscrito
	$estados["N"] = 0; //Reprobado por iNasistencia
	$estados["P"] = 0; //Preinscrito
	$estados["R"] = 0; //Reprobado
*/

	//inicializaciones
	$altoCelda = 4;

	if(isset($estudiantes['estudiante'])){
		$conta = 0;
		$contr = 0;
		$nota = 0;
		$fec = getdate();

		$pdf = new FPDF('p','mm','Letter');

		$pdf->AddPage();
		$pdf->SetFont('Arial','B',11);
		$pdf->SetTextColor(0);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetLeftMargin(15);
		$pdf->SetTopMargin(20);

		$pdf->Image('recursos/imgPropias/fotos/iut.png',20);
		//$pdf->Image('recursos/imgPropias/fotos/head.png',70,10,200);

		$pdf->SetFont('Arial','B',14);
		$pdf->Cell(0,$altoCelda,"ACTA DE NOTAS",0,0,'C',true);
		$pdf->Ln();

		$pdf->SetFont('Arial','',11);
		$pdf->Cell(40,$altoCelda,"Instituto",1,0,'C',true);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0);
		$pdf->SetFont('Arial','',11);
		$pdf->Cell(130,$altoCelda,$estudiantes['estudiante'][0]['insti'],1,0,'C',true);
		$pdf->Ln();

		$pdf->SetFont('Arial','',11);
		$pdf->Cell(40,$altoCelda,"Carrera",1,0,'C',true);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0);
		$pdf->SetFont('Arial','',11);
		$pdf->Cell(130,$altoCelda,$estudiantes['estudiante'][0]['nombrepensum'],1,0,'C',true);
		$pdf->Ln();

		$pdf->SetFont('Arial','',11);
		$pdf->Cell(40,$altoCelda,"Periodo Académico",1,0,'C',true);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0);
		$pdf->SetFont('Arial','',11);
		$pdf->Cell(130,$altoCelda,$estudiantes['estudiante'][0]['periodo'],1,0,'C',true);
		$pdf->Ln();

		$pdf->SetFont('Arial','',11);
		$pdf->Cell(40,$altoCelda,"Tray./Año-Sección",1,0,'C',true);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0);
		$pdf->SetFont('Arial','',11);
		$pdf->Cell(130,$altoCelda,"Trayecto: ".$estudiantes['estudiante'][0]['num_trayecto'] . " - Sección: " . $estudiantes['estudiante'][0]['seccion'] ,1,0,'C',true);
		$pdf->Ln();

		$pdf->SetFont('Arial','',11);
		$pdf->Cell(40,$altoCelda,"U.Curricular / Profesor",1,0,'C',true);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0);
		$pdf->SetFont('Arial','',11);
		$pdf->Cell(130,$altoCelda,$estudiantes['estudiante'][0]['nombreuni'] . " / " . $estudiantes['estudiante'][0]['nombredocente'],1,0,'C',true);
		$pdf->Ln();

		$pdf->SetFont('Arial','',11);
		$pdf->Cell(40,$altoCelda,"Nota Aprobatoria",1,0,'C',true);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0);
		$pdf->SetFont('Arial','',11);
		$uc = $estudiantes['estudiante'][0]['uni_credito'];
		if ($uc == 1) $cad = "($uc unidad de crédito)";
		     else    $cad = "($uc unidades de crédito)";
		$pdf->Cell(130,$altoCelda,$estudiantes['estudiante'][0]['not_min_aprobatoria']."/".$estudiantes['estudiante'][0]['not_maxima'] . " $cad",1,0,'C',true);
		$pdf->Ln();

		$pdf->SetFont('Arial','',11);
		$pdf->Cell(40,$altoCelda,"Fecha de Emisión",1,0,'C',true);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0);
		$pdf->SetFont('Arial','',11);
		if($fec['hours']>12){
			$fec['hours']-=12;
			$a = "PM";
		}else if($fec['hours']==0){
			$fec['hours']=12;
			$a = "AM";
		}else
			$a = "AM";
		$pdf->Cell(130,$altoCelda,$fec['hours'].":".$fec['minutes'].$a." - ".$fec['mday']."/".$fec['mon']."/".$fec['year'],1,0,'C',true);
		$pdf->Ln();

		$pdf->Ln();
		$pdf->SetFont('Arial','B',14);
		$pdf->SetTextColor(0);
		$pdf->Cell(0,$altoCelda,"NOTAS",0,0,'C',true);
		$pdf->Ln();
		$pdf->SetFont('Arial','B',11);


		$pdf->Cell(15,$altoCelda,"#",1,0,'C',true);
		$pdf->Cell(35,$altoCelda,"Cédula",1,0,'C',true);
		$pdf->Cell(55,$altoCelda,"Apellidos y Nombre",1,0,'C',true);
		$pdf->Cell(25,$altoCelda,"Asistencia",1,0,'C',true);
		$pdf->Cell(15,$altoCelda,"Nota",1,0,'C',true);
		$pdf->Cell(25,$altoCelda,"Res.",1,0,'C',true);
		$pdf->Ln();

		$pdf->SetFont('Arial','',10);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0);

		for($i=0;$i<count($estudiantes['estudiante']);$i++){
			$pdf->Cell(15,$altoCelda,$i+1,1,0,'C',true);
			$pdf->Cell(35,$altoCelda,$estudiantes['estudiante'][$i]['cedula'],1,0,'C',true);
			$pdf->Cell(55,$altoCelda,$estudiantes['estudiante'][$i]['nombreestudiante'],1,0,'C',true);
			$pdf->Cell(25,$altoCelda,$estudiantes['estudiante'][$i]['por_asistencia']."%",1,0,'C',true);
			$pdf->Cell(15,$altoCelda,$estudiantes['estudiante'][$i]['nota'],1,0,'C',true);


			$pdf->Cell(25,$altoCelda,$estudiantes['estudiante'][$i]['codestado'],1,0,'C',true);

/*
			if($estudiantes['estudiante'][$i]['codestado'] == 'A')
				$conta++;
			else if(($estudiantes['estudiante'][$i]['codestado'] == 'N')||($estudiantes['estudiante'][$i]['codestado'] == 'R'))
				$contr++;
*/

			$e = $estudiantes['estudiante'][$i]['codestado'];
			//contar la cantidad de estudiantes en cada estado
			if (empty($estados[$e]['cantidad']))
				$estados[$e]['cantidad'] = 1;
			else
				$estados[$e]['cantidad']++;

			//sumar las notas para luego sacar el promedio
			if (($e == "R") or ($e == "A"))
				$nota += $estudiantes['estudiante'][$i]['nota'];



			$pdf->Ln();
		}

		//impresion de la leyenda *******************
		$cadena = "Leyenda:  ";
		$pdf->SetFont('Arial','',10);
		if($leyenda != NULL){
			for($j = 0; $j < count($leyenda); $j++){
					$cadena .= "(".$leyenda[$j]['codigo'].") ".$leyenda[$j]['nombre'].";  ";
				if((($j % 4  == 0)&&($j != 0))||(($j+1) == count($leyenda))){

					$pdf->Cell(0,5,$cadena,0,0,'',true);
					$pdf->Ln();
					$cadena = "     ";

				}
			}
		}
		// Fin impresión leyenda

		// impresión datos estadísticos
		$cadena = "Estadístico:  ";
		$pdf->SetFont('Arial','',10);
		if($leyenda != NULL){
			$validos = $estados["R"]["cantidad"] + $estados["A"]["cantidad"];
				if ($validos == 0) $validos = 1;
				$rep = round(($estados["R"]["cantidad"])/($validos) * 100, 2);
				$apr = round(($estados["A"]["cantidad"])/($validos) * 100, 2);
				$prom = round($nota / $validos,2);
				//$cadena .= $estados["N"]["nombre"] . ": " . $estados["N"]["cantidad"] . ";  ";
				$cadena .= $estados["R"]["nombre"] . ": " . $estados["R"]["cantidad"] . " ($rep%);  ";
				$cadena .= $estados["A"]["nombre"] . ": " . $estados["A"]["cantidad"] . " ($apr%);  ";
				$pdf->Cell(0,5,$cadena,0,0,'',true);
				$cadena = "       Promedio: " . $prom;
				$pdf->Ln();
				$pdf->Cell(0,5,$cadena,0,0,'',true);

				$cadena = "";


		}


		$pdf->SetFont('Arial','B',11);


/*
		//data estadística
		* Total válidos (aprobados + reprobados): 10
		* Reprobados por inasistencia:     8
		* Aprobados:                       4   (40%)
		* Reprobados(asistentes):          6    (60%)
		* Promedio:                      10.05
		*
		*
		*
		$pdf->Ln();
		$pdf->Cell(0,8,"Datos Estadísticos",0,0,'C',true);
		$pdf->Ln();
		$pdf->SetFont('Arial','',11);
		$cadena = "";
		foreach ($estados as $clave => $valor){
			$cadena .= "$clave: $valor;     ";
		}
		$pdf->Cell(0,8,$cadena,0,0,'C',true);
		$pdf->SetFont('Arial','',11);
		$pdf->Ln();
*/




/*
		$pdf->Ln();
		$pdf->Cell(0,8,"Datos Estadísticos",0,0,'C',true);
		$pdf->Ln();
		$pdf->SetFont('Arial','',11);
		$pdf->Cell(0,8,"Promedio: ".$nota/$i."            Aprobados: ".$conta."/".$i." - ".$conta/$i*(100)."%                     Reprobados: ".$contr."/".$i." - ".$contr/$i*(100)."%",0,0,'C',true);
		$pdf->SetFont('Arial','',11);
		$pdf->Ln();
*/

		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell(0,$altoCelda,"______________________________",0,0,'C',true);
		$pdf->Ln();
		$pdf->Cell(0,$altoCelda,"Prof. ".$estudiantes['estudiante'][0]['nombredocente'],0,0,'C',true);
		$pdf->Ln();
		$pdf->Cell(0,$altoCelda,"C.I. ".$estudiantes['estudiante'][0]['ceduladoc'],0,0,'C',true);

//		$pdf->Output("ACTA DE NOTAS_".$estudiantes['estudiante'][0]['nombreuni'].".pdf", 'D');
		$pdf->Output($nombreArchivoDestino, 'D');
	}
	else{
		$pdf = new FPDF('p','mm','A4');

		$pdf->AddPage();
		$pdf->SetFont('Arial','B',11);
		$pdf->SetTextColor(0);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetLeftMargin(15);
		$pdf->SetTopMargin(20);

		$pdf->Image('recursos/imgPropias/fotos/iut.png',20);
		//$pdf->Image('recursos/imgPropias/fotos/head.png',70,10,200);

		$pdf->SetFont('Arial','B',14);
		$pdf->Cell(0,10,"SE HA PRODUCIDO UN ERROR,",0,0,'C',true);
		$pdf->Ln();
		$pdf->Cell(0,10,"VERIFIQUE LA INFORMACIÓN DEL CURSO,",0,0,'C',true);
		$pdf->Ln();
		$pdf->Output("Error.pdf", 'D');
	}

?>
