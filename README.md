#### Comandos SQL responsáveis por criar as tabelas do banco:

```
CREATE TABLE Produtos (  
    idprod  int (11) AUTO_INCREMENT PRIMARY KEY not null,
    nome varchar (256) not null,
    cor varchar (256)
);
```

```
CREATE TABLE Preço (
    idpreco int (11) PRIMARY KEY not null,
    preco decimal (8,2)
);
```

## O que é?

Trata-se de uma aplicação CRUD (Create, Read, Update, Delete).

## Quais são as funcionalidades? 

São disponibilizados os recursos de inserir, remover e editar produtos, além de listá-los ou buscá-los.

A opção de busca permite resgatá-los por nome, cor ou preço. Neste último, pode-se fazer uso de valores iguais, menores ou maiores.

## Regras de negócio

Além disso, o aplicativo segue regras de negócio, passíveis de serem modificadas em arquivo próprio:

* Os produtos de cor azul ou vermelha são exibidos com um desconto de 20%;
* Os produtos de cor amarela são exibidos com um desconto de 10%;
* Os produtos de cor vermelha, quando apresentam valores maior que R$ 50,00, são exibidos com desconto de 5%.
* Uma vez escolhida a cor, nao é possível modificá-la.
* A exibição da tabela contém os números no formato da moeda nacional. 
