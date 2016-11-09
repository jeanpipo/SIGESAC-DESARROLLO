
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

Nombre: estudiante.js
Diseñador:Jean Pierre Sosa.
Programador:Jean Pierre Sosa.
Lider de proyecto: Johan Alamo (johan.alamo@gmail.com)
Fecha:10-1-16
Descripción:  
	Este es el javascript del módulo error, encargado de todas las 
	llamadas AJAX, objetos DOM y validaciones de dicho módulo. 

 * * * * * * * * Cambios/Mejoras/Correcciones/Revisiones * * * * * * * *
Diseñador - Programador /   Fecha   / Descripción del cambio
   

 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
*/

$(document).ready(function() {

	verEstudiante();
	if($('#pantalla').val()=="principal"){
		nuevoEstudiante ();
		verEstadoEsPrincipal();  
		verInstitutoEsPrincipal(); 
		verPNFEsPrincipal();
	}
	setTimeout(function() {
		
		var accion =getVarsUrl().accion;
		if(accion=="V")
			bloquearCamposEstudiante();
	
	}, 1500);

} );

function verEstudiante (cod_estudiante,cod_persona){

	if(!$("#cod_persona").val())
		cod_persona=getVarsUrl().persona;
	else
		cod_persona=$("#cod_persona").val();

	var arr = Array("m_modulo"	,	"estudiante",
					"m_accion"	,	"listar",
					"codPersona",	cod_persona,
					"codi"		,	cod_estudiante
					);
	
	ajaxMVC(arr,montarEstudiante,error);

}

function montarEstudiante(data){
	console.log(data);
	cadena="";
	cadena+='<tbody id="listarEstudiante">';
	if(data.estudiante!=null){
		for(var x=0; x<data.estudiante.length; x++)
		{
			if(data.codi==data.estudiante[x]['codigo'])
				cadena+='<tr class="pointer" onclick="modificarEstudiante('+data.estudiante[x]['codigo']+'); verEstudiante('+data.estudiante[x]['codigo']+');" style="background-color:#E5EAEE;">';
			else
				cadena+='<tr class="pointer" onclick="modificarEstudiante('+data.estudiante[x]['codigo']+'); verEstudiante('+data.estudiante[x]['codigo']+');">';
			cadena+='<td>'+data.estudiante[x]['codigo']+'</td>';
			cadena+='<td>'+data.estudiante[x]['fec_inicios']+'</td>';
			if(data.estudiante[x]['fec_fin'])
				cadena+='<td>'+data.estudiante[x]['fec_fin']+'</td>';
			else
				cadena+='<td>-</td>';
			cadena+='<td>'+data.estudiante[x]['nombre']+'</td>';
			cadena+='<td>'+data.estudiante[x]['nom_instituto']+'</td>';
			cadena+='<td>'+data.estudiante[x]['nom_pensum']+'</td>';

			if(data.estudiante[x]['condicion'])		
				cadena+='<td >'+data.estudiante[x]['condicion']+'</td>';
			else
				cadena+='<td> - </td>';

			if(data.estudiante[x]['observaciones'])
				if(data.estudiante[x]['observaciones'].length>25){
					var info=data.estudiante[x]['observaciones'].slice(0,25)+"...";
					cadena+='<td>'+info+'</td>';
				}
				else
					cadena+='<td>'+data.estudiante[x]['observaciones']+'</td>';
			else
				cadena+='<td> - </td>';
			cadena+='</tr>';
		}
	}
	cadena+="</tbody>";

	$("#listarEstudiante").remove();
	$(cadena).appendTo('#tablaEstudiante');
}

function preGuardarEstudiante(){
	var bool=true;
	if($("#estudiante #selectInstituto").val()=="seleccionar"){
		mostrarMensaje("debe de seleccionar un Instituto",2);
		bool=false;
	}
	else if(!validarFecha("#fec_ini_estudiante",true)){
		mostrarMensaje("debe de seleccionar la fecha de inicio",2);
		bool=false;
	}	
	else if($("#estudiante #selectPNF").val() =="seleccionar"){
		mostrarMensaje("debe de seleccionar un Pensum",2);
		bool=false;
	}	
	else if($("#estudiante #selectEstado").val()=="seleccionar"){
		mostrarMensaje("debe de seleccionar un estado",2);
		bool=false;
	}
	else if($("#fec_fin_estudiante").val()){
		var fecha =$("#fec_ini_estudiante").val().split("/");
		var fechFin=$("#fec_fin_estudiante").val().split("/");
		fechFin=new Date (fechFin[2],fechFin[1],fechFin[0]);
		fecha= new Date(fecha[2],fecha[1],fecha[0]);
		if(fechFin<=fecha){
			bool=false;	
			mostrarMensaje("La fecha de inicio no puede ser mayor a la fecha de culminacion.",2);
		}
	}
	
	if(bool)
		antesGuardarEstudiante();

}

function antesGuardarEstudiante(){
	arr= Array("m_modulo", "estudiante",
			   "m_accion", "listar",
			   "codPersona",$("#cod_persona").val()
			   );

	ajaxMVC(arr,succAntesGuardarEstudiante,error);
}

function succAntesGuardarEstudiante(data){
	var bool=true;
	if(data.estudiante){
		for(var x=0;x<data.estudiante.length;x++){
			if(data.estudiante[x]['fec_inicios']==$("#fec_ini_estudiante").val()
				&& data.estudiante[x]['codigo']!= $("#cod_estudiante").val()){
				bool=false;
				break;
			}
		}			
	}

	if(bool)
		guardarEstudiante();
	else
		mostrarMensaje("No puedes inscribir al estudiante con dos fecha de inicio iguales",2);
}	

/**
* Funcion Java Script que permite guardar los datos de a un estudiante
* para que luego sean almacenados en la base de datos. Los Datos son enviados
* por ajax.
*/
function guardarEstudiante (){
	
	var arr = Array("m_modulo"	,	"estudiante",
					"m_accion"	,	"agregar",
					"codEstudiante",  $("#cod_estudiante").val(),
					"codPersona",  $("#codigoPersona").val(),
					"codInstituto", $("#estudiante #selectInstituto").val(),
					"numCarnet",  $("#num_carnet").val(),
					"numExpediente",  $("#expediente").val(),
					"codRusnies",  $("#cod_rusnies").val(),
					"codEstado",  $("#estudiante #selectEstado").val(),
					"fecInicio", $("#fec_ini_estudiante").val(),
					"fecFin",  $("#fec_fin_estudiante").val(),
					"condicion",  $("#condicion").val(),
					"obsEstudiante",  $("#obs_estudiante").val(),										
					"codPensum", $("#estudiante #selectPNF").val()
					);
	ajaxMVC(arr,succAgregarEstudiante,error);
}



function succAgregarEstudiante(data){

	if(data.estatus>0){
		
		if(data.codEstudiante)
			$("#cod_estudiante").val(data.codEstudiante);
		mostrarMensaje(data.mensaje, 1);
		console.log(data);
		verEstudiante();
	}			
	else
		mostrarMensaje(data.mensaje,2);
}


function verInstitutoEsPrincipal(){

	var arr = Array("m_modulo"	,	"instituto",
					"m_accion"	,	"listar"							
					);
		
	ajaxMVC(arr,montarSelectInstituto,error);
}


function verPNFEsPrincipal(){

	var arr = Array("m_modulo"	,	"pensum",
					"m_accion"	,	"buscarPorInstituto",
					"codigo"	,	$("#selectInstituto").val()
					);
	
	ajaxMVC(arr,montarSelectPNF,error);
}


/**
* Funcion Java Script que permite listar Todos los estados que posee un actor
* para que luego sea mostado en un select. los datos son enviados
* por ajax para que se haga la consulta a la base de datos y mostrar 
* los resultados en la funcion mmontarSelectEstado().
*/

function verEstadoEs(){

	var arr = Array("m_modulo"	,	"estudiante",
					"m_accion"	,	"listarEstado"
					);	

	ajaxMVC(arr,montarSelectEstadoPersona,error);
}

function verEstadoEsPrincipal(){

	var arr = Array("m_modulo"	,	"estudiante",
					"m_accion"	,	"listarEstado"
					);	

	ajaxMVC(arr,montarSelectEstado,error);
}

/**
* Funcion Java Script que permite listar a un estudiante en el HTML para
* que lugo se modifique su informacionde la base de datos. Los Datos son enviados
* por ajax.
*/
function modificarEstudiante(cod_estudiante,cod_persona){

	if(!cod_persona && $("#cod_persona").val())
		cod_persona=$("#cod_persona").val();

	if(!cod_estudiante && $("#cod_empleado").val())
		cod_estudiante=$("#cod_estudiante").val();
	
	var arr = Array("m_modulo"	,	"estudiante",
					"m_accion"	,	"listar",
					"codPersona",  cod_persona,
					"codEstudiante", cod_estudiante,
					"codi"		,	cod_estudiante						
					);
		
	ajaxMVC(arr,succMontarModificarEstudiante,error);

}

/**
 * esta funcion JavaScript permite signar los datos obtenido en la
 * consuta  la base de datos y colocarlos en la vista HTML
 * de esta manera el usuario podra modificar los datos del estudiante
 */
function succMontarModificarEstudiante (data){

	//verEstadoEsPrincipal();  verInstitutoEsPrincipal();
	setTimeout(function(){ 
		$("#estudiante #selectInstituto").val(data.estudiante[0]['cod_instituto']);	
		$("#estudiante #selectEstado").val(data.estudiante[0]['cod_estado']);
		verPNFEsPrincipal();
	}, 850);

	$("#cod_estudiante").val(data.estudiante[0]['codigo']);
	$("#codPersona").val(data.estudiante[0]['cod_persona']);		
	$("#num_carnet").val(data.estudiante[0]['num_carnet']);
	$("#expediente").val(data.estudiante[0]['num_expediente']);
	$("#cod_rusnies").val(data.estudiante[0]['cod_rusnies']);
	
	$("#fec_ini_estudiante").val(data.estudiante[0]['fec_inicios']);
	$("#fec_fin_estudiante").val(data.estudiante[0]['fec_final']);
	$("#condicion").val(data.estudiante[0]['condicion']);
	$("#obs_estudiante").val(data.estudiante[0]['observaciones']);										
	//$("#estadoEs").val(data.estudiante[0]['cod_estado']);		
	
	setTimeout(function(){ 
		$("#estudiante #selectPNF").val(data.estudiante[0]['cod_pensum']);
		if(getVarsUrl().accion=="V"){
			$("#estudiante #selectInstituto").prop("disabled",true);
			$("#estudiante #selectPNF").prop("disabled",true);
			$("#estudiante #selectEstado").prop("disabled",true);
		}
		$('#estudiante #selectInstituto').selectpicker('refresh');
		$('#estudiante #selectPNF').selectpicker('refresh');
		$('#estudiante #selectEstado').selectpicker('refresh');
	}, 1850);
}

function nuevoEstudiante (){

	$("#cod_estudiante").val("");
	$("#codPersona").val("");
	$("#selectPNF").val("seleccionar");
	$('#selectPNF').selectpicker('refresh');
	$("#num_carnet").val("");
	$("#expediente").val("");
	$("#cod_rusnies").val("");
	$("#selectEstado").val("seleccionar");
	$('#selectEstado').selectpicker('refresh');
	$("#fec_ini_estudiante").val(fecActual());
	$("#fec_fin_estudiante").val("");
	$("#condicion").val("");
	$("#obs_estudiante").val("");										

	$("#selectInstituto").val("seleccionar");	
	$('#selectInstituto').selectpicker('refresh');

}

function bloquearCamposEstudiante(){

	$("#cod_estudiante").prop('disabled',true);
	$("#codPersona").prop('disabled',true);
	$("#selectPNF").prop('disabled',true);
	$("#num_carnet").prop('disabled',true);
	$("#expediente").prop('disabled',true);
	$("#cod_rusnies").prop('disabled',true);
	$("#selectEstado").prop('disabled',true);
	$("#fec_ini_estudiante").prop('disabled',true);
	$("#fec_fin_estudiante").prop('disabled',true);
	$("#condicion").prop('disabled',true);
	$("#obs_estudiante").prop('disabled',true);								

	$("#selectInstituto").prop('disabled',true);	
}
	
/**
* Funcion Java Script que permite borrar a un  estudiante
* de la base de datos. Los Datos son enviados
* por ajax.
*/
function borrarEstudiante(){

	var arr = Array("m_modulo"	,	"estudiante",
					"m_accion"	,	"eliminar",
					"cod_estudiante",  $("#cod_estudiante").val()									
					);
			
	ajaxMVC(arr,succMontarEliminarEstudiante,error);

}

function succMontarEliminarEstudiante (data){

	if(data.estatus>0){
		$("#cod_estudiante").val('');
		mostrarMensaje(data.mensaje, 1);
		verEstudiante(data.codEstudiante);
	}
	else
		mostrarMensaje(data.mensaje,2);
}



function error(data){	
	console.log(data);
	mostrarMensaje("Error de comunicación con el servidor.",2);
}
