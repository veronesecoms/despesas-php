<?php

	$erro = isset($_GET['erro']) ? $_GET['erro'] : 0;
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
		<link href="estilo.css" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"
		  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
		  crossorigin="anonymous"></script>

		  <script src="jquery-maskmoney-master/dist/jquery.maskMoney.min.js" type="text/javascript"></script>


		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

		<!-- bootstrap - link cdn -->

		<script>

			//verificar se os campos de usuário e senha foram devidamente preenchidos
			$(document).ready(function(){

				$('#btn_login').click(function(){

					var campo_vazio = false;

					if($('#campo_usuario').val() == ''){
						$('#campo_usuario').css({'border-color' : '#9C0E0E'});
						$('#campo_usuario').css({'border-width' : '2px'});
						campo_vazio = true;
					}else{
						$('#campo_usuario').css({'border-color' : '#CCC'});
					}

					if($('#campo_senha').val() == ''){
						$('#campo_senha').css({'border-color' : '#9C0E0E'});
						$('#campo_senha').css({'border-width' : '2px'});
						campo_vazio = true;
					}else{
						$('#campo_senha').css({'border-color' : '#CCC'});
					}

					if(campo_vazio) return false;

				});

			});

		</script>

	
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
	    		<h3 style="color: white" align="center">Você já possui uma conta?</h3>
	    		<br />
				<form method="post" action="validar_acesso.php" id="formLogin">
					<div class="form-group">
						<input type="text" class="form-control" id="campo_usuario" name="usuario" placeholder="Usuário" />
					</div>

					<div class="form-group">
						<input type="password" class="form-control red" id="campo_senha" name="senha" placeholder="Senha" />
					</div>
					
					<br>
					<div align="center">
					<button type="buttom" id="btn_login" class="btn btn-custom btn-roxo">Entrar</button>
					</div>
					<br /><br />
				</form>

				<?php
					if($erro == 1){
						echo '<center><font color="white">Usuário e ou senha inválido(s)</font></center>';
					}
				?>

				<?php
					if($sucesso == 1){
						echo '<center><font color="white">Usuário cadastrado com sucesso, você foi redirecionado automaticamente para a página de Login!</font></center>';
					}
				?>

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