<?php

/**
 * Instalación.php - Componente de MVCRIVERO.
 *
 * Clase que permite almacenar en un objeto todos la información de la instalación del MVCRIVERO
 * Esta clase facilita todo lo reverenciado a la instalación ya encapsula todo los datos en un objeto
 * para un mejor manejo, así como la carga de los datos cuando ya esta instalada la aplicación, ya que 
 * los datos de instalación se guardan en el archivo config.ini localizado en la raíz, el objeto permite
 * cargar esos datos y encapsularlos en el objeto para su utilización.
 *
 * @copyright 2016 - Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio
 * @license GPLv3
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @author Johan Alamo (lider de proyecto) <johan.alamo@gmail.com>
 * @author GERALDINE CASTILLO (jhonnyvq1@gmail.com)
 * @author JHONNY VIELMA      (jhonnyvq1@gmail.com)
 * 
 * @package MVC
 */

class Instalacion{
 /** @var String Usuario administrador del sistema gestor ejemplo: postgres */
	private $usuConectorBD;
	 /** @var String  Clave del administrador del sistema gestor. */
	private $passConectorBD;
	 /** @var String  Servidor donde se encuentra de la base de datos a conectar. */
	private $servidor;
	/** @var String   Puerto por el cual se conectara. */
	private $puerto;
	/** @var String   Base de datos a la cual se conectara por ejemplo PostgreSQL. */
	private $baseDatos;
	/** @var String    Nombre de la base de datos a crear. */
	private $nombreBD;
	/** @var String    Codificación de caracteres que tendrá la base de datos ejemplo:UTF-8. */
	private $codificacion;
	/** @var String    Nombre del administrador de la base de datos que se creo. */
	private $nombreAdmin;
	/** @var String    Apellido del administrador de la base de datos que se creo. */
	private $apellidoAdmin;
	/** @var String    Usuario  del administrador de la base de datos. */
	public $usuarioAdmin;
	/** @var String    Clave  del administrador de la base de datos, de no ser usuarios de base de datos */
	private $passAdmin;
	/** @var String    Nombre de la aplicación que se creo. */
	public $nombreAplicacion;
	/** @var String    Abreviación del nombre  de la aplicación que se creo. */
	public $abreviacionAplicacion;
	/** @var Boolean   Boolean true= usuarios de base de datos y false= usuarios común . */
	public $usuariosBD;
	/** @var Array     Pasos que se han cumplido en la instalación. */
	public $pasos;
	/** @var String    Configuración del campo1 para guardar información de los usuarios */
	public $campo1;
	/** @var String    Configuración del campo2 para guardar información de los usuarios*/
	public $campo2;
	/** @var String    Configuración del campo3 para guardar información de los usuarios*/
	public $campo3;

    /**
	 * Método que permite asignar un paso de instalación.
	 *
	 * 	Método publico que permite asignar un true cuando un paso se cumple en la instalación.
	 *
	 * @param Integer $paso 		        Numero del paso a asignarle valor.
	 * @param Boolean $valor 		        True o false dependiendo de lo ocurrido en el paso.
	 * 
	 * @return $this                         Instancia del objeto. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	*/
	public function asignarPaso($paso,$valor){
		$this->pasos[$paso]=$valor;
		return $this;
	}
	/**
	 * Método que permite asignar el tipo de usuario de la aplicación.
	 *
	 * 	Método publico que permite asignar el tipo de usuario que usara la aplicación
	 *  ya sea usuario de base de datos de ser true o false de usuarios comunes.
	 *
	 * @param  Boolean $valor 		        Tipo de usuario de la aplicación True = usuarios base de datos y false=usuarios comunes.
	 * 
	 * @return $this                         Instancia del objeto. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public function asignarUsuBD($valor){
		$this->usuariosBD=$valor;
		return $this;
	}
   /**
	 * Método que permite asignar todos los pasos de la  instalación.
	 *
	 * 	Método publico que permite asignar un arreglo de pasos a el atributo de pasos de instalación.
	 *
	 * @param Array   $pasos		        Pasos de la instalación.
	 *
	 * @throws Exception 					No lanza exceptiones.
	*/
	public function asignarPasos($pasos){
		$this->pasos=$pasos;
		return $this;
	}
		 /**
	 * Método que permite obtener los pasos de la instalación.
	 *
	 * 	Método publico que permite obtener el arreglo de pasos  del atributo de pasos de instalación.
	 *
	 * 
	 * @return Array                        Pasos de instalación. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	*/

	public function obtenerPasos(){
		return $this->pasos;
		

	}
	/**
	 * Método que permite obtener el valor de un paso .
	 *
	 * 	Método publico que permite obtener el valor de un paso de la instalación.
	 *
	 * @param Integer  $posi		        Paso de la instalación que se quiere obtener.
	 * 
	 * @return Boolean                      Valor del paso en la instalación. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	*/
	public function obtenerPaso($posi){
		return $this->pasos[$posi];
	}

    /**
	 * Método que permite asignar el usuario conector base de datos .
	 *
	 * 	Método publico que permite asignar el usuario conector y administrador del sistema gestor de base de datos
	 *  para crear la base de datos de la aplicación y el usuario administrador de esta base de datos.
	 *
	 * @param  String  $usuConector		     Usuario conector(administrador) del sistema gestor de base de datos.
	 * 
	 * @return $this                         Instancia del objeto.  
	 *
	 * @throws Exception 					No lanza exceptiones.
	*/
	public function asignarUsuConectorBD($usuConector){
		$this->usuConectorBD=$usuConector;
		return $this;
	
	}
	/**
	 * Método que permite asignar la clave del usuario conector base de datos .
	 *
	 * 	Método publico que permite asignar la clave del usuario conector y administrador del sistema gestor de base de datos
	 *  para crear la base de datos de la aplicación y el usuario administrador de esta base de datos.
	 *
	 * @param  String  $pasConector		   Clave del Usuario conector(administrador) del sistema gestor de base de datos.
	 * 
	 * @return $this                       Instancia del objeto.  
	 *
	 * @throws Exception 				   No lanza exceptiones.
	*/
	public function asignarPassConectorBD($pasConector){
		$this->passConectorBD=$pasConector;
		return $this;
	}
	/**
	 * Método que permite asignar el servidor .
	 *
	 * 	Método publico que permite asignar el servidor en el cual se encuentra la base de datos a conectarse
	 *
	 * @param  String  $servidor		   Servidor donde se encuentra el sistema gestor de base de datos.
	 * 
	 * @return $this                       Instancia del objeto.  
	 *
	 * @throws Exception 				   No lanza exceptiones.
	*/
	public function asignarServidor($servidor){
		$this->servidor=$servidor;
		return $this;
	}
	/**
	 * Método que permite asignar el puerto .
	 *
	 * 	Método publico que permite asignar el puerto para conectarse al sistema gestor de base de datos.
	 *
	 * @param  String  $puerto		   Puerto para la conexión a la base de datos.
	 * 
	 * @return $this                   Instancia del objeto.  
	 *
	 * @throws Exception 			   No lanza exceptiones.
	*/
	public function asignarPuerto($puerto){
		$this->puerto=$puerto;
		return $this;
	
	}
    /**
	 * Método que permite asignar el nombre del sistema gestor base de datos.
	 *
	 * 	Método publico que permite asignar el gestor de base de datos al cual se conectara .
	 *
	 * @param  String  $baseDeDatos	   Nombre del sistema gestor de base de datos.
	 * 
	 * @return $this                   Instancia del objeto.  
	 *
	 * @throws Exception 			   No lanza exceptiones.
	*/
	public function asignarBD($baseDeDatos){
		$this->baseDatos=$baseDeDatos;
		return $this;
	}
    /**
	 * Método que permite asignar el nombre nombre de la base de datos.
	 *
	 * 	Método publico que permite asignar el nombre de la base de datos que se creara,
	 *  donde se alojara la data de la aplicación.
	 *
	 * @param  String  $nombreBD	   Nombre de la base de datos.
	 * 
	 * @return $this                   Instancia del objeto.  
	 *
	 * @throws Exception 			   No lanza exceptiones.
	*/
	public function asignarNombreBD($nombreBD){
		$this->nombreBD=$nombreBD;
		return $this;
	
	}
	/**
	 * Método que permite asignar la codificación de datos.
	 *
	 * 	Método publico que permite asignar la codificación de caracteres de la 
	 *  base de datos ejemplo: UTF-8.
	 *
	 * @param  String  $codficacion	   Codificaron de caracteres.
	 * 
	 * @return $this                   Instancia del objeto.  
	 *
	 * @throws Exception 			   No lanza exceptiones.
	*/
	public function asignarCodificacion($codificacion){
		$this->codificacion=$codificacion;
		return $this;
	
	}
	/**
	 * Método que permite asignar el nombre del administrador de la aplicación.
	 *
	 * 	Método publico que permite asignar la nombre del administrador de la aplicación.
	 *
	 * @param  String  $nombreAdmin	   Nombre Administrador de la aplicación.
	 * 
	 * @return $this                   Instancia del objeto.  
	 *
	 * @throws Exception 			   No lanza exceptiones.
	*/
	public function asignarNombreAdmin($nombreAdmin){
		$this->nombreAdmin=$nombreAdmin;
		return $this;
	
	}
	/**
	 * Método que permite asignar el apellido del administrador de la aplicación.
	 *
	 * 	Método publico que permite asignar el apellido del administrador de la aplicación.
	 *
	 * @param  String  $apelliddoAdmin Apellido Administrador de la aplicación.
	 * 
	 * @return $this                   Instancia del objeto.  
	 *
	 * @throws Exception 			   No lanza exceptiones.
	*/
	public function asignarApellidoAdmin($apellidoAdmin){
		$this->apellidoAdmin=$apellidoAdmin;
		return $this;
	}
    /**
	 * Método que permite asignar el usuario del administrador de la aplicación.
	 *
	 * 	Método publico que permite asignar el usuario del administrador de la aplicación.
	 *
	 * @param  String  $usuarioAdmin   Usuario Administrador de la aplicación.
	 * 
	 * @return $this                   Instancia del objeto.  
	 *
	 * @throws Exception 			   No lanza exceptiones.
	*/
	public function asignarUsuarioAdmin($usuarioAdmin){
		$this->usuarioAdmin=$usuarioAdmin;
		return $this;
	
	}
	/**
	 * Método que permite asignar la clave del administrador de la aplicación.
	 *
	 * 	Método publico que permite asignar la clave del administrador de la aplicación.
	 *
	 * @param  String  $passAdmin      Clave administrador de la aplicación.
	 * 
	 * @return $this                   Instancia del objeto.  
	 *
	 * @throws Exception 			   No lanza exceptiones.
	*/
	public function asignarPassAdmin($passAdmin){
		$this->passAdmin=$passAdmin;
		return $this;
	}
	/**
	 *  Método que permite asignar el nombre de la aplicación que se creo.
	 *
	 * 	Método publico que permite asignar el nombre de  de la aplicación que se creo.
	 *
	 * @param  String  $nombreAplicacion  Nombre de la aplicación.
	 * 
	 * @return $this                      Instancia del objeto.  
	 *
	 * @throws Exception 			      No lanza exceptiones.
	*/
	public function asignarNombreAplicacion($nombreAplicacion){
		$this->nombreAplicacion=$nombreAplicacion;
		return $this;
	
	}
    /**
	 *  Método que permite asignar la abreviación del nombre de la aplicación.
	 *
	 * 	Método publico que permite asignar la abreviación  del nombre de la aplicación que se creo.
	 *
	 * @param  String  $nombreAplicacion  Nombre de la aplicación.
	 * 
	 * @return $this                      Instancia del objeto.  
	 *
	 * @throws Exception 			      No lanza exceptiones.
	*/
	public function asignarAbreviacionAplicacion($abreviacionAplicacion){
		$this->abreviacionAplicacion=$abreviacionAplicacion;
		return $this;
	
	}

	///////////////////////////////////////////////////////////////////////////////////


	/**
	 * Método que permite obtener el usuario conector base de datos .
	 *
	 * 	Método publico que permite obtener el usuario conector y administrador del sistema gestor de base de datos
	 *  para crear la base de datos de la aplicación y el usuario administrador de esta base de datos.
	 *
	 * 
	 * @return String                       Usuario conector(administrador) del sistema gestor de base de datos
	 *
	 * @throws Exception 					No lanza exceptiones.
	*/
	public function obtenerUsuConectorBD(){
		return strtolower($this->usuConectorBD);
	}
	/**
	 *  Método que permite obtener la clave del usuario conector base de datos .
	 *
	 * 	Método publico que permite obtener la clave del usuario conector y administrador del sistema gestor de base de datos
	 *  para crear la base de datos de la aplicación y el usuario administrador de esta base de datos.
	 *
	 * 
	 * @return String                       Clave del Usuario conector(administrador) del sistema gestor de base de datos. 
	 *
	 * @throws Exception 				   No lanza exceptiones.
	*/
	public function obtenerPassConectorBD(){
		return strtolower($this->passConectorBD);
	}
	/**
	 * Método que permite obtener el servidor .
	 *
	 * 	Método publico que permite obtener el servidor en el cual se encuentra la base de datos a conectarse
	 * 
	 * @return String                       Servidor donde se encuentra el sistema gestor de base de datos
	 *
	 * @throws Exception 				   No lanza exceptiones.
	*/
	public function obtenerServidor(){
		return strtolower($this->servidor);
	}
	/**
	 * Método que permite obtener el puerto .
	 *
	 * 	Método publico que permite obtener el puerto para conectarse al sistema gestor de base de datos.
	 *
	 * @param  String  $puerto		   Puerto para la conexión a la base de datos.
	 * 
	 * @return $this                   Instancia del objeto.  
	 *
	 * @throws Exception 			   No lanza exceptiones.
	*/
	public function obtenerPuerto(){
		return strtolower($this->puerto);
	}
	 /**
	 * Método que permite obtener el nombre del sistema gestor base de datos.
	 *
	 * 	Método publico que permite obtener el gestor de base de datos al cual se conectara .
	 * 
	 * @return String                   Nombre del sistema gestor de base de datos..  
	 *
	 * @throws Exception 			   No lanza exceptiones.
	*/
	public function obtenerBD(){
		return	strtolower($this->baseDatos[0]);
	}
	    /**
	 * Método que permite obtener el nombre nombre de la base de datos.
	 *
	 * 	Método publico que permite obtener el nombre de la base de datos que se creara,
	 *  donde se alojara la data de la aplicación.
	 * 
	 * @return String                   Nombre de la base de datos..  
	 *
	 * @throws Exception 			   No lanza exceptiones.
	*/
	public function obtenerNombreBD(){
		return strtolower($this->nombreBD);
	}
		/**
	 * Método que permite obtener la codificación de datos.
	 *
	 * 	Método publico que permite obtener la codificación de caracteres de la 
	 *  base de datos ejemplo: UTF-8.
	 * 
	 * @return String                  Codificaron de caracteres.  
	 *
	 * @throws Exception 			   No lanza exceptiones.
	*/
	public function obtenerCodificacion(){
		return strtolower($this->codificacion);
	}
	/**
	 * Método que permite obtener el nombre del administrador de la aplicación.
	 *
	 * 	Método publico que permite obtener el nombre del administrador de la aplicación.
	 * 
	 * @return String                  Nombre Administrador de la aplicación  
	 *
	 * @throws Exception 			   No lanza exceptiones.
	*/
	public function obtenerNombreAdmin(){
		return strtolower($this->nombreAdmin);
	}
	/**
	 * Método que permite obtener el apellido del administrador de la aplicación.
	 *
	 * 	Método publico que permite obtener el apellido del administrador de la aplicación.
	 * 
	 * @return String                  Apellido Administrador de la aplicación..  
	 *
	 * @throws Exception 			   No lanza exceptiones.
	*/
	public function obtenerApellidoAdmin(){
		return strtolower($this->apellidoAdmin);
	}
	/**
	 * Método que permite obtener el usuario del administrador de la aplicación.
	 *
	 * 	Método publico que permite obtener el usuario del administrador de la aplicación.
	 * 
	 * @return String                   Usuario Administrador de la aplicación.  
	 *
	 * @throws Exception 			   No lanza exceptiones.
	*/
	public function obtenerUsuarioAdmin(){
		return	strtolower($this->usuarioAdmin);
	
	}
	/**
	 * Método que permite obtener la clave del administrador de la aplicación.
	 *
	 * 	Método publico que permite obtener la clave del administrador de la aplicación.
	 * 
	 * @return String                  Clave administrador de la aplicación.  
	 *
	 * @throws Exception 			   No lanza exceptiones.
	*/
	public function obtenerPassAdmin(){
		return strtolower($this->passAdmin);
	
	}
	/**
	 *  Método que permite obtener el nombre de la aplicación que se creo.
	 *
	 * 	Método publico que permite obtener el nombre de  de la aplicación que se creo.
	 * 
	 * @return String                      Nombre de la aplicación.  
	 *
	 * @throws Exception 			      No lanza exceptiones.
	*/
	public function obtenerNombreAplicacion(){
		return $this->nombreAplicacion;
	
	}
	/**
	 *  Método que permite obtener la abreviación del nombre de la aplicación.
	 *
	 * 	Método publico que permite obtener la abreviación  del nombre de la aplicación que se creo.
	 * 
	 * @return String                      Nombre de la aplicación..  
	 *
	 * @throws Exception 			      No lanza exceptiones.
	*/
	public function obtenerAbreviacionAplicacion(){
		return $this->abreviacionAplicacion;
	}
	/**
	 * Método que permite obtener el tipo de usuario de la aplicación.
	 *
	 * 	Método publico que permite obtener el tipo de usuario que usara la aplicación
	 *  ya sea usuario de base de datos de ser true o false de usuarios comunes.
	 * 
	 * @return Boolean                        Tipo de usuario de la aplicación True = usuarios base de datos y false=usuarios comunes. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public function obtenerUsuBD(){
		return $this->usuariosBD;
	}
	/**
	 * Método que permite crear el archivo config.ini.
	 *
	 * 	Método publico que permite crear el archivo.ini en el cual se alojaran todos los datos
	 *  de la aplicación que tienen que ver con la instalación. 
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public static function crearArchivo(){
			$archivo=fopen("config.ini","w+");
			fclose($archivo);
	}
	/**
	 * Método que permite guardar toda la información de instalación.
	 *
	 * 	Método publico que permite guardar la información de instalación en el 
	 *  archivo config.ini.
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public  function guardarDatosAplicacion(){
			$archivo=fopen("config.ini","a");

			$cl = "\r\n";
			$tab = "\t";
			$cadena="";
			$cadena="[CONEXIÓN]";
			fputs($archivo,$cadena); 
			$cadena=$cl.$tab."PUERTO=".$this->obtenerPuerto().
					$cl.$tab."SERVIDOR=".$this->obtenerServidor().
					$cl.$tab."USUARIO=".$this->obtenerUsuConectorBD().
					$cl.$tab."BASE_DE_DATOS=".$this->obtenerBD();
			fputs($archivo,$cadena);
			$cadena=$cl."[BASE_DE_DATOS]";
			fputs($archivo,$cadena); 
			$cadena=$cl.$tab."NOMBRE_BASE_DE_DATOS=".$this->obtenerNombreBD().
					$cl.$tab."CODIFICACIÓN=".$this->obtenerCodificacion();
			fputs($archivo,$cadena);
				$cadena=$cl."[ADMINISTRADOR]";
			fputs($archivo,$cadena); 
			$cadena=$cl.$tab."NOMBRE=".$this->obtenerNombreAdmin().
					$cl.$tab."APELLIDO=".$this->obtenerApellidoAdmin().
					$cl.$tab."USUARIO_ADMINISTRADOR=".$this->obtenerUsuarioAdmin();
			fputs($archivo,$cadena); 
			$cadena=$cl."[CONFIGURACIÓN DE CAMPOS]";
			fputs($archivo,$cadena); 
			$cadena=$cl.$tab."CAMPO1=".$this->obtenerCampo1().
					$cl.$tab."CAMPO2=".$this->obtenerCampo2().
					$cl.$tab."CAMPO3=".$this->obtenerCampo3();	

			fputs($archivo,$cadena);

			$cadena=$cl."[APLICACIÓN]";
			fputs($archivo,$cadena); 
			$cadena=$cl.$tab."NOMBRE=".$this->obtenerNombreAplicacion().
					$cl.$tab."NOMBRE_ABREVIADO=".$this->obtenerAbreviacionAplicacion().
					$cl.$tab."UsuarioBD=".$this->obtenerUsuBD();
					if ($this->obtenerUsuBD()=="false")
						$cadena.=$cl.$tab."passAdmin=".$this->obtenerPassAdmin();
			fputs($archivo,$cadena); 


			fclose($archivo);
	}
	/**
	 * Método que permite obtener la información de config.ini.
	 *
	 * 	Método publico que obtener toda la información alojada en config.ini de instalación
	 *	y la asigna a los atributos correspondientes del objeto.
	 *
	 * @throws Exception 					No lanza exceptiones.
	 */
	public  function obtenerInstalacionIni(){
		$ruta="config.ini";
		if(file_exists($ruta)){
			$a = file($ruta);
			for ($p = 0; $p < count($a);$p++){
				if($p==1){
					$re=explode("=",trim($a[$p]));
					$this->puerto=$re[1];
				}
				
				if($p==2){
					$re=explode("=",trim($a[$p]));
					$this->servidor=$re[1];
				}
				
				if($p==3){
					$re=explode("=",trim($a[$p]));
					$this->usuConectorBD=$re[1];
				}
				
				if($p==4){
					$re=explode("=",trim($a[$p]));
					$this->baseDatos=$re[1];
				}
				if($p==6){
					$re=explode("=",trim($a[$p]));
					$this->nombreBD=$re[1];
				}
				if($p==7){
					$re=explode("=",trim($a[$p]));
					$this->codificacion=$re[1];
				}
				if($p==9){
					$re=explode("=",trim($a[$p]));
					$this->nombreAdmin=$re[1];
				}
				if($p==10){
					$re=explode("=",trim($a[$p]));
					$this->apellidoAdmin=$re[1];
				}
				if($p==11){
					$re=explode("=",trim($a[$p]));
					$this->usuarioAdmin=$re[1];
				}
				if($p==13){
					$re=explode("=",trim($a[$p]));
					$this->campo1=$re[1];
				}
				if($p==14){
					$re=explode("=",trim($a[$p]));
					$this->campo2=$re[1];
				}
				if($p==15){
					$re=explode("=",trim($a[$p]));
					$this->campo3=$re[1];
				}
				if($p==17){
					$re=explode("=",trim($a[$p]));
					$this->nombreAplicacion=$re[1];
				}
				if($p==18){
					$re=explode("=",trim($a[$p]));
					$this->abreviacionAplicacion=$re[1];
				}
				if($p==19){
					$re=explode("=",trim($a[$p]));
					$this->usuariosBD=$re[1];
				}
				if($p==20){
					$re=explode("=",trim($a[$p]));
					
					$this->passAdmin=$re[1];

				}
				
				
			}
						
		}else
			throw new Exception("Archivo config.ini no existe");
	}

	/**
	 * Método que permite asignar el campo1.
	 *
	 * @param  String  $Campo1            	cadena donde se guarda la configuración del campo 1 
	 * para más información de un usuario.
	 * 
	 * @return $this                        Instancia del objeto.  
	 *
	 * @throws Exception 					No lanza exceptiones.
	*/
	public function asignarCampo1($campo1){
		$this->campo1=$campo1;
		return $this;
	
	}
	/**
	 * Método que permite obtener el campo1 .
	 *
	 * @return String                       cadena que contiene la configuración del campo 1 
	 * para más información de un usuario.
	 * @throws Exception 					No lanza exceptiones.
	*/
	public function obtenerCampo1(){
		return $this->campo1;
	}
		/**
	 * Método que permite asignar el campo2.
	 *
	 * @param  String  $Campo2            	cadena donde se guarda la configuración del campo 2
	 * para más información de un usuario.
	 * 
	 * @return $this                        Instancia del objeto.  
	 *
	 * @throws Exception 					No lanza exceptiones.
	*/
	public function asignarCampo2($campo2){
		$this->campo2=$campo2;
		return $this;
	
	}
	/**
	 * Método que permite obtener el campo2 .
	 *
	 * @return String                       cadena que contiene la configuración del campo 2
	 * para más información de un usuario.
	 * @throws Exception 					No lanza exceptiones.
	*/
	public function obtenerCampo2(){
		return $this->campo2;
	}
		/**
	 * Método que permite asignar el campo3.
	 *
	 * @param  String  $Campo3           	cadena donde se guarda la configuración del campo 3
	 * para más información de un usuario.
	 * 
	 * @return $this                        Instancia del objeto.  
	 *
	 * @throws Exception 					No lanza exceptiones.
	*/
	public function asignarCampo3($campo3){
		$this->campo3=$campo3;
		return $this;
	
	}
	/**
	 * Método que permite obtener el campo3 .
	 *
	 * @return String                       cadena que contiene la configuración del campo 3
	 * para más información de un usuario.
	 * @throws Exception 					No lanza exceptiones.
	*/
	public function obtenerCampo3(){
		return $this->campo3;
	}

}

?>
