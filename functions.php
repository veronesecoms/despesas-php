<?php
function selectContasReceber(){
	$contas = '';
	$banco = abrirBanco();
	$sql = " SELECT c.*, DATE_FORMAT(c.dataemissao, '%d %b %Y') as dataemissaoformatada, p.nome, e.nome_especie FROM contas_receber c INNER JOIN pessoa p ON (c.id_cliente = p.id) INNER JOIN especies e ON (c.id_especie = e.id)";
	$resultado = $banco->query($sql);
	$banco->close();
	while($row = mysqli_fetch_array($resultado)){
		$contas[] = $row;
	}
	return $contas;
}

function inverteData($data){    
   $parteData = explode("-", $data);    
   $dataInvertida = $parteData[2] . "/" . $parteData[1] . "/" . $parteData[0];
   return $dataInvertida;			
}


?>

