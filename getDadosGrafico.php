<?php

//Estrutura básica do gráfico

$grafico = array(
    'dados' => array(
        'cols' => array(
            array('type' => 'string', 'label' => 'Observação'),
            array('type' => 'number', 'label' => 'Valor')
        ),  
        'rows' => array()
    ),
);

//Consulta dados no BD
$pdo = new PDO('mysql:host=localhost;dbname=despesas', 'root', '');
$sql = 'SELECT observacao,valor FROM contas GROUP BY observacao';
$stmt = $pdo->query($sql);
while ($obj = $stmt->fetchObject()){
	$grafico['dados']['rows'][] = array('c' => array(
		array('v' => $obj->observacao),
		array('v' => (int)$obj->valor),
	));
}

// Enviar dados na forma de JSON
header('Content-Type: application/json; charset=UTF-8');
echo json_encode($grafico);
exit(0);