<?php
include "../model/receita.class.php";
include "../model/receitaOP.class.php";
if (isset($_POST['cadastro']))
{
	$nomereceita=	$_POST['nome'];
	$descricao=		$_POST['descricao'];
	$imgreceita=	$_FILES['imgreceita']['name'];
	$usuario=		$_POST['usuario'];



	$receita = new Receita();
	$receita-> setNome($nomereceita);
	$receita-> setDescricao($descricao);
	$receita-> setImg($imgreceita);
	$receita-> setUsuario($usuario);

	$receitaop= new ReceitaOP();
	$receitaop-> inserir($receita);
	
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