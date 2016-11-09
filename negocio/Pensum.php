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

Nombre: Pensum.php
Lider del proyecto: Johan Alamo
Diseñador: Rafael Garcia
Programador: Rafael Garcia
Fecha: Septiembre de 2015
Descripción:  
	Este archivo contiene la implementación del objeto Pensum, el cual
	consta de su constructor y de los atributos siguientes
		$codigo: código del instituto
		$nombre: Nombre del instituto
		$nombreCorto: Abreviación del instituto, ej: IUT-FRP
		$observaciones: Ubicación geográfica del instituto
		$trayecto: Trayectos que contiene el pensum. 
	
	Se corresponde con la siguiente estructura de la base de datos 
		CREATE TABLE sis.t_pensum
		(
		  codigo integer NOT NULL, -- Código del pensum
		  nombre character varying(50) NOT NULL, -- Nombre largo del pensum
		  nom_corto character varying(20) NOT NULL, -- Abreviación del nombre del pensum
		  observaciones character varying(200), -- Alguna otra información relevante del pensum
		  min_can_electiva smallint NOT NULL, -- Minima Cantidad de Electivas que posee el pesum
		  min_cre_electiva smallint NOT NULL, -- MInima Cantidad de Creditos de Electivas
		  min_cre_obligatorio smallint NOT NULL, -- MInima Cantidad de Creditos de Electivas Obligatorios
		  fec_creacion date NOT NULL, -- Fecha de creacion del pensum
		  CONSTRAINT cp_pensum PRIMARY KEY (codigo),
		  CONSTRAINT ca_pensum UNIQUE (nom_corto),
		  CONSTRAINT chk_t_pensum_01 CHECK (min_can_electiva >= 0),
		  CONSTRAINT chk_t_pensum_02 CHECK (min_cre_electiva >= 0),
		  CONSTRAINT chk_t_pensum_03 CHECK (min_cre_obligatorio >= 0),
		  CONSTRAINT chk_t_pensum_04 CHECK (fec_creacion >= '1990-01-01'::date)
		)

 * * * * * * * * Cambios/Mejoras/Correcciones/Revisiones * * * * * * * *
Diseñador - Programador /   Fecha   / Descripción del cambio
---                         ----      ---------

 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
*/

class Pensum { 
	//atributos de la clase
	private $codigo;
	private $nombre;
	private $nombreCorto;
	private $observaciones;
	private $minCanElectiva;
	private $minCreElectiva;
	private $minCreObligatorio;
	private $fechaCreacion;

	public function __construct( $codigo = null, 
								 $nombre = null ,
	     						 $nombreCorto = null,								 
								 $observaciones = null,
								 $minCanElectiva = null,
								 $minCreElectiva = null,
								 $minCreObligatorio = null,
								 $fechaCreacion = null){
		$this->asignarCodigo($codigo);
		$this->asignarNombre($nombre);
		$this->asignarNombreCorto($nombreCorto); 
		$this->asignarObservaciones($observaciones);
		$this->asignarMinCanElectiva($minCanElectiva);
		$this->asignarMinCreElectiva($minCreElectiva);
		$this->asignarMinCreObligatorio($minCreObligatorio);
		$this->asignarFechaCreacion($fechaCreacion);
	}	
	//Asignar y obtener de cada atributo
	public function asignarCodigo($codigo){
		$this->codigo = $codigo;
	}
	public function obtenerCodigo(){
		return $this->codigo;
	}
	public function asignarNombre($nombre){
		$this->nombre = $nombre;
	}
	public function obtenerNombre(){
		return $this->nombre;
	}
	public function asignarNombreCorto($nombreCorto){
		$this->nombreCorto = $nombreCorto;
	}
	public function obtenerNombreCorto(){
		return $this->nombreCorto;		
	}
	public function asignarObservaciones($observaciones){
		$this->observaciones = $observaciones;
	}
	public function obtenerObservaciones(){
		return $this->observaciones;
	}
	public function asignarMinCanElectiva($minCanElectiva){
		$this->minCanElectiva = $minCanElectiva;
	}
	public function obtenerMinCanElectiva(){
		return $this->minCanElectiva;
	}
	public function asignarMinCreElectiva($minCreElectiva){
		$this->minCreElectiva = $minCreElectiva;
	} 
	public function obtenerMinCreElectiva(){
		return $this->minCreElectiva;
	}
	public function asignarMinCreObligatorio($minCreObligatorio){
		$this->minCreObligatorio = $minCreObligatorio;
	}
	public function obtenerMinCreObligatorio(){
		return $this->minCreObligatorio;
	}
	public function asignarFechaCreacion($fechaCreacion){
		$this->fechaCreacion = $fechaCreacion;
	}
	public function obtenerFechaCreacion(){
		return $this->fechaCreacion;
	}

/*	public function toArray(){
		$arr =  array(
			'codigo' => !empty($this->obtenerCodigo())?$this->obtenerCodigo():'',	
			'nombre' => !empty($this->obtenerNombre())?$this->obtenerNombre():'',	
			'nombreCorto' => !empty($this->obtenerNombreCorto())?$this->obtenerNombreCorto():'',
			'observaciones' => !empty($this->obtenerObservaciones())?$this->obtenerObservaciones():'',	
			'minCanElectiva' => !empty($this->obtenerMinCanElectiva())?$this->obtenerMinCanElectiva():'',	
			'minCreElectiva' => !empty($this->obtenerMinCreElectiva())?$this->obtenerMinCreElectiva():'',	
			'minCreObligatorio' => !empty($this->obtenerMinCreObligatorio())?$this->obtenerMinCreObligatorio():'',	
			'fechaCreacion' => !empty($this->obtenerFechaCreacion())?$this->obtenerFechaCreacion():''
		 );	
		return $arr;
	}*/

}

?>
