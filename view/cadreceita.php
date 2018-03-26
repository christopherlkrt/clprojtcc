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
            });

		   $('#teste').on("click",".glyphicon",function(e) {
                e.preventDefault();
               $(this).parent('li').remove();
               // x--;
        });



		});





	</script>

	<title>Cadastro Usuario</title>
</head>
<body>
	<form action="../controller/receita.php" method="post" class="col-md-offset-4" enctype="multipart/form-data">
		<div class="input-group form-group margin-t5">
			<span>Nome Receita</span>
			<input type="text" class="form-control" name="nome" placeholder="Ex. Panquecas" required>
		</div>
	
		<!-- <div class="input-group form-group">
			<span>Ingredientes: </span>

			<select name="Ingredientes" id="">
			<?php
				for($i=0;$i<$linha;$i++)
				{
			?>

			<option value="<?=$obj_ingredientes[$i]['idingrediente']?>" required><?=$obj_ingredientes[$i]['nomeingrediente']?></option>

			<?php
				}
			?>
			</select>
		</div> -->



		<div class="">
			<input type="text" id="pesquisaing" placeholder="Ingrediente" required />
			<input type="number" class="" name="qtd" id="qtd" placeholder="Quantidade" required >
			<select class="" name="medida" id="medida" required >
				<option value="Colher(es)">Colher(es)</option>
				<option value="Unidade(s)">Unidade(s)</option>
				<option value="Pacote(s)">Pacote(s)</option>
				<option value="Lata(s)">Lata(s)</option>
				<option value="Caixa(s)">Caixa(s)</option>
			</select>
			<input type="button" class="btn btn-default" name="adding" id="adding" value="+">
		</div>

			<div>
				<ul id="teste">
					

				</ul>
			</div>



		<div class="input-group form-group margin-t5">
			<span>Descrição</span>
			<textarea class="form-control" name="descricao" required></textarea>
		</div>

		<div class="input-group form-group">
			<span>Imagem</span>
			<input type="file" class="form-control" name="imgreceita">
		</div>
		
		<input type="hidden" name="usuario" value="<?=$idusuario?>">
		<input type="submit" class="btn btn-default" name="cadastro" value="Cadastrar">
		
		
	</form>
</body>
</html>