<?php

session_start();


require_once('db.class.php');

if(!$_SESSION['usuario']){
	header('Location: index.php?erro=1');
}

if(isset($_POST['acao'])){
	if($_POST['acao'] == "inserir"){
	inserirPessoa();
	}
	if($_POST['acao'] == "alterar"){
		alterarPessoas();
	}
	if($_POST['acao'] == "excluir"){
		excluirPessoas();
	}
	if($_POST['acao'] == "filtrar"){
		filtraPessoas();
	}

}


function abrirBanco(){
	$conexao = new mysqli("localhost", "root", "", "despesas");
	return $conexao;
}

function valortotal(){
	$grupo = selectContas();
    foreach($grupo as $contas){
        $valortotal += $contas["valor"];
    }
}


function inserirPessoa(){

	 $nome = $_POST['nome'];
	 $datanascimento = $_POST['nascimento'];
	 $endereco = $_POST['endereco'];
	 $telefone = $_POST["telefone"];
	 $id = $_POST['id'];


	$banco = abrirBanco();
	$sql = "INSERT INTO pessoa(nome,nascimento,endereco,telefone) VALUES ('$nome', '$datanascimento', '$endereco', '$telefone')";

	$banco->query($sql);
	$banco->close();

	header('Location: home.php');

}



function filtraPessoas(){
	$grupo = '';
	$banco = abrirBanco();
	if(isset($_POST['nomefiltrar'])){
		$teste = $_POST['nomefiltrar'];
	}else{
		$teste = '';
	}

	$sql = "SELECT id, nome, DATE_FORMAT(nascimento, '%d/%m/%Y') AS data_formatada, endereco, telefone FROM pessoa WHERE nome LIKE '%$teste%' ";
	$resultado = $banco->query($sql);
	$banco->close();
	while($row = mysqli_fetch_array($resultado)){
		$grupo[] = $row;
	}
	return $grupo;
}

function selectIdPessoas($id){
	$banco = abrirBanco();
	$sql = "SELECT * FROM pessoa WHERE id = ".$id;
	$resultado = $banco->query($sql);
	$banco->close();
	$pessoa = mysqli_fetch_assoc($resultado);
	return $pessoa;
}

function alterarPessoas(){

	 $nome = $_POST['nome'];
	 $id = $_POST['id'];
	 $datanascimento = $_POST['nascimento'];
	 $endereco = $_POST['endereco'];
	 $telefone = $_POST['telefone'];
	 $id = $_POST['id'];
	$banco = abrirBanco();
	$sql = "UPDATE pessoa set nome = '$nome', nascimento = '$datanascimento', endereco = '$endereco', telefone = '$telefone' WHERE id= '$id' ";
	$banco->query($sql);
	$banco->close();

	header('Location: consulta_clientes.php');


}

function excluirPessoas(){
	 $nome = $_POST['nome'];
	 $id = $_POST['id'];
	 $datanascimento = $_POST['nascimento'];
	 $endereco = $_POST['endereco'];
	 $telefone = $_POST['telefone'];
	 $id = $_POST['id'];
	$banco = abrirBanco();
	$sql = "DELETE FROM pessoa WHERE id= '$id' ";
	$banco->query($sql);
	$banco->close();

	header('Location: consulta_clientes.php');
}


?>

