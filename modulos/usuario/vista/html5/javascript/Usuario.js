//Función que permite ir al servidor con la acción de filtrar y extraer los usuarios a través de un patrón
//Parámetros de entrada:funSucces: función que se ejecutará una vez traído la respuesta del servidor.
//						patron: cadena que representa el patrón de búsqueda
//Valor de retorno: Ninguno.

function filUsuarios(funSucces,patron=null) {

	if (patron ==null){
	
		var a=Array("m_modulo","usuario","m_accion","filtrar","patUsuario",$("#patUsuarios").val()
			);
	}else 
		var a=Array("m_modulo","usuario","m_accion","filtrar","patUsuario",patron
			);
	ajaxMVC(a,funSucces,error);
}
//Función la cual se activará cada vez que haya algún cambio del valor del input de búsqueda de usuarios
//y llamará a la función filUsuarios que traerá los usuarios para ser mostrados posteriormente en otra función
//Parámetros de entrada: ninguno.
//valor de retorno: ninguno.
function busUsuarios(){

	filUsuarios(mosUsuarios);
}
//Función que permite mostrar los iconos eliminar y modificar de los usuarios del panel de usuario cuando se le 
//pasa el cursor sobre un usuario.
//Parámetros de entrada: ninguno.
//Valor de retorno: ninguno.
function hovUsuarios(){
	$(".usuElementos").hover(
				function() {
					$( "#m"+$( this).attr( "id" )).show();
					$( "#e"+$( this).attr( "id" )).show();
					
					
				},
				function() {
					if (idClick!=$( this).attr("id")) {
						$( "#m"+$( this).attr( "id" )).hide();
						$( "#e"+$( this).attr( "id" )).hide();
					}
				}
	);
}
//Función que permite mostrar los iconos eliminar y modificar de los usuarios del panel de usuario cuando se le 
//se le da click sobre un usuario.
//Parámetros de entrada: ninguno.
//Valor de retorno: ninguno.
function cliUsuarios(){
	$( ".usuElementos" ).click(
				function() {
					ocuIcoUsuario();
					idClick=$( this).attr("id");
					$( "#m"+$( this).attr( "id" )).show();
					$( "#e"+$( this).attr( "id" )).show();

				}
	);
}

//Función que permite mostrar los usuarios en el panel de la vista a través de la información enviada desde el servidor.
//Parámetros de entrada: data: objeto que contiene la información enviada desde el servidor.
//Valor de retorno: ninguno.
function mosUsuarios(data){

	$("#lisUsuario").remove();
	var cadena='<div class="list-group" id="lisUsuario">';
	if (data.estatus<0)
		mostrarMensaje(data.mensaje,2);
	else{

		if (data.usuarios==null){

			cadena+="<a  href='#' class='list-group-item  usuElementos'>";
			cadena+="<div class='row'>";
	  		cadena+="<div class='col-lg-12'> No se encontraron usuarios ";
	  		cadena+="</div>";
	  		cadena+="</div>"
			cadena+="</a>";
	  		
		}else{ 
			var usuarios=data.usuarios;

		   	for (i=0; i< usuarios.length; i++){
		   		cadena+='<a id="'+ usuarios[i].codigo +'"  href="#" class="list-group-item usuElementos">';
			    cadena+='<div class="row">';
			    cadena+='<div class="col-lg-2">'+usuarios[i].codigo+' </div>';
			    cadena+='<div class="col-lg-5"> &nbsp;&nbsp;'+usuarios[i].usuario+'  </div>';
			    cadena+='<div class="col-lg-3"> &nbsp;&nbsp;&nbsp;'+usuarios[i].tipo+' </div>';
			    cadena+='<div class="col-lg-1">'; 
			    cadena+='<i id="m'+usuarios[i].codigo+'" title="Modificar usuario "class="icon-pencil iconoModificar icoUsuario" onclick=\'forUsuario("m","'+ usuarios[i].tipo+'",'+usuarios[i].codigo+',"'+usuarios[i].usuario+'")\' ></i> </div>';
			
			  	if (data.instalacion.usuarioAdmin != usuarios[i].usuario){
				    cadena+='<div class="col-lg-1">';
				  	cadena+='<i id="e'+usuarios[i].codigo+'" title="Eliminar usuario" class="icon-remove iconoEliminar icoUsuario" onclick=\'admUsuario("e","'+ usuarios[i].tipo+'",'+usuarios[i].codigo+',"'+usuarios[i].usuario+'")\'></i>	</div>';
			   	}
		    	cadena+='</div></a>';
		    }
		}
		cadena+='</div>';
	   $(cadena).appendTo("#panUsuarios");
	   
	   ocuIcoUsuario();
	   cliUsuarios();
	   hovUsuarios();
	   idClick="";
	}

}


//Función que permite ocultar los iconos eliminar y modificar de los usuarios del panel de usuario.
//Parámetros de entrada: ninguno.
//Valor de retorno: ninguno.
function ocuIcoUsuario(){
	$(".icoUsuario").hide();
}
//función que permite utilizar funciones cuando este cargado todo el DOM.
$(document).ready(function() {
	ocuIcoUsuario();
	hovUsuarios();
	cliUsuarios();
});
idClick='';
//función que permite crear el formulario con todos los campos requeridos para la modificación y agregación de
//usuarios.
//Parámetros de entrada: ninguno.
//Valor de retorno: cadena : cadena que representa el código html del formulario.
function forUsuario(accion="a",tipo="",codigo=null,usuario=null){



	$("#forUsuario").remove();
	var cadena='<div  class="panel titNegro" id="forUsuario">';
	////////////////////Encabezado///////////////////////////////////
	cadena+='<div class="panel-heading">';
		cadena+='<div class="row">';
			if (accion=="a")
				cadena+='<center> <h5 class="titBold letBlancas">Agregar usuario</h5> </center> ';
			if (accion=="m")
				cadena+='<center><h5 class="titBold letBlancas"> Modificar usuario </h5> </center>';
		cadena+='</div>';
	cadena+='</div>';

	///////////////////////campos//////////////////////////////////////
		
		cadena+= "<div class='list-group-item'>";
		cadena+='</br>';


		cadena+="<input type='hidden' id='hidCodigo' >";
		cadena+="<input type='hidden' id='hidUsuario' >";
		cadena+="<input type='hidden' id='hidTipo' >";
		cadena+="<input type='hidden' id='hidCampo1' >";
		cadena+="<input type='hidden' id='hidCampo2' >";
		cadena+="<input type='hidden' id='hidCampo3' >";
		cadena+="<input type='hidden' id='hidClave'>";


		//codigo
		cadena+='<div class="row">';
			cadena+="<div class='col-lg-6'>";
			cadena+='<div class="input-group">';
				cadena+='<span class="input-group-addon" title="Código"><i class="icon-qrcode"></i></span>';
				cadena+='<input type="text" disabled class="form-control 1" placeholder="Código" id="codUsuario">';
			cadena+='</div>';
			cadena+='</div>';
			//tipo
			cadena+="<div class='col-lg-6'>";
				cadena+="<a id='selTipo'>";
				cadena+="<select class='selectpicker 1' id='tipo' onchange=\"actBotUsuario();quiBotClave()\" data-live-search='true' data-style='btn-danger' data-size='auto' multiple data-max-options='1' title='Tipo'>";
				cadena+="<option value='R'>Rol</option>";
				cadena+="<option value='U'>Usuario</option>";
				cadena+="</select>";
				cadena+="</a>";
			cadena+='</div>';
		cadena+='</div>';
		cadena+='</br>';
		//usuario
		
		cadena+='<div class="row">';
			cadena+="<div class='col-lg-6'>";
			cadena+='<div class="input-group">';
				cadena+='<span class="input-group-addon" title="Usuario"><i class="icon-user"></i></span>';
				cadena+='<input type="text" class="form-control 1" placeholder="Usuario" id="usuario"   onkeyup=\'validarTextoNumeros("#usuario",1,30,true); actBotUsuario()\'>';
			cadena+='</div>';
			cadena+='</div>';
			//campo1
			cadena+="<div class='col-lg-6'>";
					cadena+='<div class="input-group">';
				cadena+='<span class="input-group-addon" title="Campo 1"><i class="icon-comment"></i></span>';
				cadena+='<input type="text" class="form-control 1" placeholder="Campo 1" id="campo1"  oninput="actBotUsuario()"  onkeyup=\'validarRangos("#campo1",1,30,false)\'>';
			cadena+='</div>';
			cadena+='</div>';
		cadena+='</div>';
		cadena+='</br>';


		//campo2
		cadena+='<div class="row">';
			cadena+="<div class='col-lg-6'>";
					cadena+='<div class="input-group">';
						cadena+='<span class="input-group-addon" title="Campo 2"><i class="icon-comment"></i></span>';
						cadena+='<input type="text" class="form-control 1" placeholder="Campo 2" id="campo2" oninput="actBotUsuario()"  onkeyup=\'validarRangos("#campo2",1,30,false)\'>';
					cadena+='</div>';
			cadena+='</div>';
			//campo3
			cadena+="<div class='col-lg-6'>";
				cadena+='<div class="input-group">';
				cadena+='<span class="input-group-addon" title="Campo 3"><i class="icon-comment"></i></span>';
				cadena+='<input type="text" class="form-control 1" placeholder="Campo 3" id="campo3" oninput="actBotUsuario()"  onkeyup=\'validarRangos("#campo3",1,30,false)\'>';
				cadena+='</div>';

			cadena+='</div>';

		cadena+='</div>';
		cadena+='</br>';
		
		cadena+='<div class="row">';
			cadena+="<div class='col-lg-6'>";
					cadena+='<div class="input-group">';
						cadena+='<span class="input-group-addon claClase" title="Contraseña"><i class="icon-key"></i></span>';
						cadena+='<input type="password" class="form-control 1 claClase" placeholder="Contraseña" id="clave" oninput=\'actBotUsuario();creBotPasAnterior("'+ accion+ '")\'  onkeyup=\'validarRangos("#clave",1,30,false)\'>';
					cadena+='</div>';
			cadena+='</div>';
			//campo3
			cadena+="<div class='col-lg-6'>";
				cadena+='<div class="input-group">';
				cadena+='<span class="input-group-addon claClase" title="Repetir contraseña"><i class="icon-key"></i></span>';
				cadena+='<input type="password" class="form-control 1 claClase" placeholder="Repetir contraseña" id="clave2"   onkeyup=\'validarRangos("#clave2",1,30,false)\'>';
				cadena+='</div>';

			cadena+='</div>';

		cadena+='</div>';
		cadena+='</br>';
		cadena+="<div class='row' id ='claAnterior'> ";

		cadena+="</div>";

		cadena+='<hr>';



		

		//botón guardar
		cadena+="<div class='row' id='botAdmUsuario'> ";
			cadena+="<center><button type='button' onclick=\"admUsuario('"+accion+"', '"+tipo+"' ,"+codigo+")\" disabled id='botUsuario' class='btn btn-success' title='Guardar'>Guardar</button></center>";
  		
		cadena+="</div>";	
		
		cadena+='</div>';
	////////////////////////////////////////////////////////////////////
	cadena+='</div>';
	$(cadena).appendTo("#htmForUsuario");
	activarSelect();
	if (accion=='m'){
		obtener(codigo,sucObtener,tipo,usuario);
		

	}

}
//Función que permite activar el botón de guardar cuando hay algún cambio en los input de usuario
//Parámetros de entrada: ninguno
//Valor de retorno: ninguno.
function actBotUsuario(){
	var tipo= $("#hidTipo").val();
	if (tipo==""){
		tipo=null;
	}
	
	if (  ($("#hidUsuario").val() != $("#usuario").val()) || ($("#hidCampo1").val() != $("#campo1").val())
		|| ($("#hidCampo2").val() != $("#campo2").val()) || (($("#hidCampo3").val() != $("#campo3").val())) 
		||  ($("#hidClave").val() != $("#clave").val()) || (tipo != $("#tipo").val()))
		

 		$("#botUsuario").attr("disabled",false);
 	
 	
 	else 
 		$("#botUsuario").attr("disabled",true);

 	
 	
}
//función que permite administrar las acciones sobre los usuarios como agregar, modificar y eliminar 
//Parámetros de entrada: codigo: entero que representa el código del usuario a eliminar o modificar
//						 acción : cadena que representa la acción a ejecutar a= agregar, m=modificar, e=eliminar.
//Valor de retorno ninguno.
 function admUsuario(accion="a",tipo,codigo=null,usuario=null){
 	

 	if (accion=="a" &&  valCampos()){
 		
 		agregar(sucAgregar);
 		$("#botUsuario").attr("disabled",true);

 	}
 	if (accion=="m"   && valCampos(accion,tipo)){
 		modificar(sucModificar);
 	}

 	if (accion=="e"){

 		var r = confirm("Está seguro que desea eliminar el usuario "+usuario);
 		if (r==true)
 			eliminar(codigo,tipo,usuario,sucEliminar);
 	}

}

//función que permite hacer una petición al servidor de agregar un usuario.
//Parámetros de entrada:funSucces: función que se ejecutará cuando traiga la información de la petición.
//valor de retorno: ninguno.
function agregar(funSucces){
	
	try {
		tipo=$("#tipo").val();
		tipo=tipo[0];
	} catch (e) {
		e instanceof TypeError;
	}


	if (tipo=="U"){
		var a=Array("m_modulo","usuario","m_accion","agregar","usuSistema",$("#usuario").val(),
			"clave",$("#clave").val(),"tipo",tipo,"campo1",$("#campo1").val(),
			"campo2",$("#campo2").val(),"campo3",$("#campo3").val()
			);
		ajaxMVC(a,funSucces,error);
	}
	if (tipo=="R"){
		var a=Array("m_modulo","usuario","m_accion","agregar","usuSistema",$("#usuario").val(),
			"tipo",tipo,"campo1",$("#campo1").val(),
			"campo2",$("#campo2").val(),"campo3",$("#campo3").val()
			);
		ajaxMVC(a,funSucces,error);
	}
}
//función que permite mostrar los respectivos mensaje dependiendo de la respuesta de la petición de agregar usuario
//Parámetros de entrada: data: objeto que contiene la información traída del servidor.
//Valor de retorno:ninguno.
function sucAgregar(data){
	
	if (data.estatus >0){
		mostrarMensaje("Usuario "+  $("#usuario").val()  +" agregado con éxito",1);
		$("#codUsuario").val(data.codUsuario);
		$("#patUsuarios").val($("#usuario").val() )
		filUsuarios(mosUsuarios);
		forUsuario("m",data.tipo,data.codUsuario,$("#usuario").val());

	}
	else 
		mostrarMensaje(data.mensaje,2);
	//	mostrarMensaje("Error al agregar el usuario "+$("#usuario").val() + ", puede ser que ya exista",2);

}

//Función que permite validar los campos del usuario
//Parámetros de entrada: acción : cadena que representa la acción del formulario.
//valor de retorno: true en caso de seguir los lineamientos y false de lo contrario.

function valCampos(accion="a",tip){

	try {
		tipo=$("#tipo").val();
		tipo=tipo[0];
	} catch (e) {
		e instanceof TypeError;
	}
	if (accion=="a"){

		if ((tipo=="U" && validarTextoNumeros("#usuario",1,30,true) && validarRangos("#campo1",1,30,false) &&
			validarRangos("#campo2",1,30,false) && validarRangos("#campo3",1,30,false) &&
			validarRangos("#clave",1,30,true) && validarRangos("#clave2",1,30,true)  && comContraseña("#clave","#clave2"))

		  	|| (tipo==null && validarTextoNumeros("#usuario",1,30,true) && validarRangos("#campo1",1,30,false) &&
			validarRangos("#campo2",1,30,false) && validarRangos("#campo3",1,30,false) &&
			validarRangos("#clave",1,30,true) && validarRangos("#clave2",1,30,true) && 
		    valNoInput("#tipo","#selTipo","El tipo de usuario es requerido") && comContraseña("#clave","#clave2"))

		  	|| (tipo=="R" && validarTextoNumeros("#usuario",1,30,true) && validarRangos("#campo1",1,30,false) &&
			validarRangos("#campo2",1,30,false) && validarRangos("#campo3",1,30,false) )

		    )
			
			return true;
		else 
			return false;	
		//si es modificar
	}else{
	
		if (tipo==null){
			 valNoInput("#tipo","#selTipo","El tipo de usuario es requerido")
			 return false;
		}


		if (tipo=='R'){

			if (validarRangos("#campo1",1,30,false) && validarRangos("#campo2",1,30,false) && validarRangos("#campo3",1,30,false))
				return true;
			else 
				return false;
		}else{

			if (($("#contActual").length==0) && ($("#hidTipo").val()=="U") ) {

				if (validarRangos("#campo1",1,30,false) && validarRangos("#campo2",1,30,false) && validarRangos("#campo3",1,30,false))
					return true;
				else 
					return false;
			}else{
				if ($("#hidTipo").val()=="R" )
					if (validarRangos("#campo1",1,30,false) && validarRangos("#campo2",1,30,false) && validarRangos("#campo3",1,30,false) &&
					validarRangos("#clave",1,30,true) && validarRangos("#clave2",1,30,true)  && comContraseña("#clave","#clave2"))
						return true;
					else
						return false;

				if (validarRangos("#campo1",1,30,false) && validarRangos("#campo2",1,30,false) && validarRangos("#campo3",1,30,false) &&
					validarRangos("#clave",1,30,true) && validarRangos("#clave2",1,30,true)  && comContraseña("#clave","#clave2") && validarRangos("#contActual",1,30,true))
					return true;
				else
					return false;

			}



		}
		

	}




}
//Función que permite obtener un usuario según su código a través de una petición al servidor.
//Parámetros de entrada: codigo: entero que representa el código del usuario.
//						funSucces: función que ejecutará una vez que llegue la respuesta de la petición al servidor.	
function obtener(codigo,funSucces,tipo,usuario=null){

	var a=Array("m_modulo","usuario","m_accion","obtener","codigo",codigo,"tipo",tipo,"usuario",usuario
		);
	ajaxMVC(a,funSucces,error);


}
//Función que permite saber cual fue el resultado la búsqueda del usuario por su código y montarlo en sus input correspondientes
//Parámetros de entrada: data: objeto que representa la respuesta del servidor.
//Valor de retorno:niinguno.
function sucObtener(data){
	if (data.estatus>0){
		usuario=data.usuario[0];
		$("#codUsuario").val(usuario.codigo);
		$("#hidCodigo").val(usuario.codigo);

		$("#usuario").val(usuario.usuario);
		$("#hidUsuario").val(usuario.usuario);

		$('#tipo').selectpicker('val',usuario.tipo);
		$("#hidTipo").val(usuario.tipo);

		if (data.tipo==false)
			$('#tipo').attr('disabled','');

		$("#campo1").val(usuario.campo1);
		$("#hidCampo1").val(usuario.campo1);

		$("#campo2").val(usuario.campo2);
		$("#hidCampo2").val(usuario.campo2);

		$("#campo3").val(usuario.campo3);
		$("#hidCampo3").val(usuario.campo3);

		$("#usuario").prop('disabled', true);
		if (usuario.tipo=="R"){
			$(".claClase").hide();
		}


	}
	else 
		mostrarMensaje(data.mensaje,2);
}
//Función que permite quitar los input de la clave del usuario si se trata de un rol ya que estos no pueden 
//loguearse en el sistemma.
//Parámetros de entrada:ninguno.
//volor de retorno:ninguno.
function quiBotClave(){
	
	try {
		tipo=$("#tipo").val();
		tipo=tipo[0];
	} catch (e) {
		e instanceof TypeError;
	}


	if ( tipo=="U" && !($('#clave').is(":visible")) ){		
		$(".claClase").toggle();
		$("#clave").val("");
		$("#clave2").val("");

	}
	if ( tipo=="R" && ($('#clave').is(":visible")) )		$(".claClase").hide();
	if ( tipo==null && !($('#clave').is(":visible")) ){
		$(".claClase").toggle();
		$("#clave").val("");
		$("#clave2").val("");
		$(".contActual").remove();


	}
	if ( tipo=="R" && ($('#contActual').is(":visible")) )	$(".contActual").remove();



	
}
//Función que permite crear el botón de contraseña anterior para el cambioo de contraseña
//Parámetros de entrada: accion: cadena que representa la acción a agregar, m modificar, e eliminar
//Valor de retorno: ninguno.
function creBotPasAnterior(accion){
 var cadena="";
	if (accion=="m"){
	 	if ($("#clave").val()=="" ){
	 		$(".contActual").remove();
	 	
	 	}
	 	else {
	 		if ($("#contActual").length == 0 && $("#hidTipo").val()!= "R"){
	 			
	 			cadena+="<div class='col-lg-6 contActual'>";
		 		cadena+='<div class="input-group contActual ">';
				cadena+='<span class="input-group-addon contActual" title="Contraseña actual"><i class="icon-key"></i></span>';
				cadena+='<input type="password" class="form-control 1 contActual " placeholder="Contraseña actual" id="contActual" >';
				cadena+="</div>";
				cadena+="</div>";
				cadena+="<div class='col-lg-6 contActual'>";
				cadena+="</div>";
				$(cadena).appendTo("#claAnterior");

			}
		}			



	}
}
//Función que permite modificar un usuario ya se de base de datos o no.
//Parámetros de entrada: funSucces: función que se ejecutrá cuando regrese la petión del servidor.
//Valor de retorno: ninguno
function modificar(funSucces){
	try {
		tipo=$("#tipo").val();
		tipo=tipo[0];
	} catch (e) {
		e instanceof TypeError;
	} 
	if (tipo=="R" || tipo=="U"){
		var a=Array("m_modulo","usuario","m_accion","modificar","codigo",$("#codUsuario").val(),
			"usuario",$("#usuario").val(),"tipo", tipo, "campo1",$("#campo1").val(),
			"campo2",$("#campo2").val(),"campo3",$("#campo3").val(),"clave",$("#clave").val(),
			"claAnterior",$("#contActual").val(),"tipAnterior",$("#hidTipo").val() 
			);
		ajaxMVC(a,funSucces,error);
	}
}
//Función que permite verificar la repuesta del servidor cuando la acción es modificar.
//Parámetros de entrada: data: objeto que contien la respuesta del servidor.
//Valor de retorno: Ninguno. 
function sucModificar(data){
	if (data.estatus>0){

		try {
			var tipo=$("#tipo").val();
			tipo=tipo[0];
		} catch (e) {
			e instanceof TypeError;
		}	
		mostrarMensaje(data.mensaje,1);
		$("#patUsuarios").val($("#usuario").val());
		filUsuarios(mosUsuarios);
		$("#hidCodigo").val($("#codUsuario").val());
		$("#hidUsuario").val($("#usuario").val());

		$("#hidTipo").val(tipo);
		$("#hidCampo1").val($("#campo1").val());
		$("#hidCampo2").val($("#campo2").val());
		$("#hidCampo3").val($("#campo3").val());
		$("#hidClave").val($("#clave").val());
		$("#botUsuario").attr("disabled",true);



	}
	else 
		mostrarMensaje(data.mensaje,2);


}

//Función que permite eliminar un usuaro a través de una petición al servidor.
//Parámetros de entrada: codigo: entero que representa el código del usuario a eliminar.
//Valor de retorno: Ninguno. 
function eliminar(codigo,tipo,usuario,funSucces){
	
	var a=Array("m_modulo","usuario","m_accion","eliminar","codigo",codigo,"tipo",tipo,"usuario",usuario
		);
	ajaxMVC(a,funSucces,error);
}
//Función que permite verificar la repuesta del servidor cuando la acción es eliminar.
//Parámetros de entrada: data: objeto que contien la respuesta del servidor.
//Valor de retorno: Ninguno. 
function sucEliminar(data){
	if (data.estatus>0){
		mostrarMensaje(data.mensaje,1);
		$("#forUsuario").remove();
		filUsuarios(mosUsuarios);
	}
	else 
		mostrarMensaje(data.mensaje,2);
}



