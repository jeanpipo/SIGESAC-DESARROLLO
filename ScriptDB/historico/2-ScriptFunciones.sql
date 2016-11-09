\connect postgres;

\connect bd_sisconot;

CREATE FUNCTION sis.f_instituto_actualizar(p_codigo integer, p_nom_corto text, p_nombre text, p_direccion text) RETURNS integer
    LANGUAGE plpgsql
    AS $_$
DECLARE
	-- ALIAS es como su nombre lo indica
	-- los parametros de entrar se reciben con el signo $(N) donde N
	-- es el orde dado
	v_operacion integer := 0;
	-- no es necesario usar alias
	--v_codigo ALIAS for $1;
	--v_nom_corto ALIAS for $2;
	--v_nombre ALIAS for $3;
	--v_direccion ALIAS for $4;
BEGIN

 UPDATE sis.t_instituto
   SET
	nom_corto=p_nom_corto,
	nombre=p_nombre,
	direccion=p_direccion
 WHERE t_instituto.codigo = p_codigo;

   IF found THEN
	v_operacion :=1;
   END IF;

 RETURN v_operacion;
 -- si es necesario modificacion multiple hacerlo con transaccion

END;
$_$;


ALTER FUNCTION sis.f_instituto_actualizar(p_codigo integer, p_nom_corto text, p_nombre text, p_direccion text) OWNER TO sisconot;


CREATE FUNCTION sis.f_instituto_eliminar(p_codigo integer) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE
	v_operacion integer := 0;
BEGIN

  DELETE FROM sis.t_instituto
	WHERE t_instituto.codigo = p_codigo;

  IF found THEN
	v_operacion :=1;
  END IF;

RETURN v_operacion;

END;
$$;


ALTER FUNCTION sis.f_instituto_eliminar(p_codigo integer) OWNER TO sisconot;

CREATE FUNCTION sis.f_instituto_insertar(text, text, text) RETURNS integer
    LANGUAGE plpgsql
    AS $_$
DECLARE
	-- aqui se reclara las variables que necesite ejm: codigo (tipo) := ((valor) o (sin valor))
	codigoInstituto integer := 0;
	--pueden usar alias
	v_nom_corto ALIAS for $1;
	v_nombre ALIAS for $2;
	v_direccion ALIAS for $3;

BEGIN
  -- cuerpo de la FUNCTION
  -- obitenes el sequencian y lo guardas en variable
  --	SELECT nextval('id_squel') into codigoInstituto;
  -- o
  -- obtienes maximo codigo
  SELECT COALESCE (max(codigo),0) FROM sis.t_instituto INTO codigoInstituto;
  codigoInstituto := codigoInstituto + 1;

	 INSERT INTO sis.t_instituto(
		    codigo, nom_corto, nombre, direccion)
	    VALUES (codigoInstituto, v_nom_corto, v_nombre, v_direccion);

  RETURN codigoInstituto;

-- execepcion solo se usaran para transacciones
-- ejemplo
-- commit;
-- EXCEPTION
--  WHEN unique_violation THEN
--  Rollback;
--  RAISE EXCEPTION 'violacion de clave foranea';
-- RETURN -3;

END;
$_$;


ALTER FUNCTION sis.f_instituto_insertar(text, text, text) OWNER TO sisconot;


CREATE FUNCTION sis.f_instituto_seleccionar() RETURNS refcursor
    LANGUAGE plpgsql
    AS $$
DECLARE
	ref refcursor;
BEGIN

  OPEN ref FOR SELECT codigo, nom_corto, nombre, direccion
  FROM sis.t_instituto;

 RETURN ref;

END;
$$;


ALTER FUNCTION sis.f_instituto_seleccionar() OWNER TO sisconot;


CREATE FUNCTION sis.f_instituto_seleccionar(refcursor) RETURNS refcursor
    LANGUAGE plpgsql
    AS $_$

BEGIN

  OPEN $1 FOR SELECT codigo, nom_corto, nombre, direccion
  FROM sis.t_instituto;

 RETURN $1;

END;
$_$;


ALTER FUNCTION sis.f_instituto_seleccionar(refcursor) OWNER TO sisconot;


CREATE FUNCTION sis.f_instituto_seleccionar_por_codigo(refcursor, integer) RETURNS refcursor
    LANGUAGE plpgsql
    AS $_$

BEGIN

  OPEN $1 FOR SELECT codigo, nom_corto, nombre, direccion
  FROM sis.t_instituto where codigo = $2;

 RETURN $1;

END;
$_$;


ALTER FUNCTION sis.f_instituto_seleccionar_por_codigo(refcursor, integer) OWNER TO sisconot;


CREATE FUNCTION sis.f_pensum_actualizar(integer, text, text, text, integer, integer, integer, date) RETURNS integer
    LANGUAGE plpgsql
    AS $_$
DECLARE
	v_operacion integer := 0;
	v_codigo ALIAS for $1;	v_nombre ALIAS for $2;
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
$_$;


ALTER FUNCTION sis.f_pensum_actualizar(integer, text, text, text, integer, integer, integer, date) OWNER TO sisconot;

CREATE FUNCTION sis.f_pensum_eliminar(integer) RETURNS integer
    LANGUAGE plpgsql
    AS $_$
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
$_$;


ALTER FUNCTION sis.f_pensum_eliminar(integer) OWNER TO sisconot;


CREATE FUNCTION sis.f_pensum_insertar(text, text, text, integer, integer, integer, date) RETURNS integer
    LANGUAGE plpgsql
    AS $_$
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
$_$;


ALTER FUNCTION sis.f_pensum_insertar(text, text, text, integer, integer, integer, date) OWNER TO sisconot;


CREATE FUNCTION sis.f_pensum_por_codigo_seleccionar(refcursor, integer) RETURNS refcursor
    LANGUAGE plpgsql
    AS $_$
BEGIN

  OPEN $1 FOR SELECT codigo, nombre, nom_corto, observaciones, min_can_electiva, min_cre_electiva,
  min_cre_obligatoria, fec_creacion
  FROM sis.t_pensum where codigo = $2;

 RETURN $1;

END;
$_$;


ALTER FUNCTION sis.f_pensum_por_codigo_seleccionar(refcursor, integer) OWNER TO sisconot;


CREATE FUNCTION sis.f_pensum_por_filtro_seleccionar(refcursor, text, integer) RETURNS refcursor
    LANGUAGE plpgsql
    AS $_$

BEGIN

    IF $2 = '1'  THEN

	IF $3 < 1 THEN/* todos los pensum de de todos los instituto */
	  OPEN $1 FOR select *
		from sis.t_pensum  pen
		inner join sis.t_periodo per on pen.codigo = cod_pensum
		left join sis.t_instituto ins on per.cod_instituto = ins.codigo;

	  ELSE  /* todos los pensum de un instituto */
	  OPEN $1 FOR select *
		from sis.t_pensum  pen
		inner join sis.t_periodo per on pen.codigo = cod_pensum
		left join sis.t_instituto ins on per.cod_instituto = ins.codigo
		where ins.codigo = $3;

	END IF;

   END IF;

    IF $2 = '2'  THEN

	IF $3 < 1 THEN
	  OPEN $1 FOR select * /*todos los trayectos de de todos los pensum pensum */
		from sis.t_pensum  pen
		inner join sis.t_trayecto tra on pen.codigo = tra.cod_pensum;

	  ELSE
	  OPEN $1 FOR select * /*todos los trayectos de un pensum*/
		from sis.t_pensum  pen
		inner join sis.t_trayecto tra on pen.codigo = tra.cod_pensum
		where pen.codigo = $3;

	END IF;

   END IF;

  IF $2 = '3'  THEN

	IF $3 < 1 THEN
	  OPEN $1 FOR select *
		from sis.t_pensum  pen
		inner join  sis.t_uni_tra_pensum utp on pen.codigo = utp.cod_pensum
		inner join sis.t_uni_curricular unc on utp.cod_uni_curricular = unc.codigo;

	  ELSE
	  OPEN $1 FOR select *
		from sis.t_pensum  pen
		inner join  sis.t_uni_tra_pensum utp on pen.codigo = utp.cod_pensum
		inner join sis.t_uni_curricular unc on utp.cod_uni_curricular = unc.codigo
		where pen.codigo = $3;

	END IF;

   END IF;

 RETURN $1;

END;
$_$;


ALTER FUNCTION sis.f_pensum_por_filtro_seleccionar(refcursor, text, integer) OWNER TO sisconot;


CREATE FUNCTION sis.f_pensum_por_instituto_seleccionar(refcursor, integer) RETURNS refcursor
    LANGUAGE plpgsql
    AS $_$

BEGIN

	IF $2 < 1 THEN/* todos los pensum de de todos los instituto */
	  OPEN $1 FOR select  distinct(pen.codigo),
                        pen.nombre,
                        pen.nom_corto,
                        pen.observaciones,
                        pen.min_can_electiva,
                        pen.min_cre_electiva,
                        pen.min_cre_obligatoria,
                        pen.fec_creacion
		from sis.t_pensum  pen
		inner join sis.t_periodo per on pen.codigo = cod_pensum
		left join sis.t_instituto ins on per.cod_instituto = ins.codigo;

	  ELSE  /* todos los pensum de un instituto */
	  OPEN $1 FOR select distinct(pen.codigo),
                        pen.nombre,
                        pen.nom_corto,
                        pen.observaciones,
                        pen.min_can_electiva,
                        pen.min_cre_electiva,
                        pen.min_cre_obligatoria,
                        pen.fec_creacion
		from sis.t_pensum  pen
		inner join sis.t_periodo per on pen.codigo = cod_pensum
		left join sis.t_instituto ins on per.cod_instituto = ins.codigo
		where ins.codigo = $2;
	END IF;


 RETURN $1;

END;
$_$;


ALTER FUNCTION sis.f_pensum_por_instituto_seleccionar(refcursor, integer) OWNER TO sisconot;


CREATE FUNCTION sis.f_pensum_por_trayecto_seleccionar(refcursor, integer) RETURNS refcursor
    LANGUAGE plpgsql
    AS $_$

BEGIN
/*todos los trayectos de de todos los pensum pensum */
	IF $2 < 1 THEN
	  OPEN $1 FOR select  tra.codigo,
                        tra.cod_pensum,
                        tra.num_trayecto,
                        tra.certificado,
                        tra.min_cre_obligatoria,
                        tra.min_cre_electiva,
                        tra.min_cre_acreditable,
                        tra.min_can_electiva
		from sis.t_pensum  pen
		inner join sis.t_trayecto tra on pen.codigo = tra.cod_pensum
    order by tra.num_trayecto;

	  ELSE
    OPEN $1 FOR select  tra.codigo,
                          tra.num_trayecto,
                          tra.certificado
                          from  sis.t_trayecto tra
                          where tra.cod_pensum = $2
                          group by
                            tra.codigo,
                            tra.num_trayecto, tra.certificado
                          order by
                            tra.num_trayecto;

  END IF;
 RETURN $1;

END;
$_$;


ALTER FUNCTION sis.f_pensum_por_trayecto_seleccionar(refcursor, integer) OWNER TO sisconot;


CREATE FUNCTION sis.f_pensum_seleccionar(refcursor) RETURNS refcursor
    LANGUAGE plpgsql
    AS $_$

BEGIN

  OPEN $1 FOR SELECT codigo, nombre, nom_corto, observaciones, min_can_electiva, min_cre_electiva,
  min_cre_obligatoria, fec_creacion
  FROM sis.t_pensum;

 RETURN $1;

END;
$_$;


ALTER FUNCTION sis.f_pensum_seleccionar(refcursor) OWNER TO sisconot;


CREATE FUNCTION sis.f_prelacion_actualizar(integer, integer, integer, integer, integer) RETURNS integer
    LANGUAGE plpgsql
    AS $_$
DECLARE
	v_operacion integer := 0;
	v_codigo ALIAS for $1;
	v_cod_pensum ALIAS for $2;
	v_cod_instituto ALIAS for $3;
	v_cod_uni_curricular ALIAS for $4;
	v_cod_uni_cur_prelada ALIAS for $5;
BEGIN

UPDATE sis.t_prelacion
   SET cod_pensum = v_cod_pensum, cod_instituto = v_cod_instituto, cod_uni_curricular = v_cod_uni_curricular, cod_uni_cur_prelada = v_cod_uni_cur_prelada
 WHERE sis.t_prelacion.codigo = v_codigo;

   IF found THEN
	v_operacion :=1;
   END IF;

 RETURN v_operacion;

END;
$_$;


ALTER FUNCTION sis.f_prelacion_actualizar(integer, integer, integer, integer, integer) OWNER TO sisconot;


CREATE FUNCTION sis.f_prelacion_eliminar(integer) RETURNS integer
    LANGUAGE plpgsql
    AS $_$
DECLARE
  v_operacion integer := 0;
  v_codigo ALIAS for $1;
BEGIN

  DELETE FROM sis.t_prelacion
  WHERE t_prelacion.codigo = v_codigo;

  IF found THEN
  v_operacion :=1;
  END IF;

RETURN v_operacion;

END;
$_$;


ALTER FUNCTION sis.f_prelacion_eliminar(integer) OWNER TO sisconot;


CREATE FUNCTION sis.f_prelacion_insertar(integer, integer, integer, integer) RETURNS integer
    LANGUAGE plpgsql
    AS $_$
DECLARE
	codigoPrela integer := 0;
	v_cod_pensum ALIAS for $1;
	v_cod_instituto ALIAS for $2;
	v_cod_uni_curricular ALIAS for $3;
	v_cod_uni_cur_prelada ALIAS for $4;
BEGIN

  SELECT COALESCE (max(codigo),0) FROM sis.t_prelacion INTO codigoPrela;
  codigoPrela := codigoPrela + 1;

  INSERT INTO sis.t_prelacion(
            codigo, cod_pensum, cod_instituto, cod_uni_curricular, cod_uni_cur_prelada)
    VALUES (codigoPrela, v_cod_pensum, v_cod_instituto, v_cod_uni_curricular, v_cod_uni_cur_prelada);

  RETURN codigoPrela;

END;
$_$;


ALTER FUNCTION sis.f_prelacion_insertar(integer, integer, integer, integer) OWNER TO sisconot;


CREATE FUNCTION sis.f_prelacion_por_codigo_seleccionar(refcursor, integer) RETURNS refcursor
    LANGUAGE plpgsql
    AS $_$
BEGIN

  OPEN $1 FOR SELECT codigo, cod_pensum, cod_instituto, cod_uni_curricular, cod_uni_cur_prelada
  FROM sis.t_prelacion where codigo = $2;

 RETURN $1;

END;
$_$;


ALTER FUNCTION sis.f_prelacion_por_codigo_seleccionar(refcursor, integer) OWNER TO sisconot;


CREATE FUNCTION sis.f_trayecto_actualizar(integer, integer, integer, text, integer, integer, integer, integer) RETURNS integer
    LANGUAGE plpgsql
    AS $_$
DECLARE
	v_operacion integer := 0;
	v_codigo ALIAS for $1; 	v_cod_pensum ALIAS for $2;
	v_num_trayecto ALIAS for $3; v_certificado ALIAS for $4;
	v_min_cre_obligatoria ALIAS for $5; v_min_cre_electiva ALIAS for $6;
	v_min_cre_acreditable ALIAS for $7; v_min_can_electiva ALIAS for $8;
BEGIN

 UPDATE sis.t_trayecto
   SET cod_pensum = v_cod_pensum, num_trayecto = v_num_trayecto, certificado = v_certificado, min_cre_obligatoria = v_min_cre_obligatoria,
       min_cre_electiva = v_min_cre_electiva, min_cre_acreditable = v_min_cre_acreditable, min_can_electiva = v_min_can_electiva
 WHERE sis.t_trayecto.codigo = v_codigo;


   IF found THEN
	v_operacion :=1;
   END IF;

 RETURN v_operacion;

END;
$_$;


ALTER FUNCTION sis.f_trayecto_actualizar(integer, integer, integer, text, integer, integer, integer, integer) OWNER TO sisconot;


CREATE FUNCTION sis.f_trayecto_eliminar(integer) RETURNS integer
    LANGUAGE plpgsql
    AS $_$
DECLARE
  v_operacion integer := 0;
  v_codigo ALIAS for $1;
BEGIN

  DELETE FROM sis.t_trayecto
  WHERE t_trayecto.codigo = v_codigo;

  IF found THEN
  v_operacion :=1;
  END IF;

RETURN v_operacion;

END;
$_$;


ALTER FUNCTION sis.f_trayecto_eliminar(integer) OWNER TO sisconot;


CREATE FUNCTION sis.f_trayecto_insertar(integer, integer, text, integer, integer, integer, integer) RETURNS integer
    LANGUAGE plpgsql
    AS $_$
DECLARE
	codigoTrayecto integer := 0;
	v_cod_pensum ALIAS for $1;
	v_num_trayecto ALIAS for $2;
	v_certificado ALIAS for $3;
	v_min_cre_obligatoria ALIAS for $4;
	v_min_cre_electiva ALIAS for $5;
	v_min_cre_acreditable ALIAS for $6;
	v_min_can_electiva ALIAS for $7;
BEGIN

  SELECT COALESCE (max(codigo),0) FROM sis.t_trayecto INTO codigoTrayecto;
  codigoTrayecto := codigoTrayecto + 1;

  INSERT INTO sis.t_trayecto(codigo, cod_pensum, num_trayecto, certificado, min_cre_obligatoria, min_cre_electiva, min_cre_acreditable, min_can_electiva)
    VALUES (codigoTrayecto, v_cod_pensum, v_num_trayecto, v_certificado, v_min_cre_obligatoria, v_min_cre_electiva, v_min_cre_acreditable, v_min_can_electiva);

  RETURN codigoTrayecto;

END;
$_$;


ALTER FUNCTION sis.f_trayecto_insertar(integer, integer, text, integer, integer, integer, integer) OWNER TO sisconot;

CREATE FUNCTION sis.f_trayecto_por_codigo_seleccionar(refcursor, integer) RETURNS refcursor
    LANGUAGE plpgsql
    AS $_$
BEGIN

  OPEN $1 FOR SELECT codigo, cod_pensum, num_trayecto, certificado, min_cre_obligatoria,
       min_cre_electiva, min_cre_acreditable, min_can_electiva
  FROM sis.t_trayecto where codigo = $2;

 RETURN $1;

END;
$_$;


ALTER FUNCTION sis.f_trayecto_por_codigo_seleccionar(refcursor, integer) OWNER TO sisconot;


CREATE FUNCTION sis.f_trayecto_seleccionar(refcursor) RETURNS refcursor
    LANGUAGE plpgsql
    AS $_$

BEGIN

  OPEN $1 FOR SELECT codigo, cod_pensum, num_trayecto, certificado, min_cre_obligatoria,
       min_cre_electiva, min_cre_acreditable, min_can_electiva
  FROM sis.t_trayecto;


 RETURN $1;

END;
$_$;



ALTER FUNCTION sis.f_trayecto_seleccionar(refcursor) OWNER TO sisconot;



CREATE OR REPLACE FUNCTION sis.f_trayecto_por_patron_seleccionar(
    refcursor,
    integer,
    text)
  RETURNS refcursor AS
$BODY$
BEGIN

  OPEN $1 FOR select tra.codigo,
      tra.num_trayecto,
        tra.certificado
        from  sis.t_trayecto tra
      where tra.cod_pensum = $2 and
  upper(tra.certificado) like upper('%'||$3||'%');


 RETURN $1;

END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sis.f_trayecto_por_patron_seleccionar(refcursor, integer, text)
  OWNER TO sisconot;


CREATE OR REPLACE FUNCTION sis.f_uni_tra_pensu_actualizar(
    integer,
    integer,
    integer,
    integer,
    text)
  RETURNS integer AS
$BODY$
DECLARE
  v_operacion integer := 0;
  v_codigo ALIAS for $1;
  v_cod_pensum ALIAS for $2;
  v_cod_trayecto ALIAS for $3;
  v_cod_uni_curri ALIAS for $4;
  v_cod_tipo ALIAS for $5;
BEGIN

UPDATE sis.t_uni_tra_pensum
   SET cod_pensum = v_cod_pensum, cod_trayecto = v_cod_trayecto, cod_uni_curricular = v_cod_uni_curri, cod_tipo = v_cod_tipo
 WHERE sis.t_uni_tra_pensum.codigo = v_codigo;

   IF found THEN
  v_operacion :=1;
   END IF;

 RETURN v_operacion;

END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sis.f_uni_tra_pensu_actualizar(integer, integer, integer, integer, text)
  OWNER TO sisconot;


CREATE FUNCTION sis.f_uni_tra_pensu_actualizar(integer, text, text, integer, integer, integer, integer, integer, integer, text, text, text) RETURNS integer
    LANGUAGE plpgsql
    AS $_$
DECLARE
	v_operacion integer := 0;
	v_codigo ALIAS for $1;
	v_cod_pensum ALIAS for $1;
	v_cod_trayecto ALIAS for $2;
	v_cod_uni_curri ALIAS for $3;
	v_cod_tipo ALIAS for $4;

BEGIN

UPDATE sis.t_uni_tra_pensum
   SET cod_pensum = v_cod_pensum, cod_trayecto = v_cod_trayecto, cod_uni_curricular = v_cod_uni_curri, cod_tipo = v_cod_tipo

 WHERE sis.t_uni_tra_pensum.codigo = v_codigo;

   IF found THEN
	v_operacion :=1;
   END IF;

 RETURN v_operacion;

END;
$_$;


ALTER FUNCTION sis.f_uni_tra_pensu_actualizar(integer, text, text, integer, integer, integer, integer, integer, integer, text, text, text) OWNER TO sisconot;


CREATE FUNCTION sis.f_uni_tra_pensu_eliminar(integer) RETURNS integer
    LANGUAGE plpgsql
    AS $_$
DECLARE
  v_operacion integer := 0;
  v_codigo ALIAS for $1;
BEGIN

  DELETE FROM sis.t_uni_tra_pensum
  WHERE t_uni_tra_pensum.codigo = v_codigo;

  IF found THEN
  v_operacion :=1;
  END IF;

RETURN v_operacion;

END;
$_$;


ALTER FUNCTION sis.f_uni_tra_pensu_eliminar(integer) OWNER TO sisconot;


CREATE OR REPLACE FUNCTION sis.f_uni_tra_pensu_insertar(
    integer,
    integer,
    integer,
    text)
  RETURNS integer AS
$BODY$
DECLARE
  codigoUniTraPen integer := 0;
  v_cod_pensum ALIAS for $1;
  v_trayecto ALIAS for $2;
  v_cod_uni_curri ALIAS for $3;
  v_cod_tipo ALIAS for $4;
BEGIN

  SELECT COALESCE (max(codigo),0) FROM sis.t_uni_tra_pensum INTO codigoUniTraPen;
  codigoUniTraPen := codigoUniTraPen + 1;

  INSERT INTO sis.t_uni_tra_pensum(codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (codigoUniTraPen, v_cod_pensum, v_trayecto, v_cod_uni_curri, v_cod_tipo);

  RETURN codigoUniTraPen;

END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sis.f_uni_tra_pensu_insertar(integer, integer, integer, text)
  OWNER TO sisconot;





CREATE OR REPLACE FUNCTION sis.f_uni_tra_pensu_por_codigo_seleccionar(
    refcursor,
    integer)
  RETURNS refcursor AS
$BODY$
BEGIN

  OPEN $1 FOR SELECT utp.codigo, utp.cod_pensum, utp.cod_trayecto, utp.cod_uni_curricular, utp.cod_tipo,
  uni.descripcion
  FROM sis.t_uni_tra_pensum as utp
  left join sis.t_uni_curricular uni on utp.cod_uni_curricular = uni.codigo
  where utp.codigo = $2;

 RETURN $1;

END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sis.f_uni_tra_pensu_por_codigo_seleccionar(refcursor, integer)
  OWNER TO sisconot;



CREATE FUNCTION sis.f_unicurricular_actualizar(integer, text, text, integer, integer, integer, integer, integer, integer, text, text, text) RETURNS integer
    LANGUAGE plpgsql
    AS $_$
DECLARE
	v_operacion integer := 0;
	v_codigo ALIAS for $1;
	v_cod_uni_ministerio ALIAS for $2;
	v_nombre ALIAS for $3;
	v_hta ALIAS for $4;
	v_hti ALIAS for $5;
	v_uni_credito ALIAS for $6;
	v_dur_semanas ALIAS for $7;
	v_not_min_aprobatoria ALIAS for $8;
	v_not_maxima ALIAS for $9;
	v_descripcion ALIAS for $10;
	v_observacion ALIAS for $11;
	v_contenido ALIAS for $12;

BEGIN


UPDATE sis.t_uni_curricular
   SET codigo = v_codigo, cod_uni_ministerio = v_cod_uni_ministerio, nombre = v_nombre,  hta = v_hta, hti = v_hti, uni_credito = v_uni_credito,
       dur_semanas = v_dur_semanas, not_min_aprobatoria = v_not_min_aprobatoria, not_maxima = v_not_maxima, descripcion = v_descripcion, observacion = v_observacion, contenido = v_contenido
 WHERE sis.t_uni_curricular.codigo = v_codigo;

   IF found THEN
	v_operacion :=1;
   END IF;

 RETURN v_operacion;

END;
$_$;


ALTER FUNCTION sis.f_unicurricular_actualizar(integer, text, text, integer, integer, integer, integer, integer, integer, text, text, text) OWNER TO sisconot;

CREATE FUNCTION sis.f_unicurricular_eliminar(integer) RETURNS integer
    LANGUAGE plpgsql
    AS $_$
DECLARE
  v_operacion integer := 0;
  v_codigo ALIAS for $1;
BEGIN

  DELETE FROM sis.t_uni_curricular
  WHERE t_uni_curricular.codigo = v_codigo;

  IF found THEN
  v_operacion :=1;
  END IF;

RETURN v_operacion;

END;
$_$;


ALTER FUNCTION sis.f_unicurricular_eliminar(integer) OWNER TO sisconot;


CREATE FUNCTION sis.f_unicurricular_insertar(text, text, integer, integer, integer, integer, integer, integer, text, text, text) RETURNS integer
    LANGUAGE plpgsql
    AS $_$
DECLARE
	codigoUniCurricular integer := 0;
	v_cod_uni_ministerio ALIAS for $1;
	v_nombre ALIAS for $2;
	v_hta ALIAS for $3;
	v_hti ALIAS for $4;
	v_uni_credito ALIAS for $5;
	v_dur_semanas ALIAS for $6;
	v_not_min_aprobatoria ALIAS for $7;
	v_not_maxima ALIAS for $8;
	v_descripcion ALIAS for $9;
	v_observacion ALIAS for $10;
	v_contenido ALIAS for $11;

BEGIN

  SELECT COALESCE (max(codigo),0) FROM sis.t_uni_curricular INTO codigoUniCurricular;
  codigoUniCurricular := codigoUniCurricular + 1;

  INSERT INTO sis.t_uni_curricular(codigo, cod_uni_ministerio, nombre, hta, hti, uni_credito, dur_semanas, not_min_aprobatoria, not_maxima, descripcion, observacion, contenido)
            VALUES (codigoUniCurricular, v_cod_uni_ministerio, v_nombre, v_hta, v_hti, v_uni_credito, v_dur_semanas, v_not_min_aprobatoria, v_not_maxima, v_descripcion, v_observacion, v_contenido);

  RETURN codigoUniCurricular;

END;
$_$;


ALTER FUNCTION sis.f_unicurricular_insertar(text, text, integer, integer, integer, integer, integer, integer, text, text, text) OWNER TO sisconot;

CREATE FUNCTION sis.f_unicurricular_por_codigo_seleccionar(refcursor, integer) RETURNS refcursor
    LANGUAGE plpgsql
    AS $_$
BEGIN

  OPEN $1 FOR SELECT codigo, cod_uni_ministerio, nombre, hta, hti, uni_credito, dur_semanas,
       not_min_aprobatoria, not_maxima, descripcion, observacion, contenido
  FROM sis.t_uni_curricular where codigo = $2;

 RETURN $1;

END;
$_$;


ALTER FUNCTION sis.f_unicurricular_por_codigo_seleccionar(refcursor, integer) OWNER TO sisconot;

CREATE OR REPLACE FUNCTION sis.f_unicurricular_por_patron_seleccionar(
    refcursor,
    text,
    text)
  RETURNS refcursor AS
$BODY$
BEGIN
  -- buscar por 

  if ($3 = '0') then
  OPEN $1 FOR SELECT codigo, cod_uni_ministerio, nombre, descripcion
  FROM sis.t_uni_curricular where
     sis.utf(cod_uni_ministerio) ilike sis.utf('%'||$2||'%') or 
     sis.utf(nombre) ilike sis.utf('%'||$2||'%') or
     sis.utf(descripcion) ilike sis.utf('%'||$2||'%')
     ;
  end if;
  
  if ($3 = '1') then
  OPEN $1 FOR SELECT codigo, cod_uni_ministerio, nombre, descripcion
  FROM sis.t_uni_curricular where
    upper(sis.utf(cod_uni_ministerio)) ilike upper(sis.utf('%'||$2||'%'));
  end if;

   if ($3 = '2') then
   OPEN $1 FOR SELECT codigo, cod_uni_ministerio, nombre, descripcion
    FROM sis.t_uni_curricular where upper(sis.utf(nombre)) ilike upper(sis.utf('%'||$2||'%'));
   end if;  

     if ($3 = '3') then
   OPEN $1 FOR SELECT codigo, cod_uni_ministerio, nombre, descripcion
    FROM sis.t_uni_curricular where upper(sis.utf(descripcion)) ilike upper(sis.utf('%'||$2||'%'));
   end if;  
    
  
 RETURN $1;

END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sis.f_unicurricular_por_patron_seleccionar(refcursor, text, text)
  OWNER TO sisconot;

CREATE OR REPLACE FUNCTION sis.f_unicurricular_por_pen_usado(
    refcursor,
    integer)
  RETURNS refcursor AS
$BODY$
BEGIN

  OPEN $1 FOR select distinct (p.nom_corto) as nomcorto from sis.t_uni_tra_pensum v left join sis.t_pensum p on v.cod_pensum = p.codigo
  where cod_uni_curricular = $2 GROUP BY  p.nom_corto;
  
 RETURN $1;

END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sis.f_unicurricular_por_pen_usado(refcursor, integer)
  OWNER TO sisconot;




CREATE FUNCTION sis.f_unicurricular_por_pen_y_tray_seleccionar(refcursor, integer, integer) RETURNS refcursor
    LANGUAGE plpgsql
    AS $_$

BEGIN

	  OPEN $1 FOR select *
		from sis.t_pensum  pen
		inner join  sis.t_uni_tra_pensum utp on pen.codigo = utp.cod_pensum
		inner join sis.t_uni_curricular unc on utp.cod_uni_curricular = unc.codigo
		where utp.cod_pensum = $2 and utp.cod_trayecto = $3 ;

 RETURN $1;

END;
$_$;


ALTER FUNCTION sis.f_unicurricular_por_pen_y_tray_seleccionar(refcursor, integer, integer) OWNER TO sisconot;


CREATE FUNCTION sis.f_unicurricular_por_pensum_seleccionar(refcursor, integer) RETURNS refcursor
    LANGUAGE plpgsql
    AS $_$

BEGIN

	IF $2 < 1 THEN
	  OPEN $1 FOR select *
		from sis.t_pensum  pen
		inner join  sis.t_uni_tra_pensum utp on pen.codigo = utp.cod_pensum
		inner join sis.t_uni_curricular unc on utp.cod_uni_curricular = unc.codigo;

	  ELSE
	  OPEN $1 FOR select *
		from sis.t_pensum  pen
		inner join  sis.t_uni_tra_pensum utp on pen.codigo = utp.cod_pensum
		inner join sis.t_uni_curricular unc on utp.cod_uni_curricular = unc.codigo
		where pen.codigo = $2;

	END IF;

 RETURN $1;

END;
$_$;


ALTER FUNCTION sis.f_unicurricular_por_pensum_seleccionar(refcursor, integer) OWNER TO sisconot;



CREATE OR REPLACE FUNCTION sis.f_unicurricular_seleccionar(refcursor)
  RETURNS refcursor AS
$BODY$

BEGIN

  OPEN $1 FOR SELECT codigo, cod_uni_ministerio, nombre, hta, hti, uni_credito, dur_semanas,
       not_min_aprobatoria, not_maxima, descripcion, observacion, contenido
  FROM sis.t_uni_curricular ORDER BY codigo ASC;



 RETURN $1;

END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sis.f_unicurricular_seleccionar(refcursor)
  OWNER TO sisconot;



CREATE OR REPLACE FUNCTION sis.f_curso_ins(
						 p_cod_periodo integer,
						 p_cod_uni_curricular integer,
						 p_cod_docente integer,
						 p_seccion TEXT,
						 p_fec_inicio date,
						 p_fec_final date,
						 p_capacidad integer,
						 p_observaciones TEXT)
  RETURNS INTEGER AS
$BODY$
DECLARE cod_curso integer := 0;
BEGIN
	select nextval('sis.s_curso') into cod_curso;

	INSERT INTO sis.t_curso (	codigo,
								cod_periodo,
								cod_uni_curricular,
								cod_docente,
								seccion,
								fec_inicio,
								fec_final,
								capacidad,
								observaciones)
	 VALUES ( 					cod_curso,
								p_cod_periodo,
								p_cod_uni_curricular,
								p_cod_docente,
								p_seccion,
								p_fec_inicio,
								p_fec_final,
								p_capacidad,
								p_observaciones);

  RETURN cod_curso;
END;
$BODY$
language plpgsql volatile
			COST 100;
ALTER FUNCTION sis.f_curso_ins(integer, integer, integer, text, DATE, DATE, integer, text)
  OWNER TO sisconot;


CREATE OR REPLACE FUNCTION sis.f_curso_mod(
						 p_codigo integer,
						 p_cod_periodo integer,
						 p_cod_uni_curricular integer,
						 p_cod_docente integer,
						 p_seccion TEXT,
						 p_fec_inicio DATE,
						 p_fec_final DATE,
						 p_capacidad integer,
						 p_observaciones TEXT)
  RETURNS INTEGER AS
$BODY$
DECLARE r_operacion integer := 0;
BEGIN
	UPDATE sis.t_curso
		SET
			cod_periodo = p_cod_periodo,
			cod_uni_curricular = p_cod_uni_curricular,
			cod_docente = p_cod_docente,
			seccion = p_seccion,
			fec_inicio = p_fec_inicio,
			fec_final = p_fec_final,
			capacidad = p_capacidad,
			observaciones = p_observaciones
		WHERE
			codigo = p_codigo;

		IF found THEN
			r_operacion := 1;
		END IF;

  RETURN r_operacion;
END;
$BODY$
language 	plpgsql volatile
			COST 100;
ALTER FUNCTION sis.f_curso_mod(integer, integer, integer, integer, text, DATE, DATE, integer, text)
  OWNER TO sisconot;


CREATE OR REPLACE FUNCTION sis.f_curso_del(p_codigo integer)
RETURNS INTEGER AS
$BODY$
	DECLARE r_operacion integer := 0;
BEGIN

	DELETE FROM sis.t_curso WHERE codigo = p_codigo;

	IF found THEN
		r_operacion := 1;
	END IF;

	RETURN r_operacion;
END;
$BODY$
LANGUAGE plpgsql
	COST 100;
ALTER FUNCTION sis.f_curso_del(integer)
  OWNER TO sisconot;


CREATE OR REPLACE FUNCTION sis.f_curso_sel(p_cursor refcursor)
RETURNS refcursor AS
$BODY$
BEGIN
	OPEN p_cursor FOR
		SELECT 	codigo,
				cod_periodo,
				cod_uni_curricular,
				cod_docente,
				seccion,
				fec_inicio,
				fec_final,
				capacidad,
				observaciones
		FROM sis.t_curso;


	RETURN p_cursor;
END;
$BODY$
LANGUAGE plpgsql VOLATILE
	COST 100;
ALTER FUNCTION sis.f_curso_sel(refcursor)
  OWNER TO sisconot;

CREATE OR REPLACE FUNCTION sis.f_periodo_pensum_sel(p_cursor refcursor, p_codigo integer)
RETURNS refcursor AS
$BODY$
BEGIN
    OPEN p_cursor FOR
    select 	per.codigo,
            per.nombre
            from sis.t_periodo per
            where per.cod_pensum = p_codigo;
    RETURN p_cursor;
    END;
    $BODY$
    LANGUAGE plpgsql VOLATILE
    COST 100;

ALTER FUNCTION sis.f_periodo_pensum_sel(refcursor, integer)
    OWNER TO sisconot;


CREATE OR REPLACE FUNCTION sis.f_curso_sel_por_codigo(p_cursor refcursor, p_codigo integer)
RETURNS refcursor AS
$BODY$
BEGIN
	OPEN p_cursor FOR
		SELECT 	codigo,
				cod_periodo,
				cod_uni_curricular,
				cod_docente,
				seccion,
				fec_inicio,
				fec_final,
				capacidad,
				observaciones
		FROM sis.t_curso
		WHERE codigo = p_codigo;
	RETURN p_cursor;
END;
$BODY$
LANGUAGE plpgsql VOLATILE
	COST 100;
ALTER FUNCTION sis.f_curso_sel_por_codigo(refcursor, integer)
  OWNER TO sisconot;



CREATE OR REPLACE FUNCTION sis.f_cur_estudiante_ins(
						p_cod_estudiante integer,
						p_cod_curso integer,
						p_por_asistencia float,
						p_nota float,
						p_cod_estado text,
						p_observaciones text)
  RETURNS INTEGER AS
$BODY$
DECLARE cod_cur_est integer := 0;
BEGIN
	select nextval('sis.s_cur_estudiante') into cod_cur_est;

	INSERT INTO sis.t_cur_estudiante (	codigo,
										cod_estudiante,
										cod_curso,
										por_asistencia,
										nota,
										cod_estado,
										observaciones)
	 VALUES ( 					cod_cur_est,
								p_cod_estudiante,
								p_cod_curso,
								p_por_asistencia,
								p_nota,
								p_cod_estado,
								p_observaciones);

  RETURN cod_cur_est;
END;
$BODY$
language plpgsql volatile
			COST 100;
ALTER FUNCTION sis.f_cur_estudiante_ins(integer, integer, float, float, text, text)
  OWNER TO sisconot;




CREATE OR REPLACE FUNCTION sis.f_cur_estudiante_mod(
						 p_codigo integer,
						 p_cod_estudiante integer,
						 p_cod_curso integer,
						 p_por_asistencia float,
						 p_nota float,
						 p_cod_estado text,
						 p_observaciones TEXT)
  RETURNS INTEGER AS
$BODY$
DECLARE r_operacion integer := 0;
BEGIN
	UPDATE sis.t_cur_estudiante
		SET
			cod_estudiante = p_cod_estudiante,
			cod_curso = p_cod_curso,
			por_asistencia = p_por_asistencia,
			nota = p_nota,
			cod_estado = p_cod_estado,
			observaciones = p_observaciones
		WHERE
			codigo = p_codigo;

		IF found THEN
			r_operacion := 1;
		END IF;

  RETURN r_operacion;
END;
$BODY$
language 	plpgsql volatile
			COST 100;
ALTER FUNCTION sis.f_cur_estudiante_mod(integer, integer, integer, float, float, text, text)
  OWNER TO sisconot;



CREATE OR REPLACE FUNCTION sis.f_cur_estudiante_del(p_codigo integer)
RETURNS INTEGER AS
$BODY$
	DECLARE r_operacion integer := 0;
BEGIN

	DELETE FROM sis.t_cur_estudiante WHERE codigo = p_codigo;

	IF found THEN
		r_operacion := 1;
	END IF;

	RETURN r_operacion;
END;
$BODY$
LANGUAGE plpgsql
	COST 100;
ALTER FUNCTION sis.f_cur_estudiante_del(integer)
  OWNER TO sisconot;


CREATE OR REPLACE FUNCTION sis.f_cur_estudiante_sel(p_cursor refcursor)
RETURNS refcursor AS
$BODY$
BEGIN
	OPEN p_cursor FOR
		SELECT 	codigo,
				cod_estudiante,
				cod_curso,
				cod_estado,
				nota,
				por_asistencia,
				observaciones
		FROM sis.t_cur_estudiante;


	RETURN p_cursor;
END;
$BODY$
LANGUAGE plpgsql VOLATILE
	COST 100;
ALTER FUNCTION sis.f_curso_sel(refcursor)
  OWNER TO sisconot;


CREATE OR REPLACE FUNCTION sis.f_cur_estudiante_sel_por_codigo(p_cursor refcursor, p_codigo integer)
RETURNS refcursor AS
$BODY$
BEGIN
	OPEN p_cursor FOR
		SELECT 	codigo,
				cod_estudiante,
				cod_curso,
				cod_estado,
				nota,
				por_asistencia,
				observaciones
		FROM sis.t_cur_estudiante
		WHERE codigo = p_codigo;
	RETURN p_cursor;
END;
$BODY$
LANGUAGE plpgsql VOLATILE
	COST 100;
ALTER FUNCTION sis.f_cur_estudiante_sel_por_codigo(refcursor, integer)
  OWNER TO sisconot;



CREATE OR REPLACE FUNCTION sis.f_periodo_ins(
						p_nombre text,
						p_cod_instituto integer,
						p_cod_pensum integer,
						p_fec_inicio date,
						p_fec_final date,
						p_observaciones text,
						p_cod_estado text)
  RETURNS INTEGER AS
$BODY$
DECLARE cod_periodo integer := 0;
BEGIN
	select coalesce(max(codigo)+1,0) from sis.t_periodo into cod_periodo;

	INSERT INTO sis.t_periodo(	codigo,
								nombre,
								cod_instituto,
								cod_pensum,
								fec_inicio,
								fec_final,
								observaciones,
								cod_estado)
	VALUES					 (	cod_periodo,
								p_nombre,
								p_cod_instituto,
								p_cod_pensum,
								p_fec_inicio,
								p_fec_final,
								p_observaciones,
								p_cod_estado);

  RETURN cod_periodo;
END;
$BODY$
language plpgsql volatile
			COST 100;
ALTER FUNCTION sis.f_periodo_ins(text,integer,integer,date,date,text,text)
  OWNER TO sisconot;



CREATE OR REPLACE FUNCTION sis.f_periodo_mod(
									p_codigo integer,
									p_nombre text,
									p_cod_instituto integer,
									p_cod_pensum integer,
									p_fec_inicio date,
									p_fec_final date,
									p_observaciones text,
									p_cod_estado text)
  RETURNS INTEGER AS
$BODY$
DECLARE r_operacion integer := 0;
BEGIN
	UPDATE sis.t_periodo
		SET
			nombre = p_nombre,
			cod_instituto = p_cod_instituto,
			cod_pensum = p_cod_pensum,
			fec_inicio = p_fec_inicio,
			fec_final = p_fec_final,
			observaciones = p_observaciones,
			cod_estado = p_cod_estado
		WHERE
			codigo = p_codigo;

		IF found THEN
			r_operacion := 1;
		END IF;

  RETURN r_operacion;
END;
$BODY$
language 	plpgsql volatile
			COST 100;
ALTER FUNCTION sis.f_periodo_mod(integer,text,integer,integer,date,date,text,text)
  OWNER TO sisconot;



CREATE OR REPLACE FUNCTION sis.f_periodo_del(p_codigo integer)
RETURNS INTEGER AS
$BODY$
	DECLARE r_operacion integer := 0;
BEGIN

	DELETE FROM sis.t_periodo WHERE codigo = p_codigo;

	IF found THEN
		r_operacion := 1;
	END IF;

	RETURN r_operacion;
END;
$BODY$
LANGUAGE plpgsql
	COST 100;
ALTER FUNCTION sis.f_periodo_del(integer)
  OWNER TO sisconot;


CREATE OR REPLACE FUNCTION sis.f_periodo_sel(p_cursor refcursor)
RETURNS refcursor AS
$BODY$
BEGIN
	OPEN p_cursor FOR
		SELECT 	codigo,
				nombre,
				cod_instituto,
				cod_pensum,
				fec_inicio,
				fec_final,
				cod_estado,
				observaciones
		FROM sis.t_periodo;


	RETURN p_cursor;
END;
$BODY$
LANGUAGE plpgsql VOLATILE
	COST 100;
ALTER FUNCTION sis.f_periodo_sel(refcursor)
  OWNER TO sisconot;


CREATE OR REPLACE FUNCTION sis.f_periodo_sel_por_codigo(p_cursor refcursor, p_codigo integer)
RETURNS refcursor AS
$BODY$
BEGIN
	OPEN p_cursor FOR
		SELECT 	codigo,
				nombre,
				cod_instituto,
				cod_pensum,
				fec_inicio,
				fec_final,
				cod_estado,
				observaciones
		FROM sis.t_periodo
		WHERE codigo = p_codigo;
	RETURN p_cursor;
END;
$BODY$
LANGUAGE plpgsql VOLATILE
	COST 100;
ALTER FUNCTION sis.f_periodo_sel_por_codigo(refcursor, integer)
  OWNER TO sisconot;



CREATE FUNCTION sis.f_empleado_act(p_codigo integer, p_cod_persona integer, p_cod_instituto integer, p_cod_pensum integer, p_cod_estado text, p_fec_inicio date, p_fec_fin date, p_es_jef_pensum boolean, p_es_jef_con_estudio boolean, p_es_ministerio boolean, p_es_docente boolean, p_observaciones text) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE r_operacion integer := 0;
BEGIN
	UPDATE sis.t_empleado SET cod_instituto=p_cod_instituto,	  cod_pensum=p_cod_pensum,
				  cod_estado=p_cod_estado,		  fec_inicio=p_fec_inicio,
				  fec_fin=p_fec_fin,			  es_jef_pensum=p_es_jef_pensum,
				  es_jef_con_estudio=p_es_jef_con_estudio,es_ministerio=p_es_ministerio,
				  es_docente=p_es_docente,		  observaciones=p_observaciones
			      WHERE codigo=p_codigo;
     IF found THEN
	r_operacion := 1;
     END IF;

  RETURN r_operacion;
END;
$$;


ALTER FUNCTION sis.f_empleado_act(p_codigo integer, p_cod_persona integer, p_cod_instituto integer, p_cod_pensum integer, p_cod_estado text, p_fec_inicio date, p_fec_fin date, p_es_jef_pensum boolean, p_es_jef_con_estudio boolean, p_es_ministerio boolean, p_es_docente boolean, p_observaciones text) OWNER TO sisconot;


CREATE FUNCTION sis.f_empleado_eli(p_codigo integer) RETURNS integer
    LANGUAGE plpgsql
    AS $$
	DECLARE r_operacion integer := 0;
BEGIN

	DELETE FROM sis.t_empleado WHERE codigo = p_codigo;

	IF found THEN
		r_operacion := 1;
	END IF;

	RETURN r_operacion;
END;
$$;


ALTER FUNCTION sis.f_empleado_eli(p_codigo integer) OWNER TO sisconot;

CREATE FUNCTION sis.f_empleado_ins(p_cod_persona integer, p_cod_instituto integer, p_cod_pensum integer, p_cod_estado text, p_fec_inicio date, p_fec_fin date, p_es_jef_pensum boolean, p_es_jef_con_estudio boolean, p_es_ministerio boolean, p_es_docente boolean, p_observaciones text) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE cod_empleado integer := 0;
BEGIN
	select coalesce(max(codigo),0) from sis.t_empleado into cod_empleado;

	cod_empleado:=cod_empleado+1;

	INSERT INTO sis.t_empleado (codigo,		cod_persona,		cod_instituto,
				    cod_pensum,		cod_estado,	        fec_inicio,
				    fec_fin,		es_jef_pensum,		es_jef_con_estudio,
				    es_ministerio,	es_docente,		observaciones
				 )
			    VALUES (cod_empleado,	p_cod_persona,		p_cod_instituto,
				    p_cod_pensum,	p_cod_estado,		p_fec_inicio,
				    p_fec_fin,		p_es_jef_pensum,	p_es_jef_con_estudio,
				    p_es_ministerio,	p_es_docente,		p_observaciones
				  );

  RETURN cod_empleado;
END;
$$;


ALTER FUNCTION sis.f_empleado_ins(p_cod_persona integer, p_cod_instituto integer, p_cod_pensum integer, p_cod_estado text, p_fec_inicio date, p_fec_fin date, p_es_jef_pensum boolean, p_es_jef_con_estudio boolean, p_es_ministerio boolean, p_es_docente boolean, p_observaciones text) OWNER TO sisconot;

CREATE FUNCTION sis.f_empleado_sel(p_cursor refcursor) RETURNS refcursor
    LANGUAGE plpgsql
    AS $$
BEGIN
	OPEN p_cursor FOR
		SELECT * FROM sis.t_empleado;

 RETURN p_cursor;
END;
$$;


ALTER FUNCTION sis.f_empleado_sel(p_cursor refcursor) OWNER TO sisconot;


CREATE FUNCTION sis.f_empleado_sel_cod(p_cursor refcursor, p_codigo integer) RETURNS refcursor
    LANGUAGE plpgsql
    AS $$
BEGIN
	OPEN p_cursor FOR
		SELECT * FROM sis.t_empleado;

 RETURN p_cursor;
END;
$$;


ALTER FUNCTION sis.f_empleado_sel_cod(p_cursor refcursor, p_codigo integer) OWNER TO sisconot;


CREATE FUNCTION sis.f_estudiante_act(p_codigo integer, p_cod_persona integer, p_cod_instituto integer, p_cod_pensum integer, p_num_carnet text, p_num_expediente text, p_cod_rusnies text, p_cod_estado text, p_fec_inicio date, p_fec_fin date, p_condicion text, p_observaciones text) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE r_operacion integer := 0;
BEGIN

	UPDATE sis.t_estudiante SET cod_instituto=p_cod_instituto, 	cod_pensum=p_cod_pensum,
				    num_carnet=p_num_carnet,		num_expediente=p_num_expediente,
				    cod_rusnies=p_cod_rusnies,	    	cod_estado=p_cod_estado,
				    fec_inicio=p_fec_inicio, 		condicion= p_condicion,
				    fec_fin=p_fec_fin, 			observaciones=p_observaciones
			     WHERE codigo=p_codigo;
	IF found THEN
		r_operacion := 1;
	END IF;

  RETURN r_operacion;
END;
$$;


ALTER FUNCTION sis.f_estudiante_act(p_codigo integer, p_cod_persona integer, p_cod_instituto integer, p_cod_pensum integer, p_num_carnet text, p_num_expediente text, p_cod_rusnies text, p_cod_estado text, p_fec_inicio date, p_fec_fin date, p_condicion text, p_observaciones text) OWNER TO sisconot;


CREATE FUNCTION sis.f_estudiante_eli(p_codigo integer) RETURNS integer
    LANGUAGE plpgsql
    AS $$
	DECLARE r_operacion integer := 0;
BEGIN

	DELETE FROM sis.t_estudiante WHERE codigo = p_codigo;

	IF found THEN
		r_operacion := 1;
	END IF;

	RETURN r_operacion;
END;
$$;


ALTER FUNCTION sis.f_estudiante_eli(p_codigo integer) OWNER TO sisconot;


CREATE FUNCTION sis.f_estudiante_ins(p_cod_persona integer, p_cod_instituto integer, p_cod_pensum integer, p_num_carnet text, p_num_expediente text, p_cod_rusnies text, p_cod_estado text, p_fec_inicio date, p_fec_fin date, p_condicion text, p_observaciones text) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE cod_estudiante integer := 0;
BEGIN
	select coalesce(max(codigo),0) from sis.t_estudiante into cod_estudiante;

	cod_estudiante := cod_estudiante + 1;

	insert into sis.t_estudiante (	codigo, 		cod_persona, 		cod_instituto,
					cod_pensum, 		num_carnet, 		num_expediente,
					cod_rusnies, 		cod_estado,		fec_inicio,
					fec_fin, 		condicion,		observaciones
				     )
			     values (	cod_estudiante, 	p_cod_persona, 		p_cod_instituto,
					p_cod_pensum, 		p_num_carnet,		p_num_expediente,
					p_cod_rusnies, 		p_cod_estado, 		p_fec_inicio,
					p_fec_fin, 		p_condicion, 		p_observaciones
				    );



  RETURN cod_estudiante;
END;
$$;


ALTER FUNCTION sis.f_estudiante_ins(p_cod_persona integer, p_cod_instituto integer, p_cod_pensum integer, p_num_carnet text, p_num_expediente text, p_cod_rusnies text, p_cod_estado text, p_fec_inicio date, p_fec_fin date, p_condicion text, p_observaciones text) OWNER TO sisconot;

CREATE FUNCTION sis.f_estudiante_sel(p_cursor refcursor) RETURNS refcursor
    LANGUAGE plpgsql
    AS $$
BEGIN
	OPEN p_cursor FOR
	select * from sis.t_estudiante;

	RETURN p_cursor;

END;
$$;


ALTER FUNCTION sis.f_estudiante_sel(p_cursor refcursor) OWNER TO sisconot;

CREATE FUNCTION sis.f_persona_act(p_codigo integer, p_cedula integer, p_rif text, p_nombre1 text, p_nombre2 text, p_apellido1 text, p_apellido2 text, p_sexo text, p_fec_nacimiento date, p_tip_sangre text, p_telefono1 text, p_telefono2 text, p_cor_personal text, p_cor_institucional text, p_direccion text, p_discapacidad text, p_nacionalidad text, p_hijos integer, p_est_civil text, p_observaciones text) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE r_operacion integer := 0;
BEGIN

	UPDATE sis.t_persona SET cedula=p_cedula,			rif=p_rif,
				 nombre1=p_nombre1,			nombre2=p_nombre2,
				 apellido1=p_apellido1,			apellido2=p_apellido2,
				 sexo=p_sexo,				fec_nacimiento=p_fec_nacimiento,
				 tip_sangre=p_tip_sangre,		telefono1=p_telefono1,
				 telefono2=p_telefono2,			cor_personal=p_cor_personal,
				 cor_institucional=p_cor_institucional,	direccion=p_direccion,
				 discapacidad=p_discapacidad,		nacionalidad=p_nacionalidad,
				 hijos=p_hijos,				est_civil=p_est_civil,
				 observaciones=p_observaciones
			     WHERE codigo=p_codigo;

        update sis.t_persona set nombre1 = upper(nombre1), nombre2 = upper(nombre2), apellido1 = upper(apellido1), apellido2 = upper(apellido2);

	IF found THEN
		r_operacion := 1;
	END IF;

  RETURN r_operacion;
END;
$$;


ALTER FUNCTION sis.f_persona_act(p_codigo integer, p_cedula integer, p_rif text, p_nombre1 text, p_nombre2 text, p_apellido1 text, p_apellido2 text, p_sexo text, p_fec_nacimiento date, p_tip_sangre text, p_telefono1 text, p_telefono2 text, p_cor_personal text, p_cor_institucional text, p_direccion text, p_discapacidad text, p_nacionalidad text, p_hijos integer, p_est_civil text, p_observaciones text) OWNER TO sisconot;

CREATE FUNCTION sis.f_persona_eli(p_codigo integer) RETURNS integer
    LANGUAGE plpgsql
    AS $$
	DECLARE r_operacion integer := 0;
BEGIN

	DELETE FROM sis.t_persona WHERE codigo = p_codigo;

	IF found THEN
		r_operacion := 1;
	END IF;

	RETURN r_operacion;
END;
$$;


ALTER FUNCTION sis.f_persona_eli(p_codigo integer) OWNER TO sisconot;

CREATE FUNCTION sis.f_persona_ins(p_cedula integer, p_rif text, p_nombre1 text, p_nombre2 text, p_apellido1 text, p_apellido2 text, p_sexo text, p_fec_nacimiento date, p_tip_sangre text, p_telefono1 text, p_telefono2 text, p_cor_personal text, p_cor_institucional text, p_direccion text, p_discapacidad text, p_nacionalidad text, p_hijos integer, p_est_civil text, p_observaciones text) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE cod_persona integer := 0;
BEGIN
	select coalesce(max(codigo),0) from sis.t_persona into cod_persona;

	cod_persona := cod_persona + 1;

	insert into sis.t_persona (codigo,		cedula,			rif,
				   nombre1,		nombre2,		apellido1,
				   apellido2,   	sexo,			fec_nacimiento,
				   tip_sangre,		telefono1,		telefono2,
				   cor_personal,	cor_institucional,	direccion,
				   discapacidad,	nacionalidad,		hijos,
				   est_civil,		observaciones
				)

		          values (cod_persona,		p_cedula,		p_rif,
				  p_nombre1,		p_nombre2,		p_apellido1,
				  p_apellido2,		p_sexo,			p_fec_nacimiento,
				  p_tip_sangre,		p_telefono1,		p_telefono2,
				  p_cor_personal,	p_cor_institucional,	p_direccion,
				  p_discapacidad, 	p_nacionalidad,		p_hijos,
				  p_est_civil,		p_observaciones
				);
  update sis.t_persona set nombre1 = upper(nombre1), nombre2 = upper(nombre2), apellido1 = upper(apellido1), apellido2 = upper(apellido2);

  RETURN cod_persona;
END;
$$;


ALTER FUNCTION sis.f_persona_ins(p_cedula integer, p_rif text, p_nombre1 text, p_nombre2 text, p_apellido1 text, p_apellido2 text, p_sexo text, p_fec_nacimiento date, p_tip_sangre text, p_telefono1 text, p_telefono2 text, p_cor_personal text, p_cor_institucional text, p_direccion text, p_discapacidad text, p_nacionalidad text, p_hijos integer, p_est_civil text, p_observaciones text) OWNER TO sisconot;




CREATE OR REPLACE FUNCTION sis.f_persona_sel(p_cursor refcursor)
  RETURNS refcursor AS
$BODY$
BEGIN
  OPEN p_cursor FOR
  select *,  (select to_char(fec_nacimiento,'DD/MM/YYYY')) as fec_nacimientos from sis.t_persona;

  RETURN p_cursor;

END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sis.f_persona_sel(refcursor)
  OWNER TO sisconot;

    

CREATE OR REPLACE FUNCTION sis.utf(character varying)
  RETURNS text AS
  $BODY$
    SELECT TRANSLATE
    ($1,
    'áàâãäéèêëíìïóòôõöúùûüÁÀÂÃÄÉÈÊËÍÌÏÓÒÔÕÖÚÙÛÜçÇ',
    'aaaaaeeeeiiiooooouuuuAAAAAEEEEIIIOOOOOUUUUcC');
  $BODY$
  LANGUAGE 'sql'
  COST 100;

ALTER FUNCTION sis.utf(character varying)  OWNER TO sisconot;

CREATE OR REPLACE FUNCTION sis.f_convalidar_ins(integer, boolean, real, date, text, integer, integer, integer, text)
  RETURNS integer AS
$BODY$
DECLARE
  p_codigo integer := 0;
  p_cod_estudiante integer:=0;
  p_cod_persona ALIAS for $1;
  p_con_nota ALIAS for $2;
  p_nota ALIAS for $3;
  p_fecha ALIAS for $4;
  p_cod_tip_uni_curricular ALIAS for $5;
  p_cod_pensum ALIAS for $6;
  p_cod_trayecto ALIAS for $7;
  p_cod_uni_curricular ALIAS for $8;
  p_descripcion ALIAS FOR $9;

BEGIN

  SELECT COALESCE (max(codigo),0) FROM sis.t_convalidacion INTO p_codigo;
  p_codigo := p_codigo + 1;
  SELECT codigo from sis.t_estudiante where cod_pensum=p_cod_pensum and cod_estado='A' and cod_persona=p_cod_persona INTO p_cod_estudiante;
  INSERT INTO sis.t_convalidacion(codigo,   cod_estudiante,      con_nota,   nota,
          fecha,      cod_tip_uni_curricular,    cod_pensum, cod_trayecto,
          cod_uni_curricular,   descripcion )
          
  VALUES (p_codigo,     p_cod_estudiante,          p_con_nota,   p_nota,
          p_fecha,        p_cod_tip_uni_curricular,    p_cod_pensum, p_cod_trayecto,
          p_cod_uni_curricular,     p_descripcion);

  RETURN p_codigo;

END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sis.f_convalidar_ins(integer, boolean, real, date, text, integer, integer, integer, text)
  OWNER TO sisconot;




CREATE OR REPLACE FUNCTION sis.f_convalidar_mod(integer, text)
  RETURNS integer AS
$BODY$
DECLARE
  r_operacion integer := 0;
  p_codigo  ALIAS FOR $1;
  p_descripcion ALIAS FOR $2;

BEGIN


  UPDATE sis.t_convalidacion  SET descripcion=p_descripcion  WHERE codigo=p_codigo;

  IF found THEN
  r_operacion := 1;
  END IF;


  RETURN r_operacion;

END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sis.f_convalidar_mod(integer, text)
  OWNER TO sisconot;



CREATE OR REPLACE FUNCTION sis.f_convalidacion_eli(integer)
  RETURNS integer AS
$BODY$
  DECLARE r_operacion integer := 0;
  p_codigo ALIAS for $1;
BEGIN

  DELETE FROM sis.t_convalidacion WHERE codigo = p_codigo;

  IF found THEN
    r_operacion := 1;
  END IF;

  RETURN r_operacion;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sis.f_convalidacion_eli(integer)
  OWNER TO sisconot;




CREATE OR REPLACE FUNCTION sis.f_archivo_ins(text,text)
  RETURNS integer AS
$BODY$
DECLARE 
	cod_archivo integer := 0;
	p_tipo ALIAS for $1;
	p_archivo ALIAS for $2;
BEGIN
	select coalesce(max(codigo),0) from sis.t_archivo into cod_archivo;

	cod_archivo:=cod_archivo+1;

	INSERT INTO sis.t_archivo (codigo,	tipo,	archivo	 )
			    VALUES (cod_archivo,p_tipo,	lo_import(p_archivo) );

  RETURN cod_archivo;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sis.f_archivo_ins(text, text)
  OWNER TO sisconot;


CREATE OR REPLACE FUNCTION sis.f_archivo_mod(integer,text,text)
  RETURNS integer AS
$BODY$
DECLARE 
	r_operacion integer := 0;
	p_codigo ALIAS for $1;
	p_tipo ALIAS for $2;
	p_archivo ALIAS for $3;
BEGIN

  UPDATE sis.t_archivo SET archivo = lo_import(p_archivo),tipo=p_tipo WHERE codigo= p_codigo;

  IF found THEN
  r_operacion := 1;
  END IF;

  RETURN cod_archivo;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sis.f_archivo_mod(integer,text, text)
  OWNER TO sisconot;

