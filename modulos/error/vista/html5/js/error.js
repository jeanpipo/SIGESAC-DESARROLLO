
/*
 * * * * * * * * * * LICENCIA * * * * * * * * * * * * * * * * * * * * *

Copyright(C) 2015
pensum Universtiario de Tecnología Dr. Federico Rivero Palacio

Este programa es Software Libre y usted puede redistribuirlo y/o modificarlo
bajo los términos de la versión 3.0 de la Licencia Pública General (GPLv3)
publicada por la Free Software Foundation (FSF), es distribuido sin ninguna
garantía. Usted debe haber recibido una copia de la GPLv3 junto con este
programa, sino, puede encontrarlo en la página web de la FSF, 
específicamente en la dirección http://www.gnu.org/licenses/gpl-3.0.html

 * * * * * * * * * * ARCHIVO * * * * * * * * * * * * * * * * * * * * *

Nombre: error.js
Diseñador:Jean Pierre Sosa.
Programador:Jean Pierre Sosa.
Lider de proyecto: Johan Alamo (johan.alamo@gmail.com)
Fecha:22-04-2015
Descripción:  
	Este es el javascript del módulo error, encargado de todas las 
	llamadas AJAX, objetos DOM y validaciones de dicho módulo. 

 * * * * * * * * Cambios/Mejoras/Correcciones/Revisiones * * * * * * * *
Diseñador - Programador /   Fecha   / Descripción del cambio
   

 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
*/


/*
 * Funcion en JavaScript que permite  reportar un nuevo error.
 * 
 * En esta funcion se crea un dialogo en donde se montan  
 * todos los campos para ser llenado por el usuario.
 * 
 */ 
function reportarError(){
	crearDialogo("reportarError",'Reportar Error','Llene el formulario con los datos del error',1,'agregarError()','Reportar Error',true);

	cadena = '';

	cadena+='<div class="row">';

	cadena+='<div class="col-md-12">';

	cadena+='<h4>Introduzca código del error: </h4><input type="text" class="form-control" onkeyup="validarSoloNumeros(\'#codError\',false)" placeholder="Código del Error (Si lo conoce, no es requerido)" id="codError">';

	cadena+='<h4>Descripción del error:</h4> <textarea type="text" onkeyup="validarRangos(\'#descError\',5,255,true)" class="form-control" placeholder="Describa el error" id="descError" />';

	cadena+='</div>';

	cadena+='</div>'; 

	$("#reportarError .modal-body").append(cadena);

	//$('.modal-body').load("ruta", function(){});

	$('#reportarError').modal('show');
}


/*
 * Funcion en JavaScript que permite validar si un reporte de error.
 * 
 * Se valida que el campo descripcion de error no este vacio y que
 * el campo codigo de error no poseea letras ni espacios en blancos.
 * Una de las funciones que hacen llamado a esta funcion es reportarError() 
 * en este mismo archivo (error.js)
 * y los ID son los siguientes: id="descError" , id="codError".   
 */
function validarError(){
	if((validarSoloNumeros("#codError",false))&&(validarRangos("#descError",5,255,true)))
		return true;
	else
		return false;
}


/*
 * Funcion JavaScript que permite agregar un nuevo error.
 * 
 * Se envia la informacion obtenida en la funcion  reportarError()
 * ubicada en el archivo error.js al controlador de error por 
 * medio del uso de AJAX.
 * Luego en el controlador se ejecutara el metodo agregarError() 
 * y se ejecutaran las funciones necesarias para que el reprote
 * se almacene en la base de datos.
 */
function agregarError(){
	if(validarError()){		
		var arr = Array("m_modulo"	,	"error",
						"m_accion"	,	"agregarError",
						"codError"	,	$("#codError").val(),
						"descError"	,	$("#descError").val()
						);

		ajaxMVC(arr, succAgregarErrores, error);
	}
}


/*
 * Funcion JavaScript que permite borrar una ventana modala.
 * 
 * Si el reporte de error se envio con exito por medio del AJAX
 * usando la funcion agregarError() ubicado en el archivo error.js
 * entonces se va a enviar un mensaje de exito y luego se van a 
 * borrar la ventana modal.
 */
function succAgregarErrores(data){
	mostrarMensaje(data.mensaje, 1);
	$('#reportarError').modal('hide');
		$('#reportarError .modal-body').remove();
}


/*
 * Funcion JavaScript que permite listar los reportes de errores.
 *
 * Se envia todos los estados de error seleccionados por el usuario
 * en la funcion montarErrores() (ubicada en el archivo error.js)
 * haciendo uso del ajax, enviandose asi al modulo "error" y llamando
 * a la funcion "listar" en ErrorControlador.php. 
 * Por otra parte se estara creando una ventana modal para mostrar
 * los errores obtenidos, en el caso de que los haya.
 */ 
function verErrores(){

	var arr = Array("m_modulo"	,	"error",
					"m_accion"	,	"listar",
					'codigo_estado', $("#estadoErrorL").val());

	
	if($("#listarErr").length == 0)
		crearDialogo("listarErr",'Lista de Errores','',1100,'','',true);
		
	ajaxMVC(arr,succListarErrores,error);
}


/*
 * Funcion JavaScript que permite mostrar los resportes de error obtenidos.
 * 
 * Si los reportes de error se listaron con exito por medio del AJAX
 * usando la funcion verErrores() ubicado en el archivo error.js
 * entonces se van a mostrar todos los reportes de error obtenidos
 * en el caso de no haber ningun reporte de error entonces se mostrara
 * un mensaje de error.
 */
function succListarErrores(data){
	if(data.estatus > 0){
		montarErrores(data.errores,data.estado,data.estado_completo);
	}
	else
		mostrarMensaje(data.mensaje,4);
}


/*function selectEstados (estado,errores)
{
	cadena="";
	cadena +="<select class='selectpicker' id='estadoError' title='Estado del Reporte' data-live-search='true' data-size='auto'  data-max-options='1'>";
	for(var i=0;i<estado.length;i++)
	{
		if(errores[0]['cod_estatus']!=estado[i]['codigo'])
			cadena += "<option value='"+estado[i]['codigo']+"'>"+estado[i]['nombre']+"</option>";
		else
			cadena += "<option selected='selected' value='"+errores[0]['cod_estatus']+"'>"+estado[i]['nombre']+"</option>";
	}
	cadena +="</select>";
	$(cadena).appendTo("#estadoErrores");
	$("#estadoError").remove();
}*/


/*
 * Funcion en JavaScript que permite mostrar los reportes de error.
 * 
 * esta funcion recibe tres parametros:
 * 
 * var errores 				Contiene la informacion de los reportes de error consultada en la base de datos 
 * var estado				Contiene la informacion de los estados de error que fueron ser seleccionados para ser mostrados
 * var estado_completo 		Contiene todos los estados de error que hay almacenado en la base de datos.
 * 
 * Aqui se muestran todos los reportes de error para
 * luego ser adherido a una ventana modal que es 
 * en donde el usuario va a poder visualizar todos los
 * reportes de error.
 */ 
function montarErrores(errores,estado,estado_completo){
	if(errores != null){
		$("#idTabla ").remove();
		//$("#estadoErrores").remove();
		cadena = '';

		cadena +='<div class="row">';

		cadena +='<div class="col-md-12">';
		
		// Hace que el select no se repita cada vez que se llame a esta funcion
		if ($("#estadoErrorL").length == 0){
			
			cadena +="<b> Estado del Error: </b>";
			/*
			 * Este select sirve para filtrar los reportes que se van a mostrar por estado de error 
			 * (un ejemplo de estado de error son: "en proceso","reportado","corregido", etc).
			 */ 
			cadena +="<select onchange='verErrores()' class='selectpicker' id='estadoErrorL' title='Estado del Reporte' data-live-search='true' data-size='auto' data-max-options='12' multiple >";
			
		
		for(var i=0;i<estado_completo.length;i++)
		{
			cadena += "<option  value='"+estado_completo[i]['codigo']+"'>"+estado_completo[i]['nombre']+"</option>";
		}		
		
		cadena +="</select>";		
					
		}	
		cadena += '<table class="table" id="idTabla" >';
		cadena += '<tr class="titulo">';
		cadena += '<td> Código </td>';
		cadena += '<td> Código del Error </td>';
		cadena += '<td> Estatus </td>';
		cadena += '<td> Descripción </td>';
		cadena += '<td> respuesta </td>';
		cadena += '<td> Usuario que reportó </td>';
		cadena += '<td> Error</td>';
		cadena += '<td></td>';
		cadena += '</tr>';
		
		/*
		 * El primer for sirve para recorrer los estados que fueron filtrados
		 * por el usuario este es el primer for ---> for(var x=0;x<estado.length; x++)
		 * 
		 * el segundo for sirve para recorrer todos los resportes que 
		 * estan alamacenados en la base de datos.
		 */ 
		 
		for(var x=0;x<estado.length; x++)
		{
			for(var i = 0; i < errores.length; i++)
			{
				/*
				 * si el estado del error tiene el mismo estado que el usuario filtro
				 * para mostrar los errores, entonces se van a mostrar,
				 * pero de lo contrario si los errores son diferentes entonces no
				 * se va a mostrar ningun reporte 
				 */
				 
				if(errores[i]['nombre']==estado[x]['nombre'])
				{			
					cadena += '<tr style="text-align:center">';
					cadena += '<td>'+errores[i]['codigo'] + '</td>';
					cadena += '<td>'+errores[i]['cod_error'] + '</td>';
					cadena += '<td>'+errores[i]['nombre'] + '</td>';
					cadena += '<td style="max-width:300px;">'+errores[i]['descripcion'] + '</td>';
					cadena += '<td style="max-width:300px;">'+errores[i]['respuesta'] + '</td>';
					cadena += '<td>'+errores[i]['nombrecompleto'] + '</td>';			
					cadena += "<td><button class='btn btn-primary' title='Modificar Error' onclick='obtenerError("+errores[i]['codigo']+")' type='button'>";
					cadena += "<i class='icon-pencil'></i>"
					cadena += "</button></td>";
					cadena += "<td><button class='btn btn-danger' title='Eliminar Error' onclick='eliminarError("+errores[i]['codigo']+")' type='button'>";
					cadena += "<i class='icon-remove'></i>"
					cadena += "</button></td></tr>";
					cadena += '</tr>';
				}
			}
		}

		cadena += '</table>';

		// Se adhieren los reportes de error obtenidos a la ventana modal.
		$(cadena).appendTo('#listarErr .modal-body');

		activarSelect();

		if($("#listarErr").length != 0)
			$('#listarErr').modal('show');
	}
}


/*
 * Funcion JavaScript que permite obtener un reporte de error en especifico.
 *
 * Se envia el reporte de error seleccionado por el usuario
 * en la funcion montarErrores() (ubicada en el archivo error.js)
 * haciendo uso del AJAX, enviandose asi al modulo "error" y llamando
 * a la funcion "buscarError" en ErrorControlador.php. 
 * Por otra parte se estara creando una ventana modal para mostrar
 * en donde se mostrara toda la informacion obtenida del reporte de error.
 */ 
function obtenerError(codigo)
{
	var arr= Array ('m_modulo','error',
					'm_accion','buscarError',
					'codigo_error',codigo);

	crearDialogo("dialogoErrorNuevo",'Modificar Error','',800,'modificarError()','Modificar',true);

	ajaxMVC(arr,succModificarErrores,error);
}


/*
 * Funcion JavaScript que permite mostrar un reporte de error en especifico con opcion a sufrir modificaciones por el usuario.
 *
 * Si se obtuvo con exito el reporte de error con el uso del AJAX
 * cuando se llamo a la funcion obtenerError() (ubicado en el archivo error.js).
 * entonces se va a mostrar el reporte de error con toda la informacion
 * completa en una ventana modal y el usuario tendra la opcion de  modificar 
 * los campos que esten habilitados en el caso de que sea necesario hacerlo.
 */
function succModificarErrores(data)
{
	if(data.estatus>0)
		plantillaModificarError(data.errores,data.estado);
	else
		mostrarMensaje(data.mensaje,4);
}


/*
 * Funcion en JavaScript que permite mostrar la informacion completa de un reporte de error.
 * 
 * esta funcion recibe dos parametros:
 * 
 * var errores 				Contiene la informacion de los reportes de error consultada en la base de datos.
 * var estado				Contiene la informacion de los estados de error actual que posee el reporte.
 * 
 * Aqui se muestran toda la ifnromacion de un reportes de error 
 * luego ser adherido a una ventana modal que es 
 * en donde el usuario va a poder visualizar toda la informacion
 * del reporte y en donde tambien tendra la opcion de moficiar 
 * los campos que esten habilitados para ser modificados.
 */ 
function plantillaModificarError(errores,estado)
{

	cadena ="";
	for(var i=0;i<estado.length;i++)
	{
		if(errores[0]['cod_estatus']!=estado[i]['codigo'])
			cadena += "<option value='"+estado[i]['codigo']+"'>"+estado[i]['nombre']+"</option>";
		else
			cadena += "<option selected='selected' value='"+errores[0]['cod_estatus']+"'>"+estado[i]['nombre']+"</option>";
	}

	
	$('#dialogoErrorNuevo .modal-body').load("modulos/error/vista/html5/js/modificarError.html", function()
		{			
			$('#dialogoErrorNuevo').modal('show');
			infoModificarError(errores,cadena);
			activarSelect();	
			
		});	

}


/*
 * Funcion de JavaScript que permite dar informacion a los campos
 * 
 * Esta funcion permite dar informacion a todos los campos que 
 * se estan mostrando en la funcion plantillaModificarError().
 * uibicado en el archivo error.js
 */
function infoModificarError(error,estados)
{ 
	$('#reportadoPor').val(error[0]['nombrecompleto']);
	$('#idError').val(error[0]['codigo']);
	$('#codError').val(error[0]['cod_error']);
	$('#estadoError').append(estados);
	$('#descError').append(error[0]['descripcion']);
	$('#mostrarError').append(error[0]['ver_error']);
	$('#observacionTecnica').val(error[0]['respuesta']);	
	$('#fechaReporte').val(error[0]['fec_reporte']);
	$('#fechaRespuesta').val(error[0]['fec_respuesta']);

	console.log(error);
}


/*
 * Funcion JavaScript que permite modificar la informacion de un reporte de error en especifico.
 *
 * Se envian los datos modificados por el usuario
 * en la plantillaModificarError() (ubicada en el archivo error.js)
 * haciendo uso del AJAX, enviandose asi al modulo "error" y llamando
 * a la funcion "modificacionError" en ErrorControlador.php. 
 */ 
function modificarError()
{
	var arr=Array(	'm_modulo','error',
					'm_accion','modificacionError',
					'estado_error',$('#estadoError').val(),
					'respuesta',$('#observacionTecnica').val(),
					'id_error',$("#idError").val());

	ajaxMVC(arr,succModificadoErrores,error);
}


/*
 * Funcion JavaScript que permite modificar un reporte de error.
 *
 * Si se modifico con exito el reporte de error con el uso del AJAX
 * cuando se llamo a la funcion plantillaModificarError() (ubicada en el archivo error.js).
 * luego se va a cerrar la ventana modal con la informacion que se modifico.
 * y se llamara a la funcion verErrores() en la cual se volvera a listar todos los
 * reportes de error.
 * en el caso de que no se haya podido modificar el reporte se mostrara un mensaje de error.
 */
function succModificadoErrores(data)
{
	if(data.estatus > 0){
		mostrarMensaje(data.mensaje, 1);
		$('#dialogoErrorNuevo').modal('hide');
		$('#dialogoErrorNuevo .modal-body').remove();
		
		verErrores();
	}
	else{
		mostrarMensaje(data.mensaje,4);
	}
}


/*
 * Funcion JavaScript que permite eliminar un reporte de error en especifico.
 *
 * Se envia el codigo del reporte de error que se va a eliminar 
 * haciendo uso del AJAX, enviandose asi al modulo "error" y llamando
 * a la funcion "eliminarError" en ErrorControlador.php. 
 */ 
function eliminarError(id)
{
	if(confirm("¿Está seguro que desea borrar el error?")){
		var arr=Array(	'm_modulo','error',
						'm_accion','eliminarError',					
						'id_error',id);

		ajaxMVC(arr,succEliminarError,error);
	}
}


/*
 * Funcion JavaScript que permite eliminar un reporte de error.
 *
 * Si se elimino con exito el reporte de error con el uso del AJAX
 * cuando se llamo a la funcion eliminarError() (ubicada en el archivo error.js).
 * luego se llamara a la funcion verErrores() en la cual se volvera a listar todos los
 * reportes de error.
 * en el caso de que no se haya podido eliminar un reporte se mostrara un mensaje de error.
 */
function succEliminarError(data)
{
	mostrarMensaje(data.mensaje,1);
	verErrores();
}


/*
 * Funcion JavaScript que permite permite mostrar un mensaje de error.
 *
 * en el caso de que exista algun error al momento de hacer 
 * uso del AJAX se va a mostrar este mensaje de error 
 * "Error de comunicación con el servidor" de esta forma
 * se le estara indicando al usuario que no se pudo 
 * realizar la operacion.
 */
function error(data){	
	console.log(data);
	mostrarMensaje("Error de comunicación con el servidor.",2);
}
