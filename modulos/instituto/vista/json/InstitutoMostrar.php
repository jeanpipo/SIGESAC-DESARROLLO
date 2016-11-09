<?php

$institutos = $this->obtenerDato('institutos');
$instituto = $institutos[0];

if ($instituto) {
	$cad=json_encode($instituto);
	echo $cad;
}else
	echo "[{\"codigo\":\"ERROR\",\"nombre\":\"ERROR\",\"nombreCorto\":\"ERROR\",\"descripcion\":\"ERROR\"}]";




?>
		
