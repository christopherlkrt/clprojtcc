<?php
session_start();
include "../model/ingrediente.class.php";
include "../model/ingredienteOP.class.php";
include "../model/usuario_ing.class.php";
if (isset($_GET['ing']))
 {
 	$nome=	$_GET['ing'];
 	
	$ingrediente = new  IngredienteOP();
	$vetor=$ingrediente->buscaIngredientes($nome);
	
$indice=0;
foreach ($vetor as $valor){
$vetor2[]=$vetor[$indice]['nomeingrediente'];
$indice++;
}

echo json_encode($vetor2);
}
else if (isset($_POST['adding']))
{
	$idingrediente = $_POST['ing'];
	$idusuario=$_SESSION['idusuario'];
	$inclui='sim';
	$ingrediente = new Usuario_ing();
	$ingrediente -> setIngrediente($idingrediente);
	$ingrediente -> setUsuario($idusuario);
	$ingrediente -> setInclui($inclui);

	$ingredienteop = new IngredienteOP();
	$adicionaing = $ingredienteop->incluiIngrediente($ingrediente);
} 
else if(isset($_POST['removeing'])){

	$idingrediente = $_POST['ing'];
	$idusuario=$_SESSION['idusuario'];
	$inclui='nao';
	$ingrediente = new Usuario_ing();
	$ingrediente -> setIngrediente($idingrediente);
	$ingrediente -> setUsuario($idusuario);
	$ingrediente -> setInclui($inclui);

	$ingredienteop = new IngredienteOP();
	$adicionaing = $ingredienteop->incluiIngrediente($ingrediente);
}


// include "../model/ingrediente.class.php";
// include "../model/ingredienteOP.class.php";
// if (isset($_GET['ing']))
//  {
//  	$nome=	$_GET['ing'];
 	

// 	$ing = new  IngredienteOP();


// 	$vetor=$ing->buscaIngredientes($nome);
	
// $indice=0;
// foreach ($vetor as $indice2){
// $vetor2[]=$vetor[$indice]['idingrediente'].'-'.$vetor[$indice]['nomeingrediente'];
// $indice++;
// }


// echo json_encode($vetor2);

// }



?>

