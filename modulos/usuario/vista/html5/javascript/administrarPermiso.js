indiModUsuRol=0;  //variable global que esta reprentada por un 0 si se esta buscando buscando la permisologia de un usuario por primera vez
				  //y con un 1 si se esta trabajando ya en la permisologia de un usuario.
idClickUsuRol=""; //variable global donde esta guardado el id del rol o usuario que esta seleccionado.

//--------------------------HOVER LISTA DE USUARIO Y ROLES------------------------
//DESCRIPCIÓN: 	Funcion que permite aparecer el icono de modificar en la lista
//			   	de usuarios y roles de la pantalla cuando se aplica un hover sobre
//			   	el elemento con la clase usuAcciones o rolAcciones.
//PARAMETROS DE ENTRADA: No posee.
//VALOR DE RETORNO: No posee. 	 
//---------------------------------------------------------------------------------
function hoverUsuRolAcciones(){
	$(".usuAcciones").hover(
				function() {
					$( "#icoUsu"+obtenerID($(this).attr("id"),1)).show();
					$("#"+$(this).attr("id")).css("color", "#6F4B73");
                    $("#"+$(this).attr("id")).css("font-size", "18px");
				},
				function() {
					if (idClickUsuRol!=$(this).attr("id")) {
						$( "#icoUsu"+obtenerID($(this).attr("id"),1)).hide();
						$("#"+$(this).attr("id")).css("color", "#555555");
                    	$("#"+$(this).attr("id")).css("font-size", "15px");
					}
				}
	);

	$(".rolAcciones").hover(
				function() {
					$( "#icoRol"+obtenerID($(this).attr("id"),1)).show();
					$("#"+$(this).attr("id")).css("color", "#19A563");
                    $("#"+$(this).attr("id")).css("font-size", "18px");
					
				},
				function() {
					if (idClickUsuRol!=$(this).attr("id")) {
						$( "#icoRol"+obtenerID($(this).attr( "id" ),1)).hide();
						$("#"+$(this).attr("id")).css("color", "#555555");
                    	$("#"+$(this).attr("id")).css("font-size", "15px");
					}
				}
	);
}
//--------------------------DOCUMENTO LISTO------------------------------------------
//DESCRIPCIÓN: 	Funcion que permite ejecutar funciones despues que la pagina
//				esta completamente cargada, esto evita que se carguen funcionalidades
//				a elementos sin que estos no existan.
//PARAMETROS DE ENTRADA: No posee.
//VALOR DE RETORNO: No posee. 	 
//----------------------------------------------------------------------------------
$(document).ready(function() {
ocultarIconos('.icoModUsuario');
ocultarIconos('.icoModRol');	
hoverUsuRolAcciones();
cliRolUsuarios();
verUsuModificar();	

});

//--------------------------OCULTAR ICONOS------------------------------------------
//DESCRIPCIÓN: 	Funcion que permite ocultar los iconos de modificar (pensil) que se
//              encuentran en la lista de usuarios y roles. Esta función se le pude
//              aplicar a los elementos que tengan como clase icoModRolUsuario.
//PARAMETROS DE ENTRADA: String que puede ser una clase como un id.
//VALOR DE RETORNO: No posee. 	 
//----------------------------------------------------------------------------------
function ocultarIconos(elemento){
	$(elemento).hide();
}

//-------------------------CLICK LISTA USUARIOS Y ROLES------------------------------
//DESCRIPCIÓN: 	Función que permite colocarle propiedades css a el usuario o rol
//				al cual se le haya dado click y desaparece los iconos de los otros
//				usuarios o roles que esten activos.
//PARAMETROS DE ENTRADA: No posee.
//VALOR DE RETORNO: No posee. 	 
//----------------------------------------------------------------------------------
function cliRolUsuarios(){


    $( ".usuAcciones" ).click(
                function() {
                    ocultarIconos('.icoModUsuario');
					ocultarIconos('.icoModRol');
  
                    $("#"+idClickUsuRol).css("background-color", "white");
                    $("#"+idClickUsuRol).css("color", "#555555");
                    $("#"+idClickUsuRol).css("font-size", "15px");
                    idClickUsuRol=$(this).attr("id");
                    $("#"+idClickUsuRol).css("color", "#6F4B73");
                    $("#"+idClickUsuRol).css("font-size", "18px");
                    $("#icoUsu"+obtenerID(idClickUsuRol,1)).show();
                }
    );

    $( ".rolAcciones" ).click(
                function() {
                    ocultarIconos('.icoModUsuario');
					ocultarIconos('.icoModRol');
                    $("#"+idClickUsuRol).css("background-color", "white");
                    $("#"+idClickUsuRol).css("color", "#555555");
                    $("#"+idClickUsuRol).css("font-size", "15px");
                    idClickUsuRol=$(this).attr("id");
                    $("#"+idClickUsuRol).css("color", "#19A563");
                    $("#"+idClickUsuRol).css("font-size", "18px");
                    $("#icoRol"+obtenerID(idClickUsuRol,1)).show();
                }
    );
}
//-------------------------INICIAR SWITCHES------------------------------
//DESCRIPCIÓN: 	Funcion que permite configurar un swiches, el del id pasado por 
//				parametro y le configura la animacion, el valor, los nombres,
//				colores y entre otros valores.
//PARAMETROS DE ENTRADA: String con el id del swiches que se configurara.
//VALOR DE RETORNO: No posee. 	 
//----------------------------------------------------------------------------------
function iniSwitch(activador,estate=false){
	$("#"+activador).bootstrapSwitch();
	$("#"+activador).bootstrapSwitch("animate",true);
	$("#"+activador).bootstrapSwitch("state",estate);
	$("#"+activador).bootstrapSwitch("onText","ON");
	$("#"+activador).bootstrapSwitch("offText","OFF");
	$("#"+activador).bootstrapSwitch("labelText","Acción");
	$("#"+activador).bootstrapSwitch("onColor","success");
	$("#"+activador).bootstrapSwitch("offColor","danger");
	$("#"+activador).bootstrapSwitch("size","mini");
	$("#"+activador).bootstrapSwitch("onSwitchChange",oncSwiches);
}
//-------------------------ACTIVAR SWITCHES------------------------------
//DESCRIPCIÓN: 	Funcion permite activar el switches y pasarlo de un check 
//				al swinches.
//PARAMETROS DE ENTRADA: String con el id del swiches que se activara.
//VALOR DE RETORNO: No posee. 	 
//----------------------------------------------------------------------------------
function activarSwitch(swiche){

	if (swiche == false && $("#"+swiche).bootstrapSwitch("state")==false){
		eveSwiches("click",$("#"+swiche).bootstrapSwitch("state"));
	}
}
//-------------------------BUSCAR USUARIOS-----------------------------------------
//DESCRIPCIÓN: 	Funcion que permite lanzar una petición ajax al servidor que obtiene
//				la lista de usuarios ya sea filtrada o ordenada por rol o usuarios
//				si el check de solo roles esta activo ordenara por roles y si esta 
//				desactivado ordenara por usuarios y filtra por el #patronusuariosRoles
//				y llamara a la función sucBusUsuarios que se encargara de armar la lista
//				de usuarios ya filtrada u ordenada.
//PARAMETROS DE ENTRADA: No posee.
//VALOR DE RETORNO: 	 No posee. 	 
//----------------------------------------------------------------------------------
function busUsuarios(){
	order="usuario";
	if ($("#checkPriRoles").is(':checked'))
		order="tipo"
	patron= $("#patronUsuariosRoles").val();
	var a=Array("m_modulo","usuario","m_accion","filtrar",
			    "patUsuario",patron,"order",order);
	ajaxMVC(a,sucBusUsuarios,error);
}
//-------------------------SUCCES BUSCAR USUARIOS-----------------------------------------
//DESCRIPCIÓN: 	Funcion que permite remover la lista de usuarios y armar la nueva lista 
//				de usuarios que se encuentran en el parametro data.usuarios y cargarlos al
//				html al id #panelUsuarioRoles.
//PARAMETROS DE ENTRADA: Data objeto Ajax.
//VALOR DE RETORNO: 	 No posee. 	 
//----------------------------------------------------------------------------------
function sucBusUsuarios(data){
	$("#listaUsuRoles").remove();
	cadena="<div class='list-group' id='listaUsuRoles'>";
	if (data.usuarios){
		for (var i=0; i< data.usuarios.length;i++){
			if (data.usuarios[i].tipo=='U'){
				tipoUsu = 'Usuario';
  				clas = 'usuAcciones';
    			idIco = 'icoUsu';
    			classIco = 'icoModUsuario';
    		}else{
    			tipoUsu = 'Rol';
  				clas = 'rolAcciones';
    			idIco = 'icoRol';
    			classIco = 'icoModRol';
    		}

    			cadena+="<a id="+data.usuarios[i].tipo+data.usuarios[i].codigo+" class='list-group-item "+clas+"'>"; 
    				cadena+="<div class='row'>";
    					cadena+="<div class='col-xs-2 col-sm-2 col-md-2 col-lg-2'>"+data.usuarios[i].codigo  +"</div>";
    					cadena+="<div class='col-xs-5 col-sm-5 col-md-5 col-lg-5'>"+data.usuarios[i].usuario  +"</div>";
    					cadena+="<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3'>"+ tipoUsu +"</div>";
    					cadena+="<div class='col-xs-2 col-sm-2 col-md-2 col-lg-2'>";
    						cadena+="<i id='"+idIco+data.usuarios[i].codigo+"' title='Modificar permisos' onclick=\" modUsuAcciones("+data.usuarios[i].codigo+",'"+data.usuarios[i].usuario+"')\" class='icon-pencil "+classIco+" '></i>";
    					cadena+="</div>";
    				cadena+="</div>";
    			cadena+="</a> ";

		}
	}else{
		cadena+="<a id='sinResultado' class='list-group-item rolAcciones'>"; 
   			cadena+="<div class='row'>";
    			cadena+="<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'><center> <i title='' class='icon-info-sign'></i> No existe coincidencia <i title='' class='icon-question-sign  '></i>  </center></div>";
    		cadena+="</div>";
    	cadena+="</a> ";
	}
	cadena+="</div>";
	$(cadena).appendTo("#panelUsuarioRoles");
	ocultarIconos('.icoModUsuario');
	ocultarIconos('.icoModRol');	
	hoverUsuRolAcciones();
	cliRolUsuarios();
	idClickUsuRol=""; 

}
//-------------------------VERIFICAR USUARIO A MODIFICAR----------------------------------------
//DESCRIPCIÓN: 	Funcion que permite verificar si hay algun usuario que modificar cuando se carga la
//				pagina para cargarle sus permisos y todo lo correspondiente, verifica elo id usuModificar.
//PARAMETROS DE ENTRADA: No posee.
//VALOR DE RETORNO: 	 No posee. 	 
//-----------------------------------------------------------------------------------------------
function verUsuModificar(){

	if ($("#usuModificar").val()!=''){
		 autRolUsuarios();
		obtPermisos($("#usuModificar").val(),sucBusAccionesUsuarios);
	}

}
//-------------------------OBTENER PERMISOS----------------------------------------
//DESCRIPCIÓN: 	Funcion que permite enviar una peticion ajax al servidor para obtener los permisos
//				ya sea de un usuario o sin usuario y tambn permite filtrar en la busqueca de las
//				acciones.
//PARAMETROS DE ENTRADA: No posee.
//VALOR DE RETORNO: 	 No posee. 	 
//-----------------------------------------------------------------------------------------------
function obtPermisos(usuario,success){

	patronUsuAcciones=$("#busAccionesUsuarios").val();

	var a=Array("m_modulo","usuario","m_accion","obtenerPermisos",
			    "patAcciones",patronUsuAcciones,"usuario",usuario);

	ajaxMVC(a,success,error);

}
//-------------------------SUCCES BUSCAR ACCIONES DE USUARIOS----------------------------------------
//DESCRIPCIÓN: 	Funcion que se encarga de armar la lista de acciones que posee y no posee el usuario
//				para su asignacion o negacion de estas mismas..
//PARAMETROS DE ENTRADA: No posee.
//VALOR DE RETORNO: 	 No posee. 	 
//-----------------------------------------------------------------------------------------------
function sucBusAccionesUsuarios(data){
	$("#swichesAcciones").remove();
	cadena="<div class='list-group' id='swichesAcciones'> </div>";
	$(cadena).appendTo("#listaPanelAccionesUsuarios");
	//console.log(data);
	if (data.permisos){
		cadena='';

		if (indiModUsuRol==0){
			tabAcciones= new Array();
		}	

		for (var i=0; i< data.permisos.length;i++){
			if (indiModUsuRol==0 || tabAcciones["A"+data.permisos[i]['cod_accion']]==undefined){
				var arreglo= new Array(3);
				arreglo["codAccion"]=data.permisos[i]['cod_accion'];
				if (data.permisos[i]["cod_usu_accion"]!=null){
					arreglo["valInicial"]=true;
					arreglo["valActual"]=true;
					var canPermisos=parseInt($("#canPermisos").val())+1;
					$("#canPermisos").val(canPermisos);
					$("#removerTodas").attr("disabled",false);
				}else{
					arreglo["valInicial"]=false;
					arreglo["valActual"]=false;
				}
				if (indiModUsuRol==1 && tabAcciones["A"+data.permisos[i]['cod_accion']]==undefined ){
					var canIguales=parseInt($("#canIguales").val())+1;
					$("#canIguales").val(canIguales);
				}
				tabAcciones['A'+arreglo['codAccion']]=arreglo;

			}

			if (tabAcciones["A"+data.permisos[i]['cod_accion']]['valInicial'] == tabAcciones["A"+data.permisos[i]['cod_accion']]['valActual']) {
				var colorIcono="iconAzul";
				if (indiModUsuRol==0){
					var canIguales=parseInt($("#canIguales").val())+1;
					$("#canIguales").val(canIguales);
				}
			}
			if (tabAcciones["A"+data.permisos[i]['cod_accion']]['valInicial'] != tabAcciones["A"+data.permisos[i]['cod_accion']]['valActual']){
				if (tabAcciones["A"+data.permisos[i]['cod_accion']]['valInicial'])
					var colorIcono="iconRojo";
				else
					var colorIcono="iconVerde";
			}


			cadena+="<a class='list-group-item ' id='ac1'>";
				cadena+="<div class='row'>";
				cadena+="<div class='col-xs-2 col-sm-2 col-md-2 col-lg-2'> ";				
		 				cadena+=data.permisos[i]['cod_accion']; 
		 			cadena+="</div>";
					cadena+="<div class='col-xs-6 col-sm-6 col-md-6 col-lg-6'> ";				
		 				cadena+=data.permisos[i]['nombre']; 
		 			cadena+="</div>";
					cadena+="<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3'>"; 
		 				cadena+="<input  id='swiAcc"+data.permisos[i]['cod_accion']+"' name='chect' type='checkbox'  checked>";
		 			cadena+="</div>";
		 			cadena+="<div class='col-xs-1 col-sm-1 col-md-1 col-lg-1'>"; 
		 				cadena+="<i id='ast"+data.permisos[i]['cod_accion']+"' class='icon-asterisk iconListaAcciones "+colorIcono+"'></i>";
		 			cadena+="</div>";
		  		cadena+="</div>";
		  	cadena+="</a>";
		  	swichesAcciones
		  	$(cadena).appendTo("#swichesAcciones");

		  		iniSwitch("swiAcc"+data.permisos[i]['cod_accion'],tabAcciones["A"+data.permisos[i]['cod_accion']]['valActual']);

		  	cadena="";
		}
	}else{
		cadena="<a class='list-group-item '' id='ac1'>";
				cadena+="<div class='row'>";
					cadena+="<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'> ";				
		 				cadena+="<center> <i title='' class='icon-info-sign'></i> No existe coincidencia <i title='' class='icon-question-sign  '></i>  </center>";
		 			cadena+="</div>";
		  		cadena+="</div>";
		  	cadena+="</a>";
		  	$(cadena).appendTo("#swichesAcciones");

	}
	//console.log(tabAcciones);
	indiModUsuRol=1;

	$("#conRevocadas").remove();
	$("<i id='conRevocadas' class='iconRojo textoPequeno '>"+$("#canRevocar").val()+"</i>").appendTo("#h5canRevocadas");
	$("#conAgregar").remove();
	$("<i id='conAgregar' class='iconVerde textoPequeno '>"+$("#canAgregar").val()+"</i>").appendTo("#h5canAgregadas");
	$("#conIguales").remove();
	$("<i id='conIguales' class='iconAzul textoPequeno '>"+ $("#canIguales").val()+"</i>").appendTo("#h5canIguales");
}

//----------------------------MODIFICAR USUARIO ACCIONES------------------------------------------
//DESCRIPCIÓN: 	Funcion que permite preparar un usuario para modificar su permisologia en acciones
//				ya sea agregar, modificar o clonar las de otro usuario.
//PARAMETROS DE ENTRADA: Integer codUsuario.    Codigo del usuario a modificar sus permisos.
//						 String  usuario.       usuario al cual se modificara sus permisos.    
//VALOR DE RETORNO: 	 No posee. 	 
//-----------------------------------------------------------------------------------------------
function modUsuAcciones(codUsuario,usuario){

	$("#canPermisos").val(0);
	$("#canIguales").val(0);
	$("#canAgregar").val(0);
	$("#canRevocar").val(0);
	window.history.pushState("", "Modificar Permisos "+usuario,"index.php?m_modulo=usuario&m_formato=html5&m_accion=administrarPermisos&m_vista=AdministradorPermisos&usuario="+usuario);

	$("#usuModificar").val(usuario);
	$("#codUsuModificar").val(codUsuario);
	$("#panelAccionesUsuarios").remove();
	cadena="<div id='panelAccionesUsuarios' class='panel panel-default' >"
		cadena+="<div class='list-group'>";
			cadena+="<a class='list-group-item verde' id='tituloModificarPermiso'> ";
				cadena+="<div class='row'>";
					cadena+="<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 blanco'> ";
		 				cadena+="<center> <h4 class='sinSalto'>Modificar Permisos</h4> </center>";
		 			cadena+="</div>";
		 		cadena+="</div>";
		  	cadena+="</a>";
		cadena+="</div>";
		cadena+="<div class='row'>";
			cadena+="<div class='col-xs-1 col-sm-1 col-md-1 col-lg-1'></div>";
			cadena+="<div class='col-xs-6 col-sm-6 col-md-6 col-lg-6'>";
			    cadena+="<h4> <i class='icon-user' id='icoUserInfo' ></i> Usuario :"+usuario+"  </h4>";
			cadena+="</div>";
			cadena+="<div class='col-xs-5 col-sm-5 col-md-5 col-lg-5'> <h4>#id:"+codUsuario+" </h4> </div>"
		cadena+="</div>";
		cadena+="<br>";
		cadena+="<div class='row'>";
			cadena+="<div class='col-xs-1 col-sm-1 col-md-1 col-lg-1'></div>";
			cadena+="<div class='col-xs-4 col-sm-4 col-md-4 col-lg-4 sinPadding'>";
				cadena+="<h5 class='azul titBold'> Clonar permisos de"; 
					cadena+="<i class='icon-chevron-right' id='icoUserInfo' ></i>";
					cadena+="<i class='icon-chevron-right' id='icoUserInfo' ></i>"; 
				cadena+="</h5>";
			cadena+="</div>";
			cadena+="<div class='col-xs-6 col-sm-6 col-md-6 col-lg-6 sinPadding'>";
			    cadena+="<div class='input-group'>";
					cadena+="<span class='input-group-addon' title='Buscar usuario o rol a clonar'>"
	  					cadena+="<i> <img src='recursos/assets/ico/copiar.png' height='20px' width='20px' class='img-circle  '></i>";
	  				cadena+="</span>";
	  				cadena+="<input  id='busUsuarioRolesClonar' type='text' class='form-control 1' placeholder='Buscar usuario o rol a clonar' >";
				cadena+="</div>";
			cadena+="</div>";
		cadena+="</div>";
		cadena+="<br> <br>";
		cadena+="<div class='row'>";
			cadena+="<div class='col-xs-1 col-sm-1 col-md-1 col-lg-1'></div>";
			cadena+="<div class='col-xs-4 col-sm-4 col-md-4 col-lg-7'>";
				cadena+="<div class='input-group'>";
					cadena+="<span class='input-group-addon' title='Buscar acciones'><i class='icon-search'></i>";
	  				cadena+="</span>";
	  				cadena+="<input oninput=\"obtPermisos('"+$("#usuModificar").val()+"',sucBusAccionesUsuarios)\" id='busAccionesUsuarios' type='text' class='form-control 1' placeholder='Buscar acciones' >";
				cadena+="</div>";
			cadena+="</div>";
			cadena+="<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3 '>";
				cadena+="<button onclick='removerTodas()' id='removerTodas' type='button' disabled title='Remover todas las acciones 'class='btn btn-danger btn-md'>";
	  				cadena+="<span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Remover todas";
				cadena+="</button>";
			cadena+="</div>";
		cadena+="</div>";
		cadena+="<br>";
		cadena+="<div class='row'> ";
			cadena+="<div class='col-xs-1 col-sm-1 col-md-1 col-lg-1 '> </div>";
			cadena+="<div class='col-xs-10 col-sm-10 col-md-10 col-lg-10 ' id='listaAccionesUsuarios'>"; 
				cadena+="<div id='listaPanelAccionesUsuarios' class='panel panel-default' > ";
					cadena+="<div class='list-group'>";
						cadena+="<a class='list-group-item azulClaro' id='tituloListaAccionesUsuarios'>"; 
							cadena+="<div class='row'>";
		 						cadena+="<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 blanco'>"; 
		 							cadena+="<center> <h4 class='sinSalto'>Lista de permisos en acciones</h4> </center>";
		 						cadena+="</div>";
		  					cadena+="</div>";
		  				cadena+="</a>";
			        cadena+="</div>";
					cadena+="<div class='list-group' id='swichesAcciones'>";
					cadena+="</div>";
			    cadena+="</div>";
			cadena+="</div>";
			cadena+="<div class='col-xs-1 col-sm-1 col-md-1 col-lg-1 '> </div>";
		cadena+="</div>";
		cadena+="<div class='row'>";
			cadena+="<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 '>";
				cadena+="<center>";
					cadena+="<button id='botGuaPErmisos' onclick='guaPermisos()' disabled type='button' title='Guardar Cambios' class='btn btn-info btn-xs'>"
	  					cadena+="<span class='glyphicon glyphicon-floppy-disk' aria-hidden='true'></span> Guardar Cambios";
					cadena+="</button>";
				cadena+="</center>";
			cadena+="</div>";
		cadena+="</div>";
		cadena+="<div class='row'>";
			cadena+="<div class='col-xs-1 col-sm-1 col-md-1 col-lg-1 '> </div>";
			cadena+="<div class='col-xs-4 col-sm-4 col-md-4 col-lg-4 '>";
				cadena+="<h5 id='h5canIguales' class='textoPequeno'>";
					cadena+=" <i  class='icon-asterisk iconListaAcciones iconAzul sinSalto'></i> Se mantienen: <i id='conIguales' class='iconAzul textoPequeno '> </i>";
				cadena+="</h5>";
			cadena+="</div>";
			cadena+="<div class='col-xs-4 col-sm-4 col-md-4 col-lg-4 '>";
				cadena+="<h5  id='h5canAgregadas' class='textoPequeno'>";
					cadena+=" <i class='icon-asterisk iconListaAcciones iconVerde sinSalto'></i> A agregar: <i id='conAgregar' class='iconVerde textoPequeno '> </i>";
				cadena+=" </h5>";
			cadena+="</div>";
			cadena+="<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3 '>";
				cadena+="<h5 id='h5canRevocadas' class='textoPequeno'>";
					cadena+=" <i class='icon-asterisk iconListaAcciones iconRojo sinSalto'></i> A revocar: <i id='conRevocadas' class='iconRojo textoPequeno '> 	</i>";
				cadena+=" </h5>";
			cadena+="</div>";
		cadena+="</div>";
		cadena+="<br>";
	cadena+="</div>";

	$(cadena).appendTo("#divAdmPerUsuarios");	
	obtPermisos($("#usuModificar").val(),sucBusAccionesUsuarios);
	autRolUsuarios();
	indiModUsuRol=0;
}

//----------------------------AUTOCOMPLETAR BUSQUEDA USUARIOS------------------------------------------
//DESCRIPCIÓN: 	Funcion que cargar el metodo de autocompletar al input #busUsuarioRolesClonar que es donde
//				se busca al usuario o rol que se desea clonar su permisologia.
//PARAMETROS DE ENTRADA: No posee
//VALOR DE RETORNO: 	 No posee. 	 
//-----------------------------------------------------------------------------------------------
function autRolUsuarios(){

$("#busUsuarioRolesClonar").autocomplete({
			delay: 100,  //milisegundos
			minLength: 1,
			source: function( request, response ) {
				var a=Array("m_modulo","usuario",
							"m_accion","autocompletarUsuario",
							"patron",request.term
							);
				ajaxMVC(a,function(data){  
							return response(data);  
						  },
						  function(data){
						  	console.log(data);	
							return response([{"label": "Error de conexión", "value": {"usuario(usuario)":""}}]); 
					
						   }
						);


			},
			select: function (event, ui){
				//alert(ui.item.value);
				clonarUsuario(ui.item.value);

			},
			focus: function (event, ui){
				$(this).val(ui.item.value);
				event.preventDefault();
			}	
	});
}
//----------------------------ONCHANGE SWICHES---------------------------------------------------
//DESCRIPCIÓN: 	Funcion que se ejecuta cuando ocurre un cambio de valor de los swiches y le configura
//				el valor en la la matriz tabAcciones que es la que lleva el control de todo los que 
//				se ha modificado en la permisologia del usuario, esta funcion cambia el color del *
//				que se encuentra al lado derecho del swiches azul de no haber cambios, rojo de que
//				se revocara una accion y verde de que se asignara un opcion.
//PARAMETROS DE ENTRADA: No posee
//VALOR DE RETORNO: 	 No posee. 	 
//-----------------------------------------------------------------------------------------------
function oncSwiches(evento,state){
	codigoAccion=obtenerID(evento.target.id,6);
	tabAcciones['A'+codigoAccion]['valActual']=state;

	if (tabAcciones["A"+codigoAccion]['valInicial'] == tabAcciones["A"+codigoAccion]['valActual']){
		$("#ast"+codigoAccion).css("color", "#3DB8EC");
		var canIguales=parseInt($("#canIguales").val())+1;
			$("#canIguales").val(canIguales);

		if (tabAcciones["A"+codigoAccion]['valInicial']){
			var canRevocar=parseInt($("#canRevocar").val())-1;
			$("#canRevocar").val(canRevocar);
			var canPermisos=parseInt($("#canPermisos").val())+1;
			$("#canPermisos").val(canPermisos);
			$("#removerTodas").attr("disabled",false);	
		}else{
			var canAgregar=parseInt($("#canAgregar").val())-1;
			$("#canAgregar").val(canAgregar);
			var canPermisos=parseInt($("#canPermisos").val())-1;
			$("#canPermisos").val(canPermisos);
			if (canPermisos==0)
				$("#removerTodas").attr("disabled",true);
		}
	}

	if (tabAcciones["A"+codigoAccion]['valInicial'] != tabAcciones["A"+codigoAccion]['valActual']){
		if (tabAcciones["A"+codigoAccion]['valInicial']){
			var canRevocar=parseInt($("#canRevocar").val())+1;
			$("#canRevocar").val(canRevocar);
			var canIguales=parseInt($("#canIguales").val())-1;
			$("#canIguales").val(canIguales);

			$("#ast"+codigoAccion).css("color", "#CE2A40");
			var canPermisos=parseInt($("#canPermisos").val())-1;
			$("#canPermisos").val(canPermisos);
			if (canPermisos==0)
				$("#removerTodas").attr("disabled",true);	
		}else{

			var canAgregar=parseInt($("#canAgregar").val())+1;
			$("#canAgregar").val(canAgregar);
			var canIguales=parseInt($("#canIguales").val())-1;
			$("#canIguales").val(canIguales);


			$("#ast"+codigoAccion).css("color", "#39AC4A");
			var canPermisos=parseInt($("#canPermisos").val())+1;
			$("#canPermisos").val(canPermisos);
			$("#removerTodas").attr("disabled",false);	
		}
	}
		if (verificarCambios())
		$("#botGuaPErmisos").attr("disabled",false);
	else
		$("#botGuaPErmisos").attr("disabled",true);
	$("#conRevocadas").remove();
	$("<i id='conRevocadas' class='iconRojo textoPequeno '>"+$("#canRevocar").val()+"</i>").appendTo("#h5canRevocadas");
	$("#conAgregar").remove();
	$("<i id='conAgregar' class='iconVerde textoPequeno '>"+$("#canAgregar").val()+"</i>").appendTo("#h5canAgregadas");
	$("#conIguales").remove();
	$("<i id='conIguales' class='iconAzul textoPequeno '>"+ $("#canIguales").val()+"</i>").appendTo("#h5canIguales");

}
//----------------------------GUARDAR PERMISOS---------------------------------------------------
//DESCRIPCIÓN: 	Funcion que opermite mandar al servidor la speticiones ajax de asignar accion y de
//				revocar accion recorriendo todo la matriz de tabAcciones y verificando cuales son
//				las acciones que se deben revocar y las que se deben asignar a el usuario .
//PARAMETROS DE ENTRADA: No posee
//VALOR DE RETORNO: 	 No posee. 	 
//-----------------------------------------------------------------------------------------------
function guaPermisos(){
	for (var propiedad in tabAcciones){
		pAccion=tabAcciones[ propiedad];
		if (pAccion['valInicial']!=pAccion['valActual']){
			if (pAccion['valInicial'])
				eliminarAccion($("#codUsuModificar").val(),pAccion['codAccion']);
			else
				asignarAccion($("#codUsuModificar").val(),pAccion['codAccion']);
		}
	}

	setTimeout (validarCambios, 500);
	restablecerPermisosBD();
}



function restablecerPermisosBD(){
	var a=Array("m_modulo","usuario","m_accion","restablecerPermisosBD",
			    'usuario',$("#usuModificar").val());
	ajaxMVC(a,sucReBDPermisos,error);

}

function sucReBDPermisos(data){
if (data.estatus>0){
	mostrarMensaje(data.mensaje,1);
}else{
	mostrarMensaje(data.mensaje,2);
}


}
//----------------------------VALIDAR CAMBIOS---------------------------------------------------
//DESCRIPCIÓN: 	Funcion que se llama luego de haber realizado cambios en un usuario ya sea asignandole
//				o revocandole acciones y la funcion verifica que los cambios se hayan realizado en la
//				tabla tabAccion y manda un mensaje por pantalla de usuario modificado con exito y de 
//				algunas permisos fueron guardados y otros fallaron en caso de que fallen algunos.
//PARAMETROS DE ENTRADA: No posee
//VALOR DE RETORNO: 	 No posee. 	 
//-----------------------------------------------------------------------------------------------
function validarCambios(){
	if (verificarCambios()){
		$('#botGuaPErmisos').attr('disabled',false);
		mostrarMensaje('Algunos permisos fueron guardados y otros fallaron',3);
	}else{
		$('#botGuaPErmisos').attr('disabled',true);
		mostrarMensaje('Permisos de usuario modificados con exito',1);
	}
}
//----------------------------ASIGNAR ACCIÓN---------------------------------------------------
//DESCRIPCIÓN: 	Funcion que permite mandar al servidor la peticion ajax para asignar una acción a un usuario				.
//PARAMETROS DE ENTRADA: INTEGER codUsuario    Codigo del usuario al que se le asignara la acción.
//						 INTEGER codAccion     Codigo de la acción que se le asignara al usuario.
//VALOR DE RETORNO: 	 No posee. 	 
//-----------------------------------------------------------------------------------------------
function asignarAccion(codUsuario,codAccion){
	var a=Array("m_modulo","usuario","m_accion","asignarAccion",
			    "codUsuario",codUsuario,"codAccion",codAccion,'usuario',$("#usuModificar").val());
	ajaxMVC(a,sucAsignarAccion,error);
}
//----------------------------ELIMINAR ACCIÓN---------------------------------------------------------------
//DESCRIPCIÓN: 	Funcion que permite mandar al servidor la peticion ajax para revocar una acción a un usuario				.
//PARAMETROS DE ENTRADA: INTEGER codUsuario    Codigo del usuario al que se le revocara la acción.
//						 INTEGER codAccion     Codigo de la acción que se le revocara al usuario.
//VALOR DE RETORNO: 	 No posee. 	 
//---------------------------------------------------------------------------------------------------------
function eliminarAccion(codUsuario,codAccion){
	var a=Array("m_modulo","usuario","m_accion","eliminarAccion",
			    "codUsuario",codUsuario,"codAccion",codAccion,'usuario',$("#usuModificar").val());
	ajaxMVC(a,sucEliminarAccion,error);

}
//----------------------------SUCCCESS ASIGNAR ACCIÓN----------------------------------------------
//DESCRIPCIÓN: 	Success de asignar acción al usuario esta función se ejecuta cuando fue exitosa
//				la petición, se encarga de cambiar de color del * de la accion a azul, cambiar el 
//				valor de la acción en tabAccion de que fue exitosa la asignacion.				.
//PARAMETROS DE ENTRADA: Object Data    Objeto con toda la data mandada del servidor al cliente. 
//VALOR DE RETORNO: 	 No posee. 	 
//-------------------------------------------------------------------------------------------------
function sucAsignarAccion(data){
	if (data.estatus>0){
		$("#ast"+data.codAccion).css("color", "#3DB8EC");
		tabAcciones["A"+data.codAccion]["valActual"]=true;
		tabAcciones["A"+data.codAccion]["valInicial"]=true;
		var canAgregar=parseInt($("#canAgregar").val())-1;
		$("#canAgregar").val(canAgregar);
		var canMantienen=parseInt($("#canIguales").val())+1;
		$("#canIguales").val(canMantienen);
		$("#conIguales").remove();
		$("<i id='conIguales' class='iconAzul textoPequeno '>"+ $("#canIguales").val()+"</i>").appendTo("#h5canIguales");

		$("#conAgregar").remove();
		$("<i id='conAgregar' class='iconVerde textoPequeno '>"+ $("#canAgregar").val() +"</i>").appendTo("#h5canAgregadas");
	}else
		mostrarMensaje(data.mensaje,2);	
}
//----------------------------SUCCCESS ELIMINAR ACCIÓN---------------------------------------------
//DESCRIPCIÓN: 	Success de eliminar acción al usuario esta función se ejecuta cuando fue exitosa
//				la petición, se encarga de cambiar de color del * de la accion a azul, cambiar el 
//				valor de la acción en tabAccion de que fue exitosa la eliminación.				.
//PARAMETROS DE ENTRADA: Object Data    Objeto con toda la data mandada del servidor al cliente. 
//VALOR DE RETORNO: 	 No posee. 	 
//-------------------------------------------------------------------------------------------------
function sucEliminarAccion(data){
	if (data.estatus>0){
		$("#ast"+data.codAccion).css("color", "#3DB8EC");
		tabAcciones["A"+data.codAccion]["valActual"]=false;
		tabAcciones["A"+data.codAccion]["valInicial"]=false;
		var canrevocar=parseInt($("#canRevocar").val())-1;
		$("#canRevocar").val(canrevocar);
		var canMantienen=parseInt($("#canIguales").val())+1;
		$("#canIguales").val(canMantienen);
		$("#conIguales").remove();
		$("<i id='conIguales' class='iconAzul textoPequeno '>"+ $("#canIguales").val()+"</i>").appendTo("#h5canIguales");

		$("#conRevocadas").remove();
		$("<i id='conRevocadas' class='iconRojo textoPequeno '>"+$("#canRevocar").val()+"</i>").appendTo("#h5canRevocadas");
	}else
		mostrarMensaje(data.mensaje,2);
}
//-------------------------------------CLONAR USUARIO---------------------------------------------
//DESCRIPCIÓN: 	Funcion que permite mandar la petición ajax para traer los permisos del usuario
//				que se desea clonar y utiliza como succes la función succClonarUsuarios que se
//				encarga de asignar a tabValores toda la permisologia del usuario que se desea 
//				clonar.				.
//PARAMETROS DE ENTRADA: String usuario    Usuario que se desea clonar. 
//VALOR DE RETORNO: 	 No posee. 	 
//-------------------------------------------------------------------------------------------------
function clonarUsuario(usuario){
	$("#busAccionesUsuarios").val('');
	obtPermisos(usuario,sucClonarUsuarios);
}
//-------------------------------------SUCCESS CLONAR USUARIOS--------------------------------------------
//DESCRIPCIÓN: 	Función que se ejecuta cuando la peticion ajax de clonar usuario es exitosa, función
//				que se encarga de asignarle todo los permisos obtenidos del usuario a clonar a la
//				matriz tabAccion donde se encuentran todos los permisos del usuario que se esta modificando
//				la permisologia.				.
//PARAMETROS DE ENTRADA: Object data    Toda la información mandada del servidor al cliente como los permisos. 
//VALOR DE RETORNO: 	 No posee. 	 
//---------------------------------------------------------------------------------------------------------
function sucClonarUsuarios(data){
	$("#canPermisos").val(0);
	$("#canIguales").val(0);
	$("#canAgregar").val(0);
	$("#canRevocar").val(0);


	for (var i=0; i< data.permisos.length;i++){
		if (tabAcciones["A"+data.permisos[i]['cod_accion']]==undefined){
				var arreglo= new Array(3);
				arreglo["codAccion"]=data.permisos[i]['cod_accion'];
				arreglo["valActual"]=false;
				arreglo["valInicial"]=false;
				tabAcciones['A'+data.permisos[i]['cod_accion']]=arreglo;
		}

		if (data.permisos[i]["cod_usu_accion"]!=null){
			tabAcciones["A"+data.permisos[i]["cod_accion"]]['valActual']=true;
			if (tabAcciones["A"+data.permisos[i]["cod_accion"]]['valInicial']){
			    var canIgual=parseInt($("#canIguales").val())+1;
				$("#canIguales").val(canIgual);
			}else{
				var canAgregar=parseInt($("#canAgregar").val())+1;
				$("#canAgregar").val(canAgregar);
			}
			var canPermisos=parseInt($("#canPermisos").val())+1;
			$("#canPermisos").val(canPermisos);
			$("#removerTodas").attr("disabled",false);
		}else{
			tabAcciones["A"+data.permisos[i]["cod_accion"]]['valActual']=false;
			if (tabAcciones["A"+data.permisos[i]["cod_accion"]]['valInicial']==false){
			    var canIgual=parseInt($("#canIguales").val())+1;
				$("#canIguales").val(canIgual);
			}else{
				var canRevocar=parseInt($("#canRevocar").val())+1;
				$("#canRevocar").val(canRevocar);
			}
		}
		
	}
	console.log(tabAcciones);
	obtPermisos($("#usuModificar").val(),sucBusAccionesUsuarios);
	if (verificarCambios())
		$("#botGuaPErmisos").attr("disabled",false);
	else
		$("#botGuaPErmisos").attr("disabled",true);
}

//-------------------------------------VERIFICAR CAMBIOS--------------------------------------------
//DESCRIPCIÓN:  Función que permite verificar si existe algun cambio en la matriz tab acciones y de existir 
//				algun cambio retorna true y no de existir cambios retorna false.					.
//PARAMETROS DE ENTRADA: No posee. 
//VALOR DE RETORNO: 	 No posee. 	 
//---------------------------------------------------------------------------------------------------------
function verificarCambios(){
	for (var propiedad in tabAcciones){
		pAccion=tabAcciones[ propiedad];
		if (pAccion['valActual']!=pAccion['valInicial'])
			return true;
	}
	return false;
}
//-------------------------------------REMOVER TODAS--------------------------------------------
//DESCRIPCIÓN:  Función que permite remover todas las acciones a un usuario.
//PARAMETROS DE ENTRADA: No posee. 
//VALOR DE RETORNO: 	 No posee. 	 
//---------------------------------------------------------------------------------------------------------
function removerTodas(){
	var cont=0;
	var contt=0
	for (var propiedad in tabAcciones){
		contt++;
		tabAcciones[propiedad]['valActual']=false;
		if (tabAcciones[propiedad]['valInicial'])
			cont++;
	}

	obtPermisos($("#usuModificar").val(),sucBusAccionesUsuarios);
	$("#botGuaPErmisos").attr("disabled",false);
	$("#removerTodas").attr("disabled",true);

	$("#canRevocar").val(cont);
	$("#canIguales").val(contt-cont);
	$("#canPermisos").val(0);
	$("#canAgregar").val(0);
}
