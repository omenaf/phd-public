<?php include 'classes.php'; session_start(); ?>
<?php if(!isset($_SESSION['nome'])){echo "<script> alert('Usuário não encontrado, faça o login novamente.'); document.location.href='index.php'; </script>";} ?>
<?php if(isset($_SESSION['msg'])){echo "<script> alert('" . $_SESSION['msg'] . "'); </script>"; unset($_SESSION['msg']);} ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Acessar Dúvidas</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="formatacao.css">  
  <script src="classes.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
	  <li><a href="menu-estudante-analisar-atividade.php">Análise de Mídias</a></li>
      <li class="active"><a href="menu-estudante-acessar-duvidas.php">Respostas de Dúvidas</a></li>
      <li><a href="menu-estudante-registrar-planejamento.php">Planejamento de Atividade</a></li>
	  <li><a href="menu-estudante-cadastrar-midia.php">Enviar Mídias</a></li>
      <li><a href="menu-estudante-autoavaliacao.php">Autoavaliação</a></li>
      <li><a href="menu-estudante-ajuda.php">Ajuda</a></li>
	  <li><a href="deslogar.php">Deslogar [<i><?php echo $_SESSION["nome"]; ?></i>]</a></li>
    </ul>
  </div>
</nav>
	<div class="container">
	  <h3>Respostas de Dúvidas</h3>
	  <p>Relação das respostas das dúvidas registradas. </p><br>
	  <script> var listaDuvidas = new Array(); </script>
	  <?php 
	    // add classes JS pra fazer la embaixo
		$duvidas = $_SESSION["atividades"];
		if(count($duvidas)>=1){
			echo "<select class='form-control' id='select' name='select' onchange='apresentarTabela()'>";
			echo "<option value='0'>-- Selecione uma opção --</option>";
			foreach ($duvidas as $duvida) {
				echo "<script> var listaItemDuvidas = new Array(); </script>";
				$id = $duvida->idAtividade;
				$titulo = $duvida->tituloAtividade;
				echo "<option value='$id'>#$id - $titulo</option>";
				foreach ($duvida->lista as $itens) {
					$idItem = $itens->id;
					$tempoItem = $itens->tempo;
					$tituloItem = $itens->titulo;
					$descricaoItem = $itens->descricao;
					$respostaItem = $itens->resposta;
					echo "<script> listaItemDuvidas.push(new ItemDuvida('$idItem', '$tempoItem', '$tituloItem', '$descricaoItem', '$respostaItem')); </script>";
				}
				echo "<script> listaDuvidas.push(new Duvida ('$id','$titulo',listaItemDuvidas)); </script>";
			}
			echo "</select>";
		}else{
			echo "<p>Não há dúvidas registradas.</p>";
		}
	  ?>
		<br><br>
		  <div id="divTabela">
		  </div>
		  <br>
     </div>
  <script>
    apresentarTabela();
	function apresentarTabela(){
		// remove tabela anterior, se existir:
		tabAnterior = document.getElementsByTagName("table")[0];
		if(tabAnterior!=null){
			tabAnterior.parentElement.removeChild(tabAnterior);
			tabAnterior.remove();
		}
		// verifica opcao selecionada e cria tabela dinamica
		var numSelect = 0;
		var elementoSelect = document.getElementById("select");
		if(elementoSelect !=null){
			numSelect = document.getElementById("select").value;
		}
		if(numSelect != 0){
			// cria tabela
			var  tbl = document.createElement("table");
			// cria cabecalho
			var  tblHead = document.createElement("thead");
			var  cabecalho = document.createElement("tr");
			cabecalho.innerHTML = '<th width=10%>Tempo do Vídeo</th><th width=20%>Título da Dúvida</th><th width=70%>Descrição </th>' ;
			tblHead.appendChild(cabecalho);
			// cria grupo de linhas com resposta
			var  tblBody = document.createElement("tbody");
			for(let posLista1 = 0; posLista1 < listaDuvidas.length; posLista1++) {
				// obtem duvidas
				var duvida = listaDuvidas.at(posLista1);
				var idAtividade = duvida.idAtividade;
				// verifica se o id da atividade da duvida é a selecionada
				if(idAtividade == numSelect){
					// pega a lista de itens da duvida
					var listaItem = duvida.lista;
					for(let posLista2 = 0; posLista2 < listaItem.length; posLista2++) {
						var item = listaItem.at(posLista2);
						var row = document.createElement("tr");
						row.innerHTML = '<td width=10%><input type="time" step="1" name="tempo-video-duvida[]" class="form-control" readonly value="' + item.tempo + '"></td><td width=20%><input type="text" class="form-control" name="titulo-duvida[]" maxlength="100" value="' + item.titulo + '"readonly></td><td width=70%><textarea class="form-control" rows="1" name="descricao-duvida[]" maxlength="200" readonly>' + item.descricao + '</textarea><td>' ;
						tblBody.appendChild(row);
						var row2 = document.createElement("tr");
						if(item.resposta == "[A dúvida ainda não foi respondida]"){
							row2.innerHTML = '<td colspan=3 style="border:0"><textarea class="form-control" style="background-color:rgb(255,255,224); color:#ff6666; font-style: italic" rows="2" name="descricao-duvida[]" maxlength="300" readonly>' + item.resposta + '</textarea></td>' ;
						}else{
							row2.innerHTML = '<td colspan=3 style="border:0"><textarea class="form-control" style="background-color:rgb(255,255,224); font-style: italic" rows="2" name="descricao-duvida[]" maxlength="300" readonly>Resposta dada pelo professor: ' + item.resposta + '</textarea></td>' ;
						}
						tblBody.appendChild(row2);
					}
				}
			}
			tbl.appendChild(tblHead);
			tbl.appendChild(tblBody);
			tbl.classList.add('table');
			document.getElementById('divTabela').appendChild(tbl);
		}
	}
 </script>
</body>
</html>