
$( document ).ready(function() {
	activarCal();
	setSelects();

});

function setSelects (){
	var arr = Array("m_modulo","instituto");

	ajaxMVC(arr,succSetSelects,errAjaxs);
}

function succSetSelects(data){

	var pensum=data.datos[0]['emp_pensum'];
	var jc= data.datos[0]['es_jef_con_estudio'];
	var instituto=data.datos[0]['emp_inst'];

	$("#jc").val(jc);

	verInstitutos(instituto);
	
	verPensuma(pensum,jc,instituto);

	verPeriodo(instituto,jc,pensum);

	if(!jc)
		listarElectivas();



	borrarCamposElectiva(jc);
}

function borrarCamposElectiva(jc){

	if(jc){
		$("#SelectPensum").val("-1");
		verPeriodo();			
		$("#SelectPeriodo").val("-1");	
	}
	else
		$("#SelectPeriodo").val("-1");

	$("#seccion").val("");
	$("#capacidad").val("");
	$("#docentes").val("");
	$("#docente").val("");
	$("#unidadCurricular").val("");
	$("#uniCurricular").val("");
	$("#fecInicio").val("");
	$("#fecFin").val("");
	$("#observacion").val("");
	$("#codigo").val("");
	$("#unidadCurricular").prop('disabled', false);

	if($("#jc").val()=='true')
		$("#SelectPensum").prop('disabled', false);
	
	$("#SelectPeriodo").prop('disabled', false);
	$("#detallePen").remove();
	$(".selectpicker").selectpicker("refresh");
}

function borrarElectiva(){

	var arr=Array("m_modulo"	,		"curso",
				  "m_accion"	,		"eliminarCurso",
				  "codCurso"	,		$("#codigo").val()
				);
	ajaxMVC(arr,succEliminar,errAjaxs);
}

function succEliminar(data){

	if(data.estatus>0){
		mostrarMensaje(data.mensaje,1);
		listarElectivas();
	}
	else
		mostrarMensaje(data.mensaje,2);

}


function verInstitutos(codigo){

	if(!codigo)
		codigo=-1;

	var arr=Array("m_modulo"	,		"instituto",
				  "m_accion"	,		"obtener",
				  "codigo"		,		codigo
				);
	ajaxMVC(arr,succInstituto,errAjaxs);

}

function succInstituto(data){

	var cad ='';
	$("#IdSelectInstituto").remove();

	cad="<div id='IdSelectInstituto'> Instituto";
	cad+= "<select  class='selectpicker' id='SelectInstituto' title='tipo unidad curricular' data-live-search='true' data-size='auto' data-max-options='12' disabled>";
	cad+= "<option value='-1' >Seleccionar</option>";
	if(data.instituto){
		for(var x=0; x<data.instituto.length;x++){
			cad+= "<option value='"+data.instituto[x]['codigo']+"' >"+data.instituto[x]['nom_corto']+"</option>";
		}
	}
	cad+="</select>";
	cad+="</div>";
	$(cad).appendTo('#institutos');
	activarSelect();
	$("#SelectInstituto").val(data.datos[0]['emp_inst']);
	$("#SelectInstituto").selectpicker("refresh");
}

function verPensuma(codigo,jc,instituto){

	if(!codigo)
		codigo=-1;
	if(jc){
		var accion="buscarPorInstituto";
		codigo=instituto;
	}
	else{
		var accion ="buscarPensum";
	}

	var arr=Array("m_modulo"	,		"pensum",
				  "m_accion"	,		accion,
				  "codigo"		,		codigo
				);
	ajaxMVC(arr,succPensum,errAjaxs);

}

function succPensum(data){

	var pensum=data.datos[0]['emp_pensum'];
	var jc= data.datos[0]['es_jef_con_estudio'];
	var instituto=data.datos[0]['emp_inst'];
	var cad ='';

	$("#IdSelectPensum").remove();

	cad="<div id='IdSelectPensum'> Pensum";
	if(data.datos[0]['es_jef_con_estudio'])
		cad+= "<select class='selectpicker' onchange='verPeriodo("+instituto+","+jc+","+pensum+");' id='SelectPensum' title='tipo unidad curricular' data-live-search='true' data-size='auto' data-max-options='12' >";
	else
		cad+= "<select class='selectpicker'  id='SelectPensum' title='tipo unidad curricular' data-live-search='true' data-size='auto' data-max-options='12' disabled>";

	cad+= "<option value='-1' >Seleccionar</option>";
	if(data.pensum){

		for(var x=0; x<data.pensum.length;x++){
			cad+= "<option value='"+data.pensum[x]['codigo']+"' >"+data.pensum[x][2]+"</option>";
		}
	}

	cad+="</select>";
	cad+="</div>";
	$(cad).appendTo('#pensuma');
	activarSelect();
	if(!data.datos[0]['es_jef_con_estudio']){
		$("#SelectPensum").val(data.datos[0]['emp_pensum']);
		$("#SelectPensum").selectpicker("refresh");
	}	

}


function verPeriodo (instituto,jc,pensum){

	if(jc)
		pensum=$("#SelectPensum").val();

	var arr=Array("m_modulo"	,	"periodo",
				  "m_accion"	,	"periodoInsPenEstado",
				  "instituto"	,	instituto,
				  "pensum"		,	pensum,
				  "estado"		,	'A'
				);
	ajaxMVC(arr,succPerido,errAjaxs);
}

function succPerido(data){

	var cad ='';
	$("#IdSelectPeriodo").remove();

	cad="<div id='IdSelectPeriodo'> Periodo";
	cad+= "<select class='selectpicker' id='SelectPeriodo' onchange='listarElectivas();' title='tipo unidad curricular' data-live-search='true' data-size='auto' data-max-options='12' >";
	cad+= "<option value='-1' >Seleccionar</option>";
	if(data.periodo){
		for(var x=0; x<data.periodo.length;x++){
			cad+= "<option value='"+data.periodo[x]['codigo']+"' >"+data.periodo[x]['nombre']+"</option>";
		}
	}
	cad+="</select>";
	cad+="</div>";
	$(cad).appendTo('#periodo');
	activarSelect();
}

function autoCompletarUniCurricularPensum(){

	$(".uniCurricular").autocomplete({
			delay: 200,  //milisegundos
			minLength: 1,
			source: function( request, response ) {

				var a=Array("m_modulo"		,		"unidad",
							"m_accion"		,		"uniCurPensum",
							"patron"		,		request.term,
							"pensum"		,		$("#SelectPensum").val(),
							"tipo"			,		"E"
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
					$("#uniCurricular").val('');
					$("#detallePen").remove();

				}
				else{
					$(this).val(ui.item.label);
					event.preventDefault();
					var codigo =ui.item.value;
					verDetalles(codigo);
					$("#uniCurricular").val(codigo);
				}


			},
			focus: function (event, ui){
				if(ui.item.value == "null"){
					$(this).val("");
					event.preventDefault();
					$("#uniCurricular").val('');
					$("#detallePen").remove();

				}
				else{
					$(this).val(ui.item.label);
					event.preventDefault();
					var codigo =ui.item.value;
					$("#uniCurricular").val(codigo);
					verDetalles(codigo);
				}
			}
	});
}

function guardarElectiva(){

	if($("#codigo").val()>0)
		var accion="modificarCurso";
	else
		var accion = "agregarCurso";

	var arr=Array("m_modulo"	,	"curso",
				  "m_accion"	,	accion,
				  "codPeriodo"		,	$("#SelectPeriodo").val(),
				  "seccion"		,	$("#seccion").val().toUpperCase(), 
				  "capacidad"	,	$("#capacidad").val(),
				  "codDocente"		,	$("#docente").val(),
				  "codUniCurricular",	$("#uniCurricular").val(),
				  "fecInicio"	,	$("#fecInicio").val(),
				  "fecFinal"		,	$("#fecFin").val(),
				  "observaciones"	,	$("#observacion").val(),
				  "codCurso"		,	$("#codigo").val()
				);
	ajaxMVC(arr,succGuardarElectiva,errAjaxs);

}

function succGuardarElectiva(data){
console.log(data);
	if(data.estatus>0){
		if(data.codCurso)
			$("#codigo").val(data.codCurso);
		mostrarMensaje(data.mensaje,1);
		listarElectivas(undefined);
	}
	else
		mostrarMensaje(data.mensaje,2);
}

function listarElectivas(codigo){
	
	var arr=Array("m_modulo"	,		"curso",
				  "m_accion"	,		"listarCurElectivas",
				  "pensum"		,		$("#SelectPensum").val(),
				  "periodo"		,		$("#SelectPeriodo").val(),
				  "codigo"		,		codigo
				);
	ajaxMVC(arr,succListarElectivas,errAjaxs);
}

function succListarElectivas(data){

	$("#listarElectiva").remove();
	var cad="";
	cad="<tbody id='listarElectiva' style='text-align:center;' >";
	if(data.electivas){
		for(var x=0; x<data.electivas.length;x++){
			var dat=data.electivas[x];
			if(data.codigo == dat['codigo'])
				cad+="	<tr class='pointer' onclick='buscarElectiva("+dat['codigo']+"); listarElectivas("+dat['codigo']+");' style='background-color:#E5EAEE;'>";
			else
				cad+="	<tr class='pointer' onclick='buscarElectiva("+dat['codigo']+"); listarElectivas("+dat['codigo']+");' >";
			cad+="	  <td>"+(x+1)+"</td>";
			cad+="	  <td>"+dat['codigo']+"</td>";
			cad+="	  <td>"+dat['nombre']+"</td>";
			if(dat['capacidad'])
				cad+="	  <td>"+dat['capacidad']+"</td>";
			else
				cad+="	 <td> - </td>";
			if(dat['nom_persona'])
				cad+="	  <td>"+dat['nom_persona']+"</td>";
			else
				cad+="	 <td> - </td>";
			if(dat['fec_inicios'])
				cad+="	  <td>"+dat['fec_inicios']+"</td>";
			else
				cad+="	 <td> - </td>";
			if(dat['fec_fin'])
				cad+="	  <td>"+dat['fec_fin']+"</td>";
			else
				cad+="	 <td> - </td>";
			if(dat['observaciones'])
				cad+="	  <td>"+dat['observaciones']+"</td>";
			else
				cad+="	 <td>- </td>";
			cad+="	</tr>";       		
		}
	}
	cad+="</tbody>";
	$(cad).appendTo('#tablaElectiva');
}

function buscarElectiva(codigo){
	
	var arr=Array("m_modulo"	,		"curso",
				  "m_accion"	,		"buscarCurElectiva",
				  "codigo"		,		codigo
				);
	ajaxMVC(arr,succbuscarElectiva,errAjaxs);
}

function succbuscarElectiva(data){

	var jc= data.datos[0]['es_jef_con_estudio'];
	var dat=data.electiva[0];

	if(jc){
		$("#SelectPensum").val(dat['cod_pensum']);
		setTimeout(function() {
			verPeriodo($("#SelectInstituto").val(),jc,$("#SelectPensum").val());
		}, 200);
		setTimeout(function() {
			
			$("#SelectPeriodo").val(dat['cod_periodo']);
			$("#SelectPeriodo").prop('disabled', true);
			$(".selectpicker").selectpicker("refresh");

		}, 350);
		
	}
	else
		$("#SelectPeriodo").val(dat['cod_periodo']);

	$("#SelectPeriodo").prop('disabled', true);
	$("#SelectPensum").prop('disabled', true);
	$("#seccion").val(dat['seccion']);
	$("#capacidad").val(dat['capacidad']);
	$("#docentes").val(dat['nom_persona']);
	$("#docente").val(dat['cod_docente']);
	$("#unidadCurricular").val(dat['nombre']);
	$("#unidadCurricular").prop('disabled', true);
	$("#uniCurricular").val(dat['cod_uni_curricular']);
	$("#fecInicio").val(dat['fec_inicios']);
	$("#fecFin").val(dat['fec_fin']);
	$("#observacion").val(dat['observaciones']);
	$("#codigo").val(dat['codigo']);
	if(!jc)
		$(".selectpicker").selectpicker("refresh");

	
	//$("#SelectPeriodo").is(':disabled');
	verDetalles(dat['cod_uni_curricular']);
}

function autocompletarDocentes(){

	$(".docentes").autocomplete({
			delay: 200,  //milisegundos
			minLength: 1,
			source: function( request, response ) {
				var a=Array("m_modulo"		,		"empleado",
							"m_accion"		,		"auto",
							"patron"		,		request.term,
							"instituto"		,		$("#SelectInstituto").val(),
							"pensum"		,		$("#SelectPensum").val(),
							"completo"		, 		false
							);

				ajaxMVC(a,function(data){
					console.log(data);
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
					$("#docente").val("");
				}
				else{
					$(this).val(ui.item.label);
					event.preventDefault();
					$("#docente").val(ui.item.value);
					
				}

			},
			focus: function (event, ui){
				if(ui.item.value == "null"){
					$(this).val("");
					event.preventDefault();
					$("#docente").val("");
				}
				else{
					$(this).val(ui.item.label);
					event.preventDefault();
					$("#docente").val(ui.item.value);
				}
			}
	});
}

function preGuardar(){
	var bool=true;
alert("dfdsf");
	if($("#SelectPeriodo").val()=="-1"){
		bool=false;
		mostrarMensaje("Debe de Seleccionar un periodo.",2);
	}
	else if(!validarSoloTextoNumer("#seccion","1","2","true")){
		bool=false;
		mostrarMensaje("Debe introducir una seccion");
	}
	else if($("#capacidad").val() && ($("#capacidad").val()<1 || !validarSoloNumeros("#capacidad","0","3","false"))){
		bool=false;
		mostrarMensaje("Debe introducir una capacidad Valida");
	}
	else if(!$("#unidadCurricular").val()){
		bool=false;
		mostrarMensaje("Debe introducir una una unidadCurricular");
	}
	else if(!validarSoloTextoNumer("#unidadCurricular","1","80","true")){
		bool=false;
		mostrarMensaje("Debe introducir una una unidadCurricular valida");
	}
	else if(!$("#uniCurricular").val()){
		bool=false;
		mostrarMensaje("Debe Seleccionar una unidad curricular");
	}
	else if($("#fecInicio").val() && $("#fecFin").val()){
		var fecha =$("#fecInicio").val().split("/");
		var fechFin=$("#fecFin").val().split("/");
		fechFin=new Date (fechFin[2],fechFin[1],fechFin[0]);
		fecha= new Date(fecha[2],fecha[1],fecha[0]);
		if(fechFin<=fecha){
			bool=false;	
			mostrarMensaje("La fecha de inicio no puede ser mayor a la fecha fin.",2);
		}
	}

	if(bool)
		guardarElectiva();
}

function borrarDetalle(){
	
	if(!$("#detallePen").val()){
		$("#detallePen").remove();
		$("#uniCurricular").val('');
	}
}

function borrarDocente(){

	if(!$("#docentes").val())
		$("#docente").val('');
	
}

function errAjaxs(data){
	console.log(data);
	//alert(data.mensaje);
	mostrarMensaje("Error de comunicación con el servidor.",2);
}


function verDetalles(codigo){
	var arr = Array ("m_modulo","unidad",
	 				 "m_accion","buscarCodigoUnidadCurricular",
	 				 "codigo",codigo
	 				 );
	ajaxMVC(arr,consultarDetalleUnic,errAjaxs);
}

function consultarDetalleUnic(data) {
//	console.log(data)
	if (data.estatus>0){
		console.log(data);
		unidad=data.unidad[0];
	//	console.log(unidad);
		cadena="";
		$("#detallePen").remove();
		cadena+="<div id='detallePen' class='third'>";
		cadena+="<table id='pesum' class='table table-bordered table-striped' style='clear: both'><tbody>";
		cadena+="<tr><td style='width: 35%;''>Código:</td><td style='width: 65%;'><a href='#'' >"+unidad[0]+"</a></td></tr>";
		cadena+="<tr><td>Código de Ministerio:</td><td>";
		cadena+="<a href='#'' >"+unidad[1]+"</a></td></tr>";
		cadena+="<tr><td>Nombre:</td><td>";
		cadena+="<a href='#'' >"+unidad[2]+"</a></td></tr>";
		cadena+="<tr><td>Horas de Trabajo Acompañadas (HTA):</td><td>";
		cadena+="<a href='#'' >"+unidad[3]+"</a></td></tr>";
		cadena+="<tr><td>Horas de Trabajo Independiente (HTI):</td><td>";
		cadena+="<a href='#'' >"+unidad[4]+"</a></td></tr>";
		cadena+="<tr><td>Unidades de Crédito:</td><td>";
		cadena+="<a href='#'' >"+unidad[5]+"</a></td></tr>";
		cadena+="<tr><td>Duración de Semanas:</td><td>";
		cadena+="<a href='#'' >"+unidad[6]+"</a></td></tr>";
		cadena+="<tr><td>Nota Mínima Aprobatoria:</td><td>";
		cadena+="<a href='#'' >"+unidad[7]+"</a></td></tr>";
		cadena+="<tr><td>Nota Máxima:</td><td>";
		cadena+="<a href='#'' >"+unidad[8]+"</a></td></tr>";
		cadena+="<tr><td>Descripción:</td><td>";
		cadena+="<a href='#'' >"+unidad[9]+"</a></td></tr>";
		cadena+="<tr><td>Observación:</td><td>";
		cadena+="<a href='#'' >"+unidad[10]+"</a></td></tr>";
		cadena+="<tr><td>Contenido:</td><td>";
		cadena+="<a href='#'' >"+unidad[11]+"</a></td></tr>";
		cadena+="</tbody></table></div>";
	//	$("#detallePen").html(cadena);
	//	alert(cadena);
		$("#notaMinima").val(unidad[7]);
		$("#notaMaxima").val(unidad[8]);

		$(cadena).appendTo('#detalle');
		//$("detallePen").replaceWith(cadena);
	}
}
