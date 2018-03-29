<?php include_once("registra_pessoa.php");
	$grupo = filtraPessoas();



	if(!$_SESSION['usuario']){
		header('Location: index.php?erro=1');
	}

?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>



		<script type="text/javascript">
			function ocultaForm(tag){
				$(tag).show();
			}
		</script>

		<meta charset="UTF-8">

		<title>Despesas</title>

		<!-- jquery - link cdn -->

		  <script src="https://code.jquery.com/jquery-3.2.1.min.js"
		  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
		  crossorigin="anonymous"></script>
		  
		  <script type="text/javascript" src="js/jquery.mask.min.js"/></script>


		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

		<!-- bootstrap - link cdn -->
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link href="estilo.css" rel="stylesheet">



<script type="text/javascript">
        $(document).ready(function(){
                $('.btn_carrega_conteudo').click(function(){
                    if($('#nomefiltrar').val().length > 0){
                        $.ajax({
                            url: 'pdf_clientes.php',
                            method: 'post',
                            data: { nomefiltrar: $('#nomefiltrar').val() },
                            success: function(data){
                                alert('Teste');
                            }
                        });
                    }
            });
        });

</script>

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
				      <li class="dropdown">
				        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Cadastro
				        <span class="caret"></span></a>
				        <ul class="dropdown-menu">
				          <li><a href="inserir_pessoa.php">Cadastro de Clientes</a></li>
				          <li><a href="inserir_produto.php">Cadastro de Produtos</a></li>
				        </ul>
				      </li>
				      <li class="dropdown active">
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
		<br><br><br><br><br>


		<div class="container">
		<div class="thumb">
		<a href="pdf_clientes.php" target="_blank">
		<img src="imagens/printer.png">
		</a>
		<div class="desc"><span style="color:white">Relatório Completo</span></div>
		</div>

		<div class="thumb">
			<img id="filtraresultados" name="filtraresultados" src="imagens/search.png" style="cursor:pointer" "/>
		<div class="desc"><span style="color:white">Filtrar Resultados</span></div>
		</div>


		</div>


		<br>

		<div class="container">
		<form hidden name="filtroClientes" action="consulta_teste_clientes.php" method="POST">

			<div class="form-group">
				<label for="nomefiltrar" style="color:#E4CDAC; font-size: 17px; font-family:Arial">Nome</label>
				<p>
				
				<input type="text" class="teste" id="nomefiltrar" name="nomefiltrar" />
				<input type="hidden" name="acao" value="filtrar"/>

			</div>


			<button type="submit" class="btn btn-custom btn-roxo btn_carrega_conteudo" id="teste">Filtrar</button>
	</div>
</form>


<br>



		<script>
			filtraresultados.addEventListener("click", function() {
   			 	ocultaForm('form');
			}, false);
		</script>

		<script>
			filtraresultados.addEventListener("click", function() {
   			 	ocultaFormBotao('input');
			}, false);
		</script>






		<div class="container divconsultas">

				<table class="table">
			<thread>
				<tr>
					<td align="center" style="color:white; font-size: 17px; font-family:Tahoma">Nome</td>
					<td align="center" style="color:white; font-size: 17px; font-family:Tahoma">Data de nascimento</td>
					<td align="center" style="color:white; font-size: 17px; font-family:Tahoma">Telefone</td>
					<td align="center" style="color:white; font-size: 17px; font-family:Tahoma">Endereço</td>
					<td align="center" style="color:white; font-size: 17px; font-family:Tahoma">Editar</td>
					<td align="center" style="color:white; font-size: 17px; font-family:Tahoma">Excluir</td>
				</tr>
			</thread>
				<?php
				if (is_array($grupo) || is_object($grupo)){
				foreach($grupo as $pessoa){
				 ?>

					<tr>
						<td align="center" style="color:white; font-size: 15px; font-family:Tahoma"> <?=$pessoa["nome"]?> </td>
						<td align="center" style="color:white; font-size: 15px; font-family:Tahoma"> <?=$pessoa["data_formatada"]?> </td>
						<td align="center" style="color:white; font-size: 15px; font-family:Tahoma"> <?=$pessoa["telefone"]?> </td>
						<td align="center" style="color:white; font-size: 15px; font-family:Tahoma"> <?=$pessoa["endereco"]?></td>
						<td align="center" style="color:white; font-size: 15px; font-family:Tahoma">

							 <form align="center" action="alterar_pessoa.php" name="alterar" method="POST">
							 	<input type="hidden" name="id" value=<?=$pessoa["id"]?>>
							 	<input type="submit" class="btn editar cor" value="Editar" name="Editar" class="btn btn-default">
							 </form>
 
						</td>
						<td>

							<form align="center" action="registra_pessoa.php" name="excluir" method="POST">
								<input type="hidden" name="id" value=<?=$pessoa["id"]?>>
								<input type="hidden" name="acao" value="excluir"/>
								<input type="submit" class="btn editar excluir" onclick="msgSucesso()" value="Excluir" name="excluir" class="btn btn-default">
							</form>

						</td>
					</tr>
			

				</div>

					<script>
						function msgSucesso(){
							alert('Pessoa excluida com sucesso');
						}
					</script>


				<?php
				}
			}else{
				echo('Ainda não existem clientes cadastrados');
			}

				?>

			</table>
		</div>


	

	</body>
</html>