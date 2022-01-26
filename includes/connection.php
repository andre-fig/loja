<?php

// Define o host, database, usuário e senha
$bdServidor = "localhost";
$bdUsuario = "root";
$bdSenha = "";
$bdNome = "bdloja";

// Conecta ao banco de dados
$conexao = mysqli_connect($bdServidor, $bdUsuario, $bdSenha, $bdNome);

// Checa se a conexão falhou
if (!$conexao) {
    die("Erro na conexão:" . mysqli_connect_error());
}
