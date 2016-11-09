<?php
	require_once("Permisos.php");
	$permisos= new Permisos();
	$permisos->iniciar();
	$permisos->agregarAccion("institutoListar",true);
	$permisos->agregarAccion("institutoModificar",true);
	$permisos->agregarAccion("institutoAgregar",true);
	$permisos->agregarAccion("institutoEliminar",false);
	if ($permisos->obtenerPermiso("institutoEliminar"))
		echo" tengo permiso";
	else
		echo " no tengo permiso";
		
		
	echo($permisos->obtenerJavascript('per'));
?>


<html5>
<script type="text/javascript">  <?php echo($permisos->obtenerJavascript('PER')); ?>  </script>

<script type="text/javascript">  alert(PER ); </script>

<script type="text/javascript">  alert(PER.institutoListar ); </script>

</html5>
