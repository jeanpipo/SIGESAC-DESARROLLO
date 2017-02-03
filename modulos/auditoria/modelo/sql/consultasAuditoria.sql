CREATE OR REPLACE FUNCTION aud.f_auditoria_sel(p_tabla text[], p_usuario text[], p_tipo text[])
  RETURNS table (id int,
				usuario character varying,
				datos text,
				hora timestamp,
				tabla character varying,
				tipo character varying,
				subtipo character varying) AS
$BODY$
DECLARE

BEGIN
	IF(p_tabla is not null and p_usuario is not null and  p_tipo is not null) THEN
	    	return query select a.id, a.usuario, a.datos, a.hora, a.tabla, a.tipo, a.subtipo from aud.t_auditoria as a where a.tabla=any(p_tabla) and a.usuario=any(p_usuario) and a.tipo=any(p_tipo);
	ELSEIF(p_tabla is not null and p_usuario is not null) THEN
		return query select a.id, a.usuario, a.datos, a.hora, a.tabla, a.tipo, a.subtipo from aud.t_auditoria as a where a.tabla=any(p_tabla) and a.usuario=any(p_usuario);
	ELSEIF( p_tabla is not null and p_tipo is not null) THEN
		return query select a.id, a.usuario, a.datos, a.hora, a.tabla, a.tipo, a.subtipo from aud.t_auditoria as a where a.tabla=any(p_tabla) and a.tipo=any(p_tipo);
	ELSEIF(p_usuario is not null and p_tipo is not null) THEN
		return query select a.id, a.usuario, a.datos, a.hora, a.tabla, a.tipo, a.subtipoo from aud.t_auditoria as a where a.usuario=any(p_usuario) and a.tipo= any(p_tipo);
	ELSEIF(p_tabla is null and p_usuario is null and  p_tipo is null) THEN
	    	return query select a.id, a.usuario, a.datos, a.hora, a.tabla, a.tipo, a.subtipo from aud.t_auditoria as a;
	ELSE
		return query select a.id, a.usuario, a.datos, a.hora, a.tabla, a.tipo, a.subtipo from aud.t_auditoria as a where a.tabla=any(p_tabla) or a.usuario=any(p_usuario) or a.tipo=any(p_tipo);
	END IF;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION aud.f_auditoria_sel(p_tabla text[], p_usuario text[], p_tipo text[])
  OWNER TO admin;

/*
 select * from aud.f_auditoria_sel (null,null,null)

select * from aud.t_auditoria

grant all privileges on aud.t_auditoria_id_seq to papo



CREATE OR REPLACE FUNCTION sa()
  RETURNS table (id int,
				usuario character varying,
				datos text,
				hora timestamp,
				tabla character varying,
				tipo character varying,
				subtipo character varying) AS
$BODY$
DECLARE
	
BEGIN
	
	 return query select a.* from aud.t_auditoria as a;

	 select * from sis.t_empleado where cod_persona = 2176;
	 delete from sis.t_empleado where cod_persona = 2176

	
	
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sa()
  OWNER TO admin;

  select sa()

  */