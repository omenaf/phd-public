<?php include 'classes.php'; session_start(); ?>
<?php if(!isset($_SESSION['nome'])){echo "<script> alert('Usuário não encontrado, faça o login novamente.'); document.location.href='index.php'; </script>";} ?>
<?php if(isset($_SESSION['msg'])){echo "<script> alert('" . $_SESSION['msg'] . "'); </script>"; unset($_SESSION['msg']);} ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Autoavaliação</title>
  <meta charset="utf-8">
  <script src="classes.js"></script>
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
      <li class="active"><a href="menu-estudante-autoavaliacao.php">Autoavaliação</a></li>
	  <li><a href="menu-estudante-ajuda.php">Ajuda</a></li>
	  <li><a href="deslogar.php">Deslogar [<i><?php echo $_SESSION["nome"]; ?></i>]</a></li>
    </ul>
  </div>
</nav>
	<script>
	function validarCampos(){
	  let aberta1 = document.getElementById("aberta1").value;
	  let aberta2 = document.getElementById("aberta2").value;
	  let aberta3 = document.getElementById("aberta3").value;
	  
	  if (aberta1.length <= 1) {
		alert("Informe as principais dificuldades identificadas.");
		return false;
	  }
	  
	  if (aberta2.length <= 1) {
		alert("Informe as principais ações e estratégias a serem realizadas.");
		return false;
	  }
	  
	  if (aberta3.length <= 1) {
		alert("Informe suas percepções sobre a abordagem.");
		return false;
	  }
	  
	}
	</script>
	<script> temRegistros = true; var listaSelect = new Array();</script>
	<div class="container">
	  <h3>Registro de Autoavaliação</h3>
	  <p>Ao selecionar uma atividade, acesse os comentários das avaliações realizadas ou realize uma nova avaliação. </p><br>
	  
	  <form method="post" action="cadastrar-avaliacao-estudante.php" onsubmit="return validarCampos()">
		  <div class="col-7">
			<label for="titulo">Atividade</label>
			  <?php 
			    $ocultar=false;
				$atividades = $_SESSION["atividades"];
				if(count($atividades)>=1){
					echo "<select class='form-control' id='select' name='select' onchange='apresentarSecaoMae()'>";
					echo "<option value='0'>-- Selecione uma opção --</option>";
					foreach ($atividades as $atividade) {
						$id = $atividade->idAtividade;
						$titulo = $atividade->titulo;
						$videoAtividade = $atividade->videoAtividade;
						$videoEnviado = $atividade->videoEnviado;
						$campo1 = $atividade->campo1Atividade;
						$campo2 = $atividade->campo2Gravacao;
						$campo3 = $atividade->campo3Lembrete;
						$campo4 = $atividade->campo4Outros;
						$resposta = $atividade->resposta;
						$aberta1 = $resposta->aberta1;
						$aberta2 = $resposta->aberta2;
						$aberta3 = $resposta->aberta3;
						$aberta4 = $resposta->aberta4;
						$perg1 = $resposta->perg1;
						$perg2 = $resposta->perg2;
						$perg3 = $resposta->perg3;
						$perg4 = $resposta->perg4;
						$perg5 = $resposta->perg5;
						$perg6 = $resposta->perg6;
						$perg7 = $resposta->perg7;
						$perg8 = $resposta->perg8;
						$perg9 = $resposta->perg9;
						$perg10 = $resposta->perg10;
						$perg11 = $resposta->perg11;
						$perg12 = $resposta->perg12;
						$perg13 = $resposta->perg13;
						$perg14 = $resposta->perg14;
						$perg15 = $resposta->perg15;
						$perg16 = $resposta->perg16;
						$perg17 = $resposta->perg17;
						echo "<option value='$id'>#$id - $titulo</option>";
						echo "<script> listaSelect.push(new AvaliacaoAtividade('$id', '$videoAtividade', '$videoEnviado', '$campo1', '$campo2', '$campo3', '$campo4', new Resposta('$aberta1','$aberta2','$aberta3','$aberta4','$perg1','$perg2','$perg3','$perg4','$perg5','$perg6','$perg7','$perg8','$perg9','$perg10','$perg11','$perg12','$perg13','$perg14','$perg15','$perg16','$perg17'))); </script>";
					}
					echo "</select>";
				}else{
					echo "<p>Não há atividades para avaliar.</p>";
					echo "<script> temRegistros = false; </script>";
					$ocultar=true;
				}
			  ?>
		  </div>
		  
		  <br>
		  
		  <div id="divMae">
			  
			  <div class="col-7">
				<label for="descricao">Planejamento de ações ao realizar a atividade </label>
				<textarea class="form-control" rows="3" id="campo1" name="campo1"  readonly>Lorem ipsum dolor sit amet. Sit possimus accusamus et dolorem sint quo numquam eligendi ea quae enim ea corporis dolores et eius porro. Et voluptates delectus hic quod veritatis sed distinctio quis non sint velit est aliquam amet? Sed veritatis consequuntur est eius similique At deleniti Quis quo assumenda aperiam et rerum vero aut facilis sint qui tenetur modi. </textarea>
			  </div>
			  
			  <br>
			  
			  <div class="col-7">
				<label for="descricao">Planejamento de ações ao gravar o vídeo </label>
				<textarea class="form-control" rows="3" id="campo2" name="campo2"  readonly>Lorem ipsum dolor sit amet. Sit possimus accusamus et dolorem sint quo numquam eligendi ea quae enim ea corporis dolores et eius porro. Et voluptates delectus hic quod veritatis sed distinctio quis non sint velit est aliquam amet? Sed veritatis consequuntur est eius similique At deleniti Quis quo assumenda aperiam et rerum vero aut facilis sint qui tenetur modi. </textarea>
			  </div>
			  
			  <br>
			  
			  <div class="col-7">
				<label for="descricao">Planejamento do que não esquecer </label>
				<textarea class="form-control" rows="3" id="campo3" name="campo3"  readonly>Lorem ipsum dolor sit amet. Sit possimus accusamus et dolorem sint quo numquam eligendi ea quae enim ea corporis dolores et eius porro. Et voluptates delectus hic quod veritatis sed distinctio quis non sint velit est aliquam amet? Sed veritatis consequuntur est eius similique At deleniti Quis quo assumenda aperiam et rerum vero aut facilis sint qui tenetur modi. </textarea>
			  </div>
			  
			  <br>
			  
			  <div class="col-7">
				<label for="descricao">Outras observações </label>
				<textarea class="form-control" rows="3" id="campo4" name="campo4"  readonly>Lorem ipsum dolor sit amet. Sit possimus accusamus et dolorem sint quo numquam eligendi ea quae enim ea corporis dolores et eius porro. Et voluptates delectus hic quod veritatis sed distinctio quis non sint velit est aliquam amet? Sed veritatis consequuntur est eius similique At deleniti Quis quo assumenda aperiam et rerum vero aut facilis sint qui tenetur modi. </textarea>
			  </div>
			  
			  <br>
			  
			  <div class="col-7">
				<label for="descricao">Vídeo da Atividade</label>
				<iframe id="iframe1" class="form-control" style="width: 100vh; height: 50vh" src="" allowfullscreen=true></iframe>
			  </div>
			  
			  <br>
			  
			  <div class="col-7">
				<label for="descricao">Vídeo Enviado</label>
				<iframe id="iframe2" class="form-control" style="width: 100vh; height: 50vh" src="" allowfullscreen=true></iframe>
			  </div>
			  
			  <br>
			  
			  <br>
			  
			  <div class="col-7">
				<label id="descricao" for="descricao">Reflexão e Avaliação do Processo </label>
				<p>Marque apenas as opções que se aplicam.</p><br>
			  </div>
			  
			  <table class="table">
				<tbody>
				  <tr>
					<td width=20px><input name="perg1" id="perg1" type="checkbox" ></td>
					<td>Foram enviadas dúvidas antes de realizar a gravação?</td>
				  </tr>
				  <tr>
					<td><input type="checkbox" name="perg2" id="perg2"  class="form-check-input"></td>
					<td>As dúvidas respondidas esclareceram o enunciado e ajudaram a entender melhor a atividade</td>
				  </tr>
				  <tr>
					<td><input type="checkbox" name="perg3" id="perg3" class="form-check-input"></td>
					<td>As dúvidas respondidas esclareceram o vídeo recebido e ajudaram as ações gravadas</td>
				  </tr>
				  <tr>
					<td><input type="checkbox" name="perg4" id="perg4" class="form-check-input"></td>
					<td>As dúvidas respondidas esclareceram o que eu deveria fazer e ajudaram em como deveria proceder</td>
				  </tr>
				  <tr>
					<td><input type="checkbox" name="perg5" id="perg5" class="form-check-input"></td>
					<td>As atividades planejadas foram seguidas?</td>
				  </tr>
				  <tr>
					<td><input type="checkbox" name="perg6" id="perg6" class="form-check-input"></td>
					<td>As atividades planejadas ajudaram a definir objetivos?</td>
				  </tr>
				  <tr>
					<td><input type="checkbox" name="perg7" id="perg7" class="form-check-input"></td>
					<td>As atividades planejadas ajudaram a guiar a condução das ações durante a atividade?</td>
				  </tr>
				  <tr>
					<td><input type="checkbox" name="perg8" id="perg8" class="form-check-input"></td>
					<td>O vídeo enviado contempla as demandas requisitadas na atividade?</td>
				  </tr>
				  <tr>
					<td><input type="checkbox" name="perg9" id="perg9" class="form-check-input"></td>
					<td>Na sua opinião, este ambiente colabora para o aperfeiçoamento da ação/atividade?</td>
				  </tr>
				</tbody>
			  </table>
			  
			  <div class="col-7">
				<label for="descricao">Registro de Melhorias</label>
			</div> 
			
			  <table class="table">
				<tbody>
				  <tr>
					<td width=45%>Quais foram as maiores dificuldades identificadas durante o processo? *</td>
					<td><input type="text" name="aberta1" id="aberta1" class="form-control"></td>
				 </tr>
				  <tr>
					<td>Quais ações e/ou estratégias podem ajudar nestas dificuldades? *</td>
				  <td><input type="text" name="aberta2" id="aberta2"class="form-control"></td>
				 </tr>
				  <tr>
					<td>Quais são suas percepções sobre a abordagem realizada? * </td>
				  <td><input type="text" name="aberta3" id="aberta3" class="form-control"></td>
				 </tr>
				  <tr>
					<td>Outras observações relevantes</td>
				  <td><input type="text" name="aberta4" id="aberta4" class="form-control"></td>
				 </tr>
				</tbody>
			  </table>
			  
			  <div class="col-7">
				<label for="descricao">Devo ter mais atenções na próxima atividade </label>
			    <p>Marque apenas as opções que se aplicam.</p><br>
			 </div> 
			  
			  <table class="table">
				<tbody>
				  <tr>
					<td width=20px><input type="checkbox" name="perg10" id="perg10" class="form-check-input"></td>
					<td>Enunciado da atividade</td>
				  </tr>
				  <tr>
					<td><input type="checkbox" name="perg11" id="perg11" class="form-check-input"></td>
					<td>Observação do vídeo recebido</td>
				  </tr>
				  <tr>
					<td><input type="checkbox" name="perg12" id="perg12" class="form-check-input"></td>
					<td>Esclarecer dúvidas antes de iniciar</td>
				  </tr>
				  <tr>
					<td><input type="checkbox" name="perg13" id="perg13" class="form-check-input"></td>
					<td>Definir melhor ações a serem realizadas</td>
				  </tr>
				  <tr>
					<td><input type="checkbox" name="perg14" id="perg14" class="form-check-input"></td>
					<td>Estabelecer lembretes para não esquecer de detalhes</td>
				  </tr>
				  <tr>
					<td><input type="checkbox" name="perg15" id="perg15" class="form-check-input"></td>
					<td>Definir objetivos claros</td>
				  </tr>
				  <tr>
					<td><input type="checkbox" name="perg16" id="perg16" class="form-check-input"></td>
					<td>Processo de gravação do vídeo</td>
				  </tr>
				  <tr>
					<td><input type="checkbox" name="perg17" id="perg17" class="form-check-input"></td>
					<td>Rever mais vezes o vídeo gravado</td>
				  </tr>
				</tbody>
			  </table>
			  
			  <div class="col-7">
				<button type="submit" class="btn btn-primary" id="botao" name="botao">Avaliar Atividade</button>
			  </div>
			</div>
			<input type="text" name="oculto" id="oculto" class="form-control">
	  </form>
	</div>
	<script>
			document.getElementById("oculto").style.display = 'none';
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
					var elementoDaLista = listaSelect.at(numSelect-1);
					document.getElementById("campo1").innerHTML= elementoDaLista.campo1Atividade;
					document.getElementById("campo2").innerHTML= elementoDaLista.campo2Gravacao;
					document.getElementById("campo3").innerHTML= elementoDaLista.campo3Lembrete;
					document.getElementById("campo4").innerHTML= elementoDaLista.campo4Outros;
					var novoLink1 = elementoDaLista.videoAtividade.replace("watch?v=", "embed/");
					document.getElementById("iframe1").src = novoLink1;
					var novoLink2 = elementoDaLista.videoEnviado.replace("watch?v=", "embed/");
					document.getElementById("iframe2").src = novoLink2;
					document.getElementById("divMae").style.display = '';
					document.getElementById("botao").innerHTML='Avaliar Atividade #' + elementoDaLista.idAtividade;
					// se tiver vazio é pq foi avaliado: traz os dados e deixa readonly
					if(elementoDaLista.resposta.aberta1!=''){
						document.getElementById("descricao").innerText = "Avaliação Registrada";
						document.getElementById("aberta1").value = elementoDaLista.resposta.aberta1;
						document.getElementById("aberta2").value = elementoDaLista.resposta.aberta2;
						document.getElementById("aberta3").value = elementoDaLista.resposta.aberta3;
						document.getElementById("aberta4").value = elementoDaLista.resposta.aberta4;
						document.getElementById("aberta1").readOnly = true;
						document.getElementById("aberta2").readOnly = true;
						document.getElementById("aberta3").readOnly = true;
						document.getElementById("aberta4").readOnly = true;
						if(elementoDaLista.resposta.perg1=='1'){document.getElementById("perg1").checked = true;}
						if(elementoDaLista.resposta.perg2=='1'){document.getElementById("perg2").checked = true;}
						if(elementoDaLista.resposta.perg3=='1'){document.getElementById("perg3").checked = true;}
						if(elementoDaLista.resposta.perg4=='1'){document.getElementById("perg4").checked = true;}
						if(elementoDaLista.resposta.perg5=='1'){document.getElementById("perg5").checked = true;}
						if(elementoDaLista.resposta.perg6=='1'){document.getElementById("perg6").checked = true;}
						if(elementoDaLista.resposta.perg7=='1'){document.getElementById("perg7").checked = true;}
						if(elementoDaLista.resposta.perg8=='1'){document.getElementById("perg8").checked = true;}
						if(elementoDaLista.resposta.perg9=='1'){document.getElementById("perg9").checked = true;}
						if(elementoDaLista.resposta.perg10=='1'){document.getElementById("perg10").checked = true;}
						if(elementoDaLista.resposta.perg11=='1'){document.getElementById("perg11").checked = true;}
						if(elementoDaLista.resposta.perg12=='1'){document.getElementById("perg12").checked = true;}
						if(elementoDaLista.resposta.perg13=='1'){document.getElementById("perg13").checked = true;}
						if(elementoDaLista.resposta.perg14=='1'){document.getElementById("perg14").checked = true;}
						if(elementoDaLista.resposta.perg15=='1'){document.getElementById("perg15").checked = true;}
						if(elementoDaLista.resposta.perg16=='1'){document.getElementById("perg16").checked = true;}
						if(elementoDaLista.resposta.perg17=='1'){document.getElementById("perg17").checked = true;}
						document.getElementById("perg1").disabled = true;
						document.getElementById("perg2").disabled = true;
						document.getElementById("perg3").disabled = true;
						document.getElementById("perg4").disabled = true;
						document.getElementById("perg5").disabled = true;
						document.getElementById("perg6").disabled = true;
						document.getElementById("perg7").disabled = true;
						document.getElementById("perg8").disabled = true;
						document.getElementById("perg9").disabled = true;
						document.getElementById("perg10").disabled = true;
						document.getElementById("perg11").disabled = true;
						document.getElementById("perg12").disabled = true;
						document.getElementById("perg13").disabled = true;
						document.getElementById("perg14").disabled = true;
						document.getElementById("perg15").disabled = true;
						document.getElementById("perg16").disabled = true;
						document.getElementById("perg17").disabled = true;
						// botao desaparece pq ja fez avaliacao
						document.getElementById("botao").style.display = 'none';
					}else{
						document.getElementById("descricao").innerText = "Reflexão e Avaliação do Processo";
						document.getElementById("aberta1").value = '';
						document.getElementById("aberta2").value = '';
						document.getElementById("aberta3").value = '';
						document.getElementById("aberta4").value = '';
						document.getElementById("aberta1").readOnly = false;
						document.getElementById("aberta2").readOnly = false;
						document.getElementById("aberta3").readOnly = false;
						document.getElementById("aberta4").readOnly = false;
						document.getElementById("perg1").checked = false;
						document.getElementById("perg2").checked = false;
						document.getElementById("perg3").checked = false;
						document.getElementById("perg4").checked = false;
						document.getElementById("perg5").checked = false;
						document.getElementById("perg6").checked = false;
						document.getElementById("perg7").checked = false;
						document.getElementById("perg8").checked = false;
						document.getElementById("perg9").checked = false;
						document.getElementById("perg10").checked = false;
						document.getElementById("perg11").checked = false;
						document.getElementById("perg12").checked = false;
						document.getElementById("perg13").checked = false;
						document.getElementById("perg14").checked = false;
						document.getElementById("perg15").checked = false;
						document.getElementById("perg16").checked = false;
						document.getElementById("perg17").checked = false;
						document.getElementById("perg1").disabled = false;
						document.getElementById("perg2").disabled = false;
						document.getElementById("perg3").disabled = false;
						document.getElementById("perg4").disabled = false;
						document.getElementById("perg5").disabled = false;
						document.getElementById("perg6").disabled = false;
						document.getElementById("perg7").disabled = false;
						document.getElementById("perg8").disabled = false;
						document.getElementById("perg9").disabled = false;
						document.getElementById("perg10").disabled = false;
						document.getElementById("perg11").disabled = false;
						document.getElementById("perg12").disabled = false;
						document.getElementById("perg13").disabled = false;
						document.getElementById("perg14").disabled = false;
						document.getElementById("perg15").disabled = false;
						document.getElementById("perg16").disabled = false;
						document.getElementById("perg17").disabled = false;
						// botao aparece pq nao fez avaliacao
						document.getElementById("botao").style.display = '';
					}
					document.getElementById("oculto").value=elementoDaLista.idAtividade;
				}
			}
		 </script>
	<br> <br> 
</body>
</html>