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

	if($('#pantalla').val()=="principal"){
		
		limpiarCamposPersona();	
		tabsBloqueados();
		removerEsEm();		
		
		var accion =getVarsUrl().accion;
		if(accion=="V"){
			bloquearCamposPersona();
		}
		
		mostrarInformaion();
		activarCal();
	}
	else if(getVarsUrl().Fbtn || getVarsUrl().FCampo || getVarsUrl().FInstituto || getVarsUrl().FPensum){	
	//	window.location.href = 'index.php?m_modulo=persona&m_vista=Listar&m_formato=html5&FInstituto='+getVarsUrl().FInstituto+'&FPensum='+getVarsUrl().FPensum+'&FEstado='+getVarsUrl().FEstado+'&FCampo='+getVarsUrl().FCampo;
		//alert($("#bTodos1").css("background-color"));rgb(79, 216, 176);
	
		if(getVarsUrl().Fbtn=="todos"){
			$("#bTodos3").css("background-color","#209472");
			$("#bTodos1").css("background-color","#4FD8B0");
			$("#bTodos2").css("background-color","#4FD8B0");
		}
		else if(getVarsUrl().Fbtn=="estudiantes"){
			$("#bTodos3").css("background-color","#4FD8B0");
			$("#bTodos1").css("background-color","#4FD8B0");
			$("#bTodos2").css("background-color","#209472");
		}
		else{
			$("#bTodos3").css("background-color","#4FD8B0");
			$("#bTodos1").css("background-color","#209472");
			$("#bTodos2").css("background-color","#4FD8B0");
		}
		//verEstadolistar();
		verInstitutoListar();		
				
		$("#campo").val(quitarEspacioUrl(getVarsUrl().FCampo));
		setTimeout(function(){ 			
			$("#selectInstituto").val(getVarsUrl().FInstituto);		
			$('#selectInstituto').selectpicker('refresh');
			verPNFListar();
			if(getVarsUrl().Fbtn=="todos")
				verEstadolistar();
			else if(getVarsUrl().Fbtn=="estudiantes")
				verEstadoEs();
			else
				verEstadoEm(); 
			
			setTimeout(function(){ 
				$("#selectPNF").val(getVarsUrl().FPensum);		
				$('#selectPNF').selectpicker('refresh');
				$("#selectEstado").val(getVarsUrl().FEstado);
				$('#selectEstado').selectpicker('refresh');
				if(getVarsUrl().Fbtn=="todos")
					verPersona(); //TodosFocus();
				else if(getVarsUrl().Fbtn=="estudiantes")
					verPersonaEstudiante();
				else
					verPersonaEmpleado();
			},450);
		},200);
		
	}
	else if(getVarsUrl().m_vista=="CargaArchivoNuevoIngreso"){
		selectInstituto();		
		$("#btnRegistrar").hide();
		$("#noInscritos").hide();
		$("#noInscritos").hide();
		$("#limpiarFormulario").hide();
	}
	else{
		verEstadolistar();
		verInstitutoListar();		
		verPersona();
		TodosFocus();
	}



});



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
	var Fbtn="";
	//alert($("#bTodos1").css("background-color"));rgb(79, 216, 176);
	if($("#bTodos3").css("background-color")=="rgb(32, 148, 114)")
		Fbtn="todos";
	else if($("#bTodos2").css("background-color")=="rgb(32, 148, 114)")
		Fbtn="estudiantes";
	else
		Fbtn="profesores";
	if($("#campo").val()!=undefined)
		window.location.href = 'index.php?m_modulo=persona&m_vista=Principal&m_formato=html5&accion=N&persona=-1&FInstituto='+$("#selectInstituto").val()+'&FPensum='+$("#selectPNF").val()+'&FEstado='+$("#selectEstado").val()+'&FCampo='+$("#campo").val()+'&Fbtn='+Fbtn; 
	else
		window.location.href = 'index.php?m_modulo=persona&m_vista=Principal&m_formato=html5&accion=N&persona=-1&FInstituto='+getVarsUrl().FInstituto+'&FPensum='+getVarsUrl().FPensum+'&FEstado='+getVarsUrl().FEstado+'&FCampo='+getVarsUrl().FCampo+'&Fbtn='+getVarsUrl().Fbtn; 
																																								 																							
}

function nuevoPersonaEmpleado (){	
	window.location.href = 'index.php?m_modulo=persona&m_vista=Agregar&m_formato=html5&accion=N&persona=-1'; 
}

function fotoTamaño(mensaje){
	input = document.getElementById('foto');
	if($("#foto").val()){
		if((input.files[0].size/1024/1024)>1){
			if(!mensaje)
				mostrarMensaje("La imagen NO puede ser mayor a 1 MB ",2);

			$("#foto").val("");
			$("#imagen").remove();
			var cadena ="";
			///var fso = new ActiveXObject("Scripting.FileSystemObject");
			var archivo= 'modulos/persona/vista/html5/imagen/foto.png';
			cadena+="<div id='imagen'>";
			cadena+="<img src="+archivo+" width='200' height='200'>";
			cadena+="</div>";
			//alert(FileExists(fso.archivo));
			$("#superImagen").append(cadena);
			return false;
		}
		else
			return true;
	}
}

function fotoExtencion (mensaje){ 
	
	var  extensiones_permitidas = new Array(".png", ".jpg",".gif","jpeg"); 
	var  error = ""; 
	var  archivo=$("#foto").val();
	
	if (archivo) 	  
   { 
	    //recupero la extensión de este nombre de archivo 
	    var  extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase(); 
	     
	    //compruebo si la extensión está entre las permitidas 
	    var  permitida = false; 
	    for (var i = 0; i < extensiones_permitidas.length; i++) 
	    { 
	       if (extensiones_permitidas[i] == extension) 
	       { 
		       permitida = true; 		        
		       break; 
	        } 
	    } 	      
	} 

	

	if (!permitida){

		if(!mensaje){
			error = "Comprueba la extension de los archivos a subir. \n Solo se pueden subir archivos con extensiones: " + extensiones_permitidas.join(); 
			mostrarMensaje(error,2);
		}
		//mostrarMensaje(error,2); 
		$("#foto").val("");
		$("#imagen").remove();
		var cadena ="";
		///var fso = new ActiveXObject("Scripting.FileSystemObject");
		var archivo= 'modulos/persona/vista/html5/imagen/foto.png';
		cadena+="<div id='imagen'>";
		cadena+="<img src="+archivo+" width='200' height='200'>";
		cadena+="</div>";
		//alert(FileExists(fso.archivo));
		$("#superImagen").append(cadena);
		
		return false;
	}
	else 
		return true;



}

function foto(){

	$("#foto").on("change", function(){
		
	/* Limpiar vista previa */
	    $("#vista-previa").html('');

	    var archivos = document.getElementById('foto').files;

	    var navegador = window.URL || window.webkitURL;

	    /* Recorrer los archivos */

	    if(fotoExtencion(true) && fotoTamaño(true)){
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
		}
		
	});
}

function estudianteFocus(){
	var boton='';
	boton ='<button type="button" id="bTodos1" class="btn btn-info boton-focus" style="background-color: #4FD8B0;" title="Solo Empleados" onclick="succBuscarFoto(); empleadoFocus(); verPersonaEmpleado(); verEstadoEm(); ">  <b>Empleados</b>	</button>';
	boton +='<button type="button" id="bTodos2" class="btn btn-info boton-focus"style="background-color: #209472;"  title="Solo Estudiantes" onclick="succBuscarFoto(); estudianteFocus(); verPersonaEstudiante(); verEstadoEs(); "><b>Estudiantes<b></button>';
	boton +='<button type="button" id="bTodos3"  class="btn btn-info boton-focus" style="background-color: #4FD8B0;"title="todos" onclick="TodosFocus(); succBuscarFoto();asignarAmbos(); verPersona(); verEstadolistar(); "><b>Todos<b></button>';
	$("#bTodos1").remove();
	$("#bTodos2").remove();
	$("#bTodos3").remove();
	$(boton).appendTo("#botones");
}
function empleadoFocus(){
	var boton='';
	boton ='<button type="button" id="bTodos1" class="btn btn-info boton-focus" style="background-color: #209472;"title="Solo Empleados" onclick="succBuscarFoto(); empleadoFocus(); verPersonaEmpleado(); verEstadoEm(); ">  <b>Empleados</b>	</button>';
	boton +='<button type="button" id="bTodos2" class="btn btn-info boton-focus" style="background-color: #4FD8B0;" title="Solo Estudiantes" onclick="succBuscarFoto(); estudianteFocus(); verPersonaEstudiante(); verEstadoEs(); "><b>Estudiantes<b></button>';
	boton +='<button type="button" id="bTodos3" class="btn btn-info boton-focus" style="background-color: #4FD8B0;"  title="todos" onclick="succBuscarFoto(); TodosFocus(); asignarAmbos(); verPersona(); verEstadolistar(); "><b>Todos<b></button>';
	$("#bTodos1").remove();
	$("#bTodos2").remove();
	$("#bTodos3").remove();
	$(boton).appendTo("#botones");
}
function TodosFocus(){
	var boton='';

	boton ='<button type="button" id="bTodos1" class="btn btn-info boton-focus" style="background-color: #4FD8B0;" title="Solo Empleados" onclick="succBuscarFoto(); empleadoFocus(); verPersonaEmpleado(); verEstadoEm(); ">  <b>Empleados</b>	</button>';
	boton +='<button type="button" id="bTodos2" class="btn btn-info boton-focus" style="background-color: #4FD8B0;" title="Solo Estudiantes" onclick="succBuscarFoto(); estudianteFocus(); verPersonaEstudiante(); verEstadoEs(); "><b>Estudiantes<b></button>';
	boton +='<button type="button" id="bTodos3" style="background-color: #209472;" class="btn btn-info boton-focus" title="todos" onclick="succBuscarFoto(); TodosFocus(); asignarAmbos(); verPersona(); verEstadolistar(); "><b>Todos<b></button>';
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
	var arr = Array("m_modulo"	,	"instituto",
					"m_accion"	,	"listar"
					);
		
	ajaxMVC(arr,montarSelectInstitutoPersona,error);
}

/**
* Funcion Java Script que permite mostrar un select con
* los institutos y es concatenado a un  div en la vista HTML
*/

function montarSelectInstitutoPersona(data){

	var cadena = "";
	$("#selectIns").remove();
	cadena+="<div id='selectIns'> Instituto ";
	
	if(data.tipo_persona=='estudiante')
		cadena += "<select onchange='verPersonaEstudiante(); succBuscarFoto(); verPNFEs();' class='selectpicker' id='selectInstituto' title='institutos' data-live-search='true' data-size='auto' data-max-options='12' >"; 
	else if(data.tipo_persona=='empleado')
		cadena += "<select onchange='verPersonaEmpleado(); succBuscarFoto(); verPNFEm();' class='selectpicker' id='selectInstituto' title='institutos' data-live-search='true' data-size='auto' data-max-options='12' >"; 

	else
		cadena += "<select onchange='verPersona(); succBuscarFoto(); verPNFListar();' class='selectpicker' id='selectInstituto' title='institutos' data-live-search='true' data-size='auto' data-max-options='12' >"; 
	cadena += "<option value='seleccionar' >Seleccionar</option>";
	if(data.institutos){
		for(var x=0; x<data.institutos.length;x++)
		{
			if(data.datos){
				if((data.datos[0].emp_inst != data.institutos[x]["codigo"] || !data.datos[0].emp_inst ) && (data.datos[0].est_inst != data.institutos[x]["codigo"] || !data.datos[0].est_inst ) )
					cadena += '<option value="'+data.institutos[x]["codigo"]+'">'+data.institutos[x]["nom_corto"]+'</option>';
				else{
					
					cadena += '<option selected value="'+data.institutos[x]["codigo"]+'">'+data.institutos[x]["nom_corto"]+'</option>';
					setTimeout(function(){ 

						if(data.tipo_persona=='estudiante' && !getVarsUrl().FPensum)
							verPNFEs();
						else if(data.tipo_persona=='empleado' && !getVarsUrl().FPensum)
							verPersonaEmpleado(); 
						else if(!getVarsUrl().FPensum)
							verPNFListar();
					}, 1000);
				}
			}
			else
				cadena += '<option value="'+data.institutos[x]["codigo"]+'">'+data.institutos[x]["nom_corto"]+'</option>';
		}
	}

	cadena +="</select>";

	$(cadena).appendTo('#selectInstitutos2');
	$(cadena).appendTo('.selectInstituto2');

	activarSelect();	

}

function montarSelectInstituto(data){
	var cadena = "";

	$("#selectIns").remove();
	cadena+="<div id='selectIns'> institutos ";
	if(!data.empleado2)
		cadena += "<select onchange='verPNFEsPrincipal();' class='selectpicker' id='selectInstituto' title='institutos' data-live-search='true' data-size='auto' data-max-options='12' >"; 

	cadena += "<option value='seleccionar' >Seleccionar</option>";
	if(data.institutos)
	for(var x=0; x<data.institutos.length;x++)
	{	
		if(data.datos){
			if((data.datos[0].emp_inst != data.institutos[x]["codigo"] || !data.datos[0].emp_inst ) && (data.datos[0].est_inst != data.institutos[x]["codigo"] || !data.datos[0].est_inst ) )
				cadena += '<option value="'+data.institutos[x]["codigo"]+'">'+data.institutos[x]["nom_corto"]+'</option>';
			else{
				cadena += '<option selected value="'+data.institutos[x]["codigo"]+'">'+data.institutos[x]["nom_corto"]+'</option>';			

				setTimeout(function(){ 
					verPNFEsPrincipal();
				}, 1000);
				
			}
		}
		else
			cadena += '<option value="'+data.institutos[x]["codigo"]+'">'+data.institutos[x]["nom_corto"]+'</option>';
	}
	cadena +="</select>";

	$(cadena).appendTo('#selectInstitutos');
	$(cadena).appendTo('.selectInstituto');

	activarSelect();	

}

/**
* Funcion Java Script que permite listar Todos los PNF
* para que luego sea mostado en un select. los datos son enviados
* por ajax para que se haga la consulta a la base de datos y mostrar 
* los resultados en la funcion montarSelectPNF().
*/
function verPNFListar(){

	var arr = Array("m_modulo"	,	"pensum",
					"m_accion"	,	"buscarPorInstituto",
					"codigo"	,	$("#selectInstituto").val()				
					);
		
	ajaxMVC(arr,montarSelectPNFPersona,error);
}

/**
* Funcion Java Script que permite mostrar un select con
* los PNF y es concatenado a un  div en la vista HTML
*/
function montarSelectPNFPersona(data){

	console.log(data);
	var cadena = "";

	$("#selectPensuma").remove();
	cadena+="<div id='selectPensuma'> Pensum ";
	
	if(data.tipo_persona=='estudiante')
		cadena += "<select onchange='verPersonaEstudiante(); succBuscarFoto();' class='selectpicker' id='selectPNF' title='pensum' data-live-search='true' data-size='auto' data-max-options='12' >"; 
	else if(data.tipo_persona=='empleado')
		cadena += "<select onchange='verPersonaEmpleado(); succBuscarFoto();' class='selectpicker' id='selectPNF' title='pensum' data-live-search='true' data-size='auto' data-max-options='12' >"; 
	else
		cadena += "<select onchange='verPersona(); succBuscarFoto();' class='selectpicker' id='selectPNF' title='pensum' data-live-search='true' data-size='auto' data-max-options='12' >"; 
	cadena += "<option value='seleccionar'>Seleccionar</option>";
	
	if(data.pensum){
		for(var x=0; x<data.pensum.length;x++)
		{	
			cadena += '<option value="'+data.pensum[x]["codigo"]+'">'+data.pensum[x][2]+'</option>';
		}
	}
	
	cadena +="</select></div>";

	$(cadena).appendTo('.selectPensum2');

	activarSelect();					
}



function montarSelectPNF(data){
	var cadena = "";

	$("#selectPensuma").remove();
		cadena+="<div id='selectPensuma'> Pensum ";

	cadena += "<select class='selectpicker' id='selectPNF' title='pensum' data-live-search='true' data-size='auto' data-max-options='12' >"; 
	cadena += "<option value='seleccionar'>Seleccionar</option>";
	
	if(data.pensum){
		for(var x=0; x<data.pensum.length;x++)
		{	
			cadena += '<option value="'+data.pensum[x]["codigo"]+'">'+data.pensum[x][2]+'</option>';
		}
	}
	
	cadena +="</select></div>";

	$(cadena).appendTo('.selectPensum');

	activarSelect();					
}
/**
* Funcion Java Script que permite listar Todos los estados que posee un actor
* para que luego sea mostado en un select. los datos son enviados
* por ajax para que se haga la consulta a la base de datos y mostrar 
* los resultados en la funcion mmontarSelectEstado().
*/

function verEstadolistar(){
	var arr = Array("m_modulo"	,	"persona",
					"m_accion"	,	"listarEstadoEstudianteEmpleado"
					);		
	ajaxMVC(arr,montarSelectEstadoPersona,error);
}


/**
* Funcion Java Script que permite mostrar un select con
* los estados y es concatenado a un  div en la vista HTML
*/
function montarSelectEstadoPersona(data){

	var cadena = "";
	$("#selectEstados").remove();

	cadena+="<div id='selectEstados'> Estado ";

	if(data.tipo_persona=='estudiante')
		cadena += "<select onchange='verPersonaEstudiante(); succBuscarFoto();' name='selectEstado' id='selectEstado' class='selectpicker'  title='pensum' data-live-search='true' data-size='auto' data-max-options='12' >"; 
	else if(data.tipo_persona=='empleado' )
		cadena += "<select onchange='verPersonaEmpleado(); succBuscarFoto();' name='selectEstado' class='selectpicker' id='selectEstado' title='pensum' data-live-search='true' data-size='auto' data-max-options='12' >"; 
	else
		cadena += "<select onchange='verPersona(); succBuscarFoto();' name='selectEstado' class='selectpicker' id='selectEstado' title='pensum' data-live-search='true' data-size='auto' data-max-options='12' >"; 
	cadena += "<option value='seleccionar'>Seleccionar</option>";
	if(data.estado){
		for(var x=0; x<data.estado.length;x++)
		{
			cadena += '<option value="'+data.estado[x]["codigo"]+'">'+data.estado[x]["nombre"]+'</option>';
		}
	}
	cadena +="</select></div>";

	$(cadena).appendTo('.selectEstado2');
	activarSelect();	
				
}

function montarSelectEstado(data){

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

	$(cadena).appendTo('.selectEstado');

	activarSelect();	
				
}

/**
* Funcion Java Script que permite listar Todas las personas
* para que luego sean mostradas. los datos son enviados
* por ajax para que se haga la consulta a la base de datos y mostrar 
* los resultados en la funcion montarPersona().
*/
function verPersona(codi){
	
	
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
function verPersonaEmpleado(codi){
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
function verPersonaEstudiante(codi){
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
						cadena+="<tr class='pointer' onclick='verPersonaEstudiante("+data.persona[x]['cod_persona']+"); buscarFoto("+data.persona[x]['cod_foto']+","+data.persona[x]['cod_persona']+");' style='background-color:#E5EAEE;'>";
					}
					else if(data.tipo_persona=="empleado")
						cadena+="<tr class='pointer' onclick='verPersonaEmpleado("+data.persona[x]['cod_persona']+"); buscarFoto("+data.persona[x]['cod_foto']+","+data.persona[x]['cod_persona']+");' style='background-color:#E5EAEE;'>";
					else if(data.tipo_persona=="ambos")
						cadena+="<tr class='pointer' onclick='verPersona("+data.persona[x]['cod_persona']+"); buscarFoto("+data.persona[x]['cod_foto']+","+data.persona[x]['cod_persona']+");' style='background-color:#E5EAEE;'>";

				}
				else{
					if(data.tipo_persona=="estudiante")
						cadena+="<tr class='pointer' onclick='verPersonaEstudiante("+data.persona[x]['cod_persona']+"); buscarFoto("+data.persona[x]['cod_foto']+","+data.persona[x]['cod_persona']+");'>";
					else if(data.tipo_persona=="empleado")
						cadena+="<tr class='pointer' onclick='verPersonaEmpleado("+data.persona[x]['cod_persona']+"); buscarFoto("+data.persona[x]['cod_foto']+","+data.persona[x]['cod_persona']+");'>";
					else if(data.tipo_persona=="ambos")
						cadena+="<tr class='pointer' onclick='verPersona("+data.persona[x]['cod_persona']+"); buscarFoto("+data.persona[x]['cod_foto']+","+data.persona[x]['cod_persona']+");' >";
				}
			}
			else{

				if($("#tipoPersona").val()=="estudiante")
					cadena+="<tr class='pointer' onclick='verPersonaEstudiante("+data.persona[x]['cod_persona']+"); buscarFoto("+data.persona[x]['cod_foto']+","+data.persona[x]['cod_persona']+");'>";
				else if($("#tipoPersona").val()=="empleado")
					cadena+="<tr class='pointer' onclick='verPersonaEmpleado("+data.persona[x]['cod_persona']+"); buscarFoto("+data.persona[x]['cod_foto']+","+data.persona[x]['cod_persona']+");'>";
				else if($("#tipoPersona").val()=="ambos")
					cadena+="<tr class='pointer' onclick='verPersona("+data.persona[x]['cod_persona']+"); buscarFoto("+data.persona[x]['cod_foto']+","+data.persona[x]['cod_persona']+");' >";
			}
			cadena+="<td>"+data.persona[x]['cod_persona']+"</td>";
			cadena+="<td>"+data.persona[x]['cedula']+"</td>";
			cadena+="<td>"+data.persona[x]['nombre1']+" "+apellido+"</td>";
			cadena+="<td>"+data.persona[x]['apellido1']+" "+nombre+"</td>";
			if(data.persona[x]['cor_personal'])
				cadena+="<td>"+data.persona[x]['cor_personal']+"</td>";
			else
				cadena+="<td> - </td>";

			cadena+="</tr>";
		}
	}
	else
		cadena+="<tr><td align='center' colspan='5'>"+data.mensaje+"</td></tr>";
	cadena+="</tbody>";

	$("#listarPersona").remove();
	$(cadena).appendTo('#primeraTabla');
}


function preGuardarPersona(){
	var bool=true;
	
	if(!validarSoloNumeros('#ced_persona',6,8,true)){
		mostrarMensaje("Debes introducir una cedula",2);
		bool=false;
	}
	else if(!fotoExtencion(true) && $("#foto").val()){
		var  extensiones_permitidas = new Array(".png", ".jpg",".gif","jpeg"); 
	    error = "Comprueba la extension de los archivos a subir. \n Solo se pueden subir archivos con extensiones: " + extensiones_permitidas.join(); 
	    mostrarMensaje(error,2);
		bool=false;
	}
	else if(!fotoTamaño(true) && $("#foto").val()){
		 mostrarMensaje(error,2);
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

	var a="archivo";
	var b="";
	jQuery.each(jQuery('#foto')[0].files, function(i, file) {
	   a='archivo';
	   b=file;
	});
	//alert(JSON.stringify(b));
	var arr= Array( "m_modulo"	,	"persona",
					"m_accion"	,	"agregar",
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

	setTimeout(function(){ ajaxMVC(arr,succAgregarPersona,error); }, 300);
}

/**
* Funcion Java Script que permite listar a una persona en el HTML para
* que lugo se modifique su informacionde la base de datos. Los Datos son enviados
* por ajax.
*/
function modificarPersona(codigo){
	var Fbtn="";
	//alert($("#bTodos1").css("background-color"));rgb(79, 216, 176);
	if($("#bTodos3").css("background-color")=="rgb(32, 148, 114)")
		Fbtn="todos";
	else if($("#bTodos2").css("background-color")=="rgb(32, 148, 114)")
		Fbtn="estudiantes";
	else
		Fbtn="profesores";

	if(getVarsUrl().persona)
		codigo=getVarsUrl().persona;
	else if(!codigo)
		codigo=$('#cod_persona').val();
	if(!codigo || codigo=='null')
		mostrarMensaje("Debes seleccionar a una persona.",2);



	else if($("#campo").val()!=undefined){
		window.location.href = 'index.php?m_modulo=persona&m_vista=Principal&m_accion=listar&m_formato=html5&persona='+codigo+'&accion=M&FInstituto='+$("#selectInstituto").val()+'&FPensum='+$("#selectPNF").val()+'&FEstado='+$("#selectEstado").val()+'&FCampo='+$("#campo").val()+'&Fbtn='+Fbtn;
	}
	else
		window.location.href = 'index.php?m_modulo=persona&m_vista=Principal&m_accion=listar&m_formato=html5&persona='+codigo+'&accion=M&FInstituto='+getVarsUrl().FInstituto+'&FPensum='+getVarsUrl().FPensum+'&FEstado='+getVarsUrl().FEstado+'&FCampo='+getVarsUrl().FCampo+'&Fbtn='+getVarsUrl().Fbtn;


}

function mostrarPersona(){

	var codigo=null;
	var Fbtn="";
	//alert($("#bTodos1").css("background-color"));rgb(79, 216, 176);
	if($("#bTodos3").css("background-color")=="rgb(32, 148, 114)")
		Fbtn="todos";
	else if($("#bTodos2").css("background-color")=="rgb(32, 148, 114)")
		Fbtn="estudiantes";
	else
		Fbtn="profesores";

	if(getVarsUrl().persona)
		codigo=getVarsUrl().persona;
	else
		codigo=$('#cod_persona').val();

	if(!codigo || codigo=='null')	
		mostrarMensaje("Debes seleccionar a una persona.",2);
	else
		window.location.href = 'index.php?m_modulo=persona&m_vista=Principal&m_formato=html5&persona='+codigo+'&accion=V&FInstituto='+$("#selectInstituto").val()+'&FPensum='+$("#selectPNF").val()+'&FEstado='+$("#selectEstado").val()+'&FCampo='+$("#campo").val()+'&Fbtn='+Fbtn;
}

function volverPersona(){
	window.location.href = 'index.php?m_modulo=persona&m_vista=Listar&m_formato=html5&FInstituto='+getVarsUrl().FInstituto+'&FPensum='+getVarsUrl().FPensum+'&FEstado='+getVarsUrl().FEstado+'&FCampo='+getVarsUrl().FCampo+'&Fbtn='+getVarsUrl().Fbtn;

}

function bloquearCampos(){			
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
		$("#crearUsuario").remove();
	}
	else if(getVarsUrl().accion=='N'){
		$("#borrar_persona").remove();
		$("#md_persona").remove();
		$("#crearUsuario").remove();
	}
	else {
		$("#crearUsuario").remove();
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
		$("#nuevo_persona").remove();
	}

	var accion =getVarsUrl().accion;
	if(getVarsUrl().persona!="-1" && getVarsUrl().persona && (accion=="V" || accion=="M" || accion=="V"))
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

function succMontarModificarPersona(data){
	
	tabsActivos(); 

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
	$('#fec_nac').val(data.persona[0]['fec_nacimientos']);
	$('#cod_persona').val(data.persona[0]['codigo']);
	$('#codigoPersona').val(data.persona[0]['codigo']);
	$('.selectpicker').selectpicker('refresh');

	if(data.foto){
		$("#imagen").remove();
		$("#imagenEm").remove();
		$("#imagenEs").remove();
		var cadena ="";
		cadena+="<div id='imagen'>";
		cadena+="<img src="+data.foto+" >";
		cadena+="</div>";
		
		$("#superImagen").append(cadena);
		$("#superImagenEm").append(cadena);
		$("#superImagenEs").append(cadena);
		borrarFoto(data.foto);
	 
	}


	if(data.empleado)
		setTimeout(function(){ succMontarModificarEmpleado(data); }, 400);

	 if(data.estudiante)
		setTimeout(function(){ succMontarModificarEstudiante(data); }, 400);
	
}

function borrarFoto(ruta){
	arr = Array("m_modulo","foto",
				"m_accion","borrar",
				"ruta"	,	ruta);
	ajaxMVC(arr,null,error);
}

function limpiarCamposPersona(){

	$("#ced_persona").val('');
	$("#rif_persona").val('');
	$("#nombre1").val('');
	$("#nombre2").val('');
	$("#apellido1").val('');
	$("#apellido2").val('');
	$("#telefono1").val('');
	$("#telefono2").val('');
	$("#cor_personal").val('');
	$("#cor_institucional").val('');
	$("#discapacidad").val('');
	$("#direccion").val('');
	$("#obs_persona").val('');
	$('#sexo').val('M');
	$('#tip_sangre').val('A+');
	$('#hijo').val('0');
	$('#est_civil').val('S');
	$('#nacionalidad').val('V');
	$('#fec_nac').val('');
	$('#cod_persona').val('');
	$('#codigoPersona').val('');
	
}

function bloquearCamposPersona(){

	$("#ced_persona").prop('disabled',true);
	$("#rif_persona").prop('disabled',true);
	$("#nombre1").prop('disabled',true);
	$("#nombre2").prop('disabled',true);
	$("#apellido1").prop('disabled',true);
	$("#apellido2").prop('disabled',true);
	$("#telefono1").prop('disabled',true);
	$("#telefono2").prop('disabled',true);
	$("#cor_personal").prop('disabled',true);
	$("#cor_institucional").prop('disabled',true);
	$("#discapacidad").prop('disabled',true);
	$("#direccion").prop('disabled',true);
	$("#obs_persona").prop('disabled',true);
	$('#sexo').prop('disabled',true);
	$('#tip_sangre').prop('disabled',true);
	$('#hijo').prop('disabled',true);
	$('#est_civil').prop('disabled',true);
	$('#nacionalidad').prop('disabled',true);
	$('#fec_nac').prop('disabled',true);
	$('#cod_persona').prop('disabled',true);
	$('#codigoPersona').prop('disabled',true);

}

function buscarFoto(codigo,codPersona){

	var arr = Array("m_modulo"	,	"foto",
					"m_accion"	,	"buscarFoto",
					"codigo"	,  	codigo,
					"codPersona",	codPersona								
					);
		
	ajaxMVC(arr,succBuscarFoto,error);

}

function succBuscarFoto(data){
	if(data){
		
		if(data.foto){
			
			$("#imagen").remove();
			var cadena ="";		
			cadena+="<div id='imagen'>";
			cadena+="<img src="+data.foto+" width='300' height='300'>";
			cadena+="</div>";
			
			$("#superImagen").append(cadena);		
			borrarFoto(data.foto);
		}
		else{
			var cadena ="";
			$("#imagen").remove();		
			cadena+="<div id='imagen' class='text-center'>";
			cadena+="<img src='modulos/persona/vista/html5/imagen/foto.png' width='300' height='300'>";
			cadena+="</div>";
			
			$("#superImagen").append(cadena);	
		}
	}
	else{
		var cadena ="";
		$("#imagen").remove();		
		cadena+="<div id='imagen' class='text-center'>";
		cadena+="<img src='modulos/persona/vista/html5/imagen/foto.png' width='300' height='300'>";
		cadena+="</div>";
		
		$("#superImagen").append(cadena);	
	}

}
/**
* Funcion Java Script que permite borrar a una persona
* de la base de datos. Los Datos son enviados
* por ajax.
*/
function borrarPersona(){ 
	var arr = Array("m_modulo"	,	"persona",
					"m_accion"	,	"eliminar",
					"cod_persona",  $("#cod_persona").val()									
					);
		
	ajaxMVC(arr,succMontarEliminarPersona,errors);

}

function quitarEspacioUrl(str){
	return str.replace(/%20/g," ");
}

function succMontarEliminarPersona (data){

	if(data.estatus>0){
		mostrarMensaje(data.mensaje,1);
		setTimeout(function(){ 			
			window.location.href = 'index.php?m_accion=listar&m_modulo=persona&m_vista=Listar&m_formato=html5&FInstituto='+getVarsUrl().FInstituto+'&FPensum='+getVarsUrl().FPensum+'&FEstado='+getVarsUrl().FEstado+'&FCampo='+getVarsUrl().FCampo+'&Fbtn='+getVarsUrl().Fbtn;
		}, 2000);
	}
	else
		mostrarMensaje(data.mensaje,2);
}

function roles (){

	var arr = Array("m_modulo"	,	"persona",
					"m_accion"	,	"obtenerRol"							
				   );
		
	ajaxMVC(arr,succRoles,errors);
}

function succRoles(data){

	var cadena = "";
	$("#DivSelectRol").remove();
	console.log(data);
	cadena+="<div id='DivSelectRol'>";
	
	cadena += "<select name='selectRol' class='selectpicker' id='rol' title='Roles' data-live-search='true' data-size='auto' data-max-options='12' >"; 
	cadena += "<option value='-1'>Seleccionar</option>";
	if(data.rol){
		for(var x=0; x<data.rol.length;x++)
		{
			cadena += '<option value="'+data.rol[x]["codigo"]+'">'+data.rol[x]["usuario"]+'</option>';
		}
	}
	cadena +="</select></div>";

	$(cadena).appendTo('#selectRol2');
	activarSelect();
}
function  abrirDialogoCrearUsuario(nombreDialogo,titulo,tipoAccion,montarImpu){
	$('.modal').remove();
	$('#'+nombreDialogo).remove();
	
	crearDialogo(nombreDialogo,'<center>'+titulo+'</center>','',500,"preGuardarUsuario()","Crear Usuario",true);
	//crearDialogo("dialogoCrearUsuario","Crear Usuario</center>","",1,"preGuardarUsuario()","Crear Usuario");
	
}
function crearUsuario(){	

	abrirDialogoCrearUsuario("dialogoCrearUsuario","Crear Usuario","preGuardarUsuario()",true);
	roles ();
	cadena= "<div class='col-md-6'> <h4>Nombre de Usuario: </h4> <input id='usuario' type='text' maxlength='40' onkeyup='validarUsuario(\"#usuario\",\"0\",\"40\",\"true\")'> </div> ";	
	cadena+= "<div class='col-md-6'> <h4>Rol:</h4> <div id='selectRol2'> </div> </div>";	
	cadena+= "<div class='col-md-6'> <h4>Clave: </h4> <input id='clave1' type='password' onkeyup='validarRequerdido(\"#clave1\");'> </div> ";	
	cadena+= "<div class='col-md-6'> <h4>Confirmar Clave: </h4> <input id='clave2' type='password' onkeyup='validarRequerdido(\"#clave2\");'> </div> ";	
	cadena+= "<h4></h4>";
	
	$(cadena).appendTo(".modal-body");
}

function preGuardarUsuario(){
	var bool=true;

	if(!$("#dialogoCrearUsuario #usuario").val().trim()){
		bool=false;
		mostrarMensaje("Debes introducir un nombre de usuario",2);
	}
	else if($("#dialogoCrearUsuario #rol").val()=="-1"){
		bool=false;
		mostrarMensaje("Debes seleccionar un rol",2);
	}
	else if(!$("#dialogoCrearUsuario #clave1").val()){
		bool=false;
		mostrarMensaje("Debes ingresar una clave",2);
	}
	else if(!$("#dialogoCrearUsuario #clave2").val()){
		bool=false;
		mostrarMensaje("Debes confirmar la clave",2);
	}
	else if($("#dialogoCrearUsuario #clave1").val() != $("#dialogoCrearUsuario #clave2").val()){
		bool=false;
		mostrarMensaje("Las claves introducidas NO coinciden",2);
	}

	if(bool)
		guardarUsuario();
}

function guardarUsuario(){

	var arr = Array("m_modulo"	,	"persona",
					"m_accion"	,	"agregarUsuario",
					"codPersona",   $("#cod_persona").val(),
					"rol"		,	$("#dialogoCrearUsuario #rol").val(),	
					"clave"		,	$("#dialogoCrearUsuario #clave1").val(),
					"usuSistema",	$("#dialogoCrearUsuario #usuario").val()							
					);		
	ajaxMVC(arr,succGuardarUsuario,errors);
}

function succGuardarUsuario(data){

	if(data.estatus>0)
		mostrarMensaje(data.mensaje,1);
	else
		mostrarMensaje(data.mensaje,2);
}

function succAgregarPersona(data){
	//alert(JSON.stringify(data));
		//alert(JSON.stringify(data));
	if(data.estatus>0)
		mostrarMensaje(data.mensaje, 1);
	else
		mostrarMensaje(data.mensaje, 2);

	$('#cod_persona').val(data.codPersona);
	$('#codigoPersona').val(data.codPersona);

	if(data.codPersona){
		if(per.UsuarioAgregar && per.AdministrarPrivilegios){
			$("#crearUsuario").remove();
			var cad="<button type='button' class='btn btn-warning' type='button' ";
				cad+="id='crearUsuario' onclick='crearUsuario();' data-toggle='modal'";
				cad+=" data-target='#dialogoCrearUsuario'><b>Crear Usuario</b></button>";
			$("#botonera").append(cad);
		}

		tabsActivos(); 
		verEmpleado();
		verEstudiante();				
		$('div.empleado').hide();
		$("#historico").hide();
		$('#fec_ini_estudiante').val(fecActual());
		if(data.foto){
			$("#imagen").remove();
			$("#imagenEm").remove();
			$("#imagenEs").remove();
			var cadena ="";
			cadena+="<div id='imagen'>";
			cadena+="<img src="+data.foto+" >";
			cadena+="</div>";
			
			$("#superImagen").append(cadena);
			$("#superImagenEm").append(cadena);
			$("#superImagenEs").append(cadena);
			//modificarPersona(data.codPersona); 
			setTimeout(function(){	
				borrarFoto(data.foto);
			}, 1000);
		}
		if(data.mensajeFoto)
			mostrarMensaje(data.mensajeFoto,2);	
	}
}

function fichaPersonaPDF(){							

	window.open('index.php?m_modulo=persona&m_vista=fichaPersona&m_accion=modificar&m_formato=pdf&codPersona='+$('#cod_persona').val()).focus();
}


function exportarODS(){

	var modulo="";
	if($("#tipoPersona").val() && $("#tipoPersona").val()=="ambos")
	 	modulo="persona"
	else if($("#tipoPersona").val())
		modulo=$("#tipoPersona").val();
	else
		modulo="persona";

	window.location.assign("index.php?m_modulo="+modulo+"&m_formato=ods&m_vista=ListarPersona&m_accion=listar&pnf="+$("#selectPNF").val()+"&estado="+$("#selectEstado").val()+"&instituto="+$("#selectInstituto").val()+"&campo="+$("#campo").val());
}

function exportarPDF(){

	var modulo="";
	if($("#tipoPersona").val() && $("#tipoPersona").val()=="ambos")
	 	modulo="persona"
	else if($("#tipoPersona").val())
		modulo=$("#tipoPersona").val();
	else
		modulo="persona";

	window.location.assign("index.php?m_modulo="+modulo+"&m_formato=pdf&m_vista=ListarPersona&m_accion=listar&pnf="+$("#selectPNF").val()+"&estado="+$("#selectEstado").val()+"&instituto="+$("#selectInstituto").val()+"&campo="+$("#campo").val());
}

function exportarODT(){

	var modulo="";
	if($("#tipoPersona").val() && $("#tipoPersona").val()=="ambos")
	 	modulo="persona"
	else if($("#tipoPersona").val())
		modulo=$("#tipoPersona").val();
	else
		modulo="persona";

	
	window.location.assign("index.php?m_modulo="+modulo+"&m_formato=odt&m_vista=ListarPersona&m_accion=listar&pnf="+$("#selectPNF").val()+"&estado="+$("#selectEstado").val()+"&instituto="+$("#selectInstituto").val()+"&campo="+$("#campo").val());
}

function tabsBloqueados(){
	
	//$("#tabsBloqueado").hide();
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

function cargaArchivoNuevoIngreso(){
	var a="archivo";
	var b="";
	
	jQuery.each($('#archivo')[0].files, function(i, file) {
	   a='archivo';
	   b=file;

	});
	//alert(JSON.stringify($('#archivo')[0].files));
	var arr = Array("m_modulo"	,	"persona",
					"m_accion"	,	"cargaArchivoNuevoIngreso",					
					"instituto"	,	$("#selectInstituto").val(),
					"pnf"		,	$("#selectPNF").val(),
					a 			,	b
					);	

	ajaxMVC(arr,succCargaArchivoNuevoIngreso,errors);

}

function succCargaArchivoNuevoIngreso(data){
	
	//alert(data.contadorExiste);
	if(data.contadorExiste>1){
		$("#tablaNo").remove();
		var cadena=""
		cadena+="<div id='tablaNo'> <b> <font color='red'>ESTAS PERSONAS DEBE SER REGISTRADAS MANUALMENTE ";
		cadena+="EN EL MODULO DE ESTUDIANTES PORQUE YA SE ENCUENTRAN REGISTRAS EN EL SISTEMA </font></b>";
		cadena+="<table border='1'>";	
		var datos=data.personasYaRegistradas;
		var datosSplit="";
		for(var x=0;x<datos.length;x++){
			cadena+="<tr>";
			datosSplit=datos[x].split(";");
			
			for(var y=0;y<datosSplit.length;y++){				
				cadena+="<td>"+datosSplit[y]+"</td>";
			}
			cadena+="</tr>";
		}				
		cadena+="</table>";
		cadena+="</div>";
		$(cadena).appendTo('#contenedorTabla');
	}
	
	if(data.contadorNoExite>1){
		$("#tabla").remove();
		var cadena=""
		cadena+="<div id='tabla'> <b> <font color='green'>SE VAN A REGISTRAR LAS SIGUIENTES PERSONAS </font></b>";
		cadena+="<table border='1'>";	
		var datos=data.personasAgregadas;
		var datosSplit="";
		for(var x=0;x<datos.length;x++){
			cadena+="<tr>";
			datosSplit=datos[x].split(";");
			
			for(var y=0;y<datosSplit.length;y++){				
				cadena+="<td>"+datosSplit[y]+"</td>";
			}
			cadena+="</tr>";
		}				
		cadena+="</table>";
		cadena+="</div>";
		$(cadena).appendTo('#contenedorTabla');
	}

	if(data.contadorNoExite>1 || data.contadorExiste>1){
		$("#ruta").val(data.ruta);
		$("#btnCarga").hide();
		if(data.contadorNoExite>1)
			$("#btnRegistrar").show();
		else
			mostrarMensaje("no hay estudiantes nuevos para cargaArchivoNuevoIngreso.",2);
		$("#limpiarFormulario").show();
		if(data.contadorExiste>1){
			$("#noInscritos").show();
			if(confirm("Te recomendamos que descargues el listados de los estudiantes que deben ser registrados manualmente. \n ¿deseas descargar el listado?")){
				pdfEstudiantesNuevoIngresoNoInscrito();
			}
		}
		else
			$("#noInscritos").hide();
	}
	else{
		mostrarMensaje("Este archivo no contiene los estudiantes para cargar",2);
	}
	
	//alert(JSON.stringify(data));
}

function registrarCargaArchivoNuevoIngreso(){
	var arr = Array("m_modulo"	,	"persona",
					"m_accion"	,	"cargaArchivoNuevoIngreso",
					"formato"	,	"html5",				
					"instituto"	,	$("#selectInstituto").val(),
					"pnf"		,	$("#selectPNF").val(),
					"ruta" 		,	$("#ruta").val()
					);	

	ajaxMVC(arr,succRegistrarCargaArchivoNuevoIngreso,errors);
}

function succRegistrarCargaArchivoNuevoIngreso(data){

	if(data.estatus>0)
		mostrarMensaje(data.mensaje,1);
	else
		mostrarMensaje(data.mensaje,2);

	$("#ruta").val("");
}

function selectInstituto(){
	var arr = Array("m_modulo"	,	"instituto",
					"m_accion"	,	"listar"
					);
		
	ajaxMVC(arr,succSelectInstituto,error);
}

function succSelectInstituto(data){

	var cadena = "";
	$("#selectIns").remove();
	cadena+="<div id='selectIns'> Instituto ";
	
	
	cadena += "<select onchange='selectPNF();' class='selectpicker' id='selectInstituto' title='institutos' data-live-search='true' data-size='auto' data-max-options='12' >"; 
	cadena += "<option value='-1' >Seleccionar</option>";
	if(data.institutos){
		for(var x=0; x<data.institutos.length;x++)
		{
			if(data.datos){
				if((data.datos[0].emp_inst != data.institutos[x]["codigo"] || !data.datos[0].emp_inst ) && (data.datos[0].est_inst != data.institutos[x]["codigo"] || !data.datos[0].est_inst ) )
					cadena += '<option value="'+data.institutos[x]["codigo"]+'">'+data.institutos[x]["nom_corto"]+'</option>';
				else					
					cadena += '<option selected value="'+data.institutos[x]["codigo"]+'">'+data.institutos[x]["nom_corto"]+'</option>';			
			}
			else
				cadena += '<option value="'+data.institutos[x]["codigo"]+'">'+data.institutos[x]["nom_corto"]+'</option>';
		}
		setTimeout(function(){						
			selectPNF();						
		}, 500);
	}

	cadena +="</select>";

	$(cadena).appendTo('#selectInstitutos');

	activarSelect();
}

function selectPNF(){

	var arr = Array("m_modulo"	,	"pensum",
					"m_accion"	,	"buscarPorInstituto",
					"codigo"	,	$("#selectInstituto").val()				
					);
		
	ajaxMVC(arr,succSelectPNF,error);

}

function succSelectPNF(data){

	console.log(data);
	var cadena = "";

	$("#selectPensuma").remove();
	cadena+="<div id='selectPensuma'> Pensum ";
	
	
	cadena += "<select  class='selectpicker' id='selectPNF' title='pensum' data-live-search='true' data-size='auto' data-max-options='12' >"; 
	cadena += "<option value='-1'>Seleccionar</option>";
	
	if(data.pensum){
		for(var x=0; x<data.pensum.length;x++)
		{	
			if(data.datos){
				if(data.datos[0].emp_pensum != data.pensum[x]["codigo"] )
					cadena += '<option value="'+data.pensum[x]["codigo"]+'">'+data.pensum[x][2]+'</option>';
				else
					cadena += '<option selected value="'+data.pensum[x]["codigo"]+'">'+data.pensum[x][2]+'</option>';
			}
			else 
				cadena += '<option value="'+data.pensum[x]["codigo"]+'">'+data.pensum[x][2]+'</option>';
		}
	}
	
	cadena +="</select></div>";

	$(cadena).appendTo('#selectPensum');

	activarSelect();
}

function  validarCargaArchivo(){
	var bool=true;
	msj="";
	if($("#selectInstituto").val()<0){
		bool=false;
		msj="Debe seleccionar un instituto.";
	}
	else if($("#selectPNF").val()<0){
		bool=false;
		msj="Debe seleccionar un PNF.";
	}
	else if(!$("#archivo").val()){
		bool=false;
		msj="Debes cargar un archivo.";
	}
	/*else if(archivoExtencion ('true')){
		bool=false;
	}
	else if(archivoTamaño('true')){
		bool=false;
	}*/
	
	if(bool && !$("#ruta").val())
		cargaArchivoNuevoIngreso();
	else if(bool && $("#ruta").val()){
		registrarCargaArchivoNuevoIngreso();
	}
	else if(msj)
		mostrarMensaje(msj,2);

}



function archivoExtencion (mensaje){ 
	
	var  extensiones_permitidas = new Array(".odt", ".txt",".csv",".xls",".doc",".ods",".docx"); 
	var  error = ""; 
	var  archivo=$("#archivo").val();
	
	if (archivo) 	  
   { 
	    //recupero la extensión de este nombre de archivo 
	    var  extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase(); 
	     
	    //compruebo si la extensión está entre las permitidas 
	    var  permitida = false; 
	    for (var i = 0; i < extensiones_permitidas.length; i++) 
	    { 
	       if (extensiones_permitidas[i] == extension) 
	       { 
		       permitida = true; 		        
		       break; 
	        } 
	    } 	      
	} 
	

	if (!permitida){

		if(mensaje){
			error = "Comprueba la extension del archivo a subir. \n Solo se pueden cargar archivos con extensiones: " + extensiones_permitidas.join(); 
			mostrarMensaje(error,2);
		}
		$("#archivo").val("");
		var cadena ="";		
		return false;
	}
	else 
		return true;

}

function archivoTamaño(mensaje){
	input = document.getElementById('archivo');
	if($("#archivo").val()){
		if((input.files[0].size/1024/1024)>1){
			if(mensaje)
				mostrarMensaje("el archivo NO puede pesar mas de 1 MB ",2);

			$("#archivo").val("");
			return false;
		}
		else
			return true;
	}
}

function archivo(){

	$("#archivo").on("change", function(){
	    fotoExtencion(true);
	    fotoTamaño(true);		
	});
}

function limpiarFormularioCargaArchivo(borrarTodo){

	$("#ruta").val("");
	$("#btnCarga").show();
	$("#btnRegistrar").hide();
	$("#limpiarFormulario").hide();
	$("#noInscritos").hide();
	$("#tablaNo").remove();
	$("#tabla").remove();
	if(!borrarTodo){
		$("#selectInstituto").val("-1");
		$("#selectPNF").val("-1");
		$("#archivo").val("");
		$('.selectpicker').selectpicker('refresh');
	}

}

function pdfEstudiantesNuevoIngresoNoInscrito(){

	window.open("index.php?m_modulo=persona&m_formato=pdf&m_vista=nuevoIngresoNoInscrito&m_accion=cargaArchivoNuevoIngreso&ruta="+$("#ruta").val());

}

/**
* Funcion Java Script que permite mostrar un mensaje de error.
*/
function errors(data){	
	console.log(data);
	alert(JSON.stringify(data));
	mostrarMensaje("Error de comunicación con el servidor.",2);
}