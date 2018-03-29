<?php

session_start();


require_once('db.class.php');

if(!$_SESSION['usuario']){
	header('Location: index.php?erro=1');
}

if(isset($_POST['acao'])){
	if($_POST['acao'] == "inserir"){
	inserirProdutos();
	}
	if($_POST['acao'] == "alterar"){
		alterarProdutos();
	}
	if($_POST['acao'] == "excluir"){
		excluirProdutos();
	}
	if($_POST['acao'] == "filtrar"){
		filtraProdutos();
	}
}

function abrirBanco(){
	$conexao = new mysqli("localhost", "root", "", "despesas");
	return $conexao;
}

function inserirProdutos(){
	$nomeproduto = $_POST['descricao'];
	$custoproduto = $_POST['custo'];
	$precovenda = $_POST['precovenda'];
	$banco = abrirBanco();
	$sql = " INSERT INTO produtos(descricao, custo, preco_venda, fg_ativo) VALUES ('$nomeproduto', '$custoproduto', '$precovenda', '1') ";
	$banco->query($sql);
	$banco->close();

	header('Location: home.php');
}

function alterarProdutos(){
	$idproduto = $_POST['id'];
	$nomeproduto = $_POST['descricao'];
	$custoproduto = $_POST['custo'];
	$precovenda = $_POST['precovenda'];
	$fg_ativo = $_POST['fg_ativo'];
	$banco = abrirBanco();
	$sql = " UPDATE produtos set descricao = '$nomeproduto', custo = '$custoproduto', preco_venda = '$precovenda', fg_ativo = '$fg_ativo' WHERE id = '$idproduto'";
	$banco->query($sql);
	$banco->close();

	header('Location: consulta_produtos.php');
}

function filtraProdutos(){
	$produtos = '';
	$banco = abrirBanco();
	if(isset($_POST['nomefiltrar'])){
		$nomefiltrar = $_POST['nomefiltrar'];
	}else{
		$nomefiltrar = '';
	}
	$sql = " SELECT * FROM produtos WHERE descricao LIKE '%$nomefiltrar%' ";
	$resultado = $banco->query($sql);
	$banco->close();
	while($row = mysqli_fetch_array($resultado)){
		$produtos[] = $row;
	}
	return $produtos;
}

function selectIdProdutos($id){
	$banco = abrirBanco();
	$sql = " SELECT * FROM produtos WHERE id = ".$id;
	$resultado = $banco->query($sql);
	$banco->close();
	$produto = mysqli_fetch_assoc($resultado);
	return $produto;
}

function excluirProdutos(){
	$idproduto = $_POST['id'];
	$banco = abrirBanco();
	$sql = " DELETE FROM produtos WHERE id = '$idproduto'";
	$banco->query($sql);
	$banco->close();

	header('Location: consulta_produtos.php');
}

