<?php

session_start();

// obtem os dados
$video = $_POST["url"]; 
$id_atividade = $_POST["select"]; 

// consulta no banco
$conn= new mysqli("localhost", "root", "", "_phd");
if($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
// Envia comando sql
$sql= "INSERT INTO resposta_atividade (id_atividade, usuario_aluno, video)
VALUES (". $id_atividade ." ," . $_SESSION["cpf"] . ",'" . $video. "')";

echo $sql;

if($conn->query($sql) === TRUE) {
	$_SESSION["msg"] = "Mídia registrada com sucesso!";
}else{
	$_SESSION["msg"] = "Erro durante o cadastro da mídia.";
}

$conn->close();

header('Location: menu-estudante-cadastrar-midia.php');

?>