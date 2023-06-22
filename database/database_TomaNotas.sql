-- drop database if exists tomanotas;
create database tomanotas;
use tomanotas;

create table Rol_Usuario(
id_rol_PK int not null auto_increment,
descripcion varchar(50) not null,
primary key(id_rol_PK)
);

create table Usuario(
id_usuario_PK int not null auto_increment,
id_rol_FK int not null,
nombre varchar(50) not null,
apellido varchar(50) not null,
correo varchar(50) not null,
nickname varchar(50) not null,
clave varchar(200) not null,
estado boolean not null,
fecha_nacimiento date not null,
fecha_ingreso datetime not null,
primary key(id_usuario_PK),
foreign key (id_Rol_FK) references Rol_Usuario(id_rol_PK)
);

create table Link (
id_link_PK int not null auto_increment,
id_usuario_FK int not null,
titulo varchar(500) null,
url_link varchar(500),
fecha_ingreso datetime not null,
primary key(id_link_PK),
foreign key (id_usuario_FK) references Usuario(id_usuario_PK)
);

create table Link_Compartido(
id_link_compartido_PK int not null auto_increment,
id_usuario_entrega_FK int not null,
id_usuario_recibe_FK int not null,
id_link_FK int not null,
fecha datetime not null,
primary key(id_link_compartido_PK),
foreign key (id_usuario_entrega_FK) references Usuario (id_usuario_PK),
foreign key (id_usuario_recibe_FK) references Usuario (id_usuario_PK),
foreign key (id_link_FK) references Link (id_link_PK)
);

-- links que se van eliminando
create table Backup_Link (
id_link_PK int not null,
id_usuario_FK int not  null,
titulo varchar(500) null,
url_link varchar(500),
fecha_ingreso datetime not null,
foreign key (id_usuario_FK) references Usuario(id_usuario_PK)
);


create table Nota(
id_nota_PK int not null auto_increment,
id_usuario_FK int not null,
titulo varchar(1000) null,
descripcion mediumtext not null,
estado boolean not null,
fecha_ingreso datetime not null,
primary key(id_nota_PK),
foreign key (id_usuario_FK) references Usuario(id_usuario_PK)
);


create table Archivo(
id_archivo_PK int not null auto_increment,
id_usuario_FK int not null,
ruta varchar(1000) not null,
tamano float not null,
tipo varchar(100) not null,
estado boolean not null,
fecha_ingreso datetime not null,
primary key(id_archivo_PK),
foreign key (id_usuario_FK) references Usuario(id_usuario_PK)
);
-- taba de reistro de login
 create table Registro_Login(
 id_registro_login_PK int not nulL auto_increment,
 id_usuario_FK int not null,
 fecha date not null,
 hora  time not null,
 primary key(id_registro_login_PK),
 foreign key (id_usuario_FK) references Usuario(id_usuario_PK)
 );

 create table Notificacion(
id_notificacion_PK int not null auto_increment,
id_usuario_FK int not null,
tipo_notificacion varchar(500) not null,
fecha datetime not null,
primary key(id_notificacion_PK),
foreign key (id_usuario_FK) references Usuario (id_usuario_PK)
);

create table Archivo_Compartido(
id_archivo_compartido_PK int not null auto_increment,
id_usuario_entrega_FK int not null,
id_usuario_recibe_FK int not null,
id_archivo_FK int not null,
fecha datetime not null,
primary key(id_archivo_compartido_PK),
foreign key (id_usuario_entrega_FK) references Usuario (id_usuario_PK),
foreign key (id_usuario_recibe_FK) references Usuario (id_usuario_PK),
foreign key (id_archivo_FK) references Archivo (id_archivo_PK)
);

create table Tarea(
id_tarea_PK int not null auto_increment,
id_usuario_FK int not null,
descripcion varchar(1000) not null,
fecha datetime not null,
hora time not null,
estado boolean not null,
primary key(id_tarea_PK),
foreign key (id_usuario_FK) references Usuario(id_usuario_PK)
);

create table cronograma(
id_cronograma_PK int not null auto_increment,
id_usuario_FK int not null,
titulo varchar(100) null,
fecha datetime not null,
primary key(id_cronograma_PK),
foreign key (id_usuario_FK) references Usuario(id_usuario_PK)
);

create table tarea_cronograma(
id_tarea_cronograma_PK int not null auto_increment,
id_cronograma_FK int not null,
descripcion varchar(1000) not null,
hora int not null,
minuto int not null,
meridiano varchar(2) not null,
estado boolean not null,
primary key(id_tarea_cronograma_PK),
foreign key (id_cronograma_FK) references cronograma(id_cronograma_PK)
);

ALTER TABLE Nota
ADD color varchar(50) not null default "#ffffff";

-- proyectos de tareas
create table projects(
  id int not null auto_increment,
  user_id int not null,
  name varchar(255) not null,
  status boolean not null default 1,
  descripcion varchar(1000) null,
  created_at datetime not null default now(),
  primary key(id),
  foreign key (user_id) references Usuario(id_usuario_PK)
);

ALTER TABLE
  tarea_cronograma
ADD
  COLUMN project_id INT NULL,
ADD
  FOREIGN KEY (project_id) REFERENCES projects(id);

create
or replace view time_project_spent as
select
  t.project_id,
  SUM(
    TIME_TO_SEC(
      TIMEDIFF(
        STR_TO_DATE(next_time, '%H:%i'),
        STR_TO_DATE(actual_time, '%H:%i')
      )
    ) / 3600
  ) AS time_difference
FROM
  (
    SELECT
      x.*,
      CONCAT(x.hora, ':', x.minuto) AS actual_time,
      COALESCE(
        (
          SELECT
            CONCAT(tp2.hora, ':', tp2.minuto)
          FROM
            tarea_cronograma AS tp2
          WHERE
            tp2.id_tarea_cronograma_PK = (x.id_tarea_cronograma_PK + 1)
            AND id_cronograma_FK = x.id_cronograma_FK
            and tp2.estado = 1
        ),
        TIME_FORMAT(
          DATE_ADD(
            STR_TO_DATE(CONCAT(x.hora, ':', x.minuto), '%H:%i'),
            INTERVAL 30 MINUTE
          ),
          '%H:%i'
        )
      ) AS next_time
    FROM
      tarea_cronograma x
    ORDER BY
      x.id_tarea_cronograma_PK ASC,
      x.id_cronograma_FK
  ) AS t
GROUP BY
  t.project_id;
-- compartido con otros..compartido con conmigo
create procedure Archivos_Compartidos (IDUSUARIO int)
select AC.id_archivo_compartido_PK,A.id_usuario_FK,AC.id_usuario_entrega_FK, AC.id_archivo_FK,A.ruta,A.tamano,AC.id_usuario_recibe_FK,U.nombre,U.apellido,AC.fecha
from Archivo as A  inner join Archivo_Compartido as AC  on id_archivo_FK = id_archivo_PK
                   inner join Usuario as U on id_usuario_recibe_FK = id_usuario_PK
                   where AC.id_usuario_entrega_FK = IDUSUARIO OR AC.id_usuario_recibe_FK = IDUSUARIO  ORDER BY AC.id_archivo_compartido_PK DESC;

-- compartido con otros..compartido con conmigo
create procedure Links_Compartidos (IDUSUARIO int)
select LC.id_link_compartido_PK,LC.id_usuario_entrega_FK,LC.id_usuario_recibe_FK,U.nombre,U.apellido,LC.id_link_FK,L.url_link,L.titulo,LC.fecha
from Link as L  inner join Link_Compartido as LC  on id_link_FK = id_link_PK
                   inner join Usuario as U on id_usuario_recibe_FK = id_usuario_PK
                   WHERE LC.id_usuario_entrega_FK = IDUSUARIO OR LC.id_usuario_recibe_FK = IDUSUARIO  ORDER BY LC.id_link_compartido_PK DESC ;

-- creacion de vistas
create view Consulta_Notificacion as
select n.id_notificacion_PK, u.id_usuario_PK,u.nombre, u.apellido, n.tipo_notificacion , n.fecha
from Notificacion as n inner join Usuario as u on id_usuario_PK = id_usuario_FK ORDER BY n.id_notificacion_PK DESC;

create view Consulta_Registro_Login as
select hl.id_registro_login_PK,u.id_usuario_PK, u.nombre, u.apellido, hl.fecha,hl.hora
from Registro_Login as hl inner join Usuario as u on id_usuario_PK = id_usuario_FK ORDER BY id_registro_login_PK DESC;

-- uso de un trigger para las notas eliminadas
create trigger Elinimacion_Notas_BD before delete on Link for each row
insert into Backup_Link values(old.id_link_PK,old.id_usuario_FK,old.titulo,old.url_link,now());

create view Reporte_Modulos as
    SELECT u.nickname, u.id_usuario_PK,
    (SELECT COUNT(*) FROM Link WHERE id_usuario_FK = u.id_usuario_PK) as L,
    (SELECT COUNT(*) FROM Nota WHERE id_usuario_FK = u.id_usuario_PK) as N,
    (SELECT COUNT(*) FROM Archivo WHERE id_usuario_FK = u.id_usuario_PK) as A,
    (SELECT COUNT(*) FROM Tarea WHERE id_usuario_FK = u.id_usuario_PK) as T,
    (SELECT COUNT(*) FROM cronograma WHERE id_usuario_FK = u.id_usuario_PK) as C
    FROM Usuario as u
    ORDER BY u.id_usuario_PK asc;



