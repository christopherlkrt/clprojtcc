<?php
session_start();
include "../model/categoria.class.php";
include "../model/categoriaOP.class.php";

if (isset($_POST['salvaradmin']))
{
	$idcategoria = $_POST['salvaradmin'];
	$nome=$_POST['nome'];

	$categoria = new Categoria();
	$categoria-> setId($idcategoria);
	$categoria-> setNome($nome);

	$categoriaop= new CategoriaOP();
	$categoriaop-> update($categoria);
} else if (isset($_POST['catadd'])) {
	$nome = $_POST['nome'];
	$categoria = new Categoria();
	$categoria-> setNome($nome);

	$categoriaop= new CategoriaOP();
	$categoriaop-> inserir($categoria);

} else if (isset($_POST['deletar'])) {
	$idcategoria = $_POST['deletar'];

	$categoriaop = new CategoriaOP();
	$deletar = $categoriaop->deletar($idcategoria);


}


?>

