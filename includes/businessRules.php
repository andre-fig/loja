<?php

// FUNÇÃO RESPONSÁVEL POR CALCULAR O DESCONTO
function calculaDesconto($preco, $cor)
{
	if ($cor == 'amarelo') {
		return $preco * 0.9;
	}

	if (($cor == 'vermelho' && $preco <= 50) || $cor == 'azul') {
		return $preco * 0.8;
	}

	if ($cor == 'vermelho' && $preco > 50) {
		return  $preco * 0.95;
	}

	return $preco;
}

// DESABILITA A ALTERAÇÃO DA COR: true para habilitar e false para desabilitar

$habilitarEdicaoDeCor = false;


// FUNÇÃO RESPONSÁVEL POR EXIBIR A MOEDA NO FORMATO BRASILEIRO
function formataMoeda($valor, $moeda){
	if ($moeda == 'real'){
		$valorFormatado = number_format($valor, 2, ",", ".");
	}

	return $valorFormatado;
}

// SELECIONA O FORMATO DA MOEDA
$moeda = 'real';