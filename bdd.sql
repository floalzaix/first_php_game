DROP DATABASE first_php_game;

CREATE DATABASE first_php_game;

USE first_php_game;

CREATE TABLE personnages (
    id INT AUTO_INCREMENT,
    nom VARCHAR(50),
    deg SMALLINT,
    pv SMALLINT,
    PRIMARY KEY (id)
);