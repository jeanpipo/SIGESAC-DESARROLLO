// ver detalle de la unidad curricular

function verDetalle(codigo){	
	var arr = Array ("m_modulo","unidad",
	 				 "m_accion","buscarCodigoUnidadCurricular",
	 				 "codigo",codigo);
	ajaxMVC(arr,consultarDetalleUni,errorBuscarUni); 
}


function errorBuscarUni(){mostrarMensaje("No se puede la unidad curricular en este momento",2);}


/*
consulta todo los detalles
*/

// ver los detalles
function consultarDetalleUni(data) {
	console.log(data)

	if (data.estatus>0){
		
	
		unidad=data.unidad[0];
	//	console.log(unidad);
		cadena="";
		$("#codigoUnidaLLenar").val(unidad[0]);

		cadena+="<div id='detallePen' class='third'>";
		cadena+="<table id='pesum' class='table table-bordered table-striped table-responsive' style='clear: both'><tbody>";
		cadena+="<tr><td style='width: 35%;''>Código:</td><td style='width: 65%;'><a href='#'' >"+unidad[0]+"</a></td></tr>";
		cadena+="<tr><td>Código de Ministerio:</td><td>";
		
		if(unidad[1] != null)
			cadena+="<a href='#'' >"+unidad[1]+"</a></td></tr>";
		else
			cadena+="<a href='#'>(N/A)</a></td></tr>";
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
		if (data.usada != null){
			usada = data.usada;
			cadena+="<tr><td>Usada en pensums:</td><td>";
			cadena+="<a href='#'' >";
			for (var i = 0; i < usada.length ; i++) {	
				cadena+=" ("+usada[i][0]+") ";
			}
			cadena+="</a></td></tr>";
		}else{
			cadena+="<tr><td>Usada en pensums:</td><td>";
			cadena+="<a href='#'' > No asiganado ningun pensum</a></td></tr>";
		}


		cadena+="</tbody></table></div>";
	//	$("#detallePen").html(cadena);
	//	alert(cadena);
		//$(cadena).appendTo('#detallePen');
		$("div.third").replaceWith(cadena);
	}
}


function verCoincidencia(busqueda){
	
	if (busqueda == 'Ministerio'){
	var arr = Array ("m_modulo","unidad",
	 				 "m_accion","buscarUniPorCoincidencia",
	 				 "patron",$("#codigoMinisterio").val(),
	 				 "accion", "0");
	}else if (busqueda == 'Descripcion'){

	var arr = Array ("m_modulo","unidad",
	 				 "m_accion","buscarUniPorCoincidencia",
	 				 "patron",$("#descripcion").val(),
	 				 "accion", "0");
	}else if (busqueda == 'Nombre'){

	var arr = Array ("m_modulo","unidad",
	 				 "m_accion","buscarUniPorCoincidencia",
	 				 "patron",$("#nombre").val(),
	 				 "accion", "0");
	}

		console.log(arr.toString())
	ajaxMVC(arr,verConsultarPatronUni,errorBuscarPatron); 
}


function errorBuscarPatron(){mostrarMensaje("No Puede mostar Coincidencias unidad curricular en este momento",2);}

function verConsultarPatronUni(data){
	var cadena="";

	console.log(data)
	
	var unidades = data["unidades"];
	
	if (data["unidades"] != null){
		cadena+=" <div class='trow' style='width:auto; height:200px; overflow:auto;'>";		                			
		cadena+="<table class='table table-hover mbn'><thead><tr class='active'><th># Código</th> <th>Código Ministerio</th><th>Nombre</th><th>Descripción</th></tr></thead>";
	    cadena+="<tbody> ";
	    for (var i = 0; i < unidades.length ; i++) {	    	
	    	 cadena+="  <tr class='active' href='#' onclick='verDetalleYCampos( "+ unidades[i][0]+ ")'><th># "+ unidades[i][0]+ "</th> <th>"+ unidades[i][1]+ "</th> <th>"+ unidades[i][2]+ "</th> <th>"+ unidades[i][3]+ "</th> </tr>";
	    };
	    cadena+=""
	    cadena+="</tbody></table></div>";
		$("div.trow").replaceWith(cadena);

	//console.log(data["unidades"].length)
	}else{
		cadena+=" <div class='trow' style='width:auto; height:200px; overflow:auto;'>";		                			
		cadena+="<table class='table table-hover mbn'><thead><tr class='active'><th># Código</th> <th>Código Ministerio</th><th>Nombre</th><th>Descripción</th></tr></thead>";
	    cadena+="<tbody> ";
		cadena+="<tr class='cuadro' style='background-color: rgb(255, 199, 52); position: initial;''>";
		cadena+="<td colspan='4'>NO HAY COINCIDENCIA</td>";
		cadena+="</tr>";
	    cadena+="</tbody></table></div>";

		$("div.trow").replaceWith(cadena);
	}
}

function verDetalleYCampos(codigo){
	verDetalle(codigo);
	//llenarCamposForm(codigo);
}

function llenarCamposForm(){

	var arr = Array ("m_modulo","unidad",
	 				 "m_accion","buscarCodigoUnidadCurricular",
	 				 "codigo",	$("#codigoUnidaLLenar").val());
	ajaxMVC(arr,setCampos,errorBuscarUni); 
}

function setCampos(data){
	//console.log('unidad');
	unidad=data.unidad[0];
//		console.log(unidad);
	$("#codigo").val(unidad["codigo"]);
	
	$("#codigoMinisterio").val(unidad["cod_uni_ministerio"]);
	$("#nombre").val(unidad["nombre"]);
	$("#unidadCredito").val(unidad["uni_credito"]);
	$("#descripcion").val(unidad["descripcion"]);
	$("#hta").val(unidad["hta"]);
	$("#hti").val(unidad["hti"]);
	$("#semanas").val(unidad["dur_semanas"]);
	$("#notaMin").val(unidad["not_min_aprobatoria"]);
	$("#notMaxima").val(unidad["not_maxima"]);
	$("#contenido").val(unidad["contenido"]);
	$("#observacion").val(unidad["observacion"]);
	
}

function setClear(){
	//console.log('unidad');	
//		console.log(unidad);
	$("#codigo").val('');
	$("#codigoMinisterio").val('');
	$("#nombre").val('');
	$("#unidadCredito").val('');
	$("#descripcion").val('');
	$("#hta").val('');
	$("#hti").val('');
	$("#semanas").val('');
	$("#notaMin").val('');
	$("#notMaxima").val('');
	$("#contenido").val('');
	$("#observacion").val('');	
}

function agregarModificar(){
	if (validarFrom()){
		if ($("#codigo").val() != ''){
			if (confirm("¿Desea modificar la unidad curricular ?")){
				var arr = Array (
				"m_modulo","unidad",
				"m_accion","preAgregModif",
				"codigo",$("#codigo").val(),
				"codMinisterio",$("#codigoMinisterio").val(),
				"nombre",$("#nombre").val(),
				"unidadesCredito",$("#unidadCredito").val(),
				"descripcion",$("#descripcion").val(),
				"hta",$("#hta").val(),
				"hti",$("#hti").val(),
				"duracionSemanas",$("#semanas").val(),
				"notaMinima",$("#notaMin").val(),
				"notaMaxima",$("#notMaxima").val(),
				"contenido",$("#contenido").val(),
				"observacion",$("#observacion").val()
				);	
				console.log(arr.toString())
				ajaxMVC(arr,succModificar,errorModifUnidad);	 
			}
		
	 	}else{
	 		
	 		var arr = Array (
		    "m_modulo","unidad",
		    "m_accion","preAgregModif",
			"codMinisterio",$("#codigoMinisterio").val(),
			"nombre",$("#nombre").val(),
			"unidadesCredito",$("#unidadCredito").val(),
			"descripcion",$("#descripcion").val(),
			"hta",$("#hta").val(),
			"hti",$("#hti").val(),
			"duracionSemanas",$("#semanas").val(),
			"notaMinima",$("#notaMin").val(),
			"notaMaxima",$("#notMaxima").val(),
			"contenido",$("#contenido").val(),
			"observacion",$("#observacion").val()
			);	

			console.log(arr.toString()) 
			ajaxMVC(arr,succAgregar,errorAgregandoUnidad);
	 	}
		
	
		
	}else{
		errorCamposInvalidos();
	}

}

function validarFrom(){
	var result = true;

		if(!validarRangos('#codigoMinisterio', 1, 40, true))
			return false;
		if(!validarRangos('#nombre', 1, 60, true))
			return false;
		if(!validarSoloNumeros('#unidadCredito', 1, 3, true))
			return false;
		if(!validarRangos('#descripcion', 0, 100, true))
			return false;
		if(!validarSoloNumeros('#hta', 1, 3, true))
			return false;
		if(!validarSoloNumeros('#hti', 1, 3, true))
			return false;
		if(!validarSoloNumeros('#semanas', 1, 3, true))
			return false;
		if(!validarSoloNumeros('#notaMin', 1, 3, true))
			return false;
		if(!validarSoloNumeros('#notMaxima', 1, 3, true))
			return false;
		if(!validarRangos('#observacion', 0, 100, false))
			return false;
		if(!validarRangosNotaMaxima())
			return false;

	return result;
}
// mensaje de agregar o modificar exito
function succAgregar(data){
	console.log(data)
	if (data.estatus>0){
		$("#codigo").val(data.Unidad);
		//mostrarMensaje("No se puede realizar operacion fallo del servicio", 3);
		mostrarMensaje("la unidad a sido agregada exitosamente",1);	
	//	mostrarMensaje("El pensum ha sido agregado satisfactoriamente!",1);
		
	}else{
		mostrarMensaje("No se puede realizar operacion fallo del servicio", 3);
	}
}

function succModificar(data){
	console.log(data)
	if (data.estatus>0){
		//mostrarMensaje("No se puede realizar operacion fallo del servicio", 3);
		mostrarMensaje("la unidad a sido modificada exitosamente",1);	
	//	mostrarMensaje("El pensum ha sido agregado satisfactoriamente!",1);
		//alert()		
	}else{
		mostrarMensaje("No se puede realizar operacion fallo del servicio", 3);
	}
}

function errorAgregandoUnidad(data){
	mensajeErrorDB(data,"Agregando Unidad Curricular");
}

function errorModifUnidad(data){
	mensajeErrorDB(data,"Modificando Unidad Curricular");
}

function errorCamposInvalidos(){mostrarMensaje("No se puede hacer el cambio Campos Invalidos",2);}

// redireciona el boton de edit a el formulario de agregar
function redirectEdit(codigo){
	  window.location="index.php?m_modulo=unidad&m_formato=html5&m_accion=preAgregarModif&m_vista=Agregar&codigo="+codigo;
}


/*Eliminar unidada*/
function  abrirDialogoElimiar(nombreDialogo,titulo,tipoAccion){
	$('.modal').remove();
	//$('#'+nombreDialogo).remove();
	crearDialogo(nombreDialogo,"<center>Eliminar Unidad</center>","",1,tipoAccion,"Aceptar");	
}


function eliminar(codigo){	
	if (confirm("¿Desea eliminar el la unidad curricular ?")){
		var arr = Array ("m_modulo","unidad",
						 "m_accion","eliminarUnidadCurricular",
						 "codigo", codigo);			
		console.log(arr.toString());

		ajaxMVC(arr,succEliminarUnidad,errorEliminarUnidad);
	}
}


function eliminarUnidad(codigo){
	abrirDialogoElimiar("dialogoUnidad","Eliminar Pensum","eliminar()");

	var arr = Array ("m_modulo","unidad",
	 				 "m_accion","buscarCodigoUnidadCurricular",
	 				 "codigo",codigo);

	ajaxMVC(arr,succObtenerU,error);
	
}

function succEliminarUnidad(data){
	console.log(data)
	if (data.estatus>0){
		mostrarMensaje(data.mensaje,1);
		$("#dialogoUnidad").modal('hide');	
		recargarUnidad();		
		
	}else{
		mostrarMensaje(data.mensaje,2);
	}	

}

function errorEliminarUnidad(data){mostrarMensaje("No se puede eliminar un unidad activos",2);}


// recargar listar

function recargarUnidad(){
	var arr = Array ("m_modulo", "unidad",
				     "m_accion", "listarUnidades");
	ajaxMVC(arr,actualizarLista,errorRecargar);
}

function errorRecargar(data){mostrarMensaje("Error al recargar la pagina",2);}


function verCoincidenciaLista(){
	
	var arr = Array ("m_modulo","unidad",
	 				 "m_accion","buscarUniPorCoincidencia",
	 				 "patron",$("#nombreLista").val(),
	 				 "accion","2");

	ajaxMVC(arr,actualizarLista,errorLista); 
}

function errorLista(){mostrarMensaje("Error en Lista",2);}

function actualizarLista(data){
	if(data.estatus>0){
		$('#tableTT').remove();		

		cadena="<table class='table table-hover mbn' id='tableTT'>";
		cadena+="<thead>";
	    cadena+="<tr class='active'>";
    	cadena+="<th>N° Cod </th>";
        cadena+="<th>Nombre Unidad </th>";       
	    cadena+="<th>  </th>";
	    cadena+="</tr></thead>";
		cadena+="<tbody>";
		if ( data.unidades != null ){
			for (i=0;i<data.unidades.length;i++){
				cadena+="<tr >";
					cadena+="<td><a href='#' onmouseover='verDetalle("+data.unidades[i]["codigo"]+")'>"+data.unidades[i]["codigo"]+"</a></td>";
					
					
					if(data.unidades[i]["cod_uni_ministerio"] != null)
						cadena+="<td><a href='#' onmouseover='verDetalle("+data.unidades[i]["codigo"]+")'>"+data.unidades[i]["nombre"]+" ("+data.unidades[i]["cod_uni_ministerio"]+")</a></td>";				
					else
						cadena+="<td><a href='#' onmouseover='verDetalle("+data.unidades[i]["codigo"]+")'>"+data.unidades[i]["nombre"]+" (N/A)</a></td>";
					
					cadena+="<td style='padding-left: 0px; padding-right: 0px; min-width: 54px;'>";
						cadena+="<button class='btn btn-xs btn-info' title='Modificar la Unidada Curricular' onclick='redirectEdit("+data.unidades[i]["codigo"]+")'>";
							cadena+="<i class='icon-pencil'></i>";
						cadena+="</button>";
						cadena+="<button class='btn btn-xs btn-danger' title='Eliminar Unidad' onclick='eliminar("+data.unidades[i]["codigo"]+")' title='Eliminar Unidad'>";
							cadena+="<i class='icon-remove'></i>";
						cadena+="</button>";
					cadena+="</td>";
				cadena+="</tr>";
			}
		}else{
				cadena+="<tr >";
				cadena+="<td colspan='3'> No hay Coincidencias de Unidad</td>";
			
			cadena+="</tr>";
		}
		cadena+="</tbody></table>";
		$(cadena).appendTo("#listarI");
		console.log(cadena);
	
	}else{ 
		$('#tableTT').remove();		
		cadena="<table class='table table-hover mbn' id='tableTT'>";
		cadena+="<thead>";
	    cadena+="<tr>";
    	cadena+="<th>N° Código</th>";
        cadena+="<th>Nombre Unidad Curricular</th>";
        cadena+="<th>Descripcion</th>";
        cadena+="<th>Modificar</th>";
	    cadena+="<th>Eliminar</th>";
	    cadena+="</tr></thead>";
		cadena+="<tbody>";

			cadena+="<tr >";
				cadena+="<td colspan='5'> No hay Coincidencias de Unidad</td>";
			
			cadena+="</tr>";
	
		cadena+="</tbody></table>";

		$(cadena).appendTo("#listarI");
	
	}
}




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


function validarRangosNotaMaxima(){
	$(".popover").hide();
	var min = $("#notaMin").val();
	var max = $("#notMaxima").val();

	if(min > max){
		detonarAdvertencia("#notaMin","la nota minima no puede ser mayor (>) a nota maxima .");
		return false;
	}

	return true;
}





