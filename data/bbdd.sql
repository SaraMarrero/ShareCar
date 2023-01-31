CREATE DATABASE sharecar;
use sharecar;

CREATE TABLE usuario(
    dniUsuario VARCHAR(9) PRIMARY KEY,
    nombreUsuario VARCHAR(20) NOT NULL,
    apellidosUsuario VARCHAR(25) NOT NULL,
    emailUsuario VARCHAR(50) NOT NULL,
    passwordUsuario VARCHAR(20) NOT NULL,
    administrador boolean DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE viaje(
    idViaje INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fechaSalida DATE NOT NULL,
    origen VARCHAR(20) NOT NULL,
    destino VARCHAR(20) NOT NULL,
    pasajeros INT NOT NULL,
    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE datosViaje(
    dniUsuario VARCHAR(9),
    idViaje INT,
    PRIMARY KEY (dniUsuario, idViaje)
);

-- Se crea un administrador
INSERT INTO usuario (dniUsuario, nombreUsuario, apellidosUsuario, emailUsuario, passwordUsuario, administrador) values ("12345678R", "NombreAdmin", "ApellidosAdmin", "admin@gmail.com", "12345", 1); 