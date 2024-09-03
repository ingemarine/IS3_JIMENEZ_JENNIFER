create table ROLES (
ROLES_ID SERIAL PRIMARY KEY NOT NULL,
ROLES_NOMBRE VARCHAR(30) NOT NULL,
ROLES_SITUACION SMALLINT DEFAULT 1
);

CREATE TABLE USERS (
US_ID SERIAL PRIMARY KEY NOT NULL,
US_NOMBRE VARCHAR(25) NOT NULL,
US_EMAIL VARCHAR(35) NOT NULL,
US_PASSWORD LVARCHAR(255) NOT NULL,
ROLES_ID INTEGER,
FOREIGN KEY (ROLES_ID) REFERENCES ROLES (ROLES_ID)
);

CREATE TABLE PUNTOS (
PUNTO_ID SERIAL PRIMARY KEY NOT NULL,
PUNTO_NOMBRE VARCHAR(25) NOT NULL,
LATITUD DECIMAL(10, 8) NOT NULL,
LONGITUD DECIMAL(11,8) NOT NULL
);

CREATE TABLE ENVIOS (
ENVIO_ID SERIAL PRIMARY KEY NOT NULL,
ENVIO_FECHA DATE NOT NULL,
US_ID INTEGER,
ORIGEN_ID INTEGER,
DESTINO_ID INTEGER,
ESTADO VARCHAR(20),
FOREIGN KEY (US_ID) REFERENCES USERS (US_ID),
FOREIGN KEY (ORIGEN_ID) REFERENCES PUNTOS (PUNTO_ID),
FOREIGN KEY (DESTINO_ID) REFERENCES PUNTOS (PUNTO_ID)
);

create table permisos (
permisos_id serial,
permisos_users integer,
permisos_roles integer,
permisos_situacion smallint default 1,
primary key (permisos_id),
foreign key (permisos_roles) references roles (roles_id),
foreign key (permisos_users) references users (us_id)
);


--DETALLE ENVIO

 CREATE TABLE DETALLE_ENVIO (
 DETALLE_ID SERIAL PRIMARY KEY NOT NULL,
 DETALLE_ENVIO INTEGER,
 DETALLE_USER INTEGER,
 DETALLE_CANTIDAD INTEGER,
 DETALLE_SITUACION SMALLINT DEFAULT 1,
 FOREIGN KEY (DETALLE_ENVIO) REFERENCES ENVIOS (ENVIO_ID),
 FOREIGN KEY (DETALLE_USER) REFERENCES USERS (US_ID)
 );
 

//INSERTS
INSERT INTO roles (roles_nombre) VALUES ('Usuario Normal');
INSERT INTO roles (roles_nombre) VALUES ('Usuario Administrativo');
INSERT INTO roles (roles_nombre) VALUES ('Administrador');

-- Insertar usuarios
INSERT INTO users (us_nombre, us_email, us_password, roles_id) 
VALUES ('Jennifer Jimenez', 'jennifer@gmail.com','e10adc3949ba59abbe56e057f20f883e' , 1);
INSERT INTO users (us_nombre, us_email, us_password, roles_id) 
VALUES ('Lucas Martinez', 'lucas@gmail.com','827ccb0eea8a706c4c34a16891f84e7b', 2);
INSERT INTO users (us_nombre, us_email, us_password, roles_id) 
VALUES ('Ronaldd Castellanos', 'ronald@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 3);

-- Insertar puntos de origen y destino
INSERT INTO puntos (punto_nombre, latitud, longitud) 
VALUES ('Ciudad de Guatemala', 14.64072, -90.513227);
INSERT INTO puntos (punto_nombre, latitud, longitud) 
VALUES ('Zacapa', 14.97222, -89.53056);
INSERT INTO puntos (punto_nombre, latitud, longitud) 
VALUES ('Quetzaltenango', 14.83472, -91.51806);
INSERT INTO puntos (punto_nombre, latitud, longitud) 
VALUES ('Puerto Barrios', 15.72778, -88.59444);

-- Insertar envíos
INSERT INTO envios (envio_fecha, us_id, origen_id, destino_id, estado) 
VALUES ('2024-09-01', 1, 3, 2, 'En Tránsito');
INSERT INTO envios (envio_fecha, us_id, origen_id, destino_id, estado) 
VALUES ('2024-09-02', 2, 1, 2, 'Entregado');
INSERT INTO envios (envio_fecha, us_id, origen_id, destino_id, estado) 
VALUES ('2024-08-31', 3, 4, 1, 'En bodega');

--INSERT DETALLE ENVIOS
 insert into detalle_envio (detalle_envio, detalle_user,detalle_cantidad, detalle_situacion) values (1, 1, 1, 1);
      insert into detalle_envio (detalle_envio, detalle_user,detalle_cantidad, detalle_situacion) values (1, 3,2, 1);
            insert into detalle_envio (detalle_envio, detalle_user,detalle_cantidad, detalle_situacion) values (2, 2,3, 1);
      insert into detalle_envio (detalle_envio, detalle_user,detalle_cantidad, detalle_situacion) values (2, 1,2, 1);



INSERT INTO permisos (permisos_users, permisos_roles) 
VALUES ( 1, 1);
INSERT INTO permisos (permisos_users, permisos_roles) 
VALUES ( 2, 2);
INSERT INTO permisos (permisos_users, permisos_roles) 
VALUES ( 3, 3);

select * from permisos

SELECT * FROM permisos 
INNER JOIN roles ON permisos_roles = roles_id WHERE permisos_users = 1;

SELECT * FROM users where us_email = 'jennifer@gmail.com'


SELECT US_NOMBRE AS USERS, SUM (DETALLE_CANTIDAD) AS CANTIDAD_ENVIO FROM DETALLE_ENVIO 
INNER JOIN USERS ON DETALLE_USER = US_ID WHERE DETALLE_SITUACION = 1 GROUP BY US_NOMBRE

SELECT * FROM users
SELECT * FROM envios
SELECT * FROM roles
SELECT * FROM puntos
SELECT * FROM detalle_envio