
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
		data = row_to_json(OLD.*);		
		
	ELSEIF (TG_OP = 'UPDATE') THEN
		IF (TG_WHEN = 'BEFORE') THEN
			data = row_to_json(OLD.*);
		ELSE 
			data = row_to_json(NEW.*);
		END IF;
	END IF;
	
	INSERT INTO aud.t_auditoria (usuario,datos,hora,tabla,tipo,subtipo) 
		VALUES (user,data,current_timestamp,TG_TABLE_NAME,TG_OP,TG_WHEN);
	IF (TG_OP <> 'DELETE') THEN
		RETURN NEW;
	ELSE
		RETURN OLD;
	END IF;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION aud.f_auditoria()
  OWNER TO admin;


CREATE OR REPLACE FUNCTION aud.f_NoBorrarEditarAuditoria()
  RETURNS trigger AS
$BODY$
DECLARE
	
BEGIN
	return null;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION aud.f_NoBorrarEditarAuditoria()
  OWNER TO admin;

select aud.f_NoBorrarEditarAuditoria();

 CREATE OR REPLACE FUNCTION aud.f_crearTgAuditoria (p_esquema text) returns void
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
ALTER FUNCTION aud.f_crearTgAuditoria (p_esquema text)
  OWNER TO admin;
  

 CREATE OR REPLACE FUNCTION aud.f_crearTgTablaAuditoria () returns void
   as $BODY$
DECLARE
	
BEGIN	
	execute 'CREATE TRIGGER tg_auditoria_before BEFORE UPDATE OR DELETE ON aud.t_auditoria  FOR EACH ROW EXECUTE PROCEDURE aud.f_NoBorrarEditarAuditoria();';
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION aud.f_crearTgTablaAuditoria ()
  OWNER TO admin;

select aud.f_crearTgTablaAuditoria ();

 CREATE OR REPLACE FUNCTION aud.f_eliminarTg (p_esquema text) returns void
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
ALTER FUNCTION aud.f_eliminarTg(p_esquema text)
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
	exite integer := 0;
BEGIN
	select coalesce(max(codigo),0) from sis.t_persona into cod_persona;

	cod_persona := cod_persona + 1;
	select codigo from sis.t_persona where cedula=p_cedula into exite;
	IF (exite is  null) THEN
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
	ELSE
		RETURN -1;
	END IF;
END;
$$;


ALTER FUNCTION sis.f_persona_ins(p_cedula integer, p_rif text, p_nombre1 text, p_nombre2 text, p_apellido1 text, p_apellido2 text, p_sexo text, p_fec_nacimiento date, p_tip_sangre text, p_telefono1 text, p_telefono2 text, p_cor_personal text, p_cor_institucional text, p_direccion text, p_discapacidad text, p_nacionalidad text, p_hijos integer, p_est_civil text, p_observaciones text) 
OWNER TO admin;


grant all on sequence aud.t_auditoria_id_seq to public;


CREATE OR REPLACE FUNCTION per.AgregarModuloAuditoria() returns void
   as $BODY$
DECLARE

BEGIN
	select per.f_modulo_agregar('Auditoria', 'Gestion de la auditoria sobre las modificaciones en todas las tablas del esquema sis');
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION per.AgregarModuloAuditoria()
  OWNER TO admin;

select per.AgregarModuloAuditoria();

CREATE OR REPLACE FUNCTION per.AgregarAccionesAuditoria() returns void
   as $BODY$
DECLARE
	codigoModulo integer;
BEGIN
	select codigo from per.t_modulo where nombre='Auditoria' into codigoModulo;
	select per.f_accion_ins('AuditoriaAgregar', 'agregar en la tabla auditoria', codigoModulo);	
	select per.f_accion_ins('AuditoriaListar', 'Permite Consultar la tabla Auditoria', codigoModulo);
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION aud.f_agregarPermmisoATodosUsuarios()
  OWNER TO admin;

select per.AgregarAccionesAuditoria();

 CREATE OR REPLACE FUNCTION aud.f_agregarPermmisoATodosUsuarios () returns void
   as $BODY$
DECLARE
	r pg_user;
	i per.t_usuario;
	x integer;
	codInsertarAuditoria integer;
	codListarAuditoria integer;
BEGIN
	select codigo from per.t_accion where nombre='AuditoriaAgregar' into codInsertarAuditoria;
	select codigo from per.t_accion where nombre='AuditoriaListar' into codListarAuditoria;
	
	for r in SELECT usename FROM pg_user loop
		execute 'grant insert on table aud.t_auditoria to ' || r.usename ||';';
			
		execute 'grant select on table aud.t_auditoria to ' || r.usename ||';';			
	end loop;

	for i in SELECT codigo FROM per.t_usuario loop
		select max(cod_usuario) from per.t_acc_usuario where cod_accion in (codInsertarAuditoria,codListarAuditoria) and cod_usuario =i.codigo into x;
		if(x is null) then
			execute 'select per.f_usuario_usu_acc_insertar('  ||i.codigo || ',' || codInsertarAuditoria ||');';
			execute 'select per.f_usuario_usu_acc_insertar('  ||i.codigo ||',' || codListarAuditoria ||');';	
		end if;		
	end loop;
	
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION aud.f_agregarPermmisoATodosUsuarios()
  OWNER TO admin;
  
  select aud.f_agregarPermmisoATodosUsuarios ();

--pg_dump postgres > postgres_db.sql

  

  