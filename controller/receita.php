<?php

include "../model/receita.class.php";
include "../model/receita_ingrediente.class.php";
include "../model/receitaOP.class.php";
include "../model/categoria.class.php";
include "../model/categoriaOP.class.php";
include "../model/receita_categoria.class.php";
include "../model/receita_categoriaOP.class.php";
if (isset($_POST['cadastro']))
{
	
	foreach ($_POST['ingrediente'] as $key => $value) {
		$ingrediente=$_POST['ingrediente'][$key];
		$receitaop= new ReceitaOP();
		$idingrediente=$receitaop-> getIdporNome(strtoupper($ingrediente));

		if($idingrediente==null){
			$erro=1;
			break;
		}
		else {
			$erro=0;
		}
	}

	if ($erro==1) {
		$array[]=1;
		echo json_encode($array);
	}
	else {
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

	$idreceita=$receitaop-> inserir($receita);
	move_uploaded_file($tmpimgreceita, "../imgs/receitas/".$imgreceita);


	foreach ($_POST['ingrediente'] as $key => $value) {

		$ingrediente=$_POST['ingrediente'][$key];
		$qtd=$_POST['qtd'][$key];
		$medida=$_POST['medida'][$key];

		$idingrediente=$receitaop-> getIdporNome(strtoupper($ingrediente));
		
		$receita_ingrediente = new ReceitaIng();
		$receita_ingrediente -> setIngrediente($idingrediente);
		$receita_ingrediente -> setReceita($idreceita);
		$receita_ingrediente -> setQuantia($qtd);
		$receita_ingrediente -> setMedida($medida);

		$receitaop-> inserirReceitaIng($receita_ingrediente);
		
	}
	
		foreach ($_POST['cat'] as $key => $value) {

			$categoria=$_POST['cat'][$key];

			$receita_categoria = new ReceitaCat();
			$receita_categoria -> setReceita($idreceita);
			$receita_categoria -> setCategoria($categoria);

			$receitacatop = new ReceitaCatOP();
			$receitacatop-> inserirReceitaCat($receita_categoria);
		}
	
	$array[]=0;
	echo json_encode($array);

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
else if (isset($_POST['idreceita']))
{
	
	$idreceita = $_POST['idreceita'];
	$nome=$_POST['nome'];
	$descricao=$_POST['descricao'];
	$img=$_FILES['imgreceita']['name'];
	$tmpimg=$_FILES['imgreceita']['tmp_name'];

	$receita = new Receita();
	$receita-> setId($idreceita);
	$receita-> setNome($nome);
	$receita-> setDescricao($descricao);
	$receita-> setImg($img);

	$receitaop= new ReceitaOP();
	$receitaop-> update($receita);

	move_uploaded_file($tmpimg, "../imgs/receitas/".$img);
}
else if (isset($_POST['addreceita']))
{
	$nome=$_POST['nome'];
	$descricao=$_POST['descricao'];
	$img=$_FILES['imgreceita']['name'];
	$tmpimg=$_FILES['imgreceita']['tmp_name'];

	$receita = new Receita();
	$receita-> setNome($nome);
	$receita-> setDescricao($descricao);
	$receita-> setImg($img);

	$receitaop= new ReceitaOP();
	$receitaop-> inserirAdm($receita);

	move_uploaded_file($tmpimg, "../imgs/receitas/".$img);
}
else if (isset($_POST['aprovar'])) {
	$idreceita = $_POST['aprovar'];
	
	$receitaop = new ReceitaOP();
	$aprovar = $receitaop->aprovaReceita($idreceita);


}
else if (isset($_POST['deletar'])) {
	$idreceita = $_POST['deletar'];
	
	$receitaop = new ReceitaOP();
	$deletar = $receitaop->deletar($idreceita);


}
// else if (isset($_POST['geraReceitas'])) {
// 	include "../model/ingredienteOP.class.php";
// 	session_start();
// 	$idusuario=$_SESSION['idusuario'];

// 		$ingredienteOP = new IngredienteOP();
// 		$itens = $ingredienteOP->getIngredientesIn($idusuario);
// 		$itens1 = $ingredienteOP->getIngredientesOut($idusuario);


// 	if($itens!=null and $itens1!=null){
// 		$i=0;
// 		foreach ($itens as $key => $value) {
// 			$itensSplit[$i]=$itens[$key];
// 			$i++;	
// 		}
// 		foreach ($itensSplit as $key => $value) {
// 			$itensIn[]=$itensSplit[$key]['idingrediente'];
// 		}
// 		$itensInMDS=implode(', ', $itensIn);


// 		$i=0;
// 		foreach ($itens1 as $key => $value) {
// 			$itensSplit1[$i]=$itens1[$key];
// 			$i++;	
// 		}
// 		foreach ($itensSplit1 as $key => $value) {
// 			$itensOut[]=$itensSplit1[$key]['idingrediente'];
// 		}
// 		$itensOutMDS=implode(', ', $itensOut);
// 		$geraReceitas = $ingredienteOP->customReceitas($itensInMDS, $itensOutMDS);
// 	}else if ($itens!=null and $itens1==null) {

// 		$i=0;
// 		foreach ($itens as $key => $value) {
// 			$itensSplit[$i]=$itens[$key];
// 			$i++;	
// 		}
// 		foreach ($itensSplit as $key => $value) {
// 			$itensIn[]=$itensSplit[$key]['idingrediente'];
// 		}
// 		$itensInMDS=implode(', ', $itensIn);
// 		$geraReceitas = $ingredienteOP->buscaIngs($itensInMDS);

// 	}else if ($itens==null and $itens1!=null){

// 		$i=0;
// 		foreach ($itens1 as $key => $value) {
// 			$itensSplit1[$i]=$itens1[$key];
// 			$i++;	
// 		}
// 		foreach ($itensSplit1 as $key => $value) {
// 			$itensOut[]=$itensSplit1[$key]['idingrediente'];
// 		}
// 		$itensOutMDS=implode(', ', $itensOut);
// 		$geraReceitas = $ingredienteOP->buscaIngsOut($itensOutMDS);

// 	}
// }
?>