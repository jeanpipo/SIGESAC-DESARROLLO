function borrarAcreditable(){

	
}

function autocompletarEstudiante(){

	$(".estudiante").autocomplete({
			delay: 200,  //milisegundos
			minLength: 1,
			source: function( request, response ) {
				var a=Array("m_modulo"	,	"estudiante",
							"m_accion"	,	"buscarEstudiante",
							"estado"	,	"A",
							"conCedula"	,	"true",
							"patron"	,	$("#estudiante").val()
							);

				ajaxMVC(a,function(data){
					//alert(JSON.stringify(data));
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
			cad+="	<tr class='pointer' id='"+x+"Electiva' onclick='buscarAcreditable("+dat['codigo']+"); seleccionarFila(\""+id+"\",\""+data.acreditadas.length+"\");'>";
			
			cad+="	  <td>"+(x+1)+"</td>";
			cad+="	  <td>"+dat['codigo']+"</td>";
			cad+="	  <td>"+dat['pensum']+"</td>";
			if(dat['trayecto'])
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
	/*var arr=Array("m_modulo"	,		"curso",
				  "m_accion"	,		"buscarAcreditadas",
				  "codEstudiante",		codEstudiante
				);

	ajaxMVC(arr,succBuscarAcreditable,errorAjax);*/
}

function succBuscarAcreditable(data){

}

function borraCamposAcreditable(){
	$("#codEstudiante").val("");
	$("#codigo").val("");
	$("#unidadCredito").val("");
	$("#pensum").val("");
	$("#fecha").val("");
	$("#observacion").val("");
}

function guardarAcreditable(){
	var arr=Array("m_modulo"	,		"curso",
				  "m_accion"	,		"guardarAcreditada",
				  "cod_estudiante",		$("#codEstudiante").val(),
				  "cod_pensum",			$("#pensum").val(),
				  "cod_trayecto",		$("#trayecto").val(),
				  "uni_credito",		$("#unidadCredito").val(),
				  "fecha",				$("#fecha").val(),	
				  "descripcion",		$("#observacion").val(),
				  "codEstudiante",		codEstudiante
				);

	ajaxMVC(arr,succGuardarAcreditable,errorAjax);
}

function succGuardarAcreditable(data){

	if(data.estatus<0)
		mostrarMensaje("No se pudo acreditar.",2);
	else{
		buscarAcreditadas($("#codEstudiante").val());
		mostrarMensaje("La acreditacion se realizo con exito.",1);
	}
}

function seleccionarFila(idFila,nFilas){
	for(var x=0;x<nFilas;x++){
		$("#"+x+"Electiva").css("background-color","#F4F7F9");
	}

	$("#"+idFila).css("background-color","#E5EAEE");
}
function errorAjax(){
	console.log(data);
	//alert(data.mensaje);
	mostrarMensaje("Error de comunicación con el servidor.",2);
}

