<?php
	include_once("registra_recebimento.php");
	require_once("conexao.php");

	if(!$_SESSION['usuario']){
		header('Location: index.php?erro=1');
	}

	$conta = selectIdConta($_POST["id"]);

?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Despesas</title>
		<link rel="icon" href="imagens/favicon1.png">
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<script
		  src="http://code.jquery.com/jquery-2.2.4.min.js"
		  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
		  crossorigin="anonymous"></script>

		  <script src="jquery-maskmoney-master/dist/jquery.maskMoney.min.js" type="text/javascript"></script>


		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<link href="estilo.css" rel="stylesheet">
		<!-- bootstrap - link cdn -->

	
	</head>

	<body>

		<!-- Static navbar -->
		<nav class="navbar navbar-fixed-top navbar-inverse navbar-transparente">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#barranavegacao">
				        <span class="sr-only">Alternar navegação</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
     				</button>

     				<a href="home.php" class="navbar-brand">
     				   <span class="img-logo">Despesas</span>
     				</a>
     			</div>

     			<div class="collapse navbar-collapse" id="barranavegacao">
					<ul class="nav navbar-nav">
				      <li><a href="home.php">Home</a></li>
				      <li class="dropdown active">
				        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Cadastro
				        <span class="caret"></span></a>
				        <ul class="dropdown-menu">
				          <li><a href="inserir_pessoa.php">Cadastro de Clientes</a></li>
				          <li><a href="inserir_produto.php">Cadastro de Produtos</a></li>
				        </ul>
				      </li>
				      <li class="dropdown">
				        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Consultas
				        <span class="caret"></span></a>
				        <ul class="dropdown-menu">
				          <li><a href="consulta_clientes.php">Consulta de Clientes</a></li>
				          <li><a href="consulta_produtos.php">Consulta de Produtos</a></li>
				          <li role="separator" class="divider"></li>
				          <li><a href="consulta_contas.php">Consulta de Contas a Pagar</a></li>
				          <li><a href="consulta_contas_receber.php">Consulta de Contas a Receber</a></li>
				      </ul>
				      <li class="dropdown">
				        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Financeiro
				        <span class="caret"></span></a>
				        <ul class="dropdown-menu">
				          <li><a href="inserir_conta.php">Contas a Pagar</a></li>
				          <li><a href="inserir_recebimento.php">Contas a Receber</a></li>
				        </ul>
				      </li>


				    </ul>
				
				      <ul class="nav navbar-nav navbar-right">
        <li>
          <a href="">Ajuda</a>
        </li>
        <li class="divisor" role="separator">
        </li>
        <li>
          <a href="sair.php">Sair</a>
        </li>
    </ul>
</div>


			</div>
		</nav>
		<br><br><br><br><br><br><br>

		<div class="container">
			<div class="col-md-6">
		<form name="dadosConta" action="registra_recebimento.php" method="POST">
			<div class="form-group">
				<label style="color:#E4CDAC; font-size: 17px; font-family:Arial" for="dataemissao">Data Emissao</label>
				<input type="date" class="form-control" id="dataemissao" name="dataemissao" value=<?=$conta["dataemissaoformatada"]?>>
			</div>

		<div class="form-group">
				<label for="especie" style="color:#E4CDAC; font-size: 17px;font-family:Arial">Espécie</label>
				<select class="form-control" name="select_especies">
					<?php
					$idespecie = $conta['id_especie'];
					?>
					<option value = <?=$idespecie?> > <?=$conta["nome_especie"]?></option>
					<?php
					$result_especies = "SELECT * FROM especies WHERE id <> '$idespecie' ";
					$resultado = mysqli_query($conn, $result_especies);
					while($row_especies = mysqli_fetch_assoc($resultado)){
						?>
						<option value="<?php echo $row_especies['id']; ?>"> <?php echo $row_especies['nome_especie']; ?>
						</option> <?php
					}

					?>
			</select>

		</div>

		<div class="form-group">
			<label for="valor" style="color:#E4CDAC; font-size: 17px;font-family:Arial">Valor</label>
			<input type="text" class="form-control" value=<?=$conta["valor"]?> name="valor" id="valor"/>
		</div>


			<div class="form-group">
				<label for="cliente" style="color:#E4CDAC; font-size: 17px;font-family:Arial">Cliente</label>
				<select class="form-control" name="select_clientes">
					<?php
					$idselecionado = $conta['id_cliente'];
					?>
					<option value = <?=$idselecionado?> > <?=$conta["nome"]?></option>
					<?php
					$result_fornecedores = "SELECT * FROM pessoa WHERE id <> '$idselecionado' ";
					$resultado = mysqli_query($conn, $result_fornecedores);
					while($row_fornecedores = mysqli_fetch_assoc($resultado)){
						?>
						<option value="<?php echo $row_fornecedores['id']; ?>"> <?php echo $row_fornecedores['nome']; ?>
						</option> <?php
					}

					?>
			</select>

			</div>

			<div class="form-group">
				<label for="observacao" style="color:#E4CDAC; font-size: 17px; font-family:Arial">Observação</label>
				<textarea class="form-control" rows="2" id="observacao" name="observacao"><?=$conta["observacao"]?></textarea>
			</div>

			<input type="hidden" name="acao" value="alterar">
			<input type="hidden" name="id" value="<?=$conta["id"]?>" />

			<div class="form-group">
				<button onclick="msgSucesso()" type="submit" value="Enviar" name="Enviar" class="btn customizado btn-roxo btn-lg">Alterar</button>
			</div>

			<script>
			function msgSucesso(){
				alert('Entrada alterada com sucesso!');
			}
			</script>
			<script>
			$("#valor").maskMoney({thousands:'', decimal:'.', allowZero:true});
			</script>

		</form>
	</div>
</div>


		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

	</body>
</html>