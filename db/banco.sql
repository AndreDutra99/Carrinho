CREATE DATABASE carrinho;

CREATE TABLE usuario (
    id_usuario int PRIMARY KEY AUTO_INCREMENT, 
    nome VARCHAR(255) NOT NULL, 
    senha VARCHAR(255) NOT NULL, 
    email VARCHAR(255) NOT NULL, 
    nivel_acesso int DEFAULT 1
);

CREATE TABLE produto (
    id_produto int PRIMARY KEY AUTO_INCREMENT, 
    nome_produto VARCHAR(255) NOT NULL,  
    preco FLOAT NOT NULL,  
    imagem_produto LONGBLOB
);