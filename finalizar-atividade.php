<?php 
session_start();

$id = $_POST["select"]; 

// consulta no banco
$conn= new mysqli("localhost", "root", "", "_phd");
if($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// Encerra a atividade selecionada
$sql= "update atividade set aberta_respostas = 0 where id = " . $id; 

$result= $conn->query($sql);

if($conn->query($sql) === TRUE) {
	$_SESSION["msg"] = "Atividade finalizada com sucesso!";
}else{
	$_SESSION["msg"] = "Erro durante o encerramento da atividade.";
}

// consulta novamente as atividades disponiveis
$sql= "select id,titulo from atividade where aberta_respostas = 1 and usuario = " . $_SESSION['cpf']; 
$result= $conn->query($sql);

$atividades = array();
if($result->num_rows> 0) {
	while($row= $result->fetch_assoc()) {
		array_push($atividades, $row["id"].";".$row["titulo"]);
		echo $row["titulo"];
	}
}
$_SESSION["atividades"]=$atividades; 

header('Location: menu-professor-finalizar-tela.php');
$conn->close();


?>