
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

Nombre: persona.js
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


	$('div.infoPersona').fadeIn(700);
    $('div.estudiantes').hide();				
	$('div.empleados').hide();
	$("#historico").hide();

	
});

$(function()
{	
	$("a.infoPersona").click(function()
	{				
		$('div.infoPersona').fadeIn(700);
	    $('div.estudiantes').hide();				
		$('div.empleados').hide();
		$("#historico").hide();
						
	});

	$("a.estudiantes").click(function()
	{				
		$('div.estudiantes').fadeIn(700);
	    $('div.infoPersona').hide();				
		$('div.empleados').hide();
		$("#historico").show();
						
	});

	$("a.empleados").click(function()
	{				
		$('div.empleados').fadeIn(700);				
		$('div.estudiantes').hide();	
		$('div.infoPersona').hide();	
		$("#historico").show();					
	});
});

$(document).ready(function() {
	verInstitutoListar();
	//verInstituto();
	//verPNF();
	//verPNFListar();
	verEstadolistar();
	//verEstado();
	//verInstitutoEm2();
	//verPNFEm2();
	//verEstadoEm2();
	verPersona();
	tabsBloqueados();
	removerEsEm();
	mostrarInformaion();
	activarCal();
	TodosFocus();
	//activarFecha(".date");

} );



function getVarsUrl(){
    var url= location.search.replace("?", "");
    var arrUrl = url.split("&");
    var urlObj={};   
    for(var i=0; i<arrUrl.length; i++){
        var x= arrUrl[i].split("=");
        urlObj[x[0]]=x[1]
    }
    return urlObj;
}


function nuevoPersonaEstudiante (){	
	window.location.href = 'index.php?m_modulo=persona&m_vista=Principal&m_formato=html5&accion=N&persona=-1'; 
}

function nuevoPersonaEmpleado (){	
	window.location.href = 'index.php?m_modulo=persona&m_vista=Agregar&m_formato=html5&accion=N&persona=-1'; 
}
function foto(data){

	$("#foto").on("change", function(){

	    /* Limpiar vista previa */

	    $("#vista-previa").html('');

	    var archivos = document.getElementById('foto').files;

	    var navegador = window.URL || window.webkitURL;

	    /* Recorrer los archivos */
	    $("#imagen").remove();
	    for(x=0; x<archivos.length; x++)
	    {   	
	   		var objeto_url = navegador.createObjectURL(archivos[x]);
		}
		var cadena ="";
		cadena+="<div id='imagen'>";
		cadena+="<img src="+objeto_url+" width='200' height='200'>";
		cadena+="</div>";
		
		$("#superImagen").append(cadena);

	});
	
}
function estudianteFocus(){
	var boton='';
	boton ='<button type="button" id="bTodos1" class="btn btn-info boton-focus" style="background-color: #4FD8B0;" title="Solo Empleados" onclick="empleadoFocus(); verPersonaEmpleado(); verEstadoEm(); ">  <b>Empleados</b>	</button>';
	boton +='<button type="button" id="bTodos2" class="btn btn-info boton-focus"style="background-color: #209472;"  title="Solo Estudiantes" onclick="estudianteFocus(); verPersonaEstudiante(); verEstadoEs(); "><b>Estudiantes<b></button>';
	boton +='<button type="button" id="bTodos3"  class="btn btn-info boton-focus" style="background-color: #4FD8B0;"title="todos" onclick="TodosFocus(); asignarAmbos(); verPersona(); verEstadoListar(); "><b>Todos<b></button>';
	$("#bTodos1").remove();
	$("#bTodos2").remove();
	$("#bTodos3").remove();
	$(boton).appendTo("#botones");
}
function empleadoFocus(){
	var boton='';
	boton ='<button type="button" id="bTodos1" class="btn btn-info boton-focus" style="background-color: #209472;"title="Solo Empleados" onclick="empleadoFocus(); verPersonaEmpleado(); verEstadoEm(); ">  <b>Empleados</b>	</button>';
	boton +='<button type="button" id="bTodos2" class="btn btn-info boton-focus" style="background-color: #4FD8B0;" title="Solo Estudiantes" onclick="estudianteFocus(); verPersonaEstudiante(); verEstadoEs(); "><b>Estudiantes<b></button>';
	boton +='<button type="button" id="bTodos3" class="btn btn-info boton-focus" style="background-color: #4FD8B0;"  title="todos" onclick="TodosFocus(); asignarAmbos(); verPersona(); verEstadoListar(); "><b>Todos<b></button>';
	$("#bTodos1").remove();
	$("#bTodos2").remove();
	$("#bTodos3").remove();
	$(boton).appendTo("#botones");
}
function TodosFocus(){
	var boton='';

	boton ='<button type="button" id="bTodos1" class="btn btn-info boton-focus" style="background-color: #4FD8B0;" title="Solo Empleados" onclick="empleadoFocus(); verPersonaEmpleado(); verEstadoEm(); ">  <b>Empleados</b>	</button>';
	boton +='<button type="button" id="bTodos2" class="btn btn-info boton-focus" style="background-color: #4FD8B0;" title="Solo Estudiantes" onclick="estudianteFocus(); verPersonaEstudiante(); verEstadoEs(); "><b>Estudiantes<b></button>';
	boton +='<button type="button" id="bTodos3" style="background-color: #209472;" class="btn btn-info boton-focus" title="todos" onclick="TodosFocus(); asignarAmbos(); verPersona(); verEstadoListar(); "><b>Todos<b></button>';
	$("#bTodos1").remove();
	$("#bTodos2").remove();
	$("#bTodos3").remove();
	$(boton).appendTo("#botones");
}

/**
* Funcion Java Script que permite listar Todos los institutos
* para que luego sea mostado en un select. los datos son enviados
* por ajax para que se haga la consulta a la base de datos y mostrar 
* los resultados en la funcion montarSelectInstituto().
*/

function verInstitutoListar(){
	var arr = Array("m_modulo"	,	"persona",
					"m_accion"	,	"listar",
					"estado"	,	$("#selectEstado").val(),
					"pnf"		,	$("#selectPNF").val(),
					"instituto"	,	$("#selectInstituto").val(),
					"campo",		$("#campo").val(),
					"tipo_persona", "ambos"
					);
		
	ajaxMVC(arr,montarSelectInstitutoPersona,error);
}

function verInstituto(){
		
	var arr = Array("m_modulo"	,	"persona",
					"m_accion"	,	"listarSelects",
					"estado"	,	$("#selectEstado").val(),
					"pnf"		,	$("#selectPNF").val(),
					"instituto"	,	$("#selectInstituto").val()
					);
		
	ajaxMVC(arr,montarSelectInstituto,error);
}
/**
* Funcion Java Script que permite mostrar un select con
* los institutos y es concatenado a un  div en la vista HTML
*/

function montarSelectInstitutoPersona(data){
	var cadena = "";

	//if(!data.empleado2){
		//$("#selectEstados").remove();	
	$("#selectIns").remove();
	cadena+="<div id='selectIns'> institutos ";
	/*}
	else{
		$("#selectInsEm").remove();
		cadena+="<div id='selectInsEm'> institutos ";
	}*/

	
	if(data.tipo_persona=='estudiante')
		cadena += "<select onchange='verPersonaEstudiante(); verPNFEs();' class='selectpicker' id='selectInstituto' title='institutos' data-live-search='true' data-size='auto' data-max-options='12' >"; 
	else if(data.tipo_persona=='empleado')
		cadena += "<select onchange='verPersonaEmpleado(); verPNFEm();' class='selectpicker' id='selectInstituto' title='institutos' data-live-search='true' data-size='auto' data-max-options='12' >"; 
	/*else if(data.tipo_persona=='empleado' && data.empleado2)
		cadena += "<select onchange='verPersonaEmpleado(); verPNFEm2();' class='selectpicker' id='selectInstituto' title='institutos' data-live-search='true' data-size='auto' data-max-options='12' >";
	*/
	else
		cadena += "<select onchange='verPersona(); verPNFListar();' class='selectpicker' id='selectInstituto' title='institutos' data-live-search='true' data-size='auto' data-max-options='12' >"; 
	cadena += "<option value='seleccionar' >Seleccionar</option>";
	if(data.instituto){
		for(var x=0; x<data.instituto.length;x++)
		{
			cadena += '<option value="'+data.instituto[x]["codigo"]+'">'+data.instituto[x]["nom_corto"]+'</option>';
		}
	}
	cadena +="</select>";
	//alert(data.empleado2);
	//if(!data.empleado2){
		$(cadena).appendTo('#selectInstitutos2');
		$(cadena).appendTo('.selectInstituto2');
	//}
	//else
	//	$(cadena).appendTo('.selectInstitutoEm');
	activarSelect();	

}

function montarSelectInstituto(data){
	var cadena = "";
	//alert(JSON.stringify(data));
	$("#selectIns").remove();
	cadena+="<div id='selectIns'> institutos ";
	if(!data.empleado2)
		cadena += "<select onchange='verPNF();' class='selectpicker' id='selectInstituto' title='institutos' data-live-search='true' data-size='auto' data-max-options='12' >"; 
	else
		cadena += "<select onchange='verPNFEm2();' class='selectpicker' id='selectInstituto' title='institutos' data-live-search='true' data-size='auto' data-max-options='12' >"; 

	cadena += "<option value='seleccionar' >Seleccionar</option>";
	if(data.instituto)
	for(var x=0; x<data.instituto.length;x++)
	{	
		cadena += '<option value="'+data.instituto[x]["codigo"]+'">'+data.instituto[x]["nom_corto"]+'</option>';
	}
	cadena +="</select>";
	//if(!data.empleado2){
		$(cadena).appendTo('#selectInstitutos');
		$(cadena).appendTo('.selectInstituto');
	/*}
	else*/
		//$(cadena).appendTo('.selectInstitutoEm');
	activarSelect();	

}

/**
* Funcion Java Script que permite listar Todos los PNF
* para que luego sea mostado en un select. los datos son enviados
* por ajax para que se haga la consulta a la base de datos y mostrar 
* los resultados en la funcion montarSelectPNF().
*/
function verPNFListar(){
	/*if($("#selectInstituto").val()){
		if($("#selectInstituto").val()=="seleccionar")
			$("#selectPNF").val('seleccionar');
		verPersona();
	}*/
	var arr = Array("m_modulo"	,	"persona",
					"m_accion"	,	"listar",
					"estado"	,	$("#selectEstado").val(),
					"pnf"		,	$("#selectPNF").val(),
					"instituto"	,	$("#selectInstituto").val(),
					"campo"		,	$("#campo").val(),
					"tipo_persona", "ambos"						
					);
		
	ajaxMVC(arr,montarSelectPNFPersona,error);
}

function verPNF(){
	/*if($("#selectInstituto").val()){
		if($("#selectInstituto").val()=="seleccionar")
			$("#selectPNF").val('seleccionar');
		verPersona();
	}*/
	var arr = Array("m_modulo"	,	"persona",
					"m_accion"	,	"listarSelects",
					"estado"	,	$("#selectEstado").val(),
					"pnf"		,	$("#selectPNF").val(),
					"instituto"	,	$("#selectInstituto").val()				
					);
		
	ajaxMVC(arr,montarSelectPNF,error);
}


/**
* Funcion Java Script que permite mostrar un select con
* los PNF y es concatenado a un  div en la vista HTML
*/
function montarSelectPNFPersona(data){

	console.log(data);
	var cadena = "";
	//if(!data.empleado2){
		$("#selectPensuma").remove();//	$("#selectPensuma").remove();
		cadena+="<div id='selectPensuma'> Pensum ";
	/*}		
	else{
		$("#selectPensumaEm").remove();
		cadena+="<div id='selectPensumaEm'> Pensum ";
	}*/


	
	if(data.tipo_persona=='estudiante')
		cadena += "<select onchange='verPersonaEstudiante();' class='selectpicker' id='selectPNF' title='pensum' data-live-search='true' data-size='auto' data-max-options='12' >"; 
	else if(data.tipo_persona=='empleado')
		cadena += "<select onchange='verPersonaEmpleado();' class='selectpicker' id='selectPNF' title='pensum' data-live-search='true' data-size='auto' data-max-options='12' >"; 
	else
		cadena += "<select onchange='verPersona();' class='selectpicker' id='selectPNF' title='pensum' data-live-search='true' data-size='auto' data-max-options='12' >"; 
	cadena += "<option value='seleccionar'>Seleccionar</option>";
	if(data.pnf){
		for(var x=0; x<data.pnf.length;x++)
		{	
			cadena += '<option value="'+data.pnf[x]["codigo"]+'">'+data.pnf[x][2]+'</option>';
		}
	}
	
	cadena +="</select></div>";

	//if(!data.empleado2)
		$(cadena).appendTo('.selectPensum2');
	/*else
		$(cadena).appendTo('.selectPensumEm');*/
	activarSelect();					
}



function montarSelectPNF(data){
console.log(data);

	var cadena = "";
	//if(!data.empleado2){
	$("#selectPensuma").remove();//	$("#selectPensuma").remove();
		cadena+="<div id='selectPensuma'> Pensum ";

	cadena += "<select class='selectpicker' id='selectPNF' title='pensum' data-live-search='true' data-size='auto' data-max-options='12' >"; 
	cadena += "<option value='seleccionar'>Seleccionar</option>";
	if(data.pnf){
		for(var x=0; x<data.pnf.length;x++)
		{	
			cadena += '<option value="'+data.pnf[x]["codigo"]+'">'+data.pnf[x][2]+'</option>';
		}
	}
	
	cadena +="</select></div>";

	//if(!data.empleado2)
		$(cadena).appendTo('.selectPensum');
	//else
		//$(cadena).appendTo('.selectPensumEm');
	activarSelect();					
}
/**
* Funcion Java Script que permite listar Todos los estados que posee un actor
* para que luego sea mostado en un select. los datos son enviados
* por ajax para que se haga la consulta a la base de datos y mostrar 
* los resultados en la funcion mmontarSelectEstado().
*/

function verEstado(){

	var arr = Array("m_modulo"	,	"persona",
					"m_accion"	,	"listarSelects",
					"estado"	,	$("#selectEstado").val(),
					"pnf"		,	$("#selectPNF").val(),
					"instituto"	,	$("#selectInstituto").val()
					);		
	ajaxMVC(arr,montarSelectEstado,error);
}

function verEstadolistar(){
	
	var arr = Array("m_modulo"	,	"persona",
					"m_accion"	,	"listar",
					"estado"	,	$("#selectEstado").val(),
					"pnf"		,	$("#selectPNF").val(),
					"instituto"	,	$("#selectInstituto").val(),
					"campo",		$("#campo").val(),
					"tipo_persona", "ambos"		
					);		
	ajaxMVC(arr,montarSelectEstadoPersona,error);
	
}

/**
* Funcion Java Script que permite mostrar un select con
* los estados y es concatenado a un  div en la vista HTML
*/
function montarSelectEstadoPersona(data){

	console.log(data);
	var cadena = "";
	$("#selectEstados").remove();
	/*if(data.empleado2){
		$("#selectEstadosEm").remove();$("#selectEstadosEm").remove();//$("#selectEstados").remove();	
	}*/
	//alert(data.empleado2);
	//if(!data.empleado2)
		cadena+="<div id='selectEstados'> Estado ";
	/*else
		cadena+="<div id='selectEstadosEm'> Estado";
	*/
	if(data.tipo_persona=='estudiante')
		cadena += "<select onchange='verPersonaEstudiante();' name='selectEstado' id='selectEstado' class='selectpicker'  title='pensum' data-live-search='true' data-size='auto' data-max-options='12' >"; 
	else if(data.tipo_persona=='empleado' )
		cadena += "<select onchange='verPersonaEmpleado();' name='selectEstado' class='selectpicker' id='selectEstado' title='pensum' data-live-search='true' data-size='auto' data-max-options='12' >"; 
	/*else if(data.tipo_persona=="empleado" && data.empleado2==true)
		cadena += "<select onchange='verPersonaEmpleado();' name='selectEstado' class='selectpicker' id='selectEstado' title='pensum' data-live-search='true' data-size='auto' data-max-options='12' >"; 
	*/else
		cadena += "<select onchange='verPersona();' name='selectEstado' class='selectpicker' id='selectEstado' title='pensum' data-live-search='true' data-size='auto' data-max-options='12' >"; 
	cadena += "<option value='seleccionar'>Seleccionar</option>";
	if(data.estado){
		for(var x=0; x<data.estado.length;x++)
		{
			cadena += '<option value="'+data.estado[x]["codigo"]+'">'+data.estado[x]["nombre"]+'</option>';
		}
	}
	cadena +="</select></div>";
	//if(!data.empleado2)
		$(cadena).appendTo('.selectEstado2');
	/*else
		$(cadena).appendTo('.selectEstadoEm');*/
	activarSelect();	
				
}

function montarSelectEstado(data){

	console.log(data);
	var cadena = "";
	$("#selectEstados").remove();

	cadena+="<div id='selectEstados'> Estado ";

	cadena += "<select name='selectEstado' class='selectpicker' id='selectEstado' title='pensum' data-live-search='true' data-size='auto' data-max-options='12' >"; 
	cadena += "<option value='seleccionar'>Seleccionar</option>";
	if(data.estado){
		for(var x=0; x<data.estado.length;x++)
		{
			cadena += '<option value="'+data.estado[x]["codigo"]+'">'+data.estado[x]["nombre"]+'</option>';
		}
	}
	cadena +="</select></div>";
	//if(!data.empleado2)
	$(cadena).appendTo('.selectEstado');
	//else{
		//$(cadena).appendTo('.selectEstadoEm');
		
	//}
	activarSelect();	
				
}

/**
* Funcion Java Script que permite listar Todas las personas
* para que luego sean mostradas. los datos son enviados
* por ajax para que se haga la consulta a la base de datos y mostrar 
* los resultados en la funcion montarPersona().
*/
function verPersona(codi=null){
	console.log($("#selectPNF").val());
	
	var modulo="";
	if($("#tipoPersona").val() && $("#tipoPersona").val()=="ambos")
	 	modulo="persona"
	else if($("#tipoPersona").val())
		modulo=$("#tipoPersona").val();
	else
		modulo="persona";
	
	var arr = Array("m_modulo"	,	modulo,
					"m_accion"	,	"listar",
					"estado"	,	$("#selectEstado").val(),
					"pnf"		,	$("#selectPNF").val(),
					"instituto"	,	$("#selectInstituto").val(),
					"campo"		,	$("#campo").val(),
					"tipo_persona", "ambos",
					"codi"		,	codi
					);
		
		ajaxMVC(arr,montarPersona,error);
	
		
}

function asignarAmbos(){
	$("#tipoPersona").val("ambos");
}
function buscarPorCampo(){

	var arr = Array("m_modulo"	,	"persona",
					"m_accion"	,	"listar",
					"estado"	,	$("#selectEstado").val(),
					"pnf"		,	$("#selectPNF").val(),
					"instituto"	,	$("#selectInstituto").val(),
					"campo"		,	$("#campo").val()
					);
	ajaxMVC(arr,montarPersona,error);
}



/**
* Funcion Java Script que permite listar Todos los empleado
* para que luego sean mostradas. los datos son enviados
* por ajax para que se haga la consulta a la base de datos y mostrar 
* los resultados en la funcion montarPersona().
*/
function verPersonaEmpleado(codi=null){
	$("#tipoPersona").val("empleado");

	var arr = Array("m_modulo"	,	"empleado",
					"m_accion"	,	"listar",
					"estado"	,	$("#selectEstado").val(),
					"pnf"		,	$("#selectPNF").val(),
					"instituto"	,	$("#selectInstituto").val(),
					"tipo_persona",	"empleado",
					"codi"		,	codi,
					"campo"		,   $("#campo").val()
					);
		
	ajaxMVC(arr,montarPersona,error);
}



/**
* Funcion Java Script que permite listar Todos los estudiantes
* para que luego sean mostradas. los datos son enviados
* por ajax para que se haga la consulta a la base de datos y mostrar 
* los resultados en la funcion montarPersona().
*/
function verPersonaEstudiante(codi=null){
	$("#tipoPersona").val("estudiante");
	var arr = Array("m_modulo"	,	"estudiante",
					"m_accion"	,	"listar",
					"estado"	,	$("#selectEstado").val(),
					"pnf"		,	$("#selectPNF").val(),
					"instituto"	,	$("#selectInstituto").val(),
					"tipo_persona",	"estudiante",
					"codi"		,	codi,
					"campo"		,   $("#campo").val()
					);
	//alert(codi);
	ajaxMVC(arr,montarPersona,error);
}

/**
* Funcion Java Script que permite mostrar una tabla con
* las personas y es concatenado a una tabla en la vista HTML
*/
function montarPersona(data){	

	cadena="";
	cadena+='<tbody id="listarPersona">';
	$("#btnVerPersona").hide();
	$("#btnModificarPersona").hide();	
	if(data.persona!=null){
		$("#btnVerPersona").show();
		$("#btnModificarPersona").show();
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

			if(data.codi){
				if(data.codi==data.persona[x]['cod_persona']){
					$("#cod_persona").val(data.persona[x]['cod_persona']);

					if(data.tipo_persona=="estudiante"){
						cadena+="<tr onclick='verPersonaEstudiante("+data.persona[x]['cod_persona']+");' style='background-color:#E5EAEE;'>";
					}
					else if(data.tipo_persona=="empleado")
						cadena+="<tr onclick='verPersonaEmpleado("+data.persona[x]['cod_persona']+");' style='background-color:#E5EAEE;'>";
					else if(data.tipo_persona=="ambos")
						cadena+="<tr onclick='verPersona("+data.persona[x]['cod_persona']+");' style='background-color:#E5EAEE;'>";

				}
				else{
					if(data.tipo_persona=="estudiante")
						cadena+="<tr onclick='verPersonaEstudiante("+data.persona[x]['cod_persona']+");'>";
					else if(data.tipo_persona=="empleado")
						cadena+="<tr onclick='verPersonaEmpleado("+data.persona[x]['cod_persona']+");'>";
					else if(data.tipo_persona=="ambos")
						cadena+="<tr onclick='verPersona("+data.persona[x]['cod_persona']+");' >";

					//cadena+="<tr onclick='verPersona("+data.persona[x]['cod_persona']+");'>";
				}
			}
			else{

				if($("#tipoPersona").val()=="estudiante")
					cadena+="<tr onclick='verPersonaEstudiante("+data.persona[x]['cod_persona']+");'>";
				else if($("#tipoPersona").val()=="empleado")
					cadena+="<tr onclick='verPersonaEmpleado("+data.persona[x]['cod_persona']+");'>";
				else if($("#tipoPersona").val()=="ambos")
					cadena+="<tr onclick='verPersona("+data.persona[x]['cod_persona']+");' >";

				//cadena+="<tr onclick='verPersona("+data.persona[x]['cod_persona']+");'>";
			}
			cadena+="<td>"+data.persona[x]['cod_persona']+"</td>";
			cadena+="<td>"+data.persona[x]['cedula']+"</td>";
			cadena+="<td>"+data.persona[x]['apellido1']+" "+nombre+"</td>";
			cadena+="<td>"+data.persona[x]['nombre1']+" "+apellido+"</td>";
			cadena+="<td>"+data.persona[x]['cor_personal']+"</td>";
			cadena+="</tr>";
		}
	}
	else
		cadena+="<tr><td align='center' colspan='5'>"+data.mensaje+"</td></tr>";
	cadena+="</tbody>";

	$("#listarPersona").remove();
	$(cadena).appendTo('#primeraTabla');

}



/**
* Funcion Java Script que permite modificar la informacion
* de una persona de la base de datos. Los Datos son enviados
* por ajax.
*//*
function modificarPersonas(){
	var arr = Array("m_modulo"	,	"persona",
					"m_accion"	,	"modificar",
					"codPersona", $('input:radio[name=cod_persona]:checked').val()
					);	

		ajaxMVC(arr,succMontarModificarPerson,error);

}

function succMontarModificarPerson(data)
{
	alert("lol");
	/*if(data.estatus>0)
		montarModificarPersona(data);
	else
		mostrarMensaje(data.mensaje,4);
}

function montarModificarPersona(data){

	alert("hola");
	//document.location.href = "index.php?m_modulo=persona&m_formato=html5&m_accion=listar&m_vista=Agregar";
	
}
*/

function preGuardarPersona(){
	var bool=true;
	if(!validarSoloNumeros('#ced_persona',6,8,true)){
		mostrarMensaje("Debes introducir una cedula",2);
		bool=false;
	}
	else if(!validarSoloTexto('#nombre1',2,20,true)){
		mostrarMensaje("Debes introducir el primer nombre",2);
		bool=false;
	}
	else if (!validarSoloTexto('#nombre2',2,20,false)){
		mostrarMensaje("para los campos nombre solo se permiten letras",2);
		bool=false;
	}
	else if (!validarSoloTexto('#apellido1',2,20,true)){
		mostrarMensaje("Debes introducir el primer apellido",2);
		bool=false;
	}
	else if(!validarSoloTexto('#apellido2',2,20,false)){
		mostrarMensaje("para los campos apellido solo se permiten letras",2);
		bool=false;
	}
	else if(!validarTelefono('#telefono1',7,15,false)){
		mostrarMensaje("debes introducir un número telefónico valido",2);
		bool=false;
	}
	else if(!validarTelefono('#telefono2',7,15,false)){
		mostrarMensaje("debes introducir un número telefónico valido",2);
		bool=false;
	}
	else if(!validarEmail('#cor_personal',10,50,false)){
		mostrarMensaje("introduzca un E-mail valido",2);
		bool=false;
	}
	else if(!validarEmail('#cor_institucional',10,50,false)){
		mostrarMensaje("introduzca un E-mail valido",2);
		bool=false;
	}
	else if($("#fec_nac").val()){
		if(validarFecha('#fec_nac',false)){
			var fecha=$("#fec_nac").val().split("/");
			var actual= fecActual().split("/");
			//alert(actual[2]-fecha[2]);
			if(actual[2]-fecha[2]<=15){
				mostrarMensaje("la persona tiene que tener almenos 15 años",2);
				bool=false;
			}
			if(!validarFecha('#fec_nac',false)){
				mostrarMensaje("debe de introducir una fecha valida",2);
				bool=false;
			}

		}		
	}

	if(bool)
		guardarPersona();
}


/**
* Funcion Java Script que permite guardar los datos de a una persona
* para que luego sean guaradosde la base de datos. Los Datos son enviados
* por ajax.
*/
function guardarPersona(){

//	var data = new FormData();
	var a="archivo";
	var b="";
	jQuery.each(jQuery('#foto')[0].files, function(i, file) {
	   // data.append('file-'+i, file);
	   a='archivo';
	   b=file;
	});

	var arr= Array( "m_modulo"	,	"persona",
					"m_accion"	,	"agregar",
					//"m_modulo"	,	"persona",
					//"m_accion"	,	"agregar",
					"cedPersona",	$("#ced_persona").val(),
					"rifPersona",	$("#rif_persona").val(),
					"nombre1"	,	$("#nombre1").val(),
					"nombre2"	,	$("#nombre2").val(),
					"apellido1"	,	$("#apellido1").val(),
					"apellido2"	,	$("#apellido2").val(),
					"telefono1"	,	$("#telefono1").val(),
					"telefono2"	,	$("#telefono2").val(),
					"corPersonal"	,	$("#cor_personal").val(),
					"corInstitucional"	,	$("#cor_institucional").val(),
					"discapacidad"	,	$("#discapacidad").val(),
					"direccion"	,	$("#direccion").val(),
					"obsPersona"	,	$("#obs_persona").val(),
					"sexo"		,	$('#sexo').val(),
					"tipSangre" ,	$('#tip_sangre').val(),
					"hijo"		,	$('#hijo').val(),
					"estCivil"	,	$('#est_civil').val(),
					"nacionalidad",	$('#nacionalidad').val(),
					"fecNacimiento",$('#fec_nac').val(),
					"codigo",		$('#cod_persona').val(),
					"estado",		$('#estado').val(),
					a 		,		b
				);
	console.log(arr);
	setTimeout(function(){ ajaxMVC(arr,succAgregarPersona,error); }, 300);
	
	//ajaxMVC(arr,succAgregarPersona,error);
}

/**
* Funcion Java Script que permite listar a una persona en el HTML para
* que lugo se modifique su informacionde la base de datos. Los Datos son enviados
* por ajax.
*/
function modificarPersona(codigo=null){

//alert(codigo+" el codigo");
	if(getVarsUrl().persona)
		codigo=getVarsUrl().persona;
	else if(!codigo)
		codigo=$('#cod_persona').val();

	window.location.href = 'index.php?m_modulo=persona&m_vista=Principal&m_accion=listar&m_formato=html5&persona='+codigo+'&accion=M';
}

function mostrarPersona(){

	var codigo=null;
	if(getVarsUrl().persona)
		codigo=getVarsUrl().persona;
	else
		codigo=$('#cod_persona').val();
	
	window.location.href = 'index.php?m_modulo=persona&m_vista=Principal&m_formato=html5&persona='+codigo+'&accion=V';
}

function bloquearCampos(ver=null){			
	bloquearCamposEstudiante();		
}




function mostrarInformaion(){
	$("#historico").hide();

	
	var arr = Array("m_modulo"	,"persona",
				"m_accion"	,	"modificar",					
				"codPersona",  getVarsUrl().persona								
				);

	if(getVarsUrl().accion=='M'){			
		$("#editar_estudiante").remove();
		$("#editar_empleado").remove();
		$("#md_persona").remove();

	}
	else if(getVarsUrl().accion=='V'){
		$("#md_estudiante").remove();
		$("#md_empleado").remove();
		$("#borrar_estudiante").remove();
		$("#borrar_empleado").remove();
		$("#guardarPersona").remove();
		$("#nv_estudiante").remove();
		$("#nv_empleado").remove();
		$("#nuevo_empleado").remove();
		$("#nuevo_estudiante").remove();
		$("#fotoSpan").remove();
		$("#borrar_persona").remove();
	}
	else if(getVarsUrl().accion=='N'){
		$("#borrar_persona").remove();
		$("#md_persona").remove();
		$("#nuevo_empleado").remove();
	}
	else {
		$("#md_estudiante").remove();
		$("#md_empleado").remove();
		$("#borrar_estudiante").remove();
		$("#borrar_empleado").remove();
		$("#editar_estudiante").remove();
		$("#editar_empleado").remove();
		$("#nuevo_estudiante").remove();
		$("#nuevo_empleado").remove();
		$("#nv_empleado").remove();
		$("#nv_estudiante").remove();
		$("#foto").remove();
		$("#borrar_persona").remove();
		$("#md_persona").remove();
		$("#guardarPersona").remove();
		$("#nuevo_empleado").remove();
	}
	if(getVarsUrl().persona!="-1" && getVarsUrl().persona)
		ajaxMVC(arr,succMontarModificarPersona,error);
}

function mostrarInformaion2(){
	if(getVarsUrl().persona){
		var arr = Array("m_modulo"	,"persona",
						"m_accion"	,"modificar",					
						"codPersona",  getVarsUrl().persona								
						);		

		ajaxMVC(arr,succMontarModificarPersona2,error);
	}
	
	
}

function succMontarModificarPersona2(data){
	if(data.empleado){
		setTimeout(function(){ succMontarModificarEmpleado(data); }, 300);
	}


}
/**
 * esta funcion JavaScript permite signar los datos obtenido en la
 * consuta  la base de datos y colocarlos en la vista HTML
 * de esta manera el usuario podra modificar los datos de la persona
 */
/*
function succMontarModificarPersona (data){
	console.log(data);
	window.location.href = 'index.php?m_modulo=persona&m_vista=Agregar&m_formato=html5&persona='+data.persona[0]['cod_persona'];
		
	//ajaxMVC(arr,succMontarModificarPersona2,error);
	
}*/


function succMontarModificarPersona(data){
	/*console.log(data.persona);
	console.log(data.persona);*/


	//verEstadoEs();	
	tabsActivos(); 
	
	//$("#estudiante").show();
	//$("#historico").hide();
	$("#ced_persona").val(data.persona[0]['cedula']);
	$("#rif_persona").val(data.persona[0]['rif']);
	$("#nombre1").val(data.persona[0]['nombre1']);
	$("#nombre2").val(data.persona[0]['nombre2']);
	$("#apellido1").val(data.persona[0]['apellido1']);
	$("#apellido2").val(data.persona[0]['apellido2']);
	$("#telefono1").val(data.persona[0]['telefono1']);
	$("#telefono2").val(data.persona[0]['telefono2']);
	$("#cor_personal").val(data.persona[0]['cor_personal']);
	$("#cor_institucional").val(data.persona[0]['cor_institucional']);
	$("#discapacidad").val(data.persona[0]['discapacidad']);
	$("#direccion").val(data.persona[0]['direccion']);
	$("#obs_persona").val(data.persona[0]['observaciones']);
	$('#sexo').val(data.persona[0]['sexo']);
	$('#tip_sangre').val(data.persona[0]['tip_sangre']);
	$('#hijo').val(data.persona[0]['hijos']);
	$('#est_civil').val(data.persona[0]['est_civil']);
	$('#nacionalidad').val(data.persona[0]['nacionalidad']);
	$('#fecNacimiento').val(data.persona[0]['fec_nacimiento']);
	$('#cod_persona').val(data.persona[0]['codigo']);
	$('#codigoPersona').val(data.persona[0]['codigo']);
	//setTimeout(function(){ 
	if(data.foto){
		$("#imagen").remove();
		var cadena ="";
		cadena+="<div id='imagen'>";
		cadena+="<img src="+data.foto+" >";
		cadena+="</div>";
		
		$("#superImagen").append(cadena);
	}
	
	//}, 400);
	//alert(data.foto);
	
	if(data.empleado)
		setTimeout(function(){ succMontarModificarEmpleado(data); }, 400);
	else{
		verInstitutoEm2(); verEstadoEm2(); verPNFEm2();
	}

	if(data.estudiante)
		setTimeout(function(){ succMontarModificarEstudiante(data); }, 400);

}

/**
* Funcion Java Script que permite borrar a una persona
* de la base de datos. Los Datos son enviados
* por ajax.
*/
function borrarPersona(){ //activoo controlador.
	var arr = Array("m_modulo"	,	"persona",
					"m_accion"	,	"eliminar",
					"cod_persona",  $("#cod_persona").val()									
					);
		
	ajaxMVC(arr,succMontarEliminarPersona,error);

}

function succMontarEliminarPersona (data){

	if(data.estatus>0){
		mostrarMensaje(data.mensaje,1);
		setTimeout(function(){ 
			window.location.href = 'index.php?m_accion=listar&m_modulo=persona&m_vista=Listar&m_formato=html5'
		}, 2000);
	}
	else
		mostrarMensaje(data.mensaje,2);

}


function fecActual(){
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();

	if(dd<10) {
	    dd='0'+dd
	} 

	if(mm<10) {
	    mm='0'+mm
	} 

	today = dd+'/'+mm+'/'+yyyy;
	return today;
}

function succAgregarPersona(data){
	//aqui se agrega el codigo de persona en el hiden
	//console.log(data);
//alert(data.mensaje);
	//alert(data.codPersona);

	if(data.estatus>0)
		mostrarMensaje(data.mensaje, 1);
	else
		mostrarMensaje(data.mensaje, 2);

	$('#cod_persona').val(data.codPersona);
	$('#codigoPersona').val(data.codPersona);
	if(data.codPersona){
		tabsActivos(); 
		//modificarPersona(data.codPersona);
		//alert(data.codPersona+"antes");
		verEmpleado();
		verEstudiante();
		//AgregarEsEm();
		//$('div.estudiante').fadeIn(700);				
		$('div.empleado').hide();
		$("#historico").hide();
		$('#fec_ini_estudiante').val(fecActual());
		
		if(data.foto){
			//alert(data.foto);
			$("#imagen").remove();
			var cadena ="";
			cadena+="<div id='imagen'>";
			cadena+="<img src="+data.foto+" width='200' height='200'>";
			cadena+="</div>";
			
			$("#superImagen").append(cadena);
			$("#imagen").remove();
			modificarPersona(data.codPersona); 
		}
		if(data.mensajeFoto)
			mostrarMensaje(data.mensajeFoto,2);		

	}

}

function exportarODS(){

	window.location.assign("index.php?m_modulo=persona&m_formato=ods&m_vista=ListarPersona&m_accion=listar&pnf="+$("#selectPNF").val()+"&estado="+$("#selectEstado").val()+"&instituto="+$("#selectInstituto").val());
}

function exportarPDF(){
	//verPersona();
	window.location.assign("index.php?m_modulo=persona&m_formato=pdf&m_vista=ListarPersona&m_accion=listar&pnf="+$("#selectPNF").val()+"&estado="+$("#selectEstado").val()+"&instituto="+$("#selectInstituto").val());
}

function exportarODT(){

	window.location.assign("index.php?m_modulo=persona&m_formato=odt&m_vista=ListarPersona&m_accion=listar&pnf="+$("#selectPNF").val()+"&estado="+$("#selectEstado").val()+"&instituto="+$("#selectInstituto").val());
}

function tabsBloqueados(){
	
	$("#tabsBloqueado").hide();
	$("#tabsActivo").hide();
	$("#historico").hide();
}

function tabsActivos(){
	
	$("#tabsBloqueado").hide();
	$("#tabsActivo").show();
}

function removerEsEm(){
	
	$("#estudiante").hide();
	$("#empleado").hide();
	
}

/**
* Funcion Java Script que permite mostrar un mensaje de error.
*/
function error(data){	
	console.log(data);
	mostrarMensaje("Error de comunicación con el servidor.",2);
}
