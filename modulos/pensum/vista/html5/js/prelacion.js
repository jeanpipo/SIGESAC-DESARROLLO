function err(data){
	alert("err");
	console.log(data);
}

function errorSelect(data){
mostrarMensaje("Error Cargando Select consultar LOG",2);
console.log(data);}



function cargarPensums(){

	var arr = Array("m_modulo"		,	"pensum",
					"m_accion"		,	"buscarPorInstituto",
					"codigo" 		, 	$("#selInst").val()[0]);

	ajaxMVC(arr,succCargarPensums,errorSelect);
}

function cargarInstitutos(){

	//  SelectUnidadC()
	
	var arr = Array("m_modulo"		,		"instituto",
					"m_accion"		,		"listar");

	ajaxMVC(arr,succCargarInstitutos,err);

}

function SelectUnidadC(){
	/*	var arr = Array("m_modulo"		,		"unidad",
				"m_accion"		,		"listarUnidades");
	
		ajaxMVC(arr,ssccCargaUnidadesC,err); */

			var arr = Array("m_modulo"		,		"unidad",
					"m_accion"		,		"buscarUniCurricularPorPensum",
					"codigo" 		, 	$("#codigoPensum").val()
					);
		ajaxMVC(arr,ssccCargaUnidadesC,err);
}

/*
function cargarUnidadCurricularDePensum(){
		var arr = Array("m_modulo"		,		"unidad",
					"m_accion"		,		"buscarUniCurricularPorPensum",
					"codigo" 		, 	$("#codigoPensum").val()
					);

	ajaxMVC(arr,ssccCargaUnidadesC,errorSelect);
}
*/



function ssccCargaUnidadesC(data){
	console.log('Uniudades')
	console.log(data)
	var ins = data.pensum;
	var cad = "";

	cad += "<select class='selectpicker' id='selUnidad' onchange='obtenerCodigo(1)' data-live-search='true' data-size='auto'  data-max-options='1' title='Seleccione Unidad Curricular'>";

	if(ins){
		for(var i = 0; i < ins.length; i++){
			cad += "<option value="+ins[i]['cod_uni_curricular']+">"+ins[i][16]+" ("+ins[i]['cod_uni_ministerio']+") </option>";
		}
		cad += "</select>";
	}
	else{
		cad += "<option></option>";
	}

	$("#selUnidad").selectpicker("destroy");
	$("#divUni").append(cad);
	$("#selUnidad").selectpicker();

	

	var cad = "";

	cad += "<select class='selectpicker' id='selUnidadP' onchange='obtenerCodigo(2)' data-live-search='true' data-size='auto' data-max-options='1' title='Seleccione Unidad Curricular Prelada'>";

	if(ins){
		for(var i = 0; i < ins.length; i++){
			cad += "<option value="+ins[i]['cod_uni_curricular']+">"+ins[i][16]+" ("+ins[i]['cod_uni_ministerio']+") </option>";
		}
		cad += "</select>";
	}
	else{
		cad += "<option></option>";
	}

	$("#selUnidadP").selectpicker("destroy");
	$("#divUniP").append(cad);
	$("#selUnidadP").selectpicker();
}

function obtenerCodigo(selUnidad){
	
	if (selUnidad == 1){
		$("#codigoUnidadC").val($("#selUnidad").val());
	}else{
		$("#codigoUnidadCP").val($("#selUnidadP").val());
	}
	//alert("#"+selUnidad) ;
}

function succCargarInstitutos(data){

	var ins = data.institutos;
	var cad = "";

	cad += "<select class='selectpicker' id='selInst' data-live-search='true' data-size='auto' multiple data-max-options='1' title='Seleccione Instituto'>";

	if(ins){
		for(var i = 0; i < ins.length; i++){
			cad += "<option value="+ins[i][0]+">"+ins[i]['nombre']+"</option>";
		}
		cad += "</select>";
	}
	else{
		cad += "<option value='-1' selected>Sin Asignar</option>";
	}
//	console.log(cad)
	$("#selInst").selectpicker("destroy");
	$("#divInst").append(cad);
	$("#selInst").selectpicker();
}



function ObtenerIDPensum(){
	var loc = document.location.href;	
	var getString = loc.search("codigoPensum");	
	 if (getString != -1){
       	 getString+=13;
	     var a = loc.substring(getString,getString+25);
	  
	     $("#codigoPensum").val(a);
	     return a;
	   }else{
	//   	alert('No posee codigo Pensum en url');
	   	return 'not';
	   }
}

function agregarPrelacion(){
		var arr = Array ("m_modulo","unidad",
	 					 "m_accion","agregarPrelacion",
	 					 "cod_instituto",$("#selInst").val(),
	 					 "cod_pensum",$("#codigoPensum").val(),
	 					 "cod_uni_curricular",$("#codigoUnidadC".val),
	 					 "cod_uni_cur_prelada",$("#codigoUnidadCP").val()
	 					  );
	ajaxMVC(arr,succAgregarPrelacion,errorAgregar); 
}





function modificarURL(codigoPensum, formulario){
	if (formulario == 'info'){

		$("#steps-uid-0-t-T").attr("href", "index.php?m_modulo=pensum&m_formato=html5&m_accion=mostrar&m_vista=Trayecto&codigoPensum="+codigoPensum);
		$("#steps-uid-0-t-U").attr("href", "index.php?m_modulo=pensum&m_formato=html5&m_accion=mostrar&m_vista=UnidadesCurricular&codigoPensum="+codigoPensum);
		$("#steps-uid-0-t-P").attr("href", "index.php?m_modulo=pensum&m_formato=html5&m_accion=mostrar&m_vista=Prelacion&codigoPensum="+codigoPensum);
	
	}else if (formulario == 'pre'){
	
		$("#steps-uid-0-t-I").attr("href", "index.php?m_modulo=pensum&m_formato=html5&m_accion=preModif&m_vista=Agregar&codigoPensum="+codigoPensum);		
		$("#steps-uid-0-t-T").attr("href", "index.php?m_modulo=pensum&m_formato=html5&m_accion=mostrar&m_vista=Trayecto&codigoPensum="+codigoPensum);
		$("#steps-uid-0-t-U").attr("href", "index.php?m_modulo=pensum&m_formato=html5&m_accion=mostrar&m_vista=UnidadesCurricular&codigoPensum="+codigoPensum);
	
	
	}

};

function mensajeErrorDB(cadena,mensaje){
	var data = cadena.responseText;

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




function agregarModificar(){
	//if (validarFrom()){
	//	if ($("#codigo").val() != ''){
			// trayecto
			
		    // tipo		
			if ($("#codigo").val() == ""){
				var arr = Array (
					"m_modulo","unidad",
					"m_accion","agregarPrelacion",
					"cod_pensum",		  $("#codigoPensum").val(),
					"cod_instituto",	  $("#selInst").val(),
					"cod_uni_curricular", $("#codigoUnidadC").val(),
					"cod_uni_cur_prelada",$("#codigoUnidadCP").val()
				);	 

			 	ajaxMVC(arr,succAgregarPrelacion,errorAgregarModif);			

			}else{
				var arr = Array (
					"m_modulo","unidad",
					"m_accion","ModificarUniTraPen",
					"",$("#codigo").val(),
					"cod_pensum",$("#codigoPensum").val(),
					"cod_instituto",$("#selInst").val(),
					"cod_uni_curricular",$("#codigoUnidadC").val(),
					"cod_uni_cur_prelada",$("#codigoUnidadCP").val()
				);	 

			  	ajaxMVC(arr,succEditAgregando,errorAgregarModif);
			}

		console.log(arr.toString())
}


function errorAgregarModif(data){
	console.log(data.responseText);
}


function succAgregarPrelacion(data){
	console.log(data);
}
/*
function cargarListaUnidadPre(){
		var arr = Array("m_modulo"		,	"unidad",
						"m_accion"		,	"obtenerPerlacionPorPensum",
						"codigoPensum" 		, 	$("#codigoPensum").val()[0]);

	ajaxMVC(arr,succCargarPrelacion,errorLista);
}
*/

function cargarUniCurricularPorPensum(){
		var arr = Array("m_modulo"		,		"unidad",
					"m_accion"		,		"buscarUniCurricularPorPensum",
					"codigo" 		, 	$("#codigoPensum").val()
					);
	ajaxMVC(arr,succCargarListT,errorLista);
}





function succCargarListT(data){
//	alert()
	var cadena="";
	
	var trayectos = data["pensum"];
	console.log(data)
//	console.log(trayectos)
	if (data["pensum"] != null){
		cadena+=" <div class='trow' style='width:100%; height:337px; overflow:auto;'>";		                			
		cadena+="<table class='table table-hover mbn'><thead><tr class='active'> ";
		cadena+="<th>#N° Trayecto</th> ";
		cadena+="		<th>Tipo</th> "; 
		cadena+="		<th>(codigo)Nombre</th> ";
		cadena+="		<th></th>  ";
		cadena+="<th></th></tr></thead>";
	    cadena+="<tbody> ";
	    for (var i = 0; i < trayectos.length ; i++) {	
	    	if (trayectos[i]['cod_trayecto'] == null){
	    		numt = "Sin Tray.";
	    	}else {
	    		numt = trayectos[i]['cod_trayecto']; }

	    	  cadena+="  <tr class='active' href='#' onclick='cargarUniCurricularRequeridas( "+ trayectos[i]["cod_uni_curricular"]+ "); asignarUniPerCodigo("+ trayectos[i]['cod_uni_curricular']+ ")' >";
	          cadena+="<td style='text-align: left;'># "+ numt  +" ("+trayectos[i][9]+")</td>";
	    	  cadena+="<td style='text-align: left;' >"+ trayectos[i][27]+ "</td>";
	    	  cadena+="<td colspan='2' style='text-align: left;'>("+ trayectos[i]["cod_uni_curricular"]+ ") "+ trayectos[i][16]+ " ("+ trayectos[i][15]+ ")</td>";
	    	  cadena+="<td></td> ";
	    	  cadena+="</tr>";
	    };
	    cadena+=""
	    cadena+="</tbody></table></div>";
		$("div.trow").replaceWith(cadena);

	}
}


function errorLista(errorLista){
	console.log(errorLista)
}

function succCargarPrelacion(data){
	console.log(data)
}


function asignarUniPerCodigo(codigo){
	$("#codigoPrelacion").val(codigo);
}


function cargarUniCurricularRequeridas(codigo){
		var arr = Array("m_modulo"		,		"unidad",
					"m_accion"			,		"obtenerPerlacionPorRequerido",
					"codigoUnidad" 		, 		codigo,
					"codigoPensum"		,	 $("#codigoPensum").val()
					);
		console.log(arr.toString())
	ajaxMVC(arr,succCargarCuadroReque,errorLista);

		var arr2 = Array("m_modulo"		,		"unidad",
					"m_accion"			,		"obtenerPerlacionPorRequisito",
					"codigoUnidad" 		, 		codigo,
					"codigoPensum"		,	 $("#codigoPensum").val()
					);
	ajaxMVC(arr2,succCargarCuadroRequisito,errorLista);
}




function succCargarCuadroReque(data){
//	alert()
	var cadena="";
	
	var prelacionRequeri = data["prelacion"];
	console.log(data)
//	console.log(trayectos)
	if (data["prelacion"] != null){
		cadena+=" <div class='three' style='width:100%; height:115px; overflow:auto;'>";		                			
		cadena+="<table class='table table-hover mbn'><thead><tr class='active'> ";
		cadena+=" <th>#Cod Relación</th>";                                                             
		cadena+="<th>Nombre</th>";
        cadena+="<th></th>";
        cadena+="<th></th>";
        cadena+="<th></th>";
		cadena+=" </tr></thead>";
	    cadena+="<tbody> ";
	    for (var i = 0; i < prelacionRequeri.length ; i++) {	
	
	    	  cadena+="  <tr class='active' href='#' onclick='editarPrelacion( "+ prelacionRequeri[i]["cod_uni_curricular"]+ "); asignarUniPerCodigo("+ prelacionRequeri[i]['cod_uni_curricular']+ ")' >";
	          cadena+="<td style='text-align: left;'># "+prelacionRequeri[i]['codigo']+"</td>";
	    	  cadena+="<td style='text-align: left;' colspan='4'>"+ prelacionRequeri[i]['nombre']+ " ("+prelacionRequeri[i]['cod_uni_ministerio']+")</td>";
	    	
	    	  cadena+="</tr>";
	    };
	    cadena+=""
	    cadena+="</tbody></table></div>";
		$("div.three").replaceWith(cadena);

	}else{
		cadena+=" <div class='three' style='width:100%; height:115px; overflow:auto;'>";		                			
		cadena+="<table class='table table-hover mbn'><thead><tr class='active'> ";
		cadena+=" <th>#Cod Relación</th>";                                                             
		cadena+="<th>Nombre</th>";
        cadena+="<th></th>";
        cadena+="<th></th>";
        cadena+="<th></th>";
		cadena+=" </tr></thead>";
	    cadena+="<tbody> ";
	   	cadena+="<tr class='alert' style='background-color: rgb(255, 199, 52); position: unset;'><td colspan='5'>NO HAY UNIDADES</td></tr>";	    
	    cadena+="</tbody></table></div>";
		$("div.three").replaceWith(cadena);
	}
}





function succCargarCuadroRequisito(data){
//	alert()
	var cadena="";
	
	var prelacionRequeri = data["prelacion"];
	console.log(data)
//	console.log(trayectos)
	if (data["prelacion"] != null){
		cadena+=" <div class='four' style='width:100%; height:115px; overflow:auto;'>";		                			
		cadena+="<table class='table table-hover mbn'><thead><tr class='active'> ";
		cadena+=" <th>#Cod Relación</th>";                                                             
		cadena+="<th>Nombre</th>";
        cadena+="<th></th>";
        cadena+="<th></th>";
        cadena+="<th></th>";
		cadena+=" </tr></thead>";
	    cadena+="<tbody> ";
	    for (var i = 0; i < prelacionRequeri.length ; i++) {	
	
	    	  cadena+="  <tr class='active' href='#' onclick='editarPrelacion( "+ prelacionRequeri[i]["cod_uni_curricular"]+ "); asignarUniPerCodigo("+ prelacionRequeri[i]['cod_uni_curricular']+ ")' >";
	          cadena+="<td style='text-align: left;'># "+prelacionRequeri[i]['codigo']+"</td>";
	    	  cadena+="<td style='text-align: left;' colspan='4'>"+ prelacionRequeri[i]['nombre']+ " ("+prelacionRequeri[i]['cod_uni_ministerio']+")</td>";
	    	
	    	  cadena+="</tr>";
	    };
	    cadena+=""
	    cadena+="</tbody></table></div>";
		$("div.four").replaceWith(cadena);

	}else{
		cadena+=" <div class='four' style='width:100%; height:115px; overflow:auto;'>";		                			
		cadena+="<table class='table table-hover mbn'><thead><tr class='active'> ";
		cadena+=" <th>#Cod Relación</th>";                                                             
		cadena+="<th>Nombre</th>";
        cadena+="<th></th>";
        cadena+="<th></th>";
        cadena+="<th></th>";
		cadena+=" </tr></thead>";
	    cadena+="<tbody> ";
	   	cadena+="<tr class='alert' style='background-color: rgb(255, 199, 52); position: unset;'><td colspan='5'>NO HAY UNIDADES</td></tr>";	    
	    cadena+="</tbody></table></div>";
		$("div.four").replaceWith(cadena);
	}
}

