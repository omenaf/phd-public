<?php

// remove das opcoes do select, as atividades ja planejadas do usuario
$atividadesNaoRealizadas = array();
$listaAtividadesBanco = $_SESSION["atividades"];

if(count($listaAtividadesBanco)>=1){
	// cria conexao com banco
	$conn= new mysqli("localhost", "root", "", "_phd");
	if($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
		
	// itera na relacao de atividades e verifica cada se ja foi respondida
	foreach ($listaAtividadesBanco as $objAtividade) {
		// Envia comando sql
		$sql= "SELECT * FROM planejamento where " .
		"id_atividade = '" . $objAtividade->id . "' and " .
		"usuario = " . $_SESSION["cpf"];
		echo $sql;

		$result= $conn->query($sql);

		// caso nao tenha resposta, add o objeto na lista do select
		if($result->num_rows == 0) {
			array_push($atividadesNaoRealizadas, $objAtividade);
		}
	}
	$_SESSION["atividades"]=$atividadesNaoRealizadas; 
}

// mostrar no console
echo "<br><br>".count($atividadesNaoRealizadas);

foreach ($atividadesNaoRealizadas as $objAtividade) {
	echo $objAtividade->id;
}

echo "<br>". count($listaAtividadesBanco);

foreach ($listaAtividadesBanco as $objAtividade) {
	echo $objAtividade->id;
}

?>