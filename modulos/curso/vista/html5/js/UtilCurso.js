
var datos = null;

/**
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

Nombre: UtilCurso.js
Diseñador: Juan De Sousa (juanmdsousa@gmail.com)
Programador: Juan De Sousa
Lider de proyecto: Johan Alamo (johan.alamo@gmail.com)
Fecha: Febrero de 2016
Descripción:
	Librería JS del módulo. Encargada de todas las llamadas AJAX y
elementos visuales dinámicos.

 * * * * * * * * Cambios/Mejoras/Correcciones/Revisiones * * * * * * * *
*---                         ----      ---------

 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
*/

function succ(data){
	alert("succ");
	console.log(data);
}

function err(data){
	mostrarMensaje("Ocurrió un error de comunicación con el servidor. Es probable que no se haya procesado la petición.",2);
	console.log(data);
}

/*
 * Función que limpia los campos/selects dependientes.
 *
 * Recibe como parámetro una cadena que indica hasta
 * donde tiene que limpiar.
 * Para limpiar, se remueven los selects (de existir)
 * y se vuelven a crear (sin información)
 *
 * De ser un input que se tiene que limpiar,
 * simplemente se elimina su value.
 */

function limpiarCampos(val){

	/* El return de cada bloque indica hasta dónde se va a limpiar.
	 *
	 * Es decir, el parámetros val con valor "uni" no limpiaría ningún
	 * select/campo. Ya que en todas las vistas es el último select
	 * presente y de él no depende ningún otro.
	 *
	 * Por el contrario, para cualquier otro valor de val, se limpiarán
	 * los selects/campos dependientes de éste.
	 *
	 * El return es utilizado para romper el flujo de la función.
	 */

	if($("#table-lis").length > 0)
 	 	$("#table-lis").remove();

	if($("#tableCD").length > 0)
	 	$("#tableCD").remove();

	if($("#tableCur").length > 0)
	 	$("#tableCur").remove();

	if(val == 'est')
		return;

	if($("#selEstudiante").length > 0){
			$("#selEstudiante").selectpicker('destroy');

			$("#divEstudiante").append("<select class='selectpicker' id='selEstudiante' data-live-search='true' data-size='20'></select>");
			$("#selEstudiante").selectpicker();
	}


	if(val == 'uni')
		return;

	/*
	 * Se elimina el select "selUni" presente en cada vista
	 * donde existe un select que liste las unidades curriculares.
	 * Luego de eliminarse, se vuelve a crear y se agrega a "divUni".
	 * Div presente en cada vista donde se utiliza selUni.
	 */

	if($("#selUni").length > 0){
		$("#selUni").selectpicker('destroy');

		$("#divUni").append("<select class='selectpicker' id='selUni' data-live-search='true' data-size='20'></select>");
		$("#selUni").selectpicker();
	}

	if(val == 'sec')
		return;

	/*
	 * Se verifica si existe "sec", campo text para indicar la sección.
	 * Vista de Agregar/Modificar Curso.
	 *
	 * De ser así, se coloca el value del campo en "".
	 * De no ser así, se eliminar el selSec (select de sección),
	 * se vuelve a crear y se agrega a divSec (presente en cada vista)
	 * donde se encuentra selSec
	 */

	if($("#sec").length > 0){
		$("#sec").val("");
	}
	else if($("#selSec").length > 0){
		$("#selSec").selectpicker('destroy');

		$("#divSec").append("<select class='selectpicker' id='selSec' data-live-search='true' data-size='20'></select>");
		$("#selSec").selectpicker();
	}

	/*
	 * Se elimina el select "selTra" presente en cada vista
	 * donde existe un select que liste los trayectos.
	 * Luego de eliminarse, se vuelve a crear y se agrega a "divTra".
	 * Div presente en cada vista donde se utiliza selTra.
	 */

	if(val == 'tra')
		return;

	if($("#selTra").length > 0){
		$("#selTra").selectpicker('destroy');

		$("#divTra").append("<select class='selectpicker' id='selTra' data-live-search='true' data-size='20'></select>");
		$("#selTra").selectpicker();
	}

	/*
	 * Se elimina el select "selPer" presente en cada vista
	 * donde existe un select que liste los periodos.
	 * Luego de eliminarse, se vuelve a crear y se agrega a "divPer".
	 * Div presente en cada vista donde se utiliza selPer.
	 */

	if(val == 'per')
		return;

	if($("#selPer").length > 0){
		$("#selPer").selectpicker('destroy');

		$("#divPer").append("<select class='selectpicker' id='selPer' data-live-search='true' data-size='20'></select>");
		$("#selPer").selectpicker();
	}

	/*
	 * Se elimina el select "selPen" presente en cada vista
	 * donde existe un select que liste los pensums del sistema.
	 * Luego de eliminarse, se vuelve a crear y se agrega a "divPen".
	 * Div presente en cada vista donde se utiliza selPen.
	 */

	if(val == 'pen')
		return;

	if($("#selPen").length > 0){
		$("#selPen").selectpicker('destroy');

		$("#divPen").append("<select class='selectpicker' id='selPen' data-live-search='true' data-size='20'></select>");
		$("#selPen").selectpicker();
	}

	/*
	 * Se elimina el select "selInst" presente en cada vista
	 * donde existe un select que liste los institutos del sistema.
	 * Luego de eliminarse, se vuelve a crear y se agrega a "divInst".
	 * Div presente en cada vista donde se utiliza selInst.
	 */

	if(val == 'inst')
		return;

	if($("#selInst").length > 0){
		$("#selInst").selectpicker('destroy');

		$("#divInst").append("<select class='selectpicker' id='selInst' data-live-search='true' data-size='20'></select>");
		$("#selInst").selectpicker();
	}

}

/*
 * Llamada AJAX para cargar los institutos del sistema
 *
 * Si es succ, llama a la función succCargarInstitutos.
 * De ser error, llama a la función err y muestra un mensaje
 * al usuario.
 */

function cargarInstitutos(){
	var arr = Array("m_modulo"		,		"instituto",
					"m_accion"		,		"listar");

	ajaxMVC(arr,succCargarInstitutos,err);
}

/*
 * Función succCargarInstitutos.
 *
 * Se encarga de montar la información proveniente
 * del AJAX en un select.
 *
 * Para asegurar la limpieza, se elimina el select y se vuelve
 * a crear.
 *
 * Parámetro de entrada:
 * 		data 				Resultado del AJAX.
 *
 * Como se está modificando el elemento, se utiliza la función
 * limpiarCampos para que limpie los elementos dependientes de este.
 */


function succCargarInstitutos(data){

	var ins = data.institutos;

	var cad = "";
	cad += "<select class='selectpicker' id='selInst' onchange='cargarPensums()' data-live-search='true' data-size='20'>";

	if(ins){
		cad += "<option value='-1' disabled selected> Seleccione Instituto</option>";
		for(var i = 0; i < ins.length; i++){
			cad += "<option value="+ins[i][0]+">"+ins[i]['nombre']+"</option>";
		}
	}
	else{
		cad += "<option></option>";
	}
	cad += "</select>";

	$("#selInst").selectpicker("destroy");
	$("#divInst").append(cad);
	$("#selInst").selectpicker();

	limpiarCampos('inst');

	datos = data.datos;

}

/*
 * Llamada AJAX para cargar los pensum de un instituto
 *
 * Si es succ, llama a la función succCargarPensum.
 * De ser error, llama a la función err y muestra un mensaje
 * al usuario.
 */


function cargarPensums(){

	var arr = Array("m_modulo"		,	"pensum",
					"m_accion"		,	"buscarPorInstituto",
					"codigo" 		, 	$("#selInst").val());

	ajaxMVC(arr,succCargarPensums,err);
}

/*
 * Función succCargarPensums.
 *
 * Se encarga de montar la información proveniente
 * del AJAX en un select.
 *
 * Para asegurar la limpieza, se elimina el select y se vuelve
 * a crear.
 *
 * Parámetro de entrada:
 * 		data 				Resultado del AJAX.
 *
 * Como se está modificando el elemento, se utiliza la función
 * limpiarCampos para que limpie los elementos dependientes de este.
 */

function succCargarPensums(data){

	var pen = data.pensum;
	var cad = "";

	cad += "<select class='selectpicker' id='selPen' onchange='cargarPeriodos()' data-live-search='true' data-size='20'>";

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

	$("#selPen").selectpicker('destroy');
	$("#divPen").append(cad);
	$("#selPen").selectpicker();
	limpiarCampos('pen');
}

/*
 * Llamada AJAX para cargar los periodos de un pensum en un instituto
 *
 * Si es succ, llama a la función succCargarInstitutos.
 * De ser error, llama a la función err y muestra un mensaje
 * al usuario.
 */

function cargarPeriodos(){
	var arr = Array("m_modulo"		,		"periodo",
					"m_accion"		,		"listarPeriodos",
					"codPensum"		,		$("#selPen").val());

	ajaxMVC(arr,succCargarPeriodos,err);
}

/*
 * Función succCargarPeriodos.
 *
 * Se encarga de montar la información proveniente
 * del AJAX en un select.
 *
 * Para asegurar la limpieza, se elimina el select y se vuelve
 * a crear.
 *
 * Parámetro de entrada:
 * 		data 				Resultado del AJAX.
 *
 * Como se está modificando el elemento, se utiliza la función
 * limpiarCampos para que limpie los elementos dependientes de este.
 */

function succCargarPeriodos(data){

	var per = data.periodos;
	var cad = "";

	if($("#divEstudiante").length > 0){
		cad += "<select class='selectpicker' id='selPer' onchange='cargarEstudiantes()' data-live-search='true' data-size='20'>";
	}
	else {
		cad += "<select class='selectpicker' id='selPer' onchange='cargarTrayectos()' data-live-search='true' data-size='20'>";
	}
	if(per){
		cad += "<option value='-1' disabled selected> Seleccione Periodo</option>";

		for(var i = 0; i < per.length; i++){
			cad += "<option value="+per[i][0]+">"+per[i][1]+"</option>";
		}
	}
	else{
		cad += "<option></option>";
		mostrarMensaje("No hay periodos abiertos para este pensum.",2);
	}

	cad += "</select>";


	$("#selPer").selectpicker('destroy');
	$("#divPer").append(cad);
	$("#selPer").selectpicker();
	limpiarCampos('per');
}

/*
 * Llamada AJAX para cargar los trayectos de un pensum
 *
 * Si es succ, llama a la función succCargarInstitutos.
 * De ser error, llama a la función err y muestra un mensaje
 * al usuario.
 */

function cargarTrayectos(){
	var arr = Array("m_modulo"		,		"pensum",
					"m_accion"		,		"buscarPorTrayecto",
					"codigo"		,		$("#selPen").val());

	ajaxMVC(arr,succCargarTrayectos,err);
}

/*
 * Función succCargarTrayectos.
 *
 * Se encarga de montar la información proveniente
 * del AJAX en un select.
 *
 * Para asegurar la limpieza, se elimina el select y se vuelve
 * a crear.
 *
 * Parámetro de entrada:
 * 		data 				Resultado del AJAX.
 *
 * Como se está modificando el elemento, se utiliza la función
 * limpiarCampos para que limpie los elementos dependientes de este.
 */

function succCargarTrayectos(data){

	var tra = data.pensum;
	var cad = "";

	if($("#selSec").length > 0)
		cad += "<select class='selectpicker' id='selTra' data-live-search='true' onchange='cargarSeccion()' data-size='20'>";
	else
		cad += "<select class='selectpicker' id='selTra' onchange='limpiarCampos(\"tra\")' data-live-search='true' data-size='20'>";


	if(tra){
		cad += "<option value='-1' disabled selected> Seleccione Trayecto</option>";

		for(var i = 0; i < tra.length; i++){
			if(tra[i]['codigo'] == null)
				cad += "<option value="+tra[i]['codigo']+">"+tra[i]['num_trayecto']+"</option>";
			else
				cad += "<option value="+tra[i]['codigo']+">Trayecto "+tra[i]['num_trayecto']+"</option>";
		}
	}
	else{
		cad += "<option></option>";
	}

	$("#selTra").selectpicker("destroy");
	$("#divTra").append(cad);
	$("#selTra").selectpicker();
	limpiarCampos('tra');
}

/*
 * Llamada AJAX para cargar las secciones de los trayectos
 *
 * Si es succ, llama a la función succCargarInstitutos.
 * De ser error, llama a la función err y muestra un mensaje
 * al usuario.
 */

function cargarSeccion(){
	var arr = Array("m_modulo"		,		"curso",
					"m_accion"		,		"buscarSeccionPorTrayecto",
					"codTrayecto"	,		$("#selTra").val(),
					"periodo"		,		$("#selPer").val());

	ajaxMVC(arr,succCargarSeccion,err);
}

/*
 * Función succCargarSeccion.
 *
 * Se encarga de montar la información proveniente
 * del AJAX en un select.
 *
 * Para asegurar la limpieza, se elimina el select y se vuelve
 * a crear.
 *
 * Parámetro de entrada:
 * 		data 				Resultado del AJAX.
 *
 * Como se está modificando el elemento, se utiliza la función
 * limpiarCampos para que limpie los elementos dependientes de este.
 */

function succCargarSeccion(data){
	var sec = data.secciones;
	var cad = "";

	if($("#sec").length > 0){
		$("#sec").val(sec[0][0]);
	}
	else{
		cad += "<select class='selectpicker' id='selSec' data-live-search='true' onchange='cargarUni()' data-size='20'>";

		if(sec){
			cad += "<option value='-1' disabled selected>Seleccione Sección</option>";

			for(var i = 0; i < sec.length; i++){
				cad += "<option value="+sec[i][0]+">Sección "+sec[i][0]+"</option>";
			}
		}
		else{
			cad += "<option></option>";
		}

		$("#selSec").selectpicker("destroy");
		$("#divSec").append(cad);
		$("#selSec").selectpicker();
	}

	limpiarCampos('sec');
}

/*
 * Llamada AJAX para cargar las unidades curriculares de una sección, pensum, trayecto y periodo
 *
 * Si es succ, llama a la función succCargarInstitutos.
 * De ser error, llama a la función err y muestra un mensaje
 * al usuario.
 */

function cargarUni(){
	var arr = Array("m_modulo"		,		"curso",
					"m_accion"		,		"listarUniCurricular",
					"seccion"		,		$("#selSec").val(),
					"pensum"		,		$("#selPen").val(),
					"trayecto"		,		$("#selTra").val(),
					"periodo"		,		$("#selPer").val());

	ajaxMVC(arr,succCargarUni,err);
}

/*
 * Función succCargarUni.
 *
 * Se encarga de montar la información proveniente
 * del AJAX en un select.
 *
 * Para asegurar la limpieza, se elimina el select y se vuelve
 * a crear.
 *
 * Parámetro de entrada:
 * 		data 				Resultado del AJAX.
 *
 * Como se está modificando el elemento, se utiliza la función
 * limpiarCampos para que limpie los elementos dependientes de este.
 */

function succCargarUni(data){
	console.log(data);

	var uni = data.uni;
	var cad = "";

	cad += "<select class='selectpicker' id='selUni' data-live-search='true' onchange=\"listarEstudiantes(succListarEstudiantes,$('#selUni').val())\" data-size='20'>";

	if(uni){
		cad += "<option value='-1' disabled selected> Seleccione Unidad Curricular</option>";

		for(var i = 0; i < uni.length; i++){
			cad += "<option value="+uni[i]['codigo']+">"+uni[i]['nombre']+"</option>";
		}
	}
	else{
		cad += "<option></option>";
	}

	$("#selUni").selectpicker("destroy");
	$("#divUni").append(cad);
	$("#selUni").selectpicker();
	limpiarCampos('uni');
}

/*
 * Llamada AJAX para cargar los cursos del sistema. Se cargan
 * por Instituto, pensum, periodo y patrón de búsqueda.
 *
 * Si es succ, llama a la función succCargarInstitutos.
 * De ser error, llama a la función err y muestra un mensaje
 * al usuario.
 */

function listarCursos(){
	var arr = Array("m_modulo"		,		"curso",
					"m_accion"		,		"listarCursos",
					"codInstituto"	,		$("#selInst").val(),
					"codPensum"		,		$("#selPen").val(),
					"codPeriodo"	,		$("#selPer").val(),
					"patron"		,		$("#patron").val());

	ajaxMVC(arr,succListarCursos,err)
}

/*
 * Función succListarCursos que recibe data proveniente
 * de una llamada AJAX. Es encargado de crear una cadena html
 * con una tabla y los valores pertinentes de los datos que
 * vienen del AJAX. Luego de crear la cadena, se la agrega al
 * al div correspondiente. Para realizar esta operación,
 * se le hace remove al id de la tabla que se crea en esta función
 * (para no repetir elementos en la vista) y luego se agrega al div.
 *
 * Si el resultado del AJAX es vacío o null, se muestra un mensaje de error
 * al usuario.
 *
 */

function succListarCursos(data){
	var cur = data.cursos;
	var cad = "";

	if(cur){
		cad += "<table id='table-lis' class='table table-hover table-condensed table-responsive'>";

		var cont = 0;
		var tope = cur.length;
		var it = -1;

		var sec = cur[0][2];
		var p = '';

		while(cont < tope){
			var tra = cur[cont][1];

			/*
			 * Condicional que permite diferenciar en la vista
			 * el cambio de Trayectos.
			 */

			if(it != tra){
				sec = '';
				p = 'info';

				it = tra;
				cad += "<tr>";
				if(cur[cont][1] == null)
					cad+="<th style='text-align:center' class='dark' colspan='10'>Generales del Pensum</th>";
				else
					cad+="<th style='text-align:center' class='dark' colspan='10'>Trayecto "+cur[cont][1]+"</th>";
				cad += "</tr>";
				cad += "<th style='text-align:center' class='dark'>Más opciones</th>";
				cad += "<th style='text-align:center' class='dark'>Código del Curso</th>";
				cad += "<th style='text-align:center' class='dark'>Trayecto</th>";
				cad += "<th style='text-align:center' class='dark'>Sección</th>";
				cad += "<th style='text-align:center' class='dark'>Unidad Curricular (Código del Ministerio)</th>";
				cad += "<th style='text-align:center' class='dark'>Docente</th>";
				cad += "<th style='text-align:center' class='dark'>Cantidad de Estudiantes</th>";
				cad += "<th style='text-align:center' class='dark'>Capacidad de Estudiantes</th>";
				cad += "<th style='text-align:center' class='dark'>Fecha de Inicio</th>";
				cad += "<th style='text-align:center' class='dark'>Fecha de Fin</th>";
			}

			if(cur[cont][2] != sec){
				if(p == 'info')
					p = '';
				else if(p == '')
					p = 'info';
				sec = cur[cont][2];
			}

			cad += "<tr>";
			cad += "<td style='text-align:center' class='"+p+"'><input type='checkbox' onchange='actualizarCheck("+cont+")' id='checkbox"+cont+"'><input type='text' hidden id='hid"+cont+"' value='"+cur[cont][0]+"'></td>"

			for(var i = 0; i < 9; i++){
				if(cur[cont][i] != null){
					if(i == 5)
						cad += "<td style='text-align:center' class='"+p+"' id='cant"+cont+"'>"+cur[cont][i]+"</td>";
					else if(i == 3)
						if(cur[cont]['cod_uni_ministerio'] != null)
							cad += "<td  class='"+p+"' id='"+cont+"'>"+cur[cont]['nombre']+" ("+cur[cont]['cod_uni_ministerio']+")</td>";
						else
							cad += "<td  class='"+p+"' id='"+cont+"'>"+cur[cont]['nombre']+" (N/A)</td>";
					else
						cad += "<td style='text-align:center' class='"+p+"' id='c"+i+cont+"'>"+cur[cont][i]+"</td>";
				}
				else{
					if(i == 5)
						cad += "<td style='text-align:center' class='"+p+"' id='cant"+cont+"'>0</td>";
					else
						cad += "<td style='text-align:center' class='"+p+"'>No asignado</td>";
				}
			}
			cad += "</tr>";

			cont++;
		}

		cad += "</table>";
	}
	else{
		mostrarMensaje("No hay elementos que coincidan con los criterios de búsqueda",2);
	}

	$("#table-lis").remove();
	$("#divLis").append(cad);

	verificarChecks();
}

function mostrarPatron(){
	$("#divPat").show();
	$("#divBut").show();
}

var cantCheck = 0;

function actualizarCheck(el){

	if($("#checkbox"+el).is(':checked'))
		cantCheck++;
	else
		cantCheck--;

	if(cantCheck == 0)
		ocultarPanel();
	else
		mostrarPanel();
}

function mostrarPanel(){
	if($("#panelB").is(":hidden"))
		$("#panelB").show();
}

function ocultarPanel(){
	if($("#panelB").is(":visible"))
		$("#panelB").hide();
}

function verificarChecks(el){
	var len = $('#table-lis >tbody >tr').length;

	var sec = '';
	var tra = '';

	for(var i = 0; i < len; i++){
		if($("#checkbox"+i).is(":checked")){
			if(el == 'mod'){
				/*
				 * Verificación de permisos.
				 */
				if(per.CursoModificar || per.CursoAgregar){
					if((sec+tra) != ($("#c2"+i).html()+$("#c1"+i).html())){
						window.open('index.php?m_modulo=curso&m_accion=mostrar&m_vista=CrearModificarCurso&m_formato=html5&codigo='+$("#hid"+i).val(),'_blank');
						sec = $("#c2"+i).html();
						tra = $("#c1"+i).html();
					}
				}
				else{
					mostrarMensaje("Se ha detectado que no posee permisos para crear/modificar cursos.",4);
				}
			}
			else if(el == 'le') { //lista de estudiantes
				/*
				 * Verificación de permisos.
				 */
				if(per.CurEstudianteListar){
					if($("#cant"+i).html() != '0')
						window.open('index.php?m_modulo=curso&m_accion=mostrar&m_vista=ListarEstudiantes&m_formato=html5&codigo='+$("#hid"+i).val(),'_blank');
					else
						mostrarMensaje("No se puede generar la lista de estudiantes para este curso porque no posee estudiantes inscritos.",3);
				}
				else {

				}
			}
			else if(el == 'lepdf') { //lista de estudiantes en pdf
				/*
				 * Verificación de permisos.
				 */
				if(per.CurEstudianteListar){
					if($("#cant"+i).html() != '0'){
						//ARIC: Aprobados, Reprobados, reprobados por Inasistencia, Cursando
						window.open('index.php?m_modulo=estudiante&m_accion=listarEstudiantesPorCurso&m_vista=listaAsistencia&m_formato=pdf&codigo='+$("#hid"+i).val() + '&est_estudiante=ARIC','_blank');

					}else
						mostrarMensaje("No se puede generar la lista de estudiantes para este curso porque no posee estudiantes inscritos.",3);
				}
			}
			else if(el == 'cn'){
				/*
				 * Verificación de permisos.
				 */
				if(per.CurEstudianteModificar){
					if($("#cant"+i).html() != '0')
						window.open('index.php?m_modulo=curso&m_accion=mostrar&m_vista=CargarNotas&m_formato=html5&codigo='+$("#hid"+i).val(),'_blank');
					else
						mostrarMensaje("No se puede abrir la pestaña de cargar notas para este curso porque no posee estudiantes inscritos.",3);
				}
				else{
					mostrarMensaje("Se ha detectado que no posee permisos para cargar notas.",4);
				}
			}
			else if(el == 'ri'){
				if(per.CurEstudianteModificar){
					if($("#cant"+i).html() != '0')
							window.open('index.php?m_modulo=curso&m_accion=mostrar&m_vista=InscribirRetirarEstudiante&m_formato=html5&codigo='+$("#hid"+i).val(),'_blank');
					else
						mostrarMensaje("No se puede abrir la pestaña de retirar estudiante para este curso porque no posee estudiantes inscritos.",3);
				}
				else{
					mostrarMensaje("Se ha detectado que no posee permisos para retirar estudiantes del curso.",4);
				}
			}
			else if(el == "ret"){
				retirarEstudiante($("#hid"+i).val(),$("#selUni").val());
			}
			else if(el == "elim"){
				eliminarEstudiante($("#hid"+i).val(),$("#selUni").val());
			}
		}
	}
}

function retirarEstudiante(codigo, uni){
	var arr = Array("m_modulo"		,		"curso",
					"m_accion"		,		"retirarEstudiante",
					"codEstudiante"	,		codigo,
					"codCurso"		,		uni);

	ajaxMVC(arr, succRetirarEstudiante, err);
}

function succRetirarEstudiante(data){
	mostrarMensaje("Se ha realizado un retiro exitoso.",1);
	listarEstudiantes(succListarEstudiantes,$('#selUni').val());
}

function eliminarEstudiante(codigo, uni){
	var arr = Array("m_modulo"		,		"curso",
					"m_accion"		,		"eliminarEstudiante",
					"codEstudiante"	,		codigo,
					"codCurso"		,		uni);

	ajaxMVC(arr, succEliminarEstudiante, err);
}

function succEliminarEstudiante(data){
	mostrarMensaje("Se ha eliminado al estudiante de la lista.",1);
	listarEstudiantes(succListarEstudiantes,$('#selUni').val());
}


function cargarCursosPensum(){
	if($("#sec").val().trim() != '' && validarRangos("#sec",1,5,true)){
		var arr = Array("m_modulo"		,		"curso",
						"m_accion"						,		"obtenerCursosPensum",
						"seccion"							,		$("#sec").val().trim().toUpperCase(),
						"trayecto"						,		$("#selTra").val(),
						"periodo"							,		$("#selPer").val());

		ajaxMVC(arr,succCargarCursosPensum,err);
	}
	else{
		if($(".alert").length == 0)
			mostrarMensaje("Ingrese una sección válida.",4);
			$("#tableCur").remove();
	}

}

/*
 * Función succCargarCursosPensum que recibe data proveniente
 * de una llamada AJAX. Es encargado de crear una cadena html
 * con una tabla y los valores pertinentes de los datos que
 * vienen del AJAX. Luego de crear la cadena, se la agrega al
 * al div correspondiente. Para realizar esta operación,
 * se le hace remove al id de la tabla que se crea en esta función
 * (para no repetir elementos en la vista) y luego se agrega al div.
 *
 * Si el resultado del AJAX es vacío o null, se muestra un mensaje de error
 * al usuario.
 *
 */

function succCargarCursosPensum(data){
	var cur = data.cursos;
	var cad = "";

	if(cur){
		cad += "<table id='tableCur' class='table table-hover table-condensed table-responsive'>";

		cad += "<th style='text-align:center' class='dark'>Cursos Activos</th>";
		cad += "<th style='text-align:center' class='dark'>Unidad Curricular</th>";
		cad += "<th style='text-align:center' class='dark'>Capacidad</th>";
		cad += "<th style='text-align:center' class='dark'>Docente</th>";
		cad += "<th style='text-align:center' class='dark'>Fecha Inicio</th>";
		cad += "<th style='text-align:center' class='dark'>Fecha Fin</th>";
		cad += "<th style='text-align:center' class='dark'>Observaciones</th>";

		var val = '';

		for(var i = 0; i < cur.length; i++){
			val = '';
			cad += "<tr>";

			if(cur[i]['codcurso'] != null){
				if(per.CursoAgregar || per.CursoEliminar)
					cad += "<td style='text-align:center'><input type='checkbox' id='check"+i+"' onchange='validarCurso("+i+",\""+cur[i]['nombre']+"\")' checked></td>";
				else {
					cad += "<td style='text-align:center'><input disabled type='checkbox' id='check"+i+"' onchange='validarCurso("+i+",\""+cur[i]['nombre']+"\")' checked></td>";
				}
				val = '';
			}
			else {
				if(per.CursoAgregar || per.CursoEliminar)
					cad += "<td style='text-align:center'><input type='checkbox' id='check"+i+"' onchange='validarCurso("+i+",\""+cur[i]['nombre']+"\")' ></td>";
				else {
					cad += "<td style='text-align:center'><input disabled type='checkbox' id='check"+i+"' onchange='validarCurso("+i+",\""+cur[i]['nombre']+"\")' ></td>";
				}
				val = 'disabled';
			}

			cad += "<input type='hidden' id='estado"+i+"' value='s'>";

			cad += "<input type='hidden' id='uni"+i+"' value='"+cur[i]['coduni']+"'>";

			if(cur[i]['codcurso'] != null){
				cad += "<input type='hidden' id='cod"+i+"' value='"+cur[i]['codcurso']+"'>";
			}
			else
				cad += "<input type='hidden' id='cod"+i+"' value='-1'>";

			if(cur[i]['codcurso'] != null)
				cad += "<td>"+cur[i]['nombre']+" ("+cur[i]['codcurso']+")</td>";
			else
				cad += "<td>"+cur[i]['nombre']+"</td>";

			cad += "<input type='hidden' value='"+cur[i]['nombre']+"' id='nb"+i+"'>";

			if(cur[i]['capacidad'] == null)
				cad += "<td style='text-align:center'><input type='text' class='form-control' size='2' "+val+" onkeyup='validarSoloNumeros(\"#capacidad"+i+"\",1,3,true)' onchange='actualizarEstadoCurso("+i+")' id='capacidad"+i+"'></td>";
			else
				cad += "<td style='text-align:center'><input type='text' class='form-control' size='2' "+val+" onkeyup='validarSoloNumeros(\"#capacidad"+i+"\",1,3,true)' onchange='actualizarEstadoCurso("+i+")' id='capacidad"+i+"' value='"+cur[i]['capacidad']+"'></td>";


			if(cur[i]['nombredocente'] == null)
				cad += "<td style='text-align:center'><input type='text' "+val+" class='docente form-control' onfocus='autocompletarDocente()' onchange='limpiarDoc("+i+");actualizarEstadoCurso("+i+")' id='"+i+"' ></td>";
			else
				cad += "<td style='text-align:center'><input type='text' "+val+" class='docente form-control' onfocus='autocompletarDocente()' onchange='limpiarDoc("+i+");actualizarEstadoCurso("+i+")' id='"+i+"' value='"+cur[i]['nombredocente']+"'></td>";

			if(cur[i]['coddocente'] == null)
				cad += "<input type='hidden' id='doc"+i+"' value=''>";
			else
				cad += "<input type='hidden' id='doc"+i+"' value='"+cur[i]['coddocente']+"'>";

			if(cur[i]['fec_inicio'] == null)
				cad += "<td style='text-align:center'><input type='text' "+val+"  onclick='actualizarEstadoCurso("+i+")' class='date form-control' style='cursor:pointer'  id='fecini"+i+"' size='3'></td>";
			else
				cad += "<td style='text-align:center'><input type='text' "+val+"  onclick='actualizarEstadoCurso("+i+")' class='date form-control' style='cursor:pointer'  id='fecini"+i+"' value='"+cur[i]['fec_inicio']+"' size='3'></td>";


			if(cur[i]['fec_final'] == null){
				cad += "<td style='text-align:center'><input type='text' "+val+" size='5' class='date form-control' style='cursor:pointer' onclick='actualizarEstadoCurso("+i+")' id='fecfin"+i+"' ></td>";
			}else
				cad += "<td style='text-align:center'><input type='text' "+val+" size='5' class='date form-control' style='cursor:pointer' onclick='actualizarEstadoCurso("+i+")' id='fecfin"+i+"' value='"+cur[i]['fec_final']+"'></td>";

			if(cur[i]['observaciones'] == null)
				cad += "<td style='text-align:center'><input type='text' class='form-control' "+val+" onchange='actualizarEstadoCurso("+i+")' id='observaciones"+i+"' maxlength='50'></td>";
			else
				cad += "<td style='text-align:center'><input type='text' class='form-control' "+val+" onchange='actualizarEstadoCurso("+i+")' id='observaciones"+i+"' value='"+cur[i]['observaciones']+"' maxlength='50'></td>";

			cad += "</tr>";
		}

		cad += "</table>";

		/*
		 * Verificación de permisos.
		 */

		if(per.CursoAgregar || per.CursoModificar)
			cad += "<button id='btn-b' class='btn btn-dark btn-xs' onclick='actualizarCursos()'>Guardar Cambios</button>";
	}
	else{
		mostrarMensaje("No hay cursos disponibles en la base de datos",2);
	}

	$("#tableCur").remove();
	$("#btn-b").remove();
	$("#divTable").append(cad);
	$(".form-control").css("font-size",10);
	$(".form-control").css("height","25px");
	$('.date').datetimepicker({
		format: 'DD/MM/YYYY',
		collapse : false,
		calendarWeeks : true
	});
}

function validarCurso(i,e){
	// if($("#check"+i).is(':checked')){
	// 	// poner tr disponible
	// }
	// else{
	// 	if(confirm("¿Está seguro que desea eliminar el curso "+elmnt+"?"))
	// 		eliminarCurso($("#cod"+i).val());
	// }

	if($("#check"+i).is(":checked")){
		mostrarMensaje("Se ha habilitado el curso de "+e+" para su edición.",4);
		if($("#cod"+i).val() != '-1'){
			$("#estado"+i).val("m");
		}
	}
	else{
		if($("#cod"+i).val() != '-1'){
			$("#estado"+i).val("e");
			mostrarMensaje("Se ha marcado el curso de "+e+" para su eliminación. Se realizará una vez guarde los cambios.",4);
		}
	}

	$('#tableCur').delegate(':checkbox', 'change', function(){
  	$(this).closest('tr').find('input:text').attr('disabled', !this.checked);
	});
}



function actualizarEstadoCurso(i){
	if($("#estado"+i).val() == 's')
		$("#estado"+i).val("m");

	if($("#estado"+i).val() == 'm' && $("#cod"+i).val() == -1)
		$("#estado"+i).val("n");
}

function limpiarDoc(i){
	if($("#"+i).val() == ''){
		$("#doc"+i).val("");
	}
}

/*
 * Función que hace una llamada AJAX dependiendo del estado del curso
 * (si se va a agregar o modificar) e invoca a la acción respectiva.
 *
 */

function actualizarCursos(){
	var len = $('#tableCur >tbody >tr').length;

	for(var i = 0; i < len; i++){
		if($("#estado"+i).val() == 'n'){
			var arr = Array("m_modulo"			,		"curso",
							"m_accion"			,		"agregarCurso",
							"codPeriodo"		,		$("#selPer").val(),
							"codUniCurricular"	,		$("#uni"+i).val(),
							"codDocente"		,		$("#doc"+i).val(),
							"seccion"			,		$("#sec").val().toUpperCase().trim(),
							"fecInicio"			,		$("#fecini"+i).val(),
							"fecFinal"			,		$("#fecfin"+i).val(),
							"capacidad"			,		$("#capacidad"+i).val(),
							"observaciones"		,		$("#observaciones"+i).val());

			if(per.CursoAgregar){
				if(validarDosFechas("#fecini"+i,"#fecfin"+i) && validarSoloNumeros("#capacidad"+i,2,3,true)){

					ajaxMVC(arr,succActualizarCursosA,err);
				}
			}
			else {
				mostrarMensaje("Se ha detectado que no posee los permisos necesarios. No se pudo realizar la acción.",3);
			}
		}
		else if($("#estado"+i).val() == 'm'){
			var arr2 = Array("m_modulo"			,		"curso",
							"m_accion"			,		"modificarCurso",
							"codCurso"			,		$("#cod"+i).val(),
							"codPeriodo"		,		$("#selPer").val(),
							"codUniCurricular"	,		$("#uni"+i).val(),
							"codDocente"		,		$("#doc"+i).val(),
							"seccion"			,		$("#sec").val().toUpperCase().trim(),
							"fecInicio"			,		$("#fecini"+i).val(),
							"fecFinal"			,		$("#fecfin"+i).val(),
							"capacidad"			,		$("#capacidad"+i).val(),
							"observaciones"		,		$("#observaciones"+i).val());

			if($("#capacidad"+i).val() == '0')
				detonarAdvertencia("#capacidad"+i,"La capacidad no puede ser 0.");
			else if(per.CursoModificar){
				if(validarDosFechas("#fecini"+i,"#fecfin"+i) && validarSoloNumeros("#capacidad"+i,1,3,true)){
					ajaxMVC(arr2,succActualizarCursosM,err);
				}
			}
			else
				mostrarMensaje("Se ha detectado que no posee los permisos necesarios. No se pudo realizar la acción.",3);
		}
		else if($("#estado"+i).val() == 'e'){
			var arr3 = Array("m_modulo"		,			"curso",
											"m_accion"		,			"eliminarCurso",
											"codCurso"		,			$("#cod"+i).val());

			if(per.CursoEliminar)
				if(confirm("¿Está seguro que desea eliminar el curso "+$("#nb"+i).val()+"?"))
					ajaxMVC(arr3,succEliminarCurso,err);
		}
	}
}

function succActualizarCursosA(data){
	cargarCursosPensum();
	mostrarMensaje("El curso se ha agregado con éxito. El nuevo código para este curso es "+data.codCurso,1);
}

function succEliminarCurso(data){
	var est = data.estatus;

	if(est > 0){
		cargarCursosPensum();
		mostrarMensaje(data.mensaje,1);
	}
	else{
		mostrarMensaje(data.mensaje,3);
	}
}

function succActualizarCursosM(data){
	mostrarMensaje(data.mensaje,1);
	cargarCursosPensum();
}

/*
 * Llamada ajax reutilizable que permite listar los estudiantes
 * de un curso. Recibe como parámetro la función que se realizará
 * en el success del AJAX y el código del curso de donde se desean
 * consultar los estudiantes.
 */

function listarEstudiantes(funsucc,cod){
	var arr = Array("m_modulo"		,		"estudiante",
					"m_accion"		,		"listarEstudiantesPorCurso",
					"codigo"		,		cod);


	ajaxMVC(arr,funsucc,err);

}

/*
 * Función succListarEstudiantes que recibe data proveniente
 * de una llamada AJAX. Es encargado de crear una cadena html
 * con una tabla y los valores pertinentes de los datos que
 * vienen del AJAX. Luego de crear la cadena, se la agrega al
 * al div correspondiente. Para realizar esta operación,
 * se le hace remove al id de la tabla que se crea en esta función
 * (para no repetir elementos en la vista) y luego se agrega al div.
 *
 * Si el resultado del AJAX es vacío o null, se muestra un mensaje de error
 * al usuario.
 *
 * Este succ es reutilizado por varias llamadas AJAX y es el responsable
 * (en su mayoría) de mostrar listas de estudiantes.
 */

function succListarEstudiantes(data){
	console.log(data);

	var est = data.estudiante;
	var cad = "";

	if(est){
		var estB = (obtenerGet("m_vista") == 'InscribirRetirarEstudiante');

		cad += "<table id='table-lis' class='table table-hover table-condensed table-responsive'>";

		if(estB)
			cad += "<th style='text-align:center' class='dark'></th>";

		cad += "<th style='text-align:center' class='dark'>#</th>";
		cad += "<th style='text-align:center' class='dark'>Cédula</th>";
		cad += "<th style='text-align:center' class='dark'>Apellido</th>";
		cad += "<th style='text-align:center' class='dark'>Nombre</th>";
		cad += "<th style='text-align:center' class='dark'>Correo</th>";
		cad += "<th style='text-align:center' class='dark'>Nota</th>";
		cad += "<th style='text-align:center' class='dark'>% Asistencia</th>";
		cad += "<th style='text-align:center' class='dark'>Estado</th>";

		var prom = 0;
		var ne = 0;
		var ret = false;

		for(var i = 0; i < est.length; i++){
			if(est[i]['cod_estado'] != 'X'){
				cad += "<tr>";

				if(estB)
					cad += "<td style='text-align:center'><input type='checkbox' id='checkbox"+i+"'><input type='hidden' id='hid"+i+"' value='"+est[i]['codigo']+"'></input></td>";

					cad += "<td style='text-align:center'>"+(i+1)+"</td>";

				if(est[i]['nacionalidad'] != null)
					cad += "<td style='text-align:center'>"+est[i]['nacionalidad']+"-"+est[i]['cedula']+"</td>";
				else
					cad += "<td style='text-align:center'>"+est[i]['cedula']+"</td>";

				cad += "<td style='text-align:center'>"+est[i]['apellido1']+"</td>";

				cad += "<td style='text-align:center'>"+est[i]['nombre1']+"</td>";

				if(est[i]['cor_personal'] == null)
					cad += "<td style='text-align:center'>No asignado</td>";
				else
					cad += "<td style='text-align:center'>"+est[i]['cor_personal']+"</td>";

				if(est[i]['nota'] == null)
					cad += "<td style='text-align:center'>No asignado</td>";
				else{
					cad += "<td style='text-align:center'>"+est[i]['nota']+"</td>";
					prom += est[i]['nota'];
				}

				if(est[i]['por_asistencia'] == null)
					cad += "<td style='text-align:center'>No asignado</td>";
				else
					cad += "<td style='text-align:center'>"+est[i]['por_asistencia']+"</td>";

				if(est[i]['nombre'] == null)
					cad += "<td style='text-align:center'>No asignado</td>";
				else
					cad += "<td style='text-align:center'>"+est[i]['nombre']+"</td>";

				cad += "</tr>";
			}
			else if(obtenerGet("m_vista") != 'InscribirRetirarEstudiante'){
				if(!ret){
					cad += "<tr>";
					cad += "<th style='text-align:center' colspan='9' class='dark'>Retirados</th>";
					ret = true;
					cad += "</tr>";
					cad += "<th style='text-align:center' class='dark'>#</th>";
					cad += "<th style='text-align:center' class='dark'>Cédula</th>";
					cad += "<th style='text-align:center' class='dark'>Apellido</th>";
					cad += "<th style='text-align:center' class='dark'>Nombre</th>";
					cad += "<th style='text-align:center' class='dark'>Correo</th>";
					cad += "<th style='text-align:center' class='dark'>Nota</th>";
					cad += "<th style='text-align:center' class='dark'>% Asistencia</th>";
					cad += "<th style='text-align:center' class='dark'>Estado</th>";
				}

				cad += "<tr>";

				if(ret){
					ne++;
					cad += "<td style='text-align:center'>"+(ne)+"</td>";
				}
				else
					cad += "<td style='text-align:center'>"+(i+1)+"</td>";

				cad += "<td style='text-align:center'>"+est[i]['cedula']+"</td>";

				cad += "<td style='text-align:center'>"+est[i]['apellido1']+"</td>";

				cad += "<td style='text-align:center'>"+est[i]['nombre1']+"</td>";

				if(est[i]['cor_personal'] == null)
					cad += "<td style='text-align:center'>No asignado</td>";
				else
					cad += "<td style='text-align:center'>"+est[i]['cor_personal']+"</td>";

				if(est[i]['nota'] == null)
					cad += "<td style='text-align:center'>No asignado</td>";
				else{
					cad += "<td style='text-align:center'>"+est[i]['nota']+"</td>";
					prom += est[i]['nota'];
				}

				if(est[i]['por_asistencia'] == null)
					cad += "<td style='text-align:center'>No asignado</td>";
				else
					cad += "<td style='text-align:center'>"+est[i]['por_asistencia']+"</td>";

				if(est[i]['nombre'] == null)
					cad += "<td style='text-align:center'>No asignado</td>";
				else
					cad += "<td style='text-align:center'>"+est[i]['nombre']+"</td>";

				cad += "</tr>";
			}
		}
		cad += "</table>";
	}
	else {
		mostrarMensaje("No hay estudiantes inscritos en este curso.",4);
	}

	$("#divButt").show();
	$("#table-lis").remove();
	$("#divLis").append(cad);

}
$( document ).ready(function() {
	if($("#selInst").length > 0)
		cargarInstitutos();

});


//~ if(obtenerGet('codigo') != null && obtenerGet('m_vista') != 'CargarNotas')
	//~ montarSelects();
// if((obtenerGet('m_vista') != 'CargarNotas')&&(obtenerGet('codigo') != null)){
// 	montarSelects();
// }

if(obtenerGet('codigo') != null)
	montarSelects();
//}

function montarSelectUsuario(){

	datos = datos[0];

	if(datos.emp_inst != null){
		$("#selInst").val(datos.emp_inst);
		$("#selInst").attr('disabled',true);
		cargarPensums();
	}
	else if(datos.est_inst != null){
		$("#selInst").val(datos.est_inst);
		$("#selInst").attr('disabled',true);
		cargarPensums();
	}


	setTimeout(function(){
		if(datos.emp_pensum != null){
			$("#selPen").val(datos.emp_pensum);
			$("#selPen").prop("disabled",true);
			$(".selectpicker").selectpicker("refresh");
			cargarPeriodos();
		}
		else if(datos.est_pensum != null){
			$("#selPen").val(datos.est_pensum);
			$("#selPen").prop("disabled",true);
			$(".selectpicker").selectpicker("refresh");
			cargarPeriodos();
		}
	},700);


}

function obtenerGet(indice){
	var $_GET = {};

	document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
	    function decode(s) {
	        return decodeURIComponent(s.split("+").join(" "));
	    }

    	$_GET[decode(arguments[1])] = decode(arguments[2]);
	});

	return ($_GET[indice])?$_GET[indice]:null;
}

function montarSelects(){
	var arr = Array("m_modulo"		,		"curso",
					"m_accion"		,		"obtenerDatosDeCurso",
					"codigo"		,		obtenerGet('codigo'));

	if(obtenerGet("m_vista") == "CargarNotas")
		ajaxMVC(arr,succCargarNotas,err);
	else
		ajaxMVC(arr,succMontarSelects,err);
}

function cargarNotas(){
	var arr = Array("m_modulo"		,		"curso",
					"m_accion"		,		"obtenerDatosDeCurso",
					"codigo"		,		obtenerGet('codigo'));

	ajaxMVC(arr,succCargarNotas,err);
}

function montarSelectEstado(data){
	if(data == null){
		var arr = Array("m_modulo"		,		"curso",
						"m_accion"		,		"obtenerEstusEstudiante");

		ajaxMVC(arr,montarSelectEstado,err);
	}
	else {
		var dat = data.estados;
		var cad = "";
		if(dat){
			for(var i = 0; i < dat.length; i++)
				cad += "<option value='"+dat[i]['codigo']+"'>"+dat[i]['nombre']+"</option>";
		}
	}
}

function succCargarNotas(data){
	var dat = data.cursoInfoMontar;

	if(dat){
		/*$("#inst").html(dat[0]['nombreins']);
		$("#tra").html(dat[0]['numtrayecto']);
		if(dat[0]['nombredocente'] != null)
			$("#doc").html(dat[0]['nombredocente']);
		else {
			$("#doc").html("No asignado");
		}
		$("#pen").html(dat[0]['nombrepen']);
		$("#sec").html(dat[0]['seccion']);

		$("#per").html(dat[0]['nombreperiodo']);
		$("#uni").html(dat[0]['nombreuni']);
		*/
		//montarSelects(data);
		succMontarSelects(data);

		listarEstudiantes(succListarEstudiantesCargarNotas,obtenerGet('codigo'));
	}
}

/*
 * Función succListarEstudiantesCargarNotas que recibe data proveniente
 * de una llamada AJAX. Es encargado de crear una cadena html
 * con una tabla y los valores pertinentes de los datos que
 * vienen del AJAX. Luego de crear la cadena, se la agrega al
 * al div correspondiente. Para realizar esta operación,
 * se le hace remove al id de la tabla que se crea en esta función
 * (para no repetir elementos en la vista) y luego se agrega al div.
 *
 * Si el resultado del AJAX es vacío o null, se muestra un mensaje de error
 * al usuario.
 *
 * A diferencia de la otra función encargada de construir una lista de estudaintes,
 * esta crea campos text que permitirán cargar notas al usuario.
 */

function succListarEstudiantesCargarNotas(data){

	var est = data.estudiante;
	var cad = "";
	var cad2 = "";
	var edos = data.estados;

	for(var j = 0; j < edos.length; j++){
		cad2 += "<option value='"+edos[j]['codigo']+"'>"+edos[j]['nombre']+"</option>";
	}

	if(est){
		cad += "<table id='table-Est' class='table table-hover table-condensed table-responsive'>";

		cad += "<th style='text-align:center' class='dark'>#</th>";
		cad += "<th style='text-align:center' class='dark'>Cédula</th>";
		cad += "<th style='text-align:center' class='dark'>Apellido</th>";
		cad += "<th style='text-align:center' class='dark'>Nombre</th>";
		cad += "<th style='text-align:center' class='dark'>Nota</th>";
		cad += "<th style='text-align:center' class='dark'>% Asistencia</th>";
		cad += "<th style='text-align:center' class='dark'>Estado</th>";
		cad += "<th style='text-align:center' class='dark'>Observaciones</th>";

		var prom = 0;

		cad += "<input type='hidden' id='codigocurso' value='"+est[0]['cod_curso']+"'>";

		for(var i = 0; i < est.length; i++){
			if(est[i]['cod_estado'] != 'X'){
				cad += "<tr>";

				cad += "<td style='text-align:center'>"+(i+1)+" <input type='hidden' id='hid"+i+"' value='n'>";

				cad += "<input type='hidden' id='curest"+i+"' value='"+est[i]['cod_curest']+"'></td>";
				cad += "<input type='hidden' id='est"+i+"' value='"+est[i]['codigo']+"'></td>";

				if(est[i]['nacionalidad'] != null)
					cad += "<td style='text-align:center'>"+est[i]['nacionalidad']+"-"+est[i]['cedula']+"</td>";
				else
					cad += "<td style='text-align:center'>"+est[i]['cedula']+"</td>";

				cad += "<td style='text-align:center'>"+est[i]['apellido1']+"</td>";

				cad += "<td style='text-align:center'>"+est[i]['nombre1']+"</td>";

				cad += "<input type='hidden' id='nom"+i+"' value='"+est[i]['nombre1']+" "+est[i]['apellido1']+"'>";

				if(est[i]['nota'] == null)
					cad += "<td style='text-align:center'><center><input class='form-control' type='text' onkeyup='validarSoloNumeros(\"#nota"+i+"\",1,2,false)' onchange='actualizarEstado("+i+")' id='nota"+i+"' size='4' style='width:50px;' value=''></td>";
				else
					cad += "<td style='text-align:center'><center><input class='form-control' type='text' onkeyup='validarSoloNumeros(\"#nota"+i+"\",1,2,false)' onchange='actualizarEstado("+i+")' id='nota"+i+"'  size='4' style='width:50px;' value='"+est[i]['nota']+"'></td>";

				if(est[i]['por_asistencia'] == null)
					cad += "<td style='text-align:center'><center><input class='form-control' type='text' onkeyup='validarSoloNumeros(\"#asis"+i+"\",1,3,false)' onchange='actualizarEstado("+i+")' id='asis"+i+"' size='4' style='width:50px;' value=''></td>";
				else
					cad += "<td style='text-align:center'><center><input class='form-control' type='text' onkeyup='validarSoloNumeros(\"#asis"+i+"\",1,3,false)' onchange='actualizarEstado("+i+")' id='asis"+i+"' size='4' style='width:50px;' value='"+est[i]['por_asistencia']+"'></td>";

				cad += "<td style='text-align:center'><select class='selectpicker' onchange='actualizarEstado("+i+")' data-live-search='true' data-width='200px' id='estado"+i+"'>"+cad2+"</select></td>";


				if(est[i]['observaciones'] == null)
					cad += "<td style='text-align:center'><input type='text' class='form-control' onchange='actualizarEstado("+i+")' id='obser"+i+"' value='' maxlength='50'></td>";
				else
					cad += "<td style='text-align:center'><input type='text' class='form-control' onchange='actualizarEstado("+i+")' id='obser"+i+"' value='"+est[i]['observaciones']+"' maxlength='50'></td>";

				cad += "</tr>";
			}
		}

		cad += "</table>";

		if(per.CurEstudianteModificar)
			cad += "<br><br><center><button class='btn btn-dark btn-xs' onclick='guardarNotas()'>Cargar Notas</button></center>";
	}
	else {
		mostrarMensaje("No hay resultados para los criterios de búsqueda",3);
	}

	$("#table-Est").remove();
	$("#tableEst").append(cad);
	$(".form-control").css("font-size",10);
	$(".form-control").css("height","25px");
	for(var i = 0; i < est.length; i++){
		$("#estado"+i).val(est[i]['cod_estado']);
	}

	$(".selectpicker").selectpicker();

}


function actualizarEstado(i){
	$("#hid"+i).val("s");
}

function guardarNotas(i){
	var len = $('#table-Est >tbody >tr').length;

	for(var i = 0; i < len; i++){
		if($("#hid"+i).val() == 's'){
			$("#hid"+i).val("n");
			var arr = Array("m_modulo"		,		"curso",
							"m_accion"		,		"modificarCurEst",
							"codCurEst"		,		$("#curest"+i).val(),
							"codCurso"		,		$("#codigocurso").val(),
							"codEstudiante"	,		$("#est"+i).val(),
							"porAsistencia"	,		$("#asis"+i).val(),
							"codEstado"		,		$("#estado"+i).val(),
							"nota"			,		$("#nota"+i).val(),
							"observaciones"	,		$("#obser"+i).val(),
							"nombre"		,		$("#nom"+i).val());

			if(validarSoloNumeros("#nota"+i,1,2,false) && validarSoloNumeros("#asis"+i,1,3,false))
				ajaxMVC(arr,succGuardarNotas,err);
			else {
				mostrarMensaje("Ocurrió un error en la validación de campos. Por favor, verifique la información",4);
			}
		}
	}
}

function succGuardarNotas(data){
	mostrarMensaje("La información del estudiante "+data.nombre+" fue cargada exitosamente.",1);
}

function succMontarSelects(data){

	var dat = data.cursoInfoMontar;
	var tmp = 400;
	var i = 1;

	var aux = (obtenerGet("m_vista") == "CargarNotas");

	if(dat[0]['cod_instituto'] != null){
		i++;
		setTimeout(function (){
			$("#selInst").val(dat[0]['cod_instituto']);
			if(datos != null){
				if(datos.est_instituto != null || datos.emp_instituto != null || aux){
					$("#selInst").prop("disabled",true);
				}
			}
			cargarPensums();
		}, tmp*i);
	}


	if(dat[0]['cod_pensum'] != null){
		i++;
		setTimeout(function (){
			$("#selPen").val(dat[0]['cod_pensum']);
			if(datos != null){
				if(datos.est_pensum != null || datos.emp_pensum != null || aux){
					$("#selPen").prop("disabled",true);
				}
			}
			cargarPeriodos();
		}, tmp*i);
	}

	if(dat[0]['codigo'] != null){
		i++;
		setTimeout(function (){
			$("#selPer").val(dat[0]['codigo']);
			if(aux)
				$("#selPer").prop("disabled",true);

			cargarTrayectos();

		}, tmp*i);
	}

	if(dat[0]['cod_trayecto'] != null){
		i++;
		setTimeout(function (){
			$("#selTra").val(dat[0]['cod_trayecto']);

			if(aux)
				$("#selTra").prop("disabled",true);

			if($("#selSec").length > 0)
				cargarSeccion();
		}, tmp*i);
	}

	if($("#sec").length > 0){
		i++;
		setTimeout(function (){
			$("#sec").val(dat[0]['seccion']);
		}, tmp*i);
	}
	else if(dat[0]['seccion'] != null){
		i++;
		setTimeout(function (){
			$("#selSec").val(dat[0]['seccion']);

			if($("#selUni").length > 0)
				cargarUni();
		}, tmp*i);
	}

	if($("#selUni").length > 0){
		if(dat[0]['codigocurso'] != null){
			i++;
			setTimeout(function (){
				$("#selUni").val(dat[0]['codigocurso']);
			}, tmp*i);
		}
	}

	setTimeout(function (){
		if($("#divLis").length == 0)
			cargarCursosPensum();
		else{
			if(obtenerGet('codigo') != null){
				listarEstudiantes(succListarEstudiantes,obtenerGet('codigo'));
			}
			else {
				listarEstudiantes(succListarEstudiantes,$("#selUni").val());
			}
		}
		$(".selectpicker").selectpicker("refresh");
	}, tmp*i);

}


function montarSelect(sel,val){
	$(sel).val(val);
	$(sel).selectpicker("refresh");
}

function cargarEstudiantes(){
	var arr = Array("m_modulo"		,		"estudiante",
									"m_accion"		,		"listarEstudiantePeriodo",
									"instituto"		,		$("#selInst").val(),
									"pensum"			,		$("#selPen").val(),
									"periodo"			,		$("#selPer").val());

	ajaxMVC(arr,succCargarEstudiantes,err);
}

/*
 * Función succCargarEstudiantes.
 *
 * Se encarga de montar la información proveniente
 * del AJAX en un select.
 *
 * Para asegurar la limpieza, se elimina el select y se vuelve
 * a crear.
 *
 * Parámetro de entrada:
 * 		data 				Resultado del AJAX.
 *
 * Como se está modificando el elemento, se utiliza la función
 * limpiarCampos para que limpie los elementos dependientes de este.
 */

function succCargarEstudiantes(data){

	var dat = data.estudiantes;
	var cad = "";

	cad += "<select class='selectpicker' id='selEstudiante' onchange='listarUniEstudiante()' data-width='500px' data-live-search='true' data-size='20'>";

	if(dat){

		cad += "<option value='-1' disabled selected> Seleccione Estudiante</option>";

		for(var i = 0; i < dat.length; i++){
			cad += "<option value='"+dat[i]['codigo']+"'>"+dat[i]['nombrecompleto']+" ("+dat[i]['nacionalidad']+"-"+dat[i]['cedula']+")</option>";
		}
	}

	cad += "</select>";

	$("#selEstudiante").selectpicker("destroy");
	$("#divEstudiante").append(cad);
	$("#selEstudiante").selectpicker();

	limpiarCampos('est');
}

function listarUniEstudiante(){
	if(obtenerGet("m_vista") != 'Inscripcion'){
		var arr = Array("m_modulo"		,		"curso",
						"m_accion"		,		"obtenerCursosPorEstudiante",
						"codigo"		,		$("#selEstudiante").val());


		ajaxMVC(arr,succListarUniEstudiante,err);
	}
	else{
		var arr = Array("m_modulo"		,		"curso",
						"m_accion"		,		"obtenerCursosDisponiblesParaInscripcionPorEstudiante",
						"estudiante"	,		$("#selEstudiante").val(),
						"instituto"		,		$("#selInst").val(),
						"pensum"		,		$("#selPen").val(),
						"periodo"		,		$("#selPer").val(),
						"prelaciones"	,		($("#chckPrelacion").is(':checked')));

		ajaxMVC(arr,succCursosInscribir,err);
	}
}

/*
 * Función succCusosInscribir que recibe data proveniente
 * de una llamada AJAX. Es encargado de crear una cadena html
 * con una tabla y los valores pertinentes de los datos que
 * vienen del AJAX. Luego de crear la cadena, se la agrega al
 * al div correspondiente. Para realizar esta operación,
 * se le hace remove al id de la tabla que se crea en esta función
 * (para no repetir elementos en la vista) y luego se agrega al div.
 *
 * Si el resultado del AJAX es vacío o null, se muestra un mensaje de error
 * al usuario.
 */

function succCursosInscribir(data){
	var dat = data.cursos;

	if(dat){
		var cad = "";


		cad += "<table class='table table-hover table-condensed table-responsive' id='tableCD'>";

		cad += "<th class='dark' style='text-align:center'>Trayecto</th>";
		cad += "<th class='dark' style='text-align:left'>Unidad Curricular(Código del Ministerio)</th>";
		cad += "<th class='dark' style='text-align:center'>UC</th>";
		cad += "<th class='dark' style='text-align:left'>Sección a Inscribir (Cantidad de Estudiantes/Capacidad del Curso)</th>";

		var len = dat.length;
		var cont = 0;

		var cod = -1;

		for(var i = 0; i < len; i++){

			/*
			 * Condicional que permite agrupar las secciones disponibles
			 * por cada código de unidad curricular.
			 */

			if(cod != dat[i]['cod_uni_curricular']){
				cont++;
				cad += "<tr style='text-align:left'>";

				cad += "<td>"+dat[i]['num_trayecto']+"</td>";
				cad += "<td style='text-align:left'>"+dat[i]['nombre']+" ("+dat[i]['cod_uni_ministerio']+")</td>";
				cad += "<td style='text-align:center' id='uni"+cont+"'>"+dat[i]['uni_credito']+"</td>";

				cad += "<input type='hidden' id='est"+cont+"' value='0'>";

				cad += "<td style='text-align:left;'>";

				cad += "<div class='radio-inline'>" +
					  "<label style='cursor:pointer;'>" +
							"<input style='cursor:pointer;' type='radio' name='opc"+cont+"' checked onchange='cambiarEstUC(0,"+cont+")'>" +
							"No inscribir" +
					  "</label>"+
					"</div>";

				cad +=

				"<div class='radio-inline'>" +
				  "<label style='cursor:pointer;'>" +
						"<input type='radio' style='cursor:pointer;' name='opc"+cont+"' onchange='cambiarEstUC("+dat[i]['codigo']+","+cont+")'>" +
						""+ dat[i]['seccion'] + "(" + dat[i]['cantidad'] +"/"+ dat[i]['capacidad'] + ")" +
				  "</label>"+
				"</div>";

				cod = dat[i]['cod_uni_curricular'];
			}
			else{
				cad +=

				"<div class='radio-inline'>" +
				  "<label>" +
						"<input type='radio' name='opc"+cont+"' onchange='cambiarEstUC("+dat[i]['codigo']+","+cont+")'>" +
						""+ dat[i]['seccion'] + "(" + dat[i]['cantidad'] +"/"+ dat[i]['capacidad'] + ")" +
				  "</label>"+
				"</div>";
			}

		}

		cad += "</td>";

		cad += "</tr>";

		cad += "</table>";

		cad += "<center><button class='btn btn-dark btn-xs' id='btnCD' onclick='inscribirUC()'>Inscribir Unidades Curriculares</button>";

		$("#btnTicket").remove();

		$("#ticket").append("<button id='btnTicket' class='btn btn-danger btn-xs' onclick='generarTicket()'>Generar Ticket de Inscripción</button>");
	}
	else{
		mostrarMensaje("Este estudiante no tiene cursos disponibles para inscribir",4);
	}

	$("#info").remove();
	$("#btnCD").remove();
	$("#tableCD").remove();
	$("#tableCursosD").append(cad);
}

function cambiarEstUC(num,i){
	$("#est"+i).val(num);

	var len = $('#tableCD >tbody >tr').length;
	var cont = 0;
	var a = 0;
	var cad = "";

	for(var i = 1; i < len; i++){
		if($("#est"+i).val() != 0){
			cont += parseInt($("#uni"+i).html());
			a++;
		}
	}

	cad += "<div id='info'>";

	cad += "Cantidad de Unidades de Crédito a Inscribir: "+cont;

	cad += "<br>";

	cad += "Cantidad de Unidades Curriculares a Inscribir: "+a;

	cad += "</div>";

	$("#info").remove();

	$("#tableCursosD").append(cad);
}

function inscribirUC(){
	var len = $('#tableCD >tbody >tr').length;

	for(var i = 1; i < len; i++){
		if($("#est"+i).val() != 0){
			var arr = Array("m_modulo"			,		"curso",
							"m_accion"			,		"agregarCurEst",
							"codEstudiante"		,		$("#selEstudiante").val(),
							"codCurso"			,		$("#est"+i).val(),
							"porAsistencia"		,		"0",
							"nota"				,		"0",
							"codEstado"			,		"C",
							"observaciones"		,		"");
			ajaxMVC(arr,succInscribirUC,err);
		}
	}
}

function generarTicket(){
	window.location.assign("index.php?m_modulo=curso&m_formato=pdf&m_vista=ticketInscripcion&m_accion=generarTicketInscripcion&codEstudiante="+$("#selEstudiante").val()+"&codPeriodo="+$("#selPer").val()+"&codPensum="+$("#selPen").val()+"");
}

function succInscribirUC(data){
	var msj = data.mensaje;
	mostrarMensaje(msj,1);
	listarUniEstudiante();
}

/*
 * Función succListarUniestudiante que recibe data proveniente
 * de una llamada AJAX. Es encargado de crear una cadena html
 * con una tabla y los valores pertinentes de los datos que
 * vienen del AJAX. Luego de crear la cadena, se la agrega al
 * al div correspondiente. Para realizar esta operación,
 * se le hace remove al id de la tabla que se crea en esta función
 * (para no repetir elementos en la vista) y luego se agrega al div.
 *
 * Si el resultado del AJAX es vacío o null, se muestra un mensaje de error
 * al usuario.
 */

function succListarUniEstudiante(data){
	var dat = data.cursos;
	var cad = "";
	if(dat){
		cad += "<table class='table table-hover table-condensed table-responsive' id='tableC'>";

		cad += "<th class='dark' style='text-align:center'>Seleccionar</th>";
		cad += "<th class='dark' style='text-align:center'>Código del Curso</th>";
		cad += "<th class='dark' style='text-align:center'>Trayecto</th>";
		cad += "<th class='dark' style='text-align:center'>Nombre UC (Código de Ministerio)</th>";
		cad += "<th class='dark' style='text-align:center'>Sección</th>";
		cad += "<th class='dark' style='text-align:center'>Estado</th>";

		for(var i = 0; i < dat.length; i++){
			cad += "<tr>";

			cad += "<td style='text-align:center'><input type='checkbox' id='checkbox"+i+"'></input></td>";

			cad += "<input type='hidden' id='hid"+i+"' value="+dat[i]['cod_ce']+"></input>";

			cad += "<td style='text-align:center'>"+dat[i]['cod_cur']+"</td>";

			cad += "<td style='text-align:center'>"+dat[i]['num_trayecto']+"</td>";

			if(dat[i]['cod_uni_ministerio'] == null)
				cad += "<td style='text-align:center'>"+dat[i]['nombre']+" (No Disponible)</td>";
			else
				cad += "<td style='text-align:center'>"+dat[i]['nombre']+" ("+dat[i]['cod_uni_ministerio']+")</td>";

			cad += "<td style='text-align:center'>"+dat[i]['seccion']+"</td>";

			cad += "<td style='text-align:center'>"+dat[i]['edonom']+"</td>";
		}

		cad += "</table>";

		cad += "<button class='btn btn-dark btn-xs' id='butRet' onclick='retirarUni()'>Retirar Unidad Curricular</button>";

		$("#butRet").remove();
		$("#tableC").remove();
		$("#listaC").append(cad);
	}
	else{
		$("#butRet").remove();
		$("#tableC").remove();
		mostrarMensaje("El estudiante no tiene unidades curriculares con estado 'Cursando'",3);
	}
}

function autocompletarDocente(){
	$(".docente").autocomplete({
			delay: 0,  //milisegundos
			minLength: 1,
			source: function( request, response ) {
				var a=Array("m_modulo"		,		"empleado",
							"m_accion"		,		"auto",
							"patron"		,		request.term,
							"instituto"		,		$("#selInst").val(),
							"pensum"		,		$("#selPen").val()
							);

				ajaxMVC(a,function(data){
							return response(data);
						  },
						  function(data){
							return response([{"label": "Error de conexión", "value": {"nombreCorto":""}}]);

						   }
						);

			},
			select: function (event, ui){
				if(ui.item.value == "null"){
					$(this).val("");
					event.preventDefault();
					$("#doc"+$(this).attr("id")).val("");
				}
				else{
					$(this).val(ui.item.label);
					event.preventDefault();
					$("#doc"+$(this).attr("id")).val(ui.item.value);
				}

			},
			focus: function (event, ui){
				if(ui.item.value == "null"){
					$(this).val("");
					event.preventDefault();
					$("#doc"+$(this).attr("id")).val("");
				}
				else{
					$(this).val(ui.item.label);
					event.preventDefault();
					$("#doc"+$(this).attr("id")).val(ui.item.value);
				}
			}
	});
}

function retirarUni(){
	var len = $('#tableC >tbody >tr').length;

	for(var i = 0; i < len; i++){
		if($("#checkbox"+i).is(":checked")){
			var arr = Array("m_modulo"		,		"curso",
							"m_accion"		,		"retirarCurEstudiante",
							"codigo"		,		$("#hid"+i).val());

			ajaxMVC(arr,succRetirarUni,err);
		}
	}
}

function succRetirarUni(data){
	mostrarMensaje(data.mensaje,1);
	listarUniEstudiante();
}
