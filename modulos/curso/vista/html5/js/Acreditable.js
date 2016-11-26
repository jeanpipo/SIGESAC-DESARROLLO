
setSelectss ();
activarCal();
function setSelectss (){
	var arr = Array("m_modulo","instituto");

	ajaxMVC(arr,succSetSelect,errAjaxs);
}
function succSetSelect(data){
	verPensumAcreditable(data.datos);
}
function borrarAcreditable(){
	var arr=Array("m_modulo"	,		"curso",
				  "m_accion"	,		"borrarAcreditable",
				  "codigo"		,		$("#codigoHAcreditable").val()				  
				);

	ajaxMVC(arr,succBorrarAcreditable,errorAjax);
	
}

function succBorrarAcreditable(data){
	if(data.estatus<0 )
		mostrarMensaje("No se pudo eliminar la acreditacion.",2);
	else{
		buscarAcreditadas($("#codEstudiante").val());
		limpiarCamposAcreditable();
		mostrarMensaje("La acreditacion se ha eliminidado.",1);
	}
}
function autocompletarEstudiante(){

	$(".estudiante").autocomplete({
			delay: 200,  //milisegundos
			minLength: 1,
			source: function( request, response ) {
				var a=Array("m_modulo"	,	"estudiante",
							"m_accion"	,	"buscarEstudiante",
							"estado"	,	"A",
							"mostrarCedula"	,	"true",
							"patron"	,	$("#estudiante").val()
							);

				ajaxMVC(a,function(data){
					//alert(JSON.stringify(data.datos));
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
					borraCamposAcreditable();
				}
				else{
					$(this).val(ui.item.label);
					event.preventDefault();
					$("#codEstudiante").val(ui.item.value);
					buscarAcreditadas(ui.item.value);					
				}

			},
			focus: function (event, ui){
				if(ui.item.value == "null"){
					$(this).val("");
					event.preventDefault();
					borraCamposAcreditable();
				}
				else{
					$(this).val(ui.item.label);
					event.preventDefault();
					$("#codEstudiante").val(ui.item.value);
				}
			}
	});
}
function verPensumAcreditable (datos){
	
	var arr=Array("m_modulo"	,		"pensum",
				  "m_accion"	,		"buscarPorInstituto",
				  "codigo"		,		datos[0]['emp_inst']				  
				);

	ajaxMVC(arr,succPensumAcreditable,errorAjax);
}
function succPensumAcreditable(data){

	var cad ='';
	$("#IdPensumAcreditable").remove();
	cad="<div id='IdPensumAcreditable'> Pensum";
	cad+= "<select onchange='verTrayectoAcreditable();'class='selectpicker' id='pensumDeAcreditable' title='Pensum' data-live-search='true' data-size='auto' data-max-options='12' >";
	cad+= "<option value='-1' >Seleccionar</option>";
	if(data.pensum){			
		for(var x=0; x<data.pensum.length;x++){
			
			if(data.datos[0]['emp_pensum']!=data.pensum[x]['codigo'])
				cad+= "<option value='"+data.pensum[x]['codigo']+"' >"+data.pensum[x]['nom_corto']+"</option>";
			else
				cad+= "<option value='"+data.pensum[x]['codigo']+"' selected>"+data.pensum[x]['nom_corto']+"</option>";
		}
	}
	cad+="</select>";
	cad+="</div>";
	$(cad).appendTo('#pensumAcreditable');
	activarSelect();

	verTrayectoAcreditable(data.datos[0]['emp_pensum']);
}

function verTrayectoAcreditable(){
	
	var arr=Array("m_modulo"	,		"trayecto",
				  "m_accion"	,		"listarTrayectoPensum",
				  "codigo"		,		$("#pensumDeAcreditable").val()
				);

	ajaxMVC(arr,succTrayectoAcreditable,errorAjax);

}

function succTrayectoAcreditable(data){
	var cad ='';
	$("#IdTrayectoAcreditable").remove();

	cad="<div id='IdTrayectoAcreditable'> Trayecto";
	cad+= "<select class='selectpicker' id='trayectoDeAcreditable' title='trayecto' data-live-search='true' data-size='auto' data-max-options='12' >";
	cad+= "<option value='-1' >Seleccionar</option>";
	if(data.trayecto){
		for(var x=0; x<data.trayecto.length;x++){
			cad+= "<option value='"+data.trayecto[x]['codigo']+"' >"+data.trayecto[x]['num_trayecto']+"</option>";
		}
	}
	cad+="</select>";
	cad+="</div>";
	$(cad).appendTo('#trayectoAcreditable');
	activarSelect();
}

function buscarAcreditadas(codEstudiante){
	var arr=Array("m_modulo"	,		"curso",
				  "m_accion"	,		"buscarAcreditadas",
				  "codEstudiante",		codEstudiante
				);
	ajaxMVC(arr,succBuscarAcreditadas,errorAjax);
}

function succBuscarAcreditadas(data){

	$("#listarAcreditable").remove();
	var cad="";
	cad="<tbody id='listarAcreditable' style='text-align:center;' >";
	if(data.acreditadas){
		var id="";
		for(var x=0; x<data.acreditadas.length;x++){
			var dat=data.acreditadas[x];
			id=x+"Electiva";
			cad+="	<tr class='pointer' id='"+x+"Electiva' onclick='buscarAcreditable("+dat['codigo']+"); seleccionarFila(\""+id+"\",\""+data.acreditadas.length+"\",\""+dat['codigo']+"\");'>";
			
			cad+="	  <td>"+(x+1)+"</td>";
			cad+="	  <td>"+dat['codigo']+"</td>";
			cad+="	  <td>"+dat['pensum']+"</td>";
			if(dat['trayecto'] || dat['trayecto']==0)
				cad+="	  <td>"+dat['trayecto']+"</td>";
			else
				cad+="	 <td> - </td>";
			if(dat['uni_credito'])
				cad+="	  <td>"+dat['uni_credito']+"</td>";
			else
				cad+="	 <td> - </td>";
			if(dat['fecha'])
				cad+="	  <td>"+dat['fecha']+"</td>";
			else
				cad+="	 <td> - </td>";
			if(dat['descripcion'])
				cad+="	  <td>"+dat['descripcion']+"</td>";
			else
				cad+="	 <td> - </td>";
			cad+="	</tr>";       		
		}
	}
	cad+="</tbody>";
	$(cad).appendTo('#tablaAcreditable');
	
}

function buscarAcreditable(codigo){
	var arr=Array("m_modulo"	,		"curso",
				  "m_accion"	,		"buscarUnaAcreditable",
				  "codigo"		,		codigo
				);

	ajaxMVC(arr,succBuscarAcreditable,errorAjax);
}

function succBuscarAcreditable(data){
	
	if(data.acreditada){
		data=data.acreditada[0];
		$("#pensumDeAcreditable").val(data['cod_pensum']);
		$("#pensumDeAcreditable").selectpicker("refresh");		
		$("#codigo").val(data['codigo']);
		$("#unidadCredito").val(data['uni_credito']);
		$("#fecha").val(data['fecha']);			
		$("#observacion").val(data['descripcion']);
		verTrayectoAcreditable();
		setTimeout(function(){
			$("#trayectoDeAcreditable").val(data['cod_trayecto']);
			$("#trayectoDeAcreditable").selectpicker("refresh");
		},200);
	}

}

function limpiarCamposAcreditable(){
	$("#codigo").val("");
	$("#unidadCredito").val("");
	$("#fecha").val("");	
	$("#pensumDeAcreditable").val("-1");
	$("#pensumDeAcreditable").selectpicker("refresh");
	$("#trayectoDeAcreditable").val("-1");
	$("#trayectoDeAcreditable").selectpicker("refresh");	
	$("#observacion").val("");
}
function limpiarTodosCamposAcreditable(){
	$("#codigo").val("");
	$("#unidadCredito").val("");
	$("#fecha").val("");	
	$("#pensumDeAcreditable").val("-1");
	$("#pensumDeAcreditable").selectpicker("refresh");
	$("#trayectoDeAcreditable").val("-1");
	$("#trayectoDeAcreditable").selectpicker("refresh");	
	$("#observacion").val("");
	$("#estudiante").val("");
	$("#codEstudiante").val("");
}

function preGuardarAcreditable(){
	validacion=true;
	if(!$("#codEstudiante").val().trim()){
		validacion=false;
		mostrarMensaje("Debe escoger un estudiante.",2);
	}
	else if(!$("#estudiante").val().trim()){
		validacion=false;
		mostrarMensaje("Debe escoger un estudiante.",2);
	}
	else if(!$("#unidadCredito").val().trim()){
		validacion=false;
		mostrarMensaje("Debe introducir las unidades de credito.",2);
	}
	else if(!($("#unidadCredito").val().trim()>=1 && $("#unidadCredito").val().trim()<=10)){
		validacion=false;
		mostrarMensaje("las unidades de credito debe ser entre 1 unidad de credito hasta 10 unidades de credito.",2);
	}
	else if($("#pensumDeAcreditable").val()==-1){
		validacion=false;
		mostrarMensaje("Debe elegir un pensum.",2);
	}
	else if($("#trayectoDeAcreditable").val()==-1){
		validacion=false;
		mostrarMensaje("Debe elegir un trayecto.",2);
	}
	else if(!$("#fecha").val().trim()){
		validacion=false;
		mostrarMensaje("Debe .",2);
	}
	else if($("#fecha").val().trim()){
		var fecha =$("#fecha").val().trim().split("/");
		var f = new Date();
		var fechActual=f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
		
		fechActual=fechActual.split("/");
		fecha= new Date(fecha[2],fecha[1],fecha[0]);
		fechActual=new Date(fechActual[2],fechActual[1],fechActual[0]);
		if(fechActual<=fecha){
			validacion=false;
			mostrarMensaje("La fecha de inicio no puede ser mayor a la fecha fin.",2);
		}
	}

	if(validacion)
		guardarAcreditable();
}

function guardarAcreditable(){
	var arr=Array("m_modulo"	,		"curso",
				  "m_accion"	,		"guardarAcreditada",
				  "cod_estudiante",		$("#codEstudiante").val(),
				  "cod_pensum",			$("#pensumDeAcreditable").val(),
				  "cod_trayecto",		$("#trayectoDeAcreditable").val(),
				  "uni_credito",		$("#unidadCredito").val(),
				  "fecha",				$("#fecha").val(),	
				  "descripcion",		$("#observacion").val()	,
				  "codigo"		,		$("#codigo").val()			  
				);
	ajaxMVC(arr,succGuardarAcreditable,errorAjax);
}

function succGuardarAcreditable(data){

	if(data.estatus<0 )
		mostrarMensaje("No se pudo acreditar.",2);
	else{
		buscarAcreditadas($("#codEstudiante").val());
		$("#codigo").val(data.acreditada);
		mostrarMensaje("La acreditacion se realizo con exito.",1);
	}
}

	

function seleccionarFila(idFila,nFilas,codElectiva){
	for(var x=0;x<nFilas;x++){
		$("#"+x+"Electiva").css("background-color","#F4F7F9");
	}
	$("#codigoHAcreditable").val(codElectiva);
	$("#"+idFila).css("background-color","#E5EAEE");
}
function errorAjax(){
	console.log(data);
	//alert(data.mensaje);
	mostrarMensaje("Error de comunicación con el servidor.",2);
}

