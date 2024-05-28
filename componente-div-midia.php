
  <div class="col-7">
	<label for="descricao">Atividades Planejadas </label>
  </div>
  
  <table class="table">
	<tbody>
	  <tr>
		<td width=20px><input type="checkbox" ></td>
		<td>Lembrete 1</td>
	  </tr>
	  <tr>
		<td><input type="checkbox" class="form-check-input"></td>
		<td>Lembrete 2</td>
	  </tr>
	  <tr>
		<td><input type="checkbox" class="form-check-input"></td>
		<td>Lembrete 3</td>
	  </tr>
	  <tr>
		<td><input type="checkbox" class="form-check-input"></td>
		<td>Lembrete 3</td>
	  </tr>
	</tbody>
  </table>
  
  <div class="col-7">
	<label for="descricao">Selecione o Vídeo </label>
	<input id='videoUpload' type="file" placeholder="Selecione o vídeo" name="video">
	<br>
	<video width="100%" style="display:none" controls>
	  O vídeo selecionado não é suportado pelo seu navegador.
	</video>
  </div>
  
  <br id="mostrar-dps"> 
  
  <!-- VALIDAÇÕES DE FORMULÁRIO -->
  <div class="col-7">
	<button type="submit" class="btn btn-primary">Registrar Envio</button>
  </div>
</form>
</div>

<br> <br> 

<script>
document.getElementById("mostrar-dps").style.display = 'none';
document.getElementById("videoUpload").onchange = function(event) {
  let file = event.target.files[0];
  let blobURL = URL.createObjectURL(file);
  document.querySelector("video").style.display = 'block';
  document.querySelector("video").src = blobURL;
  document.getElementById("mostrar-dps").style.display = '';
}
</script>