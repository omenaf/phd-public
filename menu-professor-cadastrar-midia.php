<?php session_start(); ?>
<?php if(!isset($_SESSION['nome'])){echo "<script> alert('Usuário não encontrado, faça o login novamente.'); document.location.href='index.php'; </script>";} ?>
<?php if(isset($_SESSION['msg'])){echo "<script> alert('" . $_SESSION['msg'] . "'); </script>"; unset($_SESSION['msg']);} ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cadastro de Mídias Digitais</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="formatacao.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<script>
function validarCampos(){
  let titulo = document.getElementById("titulo").value;
  let video = document.getElementById("url").value;
  let descricao = document.getElementById("descricao").value;
  
  if (titulo.length <= 0) {
	alert("Preencha o título da atividade corretamente.");
	return false;
  }
  
  if (video.length <= 0) {
	alert("Carregue o vídeo da atividade corretamente.");
	return false;
  }
  
  if (descricao.length <= 5) {
	alert("Preencha a descrição da atividade corretamente.");
	return false;
  }
  
}
</script>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li class="active"><a href="menu-professor-cadastrar-midia.php">Cadastro de Mídias</a></li>
      <li><a href="menu-professor-duvidas.php">Dúvidas dos Estudantes</a></li>
      <li><a href="menu-professor-finalizar.php">Encerrar Recebimento de Mídias</a></li>
      <li><a href="menu-professor-ajuda.php">Ajuda</a></li>
	  <li><a href="deslogar.php">Deslogar [<i><?php echo $_SESSION["nome"]; ?></i>]</a></li>
    </ul>
  </div>
</nav>
	<div class="container">
	  <h3>Cadastro de Mídias Digitais</h3>
	  <p>Realize o preenchimento das informações e selecione o vídeo da atividade. </p><br>
	  
	  <form method="post" action="cadastrar-midia.php" onsubmit="return validarCampos()" enctype="multipart/form-data">
		  <div class="col-7">
			<label for="titulo">Título </label>
			<input type="text" class="form-control" id="titulo" maxlength="100" placeholder="Informe o título da atividade" name="titulo">
		  </div>
		  
		  <br>
		  
		  <div class="col-7">
			<label for="descricao">Vídeo do Youtube</label><br>
			<input type="text" class="form-control" id="url" name="url" maxlength="200" onchange="carregarVideo()" placeholder="Informe o link do youtube">
			<br id="exibir-dps">
			<iframe id="iframe" class="form-control" style="width: 100vh; height: 50vh" src="" allowfullscreen=true></iframe>
		  </div>
		  
		  <br> 
		  
		  <div class="col-7">
			<label for="descricao">Descrição </label>
			<textarea class="form-control" rows="4" id="descricao" maxlength="500" placeholder="Informe a descrição da atividade" name="descricao"></textarea>
		  </div>
		  
		  <br>
		  
		  <div class="col-7">
			<button type="submit" class="btn btn-primary">Cadastrar Atividade</button>
		  </div>
		  <br>
	  </form>
	</div>
	
	<script>
		document.getElementById("iframe").style.display = 'none'; 
		document.getElementById("exibir-dps").style.display = 'none'; 
		function carregarVideo(){
			var link = document.getElementById("url").value;
			if(link.length > 0){
				var regExp = /^(?:https?:\/\/)?(?:m\.|www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
				if (!link.match(regExp)) {
					alert("A url informada não é do youtube.");
					document.getElementById("url").value = "";
					document.getElementById("iframe").style.display = 'none'; 
					document.getElementById("exibir-dps").style.display = 'none'; 
				}else{
				  var novoLink = link.replace("watch?v=", "embed/");
				  document.getElementById("iframe").src = novoLink;
				  document.getElementById("iframe").style.display = '';
				  document.getElementById("exibir-dps").style.display = '';
				} 
			}else{
			  document.getElementById("iframe").style.display = 'none'; 
			  document.getElementById("exibir-dps").style.display = 'none'; 
			}
	   }
	</script>
</body>
</html>
