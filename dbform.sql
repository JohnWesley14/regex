-- Active: 1782935527149@@127.0.0.1@3306@usuarios
CREATE DATABASE usuarios;

CREATE TABLE tb_usuarios (
   cpf VARCHAR(14) primary key,
   nome VARCHAR (255),
   telefone VARCHAR(15),
   email varchar(255)
);
SELECT * FROM tb_usuarios;
desc tb_usuarios;