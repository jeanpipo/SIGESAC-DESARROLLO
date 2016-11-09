
function activarSelect(){
	$(".selectpicker").selectpicker();
}


(function( factory ) {
if ( typeof define === "function" && define.amd ) {
// AMD. Register as an anonymous module.
define([ "../datepicker" ], factory );
} else {
// Browser globals
factory( jQuery.datepicker );
}
}(function( datepicker ) {
datepicker.regional['es'] = {
closeText: 'Cerrar',
prevText: '&#x3C;Ant',
nextText: 'Sig&#x3E;',
currentText: 'Hoy',
monthNames: ['enero','febrero','marzo','abril','mayo','junio',
'julio','agosto','septiembre','octubre','noviembre','diciembre'],
monthNamesShort: ['ene','feb','mar','abr','may','jun',
'jul','ago','sep','oct','nov','dic'],
dayNames: ['domingo','lunes','martes','miércoles','jueves','viernes','sábado'],
dayNamesShort: ['dom','lun','mar','mié','jue','vie','sáb'],
dayNamesMin: ['D','L','M','X','J','V','S'],
weekHeader: 'Sm',
dateFormat: 'dd/mm/yy',
firstDay: 1,
isRTL: false,
showMonthAfterYear: false,
yearSuffix: ''};
datepicker.setDefaults(datepicker.regional['es']);
return datepicker.regional['es'];
}));

$(document).ready(function() {
	$.datepicker.setDefaults($.datepicker.regional["es"]);

});

function activarFecha(elemento){

	$(elemento).datepicker();
	$(elemento).datepicker( "show" );
}

function mostrarMensaje(mensaje, tipo){
	var len = $(".alert").height();

	len += len/2;

	var cont = $(".alert").length * len;

	if(tipo==1){
		cad = 'info';
		cad2 = '¡Éxito!';
	}
	else if(tipo==2){
		cad = 'danger';
		cad2 = '¡Error!'
	}
	else if(tipo==3){
		cad = 'warning';
		cad2 = '¡Advertencia!';
	}
	else if(tipo==4){
		cad = 'dark';
		cad2 = 'Información';
	}

	if(tipo == 5){
		var cont = $("<div class='alert alert-default pastel alert-dismissible' id='"+$(".alert").length+"' style='top:0' role='alert'>"
						+ "<button type='button' class='close' data-dismiss='alert'>"
						+ "<span aria-hidden='true'>&times;</span>"
						+ "</button>"
						+ "<strong><center>"+mensaje+"</center></strong>"
						+ "</div>");
	}
	else{
		var cont = $("<div class='alert alert-" + cad + " alert-dismissible' id='"+$(".alert").length+"' style='bottom:"+cont+"px' role='alert'>"
						+ "<button type='button' class='close' data-dismiss='alert'>"
						+ "<span aria-hidden='true'>&times;</span>"
						+ "</button>"
						+ "<strong>"+ cad2 + "</strong> "+ mensaje+ ""
						+ "</div>");
	}


	$(cont).appendTo(".alerts");

	if(tipo != 5){
		setTimeout(function(){
			$("#"+($(".alert").length - 1)).remove();
		},5000);
	}

}


function crearDialogo(id, titulo, segundoTitulo, size, accion, boton, tipo){
	if($('.modal').length==0){
		if(size==1)
			cad = '<div class="modal-dialog" data-backdrop="static">';
		else if(size==2)
			cad = '<div class="modal-lg" >';
		else
			cad = '<div class="modal-dialog" style="width:'+size+'px;">';

		if(tipo==true)
			cad2 = '<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>';
		else
			cad2 = '';

		if(boton!='')
			cad3 = '<button type="button" class="btn btn-success" onclick="'+accion+'">'+boton+'</button>';
		else
			cad3 = '';

		$('#'+id).remove();
		$(".modal-content").remove();

		$('<div class="modal" id="'+id+'">'+
			cad +
				'<div class="modal-content">'+
					'<div class="modal-header">'+
						'<button type="button" class="close" data-dismiss="modal">'+
						'<span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'+
						'<h3 class="modal-title" id="myModalLabel">'+titulo+'</h4>'+
						'<h4 class="modal-title" id="myModalLabel"><div id="segtitulo">'+segundoTitulo+'</div></h4>'+
					'</div>'+
					'<div class="modal-body">'+
					'</div>'+
					'<div class="modal-footer">'+
						cad3+
						cad2+
					'</div>'+
				'</div>'+
			'</div>'+
		'</div>').appendTo("body");
	}
	else{
		$('#'+id).remove();
		$("#"+id+" .modal-content").remove();
		if(size==1)
			cad = '<div class="modal-dialog">';
		else
			cad = '<div class="modal-lg">';

		if(tipo==true)
			cad2 = '<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>';
		else
			cad2 = '';

		if(boton!='')
			cad3 = '<button type="button" class="btn btn-success" onclick="'+accion+'">'+boton+'</button>';
		else
			cad3 = '';

		$('<div class="modal fade" id="'+id+'" data-backdrop="static">'+
			cad +
				'<div class="modal-content">'+
					'<div class="modal-header">'+
						'<button type="button" class="close" data-dismiss="modal">'+
						'<span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'+
						'<h3 class="modal-title" id="myModalLabel">'+titulo+'</h4>'+
						'<h4 class="modal-title" id="myModalLabel">'+segundoTitulo+'</h4>'+
					'</div>'+
					'<div class="modal-body">'+


					'</div>'+
					'<div class="modal-footer">'+
						cad3+
						cad2+
					'</div>'+
				'</div>'+
			'</div>'+
		'</div>').appendTo("body");

	}
}



function crearConfirm(titulo,boton,tituloBoton){
	$("<div class='alert alert-black alert-dismissible alert-link fade in' role='alert' id='confirmationDialoge'>"
					+ "<button type='button' class='close' data-dismiss='alert'>"
					+ "<span aria-hidden='true'>&times;</span>"
					+ "</button>"
					+ "<span id='mensajeConfirm'><strong>"+titulo+"</strong></span>"
					+ "<div id='confirmBtn'>"
					+ "<button class='btn btn-success' onclick="+boton+" class='close' data-dismiss='alert'>"+tituloBoton+"</button>"
					+ "<button type='button' onclick='cancelConfirm()' class='btn btn-danger' class='close' data-dismiss='alert'>Cancelar</button>"
					+ "</div>"
					+ "</div>").appendTo(".alerts");
}

function cancelConfirm(){
	$('#mensajeConfirm').html("<strong>HA DECIDIDO NO ELIMINAR</strong>");
	agregarNotificacion('Se ha cancelado la eliminación',3);
}

function agregarNotificacion(error,tipo){

		var elementos = parseInt($("#notificaciones").html());

	if($('#notificaciones').length)
		$('#notificaciones').html(elementos+1);
	else
		$('<div id="notificaciones">1</div>').appendTo('#notificacion');


	if(tipo===1)
		$('<li><a href="#" id="noti'+elementos+'" style="color:green"> <i class="icon-ok"></i> '+error+'</a></li>').appendTo('#notMensaje');
	else if(tipo===2)
		$('<li><a href="#" id="noti'+elementos+'" style="color:red;"> <i class="icon-remove"></i> '+error+'</a></li>').appendTo('#notMensaje');
	else if(tipo===4)
		$('<li><a href="#" id="noti'+elementos+'" style="color:#428BCA;"> <i class="icon-info"></i> '+error+'</a></li>').appendTo('#notMensaje');
	else if(tipo===3)
		$('<li><a href="#" id="noti'+elementos+'" style="color:#FFE13A;text-shadow:0.5px 0.5px black;"> <i class="icon-info-sign"></i> '+error+'</a></li>').appendTo('#notMensaje');
}

function eliminarNotificacion(noti){
	$(noti).remove();
}

function activarCal(){
	$('.date').datetimepicker({
    format: 'DD/MM/YYYY'
});

}

function obtenerMenu(opcion){
	if(opcion == "A"){
		if($("#menuIA").length == 0){
			cadena = '<div id="menuIA">';
				cadena += '<a href="index.php?m_modulo=persona&m_formato=html5&m_accion=listar&m_vista=Listar"  style="color:white">Personas</a>';
				cadena += '<a href="index.php?m_modulo=estudiante&m_formato=html5&m_accion=listar&m_vista=Listar"  style="color:white">Estudiantes</a>';
				cadena += '<a href="index.php?m_modulo=docente&m_formato=html5&m_accion=listar&m_vista=Listar"  style="color:white">Docentes</a>';
				cadena += '<a href="index.php?m_modulo=curso&m_formato=html5&m_accion=listar&m_vista=Listar" style="color:white">Lista de Cursos</a>';
				cadena += '<a href="index.php?m_modulo=curso&m_formato=html5&m_accion=listarD&m_vista=ListarD" style="color:white">Mis Cursos</a>';
				cadena += '<a href="index.php?m_modulo=curso&m_formato=html5&m_accion=inscribirEst&m_vista=CursosEstudiante" style="color:white">Inscribir estudiante</a>';
			cadena += '</div>';
			$('#menuIR').append(cadena);
		}
		else
			$("#menuIA").remove();
	}
	else if(opcion == 'I'){

	}
}

function fecActual(){
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();

	if(dd<10) {
	    dd='0'+dd
	} 

	if(mm<10) {
	    mm='0'+mm
	} 

	today = dd+'/'+mm+'/'+yyyy;
	return today;
}


