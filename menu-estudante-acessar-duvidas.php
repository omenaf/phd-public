<?php
session_start();

include 'classes.php';

// consulta no banco
$conn= new mysqli("localhost", "root", "", "_phd");
if($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// Envia comando sql
$sql= "select duvida.id, duvida.id_atividade, duvida.usuario_aluno, duvida.tempo, duvida.titulo, duvida.descricao, duvida.resposta, atividade.titulo as titulo_atividade from duvida inner join atividade on duvida.id_atividade=atividade.id where duvida.usuario_aluno = " . $_SESSION["cpf"] . " order by id"; 
echo $sql;

$result= $conn->query($sql);

$listaDuvidas = array();

if($result->num_rows> 0) {
	while($row= $result->fetch_assoc()) {
		$idAtividadeAtual = $row["id_atividade"];
		
		// para cada id, cria um objeto duvida
		$duvida = new Duvida();
		$duvida->idAtividade = $idAtividadeAtual;
		$duvida->tituloAtividade = $row["titulo_atividade"];
		$duvida->lista = array();
		
		// verifica se ja tem duvida (id_ativ) na lista 
		$achou = false;
		foreach($listaDuvidas as $duvidasCadastradas){
			if($duvidasCadastradas->idAtividade == $idAtividadeAtual){
				$duvida = $duvidasCadastradas;
				$achou = true;
				break;
			}
		}
		
		// cada objeto duvida pode ter lista de itens de duvida
		$itemDuvida = new ItemDuvida();
		$itemDuvida->id = $row["id"];
		$itemDuvida->tempo = $row["tempo"];
		$itemDuvida->titulo = $row["titulo"];
		$itemDuvida->descricao = $row["descricao"];
		$itemDuvida->resposta = $row["resposta"];
		if(empty($itemDuvida->resposta)){
			$itemDuvida->resposta = "[A dúvida ainda não foi respondida]";
		}
		// adiciona o item criado acima, no objeto Duvida
		array_push($duvida->lista, $itemDuvida);
		
		// adiciona o objeto Duvida na lista de duvidas
		if(!$achou){
			array_push($listaDuvidas, $duvida);
		}
	}
}

$_SESSION["atividades"]=$listaDuvidas; 

$conn->close();

// apresenta no console
//print_r($listaDuvidas);


//echo $listaDuvidas[0]->idAtividade;

// encaminha pra tela
header('Location: menu-estudante-acessar-duvidas-tela.php');
?>