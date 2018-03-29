<?php

session_start();



require_once('functions.php');

if(!$_SESSION['usuario']){
	header('Location: index.php?erro=1');
}

if(isset($_POST['acao'])){
	if($_POST['acao'] == "inserir"){
	inserirConta();
	}
	if($_POST['acao'] == "alterar"){
		alterarConta();
	}
	if($_POST['acao'] == "excluir"){
		excluirConta();
	}
	if($_POST['acao'] == "filtrar"){
		filtraContas();
	}

}

function abrirBanco(){
	$conexao = new mysqli("localhost", "root", "", "despesas");
	return $conexao;
}

function inserirConta(){
	 $dataemissao = $_POST['dataemissao'];
	 $select_fornecedores = $_POST['select_fornecedores'];
	 $select_especies = $_POST['select_especies'];
	 $valor = $_POST['valor'];
	 $datavencimento = $_POST['datavencimento'];
	 $observacao = $_POST['observacao'];

	 $emissaoinvertida = inverteData($dataemissao);
	 $vencimentoinvertida = inverteData($datavencimento);


	$banco = abrirBanco();
	$sql = "INSERT INTO contas(dataemissao,valor,datavencimento, id_fornecedor, id_especie, observacao) VALUES ('$emissaoinvertida', '$valor', '$vencimentoinvertida', '$select_fornecedores', '$select_especies', '$observacao')";

	$banco->query($sql);
	$banco->close();

	header('Location: home.php');
}

function alterarConta(){
	 $dataemissao = $_POST['dataemissao'];
	 $select_especies = $_POST['select_especies'];
	 $select_fornecedores = $_POST['select_fornecedores'];
	 $id_conta_selecionada = $_POST['id'];
	 $valor = $_POST["valor"];
	 $datavencimento = $_POST['datavencimento'];
	 $especie = $_POST['especie'];
	 $observacao = $_POST['observacao'];
	 $row_forn = $_POST['row_fornecedores'];

	 $emissaoinvertida = inverteData($dataemissao);
	 $vencimentoinvertida = inverteData($datavencimento);


	 $banco = abrirBanco();
	 $sql = " UPDATE contas SET dataemissao = '$emissaoinvertida', datavencimento = '$vencimentoinvertida', valor = '$valor', observacao = '$observacao', id_fornecedor = '$select_fornecedores', id_especie = '$select_especies' WHERE id= '$id_conta_selecionada' ";
	$banco->query($sql);
	$banco->close();

	header('Location: consulta_contas.php');
}

function filtraContas(){
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

	

	$sql = " SELECT c.*, p.nome, e.nome_especie FROM contas c INNER JOIN pessoa p ON (c.id_fornecedor = p.id) INNER JOIN especies e ON (c.id_especie = e.id) WHERE STR_TO_DATE(c.dataemissao, '%d/%m/%Y') BETWEEN STR_TO_DATE('$dataemissaoinicio', '%d/%m/%Y') AND STR_TO_DATE('$dataemissaofinal', '%d/%m/%Y') AND c.observacao LIKE '%$nomefiltrar%' ";
	$resultado = $banco->query($sql);
	$banco->close();
	while($row = mysqli_fetch_array($resultado)){
		$contas[] = $row;
	}
	return $contas;
}

function selectIdConta($id){
	$banco = abrirBanco();
	$sql = " SELECT c.*, STR_TO_DATE(c.dataemissao, '%d/%m/%Y') as dataemissaoformatada , STR_TO_DATE(c.datavencimento, '%d/%m/%Y') as datavencimentoformatada, p.nome, e.nome_especie FROM contas c INNER JOIN pessoa p ON(c.id_fornecedor = p.id) INNER JOIN especies e ON(c.id_especie = e.id) WHERE c.id = ".$id;
	$resultado = $banco->query($sql);
	$banco->close();
	$conta = mysqli_fetch_assoc($resultado);
	return $conta;
}

function excluirConta(){
	$id = $_POST['id'];
	$banco = abrirBanco();
	$sql = " DELETE FROM contas WHERE id = '$id'";
	$banco->query($sql);
	$banco->close();

	header('Location: consulta_contas.php');
}
