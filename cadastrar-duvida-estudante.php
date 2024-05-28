<?php

session_start();

// obtem os dados
$idUsuario = $_SESSION["cpf"]; 
$idAtividadeEscolhida = $_POST["select"]; 
$tempos = $_POST["tempo-video-duvida"]; 
$titulos = $_POST["titulo-duvida"]; 
$descricoes = $_POST["descricao-duvida"]; 
		
// conexao com banco
$conn= new mysqli("localhost", "root", "", "_phd");
if($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

for($cont=0; $cont< count($tempos) ; $cont++){
	$tempo = $tempos[$cont];
	$titulo = $titulos[$cont];
	$descricao = $descricoes[$cont];
	
	// verifica se os 3 tem dados
	if($tempo != null && $tempo != "00:00:00" > 10 &&
		$titulo != null && strlen($titulo) > 0 &&
		$descricao != null && strlen($descricao) > 0){
		// Envia comando sql
		$sql= "INSERT INTO duvida(id_atividade, usuario_aluno, tempo, titulo, descricao) VALUES
		(". $idAtividadeEscolhida ." ," . $idUsuario. ",'" . $tempo . "','" . $titulo . "','" . $descricao . "')";

		echo $sql;

		if($conn->query($sql) === TRUE) {
			$_SESSION["msg"] = "Dúvidas registradas com sucesso!";
		}else{
			$_SESSION["msg"] = "Erro durante o registro da dúvida.";
		}
	}
}
$conn->close();

header('Location: menu-estudante-analisar-atividade.php');

?>