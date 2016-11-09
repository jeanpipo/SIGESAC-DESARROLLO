<?php
try{

	require_once '../../../base/clases/basededatos/Conexion.php';

	require_once 'PensumServicio.php';
	require_once "../../../negocio/Pensum.php";

	
	Conexion::iniciar("localhost","bd_scnfinal","5432","postgres","5455");
	echo "<pre>";
	
	echo "----------lista de institutos -----------------------\n";
	
//	$ins = PensumServicio::listarPensum();

//	 var_dump($ins);

	
	echo "----------------obtener por codigo un instituto-------------------\n";
	
	 $ins2 = PensumServicio::obtener(1);

		var_dump($ins2);

	echo "----------------Agregar un instituto-------------------\n";


	//$a   = PensumServicio::agregarInstituto("iut federico palacio","iut3", "km8");
	//echo "Código del instituto agregado:   $a\n";
	

	echo "----------------Eliminar un instituto-------------------\n";

	// PensumServicio::eliminar(10);

	echo "----------------Modificar un instituto-------------------\n";


//	 PensumServicio::modificarInstituto(10,"iut federico 3","iut3 mod", "km8");


	echo "</pre>";

}catch(Exception $e){
	echo $e;
	
}





?>
