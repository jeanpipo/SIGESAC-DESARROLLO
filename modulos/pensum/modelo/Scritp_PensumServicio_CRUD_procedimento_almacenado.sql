/**
 * copyright 2014 - Instituto Universtiario de Tecnología Dr. Federico Rivero Palacio
 * license GPLv3
 * license http://www.gnu.org/licenses/gpl-3.0.html
 *
 * Script PesumnServicio.sql - Servicio del módulo Instituto.
 *
 * Esta clase ofrece el servicio de conexión a la base de datos, recibe 
 * los parámetros, construye las consultas SQL, hace las peticiones a 
 * la base de datos y retorna los objetos o datos correspondientes a la
 * acción. en este archivo se contiene todo lo relacionado a instituto
 * es el archivo que permite la interacion la lo relacionado a instituto
 * en la base de datos.Todas las funciones de esta clase relanzan las excepciones si son capturadas.
 * Esto con el fin de que la clase manejadora de errores las capture y procese.
 *
 * author Rafael Garcia (rafaelantoniorf@gmail.com)
 * 
 * explicacion de standar de creacion de funciones (Store precedure) 
 */

-- Insertar ------------------------------------------------------
-- nombre del procedure
-- ver documento de nomenclartura de procedure

CREATE OR REPLACE FUNCTION sis.f_pensum_insertar(text, text, text, integer, integer, integer, date)
  RETURNS INTEGER  AS   
$BODY$
DECLARE
  codigoPensum integer := 0;
  v_nombre ALIAS for $1;  
  v_nom_corto ALIAS for $2;
  v_observaciones ALIAS for $3;
  v_min_can_elect ALIAS for $4;
  v_min_cre_elect ALIAS for $5;
  v_min_cre_obligat ALIAS for $6;
  v_fec_creac ALIAS for $7; 
BEGIN

  SELECT COALESCE (max(codigo),0) FROM sis.t_pensum INTO codigoPensum;
  codigoPensum := codigoPensum + 1; 

  INSERT INTO sis.t_pensum(codigo, nombre, nom_corto, observaciones, min_can_electiva, min_cre_electiva, min_cre_obligatoria, fec_creacion)
  VALUES (codigoPensum, v_nombre, v_nom_corto, v_observaciones, v_min_can_elect, v_min_cre_elect, v_min_cre_obligat, v_fec_creac);

  RETURN codigoPensum;

END;
$BODY$
  LANGUAGE plpgsql VOLATILE 
  COST 100; 
ALTER FUNCTION sis.f_pensum_insertar(text, text, text, integer, integer, integer, date) -- usuriao para la funcion
  OWNER TO postgres;


select sis.f_pensum_insertar('pnf_electricidad', 'pne', 'pensum de electricidad 2016 ', 2, 1, 2, '2016-05-13');; 
select * from sis.t_pensum;

-- Actualizar ------------------------------------------------------

-- las referencias verlas en insercion
CREATE OR REPLACE FUNCTION sis.f_pensum_actualizar(integer, text, text, text, integer, integer, integer, date)
  RETURNS integer AS
$BODY$
DECLARE
  v_operacion integer := 0;
  v_codigo ALIAS for $1;  v_nombre ALIAS for $2;  
  v_nom_corto ALIAS for $3; v_observaciones ALIAS for $4;
  v_min_can_elect ALIAS for $5; v_min_cre_elect ALIAS for $6;
  v_min_cre_obligat ALIAS for $7; v_fec_creac ALIAS for $8;   
BEGIN

 UPDATE sis.t_pensum
   SET nombre = v_nombre, nom_corto = v_nom_corto, observaciones = v_observaciones, min_can_electiva = v_min_can_elect, 
       min_cre_electiva = v_min_cre_elect, min_cre_obligatoria = v_min_cre_obligat, fec_creacion = v_fec_creac       
 WHERE t_pensum.codigo = v_codigo;

   IF found THEN  
  v_operacion :=1;
   END IF;
  
 RETURN v_operacion;
 
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sis.f_pensum_actualizar(integer, text, text, text, integer, integer, integer, date)
  OWNER TO postgres;


select sis.f_pensum_actualizar(8,'prueba_actulizacion','prueba_actulizacion','prueba_actulizacion');


-- Eliminar ------------------------------------------------------

-- consulta referencias anteriores
CREATE OR REPLACE FUNCTION sis.f_pensum_eliminar(
    integer
    )
  RETURNS integer AS
$BODY$
DECLARE
  v_operacion integer := 0;
  v_codigo ALIAS for $1;  
BEGIN

  DELETE FROM sis.t_pensum
  WHERE t_pensum.codigo = v_codigo;

  IF found THEN  
  v_operacion :=1;
  END IF;

RETURN v_operacion; 

END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sis.f_pensum_eliminar(integer)
  OWNER TO postgres;

select  sis.f_pensum_eliminar(13);

-- SELECTS Standar ------------------------------------------------------

-- ver referencias anterirores 
-- valor de entrada refcursor sirver como nombre para curso 
-- para efectos de trabajo y prueba pasarle el nombre del cursor
-- seleccionar todos

CREATE OR REPLACE FUNCTION sis.f_pensum_seleccionar(refcursor)
  RETURNS refcursor AS
$BODY$

BEGIN
  
  OPEN $1 FOR SELECT codigo, nombre, nom_corto, observaciones, min_can_electiva, min_cre_electiva,
  min_cre_obligatoria, fec_creacion
  FROM sis.t_pensum;
    
 RETURN $1;   
 
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sis.f_pensum_seleccionar(refcursor)
  OWNER TO postgres;

--{ para efectos de trabajo y prueba correrlos ambos (ADVERTENCIA No usar mayuscular y minusculas juntas) 
 select sis.f_instituto_seleccionar('fcursor');
 FETCH ALL IN fcursor;
--}

-------------------------------------------------------------------------------------
-- selecionar por codigo 


CREATE OR REPLACE FUNCTION sis.f_pensum_por_codigo_seleccionar(refcursor, integer)
  RETURNS refcursor AS
$BODY$
BEGIN
  
  OPEN $1 FOR SELECT codigo, nombre, nom_corto, observaciones, min_can_electiva, min_cre_electiva,
  min_cre_obligatoria, fec_creacion
  FROM sis.t_pensum where codigo = $2;
    
 RETURN $1;   
 
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sis.f_pensum_por_codigo_seleccionar(refcursor, integer)
  OWNER TO postgres;

 select sis.f_pensum_por_codigo_seleccionar('fcursorinst',2);
 FETCH ALL IN fcursorinst;

 
