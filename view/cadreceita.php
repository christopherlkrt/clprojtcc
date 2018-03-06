<?php

// session_start();
// if(isset($_SESSION['idusuario'])){

//     $idusuario = $_SESSION['idusuario'];
//     $nusuario = $_SESSION['nusuario'];
// }
// else
// {
// 	header("location: ../view/home.php");
// }

include "../model/receitaOP.class.php";
$receitaop= 		new ReceitaOP();
$obj_ingredientes = $receitaop-> getAllingredientes();
$linha=sizeof($obj_ingredientes);


?>







<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/home.css">
	<link rel="stylesheet" type="text/css" href="../css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<script src="../js/jquery-3.2.1.min.js"></script>
	<script src="../js/jquery-ui.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
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

		});
	</script>

	<title>Cadastro Usuario</title>
</head>
<body>
	<form action="../controller/receita.php" method="post" class="col-md-offset-5" enctype="multipart/form-data">
		<div class="input-group form-group">
			<span>Nome Receita</span>
			<input type="text" class="form-control" name="nome" placeholder="Ex. Panquecas" required>
		</div>
	
		<div class="input-group form-group">
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
		</div>


		<div class="">
			<input type="text" id="pesquisaing">
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