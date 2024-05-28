<?php

session_start();

// obtem os dados
$titulo = $_POST["titulo"]; 
$descricao = $_POST["descricao"]; 
$video = $_POST["url"]; 

// consulta no banco
$conn= new mysqli("localhost", "root", "", "_phd");
if($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
// Envia comando sql
$sql= "INSERT INTO atividade(usuario, titulo,video, descricao, aberta_respostas) 
VALUES (". $_SESSION["cpf"] ." ,'" . $titulo. "','" . $video. "','" . $descricao. "',1)";

echo $sql;

if($conn->query($sql) === TRUE) {
	$_SESSION["msg"] = "Atividade registrada com sucesso!";
}else{
	$_SESSION["msg"] = "Erro durante o cadastro da atividade.";
}

$conn->close();

header('Location: menu-professor-cadastrar-midia.php');


?>