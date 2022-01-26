<?php

include_once 'includes/businessRules.php';

session_start();

$nome = "";
$cor = "";
$preco = "";
$idprod = "";
$busca = "";
$metodo = "";

// RESPONSÁVEL PELA INCLUSÃO
if (isset($_POST["salvar"])) {
    $nome = $_POST["nome"];
    $cor = $_POST["cor"];
    $preco = $_POST["preco"];

    // Verifica se os campos estão preenchidos corretamente
    if (!empty($nome) && is_numeric($preco)) {

        $conexao->query("INSERT INTO produtos (nome, cor) VALUES ('$nome', '$cor');")
            or die($conexao->error());
        $conexao->query("INSERT INTO preço (preco, idpreco) VALUES ($preco, (select LAST_INSERT_ID()));")
            or die($conexao->error());
    } else {
        echo "<script>alert('Por favor, verifique os dados e tente novamente.')</script>";
    }

    header("location: index.php");
}

// RESPONSÁVEL PELA EXCLUSÃO

if (isset($_GET["deletar"])) {
    $idprod = $_GET["deletar"];

    $conexao->query("DELETE FROM produtos WHERE idprod = $idprod;")
        or die($conexao->error());
    $conexao->query("DELETE FROM preço WHERE idpreco = $idprod;")
        or die($conexao->error());

    // Redireciona o usuário para o index.php
    header("location: index.php");
}

// RESPONSÁVEL PELA ATUALIZAÇÃO

// Recupera os dados para os campos
if (isset($_GET["editar"])) {
    $idprod = $_GET["editar"];

    $sql = "SELECT produtos.nome, preço.preco, produtos.cor FROM produtos INNER JOIN preço ON produtos.idprod = preço.idpreco WHERE idprod = $idprod;";

    $resultado = $conexao->query($sql);

    $row = $resultado->fetch_assoc();

    $nome = $row['nome'];
    $preco = $row['preco'];
    $cor = $row['cor'];
}

// Atualiza os dados no banco 
if (isset($_POST["atualizar"])) {
    $idprod = $_GET["editar"];

    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $cor = isset($_POST["cor"]) ? $_POST["cor"] : "";

    // Verifica se os campos estão preenchidos corretamente
    if (!empty($nome) && is_numeric($preco)) {
        $conexao->query("UPDATE produtos SET nome = '$nome' WHERE idprod = $idprod;")
            or die($conexao->error());

        $conexao->query("UPDATE preço SET preco = $preco WHERE idpreco = $idprod;")
            or die($conexao->error());

        if (!empty($cor)) {
            $conexao->query("UPDATE produtos SET cor = '$cor' WHERE idprod = $idprod;")
                or die($conexao->error());
        }


        // Redireciona o usuário para o index.php
        header("location: index.php");
    } else {
        echo "<script>alert('Por favor, verifique os dados e tente novamente.')</script>";
    }
}

// RESPONSÁVEL PELA BUSCA
if (isset($_GET["metodo"])){
    $metodo = $_GET["metodo"];

    if ($metodo == 'produto'){
        $buscaNome  = $_GET["buscaNome"];
        $sqlDados = "SELECT Produtos.idprod, Produtos.nome, Produtos.cor, Preço.preco FROM Produtos INNER JOIN Preço ON Produtos.idprod = Preço.idpreco WHERE Produtos.nome LIKE '%$buscaNome%';";
    } elseif ($metodo == 'cor'){
        $buscaCor = $_GET["buscaCor"];
            $sqlDados = "SELECT Produtos.idprod, Produtos.nome, Produtos.cor, Preço.preco FROM Produtos INNER JOIN Preço ON Produtos.idprod = Preço.idpreco WHERE Produtos.cor LIKE '$buscaCor';";
    } elseif ($metodo == 'preco'){
        $operador = $_GET["operador"];
        $buscaPreco = $_GET["buscaPreco"];

        if ($operador == 'maior'){
            $sqlDados = "SELECT Produtos.idprod, Produtos.nome, Produtos.cor, Preço.preco FROM Produtos INNER JOIN Preço ON Produtos.idprod = Preço.idpreco WHERE Preço.preco > $buscaPreco;";
        } elseif ($operador == 'menor'){
            $sqlDados = "SELECT Produtos.idprod, Produtos.nome, Produtos.cor, Preço.preco FROM Produtos INNER JOIN Preço ON Produtos.idprod = Preço.idpreco WHERE Preço.preco < $buscaPreco;";
        } elseif ($operador == 'igual'){
            $sqlDados = "SELECT Produtos.idprod, Produtos.nome, Produtos.cor, Preço.preco FROM Produtos INNER JOIN Preço ON Produtos.idprod = Preço.idpreco WHERE Preço.preco = $buscaPreco;";
        }

    }  
    } else {
    $sqlDados = "SELECT Produtos.idprod, Produtos.nome, Produtos.cor, Preço.preco FROM Produtos INNER JOIN Preço ON Produtos.idprod = Preço.idpreco;";
}
