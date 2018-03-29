<?php

session_start();


require_once('db.class.php');
require_once('functions.php');

if(!$_SESSION['usuario']){
	header('Location: index.php?erro=1');
}

if(isset($_POST['acao'])){
	if($_POST['acao'] == "inserir"){
		inserirEntrada();
	}
	if($_POST['acao'] == "alterar"){
		alterarEntrada();
	}
	if($_POST['acao'] == "excluir"){
		excluirConta();
	}
	if($_POST['acao'] == "filtrar"){
		filtraRecebimentos();
	}
}

function abrirBanco(){
	$conexao = new mysqli("localhost", "root", "", "despesas");
	return $conexao;
}

function inserirEntrada(){
	 $id = $_POST['id'];
	 $dataemissao = $_POST['dataemissao'];
	 $select_clientes = $_POST['select_clientes'];
	 $select_especies = $_POST['select_especies'];
	 $valor = $_POST['valor'];
	 $observacao = $_POST['observacao'];

	 $emissaoinvertida = inverteData($dataemissao);

	$banco = abrirBanco();
	$sql = "INSERT INTO contas_receber(dataemissao,valor, id_cliente, id_especie, observacao) VALUES ('$emissaoinvertida', '$valor', '$select_clientes', '$select_especies', '$observacao')";

	$banco->query($sql);
	$banco->close();

	header('Location: consulta_contas_receber.php');
}

function alterarEntrada(){
	 $dataemissao = $_POST['dataemissao'];
	 $select_especies = $_POST['select_especies'];
	 $select_clientes = $_POST['select_clientes'];
	 $id_conta_selecionada = $_POST['id'];
	 $valor = $_POST["valor"];
	 $observacao = $_POST['observacao'];
	 $banco = abrirBanco();
	 $emissaoinvertida = inverteData($dataemissao);
	 $sql = " UPDATE contas_receber SET dataemissao = '$emissaoinvertida', valor = '$valor', observacao = '$observacao', id_cliente = '$select_clientes', id_especie = '$select_especies' WHERE id= '$id_conta_selecionada' ";
	$banco->query($sql);
	$banco->close();

	header('Location: consulta_contas_receber.php');
}

function filtraRecebimentos(){
	$contas = '';
	$banco = abrirBanco();
	if(!empty($_POST['nomefiltrar'])){
		$nomefiltrar = $_POST['nomefiltrar'];
	}else{
		$nomefiltrar = '';
	}

	if(!empty($_POST['dataemissaoiniciofiltrar'])){
		$dataemissaoinicio = $_POST['dataemissaoiniciofiltrar'];

	}else{
		$dataemissaoinicio = '01/01/2000';
	}

	if(!empty($_POST['dataemissaofinalfiltrar'])){
		$dataemissaofinal = $_POST['dataemissaofinalfiltrar'];
	}else{
		$dataemissaofinal = '01/01/2020';
	}

	$sql = " SELECT c.*, p.nome, e.nome_especie FROM contas_receber c INNER JOIN pessoa p ON (c.id_cliente = p.id) INNER JOIN especies e ON (c.id_especie = e.id) WHERE STR_TO_DATE(c.dataemissao, '%d/%m/%Y') BETWEEN STR_TO_DATE('$dataemissaoinicio', '%d/%m/%Y') AND STR_TO_DATE('$dataemissaofinal', '%d/%m/%Y') AND c.observacao LIKE '%$nomefiltrar%' ";
	$resultado = $banco->query($sql);
	$banco->close();
	while($row = mysqli_fetch_array($resultado)){
		$contas[] = $row;
	}
	return $contas;
}

function selectIdConta($id){
	$banco = abrirBanco();
	$sql = " SELECT c.*,STR_TO_DATE(c.dataemissao, '%d/%m/%Y') as dataemissaoformatada , p.nome, e.nome_especie FROM contas_receber c INNER JOIN pessoa p ON(c.id_cliente = p.id) INNER JOIN especies e ON(c.id_especie = e.id) WHERE c.id = ".$id;
	$resultado = $banco->query($sql);
	$banco->close();
	$conta = mysqli_fetch_assoc($resultado);
	return $conta;
}

function excluirConta(){
	$id = $_POST['id'];
	$banco = abrirBanco();
	$sql = " DELETE FROM contas_receber WHERE id = '$id'";
	$banco->query($sql);
	$banco->close();

	header('Location: consulta_contas_receber.php');
}
