-- Criação do banco de dados
CREATE DATABASE certificados;

-- Selecionar o banco de dados para uso
USE certificados;

-- Criação da tabela evento
CREATE TABLE evento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    data DATE NOT NULL,
    horas INT NOT NULL,
    palestrante VARCHAR(100) NOT NULL,
    descricao TEXT
);

-- Criação da tabela inscritos
CREATE TABLE inscritos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telefone VARCHAR(20),
    palestrante INT,
    inscricao INT,
    FOREIGN KEY (inscricao) REFERENCES evento(id)
);

-- Criação da tabela usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telefone VARCHAR(20),
    admin TINYINT(1) DEFAULT 0
);
