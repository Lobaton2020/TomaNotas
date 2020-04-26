create database archivos;
use archivos;

CREATE TABLE archivos (
    id_archivo INT(100) NOT NULL AUTO_INCREMENT,
    id_usuario_FK INT(100)  NULL ,
    nombre_archivo varchar(500) NOT NULL,
    PRIMARY KEY (id_archivo)
);

