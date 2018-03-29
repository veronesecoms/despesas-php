

<?php

	$erro_usuario = isset($_GET['erro_usuario']) ? $_GET['erro_usuario'] : 0;
	$erro_email = isset($_GET['erro_email']) ? $_GET['erro_email'] : 0;
	$sucesso = isset($_GET['sucesso']) ? $_GET['sucesso'] : 0;
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
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"
		  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
		  crossorigin="anonymous"></script>

		  <script src="jquery-maskmoney-master/dist/jquery.maskMoney.min.js" type="text/javascript"></script>


		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<link href="estilo.css" rel="stylesheet">
		<!-- bootstrap - link cdn -->

	
	</head>

	<body>

		<nav class="navbar navbar-fixed-top navbar-inverse navbar-transparente">
      <div class="container">
        
    <div class="navbar-header">

      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#barranavegacao">
        <span class="sr-only">Alternar navegação</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <a href="index.php" class="navbar-brand">
        <span class="img-logo">Despesas</span>
      </a>

    </div>

    <div class="collapse navbar-collapse" id="barranavegacao">
      <ul class="nav navbar-nav navbar-right">
        <li>
          <a href="">Ajuda</a>
        </li>
        <li class="divisor" role="separator">
        </li>
        <li>
          <a href="inscrevase.php">Registrar</a>
        </li>
        <li>
          <a href="entrar.php">Entrar</a>
        </li>
      </ul>
    </div>

</div>

  </nav>

	    	<br /><br />
	    	<br /><br />
	    	<br /><br />
	    	<br /><br />
	    	<br /><br />

	    	<div class="col-md-4"></div>
	    	<div class="col-md-4">
	    		<h3 style="color: white" align="center">Criar uma conta</h3>
	    		<br />
				<form method="post" action="registra_usuario.php" id="formCadastrarse">
					<div class="form-group">
						<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuário" required="required">
						<?php
							if($erro_usuario){
								echo '<font style="color:white">Este usuário já está em uso.</font>';
							}
						?>
					</div>

					<div class="form-group">
						<input type="email" class="form-control" id="email" name="email" placeholder="Email" required="required">
						<?php
							if($erro_email){
								echo '<font style="color:white">Este email já está em uso.</font>';
							}
						?>
					</div>
					
					<div class="form-group">
						<input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required="required">
					</div>
					<br>
					<div align="center">
					<button type="submit" class="btn btn-custom btn-roxo">Registrar Agora</button>
					</div>
				</form>
			</div>
			<div class="col-md-4"></div>

			<div class="clearfix"></div>
			<br />
			<div class="col-md-4"></div>
			<div class="col-md-4"></div>
			<div class="col-md-4"></div>

		</div>


	    </div>
	
	</body>
</html>