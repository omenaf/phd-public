<?php session_start(); ?>
<?php if(!isset($_SESSION['nome'])){echo "<script> alert('Usuário não encontrado, faça o login novamente.'); document.location.href='index.php'; </script>";} ?>
<?php if(isset($_SESSION['msg'])){echo "<script> alert('" . $_SESSION['msg'] . "'); </script>"; unset($_SESSION['msg']);} ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Finalizar Atividade </title>
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
      <li><a href="menu-professor-cadastrar-midia.php">Cadastro de Mídias</a></li>
      <li><a href="menu-professor-duvidas.php">Dúvidas dos Estudantes</a></li>
      <li class="active"><a href="menu-professor-finalizar.php">Encerrar Recebimento de Mídias</a></li>
      <li><a href="menu-professor-ajuda.php">Ajuda</a></li>
      <li><a href="deslogar.php">Deslogar [<i><?php echo $_SESSION["nome"]; ?></i>]</a></li>
    </ul>
  </div>
</nav>
	<div class="container">
	  <h3>Finalizar Atividade</h3>
	  <p>Selecione a atividade que deseja finalizar. </p><br>
	  
	  <form method="post" action="finalizar-atividade.php">
		  <div class="col-7">
			<label for="titulo">Título da Atividade</label>
			  <?php 
			    $ocultar=false;
				$atividades = $_SESSION["atividades"];
				if(count($atividades)>=1){
					echo "<select class='form-control' name='select'>";
					foreach ($atividades as $atividade) {
						$id = explode(";",$atividade)[0];
						$titulo = explode(";",$atividade)[1];
						echo "<option value='$id'>#$id - $titulo</option>";
					}
					echo "</select>";
				}else{
					echo "<p>Não há atividades disponibilizadas para os estudantes.</p>";
					$ocultar=true;
				}
			  ?>
		  </div>
		  
		  <br>
		  
		  <div class="col-7">
			<button type="submit" id="botao" class="btn btn-primary">Finalizar Atividade</button>
		  </div>
	  </form>
	</div>
	<?php 
	if($ocultar){
		echo "<script> document.getElementById('botao').disabled = true;</script>";
	}
  ?>
</body>
</html>