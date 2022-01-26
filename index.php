<?php
include_once 'includes/connection.php';
include_once 'includes/process.php';
include_once 'includes/businessRules.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sistema da Loja</title>
	<link rel="stylesheet" type="text/css" href="styles/styles.css">
</head>

<body>

	<!-- FORMULÁRIO DE INCLUSÃO E ATUALIZAÇÃO DOS DADOS -->

	<table align="center" class = "formulario">
		<form action="" method="POST">

			<tr>
				<td colspan='2' style='text-align: center'>
					<h3 id="titulo">INCLUIR PRODUTO</h3>
				</td>
			</tr>

			<tr>

				<!-- Campo nome -->

				<th><label>Nome </label></th>
				<th><input type "text" name="nome" value='<?php echo $nome; ?>' placeholder="Digite o nome do produto"></th>
			<tr>

				<!-- Campo preço  -->

				<th><label>Preço s/ desc. </label></th>
				<th><input type "text" name="preco" value='<?php echo $preco; ?>' placeholder="Digite o preço do produto"></th>
			<tr>

				<!-- Campo cor -->

				<th><label>Cor </label></th>
				<th><select id="cor" name="cor" onchange="alteraCor(this)" style="color: gray; width:177px;" required>

						<?php
						$parametros = $_SERVER['QUERY_STRING'];
						if (isset($_GET["editar"])) {
							echo "<option value = '$cor' selected disabled hidden> $cor </option>";
						} else {
							echo "<option value = '' selected disabled hidden>Selecione a cor </option>";
						}
						?>

						<option value="amarelo" <?php echo $cor == 'amarelo' ? 'selected' : "" ?>>amarelo</option>
						<option value="azul" <?php echo $cor == 'azul' ? 'selected' : "" ?>>azul</option>
						<option value="vermelho" <?php echo $cor == 'vermelho' ? 'selected' : "" ?>>vermelho</option>
				</th>

			<tr>
				<th></th>
				<th>


					<!-- Botões de inclusão e atualização -->

					<?php

					$parametros = $_SERVER['QUERY_STRING'];

					if (isset($_GET["editar"])) {
						echo "<button id = 'atualizar' type = 'submit' name = 'atualizar' class = 'botao'> Atualizar</button>";
					} else {
						echo "<button id = 'incluir' type = 'submit' name = 'salvar' class = 'botao'> Incluir</button>";
					}

					?>

				</th>
		</form>
	</table>

	<br>

	<!-- CAMPO DE BUSCA -->

	<table align="center" class = "busca">
		<form action="" method="GET">
			<tr>
				<td>
					Filtrar por
				</td>
				<td>
					<select class= "metodo" id="metodo" name = "metodo">
						<option value="produto" name = "procuraNome">produto</option>
						<option value="preco" name = "procuraPreco">preço s/ desc.</option>
						<option value="cor" name = "procuraCor">cor</option>
					</select>
				</td>
				<td>
						<div id = "buscaNome"><input id = "campoNome" type "text" name="buscaNome" value='' placeholder=""></th></div>

						<div hidden id = "buscaPreco">
							<select id = 'operador' name = 'operador'><option value = '' selected disabled hidden></option><option value='maior'>></option> <option value='menor'><</option><option value='igual'>=</option></select>	
							<input id = "campoPreco" type "text" name="buscaPreco" value='' placeholder="" style="width:125px">
						</div>

						<div hidden id = "buscaCor"><select id = 'campoCor' name = 'buscaCor'><option value = '' selected disabled hidden></option><option value='amarelo'>amarelo</option><option value='azul'>azul</option><option value='vermelho'>vermelho</option></select></div>
					</td>
				<td>
					<?php
						echo "<a href = 'index.php?buscar=" . $busca . "' style= 'color: black; text-decoration: none'><button class = 'botao' id = 'botaoBuscar'>Buscar</button</a>	";
					?>
				</td>

			</tr>
		</form>
	</table>


	<!-- TABELA DE EXIBIÇÃO DOS DADOS -->

	<table align="center" border="1px" style="border-collapse:collapse" id = 'dados' >
		<tr>
			<th>
				<h4>PRODUTO</h4>
			</th>
			<th>
				<h4>PREÇO C/ DESC.</h4>
			</TH>
			<th>
				<h4>COR</h4>
			</th>
			<th>
				<h4>AÇÃO</h4>
			</th>
		</tr>

		<br>

		<?php



		// Executa a query
		$resultado = $conexao->query($sqlDados);

		if ($resultado->num_rows > 0) {
			while ($row = $resultado->fetch_array()) {

				$idprod = $row["idprod"];
				$nome = $row["nome"];
				$cor = $row["cor"];
				$preco = $row["preco"];

				echo "<tr>
						<td>" . $nome . "</td>

						<td> R$ " . formataMoeda(calculaDesconto($preco, $cor), $moeda) . "</td>

						<td>" . $cor . "</td>
						
						<td>
							<a href = 'index.php?editar=" . $idprod . "' style= 'color: white; text-decoration: none'><button id = 'editar' class = 'botao'>Editar</button</a>	
							<a href = 'index.php?deletar=" . $idprod . "' style= 'color: black; text-decoration: none'><button class = 'botao' id = 'botaoApagar'>Apagar</button</a>	
						</td>
					</tr>";
			}
			echo "</table";
		} else {
			echo "<tr><td colspan = '4' style = 'text-align: center'>Nenhum resultado.</td></tr>";
		}

		$conexao->close();

		?>

	</table>

	<!-- JAVASCRIPT -->

	<script src="script.js" type="text/javascript"></script>

	<?php
	if (isset($_GET["editar"])) {
		echo "<script>modoEdicao();</script>";
	}

	if (($habilitarEdicaoDeCor == false) && (isset($_GET["editar"]))) {
		echo "<script>desabilitaAlteracaoDeCor();</script>";
	}
	?>


</body>

</html>