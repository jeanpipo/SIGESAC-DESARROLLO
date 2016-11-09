\connect postgres;

\connect bd_sisconot;

insert into sis.t_tip_uni_curricular(codigo,nombre) values ('O','Obligatoria');
insert into sis.t_tip_uni_curricular(codigo,nombre) values ('E','Electiva');
insert into sis.t_tip_uni_curricular(codigo,nombre) values ('A','Acreditable');

insert into sis.t_est_periodo(codigo,nombre) values ('A', 'Abierto');
insert into sis.t_est_periodo(codigo,nombre) values ('C', 'Cerrado');

insert into sis.t_est_cur_estudiante(codigo,nombre) values ('I','Inscrito');
insert into sis.t_est_cur_estudiante(codigo,nombre) values ('C','Cursando');
insert into sis.t_est_cur_estudiante(codigo,nombre) values ('E','Reprobado por Inasistencia');
insert into sis.t_est_cur_estudiante(codigo,nombre) values ('X','Retirado');
insert into sis.t_est_cur_estudiante(codigo,nombre) values ('A','Aprobado');
insert into sis.t_est_cur_estudiante(codigo,nombre) values ('R','Reprobado');

INSERT INTO sis.t_instituto(codigo, nom_corto, nombre, direccion) VALUES (1, 'IUTFRP', 'IUT Federico Rivero Palacio', 'k8 de la panamericana');
INSERT INTO sis.t_instituto(codigo, nom_corto, nombre, direccion) VALUES (2, 'CULCA', 'CU CECILIO ACOSTA', 'LOS TEQUES');
INSERT INTO sis.t_instituto(codigo, nom_corto, nombre, direccion) VALUES (3, 'CUC', 'IUT CU DE CARACAS', 'CHACAO');


INSERT INTO sis.t_pensum(codigo, nombre, nom_corto, observaciones, min_can_electiva, min_cre_electiva,min_cre_obligatoria, fec_creacion) VALUES (101, 'Programa Nacional de Formación Informática',   'PNFI', 'PNFI 2008' ,   2,  1,  2,  '2008-01-01');
INSERT INTO sis.t_pensum(codigo, nombre, nom_corto, observaciones, min_can_electiva, min_cre_electiva,min_cre_obligatoria, fec_creacion) VALUES (1,	'Programa Nacional de Formación Informática',	'PNFI8',	'PNFI 2015' ,	2,	1,	2,	'2015-01-01');
INSERT INTO sis.t_pensum(codigo, nombre, nom_corto, observaciones, min_can_electiva, min_cre_electiva,min_cre_obligatoria, fec_creacion) VALUES (2,	'Programa Nacional de Formación MECANICA',	'PNFM',	'PNFM 2008' ,	2,	1,	2,	'2008-01-01');
INSERT INTO sis.t_pensum(codigo, nombre, nom_corto, observaciones, min_can_electiva, min_cre_electiva,min_cre_obligatoria, fec_creacion) VALUES (3,	'Programa Nacional de Formación QUIMICA',	'PNFQ',	'PNFQ 2008' ,	2,	1,	2,	'2008-01-01');
INSERT INTO sis.t_pensum(codigo, nombre, nom_corto, observaciones, min_can_electiva, min_cre_electiva,min_cre_obligatoria, fec_creacion) VALUES (4,	'Programa Nacional de Formación TELECOMINICACIONES','PNFT','PNFT 2008' ,	2,	1,	2,	'2008-01-01');
INSERT INTO sis.t_pensum(codigo, nombre, nom_corto, observaciones, min_can_electiva, min_cre_electiva,min_cre_obligatoria, fec_creacion) VALUES (5,	'Programa Nacional de Formación ELECTRONICA',	'PNFE',	'PNFE 2008' ,	2,	1,	2,	'2008-01-01');
INSERT INTO sis.t_pensum(codigo, nombre, nom_corto, observaciones, min_can_electiva, min_cre_electiva,min_cre_obligatoria, fec_creacion) VALUES (6,	'Programa Nacional de Formación ADMINISTRACION','PNFA',	'PNFA 2008' ,	2,	1,	2,	'2008-01-01');
INSERT INTO sis.t_pensum(codigo, nombre, nom_corto, observaciones, min_can_electiva, min_cre_electiva,min_cre_obligatoria, fec_creacion) VALUES (101, 'Programa Nacional de Formación Informática',   'PNFI', 'PNFI 2008' ,   2,  1,  2,  '2008-01-01');



INSERT INTO sis.t_periodo values(1,'2016-2016',1,1,'2016-01-01','2017-01-01','','A');
INSERT INTO sis.t_periodo values(2,'2016-2016',1,2,'2016-01-01','2017-01-01','','A');
INSERT INTO sis.t_periodo values(3,'2016-2016',1,3,'2016-01-01','2017-01-01','','A');
INSERT INTO sis.t_periodo values(4,'2016-2016',2,4,'2016-01-01','2017-01-01','','A');
INSERT INTO sis.t_periodo values(5,'2016-2016',2,5,'2016-01-01','2017-01-01','','A');
INSERT INTO sis.t_periodo values(6,'2016-2016',3,6,'2016-01-01','2017-01-01','','A');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (4,      'PIMT113',        'MATEMÁTICA  I',                                            60,     30,     3,              12,           12,                  20,          'Lógica', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (5,      'PIAC113',        'ARQUITECTURA DEL COMPUTADOR  ',                             60,     30,     3,              12,           12,                  20,          'Estructura del computador', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (6,      'PIFC111',        'FORMACIÓN CRÍTICA I',                                       24,     6,      1,              12,           12,                  20,          'DEPORTE , RECREACIÓN Y CULTURA I', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                                 hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (7,      'PIFC121',        'FORMACIÓN CRÍTICA I',     24,     6,     1,              12,           12,                  20,          'INFORMÁTICA, POLÍTICA DE ESTADO Y SOBERANÍA I', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (8,      'PIAP114',        'ALGORÍTMICA Y PROGRAMACIÓN',                                            78,     42,     4,              12,           12,                  20,          'PROGRAMACIÓN I', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (9,      'PIAP124',        'ALGORÍTMICA Y PROGRAMACIÓN',                                            78,     42,     4,              12,           12,                  20,          'PROGRAMACIÓN II', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (10,      'PIAP134',        'ALGORÍTMICA Y PROGRAMACIÓN',                                            78,     48,     4,              12,           12,                  20,          'PROGRAMACIÓN II', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (11,      'PIPT113',        'PROYECTO SOCIOTECNOLÓGICO I',                              60,     30,     3,              12,           12,                  20,          'SOPORTE TÉCNICO A USUARIOS Y EQUIPOS I', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (12,      'PIPT123 ',        'PROYECTO SOCIOTECNOLÓGICO I',                              60,     30,     3,              12,           12,                  20,          'SOPORTE TÉCNICO A USUARIOS Y EQUIPOS II', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (13,      'PIPT133 ',        'PROYECTO SOCIOTECNOLÓGICO I',                              60,     30,     3,              12,           12,                  20,          'SOPORTE TÉCNICO A USUARIOS Y EQUIPOS III', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (14,      'PIEL123',        'ELECTIVA I',                                              60,     30,     3,              12,           12,                  20,          'DISEÑO INSTRUCCIONAL EN LAS TIC', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (15,      'PIID111',        'IDIOMAS',                                                  24,     06,     1,              12,           12,                  20,          'INGLÉS COMPRENSIÓN LECTORA I', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (16,      'PIID121',        'IDIOMAS',                                                  24,     06,     1,              12,           12,                  20,          'INGLÉS COMPRENSIÓN LECTORA II', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (17,      'PIID131',        'IDIOMAS',                                                  24,     06,     1,              12,           12,                  20,          'INGLÉS COMPRENSIÓN LECTORA III', '','');


INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (18,      'PIMT213',        'MATEMÁTICA  II',                                            60,     30,     3,              12,           12,                  20,          'CALCULO II', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (19,      'PIMT223 ',        'MATEMÁTICA  II',                                            60,     30,     3,              12,           12,                  20,          'ÁLGEBRA LINEAL', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (20,      'PIRC213',        'REDES DE COMPUTADORAS',                                            60,     30,     3,              12,           12,                  20,          'FUNDAMENTOS Y COMPONENTES DE REDES', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (21,      'PIRC223 ',        'REDES DE COMPUTADORAS',                                            60,     30,     3,              12,           12,                  20,          'ADMINISTRACIÓN, PRINCIPIOS DE ENRUTAMIENTO Y SUBREDES', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (22,      'PIFC211',        'FORMACIÓN CRÍTICA II',                                    60,     30,     1,              12,           12,                  20,          'INFORMÁTICA, TECNOLOGÍA Y SOCIEDAD I', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (23,      'PIFC221',        'FORMACIÓN CRÍTICA II',                                    60,     30,     1,              12,           12,                  20,          'INFORMÁTICA, TECNOLOGÍA Y SOCIEDAD II', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (24,      'PIFC231',        'PARADIGMAS DE PROGRAMACIÓN',                              72,     48,     4,              12,           12,                  20,          'PROGRAMACIÓN III', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (25,      'PIPP214',        'PARADIGMAS DE PROGRAMACIÓN',                              72,     48,     4,              12,           12,                  20,          'PROGRAMACIÓN III', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (26,      'PIPP224',        'PARADIGMAS DE PROGRAMACIÓN',                              72,     48,     4,              12,           12,                  20,          'PROGRAMACIÓN IV', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (27,      'PIPP234',        'PARADIGMAS DE PROGRAMACIÓN',                              72,     48,     4,              12,           12,                  20,          'PROGRAMACIÓN V', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (28,      'PIPT213',        'PROYECTO SOCIO TECNOLÓGICO II',                              60,     30,     3,              12,           12,                  20,          'DESARROLLO DE SOLUCIONES INFORMÁTICAS I', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (29,      'PIPT223',        'PROYECTO SOCIO TECNOLÓGICO II',                              60,     30,     3,              12,           12,                  20,          'DESARROLLO DE SOLUCIONES INFORMÁTICAS II', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (30,      'PIPT233',        'PROYECTO SOCIO TECNOLÓGICO II',                              60,     30,     3,              12,           12,                  20,          'DESARROLLO DE SOLUCIONES INFORMÁTICAS III', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (31,      'PIIS233',        'INGENIERÍA DEL SOFTWARE I',                              60,     30,     3,              12,           12,                  20,          'FUNDAMENTOS DE SISTEMAS E INGENIERÍA DEL SOFTWARE', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (32,      'PIBD213',        'BASES DE DATOS',                              60,     30,     3,              12,           12,                  20,          'BASES DE DATOS', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (33,      'PIEL233',        'ELECTIVA II',                              60,     30,     3,              12,           12,                  20,          'VOZ Y TELEFONÍA IP (VoIP)', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (34,      'PIEL243',        'ELECTIVA II',                              60,     30,     3,              12,           12,                  20,          'EDUMATICA', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (35,      'PIID211',        'IDIOMAS',                                          24,     6,     1,              12,           12,                  20,          'INGLÉS ­  REDACCIÓN I', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (36,      'PIID221',        'IDIOMAS',                                          24,     6,     1,              12,           12,                  20,          'INGLÉS ­  REDACCIÓN II', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (37,      'PIID231',        'IDIOMAS',                                          24,     6,     1,              12,           12,                  20,          'INGLÉS ­  REDACCIÓN III', '','');



INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (38,      'PIMA313 ',        'MATEMÁTICA  APLICADA',                                        60,     30,     3,              12,           12,                  20,          'ESTADÍSTICA Y PROBABILIDADES II', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (39,      'PIMA323 ',        'MATEMÁTICA  APLICADA',                                        60,     30,     3,              12,           12,                  20,          'MATEMÁTICA DISCRETA', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (40,      'PIIO333',        'INVESTIGACIÓN DE OPERACIONES',                                        60,     30,     3,              12,           12,                  20,          'INVESTIGACIÓN DE OPERACIONES', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (41,      'PISO313',        'SISTEMAS OPERATIVOS',                                        60,     30,     3,              12,           12,                  20,          'SISTEMAS OPERATIVOS II', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (42,      'PIFC311',        'FORMACIÓN CRÍTICA III  ',                                   24,     6,     3,              12,           12,                  20,          'CULTURA, DEPORTE Y RECREACIÓN III', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (43,      'PIFC321',        'FORMACIÓN CRÍTICA III  ',                                   24,     6,     1,              12,           12,                  20,          'INFORMÁTICA, COMUNICACIÓN Y TRANSFORMACIÓN I', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (44,      'PIFC331',        'FORMACIÓN CRÍTICA III  ',                                   24,     6,     1,              12,           12,                  20,          'INFORMÁTICA, COMUNICACIÓN Y TRANSFORMACIÓN II', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (45,      'PIPT313',        'PROYECTO SOCIO TECNOLÓGICO III',                       60,     30,     3,              12,           12,                  20,          'DESARROLLO DE APLICACIONES INFORMÁTICAS I', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (46,      'PIPT323 ',        'PROYECTO SOCIO TECNOLÓGICO III',                      60,     30,     3,              12,           12,                  20,          'DESARROLLO DE APLICACIONES INFORMÁTICAS II  ', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (47,      'PIPT333',        'PROYECTO SOCIO TECNOLÓGICO III',                       60,     30,     3,              12,           12,                  20,          'DESARROLLO DE APLICACIONES INFORMÁTICAS III', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (48,      'PIIS313',        'INGENIERÍA DEL SOFTWARE II',                       60,     30,     3,              12,           12,                  20,          'FUNDAMENTOS DE INGENIERÍA DE REQUISITOS Y ANÁLISIS', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (49,      'PIIS323',        'INGENIERÍA DEL SOFTWARE II',                       60,     30,     3,              12,           12,                  20,          'FUNDAMENTOS DEL DISEÑO DE SOFTWARE', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (50,      'PIIS333',        'INGENIERÍA DEL SOFTWARE II',                       60,     30,     3,              12,           12,                  20,          'PRUEBAS Y VALIDACIÓN DE SOFTWARE', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (51,      'PIMB333 ',        'MODELADO  DE BASES DE DATOS',                       60,     30,     3,              12,           12,                  20,          'MODELADO  DE BASES DE DATOS', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (52,      'PIEL323',        'ELECTIVA III',                       60,     30,     3,              12,           12,                  20,          'COMUNICACIONES VÍA SATÉLITE', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (53,      'PIEL324',        'ELECTIVA III',                       60,     30,     3,              12,           12,                  20,          'TECNOLOGÍAS INTERNET', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (54,      'PIRA423',        'REDES AVANZADAS',                       60,     30,     3,              12,           12,                  20,          'REDES DE TELECOMUNICACIONES Y DE DATOS', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (55,      'PIFC411',        'FORMACIÓN CRÍTICA IV',                       24,     6,     1,              12,           12,                  20,          'INFORMÁTICA, GLOBALIZACIÓN Y CULTURA I', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (56,      'PIFC421 ',        'FORMACIÓN CRÍTICA IV',                       24,     6,     1,              12,           12,                  20,          'INFORMÁTICA, GLOBALIZACIÓN Y CULTURA II', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (57,      'PIFC431 ',        'FORMACIÓN CRÍTICA IV',                       24,     6,     1,              12,           12,                  20,          'CULTURA, DEPORTE Y RECREACIÓN IV', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (58,      'PIPT414 ',        'PROYECTO SOCIOTECNOLÓGICO IV',                       60,     30,     4,              12,           12,                  20,          'GESTIÓN DE PROYECTOS I', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (59,      'PIPT424 ',        'PROYECTO SOCIOTECNOLÓGICO IV',                       60,     30,     4,              12,           12,                  20,          'GESTIÓN DE PROYECTOS II', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (60,      'PIPT434 ',        'PROYECTO SOCIOTECNOLÓGICO IV',                       72,     48,     4,              12,           12,                  20,          'GESTIÓN DE PROYECTOS III', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (61,      'PISI414  ',        'SEGURIDAD INFORMÁTICA',                       72,     48,     4,              12,           12,                  20,          ' SEGURIDAD INFORMÁTICA', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (62,      'PIGP424 ',        'GESTIÓN DE PROYECTOS INFORMÁTICOS',                       72,     48,     4,              12,           12,                  20,          'GESTIÓN DE PROYECTOS INFORMÁTICOS', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (63,      'PIAI434 ',        'AUDITORÍA INFORMÁTICA',                       72,     48,     4,              12,           12,                  20,          'AUDITORÍA INFORMÁTICA', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (64,      'PIAB413 ',        'ADMINISTRACIÓN DE BASES DE DATOS',                     60,     30,     3,              12,           12,                  20,          'AUDITORÍA INFORMÁTICA', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (65,      'PIEL433 ',        'ELECTIVA IV',                     60,     30,     3,              12,           12,                  20,          'APLICACIONES MULTIMEDIA', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (66,      'PIID411 ',        'IDIOMAS',                     24,     6,    1,              12,           12,                  20,          'CONVERSACIONAL I', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (67,      'PIID421 ',        'IDIOMAS',                     24,     6,    1,              12,           12,                  20,          'CONVERSACIONAL II', '','');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (68,      'PIID431 ',        'IDIOMAS',                     24,     6,    1,              12,           12,                  20,          'CONVERSACIONAL III', '','');



/*-------------------  trayecto incial     ----------------*/
INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                              hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (101,      'MAC015',        'Matemática',                                            5,      5,     5,              12,           12,                  20,          'Se desarrollará mediante ejercicios prácticos',  '', 'Unidad 1: Conjuntos numéricos
    Unidad 2: Expresiones Algebraicas  Unidad 3: Radicación de números reales  Unidad 4: Ecuaciones e Inecuaciones  ');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,  observacion, contenido)
    VALUES (102,      'PNS013',        'Proyecto Nacional y Nueva Ciudadanía',                        4,      2.5,     3,              12,           12,                  20,          'La sociedad multiétnica y pluricultural.', '','Unidad 1: La sociedad multiétnica y pluricultural.
    Unidad 2: Soberanía, territorio y petróleo.  Unidad 3: Estado democrático-social de derecho y justicia. Unidad 4: Proyecto de Desarrollo Nacional (Simón Bolívar) 2007-2013');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (103,      'IPC012',        'Introducción a los Proyectos y al PNF',                       2,     2.5,      2,              12,           12,                  20,          'Lecturas críticas de los materiales propuestos para la ', '','UNIDAD 1: Interacción participante – universidad - comunidad  UNIDAD 2: Inducción al PNFI UNIDAD 3: Línea de vida/autobiografía UNIDAD 4: Aprendizaje como formación integral');


/*-------------------  trayecto I    ----------------*/

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (104,      'MAC139',        ' Matemática I',                           5,      1.5,    9,              12,           12,                  20,          'Elementos del lenguaje', '','Unidad 1:Lenguaje  Unidad 2: Cálculo Proposicional Unidad 3: Reglas de Formación 
        Unidad 4: Reglas de Inferencia ');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (105,      'ACT139',        'Arquitectura del Computador',                                 5,     1.5,    9,              12,           12,                  20,          'El Computador', '','Unidad 1:El Computador Unidad 2: Hardware Unidad 3: Ensamblaje  Unidad 4: Sistemas Operativos');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (106,      'APT1312',        'Algorítmica y Programación',                                 6,      2.5,    9,              12,           12,                  20,          'El Computador', '','Unidad 1: Algoritmo y Programas Unidad 2: Estándares de Calidad en el Diseño de Algoritmos y  Unidad 3: Datos y Entidades Primitivas  Unidad 4: Metodología para el Análisis y Planteamiento de Problemas');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (107,      'FCS133',        'Formación Crítica I',                                         2,     0.5,    3,              12,           12,                  20,          'Proyecto de Desarrollo Nacional', '','Unidad 1: Proyecto de Desarrollo Nacional (Simón Bolívar) 2007-2013 Unidad 2: Vinculación del Programa Nacional de Formación en Informática con el Plan de Desarrollo Económico y Social de la Nación.');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (108,      'PTP139',        'Proyecto Socio tecnológico I',                                6,      0.5,    9,              12,           12,                  20,          'Los actores deben abordar la comunidad para conocerla, describirla y detectar necesidades.', '','Unidad 1: La comunidad como resultado de la universidad   Unidad 2: Principios del Enfoque del Marco Lógico (EML) Unidad 3: Definición e identificación del problema');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (109,      'IDC133',        'Inglés',                                                      2,      0.5,    3,              12,           12,                  20,          'Definiciones técnicas', '','Unidad 1: Manejo y uso del diccionario Unidad 2: Técnicas para facilitar la comprensión del vocabulario y la terminología técnica de la especialidad  Unidad 3: Cognados');


/*-------------------  trayecto II    ----------------*/

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                              hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (110,      'MAC226',        'Matemática II',                                        5,      1.5,    6,              12,           12,                  20,          'Definición: Antiderivada', '','Unidad 1: Integrales  Unidad 2: Ecuaciones diferenciales  Unidad 3: Vectores Unidad 4: Matrices Unidad 5: Determinantes');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                              hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (111,      'RCT226',        'Redes de Computadoras',                                5,      1.5,    6,              12,           12,                  20,          'Fundamentos de la POO', '','Unidad 1.Introducción a la Programación Orientada a Objetos  Unidad 2:Lenguaje de Programación Orientada a Objeto  Unidad 3: Herencia');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                              hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (112,      'POT2312',        'Programación II',                                     6,      2.5,    12,              12,           12,                  20,          'El Computador', '','Unidad 1: Algoritmo y Programas Unidad 2: Estándares de Calidad en el Diseño de Algoritmos y  Unidad 3: Datos y Entidades Primitivas  Unidad 4: Metodología para el Análisis y Planteamiento de Problemas');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (113,      'ISC213',        'Ingeniería del Software I',                                  5,      2,    3,              12,           12,                  20,          'Introducción a los sistemas', '','Unidad 1:Fundamentos de Sistemas  Unidad 2:Fundamentos de la Ingeniería del Software Unidad 3: Proceso de Desarrollo de Software.');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (114,      'BDC213',        'Bases de Datos',                                             5,      2,    3,                 12,           12,                  20,          'Concepto de sistema de base de datos', '','Unidad 1. El mundo de las bases de datos y los sistemas manejadores de base de datos  Unidad 2: Elementos para interpretar el modelo conceptual de datos Unidad 3: El modelo de datos relacional');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (115,      'FCS233',        'Formación Crítica II',                                       2,      0.5,    3,              12,           12,                  20,          'Definiciones técnicas', '','Unidad 1: Políticas para el adquisición y desarrollo de Software Libre en la Administración Pública Nacional  Unidad 3: Plan de Tecnología, información y comunicación');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (116,      'PTP239',        'Proyecto Socio Tecnológico II',                              6,      0.5,    9,              12,           12,                  20,          'Orientaciones para el desarrollo de proyectos', '','Unidad 1: Problema o situación que requiera desarrollo de aplicaciones informáticas Unidad 2: Planteamiento del proyecto sociotecnológico ');


/*-------------------  trayecto III    ----------------*/


INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (117,      'MAC326',        'Matemática Aplicada',                                        5,      1.5,    6,              12,           12,                  20,          'Discretas, Distribuciones en el muestreo ', '','Unidad 1: Funciones de distribución de probabilidad Unidad 2: Muestreo y estimación Unidad 3: Prueba de hipótesis ');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (118,      'IOC313',        'Investigación de Operaciones',                               5,      1.5,    3,              12,           12,                  20,          'Historia de la Investigación de Operaciones', '','Unidad 1: Introducción a la investigación de operaciones Unidad 2: Programación lineal Unidad 3: Modelo de transporte y asignación de recursos');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (119,      'SOC313',        'Sistemas Operativos',                                        5,      1.5,    3,              12,           12,                  20,          'Monolítica', '','Unidad 1: Software Unidad 2: Sistemas Operativos  Unidad 3: Estructura de los Sistemas Operativos');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (120,      'ISC339',        'Ingeniería del Software II',                                 5,      2,      9,              12,           12,                  20,          'Diseño de bases de datos.', '','Unidad 1: Modelado de Negocio Unidad 2: Ingeniería de Requisitos. Unidad 3: Análisis y especificación de Requisitos');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (121,      'BDC313',        'Modelado de Bases de Datos',                                 5,     1.5,    3,              12,           12,                  20,          'Definición de modelo, modelamiento conceptua', '','Unidad 1: Diseño Conceptual de una Base de Datos Unidad 2:Diseño Avanzado de bases de datos Unidad 3: Consultas Avanzadas en Bases de Datos');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (122,      'FCS333',        'Formación Crítica III',                                      2,      0.5,    3,              12,           12,                  20,          'Plataformas y redes de comunicación', '','Unidad 1: Informática, comunicación y transformación del sistema social 2: Elaboración de Políticas para el uso y desarrollo de Software Libre en la Administración Pública Nacional');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (123,      'PTP339',        'Proyecto Socio Tecnológico III',                             6,      0.5,    9,              12,           12,                  20,          'Diagnóstico Participativo', '','Unidad 1: Problema o situación que requiera desarrollo de aplicaciones informáticas Unidad 2: Planteamiento del proyecto Unidad 3: Planificación de Proyectos');


/*--------------------- trayecto IV ----------------------*/


INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (124,      'RAC413',        'Redes Avanzadas',                                            5,      2,      3,              12,           12,                  20,          'Protocolo (RIP, OSPF, IGRP, EIGRP,propietarios)', '','Unidad 1: Configuración de Equipos de Comunicaciones Unidad 2: Operatividad de una red electrónica de datos');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (125,      'GPC414',        'Gestión de Proyectos Informáticos',                          6,     4,    4,                 12,           12,                  20,          'Plan de desarrollo de software', '','Unidad 1: Proceso de administración del proyecto. Unidad 2: Planeación y control de proyectos CPM/PERT');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (126,      'SIC414',        'Seguridad Informática',                                      6,      4,      4,              12,           12,                  20,          '¿Qué es la seguridad informática?', '','Unidad 1: Introducción a la Seguridad Informática Unidad 2: Seguridad Física / Lógica');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (127,      'AIC414',        'Auditoría Informática',                                      6,     4,      4,               12,           12,                  20,          'De Desarrollo de Proyectos o Aplicaciones.', '','Unidad 1: Fundamentación de Auditoria 2: Tipos y clases de auditorías.');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (128,      'BDC413',        'Administración de Bases de Datos',                           5,      2,      3,              12,           12,                  20,          'Panorámica de la Gestión de la Base de datos', '','Unidad 1: Aspectos teóricos de la administración de la Base de Datos Unidad 2: Manejo de Transacciones');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (129,      'FCS433',        'Formación Crítica IV',                                       2,      0.5,    3,              36,           12,                  20,          'Formación de emprendedores', '','Unidad 1: Talleres o seminarios de diversos tópicos Unidad 2: Informatización organizacional');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (130,      '----S',        'Proyecto Socio Tecnológico IV',                                 0,     0,     0,              36,           12,                  20,          'El Computador', '','Unidad 1:El Computador Unidad 2: Hardware Unidad 3: Ensamblaje  Unidad 4: Sistemas Operativos');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (131,      'IDC433',        'Inglés',                                                     2,      0.5,    3,              36,           12,                  20,          'Presentación de una persona', '','Unidad 1 Unidad 5');


/*--------------------- ELECTIVAS PROPUESTAS ----------------------*/


INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (132,      'DIC113',        'Diseño Instruccional en las TIC',                            5,       1.5,    3,              12,           12,                  20,          'Definiciones técnicas', '','Unidad 1: Enfoque teórico del diseño instruccional y su relación con las teorías de aprendizaje Unidad 2: Modelos de diseño de instrucción');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (133,      'CIC113',        ' Capital Intelectual y Recursos Humanos',                    5,      1.5,    3,              12,           12,                  20,          'Tipos de Organizaciones', '','Unidad 1: Organizaciones, Recursos Humanos y Capital Intelectual');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (134,      'VTC213',        'Voz y Telefonía IP ',                                        5,      1.5,    3,              12,           12,                  20,          'telefonía IP', '','UNIDAD 1: Voz y telefonía IP UNIDAD 2: Arquitectura telefonía tradicional – Arquitectura telefonía IP');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (135,      'EM213',        'EduMática',                                                   5,      1.5,    3,              12,           12,                  20,          'Teorías del aprendizaje', '',' Unidad 1: Teorías del aprendizaje y la instrucción Unidad 2: Objetivos instruccionales');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (136,      'CSC313',        'Comunicaciones Vía Satélite',                                5,      1.5,    3,              12,           12,                  20,          'Satélites geoestacionarios', '','Unidad 1: Características de la comunicación por satélite Unidad 2: Enlaces');

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio,  nombre,                                                    hta,    hti,    uni_credito,    dur_semanas, not_min_aprobatoria, not_maxima,  descripcion,         observacion, contenido)
    VALUES (137,      'TIC313',        'Tecnologías Internet',                                         5,      1.5,    3,              12,           12,                  20,          'Talleres prácticos dirigidos Describir los aspectos fundamentales de un navegador', '','Unidad 2: Navegadores de Internet');

/*--------------------- END IF ----------------------*/





INSERT INTO sis.t_prelacion(
            codigo, cod_pensum, cod_instituto, cod_uni_curricular, cod_uni_cur_prelada)
    VALUES (1,   1,   1,   28,   11);

INSERT INTO sis.t_prelacion(
            codigo, cod_pensum, cod_instituto, cod_uni_curricular, cod_uni_cur_prelada)
    VALUES (2,   1,   1,   29,   12);

INSERT INTO sis.t_prelacion(
            codigo, cod_pensum, cod_instituto, cod_uni_curricular, cod_uni_cur_prelada)
    VALUES (3,   1,   1,   30,   13);

INSERT INTO sis.t_prelacion(
            codigo, cod_pensum, cod_instituto, cod_uni_curricular, cod_uni_cur_prelada)
    VALUES (4,   1,   1,   58,   45);

INSERT INTO sis.t_prelacion(
            codigo, cod_pensum, cod_instituto, cod_uni_curricular, cod_uni_cur_prelada)
    VALUES (5,   1,   1,   59,   46);

INSERT INTO sis.t_prelacion(
            codigo, cod_pensum, cod_instituto, cod_uni_curricular, cod_uni_cur_prelada)
    VALUES (6,   1,   1,   60,   47);


/*--------------------- Trayecto --------------------*/
INSERT INTO sis.t_trayecto(
            codigo, cod_pensum, num_trayecto, certificado, min_cre_obligatoria, min_cre_electiva, min_cre_acreditable, min_can_electiva)
    VALUES (101,  101,  0,   'TRAYECTO INICIAL',                                       10,              0,                     0,         0);

INSERT INTO sis.t_trayecto(
            codigo, cod_pensum, num_trayecto, certificado, min_cre_obligatoria, min_cre_electiva, min_cre_acreditable, min_can_electiva)
    VALUES (102,  101,  1,   'SOPORTE TÉCNICO A USUARIOS Y EQUIPOS',                   48,                8,                   4,         4);

INSERT INTO sis.t_trayecto(
            codigo, cod_pensum, num_trayecto, certificado, min_cre_obligatoria, min_cre_electiva, min_cre_acreditable, min_can_electiva)
    VALUES (103,  101,  2,   'TÉCNICO SUPERIOR UNIVERSITARIO EN INFORMÁTICA',          48,               8,             4,                4);

INSERT INTO sis.t_trayecto(
            codigo, cod_pensum, num_trayecto, certificado, min_cre_obligatoria, min_cre_electiva, min_cre_acreditable, min_can_electiva)
    VALUES (104,  101,  3,   'DESARROLLADOR DE APLICACIONES',                          39,              3,                  3,            1);

INSERT INTO sis.t_trayecto(
            codigo, cod_pensum, num_trayecto, certificado, min_cre_obligatoria, min_cre_electiva, min_cre_acreditable, min_can_electiva)
    VALUES (105,  101,  4,   'INGENIERO EN INFORMÁTICA',                               39,                 4,                   3,        2);

/*--------------------- END IF ----------------------*/


INSERT INTO sis.t_trayecto(
            codigo, cod_pensum, num_trayecto, certificado, min_cre_obligatoria, min_cre_electiva, min_cre_acreditable, min_can_electiva)
    VALUES (1,  1,  0,   'TRAYECTO INICIAL',                                       10,              0,                     0,         0);

INSERT INTO sis.t_trayecto(
            codigo, cod_pensum, num_trayecto, certificado, min_cre_obligatoria, min_cre_electiva, min_cre_acreditable, min_can_electiva)
    VALUES (2,  1,  1,   'SOPORTE TÉCNICO A USUARIOS Y EQUIPOS',                   48,                8,                   4,         4);

INSERT INTO sis.t_trayecto(
            codigo, cod_pensum, num_trayecto, certificado, min_cre_obligatoria, min_cre_electiva, min_cre_acreditable, min_can_electiva)
    VALUES (3,  1,  2,   'TÉCNICO SUPERIOR UNIVERSITARIO EN INFORMÁTICA',          48,               8,             4,                4);

INSERT INTO sis.t_trayecto(
            codigo, cod_pensum, num_trayecto, certificado, min_cre_obligatoria, min_cre_electiva, min_cre_acreditable, min_can_electiva)
    VALUES (4,  1,  3,   'DESARROLLADOR DE APLICACIONES',                          39,              3,                  3,            1);

INSERT INTO sis.t_trayecto(
            codigo, cod_pensum, num_trayecto, certificado, min_cre_obligatoria, min_cre_electiva, min_cre_acreditable, min_can_electiva)
    VALUES (5,  1,  4,   'INGENIERO EN INFORMÁTICA',                               39,                 4,                   3,        2);





INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (1,  1,  1,  4,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (2,  1,  1,  5,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (3,  1,  1,  6,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (7,  1,  2,  7,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (8,  1,  2,  8,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (9,  1,  2,  9,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (10,  1,  2,  10,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (11,  1,  2,  11,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (12,  1,  2,  12,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (13,  1,  2,  13,  'O');


INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (14,  1,  2,  14,  'E');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (18,  1,  2,  15,  'E');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (19,  1,  2,  16,  'E');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (20,  1,  2,  17,  'E');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (21,  1,  3,  18,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (22,  1,  3,  19,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (23,  1,  3,  20,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (24,  1,  3,  21,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (25,  1,  3,  22,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (26,  1,  3,  23,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (27,  1,  3,  24,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (28,  1,  3,  25,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (29,  1,  3,  26,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (30,  1,  3,  27,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (31,  1,  3,  28,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (32,  1,  3,  29,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (33,  1,  3,  30,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (34,  1,  3,  31,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (35,  1,  3,  32,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (36,  1,  3,  33,  'E');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (37,  1,  3,  34,  'E');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (38,  1,  3,  35,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (39,  1,  3,  36,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (40,  1,  3,  37,  'O');

---ING ---

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (41,  1,  4,  38,  'O');


INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (42,  1,  4,  39,  'O');


INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (43,  1,  4,  40,  'O');


INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (44,  1,  4,  41,  'O');


INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (45,  1,  4,  42,  'O');


INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (46,  1,  4,  42,  'O');


INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (47,  1,  4,  43,  'O');


INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (48,  1,  4,  44,  'O');


INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (49,  1,  4,  45,  'O');


INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (50,  1,  4,  46,  'O');



INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (51,  1,  4,  47,  'O');


INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (52,  1,  4,  48,  'O');


INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (53,  1,  4,  49,  'O');


INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (54,  1,  4,  50,  'O');


INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (55,  1,  4,  51,  'E');


INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (56,  1,  4,  52,  'E');



INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (57,  1,  5,  53,  'O');


INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (58,  1,  5,  54,  'O');


INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (59,  1,  5,  55,  'O');


INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (60,  1,  5,  56,  'O');



INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (61,  1,  5,  57,  'O');



INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (62,  1,  5,  58,  'O');



INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (63,  1,  5,  59,  'O');



INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (64,  1,  5,  60,  'O');



INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (65,  1,  5,  61,  'O');



INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (66,  1,  5,  62,  'O');



INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (67,  1,  5,  63,  'O');


INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (68,  1,  5,  64,  'O');



INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (69,  1,  5,  65,  'E');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (70,  1,  5,  66,  'E');


INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (71,  1,  5,  67,  'E');


INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (72,  1,  5,  68,  'E');


/*------------------- 0 ----------------------*/ 
INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (101,  101,  101, 101,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (102,  101,  101,  102,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (103,  101,  101,  103,  'O');

/*-------------------1 ----------------------*/

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (104,  101,  102,  104,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (105,  101,  102,  105,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (106,  101,  102,  106,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (107,  101,  102,  107,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (108,  101,  102,  108,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (109,  101,  102,  109,  'O');

/*--------------------2---------------------*/

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (110,  101,  103,  110,  'O');


INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (111,  101,  103,  111,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (112,  101,  103,  112,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (113,  101,  103,  113,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (114,  101,  103,  114,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (115,  101,  103,  115,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (116,  101,  103,  116,  'O');

/*--------------------3---------------------*/

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (117,  101,  104,  117,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (118,  101,  104,  118,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (119,  101,  104,  119,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (120,  101,  104,  120,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (121,  101,  104,  121,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (122,  101,  104,  122,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (123,  101,  104,  123,  'O');

/*--------------------4---------------------*/

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (124,  101,  105,  124,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (125,  101,  105,  125,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (126,  101,  105,  126,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (127,  101,  105,  127,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (128,  101,  105,  128,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (129,  101,  105,  129,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (130,  101,  105,  130,  'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (131,  101,  105,  131,  'O');

/*--------------------Electiva---------------------*/

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (132,  101,  102,  132,  'E');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (133,  101,  102,  133,  'E');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (134,  101,  103,  134,  'E');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (135,  101,  103,  135,  'E');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (136,  101,  104,  136,  'E');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (137,  101,  104,  137,  'E');





    insert into sis.t_est_empleado (codigo,nombre) values ('A','Activo');
    insert into sis.t_est_empleado (codigo,nombre) values ('P','Permiso');
    insert into sis.t_est_empleado (codigo,nombre) values ('I','Inactivo');
    insert into sis.t_est_empleado (codigo,nombre) values ('J','Jubilado');


    insert into sis.t_est_estudiante (codigo, nombre) values ('A','Activo');
    insert into sis.t_est_estudiante (codigo, nombre) values ('G','Graduado');
    insert into sis.t_est_estudiante (codigo, nombre) values ('R','Retirado');
    insert into sis.t_est_estudiante (codigo, nombre) values ('I','Inactivo');

    insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(1,11111,null,'jean',null,'sosa',null,'M','25/1/1996','A+','1111111',null,'jean@hotmail.com',null,'san atnnio',null,'V',0,'S',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(2,2222,null,'jorge',null,'gomez','pedrozo','M','2/9/1968','A+','222222',null,'jorge@hotmail.com',null,'san atnnio',null,'V',0,'S',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(3,3333,null,'alicia','magarita','gomez','lopez','F','5/12/1985','O+','333333',null,'alicia_e@yahoo.com',null,'petare',null,'V',2,'C',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(4,44444,'V-444445','Kelly','ana','isturis','mansalba','F','20/12/1983','O+','2356545',null,'la_chiqui@yahoo.com',null,'la urbina frente cdolnlds','le fata un brazo','E',0,'S','le falta el titulo');insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(5,6453423,'V-444675','ramon',null,'morales','perez','M','25/3/1963','A-','8675645',null,'rmonsqui@gmail.com',null,'manzanares','es mudo','V',3,'C',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(6,5674534,null,'rafael','ramon','garcia','rojas','M','15/2/1966','O-','7564543',null,'elrafael420i@gmail.com',null,'buenos aires',null,'E',0,'D',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(7,34532,'V-345344','Angelica','sabrina','rojas','perez','F','12/8/1986','O-','7564534',null,'angelik@hotmail.com',null,'el picacho','le falta un dedo','V',0,'V',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(8,8676543,null,'evelyn',null,'armas',null,'F','10/3/1973','AB+','54634523',null,'argrilment@hotmail.com',null,null,null,'V',0,'V',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(9,987685,null,'arianna','valentina','diaz','armas','F','3/9/1988','AB-','765',null,'ariannita@yahoo.com',null,null,null,'E',0,'S',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(10,6757546,null,'stephany',null,'mendozA','rojas','F','2/6/1993','AB-','76456232',null,'stephanymen@yahoo.com',null,'catia',null,'V',0,'S',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(11,67575333,null,'simon','alfonso','rodriguez',null,'M','8/2/1994','O-','798676545','56467576','sminro@yahoo.com',null,'san antonio',null,'V',2,'D',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(12,867546554,'V-5546545','alfonso','mundo','de la cruz','sosa','M','24/8/1966','O-','9877686','98766544','alfos@yahoo.com','alfos@iutfrp.com','las bermudez',null,'V',2,'D',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(13,89786,null,'hilda','andrea','lopez','lorenzo','F','22/9/1961','O+','87654','465788','andahil@yahoo.com','andahil@iutfrp.com','las bermudez',null,'V',0,'S',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(14,23345567,null,'gisel','alejandra','mascoli','sanchez','F','26/11/1989','O+','68574333','5678999','gigiGl@yahoo.com','gigigi@iutfrp.com','las bermudez',null,'E',0,'S',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(15,786574,null,'johan','alejandro','sanchez','palomera','M','20/6/1989','O+','98765','546576','aleale@gmail.com','alejo@iutfrp.com','catia','le falta una oreja','E',0,'S',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(16,9897228,null,'marco','alejandro','de sousa',null,'M','23/5/1973','O+','23345556','6456453','ellococo@gmail.com',null,'la dolorita','le falta un ojo','V',2,'V',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(17,88767456,null,'maria ','jose','hernandez','de la paz','F','5/6/1970','O-','2132545','3433242','lachica@gmail.com',null,'el hatillo',null,'V',0,'S',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(18,4634524,null,'jose','maria','perez','lorenzo','M','19/7/1981','O-','1234256','4564534','eljose@gmail.com',null,'la trinidad',null,'V',1,'S',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(19,54635343,null,'juan','armanndo','paredes',null,'M','21/10/1988','O-','2343564','234355','armandilo@gmail.com',null,'el limon',null,'V',0,'S',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(20,86786,null,'alejandro',null,'hernandez',null,'M','22/6/1960','O-','2346655','7833423','elhen@gmail.com',null,'la morita',null,'V',0,'S','le falta la foto');insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(21,34242343,null,'carolina','alejandra','segura','salcedo','F','1/4/1992','A+','12324235','12425555','carol@gmail.com','carol@iutfrp.com','el picacho',null,'V',0,'S',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(22,8978675,null,'cintia',null,'malabares','vegas','F','29/12/1961','A+','21454543','355767','chnty@gmail.com',null,'el picacho',null,'V',0,'S',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(23,2134238,null,'kimberlin','andreina','nuñez','chang','F','2/12/1980','A+','23132453','13244444','kimim@gmail.com',null,'el cuji',null,'V',0,'S',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(24,12343,null,'alejandra',null,'nuñez','chang','F','13/8/1968','A+','3245465','56453333','alejigmail.com',null,'el cuji',null,'V',0,'S',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(25,5454354,null,'hugo',null,'herrada',null,'M','25/5/1965','A+-','52334','25354','huguo@gmail.com',null,'OPS',null,'V',2,'C',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(26,2423423,null,'gianfranco',null,'brito','diaz','M','4/1/1979','A+','2423425','324324234','diaznoche@gmail.com',null,'el picacho',null,'V',0,'C',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(27,2324536,null,'adriana','edith','andrada',null,'F','26/2/1997','O-','432333423','12321322','andriana@gmail.com',null,'el patio',null,'V',0,'S',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(28,2324324,null,'diana','vanessa','luggo','nastasi','F','17/8/1963','O-','32434',null,'venenasta@gmail.com',null,'san antnio',null,'V',0,'S',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(29,23424234,null,'alexandra',null,'valbuena','nuñez','F','1/3/1974','O-','454465645',null,'elexaval@gmail.com',null,'san antnio',null,'V',0,'S',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(30,4343566,null,'maired',null,'mejia',null,'F','14/8/1969','O-','33454',null,'mairedmeji@gmail.com',null,null,null,'V',0,'S',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(31,2356777,null,'laura','maria','sosa','garcias','F','5/2/1975','O-','35345435',null,'lalalu@yahoo.com',null,'el valle',null,'V',0,'S',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(32,23424324,null,'fabiana',null,'betancur',null,'F','1/11/1985','O+','142123',null,'fabifabi@yahoo.com',null,null,null,'V',0,'S',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(33,2131244,null,'carlos','luis','brito',null,'M','24/11/1993','AB+','5674563',null,'carlillos@yahoo.com',null,'coche',null,'E',0,'S',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(34,4564353,null,'luis','alfonso','carrillo',null,'M','25/3/1970','AB+','5674563',null,'carrillo@gmail.com',null,null,null,'E',0,'S',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(35,6765645,null,'gabriel',null,'jordan',null,'M','26/6/1991','AB+','55445',null,'jordas@gmail.com',null,null,null,'V',0,'S',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(36,2345364,null,'daniel',null,'perez','pirella','M','10/12/1964','AB+','4353666',null,'456445@gmail.com',null,null,null,'V',0,'S',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(37,3455555,null,'moises','mateo','muñoz','rodriguez','M','29/10/1988','AB+','2243546',null,'moñozmoises@gmail.com',null,null,null,'V',0,'S',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(38,234543445,null,'mateo',null,'sanabrias',null,'M','28/4/1964','AB+','134423',null,'meteo@gmail.com',null,null,null,'V',0,'S',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(39,3447774,null,'miguel','angel','piscalli','mascigla','M','18/4/1962','AB-','4565464',null,'migue@gmail.com',null,null,null,'E',0,'S',null);insert into sis.t_persona (codigo,cedula,rif,nombre1,nombre2,apellido1,apellido2,sexo,
    fec_nacimiento, tip_sangre, telefono1,telefono2, cor_personal,
    cor_institucional,direccion,discapacidad, nacionalidad, hijos,
    est_civil,observaciones) values(40,3333726,null,'jesus','enrique','inglesias','cruz','M','22/2/1978','AB-','545435',null,'jesusi@gmail.com',null,null,null,'V',0,'S',null);

    insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
    cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
    es_docente,observaciones) values(1,1,1,1,'A','28/12/1976',false,false,false,true,'sin comentarios');insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
    cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
    es_docente,observaciones) values(2,2,1,1,'A','11/11/1982',true,false,false,false,'sin comentarios');insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
    cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
    es_docente,observaciones) values(3,3,1,1,'A','19/11/1979',false,false,false,true,'sin comentarios');insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
    cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
    es_docente,observaciones) values(4,4,1,1,'J','1/2/1985',false,false,false,true,'sin comentarios');
    insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
    cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
    es_docente,observaciones) values(5,5,1,2,'A','2/10/1971',true,false,false,true,'');insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
    cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
    es_docente,observaciones) values(6,6,1,4,'A','3/2/1988',false,false,false,true,'');insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
    cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
    es_docente,observaciones) values(7,7,2,5,'J','19/7/1998',false,false,false,true,'');insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
    cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
    es_docente,observaciones) values(8,8,2,4,'I','2/5/1986',false,false,false,false,'');
    insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
    cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
    es_docente,observaciones) values(9,9,2,5,'A','27/8/1980',false,true,false,false,'');insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
    cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
    es_docente,observaciones) values(10,10,2,4,'A','23/11/1999',false,false,false,true,'');insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
    cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
    es_docente,observaciones) values(11,11,2,5,'J','22/8/1998',false,false,false,false,'');insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
    cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
    es_docente,observaciones) values(12,12,2,4,'A','25/10/1986',false,false,false,true,'');insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
    cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
    es_docente,observaciones) values(13,13,3,6,'A','8/9/1994',false,false,false,true,'');insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
    cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
    es_docente,observaciones) values(14,14,3,6,'A','22/5/1988',false,false,true,true,'');insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
    cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
    es_docente,observaciones) values(15,15,3,6,'A','16/9/1972',false,false,true,true,'');insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
    cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
    es_docente,observaciones) values(16,16,3,6,'A','26/1/1982',false,false,false,true,'');insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
    cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
    es_docente,observaciones) values(17,17,3,6,'A','20/8/1998',false,false,false,true,'');insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
    cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
    es_docente,observaciones) values(18,18,3,6,'A','23/1/1972',false,false,false,true,'');
    insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
    cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
    es_docente,observaciones) values(19,19,1,6,'A','22/3/1990',false,false,false,true,'');insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
    cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
    es_docente,observaciones) values(20,20,2,6,'A','12/1/1974',false,false,false,true,'');


    insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
    num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
    condicion,observaciones) values(2,21,1,2,'2121','2121','2121','A','27/1/1998',01,'sin obersevacion');insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
    num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
    condicion,observaciones) values(3,22,1,3,'2222','2222','2222','A','5/7/1985',01,'');insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
    num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
    condicion,observaciones) values(4,23,1,1,'2323','2323','2323','A','17/2/1974',01,'');insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
    num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
    condicion,observaciones) values(5,24,1,2,'2424','2424','2424','G','6/8/1981',01,'');insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
    num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
    condicion,observaciones) values(6,25,1,3,'2525','2525','2525','G','24/6/1997',01,'');insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
    num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
    condicion,observaciones) values(7,26,2,4,'2626','2626','2626','A','25/6/2000',01,'');insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
    num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
    condicion,observaciones) values(8,27,2,5,'2727','2727','2727','A','25/7/1981',01,'');insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
    num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
    condicion,observaciones) values(9,28,2,4,'2828','2828','2828','A','17/7/1976',01,'');
    insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
    num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
    condicion,observaciones) values(10,29,2,5,'2929','2929','2929','I','13/10/1974',01,'');
    insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
    num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
    condicion,observaciones) values(11,30,2,4,'3030','3030','3030','I','23/6/1982',01,'');insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
    num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
    condicion,observaciones) values(12,31,2,5,'3131','3131','3131','A','1/5/1983',01,'tuvo una pelea con el profesor y le pego un golpe');insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
    num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
    condicion,observaciones) values(13,32,2,4,'3232','3232','3232','A','16/3/1979',01,'se encontro al estudiante fumando dentro del salon');
    insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
				num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
				condicion,observaciones) values(14,33,3,6,'3333','3333','3333','A','12/3/1989',01,'');insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
				num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
				condicion,observaciones) values(15,34,3,6,'3434','3434','3434','I','21/6/1985',01,'el estudinte fue expulsado de la institucion por vender drogas dentro del resinto');insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
				num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
				condicion,observaciones) values(16,35,3,6,'3535','3535','3535','A','7/10/1994',01,'');insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
				num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
				condicion,observaciones) values(17,36,3,6,'36','36','3636','A','19/9/1992',01,'');insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
				num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
				condicion,observaciones) values(18,37,3,6,'3737','3737','3737','A','23/3/1996',01,'');insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
				num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
				condicion,observaciones) values(19,38,3,6,'3838','3838','3838','A','19/4/1973',01,'');insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
				num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
				condicion,observaciones) values(20,39,3,6,'3939','3939','3939','A','4/1/1976',01,'');insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
				num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
				condicion,observaciones) values(21,40,3,6,'4040','4040','4040','A','13/10/1984',01,'');

update sis.t_persona set nombre1 = upper(nombre1), nombre2 = upper(nombre2), apellido1 = upper(apellido1), apellido2 = upper(apellido2);
