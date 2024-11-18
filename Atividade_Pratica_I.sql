CREATE DATABASE Atividade_Pratica_I;
USE Atividade_Pratica_I;

CREATE TABLE Cliente (
	cliente_id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    telefone VARCHAR(15)
);

CREATE TABLE Colaborador (
	colaborador_id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL
);

CREATE TABLE Chamado (
	chamado_id INT PRIMARY KEY AUTO_INCREMENT,
    cliente_id INT,
    descricao_problema TEXT NOT NULL,
    criticidade ENUM('baixa', 'média', 'alta') NOT NULL,
    status ENUM('aberto', 'em andamento', 'resolvido') DEFAULT 'aberto',
    data_abertura DATETIME DEFAULT CURRENT_TIMESTAMP,
    colaborador_id INT,
    FOREIGN KEY (cliente_id) REFERENCES Cliente(cliente_id),
    FOREIGN KEY (colaborador_id) REFERENCES Colaborador(colaborador_id)
);