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
<!--<link rel="stylesheet" type="text/css" href="../css/jquery-ui.css">-->
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../bootstrap/css/bootstrap-tagsinput.css">
	<style>
	body{ font-family:calibri;}
	.twitter-typeahead { display:initial !important; }
	.bootstrap-tagsinput {line-height:40px;display:block !important;}
	.bootstrap-tagsinput .tag {background:#09F;padding:5px;border-radius:4px;}
	.tt-hint {top:2px !important;}
	.tt-input{vertical-align:baseline !important;}
	.typeahead { border: 1px solid #CCCCCC;border-radius: 4px;padding: 8px 12px;width: 300px;font-size:1.5em;}
	.tt-menu { width:300px; }
	span.twitter-typeahead .tt-suggestion {padding: 10px 20px;	border-bottom:#CCC 1px solid;cursor:pointer;}
	span.twitter-typeahead .tt-suggestion:last-child { border-bottom:0px; }
	.demo-label {font-size:1.5em;color: #686868;font-weight: 500;}
	.bgcolor {max-width: 440px;height: 200px;background-color: #c3e8cb;padding: 40px 70px;border-radius:4px;margin:20px 0px;}
	
	</style>

	<script src="../js/jquery-3.2.1.min.js"></script>
	<script src="../js/typeahead.js"></script>

	<!-- <script src="../js/jquery-ui.min.js"></script> -->
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<script src="../bootstrap/js/bootstrap-tagsinput.js"></script>

	<script>
		 $(document).ready(function() {
		alert('teste2');
		// $('#pesquisaing').autocomplete({
		// source: function(request, response){
		// 	$.ajax({
		// 		url:"../controller/ingrediente.php",
		// 		dataType:"json",
		// 		data:{ing:request.term},
		// 		success: function(data){
		// 			response(data);
		// 		}
		// 	});
		// }

		// });

		// });

	  var countries = new Bloodhound({
	  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	  queryTokenizer: Bloodhound.tokenizers.whitespace,
	  prefetch: {
		url: 'countries.json',
		filter: function(list) {
		  return $.map(list, function(name) {
			return { name: name }; });
		  		alert('teste3');
		}
	  }
	});
	countries.initialize();

	$('#tags-input').tagsinput({
	  typeaheadjs: {
		name: 'countries',
		displayKey: 'name',
		valueKey: 'name',
		source: countries.ttAdapter()
				alert('teste');
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


		<div class="bgcolor">
			<input type="text" id="tags-input" data-role="tagsinput" />
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