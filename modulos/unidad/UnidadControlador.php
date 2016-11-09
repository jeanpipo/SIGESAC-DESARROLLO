<?php


/**
 * @copyright 2014 - Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio
 * @license GPLv3
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 *
 * UnidadControlador.php  Controladores de MVCRIVERO.
 *
 *	Este es el controlador del módulo UnidadCurricular, permite manejar las 
 *	operaciones relacionadas con los UnidadCurricular y prelacion (agregar, modificar,
 *	eliminar, consultar, buscar), es el intermediario entre la base de
 *	datos y la vista. La función manejarRequerimiento se maneja la accion a emprender, 
 *  obteniéndola del arreglo Post/Get en la posición 'accion'
 * 
 *  
 * @author RAFAEL GARCIA 		(rafaelantoniorf@gmail.com)
 * @author Johan Alamo (lider de proyecto) <johan.alamo@gmail.com>
 * 
 * @link modulos/unidad/modelo/UnidadCurricularServicio.php			 Clase UnidadCurricularServicio
 * @link /negocio/UniCurricular.php 			                         Clase UnidadCurricular
 * 
 * @package Controladores
 */

	require_once("modulos/unidad/modelo/UnidadCurricularServicio.php");
	require_once("modulos/unidad/modelo/UniTraPensumServicio.php");
	require_once("modulos/unidad/modelo/PrelacionServicio.php");

	require_once("negocio/UniCurricular.php"); 
	require_once("negocio/Prelacion.php");


	class  UnidadControlador
	{
		public static function manejarRequerimiento(){		
		
				//permite obtener la acción a realizar en este módulo

				$accion = PostGet::obtenerPostGet('m_accion');
	
				if ( ! $accion)
					$accion = 'listarUnidades';

				// accioens de unidad curricular
			   	else if ($accion == 'listarUnidades') 	
					self::listarUnidades();									
				else if ($accion == 'eliminarUnidadCurricular')
					self::eliminarUnidadCurricular();
				else if ($accion =='preAgregarModif')
					self::preAgregarModif();
				else if ($accion == 'preAgregModif')
					self::preAgregModif();
								
			/*	else if ($accion == 'agregarUnidadCurricular')					
					self::agregarUnidadCurricular();	
				else if ($accion =='modificarUnidadCurricular')
					self::modificarUnidadCurricular();	*/						
				else if ($accion =='buscarCodigoUnidadCurricular')
					self::buscarCodigoUnidadCurricular();
				else if ($accion =='buscarUniPorCoincidencia')
					self::buscarUniPorCoincidencia();	
				else if ($accion =='buscarUniCurricularPorPensum')
					self::buscarUniCurricularPorPensum();				
				else if ($accion =='buscarUniCurriPorPenYTra')
					self::buscarUniCurriPorPenYTra();			
	
				// servicio de prelacion
				else if ($accion == 'agregarPrelacion')					
					self::agregarPrelacion();
				else if ($accion == 'ModificarPrelacion')				
					self::ModificiarPrelacion();
				else if ($accion =='buscarPrelacion')
					self::obtenerPrelacion();
				else if ($accion =='eliminarPrelacion')
					self::eliminarPrelacion();
				else if ($accion == 'obtenerPerlacionPorRequerido')
					self::obtenerPerlacionPorRequerido();
				else if ($accion == 'obtenerPerlacionPorRequisito')
					self::obtenerPerlacionPorRequisito();
				// agregar Unidad a Pesum

				else if ($accion =='AgregarUniTraPen')
					self::AgregarUniTraPen();
				else if ($accion == 'ModificarUniTraPen')					
					self::ModificarUniTraPen();
				else if ($accion == 'obtenerUniTraPen')				
					self::obtenerUniTraPen();			
				else if ($accion =='eliminarUniTraPen')
					self::eliminarUniTraPen();

				else if ($accion == "ListarUnidadesPorPenTraPatron")
					self::ListarUnidadesPorPenTraPatron();
				elseif ($accion == "uniCurPensum") {
					self::uniCurPensum();
				}


				else
				throw new Exception ("(PensumControlador) Accion $accion no es valida");	
		}

	/**
	 * Función del controlaodr que Permite listar .
	 * 
	 * permite listar todos las UnidadCurricular.		 		 
	 *
	 * @throws Exception 					Si no se puede hacer la acion y ocurre una error en el servicio.
	 */	
	 public static function listarUnidades(){
			try{				
				$unidades=UnidadServicio::listarUniCurricular();
				$mensaje="Unidades";
				Vista::asignarDato('unidades',$unidades);
				Vista::asignarDato('mensaje',$mensaje);
				Vista::asignarDato('estatus',1);
				Vista::mostrar();
			}catch(Exception $e){
				throw $e;
			}
		}		


	/**
	 * Función del controlaor que Permite ver la vista de agregar/modificar .
	 * 
	 * permite listar todos las UnidadCurricular.		 		 
	 *
	 * @throws Exception 					Si no se puede hacer la acion y ocurre una error en el servicio.
	 */	
	 public static function preAgregarModif(){
			try{				
				if (PostGet::obtenerPostGet('codigo'))				
					$unidades = UnidadServicio::obtener(PostGet::obtenerPostGet('codigo'));			
				else					
					$unidades = null;		
				$mensaje="Unidad curricular";
				Vista::asignarDato('unidad',$unidades);
				Vista::asignarDato('mensaje',$mensaje);
				Vista::asignarDato('estatus',1);
				Vista::mostrar();
			}catch(Exception $e){
				throw $e;
			}
		}


	/**
	*
	*
	*
    * @throws Exception 					Si no se puede hacer la acion y ocurre una error en el servicio.
	*/	
	public static function preAgregModif(){
			try{				
				if (!PostGet::obtenerPostGet('codigo')){				
					$UniCurricular=new UniCurricular();
					$UniCurricular->asignarCodUniMinisterio(PostGet::obtenerPostGet('codMinisterio'));
					$UniCurricular->asignarNombre(PostGet::obtenerPostGet('nombre'));			
					$UniCurricular->asignarHta(PostGet::obtenerPostGet('hta'));
					$UniCurricular->asignarHti(PostGet::obtenerPostGet('hti'));
					$UniCurricular->asignarUniCredito(PostGet::obtenerPostGet('unidadesCredito'));
					$UniCurricular->asignarDurSemana(PostGet::obtenerPostGet('duracionSemanas'));				
					$UniCurricular->asignarNotMinAprobatoria(PostGet::obtenerPostGet('notaMinima'));	
					$UniCurricular->asignarNotMaxima(PostGet::obtenerPostGet('notaMaxima'));
					$UniCurricular->asignarDescripcion(PostGet::obtenerPostGet('descripcion'));
					$UniCurricular->asignarObservacion(PostGet::obtenerPostGet('observacion'));
					$UniCurricular->asignarContenido(PostGet::obtenerPostGet('contenido'));
					$unidades = self::agregarUnidadCurricular($UniCurricular);
				}else{	
					
			 		$UniCurricular=new UniCurricular();			
					$UniCurricular->asignarCodigo(PostGet::obtenerPostGet('codigo'));
					$UniCurricular->asignarCodUniMinisterio(PostGet::obtenerPostGet('codMinisterio'));
					$UniCurricular->asignarNombre(PostGet::obtenerPostGet('nombre'));			
					$UniCurricular->asignarHta(PostGet::obtenerPostGet('hta'));
					$UniCurricular->asignarHti(PostGet::obtenerPostGet('hti'));
					$UniCurricular->asignarUniCredito(PostGet::obtenerPostGet('unidadesCredito'));
					$UniCurricular->asignarDurSemana(PostGet::obtenerPostGet('duracionSemanas'));				
					$UniCurricular->asignarNotMinAprobatoria(PostGet::obtenerPostGet('notaMinima'));	
					$UniCurricular->asignarNotMaxima(PostGet::obtenerPostGet('notaMaxima'));
					$UniCurricular->asignarDescripcion(PostGet::obtenerPostGet('descripcion'));
					$UniCurricular->asignarObservacion(PostGet::obtenerPostGet('observacion'));
					$UniCurricular->asignarContenido(PostGet::obtenerPostGet('contenido'));
					$unidades = self::modificarUnidadCurricular($UniCurricular);
				}		
			//	$mensaje="Unidad curricular";
			//	Vista::asignarDato('unidad',$unidades);
				//Vista::asignarDato('mensaje',$mensaje);
			//	Vista::asignarDato('estatus',1);
			//	Vista::mostrar();
			}catch(Exception $e){
				throw $e;
			}
		}
	
	/**
	 * Función que permite eliminar un UnidadCurricular.
	 *
	 *Permite eliminar un UnidadCurricular, recibe los parámetros desde 
	 * la vista (arreglo PostGet) y llama a UnidadCurricular servicio que permite
	 * comunicarse con la base de datos,y este último retorna el resultado
     * ya sea éxito o fracaso.
	 * 
	 * @param string $codigo 			  		codigo codigo UnidadCurricular.
	 *
	 * @throws Exception 					Si no se puede hacer la acion.
	 */		
		public static function eliminarUnidadCurricular()
		{
			try
			{
				$r=UnidadServicio::eliminar(PostGet::obtenerPostGet('codigo'));
				$mensaje="Unidad Curricular Eliminada";
				Vista::asignarDato('unidad',$r);
				Vista::asignarDato('mensaje',$mensaje);
				Vista::asignarDato('estatus',1);
				Vista::mostrar();
			}catch (Exception $e){
				throw $e;
			}
		}


	/**
		 * Función Permite Agregar UnidadCurricular.
		 * 
		 * Permite manejar  el agregar un UnidadCurricular, recibe los parámetros desde 
		 * la vista (arreglo PostGet) y llama a UnidadCurricular servicio que permite
		 * comunicarse con la base de datos,y este último retorna el resultado
	     * ya sea éxito o fracaso,
		 * 
		 * valores muy interpetativos
		 * @param string $codMinisterio 			  		 
		 * @param int $nombreUC 			   nombre de la unidada de credito		 
		 * @param int $hta 			  	
		 * @param int $hti 			  		 
		 * @param int $unidadesCredito 			  		 
		 * @param int $duracionSemanas 			  	 
		 * @param int $notaMinima 			  		
		 * @param int $notaMaxima 			  		
		 * @param string $descripcion 			  	
		 * @param string $observacion 			  		
		 * @param string $contenido 		  	
		 *
		 * @throws Exception 					Si no se puede hacer la acion.
		 */	
		public static function agregarUnidadCurricular($Unidad){
			try{
			/*	$UniCurricular=new UniCurricular();
				$UniCurricular->asignarCodUniMinisterio(PostGet::obtenerPostGet('codMinisterio'));
				$UniCurricular->asignarNombre(PostGet::obtenerPostGet('nombreUC'));			
				$UniCurricular->asignarHta(PostGet::obtenerPostGet('hta'));
				$UniCurricular->asignarHti(PostGet::obtenerPostGet('hti'));
				$UniCurricular->asignarUniCredito(PostGet::obtenerPostGet('unidadesCredito'));
				$UniCurricular->asignarDurSemana(PostGet::obtenerPostGet('duracionSemanas'));				
				$UniCurricular->asignarNotMinAprobatoria(PostGet::obtenerPostGet('notaMinima'));	
				$UniCurricular->asignarNotMaxima(PostGet::obtenerPostGet('notaMaxima'));
				$UniCurricular->asignarDescripcion(PostGet::obtenerPostGet('descripcion'));
				$UniCurricular->asignarObservacion(PostGet::obtenerPostGet('observacion'));
				$UniCurricular->asignarContenido(PostGet::obtenerPostGet('contenido'));*/
				$r=UnidadServicio::agregarUniCurricularObjetc($Unidad);
				$mensaje="Unidad Curricular Agregada";
				Vista::asignarDato('Unidad',$r);
				Vista::asignarDato('mensaje',$mensaje);
				Vista::asignarDato('estatus',1);
				Vista::mostrar();
			}
			catch (Exception $e) {
				throw $e;
			}
		}

	/**
	 * Función que permite obtener un instituto.
	 *
	 *Permite obtener un instituto, recibe los parámetros desde 
	 * la vista (arreglo PostGet) y llama a instituto servicio que permite
	 * comunicarse con la base de datos,y este último retorna el resultado
     * ya sea éxito o fracaso.
	 * 
	 * @param string $codigo 			  		codigo codigo instituto.
	 *
	 * @throws Exception 					Si no se puede hacer la acion.
	 */		
		public static function buscarCodigoUnidadCurricular(){
			try
			{
				$r=UnidadServicio::obtener(PostGet::obtenerPostGet('codigo'));
				$a=UnidadServicio::obtenerPensumUsado(PostGet::obtenerPostGet('codigo'));
				$mensaje="Codigo";
				Vista::asignarDato('unidad',$r);
				Vista::asignarDato('usada',$a);
				Vista::asignarDato('mensaje',$mensaje);
				Vista::asignarDato('estatus',1);
				Vista::mostrar();
			}
			catch (Exception $e) {
				throw $e;
			}
		}




	/**
	 * Función que permite obtener un instituto.
	 *
	 *Permite obtener un instituto, recibe los parámetros desde 
	 * la vista (arreglo PostGet) y llama a instituto servicio que permite
	 * comunicarse con la base de datos,y este último retorna el resultado
     * ya sea éxito o fracaso.
	 * 
	 * @param string $codigo 			  		codigo codigo instituto.
	 *
	 * @throws Exception 					Si no se puede hacer la acion.
	 */		
		public static function buscarUniPorCoincidencia(){
			try
			{
				$r=UnidadServicio::obtenerPorCoincidencia(PostGet::obtenerPostGet('patron'),
						   								  PostGet::obtenerPostGet('accion'));
				$mensaje="Unidades Por Patron";
				Vista::asignarDato('unidades',$r);
				Vista::asignarDato('mensaje',$mensaje);
				Vista::asignarDato('estatus',1);
				Vista::mostrar();
			}
			catch (Exception $e) {
				throw $e;
			}
		}

	/**
	 * Función que permite obtener un pensum.
	 *
	 *Permite obtener un pensum, recibe los parámetros desde 
	 * la vista (arreglo PostGet) y llama a pensum servicio que permite
	 * comunicarse con la base de datos,y este último retorna el resultado
     * ya sea éxito o fracaso.
	 * 
	 * @param string $codigo 			  		codigo codigo pensum.
	 *
	 * @throws Exception 					Si no se puede hacer la acion.
	 */		
		public static function buscarUniCurricularPorPensum()
		{
			try
			{
				$r=UnidadServicio::ObtenerUnidadesPorPensum(PostGet::obtenerPostGet('codigo'));
			//	var_dump($r);
				$mensaje="Pensum";
				Vista::asignarDato('pensum',$r);
				Vista::asignarDato('estatus',1);
				Vista::asignarDato('mensaje',$mensaje);
				Vista::mostrar();
			}
			catch (Exception $e){
				throw $e;
			}
		}


	/**
	 * Función que permite obtener un pensum.
	 *
	 *Permite obtener un pensum, recibe los parámetros desde 
	 * la vista (arreglo PostGet) y llama a pensum servicio que permite
	 * comunicarse con la base de datos,y este último retorna el resultado
     * ya sea éxito o fracaso.
	 * 
	 * @param string $codigo 			  		codigo codigo pensum.
	 *
	 * @throws Exception 					Si no se puede hacer la acion.
	 */		
		public static function buscarUniCurriPorPenYTra()
		{
			try
			{
				$r=UnidadServicio::ObtenerUnidadesPorPenYTra(PostGet::obtenerPostGet('codigoTra'),
															 PostGet::obtenerPostGet('codigoPen'));
			//	var_dump($r);
				$mensaje="Pensum";
				Vista::asignarDato('pensum',$r);
				Vista::asignarDato('estatus',1);
				Vista::asignarDato('mensaje',$mensaje);
				Vista::mostrar();
			}
			catch (Exception $e){
				throw $e;
			}
		}


/**
	 * Función que permite modificar un instituto.
	 *
	 * Permite modificar un instituto, recibe los parámetros desde 
	 * la vista (arreglo PostGet) y llama a instituto servicio que permite
	 * comunicarse con la base de datos,y este último retorna el resultado
     * ya sea éxito o fracaso.
	 * 
  	 * @param string $codMinisterio 			  		 
	 * @param int $nombreUC 			   nombre de la unidada de credito		 
	 * @param int $hta 			  	
	 * @param int $hti 			  		 
	 * @param int $unidadesCredito 			  		 
	 * @param int $duracionSemanas 			  	 
	 * @param int $notaMinima 			  		
	 * @param int $notaMaxima 			  		
	 * @param string $descripcion 			  	
	 * @param string $observacion 			  		
	 * @param string $contenido 		
 	 *
	 * @throws Exception 					Si no se puede hacer la acion.
	 */	
		public static function modificarUnidadCurricular($UniCurricular){
			try{				
				$mensaje="se ha Modificado la unidad curricular";
				$r=UnidadServicio::modificarUniCurricularObject($UniCurricular);
				Vista::asignarDato('mensaje',$mensaje);
				Vista::asignarDato('estatus',1);
				Vista::mostrar();
			}
			catch (Exception $e) {
				throw $e;
			}
		}


		/**
		prelaciones
		*/

		public static function agregarPrelacion(){
			try{
			
				$Prelacion=new Prelacion();
				$Prelacion->asignarCodigoPesum(PostGet::obtenerPostGet('cod_pensum'));
				$Prelacion->asignarCodigoInstituto(PostGet::obtenerPostGet('cod_instituto'));			
				$Prelacion->asignarCodigoUniCurricular(PostGet::obtenerPostGet('cod_uni_curricular'));
				$Prelacion->asignarCodigoUniCurPrelada(PostGet::obtenerPostGet('cod_uni_cur_prelada'));
				$r=PrelacionServicio::agregarPrelacionObjetc($Prelacion);
				$mensaje="Prelacion Agregada";
				Vista::asignarDato('prelacion',$r);
				Vista::asignarDato('mensaje',$mensaje);
				Vista::asignarDato('estatus',1);
				Vista::mostrar();
			}
			catch (Exception $e) {
				throw $e;
			}
		}
		
		public static function agregarPrelacionModificar(){
			try{
				
				$Prelacion=new Prelacion();
				$Prelacion->asignarCodigo(PostGet::obtenerPostGet('codigo'));
				$Prelacion->asignarCodigoPesum(PostGet::obtenerPostGet('cod_pensum'));
				$Prelacion->asignarCodigoInstituto(PostGet::obtenerPostGet('cod_instituto'));			
				$Prelacion->asignarCodigoUniCurricular(PostGet::obtenerPostGet('cod_uni_curricular'));
				$Prelacion->asignarCodigoUniCurPrelada(PostGet::obtenerPostGet('cod_uni_cur_prelada'));

				$r=PrelacionServicio::agregarPrelacionModificar($Prelacion);

				$mensaje="Prelacion Modificación Con Exito";
				Vista::asignarDato('prelacion',$r);
				Vista::asignarDato('mensaje',$mensaje);
				Vista::asignarDato('estatus',1);
				Vista::mostrar();
			}
			catch (Exception $e) {throw $e;}
		}

		public static function buscarPrelacionUnidadCurricular()
		{
			try{
				$r=PrelacionServicio::buscarPrelacionUnidadCurricular(PostGet::obtenerPostGet('codigo'));
				$mensaje="Prelacion de Unidad Curricular";
				Vista::asignarDato('mensaje',$mensaje);
				Vista::asignarDato('prelacion',$r);
				Vista::asignarDato('estatus',1);
				Vista::mostrar();
			}
			catch (Exception $e) {throw $e;}	
		}

		public static function eliminarPrelacion(){
			try{
				$codigo=PostGet::obtenerPostGet('codigoPrelada');
				$r=PrelacionServicio::eliminar($codigo);
				$mensaje="Prelacion Eliminada";
				Vista::asignarDato('prelacion',$r);
				Vista::asignarDato('mensaje',$mensaje);
				Vista::asignarDato('estatus',1);
				Vista::mostrar();
			}
			catch (Exception $e) {throw $e;}
		}

		public static function obtenerPerlacionPorRequerido(){
			try{
				
				$r=PrelacionServicio::obtenerPorRequerido(PostGet::obtenerPostGet('codigoUnidad'),
													      PostGet::obtenerPostGet('codigoPensum'));
				$mensaje="Prelacion Por Pensum";
			
				Vista::asignarDato('prelacion',$r);
				Vista::asignarDato('mensaje',$mensaje);
				Vista::asignarDato('estatus',1);
				Vista::mostrar();
			}
			catch (Exception $e) {throw $e;}
		}

			public static function obtenerPerlacionPorRequisito(){
			try{
				
				$r=PrelacionServicio::obtenerPorRequisito(PostGet::obtenerPostGet('codigoUnidad'),
													      PostGet::obtenerPostGet('codigoPensum'));
				$mensaje="Prelacion Por Pensum";
			
				Vista::asignarDato('prelacion',$r);
				Vista::asignarDato('mensaje',$mensaje);
				Vista::asignarDato('estatus',1);
				Vista::mostrar();
			}
			catch (Exception $e) {throw $e;}
		}
	
		/**
		// UNIDAD TRAN PESUM
		*/	
		/**
		 * Función Permite Agregar UnidadCurricular.
		 * 
		 * Permite manejar  el agregar un UnidadCurricular, recibe los parámetros desde 
		 * la vista (arreglo PostGet) y llama a UnidadCurricular servicio que permite
		 * comunicarse con la base de datos,y este último retorna el resultado
	     * ya sea éxito o fracaso,
		 * 
		 * valores muy interpetativos
		 * @param string $codMinisterio 			  		 
		 * @param int $nombreUC 			   nombre de la unidada de credito		 
		 * @param int $hta 			  	
		 * @param int $hti 	 
  		 *	
		 *
		 * @throws Exception 					Si no se puede hacer la acion.
		 */	
		public static function AgregarUniTraPen(){
			try{
				
				if (PostGet::obtenerPostGet('trayecto') == null) 
					$trayecto = null;
				else
					$trayecto = PostGet::obtenerPostGet('trayecto');			


				$r=UniTraPensumServicio::agregarUniTraPenObjetc(
					PostGet::obtenerPostGet('pensum'),
					$trayecto,
					PostGet::obtenerPostGet('codigoUnidad'),
					PostGet::obtenerPostGet('tipo')
					);
				$mensaje="Unidad Curricular Agregada";
				Vista::asignarDato('UnidadR',$r);
				Vista::asignarDato('mensaje',$mensaje);
				Vista::asignarDato('estatus',1);
				Vista::mostrar();
			}
			catch (Exception $e) {
				throw $e;
			}
		}
	
		
			/**
		 * Función Permite Agregar UnidadCurricular.
		 * 
		 * Permite manejar  el agregar un UnidadCurricular, recibe los parámetros desde 
		 * la vista (arreglo PostGet) y llama a UnidadCurricular servicio que permite
		 * comunicarse con la base de datos,y este último retorna el resultado
	     * ya sea éxito o fracaso,
		 * 
		 * valores muy interpetativos
		 * @param string $codMinisterio 			  		 
		 * @param int $nombreUC 			   nombre de la unidada de credito		 
		 * @param int $hta 			  	
		 * @param int $hti 	 
  		 *	
		 *
		 * @throws Exception 					Si no se puede hacer la acion.
		 */	
		public static function ModificarUniTraPen(){
			try{
				
				if (PostGet::obtenerPostGet('trayecto') == null) 
					$trayecto = null;
				else
					$trayecto = PostGet::obtenerPostGet('trayecto');			

				$r=UniTraPensumServicio::modificarPrelacionParametro(PostGet::obtenerPostGet('codigo'),
					PostGet::obtenerPostGet('pensum'),
					$trayecto,
					PostGet::obtenerPostGet('codigoUnidad'),
					PostGet::obtenerPostGet('tipo')
					);
				$mensaje="Unidad Curricular Agregada";
				Vista::asignarDato('UnidadR',$r);
				Vista::asignarDato('mensaje',$mensaje);
				Vista::asignarDato('estatus',1);
				Vista::mostrar();
			}
			catch (Exception $e) {
				throw $e;
			}
		}


	/**
	 * Función que permite obtener un pensum.
	 *
	 *Permite obtener un pensum, recibe los parámetros desde 
	 * la vista (arreglo PostGet) y llama a pensum servicio que permite
	 * comunicarse con la base de datos,y este último retorna el resultado
     * ya sea éxito o fracaso.
	 * 
	 * @param string $codigo 			  		codigo codigo pensum.
	 *
	 * @throws Exception 					Si no se puede hacer la acion.
	 */		
		public static function obtenerUniTraPen()
		{
			try
			{
				$r=UniTraPensumServicio::obtener(PostGet::obtenerPostGet('codigo'));
			//	var_dump($r);
				$mensaje="Pensum";
				Vista::asignarDato('UnidadR',$r);
				Vista::asignarDato('estatus',1);
				Vista::asignarDato('mensaje',$mensaje);
				Vista::mostrar();
			}
			catch (Exception $e){
				throw $e;
			}
		}

	/**
	 * Función que permite eliminar un UnidadCurricular.
	 *
	 *Permite eliminar un UnidadCurricular, recibe los parámetros desde 
	 * la vista (arreglo PostGet) y llama a UnidadCurricular servicio que permite
	 * comunicarse con la base de datos,y este último retorna el resultado
     * ya sea éxito o fracaso.
	 * 
	 * @param string $codigo 			  		codigo codigo UnidadCurricular.
	 *
	 * @throws Exception 					Si no se puede hacer la acion.
	 */		
		public static function eliminarUniTraPen()
		{
			try
			{
				$r=UniTraPensumServicio::eliminar(PostGet::obtenerPostGet('codigo'));
				$mensaje="Unidad Curricular Eliminada";
				Vista::asignarDato('unidad',$r);
				Vista::asignarDato('mensaje',$mensaje);
				Vista::asignarDato('estatus',1);
				Vista::mostrar();
			}catch (Exception $e){
				throw $e;
			}
		}

		public static function ListarUnidadesPorPenTraPatron(){

			try{
				//echo "dfdsssf";
				$codTrayecto=PostGet::obtenerPostGet('trayecto');
				$codPensum=PostGet::obtenerPostGet('pensum');
				$patron=PostGet::obtenerPostGet('patron');
				$tipo=PostGet::obtenerPostGet('tipo');
				if($codTrayecto && $codPensum && $patron && $tipo)
					$r=UnidadServicio::ObtenerUnidadesPorPenTraPatron($codTrayecto,$codPensum,$patron,$tipo);
				else
					$r=null;
				//var_dump($r);
				$cad = "[";
				if ($r != null){
					$c = 0;
					foreach ($r as $unidad) {
						if ($c > 0)
							$cad .= ",";
						$cad .= "{";
						$cad .= '"label": "' . $unidad['nombre']. '", ';
						$cad .= '"value": '.$unidad['codigo'];
						$cad .= "}";
						$c++;
					}
				}
				else{
					$cad .= "{";
					$cad .= '"label":"No hay coincidencias", ';
					$cad .= '"value": "null"';
					$cad .= "}";
				}
				$cad .= "]";

				Vista::asignarDato("auto",$cad);

				Vista::asignarDato("detalleUnidad",$r);
				Vista::asignarDato("estatus",1);
				Vista::mostrar();
			}
			catch(Exception $e){
				throw $e;
			}
		}

		public static function uniCurPensum(){
			try{
				$pensum=PostGet::obtenerPostGet("pensum");
				$tipo=PostGet::obtenerPostGet("tipo");
				$patron=PostGet::obtenerPostGet("patron");

				$r=UnidadServicio::uniCurPensum($pensum,$patron,$tipo);
				
				$cad = "[";
				if ($r != null){
					$c = 0;
					foreach ($r as $unidad) {
						if ($c > 0)
							$cad .= ",";
						$cad .= "{";
						$cad .= '"label": "' . $unidad['nombre']. '", ';
						$cad .= '"value": '.$unidad['codigo'];
						$cad .= "}";
						$c++;
					}
				}
				else{
					$cad .= "{";
					$cad .= '"label":"No hay coincidencias", ';
					$cad .= '"value": "null"';
					$cad .= "}";
				}
				$cad .= "]";

				Vista::asignarDato("auto",$cad);

				Vista::asignarDato("detalleUnidad",$r);
				Vista::asignarDato("estatus",1);
				Vista::mostrar();


			}
			catch(Exception $e){
				throw $e;
			}
		}


	}
?>
