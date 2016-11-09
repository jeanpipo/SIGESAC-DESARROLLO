--Script de creación de la base de datos del Sistema de Control de Notas
--Proyecto Socio Tecnologico II
--Creado por Franco César, García Edson, Terrami Miguel
--Tutor Johan Alamo
--Mantenido por _________
--Octubre de 2012
--Dpto de informática del IUT-RC "Dr. Federico Rivero Palacio"

--Conectarse como usuario postgres
\connect postgres;

--Conectarse a la base de datos
\connect bd_sap;


select 'consulta para limpiar el buffer, no borrar.';


--Datos de la tabla ts_instituto


insert into ts_instituto (codigo,nom_corto,nombre,direccion) values (1, 'IUTFRP', 'Instituto Universitario de Tecnología “Dr. Federico Rivero Palacio”', 'Km 8, Panamericana');
insert into ts_instituto (codigo,nom_corto,nombre,direccion) values (2, 'CUC', 'Colegio Universitario de Caracas', 'Chacao');
insert into ts_instituto (codigo,nom_corto,nombre,direccion) values (3, 'CULTCA', 'Colegio Universitario de Los Teques Cecilio Acosta', 'Km 23, Panamericana');
insert into ts_instituto (codigo,nom_corto,nombre,direccion) values (4, 'IUTAG', 'Instituto Universitario de Tecnología Alonso Gamero', 'Parque Los Orumos');
insert into ts_instituto (codigo,nom_corto,nombre,direccion) values (5, 'IUTOMS', 'Instituto Universitario de Tecnología del Oeste Mariscal Sucre', 'Antimano');
insert into ts_instituto (codigo,nom_corto,nombre,direccion) values(6,'CUFM','Colegio Universitario Francisco de Miranda','');
insert into ts_instituto (codigo,nom_corto,nombre,direccion) values(7,'CUJLPR','Colegio Universitario ProfesorJosé Lorenzo Pérez Rodríguez','');
insert into ts_instituto (codigo,nom_corto,nombre,direccion) values(8,'IUTAI','Instituto Universitario de Tecnología Agroindustrial','');
insert into ts_instituto (codigo,nom_corto,nombre,direccion) values(9,'IUTCABIMAS','Instituto Universitariode Tecnología de Cabimas','');
insert into ts_instituto (codigo,nom_corto,nombre,direccion) values(10,'IUTCARIPITO','Instituto Universitariode Tecnología de Caripito','');
insert into ts_instituto (codigo,nom_corto,nombre,direccion) values(11,'IUTCUMANA','Instituto Universitario de Tecnología de Cumaná','');
insert into ts_instituto (codigo,nom_corto,nombre,direccion) values(12,'IUTEB','Instituto Universitario de Tecnologíadel Estado Bolívar','');
insert into ts_instituto (codigo,nom_corto,nombre,direccion) values(13,'IUTEP','Instituto Universitario de Tecnologíadel Estado Portuguesa','');
insert into ts_instituto (codigo,nom_corto,nombre,direccion) values(14,'IUTET','Instituto Universitario de Tecnologíadel Estado Trujillo','');
insert into ts_instituto (codigo,nom_corto,nombre,direccion) values(15,'IUTL','Instituto Universitario de Tecnología de los Llanos','');
insert into ts_instituto (codigo,nom_corto,nombre,direccion) values(16,'IUTM','Instituto Universitario de Tecnología de Maracaibo','Maracaibo');
insert into ts_instituto (codigo,nom_corto,nombre,direccion) values(17,'IUTDELTA','Instituto Universitario de Tecnología Dr. Delfín Mendoza','Delta Amacuro');
insert into ts_instituto (codigo,nom_corto,nombre,direccion) values(18,'IUTJNV','Instituto Universitario de Tecnología Jacinto Navarro Vallenilla','Carupano');
insert into ts_instituto (codigo,nom_corto,nombre,direccion) values(19,'IUT-JAA','Instituto Universitario de Tecnología José Antonio Anzoategui','');
insert into ts_instituto (codigo,nom_corto,nombre,direccion) values(20,'IUTE','Instituto Universitario de Tecnología de Ejido','');
insert into ts_instituto (codigo,nom_corto,nombre,direccion) values(21,'IUTPC','Instituto Universitario de Tecnología de Puerto Cabello','Puerto Cabello');
insert into ts_instituto (codigo,nom_corto,nombre,direccion) values(22,'IUTVAL','Instituto Universitario de Tecnología de Valencia','Valencia');




ALTER sequence ts_instituto_codigo_seq restart with 100;



--Datos de la tabla ts_pensum


insert into ts_pensum (codigo,nombre,observaciones,nom_corto) values (1, 'Programa Nacional de Formación Informática (Ingeniería)', 'implementado en 2008','PNFI');
insert into ts_pensum (codigo,nombre,observaciones,nom_corto) values (2, 'Programa nacional de formacion en administracion(LICENCIATURA)', 'No Posee','PNFA');
alter sequence ts_pensum_codigo_seq restart with 100;



--Datos de la tabla ts_est_periodo


insert into ts_est_periodo (codigo,descripcion,estado) values (1, 'Abierto', 'A');
insert into ts_est_periodo (codigo,descripcion,estado) values (2, 'Cerrado', 'C');



--Datos de la tabla ts_periodo


insert into ts_periodo (codigo,fec_inicio,fec_final,observaciones) values (1, '01/09/2012', '30/12/2012', '');


Alter sequence ts_periodo_codigo_seq restart with 100;



--Datos de la tabla ts_ins_pen_periodo


insert into ts_ins_pen_periodo (codigo,cod_instituto,cod_pensum,cod_periodo,estado) values (1, 1, 1, 1,'A');

Alter sequence ts_ins_pen_periodo_codigo_seq restart with 100;



--Datos de la tabla ts_trayecto

insert into ts_trayecto (codigo,num_trayecto,cod_pensum,certificado,min_credito) values (1, 0, 1, 'No Posee', 0);
insert into ts_trayecto (codigo,num_trayecto,cod_pensum,certificado,min_credito) values (2, 1, 1, 'Soporte tecnico', 0);
insert into ts_trayecto (codigo,num_trayecto,cod_pensum,certificado,min_credito) values (3, 2, 1, 'TSU Informatica', 0);
insert into ts_trayecto (codigo,num_trayecto,cod_pensum,certificado,min_credito) values (4, 3, 1, 'Desarrollador de aplicaciones', 0);
insert into ts_trayecto (codigo,num_trayecto,cod_pensum,certificado,min_credito) values (5, 4, 1, 'Ingeniero en Informatica', 0);

insert into ts_trayecto (codigo,num_trayecto,cod_pensum,certificado,min_credito) values (6, 0, 2, 'No Posee', 0);
insert into ts_trayecto (codigo,num_trayecto,cod_pensum,certificado,min_credito) values (7, 1, 2, 'ASISTENTE ADMINISTRATIVO', 0);
insert into ts_trayecto (codigo,num_trayecto,cod_pensum,certificado,min_credito) values (8, 2, 2, 'TSU EN ADMINISTRACIÓN', 0);
insert into ts_trayecto (codigo,num_trayecto,cod_pensum,certificado,min_credito) values (9, 3, 2, 'No posee', 0);
insert into ts_trayecto (codigo,num_trayecto,cod_pensum,certificado,min_credito) values (10,4, 2, 'LICENCIADO EN ADMINISTRACIÓN', 0);
Alter sequence ts_trayecto_codigo_seq restart with 100;



--Datos de la tabla ts_uni_cur_tipo


insert into ts_uni_cur_tipo (codigo,tipo,descripcion) values (1, 'P', 'Proyectos');
insert into ts_uni_cur_tipo (codigo,tipo,descripcion) values (2, 'S', 'Seminarios');
insert into ts_uni_cur_tipo (codigo,tipo,descripcion) values (3, 'T', 'Talleres');
insert into ts_uni_cur_tipo (codigo,tipo,descripcion) values (4, 'C', 'Cursos');
insert into ts_uni_cur_tipo (codigo,tipo,descripcion) values (5, 'A', 'Actividades Acreditables');



--Datos de la tabla ts_uni_curricular


insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (1, 'MAC015', 1, 1, 'MATEMÁTICA','C',5,5,5,12,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (2, 'PNS013', 1, 1, 'PROYECTO NACIONAL Y NUEVA CIUDADANÍA','C',2.5,4,3,12,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (3, 'IPC012', 1, 1, 'INTRODUCCIÓN A LOS PROYECTOS Y AL PNF','C',2.5,2,2,12,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (4, 'MAC139', 2, 1, 'MATEMÁTICA I','C',1.5,5,9,36,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (5, 'ACT139', 2, 1, 'ARQUITECTURA DEL COMPUTADOR','T',1.5,5,9,36,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (6, 'APT1312', 2, 1, 'ALGORÍTMICA Y PROGRAMACIÓN I','T',2.5,6,12,36,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (7, 'FCS133', 2, 1, 'FORMACIÓN CRÍTICA I','S',0.5,2,3,36,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (8, 'PTP139', 2, 1, 'PROYECTO SOCIO TECNOLÓGICO I','P',0.5,6,9,36,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (9, 'IDC133', 2, 1, 'INGLÉS','C',0.5,2,3,36,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (10, 'MAC226', 3, 1, 'MATEMÁTICA II','C',1.5,5,6,24,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (11, 'RCT226', 3, 1, 'REDES DE COMPUTADORAS','T',1.5,5,6,24,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (12, 'POT2312', 3, 1, 'PROGRAMACIÓN II','T',2.5,6,12,36,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (13, 'ISC213', 3, 1, 'INGENIERÍA DEL SOFTWARE I','C',2,5,3,12,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (14, 'BDC213', 3, 1, 'BASE DE DATOS','C',2,5,3,12,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (15, 'FCS233', 3, 1, 'FORMACIÓN CRÍTICA II','S',0.5,2,3,36,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (16, 'PTP239', 3, 1, 'PROYECTO SOCIO TECNOLÓGICO II','P',0.5,6,9,36,12,20);


insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (17, 'PRO6002', 6, 2, 'LA ADMINISTRACIÓN EN EL NUEVO MODELO SOCIAL','P',30,30,2,12,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (18, 'PNNC8003', 6, 2, 'PROYECTO NACIONAL Y NUEVA CIUDADANIA','P',40,40,3,12,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (19, 'DI6002', 6, 2, 'DESARROLLO INTEGRAL','S',30,30,2,12,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (20, 'MA6002', 6, 2, 'MATEMATICA','S',30,30,2,12,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (21, 'PRO700124', 7, 2, 'ANÁLISIS Y EJECUCIÓN DE LOS PROCESOS ADMINISTRATIVOS EN LAS ORGANIZACIONES','P',350,350,24,36,16,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (22, 'APN15015', 7, 2, 'ADMINISTRACIÓN PÚBLICA NACIONAL','T',175,175,5,36,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (23, 'OF6012', 7, 2, ' OPERACIONES FINANCIERAS','S',30,30,2,36,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (24, 'CON18016', 7, 2, 'CONTABILIDAD I','S',90,90,6,36,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (25, 'TPM9013', 7, 2, 'TEORÍA Y PRÁCTICA DEL MERCADEO','S',45,45,3,36,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (26, 'PRO700224', 8, 2, 'SUPERVISIÓN Y CONDUCCIÓN TÉCNICA DE PROCESOS ADMINISTRATIVOS','P',350,350,24,36,16,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (27, 'ESMD15025', 8, 2, 'ECONOMÍA, SUSTENTABILIDAD Y MODELOS DE DESARROLLO','S',175,175,5,36,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (28, 'CON9023', 8, 2, 'CONTABILIDAD II','S',45,45,3,36,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (29, 'ADC6022', 8, 2, 'ADMINISTRACIÒN DE COSTOS','S',30,30,2,36,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (30, 'OM6022', 8, 2, 'ORGANIZACIÓN Y MÉTODOS','S',30,30,2,36,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (31, 'THAT9023', 8, 2, 'TALENTO HUMANO Y AMBIENTE DE TRABAJO','T',45,45,3,36,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (32, 'PRO700324', 9, 2, 'DISEÑO, PLANIFICACIÓN, DESARROLLO E INNOVACIÓN DE SISTEMAS ADMINISTRATIVOS','P',350,350,24,36,16,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (33, 'PSAPD15035', 9, 2, 'PARTICIPACIÓN SOCIAL EN LA ADMINISTRACIÓN, PRODUCCIÓN Y DISTRIBUCIÓN','S',175,175,5,36,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (34, 'ADP6032', 9, 2, 'ADMINISTRACIÓN DE LA PRODUCCIÓN','S',30,30,2,36,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (35, 'PPU4032', 9, 2, 'PRESUPUESTO PÚBLICO','S',20,20,2,36,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (36, 'PPR3031', 9, 2, 'PRESUPUESTO PRIVADO','S',15,15,1,36,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (37, 'ADM6032', 9, 2, 'ADMINISTRACIÓN DEL MERCADEO','S',30,30,1,36,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (38, 'FEP3031', 9, 2, 'FORMULACIÓN Y EVALUACIÓN DE PROYECTOS','S',15,15,1,36,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (39, 'PRO700424', 10, 2, 'DIRECCIÓN, CONTROL Y EVALUACIÓN DE SISTEMAS ADMINISTRATIVOS','P',350,350,24,36,16,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (40, 'APUALC15045', 10, 2, 'ADMINISTRACIÓN EN LOS PROCESOS DE UNIDAD DE AMÉRICA LATINA Y EL CARIBE EN EL NUEVO CONTEXTO MUNDIAL','S',175,175,5,36,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (41, 'AIEF6042', 10, 2, 'ANÁLISIS E INTERPRETACIÓN DE ESTADOS FINANCIEROS','S',30,30,2,36,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (42, 'SFN6042', 10, 2, 'SISTEMA FINANCIERO NACIONAL','S',30,30,2,24,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (43, 'AF6042', 10, 2, 'ADMINISTRACIÓN FINANCIERA','S',30,30,2,24,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (44, 'PDETH9042', 10, 2, 'PLANIFICACIÓN Y DESARROLLO ESTRATÉGICO DEL TALENTO HUMANO','T',45,45,3,36,12,20);
insert into ts_uni_curricular (codigo,cod_uni_ministerio,cod_trayecto,cod_pensum,nombre,tipo,hti,hta,uni_credito,dur_semanas,not_min_aprobatoria,not_maxima) values (45, 'NPG9043', 10, 2, 'NUEVOS PARADIGMAS PARA LA GESTIÓN DEL TALENTO HUMANO.','T',45,45,3,12,12,20);


Alter sequence ts_uni_curricular_codigo_seq restart with 100;



--Datos de la tabla ts_privilegios


insert into ts_privilegios(codigo, descripcion, tipo) values(1,'AdministradorDepartamento','D');
insert into ts_privilegios(codigo, descripcion, tipo) values(2,'Básico','B');
insert into ts_privilegios(codigo, descripcion, tipo) values(3,'Consultor','C');
insert into ts_privilegios(codigo, descripcion, tipo) values(4,'Administrador','A');




--Datos de la tabla ts_persona


insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (1,24997125,null,1,1,'KATHERYNE','DE JESÚS','ADAMÉS','OROPEZA','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (2,23657688,null,1,1,'YARLENIS','ALEJANDRA','ALONZO','CUAMO','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (3,24101206,null,1,1,'STEPHANIE','LISHA','ÁLVAREZ','LUGO','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (4,22667489,null,1,1,'ORLEANI','DALISMAR','ARAQUE','CEDEÑO','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (5,22440561,null,1,1,'EDUARDO','ARTURO','ARENAS','SÁNCHEZ','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (6,17286718,null,1,1,'CARLOS','ENRIQUE','ARISMENDIZ','BOLÍVAR','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (7,22350152,null,1,1,'NIVARK','EDUARDO','BASTIDAS','BRACHO','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (8,22025926,null,1,1,'CARLOS','ALBERTO','BELISARIO','CALDERÓN','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (9,19710678,null,1,1,'FRANCISCO','ANTONIO','BELLORÍN','CIOFFI','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (10,24286582,null,1,1,'DANIELA','DESSIREÉ','BENCOMO','DÍAZ','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (11,22667677,null,1,1,'JOSÉ','DAVID','BRITO','SANSONETTI','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (12,21290501,null,1,1,'HENRY','MOISES','BRITO','SILVA','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (13,24315931,null,1,1,'FABRIZIO','ROBERTO RUGGERO','BRUZZESE','SANTAMARÍA','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (14,23192057,null,1,1,'DIEGO','ARMANDO JESÚS','CABALLERO','ESCALONA','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (15,23689482,null,1,1,'LUÍS','FRANCISCO','CAPELO','DOS REIS','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (16,23652815,null,1,1,'´AMBAR','CRIS','CASTRO','NAVAS','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (17,22905285,null,1,1,'DANIEL','JOSÉ','CEDRE','CARO','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (18,21408624,null,1,1,'RAIZA','YUSBLEIDY','CELIS','PEÑA','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (19,24592402,null,1,1,'RUSBETH','GIUSETH','CERVERA','GALLARDO','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (20,24461897,null,1,1,'LEXANDER','DARIO','CHACÓN','MORALES','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (21,23637528,null,1,1,'PADRÓN','SÁNCHEZ','CIROALEJANDRO','','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (22,18491779,null,1,1,'ELY','JOSÉ','COLMENAREZ','MOLINA','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (23,22440844,null,1,1,'KEVERLYN','CAROLINA','CONTRERA','RIVERA','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (24,20328783,null,1,1,'OSCAR','EDUARDO','DÁVILA','MONTILLA','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (25,21469762,null,1,1,'ABRAHAM','JOSÉ','DE SOUSA','MARRERO','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (26,22694445,null,1,1,'JEFFERSON','ADRIÁN','DÍAZ','CORRALES','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (27,24464728,null,1,1,'DAVID','ALEJANDRO','DÍAZ','PULIDO','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (28,22049068,null,1,1,'VENECIA','FABIOLA','FAIETA','LINARES','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (29,13459879,null,1,1,'ELY','','FERMÍN','','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (30,25237827,null,1,1,'JOSÉ','MANUEL','FRANCO','HERNÁNDEZ','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (31,18739895,null,1,1,'ALBA','ELENA','GARCÍA','OCANDO','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (32,24461926,null,1,1,'MYGLENY','MICHELL','GARCÍA','OCANDO','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (33,21615873,null,1,1,'ANDRÉS','','GARCÍA','RAMOS','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (34,22447221,null,1,1,'WYNKER','JOSÉ','GOITIA','DÍAZ','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (35,22048719,null,1,1,'MARTÍN','LAVY','GOMES','DI LENA','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (36,24461157,null,1,1,'JOSÉ','ANTONIO','GONZÁLEZ','HERRERA','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (37,24523065,null,1,1,'CARLOS','DAVID','GONZÁLEZ','NEXANS','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (38,21470644,null,1,1,'ROBERTO','JOSE','GONZALEZ','SANCHEZ','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (39,24462913,null,1,1,'KATHERINE','ANDREA','GONZÁLEZ','TURITTO','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (40,25896828,null,1,1,'WILLMBERT','','HERNÁNDEZ','CARILLO','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (41,21091195,null,1,1,'ALVEA','JOSÉ','LAYA','PEÑA','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (42,24130401,null,1,1,'DAYLIN','JOSÉ','LEMUS','LUCART','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (43,24524825,null,1,1,'KRISLADY','MILEXANDRA','LOBO','VELÁSQUEZ','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (44,24087693,null,1,1,'MOISES','ALEJANDRO','LÓPEZ','QUIÑONES','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (45,22280917,null,1,1,'ELEIDA','VICTORIA','LOZANO','MAYORA','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (46,25948675,null,1,1,'GILBERT','ALEXANDER','MARCANO','GONZÁLES','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (47,22033729,null,1,1,'GÉNESIS','ABIXAI','MARTÍNEZ','PRIN','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (48,22440606,null,1,1,'EVELYN','DANIELA','MENDEZ','GÓMEZ','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (49,20095483,null,1,1,'GIORDANYS','ROBERTO','MODL','RAMOS','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (50,24087122,null,1,1,'FRANCI','ANDREINA','MOLINA','MESA','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (51,19820571,null,1,1,'LEOMAR','ALEJANDRO','MONCADA','HERNÁNDEZ','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (52,20754390,null,1,1,'MARÍA','SALOMÉ','MORALES','','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (53,22908687,null,1,1,'RENNY','OTTOLINA JESÚS','MORENO','ARNDT','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (54,23617307,null,1,1,'FRANCISCO','JOSÉ','MOROS','VIERA','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (55,22281544,null,1,1,'EVELÍN','MARIANA','OROPEZA','SIVIRA','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (56,23623909,null,1,1,'KATHERINE','ANTONELLA','PACHANO','FLORES','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (57,22667509,null,1,1,'ÁLVARO','LUÍS','PERDOMO','USECHE','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (58,23608372,null,1,1,'JHORFRANK','MITCHELL','PÉREZ','BLANCO','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (59,21089422,null,1,1,'FRANCHESKA','ANDREINA','RADA','DÍAZ','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (60,22350043,null,1,1,'JESÚS','DAVID','RAMÍREZ','GONZÁLEZ','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (61,24463653,null,1,1,'JUAN','ANDRÉS','RAMOS','FERNÁDEZ','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (62,22666988,null,1,1,'KEIVYN','EDUARDO','RAMOS','PÉREZ','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (63,24997618,null,1,1,'LUÍS','ALFREDO','RANGEL','CASTILLO','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (64,24461478,null,1,1,'YAINELIN','ALEJANDRA','RANGEL','PÉREZ','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (65,24664943,null,1,1,'NAYLETH','','RIVAS','','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (66,21437139,null,1,1,'KEIVER','JOSÉ','RIVAS','JAIMES','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (67,26125500,null,1,1,'OSCAR','OMAR','ROA','GUERRERO','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (68,24700248,null,1,1,'LUÍS','ALVERTO','RODRÍGUEZ','RUÍZ','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (69,22286952,null,1,1,'YURETSY','WALESCA','ROJAS','LASTRA','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (70,22752141,null,1,1,'ZUKEILA','ALEJANDRA','ROMERO','','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (71,25964426,null,1,1,'JOSÉ','EVELIO','RONDÓN','RANGEL','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (72,22350135,null,1,1,'YEISON','FREDDY','ROSALES','JASPE','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (73,20290474,null,1,1,'KIARA','CAROLINA','RUÍZ','ATENCIO','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (74,22282022,null,1,1,'KIARA','EMPERATRIZ','SALCEDO','INFANTE','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (75,24461475,null,1,1,'EMILY','LORENA','SANDOVAL','PÉREZ','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (76,22014552,null,1,1,'YEINSON','JOSÉ','SANTIAGO','GONZÁLEZ','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (77,24410044,null,1,1,'YOELVIS','DAVID','SARMIENTO','MONTILLA','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (78,24523358,null,1,1,'DANIELA','ALEJANDRA','SEGURA','CASTELLANOS','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (79,21091197,null,1,1,'GIOVANNI','EULISES','SOJO','PEÑA','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (80,27535302,null,1,1,'FRANCISCO','JAVIER','SORTINO','ROJAS','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (81,22540822,null,1,1,'JEAN','PIERRE','SOSA','GÓMEZ','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (82,24063554,null,1,1,'KARLOS','ALFONZO','SOTO','GONZÁLEZ','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (83,23626777,null,1,1,'JOSÉ','ALÍ','SUAREZ','NAVAS','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (84,14788280,null,1,1,'LUSMILA','COROMOTO','TARACHE','TARACHE','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (85,25514417,null,1,1,'YAIVER','YANEIZA','TOVAR','HERRERA','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (86,21490846,null,1,1,'JESSICA','CRISTINA','VALE','SCHOLTE','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (87,24669462,null,1,1,'ANDRÉS','EDUARDO','VÁSQUEZ','CALVETE','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (88,24286551,null,1,1,'ENMANUEL','ALEJANDRO','VÁSQUEZ','PÉREZ','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (89,21310570,null,1,1,'JOSÉ','ALBERTO','VERDE','MARTÍNEZ','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (90,16148116,null,1,1,'JOHAN','PEDRO','ÁLAMO','AVILÁN','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (91,8812054,null,1,1,'IRIS','','ALBARRÁN','PARRA','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (92,10829324,null,1,1,'KITY','JACQUELINE','ÁLVAREZ','AGUILAR','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (93,4268591,null,1,1,'COLOMBIA ','ELENA','AMEZQUITA','ZAMBRANO','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (94,3673294,null,1,1,'GUILLERMO','ANTONIO','ARCILA','BARRIOS','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (95,5836636,null,1,1,'PEDRO','JOSÉ','BALZA','SALAS','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (97,4822028,null,1,1,'JUAN','CARLOS','CARRANZA','MEDINA','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (99,3574043,null,1,1,'EDGAR','','CASTELLANOS','DOMÍNGUEZ','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (100,15091404,null,1,1,'KEILA','','CASTRO','RODRÍGUEZ','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (101,6972243,null,1,1,'MARCO','ANTONIO','CASTRO','USTIOLA','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (102,6448549,null,1,1,'ALEXANDRA','ERNESTINA','CORREA','MENDOZA','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (103,13950317,null,1,1,'ODALIS','DEL CARMEN','DE SANTIAGO','DELGADO','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (104,3157845,null,1,1,'CARLOS','EDUARDO','DEKASH','NIÑO','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (105,26711687,null,1,1,'RICARDO','JOSÉ','DOS SANTOS','ABREU','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (106,14196922,null,1,1,'ROXYDEL','','DULCEY','RANGEL','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (107,12111968,null,1,1,'LEÍN','JOSÉ','GUTIERREZ ','MEDINA','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (108,11028233,null,1,1,'JESÚS','ANTONIO','GUTIERREZ ','PICÓN','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (109,13505890,null,1,1,'ÉRIKA','ANDREINA','HERNÁNDEZ','MONCADA','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (110,4773940,null,1,1,'CARLOS','JOSÉ','LANDAZABAL','RODRÍGUEZ','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (111,17732709,null,1,1,'ANNIE','RAQUEL','MAICA','ALFONZO','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (112,9961774,null,1,1,'JOSÉ','ALEXIS','MOLA','SALAS','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (113,6864142,null,1,1,'DAVID','JOSÉ','MORA ','ANDUEZA','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (114,10283687,null,1,1,'SIMÓN','EUSEBIO','OLIVARES','GONZÁLEZ','M','01/01/1999','NE','NE','NE','NE','NE','NE','D');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (115,12158564,null,1,1,'EUDELYS','GISELA','PARABABIRE','CASTILLO','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (116,12187525,null,1,1,'NORKA','MARÍA','PARELES','MAITA','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (117,11323880,null,1,1,'MARIELISA','','RODRÍGUEZ','LUZARDO','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (118,12855309,null,1,1,'CÉSAR','EDUARDO','RAMOS','BORRERO','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (119,12783782,null,1,1,'ROCÍO','AURORA','RAMOS','UZTÁRIZ','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (121,14825789,null,1,1,'NORETSYS','VIRGINIA','RODRÍGUEZ','GONZÁLEZ','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (122,17368119,null,1,1,'KARINA','ESTELLA','RODRÍGUEZ','MARQUEZ','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (123,11041772,null,1,1,'GERALDINE','YSABEL','ROMERO','HERNÁNDEZ','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (124,6721252,null,1,1,'BETZAIDA','INMACULADA','ROMERO','INFANTE','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (125,11552202,null,1,1,'LILINA','','SILVA','','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (126,6240502,null,1,1,'ELENA','BEATRIZ','VILLALBA ','FERNÁNDEZ','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (127,4662757,null,1,1,'MEIRA','','VILORIA','BARAZARTE','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (128,11672531,null,1,1,'GEAN','MARCOS','WARACAO','GARCÍA','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (129,20614839,null,1,1,'JUNIOR','ALBERTO','PÉREZ','GARCÍA','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (130,21469340,null,1,1,'DIANA','CAROLINA','QUINTANA','QUINTANA','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (131,22350085,null,1,1,'RAMÓN','JESÚS','MARTÍNEZ','OLIVARI','M','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (132,23434931,null,1,1,'MIKELY','ROXELYN','PÉREZ','RODRÍGUEZ','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (133,23635762,null,1,1,'CLARISBEL','ROXANA','PONCE','CANELÓN','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (140,23997560,null,1,1,'DANIEL','','ACEVEDO','','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (137,20329011,null,1,1,'HEMERSON','','BERMÚDEZ','','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (149,21470514,null,1,1,'JESÚS','','BERMÚDEZ','','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (150,22048752,null,1,1,'YEIDERSON','','BRICEÑO','','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (141,22666462,null,1,1,'KATHERINE','','CAMPOS','','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (139,24898458,null,1,1,'CÉSAR','','CARDENAS','','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (151,20654346,null,1,1,'DEIBI','','CARDONA','','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (134,18995885,null,1,1,'STEPHANIE','','DE ANDRADE','','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (142,20304149,null,1,1,'LEONARDO','','DE LA CRUZ','','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (138,20747031,null,1,1,'LEONARDO','','DOS RAMOS','','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (152,22540003,null,1,1,'PASCUAL','','FIORETTI','','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (143,21119244,null,1,1,'YEIKOR','','GAVIDIA','','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (144,19737313,null,1,1,'CHRISTIAN','','GONZÁLEZ','','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (153,22667117,null,1,1,'NESTOR','','LEÓN','','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (145,20911109,null,1,1,'JOSMAR','','MARÍN','','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (135,21120048,null,1,1,'ERNESTO','','MARRERO','','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (154,21377392,null,1,1,'AXEL','','NAVAS','','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (146,22351198,null,1,1,'DANIEL','','OVIEDO','','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (147,23782833,null,1,1,'JEISON','','PEÑA','','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (136,20411185,null,1,1,'HUBER','','QUISPE','','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (155,21469842,null,1,1,'MAURICIO','','ROSAS','','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (158,21469345,null,1,1,'JOSÉ','JESÚS','SÁNCHEZ','GONZÁLEZ','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (148,20745288,null,1,1,'ISAAC','','TORRES','','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (156,21310560,null,1,1,'WILVIR','','VÁSQUEZ','','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (157,21482137,null,1,1,'IVÁN','','YONIS','','F','01/01/1999','NE','NE','NE','NE','NE','NE','C');
insert into ts_persona (codigo,cedula,rif,cod_instituto,cod_pensum,nombre1,nombre2,apellido1,apellido2,sexo,fec_nacimiento,tip_sangre,telefono1,telefono2,cor_personal,cor_institucional,direccion,privilegio) values (160,20000,null,1,1,'MIGUEL','','MARÍN','','M','01/01/1999','NE','NE','NE','NE','NE','NE','A');

alter sequence ts_persona_codigo_seq restart with 200;


insert into ts_est_estudiante (codigo,descripcion,estado) values (1, 'CURSANDO', 'C');
insert into ts_est_estudiante (codigo,descripcion,estado) values (2, 'RETIRADO', 'R');




--Datos de la tabla ts_estudiante


insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (1, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=1),(select cedula from ts_persona where ts_persona.codigo=1),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (2, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=2),(select cedula from ts_persona where ts_persona.codigo=2),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (3, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=3),(select cedula from ts_persona where ts_persona.codigo=3),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (4, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=4),(select cedula from ts_persona where ts_persona.codigo=4),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (5, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=5),(select cedula from ts_persona where ts_persona.codigo=5),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (6, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=6),(select cedula from ts_persona where ts_persona.codigo=6),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (7, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=7),(select cedula from ts_persona where ts_persona.codigo=7),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (8, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=8),(select cedula from ts_persona where ts_persona.codigo=8),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (9, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=9),(select cedula from ts_persona where ts_persona.codigo=9),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (10, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=10),(select cedula from ts_persona where ts_persona.codigo=10),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (11, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=11),(select cedula from ts_persona where ts_persona.codigo=11),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (12, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=12),(select cedula from ts_persona where ts_persona.codigo=12),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (13, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=13),(select cedula from ts_persona where ts_persona.codigo=13),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (14, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=14),(select cedula from ts_persona where ts_persona.codigo=14),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (15, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=15),(select cedula from ts_persona where ts_persona.codigo=15),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (16, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=16),(select cedula from ts_persona where ts_persona.codigo=16),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (17, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=17),(select cedula from ts_persona where ts_persona.codigo=17),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (18, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=18),(select cedula from ts_persona where ts_persona.codigo=18),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (19, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=19),(select cedula from ts_persona where ts_persona.codigo=19),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (20, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=20),(select cedula from ts_persona where ts_persona.codigo=20),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (21, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=21),(select cedula from ts_persona where ts_persona.codigo=21),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (22, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=22),(select cedula from ts_persona where ts_persona.codigo=22),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (23, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=23),(select cedula from ts_persona where ts_persona.codigo=23),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (24, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=24),(select cedula from ts_persona where ts_persona.codigo=24),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (25, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=25),(select cedula from ts_persona where ts_persona.codigo=25),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (26, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=26),(select cedula from ts_persona where ts_persona.codigo=26),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (27, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=27),(select cedula from ts_persona where ts_persona.codigo=27),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (28, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=28),(select cedula from ts_persona where ts_persona.codigo=28),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (29, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=29),(select cedula from ts_persona where ts_persona.codigo=29),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (30, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=30),(select cedula from ts_persona where ts_persona.codigo=30),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (31, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=31),(select cedula from ts_persona where ts_persona.codigo=31),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (32, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=32),(select cedula from ts_persona where ts_persona.codigo=32),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (33, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=33),(select cedula from ts_persona where ts_persona.codigo=33),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (34, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=34),(select cedula from ts_persona where ts_persona.codigo=34),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (35, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=35),(select cedula from ts_persona where ts_persona.codigo=35),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (36, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=36),(select cedula from ts_persona where ts_persona.codigo=36),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (37, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=37),(select cedula from ts_persona where ts_persona.codigo=37),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (38, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=38),(select cedula from ts_persona where ts_persona.codigo=38),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (39, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=39),(select cedula from ts_persona where ts_persona.codigo=39),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (40, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=40),(select cedula from ts_persona where ts_persona.codigo=40),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (41, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=41),(select cedula from ts_persona where ts_persona.codigo=41),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (42, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=42),(select cedula from ts_persona where ts_persona.codigo=42),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (43, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=43),(select cedula from ts_persona where ts_persona.codigo=43),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (44, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=44),(select cedula from ts_persona where ts_persona.codigo=44),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (45, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=45),(select cedula from ts_persona where ts_persona.codigo=45),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (46, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=46),(select cedula from ts_persona where ts_persona.codigo=46),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (47, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=47),(select cedula from ts_persona where ts_persona.codigo=47),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (48, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=48),(select cedula from ts_persona where ts_persona.codigo=48),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (49, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=49),(select cedula from ts_persona where ts_persona.codigo=49),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (50, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=50),(select cedula from ts_persona where ts_persona.codigo=50),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (51, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=51),(select cedula from ts_persona where ts_persona.codigo=51),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (52, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=52),(select cedula from ts_persona where ts_persona.codigo=52),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (53, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=53),(select cedula from ts_persona where ts_persona.codigo=53),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (54, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=54),(select cedula from ts_persona where ts_persona.codigo=54),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (55, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=55),(select cedula from ts_persona where ts_persona.codigo=55),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (56, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=56),(select cedula from ts_persona where ts_persona.codigo=56),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (57, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=57),(select cedula from ts_persona where ts_persona.codigo=57),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (58, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=58),(select cedula from ts_persona where ts_persona.codigo=58),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (59, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=59),(select cedula from ts_persona where ts_persona.codigo=59),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (60, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=60),(select cedula from ts_persona where ts_persona.codigo=60),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (61, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=61),(select cedula from ts_persona where ts_persona.codigo=61),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (62, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=62),(select cedula from ts_persona where ts_persona.codigo=62),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (63, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=63),(select cedula from ts_persona where ts_persona.codigo=63),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (64, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=64),(select cedula from ts_persona where ts_persona.codigo=64),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (65, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=65),(select cedula from ts_persona where ts_persona.codigo=65),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (66, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=66),(select cedula from ts_persona where ts_persona.codigo=66),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (67, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=67),(select cedula from ts_persona where ts_persona.codigo=67),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (68, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=68),(select cedula from ts_persona where ts_persona.codigo=68),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (69, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=69),(select cedula from ts_persona where ts_persona.codigo=69),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (70, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=70),(select cedula from ts_persona where ts_persona.codigo=70),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (71, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=71),(select cedula from ts_persona where ts_persona.codigo=71),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (72, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=72),(select cedula from ts_persona where ts_persona.codigo=72),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (73, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=73),(select cedula from ts_persona where ts_persona.codigo=73),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (74, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=74),(select cedula from ts_persona where ts_persona.codigo=74),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (75, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=75),(select cedula from ts_persona where ts_persona.codigo=75),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (76, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=76),(select cedula from ts_persona where ts_persona.codigo=76),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (77, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=77),(select cedula from ts_persona where ts_persona.codigo=77),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (78, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=78),(select cedula from ts_persona where ts_persona.codigo=78),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (79, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=79),(select cedula from ts_persona where ts_persona.codigo=79),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (80, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=80),(select cedula from ts_persona where ts_persona.codigo=80),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (81, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=81),(select cedula from ts_persona where ts_persona.codigo=81),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (82, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=82),(select cedula from ts_persona where ts_persona.codigo=82),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (83, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=83),(select cedula from ts_persona where ts_persona.codigo=83),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (84, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=84),(select cedula from ts_persona where ts_persona.codigo=84),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (85, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=85),(select cedula from ts_persona where ts_persona.codigo=85),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (86, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=86),(select cedula from ts_persona where ts_persona.codigo=86),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (87, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=87),(select cedula from ts_persona where ts_persona.codigo=87),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (88, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=88),(select cedula from ts_persona where ts_persona.codigo=88),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (89, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=89),(select cedula from ts_persona where ts_persona.codigo=89),'C');

insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (129, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=129),(select cedula from ts_persona where ts_persona.codigo=129),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (130, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=130),(select cedula from ts_persona where ts_persona.codigo=130),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (131, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=131),(select cedula from ts_persona where ts_persona.codigo=131),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (132, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=132),(select cedula from ts_persona where ts_persona.codigo=132),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (133, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=133),(select cedula from ts_persona where ts_persona.codigo=133),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (140, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=140),(select cedula from ts_persona where ts_persona.codigo=140),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (137, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=137),(select cedula from ts_persona where ts_persona.codigo=137),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (149, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=149),(select cedula from ts_persona where ts_persona.codigo=149),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (150, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=150),(select cedula from ts_persona where ts_persona.codigo=150),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (141, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=141),(select cedula from ts_persona where ts_persona.codigo=141),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (139, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=139),(select cedula from ts_persona where ts_persona.codigo=139),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (151, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=151),(select cedula from ts_persona where ts_persona.codigo=151),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (134, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=134),(select cedula from ts_persona where ts_persona.codigo=134),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (142, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=142),(select cedula from ts_persona where ts_persona.codigo=142),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (138, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=138),(select cedula from ts_persona where ts_persona.codigo=138),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (152, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=152),(select cedula from ts_persona where ts_persona.codigo=152),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (143, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=143),(select cedula from ts_persona where ts_persona.codigo=143),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (144, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=144),(select cedula from ts_persona where ts_persona.codigo=144),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (153, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=153),(select cedula from ts_persona where ts_persona.codigo=153),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (145, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=145),(select cedula from ts_persona where ts_persona.codigo=145),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (135, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=135),(select cedula from ts_persona where ts_persona.codigo=135),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (154, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=154),(select cedula from ts_persona where ts_persona.codigo=154),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (146, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=146),(select cedula from ts_persona where ts_persona.codigo=146),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (147, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=147),(select cedula from ts_persona where ts_persona.codigo=147),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (136, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=136),(select cedula from ts_persona where ts_persona.codigo=136),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (155, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=155),(select cedula from ts_persona where ts_persona.codigo=155),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (148, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=148),(select cedula from ts_persona where ts_persona.codigo=148),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (156, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=156),(select cedula from ts_persona where ts_persona.codigo=156),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (157, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=157),(select cedula from ts_persona where ts_persona.codigo=157),'C');
insert into ts_estudiante (codigo,num_carnet,num_expediente,cod_rusnies,passwd,login,estado) values (158, NULL, NULL,NULL,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=158),(select cedula from ts_persona where ts_persona.codigo=158),'C');




--Datos de la tabla ts_est_docente


insert into ts_est_docente (codigo,descripcion,estado) values (1, 'ACTIVO', 'A');
insert into ts_est_docente (codigo,descripcion,estado) values (2, 'RETIRADO', 'R');
insert into ts_est_docente (codigo,descripcion,estado) values (3, 'JUBILADO', 'J');





--Datos de la tabla ts_docente


insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (90, 1011,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=90),(select cedula from ts_persona where ts_persona.codigo=90),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (91, 30,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=91),(select cedula from ts_persona where ts_persona.codigo=91),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (92, 38,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=92),(select cedula from ts_persona where ts_persona.codigo=92),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (93,  null,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=93),(select cedula from ts_persona where ts_persona.codigo=93),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (94, 1009,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=94),(select cedula from ts_persona where ts_persona.codigo=94),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (95, 119,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=95),(select cedula from ts_persona where ts_persona.codigo=95),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (97, 139,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=97),(select cedula from ts_persona where ts_persona.codigo=97),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (99,  null,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=99),(select cedula from ts_persona where ts_persona.codigo=99),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (100,  null,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=100),(select cedula from ts_persona where ts_persona.codigo=100),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (101, 135,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=101),(select cedula from ts_persona where ts_persona.codigo=101),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (102, 128,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=102),(select cedula from ts_persona where ts_persona.codigo=102),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (103,  null,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=103),(select cedula from ts_persona where ts_persona.codigo=103),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (104, 247,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=104),(select cedula from ts_persona where ts_persona.codigo=104),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (105,  null,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=105),(select cedula from ts_persona where ts_persona.codigo=105),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (106,  null,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=106),(select cedula from ts_persona where ts_persona.codigo=106),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (107,  null,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=107),(select cedula from ts_persona where ts_persona.codigo=107),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (108, 380,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=108),(select cedula from ts_persona where ts_persona.codigo=108),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (109, 417,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=109),(select cedula from ts_persona where ts_persona.codigo=109),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (110, 477,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=110),(select cedula from ts_persona where ts_persona.codigo=110),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (111, 553,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=111),(select cedula from ts_persona where ts_persona.codigo=111),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (112, 592,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=112),(select cedula from ts_persona where ts_persona.codigo=112),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (113,  null,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=113),(select cedula from ts_persona where ts_persona.codigo=113),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (114, 633,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=114),(select cedula from ts_persona where ts_persona.codigo=114),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (115, 657,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=115),(select cedula from ts_persona where ts_persona.codigo=115),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (116, 664,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=116),(select cedula from ts_persona where ts_persona.codigo=116),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (117,  null,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=117),(select cedula from ts_persona where ts_persona.codigo=117),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (118, 727,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=118),(select cedula from ts_persona where ts_persona.codigo=118),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (119, 1730,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=119),(select cedula from ts_persona where ts_persona.codigo=119),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (121, 773,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=121),(select cedula from ts_persona where ts_persona.codigo=121),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (122, 1721,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=122),(select cedula from ts_persona where ts_persona.codigo=122),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (123, 724,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=123),(select cedula from ts_persona where ts_persona.codigo=123),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (124, 1722,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=124),(select cedula from ts_persona where ts_persona.codigo=124),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (125, 856,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=125),(select cedula from ts_persona where ts_persona.codigo=125),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (126, 954,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=126),(select cedula from ts_persona where ts_persona.codigo=126),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (127,  null,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=127),(select cedula from ts_persona where ts_persona.codigo=127),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (128,  null,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=128),(select cedula from ts_persona where ts_persona.codigo=128),'A');
insert into ts_docente (codigo,num_empleado,passwd,login,estado) values (160,  null,(select md5(reverse(cast(cedula as varchar))) from ts_persona where ts_persona.codigo=160),(select cedula from ts_persona where ts_persona.codigo=160),'A');


--Datos de la tabla ts_est_cur_estudiante


insert into ts_est_cur_estudiante (codigo,descripcion,estado) values (1, 'APROBADO', 'A');
insert into ts_est_cur_estudiante (codigo,descripcion,estado) values (2, 'REPROBADO', 'R');
insert into ts_est_cur_estudiante (codigo,descripcion,estado) values (3, 'CURSANDO', 'C');




--Datos de la tabla ts_curso


insert into ts_curso (codigo,cod_ins_pen_periodo,cod_uni_curricular,cod_docente,seccion,fec_inicio,fec_final,observaciones) values (1, 1, 1,95
,1,'10/09/2012','30/09/2012','');
insert into ts_curso (codigo,cod_ins_pen_periodo,cod_uni_curricular,cod_docente,seccion,fec_inicio,fec_final,observaciones) values (2, 1, 1,104
,2,'10/09/2012','30/09/2012','');
insert into ts_curso (codigo,cod_ins_pen_periodo,cod_uni_curricular,cod_docente,seccion,fec_inicio,fec_final,observaciones) values (3, 1, 1,106
,3,'10/09/2012','30/09/2012','');
insert into ts_curso (codigo,cod_ins_pen_periodo,cod_uni_curricular,cod_docente,seccion,fec_inicio,fec_final,observaciones) values (4, 1, 2,127
,1,'10/09/2012','30/09/2012','');

insert into ts_curso (codigo,cod_ins_pen_periodo,cod_uni_curricular,cod_docente,seccion,fec_inicio,fec_final,observaciones) values (6, 1, 2,125
,2,'10/09/2012','30/09/2012','');

insert into ts_curso (codigo,cod_ins_pen_periodo,cod_uni_curricular,cod_docente,seccion,fec_inicio,fec_final,observaciones) values (8, 1, 2,91
,3,'10/09/2012','30/09/2012','');

insert into ts_curso (codigo,cod_ins_pen_periodo,cod_uni_curricular,cod_docente,seccion,fec_inicio,fec_final,observaciones) values (10, 1, 3,92
,1,'10/09/2012','30/09/2012','');
insert into ts_curso (codigo,cod_ins_pen_periodo,cod_uni_curricular,cod_docente,seccion,fec_inicio,fec_final,observaciones) values (11, 1, 3,124
,2,'10/09/2012','30/09/2012','');
insert into ts_curso (codigo,cod_ins_pen_periodo,cod_uni_curricular,cod_docente,seccion,fec_inicio,fec_final,observaciones) values (12, 1, 3,124
,3,'10/09/2012','30/09/2012','');

alter sequence ts_curso_codigo_seq restart with 100;




--Datos de la tabla ts_cur_estudiante


insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (1, 1, 0,18,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (5, 1, 0,7,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (10, 1, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (137, 1, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (13, 1, 0,19,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (139, 1, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (16, 1, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (19, 1, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (22, 1, 0,15,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (134, 1, 0,20,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (25, 1, 0,7,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (138, 1, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (28, 1, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (31, 1, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (34, 1, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (37, 1, 0,18,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (40, 1, 0,7,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (43, 1, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (44, 1, 0,7,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (135, 1, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (47, 1, 0,8,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (131, 1, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (50, 1, 0,8,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (53, 1, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (56, 1, 0,9,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (129, 1, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (130, 1, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (136, 1, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (61, 1, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (64, 1, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (67, 1, 0,8,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (70, 1, 0,18,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (73, 1, 0,9,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (75, 1, 0,11,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (79, 1, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (82, 1, 0,15,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (85, 1, 0,9,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (88, 1, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (1, 4, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (5, 4, 0,10,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (10, 4, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (137, 4, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (13, 4, 0,10,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (139, 4, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (16, 4, 0,7,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (19, 4, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (22, 4, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (134, 4, 0,20,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (25, 4, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (138, 4, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (28, 4, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (31, 4, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (34, 4, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (37, 4, 0,18,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (40, 4, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (43, 4, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (44, 4, 0,10,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (135, 4, 0,8,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (47, 4, 0,15,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (131, 4, 0,16,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (50, 4, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (53, 4, 0,15,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (56, 4, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (129, 4, 0,9,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (130, 4, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (136, 4, 0,6,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (61, 4, 0,6,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (64, 4, 0,8,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (67, 4, 0,8,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (70, 4, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (73, 4, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (75, 4, 0,10,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (79, 4, 0,17,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (82, 4, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (85, 4, 0,16,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (88, 4, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (1, 10, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (5, 10, 0,16,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (10, 10, 0,15,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (137, 10, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (13, 10, 0,18,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (139, 10, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (16, 10, 0,17,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (19, 10, 0,17,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (22, 10, 0,19,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (134, 10, 0,18,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (25, 10, 0,16,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (138, 10, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (28, 10, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (31, 10, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (34, 10, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (37, 10, 0,18,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (40, 10, 0,17,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (43, 10, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (44, 10, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (135, 10, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (47, 10, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (131, 10, 0,18,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (50, 10, 0,16,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (53, 10, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (56, 10, 0,15,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (129, 10, 0,18,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (130, 10, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (136, 10, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (61, 10, 0,15,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (64, 10, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (67, 10, 0,15,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (70, 10, 0,18,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (73, 10, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (75, 10, 0,16,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (79, 10, 0,19,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (82, 10, 0,18,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (85, 10, 0,15,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (88, 10, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (140, 2, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (3, 2, 0,16,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (6, 2, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (7, 2, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (11, 2, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (14, 2, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (141, 2, 0,16,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (17, 2, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (20, 2, 0,2,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (23, 2, 0,6,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (142, 2, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (26, 2, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (29, 2, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (32, 2, 0,6,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (33, 2, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (143, 2, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (35, 2, 0,7,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (38, 2, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (144, 2, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (41, 2, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (45, 2, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (145, 2, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (48, 2, 0,16,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (51, 2, 0,6,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (54, 2, 0,6,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (146, 2, 0,15,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (147, 2, 0,6,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (57, 2, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (132, 2, 0,6,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (59, 2, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (62, 2, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (65, 2, 0,6,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (68, 2, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (71, 2, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (74, 2, 0,2,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (76, 2, 0,6,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (80, 2, 0,7,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (83, 2, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (148, 2, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (86, 2, 0,6,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (89, 2, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (140, 6, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (3, 6, 0,17,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (6, 6, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (7, 6, 0,16,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (11, 6, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (14, 6, 0,18.5,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (141, 6, 0,20,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (17, 6, 0,4,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (20, 6, 0,2.5,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (23, 6, 0,4,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (142, 6, 0,14.5,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (26, 6, 0,8,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (29, 6, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (32, 6, 0,8,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (33, 6, 0,20,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (143, 6, 0,10.5,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (35, 6, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (38, 6, 0,13,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (144, 6, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (41, 6, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (45, 6, 0,8,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (145, 6, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (48, 6, 0,20,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (51, 6, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (54, 6, 0,2.5,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (146, 6, 0,16,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (147, 6, 0,16,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (57, 6, 0,2.5,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (132, 6, 0,5,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (59, 6, 0,16,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (62, 6, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (65, 6, 0,5,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (68, 6, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (71, 6, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (74, 6, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (76, 6, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (80, 6, 0,10.5,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (83, 6, 0,5,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (148, 6, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (86, 6, 0,20,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (89, 6, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (140, 11, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (3, 11, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (6, 11, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (7, 11, 0,15,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (11, 11, 0,18,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (14, 11, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (141, 11, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (17, 11, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (20, 11, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (23, 11, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (142, 11, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (26, 11, 0,15,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (29, 11, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (32, 11, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (33, 11, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (143, 11, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (35, 11, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (38, 11, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (144, 11, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (41, 11, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (45, 11, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (145, 11, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (48, 11, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (51, 11, 0,15,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (54, 11, 0,18,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (146, 11, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (147, 11, 0,15,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (57, 11, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (132, 11, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (59, 11, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (62, 11, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (65, 11, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (68, 11, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (71, 11, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (74, 11, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (76, 11, 0,13,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (80, 11, 0,13,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (83, 11, 0,16,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (148, 11, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (86, 11, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (89, 11, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (2, 3, 0,10,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (4, 3, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (8, 3, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (9, 3, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (149, 3, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (150, 3, 0,6,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (12, 3, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (15, 3, 0,4,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (151, 3, 0,6,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (18, 3, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (21, 3, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (24, 3, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (27, 3, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (152, 3, 0,19,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (30, 3, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (36, 3, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (39, 3, 0,4,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (42, 3, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (153, 3, 0,20,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (46, 3, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (49, 3, 0,4,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (52, 3, 0,3,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (154, 3, 0,3,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (55, 3, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (58, 3, 0,6,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (133, 3, 0,16,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (60, 3, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (63, 3, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (66, 3, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (69, 3, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (72, 3, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (155, 3, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (158, 3, 0,7,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (77, 3, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (81, 3, 0,17,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (84, 3, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (87, 3, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (156, 3, 0,13,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (157, 3, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (2, 8, 0,18,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (4, 8, 0,17,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (8, 8, 0,16,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (9, 8, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (149, 8, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (150, 8, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (12, 8, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (15, 8, 0,16,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (151, 8, 0,16,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (18, 8, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (21, 8, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (24, 8, 0,15,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (27, 8, 0,18,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (152, 8, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (30, 8, 0,18,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (36, 8, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (39, 8, 0,18,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (42, 8, 0,13,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (153, 8, 0,18,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (46, 8, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (49, 8, 0,16,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (52, 8, 0,13,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (154, 8, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (55, 8, 0,7,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (58, 8, 0,16,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (133, 8, 0,20,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (60, 8, 0,13,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (63, 8, 0,16,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (66, 8, 0,13,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (69, 8, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (72, 8, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (155, 8, 0,15,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (158, 8, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (77, 8, 0,13,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (81, 8, 0,18,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (84, 8, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (87, 8, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (156, 8, 0,17,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (157, 8, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (2, 12, 0,16,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (4, 12, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (8, 12, 0,15,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (9, 12, 0,16,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (149, 12, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (150, 12, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (12, 12, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (15, 12, 0,16,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (151, 12, 0,17,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (18, 12, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (21, 12, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (24, 12, 0,15,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (27, 12, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (152, 12, 0,16,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (30, 12, 0,17,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (36, 12, 0,13,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (39, 12, 0,18,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (42, 12, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (153, 12, 0,16,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (46, 12, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (49, 12, 0,16,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (52, 12, 0,18,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (154, 12, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (55, 12, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (58, 12, 0,15,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (133, 12, 0,20,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (60, 12, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (63, 12, 0,17,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (66, 12, 0,15,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (69, 12, 0,13,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (72, 12, 0,15,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (155, 12, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (158, 12, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (77, 12, 0,12,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (81, 12, 0,14,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (84, 12, 0,1,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (87, 12, 0,15,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (156, 12, 0,15,'C','');
insert into ts_cur_estudiante (cod_estudiante,cod_curso,por_asistencia,nota,estado,observaciones) values (157, 12, 0,13,'C','');




--Datos de la tabla ts_fotografia


Insert into ts_fotografia(cod_persona,imagen)values(29,lo_import('/var/www/Sistemacn/Otros/imagen/29.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(6,lo_import('/var/www/Sistemacn/Otros/imagen/6.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(22,lo_import('/var/www/Sistemacn/Otros/imagen/22.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(51,lo_import('/var/www/Sistemacn/Otros/imagen/51.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(49,lo_import('/var/www/Sistemacn/Otros/imagen/49.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(73,lo_import('/var/www/Sistemacn/Otros/imagen/73.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(24,lo_import('/var/www/Sistemacn/Otros/imagen/24.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(129,lo_import('/var/www/Sistemacn/Otros/imagen/129.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(52,lo_import('/var/www/Sistemacn/Otros/imagen/52.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(41,lo_import('/var/www/Sistemacn/Otros/imagen/41.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(79,lo_import('/var/www/Sistemacn/Otros/imagen/79.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(12,lo_import('/var/www/Sistemacn/Otros/imagen/12.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(18,lo_import('/var/www/Sistemacn/Otros/imagen/18.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(66,lo_import('/var/www/Sistemacn/Otros/imagen/66.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(130,lo_import('/var/www/Sistemacn/Otros/imagen/130.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(25,lo_import('/var/www/Sistemacn/Otros/imagen/25.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(38,lo_import('/var/www/Sistemacn/Otros/imagen/38.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(86,lo_import('/var/www/Sistemacn/Otros/imagen/86.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(76,lo_import('/var/www/Sistemacn/Otros/imagen/76.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(8,lo_import('/var/www/Sistemacn/Otros/imagen/8.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(28,lo_import('/var/www/Sistemacn/Otros/imagen/28.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(55,lo_import('/var/www/Sistemacn/Otros/imagen/55.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(74,lo_import('/var/www/Sistemacn/Otros/imagen/74.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(69,lo_import('/var/www/Sistemacn/Otros/imagen/69.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(131,lo_import('/var/www/Sistemacn/Otros/imagen/131.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(72,lo_import('/var/www/Sistemacn/Otros/imagen/72.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(7,lo_import('/var/www/Sistemacn/Otros/imagen/7.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(5,lo_import('/var/www/Sistemacn/Otros/imagen/5.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(48,lo_import('/var/www/Sistemacn/Otros/imagen/48.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(23,lo_import('/var/www/Sistemacn/Otros/imagen/23.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(34,lo_import('/var/www/Sistemacn/Otros/imagen/34.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(81,lo_import('/var/www/Sistemacn/Otros/imagen/81.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(62,lo_import('/var/www/Sistemacn/Otros/imagen/62.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(4,lo_import('/var/www/Sistemacn/Otros/imagen/4.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(11,lo_import('/var/www/Sistemacn/Otros/imagen/11.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(26,lo_import('/var/www/Sistemacn/Otros/imagen/26.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(70,lo_import('/var/www/Sistemacn/Otros/imagen/70.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(53,lo_import('/var/www/Sistemacn/Otros/imagen/53.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(14,lo_import('/var/www/Sistemacn/Otros/imagen/14.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(132,lo_import('/var/www/Sistemacn/Otros/imagen/132.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(58,lo_import('/var/www/Sistemacn/Otros/imagen/58.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(56,lo_import('/var/www/Sistemacn/Otros/imagen/56.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(83,lo_import('/var/www/Sistemacn/Otros/imagen/83.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(133,lo_import('/var/www/Sistemacn/Otros/imagen/133.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(21,lo_import('/var/www/Sistemacn/Otros/imagen/21.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(15,lo_import('/var/www/Sistemacn/Otros/imagen/15.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(82,lo_import('/var/www/Sistemacn/Otros/imagen/82.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(50,lo_import('/var/www/Sistemacn/Otros/imagen/50.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(88,lo_import('/var/www/Sistemacn/Otros/imagen/88.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(10,lo_import('/var/www/Sistemacn/Otros/imagen/10.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(75,lo_import('/var/www/Sistemacn/Otros/imagen/75.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(64,lo_import('/var/www/Sistemacn/Otros/imagen/64.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(39,lo_import('/var/www/Sistemacn/Otros/imagen/39.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(61,lo_import('/var/www/Sistemacn/Otros/imagen/61.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(37,lo_import('/var/www/Sistemacn/Otros/imagen/37.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(43,lo_import('/var/www/Sistemacn/Otros/imagen/43.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(87,lo_import('/var/www/Sistemacn/Otros/imagen/87.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(68,lo_import('/var/www/Sistemacn/Otros/imagen/68.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(30,lo_import('/var/www/Sistemacn/Otros/imagen/30.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(85,lo_import('/var/www/Sistemacn/Otros/imagen/85.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(40,lo_import('/var/www/Sistemacn/Otros/imagen/40.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(71,lo_import('/var/www/Sistemacn/Otros/imagen/71.jpg'));
Insert into ts_fotografia(cod_persona,imagen)values(67,lo_import('/var/www/Sistemacn/Otros/imagen/67.jpg'));


\connect postgres;

	


