/*
 * * * * * * * * * * LICENCIA * * * * * * * * * * * * * * * * * * * * *

Copyright(C) 2015
Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio

Este programa es Software Libre y usted puede redistribuirlo y/o modificarlo
bajo los términos de la versión 3.0 de la Licencia Pública General (GPLv3)
publicada por la Free Software Foundation (FSF), es distribuido sin ninguna
garantía. Usted debe haber recibido una copia de la GPLv3 junto con este
programa, sino, puede encontrarlo en la página web de la FSF,
específicamente en la dirección http://www.gnu.org/licenses/gpl-3.0.html

 * * * * * * * * * * ARCHIVO * * * * * * * * * * * * * * * * * * * * *

Nombre: Periodo.js
Diseñador: Juan De Sousa
Programador: Juan De Sousa
Lider de proyecto: Johan Alamo (johan.alamo@gmail.com)
Fecha:10-1-16
Descripción:
	Este es el javascript del módulo periodo, encargado de todas las
	llamadas AJAX, objetos DOM y validaciones de dicho módulo.

 * * * * * * * * Cambios/Mejoras/Correcciones/Revisiones * * * * * * * *
Diseñador - Programador /   Fecha   / Descripción del cambio


 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
*/

/*
 * Función general para obtenerPeriodo(s)
 *
 * Hace una llamada ajax al módulo periodo con la acción listarPeriodo.
 *
 * Recibe como parámetros:
 *
 * 		codigo 				código del periodo a listar (puede ser null para listarlos todos)
 * 		funSucc				Función que se realizará en el success del ajax
 * 		funErr				Función que se realizará en el error del ajax
 */

function obtenerPeriodos(codigo, funSucc, funErr){
	var arr = Array(	"modulo"	,	"periodo",
						"accion"	,	"listarPeriodo",
						"codPeriodo",	codigo);

	ajaxMVC(arr, funSucc, funErr);
}

/*
 * Función general para agregar un periodo.
 *
 * Hace una llamada ajax al módulo periodo con la acción agregarPeriodo
 *
 * Recibe como parámetros:
 * 		arr					Arreglo con la información del periodo a agregar
 * 		funSucc				Función que se realizará en el success del ajax
 * 		funErr				FUnción que se realizará en el error del ajax
 */

function agregarPeriodo(arr, funSucc, funErr){
	arr['m_modulo'] = 'periodo';
	arr['m_accion'] = 'agregarPeriodo';

	ajaxMVC(arr, funSucc, funErr);
}

/*
 * Función general para modificar un periodo.
 *
 * Hace una llamada ajax al módulo periodo con la acción modificarPeriodo.
 *
 * Recibe como parámetros:
 * 		arr					Arreglo con la información del periodo a modificar
 * 		funSucc				Función que se realizará en el success del ajax
 * 		funErr				FUnción que se realizará en el error del ajax
 */


function modificarPeriodo(arr, funSucc, funErr){
	arr['m_modulo'] = 'periodo';
	arr['m_accion'] = 'agregarPeriodo';

	ajaxMVC(arr, funSucc, funErr);
}

/*
 * Función general para eliminar un periodo
 *
 * Hace una llamada ajax al módulo curso con la acción eliminarPeriodo.
 *
 * Recibe como parámetros:
 *
 * 		codigo 				código del periodo a eliminar
 * 		funSucc				Función que se realizará en el success del ajax
 * 		funErr				Función que se realizará en el error del ajax
 */

function eliminarPeriodo(codigo, funSucc, funErr){
	var arr = Array(	"modulo"	,	"periodo",
						"accion"	,	"eliminarPeriodo",
						"codPeriodo",	codigo);

	ajaxMVC(arr, funSucc, funErr);
}



/* **************************************************************************************/

cargarPeriodosP();

function succ(data){
	alert("succ");
	console.log(data);
}

function err(data){
	mostrarMensaje("Error de comunicación con el servidor. Es posible que su petición no se haya procesado exitosamente.",2);
	console.log(data);
}

function cargarPensums(){

	var arr = Array("m_modulo"		,	"pensum",
					"m_accion"		,	"buscarPorInstituto",
					"codigo" 		, 	$("#dialogoPerAgregar #selInst").val());

	ajaxMVC(arr,succCargarPensums,err);
}

function succCargarPensums(data){
	var pen = data.pensum;
	var cad = "";

	cad += "<select class='selectpicker' id='selPen' data-live-search='true' data-size='auto'>";

	if(pen){
		cad += "<option value='-1' disabled selected> Seleccione Pensum</option>";

		for(var i = 0; i < pen.length; i++){
			cad += "<option value="+pen[i][0]+">"+pen[i][1]+"</option>";
		}

	}
	else{
		mostrarMensaje("No hay pensums para este instituto.",3);
	}
	cad += "</select>";

	$("#dialogoPerAgregar #selPen").selectpicker('destroy');
	$("#dialogoPerAgregar #divPen").append(cad);
	$("#dialogoPerAgregar #selPen").selectpicker();
}

function cargarPeriodosP(){
	var arr = Array("m_modulo"		,		"periodo",
					"m_accion"		,		"listar",
					"patron"		,		$("#patron").val());

	ajaxMVC(arr,succCargarPeriodosP,err);

}

function succCargarPeriodosP(data){
	var dat = data.periodos;
	var cad = "";

	if(dat){
		cad += "<table id='tableP' class='table table-hover table-condensed table-responsive'>";

		cad += "<th class='dark' style='text-align:center'>Opciones</th>";
		cad += "<th class='dark' style='text-align:center'>Instituto (Código)</th>";
		cad += "<th class='dark' style='text-align:center'>Pensum</th>";
		cad += "<th class='dark' style='text-align:center'>Nombre del Periodo</th>";
		cad += "<th class='dark' style='text-align:center'>Fecha de Inicio</th>";
		cad += "<th class='dark' style='text-align:center'>Fecha de Fin</th>";
		cad += "<th class='dark' style='text-align:center'>Estado del Periodo</th>";

		var len = dat.length;

		for(var i = 0; i < len; i++){
			cad += "<tr>";

			cad += "<td style='text-align:center'><button class='btn btn-warning btn-xs' title='Modificar Periodo' onclick='modificarPeriodoD("+dat[i]['codigo']+")'><span class='fa fa-pencil'></span></button>    ";
			cad += "<button class='btn btn-danger btn-xs' title='Eliminar Periodo' onclick='eliminarPeriodo("+dat[i]['codigo']+")'><span class='fa fa-remove'></span></button></td>";

			cad += "<td style='text-align:center'>"+dat[i]['nomi']+" ("+dat[i]['codigo']+")</td>";
			cad += "<td style='text-align:center'>"+dat[i]['nomp']+"</td>";
			cad += "<td style='text-align:center'>"+dat[i]['nombre']+"</td>";
			cad += "<td style='text-align:center'>"+dat[i]['fec_inicio']+"</td>";
			cad += "<td style='text-align:center'>"+dat[i]['fec_final']+"</td>";
			cad += "<td style='text-align:center'>"+dat[i]['nome']+"</td>";

			cad += "</tr>";
		}

		cad += "</table>";

		$("#tableP").remove();
		$("#divP").append(cad);
	}
	else{
		mostrarMensaje("No hay periodos con este criterio de búsqueda",4);
		$("#tableP").remove();
	}
}

function modificarPeriodoD(i){
	var arr = Array("m_modulo"		,		"periodo",
					"m_accion"		,		"obtenerDatosPeriodo",
					"codigo"		,		i);

	ajaxMVC(arr,succModificarPeriodoD,err);
}

function eliminarPeriodo(codigo){
    var arr = Array("m_modulo"      ,       "periodo",
                    "m_accion"      ,       "eliminarPeriodo",
                    "codPeriodo"    ,       codigo);

    if(confirm("¿Está seguro que desea eliminar el periodo?"))
        ajaxMVC(arr,succEliminarPeriodo,err);
}

function succEliminarPeriodo(data){
    mostrarMensaje("Periodo eliminado con éxito.",4);
    cargarPeriodosP();
}

function succModificarPeriodoD(data){
	var dat = data.periodo[0];
	var est = data.estados;
	var cad = "";
	var cad2 = "";

	if(dat){
		var len = est.length;

		cad += "<input type='hidden' id='codIns' value='"+dat['cod_instituto']+"'>";
		cad += "<input type='hidden' id='codPen' value='"+dat['cod_pensum']+"'>";

		cad += "<center>";

		cad += "Código del Periodo: "+dat['codigo'];

		cad += "<br>";
		cad += "<br>";

		cad += ""+dat['nom_instituto'];

		cad += "<br>";
		cad += "<br>";

		cad += ""+dat['nom_pensum'];

		cad += "<br>";
		cad += "<br>";

		cad += "Nombre del Periodo: <input type='text' id='nombreP' value='"+dat['nombre']+"'>";

		cad += "<br>";
		cad += "<br>";

		cad += "<input type='hidden' id='selEst' value='"+dat['cod_estado']+"'>";

		cad += "<div class='radio-inline'>";

		for(var i = 0; i < len; i++){
			cad += "<div class='radio-inline'>";
			if(dat['cod_estado'] == est[i]['codigo']){
				cad += "<input type='radio' onclick='actEst(\""+est[i]['codigo']+"\")' name='radio' checked>";
				cad += "<label>";
				cad += est[i]['nombre'];
				cad += "</label>";
			}
			else{
				cad += "<input type='radio' onclick='actEst(\""+est[i]['codigo']+"\")' name='radio'>";
				cad += "<label>";
				cad += est[i]['nombre'];
				cad += "</label>";
			}
			cad += "<br>";
			cad += "</div>";
		}

		cad += "<br>";
		cad += "<br>";

		cad += "Fecha de Inicio: <input type='text'id='fecIP' value='"+dat['fec_inicio']+"'></input>";

		cad += "<br>";
		cad += "<br>";

		cad += "Fecha de Fin: <input type='text' id='fecFP' value='"+dat['fec_final']+"'></input>";

		cad += "<br>";
		cad += "<br>";

		cad += "Observaciones: <input type='text' class='form-control' size='80' id='obsP' value='"+dat['observaciones']+"'></input>";

		cad += "<br>";
		cad += "<br>";

	}

    if($("#dialogoPer").length > 0){
        $("#dialogoPer").remove();
    }

	crearDialogo("dialogoPer", "Modificar Periodo",dat['nombre'], 1, "modificarPeriodo('"+dat['codigo']+"')",'Aceptar',true);

	$(".modal-body").append(cad);

	$("#dialogoPer").modal("show");
}

function actEst(val){
	$("#dialogoPer #selEst").val(val);
}

function actEstA(val){
	$("#dialogoPerAgregar #selEst").val(val);
}

function modificarPeriodo(cod){

	var arr = Array("m_modulo"		,		"periodo",
					"m_accion"		,		"modificarPeriodo",
					"nomPeriodo"	,		$("#dialogoPer #nombreP").val(),
					"codInstituto"	,		$("#dialogoPer #codIns").val(),
					"codPensum"		,		$("#dialogoPer #codPen").val(),
					"fecInicio"		,		$("#dialogoPer #fecIP").val(),
					"fecFinal"		,		$("#dialogoPer #fecFP").val(),
					"observaciones"	,		$("#dialogoPer #obsP").val(),
					"codEstado"		,		$("#dialogoPer #selEst").val(),
					"codPeriodo"	,		cod);

	ajaxMVC(arr,succModificarPeriodo,err);
}

function succModificarPeriodo(data){
	if(data.mensaje){
		mostrarMensaje(data.mensaje,1);
		cargarPeriodosP();
	}
	else{
		mostrarMensaje("El periodo no pudo ser modificado. Revise si la información que introdujo es la correcta.",3);
	}
}

function agregarPeriodoD(){
	var arr = Array("m_modulo"		,		"periodo",
					"m_accion"		,		"obtenerDatos");

	ajaxMVC(arr,succAgregarPeriodoD,err);
}

function succAgregarPeriodoD(data){
	
	var inst = data.institutos;
	var est = data.estados;

	var cad = "";
	var cad2 = "";
	var len = inst.length;

	for(var i = 0; i < len; i++){
		cad2 += "<option value='"+inst[i]['codigo']+"'>"+inst[i]['nombre']+"</option>";
	}

	cad += "<center>";

	cad += "Código del Periodo: <input type='text' size='4' id='codPeriodo' disabled>";

	cad += "<br>";
	cad += "<br>";

	cad += "Nombre del Periodo: <br><input type='text' id='nombreP' value=''>";

	cad += "<br>";
	cad += "<br>";

	cad += "<div id='divInst'>";

		cad += "<select class='selectpicker' id='selInst' onchange='cargarPensums()' data-live-search='true' data-size='auto'>";

		cad += "<option value='-1' selected disabled> Seleccione un Instituto</option>";

		cad += cad2;

		cad += "</select>";

	cad += "</div>";

	cad += "<br>";

	cad += "<div id='divPen'>";

		cad += "<select class='selectpicker' id='selPen' data-live-search='true' data-size='auto'>";

		cad += "</select>";

	cad += "</div>";

	cad += "<input type='hidden' id='selEst' value=''>";

	cad += "<br>";

	len = est.length;

	cad += "Estado del Periodo:";

	cad += "<br>";

	for(var i = 0; i < len; i++){
		cad += "<input type='radio' onclick='actEstA(\""+est[i]['codigo']+"\")' name='radio'>   ";
		cad += "<label>";
		cad += est[i]['nombre'];
		cad += "</label>   ";
		cad += "<br>";
	}

	cad += "Fecha de Inicio: <br><input type='text'id='fecIP' value=''></input>";

	cad += "<br>";
	cad += "<br>";

	cad += "Fecha de Fin: <br><input type='text' id='fecFP' value=''></input>";

	cad += "<br>";
	cad += "<br>";

	cad += "Observaciones: <br><input type='text' class='form-control' size='80' id='obsP' value=''></input>";

	cad += "<br>";
	cad += "<br>";

	crearDialogo("dialogoPerAgregar", "Agregar Periodo",'Nuevo Periodo', 1, "agregarPeriodo()",'Aceptar',true);

	$(".modal-body").append(cad);

	$("#dialogoPerAgregar").modal("show");
	$(".selectpicker").selectpicker();
}

function agregarPeriodo(){
	var arr = Array("m_modulo"			,		"periodo",
					"m_accion"			,		"agregarPeriodo",
					"nomPeriodo"		,		$("#dialogoPerAgregar #nombreP").val(),
					"codIns"			,		$("#dialogoPerAgregar #selInst").val(),
					"codPen"			,		$("#dialogoPerAgregar #selPen").val(),
					"fecIni"			,		$("#dialogoPerAgregar #fecIP").val(),
					"fecFin"			,		$("#dialogoPerAgregar #fecFP").val(),
					"observaciones"		,		$("#dialogoPerAgregar #obsP").val(),
					"codEst"			,		$("#dialogoPerAgregar #selEst").val());

	ajaxMVC(arr,succAgregarPeriodo,err);
}

function succAgregarPeriodo(data){
	if(data.codPeriodo > 0){
		mostrarMensaje("El periodo se ha agregado exitosamente con el código "+data.codPeriodo+".",1);
		$("#dialogoPerAgregar").modal('hide');
		cargarPeriodosP();
	}
	else{
		mostrarMensaje("El periodo no se pudo agregar.",2);
	}
}
