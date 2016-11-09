<?php
	function obtenerDirectorios(){
		$cmd = " cd .. && ls -1";
		
		$directorios = shell_exec($cmd);

		return explode(chr(10),$directorios);
	}
	
	function generarBloque($mod,$tipo){
		$cad = "";
		
		if($tipo == 2)
			$cad .= "else ";
			
		$cad .= "if($"."modulo == '$mod'){".
					"\n\trequire_once '".obtenerRuta($mod)."';".
					"\n\t".obtenerAccionControlador($mod).
					"\n}\n";
		
		return $cad;		
	}
	
	function obtenerRuta($cad){
		return "modulos/$cad/".obtenerMayuscula($cad)."Controlador.php";
	}
	
	function obtenerMayuscula($cad){
		$scad = strtoupper($cad[0]);
		
		for($i = 1; $i < strlen($cad); $i++)
			$scad .= $cad[$i];
			
		return $scad;
	}
	
	function obtenerAccionControlador($cad){
		return obtenerMayuscula($cad)."Controlador::manejarRequerimiento();";
	}
	
	function grabarArchivo(){
		$arch = fopen("Bloque.php","w+");
		
		fwrite($arch,"<?php\n\n");
		
		$directorios = obtenerDirectorios();
		
		for($i = 0; $i < count($directorios); $i++){
			if($directorios[$i] != ""){
				if($i == 0)
					fwrite($arch,generarBloque($directorios[$i],1));
				else
					fwrite($arch,generarBloque($directorios[$i],2));
			}
			else
				break;
		}
		fwrite($arch,"else \n\tthrow new Exception ('(PrincipalControlador) Módulo inválido: $"."modulo')");
		
		fwrite($arch,"\n?>");
		
		fclose($arch);
	}
	
	grabarArchivo();
	
?>
