<?php session_start(); ?>
<?php 
	if(isset($_SESSION['msg'])){
		// caso haja msg
		echo "<script> alert('" . $_SESSION['msg'] . "'); </script>"; 
		unset($_SESSION['msg']);
	} else{
		//caso abra em outro navegador index, deve deslogar o que esta aberto
		session_destroy();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Autenticação do Usuário</title>
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
  let email = document.getElementById("email").value;
  let senha = document.getElementById("senha").value;
  let tipo1 = document.getElementById("tipo1");
  let tipo2 = document.getElementById("tipo2");
  
  if (email.length <= 0) {
	alert("Preencha o email corretamente.");
	return false;
  }
  
  if (senha.length <= 0) {
	alert("Preencha a senha corretamente.");
	return false;
  }
  
  if(tipo1.checked == false && tipo2.checked == false ){
	 alert("Selecione uma opção de usuário.");
	 return false;
  }
  
}
</script>

<div id="bk-gray" class="container">
	<div class="col-7">
	  <center><h3>Autenticação do Usuário</h3></center>
	  
	  <form method="post" action="validacao-login.php" onsubmit="return validarCampos()">
		<div class="mb-3 mt-3">
		  <label for="email">Email:</label>
		  <input type="email" id="email" class="form-control" placeholder="Informe o email" name="email">
		</div>
		<br>
		<div class="mb-3">
		  <label for="pwd">Senha:</label>
		  <input type="password" id="senha" class="form-control" placeholder="Informe a senha" name="senha">
		</div>
		<br>
		<div class="form-check mb-1">
			<input type="radio" class="form-check-input" id="tipo1" name="tipo" value="1" >
			<label class="form-check-label" for="radio1">Professor</label>
		</div>
		<div class="form-check mb-3">
			<input type="radio" class="form-check-input" id="tipo2" name="tipo" value="2" checked>
			<label class="form-check-label" for="radio2">Aluno</label>
		</div>
		<br>
		<div class="mb-1">
		<button type="submit" class="btn btn-primary">Entrar</button>
		</div>
		<br>
	  </form>
	  <?php if(isset($_SESSION['error'])){echo "<script> alert('Usuário não encontrado'); </script>";} ?>
	 </div>
</div>
</body>
</html>
