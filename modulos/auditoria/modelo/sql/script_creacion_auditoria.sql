
drop table aud.t_auditoria;
create table aud.t_auditoria (  id serial,
				usuario character varying,
				datos text,
				hora timestamp,
				tabla character varying,
				tipo character varying,
				subtipo character varying
			);

CREATE OR REPLACE FUNCTION aud.f_auditoria()
  RETURNS trigger AS
$BODY$
DECLARE
	data json;
BEGIN
	IF (TG_OP = 'INSERT') THEN
		data = row_to_json(NEW.*);
	ELSEIF (TG_OP = 'DELETE') THEN
		IF (TG_WHEN = 'BEFORE') THEN
			data = row_to_json(OLD.*);
		ELSE 
			data = row_to_json(NEW.*);
		END IF;
	ELSEIF (TG_OP = 'UPDATE') THEN
		IF (TG_WHEN = 'BEFORE') THEN
			data = row_to_json(OLD.*);
		ELSE 
			data = row_to_json(NEW.*);
		END IF;
	END IF;
	
	INSERT INTO aud.t_auditoria (usuario,datos,hora,tabla,tipo,subtipo) 
		VALUES (user,data,current_timestamp,TG_TABLE_NAME,TG_OP,TG_WHEN);
	RETURN NEW;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION aud.f_auditoria()
  OWNER TO admin;

select tg_auditoria ('sis');
 CREATE OR REPLACE FUNCTION tg_auditoria (p_esquema text) returns void
   as $BODY$
DECLARE
	r information_schema.tables;
BEGIN
	for r in SELECT * FROM information_schema.tables WHERE table_schema = p_esquema loop
		execute 'CREATE TRIGGER tg_auditoria_before BEFORE INSERT OR UPDATE OR DELETE ON ' || p_esquema || '.' || r.table_name ||
			' FOR EACH ROW EXECUTE PROCEDURE aud.f_auditoria();';

		execute 'CREATE TRIGGER tg_auditoria_after AFTER INSERT OR UPDATE OR DELETE ON ' || p_esquema || '.' || r.table_name ||
			' FOR EACH ROW EXECUTE PROCEDURE aud.f_auditoria();';
	end loop;
	
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION tg_auditoria(p_esquema text)
  OWNER TO admin;

select borrartg('sis')

SELECT * FROM AUD.T_AUDITORIA

--DELETE FROM AUD.T_AUDITORIA
--DELETE FROM PUBLIC.DEL

select * from del

insert into del values(5105)

UPDATE  DEL SET A=7990 WHERE A=510


DROP TRIGGER test_trgg on public.del

 CREATE OR REPLACE FUNCTION borrartg (p_esquema text) returns void
   as $BODY$
DECLARE
	r information_schema.tables;
BEGIN
	for r in SELECT * FROM information_schema.tables WHERE table_schema = p_esquema loop
		execute 'DROP TRIGGER tg_auditoria_before  ON ' || p_esquema || '.' || r.table_name || ';';
			

		execute 'DROP TRIGGER tg_auditoria_after  ON ' || p_esquema || '.' || r.table_name ||';';
			
	end loop;
	
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION borrartg(p_esquema text)
  OWNER TO admin;


CREATE OR REPLACE FUNCTION sis.f_persona_act(p_codigo integer, p_cedula integer, p_rif text, p_nombre1 text, p_nombre2 text, p_apellido1 text, p_apellido2 text, p_sexo text, p_fec_nacimiento date, p_tip_sangre text, p_telefono1 text, p_telefono2 text, p_cor_personal text, p_cor_institucional text, p_direccion text, p_discapacidad text, p_nacionalidad text, p_hijos integer, p_est_civil text, p_observaciones text) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE r_operacion integer := 0;
BEGIN

	UPDATE sis.t_persona SET cedula=p_cedula,			rif=p_rif,
				 nombre1=upper(p_nombre1),		nombre2=upper(p_nombre2),
				 apellido1=upper(p_apellido1),		apellido2=upper(p_apellido2),
				 sexo=p_sexo,				fec_nacimiento=p_fec_nacimiento,
				 tip_sangre=p_tip_sangre,		telefono1=p_telefono1,
				 telefono2=p_telefono2,			cor_personal=p_cor_personal,
				 cor_institucional=p_cor_institucional,	direccion=p_direccion,
				 discapacidad=p_discapacidad,		nacionalidad=p_nacionalidad,
				 hijos=p_hijos,				est_civil=p_est_civil,
				 observaciones=p_observaciones
			     WHERE codigo=p_codigo;

	IF found THEN
		r_operacion := 1;
	END IF;

  RETURN r_operacion;
END;
$$;


ALTER FUNCTION sis.f_persona_act(p_codigo integer, p_cedula integer, p_rif text, p_nombre1 text, p_nombre2 text, p_apellido1 text, p_apellido2 text, p_sexo text, p_fec_nacimiento date, p_tip_sangre text, p_telefono1 text, p_telefono2 text, p_cor_personal text, p_cor_institucional text, p_direccion text, p_discapacidad text, p_nacionalidad text, p_hijos integer, p_est_civil text, p_observaciones text) 
OWNER TO admin;


CREATE OR REPLACE FUNCTION sis.f_persona_ins(p_cedula integer, p_rif text, p_nombre1 text, p_nombre2 text, p_apellido1 text, p_apellido2 text, p_sexo text, p_fec_nacimiento date, p_tip_sangre text, p_telefono1 text, p_telefono2 text, p_cor_personal text, p_cor_institucional text, p_direccion text, p_discapacidad text, p_nacionalidad text, p_hijos integer, p_est_civil text, p_observaciones text) RETURNS integer
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
				  upper(p_nombre1),	upper(p_nombre2),	upper(p_apellido1),
				  upper(p_apellido2),	p_sexo,			p_fec_nacimiento,
				  p_tip_sangre,		p_telefono1,		p_telefono2,
				  p_cor_personal,	p_cor_institucional,	p_direccion,
				  p_discapacidad, 	p_nacionalidad,		p_hijos,
				  p_est_civil,		p_observaciones
				);
 
  RETURN cod_persona;
END;
$$;


ALTER FUNCTION sis.f_persona_ins(p_cedula integer, p_rif text, p_nombre1 text, p_nombre2 text, p_apellido1 text, p_apellido2 text, p_sexo text, p_fec_nacimiento date, p_tip_sangre text, p_telefono1 text, p_telefono2 text, p_cor_personal text, p_cor_institucional text, p_direccion text, p_discapacidad text, p_nacionalidad text, p_hijos integer, p_est_civil text, p_observaciones text) 
OWNER TO admin;




  