<?php

class Receita{
	private $id;
	private $nome;
	private $descricao;
	private $nota;
	private $img;
	private $idusuario;

public function setNome($nome)
	{
		$this->nome=$nome;
	}

public function getNome()
	{
		return $this->nome;
	}

public function setDescricao($descricao)
	{
		$this->descricao=$descricao;
	}

public function getDescricao()
	{
		return $this->descricao;
	}

public function setNota($nota)
	{
		$this->nota=$nota;
	}

public function getNota()
	{
		return $this->nota;
	}

public function setImg($img)
	{
		$this->img=$img;
	}

public function getImg()
	{
		return $this->img;
	}

	public function setId($id)
	{
		$this->id=$id;
	}

public function getId()
	{
		return $this->id;
	}

public function setUsuario($idusuario)
	{
		$this->idusuario=$idusuario;
	}

public function getUsuario()
	{
		return $this->idusuario;
	}


}

?>