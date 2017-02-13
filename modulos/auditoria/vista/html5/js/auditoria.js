
listarAuditoria();




function listarAuditoria(){

	var accion = $("#Accionbd").val();
	var usuario = $("#usuariobd").val();
	var tabla =	$("#tablabd").val();

	var arr = Array("m_modulo"	,	"auditoria",
					"m_accion"	,	"listar",
					"tabla"		,	tabla,
					"usuario"	,	usuario,
					"accion"	,	accion
					);
		
	ajaxMVC(arr,listarAuditoriaCallBack,error);

}

function listarAuditoriaCallBack(data){

	$("#contenidoTala").remove();
	var datos=data.auditoria;
	var cadena="";
	cadena+="<div id='contenidoTala'>";
	cadena+="<table class='table table-advance' id='tabla'>";
	cadena+="<thead>";
	cadena+="<tr>";
	cadena+="<th>N°</th>";
	cadena+="<th>Usuario</th>";
	cadena+=" <th>Antes</th>";
	cadena+=" <th>Después</th>";
	cadena+=" <th>Fecha y hora</th>";
	cadena+="<th>Tabla</th>";
	cadena+="<th>Acción</th>";
	cadena+="</tr>";
	cadena+="</thead>";
	var x=0; 
	var incrementarDos=false;

	var usuarios=[];
	var tablas=[];
	
	while(x<data.auditoria.length){
		 		
		var objCambios=jQuery.parseJSON(datos[x].datos);
		if(data.auditoria.length>x+1){
			if(datos[x].hora==datos[x+1].hora){
				var objCambiosAfter=jQuery.parseJSON(datos[x+1].datos);	

				 incrementarDos=true;
			}
			else {				
				var objCambiosAfter="ACCIÓN FALLIDA";
				incrementarDos=false;
			}
		}		
		else if(data.auditoria.length>x){
			
			if(datos[x].hora==datos[x-1].hora)
				var objCambios=jQuery.parseJSON(datos[x-1].datos);	
			else {				
				var objCambiosAfter="ACCIÓN FALLIDA";
			}
			incrementarDos=false;
			
		}
		
		
		cadena+="<tr>";
		cadena+="<th>"+x+"</th>";
		cadena+="<th>"+datos[x].usuario+"</th>";		
		var linea=compararCadena(objCambios,objCambiosAfter,datos[x].tipo);
		cadena+="<th>"+linea[0]+"</th>";
		cadena+="<th>"+linea[1]+"</th>";
		cadena+="<th>"+datos[x].hora+"</th>";
		cadena+="<th>"+datos[x].tabla+"</th>";
		cadena+="<th>"+colorAccion(datos[x].tipo)+"</th>";	
		cadena+="</tr>";

		if(tablas.indexOf(datos[x].tabla)=="-1")
			tablas.push(datos[x].tabla);

		if(usuarios.indexOf(datos[x].usuario)=="-1")
			usuarios.push(datos[x].usuario);


		if(incrementarDos)
			x+=2;
		else 
			x++

	}
	cadena+="</tbody>";
	cadena+"</table>";
	cadena+="</div>";
	//alert(JSON.stringify(data));
	$(cadena).appendTo('#todaTabla');
	$('#tabla').DataTable();
	
	if($("#haySelect").val()=='false')
		llenarSelectAuditoria(tablas,usuarios);


}

function llenarSelectAuditoria(tablas,usuarios){

	$("#haySelect").val("true");

	var cadena="";
	cadena+="<div> <b> Tablas </b>";
	cadena+="<select class='selectpicker' id='tablabd' onchange='listarAuditoria();' name='tablas' title='Tablas' data-live-search='true' data-size='auto' data-max-options='12' multiple>";
	cadena += "<option value='seleccionar'>Seleccionar</option>";
	for(var x=0; x<tablas.length;x++){
		cadena+="<option value='"+tablas[x]+"'>"+tablas[x]+"</option>'";
	}
	cadena+="</select>";
	cadena+="</div>";
	cadena+="<br>";
	$(cadena).appendTo('#tablasbd');
	cadena="";
	cadena+="<div> <b> Usuarios </b>";
	cadena+="<select class='selectpicker' id='usuariobd' onchange='listarAuditoria();' name='usuarios' title='accion' data-live-search='true' data-size='auto' data-max-options='12' multiple>";
	cadena += "<option value='seleccionar'>Seleccionar</option>";
	for(var x=0; x<usuarios.length;x++){
		cadena+="<option value='"+usuarios[x]+"'>"+usuarios[x]+"</option>'";
	}
	cadena+="</select>";
	cadena+="</div>";

	cadena+="<br>";
	$(cadena).appendTo('#usuarios');
	cadena="";
	cadena+="<div> <b> Acción </b>";
	cadena+="<select class='selectpicker' id='Accionbd' onchange='listarAuditoria();' name='accion' title='accion' data-live-search='true' data-size='auto' data-max-options='12' multiple>";
	cadena += "<option value='seleccionar'>Seleccionar</option>";

	cadena+="<option value='UPDATE'>UPDATE</option>'";
	cadena+="<option value='DELETE'>DELETE</option>'";
	cadena+="<option value='INSERT'>INSERT</option>'";
	
	cadena+="</select>";
	cadena+="</div>";
	$(cadena).appendTo('#accion');
	activarSelect();


}

function colorAccion(accion){

	var linea ="";
	if(accion=="DELETE")
		linea="<b style='color:red;'>"+accion+"</b>";
	else if(accion=="INSERT")
		linea="<b style='color:green;'>"+accion+"</b>";
	else
		linea="<b style='color:#e9bd15;'>"+accion+"</b>";
	return linea;
}
function compararCadena(objCambios,objCambiosAfter,tipo){
	var c=0;
	var linea="";
	var lineaAfter="";

	for(var i in objCambios){	
		if(tipo =="DELETE")	{	
			linea+="<b style='color:black;'>"+Object.keys(objCambios)[c]+" : </b><b style='color:red;'>"+objCambios[i]+"</b> <b style='color:black;'> | </b> "; 
			if(objCambiosAfter!="ACCION FALLIDA" )
				lineaAfter+="<b style='color:black;'>"+Object.keys(objCambios)[c]+" : </b><b style='color:red;'>"+objCambiosAfter[i]+"</b> <b style='color:black;'> | </b>"; 
		}
		else if(tipo =="INSERT"){	
			linea+="<b style='color:black;'>"+Object.keys(objCambios)[c]+" : </b><b style='color:green;'>"+objCambios[i]+"</b> <b style='color:black;'> | </b> "; 
			lineaAfter+="<b style='color:black;'>"+Object.keys(objCambios)[c]+" : </b><b style='color:green;'>"+objCambiosAfter[i]+"</b> <b style='color:black;'> | </b>"; 
		}
		else{	
			if(objCambios[i]===objCambiosAfter[i]){
				linea+=Object.keys(objCambios)[c]+" : "+objCambios[i]+" <b style='color:black;'> | </b> "; 
				lineaAfter+=Object.keys(objCambios)[c]+" : "+objCambiosAfter[i]+"<b style='color:black;'> | </b>"; 
			}
			else if(!objCambios[i] ){
				linea+="<b style='color:black;'>"+Object.keys(objCambios)[c]+" : </b> <b style='color:green;'>"+objCambios[i]+"</b> <b style='color:black;'> | </b> "; 
				lineaAfter+="<b style='color:black;'>"+Object.keys(objCambios)[c]+" : </b> <b style='color:green;'>"+objCambiosAfter[i]+"</b> <b style='color:black;'> | </b>";
			}
			else if(objCambiosAfter[i]){
				linea+="<b style='color:black;'>"+Object.keys(objCambios)[c]+" : </b> <b style='color:#e9bd15;'>"+objCambios[i]+"</b> <b style='color:black;'> | </b> "; 
				lineaAfter+="<b style='color:black;'>"+Object.keys(objCambios)[c]+" : </b> <b style='color:#e9bd15;'>"+objCambiosAfter[i]+"</b> <b style='color:black;'> | </b>";
			}			
			else{
				linea+="<b style='color:black;'>"+Object.keys(objCambios)[c]+" : </b> <b style='color:red;'>"+objCambios[i]+"</b> <b style='color:black;'> | </b> "; 
				lineaAfter+="<b style='color:black;'>"+Object.keys(objCambios)[c]+" : "+objCambiosAfter[i]+"</b> <b style='color:black;'> | </b>"; 
			}

		}
		c++;
			
	}
	var resultado=[];
	resultado[0]=linea;
	if(objCambiosAfter!="ACCION FALLIDA")
		resultado[1]=lineaAfter;
	else
		resultado[1]="<b style='color:black;'>"+objCambiosAfter+"</b>";
	return resultado
}


function  errorAjax(data){
	mostrarMensaje("Error de comunicación con el servidor.",2);
	console.log(data);
	//alert(JSON.stringify(data));
}