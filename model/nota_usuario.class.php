<?php

class Nota_usuario{
	private $idusuario;
	private $idreceita;
	private $nota;

public function setUsuario($idusuario)
	{
		$this->idUsuario=$idusuario;
	}

public function getUsuario()
	{
		return $this->idusuario;
	}

public function setReceita($idreceita)
	{
		$this->idReceita=$idreceita;
	}

public function getReceita()
	{
		return $this->idreceita;
	}

public function setNota($nota)
	{
		$this->nota=$nota;
	}

public function getNota()
	{
		return $this->nota;
	}

}

?>