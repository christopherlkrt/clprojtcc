<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="http://projectsbox.com.br/css/bootstrap-tagsinput.css">
	<link rel="stylesheet" type="text/css" href="http://projectsbox.com.br/css/typeahead.css">
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
</head>
<body>

	<?php if(isset($_POST)) print_r($_POST['ing']); ?>

	<form method="post">
		<input type="text" id="tags-input" name="ing">
		<button>Enviar</button>
	</form>

</body>
</html>

<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/typeahead.js"></script>
<script src="../bootstrap/js/bootstrap-tagsinput.js"></script>
<script>
	var ingredientes = new Bloodhound({
		datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		prefetch: {
			url: '../controller/ingrediente-tags.php',
			cache: false,
			filter: function(list) {
				console.log(list);
				return $.map(list, function(item) {
					console.log(item);
					return { id: item.id, name: item.name }; });
			}
		}
	});
	ingredientes.initialize();

	$('#tags-input').tagsinput({
		itemValue: function(item) {
			return item.id;
		},
		itemText: function(item) {
			return item.name;
		},
		typeaheadjs: {
			name: 'categorias',
			displayKey: 'name',
			source: ingredientes.ttAdapter()
		}
	});

</script>