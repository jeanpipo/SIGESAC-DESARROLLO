/*Script de creación de la base de datos del Sistema de Control de Notas
--Creado por Johan Alamo y estudiantes de proyecto sociotecnológico 
--Comenzado en 2012
--Retomado en febrero de 2014
--Dpto de informática del IUT-RC "Dr. Federico Rivero Palacio"

Última versión
septiembre de 2015.
Participantes:
Tutor/coordinador: Johan Alamo  (johan.alamo@gmail.com)
Estudiantes participantes en la versión final:
	De Sousa, Juan
	García, Rafael
	Sosa, Jean Pierre

Participantes en versiones anteriores
	Castillo, Geraldine
	De Sousa, Juan
	Vielma, Jhonny
	Franco, Cesar
	García, Edson
*/

-- CREACION DE LA BASE DE DATOS   *********************************************
\connect postgres;

-- consulta para limpiar el buffer, no borrar.
select 'consulta para limpiar el buffer, no borrar.';

-- Borrar la base de datos en caso de existir
--drop database  bd_sisconot;

--drop user sisconot;
create user sisconot password '123';


-- Crear de nuevo la base de datos
--CREATE DATABASE bd_sisconot WITH OWNER = sisconot ENCODING = 'UTF8' CONNECTION LIMIT = -1;

--cambia el formato de la fecha a Dia/mes/año para consulta e insercion
alter database bd_sisconot SET DateStyle to 'sql,dmy';


-- Conectarse a la nueva base de datos
\connect bd_sisconot sisconot;



--crear el esquema de las tablas del sistema  ****************************************************
--create schema sis;


grant usage on schema sis to sisconot;


--***************************************  CREACIÓN DE TABLAS DE SUBSITEMA DE MALLAS CURRICULARES *********************************

--creación de la tabla pensum
create table sis.t_pensum(
	codigo integer,
	nombre varchar(50) not null,
	nom_corto varchar(20) not null,
	observaciones varchar(200),
	min_can_electiva smallint not null default 0, -- cantidadad de electivas
	min_cre_electiva smallint not null default 0,
	min_cre_obligatoria smallint not null default 0,
	fec_creacion date,
	constraint cp_pensum primary key (codigo),
	constraint ca_pensum unique(nom_corto),
 	constraint chk_t_pensum_01 check (min_can_electiva >= 0),
	constraint chk_t_pensum_02 check (min_cre_electiva >= 0),
	constraint chk_t_pensum_03 check (min_cre_obligatoria >= 0),
	constraint chk_t_pensum_04 check (fec_creacion >= '01/01/1950') 
);
comment on table sis.t_pensum is 'Tabla padre de un pensum';
comment on column sis.t_pensum.codigo is 'Código del pensum';
comment on column sis.t_pensum.nombre is 'Nombre largo del pensum';
comment on column sis.t_pensum.nom_corto is 'Abreviación del nombre del pensum';
comment on column sis.t_pensum.observaciones is 'Alguna otra información relevante del pensum';
comment on column sis.t_pensum.min_can_electiva is 'Minima Cantidad de Electivas que se deben cursar en el pesum';
comment on column sis.t_pensum.min_cre_electiva is 'MInima Cantidad de unidades de créditos que se deben cursar en el pensum en unidades obligatorias';
comment on column sis.t_pensum.min_cre_obligatoria is 'MInima Cantidad de Creditos de Electivas Obligatorios';
comment on column sis.t_pensum.fec_creacion is 'Fecha de creacion del pensum';
alter table sis.t_pensum owner to sisconot;

-- (Corregido)
-- CORRECCIONES A LA TABLA T_PENSUM ***************************************************************************************
-- ccomment on column sis.t_pensum.min_can_electiva is 'Minima Cantidad de Electivas que se deben cursar en el pesum'; 
-- ccomment on column sis.t_pensum.min_cre_electiva is 'MInima Cantidad de unidades de créditos que se deben cursar en el pensum en electivas';
-- ccomment on column sis.t_pensum.min_cre_obligatorio is 'MInima Cantidad de unidades de créditos que se deben cursar en el pensum en unidades obligatorias';
-- colocar a min_can_electiva, min_cre-electriva y min_cre_obligatorio la sentencia 'default 0': ver como está min_can_electiva
-- la fecha de creación puede ser nula
-- la fecha de creación ponle en el check que se mayor a '01/01/1950'
-- cambiar el género de obligatorio a obligatoria es decir "min_cre_obligatorio" a "min_cre_obligatoria"

--creación de la tabla trayecto
create table sis.t_trayecto(
	codigo integer,
	cod_pensum integer not null,
	num_trayecto smallint not null,
	certificado varchar(150),
	min_cre_obligatoria smallint not null default 0,
	min_cre_electiva smallint not null default 0,
	min_cre_acreditable smallint not null default 0,
	min_can_electiva smallint not null default 0,
	constraint cp_trayecto primary key(codigo),
	constraint cf_trayecto_pensum foreign key (cod_pensum) 
		references sis.t_pensum(codigo),
	constraint ca_trayecto unique(num_trayecto,cod_pensum),
	--constraint chk_t_trayecto_01 check (cod_pensum >= 0), evaluar
	constraint chk_t_trayecto_02 check (num_trayecto >= 0), -- evaluar 
	constraint chk_t_trayecto_03 check (min_cre_obligatoria >= 0),
	constraint chk_t_trayecto_04 check (min_cre_electiva >= 0),
	constraint chk_t_trayecto_05 check (min_cre_acreditable >= 0),
	constraint chk_t_trayecto_06 check (min_can_electiva >= 0)	
);
comment on table sis.t_trayecto is 'Lista de trayectos, semestres o trimestres de un pensum';
comment on column sis.t_trayecto.codigo is 'Código único del trayecto';
comment on column sis.t_trayecto.cod_pensum is 'Código del pensum al que pertenece';
comment on column sis.t_trayecto.num_trayecto is 'Número de trayecto, año, semestre o trimestre del pensum';
comment on column sis.t_trayecto.certificado is 'Nombre del certificado que se obtiene al finalizar este trayecto';
comment on column sis.t_trayecto.min_cre_obligatoria is 'Mínima cantidad de créditos en unidades curriculares obligatorias que se deben cursar en este trayecto';
comment on column sis.t_trayecto.min_cre_electiva is 'Mínima cantidad de créditos en unidades curriculares electivas que se deben cursar en este trayecto';
comment on column sis.t_trayecto.min_cre_acreditable is 'Mínima cantidad de créditos en actividades acreditables que se deben tener en este trayecto';
comment on column sis.t_trayecto.min_can_electiva is 'Mínima cantidad de unidades electivas que se deben cursar en este trayecto';
alter table sis.t_trayecto owner to sisconot;

-- (Corregido)
-- correcciones a la tabla t_trayecto:
-- cambiar el género de obligatorio a obligatoria
-- el check cod_pensum >= 0 no es necesario porque es una forànea, y ajuro este valor debe estar en la otra tabla
-- a los campos min_cre_obligaoria, min_cre_electiva,min_cre_acreditable,min_can_electiva ponle default 0,
-- modifica los siguientes comentarios
-- ccomment on column sis.t_trayecto.min_cre_obligatorio is 'Mínima cantidad de créditos en unidades curriculares obligatorias que se deben cursar en este trayecto';
-- ccomment on column sis.t_trayecto.min_cre_electiva is 'Mínima cantidad de créditos en unidades curriculares electivas que se deben cursar en este trayecto';
-- ccomment on column sis.t_trayecto.min_cre_acreditable is 'Mínima cantidad de créditos en actividades acreditables que se deben tener en este trayecto';
-- ccomment on column sis.t_trayecto.min_can_electiva is 'Mínima cantidad de unidades electivas que se deben cursar en este trayecto';


--creación de la tabla unidad curricular
create table sis.t_uni_curricular (
	codigo integer,
	cod_uni_ministerio varchar(40),
	nombre varchar(60) not null,
	hta float not null,
	hti float,
	uni_credito smallint not null,
	dur_semanas smallint not null,
	not_min_aprobatoria smallint not null, 
	not_maxima smallint not null,
	descripcion varchar(100),
	observacion varchar(100),
	contenido text,
	constraint cp_uni_curricular primary key(codigo),
	constraint ca_uni_curricular unique (cod_uni_ministerio),
	constraint chk_uni_curricular_01 check (codigo > 0),
	constraint chk_uni_curricular_02 check (hta >= 0),
	constraint chk_uni_curricular_03 check (hti >= 0),
	constraint chk_uni_curricular_04 check (uni_credito >= 0),
	constraint chk_uni_curricular_05 check (dur_semanas >= 0),
	constraint chk_uni_curricular_06 check (not_min_aprobatoria >= 0),
	constraint chk_uni_curricular_07 check (not_maxima >= not_min_aprobatoria)
--	constraint chk_uni_curricular_08 check (not_maxima >= 0),
--	constraint chk_uni_curricular_09 check ((not_min_aprobatoria >= 0) and ( not_min_aprobatoria <= not_maxima))
);
comment on table sis.t_uni_curricular is 'Tabla que almacena la información de las unidades curriculares';
comment on column sis.t_uni_curricular.codigo is 'Código único de la unidad curricular';
comment on column sis.t_uni_curricular.nombre is 'Nombre de la unidad curricular';
comment on column sis.t_uni_curricular.cod_uni_ministerio is 'Código de la unidad curricular según el ministerio';
comment on column sis.t_uni_curricular.uni_credito is 'Cantidad de unidades de crédito de la unidad curricular';
comment on column sis.t_uni_curricular.dur_semanas is 'Cantidad de semanas que dura la unidad curricular';
comment on column sis.t_uni_curricular.not_min_aprobatoria is 'Nota mínima con la que se aprueba la unidad curricular';
comment on column sis.t_uni_curricular.not_maxima is 'Nota máxima o escala de nota de la unidad curricular';
comment on column sis.t_uni_curricular.hta is 'Horas de Trabajo Acompañado por semana(horas de clase)';
comment on column sis.t_uni_curricular.hti is 'Horas de Trabajo Independiente por semana';
comment on column sis.t_uni_curricular.descripcion is 'descripcion adicional de la unidad curricular';
comment on column sis.t_uni_curricular.observacion is 'observaciones acerca de la unidad curricular';
comment on column sis.t_uni_curricular.contenido is 'contenido de la unidad curricular';
 alter table sis.t_uni_curricular owner to sisconot;


-- (Corregido)
-- correcciones a la tabla t_uni_curricular
  -- cod_uni_ministerio puede ser null
  --  el check 08 y 09 borralos porque están de más... ya estan cubiertos con el check 06 y 07
  -- ccomment on table sis.t_uni_curricular is 'Tabla que almacena la información de las unidades curriculares';


-- creación de la tabla tipo de unidad curricular
create table sis.t_tip_uni_curricular(
	codigo char(1),
	nombre varchar(30) not null,
	constraint cp_uni_cur_tipo primary key(codigo)
);
comment on table  sis.t_tip_uni_curricular is 'Almacena los distintos tipos de unidades curriculares';
comment on column sis.t_tip_uni_curricular.codigo is 'Código del tipo de unidad curricular';
comment on column sis.t_tip_uni_curricular.nombre is 'Nombre del tipo de unidad curricular';
alter table sis.t_tip_uni_curricular owner to sisconot;

-- (Corregido)
-- correcciones a la tabla t_tip_uni_curricular
-- cambiar el tipo de dato de "codigo" a char, para poder insertar las iniciales 'E','O', de electiva y obligatoria respectivamente




-- creación de la tabla t_instituto
create table sis.t_instituto(
	codigo smallint,
	nom_corto varchar(20) not null,
	nombre varchar(100) not null,
	direccion varchar(200),
	constraint cp_instituto primary key (codigo),
	constraint ca_instituto unique(nom_corto)
);
alter table sis.t_instituto owner to sisconot;

-- correcciones a la tabla t_instituto:
-- ya que te tocó hacerla porque dependes de ella, agrégale los comentarios
 


-- creación de la tabla para almacenar las prelaciones entre unidades curriculares
create table sis.t_prelacion (
	codigo integer,
	cod_pensum integer not null,
	cod_instituto integer not null,
	cod_uni_curricular integer not null,
	cod_uni_cur_prelada integer not null,
	constraint cp_prelacion primary key (codigo),
	constraint ca_prelacion unique (cod_uni_curricular, cod_uni_cur_prelada),
	constraint cf_prelacion__pensum foreign key (cod_pensum)
		references sis.t_pensum(codigo),
	constraint cf_prelacion__instituto foreign key (cod_instituto)
		references sis.t_instituto(codigo),
	constraint cf_prelacion__uni_curricular foreign key (cod_uni_curricular)
		references sis.t_uni_curricular(codigo),
	constraint cf_prelacion__uni_curricular_prelada foreign key (cod_uni_cur_prelada)
		references sis.t_uni_curricular(codigo)
);
comment on table sis.t_prelacion is 'Tabla que almacena las prelaciones entre unidades curriculares';
comment on column sis.t_prelacion.codigo is 'Código único de la prelación';
comment on column sis.t_prelacion.cod_pensum is 'Código del pensum al que pertenece la prelación';
comment on column sis.t_prelacion.cod_instituto is 'Código del instituto donde se está aplicando esta prelación';
comment on column sis.t_prelacion.cod_uni_curricular is 'Código de la unidad curricular a establecerle la prelación';
comment on column sis.t_prelacion.cod_uni_cur_prelada is 'Código de la unidad que no se puede cursar si no se ha aprobado esta';
alter table sis.t_prelacion owner to sisconot;

-- (Corregido)
-- correcciones a la tabla t_prelacion:
-- la clave alternativa es: cod_pensum, con_instituto, cod_uni_curricular, cod_uni_cur_prelada... o sea todas a la vez, si tienes duda del por qué entonces pregúntame
-- renombra los nombres de las restricciones:
--  cf_prelacion_01 por cf_prelacion__pensum
--  cf_prelacion_02 por cf_prelacion__instituto
--  cf_prelacion_03 por cf_prelacion__uni_curricular
--  cf_prelacion_04 por cf_prelacion__uni_curricular_prelada
-- comentarios:
-- ccomment on column sis.t_prelacion.codigo is 'Código único de la prelación'; -- ya estaba?
-- ccomment on column sis.t_prelacion.cod_pensum is 'Código del pensum al que pertenece la prelación';
-- ccomment on column sis.t_prelacion.cod_instituto is 'Código del instituto donde se está aplicando esta prelación';

--creación de la tabla relacional para malla t_uni_tra_pensum
create table sis.t_uni_tra_pensum(
	codigo integer,
	cod_pensum integer not null,
	cod_trayecto integer not null,
	cod_uni_curricular integer not null,
	cod_tipo char(1),
	constraint cp_uni_tra_pensum primary key (codigo),
	constraint cf_uni_tra_pensum__pensum foreign key(cod_pensum)
		references sis.t_pensum(codigo),
	constraint cf_uni_tra_pensum__trayecto foreign key(cod_trayecto)
		references sis.t_trayecto(codigo),
 	constraint cf_uni_tra_pensum__uni_curricular foreign key(cod_uni_curricular)
		references sis.t_uni_curricular(codigo),
	constraint cf_uni_tra_pensum__tip_uni_curricular foreign key(cod_tipo)
		references sis.t_tip_uni_curricular(codigo)
);
comment on table sis.t_uni_tra_pensum is 'Tabla relacional entre unidad , trayecto y pensum para malla';
comment on column sis.t_uni_tra_pensum.codigo is 'Código del pensum';
comment on column sis.t_uni_tra_pensum.cod_pensum is 'Nombre largo del pensum';
comment on column sis.t_uni_tra_pensum.cod_trayecto is 'Abreviación del nombre del pensum';
comment on column sis.t_uni_tra_pensum.cod_tipo is 'Alguna otra información relevante del pensum';
alter table sis.t_uni_tra_pensum owner to sisconot;

-- (Corregido)
-- correcciones a la tabla uni_tra_pensum
-- cambiar tipo de dato de cod_tipo a char
-- cod_pensum, cod_uni_curricular, cod_tipo son NOT NULL,
-- EN LOS COMENTARIOS COPIASTE Y PEGASTE Y NO CAMBIASTE LA DESCRIPCION DE LOS CAMPOS

-- detalles importantes
--  no colocar not nulls cuando estában indicados en el MER, y viceversa
--  copiar y pegar comentarios sin revisarlos después
--  no seguir las convenciones en los nombres de restricciones de las tablas, específicamente, las foraneas
--	colocar claves alternativas erradas

-- NOTA: PRIMERA ENTREGA, PESO 5, NOTA 14. SEGUNDA ENTREGA, PESO 15    
    

