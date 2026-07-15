-- Active: 1784142556848@@127.0.0.1@3306@usuarios
CREATE DATABASE if not exists usuarios;

use usuarios;
CREATE TABLE tb_usuarios (
   cpf VARCHAR(14) primary key,
   nome VARCHAR (255) NOT NULL,
   telefone VARCHAR(15) NOT NULL,
   email varchar(255) NOT NULL, 
   imagem VARCHAR(255)
);
TRUNCATE tb_usuarios;
SELECT * FROM tb_usuarios;
desc tb_usuarios;

