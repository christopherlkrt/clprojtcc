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
	if (isset($_POST['isAdmin'])) {
	$admin=$_POST['isAdmin'];
	}
	else{
	$admin=0;
	}

	$usuario = new Usuario();
	$usuario-> setNome($nome);
	$usuario-> setEmail($email);
	$usuario-> setSenha($senha);
	$usuario-> setImg($img);
	$usuario-> setAdmin($admin);



	$usuarioop= new UsuarioOP();
	$retorno = $usuarioop-> inserir($usuario);
	
	if($retorno==1){
		$array[]="certo";
		echo json_encode($array);
	}
	
}
else if (isset($_POST['entrar']))
{

	$email=$_POST['email'];
	$senha=$_POST['senha'];

	$usuarioop= new UsuarioOP();
	$obj=$usuarioop-> logar($email, $senha);


	if (!$obj)
	{
		$array[]="erro";
		echo json_encode($array);
	}
	else{
		$idUsuario = $obj->idusuario;
		$nUsuario=$obj->nomeusuario;
		$imgusuario=$obj->img;
		$admin=$obj->isAdmin;

		$_SESSION['idusuario']=$idUsuario;
		$_SESSION['nusuario']=$nUsuario;
		$_SESSION['imgusuario']=$imgusuario;
		$_SESSION['isAdmin']=$admin;

		$array[]="certo";
		echo json_encode($array);
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

	move_uploaded_file($tmpimg, "../imgs/usuarios/".$img);
}
else if (isset($_POST['salvaradmin']))
{
	$idusuario = $_POST['salvaradmin'];
	$nome=$_POST['nome'];
	$email=$_POST['email'];
	$senha=$_POST['senha'];
	if (isset($_POST['isAdmin'])) {
	$admin=$_POST['isAdmin'];
	}
	else{
	$admin=0;
	}

	$usuario = new Usuario();
	$usuario-> setId($idusuario);
	$usuario-> setNome($nome);
	$usuario-> setEmail($email);
	$usuario-> setSenha($senha);
	$usuario-> setAdmin($admin);

	$usuarioop= new UsuarioOP();
	$usuarioop-> updateadm($usuario);
}
else if (isset($_POST['deletar'])) {
	$idusuario = $_POST['deletar'];

	$usuarioop = new UsuarioOP();
	$deletar = $usuarioop->deletar($idusuario);


}

?>