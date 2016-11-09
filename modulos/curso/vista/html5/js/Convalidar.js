$( document ).ready(function() {
	verTipUniCurricular();
	$("#nota").hide();
	activarCal();
	borrarCampos();
});

function verTipUniCurricular(){

	var arr=Array("m_modulo"	,		"curso",
				  "m_accion"	,		"tipoUniCurrilular"
				);

	ajaxMVC(arr,succTipUniCurricular,errAjax)
}

function succTipUniCurricular (data){
	var cad ='';
	$("#insti").val(data.datos[0]['emp_inst']);
	$("#IdSelectTipoUni").remove();
	cad="<div id='IdSelectTipoUni'> Tipo";
	cad+= "<select class='selectpicker' onchange='borrarCampoUniCurricular();' id='selectTipoUni' title='tipo unidad curricular' data-live-search='true' data-size='auto' data-max-options='12' >";
	cad+= "<option value='-1' >Seleccionar</option>";
	if(data.tipUniCurrilular){
		for(var x=0; x<data.tipUniCurrilular.length;x++){
			cad+= "<option value='"+data.tipUniCurrilular[x]['codigo']+"' >"+data.tipUniCurrilular[x]['nombre']+"</option>";
		}
	}
	cad+="</select>";
	cad+="</div>";
	$(cad).appendTo('#tipoUni');
	activarSelect();
}

function verPensum(codigo){
	var arr=Array("m_modulo"	,		"pensum",
				  "m_accion"	,		"pensumEstActivo",
				  "codigo"		,		codigo
				);

	ajaxMVC(arr,succPensumEst,errAjax);

}

function succPensumEst (data){

	var cad ='';
	$("#IdPensumEst").remove();
	cad="<div id='IdPensumEst'> Pensum";
	cad+= "<select onchange='verTrayecto(); borrarCampoUniCurricular();'class='selectpicker' id='pensumEst' title='tipo unidad curricular' data-live-search='true' data-size='auto' data-max-options='12' >";
	cad+= "<option value='-1' >Seleccionar</option>";
	if(data.pensum){
		for(var x=0; x<data.pensum.length;x++){
			cad+= "<option value='"+data.pensum[x]['pensum_codigo']+"' >"+data.pensum[x]['nom_corto']+"</option>";
		}
	}
	cad+="</select>";
	cad+="</div>";
	$(cad).appendTo('#pensum');
	activarSelect();
}

function verTrayecto(){

	var arr=Array("m_modulo"	,		"trayecto",
				  "m_accion"	,		"listarTrayectoPensum",
				  "codigo"		,		$("#pensumEst").val()
				);

	ajaxMVC(arr,succTrayecto,errAjax);
}

function succTrayecto (data){
	var cad ='';
	$("#IdTrayecto").remove();

	cad="<div id='IdTrayecto'> Trayecto";
	cad+= "<select class='selectpicker' onchange='borrarCampoUniCurricular();' id='trayectoEst' title='tipo unidad curricular' data-live-search='true' data-size='auto' data-max-options='12' >";
	cad+= "<option value='-1' >Seleccionar</option>";
	if(data.trayecto){
		for(var x=0; x<data.trayecto.length;x++){
			cad+= "<option value='"+data.trayecto[x]['codigo']+"' >"+data.trayecto[x]['num_trayecto']+"</option>";
		}
	}
	cad+="</select>";
	cad+="</div>";
	$(cad).appendTo('#trayecto');
	activarSelect();
}

function borrarCampoUniCurricular(){
	$("#unidadCurricular").val('');
	$("#detallePen").remove();
	$("#codUni").val('');
}
function preGuardarConvalidacion(){

	var bool=true;

	if(!$("#codigoPersona").val()){
		mostrarMensaje("Debes elegir una persona.",2);
		bool=false;
	}
	else if(!validarSoloTexto('#estudiante', '0', '80', true)){
		mostrarMensaje("Debes elegir una persona.",2);
		bool=false;
	}
	else if($("#selectTipoUni").val()=='-1'){
		mostrarMensaje("Debes Seleccionar un tipo de unidad curricular.",2);
		bool=false;
	}
	else if(!validarFecha("#fecha",true)){
		mostrarMensaje("Debes de seleccionar una fecha",2);
		bool=false;
	}
	else if(!$('input:radio[id=si]:checked').val() && !$('input:radio[id=no]:checked').val()){
		mostrarMensaje("Debes seleccionar si la convalidacion posee nota",2);
		bool=false;
	}
	else if($("#pensumEst").val()=='-1'){
		mostrarMensaje("Debes seleccionar pensum para convalidar",2);
		bool=false;
	}
	else if($("#trayectoEst").val()=='-1'){
		mostrarMensaje("Debes seleccionar trayecto para convalidar",2);
		bool=false;
	}
	else if(!$("#trayectoEst").val() || !$("#codUni").val()){
		mostrarMensaje("Debes seleccionar una unidadCurricular para convalidar",2);
		bool=false;
	}
	else if(validarFecha("#fecha",true)){
		var fecha=$("#fecha").val().split("/");
		var actual= fecActual().split("/");
		//alert(actual[2]-fecha[2]);
		if(actual[2]-fecha[2]<0){
			mostrarMensaje("debe de seleccionar una fecha menor o igual a la actual",2);
			bool=false;
		}
		else if(actual[2]-fecha[2]==0 && actual[1]-fecha[1]<0){
			mostrarMensaje("debe de seleccionar una fecha menor o igual a la actual",2);
			bool=false;
		}
		else if(actual[2]-fecha[2]==0 && actual[1]-fecha[1]==0
				&& actual[0]-fecha[0]<0){
			mostrarMensaje("debe de seleccionar una fecha menor o igual a la actual",2);
			bool=false;
		}
	}
	bool2=true;
	if($('input:radio[id=si]:checked').val()
		 && $("#nota").val()){
		if(!validarSoloNumeros("#nota",'1','2',true)){
			mostrarMensaje("En el campo nota solo se permiten numeros",2);
			bool2=false;
		}
		else if($("#nota").val()<$("#notaMinima").val()){
			var cad="";
			cad="Esta materia no puede ser convalidada,";
			cad+=" ya que la nota es infirmerior a la minima aceptada";
			mostrarMensaje(cad,2);
			bool2=false;
		}
		else if($("#nota").val()>$("#notaMaxima").val()){
			var cad="";
			cad=" Esta materia no puede ser convalidada,";
			cad+=" ya que la nota es superior a la maxima aceptada";
			mostrarMensaje(cad,2);
			bool2=false;
		}
	}
	else if($('input:radio[id=si]:checked').val()
			&& !validarSoloNumeros("#nota",'1','2',true) ){
			mostrarMensaje("Debes introducir la nota",2);
			bool2=false;
	}

	if(bool && bool2)
		guardarConvalidacion ();
}

function guardarConvalidacion (){

	var arr=Array(	"m_modulo"	,		"curso",
				  	"m_accion"	,		"insertarConvalidacion",
				  	"cod_persona",			$("#codigoPersona").val(),
				  	"con_nota"		,		$('input:radio[name=nota]:checked').val(),
					"nota"			,		$("#nota").val(),
					"fecha"			,		$("#fecha").val(),
					"cod_tip_uni_curricular",$("#selectTipoUni").val(),
					"cod_pensum"	,		$("#pensumEst").val(),
					"cod_trayecto"	,		$("#trayectoEst").val(),
					"cod_uni_curricular",	$("#codUni").val(),
					"descripcion"	,		$("#descripcionText").val(),
					"codigo"		,		$("#codConvalidacion").val()
				);

	//alert($("#codUni").val());
	ajaxMVC(arr,succGuardarConvalidacion,errAjax);
	setTimeout(function(){
		verConvalidadasEstudiante($("#codigoPersona").val());
	 },300);
}

function succGuardarConvalidacion(data){

	console.log(data);
alert();
	if(data.estatus>0){
		if(data.codigo){
			$("#codConvalidacion").val(data.codigo);
			$('#btn-nuevo').remove();
			var cad="";
			cad='<button id="btn-nuevo" class="btn btn-primary form-group" ';
			cad+='onclick="borrarCampos();">Nuevo</button>';
			$(cad).appendTo('#nuevo');
		}
		mostrarMensaje(data.mensaje,1);
	}
	else
		mostrarMensaje(data.mensaje,2);
}

function borrarCampos(bool){
	if(!bool){
		$("#codigoPersona").val("");
		$("#nombre").val("");
		$("#cedula").val("");
		$("#estudiante").val("");
	}

	$("#no").prop("checked",false);
	$("#si").prop("checked",false);
	$("#nota").val("");
	$("#nota").hide();
	$("#trayectoEst").val("");
	$("#codUni").val("");
	$("#descripcionText").val("");
	$("#codConvalidacion").val("");
	
	$("#selectTipoUni").val("-1");
	$("#selectTipoUni").selectpicker("refresh");
	$("#IdPensumEst").remove();
	$("#IdTrayecto").remove();
	$("#unidadCurricular").val("");
	$("#fecha").val("");
	$("#detallePen").remove();
	$("#convalida").remove();
}

function borrarConvalidacion(){
	var arr=Array(	"m_modulo"	,		"curso",
				  	"m_accion"	,		"eliminarConvalidacion",
				  	"codigo"		,	$("#codConvalidacion").val()
				);

	ajaxMVC(arr,succBorrarConvalidacion,errAjax);
	setTimeout(function(){
		verConvalidadasEstudiante($("#codigoPersona").val());
	 },300);
}

function succBorrarConvalidacion(data){
	if(data.estatus>0){
		$("#codConvalidacion").val("");
		mostrarMensaje(data.mensaje,1);
	}
	else
		mostrarMensaje(data.mensaje,2);
}

function autoCompletarEstudiante(estado){

	$(".estudiante").autocomplete({
			delay: 200,  //milisegundos
			minLength: 1,
			source: function( request, response ) {

				var a=Array("m_modulo"		,		"estudiante",
							"m_accion"		,		"buscarEstudiante",
							"patron"		,		request.term,
							"instituto"		,		$("#insti").val(),
							"estado"		,		estado
							);
				ajaxMVC(a,function(data){					
							return response(data);
						  },
						  function(data){
						  	console.log(data);
							return response([{"label": "Error de conexión", "value": {"nombreCorto":""}}]);

						   }
						);

			},
			select: function (event, ui){
				if(ui.item.value == "null"){
					$(this).val("");
					event.preventDefault();
					borrarCampos();
					//verConvalidadasEstudiante();
				}
				else{
					$(this).val(ui.item.label);
					event.preventDefault();
					borrarCampos(true);
					habilitarCampos();
					//alert(ui.item.value);
					$("#codigoPersona").val(ui.item.value);
					$("#nombre").val(ui.item.nombre);
					$("#cedula").val(ui.item.cedula);
					//alert(ui.item.value+"---");					
					verPensum(ui.item.value);
					$("#codigoPersona").val(ui.item.value);
					verConvalidadasEstudiante(ui.item.value);
				}


			},
			focus: function (event, ui){
				if(ui.item.value == "null"){
					$(this).val("");
					event.preventDefault();
					habilitarCampos();
					borrarCampos();
				}
				else{
					$(this).val(ui.item.label);
					event.preventDefault();
					borrarCampos(true);
					habilitarCampos();
					$("#codigoPersona").val(ui.item.value);
					$("#nombre").val(ui.item.nombre);
					$("#cedula").val(ui.item.cedula);
				}
			}
	});

}


function autoCompletarUniCurricular(){

	$(".uniCurricular").autocomplete({
			delay: 200,  //milisegundos
			minLength: 1,
			source: function( request, response ) {

				var a=Array("m_modulo"		,		"unidad",
							"m_accion"		,		"ListarUnidadesPorPenTraPatron",
							"patron"		,		request.term,
							"trayecto"		,		$("#trayectoEst").val(),
							"pensum"		,		$("#pensumEst").val(),
							"tipo"			,		$("#selectTipoUni").val()
							);

				ajaxMVC(a,function(data){
							return response(data);
						  },
						  function(data){
						  	console.log(data);
							return response([{"label": "Error de conexión", "value": {"nombreCorto":""}}]);

						   }
						);

			},
			select: function (event, ui){
				if(ui.item.value == "null"){
					$(this).val("");
					event.preventDefault();
					$("#codUni").val('');
					$("#detallePen").remove();

				}
				else{
					$(this).val(ui.item.label);
					event.preventDefault();
					var codigo =ui.item.value;
					verDetalle(codigo);
					$("#codUni").val(codigo);
				}


			},
			focus: function (event, ui){
				if(ui.item.value == "null"){
					$(this).val("");
					event.preventDefault();
					$("#codUni").val('');
					$("#detallePen").remove();

				}
				else{
					$(this).val(ui.item.label);
					event.preventDefault();
					var codigo =ui.item.value;
					$("#codUni").val(codigo);
					verDetalle(codigo);
				}
			}
	});
}

function verConvalidadasEstudiante(codigo,codConvalidacion){
	var arr= Array(
					"m_modulo" , "curso",
					"m_accion" , "convalidaciones",
					"codigo"   , codigo,
					"codConvalidacion", codConvalidacion
					);

	ajaxMVC(arr,succConvalidadas,errAjax);
}

function succConvalidadas(data){
	var cadena="";
	
	//alert(data.codConvalidacion);
	$("#convalida").remove();
	
	if(/*data.convalidaciones*/data.convalidaciones.toSource()){
		var codConvalidacion=data.codConvalidacion;
		$("#codigoPersona").val(data.codPersona);
		$("#convalida").remove();
		var dat=data.convalidaciones;
		var conNota="";
		var nota="";
		cad="<tbody id='convalida'>";
		for(var x=0; x<dat.length;x++){
			data=dat[x];
			if(data['con_nota']==true)
				conNota="SI";
			else
				conNota="NO";

			nota="";
			if(data['nota'])
				nota=data['nota'];
			else
				nota=" - ";

			if(codConvalidacion!=data['codigo'])
				cad+="	<tr class='pointer' id="+data['codigo']+" onclick='buscarConvalidacion("+data['codigo']+"); verConvalidadasEstudiante("+$("#codigoPersona").val()+","+data['codigo']+");'>";
			else{
				cad+="	<tr class='pointer' id="+data['codigo']+" onclick='buscarConvalidacion("+data['codigo']+"); 'style='background-color:#E5EAEE;'>";
			}

			cad+="	  <td>"+x+"</td>";
			cad+="	  <td>"+data['codigo']+"</td>";
			cad+="	  <td>"+data['nom_corto']+"</td>";
			cad+="	  <td>"+data['num_trayecto']+"</td>";
			cad+="	  <td>"+data['tipo']+"</td>";
			cad+="	  <td>"+data['nombre']+"</td>";
			cad+="	  <td>"+conNota+" "+nota+"</td>";
			if(data['descripcion'].length>25){
				var info=data['descripcion'].slice(0,25)+"...";
				cad+="	  <td>"+info+"</td>";
			}
			else
				cad+="	  <td>"+data['descripcion']+"</td>";
			cad+="	</tr>";
		}
	}
	cad+="</tbody>"
	$(cad).appendTo('#tablaConvalidaciones');
}

function buscarConvalidacion(codigo){
	var arr= Array(
					"m_modulo" , "curso",
					"m_accion" , "buscarConvalidacionCodigo",
					"codigo"   , codigo
					);
	ajaxMVC(arr,succBuscarConvalidacion,errAjax);
}

function succBuscarConvalidacion (data){

	if(data.convalidacion){
		dat=data.convalidacion[0];
		$("#nombre").val(dat['nompersona']);
		$("#codigoPersona").val(dat['cod_persona']);
		$("#cedula").val(dat['cedula']);
		$("#codConvalidacion").val(dat['codigo']);
		$("#selectTipoUni").val(dat['cod_tip_uni_curricular']);
		$("#fecha").val(dat['fechas']);
		if(dat['con_nota']==true){
			$("#si").prop("checked", true);
			$("#nota").val(dat['nota']);
			$("#nota").show();
		}
		else
			$("#no").prop("checked", true);
		$("#pensumEst").val(dat['cod_pensum']);
		$("#unidadCurricular").val(dat['nombre']);
		$("#descripcionText").val(dat['descripcion']);
		$("#codUni").val(dat['cod_uni_curricular']);
		verTrayecto();
		setTimeout(function(){
			$("#trayectoEst").val(dat['cod_trayecto']);
			$("#nombre").prop('disabled', true);
			$("#selectTipoUni").prop('disabled', true);
			$("#fecha").prop('disabled', true);
			$("#nota").prop('disabled', true);
			$("#si").prop('disabled', true);
			$("#no").prop('disabled', true);
			$("#pensumEst").prop('disabled', true);
			$("#unidadCurricular").prop('disabled', true);
			$("#trayectoEst").prop('disabled', true);

			$(".selectpicker").selectpicker("refresh");
	 	},200);


		verDetalle(dat['cod_uni_curricular']);
	}
}

function habilitarCampos(){
	//borrarCampos(true);
	$("#nombre").prop('disabled', false);
	$("#selectTipoUni").prop('disabled', false);
	$("#fecha").prop('disabled', false);
	$("#nota").prop('disabled', false);
	$("#si").prop('disabled', false);
	$("#no").prop('disabled', false);
	$("#pensumEst").prop('disabled', false);
	$("#unidadCurricular").prop('disabled', false);
	$("#trayectoEst").prop('disabled', false);
	$(".selectpicker").selectpicker("refresh");
}
function notaHide(){
	$("#nota").hide();
}

function notaShow(){
	$("#nota").show();
}

function errAjax(data){
	console.log(data);
	//alert(data.mensaje);
	mostrarMensaje("Error de comunicación con el servidor.",2);
}



function verDetalle(codigo){
	var arr = Array ("m_modulo","unidad",
	 				 "m_accion","buscarCodigoUnidadCurricular",
	 				 "codigo",codigo
	 				 );
	ajaxMVC(arr,consultarDetalleUni,errAjax);
}

function consultarDetalleUni(data) {
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
