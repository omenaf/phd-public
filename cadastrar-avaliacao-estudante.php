<?php

session_start();

// obtem os dados
$idUsuario = $_SESSION["cpf"]; 
$idAtividade = $_POST["oculto"]; 
$aberta1 = $_POST["aberta1"]; 
$aberta2 = $_POST["aberta2"]; 
$aberta3 = $_POST["aberta3"]; 
$aberta4 = $_POST["aberta4"]; 
$perg1 = $_POST["perg1"] == "" ? 0 : 1; 
$perg2 = $_POST["perg2"] == "" ? 0 : 1;  
$perg3 = $_POST["perg3"] == "" ? 0 : 1;  
$perg4 = $_POST["perg4"] == "" ? 0 : 1;  
$perg5 = $_POST["perg5"] == "" ? 0 : 1;  
$perg6 = $_POST["perg6"] == "" ? 0 : 1;  
$perg7 = $_POST["perg7"] == "" ? 0 : 1;  
$perg8 = $_POST["perg8"] == "" ? 0 : 1; 
$perg9 = $_POST["perg9"] == "" ? 0 : 1;  
$perg10 = $_POST["perg10"] == "" ? 0 : 1; 
$perg11 = $_POST["perg11"] == "" ? 0 : 1;  
$perg12 = $_POST["perg12"] == "" ? 0 : 1;  
$perg13 = $_POST["perg13"] == "" ? 0 : 1;  
$perg14 = $_POST["perg14"] == "" ? 0 : 1;  
$perg15 = $_POST["perg15"] == "" ? 0 : 1;  
$perg16 = $_POST["perg16"] == "" ? 0 : 1;  
$perg17 = $_POST["perg17"] == "" ? 0 : 1;  
		
// conexao com banco
$conn= new mysqli("localhost", "root", "", "_phd");
if($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// Envia comando sql
$sql= "INSERT INTO autoavaliacao(aberta1, aberta2, aberta3, aberta4, perg1, perg2, perg3, perg4, perg5, perg6, perg7, perg8, perg9, perg10, perg11, perg12, perg13, perg14, perg15, perg16, perg17, usuario_aluno, id_atividade) VALUES ('$aberta1','$aberta2','$aberta3','$aberta4',$perg1,$perg2,$perg3,$perg4,$perg5,$perg6,$perg7,$perg8,$perg9,$perg10,$perg11,$perg12,$perg13,$perg14,$perg15,$perg16,$perg17,$idUsuario,$idAtividade)";

echo $sql;

if($conn->query($sql) === TRUE) {
	$_SESSION["msg"] = "Avaliação registrada com sucesso!";
}else{
	$_SESSION["msg"] = "Erro durante o registro da avaliação.";
}
$conn->close();

header('Location: menu-estudante-autoavaliacao.php');

?>