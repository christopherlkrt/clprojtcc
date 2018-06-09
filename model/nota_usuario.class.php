<?php

class Nota_usuario{
	private $idusuario;
	private $idreceita;
	private $nota;

public function setUsuario($idusuario)
	{
		$this->idusuario=$idusuario;
	}

public function getUsuario()
	{
		return $this->idusuario;
	}

public function setReceita($idreceita)
	{
		$this->idreceita=$idreceita;
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