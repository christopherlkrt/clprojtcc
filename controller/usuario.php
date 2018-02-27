<?php
session_start();
include "../model/usuario.class.php";
include "../model/usuarioOP.class.php";
if (isset($_POST['cadastro']))
{
	$nome=$_POST['nome'];
	$email=$_POST['email'];
	$senha=$_POST['senha'];

	$usuario = new Usuario();
	$usuario-> setNome($nome);
	$usuario-> setEmail($email);
	$usuario-> setSenha($senha);

	$usuarioop= new UsuarioOP();
	$usuarioop-> inserir($usuario);
	$resultado= $usuarioop-> getAll();
	
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

		$idUsuario = $obj->idUsuario;
		$nUsuario=$obj->nomeUsuario;

		$_SESSION['idUsuario']=$idUsuario;
		$_SESSION['nUsuario']=$nUsuario;

		header("location: ../view/home.php");

	}

}


?>