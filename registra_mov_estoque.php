<?php

session_start();


require_once('db.class.php');
require_once('functions.php');


if(!$_SESSION['usuario']){
	header('Location: index.php?erro=1');
}

if(isset($_POST['acao'])){
	if($_POST['acao'] == "inserir"){
		if($_POST['select_tipoMov'] == '1'){
			entraMov();
		}else{
			saiMov();
		}
	}
	if($_POST['acao'] == "alterar"){
		alterarMov();
	}
	if($_POST['acao'] == "excluir"){
		excluirMov();
	}
	if($_POST['acao'] == "filtrar"){
		filtraMov();
	}
}

function abrirBanco(){
	$conexao = new mysqli("localhost", "root", "", "despesas");
	return $conexao;
}

function entraMov(){
	 $dataemissao = $_POST['dataLancamento'];
	 $select_tipo_mov = $_POST['select_tipoMov'];
	 $select_forn = $_POST['select_clientes'];
	 $observacao = $_POST['descricao'];
	 $select_produtos = $_POST['select_produtos'];
	 $quantidade = $_POST['quantidade'];

	 $emissaoinvertida = inverteData($dataemissao);

	$dados = count($select_produtos);
	$banco = abrirBanco();

	$sql2 = "INSERT INTO mov_estoque (id_mov, id_forn, observacao, quantidade, tipo_mov, dataemissao) VALUES(NULL, '$select_forn', '$observacao', '$quantidade', '$select_tipo_mov', '$emissaoinvertida')
	";
	$banco->query($sql2);

	for($i=0; $i<$dados;$i++){
		$produtos = $select_produtos[$i];

	$sql = "CALL mov_estoque_e('$quantidade', '$produtos')";
	$sql3 = "INSERT INTO controla_estoque VALUES (2, '$produtos')";

	$banco->query($sql);

	$banco->query($sql3);
}
	$banco->close();

	$cont = $cont + 1;


	header('Location: home.php');
}

function saiMov(){
	$dataemissao = $_POST['dataLancamento'];
	 $select_tipo_mov = $_POST['select_tipoMov'];
	 $select_forn = $_POST['select_clientes'];
	 $observacao = $_POST['descricao'];
	 $select_produtos = $_POST['select_produtos'];
	 $quantidade = $_POST['quantidade'];

	 $emissaoinvertida = inverteData($dataemissao);

	 $banco = abrirBanco();

	 $dados = count($select_produtos);

	 for($i=0; $i<$dados;$i++){
		$produtos = $select_produtos[$i];
	 $sql = "CALL mov_estoque_s('$quantidade', '$produtos')";
	 $sql2 = "CALL mov_estoque_insere('$quantidade', '$produtos', '$emissaoinvertida', '$select_tipo_mov', '$select_forn', '$observacao')";
	 $banco->query($sql);
	 $banco->query($sql2);
	}
	 $banco->close();
	 header('Location: home.php');
}

function filtraMov(){
	$movs = '';
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

	

	$sql = " SELECT m.*, p.nome, FROM contas c INNER JOIN pessoa p ON (c.id_fornecedor = p.id) INNER JOIN especies e ON (c.id_especie = e.id) WHERE STR_TO_DATE(c.dataemissao, '%d/%m/%Y') BETWEEN STR_TO_DATE('$dataemissaoinicio', '%d/%m/%Y') AND STR_TO_DATE('$dataemissaofinal', '%d/%m/%Y') AND c.observacao LIKE '%$nomefiltrar%' ";
	$resultado = $banco->query($sql);
	$banco->close();
	while($row = mysqli_fetch_array($resultado)){
		$contas[] = $row;
	}
	return $contas;
}

