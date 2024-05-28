<?php session_start(); ?>
<?php if(!isset($_SESSION['nome'])){echo "<script> alert('Usuário não encontrado, faça o login novamente.'); document.location.href='index.php'; </script>";} ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ajuda</title>
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
      <li><a href="menu-estudante-registrar-planejamento.php">Planejamento de Atividade</a></li>
	  <li><a href="menu-estudante-cadastrar-midia.php">Enviar Mídias</a></li>
      <li><a href="menu-estudante-autoavaliacao.php">Autoavaliação</a></li>
      <li class="active"><a href="menu-estudante-ajuda.php">Ajuda</a></li>
	  <li><a href="deslogar.php">Deslogar [<i><?php echo $_SESSION["nome"]; ?></i>]</a></li>
    </ul>
  </div>
</nav>
	<div class="container dash">
	  <h3>Como utilizar o sistema?</h3><br>
	  <p><b>1) Acesse uma atividade</b><p>
	  <p>Selecione a opção do menu "Análise de Mídia", observe a mídia enviada como atividade e realize o registro de dúvidas a serem sanadas pelo professor. </p>
	  <p><b>2) Verifique as das respostas das dúvidas</b><p>
	  <p>Selecione a opção do "Respostas de Dúvida", acesse as respostas enviadas pelo professor para melhor entender a atividade. </p>
	  <p><b>3) Planeje a execução da atividade</b><p>
	  <p>Selecione a opção do "Planejamento de Atividade", registre observações para execução da atividade. Elas lhe ajudarão no processo de gravação do vídeo. </p>
	  <p><b>4) Envie mídias digitais</b><p>
	  <p>Selecione a opção do "Enviar Mídia" e registre o envio das atividades com auxílio do planejamento registrado. </p>
	  <p><b>5) Avalie seu desempenho</b><p>
	  <p>Selecione a opção do "Autoavaliação" e registre sua própria avaliação sobre seu desempenho. </p>
	  <br>
	  <i>Dúvidas e orientações: foma@cin.ufpe.br</i>
	  <br><br>
	</div>
</body>
</html>