<?php include 'classes.php'; session_start(); ?>
<?php if(!isset($_SESSION['nome'])){echo "<script> alert('Usuário não encontrado, faça o login novamente.'); document.location.href='index.php'; </script>";} ?>
<?php if(isset($_SESSION['msg'])){echo "<script> alert('" . $_SESSION['msg'] . "'); </script>"; unset($_SESSION['msg']);} ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Registro de Planejamento</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="formatacao.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
	  <li><a href="menu-estudante-analisar-atividade.php">Análise de Mídias</a></li>
      <li><a href="menu-estudante-acessar-duvidas.php">Respostas de Dúvidas</a></li>
      <li class="active"><a href="menu-estudante-registrar-planejamento.php">Planejamento de Atividade</a></li>
	  <li><a href="menu-estudante-cadastrar-midia.php">Enviar Mídias</a></li>
      <li><a href="menu-estudante-autoavaliacao.php">Autoavaliação</a></li>
      <li><a href="menu-estudante-ajuda.php">Ajuda</a></li>
	  <li><a href="deslogar.php">Deslogar [<i><?php echo $_SESSION["nome"]; ?></i>]</a></li>
    </ul>
  </div>
</nav>

<script>
function validarCampos(){
  let select = document.getElementById("select").value;
  let campoAtividade = document.getElementById("campo1").value;
  let campoVideo = document.getElementById("campo2").value;
  
  if (select == 0) {
	alert("Selecione uma atividade válida.");
	return false;
  }
  
  if (campoAtividade.length <= 0) {
	alert("Preencha as orientações para a realização da atividade.");
	return false;
  }
  
  if (campoVideo.length <= 0) {
	alert("Preencha as orientações para a gravação do vídeo.");
	return false;
  }
  
}
</script>

	<div class="container">
	  <h3>Registro de Planejamento</h3>
	  <p>Realize o registro de planejamento e recomendações para a gravação do vídeo (estão disponíveis apenas as atividades que não foram planejadas). </p><br>
	  
	  <!-- AÇÃO DA PÁGINA -->
	  <form method="post" action="cadastrar-planejamento.php" onsubmit="return validarCampos()">
		  <div class="col-7">
			<label for="titulo">Atividade</label>
			  <?php 
			    $ocultar=false;
				$atividades = $_SESSION["atividades"];
				if(count($atividades)>=1){
					echo "<select class='form-control' id='select' name='select' onchange='carregar()'>";
					echo "<option value='0'>-- Selecione uma opção -- </option>";
					foreach ($atividades as $atividade) {
						$id = $atividade->id;
						$titulo = $atividade->titulo;
						echo "<option value='$id'>#$id - $titulo</option>";
					}
					echo "</select>";
				}else{
					echo "<p>Não há atividades a serem planejadas.</p>";
					$ocultar=true;
				}
			  ?>
		  </div>
		  
		  <br>
		  
		  <?php if(!$ocultar) {include 'componente-div-planejamento.php';} ?>
		  
	  </form>
	</div>
</body>
</html>