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

<script>
function validarCampos(){
  let select = document.getElementById("select").value;
  let listaResposta = document.getElementsByName("resposta-duvida[]");
  
  if (select == 0) {
	alert("Selecione uma atividade válida.");
	return false;
  }
  
  let achou = false;
  for(var a =0; a < listaResposta.length; a++){
	  // verifica se tem ao menos uma linha completa preenchida
	  if(listaResposta[a]==null || listaResposta[a].value.trim().length ==0){
		achou = true;
	  }
  }
  
  if(!achou){
	  alert("Preencha ao menos uma resposta.");
	  return false;
  }
	  
}
</script>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li><a href="menu-professor-cadastrar-midia.php">Cadastro de Mídias</a></li>
      <li class="active"><a href="menu-professor-duvidas.php">Dúvidas dos Estudantes</a></li>
      <li><a href="menu-professor-finalizar.php">Encerrar Recebimento de Mídias</a></li>
      <li><a href="menu-professor-ajuda.php">Ajuda</a></li>
      <li><a href="deslogar.php">Deslogar [<i><?php echo $_SESSION["nome"]; ?></i>]</a></li>
    </ul>
  </div>
</nav>
	<div class="container">
	  <h3>Dúvidas Cadastradas</h3>
	  <p>Selecione um estudante e registre respostas as dúvidas. </p><br>
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
				$nome = $duvida->nome;
				$cpf = $duvida->cpf;
				$email = $duvida->email;
				$keyValue = $cpf.$id;
				echo "<option value= '$keyValue'>$nome - $email | Atividade: ($id) $titulo </option>";
				foreach ($duvida->lista as $itens) {
					$idItem = $itens->id;
					$tempoItem = $itens->tempo;
					$tituloItem = $itens->titulo;
					$descricaoItem = $itens->descricao;
					$respostaItem = $itens->resposta;
					echo "<script> listaItemDuvidas.push(new ItemDuvida('$idItem', '$tempoItem', '$tituloItem', '$descricaoItem', '$respostaItem')); </script>";
				}
				echo "<script> listaDuvidas.push(new Duvida ('$id','$titulo', listaItemDuvidas, '$cpf', '$nome', '$email')); </script>";
			}
			echo "</select>";
		}else{
			echo "<p>Não há dúvidas registradas.</p>";
		}
	  ?>
		<br>
		<form method="post" action="cadastrar-duvida-professor.php" onsubmit="return validarCampos()">
		  <div id="divTabela" >
			  <div class="col-7">
				<button type="submit" id="botao" class="btn btn-primary">Registrar Respostas</button>
			  </div>
		  </div>
		  </form>
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
		document.getElementById("divTabela").style.display = 'none';
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
			cabecalho.innerHTML = '<th width=10% style="border:0">Tempo do Vídeo</th><th width=20% style="border:0">Título da Dúvida</th><th width=70% style="border:0">Descrição </th>' ;
			tblHead.appendChild(cabecalho);
			// cria grupo de linhas com resposta
			var  tblBody = document.createElement("tbody");
			for(let posLista1 = 0; posLista1 < listaDuvidas.length; posLista1++) {
				// obtem duvidas
				var duvida = listaDuvidas.at(posLista1);
				var idAtividade = duvida.idAtividade;
				var cpf = duvida.cpf;
				// verifica se o id da atividade da duvida é a selecionada
				//alert("concat: " + cpf+idAtividade );
				//alert("select: " + numSelect );
				if(cpf+idAtividade == numSelect){
					// pega a lista de itens da duvida
					var listaItem = duvida.lista;
					for(let posLista2 = 0; posLista2 < listaItem.length; posLista2++) {
						var item = listaItem.at(posLista2);
						var row = document.createElement("tr");
						row.innerHTML = '<td width=10% style="border:0"><input type="time" step="1" name="tempo-video-duvida[]" class="form-control" readonly value="' + item.tempo + '"></td><td width=20% style="border:0"><input type="text" class="form-control" name="titulo-duvida[]" maxlength="100" value="' + item.titulo + '"readonly></td><td width=70% style="border:0"><textarea class="form-control" rows="1" name="descricao-duvida[]" maxlength="200" readonly>' + item.descricao + '</textarea><td>' ;
						tblBody.appendChild(row);
						var row2 = document.createElement("tr");
						row2.innerHTML = '<td colspan=3 style="border:0"><textarea class="form-control" style="font-style: italic" rows="2" name="resposta-duvida[]" maxlength="300"></textarea></td>' ;
						tblBody.appendChild(row2);
						var row3 = document.createElement("tr");
						row3.innerHTML = '<td colspan=3 style="border:0"><input name="idItemDuvida[]" type="text" value="'+ item.id +'"></td>' ;
						tblBody.appendChild(row3);
						// deixa o elemento oculto, apenas pra pegar id
						row3.style.display = "none";
					}
				}
			}
			tbl.appendChild(tblHead);
			tbl.appendChild(tblBody);
			tbl.classList.add('table');
			document.getElementById('divTabela').prepend(tbl);
			document.getElementById("divTabela").style.display = '';
		}
	}
 </script>
</body>
</html>