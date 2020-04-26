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
fecha_ingreso date not null,
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
fecha_ingreso date not null,
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
fecha_ingreso date not null,
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
fecha date not null,
primary key(id_notificacion_PK),
foreign key (id_usuario_FK) references Usuario (id_usuario_PK)
);

create table Archivo_Compartido(
id_archivo_compartido_PK int not null auto_increment,
id_usuario_entrega_FK int not null,
id_usuario_recibe_FK int not null,
id_archivo_FK int not null,
fecha date not null,
primary key(id_archivo_compartido_PK),
foreign key (id_usuario_entrega_FK) references Usuario (id_usuario_PK),
foreign key (id_usuario_recibe_FK) references Usuario (id_usuario_PK),
foreign key (id_archivo_FK) references Archivo (id_archivo_PK)
);

create table Tarea(
id_tarea_PK int not null auto_increment,
id_usuario_FK int not null,
descripcion varchar(1000) not null,
fecha date not null,
hora time not null,
estado boolean not null,
primary key(id_tarea_PK),
foreign key (id_usuario_FK) references Usuario(id_usuario_PK)
);

-- compartido con otros..compartido con conmigo
create view Consulta_Archivo_Compartido as
select AC.id_archivo_compartido_PK,A.id_usuario_FK,AC.id_usuario_entrega_FK, AC.id_archivo_FK,A.ruta,A.tamano,AC.id_usuario_recibe_FK,U.nombre,U.apellido,AC.fecha
from Archivo as A  inner join Archivo_Compartido as AC  on id_archivo_FK = id_archivo_PK
                   inner join Usuario as U on id_usuario_recibe_FK = id_usuario_PK ;

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

-- insert into Rol_Usuario values (null,"Admimistrador"),
-- 							   (null,"Usuario");
-- insert into Usuario values (null,1,"Andres","Lobaton","andrespipe021028@gmail.com","andres123","$2y$10$2OLsZUnZIeea5rOuU7efz.O.XEGoKH.u8N4XBFPNUPDou8Z/3tggm",1,"2002-10-28",now());


create view Consulta_Link as
select u.nickname,u.id_usuario_PK,count(l.id_link_PK) as L
          from Usuario as u left join Link as l on u.id_usuario_PK = l.id_usuario_FK
group by u.id_usuario_PK;


create view Consulta_Nota as 
select count(n.id_nota_PK) AS N
          from Usuario as u left join Nota as n on u.id_usuario_PK = n.id_usuario_FK
group by u.id_usuario_PK;


create view Consulta_Archivo as
select count(a.id_archivo_PK) as A
          from Usuario as u left join Archivo as a on u.id_usuario_PK = a.id_usuario_FK
group by u.id_usuario_PK;

create view Consulta_Tarea as
select count(t.id_tarea_PK) as T
          from Usuario as u left join Tarea as t on u.id_usuario_PK = t.id_usuario_FK
group by u.id_usuario_PK;