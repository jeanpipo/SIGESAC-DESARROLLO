
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

	verEmpleado();
	//pnf2=null;
} );

function antesPreGuardarEmpleado(){
	var bool=true;

	if($("#empleado #selectInstituto").val()=="seleccionar"){
		mostrarMensaje("debe de seleccionar un Instituto",2);
		bool=false;
	}
	else if(!validarFecha("#fec_ini_empleado",true)){
		mostrarMensaje("debe de seleccionar la fecha de inicio",2);
		bool=false;
	}	
	else if($("#eempleado #selectPNF").val() =="seleccionar"){
		mostrarMensaje("debe de seleccionar un Pensum",2);
		bool=false;
	}	
	else if($("#empleado #selectEstado").val()=="seleccionar"){
		mostrarMensaje("debe de seleccionar un estado",2);
		bool=false;
	}
	else if(!validarFecha('#fec_ini_empleado',true)){
		mostrarMensaje("debe de introducir una fecha valida valida",2);
		bool=false;
	}
	else if(!validarFecha('#fec_fin_empleado',false)){
		mostrarMensaje("debe de introducir una fecha fin valida",2);
		bool=false;
	}
	else if(!$('#es_ministerio').prop('checked') 
			&& !$('#es_jef_pensum').prop('checked')
			&& !$('#es_jef_con_estudio').prop('checked')
			&& !$('#Docente').prop('checked')){
		mostrarMensaje("debe de seleccionar un cargo",2);
		bool=false;
	}

	if(bool)
		preGuardarEmpleado();
}

function verEmpleado (codi,codpersona){

	if(!$("#cod_persona").val())
		codpersona=getVarsUrl().persona;

	else if($("#cod_persona").val())
		codpersona=$("#cod_persona").val();




	var arr = Array("m_modulo"	,	"empleado",
					"m_accion"	,	"listar",
					"codPersona",	codpersona,
					"codi"		,	codi
					);
	
	ajaxMVC(arr,montarEmpleado,error);

}

function montarEmpleado(data){
	console.log(data);
	var acu=0;
	cadena="";
	cadena+='<tbody id="listarEmpleado">';
	if(data.empleado!=null){
		for(var x=0; x<data.empleado.length; x++)
		{
			acu=x+1;
			if(data.codi==data.empleado[x]['codigo'])
				cadena+='<tr onclick="modificarEmpleado('+data.empleado[x]['codigo']+'); verEmpleado('+data.empleado[x]['codigo']+'); "  id="'+data.empleado[x]['codigo']+'" style="background-color:#E5EAEE;">';
			else
								cadena+='<tr onclick="modificarEmpleado('+data.empleado[x]['codigo']+'); verEmpleado('+data.empleado[x]['codigo']+'); "  id="'+data.empleado[x]['codigo']+'">';
			cadena+='<a href="#"><td>'+acu+'</td>';
			cadena+='<td>'+data.empleado[x]['codigo']+'</td>';
			cadena+='<td>'+data.empleado[x]['fec_inicios']+'</td>';
			if(data.empleado[x]['fec_fin'])
				cadena+='<td>'+data.empleado[x]['fec_fin']+'</td>';
			else
				cadena+='<td>-</td>';
			cadena+='<td>'+data.empleado[x]['nombre']+'</td>';
			cadena+='<td>'+data.empleado[x]['nom_instituto']+'</td>';
			cadena+='<td>'+data.empleado[x]['nom_pensum']+'</td>';	
			if(data.empleado[x]['es_jef_pensum'])							 
				cadena+='<td tile="Jefe de pensum" >SI</td>';
			else
				cadena+='<td tile="Jefe de pensum" >NO</td>';
			
			if(data.empleado[x]['es_jef_con_estudio'])
				cadena+='<td title="Jefe de Control de Estudio">SI</td>';
			else
				cadena+='<td title="Jefe de Control de Estudio">NO</td>';
			
			if(data.empleado[x]['es_ministerio'])
				cadena+='<td title="Personal del Ministerio">SI</td>';
			else
				cadena+='<td title="Personal del Ministerio">NO</td>';
			
			if(data.empleado[x]['es_docente'])
				cadena+='<td id="Docente" title="Docente">SI</td>';
			else
				cadena+='<td id="Docente" title="Docente">NO</td>';

			if(data.empleado[x]['observaciones']){
				if(data.empleado[x]['observaciones'].length>25){
					var info = data.empleado[x]['observaciones'].slice(0,25)+"...";
					
					cadena+='<td id="Observaciones">'+info+'</td>';
				}
				else
					cadena+='<td id="Observaciones">'+data.empleado[x]['observaciones']+'</td>';
			}
			else
				cadena+='<td> - </td> ';
			cadena+='</a></tr>';
		}
	}
	cadena+="</tbody>";

	$("#listarEmpleado").remove();
	$(cadena).appendTo('#tablaEmpleado');
}
/**
* Funcion Java Script que permite guardar los datos de a un empleado
* para que luego sean almacenados en la base de datos. Los Datos son enviados
* por ajax.
*/


function preGuardarEmpleado(){

	var arr = Array("m_modulo"	,	"empleado",
					"m_accion"	,	"listar",
					"codPersona",	getVarsUrl().persona
					);

	ajaxMVC(arr,compararDatosEmpleados,error);

}

function compararDatosEmpleados(data){

	var bool= true;
	var boolAux=false;
	//var boolCom=false;
	var boolNada=true;
	var boolFecha=true;
	var acu=0;
	var mensaje="";
	var i=0;		

	if(data.empleado){
		for(var x=0; x<data.empleado.length; x++){
			acu=x+1;
			if((data.empleado[x]['cod_instituto'] == $("#empleado #selectInstituto").val()
				&& data.empleado[x]['cod_pensum'] == $("#empleado  #selectPNF").val()
				&& data.empleado[x]['fec_inicios'] == $("#fec_ini_empleado").val() )	
				&& (data.empleado[x]['codigo'] != $("#cod_empleado").val())		
			){		
					mensaje+="Ya esta modificacion se realizo anteriormente. Si desea afectuarla puede";
					mensaje+=" eliminar la informacion que se encuentra en la fila N° "+acu+"."; 		
				mostrarMensaje(mensaje,2);	
				boolNada=false;				
				break;						
			}
			else if( data.empleado[x]['es_jef_con_estudio'] == $('#es_jef_con_estudio').prop('checked')
					&& data.empleado[x]['es_ministerio'] == $('#es_ministerio').prop('checked')
					&& data.empleado[x]['es_jef_pensum'] == $('#es_jef_pensum').prop('checked')
					&& data.empleado[x]['es_docente'] == $('#Docente').prop('checked')
					&& data.empleado[x]['cod_estado'] == $("#empleado  #selectEstado").val()
					&& data.empleado[x]['codigo'] == $("#cod_empleado").val()
					&& data.empleado[x]['fec_inicios'] == $("#fec_ini_empleado").val()
					&& data.empleado[x]['cod_instituto'] == $("#empleado #selectInstituto").val()
					&& data.empleado[x]['cod_pensum'] == $("#empleado  #selectPNF").val()
					&& (data.empleado[x]['fec_final']!= $("#fec_fin_empleado").val()
					||	data.empleado[x]['observaciones']!=$("#obs_empleado").val())){
						bool=true;
						break;
					}			
			else if(/*data.empleado[x]['fec_final']==null						
						&&*/( data.empleado[x]['cod_estado'] != $("#empleado  #selectEstado").val()
						|| data.empleado[x]['es_jef_con_estudio'] != $('#es_jef_con_estudio').prop('checked')
						|| data.empleado[x]['es_ministerio'] != $('#es_ministerio').prop('checked')
						|| data.empleado[x]['es_jef_pensum'] != $('#es_jef_pensum').prop('checked')
						|| data.empleado[x]['es_docente'] != $('#Docente').prop('checked'))
						//|| data.empleado[x]['cod_instituto'] != $("#empleado #selectInstituto").val()
						//|| data.empleado[x]['cod_pensum'] != $("#empleado #selectPNF").val()						
						&& data.empleado[x]['codigo'] == $("#cod_empleado").val()){
				bool=true;				
				boolAux=true; 
				break;	
			}
			else if(data.empleado[x]['cod_instituto'] != $("#empleado #selectInstituto").val()
					|| data.empleado[x]['cod_pensum'] != $("#empleado  #selectPNF").val()
					|| data.empleado[x]['fec_inicios'] != $("#fec_ini_empleado").val() 	
					|| data.empleado[x]['codigo'] == $("#cod_empleado").val()){
					bool=false;
					break;
				}
			else if(data.empleado[x]['fec_inicios'] == $("#fec_ini_empleado").val()){
				mensaje+="Ya esta modificacion se realizo anteriormente. Si desea afectuarla puede";
				mensaje+=" eliminar la informacion que se encuentra en la fila N° "+acu+" o cambie la fecha"; 
				mensaje+=" de inicio.";	
				mostrarMensaje(mensaje,2);	
				boolNada=false;
				break;			
			}
			else 
				bool=false;
		}
		//setTimeout(function(){verEmpleado ();}, 300);
	}
	else
		bool=false;		

	var fecha =$("#fec_ini_empleado").val().split("/");
	if($("#fec_fin_empleado").val()){
		var fechFin=$("#fec_fin_empleado").val().split("/");
		fechFin=new Date (fechFin[2],fechFin[1],fechFin[0]);
		fecha= new Date(fecha[2],fecha[1],fecha[0]);
		if(fechFin<=fecha)
			boolFecha=false;			
	}

	alert(bool+" ** "+boolAux);
	// bool== true se modifica
	// bool== false se agrega
	//boolux== true se agrega y se modifica
	if(boolNada && boolFecha){
		if(boolAux && data.empleado)
			preDobleGuardar(bool,boolAux,data.empleado[i]);
		else if(data.empleado && bool)
			preDobleGuardar(bool,null,data.empleado[i]);
		else
			preDobleGuardar(false);

		setTimeout(function(){
			verEmpleado();
			
		}, 200);
	}

	if(!boolFecha){
		mostrarMensaje("La fecha de inicio no puede ser mayor a la fecha fin.",2);
	}	
}


function preDobleGuardar(bool=null,boolAux=null,data=null){

	if(boolAux && boolAux){
		guardarEmpleadoAux(data);
		guardarEmpleado(bool,data);
	}
	else if(bool)
		guardarEmpleadoAux(data);
	else
		guardarEmpleado(bool);



}

function guardarEmpleadoAux(data){
	
	var fecha='';
	
	if($("#fec_fin_empleado").val())
		fecha=$("#fec_fin_empleado").val();
	else
		fecha=fecActual();


	alert("jpipo"+fecha);

	var arr = Array("m_modulo"	,	"empleado",
					"m_accion"	,	"agregar",	
					"codPersona",  data['cod_persona'],
					"codEstado", data['cod_estado'],
					"codEmpleado",  data['codigo'],
					"codInstituto", data['cod_instituto'],
					"codPensum", data['cod_pensum'],
					"fecInicio", data['fec_inicios'],///'7/2/2015',//fecActual(),
					"fecFin", fecha,///'7/2/2015',//fecActual(),
					"observaciones", $("#obs_empleado").val(),
					"es_jef_con_estudio",data['es_jef_con_estudio'],
					"es_ministerio",	data['es_ministerio'],
					"es_jef_pensum",	data['es_jef_pensum'],
					"Docente",			data['es_docente']
				);

	ajaxMVC(arr,succAgregarEmpleado,error);

}

function guardarEmpleado(bool=null,data=null){
	var fec_ini=$("#fec_ini_empleado").val();
	var fec_fin=null;
	
	if(bool && fec_ini){	
		if($("#fec_fin_empleado").val())
			fec_ini=$("#fec_fin_empleado").val();
		else if(data['fec_inicios']!=fec_ini)
			fec_ini=$("#fec_ini_empleado").val();
		else
			fec_ini=fecActual();		
	}

	if(!bool)
		fec_fin=$("#fec_fin_empleado").val();
	
	alert("yeah"+fec_ini);
	//alert(fec_fin+" "+$("#empleado #selectEstado").val()+" ** "+$("#empleado #selectInstituto").val());
	var arr = Array("m_modulo"	,	"empleado",
					"m_accion"	,	"agregar",	
					"codPersona",  $("#codigoPersona").val(),
					"codEstado", $("#empleado #selectEstado").val(),
					//"codEmpleado",  codigo,
					"codInstituto", $("#empleado #selectInstituto").val(),
					"codPensum", $("#empleado #selectPNF").val(),
					"fecInicio", fec_ini,///'7/2/2015',//fecActual(),
					"fecFin", fec_fin,///'7/2/2015',//fecActual(),
					"observaciones", $("#obs_empleado").val(),
					"es_jef_con_estudio",$('#es_jef_con_estudio').prop('checked'),
					"es_ministerio",	$('#es_ministerio').prop('checked'),
					"es_jef_pensum",	$('#es_jef_pensum').prop('checked'),
					"Docente",			$('#Docente').prop('checked')
				);
	//alert($("#empleado #selectInstituto").val());
	//alert($("#codigoPersona").val()+"<<<"+$("#empleado #selEstadoEm #selectEstado").val()+"<<<"+$("#empleado  #selectInstitutos #selectInstituto").val()+"<<"+$("#empleado  #selPensumEm #selectPNF").val()+"<<"+$("#obs_empleado").val()+"<<<");
	alert($("#empleado #selectPNF").val());
	ajaxMVC(arr,succAgregarEmpleado,error);
	
}

function succAgregarEmpleado(data){

	if(data.estatus>0){
		if(data.codEmpleado)
			$("#cod_empleado").val(data.codEmpleado);
		alert(data.codEmpleado);
		mostrarMensaje(data.mensaje,1);
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
function verInstitutoEm(){

	var arr = Array("m_modulo"	,	"empleado",
					"m_accion"	,	"listar",
					"estado"	,	$("#selectEstado").val(),
					"pnf"		,	$("#selectPNF").val(),
					"instituto"	,	$("#selectInstituto").val(),
					"tipo_persona",	"empleado",
					"campo",		$("#campo").val()
					);

	ajaxMVC(arr,montarSelectInstitutoPersona,error);
}

function verInstitutoEm2(){
	
	/*if(!instituto){
		instituto ='';
		estado='';
		pnf='';
		setTimeout(function(){ 

			if($("#empleado #selectInstituto").val()!=null)
				instituto=$("#empleado #selectInstituto").val();
			else
				instituto=$("#selectInstituto").val();	

			if($("#empleado #selectEstado").val()!=null)
				estado=$("#empleado #selectEstado").val();
			else
				estado=$("#selectEstado").val();

			if($("#empleado #selectEstado").val()!=null)
				pnf=$("#empleado #selectPNF").val();
			else
				pnf=$("#selectPNF").val();

		}, 500);
	}
	//alert(instituto+"***");
	//setTimeout(function(){ 
*/
		var arr = Array("m_modulo"	,	"persona",
						"m_accion"	,	"listarSelects",
						"estado"	,	$("#empleado #selectEstado").val(),
						"pnf"		,	$("#empleado #selectPNF").val(),
						"instituto"	,	$("#empleado #selectInstituto").val(),
						"tipo_persona",	"empleado",
						//"campo",		$("#campo").val(),
						"empleado2"	,	true
						);
		ajaxMVC(arr,montarSelectInstitutoE,error);
	

	//}, 700);
	
}




/**
* Funcion Java Script que permite mostrar un select con
* los institutos y es concatenado a un  div en la vista HTML
*/
function montarSelectInstitutoE(data){

	var cadena = "";
		$("#empleado #selectInsEm").remove();
		cadena+="<div id='selectInsEm'> institutos ";
		cadena += "<select onchange='verPNFEm2();' class='selectpicker' id='selectInstituto' title='institutos' data-live-search='true' data-size='auto' data-max-options='12' >"; 
		cadena += "<option value='seleccionar' >Seleccionar</option>";
	for(var x=0; x<data.instituto.length;x++)
	{
		cadena += '<option value="'+data.instituto[x]["codigo"]+'">'+data.instituto[x]["nom_corto"]+'</option>';
	}
	cadena+="</select></div>";

	$(cadena).appendTo('.selectInstitutoEm');
	activarSelect();					
}


/**
* Funcion Java Script que permite listar Todos los PNF
* para que luego sea mostado en un select. los datos son enviados
* por ajax para que se haga la consulta a la base de datos y mostrar 
* los resultados en la funcion montarSelectPNF().
*/
function verPNFEm(){

	var arr = Array("m_modulo"	,	"empleado",
					"m_accion"	,	"listar",
					"estado"	,	$("#selectEstado").val(),
					"pnf"		,	$("#selectPNF").val(),
					"instituto"	,	$("#selectInstituto").val(),
					"tipo_persona",	"empleado",
					"campo",		$("#campo").val()											
					);
												
				
	ajaxMVC(arr,montarSelectPNFPersona,error);
}

function verPNFEm2(){

/*	instituto ='';
	estado='';
	pnf='';
	setTimeout(function(){ 

		if($("#empleado #selectInstituto").val()!=null)
			instituto=$("#empleado #selectInstituto").val();
		else
			instituto=$("#selectInstituto").val();	

		if($("#empleado #selectEstado").val()!=null)
			estado=$("#empleado #selectEstado").val();
		else
			estado=$("#selectEstado").val();

		if($("#empleado #selectPNF").val())
			pnf=$("#empleado #selectPNF").val();
		else
			pnf=$("#selectPNF").val();

	}, 500);*/

	//setTimeout(function(){ 
	
		var arr = Array("m_modulo"	,	"persona",
					"m_accion"	,	"listarSelects",
					"estado"	,	$("#empleado #selectEstado").val(),
					"pnf"		,	$("#empleado #selectPNF").val(),
					"instituto"	,	$("#empleado #selectInstituto").val(),
					"tipo_persona",	"empleado",
					//"campo",		$("#campo").val(),
					"empleado2"	,	true
					);
		ajaxMVC(arr,montarSelectPNFE,error);
	/*}, 600);*/
		
	
}




/**
* Funcion Java Script que permite mostrar un select con
* los PNF y es concatenado a un  div en la vista HTML
*/
function montarSelectPNFE(data){

	var cadena = "";
	$("#empleado #selectPensumaEm").remove();
	cadena+="<div id='selectPensumaEm'> Pensum ";
	cadena += "<select class='selectpicker' id='selectPNF' title='pensum' data-live-search='true' data-size='auto' data-max-options='12' >"; 
	cadena += "<option value='seleccionar'>Seleccionar</option>";
	if(data.pnf){
		for(var x=0; x<data.pnf.length;x++)
		{
			cadena += '<option value="'+data.pnf[x]["cod_pensum"]+'">'+data.pnf[x][2]+'</option>';
		}
	}
	cadena +="</select></div>";
	//alert(cadena);
	$(cadena).appendTo('.selectPensumEm');
	activarSelect();					
}

/**
* Funcion Java Script que permite listar Todos los estados que posee un actor
* para que luego sea mostado en un select. los datos son enviados
* por ajax para que se haga la consulta a la base de datos y mostrar 
* los resultados en la funcion mmontarSelectEstado().
*/
function verEstadoEm(){
	
	var arr = Array("m_modulo"	,	"empleado",
					"m_accion"	,	"listar",
					"estado"	,	$("#selectEstado").val(),
					"pnf"		,	$("#selectPNF").val(),
					"instituto"	,	$("#selectInstituto").val(),
					"tipo_persona",	"empleado",
					"campo",		$("#campo").val()	
					);		
	ajaxMVC(arr,montarSelectEstadoPersona,error);
}

function verEstadoEm2(){
	/*instituto ='';
	estado='';
	pnf='';*/
	//setTimeout(function(){ 

	/*	if($("#empleado #selectInstituto").val()!=null)
			instituto=$("#empleado #selectInstituto").val();
		else
			instituto=$("#selectInstituto").val();	

		if($("#empleado #selectEstado").val()!=null)
			estado=$("#empleado #selectEstado").val();
		else
			estado=$("#selectEstado").val();

		if($("#empleado #selectEstado").val()!=null)
			pnf=$("#empleado #selectPNF").val();
		else
			pnf=$("#selectPNF").val();*/

	/*}, 500);

	setTimeout(function(){ */

		var arr = Array("m_modulo"	,"persona",
					"m_accion"	,	"listarSelects",
					"estado"	,	$("#empleado #selectEstado").val(),
					"pnf"		,	$("#empleado #selectPNF").val(),
					"instituto"	,	$("#empleado #selectInstituto").val(),
					"tipo_persona",	"empleado",
					///*"campo",		$("#campo").val(),
					"empleado2"	,	true
					);	
		
		ajaxMVC(arr,montarSelectEstadoEm,error);
	//}, 500);
	
}/*
function segundo (){
	setTimeout(function(){ 
		mostrarInformaion2(); 		
	}, 500);

	setTimeout(function(){ 
	//alert($("#empleado #selectInstituto").val());
	
		var arr = Array("m_modulo"	,	"empleado",
						"m_accion"	,	"listar",
						"estado"	,	$("#empleado #selectEstado").val(),
						"pnf"		,	$("#empleado #selectPNF").val(),
						"instituto"	,	$("#empleado #selectInstituto").val(),
						"tipo_persona",	"empleado",
						"campo",		$("#campo").val(),
						"empleado2"	,	true
					);	
		ajaxMVC(arr,montarSelectPNF,error);
		
	}, 1100);
	setTimeout(function(){ 
		if(!pnf2)
			pnf2=null;
		$("#empleado #selectPNF").val(pnf2);
		$('#empleado #selectPNF').selectpicker('refresh');
	}, 1150);
}*/
/**
* Funcion Java Script que permite mostrar un select con
* los estados y es concatenado a un  div en la vista HTML
*/
function montarSelectEstadoEm(data){

	var cadena = "";
	$("#empleado #selectEstadosEm").remove();
	cadena+="<div id='selectEstadosEm'> Estado";
	cadena += "<select name='selectEstado' class='selectpicker' id='selectEstado' title='pensum' data-live-search='true' data-size='auto' data-max-options='12' >"; 
	cadena += "<option value='seleccionar'>Seleccionar</option>";
	for(var x=0; x<data.estado.length;x++)
	{		
		cadena += '<option value="'+data.estado[x]["codigo"]+'">'+data.estado[x]["nombre"]+'</option>';
	}
	cadena +="</select></div>";

	$(cadena).appendTo('.selectEstadoEm');
	activarSelect();					
}


/** 
* Funcion Java Script que permite listar Todas las personas de tipo empleado
* para que luego sean mostradas. los datos son enviados
* por ajax para que se haga la consulta a la base de datos y mostrar 
* los resultados en la funcion montarPersona().
*//*
function verPersonaEmpleado(){

	var arr = Array("m_modulo"	,	"persona",
					"m_accion"	,	"listar",
					"tipo_persona", $("tipo_persona").val()				
					);		
	ajaxMVC(arr,montarPersonaEmpleado,error);
}*


/**
* Funcion Java Script que permite listar Todos los estudiantes
* para que luego sean mostradas. los datos son enviados
* por ajax para que se haga la consulta a la base de datos y mostrar 
* los resultados en la funcion montarPersona().
*/
function montarPersonaEmpleado(){

	cadena="";
	cadena+='<tbody id="listarPersonaEmpleado">';
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
	cadena+"</tbody>";

	$("#listarPersona").remove();
	$(cadena).appendTo('#primeraTabla');
}

/**
* Funcion Java Script que permite listar a un empleado en el HTML para
* que lugo se modifique su informacionde la base de datos. Los Datos son enviados
* por ajax.
*/

function modificarEmpleado(cod_empleado=null,cod_persona=null){
	
	if(!cod_persona && $("#cod_persona").val())
		cod_persona=$("#cod_persona").val();

	if(!cod_empleado && $("#cod_empleado").val())
		cod_empleado=$("#cod_empleado").val();


	var arr = Array("m_modulo"	,	"empleado",
					"m_accion"	,	"listar",
					"codPersona",   cod_persona,
					"codEmpleado",  cod_empleado									
					);
		
	ajaxMVC(arr,succMontarModificarEmpleado,error);

}

/**
 * esta funcion JavaScript permite signar los datos obtenido en la
 * consuta  la base de datos y colocarlos en la vista HTML
 * de esta manera el usuario podra modificar los datos de la empleado
 */
function succMontarModificarEmpleado (data){
//alert(data.empleado[0]['cod_estado']);
	//se inicializa la variable global.

	verInstitutoEm2(); verEstadoEm2(); 
	//pnf2=data.empleado[0]['cod_pensum'];
	console.log(data.empleado);
	$("#cod_empleado").val(data.empleado[0]['codigo']);
	$("#cod_persona").val(data.empleado[0]['cod_persona']);
	setTimeout(function(){
		$("#empleado #selectEstado").val(data.empleado[0]['cod_estado']);
	//	$("#empleado #selectEstado").selectpicker('refresh');
		$("#empleado #selectInstituto").val(data.empleado[0]['cod_instituto']);	
	//$('#empleado #selectInstituto').selectpicker('refresh');
	verPNFEm2();
	}, 250);
//$('#empleado #selectInstituto').selectpicker('refresh');
	verPNFEm2();
	setTimeout(function(){ 
		$("#empleado #selectPNF").val(data.empleado[0]['cod_pensum']);
		$('.selectpicker').selectpicker('refresh');  
	}, 600);
	$("#fec_ini_empleado").val(data.empleado[0]['fec_inicios']);
	if(data.empleado[0]['fec_final'])
		$("#fec_fin_empleado").val(data.empleado[0]['fec_final']);
	else 
		$("#fec_fin_empleado").val(fecActual());
	$("#obs_empleado").val(data.empleado[0]['observaciones']);	
	$("#es_ministerio").prop( "checked",data.empleado[0]['es_ministerio']);
	$("#es_jef_pensum").prop( "checked",data.empleado[0]['es_jef_pensum']);
	$("#es_jef_con_estudio").prop( "checked",data.empleado[0]['es_jef_con_estudio']);
	$("#Docente").prop( "checked",data.empleado[0]['es_docente']);
}

function NuevoEmpleado (){
//alert(data.empleado[0]['cod_estado']);

	$("#cod_empleado").val("");
	//$("#cod_persona").val("");
	$("#empleado #selectPNF").val("seleccionar");
	$('#empleado #selectPNF').selectpicker('refresh');
	$("#empleado #selectEstado").val("seleccionar");
	$("#empleado #selectEstado").selectpicker('refresh');
	$("#empleado #selectInstituto").val("seleccionar");	
	$('#empleado #selectInstituto').selectpicker('refresh');
	$("#fec_ini_empleado").val(fecActual());
	$("#fec_fin_empleado").val("");
	$("#obs_empleado").val("");	
	$("#es_ministerio").prop( "checked",false);
	$("#es_jef_pensum").prop( "checked",false);
	$("#es_jef_con_estudio").prop( "checked",false);
	$("#Docente").prop( "checked",false);
	//alert(data.empleado[0]['cod_estado']);
}

/**
* Funcion Java Script que permite borrar a un  estudiante
* de la base de datos. Los Datos son enviados
* por ajax.
*/
function borrarEmpleado(){

	var arr = Array("m_modulo"	,	"empleado",
					"m_accion"	,	"eliminar",
					"codEmpleado",  $("#cod_empleado").val()									
					);
		
	ajaxMVC(arr,succMontarEliminarEmpleado,error);

}

function succMontarEliminarEmpleado (data){

	if(data.estatus>0){
		mostrarMensaje(data.mensaje,1);
		setTimeout(function(){verEmpleado();}, 300);
		$("#cod_empleado").val('');
	}
	else
		mostrarMensaje(data.mensaje,2);
}


function error(data){	
	console.log(data);
	mostrarMensaje("Error de comunicación con el servidor.",2);
}
