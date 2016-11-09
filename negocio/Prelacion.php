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
Lide del proyecto: Johan Alamo
Fecha: Septiembre de 2015
Descripción:  
	Este archivo contiene la implementación del objeto Pensum, el cual
	consta de su constructor y de los atributos siguientes
		$codigo: código del instituto
		$cod_pensum: Nombre del instituto
		$cod_instituto: Abreviación del instituto, ej: IUT-FRP
		$cod_uni_curricular: Ubicación geográfica del instituto
		$cod_uni_cur_prelada: Trayectos que contiene el pensum. 
	
	Se corresponde con la siguiente estructura de la base de datos 
		CREATE TABLE sis.t_prelacion
		(
		  codigo integer NOT NULL, -- Código único de la prelación
		  cod_pensum integer NOT NULL, -- Código único de la prelación
		  cod_instituto integer NOT NULL, -- Código único de la prelación
		  cod_uni_curricular integer NOT NULL, -- Código de la unidad curricular a establecerle la prelación
		  cod_uni_cur_prelada integer NOT NULL, -- Código de la unidad que no se puede cursar si no se ha aprobado esta
		  CONSTRAINT cp_prelacion PRIMARY KEY (codigo),
		  CONSTRAINT cf_prelacion_01 FOREIGN KEY (cod_pensum)
		      REFERENCES sis.t_pensum (codigo) MATCH SIMPLE
		      ON UPDATE NO ACTION ON DELETE NO ACTION,
		  CONSTRAINT cf_prelacion_02 FOREIGN KEY (cod_instituto)
		      REFERENCES sis.t_instituto (codigo) MATCH SIMPLE
		      ON UPDATE NO ACTION ON DELETE NO ACTION,
		  CONSTRAINT cf_prelacion_03 FOREIGN KEY (cod_uni_curricular)
		      REFERENCES sis.t_uni_curricular (codigo) MATCH SIMPLE
		      ON UPDATE NO ACTION ON DELETE NO ACTION,
		  CONSTRAINT cf_prelacion_04 FOREIGN KEY (cod_uni_cur_prelada)
		      REFERENCES sis.t_uni_curricular (codigo) MATCH SIMPLE
		      ON UPDATE NO ACTION ON DELETE NO ACTION,
		  CONSTRAINT ca_prelacion UNIQUE (cod_uni_curricular, cod_uni_cur_prelada)
		)

 * * * * * * * * Cambios/Mejoras/Correcciones/Revisiones * * * * * * * *
Diseñador - Programador /   Fecha   / Descripción del cambio
---                         ----      ---------

 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
*/

class Prelacion { 
	//atributos de la clase
	private $codigo;
	private $codigoPesum;
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

/*	public function toArray(){
		$arr =  array(
			'codigo' => !empty($this->obtenerCodigo())?$this->obtenerCodigo():'',	
			'codigoPesum' => !empty($this->obtenerNombre())?$this->obtenerNombre():'',	
			'codigoInstituto' => !empty($this->obtenerCodigoInstituto())?$this->obtenerCodigoInstituto():'',
			'codigoUniCurricular' => !empty($this->obtenerCodigoUniCurricular())?$this->obtenerCodigoUniCurricular():'',	
			'codigoUniCurPrelada' => !empty($this->obtenerCodigoUniCurPrelada())?$this->obtenerCodigoUniCurPrelada():''
		 );	
		return $arr;
	} */

}

?>
