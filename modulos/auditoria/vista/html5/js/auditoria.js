listarAuditoria();

function listarAuditoria(){

	var arr = Array("m_modulo"	,	"auditoria",
					"m_accion"	,	"listar"
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
	cadena+=" <th>Despues</th>";
	cadena+=" <th>Fecha y hora</th>";
	cadena+="<th>Tabla</th>";
	cadena+="<th>Acción</th>";
	cadena+="</tr>";
	cadena+="</thead>";
	cadena+="<tbody id='tbody'>";
	for(var x=0; x<data.auditoria.length;x+=2){
		var objCambios=jQuery.parseJSON(datos[x].datos);
		var objCambiosAfter=jQuery.parseJSON(datos[x+1].datos);
		var linea="";
		var lineaAfter="";
		cadena+="<tr>";
		cadena+="<th>"+x+"</th>";
		cadena+="<th>"+datos[x].usuario+"</th>";
		c=0;
		for(var i in objCambios) {			
   			linea+="<b style='color:red;'>"+Object.keys(objCambios)[c]+":"+objCambios[i]+"</b> | "; 
   			lineaAfter+="<b style='color:green;'>"+Object.keys(objCambios)[c]+":"+objCambiosAfter[i]+"</b> | "; 
   			c++;
		}
		cadena+="<th>"+linea+"</th>";
		cadena+="<th>"+lineaAfter+"</th>";
		cadena+="<th>"+datos[x].hora+"</th>";
		cadena+="<th>"+datos[x].tabla+"</th>";
		cadena+="<th>"+datos[x].tipo+"</th>";	
		cadena+="</tr>";

	}
	cadena+="</tbody>";
	cadena+"</table>";
	cadena+="</div>";
	//alert(JSON.stringify(data));
	$(cadena).appendTo('#todaTabla');

		    $('#tabla').DataTable();


}


function  errorAjax(data){
	mostrarMensaje("Error de comunicación con el servidor.",2);
	console.log(data);
	alert(JSON.stringify(data));
}