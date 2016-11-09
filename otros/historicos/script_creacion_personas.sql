


correcciones a la tabla instituto:
   Ya que rafael también la necesitaba la colocó en su script... quítalo del tuyo


create table sis.t_archivo(
	codigo integer not null,
	tipo varchar(30),
	archivo oid,
	constraint cp_archivo primary key(codigo)
);
alter table sis.t_archivo owner to sisconot;

correcciones a la tabla t_archivo
   colocarle los comentarios tanto la tabla como a sus campos
   

   
   


--tabla persona, padre de t_estudiante y t_empleado
create table sis.t_persona(
	codigo integer not null,
	cedula integer not null,
	rif varchar(20),
	nombre1 varchar(20) not null,
	nombre2 varchar(20),
	apellido1 varchar(20) not null,
	apellido2 varchar(20),
	sexo varchar(1) not null,
	fec_nacimiento date,
	tip_sangre varchar(5),
	telefono1 varchar(15),
	telefono2 varchar(15),
	cor_personal varchar(50),
	cor_institucional varchar(50),
	direccion varchar(150),
	discapacidad varchar(50),
	nacionalidad varchar(1),
	hijos integer,
	est_civil varchar(1),
	observaciones varchar(200),
	cod_foto integer,
	constraint cp_persona primary key(codigo),
	constraint cf_persona__archivo foreign key(cod_foto)
		references sis.t_archivo(codigo),
	constraint ca_persona_01 unique(cedula),
	constraint ca_persona_02 unique(rif),
	constraint ca_persona_03 unique(cor_personal),
	constraint ca_persona_04 unique (cor_institucional),
	constraint chk_persona_01 check (fec_nacimiento>='01/01/1940' and fec_nacimiento<= current_date),
	constraint chk_persona_02 check (sexo in ('M','F')),
	constraint chk_persona_03 check (nacionalidad in ('V','E')),
	constraint chk_persona_04 check (est_civil in ('S','C','D','V','O'))
);
alter table sis.t_persona owner to sisconot;
correcciones a la tabla persona
FALTAN LOS COMENTARIOS DE LAS TABLAS Y CAMPOS MAS IMPORTANTES... VE EL SCRIPT DE RAFAEL: EJEMPLOS
     SEXO: PARA DEFINIR M y f
     NACIONALIDAD PARA DEFIINIR V y E
     ESTADO CIVIL PARA DEFINIR LOS CINCO ESTADOS (O=OTROS)
codigo: no hace falta el not null ya que es primary key
hijos: colocale check hijos mayor o igual a cero

IMPORTANTE: PARA QUE EL SCRIPT CORRA CONTINUO DEBES COLOCAR LA CREACION DE LA TABLA T_ARCHIVO ANTES DE LA
TABLA T_PERSONA, PORQUE CUANDO VA A CREAR T_PERSONA, ESTA TIENE UNA FORANEA A T_ARCHIVO Y ENTONCES COMO 
NO ESTÁ CREADA SE VA A PARAR EL SCRIPT.



--creacion de la tabla para el estado del docente: activo, retirado, jubilado... etc
create table sis.t_est_docente(
	codigo char not null,
	nombre varchar(40) not null,
	constraint cp_est_docente primary key(codigo)
);
--alter table sis.t_est_docente owner to usuarioscn;


--creación de la tabla empleado
create table sis.t_empleado(
	 codigo integer,
	 cod_persona integer not null,
	 cod_instituto integer,
	 cod_pensum integer,
	 cod_estado varchar(1),
	 fec_inicio date NOT NULL,
	 fec_fin date,
	 es_jef_pensum boolean not null default false,
	 es_jec_con_estudio boolean not null,
	 es_ministerio boolean not null,
	 es_docente boolean not null,
	 observaciones varchar(200),
	constraint cp_empleado primary key(codigo),
	constraint cf_empleado__persona foreign key(cod_persona)
		references sis.t_persona(codigo),
	constraint cf_empleado__est_docente foreign key(cod_estado)
		references sis.t_est_docente(codigo),
	constraint cf_empleado__instituto foreign key(cod_instituto)
		references sis.t_instituto(codigo),
	constraint cf_empleado__pensum foreign key(cod_pensum)
		references sis.t_pensum(codigo),
	constraint chk_empleado_01 check (fec_fin>fec_inicio)	
);
alter table sis.t_empleado owner to sisconot;
colocarlo los comentarios a la tabla y a los campos
cambiar es_jec_con_estudio por es_jef_con_estudio (cambiar la C por la F)
colocarle a los campos es_jef_pensum, es_jef_con_estudio, es_ministerio, es_docente
   la clausula default false, (ver el ejemplo de "es_jef_pensum")
restricciones check
    fecha_inicio > 1/1/1970
FALTA LA CLAVE ALTERNATIVA SIGUIENTE:
   (cod_persona, cod_instituto, cod_pensum, fec_inicio) ==> todas en una sola


--tabla para el manejo del estado de un estudiante: activo, retirado, graduado... etc 
create table sis.t_est_estudiante(
	codigo char not null,
	nombre varchar(20) not null,
	constraint cp_est_estudiante primary key(codigo)
);
alter table sis.t_est_estudiante owner to sisconot;



--tabla estudiante
create table sis.t_estudiante(
	codigo integer,  
	cod_persona integer not null,
	cod_instituto integer not null,
	cod_pensum integer not null,
	num_carnet varchar(25),
	num_expediente varchar(25),
	cod_rusnies varchar(20),
	cod_estado char,
	fec_inicio date not ,
	condicion varchar(5),
	fec_fin date,
	observaciones varchar (200),
	constraint cp_estudiante primary key(codigo),
	constraint cf_estudiante__persona foreign key(cod_persona)
		references sis.t_persona(codigo),
	constraint cf_estudiante__est_estado foreign key(cod_estado)
		references sis.t_est_estudiante(codigo), 
	constraint cf_estudiante__instituto foreign key(cod_instituto)
		references sis.t_instituto(codigo),
	constraint cf_estudiante__pensum foreign key(cod_pensum)
		references sis.t_pensum(codigo),
	constraint ca_estudiante_01 unique(num_carnet),
	constraint ca_estudiante_02 unique(num_expediente),
	constraint ca_estudiante_03 unique(cod_rusnies),
	constraint chk_docente_01 check (fec_fin>fec_inicio)
);
--alter table sis.t_estudiante owner to usuarioscn;
correcciones a la tabla t_estudiante
faltan los comentarios de la tabla y de los campos... ver script de rafael..
    cuidar bien la redacción de estos comentarios ya que queda sólo una entrega.
fic_inicio es not null (sólo aparece el not).
falta la clave alternativa compuesta (cod_persona, cod_instituto, cod_pensum, fec_inicio)
falta restricción fec_inicio > 1/1/1970



Resumen general
    FALTAN COMENTARIOS A TODAS LAS TABLAS Y CAMPOS
    ya las tablas empleados y estudiantes no son hijas de personas, son tablas de movimientos históricos y de estados    
    evidencia desconocimiento de las claves alternativas compuestas
    
NOTA: PRIMERA ENTREGA, PESO 5, NOTA 11. 
      SEGUNDA ENTREGA, PESO 15, Nota: por evaluar.
      
    
