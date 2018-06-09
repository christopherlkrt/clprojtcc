<?php
session_start();
include "../model/nota_usuario.class.php";
include "../model/usuarioOP.class.php";
// include "../model/ReceitaOP.class.php";


if (isset($_POST['nota']))
{
	$nota = $_POST['nota'];
	$idreceita = $_POST['idreceita'];
	$idusuario = $_SESSION['idusuario'];

	$nota_receita = new Nota_usuario();
	$nota_receita-> setUsuario($idusuario);
	$nota_receita-> setReceita($idreceita);
	$nota_receita-> setNota($nota);

	$nota_receitaOp = new UsuarioOP();
	$nota_receitaOp-> inserirNota($nota_receita);

	// $media_receitaOP = new ReceitaOP();
	// $media_receitaOP-> inserirMedia($nota_receita);

}

?>