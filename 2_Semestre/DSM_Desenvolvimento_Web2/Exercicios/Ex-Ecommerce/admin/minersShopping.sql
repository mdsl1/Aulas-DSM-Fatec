CREATE DATABASE IF NOT EXISTS miners_shopping_db;

USE miners_shopping_db;

CREATE TABLE IF NOT EXISTS produtos (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    descricao VARCHAR(500) NOT NULL,
    preco DECIMAL(9,2),
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS clientes (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR (50) NOT NULL,
    endereco VARCHAR(50),
    cidade VARCHAR(50),
    estado CHAR(2),
    email VARCHAR(30),
    senha VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT,
    data DATETIME,
    total DECIMAL(10,2)
);

CREATE TABLE IF NOT EXISTS itens_pedido (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pedido INT,
    id_produto INT,
    qtde INT
);

INSERT INTO produtos (nome, descricao, preco)
VALUES ('Picareta Comum', 'Picareta simples para minerações lentas e improdutivas.', 256.32);

INSERT INTO produtos (nome, descricao, preco)
VALUES ('Picareta de Diamante', 'Picareta feita com diamantes, perfeita pra extrair obsidiana.', 512.32);

INSERT INTO produtos (nome, descricao, preco)
VALUES ('Picareta de Netherite', 'Picareta extremamente resistente, feita com mineral obtido diretamente do submundo.', 1024.32);

INSERT INTO produtos (nome, descricao, preco)
VALUES ('Picareta de Netherite Encantada', 'Combina a resistencia da picareta de netherite com encantamentos antigos de velocidade.', 2048.32);

INSERT INTO produtos (nome, descricao, preco)
VALUES ('Escavadora de Mão', 'Ferramenta utilizada por anões mineradores nas minas espaciais.', 4096.32);

INSERT INTO produtos (nome, descricao, preco)
VALUES ('Pack de 64 Tochas', 'Um pack de tochas ideal para explorar cavernas escuras.', 64.32);

INSERT INTO clientes (nome, endereco, cidade, estado, email, senha)
VALUES ('Rodolfo', 'Rua das Amêndoas, 255', 'Marília', 'SP', 'aaa@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92');

CREATE USER 'php'@'localhost' IDENTIFIED BY 's3gr3d0';
GRANT ALL ON miners_shopping_db.* TO 'php'@'127.0.0.1:3309';