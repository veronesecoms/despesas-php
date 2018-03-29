<?php
	$erro = isset($_GET['erro']) ? $_GET['erro'] : 0;

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Despesas</title>
    <link rel="icon" href="imagens/favicon1.png">
    
     <script src="https://code.jquery.com/jquery-3.2.1.min.js"
      integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
      crossorigin="anonymous"></script>


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="estilo.css" rel="stylesheet">

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

    <div class="capa">
    <div class="texto-capa">
      <img height="410" align="middle" src="imagens/control01.png">
      <br>
      <a href="inscrevase.php" class="btn btn-custom btn-roxo btn-lg">Começar agora</a>
    </div>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>