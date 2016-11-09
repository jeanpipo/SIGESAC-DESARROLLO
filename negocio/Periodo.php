<?php

class Periodo { 
	//atributos de la clase
	private $codigo;
	private $nombre;
	private $codPensum;
	private $fecInicio;
	private $fecFinal;
	private $observaciones;
	private $codEstado;
	private $codInstituto;

	public function __construct($codigo=NULL, $nombre=NULL, $codInstituto=NULL, $codPensum=NULL, $fecInicio=NULL, $fecFinal=NULL, $observaciones=NULL, $codEstado=NULL)
	{
		$this->asignarCodigo($codigo);
		$this->asignarNombre($nombre);
		$this->asignarCodInstituto($codInstituto);
		$this->asignarCodPensum($codPensum);
		$this->asignarFecInicio($fecInicio);
		$this->asignarFecFinal($fecFinal);
		$this->asignarObservaciones($observaciones);
		$this->asignarCodEstado($codEstado);

	}


	//Coloque aquí los métodos y operaciones de la clase


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

	public function asignarCodInstituto($codInstituto){
		$this->codInstituto = $codInstituto;
	}
	public function obtenerCodInstituto(){
		return $this->codInstituto;
	}

	public function asignarCodPensum($codPensum){
		$this->codPensum = $codPensum;
	}
	public function obtenerCodPensum(){
		return $this->codPensum;
	}

	public function asignarFecInicio($fecInicio){
		$this->fecInicio = $fecInicio;
	}
	public function obtenerFecInicio(){
		return $this->fecInicio;
	}

	public function asignarFecFinal($fecFinal){
		$this->fecFinal = $fecFinal;
	}
	public function obtenerFecFinal(){
		return $this->fecFinal;
	}

	public function asignarObservaciones($observaciones){
		$this->observaciones = $observaciones;
	}
	public function obtenerObservaciones(){
		return $this->observaciones;
	}

	public function asignarCodEstado($codEstado){
		$this->codEstado = $codEstado;
	}
	public function obtenerCodEstado(){
		return $this->codEstado;
	}

}

?>
