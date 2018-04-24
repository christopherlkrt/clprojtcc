<?php
session_start();
include "../model/usuario.class.php";
include "../model/usuarioOP.class.php";
if (isset($_POST['cadastro']))
{
	$nome=$_POST['nome'];
	$email=$_POST['email'];
	$senha=$_POST['senha'];
	$img='user-icon.png';

	$usuario = new Usuario();
	$usuario-> setNome($nome);
	$usuario-> setEmail($email);
	$usuario-> setSenha($senha);
	$usuario-> setImg($img);


	$usuarioop= new UsuarioOP();
	$usuarioop-> inserir($usuario);
	
}
else if (isset($_POST['entrar']))
{

	$email=$_POST['email'];
	$senha=$_POST['senha'];

	$usuarioop= new UsuarioOP();
	$obj=$usuarioop-> logar($email, $senha);


	if (!$obj)
	{
		echo "erro";
	}
	else{

		$idUsuario = $obj->idusuario;
		$nUsuario=$obj->nomeusuario;
		$imgusuario=$obj->img;

		$_SESSION['idusuario']=$idUsuario;
		$_SESSION['nusuario']=$nUsuario;
		$_SESSION['imgusuario']=$imgusuario;

		header("location: ../view/home.php");

	}

}
else if (isset($_POST['salvar']))
{
	
	$idusuario = $_SESSION['idusuario'];
	$nome=$_POST['nome'];
	$img=$_FILES['imgusuario']['name'];
	$tmpimg=$_FILES['imgusuario']['tmp_name'];
	$email=$_POST['email'];
	$senha=$_POST['senha'];

	$usuario = new Usuario();
	$usuario-> setId($idusuario);
	$usuario-> setNome($nome);
	$usuario-> setEmail($email);
	$usuario-> setSenha($senha);
	$usuario-> setImg($img);

	$usuarioop= new UsuarioOP();
	$usuarioop-> update($usuario);

	move_uploaded_file($tmpimg, "../imgs/receitas/".$img);
}
else if (isset($_POST['salvaradmin']))
{
	$idusuario = $_POST['salvaradmin'];
	$nome=$_POST['nome'];
	$email=$_POST['email'];
	$senha=$_POST['senha'];

	$usuario = new Usuario();
	$usuario-> setId($idusuario);
	$usuario-> setNome($nome);
	$usuario-> setEmail($email);
	$usuario-> setSenha($senha);

	$usuarioop= new UsuarioOP();
	$usuarioop-> updateadm($usuario);
}
else if (isset($_POST['deletar'])) {
	$idusuario = $_POST['deletar'];

	$usuarioop = new UsuarioOP();
	$deletar = $usuarioop->deletar($idusuario);


}


?>