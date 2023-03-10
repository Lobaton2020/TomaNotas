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
select u.nickname,u.id_usuario_PK,count(distinct l.id_link_PK) as L,count( distinct n.id_nota_PK) as N,
                                 count( distinct a.id_archivo_PK) as A,count( distinct t.id_tarea_PK) as T,
                                 count( distinct c.id_cronograma_PK) as C
          from Usuario as u left join Link as l on u.id_usuario_PK = l.id_usuario_FK
                            left join Nota as n on u.id_usuario_PK = n.id_usuario_FK
                            left join Tarea as t on u.id_usuario_PK = t.id_usuario_FK
                            left join Archivo as a on u.id_usuario_PK = a.id_usuario_FK
                            left join cronograma as c on u.id_usuario_PK = c.id_usuario_FK
                            GROUP BY u.nickname,u.id_usuario_PK ORDER BY u.id_usuario_PK asc;


