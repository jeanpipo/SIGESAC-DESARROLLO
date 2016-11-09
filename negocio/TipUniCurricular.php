<?php
/*
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

Nombre: Prelacion.php
Diseñador: Rafael Garcia
Programador: Rafael Garcia
Fecha: Septiembre de 2015
Descripción:  
	Este archivo contiene la implementación del objeto TipUniCurricular, el cual
	consta de su constructor y de los atributos siguientes
		$codigo: código del instituto
		$nombre: Nombre del instituto
		
	
	Se corresponde con la siguiente estructura de la base de datos 
		CREATE TABLE sis.t_tip_uni_curricular
		(
		  codigo integer NOT NULL, -- Código del tipo de unidad curricular
		  nombre character varying(30) NOT NULL, -- Nombre del tipo de unidad curricular
		  CONSTRAINT cp_uni_cur_tipo PRIMARY KEY (codigo)
		)

 * * * * * * * * Cambios/Mejoras/Correcciones/Revisiones * * * * * * * *
Diseñador - Programador /   Fecha   / Descripción del cambio
---                         ----      ---------

 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
*/

class TipUniCurricular { 
	//atributos de la clase
	private $codigo;
	private $nombre;
	private $codigoInstituto;
	private $codigoUniCurricular;
	private $codigoUniCurPrelada;
	

	public function __construct( $codigo = null,
								 $codigoPesum = null,
								 $codigoInstituto = null,
								 $codigoUniCurricular = null,
								 $codigoUniCurPrelada = null
								 ){
		$this->asignarCodigo($codigo);
		$this->asignarCodigoPesum($codigoPesum);
		$this->asignarCodigoInstituto($codigoInstituto);
		$this->asignarCodigoUniCurricular($codigoUniCurricular);
		$this->asignarCodigoUniCurricular($codigoUniCurPrelada);		
	}	
	//Asignar y obtener de cada atributo
	public function asignarCodigo($codigo){
		$this->codigo = $codigo;
	}
	public function obtenerCodigo(){
		return $this->codigo;
	}	
	public function asignarCodigoPesum($codigoPesum){
		$this->codigoPesum = $codigoPesum;
	}
	public function obtenerCodigoPesum(){
		return $this->codigoPesum;
	}
	public function asignarCodigoInstituto($codigoInstituto){
		$this->codigoInstituto = $codigoInstituto;
	}
	public function obtenerCodigoInstituto(){
		return $this->codigoInstituto;
	}
	public function asignarCodigoUniCurricular($codigoUniCurricular){
		$this->codigoUniCurricular = $codigoUniCurricular;
	}
	public function obtenerCodigoUniCurricular(){
		return $this->codigoUniCurricular;
	}
	public function asignarCodigoUniCurPrelada($codigoUniCurPrelada){
		$this->codigoUniCurPrelada = $codigoUniCurPrelada; 
	}
	public function obtenerCodigoUniCurPrelada(){
		return $this->codigoUniCurPrelada;
	}

	/*public function toArray(){
		$arr =  array(
			'codigo' => !empty($this->obtenerCodigo())?$this->obtenerCodigo():'',	
			'codigoPesum' => !empty($this->obtenerNombre())?$this->obtenerNombre():'',	
			'codigoInstituto' => !empty($this->obtenerCodigoInstituto())?$this->obtenerCodigoInstituto():'',
			'codigoUniCurricular' => !empty($this->obtenerCodigoUniCurricular())?$this->obtenerCodigoUniCurricular():'',	
			'codigoUniCurPrelada' => !empty($this->obtenerCodigoUniCurPrelada())?$this->obtenerCodigoUniCurPrelada():''
		 );	
		return $arr;
	}*/
}

?>
