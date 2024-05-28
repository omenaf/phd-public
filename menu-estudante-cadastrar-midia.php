<?php

include 'componente-select-atividades.php';

// consulta no banco
$conn= new mysqli("localhost", "root", "", "_phd");
if($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// Envia comando sql para obter atividades a serem planejadas 
$sql= "SELECT planejamento.id_atividade, atividade.titulo, planejamento.usuario, planejamento.campo1_atividade, planejamento.campo2_gravacao, planejamento.campo3_lembrete, planejamento.campo4_outras FROM planejamento inner join atividade On planejamento.id_atividade = atividade.id where planejamento.usuario =" . $_SESSION["cpf"] . " and atividade.aberta_respostas=1;"; 
echo $sql;

$result= $conn->query($sql);

$atividadesPlanejadadas = array();
if($result->num_rows> 0) {
	while($row= $result->fetch_assoc()) {
		$atividade = new ObservacoesAtividade();
		$atividade->idAtividade = $row["id_atividade"];
		$atividade->campo1Atividade = $row["campo1_atividade"];
		$atividade->campo2Gravacao = $row["campo2_gravacao"];
		$atividade->campo3Lembrete = $row["campo3_lembrete"];
		$atividade->campo4Outros = $row["campo4_outras"];
		$atividade->titulo = $row["titulo"];
		$atividade->usuario = $row["usuario"];
		array_push($atividadesPlanejadadas, $atividade);
		echo "<br>" . $atividade->idAtividade . "|" . $atividade->titulo . "|" . $atividade->usuario . "|" .  $atividade->campo1Atividade . "|" . $atividade->campo2Gravacao . "|" . $atividade->campo3Lembrete . "|" . $atividade->campo4Outros ;
	}
}

// Envia comando sql que obtem os que ja foram respondidas
$sql= "SELECT * FROM resposta_atividade where usuario_aluno = " . $_SESSION["cpf"];
echo $sql;

$result= $conn->query($sql);

$atividadesRespondidas = array();
if($result->num_rows> 0) {
	while($row= $result->fetch_assoc()) {
		array_push($atividadesRespondidas, $row["id_atividade"]);
	}
}

// remove do array o que ja foi planejado
$pos = 0;
foreach ($atividadesPlanejadadas as $planejada) {
	foreach ($atividadesRespondidas as $respondida) {
		if($planejada->idAtividade == $respondida && $planejada->usuario == $_SESSION["cpf"]){
			unset($atividadesPlanejadadas[$pos]);
		}
	}
	$pos++;
}

// coloca na sessao
$_SESSION["atividadesPlanejadadas"]=$atividadesPlanejadadas; 

$conn->close();

header('Location: menu-estudante-cadastrar-midia-tela.php');
?>