-- Active: 1784565033500@@127.0.0.1@3306@usuarios_db


CREATE DATABASE if not exists usuarios_db;

use usuarios_db;
DROP table tb_usuarios;
CREATE TABLE tb_usuarios (
   id int AUTO_INCREMENT PRIMARY KEY,
   cpf VARCHAR(14) not NULL UNIQUE,
   nome VARCHAR (255) NOT NULL,
   telefone VARCHAR(15) NOT NULL,
   email varchar(255) NOT NULL UNIQUE, 
   data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   imagem VARCHAR(255)
);
TRUNCATE tb_usuarios;
SELECT * FROM tb_usuarios;
desc tb_usuarios;

SHOW STATUS LIKE 'Threads_connected';
SHOW PROCESSLIST;