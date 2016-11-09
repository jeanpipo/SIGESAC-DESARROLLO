
function errorLista(data){
mostrarMensaje("Error Cargando Lista consultar LOG",2);
console.log(data);}


function errorDetalle(data){
mostrarMensaje("Error Cargando detalle consultar LOG",2);
console.log(data);}



function CargarTrayectosPorPensum(){

	var arr = Array("m_modulo"		,	"pensum",
					"m_accion"		,	"buscarPorTrayecto",
					"codigo" 		, 	$("#codigoPensum").val());

//	console.log(arr.toString())
	ajaxMVC(arr,succCargarList,errorLista);
}

function CargarTrayectosPorPatron(){

	var arr = Array("m_modulo"		,	"trayecto",
					"m_accion"		,	"obtenerPorPatron",
					"codigo" 		, 	$("#codigoPensum").val(),
					"patron"		,	$("#Patron").val()
					);

	console.log(arr.toString())
	ajaxMVC(arr,succCargarList,errorLista);
}




function succCargarList(data){
	var cadena="";
	console.log(data)
	var trayectos = data["pensum"];
//	console.log(trayectos)
	if (data["pensum"] != null){
		cadena+=" <div class='trow' style='width:100%; height:200px; overflow:auto;'>";		                			
		cadena+="<table class='table table-hover mbn'><thead><tr class='active'><th>#N°</th> <th>N° de trayecto</th><th colspan='2'>Certificado</th><th></th></tr></thead>";
	    cadena+="<tbody> ";
	    for (var i = 0; i < trayectos.length ; i++) {	    	
	    	 cadena+="  <tr class='active' href='#' onclick='verDetalleTrayecto( "+ trayectos[i][0]+ ")'><td># "+ i+ "</td> <td>"+ trayectos[i][1]+ "</td> <td colspan='2'>"+ trayectos[i][2]+ "</td> <td></td> </tr>";
	    };
	    cadena+=""
	    cadena+="</tbody></table></div>";
		$("div.trow").replaceWith(cadena);

	//console.log(data["trayectos"].length)
	}//else{
		///cadena=" Hola mundo";

		//$("div.trow").replaceWith(cadena);
	//}
}


function verDetalleTrayecto(codigo){	
	var arr = Array ("m_modulo","trayecto",
	 				 "m_accion","verTrayecto",
	 				 "codigo",codigo);
	ajaxMVC(arr,consultarDetalleUni,errorDetalle); 
}

// ver los detalles
function consultarDetalleUni(data) {
	console.log(data)
	if (data.estatus>0){
		
		unidad=data.trayecto[0];
	//	console.log(unidad);
		cadena="";
		
		cadena+="<div id='detallePen' class='third'>";
		cadena+="<table id='pesum' class='table table-bordered table-striped' style='clear: both'><tbody>";
		cadena+="<tr><td style='width: 35%;''>Código:</td><td style='width: 65%;'><a href='#'' >"+unidad[0]+"</a></td></tr>";
		cadena+="<tr><td>Código de pesum:</td><td>";
		cadena+="<a href='#'' >"+unidad[1]+"</a></td></tr>";
		cadena+="<tr><td>Número de Trayecto:</td><td>";
		cadena+="<a href='#'' >"+unidad["num_trayecto"]+"</a></td></tr>";		
		cadena+="<tr><td>Certificado (HTA):</td><td>";
		cadena+="<a href='#'' >"+unidad["certificado"]+"</a></td></tr>";
		cadena+="<tr><td>Mínima crédito obligatorio:</td><td>";
		cadena+="<a href='#'' >"+unidad["min_cre_obligatoria"]+"</a></td></tr>";	
		cadena+="<tr><td>Mínimo crédito electiva:</td><td>";
		cadena+="<a href='#'' >"+unidad["min_cre_electiva"]+"</a></td></tr>";	
		cadena+="<tr><td>Mínimo crédito Acreditable</td><td>";
		cadena+="<a href='#'' >"+unidad["min_cre_acreditable"]+"</a></td></tr>";
		cadena+="<tr><td>Minimo cantidad de electivas :</td><td>";
		cadena+="<a href='#'' >"+unidad["min_can_electiva"]+"</a></td></tr>";	


		cadena+="</tbody></table></div>";
	//	$("#detallePen").html(cadena);
	//	alert(cadena);
		//$(cadena).appendTo('#detallePen');
		$("div.third").replaceWith(cadena);
		$("#codigoTrayectoL").val(unidad[0]);
	//	alert( $("#codigoTrayectoL").val());
		$( "#bloqEliEdit" ).removeClass( "inactivoA" );
	}
}


function setClear(){

	$("#codigo").val("");
	$("#codigoPensum").val("");
	$("#numeroTrayecto").val("");
	$("#certificado").val("");
	$("#min_cre_oblig").val("");
	$("#min_cre_elect").val("");
	$("#min_cre_acre").val("");
	$("#min_cant_elect").val("");
}

function agregarTrayecto(){
	if ($("#codigo").val() != ''){
			var arr = Array("m_modulo"		,	"trayecto",
					"m_accion"				,	"preAgreModif",
					"codigo"				,	$("#codigo").val(),
					"cod_pensum" 			, 	$("#codigoPensum").val(),
					"num_trayecto"			,   $("#numeroTrayecto").val(), 
					"certificado"   		,   $("#certificado").val(),
					"min_cre_obligatoria" 	,   $("#min_cre_oblig").val(),
					"min_cre_electiva" 		,   $("#min_cre_elect").val(),
					"min_cre_acreditable"  	,   $("#min_cre_acre").val(),
					"min_can_electiva"		,   $("#min_cant_elect").val()
					);

			console.log(arr.toString())
			ajaxMVC(arr,succeditarTrayecto,errorEdit);
	}else{
			var arr = Array("m_modulo"	,	"trayecto",
							"m_accion"			,	"preAgreModif",					
							"cod_pensum" 		, 	$("#codigoPensum").val(),
							"num_trayecto"		,   $("#numeroTrayecto").val(), 
							"certificado"   	,   $("#certificado").val(),
							"min_cre_obligatoria" ,   $("#min_cre_oblig").val(),
							"min_cre_electiva" 	  ,   $("#min_cre_elect").val(),
							"min_cre_acreditable" ,   $("#min_cre_acre").val(),
							"min_can_electiva"	  ,   $("#min_cant_elect").val()
						);
			console.log(arr.toString())
			ajaxMVC(arr,ssAgregar,errorAgregar);
	}

	console.log(arr.toString())
	
}

function ssAgregar(data){
	console.log(data);
	//alert(data.trayecto);
	if(data.estatus > 0){
		$("#codigo").val(data.trayecto);
		mostrarMensaje("Exito agregando trayecto consultar LOG",1);
		CargarTrayectosPorPensum();
		//verDetalleTrayecto();
	}else{
		mostrarMensaje("Error agregando trayecto consultar LOG",2);	
	}
}

function errorAgregar(data){
	console.log(data)
	console.log(data.responseText);	
	mostrarMensaje("Error agregando trayecto consultar LOG",2);
}

function errorEdit(data){
	console.log(data)
	console.log(data.responseText);	
	mostrarMensaje("Error editando trayecto consultar LOG",2);
}

function ConsultarTrayectoEdit(){	
	var arr = Array ("m_modulo","trayecto",
	 				 "m_accion","verTrayecto",
	 				 "codigo",  $("#codigoTrayectoL").val());
	ajaxMVC(arr,SetTrayecto,errorDetalle); 
}


function SetTrayecto(data){
	console.log(data);
	trayecto = data.trayecto[0];

	$("#codigo").val(trayecto.codigo);
	$("#codigoPensum").val(trayecto.cod_pensum);
	$("#numeroTrayecto").val(trayecto.num_trayecto);
	$("#certificado").val(trayecto.certificado);
	$("#min_cre_oblig").val(trayecto.min_cre_obligatoria);
	$("#min_cre_elect").val(trayecto.min_cre_electiva);
	$("#min_cre_acre").val(trayecto.min_cre_acreditable);
	$("#min_cant_elect").val(trayecto.min_can_electiva);
}

function succeditarTrayecto(data){
	//$("#codigo").val(data.trayecto);
	if(data.estatus > 0){
		mostrarMensaje("Exito Edito con exito trayecto ",1);
		CargarTrayectosPorPensum();
		verDetalleTrayecto($("#codigo").val());
	}else{
		mostrarMensaje("Error editando trayecto consultar LOG",2);
	}

}

function eliminarTrayecto(){
	if (confirm("¿Desea eliminar el siguiente trayecto ?")){
		var arr = Array ("m_modulo","trayecto",
						 "m_accion","eliminarTrayecto",
						 "codigo", $("#codigoTrayectoL").val());

		console.log(arr.toString());			
		ajaxMVC(arr,succEliminando,errorEliminando);
	}
}

function succEliminando(data){	
	console.log(data);	
	if(data.estatus>0){
		mostrarMensaje(data.mensaje,1);
	//	mostrarMensaje("Exito Eliminando trayecto",1);
		CargarTrayectosPorPensum();
		cadena="";
		cadena+="<div id='detallePen' class='third'>";
		cadena+=" <div class='alert alert-alert' style='margin-top: 22px; position: inherit;''> No ha selecionado ningún Trayecto</div></div>";
	//	$("#detallePen").html(cadena);
	//	alert(cadena);
		//$(cadena).appendTo('#detallePen');
		$("div.third").replaceWith(cadena);
	}
	else 
		mostrarMensaje(data.mensaje,2);
}

function errorEliminando(data){	
	console.log(data.responseText);	
}

function consultarPorPatron(){
	var data = $("#Patron").val();

	if (data != ''){
		CargarTrayectosPorPatron();
	}else{
		CargarTrayectosPorPensum();
	}

}


function cargarUnidadCurricular(){
		var arr = Array("m_modulo"		,		"unidad",
					"m_accion"		,		"buscarUniCurricularPorPensum",
					"codigo" 		, 	$("#codigoPensum").val()
					);

	ajaxMVC(arr,ssccCargaUnidadesC,err);
}





function ObtenerIDPensum(){
	var loc = document.location.href;	
	var getString = loc.search("codigoPensum");	
	 if (getString != -1){
       	 getString+=13;
	     var a = loc.substring(getString,getString+25);
	     console.log(a);
	     $("#codigoPensum").val(a);
	     return a;
	   }else{
	//   	alert('No posee codigo Pensum en url');
	   	return 'not';
	   }
}


function modificarURL(codigoPensum, formulario){
	if (formulario == 'info'){
		$("#steps-uid-0-t-T").attr("href", "index.php?m_modulo=pensum&m_formato=html5&m_accion=mostrar&m_vista=Trayecto&codigoPensum="+codigoPensum);
		$( "#steps-uid-0-t-T" ).removeClass( "inactivoA" );
		$("#steps-uid-0-t-U").attr("href", "index.php?m_modulo=pensum&m_formato=html5&m_accion=mostrar&m_vista=UnidadesCurricular&codigoPensum="+codigoPensum);
		$( "#steps-uid-0-t-U" ).removeClass( "inactivoA" );
		$("#steps-uid-0-t-P").attr("href", "index.php?m_modulo=pensum&m_formato=html5&m_accion=mostrar&m_vista=Prelacion&codigoPensum="+codigoPensum);
		$( "#steps-uid-0-t-P" ).removeClass( "inactivoA" );

	}else if (formulario == 'tray'){

		$("#steps-uid-0-t-I").attr("href", "index.php?m_modulo=pensum&m_formato=html5&m_accion=preModif&m_vista=Agregar&codigoPensum="+codigoPensum);				
		$("#steps-uid-0-t-U").attr("href", "index.php?m_modulo=pensum&m_formato=html5&m_accion=mostrar&m_vista=UnidadesCurricular&codigoPensum="+codigoPensum);
		$("#steps-uid-0-t-P").attr("href", "index.php?m_modulo=pensum&m_formato=html5&m_accion=mostrar&m_vista=Prelacion&codigoPensum="+codigoPensum);
		
	}else if (formulario == 'uni'){

	}else if (formulario == 'pre'){

	}
};



function mensajeErrorDB(cadena,mensaje){
	var data = cadena.responseText;
	console.log(data)
	  var ClaveForenea = data.search("23503");
	  if (ClaveForenea != -1){
	  	mostrarMensaje("Violacion de Clave Foranea "+mensaje,2);
	  }
	  var ClaveUnica = data.search("23505");
	  if(ClaveUnica != -1){
	  	mostrarMensaje("Violacion de Clave Unica Violada "+mensaje,2);
	  }
	  var ValorNoNULL = data.search("23502");
	  if(ValorNoNULL != -1){
	  	mostrarMensaje("Violacion de No Null"+mensaje,2);
	  }
	  var ViolacionCheke = data.search("23514");
	  if(ViolacionCheke != -1){
	  	mostrarMensaje("Violacion de una check_violation "+mensaje,2);
	  }

}