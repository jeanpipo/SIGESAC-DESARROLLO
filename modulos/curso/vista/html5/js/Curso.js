/*
 * * * * * * * * * * LICENCIA * * * * * * * * * * * * * * * * * * * * *

Copyright(C) 2015
Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio

Este programa es Software Libre y usted puede redistribuirlo y/o modificarlo
bajo los términos de la versión 3.0 de la Licencia Pública General (GPLv3)
publicada por la Free Software Foundation (FSF), es distribuido sin ninguna
garantía. Usted debe haber recibido una copia de la GPLv3 junto con este
programa, sino, puede encontrarlo en la página web de la FSF,
específicamente en la dirección http://www.gnu.org/licenses/gpl-3.0.html

 * * * * * * * * * * ARCHIVO * * * * * * * * * * * * * * * * * * * * *

Nombre: Curso.js
Diseñador: Juan De Sousa
Programador: Juan De Sousa
Lider de proyecto: Johan Alamo (johan.alamo@gmail.com)
Fecha:10-1-16
Descripción:
	Este es el javascript del módulo curso, encargado de todas las
	llamadas AJAX, objetos DOM y validaciones de dicho módulo.

 * * * * * * * * Cambios/Mejoras/Correcciones/Revisiones * * * * * * * *
Diseñador - Programador /   Fecha   / Descripción del cambio


 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
*/
/*
 * Función general para obtenerCurso(s)
 *
 * Hace una llamada ajax al módulo curso con la acción listarCursos.
 *
 * Recibe como parámetros:
 *
 * 		codigo 				código del curso a listar (puede ser null para listarlos todos)
 * 		funSucc				Función que se realizará en el success del ajax
 * 		funErr				Función que se realizará en el error del ajax
 */

function obtenerCurso(codigo, funSucc, funErr){
	var arr = Array(	"m_modulo"	,	"curso",
						"m_accion"	,	"listarCursos",
						"codCurso"	,	codigo);

	ajaxMVC(arr, funSucc, funErr);
}

/*
 * Función general para agregar un curso.
 *
 * Hace una llamada ajax al módulo curso con la acción agregar curso.
 *
 * Recibe como parámetros:
 * 		arr					Arreglo con la información del curso a agregar
 * 		funSucc				Función que se realizará en el success del ajax
 * 		funErr				FUnción que se realizará en el error del ajax
 */

function agregarCurso(arr, funSucc, funErr){
	arr['m_modulo'] = 'curso';
	arr['m_accion'] = 'agregarCurso';

	ajaxMVC(arr, funSucc, funErr);
}

/*
 * Función general para modificar un curso.
 *
 * Hace una llamada ajax al módulo curso con la acción modificar curso.
 *
 * Recibe como parámetros:
 * 		arr					Arreglo con la información del curso a modificar
 * 		funSucc				Función que se realizará en el success del ajax
 * 		funErr				FUnción que se realizará en el error del ajax
 */

function modificarCurso(arr, funSucc, funErr){
	arr['m_modulo'] = 'curso';
	arr['m_accion'] = 'modificarCurso';

	ajaxMVC(arr, funSucc, funErr);
}

/*
 * Función general para eliminar un curso.
 *
 * Hace una llamada ajax al módulo curso con la acción agregar eliminarCurso.
 *
 * Recibe como parámetros:
 * 		codigo				Código del curso a eliminar.
 * 		funSucc				Función que se realizará en el success del ajax
 * 		funErr				FUnción que se realizará en el error del ajax
 */

function eliminarCurso(codigo, funSucc, funErr){
	var arr = Array(	"m_modulo"	,	"curso",
						"m_accion"	,	"eliminarCurso",
						"codCurso"	,	codigo);

	ajaxMVC(arr, funSucc, funErr);
}

/*
 * Función general para obtenerCurEst(s)
 *
 * Hace una llamada ajax al módulo curso con la acción listarCurEst.
 *
 * Recibe como parámetros:
 *
 * 		codigo 				código del cur-estudiante a listar (puede ser null para listarlos todos)
 * 		funSucc				Función que se realizará en el success del ajax
 * 		funErr				Función que se realizará en el error del ajax
 */

function obtenerCurEst(codigo, funSucc, funErr){
	var arr = Array(	"m_modulo"	,	"curso",
						"m_accion"	,	"listarCurEst",
						"codigo"	,	codigo);

	ajaxMVC(arr, funSucc, funErr);
}

/*
 * Función general para agregar un curEstudiante.
 *
 * Hace una llamada ajax al módulo curso con la acción agregarCurEst.
 *
 * Recibe como parámetros:
 * 		arr					Arreglo con la información del cur-estudiante a agregar
 * 		funSucc				Función que se realizará en el success del ajax
 * 		funErr				FUnción que se realizará en el error del ajax
 */

function agregarCurEst(arr, funSucc, funErr){
	arr['m_modulo'] = 'curso';
	arr['m_accion'] = 'agregarCurEst';

	ajaxMVC(arr, funSucc, funErr);
}

/*
 * Función general para modificar un curEstudiante.
 *
 * Hace una llamada ajax al módulo curso con la acción modificarCurEst.
 *
 * Recibe como parámetros:
 * 		arr					Arreglo con la información del cur-estudiante a agregar
 * 		funSucc				Función que se realizará en el success del ajax
 * 		funErr				FUnción que se realizará en el error del ajax
 */

function modificarCurEst(arr, funSucc, funErr){
	arr['m_modulo'] = 'curso';
	arr['m_accion'] = 'modificarCurEst';

	ajaxMVC(arr, funSucc, funErr);
}

/*
 * Función general para eliminar un curEst
 *
 * Hace una llamada ajax al módulo curso con la acción eliminarCurEst.
 *
 * Recibe como parámetros:
 *
 * 		codigo 				código del cur-estudiante a eliminar
 * 		funSucc				Función que se realizará en el success del ajax
 * 		funErr				Función que se realizará en el error del ajax
 */

function eliminarCurEst(codigo, funSucc, funErr){
	var arr = Array(	"m_modulo"	,	"curso",
						"m_accion"	,	"eliminarCurEst",
						"codCurEst"	,	codigo);

	ajaxMVC(arr, funSucc, funErr);
}
