<?php

session_start();

// obtem os dados
$idUsuario = $_SESSION["cpf"]; 
$respostas = $_POST["resposta-duvida"]; 
$idRespostas = $_POST["idItemDuvida"]; 
		
// conexao com banco
$conn= new mysqli("localhost", "root", "", "_phd");
if($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

for($cont=0; $cont< count($respostas) ; $cont++){
	$resposta = $respostas[$cont];
	$idResposta = $idRespostas[$cont];
	
	// verifica tem dados
	if($resposta != null && strlen($resposta) > 0){
		// Envia comando sql
		$sql= "UPDATE duvida SET resposta = '" . $resposta . "' WHERE id = ". $idResposta;
		
		echo $sql;

		if($conn->query($sql) === TRUE) {
			$_SESSION["msg"] = "Respostas registradas com sucesso!";
		}else{
			$_SESSION["msg"] = "Erro durante o registro das respostas.";
		}
	}
}
$conn->close();

header('Location: menu-professor-duvidas.php');

?>