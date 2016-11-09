<?php
/**
 * @copyright 2016 - Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio
 * @license GPLv3
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 *
 * Componentes.php - Componente de MVCRIVERO.
 *
 * Clase que permite verificar todos los componentes necesarios para que
 * la aplicación tenga un funcionamiento perfecto, esta clase se encarga de
 * comprobar todo lo necesario para realizar la instalación del mvc con
 * todos sus componentes.
 *
 * @author Johan Alamo (lider de proyecto) <johan.alamo@gmail.com>
 * @author GERALDINE CASTILLO (jhonnyvq1@gmail.com)
 * @author JHONNY VIELMA      (jhonnyvq1@gmail.com)
 * 
 * @package MVC
 */
class Componentes{
	public $verPhp;
	public $verPostgres;
	public $postgres;
	public $pdo;
	public $conPostgres;
	public $disErrors;
	public $permisos;

	/**
	 * Metodo que obtiene la version de PHP.
	 *
	 * 	Metodo privado que permite obtener la version del lenguaje PHP
	 *  y asignarla al atributo de $verPHP donde se puede obtener accediendo
	 *  a dicho atributo. 
	 * 
	 * @return void                         No retorna nada. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	private function obtVerPhp(){
		$ver=explode ("-",phpversion());
		$this->verPhp=$ver[0];
	}
	/**
	 * Metodo que obtiene la version de Postgres.
	 *
	 * 	Metodo privado que permite obtener la version de la base de datos
	 *  Postgres y la  asigna al atributo de $verPostgres donde se puede obtener 
	 *  accediendo a dicho atributo. 
	 * 
	 * @return void                         No retorna nada. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	private function obtVerPostgres(){
		$cmd="/etc/init.d/postgresql status";
		$contenido= explode(" ",shell_exec($cmd));
		$contenido= explode("/",$contenido[2]);
		$this->verPostgres=$contenido[0];
	}
	/**
	 * Metodo que verifica si la base de datos Postgres esta instalada.
	 *
	 * 	Metodo privado que permite verificar si la base de datos Postgres
	 *  esta instala en el servidor o computadora donde se instalara el MVC,
	 * 	asigna el valor al atributo $postgres donde se podre obtener accediendo
	 *  directo al atributo.
	 * 
	 * @return void                         No retorna nada. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	private function obtPostgres(){
		$cmd="psql --version";
		
		$a = strpos(shell_exec($cmd),"bash");
		if ($a===0)
			$this->postgres=false;
		else 
			$this->postgres=true;	
	}
	/**
	 * Metodo que verifica si la clase PDO de PHP esta instalada.
	 *
	 * 	Metodo privado que permite verificar si la clase PDO de PHP que 
	 *  sera con la que se manejara todo lo referente a los servicios 
	 *  esta instala en el servidor o computadora donde se instalara el MVC,
	 * 	asigna el valor al atributo $pdo donde se podre obtener accediendo
	 *  directo al atributo.
	 * 
	 * @return void                         No retorna nada. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	private function obtPdo(){
		$this->pdo=class_exists("PDO");
		
	}
	/**
	 * Metodo que verifica si existe la función para establecer coneccion con postgres.
	 *
	 * 	Metodo privado que permite verificar si la función pg_connect de PHP que 
	 *  es con la que la clase PDO trabaja para ejercer las conexiones a la base de 
	 *  datos postgres esta instala en el servidor o computadora donde se instalara el MVC,
	 * 	asigna el valor al atributo $conPostgres donde se podre obtener accediendo
	 *  directo al atributo.
	 * 
	 * @return void                         No retorna nada. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	private function obtConPostgres(){
		$this->conPostgres=function_exists("pg_connect");
	}
	/**
	 * Metodo que verifica si estan activados o desactivados los errores de PHP.
	 *
	 * 	Metodo privado que permite verificar como se encuentra la configuración de PHP
	 *  de display_errors, para saber si los errores se encuentran activados o desactivados 
	 *  en el servidor o computadora donde se instalara el MVC,asigna el valor al atributo 
	 *  $disErrors donde se podre obtener accediendo directo al atributo.
	 * 
	 * @return void                         No retorna nada. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	private function obtDisErrors(){
		$this->disErrors =ini_get('display_errors');
	}
	/**
	 * Metodo que verifica si existen permisos de escritura en la carpeta del MVCRIVERO.
	 *
	 * 	Metodo privado que permite verificar si existen permisos de escritura en la carpeta
	 *  del MVCRIVERO ya que es necesario poseer permiso de escrituras para la instalación 
	 *  en el servidor o computadora donde se instalara el MVC,asigna el valor al atributo 
	 *  $permisos donde se podre obtener accediendo directo al atributo.
	 * 
	 * @return void                         No retorna nada. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	private function obtPermisos(){
		$archivo=fopen("Permisos","w+");

		if ($archivo){
			fclose($archivo);
			unlink ("Permisos");
			$this->permisos=true;
		}
		else
			$this->permisos=false;

	}
	/**
	 * Metodo que obtiene todo los componentes necesarios para la instalación.
	 *
	 * 	Metodo publico que permite obtener todos los componentes necesarios para realizar la 
	 *  instalaciń del MVC de manera correcta. Esta funcion llama a todas los metodos de la
	 *  clase y esta llenaran los atributos con los valores obtenidos, esta es el unico metodo
	 *  que se podra utilizar de esta clase. 
	 *
	 * @return void                         No retorna nada. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public function comInstalacion(){
		$this->obtVerPhp();
		$this->obtVerPostgres();
		$this->obtPostgres();
		$this->obtPdo();
		$this->obtConPostgres();
		$this->obtDisErrors();
		$this->obtPermisos();
	}
}
?>
