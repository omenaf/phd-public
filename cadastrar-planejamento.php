<?php

session_start();

// obtem os dados
$idAtividadeEscolhida = $_POST["select"]; 
$observacaoAtividade = $_POST["campo1"]; 
$observacaoGravacao = $_POST["campo2"]; 
$observacaoLembrete = $_POST["campo3"]; 
$observacaoOutras = $_POST["campo4"]; 

// consulta no banco
$conn= new mysqli("localhost", "root", "", "_phd");
if($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
// Envia comando sql
$sql= "INSERT INTO planejamento(usuario,campo1_atividade, campo2_gravacao,campo3_lembrete, campo4_outras, id_atividade) 
VALUES (". $_SESSION["cpf"] ." ,'" . $observacaoAtividade. "','" . $observacaoGravacao . "','" . $observacaoLembrete . "','" . $observacaoOutras . "'," . $idAtividadeEscolhida . ")";

echo $sql;

if($conn->query($sql) === TRUE) {
	$_SESSION["msg"] = "Planejamento registrado com sucesso!";
}else{
	$_SESSION["msg"] = "Erro durante o registro do planejamento.";
}

$conn->close();

header('Location: menu-estudante-registrar-planejamento.php');


?>