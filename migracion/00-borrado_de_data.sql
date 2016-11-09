--delete from sis.t_acreditable;
--delete from sis.t_archivo;
--delete from sis.t_convalidacion;
--delete from sis.t_cur_estudiante;
--delete from sis.t_curso;
--delete from sis.t_electiva;
--delete from sis.t_empleado;
--delete from sis.t_est_cur_estudiante;
--delete from sis.t_est_empleado;
--delete from sis.t_est_estudiante;
--delete from sis.t_est_periodo;
--delete from sis.t_estudiante;
--delete from sis.t_instituto;
--delete from sis.t_pensum;
--delete from sis.t_periodo;
--delete from sis.t_persona;
--delete from sis.t_prelacion;
--delete from sis.t_tip_uni_curricular;
--delete from sis.t_trayecto;
--delete from sis.t_uni_curricular;
--delete from sis.t_uni_tra_pensum;

alter table per.t_usuario drop constraint t_usuario_campo1_fkey;


select * from sis.t_persona;

select u.*,p.* from per.t_usuario u inner join sis.t_persona p on u.campo1 = p.codigo;