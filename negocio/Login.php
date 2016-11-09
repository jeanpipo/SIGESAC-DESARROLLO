<?php

/**
 * * * * * * * * * * LICENCIA * * * * * * * * * * * * * * * * * * * * *

Copyright(C) 2012
Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio

Este programa es Software Libre y usted puede redistribuirlo y/o modificarlo
bajo los términos de la versión 3.0 de la Licencia Pública General (GPLv3)
publicada por la Free Software Foundation (FSF), es distribuido sin ninguna
garantía. Usted debe haber recibido una copia de la GPLv3 junto con este
programa, sino, puede encontrarlo en la página web de la FSF, 
específicamente en la dirección http://www.gnu.org/licenses/gpl-3.0.html

 * * * * * * * * * * ARCHIVO * * * * * * * * * * * * * * * * * * * * *

Nombre: Login.php
Lider de proyecto: Johan Alamo
Diseñador: Geraldine Castillo, Jhonny Vielma
Programador: Geraldin Castillo , Jhonny Vielma
Fecha: julio 2015
Descripción:  
	Esta clase permite contener los datos de logueo de un usuario en un objeto tipo login.

 * * * * * * * * Cambios/Mejoras/Correcciones/Revisiones * * * * * * * *
Diseñador - Programador /   Fecha   / Descripción del cambio
---                         ----      ---------

* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
*/
class Login{ 
	public $usuario; // Atributos de la clase
	public $codigo;
	public $tipo;
	private $pass;
	public $campo1;
	public $campo2;
	public $campo3;
	/* Este es el constructor de la clase que permite inicializar los atributos
	   privados: nombre, codigo, tipo y el apellido con los valores pasados por
	   parámetros. Cada parámetro tiene el 	valor null por omisión, es decir, algunos
	   se pueden omitir.
	 * */
	
	public function __construct($usuario=NULL,$codigo=NULL,$tipo=NULL,$pass=NULL,$campo1=null,$campo2=null,$campo3=null){
		$this->asignarTipo($tipo);
		$this->asignarCodigo($codigo);
		$this->asignarUsuario($usuario);
		$this->asignarPass($pass);
		$this->asignarCampo1($campo1);
		$this->asignarCampo2($campo2);
		$this->asignarCampo3($campo3);
	}
	
//Asignar y obtener de cada atributo


	public function asignarUsuario($usuario){
		$this->usuario = $usuario;
	}
	public function obtenerUsuario(){
		return $this->usuario;
	}
	public function asignarPass($pass){
		$this->pass = $pass;
	}
	public function obtenerPass(){
		return $this->pass;
	}
	public function asignarCodigo($codigo){
		$this->codigo = $codigo;
	}
	public function obtenerCodigo(){
		return $this->codigo;
	}
	public function asignarTipo($tipo){
		$this->tipo= $tipo;
	}
	public function obtenerTipo(){
		return $this->tipo;
	}
	public function asignarCampo1($campo1){
		$this->campo1= $campo1;
	}
	public function obtenerCampo1(){
		return $this->campo1;
	}
	public function asignarCampo2($campo2){
		$this->campo2= $campo2;
	}
	public function obtenerCampo2(){
		return $this->campo2;
	}
	public function asignarCampo3($campo3){
		$this->campo3= $campo3;
	}
	public function obtenerCampo3(){
		return $this->campo3;
	}
	
}
?>
