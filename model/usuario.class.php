<?php

class Usuario{
	private $idusuario;
	private $nome;
	private $senha;
	private $email;
	private $img;
	private $admin;

	public function setNome($nome)
	{
		$this->nome=$nome;
	}

	public function getNome()
	{
		return $this->nome;
	}

	public function setSenha($senha)
	{
		$this->senha=$senha;
	}

	public function getSenha()
	{
		return $this->senha;
	}

	public function setEmail($email)
	{
		$this->email=$email;
	}

	public function getEmail()
	{
		return $this->email;
	}
	public function setId($idusuario)
	{
		 $this->idusuario=$idusuario;
	}
	public function getId()
	{
		return $this->idusuario;
	}
	public function setImg($img)
	{
		 $this->img=$img;
	}
	public function getImg()
	{
		return $this->img;
	}
	public function setAdmin($admin)
	{
		 $this->admin=$admin;
	}
	public function getAdmin()
	{
		return $this->admin;
	}
}
?>