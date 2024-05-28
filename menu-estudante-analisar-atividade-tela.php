<?php include 'classes.php'; session_start(); ?>
<?php if(!isset($_SESSION['nome'])){echo "<script> alert('Usuário não encontrado, faça o login novamente.'); document.location.href='index.php'; </script>";} ?>
<?php if(isset($_SESSION['msg'])){echo "<script> alert('" . $_SESSION['msg'] . "'); </script>"; unset($_SESSION['msg']);} ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Análise de Mídias</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="formatacao.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="classes.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<script>
function validarCampos(){
  let select = document.getElementById("select").value;
  let listaMinuto = document.getElementsByName("tempo-video-duvida[]");
  let listaTitulo = document.getElementsByName("titulo-duvida[]");
  let listaDescricao = document.getElementsByName("descricao-duvida[]");
  
  if (select == 0) {
	alert("Selecione uma atividade válida.");
	return false;
  }
  
  let achou = false;
  for(var a =0; a < listaMinuto.length; a++){
	  // verifica se tem ao menos uma linha completa preenchida
	  if(listaMinuto[a]!=null && listaMinuto[a].value !="00:00:00" && listaTitulo[a]!=null && listaTitulo[a].value.trim().length >0 && listaDescricao[a]!=null && listaDescricao[a].value.trim().length >0){
		achou = true;
	  }
  }
  if(!achou){
	alert("Preencha ao menos uma dúvida contendo tempo, título e descrição");
    return false;
  }
}
</script>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
	  <li class="active"><a href="menu-estudante-analisar-atividade.php">Análise de Mídias</a></li>
      <li><a href="menu-estudante-acessar-duvidas.php">Respostas de Dúvidas</a></li>
      <li><a href="menu-estudante-registrar-planejamento.php">Planejamento de Atividade</a></li>
	  <li><a href="menu-estudante-cadastrar-midia.php">Enviar Mídias</a></li>
      <li><a href="menu-estudante-autoavaliacao.php">Autoavaliação</a></li>
      <li><a href="menu-estudante-ajuda.php">Ajuda</a></li>
      <li><a href="deslogar.php">Deslogar [<i><?php echo $_SESSION["nome"]; ?></i>]</a></li>
    </ul>
  </div>
</nav>
  <script> temRegistros = true; var listaSelect = new Array();</script>
	<div class="container">
	  <h3>Análise de Atividade</h3>
	  <p>Realize a análise da atividade e faça o registro das dúvidas (estão disponíveis apenas as atividades que ainda não foram enviadas ao professor). </p><br>
	  
		<form method="post" action="cadastrar-duvida-estudante.php" onsubmit="return validarCampos()">
		  <div class="col-7">
			<label for="titulo">Atividade</label>
			  <?php 
			    $ocultar=false;
				$atividades = $_SESSION["atividades"];
				if(count($atividades)>=1){
					echo "<select class='form-control' id='select' name='select' onchange='apresentarSecaoMae()'>";
					echo "<option value='0'>-- Selecione uma opção --</option>";
					foreach ($atividades as $atividade) {
						$id = $atividade->id;
						$titulo = $atividade->titulo;
						$descricao = $atividade->descricao;
						$video = $atividade->video;
						echo "<option value='$id'>#$id - $titulo</option>";
						echo "<script> listaSelect.push(new Atividade('$id', '$titulo', '$descricao', '$video')); </script>";
					}
					echo "</select>";
				}else{
					echo "<p>Não há atividades a serem analisadas.</p>";
					echo "<script> temRegistros = false; </script>";
					$ocultar=true;
				}
			  ?>
		  </div>
		  
		  <br>
		  <div id="divMae">
			<div class="col-7">
			<label for="titulo">Título </label>
			<input type="text" class="form-control" id="titulo" maxlength="100" readonly name="titulo">
		  </div>
		  
		  <br>
		  
		  <div class="col-7">
			<label for="descricao">Vídeo do Youtube</label><br>
			<iframe id="iframe" class="form-control" style="width: 100vh; height: 50vh" src="" allowfullscreen=true></iframe>
		  </div>
		  
		  <br> 
		  
		  <div class="col-7">
			<label for="descricao">Descrição </label>
			<textarea class="form-control" rows="4" id="descricao" maxlength="500" readonly name="descricao"></textarea>
		  </div>
		  
		  <hr>
		  
		  <h3>Registro de Dúvidas</h3>
		  <p>Registre as duvidas e/ou esclarecimentos a serem enviados ao professor. </p><br>
		  
		  <table class="table" id="table">
			<thead>
			  <tr>
				<th>Tempo do vídeo</th>
				<th>Título da Dúvida</th>
				<th>Descrição </th>
			  </tr>
			</thead>
			<tbody>
			  <tr>
				<td width=10%><input type="time" step="1" name="tempo-video-duvida[]" class="form-control" value="00:00:00"></td>
				<td width=20%><input type="text" class="form-control" name="titulo-duvida[]" maxlength="100"></td>
				<td width=70%><textarea class="form-control" rows="1" name="descricao-duvida[]" maxlength="200"></textarea></td>
			  </tr>
			  <tr>
				<td><input type="time" step="1" name="tempo-video-duvida[]" class="form-control" value="00:00:00"></td>
				<td><input type="text" class="form-control" name="titulo-duvida[]" maxlength="100"></td>
				<td><textarea class="form-control" rows="1" name="descricao-duvida[]" maxlength="200"></textarea></td>
			  </tr>
			  <tr>
				<td><input type="time" step="1" name="tempo-video-duvida[]" class="form-control" value="00:00:00"></td>
				<td><input type="text" class="form-control" name="titulo-duvida[]" maxlength="100"></td>
				<td><textarea class="form-control" rows="1" name="descricao-duvida[]" maxlength="200"></textarea></td>
			  </tr>
			</tbody>
		  </table>
		  
		  <label for="descricao"><a href="javascript:javascript:void(0)" onclick="javascript: addLinha()" class="form-control">Adicionar Linha</a> </label>
		  
		  <hr>
		  
			  <div class="col-7">
				<button type="submit" class="btn btn-primary">Registrar Dúvida</button>
			  </div>
			</form>
			</div>

		  </div>
			<br> <br> 
		  
		  <script>
		    apresentarSecaoMae();
			function apresentarSecaoMae(){
				var numSelect = -1;
				var elementoSelect = document.getElementById("select");
				if(elementoSelect !=null){
					numSelect = document.getElementById("select").selectedIndex;
				}
				if(!temRegistros || (numSelect!=undefined && numSelect=="0")){
					document.getElementById("divMae").style.display = 'none';
				}else{
					document.getElementById("titulo").value = listaSelect.at(numSelect-1).titulo;
					var novoLink = listaSelect.at(numSelect-1).video;
				    document.getElementById("iframe").src = novoLink.replace("watch?v=","embed/");
					document.getElementById("descricao").value = listaSelect.at(numSelect-1).descricao;
					document.getElementById("divMae").style.display = '';
				}
			}
		 </script>
		 <script>
		    var posicaoLinhaParaAdicionar = 4;
		    function addLinha(){
				var table = document.getElementById("table");
				var row = table.insertRow(posicaoLinhaParaAdicionar++);
				var cell1 = row.insertCell(0);
				var cell2 = row.insertCell(1);
				var cell3 = row.insertCell(2);
				cell1.insertAdjacentHTML('beforeend','<input type="time" step="1" name="tempo-video-duvida[]" class="form-control" value="00:00:00">' );
				cell2.insertAdjacentHTML('beforeend','<input type="text" class="form-control" name="titulo-duvida[]" maxlength="100">' );
				cell3.insertAdjacentHTML('beforeend','<textarea class="form-control" rows="1" name="descricao-duvida[]" maxlength="200"></textarea>' );
			}
		 </script>
</body>
</html>