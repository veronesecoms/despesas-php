<?php
	include_once("conexao.php");
	session_start();

	if(!$_SESSION['usuario']){
		header('Location: index.php?erro=1');
	}
?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Despesas</title>

		<!-- jquery - link cdn -->

		  <script src="https://code.jquery.com/jquery-3.2.1.min.js"
		  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
		  crossorigin="anonymous"></script>

		  <script src="jquery-maskmoney-master/dist/jquery.maskMoney.min.js" type="text/javascript"></script>

		  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>


		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

		<!-- bootstrap - link cdn -->
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link href="estilo.css" rel="stylesheet">
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
				      <li>
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
				<form name="dadosMovEstoque" action="registra_mov_estoque.php" method="POST">
					<div class="form-group">
						<label for="dataLancamento" style="color:#E4CDAC; font-size: 17px; font-family:Arial">Data Lançamento</label>
						<input type="date" class="form-control" id="dataLancamento" name="dataLancamento">
					</div>

					<div class="form-group">
						<label for="tipoMov" style="color:#E4CDAC; font-size: 17px;font-family:Arial">Tipo Movimentação</label>
						<select class="form-control" name="select_tipoMov">
							<option>Selecione o Tipo de Movimentação</option>
								<option value="1">Entrada</option>
  								<option value="2">Saida</option>
  						</select>
  					</div>


  					<div class="form-group">
						<label for="fornecedores" style="color:#E4CDAC; font-size: 17px;font-family:Arial">Cliente/Fornecedor</label>
						<p>
						<select class="selectpicker"  data-live-search="true" data-width="565px" name="select_clientes">
							<option>Selecione o Fornecedor</option>
							<?php

							$result_clientes = "SELECT * FROM pessoa";
							$resultado = mysqli_query($conn, $result_clientes);
							while($row_clientes = mysqli_fetch_assoc($resultado)){
								?>
								<option value="<?php echo $row_clientes['id']; ?>"> <?php echo $row_clientes['nome']; ?>
								</option> <?php
							}

							?>
						</select>
					</div>

					<div class="form-group">
						<label for="descricao" style="color:#E4CDAC; font-size: 17px; font-family:Arial">Observação</label>
						 <textarea class="form-control" rows="2" id="descricao" name="descricao" placeholder="Insira uma observação"></textarea>
					</div>

					<div class="form-group">
						<label for="produtos" style="color:#E4CDAC; font-size: 17px;font-family:Arial">Produtos</label>
						<p>
						<select class="selectpicker" multiple data-width="570px" data-live-search="true" name="select_produtos[]">
							<option>Selecione o Produto</option>
							<?php

							$result_produtos = "SELECT * FROM produtos WHERE fg_ativo = '1' ";
							$resultado = mysqli_query($conn, $result_produtos);
							while($row_produtos = mysqli_fetch_assoc($resultado)){
								?>
								<option value="<?php echo $row_produtos['id']; ?>"> <?php echo $row_produtos['descricao'];
								 ?>
								</option> <?php
							}

							?>
						</select>
					</div>

					<div class="form-group">
						<label for="quantidade" style="color:#E4CDAC; font-size: 17px; font-family:Arial">Quantidade</label>
						 <input type="number" class="form-control" id="quantidade" name="quantidade" ></input>
					</div>

					<input type="hidden" name="acao" value="inserir">

				<div class="form-group">
				<button onclick="msgSucesso()" type="submit" class="btn customizado btn-roxo btn-lg">Realizar movimentação</button>
				</div>


				<script>
				function msgSucesso(){
					alert('Movimentação realizada com sucesso!');
				}
				</script>

