<?php
session_start();

include 'classes.php';

// consulta no banco
$conn= new mysqli("localhost", "root", "", "_phd");
if($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// Envia comando sql
$sql= "select * from atividade where aberta_respostas = 1"; 
echo $sql;

$result= $conn->query($sql);

$atividades = array();
if($result->num_rows> 0) {
	while($row= $result->fetch_assoc()) {
		$atividade = new Atividade();
		$atividade->id = $row["id"];
		$atividade->descricao = $row["descricao"];
		$atividade->video = $row["video"];
		$atividade->titulo = $row["titulo"];
		$atividade->usuario = $row["usuario"];
		array_push($atividades, $atividade);
	}
}
$_SESSION["atividades"]=$atividades; 

$conn->close();
?>