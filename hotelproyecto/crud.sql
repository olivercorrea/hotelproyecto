create database crud;
use crud;

create table cliente(
	id int auto_increment primary key,
    nombres varchar(100),
    apellidos varchar(100),
    DNI varchar(10),
    Tipo_habitacion varchar(100),
    Fecha_reserva date,
    hora_ingreso datetime,
    hora_salida datetime,
    celular varchar(12)
);
CREATE TABLE promociones (
	id int NOT NULL AUTO_INCREMENT, 
	promocion varchar(200) DEFAULT NULL,
	duracion varchar(200) DEFAULT NULL, 
	id_cliente int NOT NULL,
	PRIMARY KEY (id),
	KEY fk_promociones_l_idx (id),
	CONSTRAINT fk_promociones_1 FOREIGN KEY (id_cliente) REFERENCES cliente (id)
)