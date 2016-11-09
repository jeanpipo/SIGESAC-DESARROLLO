<html>
	<head>
		<meta charset="UTF-8">

		<link href="recursos/assets/css/bootstrap.css" rel="stylesheet">
		
		<link href="recursos/assets/css/main.css" rel="stylesheet">
		
		<style>
		.body404, .head404, .eyes404, .leftarm404, .rightarm404, .chair404, .leftshoe404, .rightshoe404, .legs404, .laptop404 {
			background: url(base/clases/utilitarias/errores/vista/html5/40<?=rand(2,2)?>.png) 0 0 no-repeat;
			width: 150px;
			height: 150px;
		}
		</style>
		<link href="base/clases/utilitarias/errores/vista/html5/error.css" rel="stylesheet">
		
	</head>
	<body>

		

<div class="error404page">
  <div class="newcharacter404">
		<div class="chair404"></div>
		<div class="leftshoe404"></div>
		<div class="rightshoe404"></div>
		<div class="legs404"></div>
		<div class="torso404">
		<div class="body404"></div>
		<div class="leftarm404"></div>
		<div class="rightarm404"></div>
		<div class="head404">
		<div class="eyes404"></div>
      </div>
    </div>
    <div class="laptop404"></div>
  </div>
</div>

<?php if($codigo != null){ ?>
	<div class="row">
		<div class="col-md-5">
			
		</div>
		<div class="col-md-6">
			<h1>Disculpen los inconvenientes.</h1>
			<h2>Contácte con soporte o reporte el error con el siguiente diagnóstico:</h2>
		</div>
	</div>
	<br>
	<br>
	<br>
	<br>
	<div class="row">
		<div class="col-md-5">
			
		</div>
		<div class="col-md-6">
			<h3>Código de reporte: <p><?=$codigo?></p></h2>
			<h3>Indicio para el reporte: <p><?=$mensaje?></p></h2>
		</div>
	</div>
	<br>
	<br>
	<br>
	<br>
	<?php } else{?>
	<div class="row">
		<div class="col-md-5">
			
		</div>
		<div class="col-md-6">
			<h1 style="font-size:60px"><a style="cursor:wait">404</a> NO ENCONTRADO</h1>
			<br>
	<br>
	<br>
	<br>
			<h2>La ruta a la que desea ingresar no existe.</h2>
			<h2>Verifique nuevamente la petición y si persiste el problema, contácte con soporte.</h2>
		</div>
	</div>
	<br>
	<br>
	<br>
	<br>
	<?php } ?>
	<div class="row">
		<div class="col-md-5">
			
		</div>
		<div class="col-md-6">
			<h3>Pulse <a href="index.php">AQUÍ</a> para volver al inicio.</h3>
			
			<?php 	if($mensaje == "Datos de autenticación incorrectos. Revise su usuario y password") 	
						$errS = 0;
					else 
						$errS = 1; 
						
			if($errS == 1) { ?>
			
			
			
			
			<script src="recursos/assets/js/jquery.min.js"></script>	
			<script src="recursos/assets/js/bootstrap.min.js"></script>	
			<script src="recursos/javascript/LibreriaMVC.js"></script>
			
			<script src="modulos/error/vista/html5/js/error.js"></script>			
			<script src="recursos/assets/js/main.js"></script>
			<script src="recursos/javascript/validaciones.js"></script>
			
				
			<h3>Pulse <a href="javascript:reportarError()">AQUÍ</a> para reportar la incidencia.</h3>
			
			<?php } ?>
			
		</div>
	</div>
	

	</body>
</html>
