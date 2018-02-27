<?php

class Usuario_receita{
	private $idreceita;
	private $idrsuario;

public function setReceita($idreceita)
	{
		$this->idreceita=$idreceita;
	}

public function getReceita()
	{
		return $this->idreceita;
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