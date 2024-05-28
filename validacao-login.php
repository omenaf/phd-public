<?php

session_start();

// obtem os dados
$email = $_POST["email"]; 
$senha = $_POST["senha"]; 
$tipo = $_POST["tipo"]; 
$nome = "";

if(isset($_SESSION['nome'])){
	$_SESSION['msg'] = "Já há um usuário logado em outra aba do navegador!";
	header('Location: index.php');
}else{

	// consulta no banco
	$conn= new mysqli("localhost", "root", "", "_phd");
	if($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	// Envia comando sql
	$sql= "SELECT nome, cpf, senha, tipo FROM usuario where email = '" . $email . "' and senha = " . $senha . " and tipo = " . $tipo; 
	echo $sql;

	$result= $conn->query($sql);

	if($result->num_rows> 0) {
		while($row= $result->fetch_assoc()) {
			// coloca na seção
			$_SESSION["nome"]=$row["nome"]; 
			$_SESSION["email"]=$row["email"]; 
			$_SESSION["senha"]=$row["senha"]; 
			$_SESSION["tipo"]=$row["tipo"]; 
			$_SESSION["cpf"]=$row["cpf"]; 
		}
		if($tipo == 1) {
			header('Location: menu-professor-cadastrar-midia.php');
		}else{
			header('Location: menu-estudante-analisar-atividade.php');
		}
	}else{
		$_SESSION["error"]= true; 
		header('Location: index.php');
	}
	$conn->close();
}

?>