--se debe crear un dblink, para ello por la consola se hace lo siguiente:
--sudo -u root su postgres;     --para conectarse como el usuario posgres del SO
--psql
--  # \c bd_sisgesac;
--  create extension dblink;


--migracion de los institutos
--select * from sis.t_instituto;
--insert into sis.t_instituto (codigo, nombre,nom_corto,direccion)
--SELECT p.*
--FROM dblink('dbname=bd_scnfinal port=5432',
 --           'SELECT codigo, nombre,nom_corto,direccion
 --                   FROM sis.t_instituto where codigo=11')
 --   AS p(codigo smallint,nombre varchar(100), nom_corto varchar(20), direccion varchar(200));


--migracion sis.t_est_cur_estudiante;
--select * from sis.t_est_cur_estudiante;
--insert into sis.t_est_cur_estudiante (codigo, nombre) values
--('C','Cursando'),
--('R','Reprobado'),
--('A','Aprobado'),
--('X','Retirado'),
--('I','Reprobado por inasistencia');

--migracion sis.t_est_docente a sis.t_est_empleado
--select * from sis.t_est_empleado;
--INSERT INTO sis.t_est_empleado (codigo, nombre) VALUES ('A', 'Activo');
--INSERT INTO sis.t_est_empleado (codigo, nombre) VALUES ('R', 'Retirado');
--INSERT INTO sis.t_est_empleado (codigo, nombre) VALUES ('J', 'Jubilado');


--select * from sis.t_est_estudiante;-
--INSERT INTO sis.t_est_estudiante (codigo, nombre) VALUES ('A', 'Activo');
--INSERT INTO sis.t_est_estudiante (codigo, nombre) VALUES ('R', 'Retirado');
--INSERT INTO sis.t_est_estudiante (codigo, nombre) VALUES ('C', 'Congelado');
---INSERT INTO sis.t_est_estudiante (codigo, nombre) VALUES ('G', 'Graduado');

--select * from sis.t_est_periodo
--INSERT INTO sis.t_est_periodo (codigo, nombre) VALUES ('A', 'Abierto');
--INSERT INTO sis.t_est_periodo (codigo, nombre) VALUES ('C', 'Cerrado');

--select * from sis.t_tip_uni_curricular
--INSERT INTO sis.t_tip_uni_curricular (codigo, nombre) VALUES ('O', 'Obligatoria');
--INSERT INTO sis.t_tip_uni_curricular (codigo, nombre) VALUES ('E', 'Electiva');


--tabla sis.t_pensum
--select * from sis.t_pensum;
--insert into sis.t_pensum (codigo, nombre,nom_corto,observaciones)
--SELECT p.*
--FROM dblink('dbname=bd_scnfinal port=5432',
--            'SELECT codigo, nombre,nom_corto,observaciones
--                    FROM sis.t_pensum where codigo = 1')
--    AS p(codigo integer,nombre varchar(100), nom_corto varchar(20), observaciones varchar(200));

--select * from sis.t_periodo;
--insert into sis.t_periodo (codigo, nombre,cod_instituto,cod_pensum,fec_inicio,fec_final,observaciones,cod_estado)
--SELECT p.*
--FROM dblink('dbname=bd_scnfinal port=5432',
--            'SELECT codigo, nombre,cod_instituto,cod_pensum,fec_inicio,fec_final,observaciones,cod_estado
--                    FROM sis.t_periodo where cod_pensum = 1')
--    AS p(codigo integer, nombre varchar(30),cod_instituto integer,cod_pensum integer,fec_inicio date,fec_final date,observaciones varchar(100),cod_estado character(1));


-- select * from sis.t_trayecto;
--insert into sis.t_trayecto (codigo, cod_pensum,num_trayecto, certificado)
--SELECT p.*
--FROM dblink('dbname=bd_scnfinal port=5432',
--            'SELECT codigo, cod_pensum,num_trayecto, certificado
--                    FROM sis.t_trayecto where cod_pensum = 1')
--    AS p(codigo integer, cod_pensum integer,num_trayecto integer, certificado varchar(150));


--migrado sis.t_uni_curricular
--select * from sis.t_uni_curricular;
--insert into sis.t_uni_curricular (codigo,
-- cod_uni_ministerio,
-- nombre ,
-- hta,
-- hti,
-- uni_credito,
-- dur_semanas,
-- not_min_aprobatoria,
-- not_maxima)
--SELECT p.*
--FROM dblink('dbname=bd_scnfinal port=5432',
--            'SELECT codigo, cod_uni_ministerio,nombre,hta,hti,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima
--                    FROM sis.t_uni_curricular where cod_trayecto between 1 and 5 and codigo != 50 order by cod_trayecto')
--    AS p(codigo integer, cod_uni_ministerio varchar(40),nombre varchar(60),hta double precision, hti double precision, uni_credito smallint,dur_semanas smallint,not_min_aprobatoria smallint,not_maxima smallint);


--select * from  sis.t_uni_tra_pensum order by codigo
--insert into sis.t_uni_tra_pensum(codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
--SELECT p.*
--FROM dblink('dbname=bd_scnfinal port=5432',
--            'select row_number() over (order by codigo) + 10 as codigo, 
--                     1 as cod_pensum, 
 --                    cod_trayecto,
  --                   codigo as cod_uni_curricular,
   --                  cod_tipo 
--             from sis.t_uni_curricular where cod_trayecto between 1 and 5 and codigo != 50 order by cod_trayecto')
--    AS p(codigo integer, cod_pensum integer,cod_trayecto integer, cod_uni_curricular integer,cod_tipo character(1));
--update sis.t_uni_tra_pensum set codigo = codigo - 10;

--personas
--select * from sis.t_persona order by cedula;
--insert into sis.t_persona (codigo, cedula, rif, nombre1, nombre2, 
--                           apellido1, apellido2, sexo, fec_nacimiento, tip_sangre,
--                           telefono1, telefono2,cor_personal,cor_institucional, direccion,
--                           discapacidad, nacionalidad, hijos, est_civil, observaciones,
--                           cod_foto)
--SELECT p.*
--  FROM dblink('dbname=bd_scnfinal port=5432',
--            'select codigo, cedula, rif, nombre1, nombre2,
--       apellido1, apellido2, sexo, fec_nacimiento, tip_sangre,
--       telefono1, telefono2, cor_personal,cor_institucional, direccion,
--       null, null, null, null, null,
--       null
--        from sis.t_persona where cedula > 200000
--          order by cedula')
--    AS p(codigo integer, cedula integer, rif varchar(20),nombre1 varchar(20),nombre2 varchar(20),
--         apellido1 varchar(20), apellido2 varchar(20),sexo character(1),fec_nacimiento date,tip_sangre varchar(5),
--         telefono1 varchar(15), telefono2 varchar(15), cor_personal varchar(50),cor_institucional varchar(50),direccion varchar(150),
--         discapacidad varchar(50),nacionalidad character(1),hijos integer, est_civil character(1),observaciones varchar(200),
--         cod_foto integer);                 
--update sis.t_persona 
--        set nombre1 = upper(nombre1), 
--            nombre2 = upper(nombre2), 
--            apellido1 = upper(apellido1),
--            apellido2 = upper(apellido2)


------------------estudiantes
--select * from sis.t_estudiante;
--insert into sis.t_estudiante (
-- codigo,         cod_persona,    cod_instituto, cod_pensum, num_carnet,
-- num_expediente, cod_rusnies,    cod_estado,    fec_inicio, condicion,
-- fec_fin,        observaciones 
--)
--SELECT p.*
 -- FROM dblink('dbname=bd_scnfinal port=5432',
--            'select row_number() over (order by codigo) as codigo,
--		       codigo as cod_persona,
--		       11 as cod_instituto,
--		       1 as cod_pensum,
--		       num_carnet,
--		       num_expediente,
--		       cod_rusnies,
--		       cod_estado,
--		       ''01/01/2014'' as fec_inicio,
--		       null as condicion,
--		       null as fec_fin,
--		       null as observaciones
--		from sis.t_estudiante
--		order by codigo')
--    AS p(codigo integer, cod_persona integer, cod_instituto integer, cod_pensum integer, num_carnet character varying(25),
--         num_expediente character varying(25), cod_rusnies  character varying(20), cod_estado character(1), fec_inicio date,condicion character varying(5),
--	fec_fin date,  observaciones varchar(200)
--);                 

--select * from sis.t_empleado;
--insert into sis.t_empleado (
--  codigo, cod_persona, cod_instituto, cod_pensum, cod_estado,
-- fec_inicio, fec_fin, es_jef_pensum, es_jef_con_estudio, es_ministerio,
--  es_docente, observaciones
--)
--SELECT p.*
--  FROM dblink('dbname=bd_scnfinal port=5432',
--            'select row_number() over (order by codigo) as codigo,
--		       codigo as cod_persona,
--		       11 as cod_instituto,
--		       1 as cod_pensum,
--		       cod_estado,
--		       ''01/01/2014'' as fec_inicio,
--		       null as fec_fin,
--			false as es_jef_pensum,
--			false as es_jef_con_estudio,
--			false as es_ministerio,
--			true as es_docente,
--			null as observaciones
--		from sis.t_docente
--		order by codigo')
--    AS p(  codigo integer,cod_persona  integer, cod_instituto integer, cod_pensum  integer, cod_estado  character varying(1), 
--	fec_inicio date, fec_fin  date, es_jef_pensum boolean, es_jef_con_estudio boolean, es_ministerio boolean, 
--	es_docente boolean, observaciones character varying(200)
--);                 
-- oscar mendoza está retirado su cedula es
--select * from sis.t_persona where nombre1 like '%OSCAR%';
-- cedula:  17559834    codigo: 2064
--update sis.t_empleado set cod_estado = 'R' where cod_persona = 2064;
--select * from sis.t_empleado;


--select * from sis.t_curso order by codigo
--insert into sis.t_curso (
-- codigo, cod_periodo, cod_uni_curricular, cod_docente, seccion,
--  fec_inicio, fec_final, capacidad, observaciones, cod_estado
--)
--SELECT p.*
--  FROM dblink('dbname=bd_scnfinal port=5432',
--            'select codigo,   cod_periodo, cod_uni_curricular, cod_docente, seccion,
--		       fec_inicio, fec_final,capacidad, observaciones, ''A'' as cod_estado
--		 from sis.t_curso
--		  where cod_uni_curricular != 50;
--		')
--    AS p(codigo integer, cod_periodo integer, cod_uni_curricular integer, cod_docente integer, seccion character varying(5),
--         fec_inicio date, fec_final date, capacidad smallint, observaciones character varying(300), cod_estado character(1)  
--);  
--select nextval('sis.s_curso');
--acomodar secuencia
--            select max(codigo) from sis.t_curso; --retorno 177
--            alter sequence sis.s_curso restart with 201;


--select * from sis.t_cur_estudiante order by codigo;
--insert into sis.t_cur_estudiante (
--codigo, cod_curso, cod_estudiante, por_asistencia, nota,
-- cod_estado, observaciones
--)
--SELECT p.*
--  FROM dblink('dbname=bd_scnfinal port=5432',
--            'select codigo,
--		       cod_curso,
--		       cod_estudiante,
--		       por_asistencia,
--		       nota,
--		       case 
--			      when cod_estado=''I'' then ''C''
--			      when cod_estado=''E'' then ''X''
--			      when cod_estado=''A'' then ''A''
--			      when cod_estado=''R'' then ''R''
--			      when cod_estado=''N'' then ''I''
--			      else ''Z''
--			      end as cod_estado,
--		       observaciones
--		from sis.t_cur_estudiante 
--		where cod_curso NOT in (75, 85);
--		')
--    AS p(codigo integer, cod_curso integer, cod_estudiante integer, por_asistencia double precision, nota double precision,
--         cod_estado character(1), observaciones character varying(300)
--);  
--acomodar la secuencia
-- select nextval('sis.s_cur_estudiante');
--            select max(codigo) from sis.t_cur_estudiante; --retorna 1396
--            alter sequence sis.s_cur_estudiante restart with 1501;
--select * from sis.t_est_cur_estudiante;

select * from per.t_usuario order by campo1;
start transaction
insert into per.t_usuario (
codigo, usuario, tipo, campo1, campo2, campo3
)
SELECT p.*
  FROM dblink('dbname=bd_scnfinal port=5432',
            'select row_number() over (order by codigo) + 100 as codigo,
		       nombre as usuario,
		       tipo,
		       codigo as campo1,
		       null as campo2,
		       null as campo3
		from per.t_usuario
		order by codigo')
    AS p(codigo integer, usuario character varying(30), tipo character(1), campo1 integer, campo2 character varying(30),
     campo3 character varying(30)
);  
update per.t_usuario set campo1 = null where tipo = 'R';

commit