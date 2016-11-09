/*Script de creación de la base de datos del Sistema de Control de Notas
--Creado por Johan Alamo y estudiantes de proyecto sociotecnológico
--Comenzado en 2012
--Dpto de informática del IUT-RC "Dr. Federico Rivero Palacio"

Última versión
frebrero de 2016.
Participantes:
Tutor/coordinador: Johan Alamo  (johan.alamo@gmail.com)
Crado por: rafael
Estudiantes participantes en la versión final:
	De Sousa, Juan
	García, Rafael
	Sosa, Jean Pierre
*/

-- CREACION DE LA BASE DE DATOS   *********************************************
\connect postgres;

-- consulta para limpiar el buffer, no borrar.
select 'consulta para limpiar el buffer, no borrar.' as resultado;

-- Borrar la base de datos en caso de existir
drop database  bd_sisconot;

drop user sisconot;
create user sisconot password '123';


-- Crear de nuevo la base de datos
CREATE DATABASE bd_sisconot WITH OWNER = sisconot ENCODING = 'UTF8' CONNECTION LIMIT = -1;

--cambia el formato de la fecha a Dia/mes/año para consulta e insercion
alter database bd_sisconot SET DateStyle to 'sql,dmy';


-- Conectarse a la nueva base de datos
\connect bd_sisconot;

--crear el esquema de las tablas del sistema  ****************************************************
create schema sis;

alter schema sis owner to sisconot;
grant usage on schema sis to sisconot;

alter schema public owner to sisconot;
grant usage on schema public to sisconot;


/*----------------------------------------TABLAS DEL SISTEMA------------------------------------------------ --*/

/* */

CREATE TABLE sis.t_instituto (
    codigo smallint NOT NULL,
    nom_corto character varying(20) NOT NULL,
    nombre character varying(100) NOT NULL,
    direccion character varying(200)
);

ALTER TABLE sis.t_instituto OWNER TO sisconot;

COMMENT ON TABLE sis.t_instituto IS 'Tabla que almacena la información básica de los institutos universitarios y/o universidades';
COMMENT ON COLUMN sis.t_instituto.codigo IS 'Código del registro que identifica al instituto';
COMMENT ON COLUMN sis.t_instituto.nom_corto IS 'Nombre corto del instituto, también es una llave alternativa';
COMMENT ON COLUMN sis.t_instituto.nombre IS 'Nombre largo del instituto.';
COMMENT ON COLUMN sis.t_instituto.direccion IS 'Ubicación geográfica del instituto';


CREATE TABLE sis.t_pensum (
    codigo integer NOT NULL,
    nombre character varying(50) NOT NULL,
    nom_corto character varying(20) NOT NULL,
    observaciones character varying(200),
    min_can_electiva smallint DEFAULT 0 NOT NULL,
    min_cre_electiva smallint DEFAULT 0 NOT NULL,
    min_cre_obligatoria smallint DEFAULT 0 NOT NULL,
    fec_creacion date,
    CONSTRAINT chk_t_pensum_01 CHECK ((min_can_electiva >= 0)),
    CONSTRAINT chk_t_pensum_02 CHECK ((min_cre_electiva >= 0)),
    CONSTRAINT chk_t_pensum_03 CHECK ((min_cre_obligatoria >= 0)),
    CONSTRAINT chk_t_pensum_04 CHECK ((fec_creacion >= '1950-01-01'::date))
);


ALTER TABLE sis.t_pensum OWNER TO sisconot;

COMMENT ON TABLE sis.t_pensum IS 'Tabla padre de un pensum';
COMMENT ON COLUMN sis.t_pensum.codigo IS 'Código del pensum';
COMMENT ON COLUMN sis.t_pensum.nombre IS 'Nombre largo del pensum';
COMMENT ON COLUMN sis.t_pensum.nom_corto IS 'Abreviación del nombre del pensum';
COMMENT ON COLUMN sis.t_pensum.observaciones IS 'Alguna otra información relevante del pensum';
COMMENT ON COLUMN sis.t_pensum.min_can_electiva IS 'Minima Cantidad de Electivas que se deben cursar en el pesum';
COMMENT ON COLUMN sis.t_pensum.min_cre_electiva IS 'MInima Cantidad de unidades de créditos que se deben cursar en el pensum en unidades obligatorias';
COMMENT ON COLUMN sis.t_pensum.min_cre_obligatoria IS 'MInima Cantidad de Creditos de Electivas Obligatorios';
COMMENT ON COLUMN sis.t_pensum.fec_creacion IS 'Fecha de creacion del pensum';


CREATE TABLE sis.t_prelacion (
    codigo integer NOT NULL,
    cod_pensum integer NOT NULL,
    cod_instituto integer NOT NULL,
    cod_uni_curricular integer NOT NULL,
    cod_uni_cur_prelada integer NOT NULL
);


ALTER TABLE sis.t_prelacion OWNER TO sisconot;


COMMENT ON TABLE sis.t_prelacion IS 'Tabla que almacena las prelaciones entre unidades curriculares';
COMMENT ON COLUMN sis.t_prelacion.codigo IS 'Código único de la prelación';
COMMENT ON COLUMN sis.t_prelacion.cod_pensum IS 'Código del pensum al que pertenece la prelación';
COMMENT ON COLUMN sis.t_prelacion.cod_instituto IS 'Código del instituto donde se está aplicando esta prelación';
COMMENT ON COLUMN sis.t_prelacion.cod_uni_curricular IS 'Código de la unidad curricular a establecerle la prelación';
COMMENT ON COLUMN sis.t_prelacion.cod_uni_cur_prelada IS 'Código de la unidad que no se puede cursar si no se ha aprobado esta';

CREATE TABLE sis.t_tip_uni_curricular (
    codigo character(1) NOT NULL,
    nombre character varying(30) NOT NULL
);


ALTER TABLE sis.t_tip_uni_curricular OWNER TO sisconot;

COMMENT ON TABLE sis.t_tip_uni_curricular IS 'Almacena los distintos tipos de unidades curriculares';
COMMENT ON COLUMN sis.t_tip_uni_curricular.codigo IS 'Código del tipo de unidad curricular';
COMMENT ON COLUMN sis.t_tip_uni_curricular.nombre IS 'Nombre del tipo de unidad curricular';


CREATE TABLE sis.t_trayecto (
    codigo integer NOT NULL,
    cod_pensum integer NOT NULL,
    num_trayecto smallint NOT NULL,
    certificado character varying(150),
    min_cre_obligatoria smallint DEFAULT 0 NOT NULL,
    min_cre_electiva smallint DEFAULT 0 NOT NULL,
    min_cre_acreditable smallint DEFAULT 0 NOT NULL,
    min_can_electiva smallint DEFAULT 0 NOT NULL,
    CONSTRAINT chk_t_trayecto_02 CHECK ((num_trayecto >= 0)),
    CONSTRAINT chk_t_trayecto_03 CHECK ((min_cre_obligatoria >= 0)),
    CONSTRAINT chk_t_trayecto_04 CHECK ((min_cre_electiva >= 0)),
    CONSTRAINT chk_t_trayecto_05 CHECK ((min_cre_acreditable >= 0)),
    CONSTRAINT chk_t_trayecto_06 CHECK ((min_can_electiva >= 0))
);


ALTER TABLE sis.t_trayecto OWNER TO sisconot;

COMMENT ON TABLE sis.t_trayecto IS 'Lista de trayectos, semestres o trimestres de un pensum';
COMMENT ON COLUMN sis.t_trayecto.codigo IS 'Código único del trayecto';
COMMENT ON COLUMN sis.t_trayecto.cod_pensum IS 'Código del pensum al que pertenece';
COMMENT ON COLUMN sis.t_trayecto.num_trayecto IS 'Número de trayecto, año, semestre o trimestre del pensum';
COMMENT ON COLUMN sis.t_trayecto.certificado IS 'Nombre del certificado que se obtiene al finalizar este trayecto';
COMMENT ON COLUMN sis.t_trayecto.min_cre_obligatoria IS 'Mínima cantidad de créditos en unidades curriculares obligatorias que se deben cursar en este trayecto';
COMMENT ON COLUMN sis.t_trayecto.min_cre_electiva IS 'Mínima cantidad de créditos en unidades curriculares electivas que se deben cursar en este trayecto';
COMMENT ON COLUMN sis.t_trayecto.min_cre_acreditable IS 'Mínima cantidad de créditos en actividades acreditables que se deben tener en este trayecto';
COMMENT ON COLUMN sis.t_trayecto.min_can_electiva IS 'Mínima cantidad de unidades electivas que se deben cursar en este trayecto';


CREATE TABLE sis.t_uni_curricular (
    codigo integer NOT NULL,
    cod_uni_ministerio character varying(40),
    nombre character varying(60) NOT NULL,
    hta double precision NOT NULL,
    hti double precision,
    uni_credito smallint NOT NULL,
    dur_semanas smallint NOT NULL,
    not_min_aprobatoria smallint NOT NULL,
    not_maxima smallint NOT NULL,
    descripcion character varying(100),
    observacion character varying(100),
    contenido text,
    CONSTRAINT chk_uni_curricular_01 CHECK ((codigo > 0)),
    CONSTRAINT chk_uni_curricular_02 CHECK ((hta >= (0)::double precision)),
    CONSTRAINT chk_uni_curricular_03 CHECK ((hti >= (0)::double precision)),
    CONSTRAINT chk_uni_curricular_04 CHECK ((uni_credito >= 0)),
    CONSTRAINT chk_uni_curricular_05 CHECK ((dur_semanas >= 0)),
    CONSTRAINT chk_uni_curricular_06 CHECK ((not_min_aprobatoria >= 0)),
    CONSTRAINT chk_uni_curricular_07 CHECK ((not_maxima >= not_min_aprobatoria))
);


ALTER TABLE sis.t_uni_curricular OWNER TO sisconot;


COMMENT ON TABLE sis.t_uni_curricular IS 'Tabla que almacena la información de las unidades curriculares';
COMMENT ON COLUMN sis.t_uni_curricular.codigo IS 'Código único de la unidad curricular';
COMMENT ON COLUMN sis.t_uni_curricular.cod_uni_ministerio IS 'Código de la unidad curricular según el ministerio';
COMMENT ON COLUMN sis.t_uni_curricular.nombre IS 'Nombre de la unidad curricular';
COMMENT ON COLUMN sis.t_uni_curricular.hta IS 'Horas de Trabajo Acompañado por semana(horas de clase)';
COMMENT ON COLUMN sis.t_uni_curricular.hti IS 'Horas de Trabajo Independiente por semana';
COMMENT ON COLUMN sis.t_uni_curricular.uni_credito IS 'Cantidad de unidades de crédito de la unidad curricular';
COMMENT ON COLUMN sis.t_uni_curricular.dur_semanas IS 'Cantidad de semanas que dura la unidad curricular';
COMMENT ON COLUMN sis.t_uni_curricular.not_min_aprobatoria IS 'Nota mínima con la que se aprueba la unidad curricular';
COMMENT ON COLUMN sis.t_uni_curricular.not_maxima IS 'Nota máxima o escala de nota de la unidad curricular';
COMMENT ON COLUMN sis.t_uni_curricular.descripcion IS 'descripcion adicional de la unidad curricular';
COMMENT ON COLUMN sis.t_uni_curricular.observacion IS 'observaciones acerca de la unidad curricular';
COMMENT ON COLUMN sis.t_uni_curricular.contenido IS 'contenido de la unidad curricular';


CREATE TABLE sis.t_uni_tra_pensum (
    codigo integer NOT NULL,
    cod_pensum integer NOT NULL,
    cod_trayecto integer,
    cod_uni_curricular integer NOT NULL,
    cod_tipo character(1) NOT NULL
);


ALTER TABLE sis.t_uni_tra_pensum OWNER TO sisconot;

COMMENT ON TABLE sis.t_uni_tra_pensum IS 'Tabla relacional entre unidad , trayecto y pensum para malla';
COMMENT ON COLUMN sis.t_uni_tra_pensum.codigo IS 'Código del pensum';
COMMENT ON COLUMN sis.t_uni_tra_pensum.cod_pensum IS 'Nombre largo del pensum';
COMMENT ON COLUMN sis.t_uni_tra_pensum.cod_trayecto IS 'Abreviación del nombre del pensum';
COMMENT ON COLUMN sis.t_uni_tra_pensum.cod_tipo IS 'Alguna otra información relevante del pensum';

/************ PIPO *****************/


CREATE TABLE sis.t_archivo (
    codigo integer NOT NULL,
    tipo character varying(30),
    archivo oid
);


ALTER TABLE sis.t_archivo OWNER TO sisconot;

COMMENT ON TABLE sis.t_archivo IS 'En la tabla Archivo se manejan las fotos de las personas';
COMMENT ON COLUMN sis.t_archivo.codigo IS 'Codigo unico con el que se identifica un archivo';
COMMENT ON COLUMN sis.t_archivo.tipo IS 'Tipo de archivo';
COMMENT ON COLUMN sis.t_archivo.archivo IS 'Es en donde va estar almacenada la imagen/archivo';

CREATE TABLE sis.t_empleado (
    codigo integer NOT NULL,
    cod_persona integer NOT NULL,
    cod_instituto integer,
    cod_pensum integer,
    cod_estado character varying(1),
    fec_inicio date NOT NULL,
    fec_fin date,
    es_jef_pensum boolean DEFAULT false NOT NULL,
    es_jef_con_estudio boolean DEFAULT false NOT NULL,
    es_ministerio boolean DEFAULT false NOT NULL,
    es_docente boolean DEFAULT false NOT NULL,
    observaciones character varying(200),
    CONSTRAINT chk_empleado_01 CHECK ((fec_fin > fec_inicio)),
    CONSTRAINT chk_empleado_02 CHECK ((fec_inicio > '1970-01-01'::date))
);


ALTER TABLE sis.t_empleado OWNER TO sisconot;

COMMENT ON TABLE sis.t_empleado IS 'La tabla empleado almacena la informacion de los empledos';
COMMENT ON COLUMN sis.t_empleado.codigo IS 'Es el codigo unico con el que se identifica un empleado';
COMMENT ON COLUMN sis.t_empleado.cod_persona IS 'Codigo de la persona con la que esta relacionada';
COMMENT ON COLUMN sis.t_empleado.cod_instituto IS 'Codigo del instituto al que pertenece';
COMMENT ON COLUMN sis.t_empleado.cod_pensum IS 'Codigo del pensum a la que pertenece';
COMMENT ON COLUMN sis.t_empleado.cod_estado IS 'Codigo del estado que posee el empleado';
COMMENT ON COLUMN sis.t_empleado.fec_inicio IS 'Fecha en la que el empleado empezo a trabajar';
COMMENT ON COLUMN sis.t_empleado.fec_fin IS 'Fecha en la que el empleado termino de trabajar';
COMMENT ON COLUMN sis.t_empleado.es_jef_pensum IS 'Dice si un empleado es un jefe de pensum';
COMMENT ON COLUMN sis.t_empleado.es_jef_con_estudio IS 'Dice si un empleado es jefe de control de estudio';
COMMENT ON COLUMN sis.t_empleado.es_ministerio IS 'Dice si un empelado trabaja en el ministerio';
COMMENT ON COLUMN sis.t_empleado.es_docente IS 'Dice si un empleado trabaja como docente';


CREATE TABLE sis.t_est_empleado (
    codigo character(1) NOT NULL,
    nombre character varying(40) NOT NULL
);


ALTER TABLE sis.t_est_empleado OWNER TO sisconot;

CREATE TABLE sis.t_est_estudiante (
    codigo character(1) NOT NULL,
    nombre character varying(20) NOT NULL
);

ALTER TABLE sis.t_est_estudiante OWNER TO sisconot;


CREATE TABLE sis.t_estudiante (
    codigo integer NOT NULL,
    cod_persona integer NOT NULL,
    cod_instituto integer NOT NULL,
    cod_pensum integer NOT NULL,
    num_carnet character varying(25),
    num_expediente character varying(25),
    cod_rusnies character varying(20),
    cod_estado character(1),
    fec_inicio date NOT NULL,
    condicion character varying(5),
    fec_fin date,
    observaciones character varying(200),
    CONSTRAINT chk_estudiante_01 CHECK ((fec_fin > fec_inicio)),
    CONSTRAINT chk_estudiante_02 CHECK ((fec_inicio > '1970-01-01'::date))
);


ALTER TABLE sis.t_estudiante OWNER TO sisconot;

COMMENT ON TABLE sis.t_estudiante IS 'La tabla estudiante almacena informacion sobre los estudiantes';
COMMENT ON COLUMN sis.t_estudiante.codigo IS 'Codigo unico con el que se identifica un estudiante';
COMMENT ON COLUMN sis.t_estudiante.cod_persona IS 'Codigo de la persona con la que se relaciona';
COMMENT ON COLUMN sis.t_estudiante.cod_instituto IS 'Codigo del instituto al que pertenece';
COMMENT ON COLUMN sis.t_estudiante.cod_pensum IS 'Codigo del pensum al que pertenece el estudiante';
COMMENT ON COLUMN sis.t_estudiante.num_carnet IS 'Numero del carnet del estudiante';
COMMENT ON COLUMN sis.t_estudiante.num_expediente IS 'Numero del expediente del estudiante';
COMMENT ON COLUMN sis.t_estudiante.cod_rusnies IS 'Codigo rusnies que tiene el estudiante';
COMMENT ON COLUMN sis.t_estudiante.cod_estado IS 'Codigo del estado que posee el estudiante';
COMMENT ON COLUMN sis.t_estudiante.fec_inicio IS 'Fecha en el que el estudiante empezo a estudiar';
COMMENT ON COLUMN sis.t_estudiante.condicion IS 'Condicion que posee el estudiante';
COMMENT ON COLUMN sis.t_estudiante.fec_fin IS 'Fecha en la que el estudiante dejo de estudiar';
COMMENT ON COLUMN sis.t_estudiante.observaciones IS 'Observaciones sobre el estudiante';


CREATE TABLE sis.t_persona (
    codigo integer NOT NULL,
    cedula integer NOT NULL,
    rif character varying(20),
    nombre1 character varying(20) NOT NULL,
    nombre2 character varying(20),
    apellido1 character varying(20) NOT NULL,
    apellido2 character varying(20),
    sexo character varying(1) NOT NULL,
    fec_nacimiento date,
    tip_sangre character varying(5),
    telefono1 character varying(15),
    telefono2 character varying(15),
    cor_personal character varying(50),
    cor_institucional character varying(50),
    direccion character varying(150),
    discapacidad character varying(50),
    nacionalidad character varying(1),
    hijos integer,
    est_civil character varying(1),
    observaciones character varying(200),
    cod_foto integer,
    CONSTRAINT chk_persona_01 CHECK (((fec_nacimiento >= '1940-01-01'::date) AND (fec_nacimiento <= ('now'::text)::date))),
    CONSTRAINT chk_persona_02 CHECK (((sexo)::text = ANY ((ARRAY['M'::character varying, 'F'::character varying])::text[]))),
    CONSTRAINT chk_persona_03 CHECK (((nacionalidad)::text = ANY ((ARRAY['V'::character varying, 'E'::character varying])::text[]))),
    CONSTRAINT chk_persona_04 CHECK (((est_civil)::text = ANY ((ARRAY['S'::character varying, 'C'::character varying, 'D'::character varying, 'V'::character varying, 'O'::character varying])::text[]))),
    CONSTRAINT chk_persona_05 CHECK ((hijos >= 0))
);


ALTER TABLE sis.t_persona OWNER TO sisconot;



COMMENT ON TABLE sis.t_persona IS 'La tabla persona almacena la informacion general de las personas';
COMMENT ON COLUMN sis.t_persona.codigo IS 'Es el codigo unico que solo pertecene a una persona';
COMMENT ON COLUMN sis.t_persona.cedula IS 'Documento de identidad de la persona';
COMMENT ON COLUMN sis.t_persona.nombre1 IS 'El primer nombre de la persona';
COMMENT ON COLUMN sis.t_persona.apellido1 IS 'El primer apellido de la persona';
COMMENT ON COLUMN sis.t_persona.fec_nacimiento IS 'Es la fecha en la que nacio la persona';
COMMENT ON COLUMN sis.t_persona.tip_sangre IS 'Es el tipo de sangre que tiene la persona';
COMMENT ON COLUMN sis.t_persona.telefono1 IS 'Es un numero telefonico a donde se puede contactar a la persona';
COMMENT ON COLUMN sis.t_persona.cor_personal IS 'Es el correo electronico que tiene una persona';
COMMENT ON COLUMN sis.t_persona.direccion IS 'Es la direccion de habitacion de la persona';
COMMENT ON COLUMN sis.t_persona.discapacidad IS 'Informacion sobre la discapacidad que tiene la persona';
COMMENT ON COLUMN sis.t_persona.nacionalidad IS 'Es la nacionalidad de la persona es decir Venezolano o extrangero';
COMMENT ON COLUMN sis.t_persona.hijos IS 'Es la cantidad de hijos que tiene la persona';
COMMENT ON COLUMN sis.t_persona.est_civil IS 'Es el estado civil que tiene la persona';
COMMENT ON COLUMN sis.t_persona.observaciones IS 'Alguna observacion que se le haga a una persona';
COMMENT ON COLUMN sis.t_persona.cod_foto IS 'Es la clave foranea de la tabla archivo que es en donde esta almacenada la foto de la persona';



/************ JUAN **************/



CREATE TABLE sis.t_acreditable (
    codigo integer NOT NULL,
    cod_estudiante integer NOT NULL,
    cod_pensum integer NOT NULL,
    cod_trayecto integer,
    uni_credito integer NOT NULL,
    fecha date,
    descripcion character varying(300) NOT NULL,
    CONSTRAINT chk_acreditable_01 CHECK ((uni_credito >= 0))
);


ALTER TABLE sis.t_acreditable OWNER TO sisconot;

COMMENT ON TABLE sis.t_acreditable IS 'Tabla que maneja las unidades de crédito acreditadas por un estudiante.';
COMMENT ON COLUMN sis.t_acreditable.codigo IS 'Código de la acreditación.';
COMMENT ON COLUMN sis.t_acreditable.cod_estudiante IS 'Código del estudiante que acreditó.';
COMMENT ON COLUMN sis.t_acreditable.cod_pensum IS 'Código del pensum en el que acreditó.';
COMMENT ON COLUMN sis.t_acreditable.cod_trayecto IS 'Código del trayecto en el que se formalizará la acreditación. Si este es null se tomará en cuenta para la carrera.';
COMMENT ON COLUMN sis.t_acreditable.uni_credito IS 'Cantidad de unidades de crédito a acreditarse.';
COMMENT ON COLUMN sis.t_acreditable.fecha IS 'Fecha en la que se produjo la acreditación.';
COMMENT ON COLUMN sis.t_acreditable.descripcion IS 'Descripción obligatoria de la acreditación. Motivo de la misma.';


CREATE TABLE sis.t_convalidacion (
    codigo integer NOT NULL,
    cod_estudiante integer NOT NULL,
    con_nota boolean,
    nota double precision,
    fecha date NOT NULL,
    cod_tip_uni_curricular character(1),
    cod_pensum integer NOT NULL,
    cod_trayecto integer,
    cod_uni_curricular integer NOT NULL,
    descripcion character varying(300),
    CONSTRAINT chk_convalidacion_01 CHECK ((nota >= (0)::double precision)),
    CONSTRAINT chk_convalidacion_02 CHECK ((fecha > '1970-01-01'::date) and ( fecha <= ('now'::text)::date))
);

ALTER TABLE sis.t_convalidacion OWNER TO sisconot;

COMMENT ON TABLE sis.t_convalidacion IS 'Tabla encargada de manejar las convalidaciones de un estudiante en un pensum.';
COMMENT ON COLUMN sis.t_convalidacion.codigo IS 'Código de la convalidación.';
COMMENT ON COLUMN sis.t_convalidacion.cod_estudiante IS 'Código foráneo que indica el estudiante que convalidará.';
COMMENT ON COLUMN sis.t_convalidacion.con_nota IS 'Boolean que indica si la convalidación lleva (o no) nota.';
COMMENT ON COLUMN sis.t_convalidacion.nota IS 'Nota con la que se convalidará (puede ser NULL o estar vacío)';
COMMENT ON COLUMN sis.t_convalidacion.cod_tip_uni_curricular IS 'Tipo de unidad curricular a validar';
COMMENT ON COLUMN sis.t_convalidacion.cod_pensum IS 'Código del pensum en el que se va a convalidar.';
COMMENT ON COLUMN sis.t_convalidacion.cod_trayecto IS 'Código del trayecto en el que se tomará la convalidación.';
COMMENT ON COLUMN sis.t_convalidacion.cod_uni_curricular IS 'Código de la unidad curricular que se convalidará.';
COMMENT ON COLUMN sis.t_convalidacion.descripcion IS 'Descripción de la convalidación (opcional)';






CREATE SEQUENCE sis.s_cur_estudiante
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE sis.s_cur_estudiante OWNER TO sisconot;
CREATE TABLE sis.t_cur_estudiante (
    codigo integer DEFAULT nextval('sis.s_cur_estudiante'::regclass) NOT NULL,
    cod_curso integer NOT NULL,
    cod_estudiante integer NOT NULL,
    por_asistencia double precision,
    nota double precision,
    cod_estado character(1),
    observaciones character varying(300),
    CONSTRAINT chk_cur_estudiante_01 CHECK ((nota >= (0)::double precision)),
    CONSTRAINT chk_cur_estudiante_02 CHECK ((por_asistencia >= (0)::double precision))
);

ALTER TABLE sis.t_cur_estudiante OWNER TO sisconot;

COMMENT ON TABLE sis.t_cur_estudiante IS 'Tabla encargada de manejar la información de un estudiante en un curso.';
COMMENT ON COLUMN sis.t_cur_estudiante.codigo IS 'Código único del registro, llave primaria';
COMMENT ON COLUMN sis.t_cur_estudiante.cod_curso IS 'Código del curso en el que está el estudiante.';
COMMENT ON COLUMN sis.t_cur_estudiante.cod_estudiante IS 'Código del estudiante al que se hace referencia.';
COMMENT ON COLUMN sis.t_cur_estudiante.por_asistencia IS 'Porcentaje de asistencia del estudiante en el curso.';
COMMENT ON COLUMN sis.t_cur_estudiante.nota IS 'Nota del estudiante en el curso.';
COMMENT ON COLUMN sis.t_cur_estudiante.cod_estado IS 'Estado del estudiante en el curso.';
COMMENT ON COLUMN sis.t_cur_estudiante.observaciones IS 'Observaciones del estudiante en el curso.';







CREATE SEQUENCE sis.s_curso
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE sis.s_curso OWNER TO sisconot;
CREATE TABLE sis.t_curso (
    codigo integer DEFAULT nextval('sis.s_curso'::regclass) NOT NULL,
    cod_periodo integer NOT NULL,
    cod_uni_curricular integer NOT NULL,
    cod_docente integer,
    seccion character varying(5) NOT NULL,
    fec_inicio date,
    fec_final date,
    capacidad smallint,
    observaciones character varying(300),
    cod_estado character(1),
    CONSTRAINT chk_curso_01 CHECK ((fec_inicio < fec_final)),
    CONSTRAINT chk_curso_02 CHECK ((capacidad >= 0)),
    CONSTRAINT chk_curso_03 CHECK ((length(btrim((seccion)::text)) > 0))
);

ALTER TABLE sis.t_curso OWNER TO sisconot;

COMMENT ON TABLE sis.t_curso IS 'Tabla encargada de manejar los cursos abiertos de una unidad curricular.';
COMMENT ON COLUMN sis.t_curso.codigo IS 'Código del curso';
COMMENT ON COLUMN sis.t_curso.cod_periodo IS 'Código del periodo al que pertenece el curso.';
COMMENT ON COLUMN sis.t_curso.cod_uni_curricular IS 'Código de la unidad curricular que se dictará en el curso.';
COMMENT ON COLUMN sis.t_curso.cod_docente IS 'Código del docente que dictará el curso.';
COMMENT ON COLUMN sis.t_curso.seccion IS 'Sección a la que pertenece el curso.';
COMMENT ON COLUMN sis.t_curso.fec_inicio IS 'Fecha de inicio del curso.';
COMMENT ON COLUMN sis.t_curso.fec_final IS 'Fecha de finalización del curso.';
COMMENT ON COLUMN sis.t_curso.capacidad IS 'Cantidad máxima de estudiantes que se pueden aceptar en el curso.';
COMMENT ON COLUMN sis.t_curso.observaciones IS 'Observaciones del curso.';
COMMENT ON COLUMN sis.t_curso.cod_estado IS 'Reservado para el estado del curso(abierto, cerrado).';


CREATE TABLE sis.t_electiva (
    codigo integer NOT NULL,
    cod_cur_estudiante integer,
    cod_pensum integer NOT NULL,
    cod_trayecto integer
);


ALTER TABLE sis.t_electiva OWNER TO sisconot;

COMMENT ON TABLE sis.t_electiva IS 'Tabla encargada de manejar las electivas atadas a un estudiante.';
COMMENT ON COLUMN sis.t_electiva.codigo IS 'Código único del registro, llave primaria';
COMMENT ON COLUMN sis.t_electiva.cod_cur_estudiante IS 'Llave foránea de curso_estudiante, se refiere al curso que respalda la electiva';
COMMENT ON COLUMN sis.t_electiva.cod_pensum IS 'Llave foránea del pensum al que pertenece la electiva.';
COMMENT ON COLUMN sis.t_electiva.cod_trayecto IS 'Llave foránea del trayecto al que pertenece la electiva.';

CREATE TABLE sis.t_est_cur_estudiante (
    codigo character(1) NOT NULL,
    nombre character varying(30)
);


ALTER TABLE sis.t_est_cur_estudiante OWNER TO sisconot;

COMMENT ON TABLE sis.t_est_cur_estudiante IS 'Tabla que maneja los estados de un estudiante dentro de un curso.';
COMMENT ON COLUMN sis.t_est_cur_estudiante.codigo IS 'Código del estado';
COMMENT ON COLUMN sis.t_est_cur_estudiante.nombre IS 'Nombre del estado';


CREATE TABLE sis.t_est_periodo (
    codigo character(1) NOT NULL,
    nombre character varying(20) NOT NULL
);


ALTER TABLE sis.t_est_periodo OWNER TO sisconot;

COMMENT ON TABLE sis.t_est_periodo IS 'Estado que determina si el periodo académico ha finalizado o no (abierto o cerrado)';
COMMENT ON COLUMN sis.t_est_periodo.codigo IS 'Código del estado.';
COMMENT ON COLUMN sis.t_est_periodo.nombre IS 'Nombre del estado del periodo académico.';


CREATE TABLE sis.t_periodo (
    codigo integer NOT NULL,
    nombre character varying(30),
    cod_instituto integer NOT NULL,
    cod_pensum integer NOT NULL,
    fec_inicio date NOT NULL,
    fec_final date,
    observaciones character varying(150),
    cod_estado character(1) NOT NULL,
    CONSTRAINT chk_periodo_01 CHECK ((codigo > 0)),
    CONSTRAINT chk_periodo_02 CHECK ((fec_inicio < fec_final))
);

ALTER TABLE sis.t_periodo OWNER TO sisconot;

COMMENT ON TABLE sis.t_periodo IS 'Tabla que almacena la información de un periodo académico.';
COMMENT ON COLUMN sis.t_periodo.codigo IS 'Código del periodo';
COMMENT ON COLUMN sis.t_periodo.nombre IS 'Nombre del periodo académico';
COMMENT ON COLUMN sis.t_periodo.cod_instituto IS 'Clave foránea del instituto que abre el periodo.';
COMMENT ON COLUMN sis.t_periodo.cod_pensum IS 'Clave foránea del pensum que se dicta en el periodo.';
COMMENT ON COLUMN sis.t_periodo.fec_inicio IS 'Fecha de inicio del periodo académico.';
COMMENT ON COLUMN sis.t_periodo.fec_final IS 'Fecha de finalización del periodo académico.';
COMMENT ON COLUMN sis.t_periodo.observaciones IS 'Observaciones del periodo académico.';
COMMENT ON COLUMN sis.t_periodo.cod_estado IS 'Estado del periodo académico (Abierto o Cerrado en el momento de creación del sistema)';


/*********       llaves alternaticas y primarias                              *********/

ALTER TABLE ONLY sis.t_instituto
    ADD CONSTRAINT ca_instituto UNIQUE (nom_corto);
ALTER TABLE ONLY sis.t_pensum
    ADD CONSTRAINT ca_pensum UNIQUE (nom_corto);
ALTER TABLE ONLY sis.t_prelacion
    ADD CONSTRAINT ca_prelacion UNIQUE (cod_uni_curricular, cod_uni_cur_prelada);
ALTER TABLE ONLY sis.t_trayecto
    ADD CONSTRAINT ca_trayecto UNIQUE (num_trayecto, cod_pensum);
ALTER TABLE ONLY sis.t_uni_curricular
    ADD CONSTRAINT ca_uni_curricular UNIQUE (cod_uni_ministerio);

ALTER TABLE ONLY sis.t_empleado
    ADD CONSTRAINT ca_empleado UNIQUE (cod_persona, cod_instituto, cod_pensum, fec_inicio);
ALTER TABLE ONLY sis.t_estudiante
    ADD CONSTRAINT ca_estudiante UNIQUE (cod_persona, cod_instituto, cod_pensum, fec_inicio);
ALTER TABLE ONLY sis.t_estudiante
    ADD CONSTRAINT ca_estudiante_01 UNIQUE (num_carnet);
ALTER TABLE ONLY sis.t_estudiante
    ADD CONSTRAINT ca_estudiante_02 UNIQUE (num_expediente);
ALTER TABLE ONLY sis.t_estudiante
    ADD CONSTRAINT ca_estudiante_03 UNIQUE (cod_rusnies);
ALTER TABLE ONLY sis.t_persona
    ADD CONSTRAINT ca_persona_01 UNIQUE (cedula);
ALTER TABLE ONLY sis.t_persona
    ADD CONSTRAINT ca_persona_02 UNIQUE (rif);
ALTER TABLE ONLY sis.t_persona
    ADD CONSTRAINT ca_persona_03 UNIQUE (cor_personal);
ALTER TABLE ONLY sis.t_persona
    ADD CONSTRAINT ca_persona_04 UNIQUE (cor_institucional);

ALTER TABLE ONLY sis.t_convalidacion
    ADD CONSTRAINT ca_convalidacion_01 UNIQUE (cod_estudiante, cod_pensum, cod_uni_curricular);
ALTER TABLE ONLY sis.t_cur_estudiante
    ADD CONSTRAINT ca_cur_estudiante UNIQUE (cod_curso, cod_estudiante);
ALTER TABLE ONLY sis.t_curso
    ADD CONSTRAINT ca_curso_01 UNIQUE (cod_periodo, cod_uni_curricular, seccion);
ALTER TABLE ONLY sis.t_electiva
    ADD CONSTRAINT ca_electiva UNIQUE (cod_cur_estudiante, cod_pensum);
ALTER TABLE ONLY sis.t_periodo
    ADD CONSTRAINT ca_periodo UNIQUE (cod_instituto, cod_pensum, fec_inicio);

ALTER TABLE ONLY sis.t_instituto
    ADD CONSTRAINT cp_instituto PRIMARY KEY (codigo);
ALTER TABLE ONLY sis.t_pensum
    ADD CONSTRAINT cp_pensum PRIMARY KEY (codigo);
ALTER TABLE ONLY sis.t_prelacion
    ADD CONSTRAINT cp_prelacion PRIMARY KEY (codigo);
ALTER TABLE ONLY sis.t_trayecto
    ADD CONSTRAINT cp_trayecto PRIMARY KEY (codigo);
ALTER TABLE ONLY sis.t_tip_uni_curricular
    ADD CONSTRAINT cp_uni_cur_tipo PRIMARY KEY (codigo);
ALTER TABLE ONLY sis.t_uni_curricular
    ADD CONSTRAINT cp_uni_curricular PRIMARY KEY (codigo);
ALTER TABLE ONLY sis.t_uni_tra_pensum
    ADD CONSTRAINT cp_uni_tra_pensum PRIMARY KEY (codigo);

ALTER TABLE ONLY sis.t_archivo
    ADD CONSTRAINT cp_archivo PRIMARY KEY (codigo);
ALTER TABLE ONLY sis.t_empleado
    ADD CONSTRAINT cp_empleado PRIMARY KEY (codigo);
ALTER TABLE ONLY sis.t_est_empleado
    ADD CONSTRAINT cp_est_empleado PRIMARY KEY (codigo);
ALTER TABLE ONLY sis.t_estudiante
    ADD CONSTRAINT cp_estudiante PRIMARY KEY (codigo);
ALTER TABLE ONLY sis.t_persona
    ADD CONSTRAINT cp_persona PRIMARY KEY (codigo);
ALTER TABLE ONLY sis.t_est_estudiante
    ADD CONSTRAINT cp_est_estudiante PRIMARY KEY (codigo);


ALTER TABLE ONLY sis.t_convalidacion
    ADD CONSTRAINT cp_convalidacion PRIMARY KEY (codigo);
ALTER TABLE ONLY sis.t_acreditable
    ADD CONSTRAINT cp_acreditable PRIMARY KEY (codigo);
ALTER TABLE ONLY sis.t_cur_estudiante
    ADD CONSTRAINT cp_cur_estudiante PRIMARY KEY (codigo);
ALTER TABLE ONLY sis.t_curso
    ADD CONSTRAINT cp_curso PRIMARY KEY (codigo);
ALTER TABLE ONLY sis.t_electiva
    ADD CONSTRAINT cp_electiva PRIMARY KEY (codigo);
ALTER TABLE ONLY sis.t_est_cur_estudiante
    ADD CONSTRAINT cp_est_cur_estudiante PRIMARY KEY (codigo);
ALTER TABLE ONLY sis.t_est_periodo
    ADD CONSTRAINT cp_est_periodo PRIMARY KEY (codigo);
ALTER TABLE ONLY sis.t_periodo
    ADD CONSTRAINT cp_periodo PRIMARY KEY (codigo);


ALTER TABLE ONLY sis.t_prelacion
    ADD CONSTRAINT cf_prelacion__instituto FOREIGN KEY (cod_instituto) REFERENCES sis.t_instituto(codigo);
ALTER TABLE ONLY sis.t_prelacion
    ADD CONSTRAINT cf_prelacion__pensum FOREIGN KEY (cod_pensum) REFERENCES sis.t_pensum(codigo);
ALTER TABLE ONLY sis.t_prelacion
    ADD CONSTRAINT cf_prelacion__uni_curricular FOREIGN KEY (cod_uni_curricular) REFERENCES sis.t_uni_curricular(codigo);
ALTER TABLE ONLY sis.t_prelacion
    ADD CONSTRAINT cf_prelacion__uni_curricular_prelada FOREIGN KEY (cod_uni_cur_prelada) REFERENCES sis.t_uni_curricular(codigo);
ALTER TABLE ONLY sis.t_trayecto
    ADD CONSTRAINT cf_trayecto_pensum FOREIGN KEY (cod_pensum) REFERENCES sis.t_pensum(codigo);
ALTER TABLE ONLY sis.t_uni_tra_pensum
    ADD CONSTRAINT cf_uni_tra_pensum__pensum FOREIGN KEY (cod_pensum) REFERENCES sis.t_pensum(codigo);
ALTER TABLE ONLY sis.t_uni_tra_pensum
    ADD CONSTRAINT cf_uni_tra_pensum__tip_uni_curricular FOREIGN KEY (cod_tipo) REFERENCES sis.t_tip_uni_curricular(codigo);
ALTER TABLE ONLY sis.t_uni_tra_pensum
    ADD CONSTRAINT cf_uni_tra_pensum__trayecto FOREIGN KEY (cod_trayecto) REFERENCES sis.t_trayecto(codigo);
ALTER TABLE ONLY sis.t_uni_tra_pensum
    ADD CONSTRAINT cf_uni_tra_pensum__uni_curricular FOREIGN KEY (cod_uni_curricular) REFERENCES sis.t_uni_curricular(codigo);

ALTER TABLE ONLY sis.t_empleado
    ADD CONSTRAINT cf_empleado_est_empleado FOREIGN KEY (cod_estado) REFERENCES sis.t_est_empleado(codigo);
ALTER TABLE ONLY sis.t_empleado
    ADD CONSTRAINT cf_empleado__instituto FOREIGN KEY (cod_instituto) REFERENCES sis.t_instituto(codigo);
ALTER TABLE ONLY sis.t_empleado
    ADD CONSTRAINT cf_empleado__pensum FOREIGN KEY (cod_pensum) REFERENCES sis.t_pensum(codigo);
ALTER TABLE ONLY sis.t_empleado
    ADD CONSTRAINT cf_empleado__persona FOREIGN KEY (cod_persona) REFERENCES sis.t_persona(codigo);
ALTER TABLE ONLY sis.t_estudiante
    ADD CONSTRAINT cf_estudiante__est_estado FOREIGN KEY (cod_estado) REFERENCES sis.t_est_estudiante(codigo);
ALTER TABLE ONLY sis.t_estudiante
    ADD CONSTRAINT cf_estudiante__instituto FOREIGN KEY (cod_instituto) REFERENCES sis.t_instituto(codigo);
ALTER TABLE ONLY sis.t_estudiante
    ADD CONSTRAINT cf_estudiante__pensum FOREIGN KEY (cod_pensum) REFERENCES sis.t_pensum(codigo);
ALTER TABLE ONLY sis.t_estudiante
    ADD CONSTRAINT cf_estudiante__persona FOREIGN KEY (cod_persona) REFERENCES sis.t_persona(codigo);
ALTER TABLE ONLY sis.t_persona
    ADD CONSTRAINT cf_persona__archivo FOREIGN KEY (cod_foto) REFERENCES sis.t_archivo(codigo);

ALTER TABLE ONLY sis.t_convalidacion
    ADD CONSTRAINT cf_convalidacion__estudiante FOREIGN KEY (cod_estudiante) REFERENCES sis.t_estudiante(codigo);
ALTER TABLE ONLY sis.t_convalidacion
    ADD CONSTRAINT cf_convalidacion__pensum FOREIGN KEY (cod_pensum) REFERENCES sis.t_pensum(codigo);
ALTER TABLE ONLY sis.t_convalidacion
    ADD CONSTRAINT cf_convalidacion__trayecto FOREIGN KEY (cod_trayecto) REFERENCES sis.t_trayecto(codigo);
ALTER TABLE ONLY sis.t_convalidacion
    ADD CONSTRAINT cf_convalidacion__uni_curricular FOREIGN KEY (cod_uni_curricular) REFERENCES sis.t_uni_curricular(codigo);
ALTER TABLE ONLY sis.t_convalidacion
    ADD CONSTRAINT cf_convalidadcion__tip_uni_curricular FOREIGN KEY (cod_tip_uni_curricular) REFERENCES sis.t_tip_uni_curricular(codigo);
ALTER TABLE ONLY sis.t_acreditable
    ADD CONSTRAINT cf_acreditable__estudiante FOREIGN KEY (cod_estudiante) REFERENCES sis.t_persona(codigo);
ALTER TABLE ONLY sis.t_acreditable
    ADD CONSTRAINT cf_acreditable__pensum FOREIGN KEY (cod_pensum) REFERENCES sis.t_pensum(codigo);
ALTER TABLE ONLY sis.t_acreditable
    ADD CONSTRAINT cf_acreditable__trayecto FOREIGN KEY (cod_trayecto) REFERENCES sis.t_trayecto(codigo);
ALTER TABLE ONLY sis.t_cur_estudiante
    ADD CONSTRAINT cf_cur_estudiante__curso FOREIGN KEY (cod_curso) REFERENCES sis.t_curso(codigo);
ALTER TABLE ONLY sis.t_cur_estudiante
    ADD CONSTRAINT cf_cur_estudiante__est_cur_estudiante FOREIGN KEY (cod_estado) REFERENCES sis.t_est_cur_estudiante(codigo);
ALTER TABLE ONLY sis.t_cur_estudiante
    ADD CONSTRAINT cf_cur_estudiante__estudiante FOREIGN KEY (cod_estudiante) REFERENCES sis.t_persona(codigo);
ALTER TABLE ONLY sis.t_curso
    ADD CONSTRAINT cf_curso_docente FOREIGN KEY (cod_docente) REFERENCES sis.t_persona(codigo);
ALTER TABLE ONLY sis.t_curso
    ADD CONSTRAINT cf_curso__periodo FOREIGN KEY (cod_periodo) REFERENCES sis.t_periodo(codigo);
ALTER TABLE ONLY sis.t_curso
    ADD CONSTRAINT cf_curso__uni_curricular FOREIGN KEY (cod_uni_curricular) REFERENCES sis.t_uni_curricular(codigo);
ALTER TABLE ONLY sis.t_electiva
    ADD CONSTRAINT cf_electiva__cur_estudiante FOREIGN KEY (cod_cur_estudiante) REFERENCES sis.t_cur_estudiante(codigo);
ALTER TABLE ONLY sis.t_electiva
    ADD CONSTRAINT cf_electiva__pensum FOREIGN KEY (cod_pensum) REFERENCES sis.t_pensum(codigo);
ALTER TABLE ONLY sis.t_electiva
    ADD CONSTRAINT cf_electiva__trayecto FOREIGN KEY (cod_trayecto) REFERENCES sis.t_trayecto(codigo);
ALTER TABLE ONLY sis.t_periodo
    ADD CONSTRAINT cf_periodo__est_periodo FOREIGN KEY (cod_estado) REFERENCES sis.t_est_periodo(codigo);
ALTER TABLE ONLY sis.t_periodo
    ADD CONSTRAINT cf_periodo__instituto FOREIGN KEY (cod_instituto) REFERENCES sis.t_instituto(codigo);
ALTER TABLE ONLY sis.t_periodo
    ADD CONSTRAINT cf_periodo__pensum FOREIGN KEY (cod_pensum) REFERENCES sis.t_pensum(codigo);



/**------------------------  DATA PARA PREUBA -----------------------------------------------------------------------**/
