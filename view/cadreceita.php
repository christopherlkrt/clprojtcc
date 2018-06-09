<?php

session_start();
if(isset($_SESSION['idusuario'])){

	$idusuario = $_SESSION['idusuario'];
	$nusuario = $_SESSION['nusuario'];
}
else
{
	header("location: ../view/home.php");
}

include "../model/receitaOP.class.php";
$receitaop= 		new ReceitaOP();
$obj_ingredientes = $receitaop-> getAllingredientes();
$linha=sizeof($obj_ingredientes);

include "../model/categoriaOP.class.php";
$categoriaop = new CategoriaOP();
$obj_categoria = $categoriaop-> getAll();
$linhacat=sizeof($obj_categoria);
?>


<html>
<head>
	<meta charset="UTF-8">

	<script>
		$(document).ready(function() {
			
			$('#pesquisaing').autocomplete({
				source: function(request, response){
					$.ajax({
						url:"../controller/ingrediente.php",
						dataType:"json",
						data:{ing:request.term},
						success: function(data){
							response(data);
						}

					});

				}

			});


			$("#adding").click(function(){
				var ing = document.getElementById("pesquisaing").value;
				var qtd = document.getElementById("qtd").value;
				var medida = document.getElementById("medida").value;
				
				$("#teste").append("<li><input type='hidden' name='qtd[]' value="+qtd+">"+qtd+" <input type='hidden' name='medida[]' value="+medida+">"+medida+" de <input type='hidden' name='ingrediente[]' value="+ing+">"+ing+" <span class='glyphicon glyphicon-remove'></span></li>");
				$('#pesquisaing').val('');
				$('#qtd').val('');
				$('#medida').val('Medida');
			});

			$('#teste').on("click",".glyphicon",function(e) {
				e.preventDefault();
				$(this).parent('li').remove();
               // x--;
           });

			$("#addcat").click(function(){
				var idcat = document.getElementById("categoria").value;
				var nomecat = $( "#categoria option:selected" ).text();
				$("#categorias").append("<li><input type='hidden' name='cat[]' value="+idcat+">"+nomecat+" <span class='glyphicon glyphicon-remove'></span></li>");
				
			});

			$('#categorias').on("click",".glyphicon",function(e) {
				e.preventDefault();
				$(this).parent('li').remove();
	           // x--;
	       });


		});





	</script>

</head>
<body>
	<form method="post" class="col-md-offset-3" id="formReceita" enctype="multipart/form-data">
		<div class="input-group form-group margin-t5">
			<label>Nome Receita</label>
			<input type="text" class="form-control" name="nome" placeholder="Ex. Panquecas" required>
		</div>

		<div class="row">
			<div class="col-md-3 pr-0"><input type="text" class="form-control" id="pesquisaing" placeholder="Ingrediente"></div>
			<div class="col-md-2 p-0"><input type="number" class="form-control" name="qtd" id="qtd" placeholder="Quantidade"></div>
			<div class="col-md-2 p-0"><select class="form-control" name="medida" id="medida" required >
				<option selected>Medida</option>
				<option value="Colher(es)">Colher(es)</option>
				<option value="Xícara(s)">Xícara(s)</option>
				<option value="Unidade(s)">Unidade(s)</option>
				<option value="Pacote(s)">Pacote(s)</option>
				<option value="Lata(s)">Lata(s)</option>
				<option value="Caixa(s)">Caixa(s)</option>
			</select></div>
			<div class="col-md-1"><input type="button" class="btn btn-default" name="adding" id="adding" value="+"></div>
		</div>

		<div>
			<ul id="teste">
				

			</ul>
		</div>

		<div class="form-group">
			<label for="categoria">Categoria(s)</label>
			<div class="form-inline"><select class="form-control" name="categoria" id="categoria" required>
				<option selected>Selecione</option>
				<?php for ($i=0; $i < $linhacat; $i++) { 
					?>
					<option value="<?=$obj_categoria[$i]['id']?>"><?=$obj_categoria[$i]['nome']?></option>
					<?php } ?>
				</select>
				<input type="button" class="btn btn-default" name="addcat" id="addcat" value="+"></div>
			</div>

			<div>
				<ul id="categorias">


				</ul>
			</div>


			<div class="form-group row margin-t5">
				<div class="col-md-8"><label>Descrição</label>
					<textarea class="form-control" rows="7" name="descricao" required></textarea>
				</div>
			</div>

			<div class="input-group form-group">
				<label>Imagem</label>
				<input type="file" class="form-control" name="imgreceita">
			</div>

			<input type="hidden" name="usuario" value="<?=$idusuario?>">
			<input type="hidden" name="cadastro">

			<input type="submit" class="btn btn-default" name="cadastro" value="Cadastrar">


		</form>
	</body>
	<script>
		$( "#formReceita" ).on( "submit", function( event ) {
			if($('#teste').find('input').length==0 || $('[name="ingrediente[]"]').val()=='' || $('[name="qtd[]"]').val()=='' || $('[name="qtd[]"]').val()<=0 || $('[name="medida[]"]').val()=='Medida' || $('[name="medida[]"]').val().length==0){

			var mensagem = "Algo deu errado, verifique os <strong>ingredientes.</strong>.";
            mostraDialogo(mensagem, "warning", 3000);
            event.preventDefault();
			}
			else if($('#categorias').find('input').length==0 || $('[name="cat[]"]').val()=='Selecione') {

			var mensagem = "Algo deu errado, verifique a(s) <strong>categoria(s).</strong>.";
            mostraDialogo(mensagem, "warning", 3000);
			event.preventDefault();
			}
			else {
			var formdata = new FormData(this);
			event.preventDefault();
			var link = "../controller/receita.php";
			$.ajax({
				type: 'POST',
				url: link,
				data: formdata,
				processData: false,
				contentType: false,
				dataType: "json",
			}).done(function (data) {
           	if (data==1) {
           		var mensagem = "<strong>Erro ao enviar</strong>, digite um <strong>ingrediente</strong> válido.";
           		mostraDialogo(mensagem, "warning", 3000);

           	}
           	else{
           		var mensagem = "<strong>Receita enviada</strong>, verifique o status dela na aba <strong>Receitas Enviadas</strong>.";
           		mostraDialogo(mensagem, "success", 3000);
           		$('#retorno').load('cadreceita.php');
           	}
          });

           
   
		}

		});

	</script>
	</html>