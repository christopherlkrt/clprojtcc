<?php
// include "../model/ingrediente.class.php";
// include "../model/ingredienteOP.class.php";
// if (isset($_GET['ingrediente']))
//  {
//  	$nome=	$_GET['ingrediente'];
 	

// 	$ingrediente = new  IngredienteOP();


// 	$vetor=$ingrediente->buscaIngredientes($nome);
	
// $indice=0;
// foreach ($vetor as $indice2){
// $vetor2[]=$vetor[$indice]['nomeingrediente'];

// }

$vetor2[]='verde';
$vetor2[]='vermelho';
echo json_encode($vetor2);

// }

?>