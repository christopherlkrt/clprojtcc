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
	

	$vetoringredientes = explode(',', $_POST['adding']);
	$idusuario=$_SESSION['idusuario'];
	$inclui=1;

	foreach ($vetoringredientes as $indice => $idingrediente) {
		
	$ingrediente = new Usuario_ing();
	$ingrediente -> setIngrediente($idingrediente);
	$ingrediente -> setUsuario($idusuario);
	$ingrediente -> setInclui($inclui);

	$ingredienteop = new IngredienteOP();
	$adicionaing = $ingredienteop->incluiIngrediente($ingrediente);

	}

	
	
} 
else if(isset($_POST['removeing'])){

	$vetoringredientes = explode(',', $_POST['removeing']);
	$idusuario=$_SESSION['idusuario'];
	$inclui=0;

	foreach ($vetoringredientes as $indice => $idingrediente) {
		
	$ingrediente = new Usuario_ing();
	$ingrediente -> setIngrediente($idingrediente);
	$ingrediente -> setUsuario($idusuario);
	$ingrediente -> setInclui($inclui);

	$ingredienteop = new IngredienteOP();
	$adicionaing = $ingredienteop->incluiIngrediente($ingrediente);

	}
}
else if (isset($_POST['deletaing'])) {

	$idingrediente = $_POST['deletaing'];

	$ingrediente = new Usuario_ing();
	$ingrediente->setIngrediente($idingrediente);

	$ingredienteop = new IngredienteOP();
	$deleta = $ingredienteop->deletaIngrediente($idingrediente);


}

else if (isset($_POST['deletar'])) {
	$idingrediente = $_POST['deletar'];

	$ingredienteop = new IngredienteOP();
	$deletar = $ingredienteop->deletar($idingrediente);


}
else if (isset($_POST['salvaradmin']))
{
	$idingrediente = $_POST['salvaradmin'];
	$nome=$_POST['nome'];

	$ingrediente = new Ingrediente();
	$ingrediente-> setId($idingrediente);
	$ingrediente-> setNome($nome);

	$ingredienteop= new IngredienteOP();
	$ingredienteop-> update($ingrediente);
}
else if (isset($_POST['ingadd'])) {
	$nome = $_POST['nome'];
	$ingrediente = new Ingrediente();
	$ingrediente-> setNome($nome);

	$ingredienteop= new IngredienteOP();
	$ingredienteop-> insereIngrediente($ingrediente);

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

