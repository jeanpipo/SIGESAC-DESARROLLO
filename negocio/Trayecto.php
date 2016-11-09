<?php
/*
 * * * * * * * * * * LICENCIA * * * * * * * * * * * * * * * * * * * * *

Copyright(C) 2012
Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio

Este programa es ARCHIVO * * * * * * * * * * * * * * * * * * * * *

Nombre: Trayecto.clase.php
Diseñador: Miguel Terrami
Programador: Miguel Terrami
Fecha: Julio de 2012
Descripción:  
	Este archivo contiene la implementación del objeto Trayecto, el cual
	consta de su constructor y de los atributos siguientes
			$codigo;
			$cod_pensum;
			$num_trayecto;
			$certificado;
			$min_cre_obligatorio;
			$min_cre_electiva;
			$min_cre_acreditable;
			$min_can_electiva;
	
	Se corresponde con la siguiente estructura de la base de datos 
		CREATE TABLE sis.t_trayecto
		(
		  codigo integer NOT NULL, -- Código único del trayecto
		  cod_pensum integer NOT NULL, -- Código del pensum al que pertenece
		  num_trayecto smallint NOT NULL, -- Número de trayecto, año, semestre o trimestre del pensum
		  certificado character varying(150), -- Nombre del certificado que se obtiene al finalizar este trayecto
		  min_cre_obligatorio smallint NOT NULL, -- Mínima cantidad de Creditos obligatorios por trayecto
		  min_cre_electiva smallint NOT NULL, -- Mínima cantidad de Creditos electivas por trayecto
		  min_cre_acreditable smallint NOT NULL, -- Mínima cantidad de acredotables por trayecto
		  min_can_electiva smallint NOT NULL, -- Mínima cantidad de electivas por trayecto
		  CONSTRAINT cp_trayecto PRIMARY KEY (codigo),
		  CONSTRAINT cf_trayecto_pensum FOREIGN KEY (cod_pensum)
		      REFERENCES sis.t_pensum (codigo) MATCH SIMPLE
		      ON UPDATE NO ACTION ON DELETE NO ACTION,
		  CONSTRAINT ca_trayecto UNIQUE (num_trayecto, cod_pensum),
		  CONSTRAINT chk_t_trayecto_03 CHECK (min_cre_obligatorio >= 0),
		  CONSTRAINT chk_t_trayecto_04 CHECK (min_cre_electiva >= 0),
		  CONSTRAINT chk_t_trayecto_05 CHECK (min_cre_acreditable >= 0),
		  CONSTRAINT chk_t_trayecto_06 CHECK (min_can_electiva >= 0)
		)

 * * * * * * * * Cambios/Mejoras/Correcciones/Revisiones * * * * * * * *
Diseñador - Programador /   Fecha   / Descripción del cambio
---                         ----      ---------

 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
*/

class Trayecto { 
	//atributos de la clase

	private $codigo;
 	private $codPensum; 
  	private $numTrayecto;
  	private $certificado;
  	private $minCreObligatorio; 
  	private $minCreElectiva; 
  	private $minCreAcreditable;
  	private $minCanElectiva; 

	public function __construct($codigo=NULL, 
								$codPensum=NULL, 
								$numTrayecto=NULL,
								$certificado=NULL, 
								$minCreObligatorio=NULL,
								$minCreElectiva=NULL,
								$minCreAcreditable=NULL,
								$minCanElectiva=NULL){
	
								}

	//Asignar y obtener de cada atributo
	public function asignarCodigo($codigo){
		$this->codigo = $codigo;
	}
	public function obtenerCodigo(){
		return $this->codigo;
	}
	public function asignarCodPensum($codPensum){
		$this->codPensum = $codPensum;
	}
	public function obtenerCodPensum(){
		return $this->codPensum;
	}
	public function asignarNumero($numTrayecto){
		$this->numTrayecto = $numTrayecto;
	}
	public function obtenerNumero(){
		return $this->numTrayecto;
	}
	public function asignarCertificado($certificado){
		$this->certificado = $certificado;
	}
	public function obtenerCertificado(){
		return $this->certificado;
	}
	public function asignarMinCreObligatorio($minCreObligatorio){
		$this->minCreObligatorio = $minCreObligatorio;
	}
	public function obtnerMinCreObligatorio(){
		return $this->minCreObligatorio;
	}
	public function asignarMinCreElectiva($minCreElectiva){
		$this->minCreElectiva = $minCreElectiva;
	}	
	public function obtenerMinCreElectiva(){
		return $this->minCreElectiva;
	}
	public function asignarMinCreAcreditable($minCreAcreditable){
		$this->minCreAcreditable = $minCreAcreditable;
	}
	public function obtenerminCreAcreditable(){
		return $this->minCreAcreditable;
	}
	public function asignarMinCanElectiva($minCanElectiva){
		$this->minCanElectiva = $minCanElectiva;
	}
	public function obtenerMinCanElectiva(){
		return $this->minCanElectiva;
	}

	/*public function toArray(){
		
		$arr =  array(
			'codigo' => !empty($this->obtenerCodigo())?$this->obtenerCodigo():'',	
			'codPensum' => !empty($this->obtenerCodPensum())?$this->obtenerCodPensum():'',	
			'numTrayecto' => !empty($this->obtenerNumero())?$this->obtenerNumero():'',
			'certificado' => !empty($this->obtenerCertificado())?$this->obtenerCertificado():'',			
			'minCreObligatorio' => !empty($this->obtnerMinCreObligatorio())?$this->obtnerMinCreObligatorio():'',
			'minCreElectiva' => !empty($this->obtenerMinCreElectiva())?$this->obtenerMinCreElectiva():'',
			'minCreAcreditable' => !empty($this->obtenerminCreAcreditable())?$this->obtenerminCreAcreditable():'',
			'minCanElectiva' => !empty($this->obtenerMinCanElectiva())?$this->obtenerMinCanElectiva():''
		 );	
		return $arr;
	}*/

}

?>
