

function  abrirDialogoElimiar(nombreDialogo,titulo,tipoAccion){
	$('.modal').remove();
	//$('#'+nombreDialogo).remove();
	crearDialogo(nombreDialogo,"<center>Eliminar Pensum</center>","",1,tipoAccion,"Aceptar");	
}


function administrarPensum(){
	crearDialogo("preagregarpensum","<center>Agregar Pensum</center>","",1,"validarAgregarPensum()","Agregar Pensum");
	$("<div class='row'><div class='col-md-12'><div id='pensumA'></div></div></div>").appendTo("#preagregarpensum .modal-body");
	$("#pensumA").load("modulos/pensum/vista/html5/js/FormularioPensum.php",function(){activarSelect();});	
	//$('#preagregarpensum').modal('show');						
}

function validarAgregarPensum(){
	if(validarSoloTexto("#nombre",5,60,true))
	{agregarPensum();}
}

function agregarPensum(){	
	if ($("#codigo").val() != ''){
	var arr = Array ("m_modulo", "pensum",
					 "m_accion", "preModifAgre",
					 "codigo", $("#codigo").val(),
					 "nombre", $("#nombre").val(),
					 "nom_corto", $("#nom_corto").val(), 
					 "observaciones", $("#observaciones").val(),
					 "minCanElectiva", $("#min_cant_elect").val(),
					 "minCreElectiva", $("#min_cre_elect").val(),
					 "minCreObli",$("#min_cre_oblig").val(),
					 "fecha",$("#fecha").val()

					 );
	ajaxMVC(arr,succAgregarPensum,errorModificandoPensum);
	}else{
	var arr = Array ("m_modulo", "pensum",
				 "m_accion", "preModifAgre",				
				 "nombre", $("#nombre").val(),
				 "nom_corto", $("#nom_corto").val(), 
				 "observaciones", $("#observaciones").val(),
				 "minCanElectiva", $("#min_cant_elect").val(),
				 "minCreElectiva", $("#min_cre_elect").val(),
				 "minCreObli",$("#min_cre_oblig").val(),
				 "fecha",$("#fecha").val()

				 );
	ajaxMVC(arr,succAgregarPensum,errorAgregarPensum);
	}
	console.log(arr.toString());
	

}

function succAgregarPensum(data){
	console.log(data)
	if (data.estatus>0){		
		//pensums=data.pensum; 	
		$("#codigo").val(data.pensum)
		mostrarMensaje("El pensum ha sido agregado satisfactoriamente!",1);		
		modificarURL(data.pensum, 'info');
	}
}

function errorModificandoPensum(data){
	console.log(data.responseText)
		mensajeErrorDB(data,"Tratando de Modificar pensum");
}

function errorAgregarPensum(data){
	console.log(data.responseText)
	mensajeErrorDB(data,"Tratando de Agregar pensum");
 }


function eliminarPensum(codigo){
	// abrirDialogoElimiar("dialogoPensum","Eliminar Pensum","eliminar()");
	if (confirm("¿Desea Eliminar este Pensum ?")){
	var a=Array("m_modulo","pensum",
				"m_accion","eliminar",
				 "codigo",codigo);
	ajaxMVC(a,succEliminarPensum,errorEliminar);
	}
}

function errorEliminar(data){	
		mensajeErrorDB(data,"Tratando de eliminar pensum");
}

function succEliminarPensum(data){
	if (data.estatus>0){
		mostrarMensaje(data.mensaje,1);
		$("#dialogoPensum").modal('hide');	
		recargarPensum();		
		
	}	

}

function verPensum(codigo){	
	var arr = Array ("m_modulo","pensum",
	 				 "m_accion","buscarPensum",
	 				 "codigo",codigo);
	ajaxMVC(arr,succBuscarPensum,errorBuscarPensum); 
}

function succBuscarPensum(data){
	if (data.estatus>0){
		$(".modal").remove();
		pensums=data.pensum;
		crearDialogo("verPensum","<center>"+pensums[0]['nombre']+"</center>","<center>Informacion del Pensum</center>",1,"modificar()","")
		$("<div class='row'><div class='col-md-12'><div id='pensumV'></div></div></div>").appendTo("#verPensum .modal-body");
		$("#pensumV").load("modulos/pensum/vista/html5/js/VerPensum.php",function(){montarPensum(pensums);});
		$('#verPensum').modal('show');
	}
}


function errorBuscarPensum(){mostrarMensaje("No se puede el pensum en este momento",2);}

function activarPensum(){
	$('#nombre').attr('disabled',false);
	$('#nom_corto').attr('disabled',false);
	$('#observaciones').attr('disabled',false); 
	$(".modal .btn-danger").remove();
    $(".modal-footer").append("<button class='btn btn-success' onclick='validarModificar()'>Guardar Pensum</button>");
    $(".modal-footer").append("<button class='btn btn-danger' data-dismiss='modal' type='button'>Cerrar</button>"); 
    $("#BotonModificar").remove();
}	

function validarModificar(){
	if(validarSoloTexto("#nombre",5,60,true) && validarSoloTexto("#nom_corto",2,6,true))
	{modificar();}
}

function modificar(){
	console.log('llamado');
	if (confirm("¿Desea modificar el siguiente pensum?")){

		var arr = Array ("m_modulo", "pensum",
					 "m_accion", "modificar",
					 "codigo", $("#codigo").val(),
					 "nombre", $("#nombre").val(),
					 "nom_corto", $("#nom_corto").val(), 
					 "observaciones", $("#observaciones").val(),
					 "minCanElectiva", $("#min_cant_elect").val(),
					 "minCreElectiva", $("#min_cre_elect").val(),
					 "minCreObli",$("#min_cre_oblig").val(),
					 "fecha",$("#fecha").val()

					 );
		console.log(arr.toString());
/*		var arr = Array ("m_modulo", "pensum",
					 "m_accion", "modificar",
					 "codigo",$("#codigo").val(),
					 "nombre", $("#nombre").val(),
					 "nom_corto", $("#nom_corto").val(), 
					 "observaciones", $("#observaciones").val());*/
		ajaxMVC(arr,succModificar,errorModificar);
	}
	else 
	return false;
}

function succModificar(data){
	//alert('ok')
	if (data.estatus>0){
		$("#verPensum").modal('hide');
		mostrarMensaje(data.mensaje,1);
		recargarPensum();
	}
}

function errorModificar(){mostrarMensaje("Problema al modificar",2);}

function agregarInfPen(codigo){
	var arr = Array ("m_modulo","pensum",
					 "m_accion","buscarPensum",
					 "codigo",codigo);
	ajaxMVC(arr,succInfoPen,errorInfoPen); 

	console.log(arr);
}

function succInfoPen(data){
	console.log(data);
	if (data.estatus>0){
		$(".modal").remove()
		pensums=data.pensum;
		crearDialogo("infoPensum","<center>"+pensums[0]['nombre']+"</center>","<center>Nombre Abreviado del Pensum: "+pensums[0]['nom_corto']+"<center>",1,"modificar()","Modificar Pensum")
		
		$("<div class='row'><div class='col-md-12'><div id='pensumV'></div></div></div>").appendTo("#infoPensum .modal-body");
		$("#pensumV").load("modulos/pensum/vista/html5/js/FormularioPensumEdit.php",function(){
			infoEditPensum(pensums[0]);
		});
		$('#infoPensum').modal('show');
	}
}

function errorInfoPen(){mostrarMensaje("No se pudo agregar el pensum en este momento");}

function infoEditPensum(data){
	console.log(data);
	$("#codigo").val(data["codigo"])
	$("#nombre").val(data["nombre"])
	$("#nom_corto").val(data["nom_corto"]); 
    $("#min_cant_elect").val(data["min_can_electiva"]);
	$("#min_cre_elect").val(data["min_cre_electiva"]);
	$("#min_cre_oblig").val(data["min_cre_obligatoria"]);
	$("#fecha").val(data["fec_creacion"]);
	$("#observaciones").val(data["observaciones"]);
}



function buscarListar(patron){
	var arr = Array("m_modulo"	,	"pensum",
					"m_accion"	,	"listar",
					"patron"	,	patron);
	ajaxMVC(arr,successListarAjax,errorListarAjax);
}

function successListarAjax(data){
	if(data.estatus > 0){
		recargar(data.pensum);
	}
}

function errorListarAjax(data){}

function recargarPensum(){
	var arr = Array ("m_modulo", "pensum",
				     "m_accion", "listar");
	ajaxMVC(arr,actualizarLista,errorRecargarPensum);
}

function errorRecargarPensum(data){mostrarMensaje("Error al recargar la pagina",2);}

function actualizarLista(data){
	console.log(data);
	if(data.estatus>0){
		$('#table').remove();
		$('#table_wrapper').remove();

		cadena="<table class='table table-advance' id='table'>";
		cadena+="<thead>";	
			cadena+="<tr>";
				cadena+="<th>N°</>";
                cadena+="<th>Nombre Pesum</th>";
                cadena+="<th>Nombre Corto</th>";		            
                cadena+="<th>Modificar</th>";
                cadena+="<th>Eliminar</th>";			 
	        cadena+="</tr>";
		cadena+="</thead>";	
		cadena+="<tbody>";
		for (i=0;i<data.pensum.length;i++){
	
			cadena+="<tr >";				
				cadena+="<td><a href='#' onmouseover='verDetalle("+data.pensum[i]['codigo']+")' >"+i+"</a></td>";
				cadena+="<td><a href='#'  onmouseover='verDetalle("+data.pensum[i]['codigo']+")'>"+data.pensum[i]['nombre']+"</a></td>";
				cadena+="<td><a href='#'  onmouseover='verDetalle("+data.pensum[i]['codigo']+")'>"+data.pensum[i]['nom_corto']+"</a></td>";
				cadena+="<td>";
				cadena+="<button class='btn btn-info' title='Modificar el Pensum' onclick='agregarInfPen("+data.pensum[i]['codigo']+")'>";
				cadena+="<i class='icon-pencil'></i>";
				cadena+="</button>";
				cadena+="</td>";	
				cadena+="<td>";
				cadena+="<button class='btn btn-danger' title='Eliminar el Pensum' onclick='eliminarPensum("+data.pensum[i]['codigo']+");'  >";
						cadena+="<i class='icon-remove'></i>";
					cadena+="</button>";
				cadena+="</td>";
			cadena+="</tr>";

		
		}
		cadena+="</tbody>";
		cadena+="</table>";
	
		$(cadena).appendTo("#listarI");

	//	alert('hola');
		$('#table').DataTable();
	}
	else 
		mostrarMensaje(data.mensaje,2);
}


/*
consulta todo los detalles
*/
function consultarDetallePen(data) {
//	console.log(data)
	if (data.estatus>0){
		
		pensum=data.pensum[0];
	//	console.log(pensum)
		cadena="";
		
		cadena+="<div id='detallePen' class='third'>";
		cadena+="<table id='pesum' class='table table-bordered table-striped' style='clear: both'><tbody>";
		cadena+="<tr><td style='width: 35%;''>Código:</td><td style='width: 65%;'><a href='#'' >"+pensum[0]+"</a></td></tr>";
		cadena+="<tr><td>Nombre:</td><td>";
		cadena+="<a href='#'' >"+pensum[1]+"</a></td></tr>";
		cadena+="<tr><td>Nombre Corto:</td><td>";
		cadena+="<a href='#'' >"+pensum[2]+"</a></td></tr>";		
		cadena+="<tr><td>Observaciones:</td><td>";
		cadena+="<a href='#'' >"+pensum[3]+"</a></td></tr>";
		cadena+="<tr><td>Mínima cantidad electiva:</td><td>";
		cadena+="<a href='#'' >"+pensum[4]+"</a></td></tr>";	
		cadena+="<tr><td>Mínima crédito electiva:</td><td>";
		cadena+="<a href='#'' >"+pensum[5]+"</a></td></tr>";	
		cadena+="<tr><td>Mínima crédito obligatorio:</td><td>";
		cadena+="<a href='#'' >"+pensum[6]+"</a></td></tr>";
		cadena+="<tr><td>Fecha de Creación:</td><td>";
		cadena+="<a href='#'' >"+pensum[7]+"</a></td></tr>";	
		cadena+="</tbody></table></div>";
	//	$("#detallePen").html(cadena);
	//	alert(cadena);
		//$(cadena).appendTo('#detallePen');
		$("div.third").replaceWith(cadena);
	}
}

/*ver pensum consulta pensum simple*/
function verDetalle(codigo){	
	var arr = Array ("m_modulo","pensum",
	 				 "m_accion","buscarPensum",
	 				 "codigo",codigo);
	ajaxMVC(arr,consultarDetallePen,errorBuscarPensum); 
}

function succObtenerE(data){
	if(data.estatus>0){
		$("<h3> Esta seguro que quiere eliminar el Pensum ?</h3>").appendTo(".modal-body");
		cadena="<input type='hidden' value='"+data.pensum[0]['codigo']+"' class='form-control' placeholder='codigo Pensum' id='codigoI'>";
		$(cadena).appendTo(".modal-body");
		
		$("<br>").appendTo(".modal-body");
		cadena= "<h4>Codigo : "+data.pensum[0]['codigo']+"</h4>";
		$(cadena).appendTo(".modal-body");
		cadena= "<h4>Nombre: "+data.pensum[0]['nombre']+"</h4>";
		$(cadena).appendTo(".modal-body");
		cadena= "<h4>Nombre Corto : "+data.pensum[0]['nom_corto']+"</h4>";
		$(cadena).appendTo(".modal-body");
		
	}
	else 
		mostrarMensaje(data.mensaje,2);
}

function error(data){
		mostrarMensaje("error error: " + data.responseText,2);
}

function ObtenerIDPensum(){
	var loc = document.location.href;	
	var getString = loc.search("codigoPensum");	
	 if (getString != -1){
       	 getString+=13;
	     var a = loc.substring(getString,getString+25);
	     console.log(a);
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

	}else if (formulario == 'uni'){

	}else if (formulario == 'pre'){

	}
};

function redirectEdit(codigo){
	  window.location="index.php?m_modulo=pensum&m_formato=html5&m_accion=preModif&m_vista=Agregar&codigoPensum="+codigo;
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