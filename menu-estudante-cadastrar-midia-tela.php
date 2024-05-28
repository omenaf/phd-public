<?php include 'classes.php'; session_start(); ?>
<?php if(!isset($_SESSION['nome'])){echo "<script> alert('Usuário não encontrado, faça o login novamente.'); document.location.href='index.php'; </script>";} ?>
<?php if(isset($_SESSION['msg'])){echo "<script> alert('" . $_SESSION['msg'] . "'); </script>"; unset($_SESSION['msg']);} ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Envio de Mídias</title>
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
  let checkbox = document.getElementById("checkbox");
  let video = document.getElementById("url").value;
  
  if (!checkbox.checked) {
	alert("Confirme que assistiu o vídeo antes de enviá-lo.");
	return false;
  }
  
  if (video.length <= 5) {
	alert("Carregue o vídeo da atividade corretamente.");
	return false;
  }
  
}
</script>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
	  <li><a href="menu-estudante-analisar-atividade.php">Análise de Mídias</a></li>
      <li><a href="menu-estudante-acessar-duvidas.php">Respostas de Dúvidas</a></li>
      <li><a href="menu-estudante-registrar-planejamento.php">Planejamento de Atividade</a></li>
	  <li class="active"><a href="menu-estudante-cadastrar-midia.php">Enviar Mídias</a></li>
      <li><a href="menu-estudante-autoavaliacao.php">Autoavaliação</a></li>
      <li><a href="menu-estudante-ajuda.php">Ajuda</a></li>
      <li><a href="deslogar.php">Deslogar [<i><?php echo $_SESSION["nome"]; ?></i>]</a></li>
    </ul>
  </div>
</nav>
  <script> temRegistros = true; var listaSelect = new Array();</script>
	<div class="container">
	  <h3>Envio de Mídias Digitais</h3>
	  <p>Selecione a atividade desejada e realize o registro da mídia (estão disponíveis apenas as atividades que foram planejadas mas que ainda não foram enviadas ao professor).</p><br>
	  
	  <form method="post" action="cadastrar-midia-estudante.php" onsubmit="return validarCampos()">
		  <div class="col-7">
			<label for="titulo">Atividade</label>
			  <?php 
			    $ocultar=false;
				$atividades = $_SESSION["atividadesPlanejadadas"];
				if(count($atividades)>=1){
					echo "<select class='form-control' id='select' name='select' onchange='apresentarSecaoMae()'>";
					echo "<option value='0'>-- Selecione uma opção --</option>";
					foreach ($atividades as $atividade) {
						$id = $atividade->idAtividade;
						$titulo = $atividade->titulo;
						$campo1 = $atividade->campo1Atividade;
						$campo2 = $atividade->campo2Gravacao;
						$campo3 = $atividade->campo3Lembrete;
						$campo4 = $atividade->campo4Outros;
						echo $id . $campo1 . $campo2 . $campo3 . $campo4;
						echo "<option value='$id'>#$id - $titulo</option>";
						echo "<script> listaSelect.push(new ObservacoesAtividade('$id', '$campo1', '$campo2', '$campo3', '$campo4')); </script>";
					}
					echo "</select>";
				}else{
					echo "<p>Não há atividades a serem planejadas.</p>";
					echo "<script> temRegistros = false; </script>";
					$ocultar=true;
				}
			  ?>
		  </div>
		  
		  <br>
		  
			<div id="divMae">
			 <div class="col-7">
				<label for="descricao">Checklist de Registros de Planejamento (marque confirmar ciência): </label>
			  </div>
			  
			  <table class="table">
				<tbody>
				  <tr>
					<td>Deve se atentar ao realizar a atividade: <font id="campo1"> </font></td>
				  </tr>
				  <tr>
					<td>Deve se atentar ao realizar a gravação do vídeo: <font id="campo2"> </font></td></td>
				  </tr>
				  <tr>
					<td>Para se lembrar: <font id="campo3"> </font></td></td>
				  </tr>
				  <tr>
					<td>Outras observações: <font id="campo4"> </font></td></td>
				  </tr>
				</tbody>
			  </table>
			  
			  <div class="col-7">
					<label for="descricao">Vídeo do Youtube</label><br>
					<input type="text" class="form-control" id="url" name="url" maxlength="200" onchange="carregarVideo()" placeholder="Informe o link do youtube">
					<br id="exibir-dps">
					<iframe id="iframe" class="form-control" style="width: 100vh; height: 50vh" src="" allowfullscreen=true></iframe>
					<table id="exibir-tabela-dps" class="table">
						<tbody>
						  <tr>
							<td width=20px><input id="checkbox" type="checkbox" ></td>
							<td>Assisti o vídeo novamente depois de carretado.</td>
						  </tr>
						</tbody>
					  </table>
				  </div>
			  
			  <br id="ocultar-apos-tabela"> 
			  <div class="col-7">
				<button type="submit" class="btn btn-primary">Enviar Mídia</button>
			  </div>
			</form>
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
				if(!temRegistros || numSelect=="0"){
					document.getElementById("divMae").style.display = 'none';
				}else{
					document.getElementById("campo1").innerHTML= listaSelect.at(numSelect-1).campo1Atividade;
					document.getElementById("campo2").innerHTML= listaSelect.at(numSelect-1).campo2Gravacao;
					document.getElementById("campo3").innerHTML= listaSelect.at(numSelect-1).campo3Lembrete;
					document.getElementById("campo4").innerHTML= listaSelect.at(numSelect-1).campo4Outros;
					document.getElementById("divMae").style.display = '';
				}
			}
		 </script>
		 
		 <script>
			document.getElementById("iframe").style.display = 'none'; 
			document.getElementById("exibir-dps").style.display = 'none'; 
			document.getElementById("exibir-tabela-dps").style.display = 'none';
			document.getElementById("ocultar-apos-tabela").style.display = '';
			function carregarVideo(){
				var link = document.getElementById("url").value;
				if(link.length > 0){
					var regExp = /^(?:https?:\/\/)?(?:m\.|www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
					if (!link.match(regExp)) {
						alert("A url informada não é do youtube.");
						document.getElementById("url").value = "";						
					    document.getElementById("iframe").style.display = 'none'; 
					    document.getElementById("exibir-dps").style.display = 'none'; 
						document.getElementById("exibir-tabela-dps").style.display = 'none';
						document.getElementById("ocultar-apos-tabela").style.display = '';
					}else{
					  var novoLink = link.replace("watch?v=", "embed/");
					  document.getElementById("iframe").src = novoLink;
					  document.getElementById("iframe").style.display = '';
					  document.getElementById("exibir-dps").style.display = '';
					  document.getElementById("exibir-tabela-dps").style.display = '';
					  document.getElementById("ocultar-apos-tabela").style.display = 'none';
					} 
				}else{
				  document.getElementById("iframe").style.display = 'none'; 
				  document.getElementById("exibir-dps").style.display = 'none'; 
				  document.getElementById("exibir-tabela-dps").style.display = 'none';
				  document.getElementById("ocultar-apos-tabela").style.display = '';
				}
		   }
		</script>
</body>
</html>