-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS gestao_comunitaria;
USE gestao_comunitaria;

-- Tabela Voluntario
CREATE TABLE Voluntario (
    id_voluntario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    telefone VARCHAR(20),
    data_cadastro DATE
);

-- Tabela Acao
CREATE TABLE Acao (
    id_acao INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    descricao TEXT,
    data_inicio DATE,
    data_fim DATE,
    status ENUM('planejada', 'andamento', 'concluida') DEFAULT 'planejada'
);

-- Tabela Beneficiario
CREATE TABLE Beneficiario (
    id_beneficiario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    endereco VARCHAR(200),
    telefone VARCHAR(20),
    data_cadastro DATE
);

-- Tabela Doacao
CREATE TABLE Doacao (
    id_doacao INT AUTO_INCREMENT PRIMARY KEY,
    id_voluntario INT,
    id_acao INT,
    valor DECIMAL(10,2),
    tipo_item VARCHAR(50),
    quantidade INT,
    data_doacao DATE,
    FOREIGN KEY (id_voluntario) REFERENCES Voluntario(id_voluntario) ON DELETE SET NULL,
    FOREIGN KEY (id_acao) REFERENCES Acao(id_acao) ON DELETE SET NULL
);

-- Tabela Atendimento
CREATE TABLE Atendimento (
    id_atendimento INT AUTO_INCREMENT PRIMARY KEY,
    id_beneficiario INT,
    id_voluntario INT,
    data_atendimento DATE,
    descricao TEXT,
    FOREIGN KEY (id_beneficiario) REFERENCES Beneficiario(id_beneficiario),
    FOREIGN KEY (id_voluntario) REFERENCES Voluntario(id_voluntario)
);

-- Tabela ContatoMensagem
CREATE TABLE ContatoMensagem (
    id_mensagem INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    mensagem TEXT NOT NULL,
    data_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de usuários para login
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL
);

-- Inserir usuário padrão (admin / admin123)
INSERT INTO usuarios (usuario, senha) VALUES ('admin', MD5('admin123'));

-- Dados de exemplo para testes
INSERT INTO Voluntario (nome, email, telefone, data_cadastro) VALUES
('João Silva', 'joao@email.com', '(11) 99999-1111', '2025-01-10'),
('Maria Santos', 'maria@email.com', '(11) 99999-2222', '2025-01-15');

INSERT INTO Acao (titulo, descricao, data_inicio, data_fim, status) VALUES
('Campanha de Inverno', 'Arrecadação de cobertores e agasalhos', '2025-05-01', '2025-06-30', 'andamento'),
('Cesta Básica', 'Distribuição de alimentos', '2025-06-01', '2025-06-15', 'planejada');

INSERT INTO Beneficiario (nome, endereco, telefone, data_cadastro) VALUES
('Ana Paula', 'Rua A, 123', '(11) 98888-1111', '2025-02-01'),
('Carlos Souza', 'Rua B, 456', '(11) 98888-2222', '2025-02-10');

INSERT INTO Doacao (id_voluntario, id_acao, valor, tipo_item, quantidade, data_doacao) VALUES
(1, 1, NULL, 'Cobertor', 5, '2025-05-10'),
(2, 1, 100.00, 'Dinheiro', NULL, '2025-05-12');