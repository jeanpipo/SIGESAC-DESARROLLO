
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
				cadena+='<tr onclick="modificarEstudiante('+data.estudiante[x]['codigo']+'); verEstudiante('+data.estudiante[x]['codigo']+');" style="background-color:#E5EAEE;">';
			else
				cadena+='<tr onclick="modificarEstudiante('+data.estudiante[x]['codigo']+'); verEstudiante('+data.estudiante[x]['codigo']+');">';
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

/*
function preGuardarEstudiante(){

	var arr = Array("m_modulo"	,	"estudiante",
					"m_accion"	,	"listar",
					"codPersona",	getVarsUrl().persona
					);

	ajaxMVC(arr,compararDatosEstudiante,error);

}
*/
/*
function compararDatosEstudiante (){

	var bool= true;
	var acu=0;
	var mensaje="";		
 /*
  CONSTRAINT ca_estudiante UNIQUE (cod_persona , cod_instituto , cod_pensum , fec_inicio ),
  CONSTRAINT ca_estudiante_01 UNIQUE (num_carnet ),
  CONSTRAINT ca_estudiante_02 UNIQUE (num_expediente ),
  CONSTRAINT ca_estudiante_03 UNIQUE (cod_rusnies ),*/

/*	if(data.estudiante){
		for(var x=0; x<data.estudiante.length; x++){
			acu=x+1;
			if((ddata.estudiante[x]['cod_persona'] == data.codPersona 
				&& data.estudiante[x]['cod_instituto'] == $("#estudiante #selectInstituto").val()
				&& data.estudiante[x]['cod_pensum'] == $("#estudiante  #selectPNF").val()
				&& data.estudiante[x]['fec_inicios'] == $("#fec_ini_estudiante").val() )	
				&& (data.estudiante[x]['codigo'] != $("#cod_estudiante").val())		
			){		

				mensaje+=" Ya esta modificacion se realizo anteriormente. Si desea afectuarla puede";
				mensaje+=" eliminar la informacion que se encuentra en la fila N° "+acu+" o puede esperar hasta"; 
				mensaje+=" el dia siguiente.";		
				mostrarMensaje(mensaje,2);	
				bool=false;
				break;						
			}
			else if( data.empleado[x]['es_jef_con_estudio'] == $('#es_jef_con_estudio').prop('checked')
					&& data.empleado[x]['es_ministerio'] == $('#es_ministerio').prop('checked')
					&& data.empleado[x]['es_jef_pensum'] == $('#es_jef_pensum').prop('checked')
					&& data.empleado[x]['es_docente'] == $('#Docente').prop('checked')
					&& data.empleado[x]['cod_estado'] == $("#estudiante #selectEstado").val()
					&& (data.empleado[x]['codigo'] == $("#cod_empleado").val())){
				bool=true;
				break;				
			}
			else if(data.empleado[x]['fec_inicios'] == $("#fec_ini_empleado").val()){
				mensaje+="Ya esta modificacion se realizo anteriormente. Si desea afectuarla puede";
				mensaje+=" eliminar la informacion que se encuentra en la fila N° "+acu+" o puede esperar hasta"; 
				mensaje+=" el dia siguiente.";	
				mostrarMensaje(mensaje,2);	
				bool=false;				
			}
			else
				bool=false;
		}
		setTimeout(function(){verEstudiante ();}, 300);
	}

	if(bool)
		guardarEstudiante($("#cod_estudiante").val());
	else
		guardarEstudiante(null);


}
*/

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
	
	if(bool)
		guardarEstudiante ();

}
/**
* Funcion Java Script que permite guardar los datos de a un estudiante
* para que luego sean almacenados en la base de datos. Los Datos son enviados
* por ajax.
*/
function guardarEstudiante (){
//	alert( $("#codigoPersona").val()+'<<< persona codigo');
	
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
					//"estadoEs",  $("#selectEstado").val(),
					"codPensum", $("#estudiante #selectPNF").val()
					);
	//alert($("#fec_fin_estudiante").val());
	ajaxMVC(arr,succAgregarEstudiante,error);
}



function succAgregarEstudiante(data){
	//alert('adding student');
	//alert("sas");
//	alert(data.mensaje);
	if(data.estatus>0){
		//alert(data.codEstudiante);
		
		if(data.codEstudiante)
			$("#cod_estudiante").val(data.codEstudiante);
		mostrarMensaje(data.mensaje, 1);
		console.log(data);
		verEstudiante();
	}			
	else
		mostrarMensaje(data.mensaje,2);
}


/**
* Funcion Java Script que permite listar Todos los institutos
* para que luego sea mostado en un select. los datos son enviados
* por ajax para que se haga la consulta a la base de datos y mostrar 
* los resultados en la funcion montarSelectInstituto().
*/
function verInstitutoEs(){

	var arr = Array("m_modulo"	,	"estudiante",
					"m_accion"	,	"listar",
					"estado"	,	$("#selectEstado").val(),
					"pnf"		,	$("#selectPNF").val(),
					"instituto"	,	$("#selectInstituto").val(),
					"tipo_persona",	"estudiante",
					"campo",		$("#campo").val(),
					"codi"		,	$("#cod_estudiante").val()											
					);
		
	ajaxMVC(arr,montarSelectInstitutoPersona,error);
}

function verInstitutoEsPrincipal(){

	var arr = Array("m_modulo"	,	"persona",
					"m_accion"	,	"listarSelects",
					"estado"	,	$("#selectEstado").val(),
					"pnf"		,	$("#selectPNF").val(),
					"instituto"	,	$("#selectInstituto").val(),
					"tipo_persona",	"estudiante"									
					);
		
	ajaxMVC(arr,montarSelectInstituto,error);
}



/**
* Funcion Java Script que permite mostrar un select con
* los institutos y es concatenado a un  div en la vista HTML
*/
function montarSelectInstitutoE(data){
	console.log(data);
	var cadena = "";
	cadena += "<select  class='selectpicker' name='ins_estudiante' id='ins_estudiante' title='institutos' data-live-search='true' data-size='auto' data-max-options='12' >"; 
	for(var x=0; x<data.instituto.length;x++)
	{
	 	if(data.instituto[x]['codigo']!=11)
	 		cadena += '<option value="'+data.instituto[x]["codigo"]+'">'+data.instituto[x]["nom_corto"]+'</option>';
	 	else
	 		cadena += '<option selected="selected" value="'+data.instituto[x]["codigo"]+'">'+data.instituto[x]["nom_corto"]+'</option>';
	}
	cadena+="</select>";

	$(cadena).appendTo('.ins_estudiante');
	activarSelect();					
}


/**
* Funcion Java Script que permite listar Todos los PNF
* para que luego sea mostado en un select. los datos son enviados
* por ajax para que se haga la consulta a la base de datos y mostrar 
* los resultados en la funcion montarSelectPNF().
*/
function verPNFEs(){

	var arr = Array("m_modulo"	,	"estudiante",
					"m_accion"	,	"listar",
					"estado"	,	$("#selectEstado").val(),
					"pnf"		,	$("#selectPNF").val(),
					"instituto"	,	$("#selectInstituto").val(),
					"tipo_persona",	"estudiante",
					"campo",		$("#campo").val(),
					"codi"		,	$("#cod_estudiante").val()				
					);
	
	ajaxMVC(arr,montarSelectPNFPersona,error);
}

function verPNFEsPrincipal(){

	var arr = Array("m_modulo"	,	"persona",
					"m_accion"	,	"listarSelects",
					"estado"	,	$("#selectEstado").val(),
					"pnf"		,	$("#selectPNF").val(),
					"instituto"	,	$("#selectInstituto").val(),
					"tipo_persona",	"estudiante"	
					);
	
	ajaxMVC(arr,montarSelectPNF,error);
}

/**
* Funcion Java Script que permite mostrar un select con
* los PNF y es concatenado a un  div en la vista HTML
*//*
function montarSelectPNFE(data){

	var cadena = "";
	cadena += "<select  class='selectpicker' id='selectPNF' title='pensum' data-live-search='true' data-size='auto' data-max-options='12' >"; 
	cadena += "<option value='seleccionar'>Seleccionar</option>";
	for(var x=0; x<data.pnf.length;x++)
	{
		cadena += '<option value="'+data.pnf[x]["codigo"]+'">'+data.pnf[x]["nom_corto"]+'</option>';
	}
	cadena +="</select>";

	$(cadena).appendTo('.selectPensumEs');
	activarSelect();					
}
*/

/**
* Funcion Java Script que permite mostrar un select con
* los estados y es concatenado a un  div en la vista HTML
*/ /*
function montarSelectEstadoE(data){
	
	var cadena = "";
	cadena += "<select  class='selectpicker' onchange='verPersona();' id='selectEstado' title='estado' data-live-search='true' data-size='auto' data-max-options='12' >"; 
	cadena += "<option value='seleccionar'>Seleccionar</option>";
	for(var x=0; x<data.estado.length;x++)
	{		
		cadena += '<option value="'+data.estado[x]["codigo"]+'">'+data.estado[x]["nombre"]+'</option>';
	}
	cadena +="</select>";

	$(cadena).appendTo('.selectEstado');
	activarSelect();					
}
*/

/** 
* Funcion Java Script que permite listar Todas las personas de tipo estudiante
* para que luego sean mostradas. los datos son enviados
* por ajax para que se haga la consulta a la base de datos y mostrar 
* los resultados en la funcion montarPersona().
*//*
function verPersonaEstudiante(){
	alert("asdasd");
	var arr = Array("m_modulo"	,	"persona",
					"m_accion"	,	"listar",
					"estado"	,	$("#selectEstado").val(),
					"pnf"		,	$("#selectPNF").val(),
					"instituto"	,	$("#selectInstituto").val()	
					"tipo_persona", 'estudiante'			
					);		
	ajaxMVC(arr,montarPersonaEstudiante,error);
}*/

/**
* Funcion Java Script que permite listar Todos los estados que posee un actor
* para que luego sea mostado en un select. los datos son enviados
* por ajax para que se haga la consulta a la base de datos y mostrar 
* los resultados en la funcion mmontarSelectEstado().
*/

function verEstadoEs(){

	var arr = Array("m_modulo"	,	"estudiante",
					"m_accion"	,	"listar",
					"estado"	,	$("#selectEstado").val(),
					"pnf"		,	$("#selectPNF").val(),
					"instituto"	,	$("#selectInstituto").val(),
					"tipo_persona",	"estudiante",
					"campo"		,	$("#campo").val(),
					"codi"		,	$("#cod_estudiante").val()
					);	

	ajaxMVC(arr,montarSelectEstadoPersona,error);
}

function verEstadoEsPrincipal(){

	var arr = Array("m_modulo"	,	"persona",
					"m_accion"	,	"listarSelects",
					"estado"	,	$("#selectEstado").val(),
					"pnf"		,	$("#selectPNF").val(),
					"instituto"	,	$("#selectInstituto").val(),
					"tipo_persona",	"estudiante"
					);	

	ajaxMVC(arr,montarSelectEstado,error);
}



/**
* Funcion Java Script que permite listar Todos los estudiantes
* para que luego sean mostradas. los datos son enviados
* por ajax para que se haga la consulta a la base de datos y mostrar 
* los resultados en la funcion montarPersona().
*//*
function montarPersonaEstudiante(data){

	cadena="";
	cadena+'<tbody id="listarPersonaEstudiante">';
	if(data.persona!=null){
		for(var x=0; x<data.persona.length; x++)
		{
			if(data.persona[x]['apellido2']!=null)
				var nombre=data.persona[x]['apellido2'];
			else
				var nombre="";

			if(data.persona[x]['nombre2']!=null)
				var apellido=data.persona[x]['nombre2'];
			else
				var apellido="";
			cadena+="<tr>";
			cadena+="<td><input id='cod_persona' type='radio' name='cod_persona' value='"+data.persona[x]['codigo']+"'>"+data.persona[x]['codigo']+"</td>";
			cadena+="<td>"+data.persona[x]['cedula']+"</td>";
			cadena+="<td>"+data.persona[x]['apellido1']+" "+nombre+"</td>";
			cadena+="<td>"+data.persona[x]['nombre1']+" "+apellido+"</td>";
			cadena+="<td>"+data.persona[x]['cor_personal']+"</td>";
		}
	}
	cadena+"</tbody>";

	$("#listarPersona").remove();
	$(cadena).appendTo('#primeraTabla');
}
*/
/**
* Funcion Java Script que permite listar a un estudiante en el HTML para
* que lugo se modifique su informacionde la base de datos. Los Datos son enviados
* por ajax.
*/
function modificarEstudiante(cod_estudiante=null,cod_persona=null){

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
function segundoLlamado(){
	//verPNFEs(); verInstitutoEs(); verEstadoEs();
	

		//mostrarInformaion();
	
}
/**
 * esta funcion JavaScript permite signar los datos obtenido en la
 * consuta  la base de datos y colocarlos en la vista HTML
 * de esta manera el usuario podra modificar los datos del estudiante
 */
function succMontarModificarEstudiante (data){
	//console.log(data);
	//verPNFEsPrincipal(); verInstitutoEsPrincipal(); verEstadoEsPrincipal();
		
		verEstadoEsPrincipal();  verInstitutoEsPrincipal();
		setTimeout(function(){ 
			$("#selectInstituto").val(data.estudiante[0]['cod_instituto']);	
			$("#selectEstado").val(data.estudiante[0]['cod_estado']);
			verPNFEsPrincipal();
		}, 300);

		$("#cod_estudiante").val(data.estudiante[0]['codigo']);
		$("#codPersona").val(data.estudiante[0]['cod_persona']);		
		$("#num_carnet").val(data.estudiante[0]['num_carnet']);
		$("#expediente").val(data.estudiante[0]['num_expediente']);
		$("#cod_rusnies").val(data.estudiante[0]['cod_rusnies']);
		
		//$('#selectEstado').selectpicker('refresh');
		$("#fec_ini_estudiante").val(data.estudiante[0]['fec_inicios']);
		$("#fec_fin_estudiante").val(data.estudiante[0]['fec_final']);
		$("#condicion").val(data.estudiante[0]['condicion']);
		$("#obs_estudiante").val(data.estudiante[0]['observaciones']);										
		$("#estadoEs").val(data.estudiante[0]['cod_estado']);		
		//$('#selectInstituto').selectpicker('refresh');		
		setTimeout(function(){ 
			$("#selectPNF").val(data.estudiante[0]['cod_pensum']);
			$('.selectpicker').selectpicker('refresh');
		}, 600);
	
	
	//alert($("#selectEstado").val());
}

function nuevoEstudiante (){
	//console.log(data);
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
	//$("#estadoEs").val("seleccionar");
	$("#selectInstituto").val("seleccionar");	
	$('#selectInstituto').selectpicker('refresh');
	//alert($("#selectEstado").val());
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
