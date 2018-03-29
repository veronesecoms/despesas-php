<?php

	$servidor = "localhost";
	$usuario = "root";
	$senha = "";
	$dbname = "despesas";

	//criar a conexão
	$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

	if(!$conn){
		die("Falha na conexão com bd: " .mysqli_connect_error());
	}
	else{
		
	}





?>