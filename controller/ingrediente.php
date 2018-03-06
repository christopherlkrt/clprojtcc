<?php
include "../model/ingrediente.class.php";
include "../model/ingredienteOP.class.php";
if (isset($_GET['ing']))
 {
 	$ing=	$_GET['ing'];
 	

	$ingrediente = new  IngredienteOP();


	$vetor=$ingrediente->buscaIngredientes($ing);
	
$indice=0;
foreach ($vetor as $indice2){
$vetor2[]=$vetor[$indice]['nomeingrediente'];

}


echo json_encode($vetor2);

}

?>