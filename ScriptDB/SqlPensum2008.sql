INSERT INTO sis.t_pensum(codigo, nombre, nom_corto, observaciones, min_can_electiva, min_cre_electiva,min_cre_obligatoria, fec_creacion) VALUES (101, 'Programa Nacional de Formación Informática',   'PNFI', 'PNFI 2008' ,   2,  1,  2,  '2008-01-01');




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


/*-------------------- Prelacion ---------------------*/
	
	
/*-------------------- trayecto 0 ---------------------*/
	
INSERT INTO sis.t_prelacion(
            codigo, cod_pensum, cod_instituto, cod_uni_curricular, cod_uni_cur_prelada)
    VALUES (101,   101,   1,   104,   101);

/*-------------------- trayecto 1 ---------------------*/

INSERT INTO sis.t_prelacion(
            codigo, cod_pensum, cod_instituto, cod_uni_curricular, cod_uni_cur_prelada)
    VALUES (102,   101,   1,   116,   108);
	
INSERT INTO sis.t_prelacion(
            codigo, cod_pensum, cod_instituto, cod_uni_curricular, cod_uni_cur_prelada)
    VALUES (103,   101,   1,   116,   106);	
	
INSERT INTO sis.t_prelacion(
            codigo, cod_pensum, cod_instituto, cod_uni_curricular, cod_uni_cur_prelada)
    VALUES (104,   101,   1,   112,   106);	
INSERT INTO sis.t_prelacion(
            codigo, cod_pensum, cod_instituto, cod_uni_curricular, cod_uni_cur_prelada)
    VALUES (105,   101,   1,   114,   106);	
INSERT INTO sis.t_prelacion(
            codigo, cod_pensum, cod_instituto, cod_uni_curricular, cod_uni_cur_prelada)
    VALUES (106,   101,   1,   113,  106);	
	
INSERT INTO sis.t_prelacion(
            codigo, cod_pensum, cod_instituto, cod_uni_curricular, cod_uni_cur_prelada)
    VALUES (107,   101,   1,   110, 104);	
	
INSERT INTO sis.t_prelacion(
            codigo, cod_pensum, cod_instituto, cod_uni_curricular, cod_uni_cur_prelada)
    VALUES (108,   101,   1,   115, 107);	
	
/*-------------------- trayecto 2 ---------------------*/
	

INSERT INTO sis.t_prelacion(
            codigo, cod_pensum, cod_instituto, cod_uni_curricular, cod_uni_cur_prelada)
    VALUES (109,   101,   1,   122 ,115);	
	
INSERT INTO sis.t_prelacion(
            codigo, cod_pensum, cod_instituto, cod_uni_curricular, cod_uni_cur_prelada)
    VALUES (110,   101,   1,   117 ,110);	

INSERT INTO sis.t_prelacion(
            codigo, cod_pensum, cod_instituto, cod_uni_curricular, cod_uni_cur_prelada)
    VALUES (111,   101,   1,   123, 116);	

INSERT INTO sis.t_prelacion(
            codigo, cod_pensum, cod_instituto, cod_uni_curricular, cod_uni_cur_prelada)
    VALUES (112,   101,   1,   121, 114);	

INSERT INTO sis.t_prelacion(
            codigo, cod_pensum, cod_instituto, cod_uni_curricular, cod_uni_cur_prelada)
    VALUES (113,   101,   1,   120, 113);	

	
	
	
	
/*-------------------- trayecto 3 ---------------------*/
	
INSERT INTO sis.t_prelacion(
            codigo, cod_pensum, cod_instituto, cod_uni_curricular, cod_uni_cur_prelada)
    VALUES (114,   101,   1,   118, 117);	

	
INSERT INTO sis.t_prelacion(
            codigo, cod_pensum, cod_instituto, cod_uni_curricular, cod_uni_cur_prelada)
    VALUES (115,   101,   1,   129, 122);	

	
INSERT INTO sis.t_prelacion(
            codigo, cod_pensum, cod_instituto, cod_uni_curricular, cod_uni_cur_prelada)
    VALUES (116,   101,   1,   130,  123);	
	
INSERT INTO sis.t_prelacion(
            codigo, cod_pensum, cod_instituto, cod_uni_curricular, cod_uni_cur_prelada)
    VALUES (117,   101,   1,   128, 121);	
	
	
	


	

	
	