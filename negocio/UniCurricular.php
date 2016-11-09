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

Nombre: Unidad Curricular.clase.php
Diseñador: Miguel Terrami
Programador: Miguel Terrami
Fecha: Julio de 2012
Descripción:  
	Este archivo contiene la implementación del objeto Unidad Curricular, el cual
	consta de su constructor y de los atributos siguientes
				$codigo;
				$codUniMinisterio
				$nombre
				$hta
				$hti
				$uniCredito
				$durSemana
				$notMinAprobatoria
				$notMaxima
				$descripcion
				$observacion
				$contenido
	
	Se corresponde con la siguiente estructura de la base de datos 
		
			CREATE TABLE sis.t_uni_curricular
			(
			  codigo integer NOT NULL, -- Código único de la unidad curricular
			  cod_uni_ministerio character varying(40) NOT NULL, -- Código de la unidad curricular según el ministerio
			  nombre character varying(60) NOT NULL, -- Nombre de la unidad curricular
			  hta double precision NOT NULL, -- Horas de Trabajo Acompañado por semana(horas de clase)
			  hti double precision, -- Horas de Trabajo Independiente por semana
			  uni_credito smallint NOT NULL, -- Cantidad de unidades de crédito de la unidad curricular
			  dur_semanas smallint NOT NULL, -- Cantidad de semanas que dura la unidad curricular
			  not_min_aprobatoria smallint NOT NULL, -- Nota mínima con la que se aprueba la unidad curricular
			  not_maxima smallint NOT NULL, -- Nota máxima o escala de nota de la unidad curricular
			  descripcion character varying(100), -- descripcion adicional de la unidad curricular
			  observacion character varying(100), -- observaciones acerca de la unidad curricular
			  contenido text, -- contenido de la unidad curricular
			  CONSTRAINT cp_uni_curricular PRIMARY KEY (codigo),
			  CONSTRAINT ca_uni_curricular UNIQUE (cod_uni_ministerio),
			  CONSTRAINT chk_uni_curricular_01 CHECK (codigo > 0),
			  CONSTRAINT chk_uni_curricular_02 CHECK (hta >= 0::double precision),
			  CONSTRAINT chk_uni_curricular_03 CHECK (hti >= 0::double precision),
			  CONSTRAINT chk_uni_curricular_04 CHECK (uni_credito >= 0),
			  CONSTRAINT chk_uni_curricular_05 CHECK (dur_semanas >= 0),
			  CONSTRAINT chk_uni_curricular_06 CHECK (not_min_aprobatoria >= 0),
			  CONSTRAINT chk_uni_curricular_07 CHECK (not_maxima >= not_min_aprobatoria),
			  CONSTRAINT chk_uni_curricular_08 CHECK (not_maxima >= 0),
			  CONSTRAINT chk_uni_curricular_09 CHECK (not_min_aprobatoria >= 0 AND not_min_aprobatoria <= not_maxima)
			)

 * * * * * * * * Cambios/Mejoras/Correcciones/Revisiones * * * * * * * *
Diseñador - Programador /   Fecha   / Descripción del cambio
---                         ----      ---------

 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
*/


class UniCurricular { 
	//atributos de la clase
	private	$codigo;
	private	$codUniMinisterio;
	private	$nombre;
	private	$hta;
	private	$hti;
	private	$uniCredito;
	private	$durSemana;
	private	$notMinAprobatoria;
	private	$notMaxima;
	private	$descripcion;
	private	$observacion;
	private	$contenido;


	public function __construct(	$codigo = null, 
									$codUniMinisterio = null,
									$nombre = null,
									$hta = null,
									$hti = null,
									$uniCredito = null,
									$durSemana = null,
									$notMinAprobatoria = null,
									$notMaxima = null,
									$descripcion = null,
									$observacion = null,
									$contenido = null   )
	{
		$this->asignarCodigo($codigo);

	}


	//Coloque aquí los métodos y operaciones de la clase


	//Asignar y obtener de cada atributo
	public function asignarCodigo($codigo){
		$this->codigo = $codigo;
	}
	public function obtenerCodigo(){
		return $this->codigo;
	}

	public function asignarCodUniMinisterio($codUniMinisterio){
		$this->codUniMinisterio = $codUniMinisterio;
	}

	public function obtenerCodUniMinisterio(){
		return $this->codUniMinisterio;
	}

	public function asignarNombre($nombre){
		$this->nombre = $nombre;
	}

	public function obtenerNombre(){
		return $this->nombre;
	}

	public function asignarHta($hta){
		$this->hta = $hta;
	}

	public function obtenerHta(){
		return $this->hta;
	}

	public function asignarHti($hit){
		$this->hti = $hit;
	}

	public function obtenerHti(){
		return $this->hti;
	}

	public function asignarUniCredito($uniCredito){
		$this->uniCredito = $uniCredito;
	}

	public function obtenerUniCredito(){
		return $this->uniCredito;
	}

	public function asignarDurSemana($durSemana){
		$this->durSemana = $durSemana;
	}

	public function obtenerDurSemana(){
		return $this->durSemana;
	}

	public function asignarNotMinAprobatoria($notMinAprobatoria){
		$this->notMinAprobatoria = $notMinAprobatoria;
	}

	public function obtenerNotMinAprobatoria(){
		return $this->notMinAprobatoria;
	}

	public function asignarNotMaxima($notMaxima){
		$this->notMaxima = $notMaxima;
	}

	public function obtenerNotMaxima(){
		return $this->notMaxima;
	}

	public function asignarDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}

	public function obtenerDescripcion(){
		return	$this->descripcion;
	}

	public function asignarObservacion($observacion){
		$this->observacion = $observacion;
	}

	public function obtenerObservacion(){
		return $this->observacion;
	}

	public function asignarContenido($contenido){
		$this->contenido = $contenido;
	}

	public function obtenerContenido(){
		return $this->contenido;
	}

	/*public function toArray(){		

		$arr =  array(
			'codigo' => !empty($this->obtenerCodigo())?$this->obtenerCodigo():'',	
			'codUniMinisterio' => !empty($this->obtenerCodUniMinisterio())?$this->obtenerCodUniMinisterio():'',	
			'nombre' => !empty($this->obtenerNumero())?$this->obtenerNumero():'',
			'hta' => !empty($this->obtenerHta())?$this->obtenerHta():'',			
			'hti' => !empty($this->obtenerHti())?$this->obtenerHti():'',
			'uniCredito' => !empty($this->obtenerUniCredito())?$this->obtenerUniCredito():'',
			'durSemana' => !empty($this->obtenerDurSemana())?$this->obtenerDurSemana():'',
			'notMinAprobatoria' => !empty($this->obtenerNotMinAprobatoria())?$this->obtenerNotMinAprobatoria():'',
			'notMaxima' => !empty($this->obtenerNotMaxima())?$this->obtenerNotMaxima():'',
			'descripcion' => !empty($this->obtenerDescripcion())?$this->obtenerDescripcion():'',
			'observacion' => !empty($this->obtenerObservacion())?$this->obtenerObservacion():'',
			'contenido' => !empty($this->obtenerContenido())?$this->obtenerContenido():''
		 );	

		return $arr;
	} */
	
}

?>
