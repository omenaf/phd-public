<?php
session_start();

include 'classes.php';

// consulta no banco
$conn= new mysqli("localhost", "root", "", "_phd");
if($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$listaAutoavaliacao = array();

// pega todas as atividades, independentes se ja foram avaliadas
$sql= "select atividade.video as videoAtividade, atividade.titulo, planejamento.campo1_atividade, planejamento.campo2_gravacao, planejamento.campo3_lembrete, planejamento.campo4_outras, resposta_atividade.video as videoEnviado, resposta_atividade.id_atividade from resposta_atividade inner join atividade on resposta_atividade .id_atividade = atividade.id inner join planejamento on planejamento.id_atividade = resposta_atividade.id_atividade and resposta_atividade.usuario_aluno = planejamento.usuario where resposta_atividade.usuario_aluno = " . $_SESSION["cpf"] . " order by resposta_atividade.id_atividade"; 
echo $sql;

$result= $conn->query($sql);

if($result->num_rows> 0) {
	while($row= $result->fetch_assoc()) {
		$avaliacao = new Autoavaliacao();
		$avaliacao->idAtividade = $row["id_atividade"];
		$avaliacao->titulo = $row["titulo"];
		$avaliacao->campo1Atividade = $row["campo1_atividade"];
		$avaliacao->campo2Gravacao = $row["campo2_gravacao"];
		$avaliacao->campo3Lembrete = $row["campo3_lembrete"];
		$avaliacao->campo4Outros = $row["campo4_outras"];
		$avaliacao->videoAtividade = $row["videoAtividade"];
		$avaliacao->videoEnviado = $row["videoEnviado"];
		
		array_push($listaAutoavaliacao, $avaliacao);
	}
}

print_r($listaAutoavaliacao);

$sql= "SELECT * from autoavaliacao where autoavaliacao.usuario_aluno = " . $_SESSION["cpf"] . " order by autoavaliacao.id_atividade"; 
echo $sql;

$result= $conn->query($sql);

if($result->num_rows> 0) {
	while($row= $result->fetch_assoc()) {
		foreach ($listaAutoavaliacao as $avaliacao) {
			//echo "<br>" . $avaliacao->idAtividade . " compare " . $row["id_atividade"];
			if($avaliacao->idAtividade == $row["id_atividade"]){
				$resposta = new Resposta();
				$resposta->perg1 = $row["perg1"];
				$resposta->perg2 = $row["perg2"];
				$resposta->perg3 = $row["perg3"];
				$resposta->perg4 = $row["perg4"];
				$resposta->perg5 = $row["perg5"];
				$resposta->perg6 = $row["perg6"];
				$resposta->perg7 = $row["perg7"];
				$resposta->perg8 = $row["perg8"];
				$resposta->perg9 = $row["perg9"];
				$resposta->perg10 = $row["perg10"];
				$resposta->perg11 = $row["perg11"];
				$resposta->perg12 = $row["perg12"];
				$resposta->perg13 = $row["perg13"];
				$resposta->perg14 = $row["perg14"];
				$resposta->perg15 = $row["perg15"];
				$resposta->perg16 = $row["perg16"];
				$resposta->perg17 = $row["perg17"];
				$resposta->aberta1 = $row["aberta1"];
				$resposta->aberta2 = $row["aberta2"];
				$resposta->aberta3 = $row["aberta3"];
				$resposta->aberta4 = $row["aberta4"];
				
				$avaliacao->resposta = $resposta;
		
				break;
			}
		}
	}
}

$_SESSION["atividades"]=$listaAutoavaliacao; 

$conn->close();

// apresenta no console
//print_r($listaAutoavaliacao);
 
// encaminha pra tela
header('Location: menu-estudante-autoavaliacao-tela.php');
?>