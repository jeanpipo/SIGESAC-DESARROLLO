<?php
/**
 * @copyright 2016 - Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio
 * @license GPLv3
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 *
 * Permisos.php - Componente de MVCRIVERO.
 *
 * Clase que permite almacenar en un objeto todos los permisos que posee un usuario
 * en el sistema.Esta clase facilita todo lo referenciado a permisos ya que es capaz de tranformar los
 * permisos en javascrip, o twig al momento de necesitar todos estos permisos en algunos 
 * de esos ambientes. Ademas facilita el manejo de permiso al programador ya que se puede
 * utilizar de una manera muy intuitiva y muy segura ya que dichos permisos se cargaran 
 * de base de datos ya que los usuarios que se utilizaran seran usuarios de base de datos, no usuarios comunes,
 * obtendremos sus permisos de usuario mediante los catalogos.
 * 
 * @author Johan Alamo (lider de proyecto) <johan.alamo@gmail.com>
 * @author JHONNY VIELMA      (jhonnyvq1@gmail.com)
 * @author GERALDINE CASTILLO (geralcs94@gmail.com)
 * 
 * @package Componentes
 */
 
	class Permisos{

		public $permisos;
		
		
		/**
		 * Funcion estatica que permite iniciar los permisos.
		 *
		 * Esta funcion inicia los permisos para su pronta utilización ya que al iniciarlos 
		 * se podran utilizar las funciones de esta clase.
		 *
		 */
		public function iniciar(){
			$this->permisos=array();
		}


		/**
		 * Funcion estatica que agregar una accion a los permisos.
		 *
		 * Permite crear una accion a los permisos y luego de crearla le asigna el valor de 
		 * el parametro $posee que significa si el usuario tiene o no esa acción, true de poseerla 
		 * y false de no poseerla.
		 *
		 * @param strig    $accion				Accion que se agregara a los permisos.
		 * @param bool     $posee				Parametro que identifica si el usuario posee el permiso con true y que no en false.
		 * 
		 * @throws Exception 					Exception de error al crear el modulo.
		 */
		public function agregarAccion($accion,$posee=false){
			try{
				if (!(self::existeAccion($accion))){
					$this->permisos[$accion]=$posee;
				}else
					throw new Exception("Ya existe la accion: ".$accion." en el objeto permiso",1);

			}catch (Exception $e){
				throw $e;
			}
		}
		
		/**
		 * Funcion privada que permite saber si existe una acción.
		 * 
		 *
		 * Permite saber si la acción pasada por parametro esta entre la lista de los acciones de 
		 * los permisos.
		 *
		 * @param strig    $accion				Acción a buscar.
		 * 
		 */
		private function existeAccion($accion){
			 return isset($this->permisos[$accion])? true: 0;
		}

		/**
		 * Funcion publica que permite verificar un permiso o acción
		 *
		 * Permite verificar un permiso o accion, si el usuario lo posee retorna true 
		 * si no retorna un 0 que se puede conparar con false.
		 *
		 * @param strig    $accion				Accion que se verificara.
		 * 
		 * @throws Exception 					Mensaje de no se pudo obtener el permiso.
		 * 
		 * @return boolean						True en caso de tener permiso y false en caso de que no tenga permiso.                      .
		 * 
		 */
		public function obtenerPermiso($accion){
			try{
				if (self::existeAccion($accion))
					return $this->permisos[$accion];
				else 
					throw new Exception("No se puede obtener informacion de dicha acción o permiso, ya que la acción: ".$accion." no existe.",2);
			}catch (Exception $e){
				throw $e;
			}
		}
		/**
		 * Funcion publica que permite obtener la permisologia en acciones en javascript
		 *
		 * Permite obtener una cadena javascript que al insertarla en javascrip genera la permisologia
		 * del usuario y esta se puede obtener mediante el nombre que se pasa por parametro + '.' + el nombre
		 * de la acción que se desea consultar el permiso del usuario y esto retornara true(1) de tener permiso 
		 * y false(0) de no tener permiso. ejemplo prueba.insertarUsuario 
		 *
		 * @param strig    $nombre				Nombre con el cual se quiere almacenar la permisologia en javascript.
		 * 
		 * @throws Exception 					De exepciones ajenas.
		 * 
		 * @return Strin						Cadena javascript.
		 * 
		 */
		public function obtenerJavascript($nombre){
			try{
				$acciones=$this->obtenerAcciones();
				$cad="";
				$cad.="function ".$nombre."(){";
				for ( $i=0; $i<count($acciones);$i++){
					$cad.="this.".$acciones[$i][0]." = ".$acciones[$i][1].";";
				}
				$cad.="} ".$nombre."= new ".$nombre."();";
				return $cad;
			}catch (Exception $e){
				throw $e;
			}

		}
	   /**
		 * Funcion privada que permite obtener las acciones guardadas en el objeto.
		 *
		 * Permite obtener las acciones en una matriz de 2 posiciones en la cual en
		 * la posicion [i][0] se encuentra el nombre de la acción y en la posición 
		 * [i][1] se encuentra el permiso del usuario en esa acción, 1 true y 0 false .
		 *
		 * 
		 * @return array[][]				Matriz de 2 posiciones en la posicion 0 nombre de la acción y posicion 1 permiso en acción.                      .
		 * 
		 */
		private function obtenerAcciones(){
			try{
				$acciones;
				$i=0;
				foreach ($this->permisos as $accion => $permiso){
					$acciones[$i][0]=$accion;
					if ($permiso==false)
						$acciones[$i][1]=0;
					else
						$acciones[$i][1]=1;
					$i++;
				}
				return $acciones;
			}catch (Exception $e){
				throw $e;
			}
		}	

	}	


?>
