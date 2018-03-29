<?php include_once("registra_conta.php");
	include_once("footer.php");
	include_once("functions.php");
	$grupo = filtraContas();
	$receber = selectContasReceber();
	if(!$_SESSION['usuario']){
		header('Location: index.php?erro=1');
	}
?>

<?php

    $dbhandle = new mysqli('localhost', 'root', '', 'despesas');
    echo $dbhandle->connect_error;

    $query = "select 'Saidas',SUM(contas.valor)
from contas
union
select 'Entradas',SUM(contas_receber.valor)
from contas_receber";

$res = $dbhandle->query($query);

?>

<!DOCTYPE HTML>
<html lang="pt-br">
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Despesas</title>
		<link rel="icon" href="imagens/favicon1.png">

		<!-- jquery - link cdn -->
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>

		  <script src="https://code.jquery.com/jquery-3.2.1.min.js"
		  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
		  crossorigin="anonymous"></script>


		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="estilo.css" rel="stylesheet">

		 <script type="text/javascript">
		 var options = {'title':'Despesas',
                     'width':400,
                     'height':220,
                     titleTextStyle: {
   					 color: 'white',
   					 fontSize: '14',
   					 fontName: 'Tahoma',
  					},
  					legend: {
  						textStyle:{
  							color: 'white',
  						}
  					},
  					'backgroundColor': 'transparent',
  					'colors': ['#AA8E26', 'grey', 'blue', 'orange'],
  					'legend.alignment': 'center',
					'is3D':'true',
                     }

	      google.load('visualization', '1.0', {'packages':['corechart']});
	      google.setOnLoadCallback(function(){


	        var json_text = $.ajax({url: "getDadosGrafico.php", dataType:"json", async: false}).responseText;
	        var json = eval("(" + json_text + ")");
	        var dados = new google.visualization.DataTable(json.dados);

	        var chart = new google.visualization.PieChart(document.getElementById('area_grafico_despesas'));
	        chart.draw(dados, options);
      });
    </script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Saidas', 'SUM(contas.valor)'],
          
          <?php 
while($row=$res->fetch_assoc())
{
    echo "['".$row['Saidas']."',".$row['SUM(contas.valor)']."],";
}

          ?>

        ]);

		var options2 = {'title':'Saídas x Entradas',
                     'width':400,
                     'height':220,
                     titleTextStyle: {
   					 color: 'white',
   					 fontSize: '14',
   					 fontName: 'Tahoma',
  					},
  					legend: {
  						textStyle:{
  							color: 'white',
  						}
  					},
  					'backgroundColor': 'transparent',
  					'colors': ['#AA8E26', 'grey', 'blue', 'orange'],
  					'legend.alignment': 'center',
					'is3D':'true',
                     }

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options2);
      }
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
				      <li class="active"><a href="home.php">Home</a></li>
				      <li class="dropdown">
				        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Cadastro
				        <span class="caret"></span></a>
				        <ul class="dropdown-menu">
				          <li><a href="inserir_pessoa.php">Cadastro de Clientes</a></li>
				          <li><a href="inserir_produto.php">Cadastro de Produtos</a></li>
				          <li role="separator" class="divider"></li>
				          <li><a href="movimenta_estoque.php">Movimentação de estoque</a></li>
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
				          <li role="separator" class="divider"></li>
				          <li><a href="consulta_mov_estoques.php">Consulta de Movimentações de Estoque</a></li>
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

		<br>
		<br><br><br><br><br><br><br>
		<div class="container">
			<div class="col-md-4">

				<div class="panel panel-default">
					<div class="panel-body">
						<h4 align="center">Bem vindo, <?= ucfirst($_SESSION['usuario']) ?> </h4>
						<hr />
						<div class="col-md-6">

							Suas Despesas <br />
							<?php
							if (is_array($grupo) || is_object($grupo)){
							    $valortotal = '';
							    foreach($grupo as $contas){
							        $valortotal += $contas["valor"];
							    }
							    echo 'R$'. $valortotal;
							}else{
								echo 'R$'. '0';
							}
							?>
						</div>
						<div class="col-md-6">
							Saldo <br />

							<?php
							if(is_array($receber) || is_object($receber)){
								$saldo = '';
								if(empty($valortotal)){
									$valortotal = '';
								}
								foreach($receber as $recebimentos){
									$saldo += $recebimentos["valor"];
								}
								$saldo = $saldo - $valortotal;
								echo 'R$'. ($saldo);
							}
							else{
								echo 'R$'. '0';
							}
							?>
						</div>
					</div>
				</div>
			</div>

					<style>
					#area_grafico_despesas{
					background-color: #4E342E;
					border-radius: 10px;
					box-shadow: 2px 2px 2px white;
				}

				#piechart{
					background-color: #4E342E;
					border-radius: 10px;
					box-shadow: 2px 2px 2px white;
				}

				#area_grafico_despesas_entrada{
					background-color: #4E342E;
					border-radius: 10px;
					box-shadow: 2px 2px 2px white;
				}
					</style>
					<div class="col-md-4">
					<div id="area_grafico_despesas"> </div>
				</div>
					<div class="col-md-4">
					<div id="area_grafico_despesas_entrada"> </div>

					</div>

					<div class="col-md-4">
					<div id="piechart">
						<div id="piechart" style="width: 900px; height: 500px;"></div>
					</div>
</div>





		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</body>
</html>