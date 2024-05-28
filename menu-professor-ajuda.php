<?php session_start(); ?>
<?php if(!isset($_SESSION['nome'])){echo "<script> alert('Usuário não encontrado, faça o login novamente.'); document.location.href='index.php'; </script>";} ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ajuda </title>
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
      <li><a href="menu-professor-finalizar.php">Encerrar Recebimento de Mídias</a></li>
      <li class="active"><a href="menu-professor-ajuda.php">Ajuda</a></li>
      <li><a href="deslogar.php">Deslogar [<i><?php echo $_SESSION["nome"]; ?></i>]</a></li>
    </ul>
  </div>
</nav>
	<div class="container dash">
	  <h3>Como utilizar o sistema?</h3><br>
	  <p><b>1) Registre uma atividade para os estudantes</b><p>
	  <p>Selecione a opção do menu "Cadastro de Mídia", preencha as informações do vídeo e cadastre a atividade. </p>
	  <p><b>2) Verifique as dúvidas dos estudantes</b><p>
	  <p>Selecione a opção do "Dúvidas dos Estudantes", acesse as dúvidas registradas e preencha as respostas. </p>
	  <p><b>3) Encerre o prazo para o envio de respostas</b><p>
	  <p>Selecione a opção do "Encerrar Recebimento de Mídias" e selecione a atividade que deseja encerrar. </p>
	  <br>
	  <i>Dúvidas e orientações: foma@cin.ufpe.br</i>
	  <br>
	  <br>
	</div>
</body>
</html>