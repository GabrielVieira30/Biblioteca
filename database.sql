-- Database: biblioteca_crud
-- Create database if not exists
CREATE DATABASE IF NOT EXISTS biblioteca_crud;
USE biblioteca_crud;

-- Table: autores
CREATE TABLE IF NOT EXISTS autores (
    id_autor INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    nacionalidade VARCHAR(50),
    ano_nascimento INT
);

-- Table: livros
CREATE TABLE IF NOT EXISTS livros (
    id_livro INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    genero VARCHAR(50),
    ano_publicacao INT,
    id_autor INT,
    FOREIGN KEY (id_autor) REFERENCES autores(id_autor) ON DELETE CASCADE
);

-- Table: leitores
CREATE TABLE IF NOT EXISTS leitores (
    id_leitor INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    telefone VARCHAR(20)
);

-- Table: emprestimos
CREATE TABLE IF NOT EXISTS emprestimos (
    id_emprestimo INT AUTO_INCREMENT PRIMARY KEY,
    id_livro INT,
    id_leitor INT,
    data_emprestimo DATE,
    data_devolucao DATE,
    FOREIGN KEY (id_livro) REFERENCES livros(id_livro) ON DELETE CASCADE,
    FOREIGN KEY (id_leitor) REFERENCES leitores(id_leitor) ON DELETE CASCADE
);

-- Insert sample data for autores
INSERT INTO autores (nome, nacionalidade, ano_nascimento) VALUES
('Machado de Assis', 'Brasileiro', 1839),
('Clarice Lispector', 'Brasileira', 1920),
('Jorge Amado', 'Brasileiro', 1912),
('George Orwell', 'Britânico', 1903),
('J.K. Rowling', 'Britânica', 1965),
('Stephen King', 'Americano', 1947);

-- Insert sample data for livros
INSERT INTO livros (titulo, genero, ano_publicacao, id_autor) VALUES
('Dom Casmurro', 'Romance', 1899, 1),
('Memórias Póstumas de Brás Cubas', 'Romance', 1881, 1),
('A Hora da Estrela', 'Romance', 1977, 2),
('Capitães da Areia', 'Romance', 1937, 3),
('1984', 'Ficção Científica', 1949, 4),
('Harry Potter e a Pedra Filosofal', 'Fantasia', 1997, 5),
('O Iluminado', 'Terror', 1977, 6);

-- Insert sample data for leitores
INSERT INTO leitores (nome, email, telefone) VALUES
('João Silva', 'joao@email.com', '(11) 99999-9999'),
('Maria Santos', 'maria@email.com', '(11) 88888-8888'),
('Pedro Oliveira', 'pedro@email.com', '(11) 77777-7777'),
('Ana Costa', 'ana@email.com', '(11) 66666-6666');

-- Insert sample data for emprestimos
INSERT INTO emprestimos (id_livro, id_leitor, data_emprestimo, data_devolucao) VALUES
(1, 1, '2024-01-15', '2024-01-30'),
(2, 2, '2024-02-01', NULL),
(3, 3, '2024-02-10', NULL),
(4, 1, '2024-02-05', NULL),
(6, 4, '2024-01-20', '2024-02-05');
