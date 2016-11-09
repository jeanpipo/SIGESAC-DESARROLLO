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
	<table width="100%" border="1">

		<tr>
			<th colspan="3">
				<font size="5">
					Cedula
				</font>
			</th >

			<th colspan="3">
				<font size="5">
					Apellidos
				</font>
			</th>

			<th colspan="3">
				<font size="5">
					Nombres
				</font>
			</th>

			<th colspan="3">
				<font size="5">
					E-mail
				</font>
			</th>

		</tr>
		<?php
			for($x=0;$x<count($persona);$x++){
			if($x%2==0)
				echo '<tr bgcolor="#E9EBF9F">';
			else
				echo '<tr >';
		?>
		
			<th colspan="3" ><font size="4"><?php echo $persona[$x]["cedula"];?></font></th>
			<th colspan="3"><font size="4"><?php echo htmlentities($persona[$x]["apellido1"]." ".$persona[$x]["apellido2"]);?></font></th>
			<th colspan="3"><font size="4"><?php echo htmlentities($persona[$x]["nombre1"]." ".$persona[$x]["nombre1"]);?></font></th>
			<th colspan="3"><font size="4"><?php echo htmlentities($persona[$x]["cor_personal"]);?></font></th>
		</tr>
		<?php
			}
		?>
	</table>
</body>
</html>
