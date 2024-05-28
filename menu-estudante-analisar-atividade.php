<?php 

session_start();

// carrega as opcoes de atividade para o select
include 'componente-select-atividades.php';

// carrega as opcoes de atividade que ainda serao planejadas
include 'componente-consulta-planejamento.php';

// Envia comando sql que obtem as duvidas que ja foram enviadas
$sql= "SELECT DISTINCT id_atividade FROM duvida where usuario_aluno = " . $_SESSION["cpf"];
echo $sql;

$result= $conn->query($sql);

$duvidasRegistradas = array();
if($result->num_rows> 0) {
	while($row= $result->fetch_assoc()) {
		array_push($duvidasRegistradas, $row["id_atividade"]);
	}
}

// mostrar no console
echo "<br>duvidas ja registradas<br>";
foreach ($duvidasRegistradas as $x) {
	echo "<br>".$x;
}

// mostrar no console
echo "<br>duvidas antes de retirar submetidas<br>";
foreach ($_SESSION["atividades"] as $x) {
	echo "<br>x- ".$x->id;
}

// remove do array as atividades que ja tem duvidas registradas
$pos = 0;
foreach ($_SESSION["atividades"] as $planejada) {
	foreach ($duvidasRegistradas as $respondida) {
		if($planejada->id == $respondida){
			unset($_SESSION["atividades"][$pos]);
		}
	}
	$pos++;
}

// mostrar no console
echo "<br>duvidas pos retirar submetidas<br>";
foreach ($_SESSION["atividades"] as $x) {
	echo "<br>x- ".$x->id;
}

header('Location: menu-estudante-analisar-atividade-tela.php');

?>