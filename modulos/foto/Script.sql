--Script de creación de la base de datos del Sistema Administrador de pensum
--Proyecto Socio Tecnologico II
--Creado por Jhonny Vielma y Geraldine Castillo
--Tutor Johan Alamo
--Mantenido por _________
--Febrero 2014
--Dpto de informática del IUT-RC "Dr. Federico Rivero Palacio"

--Version del script: 1.0
--Contempla lo siguiente

-- CREACION DE LA BASE DE DATOS   *********************************************
-- Borrar la base de datos
\connect postgres;

select 'consulta para limpiar el buffer, no borrar.';

drop database bd_sap;


-- Crear de nuevo la base de datos
CREATE DATABASE bd_sap
  WITH OWNER = postgres
      -- ENCODING = 'UTF8';
      -- LC_COLLATE = 'es_VE.utf8';
      --- LC_CTYPE = 'es_VE.utf8';
       CONNECTION LIMIT = -1;

-- Conectarse a la nueva base de datos
\connect bd_sap;


-- Establecer configuraciones generales
SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;
SET search_path = public, pg_catalog;
SET default_tablespace = '';
SET default_with_oids = false;


create table ts_instituto(
	codigo serial,
	nom_corto varchar(20) not null,
	nombre varchar(100) not null,
	direccion varchar(200),
	constraint cp_instituto primary key (codigo),
	constraint ca_instituto unique(nom_corto)
);

--Estado que determina si el periodo academico ha finalizado o no
create table ts_est_periodo(
	codigo smallint,
	descripcion varchar(20) not null,
	estado char not null,
	constraint cp_est_periodo primary key(estado),
	constraint ca_est_periodo unique(codigo)

);
 
create table ts_periodo(
	codigo serial,
	fec_inicio date not null,
	fec_final date not null,
	observaciones varchar(100),
	constraint ch_periodo_fec_inicio_fec_final check(fec_inicio<fec_final),
	constraint cp_periodo primary key (codigo)


);



create table ts_pensum(
   codigo serial,
   nombre varchar(100) not null,
   nom_corto varchar(20) not null,
   observaciones varchar(200),
   constraint cp_pensum primary key (codigo),
   constraint ca_pensum unique(nom_corto)
);


create table ts_ins_pen_periodo (
	codigo serial, 
	cod_instituto integer NOT NULL,
	cod_pensum integer NOT NULL,
	cod_periodo integer not null,
	estado char not null,  
	constraint cp_ins_pen_per primary key (codigo),
	constraint ca_ins_pen_per unique (cod_instituto, cod_pensum, cod_periodo ),
	constraint cf_ins_pen_per__instituto foreign key (cod_instituto)
		references ts_instituto(codigo),
	constraint cf_ins_pen_per__pensum foreign key (cod_pensum)
		references ts_pensum(codigo),
	constraint cf_ins_pen_per__periodo foreign key (cod_periodo)
		references ts_periodo(codigo),
	constraint cf_ins_pen_per__est_periodo foreign key(estado)
		references ts_est_periodo(estado)
);

create table ts_trayecto(
	codigo serial,
	num_trayecto smallint not null,
	cod_pensum integer not null,
	certificado varchar(150),
	min_credito smallint not null,
	constraint cp_trayecto primary key(codigo),
	constraint cf_trayecto__pensum foreign key (cod_pensum) 
		references ts_pensum(codigo),
	constraint ca_trayecto unique(num_trayecto,cod_pensum)
);

create table ts_uni_cur_tipo(
	codigo smallint,
	descripcion varchar(40) not null,
	tipo char not null,
	constraint cp_uni_cur_tipo primary key(tipo),
	constraint ca_uni_cur_tipo unique(codigo)
);

create table ts_uni_curricular(
	codigo serial,
	cod_uni_ministerio varchar(20) not null,
	cod_trayecto integer not null,
	cod_pensum integer not null,
	nombre varchar(100) not null,
	tipo char not null,
	hti float not null,
	hta float not null,
	uni_credito smallint not null,
	dur_semanas smallint not null,
	not_min_aprobatoria smallint not null,
	not_maxima smallint not null,
	constraint cp_uni_curricular primary key(codigo),
	constraint cf_uni_curicular__trayecto foreign key(cod_trayecto)
		references ts_trayecto(codigo),
	constraint cf_uni_curicular__pensum foreign key(cod_pensum)
		references ts_pensum(codigo),
	constraint cf_uni_curricular__uni_cur_tipo foreign key(tipo)
		references ts_uni_cur_tipo(tipo),
	constraint ca_uni_curricular unique(cod_uni_ministerio,cod_pensum)
);
comment on column ts_uni_curricular.hta is 'Atributo para las horas de trabajo acompanado';
comment on column ts_uni_curricular.hti is 'Atributo para las horas de trabajo independiente';

create table ts_privilegios(
	codigo smallint,
	descripcion varchar(50),
	tipo char,
	constraint cp_privilegios primary key(tipo),
	constraint ca_privilegios unique(codigo)
);

create table ts_persona(
	cedula integer not null,
	codigo serial,
	rif varchar(20),
	cod_instituto integer,
	cod_pensum integer,
	nombre1 varchar(20) not null,
	nombre2 varchar(20),
	apellido1 varchar(20) not null,
	apellido2 varchar(20),
	sexo varchar(1) not null,
	fec_nacimiento date,
	tip_sangre varchar(8),
	telefono1 varchar(20) not null,
	telefono2 varchar(20),
	cor_personal varchar(50),
	cor_institucional varchar(50),
	direccion varchar(200),
	privilegio char,
	constraint cp_persona primary key(codigo),
	constraint ca_persona2 unique(cedula),
	constraint ch_persona_sexo check(sexo in ('M','F')),
	constraint ch_persona_fec_nacimiento check(fec_nacimiento>='01/01/1940' and fec_nacimiento<= current_date),
	constraint cf_persona__privilegios foreign key(privilegio)
		references ts_privilegios(tipo),			
	constraint cf_persona__instituto foreign key(cod_instituto)
		references ts_instituto(codigo),
	constraint cf_persona__pensum foreign key(cod_pensum)
		references ts_pensum(codigo)
);

create table ts_est_docente(
	codigo smallint,
	descripcion varchar(40) not null,
	estado char not null,
	constraint cp_est_docente primary key(estado),
	constraint ca_est_docente unique(codigo)

);

create table ts_docente(
	codigo integer,
	num_empleado smallint,
	login varchar(35),
	passwd varchar(35),
	estado char not null,
	constraint cp_docente primary key(codigo),
	constraint cf_docente__persona foreign key(codigo)
		references ts_persona(codigo),
	constraint cf_docente__est_docente foreign key(estado)
		references ts_est_docente(estado),
	--constraint ca_docente unique(num_empleado),
	constraint ca_docente2 unique(login)
);

create table ts_curso(
	codigo serial,
	cod_ins_pen_periodo integer not null,
	cod_uni_curricular integer not null,
	cod_docente integer not null,
	seccion varchar(5) not null,
	fec_inicio date,
	fec_final date,
	capacidad smallint,
	observaciones varchar(300),
	constraint cp_curso primary key(codigo),
	constraint cf_curso__uni_curricular foreign key(cod_uni_curricular)
		references ts_uni_curricular(codigo),
	constraint cf_curso__docente foreign key(cod_docente)
		references ts_docente(codigo),
	constraint cf_curso__periodo foreign key(cod_ins_pen_periodo)
		references ts_ins_pen_periodo(codigo),
	constraint ca_curso unique(cod_ins_pen_periodo,cod_uni_curricular,seccion)
);

create table ts_est_estudiante(
	codigo smallint,
	descripcion varchar(20) not null,
	estado char not null,
	constraint cp_est_estudiante primary key(estado),
	constraint ca_est_estudiante unique(codigo)
);

create table ts_estudiante(
	codigo integer,
	num_carnet varchar(20),
	num_expediente varchar(30),
	cod_rusnies varchar(30),
	login varchar(35),
	passwd varchar(35),
	estado char not null,
	constraint cp_estudiante primary key(codigo),
	constraint cf_estudiante__persona foreign key(codigo)
		references ts_persona(codigo),
	constraint cf_estudiante__est_estado foreign key(estado)
		references ts_est_estudiante(estado),
	constraint ca_estudiante unique(num_carnet),
	constraint ca_estudiante2 unique(num_expediente),
	constraint ca_estudiante3 unique(login),
	constraint ca_estudiante4 unique(cod_rusnies)

);

create table ts_est_cur_estudiante(
	codigo smallint,
	descripcion varchar(20) not null,
	estado char not null,
	constraint cp_est_cur_estudiante primary key(estado),
	constraint ca_est_cur_estudiante unique(codigo)
);

create table ts_cur_estudiante(
	codigo serial,

	cod_estudiante integer not null,
	cod_curso integer not null,
	por_asistencia float,
	nota integer,
	estado char not null,
	observaciones varchar(300),
	constraint cp_est_curso primary key(codigo),
	constraint ca_est_curso unique(cod_estudiante,cod_curso),
	constraint cf_est_curso__estudiante foreign key(cod_estudiante)
		references ts_estudiante(codigo),
	constraint cf_est_curso__curso foreign key(cod_curso)
		references ts_curso(codigo),
	constraint cf_est_curso__est_cur_estado foreign key(estado)
		references ts_est_cur_estudiante(estado)
	
);

create table ts_fotografia(
	cod_persona integer not null,
	tipo varchar(20),
	imagen oid,
	constraint cp_fotografia primary key(cod_persona),
	constraint cf_fotografia__persona foreign key(cod_persona)
		references ts_persona(codigo)
);

--Funcion para hacer reverse a las cadenas de texto

CREATE or REPLACE FUNCTION reverse(text) RETURNS text AS $$
	Select array_to_string(ARRAY(
		SELECT substring($1,s.i,1) from generate_series(length($1), 1, -1) as s(i)
		), '');

$$ LANGUAGE SQL IMMUTABLE STRICT;


-- conectarse de nuevo a la base de datos postgres
\connect postgres;



-- TIPOS DE DATOS EN POSTGRESQL *********************************************
--tipos de datos, tamaño y rango
--smallint	2 bytes	small-range integer	-32768 to +32767
--integer	4 bytes	usual choice for integer	-2147483648 to +2147483647
--bigint	8 bytes	large-range integer	-9223372036854775808 to 9223372036854775807
--decimal	variable	user-specified precision, exact	no limit
--numeric	variable	user-specified precision, exact	no limit
--real	4 bytes	variable-precision, inexact	6 decimal digits precision
--double precision	8 bytes	variable-precision, inexact	15 decimal digits precision
--serial	4 bytes	autoincrementing integer	1 to 2147483647
--bigserial	8 bytes	large autoincrementing integer	1 to 9223372036854775807

