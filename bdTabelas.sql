-- COMANDOS RESPONSÁVEIS POR CRIAR AS TABELAS DO BANCO DE DADOS

CREATE TABLE Produtos (  
    idprod  int (11) AUTO_INCREMENT PRIMARY KEY not null,
    nome varchar (256) not null,
    cor varchar (256)
);

CREATE TABLE Preço (
    idpreco int (11) PRIMARY KEY not null,
    preco decimal (8,2)
);