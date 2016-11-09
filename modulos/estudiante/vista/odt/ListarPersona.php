<?php
	
	$persona=Vista::obtenerDato("persona");

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

</head>

<body>
	<table cellpadding="0" border="1">

		<tr>
			<th>
				Cedula
			</th >

			<th>
				Apellidos				
			</th>

			<th>				
				Nombres				
			</th>

			<th>				
				E-mail				
			</th>

		</tr>
		<?php
			for($x=0;$x<count($persona);$x++){
			
		?>
		<tr>
			<th ><?php echo $persona[$x]["cedula"];?></th>
			<th ><?php echo htmlentities($persona[$x]["apellido1"]." ".$persona[$x]["apellido2"]);?></th>
			<th ><?php echo htmlentities($persona[$x]["nombre1"]." ".$persona[$x]["nombre2"]);?></th>
			<th ><?php echo htmlentities($persona[$x]["cor_personal"]);?></th>
		</tr>
		<?php
			}
		?>
	</table>
</body>
</html>
