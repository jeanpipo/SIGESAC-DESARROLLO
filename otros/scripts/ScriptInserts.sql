
INSERT INTO sis.t_est_periodo(
            codigo, nombre)
    VALUES (1, 'Abierto');
INSERT INTO sis.t_est_periodo(
            codigo, nombre)
    VALUES (2, 'Cerrado');

INSERT INTO sis.t_instituto(
            codigo, nom_corto, nombre, direccion)
    VALUES (1, 'IUTFRP', 'IUT Federico Rivero Palacio', 'k8 de la panamericana');

INSERT INTO sis.t_instituto(
            codigo, nom_corto, nombre, direccion)
    VALUES (2, 'CULTCA', 'CULTCA', 'los teques frente al metro');

INSERT INTO sis.t_instituto(
            codigo, nom_corto, nombre, direccion)
    VALUES (3, 'IUTR', 'IUT RUFINO', 'caracas');


INSERT INTO sis.t_pensum(
            codigo, nombre, nom_corto, observaciones, min_can_electiva, min_cre_electiva,
            min_cre_obligatoria, fec_creacion)
    VALUES (3,	'Pensum Nacional de Formación en Informática',	'PNFI',	'PNFI 2015' ,	2,	1,	2,	'2016-05-13');

INSERT INTO sis.t_pensum(
            codigo, nombre, nom_corto, observaciones, min_can_electiva, min_cre_electiva,
            min_cre_obligatoria, fec_creacion)
    VALUES (2,	'Pensum Nacional de Formación en Química',	'PNFQ',	'PNFQ 2008', 	2,	4,	9,	'2016-03-02');

INSERT INTO sis.t_pensum(
            codigo, nombre, nom_corto, observaciones, min_can_electiva, min_cre_electiva,
            min_cre_obligatoria, fec_creacion)
    VALUES (1,	'Pensum Nacional de Formación en Administración',	'PNFA',	'PNFA 2008' ,	2,	4,	2,	'2008-05-13');


INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio, nombre, hta, hti, uni_credito, dur_semanas,
            not_min_aprobatoria, not_maxima, descripcion, observacion, contenido)
    VALUES (1,'PNS019','PROYECTO NACIONAL Y NUEVA CIUDADANÍA',	50,	50,	4,	12,	10,	20,	'PROYECTO NACIONAL Y NUEVA CIUDADANÍA','',''
);

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio, nombre, hta, hti, uni_credito, dur_semanas,
            not_min_aprobatoria, not_maxima, descripcion, observacion, contenido)
    VALUES (2,'FC016','FORMACIÓN CRÍTICA',50,55,46,10,15,20,'FORMACIÓN CRÍTICA','',''
);

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio, nombre, hta, hti, uni_credito, dur_semanas,
            not_min_aprobatoria, not_maxima, descripcion, observacion, contenido)
    VALUES (3,'MAC015','MATEMÁTICA',50,	55,46,10,15,20,'MATEMÁTICA','',''
);

INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio, nombre, hta, hti, uni_credito, dur_semanas,
            not_min_aprobatoria, not_maxima, descripcion, observacion, contenido)
    VALUES (4,'FOR11','FORMACIÓN CRÍTICA I',50,	55,46,10,15,20,'FORMACIÓN CRÍTICA','',''
);


INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio, nombre, hta, hti, uni_credito, dur_semanas,
            not_min_aprobatoria, not_maxima, descripcion, observacion, contenido)
    VALUES (5,'PRO11',' I',50,50,4,12,10,20,'','',''
);


INSERT INTO sis.t_uni_curricular(
            codigo, cod_uni_ministerio, nombre, hta, hti, uni_credito, dur_semanas,
            not_min_aprobatoria, not_maxima, descripcion, observacion, contenido)
    VALUES (6,'CAS11','CASTELLANO I',50,50,4,12,10,20,'','',''
);

INSERT INTO sis.t_prelacion(
            codigo, cod_pensum, cod_instituto, cod_uni_curricular, cod_uni_cur_prelada)
    VALUES (1,1,1,1,2);




INSERT INTO sis.t_tip_uni_curricular(
            codigo, nombre)
    VALUES ('E',	'Electiva');

INSERT INTO sis.t_tip_uni_curricular(
            codigo, nombre)
    VALUES ('O',	'Obligatoria');

INSERT INTO sis.t_trayecto(
            codigo, cod_pensum, num_trayecto, certificado, min_cre_obligatoria,
            min_cre_electiva, min_cre_acreditable, min_can_electiva)
    VALUES (1,	1,	1,	'SOPORTE TÉCNICO',	105,	8,	4,	4);

INSERT INTO sis.t_trayecto(
            codigo, cod_pensum, num_trayecto, certificado, min_cre_obligatoria,
            min_cre_electiva, min_cre_acreditable, min_can_electiva)
    VALUES (2,	1,	2,	'TÉCNICO SUPERIOR UNIVERSITARIO',	120,	8,	6,	5);


INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (1,	1,	1,	3,	'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (2,	1,	1,	4,	'O');

INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (3,	1,	1,	5,	'O');


INSERT INTO sis.t_uni_tra_pensum(
            codigo, cod_pensum, cod_trayecto, cod_uni_curricular, cod_tipo)
    VALUES (4,	1,	1,	5,	'O');


INSERT INTO sis.t_est_periodo values('A','Abierto');
INSERT INTO sis.t_est_periodo values('C','Cerrado');

INSERT INTO sis.t_est_cur_estudiante values('C','Cursando');
INSERT INTO sis.t_est_cur_estudiante values('A','Aprobado');
INSERT INTO sis.t_est_cur_estudiante values('R','Reprobado');

insert into sis.t_est_docente (codigo,nombre) values ('A','Activo');
insert into sis.t_est_docente (codigo,nombre) values ('P','Permiso');
insert into sis.t_est_docente (codigo,nombre) values ('I','Inactivo');
insert into sis.t_est_docente (codigo,nombre) values ('J','Jubilado');

INSERT INTO sis.t_periodo values(1,'2016-2016',1,1,'2016-01-01','2017-01-01','','A');
INSERT INTO sis.t_periodo values(2,'2016-2016',2,1,'2016-01-01','2017-01-01','','A');
INSERT INTO sis.t_periodo values(3,'2016-2016',3,1,'2016-01-01','2017-01-01','','A');

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
es_docente,observaciones) values(6,6,1,2,'A','3/2/1988',false,false,false,true,'');insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
es_docente,observaciones) values(7,7,1,2,'J','19/7/1998',false,false,false,true,'');insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
es_docente,observaciones) values(8,8,1,2,'I','2/5/1986',false,false,false,false,'');
insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
es_docente,observaciones) values(9,9,1,3,'A','27/8/1980',false,true,false,false,'');insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
es_docente,observaciones) values(10,10,1,3,'A','23/11/1999',false,false,false,true,'');insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
es_docente,observaciones) values(11,11,1,3,'J','22/8/1998',false,false,false,false,'');insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
es_docente,observaciones) values(12,12,1,3,'A','25/10/1986',false,false,false,true,'');insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
es_docente,observaciones) values(13,13,1,3,'A','8/9/1994',false,false,false,true,'');insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
es_docente,observaciones) values(14,14,1,3,'A','22/5/1988',false,false,true,true,'');insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
es_docente,observaciones) values(15,15,1,2,'A','16/9/1972',false,false,true,true,'');insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
es_docente,observaciones) values(16,16,1,2,'A','26/1/1982',false,false,false,true,'');insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
es_docente,observaciones) values(17,17,1,1,'A','20/8/1998',false,false,false,true,'');insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
es_docente,observaciones) values(18,18,1,1,'A','23/1/1972',false,false,false,true,'');
insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
es_docente,observaciones) values(19,19,1,2,'A','22/3/1990',false,false,false,true,'');insert into sis.t_empleado (codigo,cod_persona,cod_instituto,cod_pensum,
cod_estado, fec_inicio, es_jef_pensum,es_jef_con_estudio, es_ministerio,
es_docente,observaciones) values(20,20,1,2,'A','12/1/1974',false,false,false,true,'');

insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
condicion,observaciones) values(1,1,1,1,'111','111','111','A','25/8/1980',01,'sin obersevacion');insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
condicion,observaciones) values(2,21,1,1,'2121','2121','2121','A','27/1/1998',01,'sin obersevacion');insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
condicion,observaciones) values(3,22,1,1,'2222','2222','2222','A','5/7/1985',01,'');insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
condicion,observaciones) values(4,23,1,1,'2323','2323','2323','A','17/2/1974',01,'');insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
condicion,observaciones) values(5,24,1,1,'2424','2424','2424','G','6/8/1981',01,'');insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
condicion,observaciones) values(6,25,1,2,'2525','2525','2525','G','24/6/1997',01,'');insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
condicion,observaciones) values(7,26,1,2,'2626','2626','2626','A','25/6/2000',01,'');insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
condicion,observaciones) values(8,27,1,2,'2727','2727','2727','A','25/7/1981',01,'');insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
condicion,observaciones) values(9,28,1,3,'2828','2828','2828','A','17/7/1976',01,'');
insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
condicion,observaciones) values(10,29,1,3,'2929','2929','2929','I','13/10/1974',01,'');
insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
condicion,observaciones) values(11,30,1,3,'3030','3030','3030','I','23/6/1982',01,'');insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
condicion,observaciones) values(12,31,1,3,'3131','3131','3131','A','1/5/1983',01,'tuvo una pelea con el profesor y le pego un golpe');insert into sis.t_estudiante (codigo,cod_persona,cod_instituto,cod_pensum,
num_carnet,num_expediente,cod_rusnies,cod_estado, fec_inicio,
condicion,observaciones) values(13,32,1,3,'3232','3232','3232','A','16/3/1979',01,'se encontro al estudiante fumando dentro del salon');

INSERT INTO sis.t_curso values(1,1,1,1,'A','01-01-01','01-01-02',30,'','');
INSERT INTO sis.t_curso values(2,1,2,2,'A','01-01-01','01-01-02',30,'','');
INSERT INTO sis.t_curso values(3,1,3,3,'A','01-01-01','01-01-02',30,'','');
INSERT INTO sis.t_curso values(4,1,4,4,'A','01-01-01','01-01-02',30,'','');
INSERT INTO sis.t_curso values(5,1,5,5,'A','01-01-01','01-01-02',30,'','');

INSERT INTO sis.t_cur_estudiante values(1,1,1,'0','0','C','0');
INSERT INTO sis.t_cur_estudiante values(2,2,1,'0','0','C','0');
INSERT INTO sis.t_cur_estudiante values(3,3,1,'0','0','C','0');
INSERT INTO sis.t_cur_estudiante values(4,4,1,'0','0','C','0');
INSERT INTO sis.t_cur_estudiante values(5,5,1,'0','0','C','0');
INSERT INTO sis.t_cur_estudiante values(6,1,2,'0','0','C','0');
INSERT INTO sis.t_cur_estudiante values(7,2,2,'0','0','C','0');
INSERT INTO sis.t_cur_estudiante values(8,3,2,'0','0','C','0');
INSERT INTO sis.t_cur_estudiante values(9,4,2,'0','0','C','0');
INSERT INTO sis.t_cur_estudiante values(10,5,2,'0','0','C','0');
INSERT INTO sis.t_cur_estudiante values(11,1,3,'0','0','C','0');
INSERT INTO sis.t_cur_estudiante values(12,2,3,'0','0','C','0');
INSERT INTO sis.t_cur_estudiante values(13,3,3,'0','0','C','0');
INSERT INTO sis.t_cur_estudiante values(14,4,3,'0','0','C','0');
INSERT INTO sis.t_cur_estudiante values(15,5,3,'0','0','C','0');
INSERT INTO sis.t_cur_estudiante values(16,1,4,'0','0','C','0');
INSERT INTO sis.t_cur_estudiante values(17,2,4,'0','0','C','0');
INSERT INTO sis.t_cur_estudiante values(18,3,4,'0','0','C','0');
INSERT INTO sis.t_cur_estudiante values(19,4,4,'0','0','C','0');
INSERT INTO sis.t_cur_estudiante values(20,5,4,'0','0','C','0');
INSERT INTO sis.t_cur_estudiante values(21,1,5,'0','0','C','0');
INSERT INTO sis.t_cur_estudiante values(22,2,5,'0','0','C','0');
INSERT INTO sis.t_cur_estudiante values(23,3,5,'0','0','C','0');
INSERT INTO sis.t_cur_estudiante values(24,4,5,'0','0','C','0');
INSERT INTO sis.t_cur_estudiante values(25,5,5,'0','0','C','0');

INSERT INTO sis.t_electiva values (1,1,1,1);

INSERT INTO sis.t_convalidacion values (1,1,false,20,'O',1,1,1,'');
INSERT INTO sis.t_convalidacion values (2,2,false,20,'O',1,1,1,'');
INSERT INTO sis.t_convalidacion values (3,3,false,20,'O',1,1,1,'');

