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

		$idUsuario = $obj->idusuario;
		$nUsuario=$obj->nomeusuario;

		$_SESSION['idusuario']=$idUsuario;
		$_SESSION['nusuario']=$nUsuario;

		header("location: ../view/home.php");

	}

}
else if (isset($_POST['salvar']))
{
	$idusuario = $_SESSION['idusuario'];
	$nome=$_POST['nome'];
	$email=$_POST['email'];
	$senha=$_POST['senha'];

	$usuario = new Usuario();
	$usuario-> setId($idusuario);
	$usuario-> setNome($nome);
	$usuario-> setEmail($email);
	$usuario-> setSenha($senha);

	$usuarioop= new UsuarioOP();
	$usuarioop-> update($usuario);
	$resultado= $usuarioop-> getAll();
}


?>