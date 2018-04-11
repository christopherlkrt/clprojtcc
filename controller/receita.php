<?php

include "../model/receita.class.php";
include "../model/receita_ingrediente.class.php";
include "../model/receitaOP.class.php";
if (isset($_POST['cadastro']))
{
	

	$nomereceita=	$_POST['nome'];
	$descricao=		$_POST['descricao'];
	$imgreceita=	$_FILES['imgreceita']['name'];
	$tmpimgreceita=	$_FILES['imgreceita']['tmp_name'];
	$usuario=		$_POST['usuario'];



	$receita = new Receita();
	$receita-> setNome($nomereceita);
	$receita-> setDescricao($descricao);
	$receita-> setImg($imgreceita);
	$receita-> setUsuario($usuario);

	$receitaop= new ReceitaOP();
	$idreceita=$receitaop-> inserir($receita);
	move_uploaded_file($tmpimgreceita, "../imgs/receitas/".$imgreceita);

foreach ($_POST['ingrediente'] as $key => $value) {
	
	

    $ingrediente=$_POST['ingrediente'][$key];
    $qtd=$_POST['qtd'][$key];
    $medida=$_POST['medida'][$key];

    $idingrediente=$receitaop-> getIdporNome($ingrediente);

	$receita_ingrediente = new ReceitaIng();
	$receita_ingrediente -> setIngrediente($idingrediente);
	$receita_ingrediente -> setReceita($idreceita);
	$receita_ingrediente -> setQuantia($qtd);
	$receita_ingrediente -> setMedida($medida);


	$receitaop-> inserirReceitaIng($receita_ingrediente);


}

	
}
else if (isset($_POST['entrar']))
{

	$nomereceita=	$_POST['nomereceita'];
	$imgreceita=	$_POST['imgreceita'];

	$receitaop= new ReceitaOP();
	$obj=$receitaop-> getAll();


	if (!$obj){

		echo "erro";
	}
	else{

		$idUsuario = $obj->idusuario;
		$nUsuario=$obj->nomeusuario;

		$_SESSION['idUsuario']=$idUsuario;
		$_SESSION['nUsuario']=$nUsuario;

		header("location: ../view/home.php");

	}

}


?>