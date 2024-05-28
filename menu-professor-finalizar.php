<?php 
session_start();

// consulta no banco
$conn= new mysqli("localhost", "root", "", "_phd");
if($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// Envia comando sql
$sql= "select id,titulo from atividade where aberta_respostas = 1 and usuario = " . $_SESSION['cpf']; 
echo $sql;

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