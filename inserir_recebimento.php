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
		  
		  <script type="text/javascript" src="js/jquery.mask.min.js"/></script>


		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

		<!-- bootstrap - link cdn -->
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link href="estilo.css" rel="stylesheet">
	</head>

	<body>

		<!-- Static navbar -->
<!-- Static navbar -->
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
				      <li class="active">
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
				<label for="dataemissao" style="color:#E4CDAC; font-size: 17px; font-family:Arial">Data de Emissão</label>
				<input type="date" class="form-control" id="dataemissao" name="dataemissao" required>
			</div>

			<div class="form-group">
				<label for="cliente" style="color:#E4CDAC; font-size: 17px;font-family:Arial">Cliente</label>
				<select class="form-control" name="select_clientes">
					<option>Selecione o Cliente</option>
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
				<label for="valor" style="color:#E4CDAC; font-size: 17px;font-family:Arial">Valor</label>
				<input type="text" class="form-control" name="valor" id="valor"/>
			</div>

			<div class="form-group">
				<label for="especie" style="color:#E4CDAC; font-size: 17px;font-family:Arial">Espécie</label>
				<select class="form-control" name="select_especies">
					<option>Selecione a Espécie</option>
					<?php

					$result_especies = "SELECT * FROM especies";
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
				<label for="observacao" style="color:#E4CDAC; font-size: 17px; font-family:Arial">Observação</label>
				<textarea class="form-control" rows="2" id="observacao" name="observacao"></textarea>
			</div>

			<input type="hidden" name="acao" value="inserir">

			<div class="form-group">
				<button onclick="msgSucesso()" type="submit" class="btn customizado btn-roxo btn-lg">Cadastrar</button>
			</div>

		</form>
			<script>
				function msgSucesso(){
					alert('Entrada adicionada com sucesso!');
				}
			</script>
			<script>
			$("#valor").maskMoney({thousands:'', decimal:'.', allowZero:true});
			</script>

			
	</div>
</div>

	</body>
</html>